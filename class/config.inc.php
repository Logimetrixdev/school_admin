<?php

	session_start();
	//**************** include classes *************************
	require_once("global.config.php");
	require_once("database.inc.php");
	require_once("class.display.php");
	require_once("class.Authentication.php");
	require_once("ClsJSFormValidation.cls.php");
	require_once("class.FormValidation.php");
	require_once("class.Notification.php");
	require_once("class.user.php");
	require_once("liveX/PHPLiveX.php");
	require_once("class.phpmailer.php");
	
	
	
	
	
	//**************** Database Configuration local development server ****************
    define("DATABASE_HOST","sjslalganj.com",true);
	define("DATABASE_PORT","",true);
	define("DATABASE_USER","sjslayjy_lalganj",true);
	define("DATABASE_PASSWORD","Abhishek@987",true);
	define("DATABASE_NAME","sjslayjy_lalganj",true); 
	
	
	//**************** Database Configuration online development server ****************
	
	
	
?>

