
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class Contactdetail{
	
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
	
	
	function Addcontactdetail($runat)
	{
    
		switch($runat){
			case 'local':
						$FormName = "frm_contact";
						$ControlNames=array("address"			=>array('address',"''","Please enter address.","span_content"),
                                                    "contact"			=>array('contact',"''","Please enter contact no.","span_contact"),
                                                    "email"			=>array('email',"''","Please enter email.","span_email")
						);

						$ValidationFunctionName="CheckcategoryValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
                        <div class="mws-panel grid_2">
                        <div class="mws-panel-header">
                        <span><a href="showcontactdetail.php"/><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All Contact</button></a></span>
                        </div>
                        </div>
                        
                        <div class="mws-panel grid_7">
                    <div class="mws-panel-header">
                        <span>Add Contact</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                         <div class="mws-form-inline">
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Address</label>
                                    <div class="mws-form-item">
                                        <textarea   class="large" name="address"></textarea>
                                     
                                        <span id="span_content"></span>
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Contact No.</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" rel="tooltip" data-placement="bottom" name="contact" data-original-title="Heading">
                                     
                                        <span id="span_contact"></span>
                                    </div>
                                </div>
                             <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Email</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" rel="tooltip" data-placement="bottom" name="email" data-original-title="Heading">
                                     
                                        <span id="span_email"></span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="mws-button-row">
                                <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return '<?php echo $ValidationFunctionName?>'();">
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
							
							$insert_sql_array = array();
							
							$insert_sql_array['address'] = $this->address;
                                                        $insert_sql_array['contact'] = $this->contact;
                                                        $insert_sql_array['email'] = $this->email;
							
						    $this->db->insert(TBL_CONTACT_DETAILS,$insert_sql_array);
							
							$_SESSION['msg'] = 'Contact has been Successfully Added';
							
							?>
							<script type="text/javascript">
								window.location = "addcontactdetail.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->Addcontactdetail('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	}
	                  
					  
		 function showacontact()
		 {
			?>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <a href="addcontactdetail.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New Contact</button></div></a>
                        </div>
                        </div>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>Contact List</span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">ID</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        
                        <th width="8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_CONTACT_DETAILS." order by id desc" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
			while($row = $this->db->fetch_array($result))
				{
				?>
                					<tr>
                                    <td><?php echo $x?></td>
                                    <td><div style="height:50px; overflow:auto;"><?php echo $row['address'];?></div></td>
                                    <td><div style="height:50px; overflow:auto;"><?php echo $row['contact'];?></div></td>
                                     <td><div style="height:50px; overflow:auto;"><?php echo $row['email'];?></div></td>
                                     
                                    <td><a href="editcontactdetail.php?vid=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>
                                    <a href="javascript: void(0);" title="Delete" rel="tooltip" data-placement="top"
					onclick="javascript: if(confirm('Do u want to delete this Contact?')) { contactdetail.deletecontact('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a></td>
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
                                <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return '<?php echo $ValidationFunctionName?>'();">
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
	
	function deletecontact($id)
	{
			ob_start();
		
		$sql="delete from ".TBL_CONTACT_DETAILS." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		$_SESSION['msg']='Contact has been Deleted successfully';
		
		?>
		<script type="text/javascript">
	 window.location= "showcontactdetail.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
				
			
				
				
}


?>