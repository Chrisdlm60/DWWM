{*
* 2007-2016 PrestaShop
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
*  @copyright  2007-2016 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if isset($banners)}
<!-- MODULE Block banner -->
<div class="wt-block-testimonial col-sm-4 links ">
			<div class="wrapper"><h3 class="h3 hidden-sm-down">{l s='Testimonials' mod='wttestimonial'}</h3></div>
	<div class="container{if $testimonial_config->used_slider == 0} no-slider{/if}">
		<div class="{if $testimonial_config->used_slider == 0} wt-{$testimonial_config->number_banner_aline|escape:'html':'UTF-8'}-items-aline{/if}">
		
			<div id="wt_testimonial_content" class="container-list testimonial-content">
			{foreach from=$banners item=banner name=banners}
				<div class="item ajax_block_product">
					<div class="testimonial-img-author">
					<a href="{$banner.link|escape:'html':'UTF-8'}" title="{$banner.title|escape:'html':'UTF-8'}">
						<img class="owl-lazy" data-src="{$module_dir|escape:'html':'UTF-8'}views/img/{$banner.file_name|escape:'html':'UTF-8'}" src="{$path_ssl|escape:'html':'UTF-8'}modules/wtproductcategory/views/img/empty-lazy.gif" alt="{$banner.title|escape:'html':'UTF-8'}" />
					</a>
					</div>
					<div class="testimonial-text">
						{if isset($banner.text)}{$banner.text|escape:'quotes':'UTF-8' nofilter}{/if}
					</div>
				</div>
			{/foreach}
			</div>
		</div>
	</div>
</div>

<!-- /MODULE Block banner -->
{/if}