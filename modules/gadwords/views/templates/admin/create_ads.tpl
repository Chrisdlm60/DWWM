{*
 * 2007-2020 PrestaShop.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}

<div class="create_ads panel col-lg-10 col-lg-offset-1">
    <div class="activate_ads col-lg-10 col-lg-offset-1">
        <div class="col-lg-2">
            <img src="{$module_dir|escape:'html':'UTF-8'}views/img/target_img.png" alt="{l s='Google AdWords' mod='gadwords'}"/>
        </div>
        <div class="col-lg-7">
            <p>{l s='Start advertising on Google with the PrestaShop Ads module, get up to 120€ in ad credit.' mod='gadwords'}</p>
        </div>
        <div id="gadwords_action-btn" class="col-lg-2 col-lg-offset-1">
            <div class="loader"></div>
            <a href="{$moduleLink|escape:'html':'UTF-8'}" class="btn btn-primary" {if false === $modulePrestashopAdsInstalled}style="display:none;"{/if}>
                {l s='Activate PrestaShop Ads' mod='gadwords'}
            </a>
            {if false === $modulePrestashopAdsInstalled}
                <span id="gadwords_installmodule" class="btn btn-primary">{l s='Activate PrestaShop Ads' mod='gadwords'}</span>
            {/if}
        </div>
    </div>
</div>
