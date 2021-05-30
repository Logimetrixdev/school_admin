
<?php
/***********************************************************************************

Class Discription : This class will handle the asigning work to User.
					
************************************************************************************/

class Managehome{
	
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

	function showhome()

	{
		?>

		<div class="mws-panel grid_8">
			<div class="mws-panel-header">
				<span><i class="icon-table"></i>Home </span>
			</div>
			<div class="mws-panel-body no-padding">
				<table class="mws-datatable-fn mws-table">
					<thead>
						<tr>
							<th width="2%">ID</th>
							<th>Heading</th>
							<!--                    <th>Image</th>-->
							<th>Content</th>			
							<th width="3%">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 

						$sql="select * from ".TBL_HOME." order by id asc" ;
						$result= $this->db->query($sql,__FILE__,__LINE__);
						$x=1;
						while($row = $this->db->fetch_array($result))
						{
							?>
							<tr>
								<td><?php echo $x?></td>
								<td><?php echo $row['heading1'];?></td>
<!--                                    <td>
	<?php
                                        //if($row['image']!='')
                                       // {
	?>
	<img src="../images/<?php //echo $row['image'];?>" height="100" width="100"/>
	<?php
                                       // }
	?>
</td>-->
<td><?php echo $row['content1'];?></div></td>				   
<td><a href="edithome.php?vid=<?php echo $row['id'];?>" title="Edit Page" rel="tooltip" data-placement="top"><i class="icol-application-edit"></i></a></td>
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
function edithome($runat,$id)
{


	switch($runat){
		case 'local':
		$FormName = "frm_editpage";
		$ControlNames=array("heading1"			=>array('heading1',"''","Please Enter heading1.","span_heading1"),
			"heading2"			=>array('heading2',"''","Please Enter heading2.","span_heading2"),
			"heading3"			=>array('heading3',"''","Please Enter heading3.","span_heading3")

		);

		$ValidationFunctionName="CheckeditpageValidity";					
		$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
		echo $JsCodeForFormValidation;
		$sql="select * from ".TBL_HOME." where id='".$id."'";
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
<!--                                     <div class="mws-form-row">
                                    	<label class="mws-form-label">Select  Image</label>
                                    	<div class="mws-form-item">
                                        	<input type="file"  name="filess">
                                           
                                        </div>
                                    </div>-->
                                    <div class="mws-form-row">
                                    	<label class="mws-form-label">Heading1</label>
                                    	<div class="mws-form-item">
                                    		<input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading1" value="<?php echo $row['heading1'];?>">
                                    		<span style="color:#F00;" id="span_heading1"></span>
                                    	</div>
                                    </div>

                                    <div class="mws-form-row">
                                    	<label class="mws-form-label">Description1</label>
                                    	<div style="height:330px;" class="mws-form-item">
                                    		<textarea name="description1"><?php echo $row['content1'];?></textarea>
                                    		<script>
                                    			CKEDITOR.replace('description1');
                                    		</script>
                                    		<?php
                    					// include_once("fckeditor/fckeditor.php");

                    					// $sBasePath = $_SERVER['PHP_SELF'] ;
                    					// $sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

                    					// $oFCKeditor = new FCKeditor('description1') ;
                    					// $oFCKedditor->skin="office";
                    					// $oFCKeditor->BasePath	= $sBasePath ;
                    					// $oFCKeditor->Value		=  $row['content1'];
                    					// $oFCKeditor->Create() ;
                                    		?>

                                    	</div>
                                    </div>
                                    <div class="mws-form-row">
                                    	<label class="mws-form-label">Heading2</label>
                                    	<div class="mws-form-item">
                                    		<input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading2" value="<?php echo $row['heading2'];?>">
                                    		<span style="color:#F00;" id="span_heading2"></span>
                                    	</div>
                                    </div>

                                    <div class="mws-form-row">
                                    	<label class="mws-form-label">Description2</label>
                                    	<div style="height:330px;" class="mws-form-item">
                                    		<textarea name="description2"><?php echo $row['content2'];?></textarea>
                                    		<script>
                                    			CKEDITOR.replace('description2');
                                    		</script>
                                    		<?php
                                    		// include_once("fckeditor/fckeditor.php");

                                    		// $sBasePath = $_SERVER['PHP_SELF'] ;
                                    		// $sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

                                    		// $oFCKeditor = new FCKeditor('description2') ;
                                    		// $oFCKedditor->skin="office";
                                    		// $oFCKeditor->BasePath	= $sBasePath ;
                                    		// $oFCKeditor->Value		=  $row['content2'];
                                    		// $oFCKeditor->Create() ;
                                    		?>

                                    	</div>
                                    </div>
                                    <div class="mws-form-row">
                                    	<label class="mws-form-label">Heading3</label>
                                    	<div class="mws-form-item">
                                    		<input type="text" class="large" title="Heading" rel="tooltip" data-placement="bottom" name="heading3" value="<?php echo $row['heading3'];?>">
                                    		<span style="color:#F00;" id="span_heading3"></span>
                                    	</div>
                                    </div>

                                    <div class="mws-form-row">
                                    	<label class="mws-form-label">Description3</label>
                                    	<div style="height:330px;" class="mws-form-item">
                                    		<textarea name="description3"><?php echo $row['content3'];?></textarea>
                                    		<script>
                                    			CKEDITOR.replace('description3');
                                    		</script>
                                    		<?php

                                    		// include_once("fckeditor/fckeditor.php");

                                    		// $sBasePath = $_SERVER['PHP_SELF'] ;
                                    		// $sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

                                    		// $oFCKeditor = new FCKeditor('description3') ;
                                    		// $oFCKedditor->skin="office";
                                    		// $oFCKeditor->BasePath	= $sBasePath ;
                                    		// $oFCKeditor->Value		=  $row['content3']; ;
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
                    	$sql3="select * from ".TBL_HOME." where id='".$id."'" ;
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
                    $this->heading1=$heading1; 
                    $this->description1=$description1;
                    $this->heading2=$heading2; 
                    $this->description2=$description2;
                    $this->heading3=$heading3; 
                    $this->description3=$description3;

							//server side validation
                    $return =true;
                    if($this->Form->ValidField($heading1,'empty','Please Enter heading1')==false)
                    	$return =false;
                    if($this->Form->ValidField($description1,'empty','Please Enter Content1')==false)
                    	$return =false;
//                                                if($this->Form->ValidField($heading2,'empty','Please Enter heading2')==false)
//							$return =false;
//						if($this->Form->ValidField($description2,'empty','Please Enter Content2')==false)
//							$return =false;
//                                                if($this->Form->ValidField($heading3,'empty','Please Enter heading3')==false)
//							$return =false;
//						if($this->Form->ValidField($description3,'empty','Please Enter Content3')==false)
//							$return =false;


                    if($return){							
                    	$update_sql_array = array();							
                    	$update_sql_array['heading1'] = $this->heading1;				
                    	$update_sql_array['content1'] = $this->description1;
                    	$update_sql_array['heading2'] = $this->heading2;				
                    	$update_sql_array['content2'] = $this->description2;
                    	$update_sql_array['heading3'] = $this->heading3;				
                    	$update_sql_array['content3'] = $this->description3;
                    	$update_sql_array['image'] = $this->path;

                    	$this->db->update(TBL_HOME,$update_sql_array,'id',$id);							
                    	$_SESSION['msg'] = 'Page has been Successfully Updated';

                    	?>
                    	<script type="text/javascript">
                    		window.location = "showhome.php"
                    	</script>
                    	<?php
                    	exit();

                    } else {
                    	echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
                    	$this->edithome('local','$id');
                    }
                    break;
                    default 	: 
                    echo "Wrong Parameter passed";
                }


            }

        }

        ?>
        <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>