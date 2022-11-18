<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 10:32:34
  from '/htdocs/prestarecup/themes/tech/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6049e3b2de28d5_74884989',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69ec9dea49bd39c47db3027b209ddee74fa3c5c2' => 
    array (
      0 => '/htdocs/prestarecup/themes/tech/templates/index.tpl',
      1 => 1587046989,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6049e3b2de28d5_74884989 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8127247456049e3b2ddf401_91875634', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_18456258476049e3b2ddfce4_41459541 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_16651300766049e3b2de09b5_00305046 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_8127247456049e3b2ddf401_91875634 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_8127247456049e3b2ddf401_91875634',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_18456258476049e3b2ddfce4_41459541',
  ),
  'page_content' => 
  array (
    0 => 'Block_16651300766049e3b2de09b5_00305046',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18456258476049e3b2ddfce4_41459541', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16651300766049e3b2de09b5_00305046', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
