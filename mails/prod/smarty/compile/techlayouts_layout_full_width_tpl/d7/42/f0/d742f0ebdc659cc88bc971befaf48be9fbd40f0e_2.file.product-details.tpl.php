<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-10 16:48:53
  from '/htdocs/prestarecup/themes/tech/templates/catalog/_partials/product-details.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6048ea658e7c46_37141088',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd742f0ebdc659cc88bc971befaf48be9fbd40f0e' => 
    array (
      0 => '/htdocs/prestarecup/themes/tech/templates/catalog/_partials/product-details.tpl',
      1 => 1614675117,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6048ea658e7c46_37141088 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div class="tab-pane fade<?php if (!$_smarty_tpl->tpl_vars['product']->value['description']) {?> in active<?php }?>"

     id="product-details"

     data-product="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['embedded_attributes'] )), ENT_QUOTES, 'UTF-8');?>
"

  >

  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7358914966048ea658d2f96_65727654', 'product_reference');
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3567525526048ea658d8e07_03008730', 'product_quantities');
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8184114686048ea658db910_92394377', 'product_availability_date');
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20290020966048ea658ddc59_52693603', 'product_out_of_stock');
?>




    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4000357256048ea658ded79_05199482', 'product_features');
?>




    
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5875110636048ea658e2dc7_46746417', 'product_specific_references');
?>




    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20055141766048ea658e5745_93258189', 'product_condition');
?>


</div>

<?php }
/* {block 'product_reference'} */
class Block_7358914966048ea658d2f96_65727654 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_reference' => 
  array (
    0 => 'Block_7358914966048ea658d2f96_65727654',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <?php if (isset($_smarty_tpl->tpl_vars['product_manufacturer']->value->id)) {?>

      <div class="product-manufacturer">

        <?php if (isset($_smarty_tpl->tpl_vars['manufacturer_image_url']->value)) {?>

          <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_brand_url']->value, ENT_QUOTES, 'UTF-8');?>
">

            <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer_image_url']->value, ENT_QUOTES, 'UTF-8');?>
" class="img img-thumbnail manufacturer-logo" />

          </a>

        <?php } else { ?>

          <label class="label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Brand','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</label>

          <span>

            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_brand_url']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_manufacturer']->value->name, ENT_QUOTES, 'UTF-8');?>
</a>

          </span>

        <?php }?>

      </div>

    <?php }?>

    <?php if (isset($_smarty_tpl->tpl_vars['product']->value['reference_to_display'])) {?>

      <div class="product-reference">

        <label class="label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reference','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
 </label>

        <span itemprop="sku"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['reference_to_display'], ENT_QUOTES, 'UTF-8');?>
</span>

      </div>

    <?php }?>

    <?php
}
}
/* {/block 'product_reference'} */
/* {block 'product_quantities'} */
class Block_3567525526048ea658d8e07_03008730 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_quantities' => 
  array (
    0 => 'Block_3567525526048ea658d8e07_03008730',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <?php if ($_smarty_tpl->tpl_vars['product']->value['show_quantities']) {?>

        <div class="product-quantities">

          <label class="label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'In stock','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</label>

          <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['quantity'], ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['quantity_label'], ENT_QUOTES, 'UTF-8');?>
</span>

        </div>

      <?php }?>

    <?php
}
}
/* {/block 'product_quantities'} */
/* {block 'product_availability_date'} */
class Block_8184114686048ea658db910_92394377 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_availability_date' => 
  array (
    0 => 'Block_8184114686048ea658db910_92394377',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <?php if ($_smarty_tpl->tpl_vars['product']->value['availability_date']) {?>

        <div class="product-availability-date">

          <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Availability date:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
 </label>

          <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['availability_date'], ENT_QUOTES, 'UTF-8');?>
</span>

        </div>

      <?php }?>

    <?php
}
}
/* {/block 'product_availability_date'} */
/* {block 'product_out_of_stock'} */
class Block_20290020966048ea658ddc59_52693603 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_out_of_stock' => 
  array (
    0 => 'Block_20290020966048ea658ddc59_52693603',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <div class="product-out-of-stock">

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'actionProductOutOfStock','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>


      </div>

    <?php
}
}
/* {/block 'product_out_of_stock'} */
/* {block 'product_features'} */
class Block_4000357256048ea658ded79_05199482 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_features' => 
  array (
    0 => 'Block_4000357256048ea658ded79_05199482',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <?php if ($_smarty_tpl->tpl_vars['product']->value['features']) {?>

        <section class="product-features">

          <h3 class="h6"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Data sheet','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h3>

          <dl class="data-sheet">

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['features'], 'feature');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['feature']->value) {
?>

              <dt class="name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['name'], ENT_QUOTES, 'UTF-8');?>
</dt>

              <dd class="value"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['value'], ENT_QUOTES, 'UTF-8');?>
</dd>

            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

          </dl>

        </section>

      <?php }?>

    <?php
}
}
/* {/block 'product_features'} */
/* {block 'product_specific_references'} */
class Block_5875110636048ea658e2dc7_46746417 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_specific_references' => 
  array (
    0 => 'Block_5875110636048ea658e2dc7_46746417',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <?php if (isset($_smarty_tpl->tpl_vars['product']->value['specific_references'])) {?>

        <section class="product-features">

         

            <dl class="data-sheet">

              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['specific_references'], 'reference', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['reference']->value) {
?>

                <dt class="name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
</dt>

                <dd class="value"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['reference']->value, ENT_QUOTES, 'UTF-8');?>
</dd>

              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            </dl>

        </section>

      <?php }?>

    <?php
}
}
/* {/block 'product_specific_references'} */
/* {block 'product_condition'} */
class Block_20055141766048ea658e5745_93258189 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_condition' => 
  array (
    0 => 'Block_20055141766048ea658e5745_93258189',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <?php if ($_smarty_tpl->tpl_vars['product']->value['condition']) {?>

        <div class="product-condition">

          <label class="label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Condition','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
 </label>

          <link itemprop="itemCondition" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['condition']['schema_url'], ENT_QUOTES, 'UTF-8');?>
"/>

          <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['condition']['label'], ENT_QUOTES, 'UTF-8');?>
</span>

        </div>

      <?php }?>

    <?php
}
}
/* {/block 'product_condition'} */
}
