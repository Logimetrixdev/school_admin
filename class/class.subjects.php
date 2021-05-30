
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class All_Subject{
	
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
	
	
	
	function Addsubject($runat)
	{
    
		switch($runat){
			case 'local':
						$FormName = "frm_addcity";
						$ControlNames=array("news"			=>array('news',"''","Please Enter news","span_news")
											
						 );

						$ValidationFunctionName="CheckcityValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						?>
                        <div class="mws-panel grid_2">
                        <div class="mws-panel-header">
                        <span><a href="showallsubjects.php"/><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All News</button></a></span>
                        </div>
                        </div>
                        
                        <div class="mws-panel grid_7">
                    <div class="mws-panel-header">
                        <span>Add New News</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                         <div class="mws-form-inline">
                         
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">New News</label>
                                    <div class="mws-form-item">
									<textarea  name="news" id="cleditor" class="large"></textarea>
                                       
                                        <span id="span_news"></span>
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
							
							$this->news = $news;
							
						
							
							
							//server side validation
							$return =true;
							
						if($this->Form->ValidField($news,'empty','Please Enter News')==false)
							$return =false;
						
					
							
							if($return){
							
							$insert_sql_array = array();
							
							$insert_sql_array['news'] = $this->news;
							
							
						    $this->db->insert(TBL_SUBJECT,$insert_sql_array);
							
							$_SESSION['msg'] = 'News has been Successfully Added';
							
							?>
							<script type="text/javascript">
								window.location = "addsubject.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->Addsubject('local');
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	}
	                  
					  
		 function showallsubject()
		 {
			?>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <a href="addsubject.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New News</button></div></a>
                        </div>
                        </div>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>News</span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">ID</th>
                        <th>News</th>
                      
                        <th width="8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_SUBJECT." order by timestamp desc" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
			while($row = $this->db->fetch_array($result))
				{
				?>
                					<tr>
                                    <td><?php echo $x?></td>
                                    <td><?php echo $row['news'];?></td>
                                    
                                    <td><a href="editsubjects.php?vid=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>
                                    <a href="javascript: void(0);" title="Delete" rel="tooltip" data-placement="top"
					onclick="javascript: if(confirm('Do u want to delete this subject?')) { subject_obj.deletesubject('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a></td>
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
		    
			function editsubject($runat,$id)
			{
				
    
		switch($runat){
			case 'local':
						$FormName = "frm_editcity";
							$ControlNames=array("news"			=>array('news',"''","Please Enter News","span_news")
										
						 );

						$ValidationFunctionName="CheckeditcityValidity";
					
						$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
						echo $JsCodeForFormValidation;
						$sql="select * from ".TBL_SUBJECT." where id='".$id."'";
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$row= $this->db->fetch_array($result);
						?>
		
                        
                        <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                     <span>Edit News</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    <form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
                         <div class="mws-form-inline">
                         
                         
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">News</label>
                                    <div class="mws-form-item">
									<textarea id="cleditor" class="large"  name="news"><?php echo $row['news'];?>											</textarea>
                                        
                                        <span id="span_subject"></span>
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
							
							$this->news = $news;
							
							
							
							//server side validation
							$return =true;
								
						if($this->Form->ValidField($news,'empty','Please Enter News')==false)
							$return =false;
							
							
							if($return){
							
							$update_sql_array = array();
							$update_sql_array['news'] = $this->news;
						
							
							$this->db->update(TBL_SUBJECT,$update_sql_array,'id',$id);
							
							$_SESSION['msg'] = 'News has been Successfully Updated';
							
							?>
							<script type="text/javascript">
								window.location = "showallsubjects.php"
							</script>
							<?php
							exit();
							
							} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->editsubject('local',$id);
							}
							break;
			default 	: 
							echo "Wrong Parameter passed";
		}
	
	
	}

	
	function deletesubject($id)
	{
			ob_start();
		
		$sql="delete from ".TBL_SUBJECT." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		$_SESSION['msg']='News has been Deleted successfully';
		
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