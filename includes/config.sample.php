<?php

session_start();

require __DIR__. '/../vendor/autoload.php';

define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', '');
define('DOMAIN', '');
define('SMTP_HOST', '');
define('COMPANY_NAME', '');
define('SMTP_USERNAME', '');
define('SMTP_EMAIL', '');
define('SMTP_PASSWORD', '');
define('SALT', '');
define('SESSION', '');
date_default_timezone_set('Europe/London');
define('DT', date('Y-m-d H:i:s'));
define('FILE', basename($_SERVER['SCRIPT_NAME']));


$user = new App\User;
$cartObj = new App\Cart;
$categoryObj = new App\Category;


if( !$user->uniqueId() ){

	$user->setUniqueId();

}


App\Helpers\Tools::boot();

function redirect($url, $message = null, $type = null){

	if($message){

		$message = $type == 'e' ? App\Helpers\Tools::error($message) : App\Helpers\Tools::flash($message);

	}

header('Location: '.$url); exit;

}
