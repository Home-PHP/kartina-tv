<?php
/**
 * В PHP 4.1.0 и более ранних версиях следует использовать $HTTP_POST_FILES вместо $_FILES.
 * ***************************************************************************************
 * URL: http://php.net/manual/ru/features.file-upload.post-method.php
 * URL: https://www.cs.tut.fi/~jkorpela/basic.css
 * URL: https://www.cs.tut.fi/~jkorpela/forms/file.html
 */

$uploaddir = '/var/www/uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

echo 'Некоторая отладочная информация:';
print_r($_FILES);

print "</pre>";