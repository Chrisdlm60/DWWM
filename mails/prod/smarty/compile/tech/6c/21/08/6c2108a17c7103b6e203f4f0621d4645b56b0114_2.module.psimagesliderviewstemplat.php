<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 10:32:34
  from 'module:psimagesliderviewstemplat' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6049e3b2c13931_52733014',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c2108a17c7103b6e203f4f0621d4645b56b0114' => 
    array (
      0 => 'module:psimagesliderviewstemplat',
      1 => 1614677893,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6049e3b2c13931_52733014 (Smarty_Internal_Template $_smarty_tpl) {
?>


<?php if ($_smarty_tpl->tpl_vars['homeslider']->value['slides']) {?>

  <div id="carousel" style="background-color:#333333; padding:2% 5% 0 5%;" data-ride="carousel" class="carousel slide hidden-sm-down" data-interval="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['homeslider']->value['speed'], ENT_QUOTES, 'UTF-8');?>
" data-wrap="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['homeslider']->value['wrap'], ENT_QUOTES, 'UTF-8');?>
" data-pause="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['homeslider']->value['pause'], ENT_QUOTES, 'UTF-8');?>
">

    <ul class="carousel-inner" role="listbox">

      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['homeslider']->value['slides'], 'slide', false, NULL, 'homeslider', array (
  'first' => true,
  'index' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_homeslider']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_homeslider']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_homeslider']->value['index'];
?>

        <li class="carousel-item <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_homeslider']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_homeslider']->value['first'] : null)) {?>active<?php }?>">

          <figure>

            <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['image_url'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['legend'] )), ENT_QUOTES, 'UTF-8');?>
"  height="80%">

            <?php if ($_smarty_tpl->tpl_vars['slide']->value['title'] || $_smarty_tpl->tpl_vars['slide']->value['description']) {?>

              <figcaption class="caption">

                <h2 class="display-1 text-uppercase"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['title'], ENT_QUOTES, 'UTF-8');?>
</h2>

                <div class="caption-description"><?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>
</div>

              </figcaption>

            <?php }?>

          </figure>

        </li>

      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    </ul>

    <div class="direction">

      <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">

        <span class="icon-prev hidden-xs" aria-hidden="true">

          <i class="material-icons">&#xE5CB;</i>

        </span>

        <span class="sr-only">Previous</span>

      </a>

      <a class="right carousel-control" href="#carousel" role="button" data-slide="next">

        <span class="icon-next" aria-hidden="true">

          <i class="material-icons">&#xE5CC;</i>

        </span>

        <span class="sr-only">Next</span>

      </a>

    </div>

  </div>

<?php }?>

<?php }
}
