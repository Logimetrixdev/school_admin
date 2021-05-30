<?php
require_once("class/config.inc.php");
include_once("class/class.student.php");
$ajax=new PHPLiveX();
$student_obj = new StudentDetail();
extract($_REQUEST);
$ajax->AjaxifyObjects(array("student_obj")); 
$notify = new Notification();
$disp = new basic_page();
$disp->auth->CheckAdminlogin();
//import all css
$disp -> setImportCss1('<link rel="stylesheet" type="text/css" href="custom-plugins/wizard/wizard.css" media="screen">');
$disp -> setImportCss2('<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">');
$disp -> setImportCss3('<link rel="stylesheet" type="text/css" href="css/fonts/ptsans/stylesheet.css" media="screen">');
$disp -> setImportCss4('<link rel="stylesheet" type="text/css" href="css/fonts/icomoon/style.css" media="screen">');
$disp -> setImportCss5('<link rel="stylesheet" type="text/css" href="css/mws-style.css" media="screen">');
$disp -> setImportCss6('<link rel="stylesheet" type="text/css" href="css/icons/icol16.css" media="screen">');
$disp -> setImportCss7('<link rel="stylesheet" type="text/css" href="css/icons/icol32.css" media="screen">');


$disp -> setImportCss11('<link rel="stylesheet" type="text/css" href="css/mws-theme.css" media="screen">');
$disp -> setImportCss12('<link rel="stylesheet" type="text/css" href="css/themer.css" media="screen">');


$ajax->Run('liveX/phplivex.js'); 
//import all js
//import all js
 //  JavaScript Plugins 
 ?>
<link rel="stylesheet" href="dcss/datepicker.css" type="text/css"/>	

<script src="djs/jquery.js"></script>
 <script src="djs/jquery-ui.js"></script>
<script src="djs/datepicker.js"></script> 
<?php


$disp->displayPageTop();
?>
<?php
$notify->Notify();
		if($submit=="Submit")
			$student_obj->EditStudentDetails('server',$vid);
		else
			$student_obj->EditStudentDetails('local',$vid);
?>
<?php $disp -> displayPageBottom(); ?>   

