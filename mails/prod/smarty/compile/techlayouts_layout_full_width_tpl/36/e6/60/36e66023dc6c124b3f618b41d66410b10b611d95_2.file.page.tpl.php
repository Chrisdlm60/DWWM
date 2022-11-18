<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 10:32:36
  from '/htdocs/prestarecup/themes/tech/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6049e3b46dd2a3_60151759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '36e66023dc6c124b3f618b41d66410b10b611d95' => 
    array (
      0 => '/htdocs/prestarecup/themes/tech/templates/page.tpl',
      1 => 1587046989,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6049e3b46dd2a3_60151759 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3291703136049e3b46d6479_88068617', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_9477472996049e3b46d75c2_68225752 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_14207655346049e3b46d6c57_89238398 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9477472996049e3b46d75c2_68225752', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_12567392456049e3b46da0a0_87571525 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_89323496049e3b46daba0_94007782 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_6202060436049e3b46d9851_80134272 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12567392456049e3b46da0a0_87571525', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_89323496049e3b46daba0_94007782', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_21288637106049e3b46dc0c1_36313774 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_7886553426049e3b46dba21_48690114 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21288637106049e3b46dc0c1_36313774', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_3291703136049e3b46d6479_88068617 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_3291703136049e3b46d6479_88068617',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_14207655346049e3b46d6c57_89238398',
  ),
  'page_title' => 
  array (
    0 => 'Block_9477472996049e3b46d75c2_68225752',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_6202060436049e3b46d9851_80134272',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_12567392456049e3b46da0a0_87571525',
  ),
  'page_content' => 
  array (
    0 => 'Block_89323496049e3b46daba0_94007782',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_7886553426049e3b46dba21_48690114',
  ),
  'page_footer' => 
  array (
    0 => 'Block_21288637106049e3b46dc0c1_36313774',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14207655346049e3b46d6c57_89238398', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6202060436049e3b46d9851_80134272', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7886553426049e3b46dba21_48690114', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
