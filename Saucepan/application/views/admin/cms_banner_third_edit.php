<?php $this->load->view('admin/header')?>
<?php $lancodelist = getlancodelist();?>


<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/lang/zh-cn/zh-cn.js"></script>
<!--以下两行加载秀米的ueditor插件的脚本和CSS，请编辑您的UEditor网页加入他们-->
<!--您也可以下载这两个文件并根据您的需要改动相关的内容，当然，改动后您必须将新文件存放到您的服务器上了-->
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/xiumi-ue-dialog-v5.js"></script>
<link rel="stylesheet" href="http://xiumi.us/connect/ue/v5/xiumi-ue-v5.css">
<style type="text/css">
	.logo40{vertical-align: middle;}
	.tn-footer{font-size: 0.9em;}
	html, body{font-size:12px;}
</style>


<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_cms_cms.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr <?php if($cmsinfo['cms_id'] != 62 && $cmsinfo['cms_id'] != 102 && $cmsinfo['cms_id'] != 86 && $cmsinfo['cms_id'] != 88 && $cmsinfo['cms_id'] != 97 && $cmsinfo['cms_id'] != 99){echo 'style=""';}?>>
			<td align="right"><?php echo lang('cy_picture')?></td>
			<td>
				<div class="img_gksel_show" id="img1_gksel_show">
					<?php 
						${'img1_gksel'} = $cmsinfo['pic_1'];
					?>
					<img style="float:left;max-width:400px;max-height:400px;" src="<?php echo base_url().${'img1_gksel'}?>" />
				</div>
				<div class="img_gksel_choose" id="img1_gksel_choose">上传图片</div>
				<div style="float:left;"><input type="hidden" id="img1_gksel" name="img1_gksel" value="<?php echo ${'img1_gksel'};?>"/></div>
				<div style="float:left;margin-left:5px;margin-top:5px;"><font class="fonterror" id="img1_gksel_error">
				<font style="color:gray;float: left;margin-top: 3px;">
					仅支持 Jpg, Png,jpeg, Gif 格式 (建议尺寸1920*1280，图片需小于2M需可上传) 
					<?php 
						if($second_id == 6){
							echo '(220 * auto)';
						}else if($second_id == 63){
							echo '(750 * 1334 px)';
						}else if($second_id == 5){
							echo '';
						}else if($second_id == 110){
							echo '(400 * 400 px)';
						}else if($cmsinfo['cms_id'] == 102){
							echo '(270 * auto)';
						}
					?>
					</font>
				</div>
			</td>
		</tr>
		<tr <?php if($parent == 3 || $second_id == 110){echo 'style="display:none;"';}?> style='display:none;'>
			<td align="right" width="150">动画（Animation）</td>
			<td align="left">
				<input type="text" name="cms_link" value="<?php echo debaseurlcontent($cmsinfo['cms_link'])?>" style="width:600px;"/>
			</td>
		</tr>
		
		<tr style="display:none;">
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '短网址';}else{echo 'Short URL';}?></td>
			<td align="left">
				<div style="float:left;">
					<input name="shorturl" style="width:250px;" type="text" value="<?php echo $cmsinfo['shorturl']?>"/>
				</div>
				<div class="tipsgroupbox"><div class="request">*</div></div>
				<div style="float:left;margin-left:10px;margin-top:5px;color:red;">
					数字，小写字母，下划线，中划线，中间不允许有空格
				</div>
				<div style="float:left;margin-left:10px;margin-top:5px;">
					<?php echo base_url().'index.php/cms/'?><span class="shorturl_show"><?php echo $cmsinfo['shorturl']?></span>
				</div>
				
				<script type="text/javascript">
					$(document).ready(function (){
						$('input[name="shorturl"]').keyup(function (){
							$('.shorturl_show').html($(this).val());
						})
					})
				</script>
			</td>
		</tr>
		
		<?php $lancodelist = getlancodelist();?>
		
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			<tr <?php if($parent == 3 && $cmsinfo['cms_id'] != 89 && $cmsinfo['cms_id'] != 90 && $cmsinfo['cms_id'] != 91 && $cmsinfo['cms_id'] != 92 && $cmsinfo['cms_id'] != 93 && $cmsinfo['cms_id'] != 94 && $cmsinfo['cms_id'] != 95 && $cmsinfo['cms_id'] != 97 && $cmsinfo['cms_id'] != 98 && $cmsinfo['cms_id'] != 99){echo 'style="display:none;"';}else{echo 'style="display:none;"';}?>>
				<td align="right" width="150">
				 <?php if($cmsinfo['cms_id'] == 102){?>
					<?php if($this->langtype == '_ch'){echo '地址';}else{echo 'Address';}?>
				<?php }else if($second_id == 5){?>
					<?php if($this->langtype == '_ch'){echo '按钮';}else{echo 'Button';}?>
				<?php }else{?>
					<?php echo lang('cy_name')?>
				<?php }?>
				 (<?php echo $lancodelist[$lc]['langname']?>)</td>
				<td align="left">
					<input type="text" name="cms_name<?php echo $lancodelist[$lc]['langtype']?>" value="<?php echo $cmsinfo['cms_name'.$lancodelist[$lc]['langtype']]?>" style="width:600px;"/>
				</td>
			</tr>
			<tr <?php if($cmsinfo['cms_id'] != 102 && $second_id != 5 && $cmsinfo['cms_id'] != 82 && $second_id != 126  && $cmsinfo['cms_id'] != 86 && $cmsinfo['cms_id'] != 88 && $cmsinfo['cms_id'] != 92 && $cmsinfo['cms_id'] != 93 && $cmsinfo['cms_id'] != 94 && $cmsinfo['cms_id'] != 95 && $cmsinfo['cms_id'] != 98){echo 'style="display:none;"';}?>>
				<td align="right" width="150">
				
					<?php if($cmsinfo['cms_id'] == 102){?>
						<?php if($this->langtype == '_ch'){echo '电话';}else{echo 'Telephone';}?>
					<?php }else if($cmsinfo['cms_id'] == 92 || $cmsinfo['cms_id'] == 93 || $cmsinfo['cms_id'] == 94 || $cmsinfo['cms_id'] == 95){?>
						数值
					<?php }else if($cmsinfo['cms_id'] == 98){?>
						标题
					<?php }else{?>
						<?php if($this->langtype == '_ch'){echo '简介';}else{echo 'Profile';}?>
					<?php }?>
				
					 
					 <?php if(count($lancodelist) > 1){?>(<?php echo $lancodelist[$lc]['langname']?>)<?php }?>
					 <?php if($cmsinfo['cms_id'] == 82){?>
						 <br />(显示在首页)
					 <?php }?>
				 </td>
				<td align="left">
					<textarea name="cms_profile<?php echo $lancodelist[$lc]['langtype']?>" style="<?php if($cmsinfo['cms_id'] == 92 || $cmsinfo['cms_id'] == 93 || $cmsinfo['cms_id'] == 94 || $cmsinfo['cms_id'] == 95 || $cmsinfo['cms_id'] == 98){echo 'width:120px;height:16px;';}else{echo 'width:800px;height:100px;';}?>"><?php echo $cmsinfo['cms_profile'.$lancodelist[$lc]['langtype']]?></textarea>
				</td>
			</tr>
			<tr style="<?php if($parent == 3 && $cmsinfo['cms_id'] != 102 && $cmsinfo['cms_id'] != 89 && $cmsinfo['cms_id'] != 90 && $cmsinfo['cms_id'] != 91 && $cmsinfo['cms_id'] != 92 && $cmsinfo['cms_id'] != 93 && $cmsinfo['cms_id'] != 94 && $cmsinfo['cms_id'] != 95){echo '';}else{echo 'display:none;';}?>">
				<td align="right" width="150"><?php echo lang('cy_description')?> <?php if(count($lancodelist) > 1){?>(<?php echo $lancodelist[$lc]['langname']?>)<?php }?></td>
				<td align="left">
					<script id="cms_description<?php echo $lancodelist[$lc]['langtype']?>" type="text/plain" style="width:800px;height:300px;"><?php echo debaseurlcontent($cmsinfo['cms_description'. $lancodelist[$lc]['langtype']])?></script>
					<script type="text/javascript">
						var cms_description<?php echo $lancodelist[$lc]['langtype']?> = UE.getEditor('cms_description<?php echo $lancodelist[$lc]['langtype']?>');
					</script>
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
				<div class="gksel_btn_action_on" onclick="tosave_bannerinfo_third(<?php echo $parent;?>, <?php echo $second_id;?>, <?php echo $cmsinfo['cms_id'];?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">

