
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work to User.
					
************************************************************************************/

class SliderPic{
	
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
	 
	 
	function __construct()
        {
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
		
	}
	
	function Addslider($runat)
	{
    
		switch($runat){
			case 'local':
						$FormName = "frm_col";
						$ControlNames=array("filess"			=>array('filess',"''","Please Select Image","span_filess"),
								"slider_type"			=>array('slider_type',"''","Please select slider position","span_slider_type"),
								"slider_text"			=>array('slider_text',"''","Please Enter Slider Text","span_slider_text"),
                                                                "slider_heading"		=>array('slider_text',"''","Please Enter Slider Text","span_slider_heading")
											);
											

						$ValidationFunctionName="CheckcolValidity";					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
                        <div class="mws-panel grid_2">
                        <div class="mws-panel-header">
                        <span><a href="showallslider.php"/><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All Slider Image</button></a></span>
                        </div>
                        </div>
                  <div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add New Slider Image</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    	<div class="mws-form-inline">
							
<!--				<div class="mws-form-row">
                                    	<label class="mws-form-label">Select Slider Type</label>
                                    	<div class="mws-form-item">
                                            <select name="slider_type">
                                            <option value="">-----Select Slider Type-----</option>
                                            <option value="L">Left</option>
                                            <option value="C">Center</option>
                                            <option value="R">Right</option>
                                            </select> 
                                            <span style="color:#F00;" id="span_slider_type"></span>
                                        </div>
                                </div>-->
								
<!--                                    <div class="mws-form-row">
                                    	<label class="mws-form-label">Slider Heading</label>
                                    	<div class="mws-form-item">
					 <input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="slider_heading" >										
                                            <span style="color:#F00;" id="span_slider_heading"></span>
                                        </div>
                                </div>-->
<!--				<div class="mws-form-row">
                                    	<label class="mws-form-label">Slider Text</label>
                                    	<div class="mws-form-item">
					  <textarea rows="4" cols="50" name="slider_text" placeholder="Enter text here..."></textarea>										
                                            <span style="color:#F00;" id="span_slider_text"></span>
                                        </div>
                                </div>-->
                    			                              
                                <div class="mws-form-row">
                                    	<label class="mws-form-label">Slider Image</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="filess" value="">
                                            <span style="color:#F00;" id="span_filess"></span>
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
							move_uploaded_file($_FILES["filess"][tmp_name],"../img/".$path); 
							}
								else
								{
									echo 'Invalid file';
								
									
								}
							}
														
							$this->path=$path;
//							$this->slider_type=$slider_type;
//							$this->slider_text=$slider_text;
//							$this->slider_heading=$slider_heading;
					                //server side validation
							$return =true;
							if($return)
                                                        {						
							$insert_sql_array['slider1'] = $this->path;
//							$insert_sql_array['slider_type'] = $this->slider_type;
//							$insert_sql_array['slider_text'] = $this->slider_text;
//                                                      $insert_sql_array['slider_heading'] = $this->slider_heading;                 	    
							
							$this->db->insert(TBL_SLIDER,$insert_sql_array);							
							$_SESSION['msg'] = 'Slider Image has been Successfully Added';
							
							?>
							<script type="text/javascript">
								window.location = "addslider.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->Addslider('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	}
	                  
					  
		 function showallslider()
		 {
			?>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <a href="addslider.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New Slider Image</button></div></a>
                        </div>
                        </div>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>Slider Image List</span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">ID</th>
                        <th>Slider Image</th>
<!--			<th>Slider Type</th>
			<th>Slider Text</th>-->
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_SLIDER." order by slider_type" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
		while($row = $this->db->fetch_array($result))
		{
		?>
                		<tr>
                                    <td><?php echo $x;?></td>                                
                                    <td><img src="../img/<?php echo $row['slider1'];?>" height="150" width="100"/></td>
<!--                                    <td><?php //if($row['slider_type']=='C') { echo 'Center Slider';} elseif($row['slider_type']=='L') { echo 'Left Slider';} else { echo 'Right Slider';} ;?></td>
				    <td><?php //echo $row['slider_text'];?></td>-->
                                    <td><a href="javascript: void(0);" title="Delete" rel="tooltip" data-placement="top" onclick="javascript: if(confirm('Do u want to delete this Slider Image?')) { slider.deleteslider('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a></td>
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
	          function deleteslider($id)
	        {
		ob_start();
			
		$sql1="select * from ".TBL_SLIDER." where id='".$id."' ";
		$records = $this->db->query($sql1,__FILE__,__LINE__);
		$row1 = $this->db->fetch_array($records); 
	 	$path= $row1['slider1'];
//		$slider_type= $row1['slider_type'];
//		$slider_type= $row1['slider_text'];
//              $slider_heading= $row1['slider_heading'];
		$directory= '../slider_image/';
		///////////////////////////////////////////////////////////////
		$deldir=$directory.$path;
		unlink($deldir);
						
		$sql="delete from ".TBL_SLIDER." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		$_SESSION['msg']='Slider has been Deleted successfully';
		
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