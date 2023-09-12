<?php $this->load->view('admin/header')?>
<?php $lancodelist = getlancodelist();?>
<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_contactus.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost">
		<?php if($contactusinfo['contactus_name'] != ''){?>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></td>
				<td align="left">
					<?php 
						echo $contactusinfo['contactus_name'];
					?>
				</td>
			</tr>
		<?php }?>
		<?php if($contactusinfo['contactus_phone'] != ''){?>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '电话';}else{echo 'Phone';}?></td>
				<td align="left">
					<?php 
						echo $contactusinfo['contactus_phone'];
					?>
				</td>
			</tr>
		<?php }?>
		<?php if($contactusinfo['created'] != ''){?>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '提交时间';}else{echo 'created';}?></td>
				<td align="left">
					<?php echo date('Y-m-d', $contactusinfo['created']).' '.date('H:i:s', $contactusinfo['created'])?>
				</td>
			</tr>
		<?php }?>
		<?php if($contactusinfo['contactus_email'] != ''){?>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '邮箱';}else{echo 'Email';}?></td>
				<td align="left">
					<?php 
						echo $contactusinfo['contactus_email'];
					?>
				</td>
			</tr>
		<?php }?>
		<?php if($contactusinfo['contactus_company'] != ''){?>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '公司';}else{echo 'Company';}?></td>
				<td align="left">
					<?php 
						echo $contactusinfo['contactus_company'];
					?>
				</td>
			</tr>
		<?php }?>
		<?php if($contactusinfo['contactus_country'] != ''){?>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '国家';}else{echo 'Country';}?></td>
				<td align="left">
					<?php 
						echo $contactusinfo['contactus_country'];
					?>
				</td>
			</tr>
		<?php }?>
		<?php if($contactusinfo['contactus_question'] != ''){?>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '问题';}else{echo 'Question';}?></td>
				<td align="left">
					<?php 
						echo $contactusinfo['contactus_question'];
					?>
				</td>
			</tr>
		<?php }?>
		<tr>
			<td colspan="2">
				<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
//商品信息---保存
function tosave_purchaseenquiryinfo(contactus_id){
	var lancodelist = getlancodelist();
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="tosave_purchaseenquiryinfo('+contactus_id+')"]');
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
			GETOBJ[GETOBJ_num]['field_name'] = 'form_content';
			GETOBJ[GETOBJ_num]['field_realname'] = 'form_content';
			GETOBJ[GETOBJ_num]['field_type'] = "textarea";
			GETOBJ[GETOBJ_num]['field_CMNAME'] = 'form_content';

			
		//----定义的字段------END
			
		//----定义多语言的字段------START
			var GETLANGOBJ = new Array();
			var GETLANGOBJ_num = 0;
		//----定义多语言的字段------END
		
		
		var returnOBJ = checkjsformcontent(lancodelist, GETOBJ, GETLANGOBJ);//----定义字段变量, 检查是否为空或格式错误------START
		var postOBJ = returnOBJ.postOBJ;
		postOBJ.backurl = backurl;
		postOBJ.GETOBJ = returnOBJ.GETOBJ_arr;
		postOBJ.GETOBJ_type = returnOBJ.GETOBJ_type_arr;
		postOBJ.GETOBJ_realname = returnOBJ.GETOBJ_realname_arr;
		postOBJ.GETLANGOBJ = returnOBJ.GETLANGOBJ_arr;
		
		if(returnOBJ.ispass == 1){
			$.post(baseurl+'index.php/admins/contactus/edit_contactus/'+contactus_id, postOBJ, function (data){
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