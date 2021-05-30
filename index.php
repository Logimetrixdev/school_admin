<?php
require_once("class/config.inc.php");
$notify = new Notification();
$disp = new basic_page();
$user = new User();
extract($_REQUEST);
$disp -> setImportCss2('<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">');
$disp -> setImportCss3('<link rel="stylesheet" type="text/css" href="css/fonts/ptsans/stylesheet.css" media="screen">');
$disp -> setImportCss4('<link rel="stylesheet" type="text/css" href="css/fonts/icomoon/style.css" media="screen">');
$disp -> setImportCss11('<link rel="stylesheet" type="text/css" href="css/mws-theme.css" media="screen">');
$disp -> setImportCss12('<link rel="stylesheet" type="text/css" href="css/login.css" media="screen">');


$disp -> setExtJavaScripts1('js/libs/jquery-1.8.3.min.js'); // might not need
$disp -> setExtJavaScripts3('js/libs/jquery.placeholder.min.js');
$disp -> setExtJavaScripts4('custom-plugins/fileinput.js');
$disp -> setExtJavaScripts14('plugins/validate/jquery.validate-min.js');
$disp -> setExtJavaScripts20('jui/js/jquery-ui-effects.min.js');
$disp -> setExtJavaScripts21('jui/js/jquery-ui-effects.min.js');


$disp->displayPageTop1();

$notify->Notify();
if(!($disp->auth->checkAdminAuthentication())){
	if($adminlogin=="Login")
		$user->AdminLogin("server");
	else
		$user->AdminLogin("local");
} else {
	?>
	<script language="javascript">window.location='home.php'</script>
	<?php
}?>

    <!-- JavaScript Plugins -->
    <?php $disp -> displayPageBottom1(); ?>  
