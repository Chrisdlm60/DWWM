<?php
/**
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2014 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_CAN_LOAD_FILES_'))
	exit;
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
include_once _PS_MODULE_DIR_.'wtproductmanu/classes/WtProductManuClass.php';
include_once _PS_MODULE_DIR_.'wtproductmanu/sql/SampleDataProManu.php';

class WtProductManu extends Module implements WidgetInterface
{
	private $temp_url = '{wtproductmanu_url}';
	private $html;
	private $settings_default;
	private $wt_manu_config;
	private $config;
	public function __construct()
	{
		$this->name = 'wtproductmanu';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'waterthemes';
		$this->bootstrap = true;
		parent::__construct();
		$this->displayName = $this->getTranslator()->trans('WT Products Manufacture', array(), 'Modules.WTProductsManufacture.Admin');
		$this->description = $this->getTranslator()->trans('Show product of Manufacture', array(), 'Modules.WTProductsManufacture.Admin');
		$this->ps_versions_compliancy = array('min' => '1.7.0.0', 'max' => _PS_VERSION_);
	}
	
	public function install()
	{
		Configuration::updateValue('USED_SLIDER', 1);
		Configuration::updateValue('NUMBER_TAB_MANU', 10);
		Configuration::updateValue('NUMBER_LINE_SHOW', 2);
		Configuration::updateValue('TOTAL_NUMBER_PRODUCT', 12);
		
		if (!parent::install() || !$this->registerHook('actionShopDataDuplication') || !$this->registerHook('displayHeader') || !$this->registerHook('displayCenterHome') || !$this->registerHook('actionObjectLanguageAddAfter'))
			return false;
		if (!Configuration::hasKey($this->wt_manu_config))
			Configuration::updateValue($this->wt_manu_config, '');
		include(dirname(__FILE__).'/sql/install.php');
		$sample_data = new SampleDataProManu();
		if (!$sample_data->initData())
			return false;
		return true;	
	}
	public function uninstall()
	{
		include(dirname(__FILE__).'/sql/uninstall.php');
		return parent::uninstall();
	}
	public function getItemsPerLineList()
	{
		$products_per_line = array();
		$i = 0;
		for ($i = 1; $i <= 8; $i++)
			$products_per_line[$i]['number'] = $i;
		return $products_per_line;
	}
	
	public function getPositionList()
	{
		$position_line = array();
		$position_line[0]['position'] = 'left';
		$position_line[1]['position'] = 'right';
		return $position_line;
	}
	public function checkValidate()
	{
		$configs = Tools::getValue('config');
		$errors = array();
		foreach ($configs as $key_option => $value_option)
		{
			$pos = strpos($key_option, 'number_');
			if ($pos !== false)
				if (isset($value_option) && (!$value_option || $value_option <= 0 || !Validate::isInt($value_option)))
					$errors[] = $this->l('An invalid '.$key_option.' has been specified.');
		}
		return $errors;
	}
	public function postProcess()
	{		
		if (Tools::isSubmit('saveBanner'))
		{
			$languageDefault = Configuration::get('PS_LANG_DEFAULT');
			if ((!isset($_FILES['image']['tmp_name']) || $_FILES['image']['tmp_name'] == '') && !Tools::getValue('id_wtproductmanu'))
				$this->html .= $this->displayError($this->l('Banner empty !'));
			else if (Tools::getValue('title_'.$languageDefault.'') == '')
				$this->html .= $this->displayError($this->l('Title for language default empty !'));
			else 
			{
				$reinsurance = new WtProductManuClass(Tools::getValue('id_wtproductmanu'));
				$reinsurance->copyFromPost();
				
				if ($reinsurance->validateFields(false) && $reinsurance->validateFieldsLang(false))
				{
					$reinsurance->save();
					if (isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name']))
					{
						$id_shop = $this->context->shop->id;
						if ($error = ImageManager::validateUpload($_FILES['image']))
							return false;
						elseif (!($tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS')) || !move_uploaded_file($_FILES['image']['tmp_name'], $tmpName))
							return false;
						elseif (!ImageManager::resize($tmpName, dirname(__FILE__).'/views/img/reinsurance-'.(int)$reinsurance->id.'-'.$id_shop.'.jpg'))
							return false;
						unlink($tmpName);
						$reinsurance->file_name = 'reinsurance-'.(int)$reinsurance->id.'-'.$id_shop.'.jpg';
						$reinsurance->save();
					}
					Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
				}
				else
					$this->html .= '<div class="conf error">'.$this->l('An error occurred while attempting to save.').'</div>';
			}
		}
		elseif (Tools::isSubmit('changeStatus') && Tools::getValue('id_wtproductmanu'))
		{
			$banner = new WtProductManuClass(Tools::getValue('id_wtproductmanu'));
			if ($banner->active == 0)
				$banner->active = 1;
			else
				$banner->active = 0;
			$res = $banner->update();
			$this->html .= ($res ? $this->displayConfirmation($this->l('Configuration updated')) : $this->displayError($this->l('The configuration could not be updated.')));
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}
		else if (Tools::isSubmit('saveConfig'))
		{
			$errors = $this->checkValidate();
			if (isset($errors) && count($errors))
				$this->html .= $this->displayError(implode('<br />', $errors));
			else
			{
					
					Configuration::updateValue('NUMBER_LINE_SHOW', Tools::getValue('number_line_show'));
					Configuration::updateValue('TOTAL_NUMBER_PRODUCT', Tools::getValue('total_number_product'));
					Configuration::updateValue('USED_SLIDER', Tools::getValue('used_slider'));
					Configuration::updateValue('NUMBER_TAB_MANU', Tools::getValue('number_tab_manu'));
					
					Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&successConfirmation');
				
			}
		}
		else if (Tools::isSubmit('deleteBanner'))
		{
			$banner = new WtProductManuClass(Tools::getValue('id_wtproductmanu'));
			$banner->delete();
			if (file_exists(dirname(__FILE__).'/views/img/'.$banner->file_name) && !$banner->bannerExistShop())
				unlink(dirname(__FILE__).'/views/img/'.$banner->file_name);
			Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}
		else if (Tools::isSubmit('successConfirmation'))
			$this->html .= $this->displayConfirmation($this->l('Your settings have been updated.'));
	}
	public function getContent()
	{
		$this->postProcess();
		if (Tools::isSubmit('addBanner') || Tools::isSubmit('editBanner') || Tools::isSubmit('saveBanner'))
			$this->initForm();
		else
		{
			$this->html .= $this->renderList();
			$this->displaySettings();
		}
		$this->_displayAdvertising();
		return $this->html;
	}
	
	private function getBanners($active = null)
	{
		$this->context = Context::getContext();
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
		if (!$result = Db::getInstance()->ExecuteS(
			'SELECT bs.*, bl.`title`,bl.`link`
			FROM `'._DB_PREFIX_.'wtproductmanu` b
			LEFT JOIN `'._DB_PREFIX_.'wtproductmanu_shop` bs ON (bs.`id_wtproductmanu` = b.`id_wtproductmanu` )
			LEFT JOIN `'._DB_PREFIX_.'wtproductmanu_lang` bl ON (b.`id_wtproductmanu` = bl.`id_wtproductmanu` '.( $id_shop ? 'AND bl.`id_shop` = '.$id_shop : ' ' ).') 
			WHERE bl.id_lang = '.(int)$id_lang.
			($active ? ' AND bs.`active` = 1' : ' ').
			( $id_shop ? 'AND bs.`id_shop` = '.$id_shop : ' ' ).''))
			return false;
		return $result;
	}
	
	public function _displayAdvertising()
{
		$this->html .= '
		<br/>
		<fieldset>
			<legend>'.$this->l('More Themes & Modules').'</legend>	
			<iframe src="https://waterthemes.com/advertising/prestashop_advertising.html" width="100%" height="420px;" border="0" style="border:none;"></iframe>
			</fieldset>';
		return $this->html;
}

	public function displaySettings()
{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Option'),
					'icon' => 'icon-cogs'
				),
				'input' => array
				(
					array(
						'type' => 'switch',
						'label' => $this->l('Used slider'),
						'name' => 'used_slider',
						'values' => array(
								array(
									'id' => 'used_slider_on',
									'value' => 1,
									'label' => $this->l('Enabled')
								),
								array(
									'id' => 'used_slider_off',
									'value' => 0,
									'label' => $this->l('Disabled')
								)
						),
					),
					array(
						'type' => 'text',
						'label' => $this->l('Number tab brand show:'),
						'desc' => $this->l('Number tab brand displayed'),
						'lang' => false,
						'name' => 'number_tab_manu',
						'cols' => 20,
						'rows' => 10,
						'class' => 'fixed-width-xs'
					),		
					array(
						'type' => 'text',
						'label' => $this->l('Number line show:'),
						'desc' => $this->l('Number line of product to displayed'),
						'lang' => false,
						'name' => 'number_line_show',
						'cols' => 20,
						'rows' => 10,
						'class' => 'fixed-width-xs'
					),		
					array(
						'type' => 'text',
						'label' => $this->l('Total number products:'),
						'desc' => $this->l('Total number products to be displayed.'),
						'lang' => false,
						'name' => 'total_number_product',
						'cols' => 20,
						'rows' => 10,
						'class' => 'fixed-width-xs'
					),		
				),
				'submit' => array(
					'title' => $this->l('Save'),
				)
			),
		);
		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$this->fields_form = array();
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'saveConfig';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'
		&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValuesOption()
		);
		$this->html .= $helper->generateForm(array($fields_form));
		
}

public function getConfigFieldsValuesOption()
{
		return array(
			'number_line_show' => Tools::getValue('number_line_show', Configuration::get('NUMBER_LINE_SHOW')),
			'total_number_product' => Tools::getValue('total_number_product', Configuration::get('TOTAL_NUMBER_PRODUCT')),
			'number_tab_manu' => Tools::getValue('number_tab_manu', Configuration::get('NUMBER_TAB_MANU')),
			'used_slider' => Tools::getValue('used_slider', Configuration::get('USED_SLIDER')),
		);
		
}

	private function renderList()
	{
		if ($this->getBanners(false) && count($this->getBanners(false)) > 0)
		{
			$banners = $this->getBanners(false);
			foreach ($banners as $key => $banner)
				$banners[$key]['status'] = $this->displayStatus($banner['id_wtproductmanu'], $banner['active']);
		}
		else
			$banners = array();
		
		$this->context->smarty->assign(
			array(
				'link' => $this->context->link,
				'banners' => $banners
			)
		);
		return $this->display(__FILE__, 'views/templates/admin/list.tpl');
	}
	
	public function displayStatus($id_wtproductmanu, $active)
	{
		$title = ((int)$active == 0 ? $this->l('Disabled') : $this->l('Enabled'));
		$icon = ((int)$active == 0 ? 'icon-remove' : 'icon-check');
		$class = ((int)$active == 0 ? 'btn-danger' : 'btn-success');
		$html = '<a class="btn '.$class.'" href="'.AdminController::$currentIndex.
			'&configure='.$this->name.'
				&token='.Tools::getAdminTokenLite('AdminModules').'
				&changeStatus&id_wtproductmanu='.(int)$id_wtproductmanu.'" title="'.$title.'"><i class="'.$icon.'"></i> '.$title.'</a>';

		return $html;
	}
	
	public function initForm()
	{
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$id_wtproductmanu = Tools::getValue('id_wtproductmanu');
		if ($id_wtproductmanu)
			$wtproductmanu = new WtProductManuClass((int)$id_wtproductmanu);
		else
			$wtproductmanu = new WtProductManuClass();
		if ($wtproductmanu->file_name != '')
			$banner = __PS_BASE_URI__.'modules/'.$this->name.'/views/img/'.$wtproductmanu->file_name;
		else
			$banner = '';
		$this->fields_form[0]['form'] = array(
			'legend' => array(
				'title' => $this->l('New Banner.'),
			),
			'input' => array(
				array(
					'type' => 'file',
					'label' => $this->l('Image:'),
					'name' => 'image',
					'value' => true,
					'banner' => $banner
				),
				array(
					'type' => 'text',
					'label' => $this->l('Title:'),
					'name' => 'title',
					'lang' => true
				),
				array(
					'type' => 'text',
					'label' => $this->l('Link:'),
					'name' => 'link',
					'lang' => true
					
				),
				array(
					'type' => 'select',
					'label' => $this->l('Position'),
					'name' => 'position',
					'options' => array(
						'query' => $this->getPositionList(),
						'id' => 'position',
						'name' => 'position'
						)
					),
				array(
					'type' => 'textarea',
					'label' => $this->l('Text:'),
					'lang' => true,
					'name' => 'text',
					'cols' => 40,
					'rows' => 10
				),
				array(
						'type' => 'switch',
						'label' => $this->l('Displayed'),
						'name' => 'active',
						'values' => array(
									array(
										'id' => 'active_on',
										'value' => 1,
										'label' => $this->l('Enabled')
									),
									array(
										'id' => 'active_off',
										'value' => 0,
										'label' => $this->l('Disabled')
									)
						),
				),
			),
			'submit' => array(
				'title' => $this->l('Save')
			)
		);
		
		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'wtproductmanu';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->show_cancel_button = true;
		$helper->back_url = AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules');
		foreach (Language::getLanguages(false) as $lang)
			$helper->languages[] = array(
				'id_lang' => $lang['id_lang'],
				'iso_code' => $lang['iso_code'],
				'name' => $lang['name'],
				'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
			);
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->toolbar_scroll = true;
		$helper->title = $this->displayName;
		$helper->submit_action = 'saveBanner';
		$helper->toolbar_btn = array(
			'save' =>
			array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'back' =>
			array(
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
				'desc' => $this->l('Back to list')
			)
		);
		
		if ($id_wtproductmanu)
		{
			$this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_wtproductmanu');
			$helper->fields_value['id_wtproductmanu'] = (int)Tools::getValue('id_wtproductmanu', $wtproductmanu->id_wtproductmanu);	
			$helper->fields_value['active'] = Tools::getValue('active', $wtproductmanu->active);
			$helper->fields_value['position'] = Tools::getValue('position', $wtproductmanu->position);
			foreach (Language::getLanguages(false) as $lang)
			{
				$helper->fields_value['title'][(int)$lang['id_lang']] = Tools::getValue('title_'.(int)$lang['id_lang'], $wtproductmanu->title[(int)$lang['id_lang']]);
				$helper->fields_value['link'][(int)$lang['id_lang']] = Tools::getValue('link_'.(int)$lang['id_lang'], $wtproductmanu->link[(int)$lang['id_lang']]);
				$helper->fields_value['text'][(int)$lang['id_lang']] = Tools::getValue('text_'.(int)$lang['id_lang'], $wtproductmanu->text[(int)$lang['id_lang']]);
			}
		}
		else
		{
			$helper->fields_value['active'] = Tools::getValue('active', 1);
			$helper->fields_value['position'] = Tools::getValue('position', 'left');
			foreach (Language::getLanguages(false) as $lang)
			{
				$helper->fields_value['title'][(int)$lang['id_lang']] = Tools::getValue('title_'.(int)$lang['id_lang'], 'Banner Title');
				$helper->fields_value['link'][(int)$lang['id_lang']] = Tools::getValue('link_'.(int)$lang['id_lang'], '#');
				$helper->fields_value['text'][(int)$lang['id_lang']] = Tools::getValue('text_'.(int)$lang['id_lang'], '');
			}
			
		}
		$this->html .= $helper->generateForm($this->fields_form);
	}
	
	public function getBannersDisplay($position)
	{
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;
		$banners = Db::getInstance()->ExecuteS(
		'SELECT bs.*, bl.`title`,bl.`link`,bl.`text`,b.`file_name`
			FROM `'._DB_PREFIX_.'wtproductmanu` b
			LEFT JOIN `'._DB_PREFIX_.'wtproductmanu_shop` bs ON (bs.`id_wtproductmanu` = b.`id_wtproductmanu` )
			LEFT JOIN `'._DB_PREFIX_.'wtproductmanu_lang` bl ON (b.`id_wtproductmanu` = bl.`id_wtproductmanu` AND bl.`id_shop` = '.$id_shop.') 
			WHERE bs.position = "'.$position.'" AND bl.id_lang = '.(int)$id_lang.' AND bs.id_shop = '.(int)$id_shop.' AND bs.`active` = 1');
		return $banners;
	}
	
	public function getWidgetVariables($hookName = null, array $configuration = [])
    {
		$this->context = Context::getContext();
		$manu_f = Manufacturer::getManufacturers(8, 0, true, 1, Configuration::get('NUMBER_TAB_MANU'));
		$new_prod_manu = array();
		foreach ($manu_f as $manu_f_item)
		{
			$id_manu = $manu_f_item['id_manufacturer'];
			$prod_manu = Manufacturer::getProducts($id_manu, 1, 0, Configuration::get('TOTAL_NUMBER_PRODUCT'));
			$manu_f_item['product_list'] = $prod_manu;
			$new_prod_manu[] = $manu_f_item;
		}
		
		if (!empty($manu_f))
		{
			return [
				'manu_f' => $new_prod_manu,
				'ps_manu_img_dir' => $this->context->link->getBaseLink().'img/m/',
				'prod_manu' => $prod_manu,
				'used_slider' => Configuration::get('USED_SLIDER'),
				'total_number_product' => Configuration::get('TOTAL_NUMBER_PRODUCT'),
				'number_line_show' => Configuration::get('NUMBER_LINE_SHOW')
			];
		}
	}
	
	public function hookDisplayHeader()
	{
		if ($this->context->controller->php_self == 'index')
			$this->context->controller->addCSS($this->_path.'views/css/wtproductmanu.css', 'all');
	}
	
	public function renderWidget($hookName = null, array $configuration = [])
    {
		if ($this->context->controller->php_self == 'index')
		{
			$this->smarty->assign($this->getWidgetVariables($hookName, $configuration));

			return $this->fetch('module:'.$this->name.'/views/templates/hook/'.$this->name.'.tpl');
		}
        
    }
	
	public function hookActionShopDataDuplication($params)
	{
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'wtproductmanu_shop (`id_wtproductmanu`, `id_shop`, `position`, `active`)
		SELECT id_wtproductmanu, '.(int)$params['new_id_shop'].', position, active
		FROM '._DB_PREFIX_.'wtproductmanu_shop
		WHERE id_shop = '.(int)$params['old_id_shop']);
		
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'wtproductmanu_lang (`id_wtproductmanu`, `id_lang`, `id_shop`, `title`, `link`, `text`)
		SELECT id_wtproductmanu,id_lang, '.(int)$params['new_id_shop'].', title, link, text 
		FROM '._DB_PREFIX_.'wtproductmanu_lang
		WHERE id_shop = '.(int)$params['old_id_shop']);
	}
	public function hookActionObjectLanguageAddAfter($params)
	{
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'wtproductmanu_lang (`id_wtproductmanu`, `id_lang`, `id_shop`, `title`, `link`, `text`)
		SELECT id_wtproductmanu, '.(int)$params['object']->id.', id_shop, title, link, text 
		FROM '._DB_PREFIX_.'wtproductmanu_lang
		WHERE id_lang = '.(int)Configuration::get('PS_LANG_DEFAULT'));
	}
}