<?php
/**
 * 2007-2017 PrestaShop.
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
 *  @copyright 2007-2017 PrestaShop SA
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

class ClassSlideshow extends ObjectModel
{
    public $id;
    public $id_slideshow;
    public $id_shop;
    public $active = 1;
    public $position;
    public $image;
    public $transition;
    public $title;
    public $link;
    public $caption;
    public $related_products;

    public static $definition = array(
        'table' => 'wtslideshow',
        'primary' => 'id_slideshow',
        'multilang' => true,
        'multilang_shop' => false,
        'fields' => array(
            'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'position' => array('type' => self::TYPE_INT),
            'image' => array('type' => self::TYPE_STRING, 'size' => 100, 'required' => true, 'validate' => 'isCleanHtml'),
            'transition' => array('type' => self::TYPE_STRING, 'size' => 50, 'validate' => 'isCatalogName'),
            'title' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 254),
            'link' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isUrlOrEmpty', 'size' => 254),
            'caption' => array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'),
        ),
    );

    public function __construct($id_slideshow = null, $id_lang = null)
    {
        parent::__construct($id_slideshow, $id_lang);

        if (!$this->id_shop) {
            $this->id_shop = Context::getContext()->shop->id;
        }

        if (!$this->position) {
            $this->position = 1 + $this->getMaxPosition();
        }
    }

    public function save($null_values = false, $autodate = true)
    {
        
        return (int) $this->id > 0 ? $this->update($null_values) : $this->add($autodate, $null_values);
    }

    public static function getList($id_lang = null, $active = true)
    {
        $id_lang = is_null($id_lang) ? Context::getContext()->language->id : (int) $id_lang;
        $id_shop = Context::getContext()->shop->id;

        $query = 'SELECT *
            FROM `'._DB_PREFIX_.'wtslideshow` s
            LEFT JOIN `'._DB_PREFIX_.'wtslideshow_lang` sl ON s.`id_slideshow` = sl.`id_slideshow`
            WHERE s.`id_shop` = '.(int) $id_shop.'
            AND `id_lang` = '.(int) $id_lang.'
            '.($active ? 'AND `active` = 1' : '').'
            GROUP BY s.`id_slideshow`
            ORDER BY s.`position` ASC';

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);

        return $result;
    }

    public static function getMaxPosition()
    {
        $id_shop = Context::getContext()->shop->id;
        $query = 'SELECT MAX(s.`position`)
            FROM `'._DB_PREFIX_.'wtslideshow` s
            WHERE s.`id_shop` = '.(int) $id_shop;

        return (int) Db::getInstance()->getValue($query);
    }

    public static function updatePosition($id_slideshow, $position)
    {
        $query = 'UPDATE `'._DB_PREFIX_.'wtslideshow`
			SET `position` = '.(int) $position.'
			WHERE `id_slideshow` = '.(int) $id_slideshow;

        Db::getInstance()->execute($query);
    }

}
