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
	
img {border:0px;}
p{
	-webkit-margin-before: 0em;
	-webkit-margin-after: 0em;
	-webkit-margin-start: 0px;
	-webkit-margin-end: 0px;
}
a{text-decoration: none;color: #1a5178;}
a:hover{text-decoration:none;}
</style>


<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_designertwo.js?date=<?php echo CACHE_USETIME()?>'></script>

<form method="post">
	<table class="gksel_normal_tabpost">
		<tr>
			<td align="right"><?php if($this->langtype == '_ch'){echo '图片';}else{echo 'Picture';}?></td>
			<td>
				<script>
					function toviewdesignertwooriginal(path){
						$('#img1_gksel_show').html('<img style="float:left;max-width:400px;max-height:400px;" src="'+baseurl+path+'" />');
					}
				</script>
				<div class="img_gksel_show" id="img1_gksel_show">
					<div style="float:left;">
						<?php 
							$img1_gksel = '';
							if(file_exists($designertwoinfo['designertwo_pic_800']) && $designertwoinfo['designertwo_pic_800']!=""){
								echo '<img style="float:left;max-width:400px;max-height:400px;" src="'.base_url().$designertwoinfo['designertwo_pic_800'].'" />';
							}
							
							if(file_exists($designertwoinfo['designertwo_pic_original']) && $designertwoinfo['designertwo_pic_original']!=""){
								$img1_gksel = $designertwoinfo['designertwo_pic_original'];
							}
						?>
					</div>
					<div style="float:left;margin-left:10px;">
						<?php if(file_exists($designertwoinfo['designertwo_pic_original']) && $designertwoinfo['designertwo_pic_original']!=""){?>
							<a href="javascript:;" onclick="toviewdesignertwooriginal('<?php echo $designertwoinfo['designertwo_pic_original']?>')"><?php if($this->langtype == '_ch'){echo '查看原图';}else{echo 'View original photo';}?></a>
						<?php }?>
					</div>
				</div>
				<div class="img_gksel_choose" id="img1_gksel_choose">上传图片</div>
				<div style="float:left;"><input type="hidden" id="img1_gksel" name="img1_gksel" value="<?php echo $img1_gksel;?>"/></div>
				<div style="float:left;margin-left:5px;margin-top:5px;"><font class="fonterror" id="img1_gksel_error"><font style="color:gray;">仅支持 Jpg, Png, Gif (1000px * 1000px)</font></div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
			</td>
		</tr>
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			<tbody>
				<tr>
					<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?> <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
					<td align="left">
						<input type="text" name="designertwo_name<?php echo $lancodelist[$lc]['langtype']?>" style="width:300px;" value="<?php echo $designertwoinfo['designertwo_name'.$lancodelist[$lc]['langtype']]?>"/>
						<div class="tipsgroupbox"></div>
					</td>
				</tr>
				<tr style="display:none;">
					<td align="right" width="150"><?php echo lang('dz_designertwo_description')?> <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
					<td align="left">
						<script id="designertwo_description<?php echo $lancodelist[$lc]['langtype']?>" type="text/plain" style="width:800px;height:300px;"><?php echo debaseurlcontent($designertwoinfo['designertwo_description'. $lancodelist[$lc]['langtype']])?></script>
						<script type="text/javascript">
							var designertwo_description<?php echo $lancodelist[$lc]['langtype']?> = UE.getEditor('designertwo_description<?php echo $lancodelist[$lc]['langtype']?>');
						</script>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
					</td>
				</tr>
			</tbody>
		<?php }?>
		<tr>
			<td align="right" width="150"><?php echo lang('cy_status')?></td>
			<td align="left">
				<input name="status" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" <?php if($designertwoinfo['status'] == 1){echo 'checked';}?>/>
			</td>
		</tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_designertwoinfo(<?php echo $designertwoinfo['designertwo_id']?>)"><?php echo lang('cy_save')?></div>
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



$(document).ready(function(){
	var button_gksel1 = $('#img1_gksel_choose'), interval;
	if(button_gksel1.length>0){
		new AjaxUpload(button_gksel1,{
			action: baseurl+'index.php/welcome/uplogo', 
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



	//商品信息---保存
	function tosave_designertwoinfo(designertwo_id){
		var lancodelist = getlancodelist();
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_designertwoinfo('+designertwo_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			
			//----定义的字段------START
			
			
				var GETOBJ = [];
				var GETOBJ_num = 0;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'status';
				GETOBJ[GETOBJ_num]['field_realname'] = 'status';
				GETOBJ[GETOBJ_num]['field_type'] = "checkboxradio";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = L['cy_status'];

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'img1_gksel';
				GETOBJ[GETOBJ_num]['field_realname'] = 'designertwo_pic_original';
				GETOBJ[GETOBJ_num]['field_type'] = "image";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = L['dz_designertwo_picture'];
			//----定义的字段------END
				
			//----定义多语言的字段------START
				var GETLANGOBJ = new Array();
				var GETLANGOBJ_num = 0;
				GETLANGOBJ[GETLANGOBJ_num] = new Array();
				GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'designertwo_name';
				GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
				GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = L['dz_designertwo_name'];

				GETLANGOBJ_num = GETLANGOBJ_num + 1;
				GETLANGOBJ[GETLANGOBJ_num] = new Array();
				GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'designertwo_description';
				GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "ueditor";
				GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = L['dz_designertwo_description'];
			//----定义多语言的字段------END
				
			var returnOBJ = checkjsformcontent(lancodelist, GETOBJ, GETLANGOBJ);//----定义字段变量, 检查是否为空或格式错误------START
			var postOBJ = returnOBJ.postOBJ;
			postOBJ.backurl = backurl;
			postOBJ.GETOBJ = returnOBJ.GETOBJ_arr;
			postOBJ.GETOBJ_type = returnOBJ.GETOBJ_type_arr;
			postOBJ.GETOBJ_realname = returnOBJ.GETOBJ_realname_arr;
			postOBJ.GETLANGOBJ = returnOBJ.GETLANGOBJ_arr;
			
			if(returnOBJ.ispass == 1){
				$.post(baseurl+'index.php/admins/designertwo/edit_designertwo/'+designertwo_id, postOBJ, function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
	//				isajaxsaveing = 0;//ajax正在保存中 --- 释放
					location.href = obj.backurl;
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