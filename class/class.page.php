
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
					************************************************************************************/

					class Page{

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

						function showallpage()
						{
							?>

							<div class="mws-panel grid_8">
								<div class="mws-panel-header">
									<span><i class="icon-table"></i>All Page </span>
								</div>
								<div class="mws-panel-body no-padding">
									<table class="mws-datatable-fn mws-table">
										<thead>
											<tr>
												<th>ID</th>
												<th>Heading</th>
												<th>Image</th>
												<th>Content</th>
												<th>Page</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>

											<?php 

											$sql="select * from ".TBL_PAGE." order by id asc" ;
											$result= $this->db->query($sql,__FILE__,__LINE__);
											$x=1;
											while($row = $this->db->fetch_array($result))
											{
												?>
												<tr>
													<td><?php echo $x?></td>
													<td><?php echo $row['heading'];?></td>
													<td>
														<?php
														if($row['image']!='')
														{
															?>
															<img src="../images/<?php echo $row['image'];?>" height="100" width="100"/>
															<?php
														}
														?>
													</td>
													<td><div style="height:150px; overflow:auto; width: 450px;"><?php echo $row['content'];?></div></td>
													<td><?php echo $row['page_name'];?></td>
													<td><a href="editpage.php?vid=<?php echo $row['id'];?>" title="Edit Page" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a></td>
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
						function editpage($runat,$id)
						{

							switch($runat){
								case 'local':
								$FormName = "frm_editpage";
								$ControlNames=array("heading"			=>array('heading',"''","Please Enter heading","span_heading")

							);

								$ValidationFunctionName="CheckeditpageValidity";					
								$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
								echo $JsCodeForFormValidation;
								$sql="select * from ".TBL_PAGE." where id='".$id."'";
								$result= $this->db->query($sql,__FILE__,__LINE__);
								$row= $this->db->fetch_array($result);
								?>

								<div class="mws-panel grid_8">
									<div class="mws-panel-header">
										<span>Edit PAGE</span>
									</div>
									<div class="mws-panel-body no-padding">
										<form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
											<div class="mws-form-inline">
												<div class="mws-form-row">
													<label class="mws-form-label">Heading</label>
													<div class="mws-form-item">
														<input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading" value="<?php echo $row['heading'];?>">
														<span style="color:#F00;" id="span_heading"></span>
													</div>
												</div>
												<div class="mws-form-row">
													<label class="mws-form-label">Select  Image</label>
													<div class="mws-form-item">
														<input type="file"  name="filess">                                         
													</div>
												</div>
												<div class="mws-form-row">
													<label class="mws-form-label">Description</label>
													<div style="height:330px;" class="mws-form-item">
														<textarea name="description"><?php echo $row['content'];?></textarea>
														<script>
															CKEDITOR.replace('description');
														</script>
														<?php
							// include_once("fckeditor/fckeditor.php");

							// $sBasePath = $_SERVER['PHP_SELF'] ;
							// $sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;							
							// $oFCKeditor = new FCKeditor('description') ;
							// $oFCKedditor->skin="office";
							// $oFCKeditor->BasePath	= $sBasePath ;
							// $oFCKeditor->Value		=  $row['content']; ;
							// $oFCKeditor->Create() ;
														?>

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
									$sql3="select * from ".TBL_PAGE." where id='".$id."'" ;
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
									}
								}

								$this->path=$path;
								$this->heading=$heading; 							
								$this->description=$description; 				
							//server side validation
								$return =true;
								if($this->Form->ValidField($heading,'empty','Please Enter heading')==false)
									$return =false;
								if($this->Form->ValidField($description,'empty','Please Enter Content')==false)
									$return =false;											
								if($return)
								{							
									$update_sql_array = array();							
									$update_sql_array['heading'] = $this->heading;				
									$update_sql_array['content'] = $this->description;
									$update_sql_array['image'] = $this->path;

									$this->db->update(TBL_PAGE,$update_sql_array,'id',$id);							
									$_SESSION['msg'] = 'Page has been Successfully Updated';

									?>
									<script type="text/javascript">
										window.location = "showallpage.php"
									</script>
									<?php
									exit();							
								} 
								else 
								{
									echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
									$this->editpage('local','$id');
								}
								break;
								default 	: 
								echo "Wrong Parameter passed";
							}


						}



					}

					?>
					<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>