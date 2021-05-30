<?php
class Enquiry
{
	
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
		function showenquiry()
		{
			
			?>
            <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span></span>
                        </div>
                        </div>
                        
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>All Enquiry </span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">S.No.</th>
                        <th >Name</th>
                         <th >Email</th>
                         <th>Contact</th>
                         <th>Course</th>
                         <th>Date</th>
                            <th>Action</th>
                       
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_ENQUIRY." order by timestamp";
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
			while($row = $this->db->fetch_array($result))
				{
				?>
                					<tr>
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                   <td><?php echo $row['phone'];?></td>
                                    <td><?php echo $row['course_name'];?></td>
                                    <td><?php echo $row['date'];?></td> 
                                    
                                      
                                   <td>
                                    
                                   <a  title="Delete" href="javascript : void(0);" onclick="javascript: if(confirm('Do u want to delete this Enquiry ?')) { objenq.deleteenq('<?php echo $row['id'];?>',{}) }; return false;" rel="tooltip" data-placement="top"><i class="icol-application-delete"></i></a>
                                   </td>
                                   
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
		
		
		function ViewDetail($id)
		{
			
			$sql="select * from ".TBL_CONTACT." where id = '".$id."'";
		$result= $this->db->query($sql,__FILE__,__LINE__);
			$row = $this->db->fetch_array($result);
			
			?>
			<div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span>Contact Details</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <ul class="mws-summary clearfix">
                            <li>
                                <span class="key"><i class="icon-pushpin"></i> Name : </span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['name'];?></span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-pushpin"></i> Phone No. : </span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['contact'];?></span>
                                </span>
                            </li>
                           
                            <li>
                                <span class="key"><i class="icon-pushpin"></i> Email Address :</span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['email'];?></span>
                                </span>
                            </li>
                           
                            <li>
                                <span class="key"><i class="icon-pushpin"></i> Address :</span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['address'];?></span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-pushpin"></i> Subject :</span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['subject'];?></span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-pushpin"></i> Message :</span>
                                <span class="val">
                                    <span class="text-nowrap"><?php echo $row['comments'];?></span>
                                </span>
                            </li>
                            
                             
                         
                         </ul>
                    </div>      
                </div>
                <?php
		}
		
		
		function deleteenq($id)
	{
			ob_start();
		
		$sql="delete from ".TBL_ENQUIRY." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		$_SESSION['msg']='Enquiry has been Deleted successfully';
		
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