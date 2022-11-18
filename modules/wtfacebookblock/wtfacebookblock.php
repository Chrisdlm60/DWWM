<?php
/**
* 2007-2016 PrestaShop
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

if (!defined('_PS_VERSION_'))
	exit;

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class WTFacebookBlock extends Module implements WidgetInterface
{
public function __construct()
{
		$this->name = 'wtfacebookblock';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Waterthemes';
		$this->bootstrap = true;
		parent::__construct();
		$this->displayName = $this->getTranslator()->trans('WT Facebook block', array(), 'Modules.WTFacebookBlock.Admin');
		$this->description = $this->getTranslator()->trans('Displays a block for subscribing to your Facebook page.', array(), 'Modules.WTFacebookBlock.Admin');
		$this->ps_versions_compliancy = array('min' => '1.7.0.0', 'max' => _PS_VERSION_);
}

public function install()
{
		return parent::install() &&
			Configuration::updateValue('facebook_url', 'https://www.facebook.com/prestashop') &&
			$this->registerHook('displayFooter') &&
			$this->registerHook('displayHeader');
}

public function uninstall()
{
		// Delete configuration
		return Configuration::deleteByName('facebook_url') && parent::uninstall();
}

public function getContent()
{
	$html = '';
		// If we try to update the settings
		if (Tools::isSubmit('submitModule'))
		{
			Configuration::updateValue('facebook_url', Tools::getValue('facebook_url'));
			$html .= $this->displayConfirmation($this->l('Configuration updated'));
			Tools::redirectAdmin('index.php?tab=AdminModules&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}

		$html .= $this->renderForm();
		$facebookurl = Configuration::get('facebook_url');
		if(!strstr($facebookurl, "facebook.com")) $facebookurl="https://www.facebook.com/".$facebookurl;
		$this->context->smarty->assign('facebookurl', $facebookurl);
		$this->context->smarty->assign('facebook_js_url', $this->_path.'blockfacebook.js');
		$this->context->smarty->assign('facebook_css_url', $this->_path.'css/wtfacebookblock.css');
		$html .= $this->context->smarty->fetch($this->local_path.'views/admin/_configure/preview.tpl');
		$html .= $this->_displayAdvertising();
		return $html;
}

public function renderWidget($hookName = null, array $configuration = [])
    {
        
		$this->smarty->assign($this->getWidgetVariables($hookName, $configuration));

        return $this->fetch('module:'.$this->name.'/views/templates/hook/'.$this->name.'.tpl');
        
    }
	
	public function getWidgetVariables($hookName = null, array $configuration = [])
    {
		$facebookurl = Configuration::get('facebook_url');
        if (!strstr($facebookurl, 'facebook.com'))
				$facebookurl = 'https://www.facebook.com/'.$facebookurl;
			
        return [
            'facebookurl' => $facebookurl,
        ];
    }


public function hookHeader()
{
			$this->page_name = Dispatcher::getInstance()->getController();
			$this->context->controller->addCss(($this->_path).'css/tvfacebookblock.css');
			$this->context->controller->addJS(($this->_path).'js/blockfacebook.js');
}

public function _displayAdvertising()
{
		$html .= '
		<br/>
		<fieldset>
			<legend>'.$this->l('More Themes & Modules').'</legend>	
			<iframe src="https://waterthemes.com/advertising/prestashop_advertising.html" width="100%" height="420px;" border="0" style="border:none;"></iframe>
			</fieldset>';
		return $html;
}

public function renderForm()
{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Settings'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'text',
						'label' => $this->l('Facebook link (full URL is required)'),
						'name' => 'facebook_url',
					),
				),
				'submit' => array(
					'title' => $this->l('Save')
				)
			),
		);

		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table =  $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();

		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitModule';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);
		return $helper->generateForm(array($fields_form));
}

public function getConfigFieldsValues()
{
	return array(
			'facebook_url' => Tools::getValue('facebook_url', Configuration::get('facebook_url')),
	);
}
}
