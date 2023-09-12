<?php $this->load->view('default/home_header')?>
<style>
	input[class='phone_number']::-webkit-input-placeholder {
	    color: #465D63 !important;
	}
	
	input[class='phone_number']:-ms-input-placeholder {
	    color: #465D63 !important;
	}
	
	input[class='phone_number']::-moz-placeholder {
	    color: #465D63 !important;
	}
</style>
<div class="new_saucepan">
	<div class="new_saucepan_body">
		<div class="title">
			Almost Done!<br> One more step!
			<div class="line"></div>
		</div>
		<input type="text" placeholder="Please enter your phone"  class="phone_number"/>
		<div class="btn">
			Lets proceed to<br> update your details
		</div>
	</div>
</div>

<div class="thankyou_box">
	<div class="box">
		<div class="thankyou_box_box">
			
			<?php if($this->langtype == '_ch'){
					echo '谢谢您';
				}else{
					echo 'Thank You';
				}
			?>,
		
			
			<?php if($this->langtype == '_ch'){
					echo '<span class="num_address"></span>秒后跳转页面';
				}else{
					echo 'Jump to page in <span class="num_address"></span> seconds';
				}
			?>
		</div>
	</div>
</div>
<style>
.box_banner{float:left;width:100%;overflow:hidden;}
.box_banner ul{float:left;width:100%;margin:0px;padding:0px;}
.box_banner ul li{float:left;width:100%;margin:0px;padding:0px;}
.box_banner ol{float:left;width:50%;height:26px;text-align:center;margin:-26px 0px 0px 25%;padding:0px;}
.box_banner ol li{display:inline-block;margin:5px;width:12px;height:12px;border-radius: 10px;background-color:transparent;border:2px solid #dbb395;}
.box_banner ol li:first-child{margin:5px 5px 5px 0px;}
.box_banner ol li:last-child{margin:5px 0px 5px 5px;}
.box_banner ol li.on{background-color:transparent;border:2px solid #82cedc;}


input::-webkit-input-placeholder{
	color:#ccc;
}
input::-moz-placeholder{   /* Mozilla Firefox 19+ */
	color:#ccc;
}
input:-moz-placeholder{    /* Mozilla Firefox 4 to 18 */
	color:#ccc;
}
input:-ms-input-placeholder{  /* Internet Explorer 10-11 */ 
	color:#ccc;
}
</style>


<input name="address_longitude" id="address_longitude" type="hidden" value=""/><!-- 经度：  -->
<input name="address_latitude" id="address_latitude" type="hidden" value=""/><!-- 纬度：  -->
<input name="address_distance" id="address_distance" type="hidden" value=""/><!-- 距离REVO店的距离：  -->
<input name="address_formattedaddress" id="address_formattedaddress" type="hidden" value=""/>
<input name="address_province" id="address_province" type="hidden" value=""/>
<input name="address_city" id="address_city" type="hidden" value=""/>
<input name="address_district" id="address_district" type="hidden" value=""/>
<input name="address_level" id="address_level" type="hidden" value=""/>
<input name="address_isposition" id="address_isposition" type="hidden" value="0"/>
		

<!-- <div style="text-transform:uppercase;position:absolute;bottom:0px;width:100%;max-width:750px;height:49px;line-height:49px;border-top:1px solid #EFEFEF;background:white;z-index:1000;">
	<div class="button_continue_off" style="color:#CCC;cursor:pointer;float:right;margin-right:15px;font-size:18px;">
		<?php// if($this->langtype == '_ch'){echo '继续';}else{echo 'Continue';}?>
	</div>
	<div class="button_continue_on" onclick="togotoshopping()" style="display:none;cursor:pointer;float:right;margin-right:15px;font-size:18px;">
		<?php// if($this->langtype == '_ch'){echo '继续';}else{echo 'Continue';}?>
	</div>
</div> -->


<style>
.address_dingwei{float:left;width:calc(100% - 7px);text-indent:10px;border-radius:5px;height:26px;color:gray;}
.address_dingwei::-webkit-input-placeholder{font-style:italic;color:#96a5a0;}
.address_dingwei::-moz-placeholder{font-style:italic;color:#96a5a0;}
.address_dingwei:-moz-placeholder{font-style:italic;color:#96a5a0;}
.address_dingwei:-ms-input-placeholder{font-style:italic;color:#96a5a0;}
.button.noFilling {
    border: 1px solid silver;
    background: none;
    color: #17aaf5;
}
.button.medium {
    font-size: 13px;
    padding: 0 20px;
    min-height: 42px;
}
.button.large, .button.medium {
    font-family: ClientFont;
    line-height: 40px;
	display: flex;
	justify-content: flex-start;
	align-items: center;
}
.button {
    font-size: 14px;
    text-transform: uppercase;
    padding: 0 25px;
    height: 50px;
    text-align: center;
    font-family: ClientFontMedium;
    display: block;
    height: auto;
    cursor: pointer;
    border-radius: 1px;
    box-shadow: 1px 1px 1px hsla(0,0%,53%,.29);
    transition: .2s ease-in-out;
}

</style>

<!-- <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.3&key=fbef71c53559a23170dd687d9b9435e8"></script> -->
<!-- <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.3&key=fbef71c53559a23170dd687d9b9435e8"></script> -->

<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.3&key=d9472192dd9115048016456116400810&plugin=AMap.Autocomplete,AMap.PlaceSearch"></script>
<div class="inside extraSpace backButton" style="margin-top: 58px;" onclick="javascript:history.back(-1);">
	<div class="button medium noFilling">
	<img style="width: 10px;" src="<?php echo base_url().'themes/default/images/history.png'?>" />
	<div style="margin-left:10px;line-height: none;color: #465c62;"><?php if($this->langtype == '_ch'){echo '上一步';}else{echo 'BACK';}?></div>
	</div>
</div>
<div style="position:absolute;top:102px;width:100%;max-width:750px;background:#465c62;z-index: 1111;">
	<div style="float:left;width:calc(100% - 20px);margin-left:10px;margin-top:6px;margin-bottom:6px;">
		<form action="javascript:;">
		
			<input id="address_dingwei" name="address_dingwei" class="address_dingwei" placeholder="<?php if($this->langtype == '_ch'){/*echo '搜索商店，城市，州或邮编';*/echo '搜索地址';}else{/*echo 'Search store, city, state, or zip';*/echo 'Search address or nearby';}?>" type="text" value="" style="background:#fdf3f2;border:0px;outline: none;padding: 5px 0;width: 100%;"/>
			<!-- <div onclick="togetcurrentlocation()" style="float:left;width:43px;margin-left:-43px;">
				<img style="float:left;width:20px;height:24px;padding-top:6px;padding-bottom:6px;margin-left:15px;" src="<?php echo base_url().'themes/default/images/icon_location_black.png'?>"/>
			</div> -->
			
			<div class="_ListContainer" id="_ListContainer" style="position:absolute;margin-top:38px;width:calc(100% - 20px);max-width:730px;z-index:9999;background:white;border-radius:6px;">

			</div>
			
			<div id="address_dingwei_error" style="display:none;float:left;width:100%;color:#f79521;line-height:20px;">
				<?php if($this->langtype == '_ch'){echo '街道不能为空';}else{echo 'Street cannnot be empty';}?>
			</div>
			<div id="message" style="float:left;width:100%;margin-top:8px;color:#f79521;display:none;">
				
			</div>
		</form>
	</div>
</div>

<div style="position:absolute;top:150px;bottom:25px;width:100%;max-width:750px;height:100%">
	<div id="container" style="position: relative;width: 100%;height: 100%;overflow:hidden;">
    	
	</div>
	<script type="text/javascript">
					    var map = new AMap.Map('container',{
					         resizeEnable: true,
					         zoom: 14,
					         center: [121.43262, 31.222172]
					    });

				      	<?php if($this->langtype == '_ch'){?>
				        	map.setLang('zh_cn');//'en', 'zh_en', 'zh_cn'
				        <?php }else{?>
				        	map.setLang('en');//'en', 'zh_en', 'zh_cn'
				        <?php }?>

						AMap.service('AMap.PlaceSearch',function(){//回调函数
							
					    })
					    
					    var placeSearch = new AMap.PlaceSearch({
						    	input: "address_dingwei",
						    	city: "上海", //上海
						    	citylimit: true,
// 						        map: map,
						        pageSize: 5,
						        pageIndex: 1,
						        extensions: 'all',
						        panel: '_ListContainer',
								
								<?php if($this->langtype == '_ch'){?>
									lang: "zh_cn",//'en', 'zh_en', 'zh_cn'
								<?php }else{?>
									lang: "en",//'en', 'zh_en', 'zh_cn'
								<?php }?>
						});//构造地点查询类

						//关键字查询
						var pois = '';

						$('input[name="address_dingwei"]').keyup(function(){
							var address_dingwei_value = $('input[name="address_dingwei"]').val();
							if(address_dingwei_value != ''){
								$('._ListContainer').show();
								placeSearch.search(address_dingwei_value, function(status, result) {
									var poiList = result.poiList;
									pois = poiList.pois;
									console.log("lllllll",pois);//打印
									var _ListContainer_msg = '<div style="float:left;width:calc(100% - 20px);margin:10px;">';
									if(pois.length > 0){
										for(var i = 0; i < pois.length; i++){
											
											var adcode = pois[i].adcode;
											var address_longitude = pois[i].location.lng;
											var address_latitude = pois[i].location.lat;
											var address_formattedaddress = pois[i].address;
											var address_dingwei = pois[i].name;
											var address_province = '';
											var address_city = 'Shanghai';
											var address_district = getdistrictname_byadcode(adcode);//根据地理编号，反解析 知道  district
											
											if(address_dingwei != '' && address_formattedaddress != ''){
												console.log("wo lai ")
												_ListContainer_msg += '<div onclick="toselectaddress_fromsearchaddresslist('+i+')" style="float:left;width:100%;line-height:16px;padding:3px 0px;border-bottom:1px solid gray;cursor:pointer;"><div style="float:left;width:100%;font-size:12px;">'+address_dingwei+'</div><div style="float:left;width:100%;font-size:12px;color:#999;">'+address_formattedaddress+', '+address_district+', '+address_city+'</div></div>';
											}
										}
									}
									_ListContainer_msg += '<div onclick="tocloseaddresslistarea()" style="float:left;width:100%;line-height:16px;padding:8px 0px 5px 0px;border-bottom:0px solid gray;cursor:pointer;"><div style="float:left;width:100%;font-size:12px;text-align:right;">Close</div></div>';
									_ListContainer_msg += '</div>';

									$('._ListContainer').html(_ListContainer_msg);

								});
							}
						});
		</script>
		<?php $this->load->view('default/account_address_add_mapjs')?>
</div>

<div class="cannot_deliverytips" style="display:none;position:absolute;top:160px;width:100%;max-width:750px;z-index:1000;">
	<div style="float:left;width:calc(100% - 20px);margin:0px 10px 5px 10px;background:white;border-radius:8px;">
		<div style="float:left;width:calc(100% - 30px);margin:15px;font-size:12px;color:red;font-weight:bold;">
			<?php 
				if($this->langtype == '_ch'){
					echo '对不起，我们目前没有送达此地址，请尝试其他地址或查看我们的送货区FAQ。';
				}else{
					echo 'Sorry, We currently don\'t deliver to this address, please try another address.';
				}
			?>
		</div>
	</div>
</div>

<div class="firstcomingin_deliverytips" style="position:absolute;top:150px;width:100%;max-width:750px;z-index:1000;" >
	<div onclick="toclose_firstcomingin()" style="float:left;width:20px;height:20px;margin:0px 10px 0px 30px;background-color:rgba(0,0,0);border-radius:2px;transform:rotate(45deg);-ms-transform:rotate(45deg);-moz-transform:rotate(45deg);-webkit-transform:rotate(45deg);-o-transform:rotate(45deg);">
		
	</div>
	<div onclick="toclose_firstcomingin()" style="float:left;width:calc(100% - 20px);margin:-10px 10px 5px 10px;background-color:rgba(0,0,0);border-radius:8px;">
		<div style="float:left;width:calc(100% - 30px);margin:15px;font-size:12px;color:white;">
			<?php 
				if($this->langtype == '_ch'){
					echo '请在上面输入您的地址';
				}else{
					echo 'Please enter your address above';
				}
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
function toclose_firstcomingin(){
	$('.firstcomingin_deliverytips').fadeOut(800);
}
$('input[name="address_dingwei"]').keyup(function(){
	$('.firstcomingin_deliverytips').fadeOut(800);
});
</script>


<div class="deiveryaddress_tips" style="position:absolute;bottom:50px;width:100%;max-width:750px;z-index:1000;">
	
</div>


<div class="deiveryaddresslist_addform" style="display:none;position:absolute;bottom:50px;width:100%;max-width:750px;z-index:1000;">
	<div style="float:left;width:calc(100% - 20px);margin:0px 10px 5px 10px;height:150px;background:white;border-radius:8px;">
		<div class="action_address_one" style="float:left;width:calc(100% - 30px);margin:15px;font-size:16px;color:gray;">
			<div style="float:left;width:calc(100% - 30px);">
				<div class="shortname" style="float:left;width:100%;color:black;font-size:12px;"></div>
				<div class="fortmatedaddress" style="float:left;width:100%;font-size:12px;margin-top:5px;"></div>
			</div>
			<div style="float:left;width:30px;">
				<div onclick="toclose_addaddressform()" style="float:right;"><img style="float:left;width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/close.png'?>"/></div>
			</div>
			
			<div class="formatedaddress" style="float:left;width:100%;font-size:14px;margin-top:5px;"></div>
			<div style="float:left;width:100%;font-size:14px;margin-top:5px;">
				<div style="float:left;width:calc(100% - 110px);">
					<div style="float:left;font-size:14px;padding:0px 0px;margin-top:-5px;">
						<div style="float:left;width:100%;">
							<input type="text" name="address_otherdetail" placeholder="Add exact address" style="float:left;width:calc(100% - 6px);-webkit-appearance:none;border-radius:0px;background:transparent;border:0px;border-bottom:2px solid black;" >
						</div>
						<div style="float:left;width:100%;font-size:12px;line-height:15px;margin-top:3px;color:gray;text-align:left;">
							<?php if($this->langtype == '_ch'){echo '(例如. 1号楼101室)';}else{echo '(EG. building 1, room 101)';}?>
						</div>
					</div>
				</div>
				
				<div style="float:left;width:110px;">
					<div onclick="toaction_address_second()" style="float:right;font-size:14px;background:black;color:white;line-height:35px;padding:0px 20px;">
						<?php if($this->langtype == '_ch'){echo '保存';}else{echo 'Save';}?>
					</div>
				</div>
				
			</div>
		</div>
		<div class="action_address_second" style="display:none;float:left;width:calc(100% - 30px);margin:15px;font-size:14px;color:gray;">
			<div style="float:left;width:100%;">
				<div style="float:left;width:80%;">
					Nearest Cross Street
				</div>
				<div style="float:left;width:20%;">
					<div onclick="toaction_address_one()" style="float:right;"><img style="float:left;width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/close.png'?>"/></div>
				</div>
			</div>
			<div style="float:left;width:calc(100% - 100px);margin-left:50px;font-size:14px;margin-top:5px;">
				<input type="text" name="address_marked" style="float:left;width:calc(100% - 6px);-webkit-appearance:none;border-radius:0px;background:transparent;border:0px;border-bottom:2px solid black;"  />
			</div>
			<div style="float:left;width:100%;font-size:12px;margin-top:4px;color:gray;text-align:center;">
				<?php //if($this->langtype == '_ch'){echo '(例如. 家 / 办公室 / 健身房)';}else{echo '(EG. Home / Office / Gym)';}?>
			</div>
			<div style="float:left;width:100%;font-size:14px;margin-top:4px;">
				<table cellspacing="0" cellpadding="0" style="float:left;width:100%;">
					<tr>
						<td align="center">
							<table cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<?php if(isset($_GET['addressid'])){ ?>
											<div class="addnewaddress_submit" onclick="toadd_newaddress2()" style="float:left;font-size:14px;background:black;color:white;line-height:35px;padding:0px 20px;">
												<?php if($this->langtype == '_ch'){echo '保存';}else{echo 'Save';}?>
											</div>
										<?php }else{?>
											<div class="addnewaddress_submit" onclick="toadd_newaddress()" style="float:left;font-size:14px;background:black;color:white;line-height:35px;padding:0px 20px;">
												<?php if($this->langtype == '_ch'){echo '保存';}else{echo 'Save';}?>
											</div>
										<?php } ?>
										<div class="addnewaddress_loading" style="display:none;float:left;font-size:14px;background:#efefef;color:gray;line-height:35px;padding:0px 20px;">
											<?php if($this->langtype == '_ch'){echo '加载中...';}else{echo 'Loading...';}?>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function toaction_address_one(){
		$('.action_address_one').show();
		$('.action_address_second').hide();
	}
	function toaction_address_second(){
		// var setoken= getCookie("token");
		// var setoken2= getCookie("user_id");
		$('.action_address_one').hide();
		$('.action_address_second').show();
		// var address_longitude = $('input[name="address_longitude"]').val();
		// var address_latitude = $('input[name="address_latitude"]').val();
		// var address_distance = $('input[name="address_distance"]').val();
		// var address_formattedaddress = $('input[name="address_formattedaddress"]').val();
		// var address_province = $('input[name="address_province"]').val();
		// var address_city = $('input[name="address_city"]').val();
		// var address_district = $('input[name="address_district"]').val();
		// var address_level = $('input[name="address_level"]').val();
		// var address_isposition = $('input[name="address_isposition"]').val();
		
		// var address_dingwei = $('input[name="address_dingwei"]').val();
		// var address_otherdetail = $('input[name="address_otherdetail"]').val();
		// var address_marked = $('input[name="address_marked"]').val();
		// var ss=address_district+address_formattedaddress;
		// if(address_otherdetail != ''){
		// 	$('.addnewaddress_submit').hide();
		// 	$('.addnewaddress_loading').show();
		// 			var formData = new FormData();
		// 			formData.append('token', setoken);
		// 			formData.append('user_id', setoken2);
		// 			formData.append('address', address_formattedaddress+address_otherdetail);
		// 			formData.append('user_address_ch', address_otherdetail);
		// 			formData.append('user_address_en', address_otherdetail);
		// 			formData.append('address_cs', address_marked); 
		// 			formData.append('user_address_cs_ch', address_marked); 
		// 			formData.append('user_address_cs_en', address_marked); 
		// 			formData.append('country', '中国'); 
		// 			formData.append('city', address_city); 
		// 			formData.append('postal_code', null); 
		// 			formData.append('latitude', address_latitude); 
		// 			formData.append('longitude', address_distance); 

					
		// 			$.ajax({
					
		// 			 type: 'POST',
		// 			 url: 'https://www.mygkselss.com/market/apis/add_address' ,
		// 			 cache:false,
		// 			 dataType: "json", 
		// 			 data: formData,
		// 			 processData: false,
		// 			 contentType: false, //data: {key:value}, 
		// 			 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		// 			 success: function(data){
		// 			    //函数参数 "data" 为请求成功服务端返回的数据
		// 					console.log('请求成功',data)  
							
		// 			},
		// 			});
		// 		}
	}
	function toadd_newaddress(){
		// var setoken= getCookie("token");
		// var setoken2= getCookie("user_id");
		
		var address_longitude = $('input[name="address_longitude"]').val();
		var address_latitude = $('input[name="address_latitude"]').val();
		var address_distance = $('input[name="address_distance"]').val();
		var address_formattedaddress = $('input[name="address_formattedaddress"]').val();
		var address_province = $('input[name="address_province"]').val();
		var address_city = $('input[name="address_city"]').val();
		var address_district = $('input[name="address_district"]').val();
		var address_level = $('input[name="address_level"]').val();
		var address_isposition = $('input[name="address_isposition"]').val();
		
		var address_dingwei = $('input[name="address_dingwei"]').val();
		var address_otherdetail = $('input[name="address_otherdetail"]').val();
		var address_marked = $('input[name="address_marked"]').val();
		var ss=address_district+address_formattedaddress;
		console.log(ss,address_district,address_formattedaddress,"ss");
		if(address_otherdetail != ''){
			$('.addnewaddress_submit').hide();
			$('.addnewaddress_loading').show();
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
					formData.append('address', address_formattedaddress+' , \xa0\xa0'+address_otherdetail);
					// formData.append('user_address_ch', address_formattedaddress+address_otherdetail);
					// formData.append('user_address_en', address_formattedaddress+address_otherdetail);
					formData.append('address_cs', address_marked); 
					// formData.append('user_address_cs_ch', address_marked); 
					// formData.append('user_address_cs_en', address_marked); 
					formData.append('country', '中国'); 
					formData.append('city', address_city); 
					formData.append('postal_code', null); 
					formData.append('latitude', address_latitude); 
					formData.append('longitude', address_longitude); 
					 if(timestamp>timestamp1){
						$.ajax({
						
						 type: 'POST',
						 url: 'https://www.mygkselss.com/market/apis/add_address' ,
						 cache:false,
						 dataType: "json", 
						 data: formData,
						 processData: false,
						 contentType: false, //data: {key:value}, 
						 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
						 success: function(data){
						    //函数参数 "data" 为请求成功服务端返回的数据
								console.log('请求成功',data)  
								if(data!=null){
									window.location.href ="<?php echo base_url().'index.php/welcome/account_address_list'?>" ;
								}
						},
						});
					}
					
			},
			});
					
					
		
					
					
				}
	}
	function toadd_newaddress2(){
		// var setoken= getCookie("token");
		// var setoken2= getCookie("user_id");
		
		var address_longitude = $('input[name="address_longitude"]').val();
		var address_latitude = $('input[name="address_latitude"]').val();
		var address_distance = $('input[name="address_distance"]').val();
		var address_formattedaddress = $('input[name="address_formattedaddress"]').val();
		var address_province = $('input[name="address_province"]').val();
		var address_city = $('input[name="address_city"]').val();
		var address_district = $('input[name="address_district"]').val();
		var address_level = $('input[name="address_level"]').val();
		var address_isposition = $('input[name="address_isposition"]').val();
		
		var address_dingwei = $('input[name="address_dingwei"]').val();
		var address_otherdetail = $('input[name="address_otherdetail"]').val();
		var address_marked = $('input[name="address_marked"]').val();
		var ss=address_district+address_formattedaddress;
		if(address_otherdetail != ''){
			$('.addnewaddress_submit').hide();
			$('.addnewaddress_loading').show();
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
					formData.append('address', address_formattedaddress+address_otherdetail);
					// formData.append('user_address_ch', address_formattedaddress+address_otherdetail);
					// formData.append('user_address_en', address_formattedaddress+address_otherdetail);
					formData.append('address_cs', address_marked); 
					// formData.append('user_address_cs_ch', address_marked); 
					// formData.append('user_address_cs_en', address_marked); 
					formData.append('country', '中国'); 
					formData.append('city', address_city); 
					formData.append('postal_code', null); 
					formData.append('latitude', address_latitude); 
					formData.append('longitude', address_longitude); 
					 if(timestamp>timestamp1){
						$.ajax({
						
						 type: 'POST',
						 url: 'https://www.mygkselss.com/market/apis/add_address' ,
						 cache:false,
						 dataType: "json", 
						 data: formData,
						 processData: false,
						 contentType: false, //data: {key:value}, 
						 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
						 success: function(data){
						    //函数参数 "data" 为请求成功服务端返回的数据num_address
								console.log('请求成功',data) 
								 var seconds = 5;
								    $(".thankyou_box").show();
								    $(".num_address").html('&nbsp;&nbsp;'+seconds+'&nbsp;&nbsp;');
								    setInterval(function () {
								      seconds--;
								      $(".num_address").html('&nbsp;&nbsp;'+seconds+'&nbsp;&nbsp;');
								      if (seconds == 0) {
								        $(".thankyou_box").hide();
								        window.location = "<?php echo base_url().'index.php/welcome/product'?>";
								      }
								    }, 1000);
							
						},
						});
					}
					
			},
			});
					
					
		
					
					
				}
	}
	//删除地址
	function toremove_address(address_id){
		$('.removeaddress_submit_'+address_id).hide();
		$('.removeaddress_loading_'+address_id).show();

		$.post('<?php echo base_url()?>index.php/account/toremove_address/'+address_id, function (data){
			toajax_deliveryaddress_list();//加载delivery address
		})
	}
</script>


<script type="text/javascript">
	toajax_deliveryaddress_list();//默认加载加载delivery address
</script>
<?php $this->load->view('default/home_footer')?>