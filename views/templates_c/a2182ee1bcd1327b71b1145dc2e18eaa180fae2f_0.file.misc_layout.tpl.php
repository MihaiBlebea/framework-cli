<?php
/* Smarty version 3.1.31, created on 2017-09-04 20:27:29
  from "C:\Laragon\www\Tests\test-IOC\views\templates\misc_layout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59adb7312cc289_02206608',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2182ee1bcd1327b71b1145dc2e18eaa180fae2f' => 
    array (
      0 => 'C:\\Laragon\\www\\Tests\\test-IOC\\views\\templates\\misc_layout.tpl',
      1 => 1504556847,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59adb7312cc289_02206608 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['app_name']->value;?>
</title>
        <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://unpkg.com/popper.js"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://js.braintreegateway.com/js/braintree-2.27.0.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://unpkg.com/axios/dist/axios.min.js"><?php echo '</script'; ?>
>

        <style>
            body {
                background-image: url('http://www.50jahre30.de/wp-content/uploads/2016/03/O7MF4F0.jpg');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
            }
            a {
                text-decoration: none;
                color: inherit;
            }
            a:hover {
                color: inherit;
            }
            a.card-link {
                color: #0A82C5;
            }
            a.card-link:hover {
                color: #0A82C5;
                font-weight: bold;
            }
            .nav {
                background-color: #0A82C5;
                color:white;
                z-index: 3;
                overflow: hidden;
                position: fixed;
                top: 0;
                width: 100%;
            }
            .nav-item:hover {
                color: yellow;
            }
            .container-fluid {
                max-width:900px;
                padding: 50px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .btn {
                cursor: pointer;
            }
            .row {
                margin-right: 0px;
                margin-left: 0px;
            }
            .card {
                position:relative;
                z-index:2;
                margin-top:50px;
            }
            .alert {
                margin-top:50px;
                width: 900px;
                margin-bottom:-10px;
            }
            .card {
                width:900px;
            }
            .program-image {
                display:block;
                margin:auto;
                margin-bottom:10px;
            }
            .table {
                margin-top: 30px;
            }
            .badge {
                color: #fff;
                background-color: #868e96;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .close {
                cursor:pointer;
            }
        </style>
    </head>
    <body>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_77304124959adb7312c8a49_07831829', "body");
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_106578289159adb7312cad20_09353582', "footer");
?>

    </body>
<body>
<?php }
/* {block "body"} */
class Block_77304124959adb7312c8a49_07831829 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_77304124959adb7312c8a49_07831829',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


        <?php
}
}
/* {/block "body"} */
/* {block "footer"} */
class Block_106578289159adb7312cad20_09353582 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_106578289159adb7312cad20_09353582',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


        <?php
}
}
/* {/block "footer"} */
}
