{**
* TNT OFFICIAL MODULE FOR PRESTASHOP.
*
* @author    GFI Informatique <www.gfi.world>
* @copyright 2016-2020 GFI Informatique, 2016-2020 TNT
* @license   https://opensource.org/licenses/MIT MIT License
*}

{if !$boolCityPostCodeIsValid}
<div class="tntofficiel-box-panel clearfix" id="noTNTCarrierWarning">
    <a href="{$link->getPageLink('address', true)|escape:'html':'UTF-8'}?id_address={$id_address_delivery|intval}&amp;back=order.php"
       class="btn button button-tntofficiel-small pull-right"><span>{l s='Validate my address' mod='tntofficiel'} <i class="icon-chevron-right right"></i> </span></a>
    <span style="font-size: 1.1em;line-height: 2em;">{l s='To view all delivery options, please verify the postal code and city of your delivery address.' mod='tntofficiel'}</span>
</div>
<br />
{/if}

{if $strTNTPaymentReadyError}
<div class="row">
    <p class="alert alert-danger">{TNTOfficiel::CARRIER_NAME|escape:'htmlall':'UTF-8'} : {$strTNTPaymentReadyError|escape:'htmlall':'UTF-8'}</p>
</div>
{/if}

<script type="text/javascript">
{literal}

    // On DOM Ready.
    window.document.addEventListener('DOMContentLoaded', function () {

        window.strTNTOfficieljQSelectorInputRadioTNT = jQuery.map(window.TNTOfficiel.carrier.list, function (value, id_carrier) {
            return '.delivery-option input:radio[value^="' + id_carrier + ',"]';
        }).join(', ');

        // Flag.
        jQuery.extend(true, window.TNTOfficiel, {
            "cart": {
                "isCarrierListDisplay": true
            }
        });

    });

{/literal}
</script>