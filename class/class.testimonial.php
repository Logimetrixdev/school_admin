
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
					************************************************************************************/

					class Testimonial{

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


						function Addtestimonial($runat)
						{
							switch($runat){
								case 'local':
								$FormName = "frm_testimonial";
								$ControlNames=array("content"			=>array('content',"''","Please Enter testimonial","span_content")
							);

								$ValidationFunctionName="CheckcategoryValidity";

								$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
								echo $JsCodeForFormValidation;
								?>
								<div class="mws-panel grid_8">
									<div class="mws-panel-header">
										<span><a href="showalltestimonial.php"/><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All News</button></a></span>
									</div>
								</div>

								<div class="mws-panel grid_8">
									<div class="mws-panel-header">
										<span>Add Testimonial</span>
									</div>
									<div class="mws-panel-body no-padding">
										<form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
											<div class="mws-form-inline">

												<div class="mws-form-row">
													<label class="mws-form-label">Select  Image</label>
													<div class="mws-form-item">
														<input type="file"  name="filess">                                         
													</div>
												</div>
												<div class="mws-form-row bordered">
													<label class="mws-form-label">News</label>
													<div class="mws-form-item">
														<textarea name="content" ><?php echo $row['content'];?></textarea>

														<script>
															CKEDITOR.replace('content');
														</script>
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
										move_uploaded_file($_FILES["filess"][tmp_name],"../images/".$path); 
									}
									else
									{
										echo 'Invalid file';
										exit;
									}
								}
								$this->path=$path;
								$this->content = $content;
							//server side validation
								$return =true;

								if($return){

									$insert_sql_array = array();
									$insert_sql_array['image'] = $this->path;
									$insert_sql_array['content'] = $this->content;

									$this->db->insert(TBL_TESTIMONIAL,$insert_sql_array);

									$_SESSION['msg'] = 'News has been Successfully Added';

									?>
									<script type="text/javascript">
										window.location = "addtestimonial.php"
									</script>
									<?php
									exit();

								} else {
									echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
									$this->Addcategory('local');
								}
								break;
								default 	: 
								echo "Wrong Parameter passed";
							}
						}


						function showalltestimonial()
						{
							?>
							<div class="mws-panel grid_8">
								<div class="mws-panel-header">
									<a href="addtestimonial.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New News</button></div></a>
								</div>
							</div>
							<div class="mws-panel grid_8">
								<div class="mws-panel-header">
									<span><i class="icon-table"></i>News List</span>
								</div>
								<div class="mws-panel-body no-padding">
									<table class="mws-datatable-fn mws-table">
										<thead>
											<tr>
												<th width="2%">S.No.</th>
												<th>News</th> 
												<th>Image</th>                      
												<th width="8%">Action</th>
											</tr>
										</thead>
										<tbody>

											<?php 

											$sql="select * from ".TBL_TESTIMONIAL." order by id desc" ;
											$result= $this->db->query($sql,__FILE__,__LINE__);
											$x=1;
											while($row = $this->db->fetch_array($result))
											{
												?>
												<tr>
													<td><?php echo $x?></td>
													<td><div style="height:50px; overflow:auto;"><?php echo $row['content'];?></div></td> 
													<td><img src="../images/<?php echo $row['image'];?>" height="150" width="100"/></td>                                   
													<td><a href="edittestimonial.php?vid=<?php echo $row['id'];?>" title="Edit" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>

														<a href="javascript: void(0);" title="Delete" rel="tooltip" data-placement="top" onclick="javascript: if(confirm('Do u want to delete this Tetimonail?')) { testimonial.deletetestimonial('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a></td>
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

							function edittestimonial($runat,$id)
							{

								switch($runat){
									case 'local':
									$FormName = "frm_editcategory";
									$ControlNames=array("content"			=>array('content',"''","Please Enter testionial","span_content")

								);

									$ValidationFunctionName="CheckeditcategoryValidity";

									$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
									echo $JsCodeForFormValidation;
									$sql="select * from ".TBL_TESTIMONIAL." where id='".$id."'";
									$result= $this->db->query($sql,__FILE__,__LINE__);
									$row= $this->db->fetch_array($result);
									?>


									<div class="mws-panel grid_8">
										<div class="mws-panel-header">
											<span><a href="showalltestimonial.php"/><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All News</button></a></span>
										</div>
									</div>
									<div class="mws-panel grid_8">
										<div class="mws-panel-header">
											<span>Edit News</span>
										</div>
										<div class="mws-panel-body no-padding">
											<form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
												<div class="mws-form-inline">
													<div class="mws-form-row">
														<label class="mws-form-label">Select  Image</label>
														<div class="mws-form-item">
															<input type="file"  name="filess">                                         
														</div>
													</div>

													<div class="mws-form-row bordered">
														<label class="mws-form-label">News</label>
														<div class="mws-form-item">
															<textarea name="content"><?php echo $row['content'];?></textarea>
															<script>
																CKEDITOR.replace('content');
															</script>
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
									//server side validation													
									$tmx=time();
									if ($_FILES["filess"]["error"] > 0)
									{
										$sql3="select * from ".TBL_TESTIMONIAL." where id='".$id."'" ;
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
											move_uploaded_file($_FILES["filess"][tmp_name],"../images/".$path); 
										}
										else
										{
											echo 'Invalid file';
											exit;
										}
									}
									$this->path=$path;
									$this->content = $content;
					           //server side validation
									$return =true;
									if($return){

										$update_sql_array = array();
										$update_sql_array['image'] = $this->path;
										$update_sql_array['content'] = $this->content;

										$this->db->update(TBL_TESTIMONIAL,$update_sql_array,'id',$id);

										$_SESSION['msg'] = 'News has been Successfully Updated';

										?>
										<script type="text/javascript">
											window.location = "showalltestimonial.php"
										</script>
										<?php
										exit();

									} else {
										echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
										$this->edittestimonial('local','$id');
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

							function deletetestimonial($id)
							{
								ob_start();

								$sql="delete from ".TBL_TESTIMONIAL." where id='".$id."'";
								$this->db->query($sql,__FILE__,__LINE__);

								$_SESSION['msg']='TESTIMONIAL has been Deleted successfully';

								?>
								<script type="text/javascript">
									window.location= "showalltestimonial.php";
								</script>
								<?php

								$html = ob_get_contents();
								ob_end_clean();
								return $html;
							}




						}


						?>
						<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>