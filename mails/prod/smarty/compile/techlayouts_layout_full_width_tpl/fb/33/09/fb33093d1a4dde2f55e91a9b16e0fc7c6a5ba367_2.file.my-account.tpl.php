<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-10 16:09:00
  from '/htdocs/prestarecup/themes/tech/templates/customer/my-account.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6048e10c2e7a82_55706743',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fb33093d1a4dde2f55e91a9b16e0fc7c6a5ba367' => 
    array (
      0 => '/htdocs/prestarecup/themes/tech/templates/customer/my-account.tpl',
      1 => 1613391533,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6048e10c2e7a82_55706743 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>





<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16701726236048e10c2ce162_49449905', 'page_title');
?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6722904936048e10c2d1663_79487438', 'page_content');
?>






<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18613693146048e10c2e6184_32140287', 'page_footer');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_title'} */
class Block_16701726236048e10c2ce162_49449905 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_title' => 
  array (
    0 => 'Block_16701726236048e10c2ce162_49449905',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Votre Compte','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>


<?php
}
}
/* {/block 'page_title'} */
/* {block 'display_customer_account'} */
class Block_2761160416048e10c2e4200_76107815 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCustomerAccount'),$_smarty_tpl ) );?>


      <?php
}
}
/* {/block 'display_customer_account'} */
/* {block 'page_content'} */
class Block_6722904936048e10c2d1663_79487438 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_6722904936048e10c2d1663_79487438',
  ),
  'display_customer_account' => 
  array (
    0 => 'Block_2761160416048e10c2e4200_76107815',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <div class="row">

    <div class="links">



      <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="identity-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['identity'], ENT_QUOTES, 'UTF-8');?>
">

        <span class="link-item">

          <i class="material-icons">&#xE853;</i>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Information','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>


        </span>

      </a>



      <?php if (count($_smarty_tpl->tpl_vars['customer']->value['addresses'])) {?>

        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="addresses-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['addresses'], ENT_QUOTES, 'UTF-8');?>
">

          <span class="link-item">

            <i class="material-icons">&#xE56A;</i>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Addresses','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>


          </span>

        </a>

      <?php } else { ?>

        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="address-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['address'], ENT_QUOTES, 'UTF-8');?>
">

          <span class="link-item">

            <i class="material-icons">&#xE567;</i>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add first address','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>


          </span>

        </a>

      <?php }?>



      <?php if (!$_smarty_tpl->tpl_vars['configuration']->value['is_catalog']) {?>

        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="history-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['history'], ENT_QUOTES, 'UTF-8');?>
">

          <span class="link-item">

            <i class="material-icons">&#xE916;</i>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order history and details','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>


          </span>

        </a>

      <?php }?>



      <?php if (!$_smarty_tpl->tpl_vars['configuration']->value['is_catalog']) {?>

        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="order-slips-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['order_slip'], ENT_QUOTES, 'UTF-8');?>
">

          <span class="link-item">

            <i class="material-icons">&#xE8B0;</i>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Credit slips','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>


          </span>

        </a>

      <?php }?>



      <?php if ($_smarty_tpl->tpl_vars['configuration']->value['voucher_enabled'] && !$_smarty_tpl->tpl_vars['configuration']->value['is_catalog']) {?>

        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="discounts-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['discount'], ENT_QUOTES, 'UTF-8');?>
">

          <span class="link-item">

            <i class="material-icons">&#xE54E;</i>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Vouchers','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>


          </span>

        </a>

      <?php }?>



      <?php if ($_smarty_tpl->tpl_vars['configuration']->value['return_enabled'] && !$_smarty_tpl->tpl_vars['configuration']->value['is_catalog']) {?>

        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="returns-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['order_follow'], ENT_QUOTES, 'UTF-8');?>
">

          <span class="link-item">

            <i class="material-icons">&#xE860;</i>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Merchandise returns','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>


          </span>

        </a>

      <?php }?>



      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2761160416048e10c2e4200_76107815', 'display_customer_account', $this->tplIndex);
?>




    </div>

  </div>

<?php
}
}
/* {/block 'page_content'} */
/* {block 'my_account_links'} */
class Block_7641499246048e10c2e66b5_27547702 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="text-xs-center">

      <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['logout_url']->value, ENT_QUOTES, 'UTF-8');?>
" >

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign out','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>


      </a>

    </div>

  <?php
}
}
/* {/block 'my_account_links'} */
/* {block 'page_footer'} */
class Block_18613693146048e10c2e6184_32140287 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_footer' => 
  array (
    0 => 'Block_18613693146048e10c2e6184_32140287',
  ),
  'my_account_links' => 
  array (
    0 => 'Block_7641499246048e10c2e66b5_27547702',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7641499246048e10c2e66b5_27547702', 'my_account_links', $this->tplIndex);
?>


<?php
}
}
/* {/block 'page_footer'} */
}
