<?php $this->load->view('default/home_header')?>

<a class="login_btn" href="javascript:history.back(-1)" style="margin-top:90px;">
	←  <?php if($this->langtype=='_ch'){echo "上一步";}else{echo "Return";}?>
</a>
<div style="width: calc(100% - 40px);;margin:20px 0;float: left;margin-left:20px;    border-bottom: 1px solid silver;">
	<div style="width: 100px;float:left;padding:10px;text-align: center;color: ;border-bottom: 2px solid #17aaf5;font-size:13px;;">
		<?php if($this->langtype=='_ch'){echo "您的发票";}else{echo "Your Invoices";}?>
	</div>
	<div style="width: 100px;float:left;padding:10px 0;text-align: center;color: ;font-size:13px;" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/account_invoicestitle'?>';">
		<?php if($this->langtype=='_ch'){echo "保存的标题";}else{echo "Saved Titles";}?>
	</div>
</div>	


<div class="login_title" style="text-align: center;" >
	<?php if($this->langtype=='_ch'){echo "没有可用的发票。";}else{echo "No Invoices Available.";}?>
	
</div>








<?php $this->load->view('default/home_footer')?>