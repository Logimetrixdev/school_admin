<?php
require_once("class/config.inc.php");
include_once("class/class.course_details.php");
$ajax=new PHPLiveX();
$course_obj = new CourseDeails();
extract($_REQUEST);
$ajax->AjaxifyObjects(array("course_obj")); 
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
$disp -> setImportCss8('<link rel="stylesheet" type="text/css" href="css/demo.css" media="screen">');
$disp -> setImportCss9('<link rel="stylesheet" type="text/css" href="jui/css/jquery.ui.all.css" media="screen">');
$disp -> setImportCss10('<link rel="stylesheet" type="text/css" href="jui/jquery-ui.custom.css" media="screen">');
$disp -> setImportCss11('<link rel="stylesheet" type="text/css" href="css/mws-theme.css" media="screen">');
$disp -> setImportCss12('<link rel="stylesheet" type="text/css" href="css/themer.css" media="screen">');

//import all js
$disp -> setExtJavaScripts1('js/libs/jquery-1.8.3.min.js'); // might not need
$disp -> setExtJavaScripts2('js/libs/jquery.mousewheel.min.js');
$disp -> setExtJavaScripts3('js/libs/jquery.placeholder.min.js');
$disp -> setExtJavaScripts4('custom-plugins/fileinput.js');
$disp -> setExtJavaScripts5('jui/js/jquery-ui-1.9.2.min.js');
$disp -> setExtJavaScripts6('jui/jquery-ui.custom.min.js');
$disp -> setExtJavaScripts7('jui/js/jquery.ui.touch-punch.js');
$disp -> setExtJavaScripts8('plugins/datatables/jquery.dataTables.min.js');
$disp -> setExtJavaScripts9('plugins/flot/jquery.flot.min.js');
$disp -> setExtJavaScripts10('plugins/flot/plugins/jquery.flot.tooltip.min.js');
$disp -> setExtJavaScripts11('plugins/flot/plugins/jquery.flot.pie.min.js');
$disp -> setExtJavaScripts12('plugins/flot/plugins/jquery.flot.stack.min.js');
$disp -> setExtJavaScripts13('plugins/flot/plugins/jquery.flot.resize.min.js');
$disp -> setExtJavaScripts14('plugins/validate/jquery.validate-min.js');
$disp -> setExtJavaScripts15('custom-plugins/wizard/wizard.min.js');
$disp -> setExtJavaScripts16('bootstrap/js/bootstrap.min.js');
$disp -> setExtJavaScripts17('js/core/mws.js');
$disp -> setExtJavaScripts18('js/core/themer.js');
$disp -> setExtJavaScripts19('js/demo/demo.dashboard.js');
$disp -> setExtJavaScripts20('');




$disp->displayPageTop();
?>
<?php
$notify->Notify();
		if($submit=="Submit")
			$course_obj->AddCourseDetails('server');
		else
			$course_obj->AddCourseDetails('local');
?>
<?php $disp -> displayPageBottom(); ?>   

