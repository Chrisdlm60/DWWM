{**

 * 2007-2016 PrestaShop

 *

 * NOTICE OF LICENSE

 *

 * This source file is subject to the Open Software License (OSL 3.0)

 * that is bundled with this package in the file LICENSE.txt.

 * It is also available through the world-wide-web at this URL:

 * http://opensource.org/licenses/osl-3.0.php

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

 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)

 * International Registered Trademark & Property of PrestaShop SA

 *}

{if $product.reference|substr:0:4=='DEV-'}
    <div class="add">
        <a class="btn btn-primary" href="{*$link->getPageLink('contact',true)*}index.php?controller=contactform&purl={if isset($smarty.server.HTTPS)}https://{else}http://{/if}{$smarty.server.HTTP_HOST}{$smarty.server.REQUEST_URI}&pname={$product.name}">{l s='Demander un devis' d='Shop.Theme.Actions'}</a>
    </div>
    <br/>
{/if}

<div class="product-add-to-cart">

  {if !$configuration.is_catalog}

    <span class="control-label"  {if $category->name == "Nos Partenaires"}style="display:none"{/if}>{l s='Quantity' d='Shop.Theme.Catalog'}</span> 

    {block name='product_quantity'}

    

      <div class="product-quantity"  {if $product.reference|substr:0:4=='DEV-' || $category->name == 'Nos Partenaires'}style="display:none"{/if}>

        <div class="qty">

          <input

            type="text"

            name="qty"

            id="quantity_wanted"

            value="{$product.quantity_wanted}"

            class="input-group"

            min="{$product.minimal_quantity}"

          />

        </div>

        <div class="add">

          <button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit" {if !$product.add_to_cart_url || $product.quantity_wanted>$product.quantity}disabled{/if}>

            <i class="material-icons shopping-cart">&#xE547;</i>

            {l s='Add to cart' d='Shop.Theme.Actions'}

          </button>

          {block name='product_availability'}

            <span id="product-availability">

              {if $product.show_availability && $product.availability_message}

                {if $product.availability == 'available'}

                  <i class="material-icons product-available">&#xE5CA;</i>

                {elseif $product.availability == 'last_remaining_items'}

                  <i class="material-icons product-last-items">&#xE002;</i>

                {else}

                  <i class="material-icons product-unavailable">&#xE14B;</i>

                {/if}

                {$product.availability_message}

              {/if}

            </span>

          {/block}

        </div>

      </div>

      <div class="clearfix"></div>

    {/block}



    {block name='product_minimal_quantity'}

      <p class="product-minimal-quantity">

        {if $product.minimal_quantity > 1}

          {l

          s='The minimum purchase order quantity for the product is %quantity%.'

          d='Shop.Theme.Checkout'

          sprintf=['%quantity%' => $product.minimal_quantity]

          }

        {/if}

      </p>

    {/block}

  {/if}

</div>

