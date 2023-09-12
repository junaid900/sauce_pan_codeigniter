<?php $this->load->view('default/home_header')?>
<style>
	.cartSuccess{background: rgba(0,0,0,.6);
	    position: fixed;
	    left: 0;
	    right: 0;
	    margin-left: auto;
	    margin-right: auto;
	    bottom: 50%;
	    width: 140px;
	    height: 68px;
	    text-align: center;
	    z-index: 5;
	    color: #fff;
	    padding-top: 20px;
	    border-radius: 5px;
	    padding-bottom: 10px;}
	
	
	.cartSuccess img {
	    width: 40px;
	    margin-bottom: 8px;
	}
</style>
<div class="product_details_banner" style="background:url('') center center / cover no-repeat;">
	
</div>
<div class="product_details_title">
	
</div>
<div class="product_details_price">

</div>
<div class="product_details_text">
	
</div>

<div class="add_card_box">
	<div class="box_math">
		<input type="number" name="num" value="1" />
	</div>
	<div class="box_btn">
		<?php if($this->langtype == '_ch'){
				echo '添加购物车';
			}else{
				echo 'Add to Cart';
			}
		?>
	</div>
</div>
<div style="width:100% ;float: left;height: 70px;">
		
</div>
<div class="product_details_bottom_btn_and_math" style="  background-color: #efefef;">
	<a class="card_btn"  href="javascript:history.back(-1)" >
		<div class="text">
			←<?php if($this->langtype == '_ch'){
					echo '返回';
				}else{
					echo 'Return';
				}
			?>
		</div>
	</a>
	<div class="math_btn" >
		<div style="font-family: 'ClientFontMedium';">1</div>
	</div>
</div>
<div class="cartSuccess" style="display:none">
	<img src="<?php echo base_url().'themes/default/images/confirmation-green.svg'?>" alt="Success" style="width: 30px">
	<br>
	<p style="letter-spacing: 1px;">Item Added</p>
