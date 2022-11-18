<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 10:24:34
  from '/htdocs/prestarecup/adminlws/themes/default/template/content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6049e1d2106c10_56931832',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16b7c0bb7d12e89a28bce8d5f26068cc780a9c6e' => 
    array (
      0 => '/htdocs/prestarecup/adminlws/themes/default/template/content.tpl',
      1 => 1613998855,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6049e1d2106c10_56931832 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="ajax_confirmation" class="alert alert-success hide"></div>
<div id="ajaxBox" style="display:none"></div>

<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div>
<?php }
}
