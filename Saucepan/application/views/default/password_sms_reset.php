<?php $this->load->view('default/home_header')?>
<div class="password_list_title" style="margin-top:120px;">
	<?php if($this->langtype == '_ch'){
			echo 'Reset Your Password';
		}else{
			echo 'Reset Your Password';
		}
	?>
</div>
<div class="password_list_text">
	<?php if($this->langtype == '_ch'){
			echo 'If you have placed an online-order with us before we\'ve already created an account for you. Enter your phone number to reset your password. ';
		}else{
			echo 'If you have placed an online-order with us before we\'ve already created an account for you. Enter your details below to reset your password. ';
		}
	?>
</div>

<div class="login_title" style="width: calc(100% - 50px);padding:0 25px">
	<?php if($this->langtype == '_ch'){
			echo '电话';
		}else{
			echo 'Phone';
		}
	?>
</div>
<div class="login_input" style="width: calc(100% - 50px);padding:0 25px">
	<input type="text" style="width: calc(100% - 147px);" />
	<div style="width:135px;float:left;background-color: rgb(216, 216, 216);text-align: center;color: graytext;font-size: 14px;padding:9px 0;margin-left:10px;">
		SEND CODE
	</div>
</div>
<div class="password_list_btn" style="background-color: rgb(216, 216, 216);color: white;border:none;">
	<?php if($this->langtype == '_ch'){
			echo '重启';
		}else{
			echo 'Reset';
		}
	?>
</div>

<a class="login_btn" href="javascript:history.back(-1)" style="margin-bottom: 50px;;">
	←  Return
</a>
<?php $this->load->view('default/home_footer')?>