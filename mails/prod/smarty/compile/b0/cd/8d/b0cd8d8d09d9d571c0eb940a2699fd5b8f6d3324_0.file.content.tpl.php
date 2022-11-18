<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 10:32:29
  from '/htdocs/prestarecup/adminlws/themes/new-theme/template/content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6049e3ada52c79_45086487',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0cd8d8d09d9d571c0eb940a2699fd5b8f6d3324' => 
    array (
      0 => '/htdocs/prestarecup/adminlws/themes/new-theme/template/content.tpl',
      1 => 1613998856,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6049e3ada52c79_45086487 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="ajax_confirmation" class="alert alert-success" style="display: none;"></div>


<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
  <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }
}
}
