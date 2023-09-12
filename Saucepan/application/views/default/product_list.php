<?php $this->load->view('default/home_header')?>
<script src="<?php echo base_url()?>themes/default/glt.js?date=<?php echo CACHE_USETIME()?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/swiper.min.css?date=<?php echo CACHE_USETIME()?>" />
<script src="<?php echo base_url()?>themes/default/js/swiper.min.js?date=<?php echo CACHE_USETIME()?>"></script>
<style>
	
	.swiper-container {
	      width: 100%;
	      height: 100%;
		  margin-top: 58px;
	    }
	
	    .swiper-slide {
	      text-align: center;
	      font-size: 18px;
	      background: #fff;
	      
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
	    }
		.swiper-pagination-bullet-active{background-color: white;}
</style>
<div class="new_saucepan">
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
<div class="swiper-container">
    <div class="swiper-wrapper">
       
     

           
    </div>
    <!-- Add Pagination -->
   <div class="swiper-pagination"></div>
</div>
<!-- <div class="product_list_banner" > -->
	<!-- <img src="<?php echo base_url().'themes/default/images/product_list.jpg'?>" /> -->
<!-- </div> -->

<div class="category_product_body" style="width: 100%;float:left;">
	
</div>
<!-- <div class="product_classification_name">
	MONTHLY POP-UP
</div> -->
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
<div style="width:100% ;float: left;height: 70px;">
		
</div>
<div class="product_name_nav" style="display: none;">
	<div class="close_box" >
		
		<?php if($this->langtype == '_ch'){
				echo '关闭';
			}else{
				echo 'Close';
			}
		?>
	</div>
	
	
</div>
<div class="card_bottom_btn_and_math">
	<div class="card_btn"  >
		<img src="<?php echo base_url().'themes/default/images/menu.png'?>" />
		<div class="text" style="font-family: 'ClientFontMedium';">
			
			<?php if($this->langtype == '_ch'){
					echo '所有产品';
				}else{
					echo 'All Products';
				}
			?>
		</div>
	</div>
	<div class="math_btn" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/cart_list'?>';">
		<img style='width:19px' src="<?php echo base_url().'themes/default/images/cart.png'?>" />
		<div style="font-family: 'ClientFontMedium';" class="cart_num">0</div>
	</div>
</div>
<div class="address_section_body">
	<div class="box">
		<div class="address_section">
			<div class="title">
				<?php if($this->langtype == '_ch'){
						echo '欢迎光临新的Saucepan';
					}else{
						echo 'Welcome to the new Saucepan';
					}
				?>
			</div>
			<div class="btn" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/address_list_map?addressid=2'?>';">
				<?php if($this->langtype == '_ch'){
						echo '我们先更新一下你的地址';
					}else{
						echo 'let us proceed by updating your addresss';
					}
				?>
			</div>
		</div>
	</div>
</div>
<div class="loading_bg" style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: white;">
	<div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;position: absolute;top:0;">
		<img style='width:50px' src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>" />
	</div>
</div>