</div>
<div class="consumption_prompt_body" >
	<div class="body">
		<div class="consumption_bg delete_prompt_btn"></div>
		<div class="addrsss_section">
			<div class="addrsss_section_title">
				<div class="left_text"><?php if($this->langtype=='_ch'){echo "提示";}else{echo "Prompt";}?></div>
				<div class="right_delete delete_prompt_btn" >
					<img style='width:20px' src="<?php echo base_url().'themes/default/images/delete_add.png'?>" />
				</div>
			</div>
			
			<div class="section_box">
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(".delete_prompt_btn").click(function(){
		$(".consumption_prompt_body").fadeOut()
	})
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
				var formDatas = new FormData();
				// formDatas.append('token', setoken);
				formDatas.append('lang', 'ch'); 
				// formDatas.append('page', '1'); 
				$.ajax({
				
				 type: 'POST',
				 url: "<?php echo api_url().'get_product_details/'.$_GET["productid"].'';?>",
				 cache:false,
				 dataType: "json", 
				 data: formDatas,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(data){
				    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("产品列表:",data)  
						var product_image=data.response.product_image;
						$(".product_details_banner").css("background-image","url(<?php echo apiimage_url()?>"+product_image+")")
						$(".product_details_title").html(<?php if($this->langtype == '_ch'){echo 'data.response.product_name_ch';}else{echo 'data.response.product_name_en';}?>)
						if(typeof(data.response.price_after_discount)=='undefined' || data.response.price_after_discount==0){
							var pricesApi=data.response.current_price
							if(pricesApi==0){
								var pricesApi=''
							}else{
								var pricesApi="￥"+data.response.current_price
							}
						}else{
							var pricesApi="￥"+data.response.price_after_discount
						}
						// var pricesApi=pricesApi.toFixed(2)
						$(".product_details_price").html(pricesApi)
						$(".product_details_text").html(<?php if($this->langtype == '_ch'){echo 'data.response.product_detail_ch';}else{echo 'data.response.product_detail_en';}?>)
						
						for(var i=0;i<data.response.categories.length;i++){
							var box="";
							for(var j=0;j<data.response.categories[i].attributes.length;j++){
								if(typeof(data.response.categories[i].attributes[j].price_after_discount)=='undefined'){
									var fushuprice=data.response.categories[i].attributes[j].original_price;
								}else{
									var fushuprice=data.response.categories[i].attributes[j].price_after_discount
								}
								box+='<div class="box">'+
					'<input type="checkbox" name='+data.response.categories[i].product_category_id+' value='+data.response.categories[i].attributes[j].product_attribute_id+' price='+fushuprice+'  attributes='+data.response.categories[i].number_of_attributes+'  />'+
					'<div class="box_text">'+
						
						<?php if($this->langtype == '_ch'){echo 'data.response.categories[i].attributes[j].product_attribute_title_ch';}else{echo 'data.response.categories[i].attributes[j].product_attribute_title_en';}?>+
					'</div>'+
					'<div class="box_price">￥'+
						 fushuprice+
					'</div>'+
				'</div>'
							}
							$(".product_details_text").after("<div class='product_details_size_title'>"+<?php if($this->langtype == '_ch'){echo 'data.response.categories[i].product_category_title_ch';}else{echo 'data.response.categories[i].product_category_title_en';}?>+"</div><div class='product_details_select'>"+box+"</div>")
							
						}
					var boxIds = new Array();
					
					$('input[type=checkbox]').click(function(e){
						console.log($(this).val(),$(this).attr('data-price'))
						 // $("input[name="+checkboxname+"]").attr('disabled',false);
						 
						var checkboxname=$(this).prop("name");
						var checkboxname=$(this).prop("name");
						var math=$(this).attr('attributes');//获取当前选取最多数量
						console.log("当前的最大值是",$(this).attr('attributes'))
						console.log("长度",$("input[name="+checkboxname+"]:checked").length)
						$("input[name="+checkboxname+"]").removeAttr("disabled")
						
						if($("input[name="+checkboxname+"]:checked").length >= math){
						      $("input[name="+checkboxname+"]:not(:checked)").attr('disabled','disabled');
						    }
						if($("input[name="+checkboxname+"]:checked").length<=math){
							var status = 0;
							for(var i = 0; i < boxIds.length;i++) {
								if (boxIds[i] == $(this).val()) {
									status = 1;
									boxIds.splice(i,1);
									break;
								}
							}
							if (status==0) {
								boxIds.push($(this).val());
							}
							console.log("添加进去的数组",boxIds)
							
						}
						
					})
					$(".box_btn").click(function(){
						// var one = $('input[name="num"]').val();
						if(pricesApi==0 && boxIds==''){//判断产品（汤）为0的时候，附属产品必须选一个；
							$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "请选择一个选项.";}else{echo "Please Select an Option";}?>")
							$(".consumption_prompt_body").fadeIn();
							return;
						}
						//     one++;
						var boxprices = new Array();
						for(var i=0;i<data.response.categories.length;i++){
							for(var y=0;y<data.response.categories[i].attributes.length;y++){
								for(var j=0;j<boxIds.length;j++){
									// console.log(data.response.categories[i].attributes[y].product_attribute_id )
									if(data.response.categories[i].attributes[y].product_attribute_id == boxIds[j]) {
												boxprices.push(data.response.categories[i].attributes[y].current_price);
											}
								}
							}
						}
						var a=0;
						for (var i=0;i<boxprices.length;i++){
							a+=Number(boxprices[i])
						}
						if(a<50 && data.response.product_id==17){
							$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "这道菜至少需要50RMB才能下单.";}else{echo "There is a minimum of 50RMB to place an order for this dish";}?>")
							$(".consumption_prompt_body").fadeIn();
							return;
						}
						if(a<15 && data.response.product_id==80){
							$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "这道菜至少需要15RMB才能下单.";}else{echo "There is a minimum of 15RMB to place an order for this dish";}?>")
							$(".consumption_prompt_body").fadeIn();
							return;
						}
						if(a<18 && data.response.product_id==81){
							$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "这道菜至少需要18RMB才能下单.";}else{echo "There is a minimum of 18RMB to place an order for this dish";}?>")
							$(".consumption_prompt_body").fadeIn();
							return;
						}
						if(a<18 && data.response.product_id==82){
							$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "这道菜至少需要15RMB才能下单.";}else{echo "There is a minimum of 15RMB to place an order for this dish";}?>")
							$(".consumption_prompt_body").fadeIn();
							return;
						}
						// $('input[name="num"]').val(one);
						console.log("产品价格:",pricesApi,"产品选取附属id:",boxIds,"产品价格:",boxprices);
						// return;
						
						
						
						
						
						
						
						$(".cartSuccess").fadeIn()
						var formData = new FormData();
					
						formData.append('product_id', data.response.product_id); 
						formData.append('qty', 1); //$('input[name="num"]').val()
						formData.append('attributes[]', boxIds); 
						console.log(boxIds)
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
									
									formData.append('token', setoken);
									formData.append('user_id', setoken2);
									console.log(timestamp1)
									if(timestamp>timestamp1){
										$.ajax({
										
										 type: 'POST',
										 url: 'https://www.mygkselss.com/market/apis/add_product_to_cart' ,
										 cache:false,
										 traditional:true,
										 dataType: "json", 
										 data: formData,
										 processData: false,
										 contentType: false, //data: {key:value}, 
										 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
										 success: function(data){
										    //函数参数 "data" 为请求成功服务端返回的数据
											// setTimeout(function(){
											// 	$(".cartSuccess").fadeOut()
											// 	}, 500);
											$(".cartSuccess").fadeOut()
												console.log("添加购物车成功:",data)  
													$('.math_btn div').text(data.response.products.length)
												
										},
										});
									}
								
						},
						});
						
					})	
					
					
					
					
					
					
					
					
					
					
					
						
				},		
				});
		
	
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
					
						$('.math_btn div').text(data.response.products.length)
						
						
						
						
						
						
						 
						 
						
				},
				});
			}else{
				
			}
			
	},
	});
	$(".math_btn").click(function(){
		window.location.href = "<?php echo base_url().'index.php/welcome/cart_list'?>";
	})
</script>
<?php $this->load->view('default/home_footer')?>