
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class StudentDetail{
	
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

	
	function AddStudentDetails($runat)
	{
    
		switch($runat){
			case 'local':
						$FormName = "frm_banners";
		$ControlNames=array("enrollment_no"			=>array('enrollment_no',"''","Please enter student enrollment number","span_enrollment_no"),
							"student_name"			=>array('student_name',"''","Please enter student name","span_student_name"),
							"course"			=>array('course',"''","Please select course name","span_course"),
							"father_name"		=>array('father_name',"''","Please enter father name","span_father_name"),
							"address"			=>array('address',"''","Please enter address","span_address"),
							"enrollment_year"	=>array('enrollment_year',"''","Please enter enrollment year","span_enrollment_year")
							
											

											
						 );

						$ValidationFunctionName="CheckbannersValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <a href="showallstudent.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All Student</button></div></a>
                        </div>
                        </div>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add New Student</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		<div class="mws-form-inline">
                            <div class="mws-form-row">
                                    <label class="mws-form-label">Enrollment No.</label>
                                    <div class="mws-form-item">
                                      <input type="text" class="large" name="enrollment_no" value=""/>
                                       <span style="color:#F00;" id="span_enrollment_no"></span>
                                    </div>
                             </div>
                            <div class="mws-form-row">
                                    <label class="mws-form-label">Student Name</label>
                                    <div class="mws-form-item">
                                      <input type="text" class="large" name="student_name" value=""/>
                                       <span style="color:#F00;" id="span_student_name"></span>
                                    </div>
                             </div>
                             <div class="mws-form-row">
                                    <label class="mws-form-label">Father Name</label>
                                    <div class="mws-form-item">
                                      <input type="text" class="large" name="father_name" value=""/>
                                       <span style="color:#F00;" id="span_father_name"></span>
                                    </div>
                             </div>
                                  <div class="mws-form-row">
                                    <label class="mws-form-label">DOB</label>
                                    <div class="mws-form-item">
                                      <input type="text" class="datepicker"name="dob" value=""/>
                                      
                                       
                                    </div>
                             </div>
                             
                             
                             
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
                    				<label class="mws-form-label">Address</label>
                    				<div  class="mws-form-item">
                    					<textarea name="address"></textarea>
                                        <span style="color:#F00;" id="span_address"></span>
                                   </div>
                    			</div>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Enrollment Year</label>
                                    <div class="mws-form-item">
                                       <select name="enrollment_year">
                                       <option value="">----Enrollment Year---</option>
                                      <?php
									  for($j=1980; $j <= date("Y"); $j++)
									  {
										  ?>
                                        <option value="<?php echo $j?>"><?php echo $j?></option>
                                        <?php
										}
										?>
                                       </select> <span style="color:#F00;" id="span_enrollment_year"></span>
                                       
                                    </div>
                                </div>
                             <div class="mws-button-row">
                    		  <h4 align="center">  Upload Result </h4>
                    		</div>
                            	<div style="width:50%; float:left;">
                                <h2 align="center">Theory</h2>
                                </div>
                                <div style="width:50%; float:left;">
                                <h2 align="center">Practical</h2>
                                </div>
                             
                                <div class="mws-form-row" style="padding: 0 24px;">
                            	<div class="mws-form-cols">
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <h4 align="center">Subject</h4>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <h4 align="center">Max. Marks</h4>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <h4 align="center">Obt. Marks</h4>
                                    </div>
                                    
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <h4 align="center">Subject</h4>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <h4 align="center">Max. Marks</h4>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <h4 align="center">Obt. Marks</h4>
                                    </div>
                                </div>
                            </div>
                              
                              
                              <div class="mws-form-row" style="padding: 10px 24px;">
                            	<div class="mws-form-cols">
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                     <div class="mws-form-item">
                                           <select name="subject_theory[]">
                                           <option value="">- Subject -</option>
                                            <?php
									   	$sql_sub_theory1="select * from ".TBL_SUBJECT." order by timestamp" ;
										$result_sub_theory1= $this->db->query($sql_sub_theory1,__FILE__,__LINE__);
										while($row_sub_theory1 = $this->db->fetch_array($result_sub_theory1))
										{
										?>
                                        <option value="<?php echo $row_sub_theory1['id']?>"><?php echo $row_sub_theory1['subject']?></option>
                                        <?php
										}
										?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                       <div class="mws-form-item">
                                            <input type="text" name="max_theory[]" placeholder="Max. Marks" value="">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                                           <input type="text" name="obt_theory[]" placeholder="Obt. Marks" value="">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <div class="mws-form-item">
                                             <select name="subject_practical[]">
                                           <option value="">- Subject -</option>
                                            <?php
									   	$sql_sub_practical1="select * from ".TBL_SUBJECT." order by timestamp" ;
										$result_sub_practical1= $this->db->query($sql_sub_practical1,__FILE__,__LINE__);
										while($row_sub_practical1 = $this->db->fetch_array($result_sub_practical1))
										{
										?>
                                        <option value="<?php echo $row_sub_practical1['id']?>"><?php echo $row_sub_practical1['subject']?></option>
                                        <?php
										}
										?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                                            <input type="text" name="max_practical[]" placeholder="Max. Marks" value="">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                                            <input type="text" name="obt_practical[]" placeholder="Obt. Marks" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            
                            
                           
                           <div id="addrows"></div>
                           
                           
                          <div class="mws-form-row">
                                     <div class="mws-form-item" style="margin-left:0px;">
                                        	<input type="text"  name="no_of_row" value=""> <input type="button" class="btn btn-success"  name="addrows" value="Add Rows" onclick="student_obj.createrow(this.form.no_of_row.value,{target:'addrows'})">
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
							$this->enrollment_no=$enrollment_no; 
							$this->student_name=$student_name; 
							$this->father_name=$father_name; 
							$this->dob=$dob; 
							$this->course=$course; 
							$this->address=$address; 
							$this->enrollment_year=$enrollment_year; 
							$this->subject_theory = $subject_theory;
							$this->max_theory = $max_theory;
							$this->obt_theory = $obt_theory;
							$this->subject_practical = $subject_practical;
							$this->max_practical =  $max_practical;
							$this->obt_practical = $obt_practical;
							
						
                           
					
                           
						
						

							
						
							
							
							//server side validation
							$return =true;
					if($this->Form->ValidField($enrollment_no,'empty','Please enter Enrollment Number')==false)
							$return =false;
					if($this->Form->ValidField($student_name,'empty','Please enter Student Name')==false)
							$return =false;
								$return =true;
					if($this->Form->ValidField($course,'empty','Please Select Course Name')==false)
							$return =false;
					if($this->Form->ValidField($father_name,'empty','Please Enter father name')==false)
							$return =false;
								$return =true;
					if($this->Form->ValidField($address,'empty','Please enter address')==false)
							$return =false;
					if($this->Form->ValidField($enrollment_year,'empty','Please Enter Enrollment year')==false)
							$return =false;
							
							
							
							if($return){
							
							$insert_sql_array = array();
							$insert_sql_array['enrollment_no'] = $this->enrollment_no;
							$insert_sql_array['student_name'] = $this->student_name;
							$insert_sql_array['father_name'] = $this->father_name;
							
							$insert_sql_array['dob'] = $this->dob;
							$insert_sql_array['course'] = $this->course;
							$insert_sql_array['address'] = $this->address;
							
							$insert_sql_array['enrollment_year'] = $this->enrollment_year;
							$insert_sql_array['result'] = $this->result;
							$insert_sql_array['image'] = $this->path;
							
							
							
						    $this->db->insert(TBL_STUDENT,$insert_sql_array);
							$student_id = $this->db->last_insert_id();
							
							if($this->max_theory[0]>0)
							{
										$insert_sql_array1['student_id'] = $student_id;
										$insert_sql_array1['enrollment_number'] = $this->enrollment_no;
										$insert_sql_array1['enrollment_year'] = $this->enrollment_year;
										
										
										
										$theory_max_total=0;
										foreach($this->max_theory as $val)
										{
											$theory_max_total = $theory_max_total+$val;
										}
										
										$theory_obt_total=0;
										foreach($this->obt_theory as $value)
										{
											$theory_obt_total = $theory_obt_total+$value;
										}
										
										
										
										
										$practical_max_total =0;
										foreach($this->max_practical as $value1)
										{
											$practical_max_total  = $practical_max_total+$value1;
										}
										
										
										$practical_obt_total =0;
										foreach($this->obt_practical as $value2)
										{
											$practical_obt_total  = $practical_obt_total+$value2;
										}
										
										$theory_percent =  $theory_obt_total*100/$theory_max_total;
										$practical_percent  =  $practical_obt_total*100/$practical_max_total;
										
										$insert_sql_array1['theory_max_total'] = $theory_max_total;
										$insert_sql_array1['theory_obt_total'] = $theory_obt_total;
										$insert_sql_array1['practical_max_total'] = $practical_max_total;
										$insert_sql_array1['practical_obt_total'] = $practical_obt_total;
										$insert_sql_array1['theory_percent'] = $theory_percent;
										$insert_sql_array1['practical_percent'] = $practical_percent;
										
										$this->db->insert(TBL_RESULT,$insert_sql_array1);
										$result_id = $this->db->last_insert_id();
									
										
										$i=0;
										foreach($this->subject_theory as $counter)
										{
												$insert_sql_array2 = array();
												$insert_sql_array2['result_id'] = $result_id;
												$insert_sql_array2['subject_theory'] = $counter;
												$insert_sql_array2['max_theory'] = $this->max_theory[$i];
												$insert_sql_array2['obt_theory'] = $this->obt_theory[$i];
												$insert_sql_array2['subject_practical'] = $this->subject_practical[$i];
												$insert_sql_array2['max_practical'] = $this->max_practical[$i];
												$insert_sql_array2['obt_practical'] = $this->obt_practical[$i];
												$this->db->insert(TBL_RESULT_DETAIL,$insert_sql_array2);
												$i++;
										}
							
							}
							
							
							
							
							$_SESSION['msg'] = 'Student Details has been Successfully Added';
							
							?>
							<script type="text/javascript">
								window.location = "addstudent.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->AddStudentDetails('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	}
	                  
	
	

	   
	
	function createrow($no_rows)
	{
		ob_start();
		
		for($i=1;$i<=$no_rows;$i++)
		{
			?>
					<div class="mws-form-row" style="padding: 10px 24px;">
                            	<div class="mws-form-cols">
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                     <div class="mws-form-item">
                                           <select name="subject_theory[]" onchange="student_obj.gettheorymax(this.value,{target:'max_theory'})">
                                           <option value="">- Subject -</option>
                                            <?php
									   	$sql_sub_theory3="select * from ".TBL_SUBJECT." order by timestamp" ;
										$result_sub_theory3= $this->db->query($sql_sub_theory3,__FILE__,__LINE__);
										while($row_sub_theory3 = $this->db->fetch_array($result_sub_theory3))
										{
										?>
                                        <option value="<?php echo $row_sub_theory3['id']?>"><?php echo $row_sub_theory3['subject']?></option>
                                        <?php
										}
										?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                       <div class="mws-form-item" id="max_theory">
                                            <input type="text" name="max_theory[]" placeholder="Max. Marks" value="">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                                           <input type="text" name="obt_theory[]" placeholder="Obt. Marks" value="">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <div class="mws-form-item">
                                             <select name="subject_practical[]" onchange="student_obj.getpracticalmax(this.value,{target:'max_practical'})">
                                           <option value="">- Subject -</option>
                                            <?php
									   	$sql_sub_practical1="select * from ".TBL_SUBJECT." order by timestamp" ;
										$result_sub_practical1= $this->db->query($sql_sub_practical1,__FILE__,__LINE__);
										while($row_sub_practical1 = $this->db->fetch_array($result_sub_practical1))
										{
										?>
                                        <option value="<?php echo $row_sub_practical1['id']?>"><?php echo $row_sub_practical1['subject']?></option>
                                        <?php
										}
										?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item" id="max_practical">
                                            <input type="text" name="max_practical[]" placeholder="Max. Marks" value="">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                                            <input type="text" name="obt_practical[]" placeholder="Obt. Marks" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php
		}
		?>
        <div id="addrows"></div>
        <script>
		document.getElementById('addrows').id = '<?php echo $this->generateRandomID();?>';
		</script>
        <?php
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	
	function generateRandomID() 
	{
  
    $required_length = 250;
    $limit_one = rand();
    $limit_two = rand();
    $randomID = substr(uniqid(sha1(crypt(md5(rand(min($limit_one, $limit_two), max($limit_one, $limit_two)))))), 0, $required_length);
    return $randomID;
	}
	
	
		 function showallstudent()
		 {
			?>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <a href="addstudent.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New Student</button></div></a>
                        </div>
                        </div>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All Student List</span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">ID</th>
                        <th width="15%">Enrollment No.</th>
                        <th width="10%">Pic</th>
                        <th width="18%">Student Name</th>
                         <th width="18%">Father Name</th>
                        <th width="12%">Year</th>
                         <th width="15%">Course</th>
                          
                        <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_STUDENT." order by timestamp" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
			while($row = $this->db->fetch_array($result))
				{
				?>
                					<tr>
                                    <td><?php echo $x?></td>
                                    <td><?php echo $row['enrollment_no'];?></td>
                                    <td><img src="thumb.php?file=../gallery/<?php echo $row['image'];?>&sizex=30&sizey=30"/></td>
                                    <td><?php echo $row['student_name'];?></td>
                                     <td><?php echo $row['father_name'];?></td>
                                    <td><?php echo $row['enrollment_year'];?></td>
                                    <td><?php echo $this->getCourseNamefromID($row['course']);?></td>
                                 	<td><a href="editstudent.php?vid=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>
                                    <a data-placement="top" rel="tooltip" href="viewstudent.php?vid=<?php echo $row['id'];?>" data-original-title="View"><i class="icol-application-double"></i></a>
                                   <a href="javascript: void(0);" title="Delete" rel="tooltip" data-placement="top"
					onclick="javascript: if(confirm('Do u want to delete this student?')) { student_obj.deletestudent('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a></td>
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
			
			
			
			function EditStudentDetails($runat,$id)
			{
				
    
		switch($runat){
			case 'local':
						$FormName = "frm_editclient";
			$ControlNames=array("enrollment_no"			=>array('enrollment_no',"''","Please enter student enrollment number","span_enrollment_no"),
							"student_name"			=>array('student_name',"''","Please enter student name","span_student_name"),
							"course"			=>array('course',"''","Please select course name","span_course"),
							"father_name"		=>array('father_name',"''","Please enter father name","span_father_name"),
							"address"			=>array('address',"''","Please enter address","span_address"),
							"enrollment_year"	=>array('enrollment_year',"''","Please enter enrollment year","span_enrollment_year")
							);

						$ValidationFunctionName="CheckeditclientValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						$sql="select * from ".TBL_STUDENT." where id='".$id."'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
                        
                       
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Edit Student Details</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		<div class="mws-form-inline">
                            
                            <div class="mws-form-row">
                                    <label class="mws-form-label">Enrollment No.</label>
                                    <div class="mws-form-item">
                                      <input type="text" class="large" name="enrollment_no" value="<?php echo $row['enrollment_no']?>"/>
                                       <span style="color:#F00;" id="span_enrollment_no"></span>
                                    </div>
                             </div>
                            <div class="mws-form-row">
                                    <label class="mws-form-label">Student Name</label>
                                    <div class="mws-form-item">
                                      <input type="text" class="large" name="student_name" value="<?php echo $row['student_name']?>"/>
                                       <span style="color:#F00;" id="span_student_name"></span>
                                    </div>
                             </div>
                             <div class="mws-form-row">
                                    <label class="mws-form-label">Father Name</label>
                                    <div class="mws-form-item">
                                      <input type="text" class="large" name="father_name" value="<?php echo $row['father_name']?>"/>
                                       <span style="color:#F00;" id="span_father_name"></span>
                                    </div>
                             </div>
                                  <div class="mws-form-row">
                                    <label class="mws-form-label">DOB</label>
                                    <div class="mws-form-item">
                                      <input type="text" class="datepicker"name="dob" value="<?php echo $row['dob']?>"/>
                                      
                                       
                                    </div>
                             </div>
                             
                             
                             
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
<option <?php if($row_course['id'] == $row['course']) { echo 'selected="selected"';} ?>  value="<?php echo $row_course['id']?>"><?php echo $row_course['course']?></option>
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
                                        <img src="../gallery/<?php echo $row['image']?>" style="height:125px; width:125px;"/>
                                        </div>
                                </div>
                    			
                                
                                
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Address</label>
                    				<div  class="mws-form-item">
                    					<textarea name="address"><?php echo $row['address']?></textarea>
                                        <span style="color:#F00;" id="span_address"></span>
                                   </div>
                    			</div>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Enrollment Year</label>
                                    <div class="mws-form-item">
                                       <select name="enrollment_year">
                                       <option value="">----Enrollment Year---</option>
                                      <?php
									  for($j=1980; $j <= date("Y"); $j++)
									  {
										  ?>
                                        <option value="<?php echo $j?>" <?php if($j == $row['enrollment_year']) { echo 'selected="selected"';} ?>  ><?php echo $j?></option>
                                        <?php
										}
										?>
                                       </select> <span style="color:#F00;" id="span_enrollment_year"></span>
                                       
                                    </div>
                                </div>
                                
                                <div class="mws-button-row">
                                <h4 align="center">  Upload Result </h4>
                                </div>
                            
                            	<div style="width:50%; float:left;">
                                <h2 align="center">Theory</h2>
                                </div>
                                <div style="width:50%; float:left;">
                                <h2 align="center">Practical</h2>
                                </div>
                                
                                <div class="mws-form-row" style="padding: 0 24px;">
                            	<div class="mws-form-cols">
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <h4 align="center">Subject</h4>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <h4 align="center">Max. Marks</h4>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <h4 align="center">Obt. Marks</h4>
                                    </div>
                                    
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <h4 align="center">Subject</h4>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <h4 align="center">Max. Marks</h4>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <h4 align="center">Obt. Marks</h4>
                                    </div>
                                </div>
                            </div>
                             <?php
			  			$sql_result="select * from ".TBL_RESULT." where student_id='".$row['id']."' and enrollment_number='".$row['enrollment_no']."'";
						$result_result= $this->db->query($sql_result,__FILE__,__LINE__);
						$cnt= $this->db->num_rows($result_result);
						$row_result= $this->db->fetch_array($result_result);
						if($cnt>0)
						{
							
        $sql_marks="select * from ".TBL_RESULT_DETAIL." where result_id='".$row_result['id']."'" ;
		$result_marks= $this->db->query($sql_marks,__FILE__,__LINE__);
		while($row_marks = $this->db->fetch_array($result_marks))
				{  
				?>
						
						 
                            
                            <div class="mws-form-row" style="padding: 10px 24px;">
                            	<div class="mws-form-cols">
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                     <div class="mws-form-item">
                                           <select name="subject_theory[]">
                                           <option value="">- Subject -</option>
                                            <?php
									   	$sql_sub_theory1="select * from ".TBL_SUBJECT." order by timestamp" ;
										$result_sub_theory1= $this->db->query($sql_sub_theory1,__FILE__,__LINE__);
										while($row_sub_theory1 = $this->db->fetch_array($result_sub_theory1))
										{
										?>
    <option value="<?php echo $row_sub_theory1['id']?>" <?php if($row_sub_theory1['id']==$row_marks['subject_theory']) { echo 'selected="selected"';} ?> ><?php echo $row_sub_theory1['subject']?></option>
                                        <?php
										}
										?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                       <div class="mws-form-item">
                                            <input type="text" name="max_theory[]" placeholder="Max. Marks" value="<?php echo $row_marks['max_theory']?>">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                                           <input type="text" name="obt_theory[]" placeholder="Obt. Marks" value="<?php echo $row_marks['obt_theory']?>">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <div class="mws-form-item">
                                             <select name="subject_practical[]">
                                           <option value="">- Subject -</option>
                                            <?php
									   	$sql_sub_practical1="select * from ".TBL_SUBJECT." order by timestamp" ;
										$result_sub_practical1= $this->db->query($sql_sub_practical1,__FILE__,__LINE__);
										while($row_sub_practical1 = $this->db->fetch_array($result_sub_practical1))
										{
										?>
                                        <option value="<?php echo $row_sub_practical1['id']?>" <?php if($row_sub_practical1['id']==$row_marks['subject_practical']) { echo 'selected="selected"';} ?>><?php echo $row_sub_practical1['subject']?></option>
                                        <?php
										}
										?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                                            <input type="text" name="max_practical[]" placeholder="Max. Marks" value="<?php echo $row_marks['max_practical']?>">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                 <input type="text" name="obt_practical[]" placeholder="Obt. Marks" value="<?php echo $row_marks['obt_practical']?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                       <?php
				}
						}
						
						else
						{
							?>
                            <div class="mws-form-row" style="padding: 10px 24px;">
                            	<div class="mws-form-cols">
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                     <div class="mws-form-item">
                                           <select name="subject_theory[]">
                                           <option value="">- Subject -</option>
                                            <?php
									   	$sql_sub_theory1="select * from ".TBL_SUBJECT." order by timestamp" ;
										$result_sub_theory1= $this->db->query($sql_sub_theory1,__FILE__,__LINE__);
										while($row_sub_theory1 = $this->db->fetch_array($result_sub_theory1))
										{
										?>
                                        <option value="<?php echo $row_sub_theory1['id']?>"><?php echo $row_sub_theory1['subject']?></option>
                                        <?php
										}
										?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                       <div class="mws-form-item">
                                            <input type="text" name="max_theory[]" placeholder="Max. Marks" value="">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                                           <input type="text" name="obt_theory[]" placeholder="Obt. Marks" value="">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                         <div class="mws-form-item">
                                             <select name="subject_practical[]">
                                           <option value="">- Subject -</option>
                                            <?php
									   	$sql_sub_practical1="select * from ".TBL_SUBJECT." order by timestamp" ;
										$result_sub_practical1= $this->db->query($sql_sub_practical1,__FILE__,__LINE__);
										while($row_sub_practical1 = $this->db->fetch_array($result_sub_practical1))
										{
										?>
                                        <option value="<?php echo $row_sub_practical1['id']?>"><?php echo $row_sub_practical1['subject']?></option>
                                        <?php
										}
										?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                                            <input type="text" name="max_practical[]" placeholder="Max. Marks" value="">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:14.909%! important;">
                                        <div class="mws-form-item">
                                            <input type="text" name="obt_practical[]" placeholder="Obt. Marks" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
						}
					?>
                            
                            
                          <div id="addrows"></div>
                          <div class="mws-form-row">
                                     <div class="mws-form-item" style="margin-left:0px;">
                                        	<input type="text"  name="no_of_row" value=""> <input type="button" class="btn btn-success"  name="addrows" value="Add Rows" onclick="student_obj.createrow(this.form.no_of_row.value,{target:'addrows'})">
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
							$sql3="select * from ".TBL_STUDENT." where id='".$id."'" ;
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
							$this->enrollment_no=$enrollment_no; 
							$this->student_name=$student_name; 
							$this->father_name=$father_name; 
							$this->dob=$dob; 
							$this->course=$course; 
							$this->address=$address; 
							$this->enrollment_year=$enrollment_year; 
							 
							$this->subject_theory = $subject_theory;
							$this->max_theory = $max_theory;
							$this->obt_theory = $obt_theory;
							$this->subject_practical = $subject_practical;
							$this->max_practical =  $max_practical;
							$this->obt_practical = $obt_practical;
							
							
					
							//server side validation
							$return =true;
					if($this->Form->ValidField($enrollment_no,'empty','Please enter Enrollment Number')==false)
							$return =false;
					if($this->Form->ValidField($student_name,'empty','Please enter Student Name')==false)
							$return =false;
								$return =true;
					if($this->Form->ValidField($course,'empty','Please Select Course Name')==false)
							$return =false;
					if($this->Form->ValidField($father_name,'empty','Please Enter father name')==false)
							$return =false;
								$return =true;
					if($this->Form->ValidField($address,'empty','Please enter address')==false)
							$return =false;
					if($this->Form->ValidField($enrollment_year,'empty','Please Enter Enrollment year')==false)
							$return =false;
							
							
							if($return){
							
							$update_sql_array = array();
						
							$update_sql_array['enrollment_no'] = $this->enrollment_no;
							$update_sql_array['student_name'] = $this->student_name;
							$update_sql_array['father_name'] = $this->father_name;
							
							$update_sql_array['dob'] = $this->dob;
							$update_sql_array['course'] = $this->course;
							$update_sql_array['address'] = $this->address;
							
							$update_sql_array['enrollment_year'] = $this->enrollment_year;
							$update_sql_array['result'] = $this->result;
							$update_sql_array['image'] = $this->path;
							
							
							$this->db->update(TBL_STUDENT,$update_sql_array,'id',$id);
					  
			  			$sql_result="select * from ".TBL_RESULT." where student_id='".$id."'";
						$result_result= $this->db->query($sql_result,__FILE__,__LINE__);
						$cnt= $this->db->num_rows($result_result);
						$row_result= $this->db->fetch_array($result_result);
						if($cnt>0)
						{
							$update_sql_array1['student_id'] = $id;
							$update_sql_array1['enrollment_number'] = $this->enrollment_no;
							$update_sql_array1['enrollment_year'] = $this->enrollment_year;
							
							$theory_max_total=0;
							foreach($this->max_theory as $val)
							{
								$theory_max_total = $theory_max_total+$val;
							}
							
							$theory_obt_total=0;
							foreach($this->obt_theory as $value)
							{
								$theory_obt_total = $theory_obt_total+$value;
							}
							
							
							
							
							$practical_max_total =0;
							foreach($this->max_practical as $value1)
							{
								$practical_max_total  = $practical_max_total+$value1;
							}
							
							
							$practical_obt_total =0;
							foreach($this->obt_practical as $value2)
							{
								$practical_obt_total  = $practical_obt_total+$value2;
							}
							
							$theory_percent =  $theory_obt_total*100/$theory_max_total;
							$practical_percent  =  $practical_obt_total*100/$practical_max_total;
							
							$update_sql_array1['theory_max_total'] = $theory_max_total;
							$update_sql_array1['theory_obt_total'] = $theory_obt_total;
							$update_sql_array1['practical_max_total'] = $practical_max_total;
							$update_sql_array1['practical_obt_total'] = $practical_obt_total;
							$update_sql_array1['theory_percent'] = $theory_percent;
							$update_sql_array1['practical_percent'] = $practical_percent;
							
							$this->db->update(TBL_RESULT,$update_sql_array1,'student_id',$id);
							
							
							$sql_get_result_Id="select * from ".TBL_RESULT." where student_id='".$id."'" ;
							$result_sub_practical1= $this->db->query($sql_get_result_Id,__FILE__,__LINE__);
							$row_sub_practical1 = $this->db->fetch_array($result_sub_practical1);
							
							$result_id= $row_sub_practical1['id'];
							
							$sql="delete from ".TBL_RESULT_DETAIL." where result_id='".$result_id."'";
							$this->db->query($sql,__FILE__,__LINE__);
							
								
							$i=0;
							foreach($this->subject_theory as $counter)
							{
									$insert_sql_array3 = array();
									$insert_sql_array3['result_id'] = $result_id;
									$insert_sql_array3['subject_theory'] = $counter;
									$insert_sql_array3['max_theory'] = $this->max_theory[$i];
									$insert_sql_array3['obt_theory'] = $this->obt_theory[$i];
									$insert_sql_array3['subject_practical'] = $this->subject_practical[$i];
									$insert_sql_array3['max_practical'] = $this->max_practical[$i];
									$insert_sql_array3['obt_practical'] = $this->obt_practical[$i];
									$this->db->insert(TBL_RESULT_DETAIL,$insert_sql_array3);
									$i++;
							}
							
						}
						else
						{
										$insert_sql_array1['student_id'] = $id;
										$insert_sql_array1['enrollment_number'] = $this->enrollment_no;
										$insert_sql_array1['enrollment_year'] = $this->enrollment_year;
										
										
										
										$theory_max_total=0;
										foreach($this->max_theory as $val)
										{
											$theory_max_total = $theory_max_total+$val;
										}
										
										$theory_obt_total=0;
										foreach($this->obt_theory as $value)
										{
											$theory_obt_total = $theory_obt_total+$value;
										}
										
										
										
										
										$practical_max_total =0;
										foreach($this->max_practical as $value1)
										{
											$practical_max_total  = $practical_max_total+$value1;
										}
										
										
										$practical_obt_total =0;
										foreach($this->obt_practical as $value2)
										{
											$practical_obt_total  = $practical_obt_total+$value2;
										}
										
										$theory_percent =  $theory_obt_total*100/$theory_max_total;
										$practical_percent  =  $practical_obt_total*100/$practical_max_total;
										
										$insert_sql_array1['theory_max_total'] = $theory_max_total;
										$insert_sql_array1['theory_obt_total'] = $theory_obt_total;
										$insert_sql_array1['practical_max_total'] = $practical_max_total;
										$insert_sql_array1['practical_obt_total'] = $practical_obt_total;
										$insert_sql_array1['theory_percent'] = $theory_percent;
										$insert_sql_array1['practical_percent'] = $practical_percent;
										
										$this->db->insert(TBL_RESULT,$insert_sql_array1);
										$result_id = $this->db->last_insert_id();
									
										
										$i=0;
										foreach($this->subject_theory as $counter)
										{
												$insert_sql_array2 = array();
												$insert_sql_array2['result_id'] = $result_id;
												$insert_sql_array2['subject_theory'] = $counter;
												$insert_sql_array2['max_theory'] = $this->max_theory[$i];
												$insert_sql_array2['obt_theory'] = $this->obt_theory[$i];
												$insert_sql_array2['subject_practical'] = $this->subject_practical[$i];
												$insert_sql_array2['max_practical'] = $this->max_practical[$i];
												$insert_sql_array2['obt_practical'] = $this->obt_practical[$i];
												$this->db->insert(TBL_RESULT_DETAIL,$insert_sql_array2);
												$i++;
										}
						}
					
							
							$_SESSION['msg'] = 'Student details has been Successfully Updated';
							
							?>
							<script type="text/javascript">
								window.location = "showallstudent.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->EditStudentDetails('local','$id');
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
	
	function deletestudent($id)
	{
			ob_start();
		
		$sql="delete from ".TBL_STUDENT." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		$_SESSION['msg']='Student Details has been Deleted successfully';
		
		?>
		<script type="text/javascript">
	location.reload(true);
		</script>
		<?php
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	
	
	function viewstudent($id)
			{
				$sql="select * from ".TBL_STUDENT." where id='".$id."'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
                 <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <a href="showallstudent.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All Student</button></div></a>
                        </div>
                        </div>
                        <div class="mws-panel grid_4">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i>Student Details</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <ul class="mws-summary clearfix">
                            <li>
                                <span class="key"><i class="icon-hand-right"></i>Enrollment No.</span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['enrollment_no'];?></span>
                                </span>
                            </li>
                             <li>
                                <span class="key"><i class="icon-hand-right"></i>Enrollment Year</span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['enrollment_year'];?></span>
                                </span>
                            </li>
                            
                            <li>
                                <span class="key"><i class="icon-hand-right"></i>Student Name</span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['student_name'];?></span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-hand-right"></i>Father Name</span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['father_name'];?></span>
                                </span>
                            </li>
                            
                            <li>
                                <span class="key"><i class="icon-hand-right"></i>Date Of Birth</span>
                                <span class="val">
                                 <span class="text-nowrap"><?php echo $row['dob'];?></span>
                                </span>
                            </li>
                             <li>
                                <span class="key"><i class="icon-hand-right"></i>Applied Course</span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $this->getCourseNamefromID($row['course']);?></span>
                                </span>
                            </li>
                             <li>
                                <span class="key"><i class="icon-hand-right"></i>Address</span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['address'];?></span>
                                </span>
                            </li>
                         
                         </ul>
                    </div>
                </div>
                <div class="mws-panel grid_4" style="min-height:355px;">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i>Student Image</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <ul class="mws-summary clearfix">
                            <li>
                                <span class="key"><i class="icon-hand-right"></i><?php echo $row['student_name'];?></span>
                                <span class="val">
                                    <span class="text-nowrap">
                                    <?php
									if($row['image']!='')
									{
										?>
                                    <img src="thumb.php?file=../gallery/<?php echo $row['image'];?>&sizex=300&sizey=300"/>
                                    <?php
									}
									else
									{
										echo 'No Pic Available';
									}
									?></span>
                                </span>
                            </li>
                             
                            
                            
                         
                         </ul>
                    </div>
                </div>
               <?php
			  			$sql_result="select * from ".TBL_RESULT." where student_id='".$row['id']."' and enrollment_number='".$row['enrollment_no']."'";
						$result_result= $this->db->query($sql_result,__FILE__,__LINE__);
						$cnt= $this->db->num_rows($result_result);
						$row_result= $this->db->fetch_array($result_result);
						if($cnt>0)
						{
						
			   ?>
                        <script>
                        function goBack()
  {
  window.history.back()
  }
</script>
                    <!--<button type="button" style="margin-left:100px;"class="btn btn-success" value="Print Result" onClick="printpage('printDiv');">Print Result</button></div>
                   -->
                <div class="mws-panel grid_8" id="printDiv">
                	<div class="mws-panel-header">
                    	
                    </div>
                    
                    <div class="mws-form  mws-panel-body">
                    <div class="mws-form-row" style="border:1px solid #606060;">
                  			  <div class="mws-form-cols" style="font-size:15px;">
                                    <div class="mws-form-col-4-8">
                                        <strong>Enrollment No.:</strong> <?php echo $row['enrollment_no'];?>
                                    </div>
                                    <div class="mws-form-col-4-8">
                                       <strong>Enrollment Year:</strong> <?php echo $row['enrollment_year'];?>
                                    </div>
                                </div>
                                <div class="mws-form-cols" style="font-size:15px;">
                                    <div class="mws-form-col-4-8">
                                        <strong>Student Name :</strong> <?php echo $row['student_name'];?>
                                    </div>
                                    <div class="mws-form-col-4-8">
                                       <strong>Father Name :</strong> <?php echo $row['father_name'];?>
                                    </div>
                                </div>
                                <div class="mws-form-cols" style="font-size:15px; margin-top:10px;">
                                    <div class="mws-form-col-8-8">
                                        <strong>Study Centre :</strong> Career Way Institute of Inter National Language, Sultanpur
                                    </div>
                                </div>
                                <hr />
                                 <div class="mws-form-cols" style="font-size:15px;  margin-top:10px; border:2px solid #606060;">
                                    <div class="mws-form-col-4-8" style="width:48.5%!important; border-right:2px solid #606060;">
                                       <h4 align="center">THEORY</h4>
                                    </div>
                                    <div class="mws-form-col-4-8">
                                       <h4 align="center">PRACTICAL</h4>
                                    </div>
                                </div>
                                
                                
                            	<div class="mws-form-cols" style="padding-top:10px; border-bottom:2px solid #606060; border-left:2px solid #606060;border-right:2px solid #606060;">
                                    <div class="mws-form-col-1-8" style="width:5.909%! important; font-weight:600; font-size:14px; text-align:center;">
                                       <div class="mws-form-item">
                                            PAPERS
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:20.909%! important; font-weight:600; font-size:14px; text-align:center;">
                                       <div class="mws-form-item">
                                            SUBJECT
                                        </div>
                                    </div>
                                  <div class="mws-form-col-1-8" style="width:7.909%! important; font-weight:600; font-size:14px; text-align:center;">
                                        <div class="mws-form-item">
                                            MAX.
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:7.909%! important; font-weight:600; font-size:14px; text-align:center;">
                                        <div class="mws-form-item">
                                            OBT.
                                        </div>
                                    </div>
                                   
                                     <div class="mws-form-col-1-8" style="width:20.909%! important; font-weight:600; font-size:14px; text-align:center;">
                                        <div class="mws-form-item">
                                            SUBJECT
                                        </div>
                                    </div>
                                  <div class="mws-form-col-1-8" style="width:7.909%! important; font-weight:600; font-size:14px; text-align:center;">
                                       <div class="mws-form-item">
                                            MAX.
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:7.909%! important; font-weight:600; font-size:14px; text-align:center;">
                                        <div class="mws-form-item">
                                            OBT.
                                        </div>
                                    </div>
                                 
                                </div>
                                <?php
        $sql_marks="select * from ".TBL_RESULT_DETAIL." where result_id='".$row_result['id']."'" ;
		$result_marks= $this->db->query($sql_marks,__FILE__,__LINE__);
		$x=1;
			while($row_marks = $this->db->fetch_array($result_marks))
				{  
				?>
                                
                                <div class="mws-form-cols" style="margin-top:10px; border-bottom:1px dashed #606060;">
                                    <div class="mws-form-col-1-8" style="width:5.909%! important; font-size:14px; text-align:center;">
                                       <div class="mws-form-item">
                                            <?php echo $x;?>.
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:20.909%! important;  font-size:14px; text-align:center;">
                                       <div class="mws-form-item">
                                           <?php echo $this->getSubjectNamefromID($row_marks['subject_theory']);?>
                                        </div>
                                    </div>
                                  <div class="mws-form-col-1-8" style="width:7.909%! important; font-size:14px; text-align:center;">
                                        <div class="mws-form-item">
                                            <?php echo $row_marks['max_theory'];?>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:7.909%! important;  font-size:14px; text-align:center;">
                                        <div class="mws-form-item">
                                           <?php echo $row_marks['obt_theory'];?>
                                        </div>
                                    </div>
                                   
                                     <div class="mws-form-col-1-8" style="width:20.909%! important;  font-size:14px; text-align:center;">
                                        <div class="mws-form-item">
                                            <?php echo $this->getSubjectNamefromID($row_marks['subject_practical']);?>
                                        </div>
                                    </div>
                                  <div class="mws-form-col-1-8" style="width:7.909%! important;  font-size:14px; text-align:center;">
                                       <div class="mws-form-item">
                                            <?php echo $row_marks['max_practical'];?>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:7.909%! important;  font-size:14px; text-align:center;">
                                        <div class="mws-form-item">
                                             <?php echo $row_marks['obt_practical'];?>
                                        </div>
                                    </div>
                                </div>
                         <?php
						 $x++;
				}
				?>
                
                <div class="mws-form-cols" style=" margin-top:10px; padding-top:5px; border:2px solid #606060; min-height:35px; font-size:15px; font-weight:600;">
                  <div class="mws-form-col-1-8" style="width:5.909%! important; font-size:16px; text-align:center;">
                                       <div class="mws-form-item">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:20.909%! important;  font-size:16px; text-align:center;">
                                       <div class="mws-form-item">
                                          Grand Total
                                        </div>
                                    </div>
                                  <div class="mws-form-col-1-8" style="width:7.909%! important; font-size:16px; text-align:center;">
                                        <div class="mws-form-item">
                                           <?php echo $row_result['theory_max_total'];?>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:7.909%! important;  font-size:16px; text-align:center;">
                                        <div class="mws-form-item">
                                           <?php echo $row_result['theory_obt_total'];?>
                                        </div>
                                    </div>
                                   
                                     <div class="mws-form-col-1-8" style="width:20.909%! important;  font-size:16px; text-align:center;">
                                        <div class="mws-form-item">
                                            Grand Total
                                        </div>
                                    </div>
                                  <div class="mws-form-col-1-8" style="width:7.909%! important;  font-size:16px; text-align:center;">
                                       <div class="mws-form-item">
                                            <?php echo $row_result['practical_max_total'];?>
                                        </div>
                                    </div>
                                    <div class="mws-form-col-1-8" style="width:7.909%! important;  font-size:16px; text-align:center;">
                                        <div class="mws-form-item">
                                            <?php echo $row_result['practical_obt_total'];?>
                                        </div>
                                    </div>
                  
                  </div>
                  
                  <div class="mws-form-cols" style="padding-top:5px; border:2px solid #606060; border-top:none; min-height:35px; font-size:15px; font-weight:600;">
                  <div class="mws-form-col-4-8" style="font-size:16px; text-align:center;">
                                       <div class="mws-form-item">
                                         Divison -  <?php 
										 if($row_result['theory_percent']>=33 and $row_result['theory_percent']<45)
										 {
											 echo 'Third';
										 }
										 elseif($row_result['theory_percent']>=45 and $row_result['theory_percent']<60)
										{
											echo 'Second';
										}
										else
										{
											echo 'First';
										}
										?>
                                        </div>
                                    </div>
                                   
                                    <div class="mws-form-col-4-8" style="font-size:16px; text-align:center;">
                                        <div class="mws-form-item">
                                           Divison -   <?php 
										 if($row_result['practical_percent']>=33 and $row_result['practical_percent']<45)
										 {
											 echo 'Third';
										 }
										 elseif($row_result['practical_percent']>=45 and $row_result['practical_percent']<60)
										{
											echo 'Second';
										}
										else
										{
											echo 'First';
										}
										?>
                                        </div>
                                    </div>
                  
                  </div>
                  

                  
                   </div>
                   </div>
                    
                </div>
                <?php
						}
						else
						{
							?>
                            <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <div align="left" style="font-size:14px; font-weight:600; color:#FFF;">Sorry, No Result Uplaoded Till Now.</div>
                        </div>
                        </div>
                            <?php
						}
                        
			}
				
				
				
				function getSubjectNamefromID($id)
			{
					$sql="select * from ".TBL_SUBJECT." where id='".$id."'" ;
					$result= $this->db->query($sql,__FILE__,__LINE__);
					$row = $this->db->fetch_array($result);
					return $row['subject'];
			}
			
				
				
}


?>