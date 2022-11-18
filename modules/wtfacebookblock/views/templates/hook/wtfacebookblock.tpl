{*
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $facebookurl != ''}
<div id="footer-block-facebook" class="block-contact col-md-4 links wrapper">
<h3 class="h3 hidden-sm-down">{l s='Facebook' d='Modules.WTFacebookBlock'}</h3>
	<div class="title clearfix hidden-md-up collapsed" data-target="#facebook_block" data-toggle="collapse" aria-expanded="false">
        <span class="h3">{l s='Facebook' d='Modules.WTFacebookBlock'}</span>
        <span class="pull-xs-right">
          <span class="navbar-toggler collapse-icons">
            <i class="material-icons add"></i>
            <i class="material-icons remove"></i>
          </span>
        </span>
      </div>
<div id="fb-root"></div>
<div id="facebook_block" class="collapse" aria-expanded="false">
	<div class="facebook-fanbox">
		<div class="fb-like-box" data-href="{$facebookurl|escape:'html':'UTF-8'}" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false">
		</div>
	</div>
</div>
</div>
{/if}
