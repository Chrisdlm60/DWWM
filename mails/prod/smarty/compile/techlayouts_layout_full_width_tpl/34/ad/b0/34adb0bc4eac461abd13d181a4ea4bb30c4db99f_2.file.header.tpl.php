<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 10:32:36
  from '/htdocs/prestarecup/themes/tech/templates/_partials/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6049e3b475e1a5_13224959',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '34adb0bc4eac461abd13d181a4ea4bb30c4db99f' => 
    array (
      0 => '/htdocs/prestarecup/themes/tech/templates/_partials/header.tpl',
      1 => 1614249996,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6049e3b475e1a5_13224959 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12965996736049e3b47588e1_56141677', 'header_nav');
?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15428708106049e3b475a4f2_21196870', 'header_top');
?>


<?php }
/* {block 'header_nav'} */
class Block_12965996736049e3b47588e1_56141677 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_nav' => 
  array (
    0 => 'Block_12965996736049e3b47588e1_56141677',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <nav class="header-nav">

    <div class="container">

        <div class="row">

          <div class="hidden-sm-down">

            <div class="col-md-4 col-xs-12">

              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav1'),$_smarty_tpl ) );?>


            </div>

            <div class="col-md-8 right-nav">

                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav2'),$_smarty_tpl ) );?>


            </div>

          </div>

          <div class="hidden-md-up text-xs-center mobile">

            <div class="pull-xs-left" id="menu-icon">

              <i class="material-icons d-inline">&#xE5D2;</i>

            </div>

            <div class="pull-xs-right" id="_mobile_cart"></div>

            <div class="pull-xs-right" id="_mobile_user_info"></div>

            <div class="top-logo" id="_mobile_logo"></div>

            <div class="clearfix"></div>

          </div>

        </div>

    </div>

  </nav>

<?php
}
}
/* {/block 'header_nav'} */
/* {block 'header_top'} */
class Block_15428708106049e3b475a4f2_21196870 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_top' => 
  array (
    0 => 'Block_15428708106049e3b475a4f2_21196870',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <div class="header-top">

    <div class="container">

       <div class="row">

        <div class="col-md-2 hidden-sm-down" id="_desktop_logo">

          <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
">

            <img class="logo img-responsive" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['logo'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
">

          </a>

        </div>

        <div class="col-md-10 col-sm-12 position-static">

          <div class="row">

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayTop'),$_smarty_tpl ) );?>


            <div class="clearfix"></div>

          </div>

        </div>

      </div>

      <div id="mobile_top_menu_wrapper" class="row hidden-md-up" style="display:none;">

        <div class="js-top-menu mobile" id="_mobile_top_menu"></div>

        <div class="js-top-menu-bottom">

          <div id="_mobile_currency_selector"></div>

          <div id="_mobile_language_selector"></div>

          <div id="_mobile_contact_link"></div>

        </div>

      </div>

    </div>

  </div>

  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNavFullWidth'),$_smarty_tpl ) );?>


<?php
}
}
/* {/block 'header_top'} */
}
