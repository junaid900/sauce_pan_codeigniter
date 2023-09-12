<?php $this->load->view('default/home_header')?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/app.min.css?date=<?php echo CACHE_USETIME()?>" />
<style>
	li, ul {
	    margin: 0;
	    padding: 0;
	    /* padding-left: 20px; */
	    font-size: 16px;
	}
</style>

<a class="login_btn" href="javascript:history.back(-1)" style="margin-top:90px;">
	←  <?php if($this->langtype=='_ch'){echo "上一步";}else{echo "Return";}?>
</a>
<div style="width: calc(100% - 20px);padding:0 10px;margin:20px 0;float: left;">
	 <?php if($this->langtype=='_ch'){echo "您的历史订单";}else{echo "Your Order History";}?>
</div>
<div style="width: calc(100% - 20px);padding:0 10px;margin:20px 0;float: left;" class="paage_box">
</div>
<div class="login_title" style="text-align: center;display: none;" >
	<?php // if($this->langtype=='_ch'){echo "没有可用的订单。";}else{echo "No Orders Available.";}?>
	
</div>
<div id="orderList" style="float: left;width: 100%;">
	<ul class="card-list">
		
	</ul>
</div>
<div class="loading_bg" style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: white;">
	<div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;position: absolute;top:0;">
		<img style='width:50px' src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>" />
	</div>
</div>

<!-- <div style="width: calc(100% - 40px);margin-left:20px;feft:left;border-bottom: 1px solid gray;padding:10px 0;display: flex;justify-content: center;align-items: center;flex-wrap:wrap ;">
	<div style="width: 50px;height:50px;float: left;background:url('<?php echo base_url().'themes/default/images/5ff9b05c7e589.jpg'?>') center center / cover no-repeat;">
		
	</div>
	<div style="width:calc(100% - 170px);float:left;margin-left:20px;margin-right:20px;font-size: 12px;">
		CHICKEN PARMA NOODLES
	</div>
	<div style="width:80px;float:left;text-align: right;">
		￥ 58.00
	</div>
	<div style="width: 100%;float: left;font-size: 14px;text-align: right;color: black;font-weight:bold;">
		× 2
	</div>
