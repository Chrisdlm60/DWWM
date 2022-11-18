<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 10:32:36
  from '/htdocs/prestarecup/themes/tech/templates/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6049e3b4858f49_78637585',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a5e5afe6b038148c6087d16e2d64f435394b8d5f' => 
    array (
      0 => '/htdocs/prestarecup/themes/tech/templates/_partials/footer.tpl',
      1 => 1613560273,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6049e3b4858f49_78637585 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">

  <div class="row">

    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterBefore'),$_smarty_tpl ) );?>


  </div>

</div>

<div class="footer-container">

  <div class="container">

    <div class="row">

      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooter'),$_smarty_tpl ) );?>


    </div>

    <div class="row">

      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterAfter'),$_smarty_tpl ) );?>


    </div>

    <div class="row">

      <div class="col-md-12">

        <p>

         

		 

			

          </a>

        </p>

      </div>

    </div>

  </div>

</div>

<?php }
}
