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
 * Class TNTOfficielOrder
 */
class TNTOfficielOrder extends ObjectModel
{
    // id_tntofficiel_order
    public $id;

    public $id_order;
    public $delivery_point;
    public $is_shipped;
    public $pickup_number;
    public $shipping_date;
    public $due_date;

    public static $definition = array(
        'table' => 'tntofficiel_order',
        'primary' => 'id_tntofficiel_order',
        'fields' => array(
            'id_order' => array(
                'type' => ObjectModel::TYPE_INT,
                'validate' => 'isUnsignedId',
                'required' => true
            ),
            'delivery_point' => array(
                'type' => ObjectModel::TYPE_STRING
                /*, 'validate' => 'isSerializedArray', 'size' => 65000*/
            ),
            'is_shipped' => array(
                'type' => ObjectModel::TYPE_BOOL,
                'validate' => 'isBool'
            ),
            'pickup_number' => array(
                'type' => ObjectModel::TYPE_STRING,
                'size' => 50
            ),
            'shipping_date' => array(
                'type' => ObjectModel::TYPE_DATE,
                'validate' => 'isDateFormat',
            ),
            'due_date' => array(
                'type' => ObjectModel::TYPE_DATE,
                'validate' => 'isDateFormat',
            )
        )
    );

    // cache and prevent race condition.
    private static $arrLoadedEntities = array();


