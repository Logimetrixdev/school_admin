
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work
					to User.
************************************************************************************/

class Career{
	
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

	  function showallcareer()
       {
			?>
                        <div class="mws-panel grid_8">
                     
                        </div>
                        <div class="mws-panel grid_8">
                        <div class="mws-panel-header">
                        <span><i class="icon-table"></i>List</span>
                        </div>
                        <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                        <thead>
                        <tr>
                        <th width="2%">S.No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Content</th>
                        <th>Resume</th>
                        <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
           <?php 
                       
		$sql="select * from ".TBL_CAREER." order by id" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$x=1;
		while($row = $this->db->fetch_array($result))
		{
		 ?>
                	<tr>
                            <td><?php echo $x;?></td>                                
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['content'];?></td>
                            <td><a href="../Resume/<?php echo $row['resume'];?>" download>Download</a> </td>
                            <td><a href="javascript: void(0);" title="Delete Record" rel="tooltip" data-placement="top" onclick="javascript: if(confirm('Do u want to delete this record?')) { career.deletecareer('<?php echo $row['id'];?>',{}) };" ><i class="icol-application-delete"></i></a> </td>
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
	          function deletecareer($id)
	        {
			ob_start();
			
		$sql="delete from ".TBL_CAREER." where id='".$id."'";
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