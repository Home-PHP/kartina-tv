<?php /* Smarty version Smarty-3.1.18, created on 2015-09-16 13:49:29
         compiled from "./templates/pc/other/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:206304285255f937c3403bd7-33706956%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9cf3c4b114b371aa6bfcbab098ac8e1a8aab3b50' => 
    array (
      0 => './templates/pc/other/form.tpl',
      1 => 1442400560,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206304285255f937c3403bd7-33706956',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_55f937c3404d60_11424935',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f937c3404d60_11424935')) {function content_55f937c3404d60_11424935($_smarty_tpl) {?><h2>Получить 3х дневный бесплатный доступ</h2>
<form action="/thanks" method="post">
    <table cellpadding="3" cellspacing="0">
        <tr>
            <td><input type="text"  name="first_name"  placeholder="Имя*"        value="" class="first_name" /></td>
            <td><input type="text"  name="phone"       placeholder="Телефон*"    value="" class="phone" /></td>
        </tr>
        <tr>
            <td><input type="text"  name="last_name"   placeholder="Фамилия" value="" /></td>
            <td><input type="email" name="email"       placeholder="E-mail"  value="" /></td>
        </tr>
    </table>        
    <input class="submit" type="submit" name="submit" value=" Да, я хочу получить доступ"/>
</form><?php }} ?>
