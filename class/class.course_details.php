
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class CourseDeails{
	
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
		$this->auth = new Authentication();
		
	}

	
	function AddCourseDetails($runat)
	{
    
		switch($runat){
			case 'local':
						$FormName = "frm_banners";
						$ControlNames=array("course"			=>array('course',"''","Please select course name","span_course")
											

											
						 );

						$ValidationFunctionName="CheckbannersValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
                        <div class="mws-panel grid_6">
                        <div class="mws-panel-header">
                        <a href="showallcoursedetails.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All Course Details</button></div></a>
                        </div>
                        </div>
<div class="mws-panel grid_6">
                	<div class="mws-panel-header">
                    	<span>Add  Course</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		<div class="mws-form-inline">
                            <div class="mws-form-row">
                                    <label class="mws-form-label">Course Name</label>
                                    <div class="mws-form-item">
                                       <select name="course">
                                       <option value="">---- Select Course---</option>
                                       <?php
									   $sql="select * from ".TBL_COURSE." order by timestamp" ;
										$result= $this->db->query($sql,__FILE__,__LINE__);
										while($row = $this->db->fetch_array($result))
										{
										?>
                                        <option value="<?php echo $row['id']?>"><?php echo $row['course']?></option>
                                        <?php
										}
										?>
                                       </select> <span style="color:#F00;" id="span_course"></span>
                                       
                                    </div>
                                </div>
                            <div class="mws-form-row">
                                    	<label class="mws-form-label">Pic</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="filess" value="">
                                        
                                        </div>
                                </div>
                    			
                                
                                
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Content</label>
                    				<div style="height:350px;" class="mws-form-item">
                    					<?php
							include_once("fckeditor/fckeditor.php");
							
							$sBasePath = $_SERVER['PHP_SELF'] ;
							$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
							
							$oFCKeditor = new FCKeditor('description') ;
							$oFCKedditor->skin="office";
							$oFCKeditor->BasePath	= $sBasePath ;
							$oFCKeditor->Value		=  $row['description']; ;
							$oFCKeditor->Create() ;
							?>
                                   </div>
                    			</div>
                                
                          </div>
                    		<div class="mws-button-row">
                    		  <input type="submit" value="Submit" name="submit" class="btn btn-danger" onclick="return <?php echo $ValidationFunctionName?>();">
                    			<input type="reset" value="Reset" class="btn">
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
							$this->description=$description; 
							$this->course=$course; 
							
						
							
							
							//server side validation
							$return =true;
					if($this->Form->ValidField($course,'empty','Please Select Course Name')==false)
							$return =false;
					if($this->Form->ValidField($description,'empty','Please Enter Details')==false)
							$return =false;
							
							
							if($return){
							
							$insert_sql_array = array();
							$insert_sql_array['course_id'] = $this->course;
							$insert_sql_array['description'] = $this->description;
							$insert_sql_array['image'] = $this->path;
							
							
						    $this->db->insert(TBL_COURSE_DETAILS,$insert_sql_array);
							
							$_SESSION['msg'] = 'Course Details has been Successfully Added';
							
							?>
							<script type="text/javascript">
								window.location = "addcourse_details.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddCourseDetails('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	}
	                  
					  
		 function showallcoursedetails()
		 {
			?>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <a href="addcourse_details.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New Course Details</button></div></a>
                        </div>
                        </div>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All Course Details</span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">ID</th>
                        <th width="20%">Course Name</th>
                        <th>Image</th>
                        <th>Content</th>
                        <th width="3%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_COURSE_DETAILS." order by timestamp" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
			while($row = $this->db->fetch_array($result))
				{
				?>
                					<tr>
                                    <td><?php echo $x?></td>
                                    <td><?php echo $this->getCourseNamefromID($row['course_id']);?></td>
                                    <td><img src="../gallery/<?php echo $row['image'];?>" height="100" width="100"/></td>
                                    <td><div style="height:100px; overflow:auto;"><?php echo $row['description'];?></div></td>
                                   <td><a href="editcourse_details.php?vid=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>
                                   <a href="javascript: void(0);" title="Delete" rel="tooltip" data-placement="top"
					onclick="javascript: if(confirm('Do u want to delete this Course Details?')) { course_obj.deletecourse('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a></td>
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
		    
			
			
			
			function getCourseNamefromID($id)
			{
					$sql="select * from ".TBL_COURSE." where id='".$id."'" ;
					$result= $this->db->query($sql,__FILE__,__LINE__);
					$row = $this->db->fetch_array($result);
					return $row['course'];
			}
			
			
			
			function EditCourseDetails($runat,$id)
			{
				
    
		switch($runat){
			case 'local':
						$FormName = "frm_editclient";
			$ControlNames=array("course"			=>array('course',"''","Please select Course Name","span_course")
						 );

						$ValidationFunctionName="CheckeditclientValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						$sql="select * from ".TBL_COURSE_DETAILS." where id='".$id."'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
                        
                       
<div class="mws-panel grid_6">
                	<div class="mws-panel-header">
                    	<span>Edit Course Details</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		<div class="mws-form-inline">
                            <div class="mws-form-row">
                                    <label class="mws-form-label">Course Name</label>
                                    <div class="mws-form-item">
                                       <select name="course">
                                       <option value="">---- Select Course---</option>
                                       <?php
									   $sql_course="select * from ".TBL_COURSE." order by timestamp" ;
										$result_course= $this->db->query($sql_course,__FILE__,__LINE__);
										while($row_course = $this->db->fetch_array($result_course))
										{
										?>
<option <?php if($row_course['id'] == $row['course_id']) { echo 'selected="selected"';} ?>  value="<?php echo $row_course['id']?>"><?php echo $row_course['course']?></option>
                                        <?php
										}
										?>
                                       </select> <span style="color:#F00;" id="span_course"></span>
                                       
                                    </div>
                                </div>
                            <div class="mws-form-row">
                                    	<label class="mws-form-label">Pic</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="filess" value="">
                                          
                                        </div>
                                </div>
                    			
                              
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Content</label>
                    				<div style="height:350px;" class="mws-form-item">
                    					<?php
							include_once("fckeditor/fckeditor.php");
							
							$sBasePath = $_SERVER['PHP_SELF'] ;
							$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
							
							$oFCKeditor = new FCKeditor('description') ;
							$oFCKedditor->skin="office";
							$oFCKeditor->BasePath	= $sBasePath ;
							$oFCKeditor->Value		=  $row['description'];
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
							
							$tmx=time();
							if ($_FILES["filess"]["error"] > 0)
							{
							$sql3="select * from ".TBL_COURSE_DETAILS." where id='".$id."'" ;
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
							$this->course=$course; 
							$this->description=$description;  
							
							
						
						
					
							//server side validation
							$return =true;
							
					if($this->Form->ValidField($course,'empty','Please Select Course Name')==false)
							$return =false;
					if($this->Form->ValidField($description,'empty','Please Enter Details')==false)
							$return =false;
							
							if($return){
							
							$update_sql_array = array();
							$update_sql_array['course_id'] = $this->course;
							$update_sql_array['description'] = $this->description;
							$update_sql_array['image'] = $this->path;
							
							
							$this->db->update(TBL_COURSE_DETAILS,$update_sql_array,'id',$id);
							
							$_SESSION['msg'] = 'Course details has been Successfully Updated';
							
							?>
							<script type="text/javascript">
								window.location = "showallcoursedetails.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditCourseDetails('local','$id');
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
	
	function deletecourse($id)
	{
			ob_start();
		
		$sql="delete from ".TBL_COURSE_DETAILS." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		$_SESSION['msg']='Course Details has been Deleted successfully';
		
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