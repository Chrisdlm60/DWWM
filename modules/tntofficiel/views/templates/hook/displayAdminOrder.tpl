{**
* TNT OFFICIAL MODULE FOR PRESTASHOP.
*
* @author    GFI Informatique <www.gfi.world>
* @copyright 2016-2020 GFI Informatique, 2016-2020 TNT
* @license   https://opensource.org/licenses/MIT MIT License
*}

<div class="row"><div class="col-lg-12">
<div id="TNTOfficelAdminOrdersViewOrder" class="panel">

    <div class="panel-heading">
        <i class="icon-tnt"></i>
        {l s='TNT' mod='tntofficiel'}
    </div>

    <div id="TNTOfficielOrderWellButton" class="well hidden-print">
        {if $isExpeditionCreated}
            <a class="btn btn-default"
               href="{$link->getAdminLink('AdminTNTOrders')|escape:'html':'UTF-8'}&amp;action=downloadBT&amp;id_order={$objPSOrder->id|intval}"
               title="{$strBTLabelName|escape:'html':'UTF-8'}"
               target="_blank"
            >
                <i class="icon-tnt"></i>
                {l s='TNT Transport Ticket' mod='tntofficiel'}
            </a>
        {else}
            <span class="span label label-inactive">
                <i class="icon-remove"></i>
                {l s='TNT Transport Ticket' mod='tntofficiel'}
            </span>
        {/if}
        &nbsp;
        <a class="btn btn-default"
           href="{$link->getAdminLink('AdminTNTOrders')|escape:'html':'UTF-8'}&amp;action=getManifest&amp;id_order={$objPSOrder->id|intval}"
           title="{l s='Manifest' mod='tntofficiel'}"
        >
            <i class="icon-tnt"></i>
            {l s='TNT Manifest' mod='tntofficiel'}
        </a>
        &nbsp;
        {if $isExpeditionCreated}
            <a class="btn btn-default"
               href="javascript:void(0);"
               onclick="window.open('{$link->getAdminLink('AdminTNTOrders')|escape:'html':'UTF-8'}&amp;action=tracking&amp;ajax=true&amp;orderId={$objPSOrder->id|intval}', 'Tracking', 'menubar=no, scrollbars=yes, top=100, left=100, width=900, height=600');"
            >
                <i class="icon-tnt"></i>
                {l s='TNT Tracking' mod='tntofficiel'}
            </a>
        {else}
            <span class="span label label-inactive">
                <i class="icon-remove"></i>
                {l s='TNT Tracking' mod='tntofficiel'}
            </span>
        {/if}
        &nbsp;
    </div>

    <div class="">
        <div class="row">
            <div id="TNTOfficielSection2" class="col-lg-7">
                {if $strDeliveryPointType !== null}
                    <div class="well">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="clearfix">
                                    <span class="TNTOfficiel_DPointLogo">
                                        {if $strDeliveryPointCode !== null}
                                            {l s='Code' mod='tntofficiel'}: <b>{$strDeliveryPointCode|escape:'htmlall':'UTF-8'}</b>
                                        {/if}
                                    </span>
                                    <span>
                                        {if !$isExpeditionCreated}
                                            <button type="button" class="btn button button-tntofficiel-small pull-right tntofficiel-shipping-method-info-select"><span><i class="icon-pencil"></i> &nbsp;{if $strDeliveryPointCode !== null}{l s='Change' mod='tntofficiel'}{else}{l s='Select' mod='tntofficiel'}{/if}</span></button>
                                        {/if}
                                        {if $strDeliveryPointCode !== null && $arrDeliveryPoint}
                                            <b>{$arrDeliveryPoint['name']|escape:'htmlall':'UTF-8'}</b><br />
                                            {if $strDeliveryPointType === 'xett'}
                                                {$arrDeliveryPoint['address']|escape:'htmlall':'UTF-8'}
                                            {else}
                                                {$arrDeliveryPoint['address1']|escape:'htmlall':'UTF-8'}<br />
                                                {$arrDeliveryPoint['address2']|escape:'htmlall':'UTF-8'}
                                            {/if}
                                            <br />
                                            {$arrDeliveryPoint['postcode']|escape:'htmlall':'UTF-8'} {$arrDeliveryPoint['city']|escape:'htmlall':'UTF-8'}<br />
                                            {l s='France' mod='tntofficiel'}
                                        {else}
                                            {* Smarty registered Prestashop methode AddressFormat::generateAddressSmarty() *}
                                            {displayAddressDetail address=$objPSAddressDelivery newLine='<br />'}
                                        {/if}
                                    </span>
                                </p>
                            </div>
                        </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-6">
                                    {if $strDeliveryPointCode !== null && $arrDeliveryPoint}
                                    <b>{l s='Schedules' mod='tntofficiel'} :</b><br />
                                    {foreach from=$arrDeliveryPoint['schedule'] key=day item=schedule}
                                        <span class="weekday">{l s=$day mod='tntofficiel'}:</span>
                                        {if !empty($schedule)}
                                            {assign var='i' value=0}
                                            {foreach from=$schedule item=part}
                                                <span>{' - '|implode:$part|escape:'htmlall':'UTF-8'}</span>
                                                {if ($schedule|@count) > 1 and $i < (($schedule|@count) -1)}
                                                    <span>{l s='and' mod='tntofficiel'}</span>
                                                {/if}
                                                {assign var='i' value=$i+1}
                                            {/foreach}
                                            <br />
                                        {else}
                                            <span>{l s='Closed' mod='tntofficiel'}</span>
                                            <br />
                                        {/if}
                                    {/foreach}
                                    {/if}
                                </div>
                                <div class="col-sm-6 hidden-print">
                                    <div id="map-delivery-point-canvas"></div>
                                </div>
                            </div>
                    </div>
                {/if}
            </div>
            <div id="TNTOfficielSection3" class="col-lg-5">
                <div id="extra_address_data" class="panel">
                    <div class="panel-heading">
                        <i class="icon-tnt"></i> {l s='TNT Additional Address' mod='tntofficiel'}
                    </div>
                    <div class="clearfix" data-validated="true">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="receiver_email">{l s='Email' mod='tntofficiel'}</label>
                                {* Email *}
                                <input class="form-control" type="text" id="receiver_email" name="receiver_email" value="{$arrFormReceiverInfoValidate.fields.receiver_email|escape:'htmlall':'UTF-8'}" {if $isExpeditionCreated}disabled="disabled"{/if} />
                                {if $arrFormReceiverInfoValidate.fields.receiver_email && array_key_exists('receiver_email', $arrFormReceiverInfoValidate.errors)}
                                    <div class="form-text alert-danger error-receiver_email">{$arrFormReceiverInfoValidate.errors.receiver_email|escape:'htmlall':'UTF-8'}<span class="tiles"></span></div>
                                {/if}
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="receiver_mobile">{l s='Cellphone' mod='tntofficiel'}</label>
                                {* Téléphone portable *}
                                <input class="form-control" type="tel" id="receiver_mobile" name="receiver_mobile" value="{$arrFormReceiverInfoValidate.fields.receiver_mobile|escape:'htmlall':'UTF-8'}" {if $isExpeditionCreated}disabled="disabled"{/if} />
                                {if $arrFormReceiverInfoValidate.fields.receiver_mobile && array_key_exists('receiver_mobile', $arrFormReceiverInfoValidate.errors)}
                                    <div class="form-text alert-danger error-receiver_mobile">{$arrFormReceiverInfoValidate.errors.receiver_mobile|escape:'htmlall':'UTF-8'}<span class="tiles"></span></div>
                                {/if}
                            </div>
                        </div>
                        {if !$isExpeditionCreated}
                            <a id="submitAddressExtraData" class="btn button button-tntofficiel-small pull-right">
                                <span>{l s='Validate' mod='tntofficiel'}</span>
                            </a>
                        {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="">
        <div class="row">
            <div class="col-lg-7">

                {include '../admin/displayAjaxUpdateOrderStateDeliveredParcels.tpl' isExpeditionCreated=$isExpeditionCreated strPickUpNumber=$strPickUpNumber arrObjTNTParcelModelList=$arrObjTNTParcelModelList}

            </div>
            <div class="col-lg-5">

                <div id="formAdminShippingDatePanel" class="panel">
                    <div class="panel-heading">
                        <i class="icon-calendar"></i>
                        {l s='Shipping date' mod='tntofficiel'}
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="parcelsTable">
                            <thead>
                            <tr>
                                <th><span class="title_box ">{l s='Shipping date' mod='tntofficiel'}</span></th>
                                <th><span class="title_box ">{l s='Due date' mod='tntofficiel'}</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="input-group fixed-width-xl" style="float:left;margin-right:3px;">
                                        <input type="text" name="shipping_date" id="shipping_date" value="">
                                        <span class="input-group-addon">
                                            <i class="icon-calendar-empty"></i>
                                        </span>
                                    </div>
                                    <div id="delivery-date-error" class="input-group" style="display: none">
                                        <div class="alert alert-danger alert-danger-small">
                                            <p>{l s='La date n\'est pas valide' mod='tntofficiel'}</p>
                                        </div>
                                    </div>
                                    <div id="delivery-date-success" class="input-group" style="display: none">
                                        <div class="alert alert-success alert-danger-small">
                                            <p>{l s='La date est valide' mod='tntofficiel'}</p>
                                        </div>
                                    </div>
                                </td>
                                <td id="due-date">
                                    {$dueDate|escape:'htmlall':'UTF-8'}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</div></div>

<script type="text/javascript">

    // On DOM Ready.
    //window.document.addEventListener('DOMContentLoaded', 
    (function () {

        {literal}
        window.TNTOfficiel.order.isTNT = true;
        window.TNTOfficiel.order.isExpeditionCreated = {/literal}{if $isExpeditionCreated}true{else}false{/if}{literal};
        window.TNTOfficiel.order.intOrderID = {/literal}{$objPSOrder->id|intval|escape:'javascript':'UTF-8'}{literal};
        window.TNTOfficiel.order.intCarrierID = {/literal}{$objPSOrder->id_carrier|intval|escape:'javascript':'UTF-8'}{literal};
        window.TNTOfficiel.order.isCarrierDeliveryPoint = {/literal}{if $strDeliveryPointType !== null}true{else}false{/if}{literal};
        {/literal}

        window.startDateAdminOrder = 0;
    {if $intTSFirstAvailableDate}
        window.startDateAdminOrder = new Date("{$intTSFirstAvailableDate|escape:'javascript':'UTF-8'}"*1000);
    {/if}
    {if $intTSShippingDate}
        window.shippingDateAdminOrder = new Date("{$intTSShippingDate|escape:'javascript':'UTF-8'}"*1000);
    {/if}

    })();

</script>