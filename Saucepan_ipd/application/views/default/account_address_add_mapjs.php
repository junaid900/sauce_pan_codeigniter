<script>
//加载delivery address
	function toajax_deliveryaddress_list(){
		$.post('<?php echo base_url()?>index.php/account/ajax_deliveryaddress_list', function (data){
			$('.deiveryaddress_tips').show().html(data);

			$('.deiveryaddresslist_addform').hide();
		})
	}
</script>
<script>
var marker = '';
//显示地图上面的位置点 marker 和 popup ----- 方法 1
function addMarker_formsearchname(i, d, showname) {
    marker = new AMap.Marker({
        map: map,
        position: [ d.location.getLng(),  d.location.getLat()]
    });
    if(showname != ''){
    	var infoWindow = new AMap.InfoWindow({
	       	content: '<div style="float:left;width:180px;"><div style="float:left;width:100%;">'+showname+'</div></div>',
	        offset: {x: 0, y: -30}
	    });
	}else{
		var infoWindow = new AMap.InfoWindow({
	       	content: '<div style="float:left;width:180px;"><div style="float:left;width:100%;">'+d.formattedAddress+'</div></div>',
	        offset: {x: 0, y: -30}
	    });
	}
    infoWindow.open(map, marker.getPosition());
}

//显示地图上面的位置点 marker 和 popup ----- 方法 2
function addMarker_formselectaddress(Lng, Lat, showname) {
    marker = new AMap.Marker({
        map: map,
        position: [ Lng,  Lat]
    });
	var infoWindow = new AMap.InfoWindow({
		//content: '<div style="float:left;width:230px;"><div style="float:left;width:100%;">'+showname+'</div></div>',
		content: '',
		offset: {x: 0, y: -30}
	});
    infoWindow.open(map, marker.getPosition());
}

