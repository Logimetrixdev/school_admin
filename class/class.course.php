
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class Course{
	
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
	
	
	
	function Addcourse($runat)
	{
    
		switch($runat){
			case 'local':
						$FormName = "frm_addcity";
						$ControlNames=array("course"			=>array('course',"''","Please Enter Course Name","span_course")
											
						 );

						$ValidationFunctionName="CheckcityValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
                        <div class="mws-panel grid_2">
                        <div class="mws-panel-header">
                        <span><a href="showallcourse.php"/><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All Course</button></a></span>
                        </div>
                        </div>
                        
                        <div class="mws-panel grid_7">
                    <div class="mws-panel-header">
                        <span>Add Course</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                         <div class="mws-form-inline">
                         
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">New Course Name</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" title="course"  rel="tooltip" data-placement="bottom" name="course">
                                        <span id="span_course"></span>
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
							
							$this->course = $course;
							
						
							
							
							//server side validation
							$return =true;
							
						if($this->Form->ValidField($course,'empty','Please Enter Course')==false)
							$return =false;
					
							
							if($return){
							
							$insert_sql_array = array();
							
							$insert_sql_array['course'] = $this->course;
							
						    $this->db->insert(TBL_COURSE,$insert_sql_array);
							
							$_SESSION['msg'] = 'Course has been Successfully Added';
							
							?>
							<script type="text/javascript">
								window.location = "addcourse.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->Addcourse('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	}
	                  
					  
		 function showallcourse()
		 {
			?>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <a href="addcourse.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New Course</button></div></a>
                        </div>
                        </div>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>Course List</span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">ID</th>
                        <th>Course Name</th>
                        <th width="8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_COURSE." order by timestamp asc" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
			while($row = $this->db->fetch_array($result))
				{
				?>
                					<tr>
                                    <td><?php echo $x?></td>
                                    <td><?php echo $row['course'];?></td>
                                    <td><a href="editcourse.php?vid=<?php echo $row['id'];?>" title="Edit Course" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>
                                    <a href="javascript: void(0);" title="Delete" rel="tooltip" data-placement="top"
					onclick="javascript: if(confirm('Do u want to delete this course?')) { course_obj.deletecourse('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a></td>
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
		    
			function editcourse($runat,$id)
			{
				
    
		switch($runat){
			case 'local':
						$FormName = "frm_editcity";
							$ControlNames=array("course"			=>array('course',"''","Please Enter Course","span_course")
										
											
						 );

						$ValidationFunctionName="CheckeditcityValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						$sql="select * from ".TBL_COURSE." where id='".$id."'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
                        
                        <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                     <span>Edit Course</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                         <div class="mws-form-inline">
                         
                         
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Course Name</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" name="course" title="Course"  rel="tooltip" data-placement="bottom" value="<?php echo $row['course'];?>">
                                        <span id="span_course"></span>
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
							$this->course = $course;
						
						
						
							
							
							//server side validation
							$return =true;
								
						if($this->Form->ValidField($course,'empty','Please Enter Course')==false)
							$return =false;
							
							if($return){
							
							$update_sql_array = array();
							$update_sql_array['course'] = $this->course;
							
							
							$this->db->update(TBL_COURSE,$update_sql_array,'id',$id);
							
							$_SESSION['msg'] = 'Course has been Successfully Updated';
							
							?>
							<script type="text/javascript">
								window.location = "showallcourse.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->editcourse('local','$id');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	}

	
	function deletecourse($id)
	{
			ob_start();
		
		$sql="delete from ".TBL_COURSE." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		$_SESSION['msg']='Course has been Deleted successfully';
		
		?>
		<script type="text/javascript">
	location.reload(true);
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
				
			
				
				
}


?>