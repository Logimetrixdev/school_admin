
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work to User.
					
************************************************************************************/

class Tcportal{
	
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
	
	
	function Addtcportal($runat)
	{
    
		switch($runat){
			case 'local':
						$FormName = "frm_contact";
						$ControlNames=array("scholor_id"        =>array('scholor_id',"''","Please enter scholor id.","span_scholor_id"),
                                                    "student_name"			=>array('student_name',"''","Please enter student name.","span_student_name"),
                                                    "tc"			=>array('tc',"''","Please select tc.","span_tc")
						);

						$ValidationFunctionName="CheckcategoryValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
                        <div class="mws-panel grid_2">
                        <div class="mws-panel-header">
                        <span><a href="showtcportal.php"/><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All TC</button></a></span>
                        </div>
                        </div>
                        
                        <div class="mws-panel grid_7">
                    <div class="mws-panel-header">
                        <span>Add TC</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                         <div class="mws-form-inline">
                                     <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Scholor ID</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" rel="tooltip" data-placement="bottom" name="scholor_id" data-original-title="Heading">
                                     
                                        <span id="span_scholor_id"></span>
                                    </div>
                                </div>
                             <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Student Name</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" rel="tooltip" data-placement="bottom" name="student_name" data-original-title="Heading">
                                     
                                        <span id="span_student_name"></span>
                                    </div>
                                </div>
                             <div class="mws-form-row">
                                    	<label class="mws-form-label">TC</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="tc" value="">
                                            <span style="color:#F00;" id="span_tc"></span>
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
							if ($_FILES["tc"]["error"] > 0)
							{
							//echo "Error: " . $_FILES["filess"]["error"] . "<br />";
							echo 'Invalid file';
							}
							else
							{
							"Upload: " . $_FILES["file"]["name"] . "<br />";
							 "Type: " . $_FILES["file"]["type"] . "<br />";
							 "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
							 "Stored in: " . $_FILES["file"]["tmp_name"];
							$tmpname=$_FILES["tc"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["tc"]["type"];
							$type= explode('/',$tmp);
							
                           // if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF'||$type[1]=='pdf'||$type[1]=='PDF'||$type[1]=='doc'||$type[1]=='docx')
                            {
							
						    $path= $tmx.".".$type[1];
							
							move_uploaded_file($_FILES["tc"][tmp_name],"../images/".$path); 
							}
                                                      //  else
								{
									echo 'Invalid file';
								
									
								}
                                                        }
							$this->path=$path;
							$this->scholor_id = $scholor_id;
                                                        $this->student_name = $student_name;
                                                       
							//server side validation
							$return =true;
							
							if($this->Form->ValidField($path,'empty','Please Select an Image')==false)
								$return =false;
							if($return){
							
							$insert_sql_array = array();
							
							$insert_sql_array['scholor_id'] = $this->scholor_id;
                                                        $insert_sql_array['student_name'] = $this->student_name;
                                                        $insert_sql_array['tc'] = $this->path;
							
						        $this->db->insert(TBL_TCPORTAL,$insert_sql_array);
							
							$_SESSION['msg'] = 'Record has been Successfully Added';
							
							?>
							<script type="text/javascript">
								window.location = "addtcportal.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->Addtcportal('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
                            
		}
	
	}
	                  
					  
		 function showtcportal()
		 {
			?>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <a href="addtcportal.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New TC</button></div></a>
                        </div>
                        </div>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>TC List</span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">S.No.</th>
                        <th>Scholor ID</th>
                        <th>Student Name</th>
                        <th>TC</th>
                        
                        <th width="8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                   <?php 
			                       
		    $sql="select * from ".TBL_TCPORTAL." order by id desc" ;
		    $result= $this->db->query($sql,__FILE__,__LINE__);
		    $x=1;
		    while($row = $this->db->fetch_array($result))
		    {
	            ?>
                <tr style="text-align:center;">
                   <td><?php echo $x;?></td>
                   <td><?php echo $row['scholor_id'];?></td>
                   <td><?php echo $row['student_name'];?></td>
                   <td><a href="../images/<?php echo $row['tc'];?>" download>Download</a></td>
                   <td> <a href="javascript: void(0);" title="Delete" rel="tooltip" data-placement="top" onclick="javascript: if(confirm('Do u want to delete this TC?')) { tcportal.deletetcportal('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a></td>
                 </tr>
                <?php 
				$x++;
				}
				?>
                               
                    </tbody>
                  </table>
                </div>
              </div>
	
             <?php 
		      }
		       function editcontactdetail($runat,$id)
			 {
				
    
		switch($runat){
			case 'local':
						$FormName = "frm_editcontact";
						$ControlNames=array("address"			=>array('address',"''","Please enter address.","span_content"),
                                                    "contact"			=>array('contact',"''","Please enter contact no.","span_contact"),
                                                    "email"			=>array('email',"''","Please enter email.","span_email")
						 );

						$ValidationFunctionName="CheckeditcategoryValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						$sql="select * from ".TBL_CONTACT_DETAILS." where id='".$id."'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
                        
                 <div class="mws-panel grid_6">
                    <div class="mws-panel-header">
                     <span>Edit Contact</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                         <div class="mws-form-inline">
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Address</label>
                                    <div class="mws-form-item">
					<textarea  class="large" name="address"><?php echo $row['address'];?></textarea>
                                    
                                        <span id="span_content"></span>
                                    </div>
                                </div>
                              <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Contact No.</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" rel="tooltip" data-placement="bottom" name="contact" value="<?php echo $row['contact'];?>" data-original-title="Heading">
                                     
                                        <span id="span_contact"></span>
                                    </div>
                                </div>
                             <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Email</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" rel="tooltip" data-placement="bottom" name="email" value="<?php echo $row['email'];?>" data-original-title="Heading">
                                     
                                        <span id="span_email"></span>
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
							
							$this->address = $address;
                                                        $this->contact = $contact;
                                                        $this->email = $email;
							
							
							//server side validation
							$return =true;
							if($return){
							
							$update_sql_array = array();
							
							$update_sql_array['address'] = $this->address;
                                                        $update_sql_array['contact'] = $this->contact;
                                                        $update_sql_array['email'] = $this->email;
							
							$this->db->update(TBL_CONTACT_DETAILS,$update_sql_array,'id',$id);
							
							$_SESSION['msg'] = 'Contact has been Successfully Updated';
							
							?>
							<script type="text/javascript">
								window.location = "showcontactdetail.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->editcontactdetail('local','$id');
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
	
	function deletetcportal($id)
	{
			ob_start();
		
		$sql="delete from ".TBL_TCPORTAL." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		$_SESSION['msg']='Record has been Deleted successfully';
		
		?>
		<script type="text/javascript">
	 window.location= "showtcportal.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
				
			
				
				
}


?>