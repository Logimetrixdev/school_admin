<?php
require_once("class/class.Authentication.php");
class basic_page
{
  var $page_keywords;
  var $page_description;
  var $page_title;
  var $active_button;  // The active button for navagation (navagation section)
  var $inner_nav; // The active page for navagation
  var $css1; // normally main_style.css which is the style sheet that define the standard elements of all pages.
  var $css2;
  var $css3;
  var $css4;
  var $css5;
  var $css6;
  var $css7;
  var $css8;
  var $css9;
  var $css10;
  var $css11;
  var $css12;
  var $css13;
  var $css14;
  var $css15;
  var $css16;
  var $css17;
  var $css18;
  var $css19;
  
  var $page_style; // this should be used sparingly; Use external style sheets.
  var $ext_java_scripts1; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts2; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts3; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts4; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts5; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts6; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts7; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts8; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts9; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts10; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts11; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts12; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts13; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts14; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts15; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts16; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts17; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts18; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts19; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts20; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts21; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts22; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts23; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts24; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts25; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $ext_java_scripts26; /* should be in the form of "<script language="javascript" SRC="the_file_url.js"></script>" */
  var $custom_java_scripts;  /* the <script> tags are already printed.  This if for javascript functions */
  var $body_script; // Add an onLoad script into the <body> tag.  Should be in the form of 'onLoad="javascriptFunction()"'
  var $auth;	//Authentication variable
  var $access_rules;			// It stores the user group & their types in which user needs to be in to access this page (may be all or them or any of them)
  var $access_rules_type;		// any or all , it determines how rules condition should be applied
  var $user_navigation_buttons; // Buttons to display on top of the page
  var $username;		// username to show on top navigation pannel 
  var $button1_name;     // button for navigation pannel
  var $button1_link;     // button link for navigation pannel
  var $button2_name;     // button for navigation pannel
  var $button2_link;     // button link for navigation pannel
  var $sidetab1;
  var $sidetablink1;
  var $sidetab2;
  var $sidetablink2;
  var $sidetab3;
  var $sidetablink3;
  var $sidetab4;
  var $sidetablink4;
  var $sidetab5;
  var $sidetablink5;
  var $sidetab6;
  var $sidetablink6;
  var $sidetab7;
  var $sidetablink7;
  var $sidetab8;
  var $sidetablink8;
  var $sidetab9;
  var $sidetablink9;
  var $sidetab10;
  var $sidetablink10;

	function __construct()
   {
	 $this->auth=new Authentication();
   }

  // sets the meta-keywords for the new page
  
  
  // sets imported css.  #1 is the main_style.css
  function setImportCss1($css_1)
  {
    $this->css1 = $css_1;
  }
  
  // sets next css import file
  function setImportCss2($css_2)
  {
    $this->css2 = $css_2;
  }

  // sets next css import file
  function setImportCss3($css_3)
  {
    $this->css3 = $css_3;
  }

  // sets next css import file
  function setImportCss4($css_4)
  {
    $this->css4 = $css_4;
  }

  // sets next css import file
  function setImportCss5($css_5)
  {
    $this->css5 = $css_5;
  }
  
  function setImportCss6($css_6)
  {
    $this->css6 = $css_6;
  }
  
  function setImportCss7($css_7)
  {
    $this->css7 = $css_7;
  }
  
  function setImportCss8($css_8)
  {
    $this->css8 = $css_8;
  }
  
  function setImportCss9($css_9)
  {
    $this->css9 = $css_9;
  }
  
  function setImportCss10($css_10)
  {
    $this->css10 = $css_10;
  }
  
  function setImportCss11($css_11)
  {
    $this->css11 = $css_11;
  }
  
  function setImportCss12($css_12)
  {
    $this->css12 = $css_12;
  }
  
  function setImportCss13($css_13)
  {
    $this->css13 = $css_13;
  }
  
