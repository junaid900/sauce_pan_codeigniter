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
		<tr <?php if($cmsinfo['cms_id'] != 63 && $cmsinfo['cms_id'] != 83 && $cmsinfo['cms_id'] != 85 && $cmsinfo['cms_id'] != 87 && $cmsinfo['cms_id'] != 100 && $cmsinfo['cms_id'] != 101){echo 'style="display:none;"';}?>>
			<td width="150" align="right">
				<?php if($cmsinfo['cms_id'] == 63){?>
					策士微信公众号
				<?php }else if($cmsinfo['cms_id'] == 100){?>
					图片
				<?php }else if($cmsinfo['cms_id'] == 101){?>
					QQ二维码
				<?php }else{?>
					<?php echo lang('cy_picture')?>
				<?php }?>
			</td>
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
				<font style="color:gray;">
					仅支持 Jpg, Png, Gif 格式 
					</font>
				</div>
			</td>
		</tr>
		<tr <?php if($cmsinfo['cms_id'] != 63 && $cmsinfo['cms_id'] != 101){echo 'style="display:none;"';}?>>
			<td align="right">
				<?php if($cmsinfo['cms_id'] == 63){?>
					咨询创意总监
				<?php }else if($cmsinfo['cms_id'] == 101){?>
					微信二维码
				<?php }else{?>
					<?php echo lang('cy_picture')?>
				<?php }?>
			</td>
			<td>
				<div class="img_gksel_show" id="img2_gksel_show">
					<?php 
						${'img2_gksel'} = $cmsinfo['pic_2'];
					?>
					<img style="float:left;max-width:400px;max-height:400px;" src="<?php echo base_url().${'img2_gksel'}?>" />
				</div>
				<div class="img_gksel_choose" id="img2_gksel_choose">上传图片</div>
				<div style="float:left;"><input type="hidden" id="img2_gksel" name="img2_gksel" value="<?php echo ${'img2_gksel'};?>"/></div>
				<div style="float:left;margin-left:5px;margin-top:5px;"><font class="fonterror" id="img2_gksel_error">
				<font style="color:gray;">
					仅支持 Jpg, Png, Gif 格式 
					</font>
				</div>
			</td>
		</tr>
		<tr <?php if($parent == 3 || $cmsinfo['cms_id'] == 100){echo 'style="display:none;"';}?>>
			<td align="right" width="150">链接</td>
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
		
		<tr <?php if($cmsinfo['cms_id'] == 63 || $cmsinfo['cms_id'] == 101){}else{echo 'style="display:none;"';}?>>
			<td align="right" width="150">
				<?php if($cmsinfo['cms_id'] == 63){?>
					公司名称
				<?php }else if($cmsinfo['cms_id'] == 101){?>
					咨询热线
				<?php }?>
			</td>
			<td align="left">
				<input type="text" name="input_1" value="<?php echo debaseurlcontent($cmsinfo['input_1'])?>" style="width:600px;"/>
			</td>
		</tr>
		
		<tr <?php if($cmsinfo['cms_id'] == 63 || $cmsinfo['cms_id'] == 101){}else{echo 'style="display:none;"';}?>>
			<td align="right" width="150">
				<?php if($cmsinfo['cms_id'] == 63){?>
					公司地址
				<?php }else if($cmsinfo['cms_id'] == 101){?>
					邮箱
				<?php }?>
			</td>
			<td align="left">
				<input type="text" name="input_2" value="<?php echo debaseurlcontent($cmsinfo['input_2'])?>" style="width:600px;"/>
			</td>
		</tr>
		
		<tr <?php if($cmsinfo['cms_id'] == 63){}else{echo 'style="display:none;"';}?>>
			<td align="right" width="150">电话</td>
			<td align="left">
				<input type="text" name="input_3" value="<?php echo debaseurlcontent($cmsinfo['input_3'])?>" style="width:600px;"/>
			</td>
		</tr>
		
		<tr <?php if($cmsinfo['cms_id'] == 63){}else{echo 'style="display:none;"';}?>>
			<td align="right" width="150">手机</td>
			<td align="left">
				<input type="text" name="input_4" value="<?php echo debaseurlcontent($cmsinfo['input_4'])?>" style="width:600px;"/>
			</td>
		</tr>
		
		<tr <?php if($cmsinfo['cms_id'] == 63){}else{echo 'style="display:none;"';}?>>
			<td align="right" width="150">QQ</td>
			<td align="left">
				<input type="text" name="input_5" value="<?php echo debaseurlcontent($cmsinfo['input_5'])?>" style="width:600px;"/>
			</td>
		</tr>
		
		<tr <?php if($cmsinfo['cms_id'] == 63){}else{echo 'style="display:none;"';}?>>
			<td align="right" width="150">经度</td>
			<td align="left">
				<input type="text" name="input_6" value="<?php echo debaseurlcontent($cmsinfo['input_6'])?>" style="width:600px;"/>
			</td>
		</tr>
		
		<tr <?php if($cmsinfo['cms_id'] == 63){}else{echo 'style="display:none;"';}?>>
			<td align="right" width="150">纬度</td>
			<td align="left">
				<input type="text" name="input_7" value="<?php echo debaseurlcontent($cmsinfo['input_7'])?>" style="width:600px;"/>
			</td>
		</tr>
		
		
		
		
		
		
		<?php $lancodelist = getlancodelist();?>
		
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			<tr <?php if($parent == 3 || $cmsinfo['cms_id'] == 100){echo 'style="display:none;"';}?>>
				<td align="right" width="150">
				 <?php if($cmsinfo['cms_id'] == 102){?>
					<?php if($this->langtype == '_ch'){echo '地址';}else{echo 'Address';}?>
				<?php }else{?>
					<?php echo lang('cy_name')?>
				<?php }?>
				 (<?php echo $lancodelist[$lc]['langname']?>)</td>
				<td align="left">
					<input type="text" name="cms_name<?php echo $lancodelist[$lc]['langtype']?>" value="<?php echo $cmsinfo['cms_name'.$lancodelist[$lc]['langtype']]?>" style="width:600px;"/>
				</td>
			</tr>
			<tr <?php if($cmsinfo['cms_id'] != 81 && $cmsinfo['cms_id'] != 83 && $cmsinfo['cms_id'] != 85 && $cmsinfo['cms_id'] != 87 && $cmsinfo['cms_id'] != 100){echo 'style="display:none;"';}?>>
				<td align="right" width="150">
				
					<?php if($cmsinfo['cms_id'] == 102){?>
						<?php if($this->langtype == '_ch'){echo '电话';}else{echo 'Telephone';}?>
					<?php }else if($cmsinfo['cms_id'] == 100){?>
						标题
					<?php }else{?>
						<?php if($this->langtype == '_ch'){echo '简介';}else{echo 'Profile';}?>
					<?php }?>
				
					 
					 <?php if(count($lancodelist) > 1){?>(<?php echo $lancodelist[$lc]['langname']?>)<?php }?>
					 <?php if($cmsinfo['cms_id'] == 81){?>
						 <br />(显示在首页)
					 <?php }?>
				 </td>
				<td align="left">
					<textarea name="cms_profile<?php echo $lancodelist[$lc]['langtype']?>" style="<?php if($cmsinfo['cms_id'] == 100){echo 'width:600px;height:25px;';}else{echo 'width:800px;height:100px;';}?>"><?php echo $cmsinfo['cms_profile'.$lancodelist[$lc]['langtype']]?></textarea>
				</td>
			</tr>
			<tr style="<?php if($parent == 3 && $cmsinfo['cms_id'] != 63 && $cmsinfo['cms_id'] != 101){echo '';}else{echo 'display:none;';}?>">
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
					<div style="float:left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
				</td>
			</tr>
		<?php }?>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl?>"/>
				<input name="subbackurl" type="hidden" value="<?php echo $subbackurl?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_bannerinfo_sub(<?php echo $parent;?>, <?php echo $cmsinfo['cms_id'];?>)"><?php echo lang('cy_save')?></div>
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



