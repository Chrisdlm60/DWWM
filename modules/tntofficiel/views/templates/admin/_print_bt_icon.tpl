{**
* TNT OFFICIAL MODULE FOR PRESTASHOP.
*
* @author    GFI Informatique <www.gfi.world>
* @copyright 2016-2020 GFI Informatique, 2016-2020 TNT
* @license   https://opensource.org/licenses/MIT MIT License
*}

<span class="btn-group-action">
    <span class="btn-group">
        <a class="btn btn-default _blank {if ($strBTLabelName == '')}disabled{/if}"
           href="{$link->getAdminLink('AdminTNTOrders')|escape:'html':'UTF-8'}&amp;action=downloadBT&amp;id_order={$intOrderID|intval}"
           target="_blank"
           rel="tooltip"
           title="{$strBTLabelName|escape:'html':'UTF-8'}"
        >
            <i class="icon-tnt"></i>
        </a>
        <a class="btn btn-default _blank"
           href="{$link->getAdminLink('AdminTNTOrders')|escape:'html':'UTF-8'}&amp;action=getManifest&amp;id_order={$intOrderID|intval}"
           rel="tooltip"
           title="{l s='Manifest' mod='tntofficiel'}"
        >
            <i class="icon-file-text"></i>
        </a>
    </span>
</span>
