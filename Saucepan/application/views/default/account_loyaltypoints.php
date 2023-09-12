<?php $this->load->view('default/home_header')?>

<a class="login_btn" href="javascript:history.back(-1)" style="margin-top:90px;">
	←  <?php if($this->langtype=='_ch'){echo "上一步";}else{echo "Return";}?>
</a>
<div style="width: calc(100% - 20px);padding:0 10px;margin:20px 0;float: left;text-align: center;font-size: 20px;">
	 SP <?php if($this->langtype=='_ch'){echo "指数";}else{echo "Points";}?>
</div>

<div style="width: 170px;height: 170px;border-radius: 50%;background-color:#465c62;;display: flex;justify-content: center;flex-wrap: wrap;margin-left:calc(50% -  85px);color: white;text-align: center;">
	<div style="width:100%;float:left;font-size: 13px;margin-top:30px;">
		<?php if($this->langtype=='_ch'){echo "当前余额";}else{echo "Current Balance";}?>
	</div>
	<div style="width:100%;float:left;font-size: 50px;" class="points_math">
		0.00
	</div>
	<div style="width:100%;float:left;font-size: 13px;margin-bottom: 30px;;">
		SP <?php if($this->langtype=='_ch'){echo "指数";}else{echo "Points";}?>
	</div>
</div>

<div style="width: calc(100% - 20px);padding:0 10px;margin:20px 0;float: left;text-align: center;font-size: 15px;margin-top:70px;">
	 <?php if($this->langtype=='_ch'){echo "历史";}else{echo "History";}?>
</div>
<div class="login_title" style="text-align: center;" >
	 <?php if($this->langtype=='_ch'){echo "没有可用的发票。";}else{echo "No Invoices Available.";}?>
	
</div>
<div class="loading_bg" style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: white;">
	<div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;position: absolute;top:0;">
		<img style='width:50px' src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>" />
	</div>
</div>



<script type="text/javascript">
	// function format_number(n){
	//    var b=parseInt(n).toString();
	//    var len=b.length;
	//    if(len<=3){return b;}
	//    var r=len%3;
	//    return r>0?b.slice(0,r)+","+b.slice(r,len).match(/\d{3}/g).join(","):b.slice(r,len).match(/\d{3}/g).join(",");
	//  }
	function parseFormatNum(number,n){
	    if(n != 0 ){
	        n = (n > 0 && n <= 20) ? n : 2;
	    }
	    number = parseFloat((number + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
	    var sub_val = number.split(".")[0].split("").reverse();
	    var sub_xs = number.split(".")[1];
	    var show_html = "";
	    for (i = 0; i < sub_val.length; i++){
	        show_html += sub_val[i] + ((i + 1) % 3 == 0 && (i + 1) != sub_val.length ? "," : "");
	    }
	    if(n == 0 ){
	        return show_html.split("").reverse().join("");
	    }else{
	        return show_html.split("").reverse().join("") + "." + sub_xs;
	    }
	}
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
			// console.log(timestamp1)
			var setoken= data.token;
			var user_id= data.user;
			var formData = new FormData();
			formData.append('token', setoken);
			formData.append('user_id', user_id);
			
			 if(timestamp>timestamp1){
				$.ajax({
				
				 type: 'POST',
				 url: 'https://www.mygkselss.com/market/apis/get_profile',
				 cache:false,
				 traditional:true,
				 dataType: "json", 
				 data: formData,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(data){
				    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("个人信息",data)  
						$(".loading_bg").hide();
						$(".points_math").html(parseFormatNum(data.response.sp_points,1))
				
						
						
				},
				});
			}
			
	},
	});
	
	
	
</script>


<?php $this->load->view('default/home_footer')?>