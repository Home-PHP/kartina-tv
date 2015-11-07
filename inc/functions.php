<?php
require_once('htmlMimeMail5/htmlMimeMail5.php');
ini_set('date.timezone', 'Europe/Kiev');

require_once('config.php');
require_once('api.php');

function registration_on_forum($first_name, $last_name, $email, $phone, $source){
    $post['name'] = $first_name;
    $post ['name'] = $last_name;
    $post['email'] = $email;
    $post['phone'] = $phone;
    $post['source'] = $source;
    
    $post_json = json_encode($post);
/*    raport_in_files($post_json);
    send_mail_admin($post_json);
  	send_mail_client($email); */
		smart_send_mail($post_json,$email,$first_name,$last_name,$phone);
}

function delete_spec_simvol($value){
    $masiv_spec = array('%',"'","\"",';','=');
    $value = htmlspecialchars($value);
    $value = str_replace($masiv_spec,'',$value);
    return $value;
}

function send_mail_admin($post){
/*     $mail = array(    
       "akapral@ukr.net",
       //"vhm@ukr.net",
       "dreamworks2008dune@gmail.com",
    ); */
	global $mail;
	
    $text = '<table border="1" cellpadding="10" cellspacing="0" >';
    foreach(json_decode($post,true) as $key => $v){
        $text .= '<tr><td>'.$key.'</td><td>'.$v.'</td></tr>';
    }
    $text .= '</table>';

    $text .= '<p>Label: '.$_COOKIE['label'].'</p>';

    $mailSend = new htmlMimeMail5();
    $helo = "Kartina.TV";
    $mailSend->setFrom('Kartina.TV <'.MAILUSER.'>');
    $mailSend->setTextCharset('utf-8');
    $mailSend->setHtmlCharset('utf-8');
    $mailSend->setHeadCharset('utf-8');
    $mailSend->setSubject('Клиент_Kartina.TV'); 
    $mailSend->setHTML($text);
    $mailSend->send($mail,mail);
}

function send_mail_fail_admin($post){
	global $mail;
	
		$text = '<font color="red">Ненайдено доступных записей</font><br /><b>Администратор отправь на заявку этому клиенту <u>логин/пароль</u> на получения бесплатного 3-х дневного доступа к видео-сервису!</b><br /><br />';
    $text .= '<table border="1" cellpadding="10" cellspacing="0" >';
    foreach(json_decode($post,true) as $key => $v){
        $text .= '<tr><td>'.$key.'</td><td>'.$v.'</td></tr>';
    }
    $text .= '</table>';

    $text .= '<p>Label: '.$_COOKIE['label'].'</p>';

    $mailSend = new htmlMimeMail5();
    $helo = "Kartina.TV";
    $mailSend->setFrom('Kartina.TV <'.MAILUSER.'>');
    $mailSend->setTextCharset('utf-8');
    $mailSend->setHtmlCharset('utf-8');
    $mailSend->setHeadCharset('utf-8');
    $mailSend->setSubject('Клиент_Kartina.TV (закончились_логин-ы)'); 
    $mailSend->setHTML($text);
    $mailSend->send($mail,mail);
}

