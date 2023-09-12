<?php $this->load->view('default/home_header')?>
<div class="password_list_title" style="margin-top:120px;">
	<?php if($this->langtype == '_ch'){
			echo '邮箱';
		}else{
			echo 'Email';
		}
	?>
</div>
<div class="password_list_text">
	<?php if($this->langtype == '_ch'){
			echo '您将收到一封指向您的电子邮件的链接，您可以在其中重置密码。';
		}else{
			echo 'You will receive a link to your email that will allow you to reset your password.';
		}
	?>
</div>
<div class="password_list_btn" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/password_reset'?>';">
	<?php if($this->langtype == '_ch'){
			echo '选择';
		}else{
			echo 'SELECT';
		}
	?>
</div>
<div class="password_list_title" style="margin-top:50px;">
	<?php if($this->langtype == '_ch'){
			echo '短信';
		}else{
			echo 'SMS';
		}
	?>
</div>
<div class="password_list_text">
	<?php if($this->langtype == '_ch'){
			echo '您将收到您注册的电话号码的消息，提供可用于重置密码的代码。';
		}else{
			echo 'You will receive a message to the phone number that you signed up with, providing a code that you can use to reset your password.';
		}
	?>
</div>
<div class="password_list_btn" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/password_sms_reset'?>';">
	<?php if($this->langtype == '_ch'){
			echo '选择';
		}else{
			echo 'Select';
		}
	?>
</div>
<?php $this->load->view('default/home_footer')?>