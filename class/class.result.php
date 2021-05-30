
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
								$FormName = "result";
								$ControlNames=array("year"	=>array('year',"''","Please select year.","span_year"),
									"class"			=>array('class',"''","Please select contact no.","span_class"),
									"section"			=>array('section',"''","Please select section.","span_section"),
									"name"			=>array('name',"''","Please enter name.","span_name"),
									"scholor_id"			=>array('scholor_id',"''","Please enter scholor_id.","span_scholor_id"),
									"position"			=>array('position',"''","Please enter position.","span_position")
								);

								$ValidationFunctionName="CheckcategoryValidity";

								$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
								echo $JsCodeForFormValidation;
								?>
								<div class="mws-panel grid_2">
									<div class="mws-panel-header">
										<span><a href="showresult.php"/><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>View All Result</button></a></span>
									</div>
								</div>

								<div class="mws-panel grid_7">
									<div class="mws-panel-header">
										<span>Add Result</span>
									</div>
									<div class="mws-panel-body no-padding">
										<form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>" class="mws-form" >
											<div class="mws-form-inline">
												<div class="mws-form-row bordered">
													<label class="mws-form-label">Year</label>
													<div class="mws-form-item">
														<select name="year">
															<option value="">---select year---</option>
															<option>2009</option>
															<option>2010</option>
															<option>2011</option>
															<option>2012</option>
															<option>2013</option>
															<option>2014</option>
															<option>2015</option>
															<option>2016</option>
															<option>2017</option>
															<option>2018</option>
															<option>2019</option>
															<option>2020</option>
														</select>

														<span id="span_year"></span>
													</div>
												</div>
												<div class="mws-form-row bordered">
													<label class="mws-form-label">Class</label>
													<div class="mws-form-item">                                      
														<select name="class">
															<option value="">---select class---</option>
															<option value="PG">PG</option>
															<option value="NURSERY">NURSERY</option>
															<option value="KG">KG</option>
															<option value="I">I</option>
															<option value="II">II</option>
															<option value="III">III</option>
															<option value="IV">IV</option>
															<option value="V">V</option>
															<option value="VI">VI</option>
															<option value="VII">VII</option>
															<option value="VIII">VIII</option>
															<option value="IX">IX</option>
															<option value="X">X</option>
															<option value="XI">XI</option>
															<option accesskey="XII">XII</option>
														</select>
														<span id="span_class"></span>
													</div>
												</div>
												<div class="mws-form-row bordered">
													<label class="mws-form-label">Section</label>
													<div class="mws-form-item">
														<select name="section">
															<option value="">---select section---</option>
															<option value="CHAMPION">CHAMPION</option>
															<option value="DIAMOND">DIAMOND</option>
															<option value="EXCELLENT">EXCELLENT</option>
															<option value="ACHIEVER">ACHIEVER</option>
															<option value="BRILLIANT">BRILLIANT</option>
														</select>

														<span id="span_section"></span>
													</div>
												</div>
												<div class="mws-form-row bordered">
													<label class="mws-form-label">Student Name</label>
													<div class="mws-form-item">
														<input type="text" class="large" rel="tooltip" data-placement="bottom" name="name" value="" data-original-title="Heading">

														<span id="span_name"></span>
													</div>
												</div>

												<div class="mws-form-row bordered">
													<label class="mws-form-label">Scholor Id</label>
													<div class="mws-form-item">
														<input type="text" class="large" rel="tooltip" data-placement="bottom" name="scholor_id" value="" data-original-title="Heading">

														<span id="span_scholor_id"></span>
													</div>
												</div>

												<div class="mws-form-row bordered">
													<label class="mws-form-label">Position</label>
													<div class="mws-form-item">
														<input type="text" class="large" rel="tooltip" data-placement="bottom" name="position" value="" data-original-title="Heading">

														<span id="span_position"></span>
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

								$this->year = $year;
								$this->class = $class;
								$this->section = $section;
								$this->name = $name;
								$this->scholor_id = $scholor_id;
								$this->position = $position;

							//server side validation
								$return =true;
								if($return){

									$insert_sql_array = array();

									$insert_sql_array['year'] = $this->year;
									$insert_sql_array['class'] = $this->class;
									$insert_sql_array['section'] = $this->section;
									$insert_sql_array['name'] = $this->name;
									$insert_sql_array['scholor_id'] = $this->scholor_id;
									$insert_sql_array['position'] = $this->position;

									$this->db->insert(TBL_RESULT,$insert_sql_array);

									$_SESSION['msg'] = 'Result has been successfully added';

									?>
									<script type="text/javascript">
										window.location = "addresult.php"
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
									<a href="addresult.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New result</button></div></a>
								</div>
							</div>
							<div class="mws-panel grid_8">
								<div class="mws-panel-header">
									<span><i class="icon-table"></i>Result List</span>
								</div>
								<div class="mws-panel-body no-padding">
									<table class="mws-datatable-fn mws-table">
										<thead>
											<tr>
												<th>Scholor Id</th>
												<th>Student Name</th>
												<th>Year</th>
												<th>Class</th>
												<th>Section</th>
												<th>Position</th>
												<th width="8%">Action</th>
											</tr>
										</thead>
										<tbody>

											<?php 

											$sql="select * from ".TBL_RESULT." order by id desc" ;
											$result= $this->db->query($sql,__FILE__,__LINE__);
											$x=1;
											while($row = $this->db->fetch_array($result))
											{
												?>
												<tr>
													<td><div style="height:50px; overflow:auto;"><?php echo $row['scholor_id'];?></div></td>
													<td><div style="height:50px; overflow:auto;"><?php echo $row['name'];?></div></td>
													<td><div style="height:50px; overflow:auto;"><?php echo $row['year'];?></div></td>
													<td><div style="height:50px; overflow:auto;"><?php echo $row['class'];?></div></td>
													<td><div style="height:50px; overflow:auto;"><?php echo $row['section'];?></div></td>
													<td><div style="height:50px; overflow:auto;"><?php echo $row['position'];?></div></td>

													<td><a href="editresult.php?vid=<?php echo $row['id'];?>" title="Edit Result" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a>
														<a href="javascript: void(0);" title="Delete" rel="tooltip" data-placement="top"
														onclick="javascript: if(confirm('Do u want to delete this Result?')) { contactdetail.deletecontact('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a></td>
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
									$FormName = "result";
									$ControlNames=array("year"	=>array('year',"''","Please select year.","span_name"),
										"class"			=>array('class',"''","Please select contact no.","span_class"),
										"section"			=>array('section',"''","Please select section.","span_section"),
										"name"			=>array('name',"''","Please enter name.","span_name"),
										"scholor_id"			=>array('scholor_id',"''","Please enter scholor_id.","span_scholor_id"),
										"position"			=>array('position',"''","Please enter position.","span_position")
									);

									$ValidationFunctionName="CheckeditcategoryValidity";

									$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
									echo $JsCodeForFormValidation;
									$sql="select * from ".TBL_RESULT." where id='".$id."'";
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
														<label class="mws-form-label">Year</label>
														<div class="mws-form-item">
															<select name="year">
																<option value="" <?php if($row['year']==''){echo 'selected';} ?> >---select year---</option>
																<option value="2009" <?php if($row['year']=='2009'){echo 'selected';} ?>>2009</option>
																<option value="2010" <?php if($row['year']=='2010'){echo 'selected';} ?>>2010</option>
																<option value="2011" <?php if($row['year']=='2011'){echo 'selected';} ?>>2011</option>
																<option value="2012" <?php if($row['year']=='2012'){echo 'selected';} ?>>2012</option>
																<option value="2013" <?php if($row['year']=='2013'){echo 'selected';} ?>>2013</option>
																<option value="2014" <?php if($row['year']=='2014'){echo 'selected';} ?>>2014</option>
																<option value="2015" <?php if($row['year']=='2015'){echo 'selected';} ?>>2015</option>
																<option value="2016" <?php if($row['year']=='2016'){echo 'selected';} ?>>2016</option>
																<option value="2017" <?php if($row['year']=='2017'){echo 'selected';} ?>>2017</option>
																<option value="2018" <?php if($row['year']=='2018'){echo 'selected';} ?>>2018</option>
																<option value="2019" <?php if($row['year']=='2019'){echo 'selected';} ?>>2019</option>
																<option value="2020" <?php if($row['year']=='2020'){echo 'selected';} ?>>2020</option>
															</select>

															<span id="span_year"></span>
														</div>
													</div>
													<div class="mws-form-row bordered">
														<label class="mws-form-label">Class</label>
														<div class="mws-form-item">                                      
															<select name="class">
																<option value="" <?php if($row['class']==''){echo 'selected';} ?>>---select class---</option>
																<option value="I" <?php if($row['class']=='I'){echo 'selected';} ?>>I</option>
																<option value="II" <?php if($row['class']=='II'){echo 'selected';} ?>>II</option>
																<option value="III" <?php if($row['class']=='III'){echo 'selected';} ?>>III</option>
																<option value="IV" <?php if($row['class']=='IV'){echo 'selected';} ?>>IV</option>
																<option value="V" <?php if($row['class']=='V'){echo 'selected';} ?>>V</option>
																<option value="VI" <?php if($row['class']=='VI'){echo 'selected';} ?>>VI</option>
																<option value="VII" <?php if($row['class']=='VII'){echo 'selected';} ?>>VII</option>
																<option value="VIII" <?php if($row['class']=='VIII'){echo 'selected';} ?>>VIII</option>
																<option value="IX" <?php if($row['class']=='IX'){echo 'selected';} ?>>IX</option>
																<option value="X" <?php if($row['class']=='X'){echo 'selected';} ?>>X</option>
																<option value="XI" <?php if($row['class']=='XI'){echo 'selected';} ?>>XI</option>
																<option accesskey="XII" <?php if($row['class']=='XII'){echo 'selected';} ?>>XII</option>
															</select>
															<span id="span_class"></span>
														</div>
													</div>
													<div class="mws-form-row bordered">
														<label class="mws-form-label">Section</label>
														<div class="mws-form-item">
															<select name="section">
																<option value="" <?php if($row['section']==''){echo 'selected';} ?>>---select section---</option>
																<option value="CHAMPION" <?php if($row['section']=='CHAMPION'){echo 'selected';} ?>>CHAMPION</option>
																<option value="DIAMOND" <?php if($row['section']=='DIAMOND'){echo 'selected';} ?>>DIAMOND</option>
																<option value="EXCELLENT" <?php if($row['section']=='EXCELLENT'){echo 'selected';} ?>>EXCELLENT</option>
															</select>

															<span id="span_section"></span>
														</div>
													</div>
													<div class="mws-form-row bordered">
														<label class="mws-form-label">Student Name</label>
														<div class="mws-form-item">
															<input type="text" class="large" rel="tooltip" data-placement="bottom" name="name" value="<?php echo $row['name']; ?>" data-original-title="Heading">

															<span id="span_contact"></span>
														</div>
													</div>

													<div class="mws-form-row bordered">
														<label class="mws-form-label">Scholor Id</label>
														<div class="mws-form-item">
															<input type="text" class="large" rel="tooltip" data-placement="bottom" name="scholor_id" value="<?php echo $row['scholor_id']; ?>" data-original-title="Heading">

															<span id="span_contact"></span>
														</div>
													</div>

													<div class="mws-form-row bordered">
														<label class="mws-form-label">Position</label>
														<div class="mws-form-item">
															<input type="text" class="large" rel="tooltip" data-placement="bottom" name="position" value="<?php echo $row['position']; ?>" data-original-title="Heading">

															<span id="span_contact"></span>
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

									$this->year = $year;
									$this->class = $class;
									$this->section = $section;
									$this->name = $name;
									$this->scholor_id = $scholor_id;
									$this->position = $position;


							//server side validation
									$return =true;
									if($return)
									{							
										$update_sql_array = array();							
										$update_sql_array['year'] = $this->year;
										$update_sql_array['class'] = $this->class;
										$update_sql_array['section'] = $this->section;
										$update_sql_array['name'] = $this->name;
										$update_sql_array['scholor_id'] = $this->scholor_id;
										$update_sql_array['position'] = $this->position;

										$this->db->update(TBL_RESULT,$update_sql_array,'id',$id);

										$_SESSION['msg'] = 'Result has been Successfully Updated';							
										?>
										<script type="text/javascript">
											window.location = "showresult.php"
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
							function deletecontact($id)
							{
								ob_start();

								$sql="delete from ".TBL_RESULT." where id='".$id."'";
								$this->db->query($sql,__FILE__,__LINE__);		
								$_SESSION['msg']='Result has been Deleted successfully';		
								?>
								<script type="text/javascript">
									window.location= "showresult.php";
								</script>
								<?php		
								$html = ob_get_contents();
								ob_end_clean();
								return $html;
							}

						}
						?>