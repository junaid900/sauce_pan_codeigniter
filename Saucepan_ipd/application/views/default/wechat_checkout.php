<?php $this->load->view('default/home_header')?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/address.css?date=<?php echo CACHE_USETIME()?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/app.min.css?date=<?php echo CACHE_USETIME()?>" />
<style type="text/css">
        .product { border-radius: 0px;box-shadow: 1px 1px 1px rgba(136, 136, 136, 0.29);}
        .product .thumb {padding: 5px 5px 5px 5px;}

        #container {
            color: #000000;
            font-size: 13px;
        }
        .container{
            padding: 0 5px;
        }
        #mainStage .product a {
            color: #000000;
        }
        .header {
            background: #465c62;
        }
        .header a {
            color: #ffffff;
        }

        .categoryTitle {
            color: !important;
        }

        .categoryTitle a {
            color: !important;
        }

        /* --- Buttons --*/

        .cartButton {
            background: #465c62 !important;
            border: none;
        }

        .cartButton a {
            color: #f7f297!important;
        }

        .productPage .addCartFooter {
            border: 1px solid #465c62;
        }

        .cartButton .cartIcon svg {
            fill: #f7f297!important;
        }

        .footer button {
            color: #f7f297!important;
        }

        .footerPopup h6 {
            color: !important;
        }



        .checkOutButton a {
            color: #f7f297!important;
        }
        .placeOrderButton {
            color: #f7f297!important;
            border: 1px solid #f7f297!important;
        }
        .button.clientColor {
            background: #465c62!important;
            border: 1px solid #000000!important;
            color: #ffffff!important;
        }

        .button.clientColor:disabled {
            color: graytext !important;
            border: 1px solid rgb(209, 209, 209) !important;
            background: rgb(216, 216, 216) !important;
        }

        .subCategoryButton {
            background: !important;
            color: !important;
            border: 1px solid !important;
        }

        .landingToolbar {
            background: #465c62;
        }

        .landingToolbar .toolbar-header {
            color: #ffffff;
        }

        .footerPopup .footer button {
            background: #465c62!important;
        }

        .placeOrderButton {
            background: #465c62!important;
        }

        .checkOutButton {
            background: #465c62!important;
        }


        .price {
            color: #465c62!important;
        }

        .cart svg {
            fill: #465c62;
        }

        .categoryButton {
            border: 1px solid #465c62!important;
            background: none!important;
            color: #465c62;
        }

        .categorySelectionDropdown .dropDownSelector {
            border: 1px solid #465c62!important;
        }

        .top-nav .active {
            border-bottom: 3px solid !important;
        }
		#deliveryTimeslotTimeSelector li{font-size: 12px;}
		.todaytimebox{position: relative;}
		.todaytimebox span{position: absolute; right: 10px;color: orange;font-size: 12px;}
    </style>
<body>

    <div id="userFacingErrorMessage"></div>
    <div id="fader"></div>
    <div id="container">
        
        <div id="contentFrame">

            

            


