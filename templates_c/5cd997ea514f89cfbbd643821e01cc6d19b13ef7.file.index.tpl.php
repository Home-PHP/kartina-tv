<?php /* Smarty version Smarty-3.1.18, created on 2015-09-29 15:38:02
         compiled from "./templates/pc/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:80709839954f59e4984ddd7-29430298%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cd997ea514f89cfbbd643821e01cc6d19b13ef7' => 
    array (
      0 => './templates/pc/index.tpl',
      1 => 1443530281,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '80709839954f59e4984ddd7-29430298',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54f59e498a4599_10959360',
  'variables' => 
  array (
    'device' => 0,
    'thanks' => 0,
    'page_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f59e498a4599_10959360')) {function content_54f59e498a4599_10959360($_smarty_tpl) {?><!DOCTYPE html>
<html class="html">
<head>
    <meta http-equiv="Content-Language" content="ru" />
    <meta charset="utf-8" />
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['device']->value)."/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['device']->value)."/schetchiki.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</head>
<body>

<nav id="top_menu"><div class="content"><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['device']->value)."/other/top_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</div></nav>

<div class="sl">&nbsp;</div>	
<div class="content">
    <div class="d1_big">
        <div class="head header"><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['device']->value)."/other/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</div>
        <div class="clear"></div>
        
        <div class="t3" style="color: #fff;font-size: 40px">видеосервис <strong>Kartina.TV</strong></div>
        <div class="anketa">
            <?php if ($_smarty_tpl->tpl_vars['thanks']->value==false) {?>
                <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['device']->value)."/other/form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php } else { ?>
                <div style="color: #fff; line-height: 180%;">
                    <p style="font-size: 22px;margin-bottom: 12px;">
                        <strong>Спасибо за Вашу заявку!</strong>
                        Наш менеджер свяжется с Вами в ближайшее время и отправит бесплатный 3хдневный доступ на Вашу почту
                    </p>
                </div>
            <?php }?>
        </div>


        <div class="data_webinar">
            <img src="/images/kartina-best.jpg" alt="" />
        </div>

    
    </div>
    <div class="d2" style="height: auto; padding: 25px 25px 15px 25px; min-height: 600px">
        <div class="plan_webinar">
        <!-- Начало текста -->
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['device']->value)."/page/".((string)$_smarty_tpl->tpl_vars['page_url']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <!-- Конець текста -->
        </div>
    </div>
</div>
    
    
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['device']->value)."/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</body>
</html><?php }} ?>