    /**
     * Creates the tables needed by the model.
     *
     * @return bool
     */
    public static function createTables()
    {
        TNTOfficiel_Logstack::log();

        $strLogMessage = sprintf('%s::%s', __CLASS__, __FUNCTION__);

        $strTablePrefix = _DB_PREFIX_;
        $strTableEngine = _MYSQL_ENGINE_;

        $strTableName = $strTablePrefix.TNTOfficielOrder::$definition['table'];

        // If table exist.
        if (TNTOfficiel_Tools::isTableExist($strTableName) === true) {
            return TNTOfficielOrder::upgradeTables();
        }

        // Create table.
        $strSQLCreateOrder = <<<SQL
CREATE TABLE IF NOT EXISTS `${strTableName}` (
    `id_tntofficiel_order`          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_order`                      INT(10) UNSIGNED NOT NULL,
    `delivery_point`                TEXT NULL,
    `is_shipped`                    TINYINT(1) NOT NULL DEFAULT '0',
    `pickup_number`                 VARCHAR(50) NOT NULL DEFAULT '',
    `shipping_date`                 DATE NOT NULL DEFAULT '0000-00-00',
    `due_date`                      DATE NOT NULL DEFAULT '0000-00-00',
-- Key.
    PRIMARY KEY (`id_tntofficiel_order`),
    UNIQUE INDEX `id_order` (`id_order`)
) ENGINE = ${strTableEngine} DEFAULT CHARSET='utf8' COLLATE='utf8_general_ci';
SQL;

        $boolDBResult = TNTOfficiel_Tools::getDbExecute($strSQLCreateOrder);
        if (is_string($boolDBResult)) {
            TNTOfficiel_Logger::logInstall($strLogMessage.' : '.$boolDBResult, false);

            return false;
        }

        TNTOfficiel_Logger::logInstall($strLogMessage);

        return TNTOfficielOrder::checkTables();
    }

    /**
     * Upgrade table.
     *
     * @return bool
     */
    public static function upgradeTables()
    {
        TNTOfficiel_Logstack::log();

        $strLogMessage = __CLASS__.'::'.__FUNCTION__;

        $strTablePrefix = _DB_PREFIX_;
        $strTableName = $strTablePrefix.TNTOfficielOrder::$definition['table'];

        // Upgrade table.
        $strSQLTableOrderDropColumns = <<<SQL
ALTER TABLE `${strTableName}`
    DROP COLUMN `start_date`;
SQL;

        $arrRequireColumnsList = array('start_date');

        // If table exist, with some columns.
        if (TNTOfficiel_Tools::isTableColumnsExist($strTableName, $arrRequireColumnsList) === true) {
            // Update table.
            $boolDBResult = TNTOfficiel_Tools::getDbExecute($strSQLTableOrderDropColumns);
            if (is_string($boolDBResult)) {
                TNTOfficiel_Logger::logInstall($strLogMessage.' : '.$boolDBResult, false);

                return false;
            }
        }

        TNTOfficiel_Logger::logInstall($strLogMessage);

        return TNTOfficielOrder::checkTables();
    }

    /**
     * Check if table and columns exist.
     *
     * @return bool
     */
    public static function checkTables()
    {
        $strTablePrefix = _DB_PREFIX_;
        $strTableName = $strTablePrefix.TNTOfficielOrder::$definition['table'];
        $arrColumnsList = array_keys(TNTOfficielOrder::$definition['fields']);

        return (TNTOfficiel_Tools::isTableColumnsExist($strTableName, $arrColumnsList) === true);
    }

    /**
     * Constructor.
     */
    public function __construct($intArgID = null)
    {
        TNTOfficiel_Logstack::log();

        parent::__construct($intArgID);
    }

    /**
     * Load existing object model or optionally create a new one for it's ID.
     *
     * @param $intArgOrderID
     * @param bool $boolArgCreate
     *
     * @return TNTOfficielOrder|null
     */
    public static function loadOrderID($intArgOrderID, $boolArgCreate = true)
    {
        TNTOfficiel_Logstack::log();

        $intOrderID = (int)$intArgOrderID;

        // No new order ID.
        if (!($intOrderID > 0)) {
            return null;
        }

        $strEntityID = '_'.$intOrderID.'-'.(int)null.'-'.(int)null;
        // If already loaded.
        if (array_key_exists($strEntityID, TNTOfficielOrder::$arrLoadedEntities)) {
            $objTNTOrderModel = TNTOfficielOrder::$arrLoadedEntities[$strEntityID];
            // Check.
            if ((int)$objTNTOrderModel->id_order === $intOrderID && Validate::isLoadedObject($objTNTOrderModel)) {
                return $objTNTOrderModel;
            }
        }

        // Search row for order ID.
        $objDbQuery = new DbQuery();
        $objDbQuery->select('*');
        $objDbQuery->from(TNTOfficielOrder::$definition['table']);
        $objDbQuery->where('id_order = '.$intOrderID);

        $arrDBResult = TNTOfficiel_Tools::getDbSelect($objDbQuery);
        // If row found and match order ID.
        if (is_array($arrDBResult) && count($arrDBResult)===1 && $intOrderID===(int)$arrDBResult[0]['id_order']) {
            // Load existing TNT order entry.
            $objTNTOrderModel = new TNTOfficielOrder((int)$arrDBResult[0]['id_tntofficiel_order']);
        } elseif ($boolArgCreate === true) {
            // Create a new TNT order entry.
            $objTNTOrderModelCreate = new TNTOfficielOrder(null);
            $objTNTOrderModelCreate->id_order = $intOrderID;
            $objTNTOrderModelCreate->save();
            // Reload to get default DB values after creation.
            $objTNTOrderModel = TNTOfficielOrder::loadOrderID($intOrderID, false);
        } else {
            $objException = new Exception('TNTOfficielOrder not found for Order ID #'.$intOrderID);
            TNTOfficiel_Logger::logException($objException);

            return null;
        }

        // Check.
        if ((int)$objTNTOrderModel->id_order !== $intOrderID || !Validate::isLoadedObject($objTNTOrderModel)) {
            return null;
        }
        $objTNTOrderModel->id = (int)$objTNTOrderModel->id;
        $objTNTOrderModel->id_order = (int)$objTNTOrderModel->id_order;

        TNTOfficielOrder::$arrLoadedEntities[$strEntityID] = $objTNTOrderModel;

        return $objTNTOrderModel;
    }

    /**
     * Load a Prestashop Order object from id.
     *
     * @param int $intArgOrderID
     *
     * @return Order|null
     */
    public static function getPSOrder($intArgOrderID)
    {
        TNTOfficiel_Logstack::log();

        // Carrier ID must be an integer greater than 0.
        if (empty($intArgOrderID) || $intArgOrderID != (int)$intArgOrderID || !((int)$intArgOrderID > 0)) {
            return null;
        }

        $intOrderID = (int)$intArgOrderID;

        // Load carrier.
        $objPSOrder = new Order($intOrderID);

        // If carrier object not available.
        if (!(Validate::isLoadedObject($objPSOrder) && (int)$objPSOrder->id === $intOrderID)) {
            return null;
        }

        return $objPSOrder;
    }

    /**
     * Load the Prestashop Address object used for delivery from Order.
     *
     * @return Address|null
     */
    public function getPSAddressDelivery()
    {
        $objPSOrder = TNTOfficielOrder::getPSOrder($this->id_order);
        if ($objPSOrder === null) {
            return null;
        }

        $intAddressID = (int)$objPSOrder->id_address_delivery;

        return TNTOfficielReceiver::getPSAddress($intAddressID);
    }

    /**
     * Get the order Carrier model.
     *
     * @return TNTOfficielCarrier|null
     */
    public function getTNTCarrierModel()
    {
        TNTOfficiel_Logstack::log();

        $objPSOrder = TNTOfficielOrder::getPSOrder($this->id_order);
        if ($objPSOrder === null) {
            return null;
        }

        // Load an existing TNT carrier.
        return TNTOfficielCarrier::loadCarrierID($objPSOrder->id_carrier, false);
    }

    /**
     * Get the carrier Account model from order.
     *
     * @return TNTOfficielAccount|null
     */
    public function getTNTAccountModel()
    {
        TNTOfficiel_Logstack::log();

        $objTNTCarrierModel = $this->getTNTCarrierModel();
        if ($objTNTCarrierModel === null) {
            return null;
        }

        return $objTNTCarrierModel->getTNTAccountModel();
    }

    /**
     * Get the Cart model from the order.
     *
     * @return TNTOfficielCart|null
     */
    public function getTNTCartModel()
    {
        TNTOfficiel_Logstack::log();

        $intOrderID = (int)$this->id_order;

        // Get the Cart object from Order.
        $objPSCart = Cart::getCartByOrderId($intOrderID);

        // If cart object not available.
        if (!(Validate::isLoadedObject($objPSCart) && (int)$objPSCart->id > 0)) {
            return null;
        }

        $intCartID = (int)$objPSCart->id;

        // Load or create a TNT cart.
        return TNTOfficielCart::loadCartID($intCartID, true);
    }

    /**
     * Get the Parcel model list from the order.
     *
     * @return array list of TNTOfficielParcel.
     */
    public function getTNTParcelModelList()
    {
        TNTOfficiel_Logstack::log();

        $intOrderID = (int)$this->id_order;

        return TNTOfficielParcel::searchOrderID($intOrderID);
    }

    /**
     * @return array
     */
    public function getDeliveryPoint()
    {
        TNTOfficiel_Logstack::log();

        $arrDeliveryPoint = Tools::unSerialize($this->delivery_point);

        if (!is_array($arrDeliveryPoint)) {
            $arrDeliveryPoint = array();
        }

        $objTNTCarrierModel = $this->getTNTCarrierModel();
        if ($objTNTCarrierModel === null) {
            return false;
        }

        // DEPOT have an PEX code.
        // DROPOFFPOINT have an XETT code.
        if ($objTNTCarrierModel->carrier_type === 'DEPOT'
            &&  isset($arrDeliveryPoint['pex'])
        ) {
            unset($arrDeliveryPoint['xett']);
        } elseif ($objTNTCarrierModel->carrier_type === 'DROPOFFPOINT'
            &&  isset($arrDeliveryPoint['xett'])
        ) {
            unset($arrDeliveryPoint['pex']);
        } else {
            $arrDeliveryPoint = array();
        }

        return $arrDeliveryPoint;
    }

    /**
     * Save a delivery point depending to the current carrier type.
     *
     * @param array $arrArgDeliveryPoint
     *
     * @return bool|int The new address ID used for Order. false if fail. true if no change needed.
     */
    public function setDeliveryPoint($arrArgDeliveryPoint)
    {
        TNTOfficiel_Logstack::log();

        if (!is_array($arrArgDeliveryPoint)) {
            return false;
        }

        $objTNTCarrierModel = $this->getTNTCarrierModel();
        if ($objTNTCarrierModel === null) {
            return false;
        }

        // DEPOT have an PEX code.
        // DROPOFFPOINT have an XETT code.
        if ($objTNTCarrierModel->carrier_type === 'DEPOT'
            &&  isset($arrArgDeliveryPoint['pex'])
        ) {
            unset($arrArgDeliveryPoint['xett']);
        } elseif ($objTNTCarrierModel->carrier_type === 'DROPOFFPOINT'
            &&  isset($arrArgDeliveryPoint['xett'])
        ) {
            unset($arrArgDeliveryPoint['pex']);
        } else {
            $arrArgDeliveryPoint = array();
        }

        $this->delivery_point = serialize($arrArgDeliveryPoint);

        // Create Pretashop order address for delivery point.
        $mxdNewIDAddressDelivery = $this->bindNewOrderAddressFromDeliveryPoint();

        if (!$this->save()) {
            return false;
        }

        return $mxdNewIDAddressDelivery;
    }

    /**
     * Get the corresponding XETT or PEX delivery point code.
     *
     * @return null|string
     */
    public function getDeliveryPointCode()
    {
        TNTOfficiel_Logstack::log();

        $arrDeliveryPoint = $this->getDeliveryPoint();
        $strDeliveryPointType = $this->getDeliveryPointType();

        if ($strDeliveryPointType !== null
            &&  array_key_exists($strDeliveryPointType, $arrDeliveryPoint)
        ) {
            return $arrDeliveryPoint[$strDeliveryPointType];
        }

        return null;
    }

    /**
     * Get the delivery point type (xett or pex).
     *
     * @return null|string
     */
    public function getDeliveryPointType()
    {
        TNTOfficiel_Logstack::log();

        $objTNTCarrierModel = $this->getTNTCarrierModel();
        if ($objTNTCarrierModel === null) {
            return null;
        }

        if ($objTNTCarrierModel->carrier_type === 'DEPOT') {
            return 'pex';
        } elseif ($objTNTCarrierModel->carrier_type === 'DROPOFFPOINT') {
            return 'xett';
        }

        return null;
    }

    /**
     * Create a new address from the current delivery point and assign it to the order as the delivery address.
     * Also copy corresponding receiver info.
     *
     * @return bool|int The new address ID used for Order. false if fail. true if no change needed.
     */
    private function bindNewOrderAddressFromDeliveryPoint()
    {
        TNTOfficiel_Logstack::log();

        // If no delivery point set yet.
        if ($this->getDeliveryPointCode() === null) {
            return true;
        }

        $arrArgDeliveryPoint = $this->getDeliveryPoint();

        $objPSOrder = TNTOfficielOrder::getPSOrder($this->id_order);
        if ($objPSOrder === null) {
            return false;
        }

        $objAddressNow = new Address($objPSOrder->id_address_delivery);
        $objAddressNew = new Address();
        // Int. Required.
        $objAddressNew->id_country = (int)Context::getContext()->country->id;
        // Int.
        $objAddressNew->id_customer = (int)$objAddressNow->id_customer;
        // Int.
        $objAddressNew->id_manufacturer = 0;
        // Int.
        $objAddressNew->id_supplier = 0;
        // Int.
        $objAddressNew->id_warehouse = 0;
        // Str 32. Required.
        $objAddressNew->alias = TNTOfficiel::MODULE_NAME;
        // Str 32. Required.
        $objAddressNew->lastname = $objAddressNow->lastname;
        // Str 32. Required.
        $objAddressNew->firstname = $objAddressNow->firstname;
        // Str 64.
        $objAddressNew->company = sprintf('%s - %s', $this->getDeliveryPointCode(), $arrArgDeliveryPoint['name']);

        // xett is DropOffPoint.
        if ($this->getDeliveryPointType() === 'xett') {
            // Str 128. Required.
            $objAddressNew->address1 = $arrArgDeliveryPoint['address'];
            // Str 128.
            $objAddressNew->address2 = '';
        } elseif ($this->getDeliveryPointType() === 'pex') {
            // Str 128. Required.
            $objAddressNew->address1 = $arrArgDeliveryPoint['address1'];
            // Str 128.
            $objAddressNew->address2 = $arrArgDeliveryPoint['address2'];
        }

        // Str 64.  Required.
        $objAddressNew->city = trim($arrArgDeliveryPoint['city']);
        // Str 12.
        $objAddressNew->postcode = trim($arrArgDeliveryPoint['postcode']);

        // Copy required fields if destination is empty.
        $arrAddressRequiredFields = $objAddressNew->getFieldsRequiredDatabase();
        if (is_array($arrAddressRequiredFields)) {
            foreach ($arrAddressRequiredFields as $arrRowItem) {
                $strFieldName = pSQL($arrRowItem['field_name']);
                if (is_object($objAddressNow) && property_exists($objAddressNow, $strFieldName)
                    && is_object($objAddressNew) && property_exists($objAddressNew, $strFieldName)
                    && Tools::isEmpty($objAddressNew->{$strFieldName})
                ) {
                    $objAddressNew->{$strFieldName} = $objAddressNow->{$strFieldName};
                }
            }
        }

        // Save.
        $objAddressNew->active = false;
        $objAddressNew->deleted = true;
        $objAddressNew->save();

        /*
         * Copy receiver to new address ID.
         */

        // Load TNT receiver info or create a new one for it's ID.
        $objTNTReceiverModelNow = TNTOfficielReceiver::loadAddressID($objAddressNow->id);
        $objTNTReceiverModelNew = TNTOfficielReceiver::loadAddressID($objAddressNew->id);
        // Validate and store receiver info, using old values.
        $objTNTReceiverModelNew->storeReceiverInfo(
            $objTNTReceiverModelNow->receiver_email,
            $objTNTReceiverModelNow->receiver_mobile,
            $objTNTReceiverModelNow->receiver_building,
            $objTNTReceiverModelNow->receiver_accesscode,
            $objTNTReceiverModelNow->receiver_floor,
            $objTNTReceiverModelNow->receiver_instructions
        );

        // Bind the new delivery address to the order.
        $objPSOrder->id_address_delivery = (int)$objAddressNew->id;

        if (!$objPSOrder->save()) {
            return false;
        }

        return (int)$objPSOrder->id_address_delivery;
    }

    /**
     * Check if process to save shipment is ok using :
     * - the saved pickup date
     * - or first available shipping date.
     * - $strArgPickupDate
     *
     * Then update shipping date in DB if available.
     *
     * @param string|null $strArgPickupDate (optional)
     *
     * @return array shippingDate and dueDate from feasibility if ok for shipment or error information..
     */
    public function updatePickupDate($strArgPickupDate = null)
    {
        TNTOfficiel_Logstack::log();

        $arrResult = array(
            'PickupDateRequest' => null,
            'boolIsRequestComError' => false,
            'strResponseMsgError' => null,
            'strResponseMsgWarning' => null
        );

        // If order has no expedition created.
        if (!$this->isExpeditionCreated()) {
            $strPickupDate = null;

            // If requested date.
            if (is_string($strArgPickupDate)) {
                // Check pickup date for apply.
                if (TNTOfficiel_Tools::getDateTimeFormat($strArgPickupDate) === null) {
                    $arrResult['strResponseMsgError'] = 'La date n\'est pas valide.';
                } elseif (!TNTOfficiel_Tools::isTodayOrTomorrow($strArgPickupDate)) {
                    $arrResult['strResponseMsgError'] = 'La date est déjà passée.';
                } elseif (!TNTOfficiel_Tools::isWeekDay($strArgPickupDate)) {
                    $arrResult['strResponseMsgError'] = 'La date n\'est pas valide le week-end.';
                } else {
                    $strPickupDate = $strArgPickupDate;
                }
            } elseif (TNTOfficiel_Tools::getDateTimeFormat($this->shipping_date) !== null) {
                // else use existing shipping date.
                $strPickupDate = $this->shipping_date;
            }

            // If no error and pickup date exist.
            if (!is_string($arrResult['strResponseMsgError'])
                && $strPickupDate !== null
            ) {
                $arrResult['PickupDateRequest'] = $strPickupDate;
                // Check the shipping date.
                $arrResult = array_merge($arrResult, $this->saveShipment($strPickupDate, true));
            }

            // Fallback if no requested date and no shipping date available.
            if (!is_string($strArgPickupDate)
                && (!array_key_exists('shippingDate', $arrResult)
                    || !array_key_exists('dueDate', $arrResult)
                )
            ) {
                // Unset previous error.
                $arrResult['strResponseMsgError'] = null;

                $objTNTCarrierAccountModel = $this->getTNTAccountModel();
                // If no account available for this carrier order.
                if ($objTNTCarrierAccountModel === null) {
                    $arrResult['strResponseMsgError'] = 'TNTOfficielAccount not found for Order ID #'.$this->id_order;
                } else {
                    // Try using the first available shipping date.
                    $arrResultPickup = $objTNTCarrierAccountModel->getPickupDate();
                    // If there is an error.
                    if (is_string($arrResultPickup['strResponseMsgError'])) {
                        $arrResult['strResponseMsgError'] = $arrResultPickup['strResponseMsgError'];
                    } else {
                        // Merge first available shipping date.
                        $arrResult = array_merge($arrResult, $this->saveShipment($arrResultPickup['pickupDate'], true));
                    }
                }
            }

            // If succeed, update.
            if (array_key_exists('shippingDate', $arrResult)
                && array_key_exists('dueDate', $arrResult)
            ) {
                // Update shipping & due date.
                $this->shipping_date = $arrResult['shippingDate'];
                $this->due_date = $arrResult['dueDate'];
            }

            $this->save();

            // If no shipping date set.
            if (TNTOfficiel_Tools::getDateTimeFormat($this->shipping_date) === null) {
                $arrResult['strResponseMsgWarning'] = 'Shipping date is missing';
            }
        }

        return $arrResult;
    }

    /**
     * Get the Total TTC to pay remaining,
     * taking into account the surplus paid on related orders (with the same references).
     *
     * @return float|null
     */
    public function getTotalToPayReal()
    {
        $objPSOrder = TNTOfficielOrder::getPSOrder($this->id_order);
        if ($objPSOrder === null) {
            return null;
        }

        $fltTotalInclTax = (float)$objPSOrder->total_paid_tax_incl;
        $fltTotalAllRelInclTax = (float)$objPSOrder->getOrdersTotalPaid();
        $fltTotalPaid = (float)$objPSOrder->total_paid_real;
        $fltTotalAllRelPaid = (float)$objPSOrder->getTotalPaid();

        $fltTotalToPay = $fltTotalInclTax - $fltTotalPaid;
        $fltTotalAllRelToPay = $fltTotalAllRelInclTax - $fltTotalAllRelPaid;

        $fltTotalAllRelToPayReal = max(min($fltTotalToPay, $fltTotalAllRelToPay), 0.0);

        return $fltTotalAllRelToPayReal;
    }

    /**
     * Check if a shipment was successfully done for an order.
     *
     * @return bool
     */
    public function isExpeditionCreated()
    {
        TNTOfficiel_Logstack::log();

        return (bool)$this->is_shipped;
    }

    /**
     * Creates the parcels model for an order using his product list.
     *
     * @return bool created or not.
     */
    public function createParcels()
    {
        TNTOfficiel_Logstack::log();

        // Get the parcels
        $arrObjTNTParcelModelList = $this->getTNTParcelModelList();

        // Already created.
        if (count($arrObjTNTParcelModelList) > 0) {
            // Nothing to do.
            return false;
        }

        // Load TNT cart model or create a new one for it's ID.
        $objTNTCartModel = $this->getTNTCartModel();
        // If fail.
        if ($objTNTCartModel === null) {
            // Nothing to do.
            return false;
        }

        $arrProductUnitList = $objTNTCartModel->getCartProductUnitList();

        // Load an existing TNT carrier.
        $objTNTCarrierModel = $this->getTNTCarrierModel();
        // If fail or carrier is not from TNT module.
        if ($objTNTCarrierModel === null) {
            // Nothing to do.
            return false;
        }

        $fltMaxParcelWeight = $objTNTCarrierModel->getMaxPackageWeight();


        // Init parcel list with one empty parcel.
        $arrParcelList = array(
            0.0
        );
        // Loop over each product.
        foreach ($arrProductUnitList as $arrProductUnit) {
            $boolProductAdded = false;
            // If no product weight.
            if ((float)$arrProductUnit['weight'] === 0.0) {
                // skip this one.
                continue;
            }
            // Loop over each parcel.
            foreach ($arrParcelList as /*$intParcelIndex =>*/ &$intParcelWeight) {
                // Check if parcel's weight exceeds the maximum parcel weight
                // Break the loop on parcel and loop again on product
                if ((($intParcelWeight + (float)$arrProductUnit['weight']) <= $fltMaxParcelWeight)
                    // If current parcel is empty, product weight out of range is added.
                    || $intParcelWeight === 0.0
                ) {
                    // Update the parcel's weight.
                    $intParcelWeight += $arrProductUnit['weight'];
                    $boolProductAdded = true;
                    break;
                }
            }
            unset($intParcelWeight);
            // If any product can't be added in the parcel.
            // We create another one and loop again on product
            if (!$boolProductAdded) {
                // add weight
                $arrParcelList[] = (float)$arrProductUnit['weight'];
            }
        }

        // Save the parcels in the database.
        foreach ($arrParcelList as $fltParcelWeight) {
            // Create a parcel.
            $objTNTParcelModel = TNTOfficielParcel::loadParcelID();
            if ($objTNTParcelModel !== null) {
                // Set order ID and weight.
                $objTNTParcelModel->updateParcel($this->id_order, $fltParcelWeight);
            }
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isUpdateParcelsStateAllowed()
    {
        // Get the parcels
        $arrObjTNTParcelModelList = $this->getTNTParcelModelList();
        foreach ($arrObjTNTParcelModelList as $objTNTParcelModel) {
            if (!$objTNTParcelModel->isTrackingFrozen()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get parcelRequest parameter for expeditionCreation.
     *
     * @return array.
     */
    public function getParcelRequest()
    {
        TNTOfficiel_Logstack::log();

        $arrParcelRequest = array();

        // Get the parcels
        $arrObjTNTParcelModelList = $this->getTNTParcelModelList();

        $strParcelCustomerReference = '';
        $objPSOrder = TNTOfficielOrder::getPSOrder($this->id_order);
        if ($objPSOrder !== null) {
            $strParcelCustomerReference = $objPSOrder->reference;
        }

        $intParcelItemNumber = 0;
        foreach ($arrObjTNTParcelModelList as $objTNTParcelModel) {
            ++$intParcelItemNumber;
            $arrParcelRequest[] = (object)array(
                'sequenceNumber' => $intParcelItemNumber,
                'customerReference' => Tools::substr($strParcelCustomerReference, 0, 10),
                'weight' => $objTNTParcelModel->weight, //floatval(str_replace(",", ".", $objTNTParcelModel->weight));
                //'insuranceAmount' => null,
                //'priorityGuarantee' => null,
            );
        }

        return $arrParcelRequest;
    }

    /**
     *
     * @param $strArgShippingDate
     * @param bool $boolArgChecking
     *
     * @return array|string
     */
    public function saveShipment($strArgShippingDate = null, $boolArgChecking = false)
    {
        TNTOfficiel_Logstack::log();

        // If order has expedition created.
        if ($this->isExpeditionCreated()) {
            if ($boolArgChecking !== true) {
                return array(
                    'boolIsRequestComError' => false,
                    'strResponseMsgError' => null
                );
            } else {
                return array(
                    'boolIsRequestComError' => false,
                    'strResponseMsgWarning' => 'Expedition is already created for Order ID #'.$this->id_order
                );
            }
        }

        $objPSOrder = TNTOfficielOrder::getPSOrder($this->id_order);
        if ($objPSOrder === null) {
            return array(
                'boolIsRequestComError' => false,
                'strResponseMsgError' => 'Order not found for Order ID #'.$this->id_order
            );
        }

        $objTNTCarrierModel = $this->getTNTCarrierModel();
        if ($objTNTCarrierModel === null) {
            return array(
                'boolIsRequestComError' => false,
                'strResponseMsgError' => 'TNTOfficielCarrier not found for Order ID #'.$this->id_order
            );
        }

        $objTNTCarrierAccountModel = $this->getTNTAccountModel();
        // If no account available for this carrier.
        if ($objTNTCarrierAccountModel === null) {
            return array(
                'boolIsRequestComError' => false,
                'strResponseMsgError' => 'TNTOfficielAccount not found for Order ID #'.$this->id_order
            );
        }

        $objPSAddressDelivery = $this->getPSAddressDelivery();
        // If no address available for this order.
        if ($objPSAddressDelivery === null) {
            return array(
                'boolIsRequestComError' => false,
                'strResponseMsgError' => 'Address not found for Address ID #'.$objPSOrder->id_address_delivery
            );
        }

        // Load TNT receiver info or create a new one for it's ID.
        $intAddressID = (int)$objPSOrder->id_address_delivery;
        $objTNTReceiverModel = TNTOfficielReceiver::loadAddressID($intAddressID, false);
        // If fail.
        if ($objTNTReceiverModel === null) {
            return array(
                'boolIsRequestComError' => false,
                'strResponseMsgError' => 'TNTOfficielReceiver not found for Address ID #'
                    .$objPSOrder->id_address_delivery
            );
        }

        // Do we have to send a pickup request for Occasional Pickup type ?
        $boolSendPickupRequest = true;
        // Get first available pickup date, etc. for Occasional Pickup
        // (depending on the city where the pickup will take place).
        $arrResultPickupOccasional = $objTNTCarrierAccountModel->getPickupDate();


        // Use saved order shipping date if none given.
        if ($strArgShippingDate === null) {
            $strArgShippingDate = $this->shipping_date;
        }
        // If requested shipping date is a valid date.
        if (TNTOfficiel_Tools::getDateTimeFormat($strArgShippingDate) !== null) {
            $strShippingDateRequested = $strArgShippingDate;
        } else {
            // else get shipping date default ...
            if ($objTNTCarrierAccountModel->isPickupTypeOccasional()) {
                // Use first available pickup date for Occasional Pickup.
                $strShippingDateRequested = $arrResultPickupOccasional['pickupDate'];
            } else {
                // Use current date for Regular Pickup.
                $strShippingDateRequested = date('Y-m-d');
            }
        }

        $strPickupDateFinal = $strShippingDateRequested;

        // check feasibility
        $strReceiverZipCode = trim($objPSAddressDelivery->postcode);
        $strReceiverCity = trim($objPSAddressDelivery->city);

        $strReceiverType = $objTNTCarrierModel->getReceiverType($objPSAddressDelivery);

        $arrFeasibilityListDateRequested = $objTNTCarrierModel->feasibility(
            $strReceiverZipCode,
            $strReceiverCity,
            $strShippingDateRequested,
            $strReceiverType
        );

        if ($objTNTCarrierAccountModel->isPickupTypeOccasional()) {
            /*
             * Occasional Pickup
             */

            // TODO : check availability on week-end.
            $arrFeasibilityListToday = $objTNTCarrierModel->feasibility(
                $strReceiverZipCode,
                $strReceiverCity,
                date('Y-m-d'),
                $strReceiverType
            );

            $strFirstShippingDateFeasibleToday = $arrFeasibilityListToday[0]['shippingDate'];

            // La date d'expédition demandée (pour la destination), n'est pas réalisable.
            if (count($arrFeasibilityListDateRequested) === 0
                && (
                    // la date d'expédition demandée est supérieure à la date d'expédition (du jour ou prochaine?).
                    $strShippingDateRequested > $strFirstShippingDateFeasibleToday ||
                    // la date d'expédition demandée n'est pas la prochaine date de rammassage possible pour la commune
                    // (donc pas possible pour la date demandée).
                    $arrResultPickupOccasional['pickupDate'] = !$strShippingDateRequested ||
                        // la date de ramassage demandée est déjà passée.
                        $strShippingDateRequested < date('Y-m-d')
                )
            ) {
                return array(
                    'boolIsRequestComError' => false,
                    'strResponseMsgError' =>
                        'La date saisie n\'est pas valide, merci de saisir une autre date d\'expédition.'
                );

                // la date d'expédition demandée est inférieure
                // à la date d'expédition d'expédition (du jour ou prochaine?).
            } elseif ($strShippingDateRequested < $strFirstShippingDateFeasibleToday
                || (
                    // la date d'expédition demandée est égale à
                    // la date d'expédition d'expédition (du jour ou prochaine?).
                    $strShippingDateRequested == $strFirstShippingDateFeasibleToday
                    // et que l'heure courante est supérieure
                    // à celle limite de ramassage (obtenue via WS SOAP).
                    && date('Hi') > $arrResultPickupOccasional['cutOffTime']
                )
            ) {
                $boolIsPickupDateRegistered = TNTOfficielPickup::isDateRegistered(
                    $objTNTCarrierModel->id_shop,
                    $objTNTCarrierAccountModel->account_number,
                    $strShippingDateRequested
                );

                // Requested shipping date is already a registered pickup date.
                if ($boolIsPickupDateRegistered) {
                    // so no need to send another pickup request.
                    $boolSendPickupRequest = false;
                    if ($boolArgChecking) {
                        return array(
                            'boolIsRequestComError' => false,
                            'strResponseMsgError' => null,
                            'strResponseMsgWarning' => 'Aucune nouvelle demande ramassage ne sera envoyée à TNT,'
                                .'vous devrez remettre le colis au chauffeur prévu ce jour.',
                            'dueDate' => $arrFeasibilityListDateRequested[0]['dueDate']
                        );
                    }
                } else {
                    return array(
                        'boolIsRequestComError' => false,
                        'strResponseMsgError' =>
                            'La date saisie n\'est pas valide, merci de saisir une autre date d\'expédition.'
                    );
                }
            }
        } else {
            /*
             * Regular Pickup
             */

            // If pickup date is before today.
            if ($strShippingDateRequested < date('Y-m-d')) {
                return array(
                    'boolIsRequestComError' => false,
                    'strResponseMsgError' =>
                        'La date saisie n\'est pas valide, merci de saisir une autre date d\'expédition.'
                );
            }
            // If pickup date is today but the current hour is greater than the driver time.
            if ($strShippingDateRequested == date('Y-m-d')
                && date('Hi') > $objTNTCarrierAccountModel->getPickupDriverTime()->format('Hi')
            ) {
                return array(
                    'boolIsRequestComError' => false,
                    'strResponseMsgError' => 'La date saisie n\'est pas valide, le chauffeur est déjà passé.'
                );
            }
        }


        if (count($arrFeasibilityListDateRequested) === 0) {
            // regular pickup case
            if (!$objTNTCarrierAccountModel->isPickupTypeOccasional() && $boolArgChecking !== true) {
                // check date +1
                $arrFeasibilityListDateRequested = $objTNTCarrierModel->feasibility(
                    $strReceiverZipCode,
                    $strReceiverCity,
                    date('Y-m-d', strtotime($strShippingDateRequested . ' + 1 DAY')),
                    $strReceiverType
                );
                if (count($arrFeasibilityListDateRequested) === 0) {
                    // check date +2
                    $arrFeasibilityListDateRequested = $objTNTCarrierModel->feasibility(
                        $strReceiverZipCode,
                        $strReceiverCity,
                        date('Y-m-d', strtotime($strShippingDateRequested . ' + 2 DAY')),
                        $strReceiverType
                    );
                    if (count($arrFeasibilityListDateRequested) === 0) {
                        // check date +3
                        $arrFeasibilityListDateRequested = $objTNTCarrierModel->feasibility(
                            $strReceiverZipCode,
                            $strReceiverCity,
                            date('Y-m-d', strtotime($strShippingDateRequested . ' + 3 DAY')),
                            $strReceiverType
                        );

                        if (count($arrFeasibilityListDateRequested) === 0) {
                            return array(
                                'boolIsRequestComError' => false,
                                'strResponseMsgError' => 'Error - It\'s not feasible'
                            );
                        }
                    }
                }

                // get new pickup date
                $strPickupDateFinal = $arrFeasibilityListDateRequested[0]['shippingDate'];
            } else {
                // occasional pickup case or check
                return array(
                    'boolIsRequestComError' => false,
                    'strResponseMsgError' =>
                        'La date saisie n\'est pas valide, merci de saisir une autre date d\'expédition.'
                );
            }
        }

        if ($boolArgChecking !== true) {
            // WS ExpeditionCreation TNT
            if (!$boolSendPickupRequest) {
                $strPickupDateFinal = $strShippingDateRequested;
            }

            $fltPaybackAmount = null;
            $arrAccountType = explode(' ', $objTNTCarrierModel->account_type);
            if (in_array('RP', $arrAccountType)) {
                $fltPaybackAmount = $this->getTotalToPayReal();
            }

            $strReceiverBuilding = $objTNTReceiverModel->receiver_building;
            $strReceiverAccessCode = $objTNTReceiverModel->receiver_accesscode;
            $strReceiverFloor = $objTNTReceiverModel->receiver_floor;
            $strReceiverInstructions = $objTNTReceiverModel->receiver_instructions;
            if (in_array($objTNTCarrierModel->account_type, array('LPSE ESSENTIEL'))) {
                $strReceiverBuilding = null;
                $strReceiverAccessCode = null;
                $strReceiverFloor = null;
            } else {
                $strReceiverInstructions = null;
                if ($objTNTCarrierModel->carrier_type !== 'INDIVIDUAL') {
                    $strReceiverBuilding = null;
                    $strReceiverAccessCode = null;
                    $strReceiverFloor = null;
                }
            }

            $arrResult = $objTNTCarrierAccountModel->expeditionCreation(
                $strReceiverType,
                $this->getDeliveryPointCode(),
                trim($objPSAddressDelivery->company),
                $objPSAddressDelivery->address1,
                $objPSAddressDelivery->address2,
                trim($objPSAddressDelivery->postcode),
                trim($objPSAddressDelivery->city),
                $objPSAddressDelivery->lastname,
                $objPSAddressDelivery->firstname,
                $objTNTReceiverModel->receiver_email,
                $objTNTReceiverModel->receiver_mobile,
                $strReceiverBuilding,
                $strReceiverAccessCode,
                $strReceiverFloor,
                $strReceiverInstructions,
                $objTNTCarrierModel->carrier_code1.$objTNTCarrierModel->carrier_code2,
                $strPickupDateFinal,
                $this->getParcelRequest(),
                $boolSendPickupRequest,
                $fltPaybackAmount
            );

            // If no communication error and no error message.
            if (!$arrResult['boolIsRequestComError'] && !is_string($arrResult['strResponseMsgError'])) {
                // If Occasional and a new pickup.
                if ($objTNTCarrierAccountModel->isPickupTypeOccasional() && $boolSendPickupRequest) {
                    // Keep expeditionCreation pickup date in memory for this account number.
                    $objTNTPickupModel = TNTOfficielPickup::loadPickupID();
                    if ($objTNTPickupModel !== null) {
                        $objTNTPickupModel->id_shop = $objTNTCarrierModel->id_shop;
                        $objTNTPickupModel->account_number = $objTNTCarrierAccountModel->account_number;
                        $objTNTPickupModel->pickup_date = $arrResult['pickupDate'];
                        $objTNTPickupModel->save();
                    }
                }

                // Load TNT label info or create a new one for it's ID.
                $objTNTLabelModel = TNTOfficielLabel::loadOrderID($this->id_order);
                if ($objTNTLabelModel !== null) {
                    // Save the BT content file in DB.
                    $boolLabelSaved = $objTNTLabelModel->addLabel(
                        sprintf('BT_%s_%s.pdf', $objPSOrder->reference, date('Y-m-d_H-i-s')),
                        $arrResult['PDFLabels'],
                        $objTNTCarrierAccountModel->pickup_label_type
                    );
                    // Flag TNT Order as shipped.
                    if ($boolLabelSaved) {
                        $this->is_shipped = true;
                        $this->save();
                    }
                }

                // Saves the tracking URL for each parcel.
                $arrObjTNTParcelModelList = $this->getTNTParcelModelList();

                $i = 0;
                foreach ($arrResult['parcelResponses'] as $objStdClassParcelItem) {
                    // Save first parcel number for Prestahop.
                    if ($i === 0) {
                        $objPSOrder->shipping_number = $objStdClassParcelItem->parcelNumber;
                        $objPSOrder->update();
                        // Update order_carrier.
                        $objPSOrderCarrier = new OrderCarrier((int)$objPSOrder->getIdOrderCarrier());
                        $objPSOrderCarrier->tracking_number = $objStdClassParcelItem->parcelNumber;
                        $objPSOrderCarrier->update();
                    }
                    $arrObjTNTParcelModelList[$i]->tracking_url = $objStdClassParcelItem->trackingURL;
                    $arrObjTNTParcelModelList[$i]->parcel_number = $objStdClassParcelItem->parcelNumber;
                    $arrObjTNTParcelModelList[$i]->save();
                    ++$i;
                }

                // Save Pickup Number.
                $this->pickup_number = (string)$arrResult['pickUpNumber'];
                $this->save();

                return array(
                    'boolIsRequestComError' => false,
                    'strResponseMsgError' => null,
                    'PDFLabels' => $arrResult['PDFLabels'],
                    'parcelResponses' => $arrResult['parcelResponses'],
                    'pickUpNumber' => $arrResult['pickUpNumber'],
                    'shippingDate' => $arrFeasibilityListDateRequested[0]['shippingDate'],
                    'dueDate' => $arrFeasibilityListDateRequested[0]['dueDate']
                );
            } else {
                return array(
                    'boolIsRequestComError' => $arrResult['boolIsRequestComError'],
                    'strResponseMsgError' => $arrResult['strResponseMsgError'],
                );
            }
        } else {
            return $arrFeasibilityListDateRequested[0];
        }
    }

    /**
     * Get and store the parcels tracking state for an order.
     *
     * @param int $intArgRefreshDelay 2 hours by default.
     *
     * @return bool. false if error.
     */
    public function updateParcelsTrackingState($intArgRefreshDelay = 7200)
    {
        TNTOfficiel_Logstack::log();

        $intOrderID = (int)$this->id_order;

        $boolResult = true;

        // Get the parcels
        $arrObjTNTParcelModelList = TNTOfficielParcel::searchOrderID($intOrderID);
        // Update tracking state.
        foreach ($arrObjTNTParcelModelList as $objTNTParcelModel) {
            // Update.
            $boolResult = ($boolResult && $objTNTParcelModel->updateTrackingState($intArgRefreshDelay));
        }

        return $boolResult;
    }

    /**
     * Add OrderState TNTOfficiel::ORDERSTATE_ALLDELIVERED to history if required.
     *
     * @param int $intArgRefreshDelay 2 hours by default.
     *
     * @return bool true if OrderState added.
     */
    public function updateOrderStateDeliveredParcels($intArgRefreshDelay = 7200)
    {
        TNTOfficiel_Logstack::log();

        // Update tracking state.
        $this->updateParcelsTrackingState($intArgRefreshDelay);

        $intOrderID = (int)$this->id_order;

        if (TNTOfficiel::ORDERSTATE_ALLDELIVERED === null) {
            return false;
        }

        $objPSOrder = TNTOfficielOrder::getPSOrder($intOrderID);
        if ($objPSOrder === null) {
            return false;
        }

        $boolIsAlreadyDelivered = count($objPSOrder->getHistory(
            (int)$objPSOrder->id_lang,
            Configuration::get(TNTOfficiel::ORDERSTATE_ALLDELIVERED)
        )) > 0;

        // If was not already delivered.
        if (!$boolIsAlreadyDelivered) {
            // Get the parcels model list for this order.
            $arrObjTNTParcelModelListforOrder = $this->getTNTParcelModelList();

            // Default is to do not treat as delivered if no parcel, else considered delivered.
            $boolAllParcelsDelivered = (count($arrObjTNTParcelModelListforOrder) > 0);
            // For each parcel.
            foreach ($arrObjTNTParcelModelListforOrder as $objTNTParcelModel) {
                // If a parcel is not delivered, all parcels are not.
                $boolAllParcelsDelivered = ($boolAllParcelsDelivered
                    && ($objTNTParcelModel->stage_id === TNTOfficielParcel::STAGE_DELIVERED)
                );
            }

            // If all parcels of this order is delivered.
            if ($boolAllParcelsDelivered) {
                // Add a new OrderState to the order history.
                $intOrderStateAllDelivered = (int)Configuration::get(TNTOfficiel::ORDERSTATE_ALLDELIVERED);
                $objOrderHistory = new OrderHistory();
                $objOrderHistory->id_order = $intOrderID;
                $objOrderHistory->changeIdOrderState($intOrderStateAllDelivered, $intOrderID);

                return $objOrderHistory->save();
            }
        }

        return false;
    }

    /**
     * Get Tracking URL for all parcels.
     *
     * @return null|string. null if no tracking url available (not a TNT carrier, not shipped or no parcel numbers).
     */
    public function getTrackingURL()
    {
        TNTOfficiel_Logstack::log();

        $strTrackingURL = null;

        // If order not found or not already shipped.
        if (!$this->isExpeditionCreated()) {
            return $strTrackingURL;
        }

        $arrParcelNumberList = array();

        // Get the parcels model list for this order.
        $arrObjTNTParcelModelList = $this->getTNTParcelModelList();
        // For each parcel.
        foreach ($arrObjTNTParcelModelList as $objTNTParcelModel) {
            //$objTNTParcelModel->tracking_url;
            if (is_string($objTNTParcelModel->parcel_number)
                && Tools::strlen($objTNTParcelModel->parcel_number) > 0
            ) {
                $arrParcelNumberList[] = $objTNTParcelModel->parcel_number;
            }
        }

        if (count($arrParcelNumberList) > 0) {
            $strTrackingURL = TNTOfficielParcel::TRACKING_URL.implode('%0d%0a', $arrParcelNumberList);
        }

        return $strTrackingURL;
    }
}
