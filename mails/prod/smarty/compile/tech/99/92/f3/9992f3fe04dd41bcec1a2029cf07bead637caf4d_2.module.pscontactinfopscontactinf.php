<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 10:32:36
  from 'module:pscontactinfopscontactinf' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6049e3b48e8b36_28883376',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9992f3fe04dd41bcec1a2029cf07bead637caf4d' => 
    array (
      0 => 'module:pscontactinfopscontactinf',
      1 => 1613558426,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6049e3b48e8b36_28883376 (Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="block-contact col-md-4 links wrapper">

  <div class="hidden-sm-down">

    <h4 class="text-uppercase block-contact-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Store information','d'=>'Shop.Theme'),$_smarty_tpl ) );?>
</h4>

      <?php echo $_smarty_tpl->tpl_vars['contact_infos']->value['address']['formatted'];?>


      <?php if ($_smarty_tpl->tpl_vars['contact_infos']->value['phone']) {?>

        <br>
        

        
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Call us: [1]%phone%[/1]','sprintf'=>array('[1]'=>'<span>','[/1]'=>'</span>','%phone%'=>$_smarty_tpl->tpl_vars['contact_infos']->value['phone']),'d'=>'Shop.Theme'),$_smarty_tpl ) );?>


      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['contact_infos']->value['fax']) {?>

        <br>

        
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Fax: [1]%fax%[/1]','sprintf'=>array('[1]'=>'<span>','[/1]'=>'</span>','%fax%'=>$_smarty_tpl->tpl_vars['contact_infos']->value['fax']),'d'=>'Shop.Theme'),$_smarty_tpl ) );?>


      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['contact_infos']->value['email']) {?>

        <br>

        
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email us: [1]%email%[/1]','sprintf'=>array('[1]'=>'<span>','[/1]'=>'</span>','%email%'=>$_smarty_tpl->tpl_vars['contact_infos']->value['email']),'d'=>'Shop.Theme'),$_smarty_tpl ) );?>


      <?php }?>

  </div>

  <div class="hidden-md-up">

    <div class="title">

      <a class="h3" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['stores'], ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Store information','d'=>'Shop.Theme'),$_smarty_tpl ) );?>
</a>

    </div>

  </div>

</div><?php }
}
