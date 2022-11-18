<?php

/**
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

class SampleDataHtml
{
	public function initData($base_url)
	{
		$content_block1 = '<div id="social_block_nav">
								<ul>
								<li class="facebook"><a class="_blank" href="http://www.facebook.com/prestashop" target="_blank"> <span>Facebook</span> </a></li>
								<li class="twitter"><a class="_blank" href="http://www.twitter.com/prestashop" target="_blank"> <span>Twitter</span> </a></li>
								<li class="rss"><a class="_blank" href="http://www.prestashop.com/blog/en/" target="_blank"> <span>RSS</span> </a></li>
								<li class="google-plus"><a class="_blank" href="https://www.google.com/+prestashop" rel="publisher" target="_blank"> <span>Google Plus</span> </a></li>
								</ul>
								</div>';

		$content_block2 = '<div class="nav-shipping-map">
							<div class="free-shipping"><span>Free shipping order from $500</span></div>
							<div class="map"><a href="#" onclick="displayMap();return false;"><span>map store location</span></a>
							<div style="display: none;" id="frame_map"><iframe width="300" height="150" style="height: 500px; width: 100%; border: 0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=24+Rue+Berger,+75001+Paris&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div>
							</div>
							</div>';

		$content_block3 = '<div class="right-contact-top">
							<p class="support"><span>Support 24/7</span> (+84) 0982 982 981</p>
							<p class="email">Email: support@ourstore.com</p>
							</div>';

		$content_block4 = '<div class="home-top-banner">
								<div class="banner col-xs-12 col-sm-4">
								<p><img src="{static_block_url}themes/wt_omartsimple/assets/img/cms/banner1.jpg" alt="" /></p>
								<div class="text banner1">
								<h2>headphone</h2>
								<h4>$99.00 -$299.00</h4>
								<a href="#" class="show-now">View More</a></div>
								</div>
								<div class="banner col-xs-12 col-sm-4">
								<p><img src="{static_block_url}themes/wt_omartsimple/assets/img/cms/banner2.jpg" alt="" /></p>
								<div class="text banner2">
								<h2>Camera</h2>
								<h4>sale of 10%</h4>
								<a href="#" class="show-now">View More</a></div>
								</div>
								<div class="banner col-xs-12 col-sm-4">
								<p><img src="{static_block_url}themes/wt_omartsimple/assets/img/cms/banner3.jpg" alt="" /></p>
								<div class="text banner3">
								<h2>iphone7</h2>
								<h4>picture perfect</h4>
								<a href="#" class="show-now">View More</a></div>
								</div>
								</div>';

		$content_block5 = '<div class="home-center-banner-1 col-xs-12 col-sm-12">
								<div class="image"><img src="{static_block_url}themes/wt_omartsimple/assets/img/cms/bannercenter.jpg" alt="" /></div>
								<div class="text">
								<h1>cat ear headphone</h1>
								<p>The innovative anime-inspired headphones will come with fully functional external cat ear speakers, LED lights, detachable cord,comfortable over-the-ears cushioning and rechargeable batteries.</p>
								</div>
								</div>';


		$content_block6 = '<div class="banner-bottom-home">
							<div class="banner left col-xs-12 col-sm-6">
							<p><img src="{static_block_url}themes/wt_omartsimple/assets/img/cms/banner-bottom1.jpg" alt="" /></p>
							<div class="text-left">
							<h3>sale and free</h3>
							<h1>case</h1>
							<h2>t-Phone</h2>
							<a href="#">view more</a></div>
							</div>
							<div class="banner-right col-xs-12 col-sm-6">
							<div class="banner right-top col-xs-12 col-sm-12">
							<p><img src="{static_block_url}themes/wt_omartsimple/assets/img/cms/banner-bottom2.jpg" alt="" /></p>
							<div class="text-right">
							<h2>Hphone</h2>
							<h3>more models more gifts</h3>
							</div>
							</div>
							<div class="banner left-b col-xs-6 col-sm-6">
							<p><img src="{static_block_url}themes/wt_omartsimple/assets/img/cms/banner-bottom.jpg" alt="" /></p>
							</div>
							<div class="banner right-b col-xs-6 col-sm-6">
							<p><img src="{static_block_url}themes/wt_omartsimple/assets/img/cms/banner-bottom3.jpg" alt="" /></p>
							</div>
							</div>
							</div>';

		$content_block7 = '<div class="wt-bottom-footer">
				<p class="copyright">© 2016 Megastore Shop Fashion Theme by<a href="#" target="_blank">Waterthemes</a>. All Rights Reserved.</p>
				<div class="payment">
				<a href="#"><img title="Omartsimple theme" src="{static_block_url}themes/wt_omartsimple/assets/img/cms/paypal.png" alt="" /> </a> 
				<a href="#"><img title="Omartsimple theme" src="{static_block_url}themes/wt_omartsimple/assets/img/cms/visa.png" alt="" /> </a> 
				<a href="#"><img title="Omartsimple theme" src="{static_block_url}themes/wt_omartsimple/assets/img/cms/express.png" alt="" /> </a> 
				<a href="#"><img title="Omartsimple theme" src="{static_block_url}themes/wt_omartsimple/assets/img/cms/mastercard.png" alt="" /> </a>
				</div>
				</div>';

		$content_block8 = '<div class="image">
								<a href="#"><img src="' . $base_url . 'themes/wt_omartsimple/assets/img/cms/banner-left.jpg" alt="" /></a>
								</div>';


		$displayNav = Hook::getIdByName('displayNav1');
		$displayLeftLogo = Hook::getIdByName('displayLeftLogo');
		$displayRightLogo = Hook::getIdByName('displayRightLogo');
		$displayRightSlider = Hook::getIdByName('displayRightSlider');
		$displayTopHome = Hook::getIdByName('displayTopHome');
		$displayHome = Hook::getIdByName('displayHome');
		$displayLeftColumn = Hook::getIdByName('displayLeftColumn');
		$displayBannerCategory = Hook::getIdByName('displayBannerCategory');

		$id_shop = Configuration::get('PS_SHOP_DEFAULT');

		/*install static Block*/
		$result = true;
		$result &= Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'wtcustomhtml` (`id_wtcustomhtml`, `hook`, `active`) 
			VALUES
			(1, "displayNav1", 1),
			(2, "displayNav2", 1),
			(3, "displayTop", 1),
			(4, "displayTopHome", 1),
			(5, "displayCenterHome", 1),
			(6, "displayBottomHome", 1),
			(7, "displayBottomFooter", 1),
			(8, "displayLeftColumn", 1);');

		$result &= Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'wtcustomhtml_shop` (`id_wtcustomhtml`, `id_shop`,`active`) 
			VALUES 
			(1,' . $id_shop . ', 1),
			(2,' . $id_shop . ', 1),
			(3,' . $id_shop . ', 1),
			(4,' . $id_shop . ', 1),
			(5,' . $id_shop . ', 1),
			(6,' . $id_shop . ', 1),
			(7,' . $id_shop . ', 1),
			(8,' . $id_shop . ', 1);');

		foreach (Language::getLanguages(false) as $lang) {
			$result &= Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'wtcustomhtml_lang` (`id_wtcustomhtml`, `id_shop`, `id_lang`, `title`, `content`) 
			VALUES 
			( "1", "' . $id_shop . '","' . $lang['id_lang'] . '","Social Top Nav", \'' . $content_block1 . '\'),
			( "2", "' . $id_shop . '","' . $lang['id_lang'] . '","Map and Shipping", \'' . $content_block2 . '\'),
			( "3", "' . $id_shop . '","' . $lang['id_lang'] . '","Right Contact Top", \'' . $content_block3 . '\'),
			( "4", "' . $id_shop . '","' . $lang['id_lang'] . '","Banner Center Top Home", \'' . $content_block4 . '\'),
			( "5", "' . $id_shop . '","' . $lang['id_lang'] . '","Banner Center Home", \'' . $content_block5 . '\'),
			( "6", "' . $id_shop . '","' . $lang['id_lang'] . '","Banner Bottom Home", \'' . $content_block6 . '\'),
			( "7", "' . $id_shop . '","' . $lang['id_lang'] . '","CopyRight And Payment", \'' . $content_block7 . '\'),
			( "8", "' . $id_shop . '","' . $lang['id_lang'] . '","Banner Left Column", \'' . $content_block8 . '\');');
		}
		return $result;
	}
}
