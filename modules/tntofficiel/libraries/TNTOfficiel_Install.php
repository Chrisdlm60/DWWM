<?php
/**
 * TNT OFFICIAL MODULE FOR PRESTASHOP.
 *
 * @author    GFI Informatique <www.gfi.world>
 * @copyright 2016-2020 GFI Informatique, 2016-2020 TNT
 * @license   https://opensource.org/licenses/MIT MIT License
 */

require_once _PS_MODULE_DIR_.'tntofficiel/libraries/TNTOfficiel_ClassLoader.php';

/**
 * Class TNTOfficiel_Install
 * Used in upgrade, do not rename or remove.
 */
class TNTOfficiel_Install
{
    /** @var array */
    public static $arrHookList = array(
        // Header
        'displayBackOfficeHeader',
        'actionAdminControllerSetMedia',
        'displayHeader',

        // Front-Office display carrier.
        'displayBeforeCarrier',
        'displayAfterCarrier',
        'displayCarrierExtraContent',
        'actionValidateStepComplete',
        // Front-Office order detail.
        'displayOrderDetail',

        // Order created.
        'actionValidateOrder',
        // Order status before changed.
        'actionOrderStatusUpdate',
        'actionOrderStatusPostUpdate',

        // Back-Office order detail.
        'displayAdminOrder',
        // Carrier updated.
        'actionCarrierUpdate',

        // Add variables for email.
        'actionGetExtraMailTemplateVars'

        //actionAdminMetaControllerUpdate_optionsBefore
        //actionCarrierProcess
        //actionOrderDetail
        //actionValidateCustomerAddressForm
        //validateCustomerFormFields
    );

    /** @var array Configuration that is Updated on Install and Deleted on Uninstall. */
    // 'preserve' => true to prevent overwrite or delete during install/uninstall process. value is a default.
    // 'global' => true for global context only.
    public static $arrConfigUpdateDeleteList = array(
        // Latest release installed, then preserved until a newer version is installed.
        'TNTOFFICIEL_RELEASE' => array('value' => '', 'global' => true, 'preserve' => true),
    );


    /** @var array */
    public static $arrRemoveFileList = array(
        'libraries/TNTOfficiel_Parcel.php',
        'override/classes/order/OrderHistory.php',
        'override/classes/order/index.php',
        'override/classes/index.php',
    );

    /** @var array */
    public static $arrRemoveDirList = array(
        'override/classes/order/',
        'override/classes/',
    );

    /**
     * Prevent Construct.
     */
    final private function __construct()
    {
        trigger_error(sprintf('%s() %s is static.', __FUNCTION__, get_class($this)), E_USER_ERROR);
    }

    /**
     * Clear Smarty cache.
     *
     * @return bool
     */
    public static function clearCache()
    {
        TNTOfficiel_Logstack::log();

        // Clear Smarty cache.
        Tools::clearSmartyCache();
        // Clear XML cache ('/config/xml/').
        Tools::clearXMLCache();
        // Clear current theme cache (/themes/<THEME>/cache/').
        Media::clearCache();

        // Clear class index cache ('/cache/class_index.php'). PS 1.6.0.5+.
        if (defined('_DB_PREFIX_') && Configuration::get('PS_DISABLE_OVERRIDES')) {
            PrestaShopAutoload::getInstance()->_include_override_path = false;
        }
        PrestaShopAutoload::getInstance()->generateIndex();

        return true;
    }

    /**
     * Remove unused files and unused dirs.
     *
     * @return bool
     */
    public static function uninstallDeprecatedFiles()
    {
        return TNTOfficiel_Tools::removeFiles(
            _PS_MODULE_DIR_.TNTOfficiel::MODULE_NAME.DIRECTORY_SEPARATOR,
            TNTOfficiel_Install::$arrRemoveFileList,
            TNTOfficiel_Install::$arrRemoveDirList
        );
    }