  function setImportCss14($css_14)
  {
    $this->css14 = $css_14;
  }
  
  function setImportCss15($css_15)
  {
    $this->css15 = $css_15;
  }
  function setImportCss16($css_16)
  {
    $this->css16 = $css_16;
  }
  
  
		  function displayPageTop()
		  {
			  
                            $this->printDocType(); 
                            $this->printHTMLStart(); 
                            $this->printHeadStart();
                            $this->printCharEncod();
                            $this->printMetaAuthor(); 
                            $this->printTitle(); 
                            $this->printMainStyle();
                            $this->printHeadEnd();
                            //$this->printHeader();
                            $this->printBodyStart();
														
									
		  }
		  	  function displayPageTop1()
		  {
			  
                            $this->printDocType(); 
                            $this->printHTMLStart(); 
                            $this->printHeadStart();
                            $this->printCharEncod();
                            $this->printMetaAuthor(); 
                            $this->printTitle(); 
                            $this->printMainStyle();
                            $this->printHeadEnd();
                            //$this->printHeader();
                            $this->printBodyStart1();
		  }
		  		  
		   function printBodyStart1()
		  {
			echo '<body>
			';
  		  }
		  
		  
		  function printDoctype()
		  {
			echo '<!DOCTYPE html>';
		  }
		  
		 function printHTMLStart()
		  {
				echo '<html lang="en">';
 		  }
		  
		  function printHeadStart()
		  {
			echo '<head>';
		  }
	      
		  function printCharEncod()
		  {
			echo '<meta charset="utf-8">';
		  }
		  
		   function printMetaAuthor()
		  {
			echo '<meta name="viewport" content="width=device-width,initial-scale=1.0">';
		  }
		  
		  function printTitle()
		  {
			echo '<link rel="shortcut icon" href="sjs.png" /><title>Admin Panel</title>';
		  }
		  
		   function printHeadEnd()
		  {
			echo '</head>';
		  }
		  
		  function printBodyStart()
		  {
			echo '<body>
			<div id="mws-header" class="clearfix">
    
    	<!-- Logo Container -->
    	<div id="mws-logo-container">
        
        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<div id="mws-logo-wrap">
            	<h1 style="color:#424242; font-size:17px">School Admin Panel</h1>
				
			</div>
        </div>'; 
		$this->userProfile();
		echo ' </div>
		<div id="mws-wrapper">
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>';
		$this->DisplaySidebarMenu();
		echo '<div id="mws-container" class="clearfix"><div class="container">
 ';
  		  }
		  		  
		  
		  function userProfile()
		  {
			?>
            <div id="mws-user-tools" class="clearfix">
        
        	<!-- Notifications -->
        	           
            <!-- Messages -->
                       
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            
            	<!-- User Photo -->
            	<div id="mws-user-photo">
                	 <b style="padding-left: 3px; color: #0086bf; font-size: 17px;">SjS</b><!--<img src="../images/hid.png"	>-->
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hi.. <?php echo $_SESSION['user_name'];?>
                    </div>
                    <ul>
                    	<!--<li><a href="#">Profile</a></li>-->
                    <li><a href="changepassword.php">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
            <?php   
		  }
		  			