function toselectaddress_fromsearchaddresslist(i){
	var adcode = pois[i].adcode;
	var address_level = pois[i].type;
	var address_longitude = pois[i].location.lng;
	var address_latitude = pois[i].location.lat;
	var address_formattedaddress = pois[i].address;
	var address_dingwei = pois[i].name;
	var address_province = '';
	var address_city = '<?php if($this->langtype=='_ch'){echo "上海";}else{echo "Shanghai";}?>';
	var address_district = getdistrictname_byadcode(adcode);//根据地理编号，反解析 知道  district
	console.log("位置经纬度",address_longitude,address_latitude)
	//计算两个距离点之间的距离 REVO 与用户选择的地点之间的距离
	driving.search([121.432878,31.222023], [address_longitude, address_latitude], function(status, result) {
		console.log(result);
	    var routes = result['routes'];
	    var distance = routes[0]['distance'];
		var distance_km = distance / 1000;
		if(distance_km > 0){
			var address_distance = distance_km;
		}else{
			var address_distance = 0;
		}

		$('input[name="address_longitude"]').val(address_longitude);
		$('input[name="address_latitude"]').val(address_latitude);
		$('input[name="address_distance"]').val(address_distance);
		
		$('input[name="address_formattedaddress"]').val(address_formattedaddress);
		
		$('input[name="address_province"]').val(address_province);
		$('input[name="address_city"]').val(address_city);
		$('input[name="address_district"]').val(address_district);

		$('input[name="address_dingwei"]').val(address_dingwei);
		$('input[name="address_isposition"]').val(0);
		$('input[name="address_level"]').val(address_level);

		if(address_district != 'Huangpu' && address_district != 'Xuhui' && address_district != 'Putuo' && address_district != 'Yangpu' && address_district != 'Changning' && address_district != 'Hongkou' && address_district != 'Jing\'an'){
			var shippingfee_show = '<span style="color:red;font-weight:bold;">don’t deliver</span>';
		}else{
		// 	if(address_formattedaddress == 'Wanting Road 99 Long'){//特殊被批准的地址，距离revo 19.837KM
		// 		var shippingfee_show = '<span style="color:#F2C3C1;font-weight:bold;">50rmb per day</span>';
		// 	}else{
				if(address_distance <= 3){
					var shippingfee_show = '<span style="color:#F2C3C1;font-weight:bold;">8rmb</span>';
				}else if(address_distance > 3 && address_distance <= 5){
					var shippingfee_show = '<span style="color:#F2C3C1;font-weight:bold;">12rmb</span>';
				}else if(address_distance > 5 && address_distance <= 8){
					var shippingfee_show = '<span style="color:#F2C3C1;font-weight:bold;">16rmb</span>';
				}else if(address_distance > 8){
					var shippingfee_show = '<span style="color:#F2C3C1;font-weight:bold;">20rmb</span>';
				}else{
					var shippingfee_show = '<span style="color:red;font-weight:bold;">don’t deliver</span>';
				}
		// 	}
		}
		

		addMarker_formselectaddress(address_longitude, address_latitude, '<div style="float:left;width:100%;">'+address_dingwei+'</div><div style="float:left;width:100%;color:#999;">'+address_formattedaddress+', '+address_district+', '+address_city+' ['+address_distance+'km] '+shippingfee_show+'</div>');//添加popup

		map.setCenter(marker.getPosition());//设置中心点

		if(address_district != 'Huangpu' && address_district != 'Xuhui' && address_district != 'Putuo' && address_district != 'Yangpu' && address_district != 'Changning' && address_district != 'Hongkou' && address_district != 'Jing\'an'){
			$('.cannot_deliverytips').fadeIn(300);

			$('.deiveryaddresslist_addform').hide().find('.shortname').html(address_dingwei);
		    $('.deiveryaddresslist_addform').hide().find('.fortmatedaddress').html(address_formattedaddress+', '+address_district+', '+address_city);
		}else{
	// 		if(address_formattedaddress == 'Wanting Road 99 Long'){//特殊被批准的地址，距离revo 19.837KM
	// 			$('.cannot_deliverytips').hide();
	
	// 			$('.deiveryaddresslist_addform').show().find('.shortname').html(address_dingwei);
	// 		    $('.deiveryaddresslist_addform').show().find('.fortmatedaddress').html(address_formattedaddress+', '+address_district+', '+address_city);
	// 		}else{
	// 			if(address_distance <= 20){//仅仅配送 20 km 以内的
					$('.cannot_deliverytips').hide();
		
					$('.deiveryaddresslist_addform').show().find('.shortname').html(address_dingwei);
				    $('.deiveryaddresslist_addform').show().find('.fortmatedaddress').html(address_formattedaddress+', '+address_district+', '+address_city);
		// 		}else{
		// 			$('.cannot_deliverytips').fadeIn(300);
		
		// 			$('.deiveryaddresslist_addform').hide().find('.shortname').html(address_dingwei);
		// 		    $('.deiveryaddresslist_addform').hide().find('.fortmatedaddress').html(address_formattedaddress+', '+address_district+', '+address_city);
		// 		}
		// 	}
		}
		tocloseaddresslistarea();
	});
}


function tocloseaddresslistarea(){
	$('._ListContainer').html('').hide();
}


AMap.service('AMap.Driving',function(){//回调函数
    //实例化Driving
    driving= new AMap.Driving({city: '上海市'});
    //TODO: 使用driving对象调用驾车路径规划相关的功能
})
//关闭添加地址输入框
function toclose_addaddressform(){
	$('.deiveryaddresslist_addform').hide();
	$('.deiveryaddress_tips').show();
}
//获取当前定位信息---错误处理的方法
function onErrorcurrentlocation(obj) {
	alert(obj.info + '--' + obj.message);
	console.log(obj);
}
//continue  -- 继续到整体页面继续到下一步
function togotoshopping(){
	location.href = '<?php //echo $decodebackurl?>';
}
</script>




<div id="container_hidden" style="display:none;"></div>

