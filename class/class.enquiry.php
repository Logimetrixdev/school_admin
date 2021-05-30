
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class Enquiry{
	
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
		  
		 function showallenquiry()
		 {
			?>
                        <div class="mws-panel grid_8">
                       <!--<div class="mws-panel-header">
                        <a href="addslider.php"/><div align="right"><button type="button" style="margin-left:25px;"class="btn btn-success"><i class="icon-cyclop"></i>Add New Slider Image</button></div></a>
                        </div>-->
                        </div>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>Enquiry List</span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">ID</th>
                        <th>Name</th>
						<th>Email</th>
						<th>Contact No.</th>
                                                <th>Content</th>                                              
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_ENQUIRY." order by id" ;
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
                                    <td><?php echo $row['content'];?></td>
                                    
                                    <td>
                                    <a href="javascript: void(0);" title="Delete Record" rel="tooltip" data-placement="top"
					onclick="javascript: if(confirm('Do u want to delete this record?')) { enquiry.deleteenquiry('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a>
                                  
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
	function deleteenquiry($id)
	{
			ob_start();
                $sql="delete from ".TBL_ENQUIRY." where id='".$id."'";
		$this->db->query($sql,__FILE__,__LINE__);
		
		$_SESSION['msg']='Record has been Deleted successfully';
		
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