			function DisplaySidebarMenu()
	          {
				?>
                                <div id="mws-sidebar">
                                
                                <!-- Hidden Nav Collapse Button -->
                                <div id="mws-nav-collapse">
                                <span></span>
                                <span></span>
                                <span></span>
                                </div>
                                
                                <!-- Searchbox -->
                                
                                
                                <!-- Main Navigation -->
                                <div id="mws-navigation">
                                <ul>
                                <li class="active"><a href="home.php"><i class="icon-home"></i>Home</a></li>
<!--				<li><a href="addlogo.php"><i class="icon-table"></i>Manage Logo</a></li>-->
                                <li><a href="showallslider.php"><i class="icon-table"></i>Manage Slider</a></li>
                                <li><a href="showhome.php"><i class="icon-table"></i>Manage Home</a></li>
                                <li><a href="showallpage.php"><i class="icon-table"></i>Manage Page</a></li>
                                <!--<li><a href="showallsubjects.php"><i class="icon-table"></i>Manage Subject</a></li>-->
                                <li><a href="showallimg.php"><i class="icon-table"></i>Manage Gallery</a></li>
                                <li><a href="showalltestimonial.php"><i class="icon-table"></i>Manage News</a></li>
                                <li><a href="showresult.php"><i class="icon-table"></i>Manage Result</a></li>
                                <li><a href="contact.php"><i class="icon-table"></i>Contact</a></li>
                                <li><a href="showallcareer.php"><i class="icon-table"></i>Careers</a></li>
<!--                            <li><a href="feedback.php"><i class="icon-table"></i>Feedback</a></li>
                                <li><a href="enquiry.php"><i class="icon-table"></i>Enquiry</a></li>-->
                                <li><a href="showcontactdetail.php"><i class="icon-table"></i>Contact Detail</a></li>
                                <li><a href="showtcportal.php"><i class="icon-table"></i>TC Portal</a></li>
                                <li><a href="showsyllabus.php"><i class="icon-table"></i>Syllabus</a></li>
                            
                             </ul>
                            </div>         
                          </div>
                <?php
			}
	
  function displayPageBottom()
  {

	$this->printFooter();
	$this->JavaScriptFooter();
	$this->printBodyEnd();
	$this->printHTMLEnd();
  }
  
  
  
    function displayPageBottom1()
  {
    $this->JavaScriptFooter();
	$this->printBodyEnd();
	$this->printHTMLEnd();
  }
  
 
  function JavaScriptFooter()
  {
	  $this->printExtJavaScripts();
	 
  }
	
	
	 // sets external java scripts that the page requires
  function setExtJavaScripts1($ext_custom_scripts)
  {
	$this->ext_java_scripts1 = $ext_custom_scripts;
  }

  function setExtJavaScripts2($ext_custom_scripts)
  {
	$this->ext_java_scripts2 = $ext_custom_scripts;
  }

  function setExtJavaScripts3($ext_custom_scripts)
  {
	$this->ext_java_scripts3 = $ext_custom_scripts;
  }

  function setExtJavaScripts4($ext_custom_scripts)
  {
	$this->ext_java_scripts4 = $ext_custom_scripts;
  }
  
  function setExtJavaScripts5($ext_custom_scripts)
  {
	$this->ext_java_scripts5 = $ext_custom_scripts;
  }
  
  function setExtJavaScripts6($ext_custom_scripts)
  {
	$this->ext_java_scripts6 = $ext_custom_scripts;
  }
  
  function setExtJavaScripts7($ext_custom_scripts)
  {
	$this->ext_java_scripts7 = $ext_custom_scripts;
  }
  
  function setExtJavaScripts8($ext_custom_scripts)
  {
	$this->ext_java_scripts8 = $ext_custom_scripts;
  }
  
  function setExtJavaScripts9($ext_custom_scripts)
  {
	$this->ext_java_scripts9 = $ext_custom_scripts;
  }
  
  function setExtJavaScripts10($ext_custom_scripts)
  {
	$this->ext_java_scripts10 = $ext_custom_scripts;
  }

  function setExtJavaScripts11($ext_custom_scripts)
  {
	$this->ext_java_scripts11 = $ext_custom_scripts;
  }
  
  function setExtJavaScripts12($ext_custom_scripts)
  {
	$this->ext_java_scripts12 = $ext_custom_scripts;
  }
  
  function setExtJavaScripts13($ext_custom_scripts)
  {
	$this->ext_java_scripts13 = $ext_custom_scripts;
  }
  
  function setExtJavaScripts14($ext_custom_scripts)
  {
	$this->ext_java_scripts14 = $ext_custom_scripts;
  }
  