//1、window.location.href(设置或获取整个 URL 为字符串)
var jsurl_fullurl = window.location.href;
//返回：http://i.cnblogs.com/EditPosts.aspx?opt=1

//2、window.location.protocol(设置或获取 URL 的协议部分)
var jsurl_protocol = window.location.protocol;
//返回：http:

//3、window.location.host(设置或获取 URL 的主机部分)
var jsurl_host = window.location.host;
//返回：i.cnblogs.com

var jsurl_sp = jsurl_fullurl.split(jsurl_host);

var jsurl_sp2 = jsurl_sp[1];
jsurl_sp2 = jsurl_sp2.split('/');
if(jsurl_sp2[1] != 'admins' && jsurl_sp2[1] != 'index.php'){
	var project_name = jsurl_sp2[1]+'/';
}else{
	var project_name = '';
}
var jsurl_baseurl = jsurl_protocol+'//'+jsurl_host+'/'+project_name;






<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>				
	if(CKEDITOR.instances["cms_description<?php echo $lancodelist[$lc]['langtype']?>"]){
		//判断是否绑定
		CKEDITOR.remove(CKEDITOR.instances["cms_description<?php echo $lancodelist[$lc]['langtype']?>"]); //解除绑定
	}
	CKEDITOR.replace( 'cms_description<?php echo $lancodelist[$lc]['langtype']?>',{
		toolbar :
        [
         [  'Bold',  'Italic', 'Underline',  '-',  'NumberedList',  'BulletedList',  '-','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock','-','Font', 'FontSize', 'TextColor', 'BGColor','Image', 'Table', 'SpecialChar','-',  'Link',  'Unlink','link_rar','link_xls','link_doc','link_ppt','link_pdf','link_pic' ]]
    });
<?php }?>
</script>
<script type="text/javascript">
$(document).ready(function(){
	<?php for($tt=1;$tt<=4;$tt++){?>
	var button_gksel<?php echo $tt;?> = $('#img<?php echo $tt;?>_gksel_choose'), interval;
	if(button_gksel<?php echo $tt;?>.length>0){
		new AjaxUpload(button_gksel<?php echo $tt;?>,{
			
			action: baseurl+'index.php/welcome/uplogo/1920/1080', 
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
					$('#img<?php echo $tt;?>_gksel_show').html('<img style="float:left;max-width:400px;max-height:400px;" src="'+baseurl+pic.logo+'" />');
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