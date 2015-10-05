<?php
require_once('htmlMimeMail5/htmlMimeMail5.php');
ini_set('date.timezone', 'Europe/Kiev');

function registration_on_forum($first_name, $last_name, $email, $phone, $source){
    $post['name'] = $first_name;
    $post ['name'] = $last_name;
    $post['email'] = $email;
    $post['phone'] = $phone;
    $post['source'] = $source;
    
    $post_json = json_encode($post);
    //raport_in_files($post_json);
    send_mail_admin($post_json);
    //send_mail_client($email); 
}



function delete_spec_simvol($value){
    $masiv_spec = array('%',"'","\"",';','=');
    $value = htmlspecialchars($value);
    $value = str_replace($masiv_spec,'',$value);
    return $value;
}

function send_mail_admin($post){
    $mail = array(    
       "akapral@ukr.net",
       //"vhm@ukr.net",
       "dreamworks2008dune@gmail.com",
    );
    
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

function send_mail_client($email){
    $text = '<p>Спасибо за регистрацию!</p>';
    $text.= '<p>Ждем Вас  24 и 25 марта 2015 года в НСК «Олимпийский»,"Зал Чемпионов".</p>';


    $mailSend = new htmlMimeMail5();
    $helo = "Aviaforum Kiev";
    $mailSend->setFrom('Aviaforum Kiev <'.MAILUSER.'>');
    $mailSend->setTextCharset('utf-8');
    $mailSend->setHtmlCharset('utf-8');
    $mailSend->setHeadCharset('utf-8');
    $mailSend->setSubject('Авиафорум'); 
    $mailSend->setHTML($text);
    $mailSend->send(array($email),mail);
}

function raport_in_files($post){
    $raportFiles = "/home/aviaforum/public_html/raport/registration.log";
    
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