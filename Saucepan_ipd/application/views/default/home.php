<?php $this->load->view('default/home_header')?>
<!-- <script src="<?php echo base_url()?>themes/default/js/timetk.js?date=<?php echo CACHE_USETIME()?>"></script> -->
<style>
	html,body{width: 100%;float:left;position: relative;height: 100%;;}
</style>
<div class="home_banners" style="background:url('<?php echo base_url().'themes/default/images/home_banner.jpg'?>') center center / cover no-repeat;">
	
</div>
 
<div class="home_menu_body">
	<a href="<?php echo base_url().'index.php/welcome/product'?>"  class="box boxs" style="background:url('<?php echo base_url().'themes/default/images/saucepan.jpg'?>') center center / cover no-repeat;">
		
	</a>
	<a href="https://www.mygksel.com/revo"  class="box" style="background:url('<?php echo base_url().'themes/default/images/revo.jpg'?>') center center / cover no-repeat;">
		
	</a>
	<a href="<?php echo base_url().'index.php/welcome/product_categories'?>"  class="box" style="background:url('<?php echo base_url().'themes/default/images/wineshop.jpg'?>') center center / cover no-repeat;">
		
	</a>
</div>
<div class="home_footer_body">
	Where health & happiness come together<?php // echo apiimage_url()?>
</div>
<script>
	
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
	 success: function(data){
	    //函数参数 "data" 为请求成功服务端返回的数据
			console.log("获取大分类成功:",data)  
			
	},
	});
	$.ajax({
	
	 type: 'POST',
	 url: 'https://www.mygkselss.com/market/apis/get_product_categories' ,
	 cache:false,
	 dataType: "json", 
	 data: formData,
	 processData: false,
	 contentType: false, //data: {key:value}, 
	 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 success: function(data){
	    //函数参数 "data" 为请求成功服务端返回的数据
			console.log("获取产品分类成功:",data)  
			
	},
	});
	
	$.ajax({
	
	 type: 'POST',
	 url: 'https://www.mygkselss.com/market/apis/get_products_by_category/9' ,
	 cache:false,
	 dataType: "json", 
	 data: formData,
	 processData: false,
	 contentType: false, //data: {key:value}, 
	 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 success: function(data){
	    //函数参数 "data" 为请求成功服务端返回的数据
			console.log("获取不知道是啥:",data)  
			
	},
	});
	
	var formDatas = new FormData();
	// formDatas.append('token', setoken);
	formDatas.append('lang', 'ch'); 
	formDatas.append('page', '1'); 
	$.ajax({
	
	 type: 'POST',
	 url: "<?php echo api_url().'get_products';?>",
	 cache:false,
	 dataType: "json", 
	 data: formDatas,
	 processData: false,
	 contentType: false, //data: {key:value}, 
	 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 success: function(data){
	    //函数参数 "data" 为请求成功服务端返回的数据
			console.log("产品列表:",data)  
			
	},
	});
</script>
<?php $this->load->view('default/home_footer')?>