<script type="text/javascript">
//获取用户当前地理位置
function togetcurrentlocation(){
	var mapObj = new AMap.Map('container_hidden');

 	<?php if($this->langtype == '_ch'){?>
 		mapObj.setLang('zh_cn');//'en', 'zh_en', 'zh_cn'
    <?php }else{?>
   		mapObj.setLang('en');//'en', 'zh_en', 'zh_cn'
    <?php }?>
	
	mapObj.plugin('AMap.Geolocation', function () {
		geolocation = new AMap.Geolocation({
			enableHighAccuracy: true, // 是否使用高精度定位，默认:true
			timeout: 10000,           // 超过10秒后停止定位，默认：无穷大
			maximumAge: 0,            // 定位结果缓存0毫秒，默认：0
			convert: true,            // 自动偏移坐标，偏移后的坐标为高德坐标，默认：true
			showButton: true,         // 显示定位按钮，默认：true
			buttonPosition: 'LB',     // 定位按钮停靠位置，默认：'LB'，左下角
			buttonOffset: new AMap.Pixel(10, 20), // 定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
			showMarker: true,         // 定位成功后在定位到的位置显示点标记，默认：true
			showCircle: true,         // 定位成功后用圆圈表示定位精度范围，默认：true
			panToLocation: true,      // 定位成功后将定位到的位置作为地图中心点，默认：true
			zoomToAccuracy:true,       // 定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
		});
		mapObj.addControl(geolocation);
		geolocation.getCurrentPosition();
		AMap.event.addListener(geolocation, 'complete', onCompletecurrentlocation); // 返回定位信息
		AMap.event.addListener(geolocation, 'error', onErrorcurrentlocation);       // 返回定位出错信息
	});
}
//获取用户当前地理位置
function onCompletecurrentlocation(obj){
// var res = '经纬度：' + obj.position + 
// '\n精度范围：' + obj.accuracy + 
// '米\n定位结果的来源：' + obj.location_type + 
// '\n状态信息：' + obj.info + 
// '\n地址：' + obj.formattedAddress + 
// '\n地址信息：' + JSON.stringify(obj.addressComponent, null, 4);

	if(obj.formattedAddress != ''){
		placeSearch.search(obj.formattedAddress, function(status, result) {
			var poiList = result.poiList;
			pois = poiList.pois;
// 			console.log(pois);//打印
			if(pois.length > 0){
				for(var i = 0; i < pois.length; i++){
					var address_formattedaddress = pois[i].address;
					var address_dingwei = pois[i].name;
					if(address_dingwei != '' && address_formattedaddress != ''){
						toselectaddress_fromsearchaddresslist(i);//自动从下拉列表里面选择一条数据
						break;
					}
				}
			}
		});
	}

}
//根据地理编号，反解析 知道  district
function getdistrictname_byadcode(adcode){
	if(adcode == 310100){
		var address_district = 'City area';
	}else if(adcode == 310151){
		var address_district = 'Chongming';
	}else if(adcode == 310120){
		var address_district = 'Fengxian';
	}else if(adcode == 310115){
		var address_district = 'Pudong';
	}else if(adcode == 310116){
		var address_district = 'Jinshan';
	}else if(adcode == 310113){
		var address_district = 'Baoshan';
	}else if(adcode == 310101){
		var address_district = 'Huangpu';
	}else if(adcode == 310114){
		var address_district = 'Jiading';
	}else if(adcode == 310104){
		var address_district = 'Xuhui';
	}else if(adcode == 310107){
		var address_district = 'Putuo';
	}else if(adcode == 310112){
		var address_district = 'Minhang';
	}else if(adcode == 310110){
		var address_district = 'Yangpu';
	}else if(adcode == 310118){
		var address_district = 'Qingpu';
	}else if(adcode == 310117){
		var address_district = 'Songjiang';
	}else if(adcode == 310105){
		var address_district = 'Changning';
	}else if(adcode == 310109){
		var address_district = 'Hongkou';
	}else if(adcode == 310106){
		var address_district = 'Jing\'an';
	}else{
		var address_district = '';
	}
	return address_district;
}
</script>