  function setExtJavaScripts15($ext_custom_scripts)
  {
	$this->ext_java_scripts15 = $ext_custom_scripts;
  }	
   function setExtJavaScripts16($ext_custom_scripts)
  {
	$this->ext_java_scripts16 = $ext_custom_scripts;
  }	
   function setExtJavaScripts17($ext_custom_scripts)
  {
	$this->ext_java_scripts17 = $ext_custom_scripts;
  }	
   function setExtJavaScripts18($ext_custom_scripts)
  {
	$this->ext_java_scripts18 = $ext_custom_scripts;
  }	
   function setExtJavaScripts19($ext_custom_scripts)
  {
	$this->ext_java_scripts19 = $ext_custom_scripts;
  }	
   function setExtJavaScripts20($ext_custom_scripts)
  {
	$this->ext_java_scripts20 = $ext_custom_scripts;
  }	
  function setExtJavaScripts21($ext_custom_scripts)
  {
	$this->ext_java_scripts21 = $ext_custom_scripts;
  }	
  function setExtJavaScripts22($ext_custom_scripts)
  {
	$this->ext_java_scripts22 = $ext_custom_scripts;
  }	
  function setExtJavaScripts23($ext_custom_scripts)
  {
	$this->ext_java_scripts23 = $ext_custom_scripts;
  }	
  function setExtJavaScripts24($ext_custom_scripts)
  {
	$this->ext_java_scripts24 = $ext_custom_scripts;
  }	
  
  
   function printExtJavaScripts()
  {
     if ( !empty($this->ext_java_scripts1) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts1.'"></script>';
     }
     if ( !empty($this->ext_java_scripts2) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts2.'"></script>';
     }
     if ( !empty($this->ext_java_scripts3) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts3.'"></script>';
     }
     if ( !empty($this->ext_java_scripts4) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts4.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts5) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts5.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts6) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts6.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts7) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts7.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts8) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts8.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts9) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts9.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts10) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts10.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts11) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts11.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts12) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts12.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts13) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts13.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts14) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts14.'"></script>';
     }
	 if ( !empty($this->ext_java_scripts15) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts15.'"></script>';
     }
	  if ( !empty($this->ext_java_scripts16) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts16.'"></script>';
     }
	  if ( !empty($this->ext_java_scripts17) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts17.'"></script>';
     }
	  if ( !empty($this->ext_java_scripts18) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts18.'"></script>';
     }
	  if ( !empty($this->ext_java_scripts19) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts19.'"></script>';
     } if ( !empty($this->ext_java_scripts20) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts20.'"></script>';
     }if ( !empty($this->ext_java_scripts21) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts21.'"></script>';
     }if ( !empty($this->ext_java_scripts22) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts22.'"></script>';
     }if ( !empty($this->ext_java_scripts23) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts23.'"></script>';
     }if ( !empty($this->ext_java_scripts24) )
	 {
     	echo '<script language="javascript" type="text/javascript" src="'.$this->ext_java_scripts24.'"></script>';
     }
	 
  }
  
	function printFooter()
	{
	echo '     
	</div> 
	 <div id="mws-footer">
            	&copy; School Admin 2014, All Rights Reserved Designed & Developed  by <a href="http://logimetrix.co.in" target="_blank">Logimetrix Tech Solutions Pvt.Ltd.</a> 
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>';
	}	
 function printBodyEnd()
  {
	echo '
</body>';
  }
  
  function printHTMLEnd()
  {
    echo '
</html>';
  }
  
 	function printMainStyle()
  {
	// the first css are for the drop down navigation on the home page
	echo $this->css1;
	echo $this->css2;
	echo $this->css3;
	echo $this->css4;
	echo $this->css5;
	echo $this->css6;
	echo $this->css7;
	echo $this->css8;
	echo $this->css9;
	echo $this->css10;
	echo $this->css11;
	echo $this->css12;
	echo $this->css13;
	echo $this->css14;
	echo $this->css15;
	echo $this->css16;

  }
  
}
?>