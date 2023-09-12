<?php $this->load->view('admin/header')?>
<script type="text/javascript">
//关键字信息---保存
function tosave_dishinfo(dish_id){
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="tosave_dishinfo('+dish_id+')"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.attr('class', 'gksel_btn_action_off');
		actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
		
		//关键字信息
		var dish_name_en = $('input[name="dish_name_en"]').val();
		var dish_description_en = $('textarea[name="dish_description_en"]').val();
		var dish_name2_en = $('input[name="dish_name2_en"]').val();
		var dish_description2_en = $('textarea[name="dish_description2_en"]').val();

		var dish_kal_protein = $('input[name="dish_kal_protein"]').val();
		var dish_kal_fat = $('input[name="dish_kal_fat"]').val();
		var dish_kal_carbohydrate = $('input[name="dish_kal_carbohydrate"]').val();
		
		var dish_grams_protein = $('input[name="dish_grams_protein"]').val();
		var dish_grams_fat = $('input[name="dish_grams_fat"]').val();
		var dish_grams_carbohydrate = $('input[name="dish_grams_carbohydrate"]').val();

		if(dish_kal_protein == ''){dish_kal_protein = 0;}
		if(dish_kal_fat == ''){dish_kal_fat = 0;}
		if(dish_kal_carbohydrate == ''){dish_kal_carbohydrate = 0;}

		if(dish_grams_protein == ''){dish_grams_protein = 0;}
		if(dish_grams_fat == ''){dish_grams_fat = 0;}
		if(dish_grams_carbohydrate == ''){dish_grams_carbohydrate = 0;}
		
		
		var ispass=1;
		if(ispass == 1){
			$.post(baseurl+'index.php/admins/cms/edit_dish/'+dish_id, {
				//返回url
				backurl: backurl,
				//关键字信息
				dish_name_en: dish_name_en, 
				dish_description_en: dish_description_en,
				dish_name2_en: dish_name2_en, 
				dish_description2_en: dish_description2_en,
				
				dish_kal_protein: dish_kal_protein,
				dish_kal_fat: dish_kal_fat,
				dish_kal_carbohydrate: dish_kal_carbohydrate,

				dish_grams_protein: dish_grams_protein,
				dish_grams_fat: dish_grams_fat,
				dish_grams_carbohydrate: dish_grams_carbohydrate,
				
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
				<input type="text" name="dish_name_en" value="<?php echo $dishinfo['dish_name_en']?>"/>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Meal description</td>
			<td align="left">
				<textarea name="dish_description_en"><?php echo $dishinfo['dish_description_en']?></textarea>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Nutritional spotlight (title)</td>
			<td align="left">
				<input type="text" name="dish_name2_en" value="<?php echo $dishinfo['dish_name2_en']?>"/>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Nutritional spotlight (description)</td>
			<td align="left">
				<textarea name="dish_description2_en" style="width:800px;height:200px;"><?php echo $dishinfo['dish_description2_en']?></textarea>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
			</td>
		</tr>
		
		<tr>
			<td align="right" width="150"></td>
			<td align="left">MACRONUTRIENTS (KAL)</td>
		</tr>
		<tr>
			<td align="right" width="150">Protein</td>
			<td align="left">
				<input type="text" style="width:60px;" name="dish_kal_protein" value="<?php if($dishinfo['dish_kal_protein'] != 0){echo $dishinfo['dish_kal_protein'];}?>"/>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Fat</td>
			<td align="left">
				<input type="text" style="width:60px;" name="dish_kal_fat" value="<?php if($dishinfo['dish_kal_fat'] != 0){echo $dishinfo['dish_kal_fat'];}?>"/>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Carbohydrate</td>
			<td align="left">
				<input type="text" style="width:60px;" name="dish_kal_carbohydrate" value="<?php if($dishinfo['dish_kal_carbohydrate'] != 0){echo $dishinfo['dish_kal_carbohydrate'];}?>"/>
			</td>
		</tr>
		
		<tr>
			<td align="right" width="150"></td>
			<td align="left">MACRONUTRIENTS (GRAMS)</td>
		</tr>
		<tr>
			<td align="right" width="150">Protein</td>
			<td align="left">
				<input type="text" style="width:60px;" name="dish_grams_protein" value="<?php if($dishinfo['dish_grams_protein'] != 0){echo $dishinfo['dish_grams_protein'];}?>"/>
				<div style="float:left;margin-left:5px;line-height:24px;">g</div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Fat</td>
			<td align="left">
				<input type="text" style="width:60px;" name="dish_grams_fat" value="<?php if($dishinfo['dish_grams_fat'] != 0){echo $dishinfo['dish_grams_fat'];}?>"/>
				<div style="float:left;margin-left:5px;line-height:24px;">g</div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Carbohydrate</td>
			<td align="left">
				<input type="text" style="width:60px;" name="dish_grams_carbohydrate" value="<?php if($dishinfo['dish_grams_carbohydrate'] != 0){echo $dishinfo['dish_grams_carbohydrate'];}?>"/>
				<div style="float:left;margin-left:5px;line-height:24px;">g</div>
			</td>
		</tr>
		
		
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_dishinfo(<?php echo $dishinfo['dish_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>

<?php $this->load->view('admin/footer')?>