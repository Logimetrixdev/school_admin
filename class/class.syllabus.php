
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work to User.
					
************************************************************************************/

class Syllabus{
	
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
	
	
	function Addsyllabus($runat)
	{
    
		switch($runat){
			case 'local':
						$FormName = "frm_contact";
						$ControlNames=array("class"	=>array('class',"''","Please enter class.","span_class"),
                                          
                                                                    "syllabus"  =>array('syllabus',"''","Please select syllabus.","span_syllabus")
						);

						$ValidationFunctionName="CheckcategoryValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
                        <div class="mws-panel grid_2">
                        <div class="mws-panel-header">
                        <span><a href="showsyllabus.php"/><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All Syllabus</button></a></span>
                        </div>
                        </div>
                        
               <div class="mws-panel grid_7">
                    <div class="mws-panel-header">
                        <span>Add Syllabus</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                         <div class="mws-form-inline">
                                     <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Class</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" rel="tooltip" data-placement="bottom" name="class" data-original-title="Heading">
                                     
                                        <span id="span_class"></span>
                                    </div>
                                </div>
                             
                             <div class="mws-form-row">
                                    	<label class="mws-form-label">Syllabus</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="syllabus" value="">
                                            <span style="color:#F00;" id="span_syllabus"></span>
                                        </div>
                                </div>
                                
                            </div>
                            <div class="mws-button-row">
                                <input type="submit" value="Submit" name="submit" class="btn btn-danger" onClick="return '<?php echo $ValidationFunctionName?>'();">
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
							if ($_FILES["syllabus"]["error"] > 0)
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
							$tmpname=$_FILES["syllabus"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["syllabus"]["type"];
							$type= explode('/',$tmp);							
                                                        //if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF'||$type[1]=='pdf'||$type[1]=='PDF'||$type[1]=='doc'||$type[1]=='docx')
                                                         {
							
						        $path= $tmx.".".$type[1];
							
							move_uploaded_file($_FILES["syllabus"][tmp_name],"../images/".$path); 
							}
                                                       // else
								{
									echo 'Invalid file';
								
									
								}
                                                        }
							$this->path=$path;
							$this->class = $class;
                                                       
							//server side validation
							$return =true;
							
							if($this->Form->ValidField($path,'empty','Please Select an Image')==false)
								$return =false;
							if($return){
							
							$insert_sql_array = array();
							
							$insert_sql_array['class'] = $this->class;
                                                    
                                                        $insert_sql_array['syllabus'] = $this->path;
							
						        $this->db->insert(TBL_SYLLABUS,$insert_sql_array);
							
							$_SESSION['msg'] = 'Record has been Successfully Added';
							
							?>
							<script type="text/javascript">
								window.location = "addsyllabus.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->Addsyllabus('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
                            
		}
	
	}
	                  
					  
		 function showsyllabus()
		 {
			?>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <a href="addsyllabus.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New Syllabus</button></div></a>
                        </div>
                        </div>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>Syllabus List</span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">S.No.</th>
                        <th>Class</th>
                        <th>Syllabus</th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody style="text-align:center;">
                        
            <?php 
			                       
		    $sql="select * from ".TBL_SYLLABUS." order by id " ;
		    $result= $this->db->query($sql,__FILE__,__LINE__);
		    $x=1;
			while($row = $this->db->fetch_array($result))
			{
			?>
                <tr>
                   <td><?php echo $x;?></td>
                   <td><?php echo $row['class'];?></td>
                   <td><a href="../images/<?php echo $row['syllabus'];?>" download>Download</a></td>
                   <td> <a href="editsyllabus.php?vid=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>
		   <a href="javascript: void(0);" title="Delete" rel="tooltip" data-placement="top" onClick="javascript: if(confirm('Do u want to delete this Syllabus?')) { syllabus.deletesyllabus('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a></td>
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
		     function editsyllabus($runat,$id)
	         {
				
    
		    switch($runat){
			    case 'local':
						$FormName = "frm_editcontact";
					        $ControlNames=array("class"			=>array('class',"''","Please enter class.","span_class"),
                                          
                                                                    "syllabus"			=>array('syllabus',"''","Please select syllabus.","span_syllabus")
						 );

						$ValidationFunctionName="CheckeditcategoryValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						$sql="select * from ".TBL_SYLLABUS." where id='".$id."'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
                        
                  <div class="mws-panel grid_6">
                    <div class="mws-panel-header">
                     <span>Edit Syllabus</span>
                    </div>
                  <div class="mws-panel-body no-padding">
                    <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                         <div class="mws-form-inline">
                                     <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Class</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" rel="tooltip" data-placement="bottom" name="class" data-original-title="Heading" value="<?php echo $row['class'];?>">
                                     
                                        <span id="span_class"></span>
                                    </div>
                                </div>
                             
                             <div class="mws-form-row">
                                    	<label class="mws-form-label">Syllabus</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="syllabus" value="">
                                            <span style="color:#F00;" id="span_syllabus"></span>
                                        </div>
                                </div>
                                
                            </div>
                            <div class="mws-button-row">
                                <input type="submit" value="Submit" name="submit" class="btn btn-danger" onClick="return '<?php echo $ValidationFunctionName?>'();">
                                <input type="reset" value="Reset" class="btn ">
                            </div>
                        </form>
                    </div>      
                </div>
						
						<?php 
					
						break;
			                     case 'server':
							extract($_POST);
							
							$this->class = $class;
                                                       
							//server side validation
							$return =true;
							if($return){
							
							$update_sql_array = array();
							
							$update_sql_array['class'] = $this->class;
                                                       
							$this->db->update(TBL_SYLLABUS,$update_sql_array,'id',$id);
							
							$_SESSION['msg'] = 'Syllabus has been Successfully Updated';
							
							?>
							<script type="text/javascript">
								window.location = "showsyllabus.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->editsyllabus('local','$id');
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
	
	function deletesyllabus($id)
	{
	        ob_start();
		
		$sql="delete from ".TBL_SYLLABUS." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		$_SESSION['msg']='Record has been Deleted successfully';
		
		?>
		<script type="text/javascript">
	                window.location= "showsyllabus.php";
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
				
			
}

?>