<script>
	
	var u = navigator.userAgent;
	 var isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
	 if (isIOS) {        
	     if (screen.height == 812 && screen.width == 375){
	         console.log('iponeX')
			 $(".card_bottom_btn_and_math").css("paddingBottom","20px")
	     }else{
	       console.log('ipone')
	     } 
	 }else{
	      console.log('安卓')
	}
	
	$(".card_btn,.close_box").click(function(){
		$(".product_name_nav").fadeToggle();
	})
	// var setoken= getCookie("token");
	var formData = new FormData();
	// formData.append('token', setoken);
	formData.append('lang', 'ch'); 
	
	$.ajax({
	
	 type: 'POST',
	 url: 'https://www.mygkselss.com/market/apis/get_main_categories' ,
	 cache:false,
	 dataType: "json", 
	 data: formData,
	 processData: false,
	 contentType: false, //data: {key:value}, 
	 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 success: function(datas){
	    //函数参数 "data" 为请求成功服务端返回的数据
		console.log("获取大分类成功:",datas)
			$.ajax({
			
			 type: 'POST',
			 url: 'https://www.mygkselss.com/market/apis/get_products' ,
			 cache:false,
			 dataType: "json", 
			 data: formData,
			 processData: false,
			 contentType: false, //data: {key:value}, 
			 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
			 success: function(productdata){
				 $(".loading_bg").fadeOut();
			    //函数参数 "data" 为请求成功服务端返回的数据
					var  i=0;
					console.log("产品列表:",productdata)  
					for(var i=0;i<datas.response.length;i++){
						var productbox = '';
						if (datas.response[i].category_id) {
							
							for(var j=0;j<productdata.response.products.length;j++){
								var watermark='';
								for(var k=0;k<productdata.response.products[j].product_watermark.length;k++){
									watermark+='<img style="width:30px;float:left;margin-left:10px;" src="<?php echo apiimage_url();?>'+productdata.response.products[j].product_watermark[k].watermark_url+'" />';
								}
								
								if(datas.response[i].category_id==productdata.response.products[j].category_id){
									// var ll=;
									// if(typeof(productdata.response.products[j].price_after_discount)=='undefined'){
									// 	var pricesApi=productdata.response.products[j].original_price
									// }else{
									// 	var pricesApi=productdata.response.products[j].price_after_discount
									// }
									if(typeof(productdata.response.products[j].price_after_discount)=='undefined' || productdata.response.products[j].price_after_discount==0){
										var pricesApi=productdata.response.products[j].original_price
										if(pricesApi==0){
											if(productdata.response.products[j].product_id==17){
												var pricesApi="From ￥"+50
											}else if(productdata.response.products[j].product_id==37){
												var pricesApi="From ￥"+32
											}else if(productdata.response.products[j].product_id==38){
												var pricesApi="From ￥"+36
											}else if(productdata.response.products[j].product_id==39){
												var pricesApi="From ￥"+28
											}else if(productdata.response.products[j].product_id==78){
												var pricesApi="From ￥"+13
											}else if(productdata.response.products[j].product_id==79){
												var pricesApi="From ￥"+15
											}else if(productdata.response.products[j].product_id==80){
												var pricesApi="From ￥"+15
											}else if(productdata.response.products[j].product_id==81){
												var pricesApi="From ￥"+18
											}else if(productdata.response.products[j].product_id==82){
												var pricesApi="From ￥"+15
											}else{
												var pricesApi=''
											}
											
										}else{
											var pricesApi="￥"+productdata.response.products[j].original_price
										}
									}else{
										var pricesApi="￥"+productdata.response.products[j].price_after_discount
									}
									
									// var pricesApi=pricesApi.toFixed(2)
									// var pricesApi=productdata.response.products[j].original_price
									productbox += '<a class="box" href="<?php echo base_url().'index.php/welcome/product_details?productid='?>'+productdata.response.products[j].product_id+'">'+
									'<div class="box_bg" style="background:url(<?php echo apiimage_url();?>'+productdata.response.products[j].product_image+') center center / cover no-repeat;position:relative"><div style="position:absolute;top:10px;left:0px;">'+watermark+'</div></div>'+
									'<div class="box_title" style="<?php if($this->langtype == '_ch'){echo 'height:50px';}else{echo 'height:43px';}?>">'+<?php if($this->langtype == '_ch'){echo 'productdata.response.products[j].product_name_ch';}else{echo 'productdata.response.products[j].product_name_en';}?>+'</div><div class="box_text">'+<?php if($this->langtype == '_ch'){echo 'productdata.response.products[j].product_detail_ch';}else{echo 'productdata.response.products[j].product_detail_en';}?>+'</div>'+
									'<div class="box_information"><div class="price_box">'+pricesApi+'</div>'+
									'<div class="card_btn"><img src="<?php echo base_url()."themes/default/images/plus.png"?>" />'+
									'</div></div></a>';
								}
							}
							// console.log(productbox)
							$(".category_product_body").append("<div class='product_classification_name ' >"+<?php if($this->langtype == '_ch'){echo 'datas.response[i].category_title_ch';}else{echo 'datas.response[i].category_title_en';}?>+"</div><div class='product_body' id="+"mf"+datas.response[i].category_id+">"+productbox+"</div>")
							$(".product_name_nav").append("<a class='box' href="+"#mf"+datas.response[i].category_id+">"+<?php if($this->langtype == '_ch'){echo 'datas.response[i].category_title_ch';}else{echo 'datas.response[i].category_title_en';}?>+"</a>")
						}
					}
			},
			});
			
			
			$("body").on("click", ".product_name_nav .box", function() {
				$(".product_name_nav").css("display","none");
				$("html, body").animate({scrollTop: $($(this).attr("href")).offset().top -100+ "px"}, 500);
				 return false;//
			  });
	},
	});

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
				
				$.ajax({
				
				 type: 'POST',
				 url: "<?php echo api_url().'get_user_addresses';?>",
				 cache:false,
				 dataType: "json", 
				 data: formData,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(datas){
					 $(".loading_bg").fadeOut();
				    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("地址列表:",datas)  
						if(datas.response.addresses==''){
							$(".withLeftMargin").html('')
						}
						if(datas.response.addresses==''){
							$(".address_section_body").fadeIn();
							return;
						} else {
							var y = 0;
							for(var i=0;i<datas.response.addresses.length;i++){
								// $(".customerAddressObject").append("<div><li class='card-footer address-head customerAddress withChangeButton'><div class='main-address row direction-row'><div class='col col4'><p class='addressType'></p><p onclick='toaction_address_second2("+datas.response.addresses[i].address_id+")'>"+datas.response.addresses[i].city+datas.response.addresses[i].user_address+",<br> "+datas.response.addresses[i].user_address_cs+"</p><p class='text_warning' style='text-align: right;margin-right: -19px;' onclick='toaction_address_second("+datas.response.addresses[i].address_id+","+datas.response.addresses[i].token_id+","+datas.response.addresses[i].user_id+")'><img style='width:15px' src='<?php echo base_url().'themes/default/images/delete.png'?>' /></p></div></div></li></div>")
								y = 0;
								if(datas.response.addresses[i].latitude==''){
									y++;
								}
							}
							if (y == datas.response.addresses.length) {
								$(".address_section_body").fadeIn();
							}
						}
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
				    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("获取购物车列表:",data,data.response.products.length)  
						$(".box_price1").html(data.response.grand_total)
						$(".price1").val(data.response.grand_total)
						var cart_id=data.response.cart_id;
						$(".cart_num").text();
						
						var list=0;
						for(var i=0;i<data.response.products.length;i++){
							list+= parseInt(data.response.products[i].quantity)
							
						}
						if(list==0){
							$(".card_bottom_btn_and_math .math_btn").attr('onclick', '')
						}else{
							$(".cart_num").text(list);
						}
						
						
				},
				});
				// 获取banner
				formData.append('lang', 'ch');
				$.ajax({//获取banner
				
				 type: 'POST',
				 url: "<?php echo api_url().'get_banners';?>",
				 cache:false,
				 dataType: "json", 
				 data: formData,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(datas){
					 $(".loading_bg").fadeOut();
				    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("获取banner:",datas,datas.response.length)  
						var box=""
						for(var i=0;i<datas.response.length;i++){
							
							// box+='<img src="" />'
							box+='<div class="swiper-slide" style="background:url(<?php echo apiimage_url();?>'+datas.response[i].banner_url+') center center / cover no-repeat;position:relative;padding-bottom:38.168%"> </div>'
						}
						$(".swiper-wrapper").append(box)
						
						if(datas.response.length=1){
							
							var swiper = new Swiper('.swiper-container', {
								 
								  observer: true,
								  observeParents: true,
							
								  centeredSlides: true,
								  autoplay: false,
								 
								 
								 //  pagination: {
									// el: '.swiper-pagination',
									// clickable: false,
								 //  },
								});
								$(".swiper-container").addClass("swiper-no-swiping")
						}else{
							var swiper = new Swiper('.swiper-container', {
								  loop : true,
								  observer: true,
								  observeParents: true,
							
								  centeredSlides: true,
								  autoplay: 5000,
								  speed:2000,
								  autoplay: {
								            disableOnInteraction: false,  //触碰后自动轮播也不会停止
								            delay: 4000,
											speed:2000,
								          },
								  pagination: {
									el: '.swiper-pagination',
									clickable: true,
								  },
								});
						}
						
					
				},
				});
			}else{
				$(".cart_num").text(0);
			}
			
	},
	});
</script>

<?php $this->load->view('default/home_footer')?>