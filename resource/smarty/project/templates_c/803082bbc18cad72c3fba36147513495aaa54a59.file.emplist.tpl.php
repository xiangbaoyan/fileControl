<?php /* Smarty version Smarty-3.1.16, created on 2014-03-12 05:04:21
         compiled from ".\templates\emplist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23458531fdbf09c14d3-37484460%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '803082bbc18cad72c3fba36147513495aaa54a59' => 
    array (
      0 => '.\\templates\\emplist.tpl',
      1 => 1394600658,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23458531fdbf09c14d3-37484460',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_531fdbf0a2b301_34718083',
  'variables' => 
  array (
    'emplist' => 0,
    'emp' => 0,
    'key' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_531fdbf0a2b301_34718083')) {function content_531fdbf0a2b301_34718083($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <?php  $_smarty_tpl->tpl_vars['emp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['emp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emplist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['emp']->key => $_smarty_tpl->tpl_vars['emp']->value) {
$_smarty_tpl->tpl_vars['emp']->_loop = true;
?>

        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['emp']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['key']->value!='age') {?>
                <span style="color: red"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</span>
                <span style="color: green"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</span>
                <br>
            <?php }?>
        <?php } ?>


    <?php } ?>
</body>
</html><?php }} ?>