</div> -->
<input type="" value="<?php  if(isset($_GET["page"])){echo $_GET['page'];}else{echo '1';}?>" style="display: none;" name="page_num" />
<script>

	var order_id_group = [];//我的订单ID group
	var order_price_group = [];//我的订单金额 group
	var page_num=$("input[name=page_num]").val();
	
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
				formData.append('user_id', setoken2);
				formData.append('page', page_num);
				formData.append('lang', 'ch'); 
				$.ajax({
				
				 type: 'POST',
				 url: "https://www.mygkselss.com/market/apis/get_user_orders",
				 cache:false,
				 dataType: "json", 
				 data: formData,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(data){
					 console.log("所有订单",data)
				},
				});
				$.ajax({
				
				 type: 'POST',
				 url: "https://www.mygkselss.com/market/apis/get_user_orders",
				 cache:false,
				 dataType: "json", 
				 data: formData,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(data){
					 
					 var box="";
					 for(var s=1;s<=data.response.total_page_count;s++){
					 	if (data.response.current_page_index == s) {
					 		box+='<option value='+s+' selected>'+s+'</option>'
					 	} else {
					 		box+='<option value='+s+' >'+s+'</option>'
					 	}
					 }
					 
					 $(".paage_box").append('<?php if($this->langtype == '_ch'){echo '分页 : ';}else{echo 'Page : ';}?><select onchange="selectOnchang(this)" style="width:50px;text-align-last: center">'+box+'</select>')
					 $(".loading_bg").fadeOut();
				    console.log("我的订单",data)
						for(var i=0;i<data.response.orders.length;i++){

							order_id_group.push(data.response.orders[i].order_id);//我的订单ID group
							order_price_group.push(data.response.orders[i].grand_total);//我的订单金额 group
							
							var box='';
							for(var j=0;j<data.response.orders[i].products.length;j++){
								var line='';
								for(var z=0;z<data.response.orders[i].products[j].attributes.length;z++){
									line+='<div style="display:flex;flex-wrap: wrap;width: 100%;">'+
									'<div class="col1 itemQuant">'+
							'<div style="padding-right: 10px;width: 50px;height: 20px;"></div>'+
						'</div>'+
						'<p class="col3">'+<?php if($this->langtype == '_ch'){echo 'data.response.orders[i].products[j].attributes[z].product_attribute_title_en';}else{echo 'data.response.orders[i].products[j].attributes[z].product_attribute_title_en';}?>+':</p>'+
						'<p class="col2 itemPrice align-right">¥'+data.response.orders[i].products[j].attributes[z].original_price+'</p>'+
						'</div>';
								}
								box+='<div class="row direction-row itemMain" style="margin-top:20px;">'+
						'<div class="col1 itemQuant" >'+
							'<div style="margin-right: 10px;width: 50px;height: 50px;background:url(<?php echo apiimage_url()?>'+data.response.orders[i].products[j].product_image+') center center / cover no-repeat;"></div>'+
						'</div>'+
						'<p class="col3 itemName">'+<?php if($this->langtype == '_ch'){echo 'data.response.orders[i].products[j].product_name_ch';}else{echo 'data.response.orders[i].products[j].product_name_en';}?>+'<br>'+'<span style="color:#00ac00">x '+data.response.orders[i].products[j].qty+'</span>'+'</p>'+
						'<p class="col2 itemPrice align-right">¥'+data.response.orders[i].products[j].price+'<br>'+'<span style="color:#00ac00">x '+data.response.orders[i].products[j].total+'</span>'+'</p>'+
					'</div>'+
					'<div class="row direction-row" style="flex-wrap: wrap;">'+
						line+
					'</div>';
							}
							$(".card-list").append('<li class="orderObject card"><div class="card-head"><div class="row direction-row"><p class="title col2">'+data.response.orders[i].order_day+'</p><!-- <p class="col1 orderStatus subtitle align-right">Awaiting Payment| <a href="continuePayment/892956">Pay Now</a> </p> --></div><br><div class="row orderPhone direction-row"><p class="col1">Phone:</p><p class="col5"><b>'+data.response.orders[i].contact+'</b></p></div><div class="row orderAddress direction-row"><p class="col1">Address:</p><p class="col5"><b>'+data.response.orders[i].city+data.response.orders[i].c_address+'<br>'+data.response.orders[i].user_address_cs+'</b></p></div><br><div class="orderItems card-body">'+box+'<hr><div class="row direction-row"><p class="col5">Total:</p><span class="orderPrice align-right col1"> ¥'+data.response.orders[i].grand_total+'</span></div></div></div><div class="card-footer" ><div class="row" style="width:100%;"><div style="width:100%;" class="button_invoice_area_'+data.response.orders[i].order_id+'"></div></div><div class="row"><a href="" class="button medium button_success" style="display:none">Track Order</a></div></div></li>')
						}

				    if(data.response.orders.length > 0){
						goto_loading_invoice_button(0);//去加载发票的按钮
				    }
				},
				});
				
			}else{
				
			}
			
	},
	});

	//去加载发票的按钮
	function goto_loading_invoice_button(num){
		var totalnum = order_id_group.length;
		if(totalnum >= 1){
			$('.button_invoice_area_'+order_id_group[num]).html('<img style="width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/>');
			$.post(baseurl+'index.php/welcome/loading_invoice_button/'+order_id_group[num]+'/'+order_price_group[num], function (data){
				$('.button_invoice_area_'+order_id_group[num]).html(data);
	
				if(totalnum == (num + 1)){
					//finished
				}else{
					setTimeout('goto_loading_invoice_button('+(num + 1)+')', 1000);
				}
			})
		}
	}
	
	function selectOnchang(num){
	 //获取被选中的option标签选项 
	 var num=num.selectedIndex+1;

		$(".loading_bg").fadeIn();
		window.location.href = "<?php echo base_url().'index.php/welcome/account_orderhistory?page='?>"+num;
	}
