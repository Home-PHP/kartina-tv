<?php
ini_set('date.timezone', 'Europe/Kiev');

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

define('SOURCE', '20140929_forum');

/** Настройки почты **/
define('MAILUSER', 'info@aviaforum.kiev.ua');
define('MAILLOGIN', 'info@aviaforum.kiev.ua');
define('MAILPWD', '12131415');
define('MAILHOST', '193.93.185.184');
define('MAILPORT', 25);


require_once 'inc/smarty/Smarty.class.php';
require_once 'inc/functions.php';
require_once 'inc/mobile_detect.php'; 


if( isset($_POST['phone']) && isset($_POST['email']) ):
    $first_name = delete_spec_simvol($_POST['first_name']); 
    $last_name  = delete_spec_simvol($_POST['last_name']);
    $email      = delete_spec_simvol($_POST['email']);
    $phone      = delete_spec_simvol($_POST['phone']);

    registration_on_forum($first_name, $last_name, strtolower($email), $phone, SOURCE);

    header('HTTP/1.1 301 Moved Permanently');
    header('Location: /thanks'); 
    exit;
endif;



$smarty = new Smarty;
$smarty->caching = false;
$smarty->cache_lifetime = 120;

/** Определаем устройство **/
$device = 'pc'; // Значение по умолчанию
//$detect = new Mobile_Detect;


/** Параметры которые передаются в шаблон **/
$params['device'] = $device;
$params['page_url'] = 'home'; // значение для главной страницы
$params['thanks'] = false;
/** Параметры #2 которые передаются в шаблон **/
/*
 * https://api.privatbank.ua/api-info/exchangerate.html >> https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5
 * ************************************************************************************************************************
 * ccy ........ Код валюты
 * base_ccy ... Код национальной валюты
 * buy ........ Курс покупки
 * sale ....... Курс продажи
 *
 * http://stackoverflow.com/questions/15617512/get-json-object-from-url
 * http://php-da.ru/osnovy-php/php-chisla-number.html
 */
$json = file_get_contents("https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5");
$obj = json_decode($json);
$EUR = $obj[1];
$params['podpisku_month'] = number_format($EUR->sale * 19.95); // number_format($EUR->sale * 19.95, 2) // round($EUR->sale * 19.95, 2) // для месячного абонемента умножаем курс евро (тот что побольше) на 19,95   (540)
$params['podpisku_year'] =  number_format($EUR->sale * 190);   // number_format($EUR->sale * 190, 2)   //round($EUR->sale * 190, 2)   // для годового абонемента умножаем курс евро (тот что побольше) на 190      (5100)


switch($_GET['url']){
    /** **************************************************************************************************************** **
     * Указываем название адреса страницы в формате "case 'url страницы':" (в списке ниже рядом с другими названиями), 
     * после в папке /public_html/templates/pc/page создаем файл 
     * с этим названием и расширением .tpl
     * содержание копируем с файла в этой папке, согласно того на какую страницу должен быть похожа новая страница
     * ***************************************************************************************************************** **/
    case 'thanks':      // страница спасибо, после регистрации
        $params['thanks'] = true;
            
    case 'abouts':      // страница о форуме
    case 'contact':     // страница контактов
    case 'vote':        // страница голосования №1
    case 'archive':     // страница архив
    case 'seminars':    // страница Семинары
    case 'iata-forum':  // страница ИАТА-форум
    case 'treningi':    // страница тренинги
    case 'speedtest':   // страница SpeedTest
    case 'podpisku':    // страница Стоимость подписки
    case 'how':         // страница Как смотреть
    case 'payments':    // страница Способы оплаты
    case 'channellist': // страница Список каналов
    case 'admin':       // страница Загрузить документ
    
    
        $params['page_url'] = $_GET['url'];
        $smarty->display($device.DS.'index.tpl',$params);
    break;     
    
    default:
        if(!empty($_GET['url'])):
            if (preg_match("/^label\/(.*)/si", $_GET['url'], $label)):
                SetCookie("label",$label['1'],time()+(40*24*60*60),"/");
            endif;
           
            $link = '/';
            if(isset($_GET['utm_source'])){ $link .= '?utm_source='.$_GET['utm_source']; }
            if(isset($_GET['utm_medium'])){ $link .= '&utm_medium='.$_GET['utm_medium']; }
            if(isset($_GET['utm_campaign'])){ $link .= '&utm_campaign='.$_GET['utm_campaign']; }
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: '.$link);
            exit;           
        endif;
        $smarty->display($device.DS.'index.tpl',$params);
}

