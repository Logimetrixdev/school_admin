
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class Logo{
	
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
		
	}

	
	function AddLogo($runat)
	{
    
		switch($runat){
			case 'local':
						$FormName = "frm_banners";
						?>
                        
<div class="mws-panel grid_6">
                	<div class="mws-panel-header">
                    	<span>Manage Logo</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		<div class="mws-form-inline">
                            <div class="mws-form-row">
                           
                                    	<label class="mws-form-label">Old Logo</label>
                        	            	<div class="mws-form-item">
                                        	<img src="../images/logo.png"/>
                                        </div>
                                </div>
                            <div class="mws-form-row">
                                    	<label class="mws-form-label">New Logo</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="filess" value="">
                                          
                                        </div>
                                        
                             </div>
                             <div class="mws-form-row">
                                    <div class="mws-form-item">
                                        	<div class="mws-form-item">
                                        	Only Upload (.png) format logo
                                    </div>
                              </div>
                    		</div>
                            </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
                       
                        
                        
                        
		<?php 
					
						break;
			case 'server':
							extract($_POST);
							
							//$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							//echo "Error: " . $_FILES["filess"]["error"] . "<br />";
							echo 'Invalid file';
							}
							else
							{
							/*  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
							echo "Type: " . $_FILES["file"]["type"] . "<br />";
							echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
							echo "Stored in: " . $_FILES["file"]["tmp_name"];*/
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='png')
								{						
						
						    	$path= 'logo'.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../images/".$path); 
								$_SESSION['msg'] = 'Logo has been Successfully Updated';
							
								}
								else
								{
								$_SESSION['error_msg'] = 'Invalid file load only png format images';
								}
								
							}
							?>
							<script type="text/javascript">
								window.location = "addlogo.php"
							</script>
                            <?php
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	}
	                  
					  
		function Editmember($runat,$id)
			{
				
    
		switch($runat){
			case 'local':
						$FormName = "frm_editcategory";
			$ControlNames=array("empname"			=>array('empname',"''","Please Enter Name","span_empname"),
											"field"			=>array('field',"''","Please enter field","span_field"),
											"edu"			=>array('edu',"''","Please Enter Education","span_edu"),
											"exp"			=>array('exp',"''","Please Enter Experience","span_exp"),
											"duration"			=>array('duration',"''","Please Enter Duration","span_duration")
					
											
											
						 );

						$ValidationFunctionName="CheckeditbannerValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						$sql="select * from ".TBL_TEAM." where id='".$id."'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
                        
                       
<div class="mws-panel grid_6">
                	<div class="mws-panel-header">
                    	<span>Edit Member</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		<div class="mws-form-inline">
                            <div class="mws-form-row">
                                    	<label class="mws-form-label">Member Image</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="filess" value="">
                                          
                                        </div>
                                </div>
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Name</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="Name" rel="tooltip" data-placement="bottom" name="empname" value="<?php echo $row['name'];?>">
                                        <span style="color:#F00;" id="span_empname"></span>
                                    </div>
                                </div>
                                
                                
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Field</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="large" title="Field" name="field" rel="tooltip" value="<?php echo $row['field'];?>" data-placement="bottom">
                                         <span style="color:#F00;" id="span_field"></span>
                    				</div>
                    			</div>
                                
                                <div class="mws-form-row">
                    				<label class="mws-form-label">Education</label>
                    				<div class="mws-form-item">
                    				<input type="text" class="large" title="Education" name="edu" value="<?php echo $row['edu'];?>" rel="tooltip" data-placement="bottom">
                                         <span style="color:#F00;" id="span_edu"></span>	
                    				</div>
                    			</div>
                                
                                <div class="mws-form-row">
                    				<label class="mws-form-label">Experience</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="large"  title="Experience" value="<?php echo $row['exp'];?>" name="exp" rel="tooltip" data-placement="bottom">
                                           <span style="color:#F00;" id="span_exp"></span>
                    				</div>
                    			</div>
                                
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Duration</label>
                    				<div class="mws-form-item">
                    				<input type="text" class="large" title="Duration" name="duration" value="<?php echo $row['duration'];?>" rel="tooltip" data-placement="bottom">
                                         <span style="color:#F00;" id="span_duration"></span>	
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
							
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_TEAM." where id='".$id."'" ;
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
							$this->empname=$empname; 
							$this->exp=$exp; 
							$this->edu=$edu; 
							$this->duration=$duration; 
							$this->field=$field; 
							
						
						
					
							//server side validation
							$return =true;
							if($return){
							
							$update_sql_array = array();
							
							
							
							$update_sql_array['name'] = $this->empname;
							
							$update_sql_array['exp'] = $this->exp;
							$update_sql_array['image'] = $this->path;
							$update_sql_array['edu'] = $this->edu;
							$update_sql_array['duration'] = $this->duration;
							$update_sql_array['field'] = $this->field;
							
							
							$this->db->update(TBL_TEAM,$update_sql_array,'id',$id);
							
							$_SESSION['msg'] = 'Member has been Successfully Updated';
							
							?>
							<script type="text/javascript">
								window.location = "showallteam.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->Editmember('local','$id');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	}
	
	function blockBank($id)
	{
		ob_start();
		
		$update_array = array();
		$update_array['status'] = 'block';
		
		$this->db->update(TBL_BANK,$update_array,'id',$id);
		
		$_SESSION['msg']='Bank has been Blocked successfully';
		
		?>
		<script type="text/javascript">
			window.location = "showbank.php"
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	function unblockBank($id)
	{
		ob_start();
		
		$update_array = array();
		$update_array['status'] = 'active';
		
		$this->db->update(TBL_BANK,$update_array,'id',$id);
		
		$_SESSION['msg']='Bank has been Un-Blocked successfully';
		
		?>
		<script type="text/javascript">
			window.location = "<?php $_SERVER['PHP_SELF'];?>"
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	function deleteteam($id)
	{
			ob_start();
		
		$sql="delete from ".TBL_TEAM." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		$_SESSION['msg']='Member has been Deleted successfully';
		
		?>
		<script type="text/javascript">
	 window.location= "showallteam.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
				
			
				
				
}


?>