</script>
<script type="text/javascript">
$(document).ready(function(){
	<?php for($tt=1;$tt<=4;$tt++){?>
	var button_gksel<?php echo $tt;?> = $('#img<?php echo $tt;?>_gksel_choose'), interval;
	if(button_gksel<?php echo $tt;?>.length>0){
		new AjaxUpload(button_gksel<?php echo $tt;?>,{
			<?php if($cmsinfo['cms_id'] == 102){?>
				action: baseurl+'index.php/welcome/uplogo_deng/800/800', 
			<?php }else{?>
				action: baseurl+'index.php/welcome/uplogo', 
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
					$('#img<?php echo $tt;?>_gksel_show').html('<img style="float:left;max-width:400px;max-height:400px;" src="'+baseurl+pic.logo+'" />');
					$('#img<?php echo $tt;?>_gksel').attr('value',pic.logo);
					$('#img<?php echo $tt;?>_gksel_error').html('');
				}	
			}
		});
	}
<?php }?>
})


	//banner信息---添加
	function tosave_bannerinfo_sub(parent, cms_id){
		var lancodelist = getlancodelist();
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_bannerinfo_sub('+parent+', '+cms_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			var subbackurl = $('input[name="subbackurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			
			//----定义的字段------START
				var GETOBJ = [];
				var GETOBJ_num = 0;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'img1_gksel';
				GETOBJ[GETOBJ_num]['field_realname'] = 'pic_1';
				GETOBJ[GETOBJ_num]['field_type'] = "image";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = 'Logo';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'img2_gksel';
				GETOBJ[GETOBJ_num]['field_realname'] = 'pic_2';
				GETOBJ[GETOBJ_num]['field_type'] = "image";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '链接';
				
				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'cms_link';
				GETOBJ[GETOBJ_num]['field_realname'] = 'cms_link';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '链接';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'shorturl';
				GETOBJ[GETOBJ_num]['field_realname'] = 'shorturl';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '短网址';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'input_1';
				GETOBJ[GETOBJ_num]['field_realname'] = 'input_1';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'input_2';
				GETOBJ[GETOBJ_num]['field_realname'] = 'input_2';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'input_3';
				GETOBJ[GETOBJ_num]['field_realname'] = 'input_3';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'input_4';
				GETOBJ[GETOBJ_num]['field_realname'] = 'input_4';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'input_5';
				GETOBJ[GETOBJ_num]['field_realname'] = 'input_5';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'input_6';
				GETOBJ[GETOBJ_num]['field_realname'] = 'input_6';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'input_7';
				GETOBJ[GETOBJ_num]['field_realname'] = 'input_7';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';
			//----定义的字段------END
			
			//----定义多语言的字段------START
				var GETLANGOBJ = new Array();
				var GETLANGOBJ_num = 0;
				GETLANGOBJ[GETLANGOBJ_num] = new Array();
				GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_name';
				GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
				GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = 'Name';

				GETLANGOBJ_num = GETLANGOBJ_num + 1;
				GETLANGOBJ[GETLANGOBJ_num] = new Array();
				GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_profile';
				GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "textarea";
				GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '';

				GETLANGOBJ_num = GETLANGOBJ_num + 1;
				GETLANGOBJ[GETLANGOBJ_num] = new Array();
				GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_description';
				GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "ueditor";
				GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '描述';
			//----定义多语言的字段------END
				
			var returnOBJ = checkjsformcontent(lancodelist, GETOBJ, GETLANGOBJ);//----定义字段变量, 检查是否为空或格式错误------START
			var postOBJ = returnOBJ.postOBJ;
			postOBJ.backurl = backurl;
			postOBJ.subbackurl = subbackurl;
			postOBJ.GETOBJ = returnOBJ.GETOBJ_arr;
			postOBJ.GETOBJ_type = returnOBJ.GETOBJ_type_arr;
			postOBJ.GETOBJ_realname = returnOBJ.GETOBJ_realname_arr;
			postOBJ.GETLANGOBJ = returnOBJ.GETLANGOBJ_arr;
			if(returnOBJ.ispass == 1){
				$.post(baseurl+'index.php/admins/cms/edit_sub_banner/'+parent+'/'+cms_id, postOBJ, function (data){
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
</script>
<?php $this->load->view('admin/footer')?>