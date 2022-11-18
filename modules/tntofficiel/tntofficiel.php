<?php
/**
 * TNT OFFICIAL MODULE FOR PRESTASHOP.
 *
 * @author    GFI Informatique <www.gfi.world>
 * @copyright 2016-2020 GFI Informatique, 2016-2020 TNT
 * @license   https://opensource.org/licenses/MIT MIT License
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once _PS_MODULE_DIR_.'tntofficiel/libraries/TNTOfficiel_ClassLoader.php';


/**
 * Class TNTOfficiel.
 */
class TNTOfficiel extends CarrierModule
{
    // Name identifier.
    const MODULE_NAME = 'tntofficiel';
    // Carrier name.
    const CARRIER_NAME = 'TNT';
    // Release stamp : (((+new Date('YYY-MM-DD HH:MM'))/1000)|0).toString(36)
    const MODULE_RELEASE = 'q0y640';

    // Status that trigger shipment creation (eg: PS_OS_PREPARATION). null to disabled.
    const ORDERSTATE_SAVESHIPMENT = 'PS_OS_SHIPPING';
    // Status to apply when all parcels is delivered (eg: PS_OS_DELIVERED). null to disabled.
    const ORDERSTATE_ALLDELIVERED = 'PS_OS_DELIVERED';

    // Path to the module Log.
    const PATH_LOG = 'log/';

    // Google Map API Version (google.maps.version).
    const GMAP_API_VER = '3.exp';

    /**
     * Request timeout.
     */

    // Timeout for connection to the server.
    const REQUEST_CONNECTTIMEOUT = 8;
    // Timeout global (expiration).
    const REQUEST_TIMEOUT = 32;

    /**
     * Reserved by Cart Model.
     * @var int|null Carrier ID set when retrieving shipping cost from module.
     * see getOrderShippingCost()
     */
    public $id_carrier = null;


    /**
     * TNTOfficiel constructor.
     */
    public function __construct()
    {
        TNTOfficiel_Logstack::log();

        // Module is compliant with bootstrap. PS1.6+
        $this->bootstrap = true;

        // Version.
        $this->version = '1.0.7';
        // Prestashop supported version. PS1.7.0.5+
        $this->ps_versions_compliancy = array('min' => '1.7.0.5', 'max' => '1.7.99.99');
        // Prestashop modules dependencies.
        $this->dependencies = array();

        // Name.
        $this->name = 'tntofficiel'; // TNTOfficiel::MODULE_NAME;
        // Displayed Name.
        $this->displayName = $this->l('TNT'); // TNTOfficiel::CARRIER_NAME;
        // Description.
        $this->description = $this->l('Offer your customers, different delivery methods with TNT');

        // Type.
        $this->tab = 'shipping_logistics';

        // Confirmation message before uninstall.
        $this->confirmUninstall = $this->l('Are you sure you want to delete this module?');

        // Author.
        $this->author = 'Gfi Informatique';

        // Module key provided by addons.prestashop.com.
        $this->module_key = '1cf0bbdc13a4d4f319266cfe0bfac777';

        // Is this instance required on module when it is displayed in the module list.
        // This can be useful if the module has to perform checks on the PrestaShop configuration.
        $this->need_instance = 0;

        // Module Constructor.
        parent::__construct();

        /*
         * Display error or warning message in the module list.
         */

        if (!extension_loaded('curl')) {
            $this->displayAdminError(
                sprintf($this->l('You have to enable the PHP %s extension on your server.'), 'cURL'),
                null,
                array('AdminAccountSetting')
            );
        }
        if (!extension_loaded('soap')) {
            $this->displayAdminError(
                sprintf($this->l('You have to enable the PHP %s extension on your server.'), 'SOAP'),
                null,
                array('AdminAccountSetting')
            );
        }
        if (!extension_loaded('zip')) {
            $this->displayAdminWarning(
                sprintf($this->l('You have to enable the PHP %s extension on your server.'), 'Zip'),
                null,
                array('AdminAccountSetting')
            );
        }

        // Check tntofficiel release version.
        if (TNTOfficiel::isDownGraded()) {
            $this->displayAdminError(
                $this->l('Update Required : Previously installed version is greater than the current one.'),
                null,
                array('AdminAccountSetting')
            );
        }

        // If module not ready.
        if (!TNTOfficiel::isContextReady()) {
            // Do nothing.
            return;
        }

        $objTNTContextAccountModel = TNTOfficielAccount::loadContextShop();
        // If no account available for this context.
        if ($objTNTContextAccountModel === null) {
            // Do nothing.
            return;
        }

        // Check each days credential state for auto invalidation (e.g: password changed).
        // If invalidated, module is disabled and carrier are not displayed on front-office.
        if ($objTNTContextAccountModel->getAuthValidatedDateTime() !== null) {
            $objTNTContextAccountModel->updateAuthValidation(60 * 60 * 24);
        }

        // Apply default carriers values if required.
        TNTOfficielCarrier::forceAllCarrierDefaultValues();
    }

    /**
     * Get a message for admin controller.
     *
     * @param string $strArgMessage
     * @param string $strArgURL
     * @param array $arrArgControllers
     *
     * todo : add shop/group context filter
     *
     * @return bool
     */
    public function getAdminMessage($strArgMessage, $strArgURL = null, $arrArgControllers = array())
    {
        $objContext = $this->context;

        if (!property_exists($objContext, 'controller')) {
            return false;
        }

        // Controller.
        $objController = $objContext->controller;

        // If not an AdminController or is an AJAX request.
        if (!($objController instanceof AdminController) || $objController->ajax) {
            return false;
        }

        // Controller Name.
        $strControllerName = preg_replace('/Controller$/ui', '', get_class($objController));
        // If controller filter list exist but not in list.
        if (!is_array($arrArgControllers)
            || (count($arrArgControllers) > 0 && !in_array($strControllerName, $arrArgControllers))
        ) {
            return false;
        }

        if (!is_string($strArgMessage) || Tools::strlen($strArgMessage) === 0) {
            return false;
        }

        //
        //if ($strControllerName === 'AdminModules' && Tools::getValue('configure') !== TNTOfficiel::MODULE_NAME) {
        //    return false;
        //}

        if (is_string($strArgURL)) {
            $strArgMessage = '<a href="'.$strArgURL.'">'.$strArgMessage.'</a>';
        }

        $strArgMessage = TNTOfficiel::CARRIER_NAME.' : '.$strArgMessage;

        return $strArgMessage;
    }

    /**
     * Display a warning for admin controller.
     *
     * @param string $strArgMessage
     * @param string $strArgURL
     * @param array $arrArgControllers
     *
     * @return bool
     */
    public function displayAdminWarning($strArgMessage, $strArgURL = null, $arrArgControllers = array())
    {
        $strArgMessage = $this->getAdminMessage($strArgMessage, $strArgURL, $arrArgControllers);

        if (is_string($strArgMessage)) {
            $this->context->controller->warnings[] = $strArgMessage;
        }

        return $strArgMessage;
    }

    /**
     * Display a error for admin controller.
     *
     * @param string $strArgMessage
     * @param string $strArgURL
     * @param array $arrArgControllers
     *
     * @return bool
     */
    public function displayAdminError($strArgMessage, $strArgURL = null, $arrArgControllers = array())
    {
        $strArgMessage = $this->getAdminMessage($strArgMessage, $strArgURL, $arrArgControllers);

        if (is_string($strArgMessage)) {
            $this->context->controller->errors[] = $strArgMessage;
        }

        return $strArgMessage;
    }

