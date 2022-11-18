<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-10 14:15:51
  from '/htdocs/prestarecup/themes/tech/templates/catalog/_partials/product-add-to-cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6048c6870cfb25_80451748',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83d8215a8231ec5fdd8624f1fd09c6596ed0467f' => 
    array (
      0 => '/htdocs/prestarecup/themes/tech/templates/catalog/_partials/product-add-to-cart.tpl',
      1 => 1615381867,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6048c6870cfb25_80451748 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<div class="product-add-to-cart">

  <?php if (substr($_smarty_tpl->tpl_vars['product']->value['reference'],0,4) == 'DEV-') {?>
    <div class="add">
        <a class="btn btn-primary" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8');?>
index.php?controller=contact-form&purl=<?php if (isset($_SERVER['HTTPS'])) {?>https://<?php } else { ?>http://<?php }
echo htmlspecialchars($_SERVER['HTTP_HOST'], ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');?>
&pname=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Demander un devis','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</a>
    </div>
    <br/>
    <?php }?>

  <?php if (!$_smarty_tpl->tpl_vars['configuration']->value['is_catalog']) {?>

    <span class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4719272396048c6870c5dc0_62938025', 'product_quantity');
?>




    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20354537406048c6870cd642_13752040', 'product_minimal_quantity');
?>


  <?php }?>

</div>

<?php }
/* {block 'product_availability'} */
class Block_804138606048c6870c9d37_64305725 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


            <span id="product-availability">

              <?php if ($_smarty_tpl->tpl_vars['product']->value['show_availability'] && $_smarty_tpl->tpl_vars['product']->value['availability_message']) {?>

                <?php if ($_smarty_tpl->tpl_vars['product']->value['availability'] == 'available') {?>

                  <i class="material-icons product-available">&#xE5CA;</i>

                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['availability'] == 'last_remaining_items') {?>

                  <i class="material-icons product-last-items">&#xE002;</i>

                <?php } else { ?>

                  <i class="material-icons product-unavailable">&#xE14B;</i>

                <?php }?>

                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['availability_message'], ENT_QUOTES, 'UTF-8');?>


              <?php }?>

            </span>

          <?php
}
}
/* {/block 'product_availability'} */
/* {block 'product_quantity'} */
class Block_4719272396048c6870c5dc0_62938025 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_quantity' => 
  array (
    0 => 'Block_4719272396048c6870c5dc0_62938025',
  ),
  'product_availability' => 
  array (
    0 => 'Block_804138606048c6870c9d37_64305725',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <div class="product-quantity" <?php if (substr($_smarty_tpl->tpl_vars['product']->value['reference'],0,4) == 'DEV-') {?>style="display:none"<?php }?>>

        <div class="qty">

          <input

            type="text"

            name="qty"

            id="quantity_wanted"

            value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['quantity_wanted'], ENT_QUOTES, 'UTF-8');?>
"

            class="input-group"

            min="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'], ENT_QUOTES, 'UTF-8');?>
"

          />

        </div>

        <div class="add">

          <button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit" <?php if (!$_smarty_tpl->tpl_vars['product']->value['add_to_cart_url'] || $_smarty_tpl->tpl_vars['product']->value['quantity_wanted'] > $_smarty_tpl->tpl_vars['product']->value['quantity']) {?>disabled<?php }?>>

            <i class="material-icons shopping-cart">&#xE547;</i>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to cart','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>


          </button>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_804138606048c6870c9d37_64305725', 'product_availability', $this->tplIndex);
?>


        </div>

      </div>

      <div class="clearfix"></div>

    <?php
}
}
/* {/block 'product_quantity'} */
/* {block 'product_minimal_quantity'} */
class Block_20354537406048c6870cd642_13752040 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_minimal_quantity' => 
  array (
    0 => 'Block_20354537406048c6870cd642_13752040',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <p class="product-minimal-quantity">

        <?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'] > 1) {?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The minimum purchase order quantity for the product is %quantity%.','d'=>'Shop.Theme.Checkout','sprintf'=>array('%quantity%'=>$_smarty_tpl->tpl_vars['product']->value['minimal_quantity'])),$_smarty_tpl ) );?>


        <?php }?>

      </p>

    <?php
}
}
/* {/block 'product_minimal_quantity'} */
}
