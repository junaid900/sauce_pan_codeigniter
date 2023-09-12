<?php $this->load->view('default/home_header')?>

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
						if(typeof(data.response.price_after_discount)=='undefined'){
							var pricesApi=data.response.current_price
						}else{
							var pricesApi=data.response.price_after_discount
						}
						// var pricesApi=pricesApi.toFixed(2)
						$(".product_details_price").html("￥"+pricesApi)
						$(".product_details_text").html(<?php if($this->langtype == '_ch'){echo 'data.response.product_detail_ch';}else{echo 'data.response.product_detail_en';}?>)
						
						for(var i=0;i<data.response.categories.length;i++){
							var box="";
							for(var j=0;j<data.response.categories[i].attributes.length;j++){
								box+='<div class="box">'+
					'<input type="checkbox" name='+data.response.categories[i].product_category_id+' value='+data.response.categories[i].attributes[j].product_attribute_id+'  attributes='+data.response.categories[i].number_of_attributes+'  />'+
					'<div class="box_text">'+
						data.response.categories[i].attributes[j].product_attribute_title_en+
					'</div>'+
					'<div class="box_price">￥'+
						 data.response.categories[i].attributes[j].original_price+'.00'+
					'</div>'+
				'</div>'
							}
							$(".product_details_text").after("<div class='product_details_size_title'>"+<?php if($this->langtype == '_ch'){echo 'data.response.categories[i].product_category_title_ch';}else{echo 'data.response.categories[i].product_category_title_en';}?>+"</div><div class='product_details_select'>"+box+"</div>")
							
						}
					var boxIds = new Array();
					$('input[type=checkbox]').click(function(e){
						console.log($(this).val(),)
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
					$(".math_btn").click(function(){
						var formData = new FormData();
					
						formData.append('product_id', data.response.product_id); 
						formData.append('qty', $('input[name="num"]').val()); 
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
												console.log("添加购物车成功:",data)  
												window.location.href = "<?php echo base_url().'index.php/welcome/cart_list'?>";
										},
										});
									}
								
						},
						});
						
					})	
					
					
					
					
					
					
					
					
					
					
					
						
				},		
				});
		
	
	
	$(".box_btn").click(function(){
		var one = $('input[name="num"]').val();
		
		    one++;
		
		$('input[name="num"]').val(one);
		$('.math_btn div').text(one)
	})
</script>
<?php $this->load->view('default/home_footer')?>