    /**
     * Update settings fields.
     *
     * @return bool
     */
    public static function updateSettings()
    {
        TNTOfficiel_Logstack::log();

        $boolUpdated = true;
        $strLogMessage = sprintf('%s::%s', __CLASS__, __FUNCTION__);

        foreach (TNTOfficiel_Install::$arrConfigUpdateDeleteList as $strCfgName => $arrConfig) {
            // Must be preserved ?
            $boolPreserve = array_key_exists('preserve', $arrConfig) && $arrConfig['preserve'] === true;
            $boolExist = Configuration::get($strCfgName) !== false;
            // if no need to preserve or not exist.
            if (!$boolPreserve || !$boolExist) {
                // Is global ?
                $boolGlobal = array_key_exists('global', $arrConfig) && $arrConfig['global'] === true;
                // Get value.
                $mxdValue = array_key_exists('value', $arrConfig) ? $arrConfig['value'] : '';

                if ($boolGlobal) {
                    $boolUpdated = $boolUpdated && Configuration::updateGlobalValue($strCfgName, $mxdValue);
                } else {
                    $boolUpdated = $boolUpdated && Configuration::updateValue($strCfgName, $mxdValue);
                }
            }
        }

        TNTOfficiel_Logger::logInstall($strLogMessage, $boolUpdated);

        return $boolUpdated;
    }

    /**
     * Delete settings fields.
     *
     * @return bool
     */
    public static function deleteSettings()
    {
        TNTOfficiel_Logstack::log();

        $boolDeleted = true;
        $strLogMessage = sprintf('%s::%s', __CLASS__, __FUNCTION__);

        foreach (TNTOfficiel_Install::$arrConfigUpdateDeleteList as $strCfgName => $arrConfig) {
            // Must be preserved ?
            $boolPreserve = array_key_exists('preserve', $arrConfig) && $arrConfig['preserve'] === true;
            if (!$boolPreserve) {
                $boolDeleted = $boolDeleted && Configuration::deleteByName($strCfgName);
            }
        }

        TNTOfficiel_Logger::logInstall($strLogMessage, $boolDeleted);

        return $boolDeleted;
    }

    /**
     * Creates the tables needed by the module.
     *
     * @return bool
     */
    public static function createTables()
    {
        TNTOfficiel_Logstack::log();

        $strLogMessage = sprintf('%s::%s', __CLASS__, __FUNCTION__);

        if (!TNTOfficielCache::createTables()
        || !TNTOfficielAccount::createTables()
        || !TNTOfficielCarrier::createTables()
        || !TNTOfficielCart::createTables()
        || !TNTOfficielOrder::createTables()
        || !TNTOfficielReceiver::createTables()
        || !TNTOfficielParcel::createTables()
        || !TNTOfficielLabel::createTables()
        || !TNTOfficielPickup::createTables()
        ) {
            TNTOfficiel_Logger::logInstall($strLogMessage, false);

            return false;
        }

        TNTOfficiel_Logger::logInstall($strLogMessage);

        return true;
    }