<div class="checkout checkoutMainStage container">

        



    

        <h5 class="withLeftMargin">
			<?php if($this->langtype == '_ch'){
						echo '个人信息';
					}else{
						echo 'Personal Information';
					}
				?>
		</h5>

    
    
    <div class="formStage flex card">
		<div class="card-head">
			<div class="section withEditButton">
				<a href="<?php echo base_url().'index.php/welcome/account_personalinfo'?>">
					<div class="customerHeader">
																																										<div class="hero">
							<h3></h3>
							<p><span><?php if($this->langtype == '_ch'){echo '电话';}else{echo 'Phone';}?></span> <span class="phone_box"></span></p>
							<p><span><?php if($this->langtype == '_ch'){echo '邮箱';}else{echo 'Email';}?></span> <span class="email_box"></span></p>
						</div>
					</div>
				</a>
			</div>
			<input type="text" name="users_system_id" value="0" style="display: none;" />
			

			<div class="alert alert_danger">
				<p style="text-align: center;">Please&nbsp;help us deliver more efficiently by</p><br>
				<p style="text-align: center;"><strong>saving your delivery address in Chinese.</strong></p>
			</div>


			 
			<div class="section withChangeButton changeAddressButton">
				<p class="p1"></p>
				<p class="p2"></p>
			<!-- 	<p class="addressNote">222</p> -->
				<input type="hidden" name="customer_address_id" value="104021">
			</div>
			<div class="section withChangeButton inactive editNoteButton">
				<div class="label beizhu"><?php if($this->langtype == '_ch'){echo '备注';}else{echo 'Note';}?></div>
				<div class="editNote hidden">
					<textarea style="height: 60px; display: inline; margin: 10px 0 10px 0;" name="order_note" id="order_note" rows="2" class="input hidden note"></textarea>
				</div>
			</div>

			<div class="section withChangeButton  changeCustomerInvoiceTitleButton">
				<div class="label">
					<?php if($this->langtype == '_ch'){echo '发票';}else{echo 'Invoice';}?>
				</div>
			</div>
		</div>
    </div>
    




                                            
                                                                                                                                                                                                                                                                                       
                        
                                                                                                            
                
                                                                                                                                                            

    

    
    <h5 class="withLeftMargin"><?php if($this->langtype == '_ch'){echo '送货时间';}else{echo 'Delivery Time';}?></h5>

    <div class="formStage card">
        <div class="card-head">
            <ul class="multipleSelect margin-bottom">
				<li class="isInstantDelivery multipleSelectNotAutomaticSelection  selected" id="instantDeliveryButton"><?php if($this->langtype == '_ch'){echo '现在交付';}else{echo 'Deliver Now ';}?> <span class="addDeliveryFee"></span></li>
				<li class="isScheduledDelivery "><div class="left" id="dateSelector">Pick a Date & Time</div><span class="right addDeliveryFee" id="addDeliveryFeeAmount"></span> </li>
            </ul>
            <input type="checkbox" name="isPreorder" value="1" checked="checked" class="hidden">
            <div id="deliveryTimeslotSelector" class="deliveryTimeslotSelector hidden">
                <div class="flexContainer">
                    <div class="dateSelector">
                        <div class="selector">
                            <ul id="deliveryTimeslotDateSelector">
								<li data-date="2021-05-26" data-human="Today"    data-math="1" class="active dateOpen"><?php if($this->langtype == '_ch'){echo '今天';}else{echo 'Today';}?> </li>
								<li data-date="2021-05-27" data-human="Tomorrow" data-math="2" class="dateOpen"> <?php if($this->langtype == '_ch'){echo '明天';}else{echo 'Tomorrow';}?></li>
								<li data-date="2021-05-28" data-human="Next Day" data-math="3" class=" dateOpen"><?php if($this->langtype == '_ch'){echo '后天';}else{echo 'Next Day';}?></li>
							<!-- 	<li data-date="2021-05-29" data-human="Sat 29th" data-math="4" class="dateOpen">June 5 </li> -->
							</ul>
                            <input type="hidden" name="deliveryTimeslotDate" id="deliveryTimeslotDate" value="2021-05-29">
                            <input type="hidden" name="instantDeliveryTimeslotId" id="instantDeliveryTimeslotId" value="70">
                        </div>
                    </div>

                    <div class="timeSelector">
                        <div class="selector">
							<ul id="deliveryTimeslotTimeSelector" class="todaytimebox">
							    <li data-dates="12:00 - 13:00" data-ysprice="">12:00 - 13:00 <span>￥8</span></li>
								<li data-dates="13:00 - 14:00" data-ysprice="">13:00 - 14:00 <span>￥8</span></li>
								<li data-dates="14:00 - 15:00" data-ysprice="">14:00 - 15:00 </li>
								<li data-dates="15:00 - 16:00" data-ysprice="">15:00 - 16:00 </li>
								<li data-dates="16:00 - 17:00" data-ysprice="">16:00 - 17:00 <span>￥8</span></li>
								<li data-dates="17:00 - 18:00" data-ysprice="">17:00 - 18:00 <span>￥8</span></li>
								<li data-dates="18:00 - 19:00" data-ysprice="">18:00 - 19:00 <span>￥8</span></li>
								<li data-dates="19:00 - 20:00" data-ysprice="">19:00 - 20:00 <span>￥8</span></li>
							</ul>
                            <ul id="deliveryTimeslotTimeSelector" class="tomorrowtimebox" style="display:none;">
                                <li data-dates="12:00 - 13:00" data-ysprice="">12:00 - 13:00 <span>￥8</span></li>
                                <li data-dates="13:00 - 14:00" data-ysprice="">13:00 - 14:00 <span>￥8</span></li>
                                <li data-dates="14:00 - 15:00" data-ysprice="">14:00 - 15:00 </li>
                                <li data-dates="15:00 - 16:00" data-ysprice="">15:00 - 16:00 </li>
                                <li data-dates="16:00 - 17:00" data-ysprice="">16:00 - 17:00 <span>￥8</span></li>
                                <li data-dates="17:00 - 18:00" data-ysprice="">17:00 - 18:00 <span>￥8</span></li>
                                <li data-dates="18:00 - 19:00" data-ysprice="">18:00 - 19:00 <span>￥8</span></li>
                                <li data-dates="19:00 - 20:00" data-ysprice="">19:00 - 20:00 <span>￥8</span></li>
                            </ul>

                            <input type="text" value="0"  name="datesvalue" style="display: none;"/>
                        </div>


                    </div>

                </div>
            </div>
        </div>

    </div>
    
        <h5 class="withLeftMargin"><?php if($this->langtype == '_ch'){echo '付款方式';}else{echo 'Payment Method';}?></h5>

    
    

	<div class="formStage card">
		<div class="card-head">
		<div class="row">
			<ul class="formRows multipleSelect paymentMethods col1">
				<li class="pay_way_begin selected">
					<div><?php if($this->langtype == '_ch'){echo '微信支付';}else{echo 'WeChat Pay';}?></div>
					<div class="hidden">
					<input name="payment_method_id" type="radio" value="0" checked="checked">
					</div>
				</li>
				<li class="pay_way_begin">
					<div><?php if($this->langtype == '_ch'){echo '现金';}else{echo 'Cash';}?></div>
					<div class="hidden">
					<input name="payment_method_id" type="radio" value="1">
					</div>
				</li>
				<li class="pay_way_box">
					<div><?php if($this->langtype == '_ch'){echo '达达';}else{echo 'ImDada';}?></div>
					<div class="hidden">
					<input name="payment_method_id" type="radio" value="2">
					</div>
				</li>
				<li class="pay_way_box">
					<div><?php if($this->langtype == '_ch'){echo '吴先生';}else{echo 'In-House';}?></div>
					<div class="hidden">
					<input name="payment_method_id" type="radio" value="3">
					</div>
				</li>
				<li class="pay_way_box">
					<div><?php if($this->langtype == '_ch'){echo '闪送';}else{echo 'Shansong';}?></div>
					<div class="hidden">
					<input name="payment_method_id" type="radio" value="4">
					</div>
				</li>
				<li class="pay_way_box">
					<div><?php if($this->langtype == '_ch'){echo 'Sherpas';}else{echo 'Sherpas';}?></div>
					<div class="hidden">
					<input name="payment_method_id" type="radio" value="5">
					</div>
				</li>
				<li class="pay_way_box">
					<div><?php if($this->langtype == '_ch'){echo '上门点单';}else{echo 'Walk-Ins';}?></div>
					<div class="hidden">
					<input name="payment_method_id" type="radio" value="6">
					</div>
				</li>
				<li class="pay_way_box">
					<div><?php if($this->langtype == '_ch'){echo 'JSS';}else{echo 'JSS';}?></div>
					<div class="hidden">
					<input name="payment_method_id" type="radio" value="7">
					</div>
				</li>
				<li class="pay_way_box">
					<div><?php if($this->langtype == '_ch'){echo 'Ele.Me';}else{echo 'Ele.Me';}?></div>
					<div class="hidden">
					<input name="payment_method_id" type="radio" value="8">
					</div>
				</li>
			</ul>
		</div>

		</div>
	</div>
    <h5 class="withLeftMargin"><?php if($this->langtype == '_ch'){echo '概要';}else{echo 'Summary';}?></h5>


    

