<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 10:11:40
  from '/htdocs/prestarecup/adminlws/themes/default/template/controllers/attributes_groups/helpers/list/list_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6049deccf31e81_65061826',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6111a3e147c1e1449327440f5c7bad46576c8a3a' => 
    array (
      0 => '/htdocs/prestarecup/adminlws/themes/default/template/controllers/attributes_groups/helpers/list/list_header.tpl',
      1 => 1613998855,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6049deccf31e81_65061826 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21401412306049deccf312b4_21581700', 'leadin');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/list/list_header.tpl");
}
/* {block 'leadin'} */
class Block_21401412306049deccf312b4_21581700 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'leadin' => 
  array (
    0 => 'Block_21401412306049deccf312b4_21581700',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
 type="text/javascript">
		$(document).ready(function() {
			$(location.hash).click();
		});
	<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'leadin'} */
}