function send_mail_client($email, $login, $password, $DataTime){
/* //    $text = '<p>Спасибо за регистрацию!</p>';
//    $text.= '<p>Ждем Вас  24 и 25 марта 2015 года в НСК «Олимпийский»,"Зал Чемпионов".</p>';
    $text = 'Здраствуйте!';
    $text .= '<br/>Вы оставляли заявку на сайте <a href="http://kartina-tv.mediaplayer.com.ua/">kartina-tv.mediaplayer.com.ua</a> на получения <u>бесплатного 3х дневного доступа</u> к видео-сервису.';
    $text .= '<br/><br/>Ваш доступ:';
    $text .=  '<table border="1" cellpadding="10" cellspacing="0" >';
    $text .= '<tr><td>логин</td><td><i>'.$login.'</i></td></tr>';
    $text .= '<tr><td>пароль</td><td><i>'.$password.'</i></td></tr>';
    $text .= '</table>';
    $text .= '<br/>доступ нужно активировать <b>до '.$DataTime.'</b>';
    $text .= '<br/>Детальная информация о видео-сервисе: как смотреть <a href="http://kartina.tv/shop_content.php/coID/1200">kartina.tv/shop_content.php/coID/1200</a>';
    $text .= '<br/>Если данный видео-сервис Вам понравился и Вы захотите оформить месячный или годовой доступ, обращайтесь по телефонам указанным ниже';
    $text .= '<br/><br/>    --';
    $text .= '<br/><i>С Уважением,';
    $text .= '<br/>Владимир';
    $text .= '<br/><br/>официальный диллер видео-сервиса <a href="http://kartina-tv.mediaplayer.com.ua/">Kartina.TV</a> в Украине';
    $text .= '<br/>моб.тел. <b>+380(98) 151-30-51</b>';
    $text .= '<br/>         <b>+38(050) 130 86 81</b>';
    $text .= '<br/>оф.тел   <b>(044) 209 96 35</b></i></b>'; */
		$text = file_get_contents("raport/text_email_client.txt");
		$text = str_replace('__LOGIN__',$login,$text);
		$text = str_replace('__PASSWORD__',$password,$text);
		$text = str_replace('__DATATIME__',$DataTime,$text);

    $mailSend = new htmlMimeMail5();
    $helo = "Kartina.TV";
    $mailSend->setFrom('Kartina.TV <'.MAILUSER.'>');
    $mailSend->setTextCharset('utf-8');
    $mailSend->setHtmlCharset('utf-8');
    $mailSend->setHeadCharset('utf-8');
    $mailSend->setSubject('Видео-сервис Каrtina.TV '); 
    $mailSend->setHTML($text);
    $mailSend->send(array($email),mail);
}

function smart_send_mail($post_json, $email, $first_name, $last_name, $phone){
	global $_work;
	global $_xlsx_file_name;
	global $_input_file_type;
	
	$available_new_record = null;
	$_KARTINA_TV          = getRegistration("$_work/$_xlsx_file_name.$_input_file_type");
	
	foreach( $_KARTINA_TV as $col=>$val ){
		if(!$val['status']){
			$available_new_record = $val;
			if( filter_var($val[0], FILTER_VALIDATE_INT) !== false ) break;
		}
	}

    $_search_name  = 0; foreach($_KARTINA_TV as $col=>$val) if($val[4] == $first_name.' '.$last_name) $_search_name++;
    $_search_email = 0; foreach($_KARTINA_TV as $col=>$val) if($val[5] == $email) $_search_email++;
    $_search_phone = 0; foreach($_KARTINA_TV as $col=>$val) if($val[6] == $phone) $_search_phone++;
    $_search       = $_search_name + $_search_email + $_search_phone;
    if(0 == $_search){
        if(filter_var($available_new_record[0], FILTER_VALIDATE_INT) !== false){
            raport_in_files($post_json);
            send_mail_admin($post_json);
            send_mail_client($email,$available_new_record[1],$available_new_record[2],$available_new_record[3]);
            editRegistration("$_work/$_xlsx_file_name.$_input_file_type",$_KARTINA_TV,$available_new_record[0],$available_new_record[1],$available_new_record[2],$available_new_record[3],$first_name.' '.$last_name,$email,$phone,date("d.m.Y"));
        } else {
            raport_in_files($post_json);
            send_mail_fail_admin($post_json);
            addRegistration("$_work/$_xlsx_file_name.$_input_file_type",$_KARTINA_TV,$first_name.' '.$last_name,$email,$phone,date("d.m.Y"));
        }
    } else {
        addFailRegistration("$_work/$_xlsx_file_name.$_input_file_type",$_KARTINA_TV,$first_name.' '.$last_name,$email,$phone,date("d.m.Y"));
    }
}

function raport_in_files($post){
//    $raportFiles = "/home/aviaforum/public_html/raport/registration.log";
	global $_work;
	global $_log_file_name;
    $raportFiles = "$_work/$_log_file_name";

    $raportFilesOpen = fopen($raportFiles, "a+") or die("File does not exist!");
    flock($raportFilesOpen,LOCK_EX);
    foreach(json_decode($post,true) as $key => $v){ $data .= $key.':'.$v.';'; }
    $data .= 'DataTime:'.date("Y-m-d H:i").';';
    $data .= '|  
';
    fwrite($raportFilesOpen,$data); 
    flock($raportFilesOpen,LOCK_UN);
    fclose($raportFilesOpen);
}




?>