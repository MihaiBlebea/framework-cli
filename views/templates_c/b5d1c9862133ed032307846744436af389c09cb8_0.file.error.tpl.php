<?php
/* Smarty version 3.1.31, created on 2017-09-12 05:51:53
  from "C:\Laragon\www\Tests\test-IOC\views\templates\error.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59b775f9c0e247_77179559',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b5d1c9862133ed032307846744436af389c09cb8' => 
    array (
      0 => 'C:\\Laragon\\www\\Tests\\test-IOC\\views\\templates\\error.tpl',
      1 => 1505195510,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59b775f9c0e247_77179559 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_45594006259b775f9bfd3c2_53074502', "body");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_162636587459b775f9c0ccb2_39921988', "footer");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'misc_layout.tpl');
}
/* {block "body"} */
class Block_45594006259b775f9bfd3c2_53074502 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_45594006259b775f9bfd3c2_53074502',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">

                        <div class="col-md-8 col-sm-12">
                            <h4 class="card-title">404 - Un cod ciudat</h4>
                            <h6 class="card-subtitle mb-2 text-muted">Nu intra in panica,asta inseamna doar ca pagina pe care o cauti nu exista</h6>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['app_path']->value;?>
/select"><button type="button" class="btn btn-primary btn-lg">Vreau sa ajung acasa</button></a>
                        </div>

                    <?php echo $_smarty_tpl->tpl_vars['email']->value;?>

                    <?php echo $_smarty_tpl->tpl_vars['error_email']->value;?>

                    <?php echo $_smarty_tpl->tpl_vars['name']->value;?>

                    <?php echo $_smarty_tpl->tpl_vars['error_name']->value;?>

                </div>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block "body"} */
/* {block "footer"} */
class Block_162636587459b775f9c0ccb2_39921988 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_162636587459b775f9c0ccb2_39921988',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block "footer"} */
}
