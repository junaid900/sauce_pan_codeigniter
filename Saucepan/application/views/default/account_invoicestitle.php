<?php $this->load->view('default/home_header')?>

<a class="login_btn" href="javascript:history.back(-1)" style="margin-top:90px;">
	←  <?php if($this->langtype=='_ch'){echo "上一步";}else{echo "Return";}?>
</a>
<div style="width: calc(100% - 40px);;margin:20px 0;float: left;margin-left:20px;    border-bottom: 1px solid silver;">
	<div style="width: 100px;float:left;padding:10px;text-align: center;font-size:13px;"  onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/account_invoices'?>';">
		<?php if($this->langtype=='_ch'){echo "您的发票";}else{echo "Your Invoices";}?>
	</div>
	<div style="width: 100px;float:left;padding:10px 0;text-align: center;font-size:13px;border-bottom: 2px solid #17aaf5;">
		<?php if($this->langtype=='_ch'){echo "保存的标题";}else{echo "Saved Titles";}?>
	</div>
</div>	


<div class="login_title" style="text-align: center;" >
	<?php if($this->langtype=='_ch'){echo "没有可用的发票。";}else{echo "No Invoices Available.";}?>
	
</div>

<div class="password_list_btn" style="    width: calc(100% - 20px);margin-left:10px;">
	<?php if($this->langtype == '_ch'){
			echo '返回商店';
		}else{
			echo 'Return to Shop';
		}
	?>
</div>






<?php $this->load->view('default/home_footer')?>