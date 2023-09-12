<?php $this->load->view('admin/header')?>
<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_cms_cms.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost">
		<?php $lancodelist = getlancodelist();?>
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			<tr>
				<td align="right"><?php echo lang('cy_picture')?></td>
				<td>
					<div class="img_gksel_show" id="img<?php echo ($lc+1)?>_gksel_show">
						<?php 
							${'img'.($lc+1).'_gksel'} = $cmsinfo['pic_1'.$lancodelist[$lc]['langtype']];
							echo '<img style="float:left;max-width:700px;max-height:700px;" src="'.base_url().${'img'.($lc+1).'_gksel'}.'"/>';
						?>
					</div>
					<div class="img_gksel_choose" id="img<?php echo ($lc+1)?>_gksel_choose">上传图片</div>
					<div style="float:left;"><input type="hidden" id="img<?php echo ($lc+1)?>_gksel" name="img<?php echo ($lc+1)?>_gksel" value="<?php echo ${'img'.($lc+1).'_gksel'};?>"/></div>
					<div style="float:left;margin-left:5px;margin-top:5px;"><font class="fonterror" id="img<?php echo ($lc+1)?>_gksel_error"><font style="color:gray;">仅支持 Jpg, Png, Gif 格式 <?php if($parentinfo['cms_id'] == 71){echo ' (1920 * 650 px)';}else{echo ' (1920 * 500 px)';}?></font></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('cy_name')?> (<?php echo $lancodelist[$lc]['langname']?>)</td>
				<td align="left">
					<input type="text" name="cms_name<?php echo $lancodelist[$lc]['langtype']?>" value="" style="width:600px;"/>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('cy_description')?> (<?php echo $lancodelist[$lc]['langname']?>)</td>
				<td align="left">
					<textarea name="cms_description<?php echo $lancodelist[$lc]['langtype']?>" style="width:800px;height:80px;"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
				</td>
			</tr>
		<?php }?>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl?>"/>
				<input name="subbackurl" type="hidden" value="<?php echo $subbackurl?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="toadd_bannerinfo(<?php echo $parent;?>)"><?php echo lang('cy_save')?></div>
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
			<?php if($parentinfo['cms_id'] == 71){?>
			action: baseurl+'index.php/welcome/uplogo/1920/650', 
			<?php }else{?>
			action: baseurl+'index.php/welcome/uplogo/1920/500', 
			<?php }?>
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