<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-10 14:15:51
  from '/htdocs/prestarecup/themes/tech/templates/catalog/_partials/product-cover-thumbnails.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6048c687086478_11978690',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db4b90389ff21c02a1a092b084d8aacb3d16c67f' => 
    array (
      0 => '/htdocs/prestarecup/themes/tech/templates/catalog/_partials/product-cover-thumbnails.tpl',
      1 => 1614607638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6048c687086478_11978690 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<div class="images-container">

  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16634535636048c68707ac66_94642710', 'product_cover');
?>




  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17698286686048c68707d010_02463480', 'product_images');
?>


</div>

<?php }
/* {block 'product_cover'} */
class Block_16634535636048c68707ac66_94642710 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_cover' => 
  array (
    0 => 'Block_16634535636048c68707ac66_94642710',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="product-cover">

      <img class="js-qv-product-cover" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['bySize']['large_default']['url'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['legend'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['legend'], ENT_QUOTES, 'UTF-8');?>
" style="width:90%; box-shadow: 3px 3px 3px #aaa6a6; border-radius: 8px;" itemprop="image">

      <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">

        <i class="material-icons zoom-in">&#xE8FF;</i>

      </div>

    </div>

  <?php
}
}
/* {/block 'product_cover'} */
/* {block 'product_images'} */
class Block_17698286686048c68707d010_02463480 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_images' => 
  array (
    0 => 'Block_17698286686048c68707d010_02463480',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="js-qv-mask mask">

      <ul class="product-images js-qv-product-images">

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['images'], 'image');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['image']->value) {
?>

          <li class="thumb-container">

            <img

              class="thumb js-thumb <?php if ($_smarty_tpl->tpl_vars['image']->value['id_image'] == $_smarty_tpl->tpl_vars['product']->value['cover']['id_image']) {?> selected <?php }?>"

              data-image-medium-src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['bySize']['medium_default']['url'], ENT_QUOTES, 'UTF-8');?>
"

              data-image-large-src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['bySize']['large_default']['url'], ENT_QUOTES, 'UTF-8');?>
"

              src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['bySize']['home_default']['url'], ENT_QUOTES, 'UTF-8');?>
"

              alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['legend'], ENT_QUOTES, 'UTF-8');?>
"

              title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['legend'], ENT_QUOTES, 'UTF-8');?>
"

              width="100"

              itemprop="image"

            >

          </li>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

      </ul>

    </div>

  <?php
}
}
/* {/block 'product_images'} */
}
