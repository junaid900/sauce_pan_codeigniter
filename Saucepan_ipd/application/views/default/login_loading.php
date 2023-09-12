<?php $this->load->view('default/home_header')?>
<style>
	.header_list_two{display: none;}
</style>
<div class="loading_bg" style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: white;">
	<div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;position: absolute;top:0;">
		<img style='width:50px' src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>" />
		
	</div>
</div>
<script type="text/javascript">
	// alert(1);
	var formData = new FormData();
	
	formData.append('loginCode', '<?php echo $code;?>');
	var nowDate = new Date();
	var year = nowDate.getFullYear();
	var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1) : nowDate.getMonth() + 1;
	var date = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate.getDate();
	var hour = nowDate.getHours()< 10 ? "0" + nowDate.getHours() : nowDate.getHours();
	var minute = nowDate.getMinutes()< 10 ? "0" + nowDate.getMinutes() : nowDate.getMinutes();
	var second = nowDate.getSeconds()< 10 ? "0" + nowDate.getSeconds() : nowDate.getSeconds();
	var date_time=year + "-" + month + "-" + date+" "+hour+":"+minute;
	formData.append('date_time', date_time); 
	$.ajax({//为新登录
	
	 type: 'POST',
	 url: "https://www.mygkselss.com/market/apis/snsgetuserinfo_register",
	 cache:false,
	 dataType: "json", 
	 data: formData,
	 processData: false,
	 contentType: false, //data: {key:value}, 
	 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 success: function(datas){
		//  alert(datas.response.token_id+datas.response.users_system_id+datas.response.token_expiry)
		// $(".ppp").text(datas.response.token_id+datas.response.users_system_id+datas.response.token_expiry)
		$.ajax({
		
		 type: 'POST',
		 url: "<?php echo base_url().'index.php/sessiones/set?token='?>"+datas.response.token_id+"&user="+datas.response.users_system_id+"&token_expiry="+datas.response.token_expiry+"",
		 cache:false,
		 dataType: "json", 
		 // data: formData,
		 processData: false,
		 contentType: false, //data: {key:value}, 
		 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		 success: function(data){
		    //函数参数 "data" 为请求成功服务端返回的数据
				
				if(data.status==1){
					window.location.href ="<?php echo base_url().'index.php/wechat/authorizedgetwechatcode'?>" ;
				}
		},
		});
			
			
	},
	});
</script>
<?php $this->load->view('default/home_footer')?>