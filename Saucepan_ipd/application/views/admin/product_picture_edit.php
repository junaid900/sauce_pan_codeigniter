<?php $this->load->view('admin/header')?>
<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_product.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr>
			<td align="right"><?php echo lang('cy_picture')?></td>
			<td>
				<script>
					function toviewproductoriginal(path){
						$('#img1_gksel_show').html('<img style="float:left;max-width:400px;max-height:400px;" src="'+baseurl+path+'" />');
					}
				</script>
				<div class="img_gksel_show" id="img1_gksel_show">
					<?php 
						$img1_gksel = '';
						if(file_exists($pictureinfo['picture_pic_800']) && $pictureinfo['picture_pic_800']!=""){
							echo '<img style="float:left;max-width:400px;max-height:400px;" src="'.base_url().$pictureinfo['picture_pic_800'].'" />';
						}
						
						if(file_exists($pictureinfo['picture_pic_original']) && $pictureinfo['picture_pic_original']!=""){
							$img1_gksel = $pictureinfo['picture_pic_original'];
						}
					?>
					<?php if(file_exists($pictureinfo['picture_pic_original']) && $pictureinfo['picture_pic_original']!=""){?>
						<a href="javascript:;" onclick="toviewproductoriginal('<?php echo $pictureinfo['picture_pic_original']?>')"><?php if($this->langtype == '_ch'){echo '查看原图';}else{echo 'View original photo';}?></a>
					<?php }?>
				</div>
				<div class="img_gksel_choose" id="img1_gksel_choose">上传图片</div>
				<div style="float:left;"><input type="hidden" id="img1_gksel" name="img1_gksel" value="<?php echo $img1_gksel;?>"/></div>
				<div style="float:left;margin-left:5px;margin-top:5px;"><font class="fonterror" id="img1_gksel_error"><font style="color:gray;">仅支持 Jpg, Png, Gif 格式 (800px * 800px)</font></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php echo lang('cy_name')?> (English)</td>
			<td align="left">
				<input type="text" name="picture_name_en" value="<?php echo $pictureinfo['picture_name_en']?>"/>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php echo lang('cy_name')?> (中文)</td>
			<td align="left">
				<input type="text" name="picture_name_ch" value="<?php echo $pictureinfo['picture_name_ch']?>"/>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_pictureinfo(<?php echo $product_id?>, <?php echo $pictureinfo['picture_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
function tosave_pictureinfo(product_id, picture_id){
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="tosave_pictureinfo('+product_id+', '+picture_id+')"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		var subbackurl = $('input[name="subbackurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.attr('class', 'gksel_btn_action_off');
		actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
		
		//商品分类信息
		var img1_gksel = $('input[name="img1_gksel"]').val();
		var picture_name_en = $('input[name="picture_name_en"]').val();
		var picture_name_ch = $('input[name="picture_name_ch"]').val();
		
		var ispass=1;
		
		if(ispass == 1){
			$.post(baseurl+'index.php/admins/product/edit_picture/'+product_id+'/'+picture_id, {
				//返回url
				backurl: backurl,
				subbackurl: subbackurl,
				//商品分类信息
				picture_name_en: picture_name_en,
				picture_name_ch: picture_name_ch,
				img1_gksel: img1_gksel
			},function (data){
				var obj = eval( "(" + data + ")" );
				actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
				location.href = obj.subbackurl;
			})
		}else{
			actionsubmit_button.attr('class', 'gksel_btn_action_on');
			actionsubmit_button.html(L['cy_save']);
			isajaxsaveing = 0;//ajax正在保存中 --- 释放
		}
	}
}

$(document).ready(function(){
	var button_gksel1 = $('#img1_gksel_choose'), interval;
	if(button_gksel1.length>0){
		new AjaxUpload(button_gksel1,{
			action: baseurl+'index.php/welcome/uplogo_deng/2000/2000', 
			name: 'logo',onSubmit : function(file, ext){
				if (ext && /^(jpg|png|gif)$/.test(ext)){
					button_gksel1.text('上传中');
					this.disable();
					interval = window.setInterval(function(){
						var text = button_gksel1.text();
						if (text.length < 13){
							button_gksel1.text(text + '.');					
						} else {
							button_gksel1.text('上传中');				
						}
					}, 200);
				} else {
					$('#img1_gksel_error').html('上传失败');
					return false;
				}
			},
			onComplete: function(file, response){
				button_gksel1.text('上传图片');						
				window.clearInterval(interval);
				this.enable();
				if(response=='false'){
					$('#img1_gksel_error').html('上传失败');
				}else{
					var pic = eval("("+response+")");
					$('#img1_gksel_show').html('<img style="float:left;max-width:400px;max-height:400px;" src="'+baseurl+pic.logo+'" />');
					$('#img1_gksel').attr('value',pic.logo);
					$('#img1_gksel_error').html('');
				}	
			}
		});
	}
})
</script>
<?php $this->load->view('admin/footer')?>