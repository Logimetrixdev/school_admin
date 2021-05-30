   
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class image{
	
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

	
	 function addNewTopper($runat)
	{
    
		switch($runat){
			case 'local':
						$FormName = "frm_banners";
						$ControlNames=array(
											"filess"			=>array('filess',"''","Please select gallery image","span_filess"),
											"text"			=>array('text',"''","Please enter topper name","span_text")
						 )

						$ValidationFunctionName="CheckbannersValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><a href="showallimg1.php"/><button type="button" style="margin-left:25px; float:right;" class="btn btn-success"><i class="icon-cyclop"></i>View All Topper</button></a></span>
                        </div>
                        </div>
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add New Topper</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                     <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                    		<div class="mws-form-inline">
                               <div class="mws-form-row">
                                    	<label class="mws-form-label">Select Topper Photo</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="filess" value="">
                                             <span style="color:#F00;" id="span_filess"></span>
                                        </div>
                                </div>
                    			
                    		</div>
							
                               <div class="mws-form-row">
                                    	<label class="mws-form-label">Topper name</label>
                                    	<div class="mws-form-item">
                                        	<input type="text"  name="text" value="">
                                             <span style="color:#F00;" id="span_text"></span>
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
							//echo "Error: " . $_FILES["filess"]["error"] . "<br />";
							echo 'Invalid file';
							}
							else
							{
							  "Upload: " . $_FILES["file"]["name"] . "<br />";
							 "Type: " . $_FILES["file"]["type"] . "<br />";
							 "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
							 "Stored in: " . $_FILES["file"]["tmp_name"];
							$tmpname=$_FILES["filess"]["name"];
							$name= explode('.',$tmpname);
							$tmp=$_FILES["filess"]["type"];
							$type= explode('/',$tmp);
							if($type[1]=='jpeg'||$type[1]=='JPEG'||$type[1]=='jpg'||$type[1]=='JPG'||$type[1]=='png'||$type[1]=='PNG'||$type[1]=='gif'||$type[1]=='GIF')
								{						
						
						    $path= 'gallery_image'.$tmx.".".$type[1];
							
							move_uploaded_file($_FILES["filess"][tmp_name],"../gallery/".$path); 
							}
								else
								{
									echo 'Invalid file';
								
									
								}
							}
							
					
							
							$this->path=$path;
							$this->text=$text;
							//server side validation
							$return =true;
							
							if($this->Form->ValidField($path,'empty','Please Select an Image')==false)
								$return =false;
								if($this->Form->ValidField($path,'empty','Please Select an Name')==false)
								$return =false;
							if($return){
								
							
							$insert_sql_array = array();
						
							$insert_sql_array['img'] = $this->path;
							$insert_sql_array['topper_name'] = $this->path;
							
						    $this->db->insert(TBL_TOPPER,$insert_sql_array);
							
							$_SESSION['msg'] = 'Image has been Successfully Added';
							
							?>
							<script type="text/javascript">
							window.location = "showallimg1.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->addNewTopper('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	}    
					  
		 function showallimage()
		 {
			?>
            <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><a href="addimg1.php"/><button type="button" style="margin-left:25px; float:right;" class="btn btn-success"><i class="icon-cyclop"></i>Add Topper</button></a></span>
                        </div>
                        </div>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All Topper </span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">S.No.</th>
						<th width="30%">Topper photo</th>
                         <th width="20%">Topper name</th>
                          <th>Action</th>
                       
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_TOPPER."";
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
			while($row = $this->db->fetch_array($result))
				{
				?>
                					<tr>
                                    
 									<td><?php echo $x; ?></td>
                                    <td><img src="thumb.php?file=../gallery/<?php echo $row['img'];?>&sizex=100&sizey=100" alt="Image" /></td>
									<td><?php echo $row['topper_name'];?></td>
                                    <td><a  title="Delete Gallery Image" href="javascript : void(0);" onclick="javascript: if(confirm('Do u want to delete this topper Image ?')) { page.deleteImage('<?php echo $row['glry_id'];?>',{}) }; return false;" rel="tooltip" data-placement="top"><i class="icol-application-delete"></i></a></td>
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
			 		
			function deleteImage($id)
	{
			ob_start();
		
		$sql1="select * from ".TBL_TOPPER." where glry_id='".$id."' ";
		$records = $this->db->query($sql1,__FILE__,__LINE__);
		$row1 = $this->db->fetch_array($records); 
	 	$path1= $row1['img'];
	     $directory= '../gallery/';
		///////////////////////////////////////////////////////////////
			$deldir1=$directory.$path1;
			unlink($deldir1);
			
			
		$sql="delete from ".TBL_TOPPER." where glry_id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		
		$_SESSION['msg']='Image has been Deleted successfully';
		
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