<?php $this->load->view('wechat/home_header')?>
<script src="<?php echo base_url()?>themes/default/glt.js?date=<?php echo CACHE_USETIME()?>"></script>
<div class="new_saucepan" style="display: block;">
	<div class="new_saucepan_body">
		<div class="title">
			Welcome to <br>the new Saucepan
			<div class="line"></div>
		</div>
			<img class="logo_saucepan" src="<?php echo base_url().'themes/default/images/logo.png'?>" />
		<a href="<?php echo base_url().'index.php/welcome/authorizedgetwechatcode'?>" class="btn">
		User Login / 进入
			<!-- Lets proceed to<br> update your details -->
		</a>	
		<a href="<?php echo base_url().'index.php/welcome/authorizedgetwechatcode'?>" class="btn">
		Enter / 进入
			<!-- Lets proceed to<br> update your details -->
		</a>
	</div>
</div>
<script type="text/javascript">
// $(document).ready(function(){
// 	$('.btn').click(function(){
// // 	  	location.replace(baseurl+'index.php/wechat/authorizedgetwechatcode');//无法进行后退返回，常用于注销
// 	  	location.href = baseurl+'index.php/wechat/authorizedgetwechatcode';
// 	});
// });
$.ajax({
	
	 type: 'POST',
	 url: "<?php echo base_url().'index.php/sessiones/get?token&user&token_expiry'?>",
	 cache:false,
	 dataType: "json", 
	 // data: formData,
	 processData: false,
	 contentType: false, //data: {key:value}, 
	 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 success: function(data){
	    //函数参数 "data" 为请求成功服务端返回的数据

			var timestamp = data.token_expiry;
			var timestamp1 =  ( new  Date()).valueOf()/1000;
			
			if(timestamp<=timestamp1){
				
				
			}else if(timestamp>timestamp1){
				
				window.location.href ="<?php echo base_url().'index.php/welcome/'?>" ;
			}else{
				
			}
			
	},
	});

</script>

<?php $this->load->view('wechat/home_footer')?>