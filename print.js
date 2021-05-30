function printpage(id) {
//alert(ctrl);
var DocumentContainer = document.getElementById(id);
//alert(DocumentContainer);
var WindowObject = window.open('', "TrackHistoryData", "width=1000,height=1000,top=250,left=345,toolbars=no,scrollbars=no,status=no,resizable=no");
//alert(ctrl);
//alert(DocumentContainer);
WindowObject.document.write("<html><head><title>Print Form</title><link rel=\"stylesheet\" type=\"text/css\" href=\"custom-plugins/wizard/wizard.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"bootstrap/css/bootstrap.min.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"css/fonts/ptsans/stylesheet.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"css/fonts/icomoon/style.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"css/mws-style.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"css/icons/icol16.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"css/icons/icol32.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"css/demo.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"jui/css/jquery.ui.all.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"jui/jquery-ui.custom.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"css/mws-theme.css\" media=\"screen\"><link rel=\"stylesheet\" type=\"text/css\" href=\"css/themer.css\" media=\"screen\"></head><body style=\"width:1000;\">");
WindowObject.document.write(DocumentContainer.innerHTML);
WindowObject.document.write('</body></html>');
//alert(ctrl);
WindowObject.document.close();
WindowObject.focus();
WindowObject.print();
//WindowObject.close();
} ;