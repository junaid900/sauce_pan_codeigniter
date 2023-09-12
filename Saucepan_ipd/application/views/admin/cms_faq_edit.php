<?php $this->load->view('admin/header')?>
<script type="text/javascript">
//关键字信息---保存
function tosave_faqinfo(faq_id){
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="tosave_faqinfo('+faq_id+')"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.attr('class', 'gksel_btn_action_off');
		actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
		
		//关键字信息
		var faq_name_en = $('input[name="faq_name_en"]').val();
		var faq_description_en = $('textarea[name="faq_description_en"]').val();
		
		var ispass=1;
		if(ispass == 1){
			$.post(baseurl+'index.php/admins/cms/edit_faq/'+faq_id, {
				//返回url
				backurl: backurl,
				//关键字信息
				faq_name_en: faq_name_en, 
				faq_description_en: faq_description_en,
			},function (data){
				var obj = eval( "(" + data + ")" );
				actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
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
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr>
			<td align="right" width="150">Name</td>
			<td align="left">
				<input type="text" name="faq_name_en" value="<?php echo $faqinfo['faq_name_en']?>"/>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Meal description</td>
			<td align="left">
				<textarea name="faq_description_en" style="width:800px;height:200px;"><?php echo $faqinfo['faq_description_en']?></textarea>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_faqinfo(<?php echo $faqinfo['faq_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>

<?php $this->load->view('admin/footer')?>