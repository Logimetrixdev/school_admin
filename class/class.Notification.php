<?php
//**************** Notification class Created for displaying notification messages across the website ****************
	class Notification
	{
	
		var $notice;	
		var $timeout;
	
		function __construct()
		{
			$this->notice=$_SESSION[msg];
			$this->error=$_SESSION[error_msg];
			$this->timeout=20000;
		}
		function SetNote($note)
		{
			$this->notice=$note;
		}
		
		function SetTimeout($SetTimeout)
		{
			$this->SetTimeout=$SetTimeout;
		}
		
		function Notify()
		{
			if($this->notice!='') {
			?>
			<script type="text/javascript">
			setTimeout('document.getElementById("message_t").style.display="none";',<?php echo $this->timeout; ?>);
			</script> 
			<div  id="message_t">
			<div class='mws-form-message success'>
			<p>
				<img src="images/icon_accept.png" alt="success" class="mid_align"/>
				<?php echo $this->notice; ?>
			</p>	
			</div>
			</div>
			<?php
			$this->destroy_note();
			}
			else if($this->error!='')
			{
			?>
			<script type="text/javascript">
			setTimeout('document.getElementById("message_er").style.display="none";',<?php echo $this->timeout; ?>);
			</script> 
			<div  id="message_er">
			<div class='mws-form-message error'>
			<p>
				<img src="images/icon_error.png" alt="" class="mid_align"/>
				<?php echo $this->error; ?>
			</p>	
			</div>
			</div>
			<?php
			$this->destroy_note();
			}
		}
		
		function destroy_note()
		{
			$_SESSION['msg']='';
			$_SESSION['error_msg']='';
		}
	
	}

?>