{*
* 2007-2018 PrestaShop
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
*  @copyright  2007-2018 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if $wt_thumbnails}
	<div class="thumbs-content">
		<a id="view_scroll_left{$wt_thumbnails_key|escape:'html':'UTF-8'}" class="button-arrow-vertical-thumb prev {if isset($wt_thumbnails) && count($wt_thumbnails) <= 4}hidden{/if}" href="javascript:{}" title="Other views" rel="11"><i class="icon-chevron-up"></i></a>
		<div id="thumbs_list{$wt_thumbnails_key|escape:'html':'UTF-8'}" class="thumbs_list {if isset($wt_thumbnails) && count($wt_thumbnails) > 3}show_sroll{/if}">
			<ul id="thumbs_list_frame{$wt_thumbnails_key|escape:'html':'UTF-8'}" class="thumbs_list_frame" name="thumb-images-special-{$product.id_product|intval}">
				{foreach from=$wt_thumbnails item=image name=thumbnails}
					{assign var=imageIds value="`$product.id_product`-`$image.id_image`"}
					{if !empty($image.legend)}
						{assign var=imageTitle value=$image.legend|escape:'html':'UTF-8'}
					{else}
						{assign var=imageTitle value=$product.name|escape:'html':'UTF-8'}
					{/if}
					<li id="thumbnail{$wt_thumbnails_key|escape:'html':'UTF-8'}_{$image.id_image|escape:'html':'UTF-8'}"{if $smarty.foreach.thumbnails.last} class="last"{/if}>
						<a wt_rel="prettyPhoto[thumb-images-special-{$product.id_product|intval}]"
							href="{$link->getImageLink($product.link_rewrite, $imageIds, 'large_default')|escape:'html':'UTF-8'}"
							data-fancybox-group="other-views-{$product.id_product|intval}" tv-img-src="{$link->getImageLink($product.link_rewrite, $imageIds, 'large_default')|escape:'html':'UTF-8'}"
							class="fancybox image_hoverwashe"
							title="{$imageTitle|escape:'quotes':'UTF-8'}">

							<img class="img-responsive lazy lazy_ajax" id="thumb_{$product.id_product|intval}_{$image.id_image|escape:'html':'UTF-8'}" data-original="{$link->getImageLink($product.link_rewrite, $imageIds, 'small_default')|escape:'html':'UTF-8'}" src="{$path_ssl|escape:'html':'UTF-8'}modules/wtproductcategory/views/img/empty-lazy.gif" alt="{$imageTitle|escape:'html':'UTF-8'}" title="{$imageTitle|escape:'html':'UTF-8'}" itemprop="image" />
						<span class="hover_bkg_light"></span>
						</a>
					</li>
				{/foreach}
			</ul>
		</div>
		<a id="view_scroll_right{$wt_thumbnails_key|escape:'html':'UTF-8'}" class="button-arrow-vertical-thumb next {if isset($wt_thumbnails) && count($wt_thumbnails) <= 4}hidden{/if}" href="javascript:{}" title="Other views" rel="11"><i class="icon-chevron-down"></i></a>
</div>
		
{/if}