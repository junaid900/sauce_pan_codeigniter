<?php $this->load->view('admin/header')?>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_event.js?date=<?php echo CACHE_USETIME()?>'></script>
    <script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<?php $lancodelist = getlancodelist();?>
<form method="post">
	<table class="gksel_normal_tabpost">
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '分类名称';}else{echo 'Category Name';}?> <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
				<td align="left">
					<input type="text" name="category_name<?php echo $lancodelist[$lc]['langtype']?>" style="width:300px;" value="<?php echo $categoryinfo['category_name'.$lancodelist[$lc]['langtype']]?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
		<?php }?>
		<tr>
			<td align="right" width="150"><?php echo lang('cy_status')?></td>
			<td align="left">
				<input name="status" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" <?php if($categoryinfo['status'] == 1){echo 'checked';}?>/>
			</td>
		</tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_eventcategoryinfo(<?php echo $categoryinfo['category_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
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