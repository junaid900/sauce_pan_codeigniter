<?php $this->load->view('admin/header')?>
<script type="text/javascript">
//关键字信息---保存
function tosave_boxinfo(menu_id, week_id, weekday_num, box_id){
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="tosave_boxinfo('+menu_id+', '+week_id+', '+weekday_num+', '+box_id+')"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//将提交按钮设置为保存中
		actionsubmit_button.attr('class', 'gksel_btn_action_off');
		actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
		
		//关键字信息
		var box_breakfast_title = $('input[name="box_breakfast_title"]').val();
		var box_breakfast_description = $('textarea[name="box_breakfast_description"]').val();
		
		var box_lunch_title = $('input[name="box_lunch_title"]').val();
		var box_lunch_description = $('textarea[name="box_lunch_description"]').val();

		var box_booster_title = $('input[name="box_booster_title"]').val();
		var box_booster_description = $('textarea[name="box_booster_description"]').val();

		var box_dinner_title = $('input[name="box_dinner_title"]').val();
		var box_dinner_description = $('textarea[name="box_dinner_description"]').val();
		
		
		var ispass=1;
		if(ispass == 1){
			$.post(baseurl+'index.php/admins/cms/edit_weekdaybox/'+menu_id+'/'+week_id+'/'+weekday_num+'/'+box_id, {
				//关键字信息
				box_breakfast_title: box_breakfast_title, 
				box_breakfast_description: box_breakfast_description,
				
				box_lunch_title: box_lunch_title, 
				box_lunch_description: box_lunch_description,
				
				box_booster_title: box_booster_title,
				box_booster_description: box_booster_description,

				box_dinner_title: box_dinner_title,
				box_dinner_description: box_dinner_description,
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
<?php 
	$weekarray = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
?>
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr>
			<td align="right" width="150"></td>
			<td align="left">
				<?php 
				if($menu_id == 1){
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">5, 10 and 21 days plan</div>';
					echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">General Menu</div>';
				}else if($menu_id == 2){
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">5, 10 and 21 days plan</div>';
					echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Vegetarian Menu</div>';
				}else if($menu_id == 3){
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">5, 10 and 21 days plan</div>';
					echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Pescetarian Menu</div>';
				}
				
				
				
				else if($menu_id == 4){
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Flexible weekly plan</div>';
					echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">General Menu</div>';
				}else if($menu_id == 5){
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Flexible weekly plan</div>';
					echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Vegetarian Menu</div>';
				}else if($menu_id == 6){
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Flexible weekly plan</div>';
					echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
					echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Pescetarian Menu</div>';
				}
			?>
			
			<?php 
				echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
				echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">'.date('Y-m-d', strtotime(date('Y-m-d H:i:s', $weekinfo['week_start']).' +'.($weekday_num - 1).' day')).' ('.$weekarray[$weekday_num].')</div>';
			?>
			</td>
		</tr>
		<tr <?php if($menu_id == 1 || $menu_id == 2 || $menu_id == 3){}else{echo 'style="display:none;"';}?>>
			<td colspan="2">
				<div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
			</td>
		</tr>
		<tr <?php if($menu_id == 1 || $menu_id == 2 || $menu_id == 3){}else{echo 'style="display:none;"';}?>>
			<td align="right" width="150"></td>
			<td align="left">
				<div style="float:left;width:100%;font-size:16px;font-weight:bold;">Breakfast</div>
			</td>
		</tr>
		<tr <?php if($menu_id == 1 || $menu_id == 2 || $menu_id == 3){}else{echo 'style="display:none;"';}?>>
			<td align="right" width="150">Name</td>
			<td align="left">
				<input type="text" name="box_breakfast_title" value="<?php echo $boxinfo['box_breakfast_title']?>"/>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr <?php if($menu_id == 1 || $menu_id == 2 || $menu_id == 3){}else{echo 'style="display:none;"';}?>>
			<td align="right" width="150">Description</td>
			<td align="left">
				<textarea name="box_breakfast_description" style="width:800px;"><?php echo $boxinfo['box_breakfast_description']?></textarea>
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
			<td align="left">
				<div style="float:left;width:100%;font-size:16px;font-weight:bold;">Lunch</div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Name</td>
			<td align="left">
				<input type="text" name="box_lunch_title" value="<?php echo $boxinfo['box_lunch_title']?>"/>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Description</td>
			<td align="left">
				<textarea name="box_lunch_description" style="width:800px;"><?php echo $boxinfo['box_lunch_description']?></textarea>
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
			<td align="left">
				<div style="float:left;width:100%;font-size:16px;font-weight:bold;">Booster</div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Name</td>
			<td align="left">
				<input type="text" name="box_booster_title" value="<?php echo $boxinfo['box_booster_title']?>"/>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Description</td>
			<td align="left">
				<textarea name="box_booster_description" style="width:800px;"><?php echo $boxinfo['box_booster_description']?></textarea>
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
			<td align="left">
				<div style="float:left;width:100%;font-size:16px;font-weight:bold;">Dinner</div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Name</td>
			<td align="left">
				<input type="text" name="box_dinner_title" value="<?php echo $boxinfo['box_dinner_title']?>"/>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">Description</td>
			<td align="left">
				<textarea name="box_dinner_description" style="width:800px;"><?php echo $boxinfo['box_dinner_description']?></textarea>
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		
		<tr>
			<td>
				
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_boxinfo(<?php echo $menu_id?>, <?php echo $week_id?>, <?php echo $weekday_num?>, <?php echo $boxinfo['box_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>

<?php $this->load->view('admin/footer')?>