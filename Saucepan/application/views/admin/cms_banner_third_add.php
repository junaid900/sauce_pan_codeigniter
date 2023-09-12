<?php $this->load->view('admin/header')?>
<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_cms_cms.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr >
			<td align="right" style="width: 100px;"><?php echo lang('cy_picture')?></td>
			<td >
				<div class="img_gksel_show" id="img1_gksel_show">
					<?php 
						${'img1_gksel'} = '';
					?>
				</div>
				<div class="img_gksel_choose" id="img1_gksel_choose">上传图片</div>
				<div style="float:left;"><input type="hidden" id="img1_gksel" name="img1_gksel" value="<?php echo ${'img1_gksel'};?>"/></div>
				<div style="float:left;margin-left:5px;margin-top:5px;"><font class="fonterror" id="img1_gksel_error"><font style="color:gray;">
				
				仅支持 Jpg, Png,jpeg, Gif 格式 (建议尺寸1920*1280，图片需小于2M需可上传) 
				
				<?php 
					if($second_id == 6){
						echo '(220 * auto)';
					}else if($second_id == 63){
						echo '(750 * 1334 px)';
					}else if($second_id == 5){
						echo '(2000 * 445 px)';
					}
				?>
				
				
				</font></div>
			</td>
		</tr>
		<tr style="display: none;">
			<td align="right" width="150">链接</td>
			<td align="left">
				<input type="text" name="cms_link" value="" style="width:600px;"/>
			</td>
		</tr>
		<?php $lancodelist = getlancodelist();?>
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			
			<tr style="display: none;">
				<td align="right" width="150">
					<?php 								if($this->langtype == '_ch'){									echo '简介';								}else{									echo 'Profile';								}						?>
				</td>
				<td align="left">
					<input type="text" name="cms_name<?php echo $lancodelist[$lc]['langtype']?>" value="" style="width:600px;"/>
				</td>
			</tr>
			<tr style="display: none;">
				<td align="right" width="150"><?php 								if($this->langtype == '_ch'){									echo '简介';								}else{									echo 'Profile';								}						?></td>
				<td align="left" >
					<textarea name="cms_profile<?php echo $lancodelist[$lc]['langtype']?>" style="width:600px;"/> </textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div style="float: left;width:100%;margin:15px 0px;"></div>
				</td>
			</tr>
		<?php }?>
		<tr style="border-top:1px solid #ccc;">
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl?>"/>
				<input name="subbackurl" type="hidden" value="<?php echo $subbackurl?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="toadd_bannerinfo_third(<?php echo $parent;?>, <?php echo $second_id;?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
$(document).ready(function(){
	<?php for($tt=1;$tt<=4;$tt++){?>
	var button_gksel<?php echo $tt;?> = $('#img<?php echo $tt;?>_gksel_choose'), interval;
	if(button_gksel<?php echo $tt;?>.length>0){
		new AjaxUpload(button_gksel<?php echo $tt;?>,{
			
				action: baseurl+'index.php/welcome/uplogo_deng/1920/1080', 
			
			name: 'logo',onSubmit : function(file, ext){
				if (ext && /^(jpg|png|jpeg|gif)$/.test(ext)){
					button_gksel<?php echo $tt;?>.text('上传中');
					this.disable();
					interval = window.setInterval(function(){
						var text = button_gksel<?php echo $tt;?>.text();
						if (text.length < 13){
							button_gksel<?php echo $tt;?>.text(text + '.');					
						} else {
							button_gksel<?php echo $tt;?>.text('上传中');				
						}
					}, 200);

				} else {
					$('#img<?php echo $tt;?>_gksel_error').html('上传失败');
					return false;
				}
			},
			onComplete: function(file, response){
				button_gksel<?php echo $tt;?>.text('选择图片');						
				window.clearInterval(interval);
				this.enable();
				if(response=='false'){
					$('#img<?php echo $tt;?>_gksel_error').html('上传失败');
				}else{
					var pic = eval("("+response+")");
					$('#img<?php echo $tt;?>_gksel_show').html('<img id="thumbnail" style="float:left;max-width:400px;max-height:400px;" src="'+baseurl+pic.logo+'" />');
					$('#img<?php echo $tt;?>_gksel').attr('value',pic.logo);
					$('#img<?php echo $tt;?>_gksel_error').html('');
				}	
			}
		});
	}
<?php }?>
})
</script>
<?php $this->load->view('admin/footer')?>