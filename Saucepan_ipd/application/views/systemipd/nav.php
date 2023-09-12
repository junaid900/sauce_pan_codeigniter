

<?php 
$menu = $this->session->userdata('menu');
$lang = $this->session->userdata('lang');

$get_str='';
if($_GET){
	$arr = geturlparmersGETS();
	for($i=0;$i<count($arr);$i++){
		if(isset($_GET[$arr[$i]])){
			if($get_str!=""){$get_str .='&';}else{$get_str .='?';}
			$get_str .=$arr[$i].'='.$_GET[$arr[$i]];
		}
	}
}
$current_url_encode = str_replace('/','slash_tag',base64_encode(current_url().$get_str));
?>
<div class="ipd_header_menu flex-row justify-between align-center" style="    align-items: flex-start;">
	<div class="left_box flex-row justify-start align-center" style="flex-wrap: wrap;">
		<div class="box flex-row justify-center align-center      <?php if($menu == 'home'){echo 'menu_ons';}else{echo 'menu_offs';}?>"  onclick="javascript:location.href='<?php echo base_url().'index.php/welcome'?>';" >
			
			<?php
					if($this->langtype == '_ch'){
						echo '点单';
					}else{
						echo 'Walk-In';
					}
			?>
		</div>
		<div class="box flex-row justify-center align-center <?php if($menu == 'order'){echo 'menu_ons';}else{echo 'menu_offs';}?>" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/systemipd_order'?>';">
			<?php 
					if($this->langtype == '_ch'){
						echo '订单';
					}else{
						echo 'Orders';
					}
			?>
		</div>
		<div class="box flex-row justify-center align-center  <?php if($menu == 'order_preorder'){echo 'menu_ons';}else{echo 'menu_offs';}?> preorder_btn_box" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/systemipd_order_preorder'?>';">
			<?php 
					if($this->langtype == '_ch'){
						echo '预购';
					}else{
						echo 'Preorder';
					}
			?>
			<div class="preorder_btn_position" style="position: absolute;top:-10px;right:-10px;width: 30px;height: 30px;line-height: 30px;border-radius: 50%;background-color: #06AACF;color: white;font-size: 12px;display: none;">
				
			</div>
		</div>
		<div class="box flex-row justify-center align-center <?php if($menu == 'order_history'){echo 'menu_ons';}else{echo 'menu_offs';}?>" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/systemipd_order_history'?>';">
            <?php
            if($this->langtype == '_ch'){
                echo '历史订单';
            }else{
                echo 'History';
            }
            ?>
        </div>
        <div class="box flex-row justify-center align-center <?php if($menu == 'customers'){echo 'menu_ons';}else{echo 'menu_offs';}?>" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/systemipd_customers'?>';">
            <?php
            if($this->langtype == '_ch'){
                echo '用户管理';
            }else{
                echo 'Customer ';
            }
            ?>
        </div>
        <div class="box flex-row justify-center align-center <?php if($menu == 'products'){echo 'menu_ons';}else{echo 'menu_offs';}?>" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/systemipd_products'?>';">
            <?php
            if($this->langtype == '_ch'){
                echo '产品管理';
            }else{
                echo 'Product';
            }
            ?>
        </div>
        <div class="box flex-row justify-center align-center <?php if($menu == 'attributes'){echo 'menu_ons';}else{echo 'menu_offs';}?>" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/systemipd_attributes'?>';" style="">
            <?php
            if($this->langtype == '_ch'){
                echo '产品管理';
            }else{
                echo 'Attribtues';
            }
            ?>
        </div>
	</div>
	<div class="right_box">
		<div class="delete_cart monthdelete_cart">
			<img style='width:27px' src="<?php echo base_url().'themes/default/images/delete.png'?>" />
		</div>
	</div>
</div>
<div class="language_box">
	<?php if($lang == 'en'){?>
				<a href="<?php echo base_url().'index.php/welcome/changelanguage/ch/'.$current_url_encode?>" class="cn_text text">
					中
				</a>
			<?php }else{?>
				
				<a href="<?php echo base_url().'index.php/welcome/changelanguage/en/'.$current_url_encode?>" class="en_text text">
					EN
				</a>
			<?php }?>
	
	
</div>
<script>
	$(".monthdelete_cart").click(function(){
		console.log(11)

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
					 url: "<?php echo api_url().'clear_cart';?>",
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
	var data = {};
	$.ajax({
	    type: 'POST',
	    url: "<?php echo api_url();?>"+"get_sp_orders/pre",
	    cache:false,
	    dataType: "json",
	    data: data,
	    processData: false,
	    contentType: false, //data: {key:value},
	    headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
	    success: function(data){
			if(data.response !=""){
				$(".preorder_btn_box").css("cssText", "background-color:#F20458 !important;color:white !important;position:relative;");
				$(".preorder_btn_position").css("display","block")
				$(".preorder_btn_position").text(data.response.length);
			}
			}
	})
</script>