<div class="card" id="checkout-summary">
    
    <div class="card-head">

        <div class="row direction-row">
            <div class="subtitle col3">
                <?php if($this->langtype=='_ch'){echo "小计";}else{echo "Sub Total";}?>
			</div>
            <div class="toPay align-right col1 itemPrice">
                 <span id="cartSubTotal">￥<?php echo $_GET["subTotal"]?></span>
            </div>
        </div>
		<div class="row direction-row">
		    <div class="subtitle col3">
		        <?php if($this->langtype=='_ch'){echo "餐具";}else{echo "Cutlery Set";}?>
			</div>
		    <div class="toPay align-right col1 itemPrice">
		         <span id="cartSubTotal">￥<?php echo $_GET["cutlery"]?></span>
		    </div>
		</div>
        
        <div class="row direction-row">
            <div class="subtitle col3">
                <?php if($this->langtype=='_ch'){echo "送货费";}else{echo "Delivery Fee";}?> <span class="deliveryFeeTitle"></span>
            </div>
            <div class="toPay align-right col1 itemPrice">
                <span id="cartDeliveryFee " class="box_price2">￥ 0</span>
				<input type="text" class="price2" style="display: none;" />
            </div>
        </div>
		
        
        
        <div class="row direction-row">
            <div class="subtitle col3">
                <?php if($this->langtype=='_ch'){echo "总计";}else{echo "Total";}?>            </div>
            <div class="toPay col1 align-right itemPrice">
                <input type="hidden" id="cartTotalHiddenField" value="">
                 <span id="cartTotal"  class="box_price3"></span>
            </div>
        </div>
		<div class="row direction-row" style="display: flex;justify-content: center;align-items: center;flex-wrap: wrap;">
		    <div class="subtitle col3" style="display: none;">
		        <?php if($this->langtype=='_ch'){echo "积分兑换";}else{echo "Redeem";}?>            </div>
		    <div class="toPay col1 align-right itemPrice" style="display: none;">
		        <input type="text" id="points_text" value="0" >
		    </div>
			<div style="width: 100%;text-align: left;">
				<br>
				 <?php if($this->langtype=='_ch'){echo "最多可使用800积分";}else{echo "Up to 800 points can be used";}?><br>
				<?php if($this->langtype=='_ch'){echo "您的积分:";}else{echo "You have :";}?>：<text class='points_num'>00</text> points
			</div>
		</div>
        

    </div>
</div>

<input type="text" class="points_input_ji" value="0"  style="display: none;">
<div id="loyaltyPointsEarnedMessage">
            <p style="padding: 15px 35px 20px 20px; text-align: center; color: #ee272b; font-size: 14px;">
                            You will receive <text class="points_math"></text> SP Points_math with this order.                    </p>
    </div>


    <div class="clear"></div>
</div>

<div id="toolbar" class="toolbar checkout row direction-row">
    <div class="col1">
        <div style="    display: block;color: #000;font-size: 17px; font-family: ClientFontMedium;text-align: center; line-height: 18px;    padding: 18px 0;" onclick="javascript:history.back(-1);"> ←
		<?php if($this->langtype == '_ch'){
						echo '上一步';
					}else{
						echo 'Back ';
					}
				?>
		</div>
    </div>
        <div class="col3"><button  class="placeOrderButton" name="doCheckOut" id="docheckout" value="docheckout"><?php if($this->langtype=='_ch'){echo "现在下单";}else{echo "Place Order Now";}?></button></div>
    </div>


			<input type="text" name="addresstest" value="" style="display: none;">
			<input type="number" name="latitude"   value="" style="display: none;">
			<input type="number" name="longitude"  value="" style="display: none;">
			<input type="text" name="distance"  value="" style="display: none;">
			