    /**
     * Module install.
     *
     * @return bool
     */
    public function install()
    {
        TNTOfficiel_Logstack::log();

        // If MultiShop and more than 1 Shop.
        if (Shop::isFeatureActive()) {
            // Define Shop context to all Shops.
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        TNTOfficiel_Logger::logInstall(sprintf(
            '____ %s (%s v%s) : install init. ____',
            TNTOfficiel::CARRIER_NAME,
            TNTOfficiel::MODULE_NAME,
            $this->version
        ));

        // Check tntofficiel release version.
        if (TNTOfficiel::isDownGraded()) {
            TNTOfficiel_Logger::logInstall('Downgrade not allowed', false);
            $this->_errors[] =
                $this->l('Downgrade not allowed : Previously installed version is greater than the current one.');

            // Do not install.
            return false;
        }

        // Check compatibility.
        if (!extension_loaded('curl')) {
            TNTOfficiel_Logger::logInstall('PHP cURL extension is required', false);
            $this->_errors[] = sprintf($this->l('You have to enable the PHP %s extension on your server.'), 'cURL');

            return false;
        }
        if (!extension_loaded('soap')) {
            TNTOfficiel_Logger::logInstall('PHP SOAP extension is required', false);
            $this->_errors[] = sprintf($this->l('You have to enable the PHP %s extension on your server.'), 'SOAP');

            return false;
        }
        if (!extension_loaded('zip')) {
            TNTOfficiel_Logger::logInstall('PHP Zip extension is required', false);
            $this->_errors[] = sprintf($this->l('You have to enable the PHP %s extension on your server.'), 'Zip');

            return false;
        }

        // Store release.
        Configuration::updateGlobalValue('TNTOFFICIEL_RELEASE', TNTOfficiel::MODULE_RELEASE);

        // Remove deprecated files.
        TNTOfficiel_Install::uninstallDeprecatedFiles();

        // Prestashop install.
        if (!parent::install()) {
            TNTOfficiel_Logger::logInstall('Module::install', false);
            $this->_errors[] = Tools::displayError('Impossible d\'installer Module::install().');

            return false;
        }
        TNTOfficiel_Logger::logInstall('Module::install');

        // Update settings.
        if (!TNTOfficiel_Install::updateSettings()) {
            $this->_errors[] = Tools::displayError('Impossible de définir la configuration.');

            return false;
        }

        // Register hooks.
        foreach (TNTOfficiel_Install::$arrHookList as $strHookName) {
            if (!$this->registerHook($strHookName)) {
                TNTOfficiel_Logger::logInstall('Module::registerHook ('.$strHookName.')', false);
                $this->_errors[] = Tools::displayError(sprintf('Impossible d\'inscrire le hook "%s".', $strHookName));

                return false;
            }
        }
        TNTOfficiel_Logger::logInstall('Module::registerHook');

        // Create the TNT tab.
        if (!TNTOfficiel_Install::createTab()) {
            $this->_errors[] = Tools::displayError('Impossible d\'ajouter l\'onglet du menu.');

            return false;
        }

        // Create the tables.
        if (!TNTOfficiel_Install::createTables()) {
            $this->_errors[] = Tools::displayError('Impossible de créer les tables en base de données.');

            return false;
        }

        // Clear cache.
        TNTOfficiel_Install::clearCache();

        TNTOfficiel_Logger::logInstall(sprintf(
            '____ %s (%s v%s) : install complete. ____',
            TNTOfficiel::CARRIER_NAME,
            TNTOfficiel::MODULE_NAME,
            $this->version
        ));

        return true;
    }

    /**
     * Module uninstall.
     *
     * @return bool
     */
    public function uninstall()
    {
        TNTOfficiel_Logstack::log();

        TNTOfficiel_Logger::logInstall(sprintf(
            '____ %s (%s v%s) : uninstall init. ____',
            TNTOfficiel::CARRIER_NAME,
            TNTOfficiel::MODULE_NAME,
            $this->version
        ));

        // Uninstall class or controllers override.
        // Already done by parent::uninstall, but used to display error message.
        if (!$this->uninstallOverrides()) {
            TNTOfficiel_Logger::logInstall('Module::uninstallOverrides', false);
            $this->_errors[] = Tools::displayError('Impossible de supprimer la surcharge de classe.');

            return false;
        }
        TNTOfficiel_Logger::logInstall('Module::uninstallOverrides');

        // Unregister Hooks.
        foreach (TNTOfficiel_Install::$arrHookList as $strHookName) {
            if (!$this->unregisterHook($strHookName)) {
                TNTOfficiel_Logger::logInstall('Module::unregisterHook ('.$strHookName.')', false);
                $this->_errors[] = Tools::displayError(sprintf('Impossible de supprimer le hook "%s".', $strHookName));

                // No return to allow re-initialisation.
                //return false;
            }
        }
        TNTOfficiel_Logger::logInstall('Module::unregisterHook');

        // Delete Tab.
        if (!TNTOfficiel_Install::deleteTab()) {
            $this->_errors[] = Tools::displayError('Impossible de supprimer l\'onglet du menu.');

            return false;
        }

        // Delete Settings.
        if (!TNTOfficiel_Install::deleteSettings()) {
            $this->_errors[] = Tools::displayError('Impossible de supprimer la configuration.');

            return false;
        }

        // Prestashop Uninstall.
        if (!parent::uninstall()) {
            TNTOfficiel_Logger::logInstall('Module::uninstall', false);
            $this->_errors[] = Tools::displayError('Impossible de désinstaller Parent::uninstall().');

            return false;
        }
        TNTOfficiel_Logger::logInstall('Module::uninstall');

        TNTOfficiel_Logger::logInstall(sprintf(
            '____ %s (%s v%s) : uninstall complete. ____',
            TNTOfficiel::CARRIER_NAME,
            TNTOfficiel::MODULE_NAME,
            $this->version
        ));

        // TODO: check default carrier is not TNT.
        // Configuration::get('PS_CARRIER_DEFAULT')

        return true;
    }

    /**
     * Module configuration page content.
     * Large form is displayed in a custom admin controller.
     *
     * @return string HTML content.
     */
    public function getContent()
    {
        TNTOfficiel_Logstack::log();

        Tools::redirectAdmin($this->context->link->getAdminLink('AdminAccountSetting'));

        return '';
    }

    /**
     * Is current release older than the previously installed.
     */
    public static function isDownGraded()
    {
        // Check tntofficiel release version.
        $strRLPrevious = (string)Configuration::get('TNTOFFICIEL_RELEASE');
        $intTSPrevious = (int)base_convert($strRLPrevious, 36, 10);
        $intTSCurrent = base_convert(TNTOfficiel::MODULE_RELEASE, 36, 10);

        return ($intTSCurrent < $intTSPrevious);
    }

    /**
     * Is module ready for current context.
     */
    public static function isContextReady()
    {
        TNTOfficiel_Logstack::log();

        $objContext = Context::getContext();
        if (property_exists($objContext, 'controller')) {
            // Controller.
            $objController = $objContext->controller;
            if ($objController !== null) {
                // Get Controller Name.
                $strCurrentControllerName = Tools::strtolower(get_class($objController));

                switch ($strCurrentControllerName) {
                    // Prevent extra processing (ex: .map file).
                    case 'pagenotfoundcontroller':
                    case 'adminnotfoundcontroller':
                        return false;
                        break;
                    default:
                        break;
                }
            }
        }

        // If module not installed (ps_module:id_module) $this->id > 0
        // or module not activated (ps_module:active) $this->active ps_module_shop
        // or module is downgraded.
        if (!Module::isInstalled(TNTOfficiel::MODULE_NAME)
            || !Module::isEnabled(TNTOfficiel::MODULE_NAME)
            || TNTOfficiel::isDownGraded()
        ) {
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getCommonVariable()
    {
        TNTOfficiel_Logstack::log();

        $objContext = $this->context;
        $objLink = $objContext->link;
        $objShop = $objContext->shop;

        // Controller.
        $objController = $objContext->controller;
        // Get Controller Name.
        $strCurrentControllerName = get_class($objController);

        $objTNTContextAccountModel = TNTOfficielAccount::loadContextShop();

        $boolContextAuth = false;
        $strAPIGoogleMapKey = '';
        if ($objTNTContextAccountModel !== null) {
            $boolContextAuth = $objTNTContextAccountModel->getAuthValidatedDateTime() !== null;
            $strAPIGoogleMapKey = $objTNTContextAccountModel->api_google_map_key;
        }

        $arrCarrierList = array();
        $arrObjTNTCarrierModelList = TNTOfficielCarrier::getContextCarrierModelList();
        foreach ($arrObjTNTCarrierModelList as $intTNTCarrierID => $objTNTCarrierModel) {
            $arrCarrierList[$intTNTCarrierID] = array(
                'account_type' => $objTNTCarrierModel->account_type,
                'carrier_type' => $objTNTCarrierModel->carrier_type
            );
        }

        if (Configuration::get('PS_RESTRICT_DELIVERED_COUNTRIES')) {
            $arrCountryList = Carrier::getDeliveredCountries($this->context->language->id, true, true);
        } else {
            $arrCountryList = Country::getCountries($this->context->language->id, true);
        }


        // Javascript config.
        $arrTNTOfficiel = array(
            'timestamp' => microtime(true) * 1000,
            'module' => array(
                'name' => TNTOfficiel::MODULE_NAME,
                'title' => TNTOfficiel::CARRIER_NAME,
                'version' => $this->version,
                'context' => $boolContextAuth,
                'ready' => TNTOfficiel::isContextReady()
            ),
            'config' => array(
                'google' => array(
                    'map' => array(
                        'url' => 'https://maps.googleapis.com/maps/api/js',
                        'data' => array(
                            'v' => TNTOfficiel::GMAP_API_VER,
                            'key' => $strAPIGoogleMapKey
                        ),
                        'default' => array(
                            "lat"  => 46.827742,
                            "lng"  => 2.835644,
                            "zoom" => 6
                        )
                    )
                )
            ),
            'translate' => array(
                'validateDeliveryAddress' => htmlentities($this->l('Validate your delivery address')),
                'unknownPostalCode' => htmlentities($this->l('Unknown postal code')),
                'validatePostalCodeDeliveryAddress' => htmlentities(
                    $this->l('Please edit and validate the postal code of your delivery address.')
                ),
                'unrecognizedCity' => htmlentities($this->l('Unrecognized city')),
                'selectCityDeliveryAddress' => htmlentities(
                    $this->l('Please select the city from your delivery address.')
                ),
                'postalCode' => htmlentities($this->l('Postal code')),
                'city' => htmlentities($this->l('City')),
                'validate' => htmlentities($this->l('Validate')),
                'validateAdditionalCarrierInfo' => htmlentities(
                    $this->l('Please confirm the form with additional information for the carrier.')
                ),
                'errorDownloadingHRA' => htmlentities(
                    $this->l('Error while downloading the HRA list. Please contact the support.')
                ),
                'errorInvalidPhoneNumber' => htmlentities($this->l('The phone number must be 10 digits')),
                'errorInvalidEMail' => htmlentities($this->l('The email is invalid')),
                'errorNoDeliveryOptionSelected' => htmlentities($this->l('No delivery options selected.')),
                'errorNoDeliveryAddressSelected' => htmlentities($this->l('No delivery address selected.')),
                'errorNoDeliveryPointSelected' => htmlentities($this->l('No delivery point selected.')),
                'errorUnknow' => htmlentities($this->l('An error has occurred.')),
                'errorTechnical' => htmlentities($this->l('A technical error occurred.')),
                'errorConnection' => htmlentities($this->l('A connection error occurred.'))
            ),
            'link' => array(
                'controller' => Tools::strtolower($strCurrentControllerName),
                'front' => array(
                    'shop' => $objShop->getBaseURL(true),
                    'module' => array(
                        'boxDeliveryPoints' => $objLink->getModuleLink(
                            TNTOfficiel::MODULE_NAME,
                            'carrier',
                            array('action' => 'boxDeliveryPoints'),
                            true
                        ),
                        'saveProductInfo' => $objLink->getModuleLink(
                            TNTOfficiel::MODULE_NAME,
                            'carrier',
                            array('action' => 'saveProductInfo'),
                            true
                        ),
                        'checkPaymentReady' => $objLink->getModuleLink(
                            TNTOfficiel::MODULE_NAME,
                            'carrier',
                            array('action' => 'checkPaymentReady'),
                            true
                        ),
                        'storeReceiverInfo' => $objLink->getModuleLink(
                            TNTOfficiel::MODULE_NAME,
                            'address',
                            array('action' => 'storeReceiverInfo'),
                            true
                        ),
                        'getAddressCities' => $objLink->getModuleLink(
                            TNTOfficiel::MODULE_NAME,
                            'address',
                            array('action' => 'getCities'),
                            true
                        ),
                        'updateAddressDelivery' => $objLink->getModuleLink(
                            TNTOfficiel::MODULE_NAME,
                            'address',
                            array('action' => 'updateDeliveryAddress'),
                            true
                        ),
                        'checkAddressPostcodeCity' => $objLink->getModuleLink(
                            TNTOfficiel::MODULE_NAME,
                            'address',
                            array('action' => 'checkPostcodeCity'),
                            true
                        )
                    ),
                    'page' => array(
                        'order' => $objLink->getPageLink('order', true)
                    )
                ),
                'back' => null,
                'image' => _MODULE_DIR_.TNTOfficiel::MODULE_NAME.'/views/img/'
            ),
            'country' => array(
                'list' => $arrCountryList
            ),
            'carrier' => array(
                'list' => $arrCarrierList
            ),
            'cart' => array(
                'isCarrierListDisplay' => false
            ),
            'order' => array(
                'isTNT' => false
            )
        );

        return $arrTNTOfficiel;
    }

    /**
     * HOOK (AKA backOfficeHeader) called inside the head tag.
     * Ideal location for adding JavaScript and CSS files.
     * Hook called even if module is disabled !
     *
     * @param array $arrArgHookParams
     *
     * @return string HTML content in head tag.
     */
    public function hookDisplayBackOfficeHeader($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objContext = $this->context;

        $objHookCookie = $arrArgHookParams['cookie'];

        // Controller.
        $objController = $objContext->controller;
        // Get Controller Name.
        $strCurrentControllerName = Tools::strtolower(get_class($objController));

        $strAssetCSSPath = $this->getPathUri().'views/css/'.TNTOfficiel::MODULE_RELEASE.'/';
        //$strAssetJSPath = $this->getPathUri().'views/js/'.TNTOfficiel::MODULE_RELEASE.'/';

        // Global Admin CSS.
        $objController->addCSS($strAssetCSSPath.'Admin.css', 'all');

        $arrJSONTNTOfficiel = $this->getCommonVariable();
        $arrJSONTNTOfficiel['link']['back'] = array(
            'module' => array(
                'addParcelUrl' =>
                    $this->context->link->getAdminLink('AdminTNTOrders').'&action=addParcel&ajax=true',
                'removeParcelUrl' =>
                    $this->context->link->getAdminLink('AdminTNTOrders').'&action=removeParcel&ajax=true',
                'updateParcelUrl' =>
                    $this->context->link->getAdminLink('AdminTNTOrders').'&action=updateParcel&ajax=true',
                'updateOrderStateDeliveredParcels' =>
                    $this->context->link->getAdminLink('AdminTNTOrders').'&action=updateOrderStateDeliveredParcels&ajax=true',
                'checkShippingDateValidUrl' =>
                    $this->context->link->getAdminLink('AdminTNTOrders').'&action=checkShippingDateValid&ajax=true',
                'storeReceiverInfo' =>
                    $this->context->link->getAdminLink('AdminTNTOrders').'&action=storeReceiverInfo&ajax=true',
                'boxDeliveryPoints' =>
                    $this->context->link->getAdminLink('AdminTNTOrders').'&action=boxDeliveryPoints&ajax=true',
                'saveProductInfo' =>
                    $this->context->link->getAdminLink('AdminTNTOrders').'&action=saveProductInfo&ajax=true',
                'selectPostcodeCities' =>
                    $this->context->link->getAdminLink('AdminTNTOrders').'&action=selectPostcodeCities&ajax=true',
                'updateHRA' =>
                    $this->context->link->getAdminLink('AdminTNTOrders').'&action=updateHRA&ajax=true',
            )
        );

        $arrJSONTNTOfficiel['translate']['back'] = array(
            'updateSuccessfulStr' => htmlentities($this->l('Update successful')),
            'updateFailRetryStr' => htmlentities($this->l('Update not completed, please try again')),
            'deleteStr' => htmlentities($this->l('Delete')),
            'updateStr' => htmlentities($this->l('Update')),
            'atLeastOneParcelStr' => htmlentities($this->l('An order requires at least one parcel'))
        );

        if (!array_key_exists('alert', $arrJSONTNTOfficiel)
            || !is_array($arrJSONTNTOfficiel['alert'])
        ) {
            $arrJSONTNTOfficiel['alert'] = array(
                'error' => array(),
                'warning' => array(),
                'success' => array()
            );
        }

        // Cookie TNTOfficielError is used to display error message once after redirect.
        if (!empty($objHookCookie->TNTOfficielError)) {
            // Add error message to the admin page if exists.
            $arrJSONTNTOfficiel['alert']['error'][] = $objHookCookie->TNTOfficielError;
            // Delete cookie.
            $objHookCookie->TNTOfficielError = null;
        }
        if (!empty($objHookCookie->TNTOfficielWarning)) {
            // Add error message to the admin page if exists.
            $arrJSONTNTOfficiel['alert']['warning'][] = $objHookCookie->TNTOfficielWarning;
            // Delete cookie.
            $objHookCookie->TNTOfficielWarning = null;
        }
        if (!empty($objHookCookie->TNTOfficielSuccess)) {
            // Add error message to the admin page if exists.
            $arrJSONTNTOfficiel['alert']['success'][] = $objHookCookie->TNTOfficielSuccess;
            // Delete cookie.
            $objHookCookie->TNTOfficielSuccess = null;
        }

        // Add TNTOfficiel global variable with others in main inline script.
        Media::addJsDef(array('TNTOfficiel' => $arrJSONTNTOfficiel));

        TNTOfficiel_Logstack::dump(array(
            'method' => sprintf('%s::%s', __CLASS__, __FUNCTION__),
            'ajax' => $objController->ajax,
            'controller_type' => $objController->controller_type,
            'controllername' => $strCurrentControllerName,
            'controllerfilename' => Dispatcher::getInstance()->getController()
        ));

        // Display nothing.
        return '';
    }

    /**
     * HOOK called to include CSS or JS files in the Back-Office header.
     *
     * @param array $arrArgHookParams
     */
    public function hookActionAdminControllerSetMedia($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objContext = $this->context;

        // Controller.
        $objController = $objContext->controller;
        // Get Controller Name.
        $strCurrentControllerName = Tools::strtolower(get_class($objController));

        $strAssetCSSPath = $this->getPathUri().'views/css/'.TNTOfficiel::MODULE_RELEASE.'/';
        $strAssetJSPath = $this->getPathUri().'views/js/'.TNTOfficiel::MODULE_RELEASE.'/';

        $objController->addCSS($strAssetCSSPath.'global.css', 'all');
        $objController->addJS($strAssetJSPath.'global.js');

        switch ($strCurrentControllerName) {
            // Back-Office Carrier Wizard.
            case 'admincarrierwizardcontroller':
                $objController->addJS($strAssetJSPath.'AdminCarrierWizard.js');
                break;
            case 'adminaddressescontroller':
                // Form.css required for address-city-check, ExtraData
                $objController->addCSS($strAssetCSSPath.'form.css', 'all');

                // FancyBox required to display form (cp/ville check).
                $objController->addJqueryPlugin('fancybox');
                $objController->addJS($strAssetJSPath.'address.js');
                break;
            default:
                break;
        }

        TNTOfficiel_Logstack::dump(array(
            'method' => sprintf('%s::%s', __CLASS__, __FUNCTION__),
            'ajax' => $objController->ajax,
            'controller_type' => $objController->controller_type,
            'controllername' => $strCurrentControllerName,
            'controllerfilename' => Dispatcher::getInstance()->getController()
        ));
    }

    /**
     * HOOK (AKA Header) displayed in head tag on Front-Office.
     *
     * @param array $arrArgHookParams
     *
     * @return string
     */
    public function hookDisplayHeader($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        //$objHookCart = $arrArgHookParams['cart'];

        $objContext = $this->context;

        // Controller.
        $objController = $objContext->controller;
        // Get Controller Name.
        $strCurrentControllerName = Tools::strtolower(get_class($objController));

        // If module not ready.
        if (!TNTOfficiel::isContextReady()) {
            // Display nothing.
            return '';
        }

        $objTNTContextAccountModel = TNTOfficielAccount::loadContextShop();

        // If no account available for this context, or is not authenticated.
        if ($objTNTContextAccountModel === null
            || $objTNTContextAccountModel->getAuthValidatedDateTime() === null
        ) {
            // Display nothing.
            return '';
        }

        $arrJSONTNTOfficiel = $this->getCommonVariable();
        // Add TNTOfficiel global variable with others in main inline script.
        Media::addJsDef(array('TNTOfficiel' => $arrJSONTNTOfficiel));

        // Google Font: Open Sans.
        $objController->addCSS('https://fonts.googleapis.com/css?family=Open+Sans:400,700', 'all');

        $strAssetCSSPath = $this->getPathUri().'views/css/'.TNTOfficiel::MODULE_RELEASE.'/';
        $strAssetJSPath = $this->getPathUri().'views/js/'.TNTOfficiel::MODULE_RELEASE.'/';

        $objController->addCSS($strAssetCSSPath.'global.css', 'all');
        $objController->addJS($strAssetJSPath.'global.js');

        // Switch Controller Name.
        switch ($strCurrentControllerName) {
            // Front-Office Order History +guest.
            case 'orderdetailcontroller':
            case 'guesttrackingcontroller':
                // Form.css required for displayOrderDetail.tpl
                $objController->addCSS($strAssetCSSPath.'form.css', 'all');
                break;
            // Front-Office Address.
            case 'addresscontroller':
                // Front-Office Guest Checkout Address.
            case 'authcontroller':
                // Form.css required for address-city-check, ExtraData
                $objController->addCSS($strAssetCSSPath.'form.css', 'all');

                // FancyBox required to display form (cp/ville check).
                $objController->addJqueryPlugin('fancybox');
                $objController->addJS($strAssetJSPath.'address.js');
                break;

            // Front-Office Cart Process.
            case 'ordercontroller':
                // Form.css required for address-city-check, ExtraData
                $objController->addCSS($strAssetCSSPath.'form.css', 'all');
                //
                $objController->addCSS($strAssetCSSPath.'carrier.css', 'all');

                // Prestashop Validation system.
                $objController->addJS(_PS_JS_DIR_.'validate.js');

                // FancyBox required to display form (cp/ville check).
                $objController->addJqueryPlugin('fancybox');
                $objController->addJS($strAssetJSPath.'address.js');

                // TNTOfficiel_inflate() TNTOfficiel_deflate(), required by carrierDeliveryPoint.js
                $objController->addJS($strAssetJSPath.'lib/string.js');
                // jQuery.fn.nanoScroller, required by carrierDeliveryPoint.js
                $objController->addJS($strAssetJSPath.'lib/nanoscroller/jquery.nanoscroller.min.js');
                $objController->addCSS($strAssetJSPath.'lib/nanoscroller/nanoscroller.css', 'all');

                $objController->addJS($strAssetJSPath.'carrierDeliveryPoint.js');
                $objController->addJS($strAssetJSPath.'carrierAdditionalInfo.js');
                // TNTOfficiel_deliveryPointsBox, used in displayAjaxBoxDeliveryPoints.tpl
                $objController->addJS($strAssetJSPath.'carrier.js');
                break;

            default:
                break;
        }


        TNTOfficiel_Logstack::dump(array(
            'method' => sprintf('%s::%s', __CLASS__, __FUNCTION__),
            'ajax' => $objController->ajax,
            'controller_type' => $objController->controller_type,
            'controllername' => $strCurrentControllerName,
            'controllerfilename' => Dispatcher::getInstance()->getController(),
            'js' => $arrJSONTNTOfficiel
        ));

        // Display nothing.
        return '';
    }

    /**
     * HOOK (AKA beforeCarrier) displayed before the carrier list on Front-Office.
     *
     * @param array $arrArgHookParams
     *
     * @return string
     */
    public function hookDisplayBeforeCarrier($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objContext = $this->context;
        $objPSCart = $objContext->cart;

        // If module not ready.
        if (!TNTOfficiel::isContextReady()) {
            // Display nothing.
            return '';
        }

        // Force $objPSCart->id_carrier Update using autoselect if not set (without using cache).
        // $objPSCart->id_carrier maybe incorrectly set when autoselection determine current selected carrier.
        // e.g: only one core carrier available, input radio is always already preselected,
        // but not $objPSCart->id_carrier since setDeliveryOption() was not used (and no change is possible).
        $objPSCart->setDeliveryOption($objPSCart->getDeliveryOption(null, false, false));
        $objPSCart->save();

        $objTNTContextAccountModel = TNTOfficielAccount::loadContextShop();

        // If no account available for this context, or is not authenticated.
        if ($objTNTContextAccountModel === null
            || $objTNTContextAccountModel->getAuthValidatedDateTime() === null
        ) {
            // Display nothing.
            return '';
        }

        $boolCityPostCodeIsValid = true;

        $objPSAddressDelivery = TNTOfficielReceiver::getPSAddress($objPSCart->id_address_delivery);
        // If delivery address object is available.
        if ($objPSAddressDelivery !== null) {
            // Check the city/postcode.
            $arrResultCitiesGuide = $objTNTContextAccountModel->citiesGuide(
                Country::getIsoById($objPSAddressDelivery->id_country),
                trim($objPSAddressDelivery->postcode),
                trim($objPSAddressDelivery->city)
            );
            // Unsupported country or communication error is considered true to prevent
            // always invalid address form and show error "unknow postcode" on Front-Office checkout.
            $boolCityPostCodeIsValid = (!$arrResultCitiesGuide['boolIsCountrySupported']
                || $arrResultCitiesGuide['boolIsRequestComError']
                || $arrResultCitiesGuide['boolIsCityNameValid']
            );
        }


        $objHookCookie = $arrArgHookParams['cookie'];
        $strTNTPaymentReadyError = null;
        if (!empty($objHookCookie->TNTPaymentReadyError)) {
            $strTNTPaymentReadyError = $objHookCookie->TNTPaymentReadyError;
        }
        $objHookCookie->TNTPaymentReadyError = null;


        $this->smarty->assign(array(
            'boolCityPostCodeIsValid' => $boolCityPostCodeIsValid,
            'id_address_delivery' => (int)$objPSCart->id_address_delivery,
            'strTNTPaymentReadyError' => $strTNTPaymentReadyError
        ));

        // Display template.
        return $this->fetch(sprintf(
            'module:%s/views/templates/hook/displayBeforeCarrier.tpl',
            TNTOfficiel::MODULE_NAME
        ));
    }

    /**
     * HOOK called after the list of available carriers, during the order process.
     * Ideal location to add a carrier, as added by a module.
     * Display TNT products during the order process.
     * (displayCarrierList AKA extraCarrier is deprecated).
     *
     * @param array $arrArgHookParams array
     *
     * @return string
     */
    public function hookDisplayAfterCarrier($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objHookCart = $arrArgHookParams['cart'];

        $intCartID = (int)$objHookCart->id;
        $intCarrierIDSelected = (int)$objHookCart->id_carrier;
        $intAddressIDDelivery = (int)$objHookCart->id_address_delivery;
        $intCustomerID = (int)$objHookCart->id_customer;

        // If module not ready.
        if (!TNTOfficiel::isContextReady()) {
            // Display nothing.
            return '';
        }

        // Prevent AJAX bug with carrier id inconsistency.
        $objHookCart->save();

        $objTNTContextAccountModel = TNTOfficielAccount::loadContextShop();

        // If no account available for this context, or is not authenticated.
        if ($objTNTContextAccountModel === null
            || $objTNTContextAccountModel->getAuthValidatedDateTime() === null
        ) {
            // Display nothing.
            return '';
        }

        $objTNTCartModel = TNTOfficielCart::loadCartID($intCartID, true);
        if ($objTNTCartModel === null) {
            // Display nothing.
            return '';
        }

        $arrFormReceiverInfoValidate = null;
        $strExtraAddressDataValid = 'false';
        // A delivery address is optional.
        $objPSAddressDelivery = $objTNTCartModel->getPSAddressDelivery();
        // If delivery address object is available.
        if ($objPSAddressDelivery !== null) {
            // Load TNT receiver info or create a new one for it's ID.
            $objTNTReceiverModel = TNTOfficielReceiver::loadAddressID($objPSAddressDelivery->id);
            // If success.
            if ($objTNTReceiverModel !== null) {
                $strCustomerEMail = null;
                // A shipping address is optional.
                $objCustomer = new Customer($intCustomerID);
                // If shipping address object is available.
                if ((int)$objCustomer->id === $intCustomerID
                    && Validate::isLoadedObject($objCustomer)
                ) {
                    $strCustomerEMail = $objCustomer->email;
                }

                $strAddressPhone = $objTNTReceiverModel::searchPhoneMobile($objPSAddressDelivery);

                // Validate & store receiver info, using the customer email and address mobile phone as default values.
                $arrFormReceiverInfoValidate = $objTNTReceiverModel->storeReceiverInfo(
                    $objTNTReceiverModel->receiver_email ? $objTNTReceiverModel->receiver_email : $strCustomerEMail,
                    $objTNTReceiverModel->receiver_mobile ? $objTNTReceiverModel->receiver_mobile : $strAddressPhone,
                    $objTNTReceiverModel->receiver_building,
                    $objTNTReceiverModel->receiver_accesscode,
                    $objTNTReceiverModel->receiver_floor,
                    $objTNTReceiverModel->receiver_instructions
                );

                $strExtraAddressDataValid = $arrFormReceiverInfoValidate['stored'] ? 'true' : 'false';
            }
        }

        // Get the carriers model list.
        $arrObjTNTCarrierModelList = TNTOfficielCarrier::getFeasibilitiesContextCarrierModelList(
            // Get the heaviest product weight from cart.
            $objTNTCartModel->getCartHeaviestProduct(),
            $intAddressIDDelivery
        );

        // Load an existing TNT carrier.
        $objTNTCarrierModelSelected = TNTOfficielCarrier::loadCarrierID($intCarrierIDSelected, false);

        $this->smarty->assign(array(
            'arrObjTNTCarrierModelList' => $arrObjTNTCarrierModelList,
            'arrDeliveryOption' => $objTNTCartModel->getDeliveryOption(),
            'strCarrierTypeSelected' =>
                $objTNTCarrierModelSelected === null ? null : ($objTNTCarrierModelSelected->carrier_type),
            'arrFormReceiverInfoValidate' => $arrFormReceiverInfoValidate,
            'strExtraAddressDataValid' => $strExtraAddressDataValid,
        ));

        // Display template.
        return $this->fetch(sprintf(
            'module:%s/views/templates/hook/displayAfterCarrier.tpl',
            TNTOfficiel::MODULE_NAME
        ))/*
        .'<pre style="font-size: 11px;line-height: 1.2em;">'
        .'<b>intCarrierIDSelected</b> : '.$intCarrierIDSelected."\n"
        .'<b>objHookCart</b> : '.TNTOfficiel_Tools::encJSON($objHookCart)."\n"
        .'<b>objTNTCartModel</b> : '.TNTOfficiel_Tools::encJSON($objTNTCartModel)."\n"
        .'<b>CartTotalWeight</b> : '.TNTOfficiel_Tools::encJSON($objTNTCartModel->getCartTotalWeight())." Kg\n"
        .'<b>CartTotalPrice</b> : '.TNTOfficiel_Tools::encJSON($objTNTCartModel->getCartTotalPrice())." € TTC\n"
        .'</pre>'
        */
        ;
    }

    /**
     * HOOK called to display extra content of an available carriers when selected.
     *
     * @param array $arrArgHookParams
     *
     * @return string
     */
    public function hookDisplayCarrierExtraContent($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objContext = $this->context;

        $arrHookCarrier = $arrArgHookParams['carrier'];
        $intCarrierID = (int)$arrHookCarrier['id'];

        $objHookCart = $objContext->cart;
        $intCartID = (int)$objHookCart->id;

        // If module not ready.
        if (!TNTOfficiel::isContextReady()) {
            // Display nothing.
            return '';
        }

        // Load TNT cart info or create a new one for it's ID.
        $objTNTCartModel = TNTOfficielCart::loadCartID($intCartID, true);
        // If fail.
        if ($objTNTCartModel === null) {
            // Display nothing.
            return '';
        }

        // Load an existing TNT carrier.
        $objTNTCarrierModel = TNTOfficielCarrier::loadCarrierID($intCarrierID, false);
        // If fail.
        if ($objTNTCarrierModel === null) {
            // Display nothing.
            return '';
        }

        $objTNTCarrierAccountModel = $objTNTCarrierModel->getTNTAccountModel();

        // If no account available for this carrier, or is not authenticated.
        if ($objTNTCarrierAccountModel === null
            || $objTNTCarrierAccountModel->getAuthValidatedDateTime() === null
        ) {
            // Display nothing.
            return '';
        }

        /*
         * Estimated delivery date.
         */

        $strDueDate = null;

        // A delivery address is optional.
        $objPSAddressDelivery = $objTNTCartModel->getPSAddressDelivery();
        // If delivery address object is available.
        if ($objPSAddressDelivery !== null) {
            $arrFeasibilitiesList = $objTNTCarrierModel->feasibilities(
                trim($objPSAddressDelivery->postcode),
                trim($objPSAddressDelivery->city),
                $objTNTCarrierModel->getReceiverType($objPSAddressDelivery)
            );
            foreach ($arrFeasibilitiesList as $arrFeasibility) {
                $strDueDate = $arrFeasibility['dueDate'];
                break;
            }
        }

        $this->smarty->assign(array(
            'objTNTCarrierModel' => $objTNTCarrierModel,
            'strDueDate' => $objTNTCarrierAccountModel->delivery_display_edd ? $strDueDate : null,
            'deliveryPoint' => $objTNTCartModel->getDeliveryPoint(),
        ));

        // Display template.
        return $this->fetch(sprintf(
            'module:%s/views/templates/hook/displayCarrierExtraContent.tpl',
            TNTOfficiel::MODULE_NAME
        ))/*
        .'<pre style="font-size: 11px;line-height: 1.2em;">'
        .'<b>intCarrierIDSelected</b> : '.$intCarrierID."\n"
        .'<b>Account</b> : '.TNTOfficiel_Tools::encJSON($objTNTCarrierAccountModel)."\n"
        .'<b>Feasibilities</b> : '.TNTOfficiel_Tools::encJSON($arrFeasibilitiesList)."\n"
        .'<b>ZonesConf</b> : '.TNTOfficiel_Tools::encJSON($objTNTCarrierModel->getZonesConf())."\n"
        .'<b>CartShippingFree</b> : '
        .TNTOfficiel_Tools::encJSON($objTNTCartModel->isCartShippingFree($intCarrierID))."\n"
        .'<b>ExtraShippingCost</b> : '.$objTNTCartModel->getCartExtraShippingCost($intCarrierID)." € HT\n"
        .'<b>getPrice</b> : '.TNTOfficiel_Tools::encJSON($objTNTCarrierModel->getPrice(
            $objTNTCartModel->getCartTotalWeight(), $objTNTCartModel->getCartTotalPrice(), $objPSAddressDelivery->id
         ))." € HT\n"
        .'</pre>'*/
        ;
    }

    /**
     * HOOK 1.7.1+ called when button continue is submitted (confirmDeliveryOption) on delivery step.
     * Check if state for a selected carrier of this module is completed.
     * https://github.com/PrestaShop/PrestaShop/commit/895255fd61b9cdf77e4e6096ef076b5149d884a4
     *
     * @param array $arrArgHookParams
     *
     * @return bool
     */
    public function hookActionValidateStepComplete($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objHookCart = $arrArgHookParams['cart'];

        $objHookCookie = $arrArgHookParams['cookie'];

        $intCartID = (int)$objHookCart->id;

        // Load TNT cart info or create a new one for it's ID.
        $objTNTCartModel = TNTOfficielCart::loadCartID($intCartID, true);
        if ($objTNTCartModel !== null) {
            $arrResult = $objTNTCartModel->isPaymentReady();
            // Set to true if completed.
            $arrArgHookParams['completed'] = !array_key_exists('error', $arrResult) || !is_string($arrResult['error']);
            // Store error message to display later after redirect in BeforeCarrier Hook.
            if (array_key_exists('error', $arrResult) && is_string($arrResult['error'])) {
                $arrJSONTNTOfficiel = $this->getCommonVariable();
                if (array_key_exists($arrResult['error'], $arrJSONTNTOfficiel['translate'])) {
                    $objHookCookie->TNTPaymentReadyError = html_entity_decode(
                        $arrJSONTNTOfficiel['translate'][$arrResult['error']]
                    );
                } else {
                    $objHookCookie->TNTPaymentReadyError = $arrResult['error'];
                }
            }
        }

        return true;
    }

    /**
     * HOOK (AKA newOrder) called during the new order creation process, right after it has been created.
     * Called from /classes/PaymentModule.php
     *
     * Create XETT/PEX address if required and create parcels.
     *
     * @param $arrArgHookParams array
     *
     * @return bool
     */
    public function hookActionValidateOrder($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objHookOrder = $arrArgHookParams['order'];
        $intOrderID = (int)$objHookOrder->id;

        //$objHookCustomer = $arrArgHookParams['customer'];
        //$objHookCurrency = $arrArgHookParams['currency'];
        //$objHookOrderStatus = $arrArgHookParams['orderStatus'];

        // Load TNT order info or create a new one for it's ID.
        $objTNTOrderModel = TNTOfficielOrder::loadOrderID($intOrderID, true);
        // If fail.
        if ($objTNTOrderModel === null) {
            return false;
        }

        // Load an existing TNT carrier.
        $objTNTCarrierModel = $objTNTOrderModel->getTNTCarrierModel();
        // If fail or carrier is not from TNT module.
        if ($objTNTCarrierModel === null) {
            // Do not have to save this cart.
            return false;
        }

        // Load TNT cart info or create a new one for it's ID.
        $objTNTCartModel = $objTNTOrderModel->getTNTCartModel();
        // If fail.
        if ($objTNTCartModel === null) {
            return false;
        }

        // Creates parcels for order.
        $objTNTOrderModel->createParcels();

        if ($objTNTCarrierModel->carrier_type === 'DEPOT'
            || $objTNTCarrierModel->carrier_type === 'DROPOFFPOINT'
        ) {
            $arrDeliveryPoint = $objTNTCartModel->getDeliveryPoint();

            // Copy Delivery Point from cart.
            $mxdNewIDAddressDelivery = $objTNTOrderModel->setDeliveryPoint($arrDeliveryPoint);
            if (is_int($mxdNewIDAddressDelivery) && $mxdNewIDAddressDelivery > 0) {
                $objHookOrder->id_address_delivery = $mxdNewIDAddressDelivery;
            } elseif (!$mxdNewIDAddressDelivery) {
                return false;
            }

            // Save TNT order.
            $objTNTOrderModel->save();
        }

        // Update shipping date if available.
        $objTNTOrderModel->updatePickupDate();

        return true;
    }

    /**
     * HOOK (AKA adminOrder) called when the order's details are displayed, below the Client Information block.
     * Parcel management for orders with a tnt carrier.
     *
     * @param array $arrArgHookParams
     *
     * @return string
     */
    public function hookDisplayAdminOrder($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objContext = $this->context;

        // Controller.
        $objController = $objContext->controller;

        //$objHookCookie = $arrArgHookParams['cookie'];
        //$objHookCart = $arrArgHookParams['cart'];

        $intHookOrderID = (int)$arrArgHookParams['id_order'];


        $objPSOrder = TNTOfficielOrder::getPSOrder($intHookOrderID);
        if ($objPSOrder === null) {
            // Display nothing.
            return '';
        }

        // If order carrier is not created by tntofficiel module.
        if (!TNTOfficielCarrier::isTNTOfficielCarrierID($objPSOrder->id_carrier)) {
            // Display nothing.
            return '';
        }

        // Prevent Prestahop bugs without override.
        // http://forge.prestashop.com/browse/BOOM-4050
        // http://forge.prestashop.com/browse/BOOM-5821
        //if (version_compare(_PS_VERSION_, '1.7.5', '<')) {
        if (Shop::getContext() !== Shop::CONTEXT_SHOP) {
            // Change context to order shop.
            Tools::redirectAdmin(
                $this->context->link->getAdminLink('AdminOrders', false)
                .'&id_order='.$objPSOrder->id.'&vieworder'
                .'&token='.Tools::getAdminTokenLite('AdminOrders')
                .'&setShopContext=s-'.$objPSOrder->id_shop
            );
        }
        //}

        // Load TNT order info or create a new one for it's ID.
        $objTNTOrderModel = TNTOfficielOrder::loadOrderID($intHookOrderID, true);
        if ($objTNTOrderModel === null) {
            $this->context->controller->errors[] = sprintf(
                $this->l('Unable to load or create TNT Order for Order ID #%s'),
                $intHookOrderID
            );
            // Display nothing.
            return '';
        }

        $objTNTCarrierAccountModel = $objTNTOrderModel->getTNTAccountModel();
        // If no account available for this order's carrier.
        if ($objTNTCarrierAccountModel === null) {
            $this->context->controller->errors[] = sprintf(
                $this->l('Unable to load TNT Account for Carrier ID #%s'),
                $objPSOrder->id_carrier
            );
            return '';
        }

        // If account is not authenticated.
        if ($objTNTCarrierAccountModel->getAuthValidatedDateTime() === null) {
            $this->context->controller->errors[] = sprintf(
                $this->l('TNT Account is not authenticated for Account ID #%s'),
                $objTNTCarrierAccountModel->id
            );
            // Display nothing.
            return '';
        }

        // Load TNT Receiver info or create a new one for it's ID.
        $objTNTReceiverModel = TNTOfficielReceiver::loadAddressID($objPSOrder->id_address_delivery);
        // If fail.
        if ($objTNTReceiverModel === null) {
            $this->context->controller->errors[] = sprintf(
                $this->l('Unable to load or create TNT Receiver for Address ID #%s'),
                $objPSOrder->id_address_delivery
            );
            // Display nothing.
            return '';
        }


        $strAssetCSSPath = $this->getPathUri().'views/css/'.TNTOfficiel::MODULE_RELEASE.'/';
        $strAssetJSPath = $this->getPathUri().'views/js/'.TNTOfficiel::MODULE_RELEASE.'/';

        // Form.css required for address-city-check, ExtraData
        $objController->addCSS($strAssetCSSPath.'form.css', 'all');
        //
        $objController->addCSS($strAssetCSSPath.'carrier.css', 'all');

        // FancyBox required to display form (cp/ville check).
        $objController->addJqueryPlugin('fancybox');

        // TNTOfficiel_inflate() TNTOfficiel_deflate(), required by carrierDeliveryPoint.js
        $objController->addJS($strAssetJSPath.'lib/string.js');
        // jQuery.fn.nanoScroller, required by carrierDeliveryPoint.js
        $objController->addJS($strAssetJSPath.'lib/nanoscroller/jquery.nanoscroller.min.js');
        $objController->addCSS($strAssetJSPath.'lib/nanoscroller/nanoscroller.css', 'all');

        $objController->addJS($strAssetJSPath.'carrierDeliveryPoint.js');
        $objController->addJS($strAssetJSPath.'carrierAdditionalInfo.js');
        $objController->addJS($strAssetJSPath.'AdminOrder.js');

        // Remove script load of API Google Map to prevent conflicts.
        // Removed in this hook triggered after the setMedia to catch parent class script addition.
        foreach ($objController->js_files as $key => $jsFile) {
            if (preg_match('/^((https?:)?\/\/)?maps\.google(apis)?\.com\/maps\/api\/js/ui', $jsFile)) {
                unset($objController->js_files[$key]);
            }
        }
        // Load once using TNTOfficel module API key.
        $objController->addJS(
            'https://maps.googleapis.com/maps/api/js?v='.TNTOfficiel::GMAP_API_VER.'&key='
            .$objTNTCarrierAccountModel->api_google_map_key
        );


        $strPickUpNumber = $objTNTCarrierAccountModel->pickup_display_number ? $objTNTOrderModel->pickup_number : null;

        // Creates parcels for order if not already done.
        $objTNTOrderModel->createParcels();

        // If all parcels delivered and order state delivered is applied.
        if ($objTNTOrderModel->updateOrderStateDeliveredParcels() === true) {
            // Redirect to show new order state.
            Tools::redirectAdmin(
                $this->context->link->getAdminLink('AdminOrders', false)
                .'&id_order='.$objPSOrder->id.'&vieworder'
                .'&token='.Tools::getAdminTokenLite('AdminOrders')
                //.'&setShopContext=s-'.$objPSOrder->id_shop
            );
        }

        // Get the parcels.
        $arrObjTNTParcelModelList = $objTNTOrderModel->getTNTParcelModelList();

        // Check and display error about shipping date.
        if (!Tools::isSubmit('submitState')) {
            // Check or update the shipping date.
            $arrResultPickupDate = $objTNTOrderModel->updatePickupDate();
            // If true error.
            if (is_string($arrResultPickupDate['strResponseMsgError'])) {
                $objController->errors[] = TNTOfficiel::CARRIER_NAME.' : '
                    .$arrResultPickupDate['strResponseMsgError'];
            }
/*
            // If normal error.
            if (is_string($arrResultPickupDate['strResponseMsgWarning'])) {
                $objController->warnings[] = TNTOfficiel::CARRIER_NAME.' : '
                    .$arrResultPickupDate['strResponseMsgWarning'];
            }
*/
        }

        $intTSShippingDate = TNTOfficiel_Tools::getDateTimeFormat($objTNTOrderModel->shipping_date);

        $dueDate = '';
        $objDateTimeDue = TNTOfficiel_Tools::getDateTime($objTNTOrderModel->due_date);
        if ($objDateTimeDue !== null) {
            $dueDate = $objDateTimeDue->format('d/m/Y');
        }

        $objDateTimeToday = new DateTime('midnight');
        $intTSFirstAvailableDate = (int)$objDateTimeToday->format('U');

        $arrDeliveryPoint = $objTNTOrderModel->getDeliveryPoint();
        $strDeliveryPointType = $objTNTOrderModel->getDeliveryPointType();
        $strDeliveryPointCode = $objTNTOrderModel->getDeliveryPointCode();

        $objCustomer = new Customer((int)$objPSOrder->id_customer);
        $objPSAddressDelivery = $objTNTOrderModel->getPSAddressDelivery();
        $strAddressPhone = $objTNTReceiverModel::searchPhoneMobile($objPSAddressDelivery);

        // Validate and store receiver info, using the customer email and address mobile phone as default values.
        $arrFormReceiverInfoValidate = $objTNTReceiverModel->storeReceiverInfo(
            $objTNTReceiverModel->receiver_email ? $objTNTReceiverModel->receiver_email : $objCustomer->email,
            $objTNTReceiverModel->receiver_mobile ? $objTNTReceiverModel->receiver_mobile : $strAddressPhone,
            $objTNTReceiverModel->receiver_building,
            $objTNTReceiverModel->receiver_accesscode,
            $objTNTReceiverModel->receiver_floor,
            $objTNTReceiverModel->receiver_instructions
        );


        $strBTLabelName = '';
        if ($objTNTOrderModel->isExpeditionCreated()) {
            // Load TNT label info or create a new one for it's ID.
            $objTNTLabelModel = TNTOfficielLabel::loadOrderID($intHookOrderID, false);
            // If fail.
            if ($objTNTLabelModel !== null) {
                $strBTLabelName = $objTNTLabelModel->label_name;
            }
        }

        $this->smarty->assign(array(
            'objPSOrder' => $objPSOrder,
            'objPSAddressDelivery' => $objPSAddressDelivery,
            'strPickUpNumber' => $strPickUpNumber,
            'arrObjTNTParcelModelList' => $arrObjTNTParcelModelList,
            'intTSFirstAvailableDate' => $intTSFirstAvailableDate,
            'intTSShippingDate' => $intTSShippingDate,
            'dueDate' => $dueDate,
            'isExpeditionCreated' => (bool)$objTNTOrderModel->isExpeditionCreated(),
            'isUpdateParcelsStateAllowed' => (bool)$objTNTOrderModel->isUpdateParcelsStateAllowed(),
            'strBTLabelName' => $strBTLabelName,
            'strDeliveryPointType' => $strDeliveryPointType,
            'strDeliveryPointCode' => $strDeliveryPointCode,
            'arrFormReceiverInfoValidate' => $arrFormReceiverInfoValidate,
            'arrDeliveryPoint' => $arrDeliveryPoint
        ));

        if (!$objTNTOrderModel->isExpeditionCreated()) {
            if ($strDeliveryPointType !== null && $strDeliveryPointCode === null) {
                $objController->errors[] = TNTOfficiel::CARRIER_NAME.' : '
                .$this->l('This order must be finalized for expedition creation.').' '
                .$this->l('In the CLIENT section, DELIVERY ADDRESS tab, SELECT a delivery point.');
            }
            if ($arrFormReceiverInfoValidate['length'] !== 0) {
                $objController->errors[] = TNTOfficiel::CARRIER_NAME.' : '
                .$this->l('This order must be finalized for expedition creation.').' '
                .$this->l('In the CUSTOMER section, DELIVERY ADDRESS tab, CONFIRM the ADDITIONAL INFORMATION form.');
            }
        }


        // Display template.
        return $this->display(__FILE__, 'views/templates/hook/displayAdminOrder.tpl');
        /*
        return $this->fetch(sprintf(
            'module:%s/views/templates/hook/displayAdminOrder.tpl',
            TNTOfficiel::MODULE_NAME
        ));
        */
    }


    /**
     * HOOK (AKA updateCarrier) called when a carrier is updated.
     * Updating a Carrier means preserve its previous state and adding a new one which include change using a new ID.
     *
     * @param array $arrArgHookParams
     *
     * @return bool
     */
    public function hookActionCarrierUpdate($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $intHookCarrierIDModified = $arrArgHookParams['id_carrier'];
        $objHookCarrierNew = $arrArgHookParams['carrier'];

        // Update it.
        return TNTOfficielCarrier::updateCarrierID(
            $intHookCarrierIDModified,
            $objHookCarrierNew->id
        );
    }

    /**
     * Carrier module : Method triggered form Cart Model if $carrier->need_range == false.
     * Get the cart shipping price without using the ranges.
     * (best price).
     *
     * @param Cart $objArgCart
     *
     * @return float|false
     */
    public function getOrderShippingCostExternal($objArgCart)
    {
        TNTOfficiel_Logstack::log();

        $fltPrice = $this->getOrderShippingCost($objArgCart, 0.0);

        return $fltPrice;
    }

    /**
     * Carrier module : Method triggered form Cart Model if $carrier->need_range == true.
     * Get the shipping price depending on the ranges that were set in the back office.
     * Get the shipping cost for a cart (best price), if carrier need range (default).
     *
     * @param Cart $objArgCart
     *
     * @return float|false false if no shipping cost (not available).
     */
    public function getOrderShippingCost($objArgCart, $fltArgShippingCost)
    {
        TNTOfficiel_Logstack::log();

        // See comment about current class $id_carrier property.
        $intCartID = (int)$objArgCart->id;
        $intCarrierID = (int)$this->id_carrier;
        $intAddressIDDelivery = (int)$objArgCart->id_address_delivery;

        // If cart carrier is not created by tntofficiel module.
        if (!TNTOfficielCarrier::isTNTOfficielCarrierID($intCarrierID)) {
            // No shipping cost, not available.
            return false;
        }

        // If module not ready.
        if (!TNTOfficiel::isContextReady()) {
            // No shipping cost, not available.
            return false;
        }

        // Load an existing TNT carrier.
        $objTNTCarrierModel = TNTOfficielCarrier::loadCarrierID($intCarrierID, false);
        // If fail or carrier is not from TNT module.
        if ($objTNTCarrierModel === null) {
            // No shipping cost, not available.
            return false;
        }

        $objTNTCarrierAccountModel = $objTNTCarrierModel->getTNTAccountModel();

        // If no account available for this carrier, or is not authenticated.
        if ($objTNTCarrierAccountModel === null
            || $objTNTCarrierAccountModel->getAuthValidatedDateTime() === null
        ) {
            // No shipping cost, not available.
            return false;
        }

        $objTNTCartModel = TNTOfficielCart::loadCartID($intCartID, true);
        if ($objTNTCartModel === null) {
            // No shipping cost, not available.
            return false;
        }

        // Multi-Shipping with multiple address or different carrier not supported.
        $boolMultiShippingSupport = $objTNTCartModel->isMultiShippingSupport();
        if (!$boolMultiShippingSupport) {
            return false;
        }

        $arrObjTNTCarrierModelList = TNTOfficielCarrier::getFeasibilitiesContextCarrierModelList(
            // Get the heaviest product weight from cart.
            $objTNTCartModel->getCartHeaviestProduct(),
            $intAddressIDDelivery
        );

        // If carrier is feasible.
        if (array_key_exists($intCarrierID, $arrObjTNTCarrierModelList)) {
            $objTNTCarrierModel = $arrObjTNTCarrierModelList[$intCarrierID];

            $fltPrice = $objTNTCarrierModel->getPrice(
                $objTNTCartModel->getCartTotalWeight(),
                $objTNTCartModel->getCartTotalPrice(),
                $intAddressIDDelivery
            );

            // Use native Prestashop price.
            if ($fltPrice === null) {
                return $fltArgShippingCost;
            }
            // Carrier is disabled.
            if ($fltPrice === false) {
                return false;
            }
            // Shipping is free.
            if ($objTNTCartModel->isCartShippingFree($intCarrierID)) {
                return 0.0;
            }

            // Get additional shipping cost for cart.
            $fltCartExtraShippingCost = $objTNTCartModel->getCartExtraShippingCost($intCarrierID);

            return $fltPrice + $fltCartExtraShippingCost;
        }

        // No shipping cost, not available.
        return false;
    }

    /**
     * HOOK (AKA updateOrderStatus) called when an order's status is changed, right before it is actually changed.
     * If status become ORDERSTATE_SAVESHIPMENT, then creates an expedition.
     *
     * @param array $arrArgHookParams
     */
    public function hookActionOrderStatusUpdate($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objHookCookie = $arrArgHookParams['cookie'];

        $objHookOrderStateNew = $arrArgHookParams['newOrderStatus'];
        $intHookOrderID = (int)$arrArgHookParams['id_order'];

        $intOrderStateIDNew = (int)$objHookOrderStateNew->id;

        // If new order status must trigger expedition creation.
        if (TNTOfficiel::ORDERSTATE_SAVESHIPMENT !== null
            && Configuration::get(TNTOfficiel::ORDERSTATE_SAVESHIPMENT) == $intOrderStateIDNew
        ) {
            $objPSOrder = TNTOfficielOrder::getPSOrder($intHookOrderID);
            if ($objPSOrder === null) {
                return;
            }

            $intCarrierID = (int)$objPSOrder->id_carrier;

            // Load an existing TNT carrier.
            $objTNTCarrierModel = TNTOfficielCarrier::loadCarrierID($intCarrierID, false);
            // If fail or carrier is not from TNT module.
            if ($objTNTCarrierModel === null) {
                // Do nothing.
                return;
            }

            // Load TNT order info for it's ID.
            $objTNTOrderModel = TNTOfficielOrder::loadOrderID($intHookOrderID, false);
            // If fail.
            if ($objTNTOrderModel === null) {
                $objHookCookie->TNTOfficielError = 'Order not found for Order ID #'.$intHookOrderID;
                // Do nothing.
                return;
            }


            // Check or update the shipping date.
            $arrResultPickupDate = $objTNTOrderModel->updatePickupDate();

            // If true error.
            if (is_string($arrResultPickupDate['strResponseMsgError'])) {
                $objHookCookie->TNTOfficielError = $arrResultPickupDate['strResponseMsgError'];
            } elseif (!$objTNTOrderModel->isExpeditionCreated()) {
                // Send a shipment request.
                $arrResponse = $objTNTOrderModel->saveShipment();
                // If the response is a string, there is an error.
                if (is_string($arrResponse['strResponseMsgError'])) {
                    $objHookCookie->TNTOfficielError = $arrResponse['strResponseMsgError'];
                }
            }

            // If normal error.
            if (is_string($arrResultPickupDate['strResponseMsgWarning'])) {
                $objHookCookie->TNTOfficielWarning = $arrResultPickupDate['strResponseMsgWarning'];
            }

            // If order has no shipment created.
            if ($objTNTOrderModel === null || !$objTNTOrderModel->isExpeditionCreated()) {
                // Default error message.
                if (!$objHookCookie->TNTOfficielError) {
                    $objHookCookie->TNTOfficielError = $this->l('Error create shipping');
                }
                // Log.
                TNTOfficiel_Logger::logException(new Exception($objHookCookie->TNTOfficielError));
                // Redirect to prevent new order state (cleaner than reverting).
                Tools::redirectAdmin(
                    $this->context->link->getAdminLink('AdminOrders', false)
                    .'&id_order='.$objPSOrder->id.'&vieworder'
                    .'&token='.Tools::getAdminTokenLite('AdminOrders')
                    //.'&setShopContext=s-'.$objPSOrder->id_shop
                );
            }
        }
    }

    /**
     * HOOK (AKA postUpdateOrderStatus) called when an order's status is changed, right after it is actually changed.
     * Alert if the shipment was not saved (for an unknown reason).
     *
     * @param array $arrArgHookParams
     */
    public function hookActionOrderStatusPostUpdate($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objHookCookie = $arrArgHookParams['cookie'];

        $objHookOrderStateNew = $arrArgHookParams['newOrderStatus'];
        $intHookOrderID = (int)$arrArgHookParams['id_order'];
        $objPSOrder = new Order($intHookOrderID);
        $intOrderStateIDNew = (int)$objHookOrderStateNew->id;

        $intCarrierID = (int)$objPSOrder->id_carrier;

        // Load an existing TNT carrier.
        $objTNTCarrierModel = TNTOfficielCarrier::loadCarrierID($intCarrierID, false);
        // If fail or carrier is not from TNT module.
        if ($objTNTCarrierModel === null) {
            // Do nothing.
            return;
        }

        // Check if the new order status is the one that must trigger shipment creation.
        if (TNTOfficiel::ORDERSTATE_SAVESHIPMENT !== null
            && Configuration::get(TNTOfficiel::ORDERSTATE_SAVESHIPMENT) == $intOrderStateIDNew
        ) {
            // Load TNT order info for it's ID.
            $objTNTOrderModel = TNTOfficielOrder::loadOrderID($intHookOrderID, false);

            // If order has no shipment created.
            if ($objTNTOrderModel === null || !$objTNTOrderModel->isExpeditionCreated()) {
                TNTOfficiel_Logger::logException(new Exception($this->l('Error create shipping')));
                if (!$objHookCookie->TNTOfficielError) {
                    $objHookCookie->TNTOfficielError = $this->l('Error create shipping');
                }
            }
        }
    }

    /**
     * HOOK (AKA orderDetailDisplayed) displayed on order detail on Front-Office.
     * Insert parcel tracking block on order detail.
     *
     * @param array $arrArgHookParams
     *
     * @return string
     */
    public function hookDisplayOrderDetail($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        $objHookOrder = $arrArgHookParams['order'];
        $intHookOrderID = (int)$objHookOrder->id;

        // Load an existing TNT carrier.
        $objTNTCarrierModel = TNTOfficielCarrier::loadCarrierID($objHookOrder->id_carrier, false);
        // If fail or carrier is not from TNT module.
        if ($objTNTCarrierModel === null) {
            // Display nothing.
            return '';
        }

        // Load TNT order info for it's ID.
        $objTNTOrderModel = TNTOfficielOrder::loadOrderID($intHookOrderID, false);

        // If order has no shipment created.
        if ($objTNTOrderModel === null || !$objTNTOrderModel->isExpeditionCreated()) {
            // Display nothing.
            return '';
        }

        $this->smarty->assign(array(
            'trackingUrl' => $this->context->link->getModuleLink(
                TNTOfficiel::MODULE_NAME,
                'tracking',
                array('action' => 'tracking', 'orderId' => $intHookOrderID),
                true
            )
        ));

        // Display template.
        return $this->fetch(sprintf(
            'module:%s/views/templates/hook/displayOrderDetail.tpl',
            TNTOfficiel::MODULE_NAME
        ));
    }

    /**
     * Add mail template variable.
     *
     * @param $arrArgHookParams
     *
     * @return bool
     */
    public function hookActionGetExtraMailTemplateVars($arrArgHookParams)
    {
        TNTOfficiel_Logstack::log();

        if (!array_key_exists('extra_template_vars', $arrArgHookParams)) {
            return false;
        }

        // Variables default is immediately available (empty).
        $arrArgHookParams['extra_template_vars']['{tntofficiel_tracking_url_text}'] = '';
        $arrArgHookParams['extra_template_vars']['{tntofficiel_tracking_url_html}'] = '';

        $intLangID = (int)$arrArgHookParams['id_lang'];
        $strLangISO = Language::getIsoById($intLangID);

        // If id_order not provided.
        if (!array_key_exists('{id_order}', $arrArgHookParams['template_vars'])) {
            return false;
        }

        $intOrderID = (int)$arrArgHookParams['template_vars']['{id_order}'];
        // Load TNT order.
        $objTNTOrderModel = TNTOfficielOrder::loadOrderID($intOrderID, false);
        // If fail.
        if ($objTNTOrderModel === null) {
            return false;
        }

        // Translation.
        $strLinkTrack = 'Track my TNT packages';
        if ($strLangISO === 'fr') {
            $strLinkTrack = 'Suivre mes colis TNT';
        }

        // mails/fr/shipped.txt; mails/fr/shipped.html
        // if ($arrArgHookParams['template'] === 'shipped') {}

        // Get tracking URL if available.
        $strTrackingURL = $objTNTOrderModel->getTrackingURL();
        if (!is_string($strTrackingURL)) {
            return false;
        }

        $arrArgHookParams['extra_template_vars']['{tntofficiel_tracking_url_text}'] =
            $strLinkTrack.' : ['.$strTrackingURL.']';
        $arrArgHookParams['extra_template_vars']['{tntofficiel_tracking_url_html}'] =
            '<a href="'.$strTrackingURL.'" style="color:#337FF1">'.$strLinkTrack.'</a>';

        return true;
    }
}
