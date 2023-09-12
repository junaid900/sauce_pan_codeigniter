<?php $this->load->view('default/home_header')?>
<style>
	.header_list_two{display: none;}
</style>
<div class="loading_bg" style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: white;">
	<div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;position: absolute;top:0;flex-wrap: wrap;">
		<div style="display: flex;justify-content: center;align-items: center;flex-wrap: wrap;">
			<div style="width: 100%;display: flex;justify-content: center;align-items: center;margin-bottom:40px">
				点单账户正在登录，请稍等...
			</div>
			<img style='width:50px' src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>" />
		</div>
	</div>
</div>
<script>
		var formData = new FormData();
		formData.append('email', 'admin@admin.com');
		formData.append('password', 'admin');
		formData.append('lang', 'en'); 
		var nowDate = new Date();
		var year = nowDate.getFullYear();
		var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1) : nowDate.getMonth() + 1;
		var date = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate.getDate();
		var hour = nowDate.getHours()< 10 ? "0" + nowDate.getHours() : nowDate.getHours();
		var minute = nowDate.getMinutes()< 10 ? "0" + nowDate.getMinutes() : nowDate.getMinutes();
		var second = nowDate.getSeconds()< 10 ? "0" + nowDate.getSeconds() : nowDate.getSeconds();
		var date_time=year + "-" + month + "-" + date+" "+hour+":"+minute;
		formData.append('date_time', date_time); 
		$.ajax({
		 type: 'POST',
		 url: 'https://www.mygkselss.com/market/apis/sign_in' ,
		 cache:false,
		 dataType: "json", 
		 data: formData,
		 processData: false,
		 contentType: false, //data: {key:value}, 
		 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		 success: function(data){
		    //函数参数 "data" 为请求成功服务端返回的数据
				// console.log("123",data)
				// return;
				$.ajax({
				 type: 'POST',
				 url: "<?php echo base_url().'index.php/sessiones/set?token='?>"+data.response.token_id+"&user="+data.response.users_system_id+"&token_expiry="+data.response.token_expiry+"",
				 cache:false,
				 dataType: "json", 
				 // data: formData,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(data){
				    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("232323232",data)  
						if(data.status==1){
							window.location.href ="<?php echo base_url().'index.php/welcome/product'?>" ;
						}
				},
				});
		},
		});
</script>
<?php $this->load->view('default/home_footer')?>