<div class="address_position_body" >
	<div class="add_bg delete_address_btn"></div>
	<div class="addrsss_section">
		<div class="addrsss_section_title">
			<div class="left_text"><?php if($this->langtype=='_ch'){echo "更换地址";}else{echo "Switch Address";}?></div>
			<div class="right_delete delete_address_btn" >
				<img style='width:20px' src="<?php echo base_url().'themes/default/images/delete_add.png'?>" />
			</div>
		</div>
		<div class="addrsss_section_box">
			
		</div>
		<div class="addrsss_section_add" >
			<?php if($this->langtype=='_ch'){echo "更换新地址";}else{echo "Add New Address";}?>
		</div>
	</div>
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

<!-- 选择派送时间段 -->
<input type="text" name="delivery_time" style="display: none;" value="" />
	<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.3&key=d9472192dd9115048016456116400810&plugin=AMap.Autocomplete,AMap.PlaceSearch"></script>
    <script type="text/javascript">
		$(".pay_way_box").hide();
		//默认派送时间段
		var times=new Date();
		var h = times.getHours();
		var m = times.getMinutes();
		var hm=h+":"+m;
		$("input[name=delivery_time]").val(hm);

		var u = navigator.userAgent;
		 var isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
		 if (isIOS) {        
		     if (screen.height == 812 && screen.width == 375){
		         console.log('iponeX')
				 $("#loyaltyPointsEarnedMessage").css("marginBottom","50px")
				 $(".toolbar").css("paddingBottom","20px")
		     }else{
		       console.log('ipone')
		     } 
		 }else{
		      console.log('安卓')
		}
		$(".addrsss_section_add").click(function(){
			window.location.href = "<?php echo base_url().'index.php/welcome/account_address_list'?>";
		})
		
		$(".beizhu").click(function(){
			$(".editNote").fadeIn()
		})
		$(".delete_address_btn").click(function(){
			$(".address_position_body").fadeOut()
		})
		$(".delete_prompt_btn").click(function(){
			$(".consumption_prompt_body").fadeOut()
		})
		$(".changeAddressButton").click(function(){
			$(".address_position_body").fadeIn()
		})
		// 点击计算运费=================================================
		function toadd_newaddress(i){
			$(".address_position_body").fadeOut()
			$(".address_position_body .addrsss_section .addrsss_section_box .box").css("border","1px solid rgba(43,43,43,.5)")
			$(".address_position_body .addrsss_section .addrsss_section_box .box"+i).css("border","1px solid #00ac00")
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
						 url: "<?php echo api_url().'get_user_addresses';?>",
						 cache:false,
						 dataType: "json", 
						 data: formData,
						 processData: false,
						 contentType: false, //data: {key:value}, 
						 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
						 success: function(datas){
							$(".p1").html(datas.response.addresses[i].city+datas.response.addresses[i].user_address)
							$(".p2").html(datas.response.addresses[i].user_address_cs)
							$('input[name=addresstest]').val(datas.response.addresses[i].address_id)
							$('input[name=latitude]').val(datas.response.addresses[i].latitude)
							$('input[name=longitude]').val(datas.response.addresses[i].longitude)
							
							AMap.service('AMap.PlaceSearch',function(){//回调函数
								
							})
							
							
							AMap.service('AMap.Driving',function(){//回调函数
								//实例化Driving
								driving= new AMap.Driving({city: '上海市'});
								//TODO: 使用driving对象调用驾车路径规划相关的功能
							})
							driving.search([121.432878,31.222023], [$('input[name=longitude]').val(),$('input[name=latitude]').val()], function(status, result) {
								console.log(result);
							    var routes = result['routes'];
							    var distance = routes[0]['distance'];
								var distance_km = distance / 1000;
								if(distance_km > 0){
									var address_distance = distance_km;
									
								}else{
									var address_distance = 0;
								}
								$(".box_price2").html(distance_km+'km')
								$('input[name=distance]').val(distance_km);
								console.log("超级无极运费",address_distance)
								if(address_distance <= 3){
									$(".box_price2").html('￥8');
									$(".price2").val(8);
									$(".todaytimebox li").attr('data-ysprice',8)
									$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
									$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
								}else if(address_distance > 3 && address_distance <= 5){
									$(".box_price2").html('￥12');
									$(".price2").val(12);
									$(".todaytimebox li").attr('data-ysprice',12)
									$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
									$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
								}else if(address_distance > 5 && address_distance <= 8){
									$(".box_price2").html('￥16');
									$(".price2").val(16);
									$(".todaytimebox li").attr('data-ysprice',16)
									$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
									$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
								}else if(address_distance > 8){console.log("????????????????????")
									$(".box_price2").html('￥20');
									$(".price2").val(20);
									$(".todaytimebox li").attr('data-ysprice',20)
									console.log("hah",parseInt(<?php echo $_GET["cutlery"]?>))
									$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
									$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
								}else{
									$(".price1").val(0);
									console.log(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>")
									$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
									$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
									var shippingfee_show = '<span style="color:red;font-weight:bold;">don’t deliver</span>';
								}
								console.log("距离计算",distance_km,"KM");
								})
						},
						});
						
					}
					
			},
			});
		}
		var datamath = 'Today';
		var sss = 1;
		
        jQuery(document).ready(function ($) {
            $('.isInstantDelivery').click(function() {//点击选择立即派送
				var times=new Date();
				var h = times.getHours();
				var m = times.getMinutes();
				console.log(h+":"+m);
				$("input[name=delivery_time]").val(h+":"+m);
				isDuringDate(14,16);
				$('.isInstantDelivery').addClass('selected');
				$('.isScheduledDelivery').removeClass('selected');
				
                $('#deliveryTimeslotSelector').hide();
                $('input[name=isPreorder]').prop('checked',false);
				$("input[name=datesvalue]").val(0)
				$("#addDeliveryFeeAmount").text('')
				
			});
			
			    function isDuringDate(beginDateStr, endDateStr) {//；点击立即配送，差看时间范围是否需要加运费
					console.log("lailai ")
			        var curDate = new Date();
					var curDate = curDate.getHours();
			            // beginDate = new Date(beginDateStr),
			            // endDate = new Date(endDateStr);
						console.log("lailai ",curDate)
			        if (curDate >= 14 && curDate < 16) {
						console.log("在范围内不用加")
						$(".box_price2").html("￥"+parseInt(parseInt($(".price2").val())));
						$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+0+parseInt(<?php echo $_GET["cutlery"]?>)))
						$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+0+parseInt(<?php echo $_GET["cutlery"]?>)))
			            return true;
			        }
					$(".box_price2").html("￥"+parseInt(parseInt($(".price2").val())+8));
					$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+8+parseInt(<?php echo $_GET["cutlery"]?>)))
					$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+8+parseInt(<?php echo $_GET["cutlery"]?>)))
					console.log("不在范围内加8")
			        return false;
					
			    }
			
            $('.isScheduledDelivery').click(function() {
                $('#deliveryTimeslotSelector').show();
                // $(".isScheduledDelivery").addClass('active');
                $('input[name=isPreorder]').prop('checked',true);
				$('.isScheduledDelivery').addClass('selected');
				$('.isInstantDelivery').removeClass('selected');
            });

            $('.dateSelector').click(function() {
                $('.selector').show();
            });

			$('#deliveryTimeslotDateSelector li.dateOpen').click(function() {
				$("#deliveryTimeslotDateSelector li").removeClass('active');
				$(this).addClass('active');
				console.log($(this).attr('data-math'))
				if($(this).attr('data-math')==1){
					$(".todaytimebox").css("display","block")
					$(".tomorrowtimebox").css("display","none")
				}else{
					$(".todaytimebox").css("display","none")
					$(".tomorrowtimebox").css("display","block")
				}
				if($(this).attr('data-math')==1){
					datamath="Today";
					sss = 1;
				}
				if($(this).attr('data-math')==2){
					datamath="Tomorrow ";
					sss = 2;
				}
				if($(this).attr('data-math')==3){
					datamath="Next Day";
					sss = 3;
				}
				if($(this).attr('data-math')==4){
					datamath="June 4"
				}
				
				
			})
			$(".todaytimebox li").click(function() {
				console.log($(this).attr('data-dates'))
				var data=$(this).attr('data-dates');
				$("input[name=delivery_time]").val(data);
				
				console.log(datamath,$(this).attr('data-ysprice'),$("input[name=delivery_time]").val())
				$("#dateSelector").html(datamath+',&nbsp;&nbsp;&nbsp;'+data)
				$('#deliveryTimeslotSelector').hide();
				$('.isScheduledDelivery').removeClass('active');
				$('.isScheduledDelivery').addClass('selected');
				$('.isInstantDelivery').removeClass('selected');
				$('input[name=isPreorder]').prop('checked',false);
				if($(this).attr('data-dates')=="12:00 - 13:00" || $(this).attr('data-dates')=="13:00 - 14:00" || $(this).attr('data-dates')=="16:00 - 17:00"|| $(this).attr('data-dates')=="17:00 - 18:00"|| $(this).attr('data-dates')=="18:00 - 19:00"|| $(this).attr('data-dates')=="19:00 - 20:00"){
					// alert($(this).attr('data-dates')+"8")
					console.log(1,$(".datesvalue").val())
					$("input[name=datesvalue]").val(8)
					$("#addDeliveryFeeAmount").text("￥8")
					// $(".price2").val( parseInt($(this).attr('data-ysprice'))+parseInt($('input[name=datesvalue]').val()))
					$(".box_price2").html("￥"+parseInt(parseInt($(".price2").val())+parseInt($("input[name=datesvalue]").val())));
					$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+8+parseInt(<?php echo $_GET["cutlery"]?>)))
					$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+8+parseInt(<?php echo $_GET["cutlery"]?>)))
				}else{
					console.log(2,$(".datesvalue").val())
					$("input[name=datesvalue]").val(0)
					$("#addDeliveryFeeAmount").text('')
					// $(".price2").val( parseInt($(this).attr('data-ysprice'))-parseInt($('input[name=datesvalue]').val()))
					$(".box_price2").html("￥"+parseInt(parseInt($(".price2").val())+parseInt($("input[name=datesvalue]").val())));
					$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+0+parseInt(<?php echo $_GET["cutlery"]?>)))
					$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
				}
			})
			
			$(".tomorrowtimebox li").click(function() {
				console.log($(this).attr('data-dates'))
				var data=$(this).attr('data-dates');
				$("input[name=delivery_time]").val(data);
				console.log(datamath,data)//点击配送时间
				$("#dateSelector").html(datamath+'&nbsp;'+data)
				$('#deliveryTimeslotSelector').hide();
				$('.isScheduledDelivery').removeClass('active');
				$('.isScheduledDelivery').addClass('selected');
				$('.isInstantDelivery').removeClass('selected');
				$('input[name=isPreorder]').prop('checked',false);
				
				// $("input[name=datesvalue]").val(0)
				// $("#addDeliveryFeeAmount").text('')
				// $(".price2").val( parseInt($(".price2").val())+parseInt($('input[name=datesvalue]').val()))
				// $(".box_price2").html(parseInt($(".price2").val())+parseInt($("input[name=datesvalue]").val())+".00");
				// $(".box_price3").html(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+0+parseInt(<?php echo $_GET["cutlery"]?>))
				if($(this).attr('data-dates')=="12:00 - 13:00" || $(this).attr('data-dates')=="13:00 - 14:00" || $(this).attr('data-dates')=="16:00 - 17:00"|| $(this).attr('data-dates')=="17:00 - 18:00"|| $(this).attr('data-dates')=="18:00 - 19:00"|| $(this).attr('data-dates')=="19:00 - 20:00"){
					// alert($(this).attr('data-dates')+"8")
					// console.log(1,$(".datesvalue").val())
					$("input[name=datesvalue]").val(8)
					$("#addDeliveryFeeAmount").text("￥8")
					// $(".price2").val( parseInt($(this).attr('data-ysprice'))+parseInt($('input[name=datesvalue]').val()))
					$(".box_price2").html(parseInt($(".price2").val())+parseInt($("input[name=datesvalue]").val())+".00");
					$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+8+parseInt(<?php echo $_GET["cutlery"]?>)))
					$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+8+parseInt(<?php echo $_GET["cutlery"]?>)))
				}else{
					console.log(2,$(".datesvalue").val())
					$("input[name=datesvalue]").val(0)
					$("#addDeliveryFeeAmount").text('')
					// $(".price2").val( parseInt($(this).attr('data-ysprice'))-parseInt($('input[name=datesvalue]').val()))
					$(".box_price2").html(parseInt($(".price2").val())+parseInt($("input[name=datesvalue]").val())+".00");
					$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+0+parseInt(<?php echo $_GET["cutlery"]?>)))
					$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
				}
			})
            $(".multipleSelect li").not('.multipleSelectNotAutomaticSelection').click(function(){

                $(this).parent().find('li').removeClass('selected');
                $(this).parent().find('[type=radio]').prop('checked', false);

                $(this).addClass('selected');
                $(this).closest('li').find('[type=radio]').prop('checked', 'checked');
				alert($("input[name='payment_method_id']:checked").val())
				

            });

            $('#instantDeliveryButton').on('click',function() {
                var selectedTimeslotId = $('#instantDeliveryTimeslotId').val();
                // updateDeliveryTimeslot(selectedTimeslotId, true);
            });



           
        });
		var box_price1=0;
		var box_price2=0;
		var box_price3=0;
		
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
							
							$(".phone_box").html(data.response.mobile);
							$(".email_box").html(data.response.email);
							$(".points_num").text(data.response.sp_points);
							$(".points_input_ji").val(data.response.sp_points)
							$("input[name=users_system_id]").val(data.response.users_system_id);
							if(data.response.wechat_nickname!=''){
								$(".hero h3").html(data.response.wechat_nickname)
							}else{
							  $(".hero h3").html(data.response.first_name+data.response.last_name);
							}
							if(data.response.users_system_id==1){
								$(".pay_way_box").show()
								$(".pay_way_begin").hide()
							}else{
								$(".pay_way_box").hide()
								$(".pay_way_begin").show()
							}
					},
					});
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
						 $(".loading_bg").hide();
						 for(var i=0;i<datas.response.addresses.length;i++){
						 $(".addrsss_section_box").append("<div class='box box"+i+"' onclick='toadd_newaddress("+i+")'><div class='title'>"+datas.response.addresses[i].city+datas.response.addresses[i].user_address+"</div><div class='text'>"+datas.response.addresses[i].user_address_cs+"</div></div>")
						 }
					    //函数参数 "data" 为请求成功服务端返回的数据
							console.log("地址列表:",datas)  
							$(".p1").html(datas.response.addresses[0].city+datas.response.addresses[0].user_address)
							$(".p2").html(datas.response.addresses[0].user_address_cs)
							// var address=datas.response.addresses[0].country+datas.response.addresses[0].city+datas.response.addresses[0].user_address
							var address=datas.response.addresses[0].address_id
							var latitude=datas.response.addresses[0].latitude;
							var longitude=datas.response.addresses[0].longitude;
							$('input[name=addresstest]').val(address)

							$('input[name=latitude]').val(datas.response.addresses[0].latitude)
							$('input[name=longitude]').val(datas.response.addresses[0].longitude)
							
							console.log("配送的经纬度",latitude)
							console.log("配送的经纬度",longitude)
							// var map = new AMap.Map('container',{
							// 		 resizeEnable: true,
							// 		 zoom: 14,
							// 		 center: [121.43262, 31.222172]
							// 	});
							
								<?php if($this->langtype == '_ch'){?>
									//map.setLang('zh_cn');//'en', 'zh_en', 'zh_cn'
								<?php }else{?>
									//map.setLang('en');//'en', 'zh_en', 'zh_cn'
								<?php }?>
							
								AMap.service('AMap.PlaceSearch',function(){//回调函数
									
								})
								
								
								AMap.service('AMap.Driving',function(){//回调函数
									//实例化Driving
									driving= new AMap.Driving({city: '上海市'});
									//TODO: 使用driving对象调用驾车路径规划相关的功能
								})
								driving.search([121.432878,31.222023], [longitude,latitude], function(status, result) {
									console.log(result);
								    var routes = result['routes'];
								    var distance = routes[0]['distance'];
									var distance_km = distance / 1000;
									if(distance_km > 0){
										var address_distance = distance_km;
										
									}else{
										var address_distance = 0;
									}
									$(".box_price2").html(distance_km+'km')
									$('input[name=distance]').val(distance_km);
									console.log("超级无极运费",address_distance)
									// if(address_distance <= 3){
									// 	$(".box_price2").html('8.00');
									// 	$(".price2").val(8);
									// 	$(".box_price3").html(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val()))
									// }else if(address_distance > 3 && address_distance <= 5){
									// 	$(".box_price2").html('12.00');
									// 	$(".price2").val(12);
									// 	$(".box_price3").html(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val()))
									// }else if(address_distance > 5 && address_distance <= 8){
									// 	$(".box_price2").html('16.00');
									// 	$(".price2").val(16);
									// 	$(".box_price3").html(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val()))
									// }else if(address_distance > 8){console.log("????????????????????")
									// 	$(".box_price2").html('20.00');
									// 	$(".price2").val(20);
									// 	$(".box_price3").html(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val()))
									// }else{
									// 	$(".price1").val(0);
									// 	console.log(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>")
									// 	$(".box_price3").html(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val()))
									// 	var shippingfee_show = '<span style="color:red;font-weight:bold;">don’t deliver</span>';
									// }
									if(address_distance <= 3){
										$(".box_price2").html('￥8');
										$(".price2").val(8);
										$(".todaytimebox li").attr('data-ysprice',8)
										$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
										$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
									}else if(address_distance > 3 && address_distance <= 5){
										$(".box_price2").html('￥12');
										$(".price2").val(12);
										$(".todaytimebox li").attr('data-ysprice',12)
										$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
										$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
									}else if(address_distance > 5 && address_distance <= 8){
										$(".box_price2").html('￥16');
										$(".price2").val(16);
										$(".todaytimebox li").attr('data-ysprice',16)
										$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
										$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
									}else if(address_distance > 8){console.log("????????????????????")
										$(".box_price2").html('￥20');
										$(".price2").val(20);
										$(".todaytimebox li").attr('data-ysprice',20)
										$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
										$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
									}else{
										$(".price1").val(0);
										console.log(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>")
										$(".box_price3").html("￥"+parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
										$(".points_math").html(parseInt(parseInt(<?php echo $_GET["subTotal"]?>)+ parseInt($(".price2").val())+parseInt(<?php echo $_GET["cutlery"]?>)))
										var shippingfee_show = '<span style="color:red;font-weight:bold;">don’t deliver</span>';
									}
									console.log("距离计算",distance_km,"KM");
									var distance=distance_km
									
									$(".placeOrderButton").click(function(){//点击结算
									console.log($(".points_input_ji").val());
										if($("#points_text").val() > $(".points_input_ji").val()){//判断最低消费，没超出70元则无法下单
											
										$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "积分不足";}else{echo "Insufficient points";}?>")
										$(".consumption_prompt_body").fadeIn();
										
										return;	
											
										}
										if($("#points_text").val() > 800){//判断最低消费，没超出70元则无法下单
											
											$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "最多可使用800积分";}else{echo "Up to 800 points can be used";}?>")
											$(".consumption_prompt_body").fadeIn();
											
											return;	
											
										}
									
										if(<?php echo $_GET["subTotal"]?> < 70){//判断最低消费，没超出70元则无法下单
											$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "消费不可低于70元";}else{echo "There is a minimum of 70rmb per order";}?>")
											$(".consumption_prompt_body").fadeIn();
											
											return;
										}
										//判断大于8公里小于20公里消费不可低于200元否则无法下单
										if($('input[name=distance]').val() < 20 && $('input[name=distance]').val() > 8 && <?php echo $_GET["subTotal"]?> < 200){//判断最低消费
											$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "您的消费必须满足200元，才能配送到您的位置。";}else{echo "Your order must be a minimum of 200rmb to be deliver";}?>")
											$(".consumption_prompt_body").fadeIn();
											
											return;
										}
										if($('input[name=distance]').val() > 20 ){//判断超出配送距离不可下单
											$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "抱歉，您的地址已超出配送距离";}else{echo "Sorry, your address has exceeded our delivery zone";}?>")
											$(".consumption_prompt_body").fadeIn();
											
											return;
										}
										
											var note=$('textarea[name=order_note]').val();
											var times=new Date();
											var h = times.getHours();
											var m = times.getMinutes();
											console.log(h+":"+m);
											var delivery_time=$("input[name=delivery_time]").val();
											console.log("下单日:",datamath,"下单时间时分:",delivery_time)
											if(sss==1){
												var day2 = new Date();
												 day2.setTime(day2.getTime());
												var s1 = day2.getFullYear()+"-" + (day2.getMonth()+1) + "-" + day2.getDate();
												 console.log("================1")
											}else if(sss==2){
												var day3 = new Date();
												day3.setTime(day3.getTime()+24*60*60*1000);
												 var s1 = day3.getFullYear()+"-" + (day3.getMonth()+1) + "-" + day3.getDate();
												  console.log("================2")
											}else{
												 var day1 = new Date();
												 day1.setTime(day1.getTime()+24*60*60*1000+24*60*60*1000);
												 var s1 = day1.getFullYear()+"-" + (day1.getMonth()+1) + "-" + day1.getDate();
												 console.log("================3")
											}
											
											var payment_method_id=$("input[name='payment_method_id']:checked").val()
											formData.append('cart_id', <?php echo $_GET['cart_id'];?>);//购物车id
											formData.append('distance', $('input[name=distance]').val());//距离
											formData.append('address', $('input[name=addresstest]').val());//地址
											formData.append('day', datamath);//下单天
											formData.append('time', h+":"+m);//下单时间时分
											formData.append('delivery_time',s1+'/'+delivery_time);//交货时间时间时分
											// formData.append('user_id', setoken2);"contact": "03043372285",
											formData.append('contact', $(".phone_box").text());//个人信息电话
											formData.append('order_source_id',"1");
											formData.append('sp_points', $("#points_text").val());
											formData.append('discount', 0);
											formData.append('note', note);//备注
											if(payment_method_id==0){
												formData.append("payment_method","WeChat_Pay");//备注
											}else if(payment_method_id==1){
												formData.append("payment_method","Cash");//备注
											}else if(payment_method_id==2){
												formData.append("payment_method","ImDada");//备注
											}else if(payment_method_id==3){
												formData.append("payment_method","In-House");//备注
											}else if(payment_method_id==4){
												formData.append("payment_method","Shansong");//备注
											}else if(payment_method_id==5){
												formData.append("payment_method","Walk-Ins");//备注
											}else if(payment_method_id==6){
												formData.append("payment_method","Sherpas");//备注
											}else if(payment_method_id==7){
												formData.append("payment_method","JSS");//备注
											}else if(payment_method_id==7){
												formData.append("payment_method","Ele.Me");//备注
											}
											
											$.ajax({
											
											 type: 'POST',
											 url: 'https://www.mygkselss.com/market/apis/submit_order2' ,
											 cache:false,
											 dataType: "json", 
											 data: formData,
											 processData: false,
											 contentType: false, //data: {key:value}, 
											 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
											 success: function(data){
											    //函数参数 "data" 为请求成功服务端返回的数据
													console.log("购买成功:",data,payment_method_id)  
													
													if(payment_method_id==0){
														var Paymentcontent = new FormData();
														Paymentcontent.append('users_system_id', $("input[name=users_system_id]").val());
														Paymentcontent.append('order_id', data.response.order_id);
														var order_id=data.response.order_id;
														$.ajax({
														
														 type: 'POST',
														 url: 'https://www.mygkselss.com/market/apis/js_api_call' ,
														 cache:false,
														 dataType: "json", 
														 data: Paymentcontent,
														 processData: false,
														 contentType: false, //data: {key:value}, 
														 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
														 success: function(data){
														    //函数参数 "data" 为请求成功服务端返回的数据
															
															console.log("微信订单提交成功,等待支付",data.data,data.data.appId)	
																// var jsApiParameters = [];
																	var datapackage=data.data.package;
																	
																	var jsApiParameters = {
																		"appId": data.data.appId,
																		"nonceStr": data.data.nonceStr,
																		"package": datapackage,
																		"signType": data.data.signType,
																		"timeStamp": data.data.timeStamp,
																		"paySign": data.data.paySign
																	};
																	console.log('jsApiParameters：', jsApiParameters);
																	
																	WeixinJSBridge.invoke(
																		'getBrandWCPayRequest', jsApiParameters,
																		function(res){
																			WeixinJSBridge.log('错误拉：'+res);
															// 				alert(res.err_code+res.err_desc+res.err_msg);
																			if(res.err_msg == "get_brand_wcpay_request:ok"){
																		
																				 //window.location.href = "http://wx.umebox.net/wxpay/pay1.jsp?id=<%=keyvalue1%>&Icum=<%=openid%>&ddh=<%=ddh%>";
																	
																				 // alert("微信支付成功!"+$("input[name=users_system_id]").val()+"=="+order_id);
																				 var Paymentcontents = new FormData();
																				Paymentcontents.append('users_system_id', $("input[name=users_system_id]").val());
																				Paymentcontents.append('order_id',order_id);
																				$.ajax({
																				
																				 type: 'POST',
																				 url: 'https://www.mygkselss.com/market/apis/paysuccess_temporary',
																				 cache:false,
																				 traditional:true,
																				 dataType: "json", 
																				 data: Paymentcontents,
																				 processData: false,
																				 contentType: false, //data: {key:value}, 
																				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
																				 success: function(data){
																				    //函数参数 "data" 为请求成功服务端返回的数据
																						console.log("微信支付订单状态成功",data)  
																						window.location.href = "<?php echo base_url().'index.php/welcome/account_orderhistory'?>";
																						
																						
																				},
																				});
																			}else if(res.err_msg == "get_brand_wcpay_request:cancel"){
																				 // alert("用户取消支付!");
																				 window.location.href = "<?php echo base_url().'index.php/welcome/account_orderhistory'?>";
																			}else{
																				// alert("支付失败!");
																				window.location.href = "<?php echo base_url().'index.php/welcome/account_orderhistory'?>";}
																		        
																		}
																	);
																
															
																
																	
																
															
														},
														});
													}else{
														window.location.href = "<?php echo base_url().'index.php/welcome/account_orderhistory'?>";
													}
											},
											});
										
										
									})
								});
								
								
							
					},
					});
				}
				
		},
		});
		
    </script>




            


        </div>
    </div>

   








<?php $this->load->view('default/home_footer')?>