{*
* 2007-2019 PrestaShop
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
*  @copyright  2007-2019 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if count($subcategories) > 0}
<div id="wt_subcategory" class="wt_subcategory card">
<h1>{l s='Sub Categories' d='Shop.Waterthemes'} </h1>
					
					  <div id="subcategory_list" class="subcategory_list">
						{foreach from = $subcategories item=sub_cat name=sub_cat_info}
							<div class="item ajax_block_product">
								<a href="{$link->getCategoryLink($sub_cat.id_category, $sub_cat.link_rewrite)|escape:'html':'UTF-8'}" title="{$sub_cat.name|escape:'html':'UTF-8'}">
								
								{if $sub_cat.id_image && $sub_cat.cat_thumb == 1}
									<img src="{$path_ssl|escape:'html':'UTF-8'}img/c/{$sub_cat.id_category|intval}_thumb.jpg" alt=""/>
								{else}
									<img class="replace-2x" src="{$path_ssl|escape:'html':'UTF-8'}img/c/{$iso_code|escape:'html':'UTF-8'}.jpg" alt=""/>
								{/if}
								</a>
								<a class="subcat-name" href="{$link->getCategoryLink($sub_cat.id_category, $sub_cat.link_rewrite)|escape:'html':'UTF-8'}" title="{$sub_cat.name|escape:'html':'UTF-8'}">{$sub_cat.name|escape}
								
								</a>
							</div>
						{/foreach}
					</div>
					



</div>
{/if}