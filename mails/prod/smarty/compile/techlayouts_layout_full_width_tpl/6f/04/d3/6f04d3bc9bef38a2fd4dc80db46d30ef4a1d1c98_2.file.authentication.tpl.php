<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-09 17:15:56
  from '/htdocs/prestarecup/themes/tech/templates/customer/authentication.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60479f3c93b862_30285347',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f04d3bc9bef38a2fd4dc80db46d30ef4a1d1c98' => 
    array (
      0 => '/htdocs/prestarecup/themes/tech/templates/customer/authentication.tpl',
      1 => 1614170002,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60479f3c93b862_30285347 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>





<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15205696060479f3c932e97_42635729', 'page_title');
?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_174825662760479f3c935704_72806457', 'page_content');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_title'} */
class Block_15205696060479f3c932e97_42635729 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_title' => 
  array (
    0 => 'Block_15205696060479f3c932e97_42635729',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Vous avez un compte ? Vous pouvez vous connecter ici, ou en créer un','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>


<?php
}
}
/* {/block 'page_title'} */
/* {block 'display_after_login_form'} */
class Block_197579672460479f3c937db2_03930997 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCustomerLoginFormAfter'),$_smarty_tpl ) );?>


      <?php
}
}
/* {/block 'display_after_login_form'} */
/* {block 'login_form_container'} */
class Block_85160105760479f3c935c52_77252361 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


      <section class="login-form">

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['render'][0], array( array('file'=>'customer/_partials/login-form.tpl','ui'=>$_smarty_tpl->tpl_vars['login_form']->value),$_smarty_tpl ) );?>


      </section>

      <hr/>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_197579672460479f3c937db2_03930997', 'display_after_login_form', $this->tplIndex);
?>


      <div class="no-account">
<p>Pas de compte? Créez votre compte, Pour Professionnel :</p>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['register'], ENT_QUOTES, 'UTF-8');?>
" data-link-action="display-register-form">
         
          <span style="color: #4faee6; text-decoration: underline;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Créer mon compte','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>
</span>

        </a>

      </div>

    <?php
}
}
/* {/block 'login_form_container'} */
/* {block 'page_content'} */
class Block_174825662760479f3c935704_72806457 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_174825662760479f3c935704_72806457',
  ),
  'login_form_container' => 
  array (
    0 => 'Block_85160105760479f3c935c52_77252361',
  ),
  'display_after_login_form' => 
  array (
    0 => 'Block_197579672460479f3c937db2_03930997',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_85160105760479f3c935c52_77252361', 'login_form_container', $this->tplIndex);
?>


<?php
}
}
/* {/block 'page_content'} */
}
