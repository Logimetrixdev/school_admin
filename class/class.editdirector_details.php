
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class Director_Details{
	
	 var $user_id;
	 var $user;
	 var $type;
	 var $password;
	 var $db;
	 var $validity;
	 var $Form;
	 var $new_pass;
	 var $confirm_pass;
	 var $auth;
	 
	 
	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
		$this->mailer = new PHPMailer();
	}

	
	      function editdirectormsg($runat)
			{
				
    
		switch($runat){
			case 'local':
						$FormName = "frm_editpage";
						$ControlNames=array("heading"		=>array('heading',"''","Please Enter heading","span_heading"),
										"ditector_name"		=>array('ditector_name',"''","Please Enter Director Name","span_ditector_name"),
									"ditector_postion"		=>array('ditector_postion',"''","Please Enter Designation","span_ditector_postion")
											
										
						 );

						$ValidationFunctionName="CheckeditpageValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						$sql="select * from ".TBL_DIRECTOR." where id='1'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
                        
                       
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Edit Director Details</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Heading</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading" value="<?php echo $row['heading'];?>">
                                        <span style="color:#F00;" id="span_heading"></span>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Name</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Name" rel="tooltip" data-placement="bottom" name="ditector_name" value="<?php echo $row['ditector_name'];?>">
                                        <span style="color:#F00;" id="span_ditector_name"></span>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Designation</label>
                                    <div class="mws-form-item">
            <input type="text" class="large" title="Designation" rel="tooltip" data-placement="bottom" name="ditector_postion" value="<?php echo $row['ditector_postion'];?>">
                                        <span style="color:#F00;" id="span_ditector_postion"></span>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    	<label class="mws-form-label">Select  Image</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="filess">
                                            <br/>
                                            <img src="../gallery/<?php echo $row['image'];?>" style="height:120px; width:120px;"/>
                                       </div>
                                </div>
                                <div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
							include_once("fckeditor/fckeditor.php");
							
							$sBasePath = $_SERVER['PHP_SELF'] ;
							$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
							
							$oFCKeditor = new FCKeditor('description') ;
							$oFCKedditor->skin="office";
							$oFCKeditor->BasePath	= $sBasePath ;
							$oFCKeditor->Value		=  $row['content']; ;
							$oFCKeditor->Create() ;
							?>
                 
                    				</div>
                    			</div>
                                
                           </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							
							//server side validation
						
							
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_DIRECTOR." where id='1'" ;
							$result3= $this->db->query($sql3,__FILE__,__LINE__);
							$row3= $this->db->fetch_array($result3);
						    $path=$row3['image'];
							}
							else
							{
							
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
							{						
						
						    $path= 'userimage'.$tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								}
							}
							
							$this->path=$path;
							$this->heading=$heading; 
							$this->ditector_name=$ditector_name; 
							$this->ditector_postion=$ditector_postion; 
							$this->description=$description; 
							
							
							
							
								
					
							//server side validation
							$return =true;
						if($this->Form->ValidField($heading,'empty','Please Enter heading')==false)
							$return =false;
						if($this->Form->ValidField($ditector_name,'empty','Please Enter name')==false)
							$return =false;
						if($this->Form->ValidField($ditector_postion,'empty','Please Enter Designation')==false)
							$return =false;
							
							if($return){
							
							$update_sql_array = array();
							
							$update_sql_array['heading'] = $this->heading;
							$update_sql_array['ditector_name'] =  $this->ditector_name;
							$update_sql_array['ditector_postion'] =  $this->ditector_postion;
							$update_sql_array['content'] = $this->description;
							$update_sql_array['image'] = $this->path;
							
							
							
							$this->db->update(TBL_DIRECTOR,$update_sql_array,'id',1);
							
							$_SESSION['msg'] = 'Director Details has been Successfully Updated';
							
							?>
							<script type="text/javascript">
								window.location = "editdirector_details.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->editdirectormsg('local','$id');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	}
	
	
	
	
	function editcontact_details($runat)
			{
				
    
		switch($runat){
			case 'local':
						$FormName = "frm_editcontact";
						$ControlNames=array("contact"		=>array('contact',"''","Please Enter Contact Number","span_contact"),
										"email"		=>array('email',"EMail","Please Enter Email Id","span_email")
						 );

						$ValidationFunctionName="CheckeditpagecontactValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						$sql="select * from ".TBL_CONTACT_DETAILS." where id='1'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
                        
                       
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Edit Contact Number</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Contact Number</label>
                                    <div class="mws-form-item">
  <input type="text" class="large" title="Contact Number" rel="tooltip" data-placement="bottom" name="contact" value="<?php echo $row['contact'];?>"> <span style="color:#F00;" id="span_contact"></span>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Email Address</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Email Address" rel="tooltip" data-placement="bottom" name="email" value="<?php echo $row['email'];?>">
                                        <span style="color:#F00;" id="span_email"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="mws-form-row">
                    				<label class="mws-form-label">Address</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
							include_once("fckeditor/fckeditor.php");
							
							$sBasePath = $_SERVER['PHP_SELF'] ;
							$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
							
							$oFCKeditor = new FCKeditor('description') ;
							$oFCKedditor->skin="office";
							$oFCKeditor->BasePath	= $sBasePath ;
							$oFCKeditor->Value		=  $row['content']; ;
							$oFCKeditor->Create() ;
							?>
                 
                    				</div>
                    			</div>
                                
                           </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							
							//server side validation
						
							
						
							
						
							$this->contact=$contact; 
							$this->email=$email; 
							$this->description=$description; 
						
						
						
								/*$this->mailer->IsHTML(true);
								$this->mailer->From = "Abhishek Mihsra";
								$this->mailer->FromName = "Infinite Websoft";
								$this->mailer->Sender = 'info@infitewebsite.com';
								$this->mailer->AddAddress($this->email,'abhimishrait@gmail.com');
								$this->mailer->Subject = 'Contact Form';	
							
								$this->mailer->Body = '<div style="padding:10px;"><br/>';
								$this->mailer->Body .= 'test email';
								$this->mailer->Body .= '</div>';
								
								$this->mailer->WordWrap = 50;
								$this->mailer->Send();*/
								$subject = 'Contact Form';
								$messege = 'Hi this is test';
								mail($email,$subject,$messege);
								
								
					
							//server side validation
							$return =true;
						if($this->Form->ValidField($contact,'empty','Please Enter Contact Number')==false)
							$return =false;
						if($this->Form->ValidField($email,'empty','Please Enter Email Address')==false)
							$return =false;
						if($this->Form->ValidField($description,'empty','Please Enter Adress')==false)
							$return =false;
							
							if($return){
							
							$update_sql_array = array();
							
							$update_sql_array['contact'] = $this->contact;
							$update_sql_array['email'] =  $this->email;
							$update_sql_array['content'] = $this->description;
							
							
							
							
							$this->db->update(TBL_CONTACT_DETAILS,$update_sql_array,'id',1);
							
							$_SESSION['msg'] = 'Contact Details has been Successfully Updated';
							
							?>
							<script type="text/javascript">
								window.location = "editcontactdetails.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->editcontact_details('local','$id');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	}
	
	
	
	
	
	
	
	function flashNews($runat)
			{
				
    
		switch($runat){
			case 'local':
						$FormName = "frm_flashNews";
						$ControlNames=array("contact"		=>array('contact',"''","Please Enter Contact Number","span_contact")
						 );

						$ValidationFunctionName="CheckeditflashNewsValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						$sql="select * from ".TBL_ANNOUNCE." where anc_id='1'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
                        
                       
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>New News</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		<div class="mws-form-inline">
                    		
                                
                                
                                <div class="mws-form-row">
                    				<label class="mws-form-label">News</label>
                    				<div style="height:330px;" class="mws-form-item">
                    					<?php
							include_once("fckeditor/fckeditor.php");
							
							$sBasePath = $_SERVER['PHP_SELF'] ;
							$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
							
							$oFCKeditor = new FCKeditor('description') ;
							$oFCKedditor->skin="office";
							$oFCKeditor->BasePath	= $sBasePath ;
							$oFCKeditor->Value		=  $row['anc_content']; ;
							$oFCKeditor->Create() ;
							?>
                 
                    				</div>
                    			</div>
                                
                           </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
						
						<?php 
					
						break;
			case 'server':
							extract($_POST);
							
							//server side validation
						
							$this->description=$description; 
						
					
							//server side validation
							$return =true;
					
						if($this->Form->ValidField($description,'empty','Please Enter Adress')==false)
							$return =false;
							
							if($return){
							
							$update_sql_array = array();
							
							$update_sql_array['anc_content'] = $this->description;
							
							
							
							
							$this->db->update(TBL_ANNOUNCE,$update_sql_array,'anc_id',1);
							
							$_SESSION['msg'] = 'News Details has been Successfully Updated';
							
							?>
							<script type="text/javascript">
								window.location = "flashnews.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->flashNews('local','$id');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	}
	

				
}


?>