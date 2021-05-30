<?php
require_once("class/config.inc.php");
require_once("class/class.course.php");
$course_obj = new Course();
extract($_REQUEST);
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
 //  JavaScript Plugins 
$disp -> setExtJavaScripts1('js/libs/jquery-1.8.3.min.js'); // might not need
$disp -> setExtJavaScripts2('js/libs/jquery.mousewheel.min.js');
$disp -> setExtJavaScripts3('js/libs/jquery.placeholder.min.js');
$disp -> setExtJavaScripts4('custom-plugins/fileinput.js');

 //jQuery-UI Dependent Scripts 
$disp -> setExtJavaScripts5('jui/js/jquery-ui-1.9.2.min.js');
$disp -> setExtJavaScripts6('jui/jquery-ui.custom.min.js');
$disp -> setExtJavaScripts7('jui/js/jquery.ui.touch-punch.js');

// Plugin Scripts 
$disp -> setExtJavaScripts8('plugins/datatables/jquery.dataTables.min.js');
$disp -> setExtJavaScripts9('plugins/colorpicker/colorpicker-min.js');


    //Core Script 
$disp -> setExtJavaScripts17('bootstrap/js/bootstrap.min.js');
$disp -> setExtJavaScripts18('js/core/mws.js');

 //Themer Script (Remove if not needed) 
$disp -> setExtJavaScripts19('js/core/themer.js');

// Demo Scripts (remove if not needed) 
$disp -> setExtJavaScripts21('js/demo/demo.table.js');





$disp->displayPageTop();
?>
<?php
$notify->Notify();
		if($submit=="Submit")
			$course_obj->Addcourse('server');
		else
			$course_obj->Addcourse('local');
?>
	
                    
                         
<?php $disp -> displayPageBottom(); ?>   