    /**
     * Creates the Tab.
     *
     * @return bool
     */
    public static function createTab()
    {
        TNTOfficiel_Logstack::log();

        $strLogMessage = sprintf('%s::%s', __CLASS__, __FUNCTION__);

        $arrLangList = Language::getLanguages(true);

        // Set displayed Tab name for each existing language.
        $arrTabNameLang = array();
        if (is_array($arrLangList)) {
            foreach ($arrLangList as $arrLang) {
                $arrTabNameLang[(int)$arrLang['id_lang']] = TNTOfficiel::CARRIER_NAME;
            }
        }

        // Creates the TNT Orders Tab.
        $objAdminTNTOrdersTab = new Tab();
        $objAdminTNTOrdersTab->active = 1;
        $objAdminTNTOrdersTab->class_name = 'AdminTNTOrders';
        $objAdminTNTOrdersTab->name = $arrTabNameLang;
        $objAdminTNTOrdersTab->module = TNTOfficiel::MODULE_NAME;
        $objAdminTNTOrdersTab->id_parent = Tab::getIdFromClassName('AdminParentOrders');
        $boolResultAdminTNTOrdersTab = (bool)$objAdminTNTOrdersTab->add();

        TNTOfficiel_Logger::logInstall($strLogMessage.' : AdminTNTOrders', $boolResultAdminTNTOrdersTab);

        // Creates the TNT setting Carrier Tab.
        $objAdminTNTSettingTab = new Tab();
        $objAdminTNTSettingTab->active = 1;
        $objAdminTNTSettingTab->class_name = 'AdminTNTSetting';
        $objAdminTNTSettingTab->name = $arrTabNameLang;
        $objAdminTNTSettingTab->module = TNTOfficiel::MODULE_NAME;
        $objAdminTNTSettingTab->id_parent = Tab::getIdFromClassName('AdminParentShipping');
        $boolResultAdminTNTSettingTab = (bool)$objAdminTNTSettingTab->add();

        TNTOfficiel_Logger::logInstall($strLogMessage.' : AdminTNTSetting', $boolResultAdminTNTSettingTab);

        // Create the Account setting child Tab (AdminAccountSettingController).
        $arrAccountSettingTabNameLang = array();
        if (is_array($arrLangList)) {
            foreach ($arrLangList as $arrLang) {
                $arrAccountSettingTabNameLang[(int)$arrLang['id_lang']] = 'Paramétrage du compte marchand';
            }
        }
        $objAdminTNTAccountSettingTab = new Tab();
        $objAdminTNTAccountSettingTab->active = 1;
        $objAdminTNTAccountSettingTab->class_name = 'AdminAccountSetting';
        $objAdminTNTAccountSettingTab->name = $arrAccountSettingTabNameLang;
        $objAdminTNTAccountSettingTab->module = TNTOfficiel::MODULE_NAME;
        $objAdminTNTAccountSettingTab->id_parent = Tab::getIdFromClassName('AdminTNTSetting');
        $boolResultAdminAccountSettingTab = (bool)$objAdminTNTAccountSettingTab->add();

        TNTOfficiel_Logger::logInstall($strLogMessage.' : AdminAccountSetting', $boolResultAdminAccountSettingTab);

        // Create the Carrier setting child Tab (AdminCarrierSettingController).
        $arrCarrierSettingTabNameLang = array();
        if (is_array($arrLangList)) {
            foreach ($arrLangList as $arrLang) {
                $arrCarrierSettingTabNameLang[(int)$arrLang['id_lang']] = 'Paramétrage des services de livraison TNT';
            }
        }
        $objAdminTNTCarrierSettingTab = new Tab();
        $objAdminTNTCarrierSettingTab->active = 1;
        $objAdminTNTCarrierSettingTab->class_name = 'AdminCarrierSetting';
        $objAdminTNTCarrierSettingTab->name = $arrCarrierSettingTabNameLang;
        $objAdminTNTCarrierSettingTab->module = TNTOfficiel::MODULE_NAME;
        $objAdminTNTCarrierSettingTab->id_parent = Tab::getIdFromClassName('AdminTNTSetting');
        $boolResultAdminCarrierSettingTab = (bool)$objAdminTNTCarrierSettingTab->add();

        TNTOfficiel_Logger::logInstall($strLogMessage.' : AdminCarrierSetting', $boolResultAdminCarrierSettingTab);

        return ($boolResultAdminTNTOrdersTab
            && $boolResultAdminTNTSettingTab
            && $boolResultAdminAccountSettingTab
            && $boolResultAdminCarrierSettingTab
        );
    }

    /**
     * Delete the Tab.
     *
     * @return bool
     */
    public static function deleteTab()
    {
        TNTOfficiel_Logstack::log();

        $strLogMessage = sprintf('%s::%s', __CLASS__, __FUNCTION__);

        $objTabsPSCollection = Tab::getCollectionFromModule(TNTOfficiel::MODULE_NAME)->getAll();
        foreach ($objTabsPSCollection as $tab) {
            if (!$tab->delete()) {
                TNTOfficiel_Logger::logInstall($strLogMessage, false);

                return false;
            }
        }

        TNTOfficiel_Logger::logInstall($strLogMessage);

        return true;
    }

}
