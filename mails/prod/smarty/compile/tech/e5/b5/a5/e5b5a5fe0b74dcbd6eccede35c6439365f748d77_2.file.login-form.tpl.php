<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-09 17:15:56
  from '/htdocs/prestarecup/themes/tech/templates/customer/_partials/login-form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60479f3ca05466_90490168',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e5b5a5fe0b74dcbd6eccede35c6439365f748d77' => 
    array (
      0 => '/htdocs/prestarecup/themes/tech/templates/customer/_partials/login-form.tpl',
      1 => 1613391534,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_partials/form-errors.tpl' => 1,
  ),
),false)) {
function content_60479f3ca05466_90490168 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender('file:_partials/form-errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('errors'=>$_smarty_tpl->tpl_vars['errors']->value['']), 0, false);
?>






<form id="login-form" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8');?>
" method="post">



  <section>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_38421566460479f3ca00724_53789234', 'form_fields');
?>


    <div class="forgot-password">

      <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['password'], ENT_QUOTES, 'UTF-8');?>
" rel="nofollow">

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mot de passe oublier?','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>


      </a>

    </div>

  </section>



  <footer class="form-footer text-xs-center clearfix">

    <input type="hidden" name="submitLogin" value="1">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_40315473860479f3ca04752_06454897', 'form_buttons');
?>


  </footer>

</form>

<?php }
/* {block 'form_field'} */
class Block_181688691660479f3ca01a65_60440904 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_field'][0], array( array('field'=>$_smarty_tpl->tpl_vars['field']->value),$_smarty_tpl ) );?>


        <?php
}
}
/* {/block 'form_field'} */
/* {block 'form_fields'} */
class Block_38421566460479f3ca00724_53789234 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'form_fields' => 
  array (
    0 => 'Block_38421566460479f3ca00724_53789234',
  ),
  'form_field' => 
  array (
    0 => 'Block_181688691660479f3ca01a65_60440904',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['formFields']->value, 'field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field']->value) {
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_181688691660479f3ca01a65_60440904', 'form_field', $this->tplIndex);
?>


      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    <?php
}
}
/* {/block 'form_fields'} */
/* {block 'form_buttons'} */
class Block_40315473860479f3ca04752_06454897 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'form_buttons' => 
  array (
    0 => 'Block_40315473860479f3ca04752_06454897',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <button class="btn btn-primary" data-link-action="sign-in" type="submit" class="form-control-submit">

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>


      </button>

    <?php
}
}
/* {/block 'form_buttons'} */
}
