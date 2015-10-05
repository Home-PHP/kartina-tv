<!DOCTYPE html>
<html class="html">
<head>
    <meta http-equiv="Content-Language" content="ru" />
    <meta charset="utf-8" />
    {include file="{$device}/head.tpl"}
    {include file="{$device}/schetchiki.tpl"}
</head>
<body>

<nav id="top_menu"><div class="content">{include file="{$device}/other/top_menu.tpl"}</div></nav>

<div class="sl">&nbsp;</div>	
<div class="content">
    <div class="d1_big">
        <div class="head header">{include file="{$device}/other/header.tpl"}</div>
        <div class="clear"></div>
        
        <div class="t3" style="color: #fff;font-size: 40px">видеосервис <strong>Kartina.TV</strong></div>
        <div class="anketa">
            {if $thanks == false}
                {include file="{$device}/other/form.tpl"}
            {else}
                <div style="color: #fff; line-height: 180%;">
                    <p style="font-size: 22px;margin-bottom: 12px;">
                        <strong>Спасибо за Вашу заявку!</strong>
                        Наш менеджер свяжется с Вами в ближайшее время и отправит бесплатный 3хдневный доступ на Вашу почту
                    </p>
                </div>
            {/if}
        </div>


        <div class="data_webinar">
            <img src="images/kartina-best.jpg" alt="" />
        </div>

    
    </div>
    <div class="d2" style="height: auto; padding: 25px 25px 15px 25px; min-height: 600px">
        <div class="plan_webinar">
        <!-- Начало текста -->
        {include file="{$device}/page/{$page_url}.tpl"}
        <!-- Конець текста -->
        </div>
    </div>
</div>
    
    
    {include file="{$device}/footer.tpl"}
</body>
</html>