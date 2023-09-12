<?php $this->load->view('default/home_header')?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/swiper.min.css?date=<?php echo CACHE_USETIME()?>" /><script src="<?php echo base_url()?>themes/default/js/swiper.min.js?date=<?php echo CACHE_USETIME()?>"></script>
<style>
	.swiper-container {
	  width: 100%;
	  height: 100%;
	}
	.swiper-slide {
	  text-align: center;
	  font-size: 18px;
	  background: #fff;
	  width: calc(50% - 20px);
	  padding:10px;
	
	  /* Center slide text vertically */
	  display: -webkit-box;
	  display: -ms-flexbox;
	  display: -webkit-flex;
	  display: flex;
	  -webkit-box-pack: center;
	  -ms-flex-pack: center;
	  -webkit-justify-content: center;
	  justify-content: center;
	  -webkit-box-align: center;
	  -ms-flex-align: center;
	  -webkit-align-items: center;
	  align-items: center;
	 box-shadow: 1px 1px 1px rgb(136 136 136 / 29%);
	  flex-wrap: wrap;
	}
	.swiper-slide .title{width:calc(100% - 20px);padding:0 10px;font-size: 17px;text-align: left;height: 38px;color: black;
	overflow: hidden;text-align: left;
	text-overflow: ellipsis;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;}
	.swiper-slide .text{width:calc(100% - 20px);padding:0 10px;font-size: 12px;    height: 19px;text-align: left;
    color: rgb(109, 109, 109);
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;padding:10px 0;}
	.swiper-slide .box_bg{width: 100%;padding-bottom: 100%;margin:10px 0;}
	.swiper-slide .price_box{width:calc(100% - 20px);margin-top:5px;display: flex;justify-content: space-between;align-items: center;padding:0 10px;}
	.swiper-slide .price_box .price{width: 100%;font-size: 12px;text-align: left;color: #465c62;;}
	.swiper-slide .price_box img{width: 12px;font-size: 12px;text-align: left;}
	.swiper-slide .price_box .card_btn{border-radius: 50%;
    background-color: #465c62;
    float: right;
    padding: 4px;}
</style>
<style>
	.cart_classification_name .text{float:left}
	.cart_classification_name .delete_card{float:right;width: 50px;}
	.cart_classification_name .delete_card img{width: 20px;float:right;}
</style>
<a class="cart_list_backbtn" href="javascript:history.back(-1)">
	← Back
</a>

<div class="cart_classification_name">
	<div class="text">
		<?php if($this->langtype=='_ch'){echo "你的购物车";}else{echo "Your Cart";}?>
	</div>
	
	<div class="delete_card">
		<img src="<?php echo base_url().'themes/default/images/delete.png'?>" />
	</div>
</div>
<div class="cart_list_body">
	<!-- <div class="box">
		<select>
			<option>1</option>
			<option>2</option>
			<option>3</option>
		</select>
		<div class="box_title">
			Complete Mulled Wine Set (including bottle of wine)
		</div>
		<div class="box_price">
			98.00 
		</div>
		<div class="box_delete">
			<img src="<?php echo base_url().'themes/default/images/Return.png'?>" />
		</div>
		
	</div> -->
	
</div>
<div class="cart_classification_name">
	
	<?php if($this->langtype=='_ch'){echo "其他项目";}else{echo "Additional Items";}?>
</div>
<div class="Additional_list_body">
	<div class="box">
		
		<div class="box_title">
			⚠️ Cutlery Set (¥2) 
		</div>
		<div class="box_price box_cutlery_price">
			￥0.00 
		</div>
		<select class="tableware">
			
		</select>
	</div>
</div>
<div class="cart_classification_name">
	<?php if($this->langtype=='_ch'){echo "概要";}else{echo "Summary";}?>
</div>
<div class="cart_summary_list">
	<!-- <div class="box">
		<div class="box_title">
			<?php if($this->langtype=='_ch'){echo "小计";}else{echo "Sub Total";}?><input type="text" class="price1" style="display: none;"/>
		</div>
		<div class="box_price box_price1">
			
		</div>
	</div>
	<div class="box">
		<div class="box_title">
			<?php if($this->langtype=='_ch'){echo "送货费";}else{echo "Delivery Fee";}?><input type="text" class="price2" style="display: none;"/>
		</div>
		<div class="box_price box_price2">
			
		</div>
	</div>
	<div class="box">
		<div class="box_title">
			<?php if($this->langtype=='_ch'){echo "总计";}else{echo "Total";}?>
		</div>
		<div class="box_price box_price3">
			
		</div>
	</div> -->
</div>

<div class="cart_list_backbtn cart_list_backbtn_1" style="margin-top:40px;">
	<?php if($this->langtype=='_ch'){echo "应用优惠";}else{echo "Add Discount or Voucher";}?>
</div>
<div class="cart_list_backbtn  cart_list_backbtn_4" style="margin-top:20px;background-color: #f9bdb8;color:white;font-size: 13px;padding:15px 0;text-transform: uppercase;display:none;text-align: left;width: calc(100% - 60px);padding:15px 20px;color: #723939;;">
	<?php if($this->langtype=='_ch'){echo "凭证代码无效";}else{echo "Invalid Voucher Code";}?>
</div>
<div class="cart_list_backbtn cart_list_backbtn_2" style="margin-top:20px;color:white;font-size: 13px;padding:0 0;display:none;">
	<input class="Couponmath" type="text" style="width: 100%;height: 20px;float:left;;" placeholder='Enter a voucher code' />
</div>
<div class="cart_list_backbtn cart_list_backbtn_2 cart_list_backbtn_2_1" style="margin-top:20px;background-color: #00ac00;color:white;font-size: 13px;padding:15px 0;text-transform: uppercase;display:none;">
	<?php if($this->langtype=='_ch'){echo "申请折扣";}else{echo "Apply Discount or Voucher";}?>
</div>
<div class="cart_list_backbtn cart_list_backbtn_2 cart_list_backbtn_3" style="margin-top:20px;background-color:#e84118;color:white;font-size: 13px;padding:15px 0;text-transform: uppercase;display:none;">
	
	<?php if($this->langtype=='_ch'){echo "取消";}else{echo "Cancel";}?>
</div>

<script>
	$(".cart_list_backbtn_1").click(function(){
		$(".cart_list_backbtn_2").css("display","block")
		$(this).css("display","none")
	})
	$(".cart_list_backbtn_3").click(function(){
		$(".cart_list_backbtn_2").css("display","none")
		$(".cart_list_backbtn_1").css("display","block")
	})
	$(".cart_list_backbtn_2_1").click(function(){
		var a =$(".cart_list_backbtn_2 input").val();
		if(a==''){
			$(".cart_list_backbtn_4").css("display","block")
		}
	})
</script>
<div class="cart_classification_name">
	
	<?php if($this->langtype=='_ch'){echo "你像添加什么吗？";}else{echo "Anything you would like to add?";}?>
</div>
<!-- <div class="product_body">
	<div class="box" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/product_details'?>';">
		<div class="box_bg" style="background:url('<?php echo base_url().'themes/default/images/5ff9b05c7e589.jpg'?>') center center / cover no-repeat;"></div>
		<div class="box_title">CHICKEN PARMA NOODLES</div>
		<div class="box_text">*vegan OmniPork option</div>
		<div class="box_information">
			<div class="price_box">58.00</div>
			<div class="card_btn">
				<img src="<?php echo base_url().'themes/default/images/plus.png'?>" />
			</div>
		</div>
	</div>
	<div class="box" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/product_details'?>';">
		<div class="box_bg" style="background:url('<?php echo base_url().'themes/default/images/5fbc77cb12040.jpg'?>') center center / cover no-repeat;"></div>
		<div class="box_title">CHICKEN PARMA NOODLES</div>
		<div class="box_text">*vegan OmniPork option</div>
		<div class="box_information">
			<div class="price_box">58.00</div>
			<div class="card_btn">
				<img src="<?php echo base_url().'themes/default/images/plus.png'?>" />
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box_bg" style="background:url('<?php echo base_url().'themes/default/images/5fbc77cb12040.jpg'?>') center center / cover no-repeat;"></div>
		<div class="box_title">CHICKEN PARMA NOODLES</div>
		<div class="box_text">*vegan OmniPork option</div>
		<div class="box_information">
			<div class="price_box">58.00</div>
			<div class="card_btn">
				<img src="<?php echo base_url().'themes/default/images/plus.png'?>" />
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box_bg" style="background:url('<?php echo base_url().'themes/default/images/5fbc77cb12040.jpg'?>') center center / cover no-repeat;"></div>
		<div class="box_title">CHICKEN PARMA NOODLES</div>
		<div class="box_text">*vegan OmniPork option</div>
		<div class="box_information">
			<div class="price_box">58.00</div>
			<div class="card_btn">
				<img src="<?php echo base_url().'themes/default/images/plus.png'?>" />
			</div>
		</div>
	</div>
	
	
</div> -->
<div class="swiper_box" style="width: 100%;float:left;"></div>
<div style="width:100% ;float: left;height: 70px;">
		
</div>
<div class="product_details_bottom_btn_and_math" style="  background-color: #efefef;z-index: 2;">
	<div class="card_btn"  οnclick="self.location=document.referrer;">
		<div class="text" onclick="javascript:history.back(-1);">
			←<?php if($this->langtype=='_ch'){echo "上一步";}else{echo "Return";}?>
		</div>
		
	</div>
	<div class="math_btn"> <!-- onclick="javascript:location.href='<?php //echo base_url().'index.php/welcome/address_list'?>';" -->
		<div>
		<?php if($this->langtype=='_ch'){echo "结算";}else{echo "Check Out";}?>
		</div>
	</div>
</div>

<div class="address_prompt_alertbox">
	<div class="address_prompt_alertbox_section">
		<div class="prompt_bg"></div>
		<div class="box">
			<img class="delete_btn" src="<?php echo base_url().'themes/default/images/delete_add.png'?>"/>
			<div class="box_section">
				<?php if($this->langtype=='_ch'){echo "你确定要清空购物车吗？";}else{echo "Are you sure you want to empty the shopping cart?";}?>
			</div>
			<div class="box_btn">
				<div class="btn_no btn"><?php if($this->langtype=='_ch'){echo "不了";}else{echo "No";}?></div>
				<div class="btn_ok btn"><?php if($this->langtype=='_ch'){echo "好的";}else{echo "Ok";}?></div>
			</div>
		</div>
	</div>
</div>
<div class="loading_bg" style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: white;">
	<div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;position: absolute;top:0;">
		<img style='width:50px' src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>" />
	</div>
</div>
<input type="text"  value="0" name="canju" style="display: none;"/>
<script type="text/javascript">
	console.log("hahah ")
	
</script>
<script type="text/javascript">
	var u = navigator.userAgent;
	 var isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
	 if (isIOS) {        
	     if (screen.height == 812 && screen.width == 375){
	         console.log('iponeX')
			 $(".product_details_bottom_btn_and_math").css("paddingBottom","20px")
	     }else{
	       console.log('ipone')
	     } 
	 }else{
	      console.log('安卓')
	}
	var box_price1=0;
	var box_price2=0;
	var box_price3=0;
	//========================给默认地址=========================
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
			var setoken= data.token;
			var setoken2= data.user;
			var timestamp = data.token_expiry;
			var timestamp1 =  ( new  Date()).valueOf()/1000;
			// console.log(timestamp1)
			if(timestamp<=timestamp1){
				
			}else if(timestamp>timestamp1){
				
				var formData = new FormData();
				formData.append('token', setoken);
				formData.append('user_id', setoken2);
				
				// 获取餐具分类
				$.ajax({
				
				 type: 'POST',
				 url: 'https://www.mygkselss.com/market/apis/get_additional_product' ,
				 cache:false,
				 dataType: "json", 
				 data: formData,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(data){
					 console.log("餐具",data)
					 },
				});
				// 获取购物车列表
				$.ajax({
				
				 type: 'POST',
				 url: 'https://www.mygkselss.com/market/apis/get_user_cart' ,
				 cache:false,
				 dataType: "json", 
				 data: formData,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(data){
					 $(".loading_bg").fadeOut();
				    //函数参数 "data" 为请求成功服务端返回的数据
						
						console.log("获取购物车列表:",data,data.response.products.length)  
						$(".box_price1").html(data.response.grand_total)
						$(".price1").val(data.response.grand_total)
						var cart_id=data.response.cart_id;
						for(var i=0;i<data.response.products.length;i++){
							var box="";
							for(var s=1;s<11;s++){
								if (data.response.products[i].quantity == s) {
									box+='<option value='+s+' selected>'+s+'</option>'
								} else {
									box+='<option value='+s+' >'+s+'</option>'
								}
							}
							var list="";
							for(var j=0;j<data.response.products[i].attributes.length;j++){
								list+='<div style="width: calc(100% - 60px);float:left;margin-top:10px;margin-left:60px;display: flex;justify-content: space-between; align-items: center;">'+
						'<div class="box_title" style="width: calc(100% - 81px);margin-left:0px;font-size:12px;" >'+
							<?php if($this->langtype == '_ch'){echo 'data.response.products[i].attributes[j].product_attribute_title_ch';}else{echo 'data.response.products[i].attributes[j].product_attribute_title_en';}?>+
						'</div>'+
						'<div class="box_price" style="font-size:12px;">￥'+
							data.response.products[i].attributes[j].original_price+
						'</div>'+
						'<div class="box_delete" onclick="deletecartproductattributes('+data.response.products[i].attributes[j].cart_product_id+','+data.response.products[i].attributes[j].product_attribute_id+','+data.response.products[i].attributes[j].original_price+')">'+
							'<img src="<?php echo base_url().'themes/default/images/Return.png'?>" />'+
						'</div>'+
					'</div>'
							}
							$(".cart_list_body").append('<div class="box"><select onchange="selectOnchang(this,'+data.response.products[i].cart_product_id+')">'+box+'</select><div class="box_title">'+<?php if($this->langtype == '_ch'){echo 'data.response.products[i].product_name_ch';}else{echo 'data.response.products[i].product_name_en';}?>+'</div><div class="box_price">￥'+data.response.products[i].price+'</div><div class="box_delete"><img onclick="deletecartproduct('+data.response.products[i].cart_product_id+')" src="<?php echo base_url().'themes/default/images/Return.png'?>" /></div>'+list+'</div>')
						}
						
						
						$(".math_btn").click(function(){//点击跳转结算页面
							console.log(cart_id,);
							var cutlery= $(".tableware").val();
							console.log(cutlery);
							window.location.href = "<?php echo base_url().'index.php/welcome/wechat_checkout/?cart_id='?>"+cart_id+"&subTotal="+data.response.grand_total+"&cutlery="+cutlery;
						})
						// $.ajax({
						
						//  type: 'POST',
						//  url: "https://www.mygkselss.com/market/apis/get_additional_product",
						//  cache:false,
						//  dataType: "json", 
						//  data: formData,
						//  processData: false,
						//  contentType: false, //data: {key:value}, 
						//  headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
						//  success: function(data){
						//     //函数参数 "data" 为请求成功服务端返回的数据
						// 		console.log("餐具api",data)
						// 	},
						// })
						
						var op="";//获取餐具数量以及价格
						 for(var i =0;i<21;i++){
							op+='<option value='+i*2+'>'+i+'</option>'
						 }
						 $(".tableware").append(op)
						 $(".tableware").change(function(){
							 formData.append('token', setoken);
							 formData.append('additional_product_id', 3);
							 formData.append('cart_id', data.response.cart_id);
							 formData.append('price', $(this).val());
							 // formData.append('cart_additional_product_id', 14);
							 // formData.append('qty', 5);
							 if($('input[name=canju]').val()==0){
								 // $.ajax({
								 
								 //  type: 'POST',
								 //  url: "https://www.mygkselss.com/market/apis/add_cart_additional_product",
								 //  cache:false,
								 //  dataType: "json", 
								 //  data: formData,
								 //  processData: false,
								 //  contentType: false, //data: {key:value}, 
								 //  headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
								 //  success: function(data){
								 //     console.log("添加餐具成功",data)
								 // 	 $('input[name=canju]').val(1)
								 // 	},
								 // })
							 }else{
								 // $.ajax({
								 
								 //  type: 'POST',
								 //  url: "https://www.mygkselss.com/market/apis/update_cart_qty_additional_product",
								 //  cache:false,
								 //  dataType: "json", 
								 //  data: formData,
								 //  processData: false,
								 //  contentType: false, //data: {key:value}, 
								 //  headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
								 //  success: function(data){
								 //     console.log("修改餐具成功",data)
								 // 	 $('input[name=canju]').val(1)
								 // 	},
								 // })
							 }
							 
							$(".box_cutlery_price").text("￥"+$(this).val()+".00")
						 });
						
				},
				});
			}else{
				
			}
			
	},
	});
	
	function selectOnchang(obj,num){  
	 //获取被选中的option标签选项 
	 // alert(obj.selectedIndex+1,num);
	 console.log(obj.selectedIndex+1,num)
	$(".loading_bg").fadeIn();
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
	 		var setoken= data.token;
	 		var setoken2= data.user;
	 		var timestamp = data.token_expiry;
	 		var timestamp1 =  ( new  Date()).valueOf()/1000;
	 		// console.log(timestamp1)
	 		var formData = new FormData();
	 		formData.append('token', setoken);
	 		formData.append('user_id', setoken2);
			formData.append('cart_product_id', num);
			formData.append('qty', obj.selectedIndex+1);
	 		if(timestamp>timestamp1){
	 			$.ajax({
	 			
	 			 type: 'POST',
	 			 url: "https://www.mygkselss.com/market/apis/update_cart_product_qty",
	 			 cache:false,
	 			 dataType: "json", 
	 			 data: formData,
	 			 processData: false,
	 			 contentType: false, //data: {key:value}, 
	 			 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 			 success: function(data){
	 			    //函数参数 "data" 为请求成功服务端返回的数据
					console.log("修改数量成功",data)
	 					window.location.reload()
	 				},
	 			})
	 		}
	 		},
	 		})
	}
	function deletecartproduct(cart_product_id){
	 //获取被选中的option标签选项 
	$(".loading_bg").fadeIn();
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
	 		var setoken= data.token;
	 		var setoken2= data.user;
	 		var timestamp = data.token_expiry;
	 		var timestamp1 =  ( new  Date()).valueOf()/1000;
	 		// console.log(timestamp1)
	 		var formData = new FormData();
	 		formData.append('token', setoken);
	 		formData.append('user_id', setoken2);
			formData.append('cart_product_id', cart_product_id);
	 		if(timestamp>timestamp1){
	 			$.ajax({
	 			
	 			 type: 'POST',
	 			 url: "https://www.mygkselss.com/market/apis//remove_product_from_cart",
	 			 cache:false,
	 			 dataType: "json", 
	 			 data: formData,
	 			 processData: false,
	 			 contentType: false, //data: {key:value}, 
	 			 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 			 success: function(data){
	 			    //函数参数 "data" 为请求成功服务端返回的数据
					console.log("修改数量成功",data)
	 					window.location.reload()
	 				},
	 			})
	 		}
	 		},
	 		})
	}
	function  deletecartproductattributes(cart_product_id,product_attribute_id,subtract_attribute_cost){
	 //获取被选中的option标签选项 
	$(".loading_bg").fadeIn();
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
	 		var setoken= data.token;
	 		var setoken2= data.user;
	 		var timestamp = data.token_expiry;
	 		var timestamp1 =  ( new  Date()).valueOf()/1000;
	 		// console.log(timestamp1)
	 		var formData = new FormData();
	 		formData.append('token', setoken);
	 		formData.append('cart_product_id', cart_product_id);
			formData.append('product_attribute_id', product_attribute_id);
			formData.append('subtract_attribute_cost', subtract_attribute_cost);
	 		if(timestamp>timestamp1){
	 			$.ajax({
	 			
	 			 type: 'POST',
	 			 url: "https://www.mygkselss.com/market/apis/remove_cart_product_attribute",
	 			 cache:false,
	 			 dataType: "json", 
	 			 data: formData,
	 			 processData: false,
	 			 contentType: false, //data: {key:value}, 
	 			 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 			 success: function(data){
	 			    //函数参数 "data" 为请求成功服务端返回的数据
					console.log("删除附属产品成功",data)
	 					// window.location.reload()
	 				},
	 			})
	 		}
	 		},
	 		})
	}
	$(".cart_list_backbtn").click(function(){
		var Couponmath=$(".Couponmath").val();
		if(Couponmath !=""){
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
					var setoken= data.token;
					var setoken2= data.user;
					var timestamp = data.token_expiry;
					var timestamp1 =  ( new  Date()).valueOf()/1000;
					// console.log(timestamp1)
					var formData = new FormData();
					formData.append('token', setoken);
					formData.append('user_id', setoken2);
					formData.append('code', Couponmath);
					if(timestamp>timestamp1){
						// 获取购物车列表
						$.ajax({
						
						 type: 'POST',
						 url: 'https://www.mygkselss.com/market/apis/get_user_cart' ,
						 cache:false,
						 dataType: "json", 
						 data: formData,
						 processData: false,
						 contentType: false, //data: {key:value}, 
						 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
						 success: function(data){
							 formData.append('cart_id', data.response.cart_id);
							 $.ajax({
							 
							  type: 'POST',
							  url: "https://www.mygkselss.com/market/apis/use_cart_coupon",
							  cache:false,
							  dataType: "json", 
							  data: formData,
							  processData: false,
							  contentType: false, //data: {key:value}, 
							  headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
							  success: function(data){
						
							     //函数参数 "data" 为请求成功服务端返回的数据
							 		window.location.reload()
							 	},
							 })
						 },
						 })
						
					}
					},
					})
		}else{
			alirt("<?php if($this->langtype == '_ch'){echo '优惠卷码不能为空！';}else{echo 'Invalid Voucher Code';}?>")
		}
		
		
	})
	$(".delete_card").click(function(){
		$(".address_prompt_alertbox").css("display","block")
	})
	$(".btn_no,.delete_btn,.prompt_bg").click(function(){
		$(".address_prompt_alertbox").css("display","none")
	})	
	$(".btn_ok").click(function(){
		$(".address_prompt_alertbox").css("display","none")
		$(".loading_bg").fadeOut();
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
				var setoken= data.token;
				var setoken2= data.user;
				var timestamp = data.token_expiry;
				var timestamp1 =  ( new  Date()).valueOf()/1000;
				// console.log(timestamp1)
				var formData = new FormData();
				formData.append('token', setoken);
				formData.append('user_id', setoken2);
				if(timestamp>timestamp1){
					
					 
					 
					 
					$.ajax({
					
					 type: 'POST',
					 url: "https://www.mygkselss.com/market/apis/clear_cart",
					 cache:false,
					 dataType: "json", 
					 data: formData,
					 processData: false,
					 contentType: false, //data: {key:value}, 
					 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
					 success: function(data){
					    //函数参数 "data" 为请求成功服务端返回的数据
							window.location.reload()
						},
					})
				}
				},
				})
	})
	
	$.ajax({
	
	 type: 'POST',
	 url: "https://www.mygkselss.com/market/apis/c_suggested_products",
	 cache:false,
	 dataType: "json", 
	 // data: formData,
	 processData: false,
	 contentType: false, //data: {key:value}, 
	 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 success: function(data){
	    //函数参数 "data" 为请求成功服务端返回的数据
		console.log("推荐产品",data)
			// window.location.reload()
			
			var box='';
			for(var i=0;i<data.response.products.length;i++){
				if(typeof(data.response.products[i].price_after_discount)=='undefined'){
					var pricesApi=data.response.products[i].original_price
				}else{
					var pricesApi=data.response.products[i].price_after_discount
				}
				var pricesApi=pricesApi.toFixed(2)
				 box +='<a class="swiper-slide" href="<?php echo base_url().'index.php/welcome/product_details?productid='?>'+data.response.products[i].product_id+'">'+
				 	
				 	'<div class="box_bg" style="background:url(<?php echo apiimage_url();?>'+data.response.products[i].product_image+') center center / cover no-repeat;""></div>'+
					'<div class="title">'+<?php if($this->langtype == '_ch'){echo 'data.response.products[i].product_name_ch';}else{echo 'data.response.products[i].product_name_en';}?>+'</div>'+
				 	'<div class="text">'+<?php if($this->langtype == '_ch'){echo 'data.response.products[i].product_detail_ch';}else{echo 'data.response.products[i].product_detail_en';}?>+'</div>'+
					'<div class="price_box"><div class="price">￥'+pricesApi+'</div><div class="card_btn"><img src="<?php echo base_url()."themes/default/images/plus.png"?>" /></div></div>'+
				 '</a>' 
			   }i
			$(".swiper_box").prepend('<div class="swiper-container"><div class="swiper-wrapper" style="padding-bottom: 20px;"> '+box+' </div><div class="swiper-pagination"> </div></div>')
		},
	complete:function(){ //请求完成时运行的函数（在请求成功或失败之后均调用，即在 success 和 error 函数之后，不管成功还是失败 都会进这个函数）
			var swiper = new Swiper('.swiper-container', {
			  slidesPerView: 'auto',
			  spaceBetween: 0,
			  loop: true,
			  autoplay:4000,
			  speed:3000,
			  pagination: {
			    el: '.swiper-pagination',
			    clickable: true,
			  },
			});
		}
	})
	
</script>

<?php $this->load->view('default/home_footer')?>