</script>

    <script>
    	function toapplyfapiaowith_qrcode(order_id){
    		$('.fapiao_show_xunwen').hide();
    		
    		$('.fapiao_show_preview').show();
        	$('.fapiao_preview_content').html('<div style="float:left;width:100%;padding:20px 0px;text-align:center;"><img style="width:25px;height:25px;" src="<?php echo CDN_URL().'themes/default/images/ajax_loading.gif'?>"/></div>');
        	$.post(baseurl+'index.php/welcome/fapiao_content_show/'+order_id, function (data){
        		$('.fapiao_preview_content').html(data);
            })
    	}
    	function toclose_fapiao_preview(){
    		$('.fapiao_show_xunwen').hide();
    		
        	$('.fapiao_show_preview').hide();
    	}
    </script>
    
    <div class="fapiao_show_preview" style="display:none;position:fixed;left:0px;top:0px;bottom:0px;width:100%;background:rgba(0,0,0,0.5);z-index:9999;">
    	<div style="float:left;width:320px;margin-left:calc(50% - 160px);height:100%;overflow-x:hidden;overflow-y:auto;border-radius:5px;-webkit-overflow-scrolling: touch;">
    		<table cellspacing="0" cellpadding="0" style="float:left;width:100%;height:100%;">
    			<tr>
    				<td valign="middle">
    					<div style="float:left;width:100%;height:25px;">
    						<img onclick="toclose_fapiao_preview()" style="float:right;width:20px;height:20px;cursor:pointer;margin-right:3px;" src="<?php echo base_url().'themes/default/images/close_white.png'?>"/>
    					</div>
    					<div class="fapiao_preview_content" style="float:left;width:100%;background-color:white;padding:0px 0px;border-radius:4px;">
                            
    					</div>
    				</td>
    			</tr>
    		</table>
    	</div>
    </div>
    
    
    <script>
    	var current_order_id = 0;
    	function toapplyfapiaowith_xunwen(order_id){
    		$('.fapiao_show_xunwen').show();
    		current_order_id = order_id;
    	}
    	function yestodo_applyfapiaowith_xunwen(){
    		toapplyfapiaowith_qrcode(current_order_id);
    	}
    	function toclose_fapiao_xunwen(){
        	$('.fapiao_show_xunwen').hide();
    	}
    </script>
    <div class="fapiao_show_xunwen" style="display:none;position:fixed;left:0px;top:0px;bottom:0px;width:100%;background:rgba(0,0,0,0.5);z-index:9999;">
    	<div style="float:left;width:320px;margin-left:calc(50% - 160px);height:100%;overflow-x:hidden;overflow-y:auto;border-radius:5px;-webkit-overflow-scrolling: touch;">
    		<table cellspacing="0" cellpadding="0" style="float:left;width:100%;height:100%;">
    			<tr>
    				<td valign="middle">
    					<div style="float:left;width:100%;height:25px;">
    						<img onclick="toclose_fapiao_xunwen()" style="float:right;width:20px;height:20px;cursor:pointer;margin-right:3px;" src="<?php echo base_url().'themes/default/images/close_white.png'?>"/>
    					</div>
    					<div style="float:left;width:calc(100% - 40px);background-color:white;padding:20px 20px;border-radius:4px;">
                            <div style="float:left;width:100%;font-size:16px;">
                                Are you sure to apply for invoice?
        					</div>
        					<div style="float:left;width:100%;margin-top:10px;">
                                <div onclick="yestodo_applyfapiaowith_xunwen()" style="float:left;background-color:green;color:white;line-height:30px;padding:0px 20px;font-size:14px;border-radius:4px;">
                                    OK
            					</div>
        					</div>
    					</div>
    				</td>
    			</tr>
    		</table>
    	</div>
    </div>
<?php $this->load->view('default/home_footer')?>