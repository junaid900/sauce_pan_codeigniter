<?php $this->load->view('admin/header')?>
<script type='text/javascript' src='<?php echo base_url()?>ckeditor/ckeditor.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_cms_cms.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr>
			<td align="right" width="150"><?php echo lang('cy_name')?> (English)</td>
			<td align="left">
				<input type="text" name="cms_name_en" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php echo lang('cy_name')?> (中文)</td>
			<td align="left">
				<input type="text" name="cms_name_ch" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php echo lang('cy_description')?> (English)</td>
			<td align="left">
				<textarea name="cms_description_en"></textarea>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php echo lang('cy_description')?> (中文)</td>
			<td align="left">
				<textarea name="cms_description_ch"></textarea>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="toadd_cmsinfo()"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
	if(CKEDITOR.instances["cms_description_en"]){
		//判断是否绑定
		CKEDITOR.remove(CKEDITOR.instances["cms_description_en"]); //解除绑定
	}
	CKEDITOR.replace( 'cms_description_en',{
		toolbar :
        [
         [  'Bold',  'Italic', 'Underline',  '-',  'NumberedList',  'BulletedList',  '-','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock','-','Font', 'FontSize', 'TextColor', 'BGColor','Image', 'Table', 'SpecialChar','-',  'Link',  'Unlink','link_rar','link_xls','link_doc','link_ppt','link_pdf','link_pic' ]]
    });


	if(CKEDITOR.instances["cms_description_ch"]){
		//判断是否绑定
		CKEDITOR.remove(CKEDITOR.instances["cms_description_ch"]); //解除绑定
	}
	CKEDITOR.replace( 'cms_description_ch',{
		toolbar :
        [
         [  'Bold',  'Italic', 'Underline',  '-',  'NumberedList',  'BulletedList',  '-','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock','-','Font', 'FontSize', 'TextColor', 'BGColor','Image', 'Table', 'SpecialChar','-',  'Link',  'Unlink','link_rar','link_xls','link_doc','link_ppt','link_pdf','link_pic' ]]
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
	var button_gksel1 = $('#img1_gksel_choose'), interval;
	if(button_gksel1.length>0){
		new AjaxUpload(button_gksel1,{
			action: baseurl+'index.php/welcome/uplogo/800/800', 
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