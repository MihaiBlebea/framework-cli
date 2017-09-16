<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2017-09-16 08:30:14
  from "C:\Laragon\www\ComposerPackages\framework-CLI\views\templates\home.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-22',
  'unifunc' => 'content_59bce116416ad5_33605758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6950ae8661b8ea00d02cd76b243402357528bfd9' => 
    array (
      0 => 'C:\\Laragon\\www\\ComposerPackages\\framework-CLI\\views\\templates\\home.tpl',
      1 => 1505501980,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59bce116416ad5_33605758 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9825180259bce1161755b9_43750819', "body");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_196426663259bce116414153_05482333', "footer");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'layout.tpl');
}
/* {block "body"} */
class Block_9825180259bce1161755b9_43750819 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_9825180259bce1161755b9_43750819',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

            </div>
        </div>
    </div>
<?php
}
}
/* {/block "body"} */
/* {block "footer"} */
class Block_196426663259bce116414153_05482333 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_196426663259bce116414153_05482333',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block "footer"} */
}
