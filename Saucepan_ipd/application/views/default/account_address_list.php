<?php $this->load->view('default/home_header')?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/address.css?date=<?php echo CACHE_USETIME()?>" />
<style>
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
			li {
			    margin-top: 2px;
			    width: auto;
			}
			.features_list{display: flex;justify-content: flex-end;align-items: center;}
			.features_list .boxbtn{width: 50px;display: flex;justify-content: flex-end;align-items: center;}
</style>
<div id="userFacingErrorMessage"></div>
<div id="fader"></div>
<div id="container">
	<div id="contentFrame">
	  <div class="withToolbar container">
		<div class="inside extraSpace backButton" style="margin-top: 58px;" onclick="javascript:history.back(-1);">
			<div class="button medium noFilling" onclick="javascript:history.back(-1);">←
				 
				<?php if($this->langtype == '_ch'){
						echo '上一步';
					}else{
						echo 'Back ';
					}
				?>
			</div>
		</div>
		<div class="new-container">
			<h5 class="withLeftMargin">
				
				<?php if($this->langtype == '_ch'){
						echo '已保存地址';
					}else{
						echo 'Your Saved Addresses ';
					}
				?>
			</h5>
			<div id="addressList">
				<ul class="card-list">
					<div class="card customerAddressObject">
						
					</div>
				</ul>
				<div>
				<a href="<?php echo base_url().'index.php/welcome/address_list_map'?>">
					<button type="submit" class="button clientColor medium fullWidth">
						
						<?php if($this->langtype == '_ch'){
								echo '新地址';
							}else{
								echo 'New Address ';
							}
						?>
					</button>
				</a>
				</div>
			</div>
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
					 $(".loading_bg").fadeOut();
				    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("地址列表:",datas)  
						if(datas.response.addresses==''){
							$(".withLeftMargin").html('')
						}
						for(var i=0;i<datas.response.addresses.length;i++){
							$(".customerAddressObject").append("<div><li class='card-footer address-head customerAddress withChangeButton'><div class='main-address row direction-row'><div class='col col4'><p class='addressType'></p><p onclick='toaction_address_second2("+datas.response.addresses[i].address_id+")'>"+datas.response.addresses[i].city+datas.response.addresses[i].user_address+",<br> "+datas.response.addresses[i].user_address_cs+"</p><div class='features_list'><p class='text_warning boxbtn' style='text-align: right;display:none' onclick='toaction_address_edit("+datas.response.addresses[i].address_id+","+datas.response.addresses[i].token_id+","+datas.response.addresses[i].user_id+")'><img style='width:15px' src='<?php echo base_url().'themes/default/images/edit.png'?>' /></p><p class='text_warning boxbtn' style='text-align: right;margin-left:10px;' onclick='toaction_address_second("+datas.response.addresses[i].address_id+","+datas.response.addresses[i].token_id+","+datas.response.addresses[i].user_id+")'><img style='width:15px' src='<?php echo base_url().'themes/default/images/delete.png'?>' /></p></div></div></div></li></div>")
						}
				},
				});
				
			}
			
	},
	});
	
	function toaction_address_second(obj,setoken,user_id) {
		$(".loading_bg").show();
		var formData2 = new FormData();
		formData2.append('token', setoken);
		formData2.append('address_id', obj);
		formData2.append('user_id', user_id);
		$.ajax({
		
		 type: 'POST',
		 url: "<?php echo api_url().'delete_user_addresses';?>",
		 cache:false,
		 dataType: "json", 
		 data: formData2,
		 processData: false,
		 contentType: false, //data: {key:value}, 
		 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		 success: function(datas){
		    //函数参数 "data" 为请求成功服务端返回的数据
				console.log("删除成功:",datas)  
				window.location.reload()//刷新当前页面.
		},
		});
	}
	function toaction_address_edit(obj,setoken,user_id) {
		$(".loading_bg").show();
		var formData2 = new FormData();
		formData2.append('token', setoken);
		formData2.append('address_id', obj);
		formData2.append('user_id', user_id);
		$.ajax({
		
		 type: 'POST',
		 url: "<?php echo api_url().'delete_user_addresses';?>",
		 cache:false,
		 dataType: "json", 
		 data: formData2,
		 processData: false,
		 contentType: false, //data: {key:value}, 
		 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		 success: function(datas){
		    //函数参数 "data" 为请求成功服务端返回的数据
				console.log("删除成功:",datas)  
				window.location.reload()//刷新当前页面.
		},
		});
	}
	
</script>
<?php $this->load->view('default/home_footer')?>