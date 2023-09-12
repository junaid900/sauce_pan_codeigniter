<?php $this->load->view('wechat/home_header')?>
<script src="<?php echo base_url()?>themes/default/glt.js?date=<?php echo CACHE_USETIME()?>"></script>
<div class="new_saucepan" style="display: block;">
	<div class="new_saucepan_body">
		<div class="title">
			Welcome to <br>the new Saucepan
			<div class="line"></div>
		</div>
			<img class="logo_saucepan" src="<?php echo base_url().'themes/default/images/logo.png'?>" />
		<div class="btn">
			Lets proceed to<br> update your details
		</div>
	</div>
</div>
<script type="text/javascript">
location.replace('<?php echo $redirecturl;?>');//无法进行后退返回，常用于注销
</script>

<?php $this->load->view('wechat/home_footer')?>