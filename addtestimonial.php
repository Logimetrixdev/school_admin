<?php
require_once("class/config.inc.php");
require_once("class/class.testimonial.php");
$ajax=new PHPLiveX();
$testimonial = new Testimonial();
extract($_REQUEST);
$ajax->AjaxifyObjects(array("testimonial")); 
$notify = new Notification();
$disp = new basic_page();
$disp->auth->CheckAdminlogin();
//import all css
 $disp -> setImportCss1('<link rel="stylesheet" type="text/css" href="plugins/colorpicker/colorpicker.css" media="screen">');
$disp -> setImportCss2('<link rel="stylesheet" type="text/css" href="custom-plugins/picklist/picklist.css" media="screen">');
$disp -> setImportCss3('<link rel="stylesheet" type="text/css" href="plugins/select2/select2.css" media="screen">');
$disp -> setImportCss4('<link rel="stylesheet" type="text/css" href="plugins/ibutton/jquery.ibutton.css" media="screen">');
$disp -> setImportCss5('<link rel="stylesheet" type="text/css" href="plugins/cleditor/jquery.cleditor.css" media="screen">');

$disp -> setImportCss6('<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">');
$disp -> setImportCss7('<link rel="stylesheet" type="text/css" href="css/fonts/ptsans/stylesheet.css" media="screen">');
$disp -> setImportCss8('<link rel="stylesheet" type="text/css" href="css/fonts/icomoon/style.css" media="screen">');

$disp -> setImportCss9('<link rel="stylesheet" type="text/css" href="css/mws-style.css" media="screen">');
$disp -> setImportCss10('<link rel="stylesheet" type="text/css" href="css/icons/icol16.css" media="screen">');
$disp -> setImportCss11('<link rel="stylesheet" type="text/css" href="css/icons/icol32.css" media="screen">');
$disp -> setImportCss12('<link rel="stylesheet" type="text/css" href="css/demo.css" media="screen">');

$disp -> setImportCss13('<link rel="stylesheet" type="text/css" href="jui/css/jquery.ui.all.css" media="screen">');
$disp -> setImportCss14('<link rel="stylesheet" type="text/css" href="jui/jquery-ui.custom.css" media="screen">');
$disp -> setImportCss15('<link rel="stylesheet" type="text/css" href="css/mws-theme.css" media="screen">');
$disp -> setImportCss16('<link rel="stylesheet" type="text/css" href="css/themer.css" media="screen">');






//import all js
$disp -> setExtJavaScripts1('js/libs/jquery-1.8.3.min.js'); // might not need
$disp -> setExtJavaScripts2('js/libs/jquery.mousewheel.min.js');
$disp -> setExtJavaScripts3('js/libs/jquery.placeholder.min.js');
$disp -> setExtJavaScripts4('custom-plugins/fileinput.js');

$disp -> setExtJavaScripts5('jui/js/jquery-ui-1.9.2.min.js');
$disp -> setExtJavaScripts6('jui/jquery-ui.custom.min.js');
$disp -> setExtJavaScripts7('jui/js/jquery.ui.touch-punch.js');

$disp -> setExtJavaScripts8('jui/js/globalize/globalize.js');
$disp -> setExtJavaScripts9('jui/js/globalize/cultures/globalize.culture.en-US.js');

$disp -> setExtJavaScripts10('custom-plugins/picklist/picklist.min.js');
$disp -> setExtJavaScripts11('plugins/autosize/jquery.autosize.min.js');
$disp -> setExtJavaScripts12('plugins/select2/select2.min.js');
$disp -> setExtJavaScripts13('plugins/colorpicker/colorpicker-min.js');
$disp -> setExtJavaScripts14('plugins/validate/jquery.validate-min.js');
$disp -> setExtJavaScripts15('plugins/ibutton/jquery.ibutton.min.js');
$disp -> setExtJavaScripts16('plugins/cleditor/jquery.cleditor.min.js');
$disp -> setExtJavaScripts17('plugins/cleditor/jquery.cleditor.table.min.js');
$disp -> setExtJavaScripts18('plugins/cleditor/jquery.cleditor.xhtml.min.js');
$disp -> setExtJavaScripts19('plugins/cleditor/jquery.cleditor.icon.min.js');
$disp -> setExtJavaScripts20('bootstrap/js/bootstrap.min.js');
$disp -> setExtJavaScripts21('js/core/mws.js');
$disp -> setExtJavaScripts22('js/core/themer.js');
$disp -> setExtJavaScripts23('js/demo/demo.formelements.js');






$disp->displayPageTop();
?>
<?php
$notify->Notify();
		if($submit=="Submit")
			$testimonial->Addtestimonial('server');
		else
			$testimonial->Addtestimonial('local');
?>
	
                    
                         
<?php $disp -> displayPageBottom(); ?>   

