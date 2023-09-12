<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_product.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<?php 
$get_str='';
if($_GET){
	$arr = geturlparmersGETS();
	for($i=0;$i<count($arr);$i++){
		if(isset($_GET[$arr[$i]])){
			if($get_str!=""){$get_str .='&';}else{$get_str .='?';}
			$get_str .=$arr[$i].'='.$_GET[$arr[$i]];
		}
	}
}
$current_url = current_url();
$current_url_encode=str_replace('/','slash_tag',base64_encode($current_url.$get_str));

$plan_id = $this->input->get('plan_id');
$keyword = $this->input->get('keyword');
$status = $this->input->get('status');
$select_date = $this->input->get('select_date');


$uid = $this->input->get('uid');
if($this->langtype == '_ch'){
	$text_select_plan = '选择套餐';
}else{
	$text_select_plan = 'Select Plan';
}
if($this->langtype == '_ch'){
	$text_paused = '已暂停';
	$text_cancelled = '已取消';
}else{
	$text_paused = 'Paused';
	$text_cancelled = 'Cancelled';
}
?>

<table class="gksel_normal_tabaction">
	<tr>
		<td>
			
		</td>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/order/deliveryaddress_timechange_list'?>" method="get">
					<input type="hidden" name="uid" value="<?php echo $uid?>"/>
					<?php 
						if($uid != ''){
							$chaxunuserinfo = $this->UserModel->getuserinfo($uid);
							echo '<div style="float:left;margin:8px 15px 0px 0px;color:red;">';
								if($this->langtype == '_ch'){
									echo '用户: '.$chaxunuserinfo['user_nickname'];
								}else{
									echo 'User: '.$chaxunuserinfo['user_nickname'];
								}
							echo '</div>';
						}
					?>
					<!--
					<input type="text" name="select_date" style="width:80px;" value="<?php echo $select_date;?>"/>
					
					<img onclick="togetshiwucalendar_month_input()" style="cursor:pointer;float:left;width:26px;height:26px;margin-top:3px;margin-right:10px;" src="<?php echo base_url().'themes/default/images/btn_calendar_backend.png'?>"/>
					-->
					<input type="hidden" name="status" value="<?php echo $status?>"/>
					<input type="text" name="keyword" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
					<input type="submit" value="<?php echo lang('cy_search')?>"/>
				</form>
				<div class="calendar_area_parent" style="display:none;position:fixed;width:100%;left:0px;top:0px;bottom:0px;z-index:100;background:rgba(0,0,0,0.8);">
					<table cellspacing="0" cellpadding="0" style="float:left;width:100%;height:100%;">
						<tr>
							<td>
								<div style="float:left;width:500px;margin-left:calc(50% - 250px);">
									<div class="calendar_area" style="float:left;width:calc(100% - 40px);margin-left:10px;margin-right:10px;padding-left:10px;padding-right:10px;padding-bottom:10px;background:#F2C3C1;border-radius:6px;">
										<div style="float:left;width:100%;margin:50px 0px;text-align:center;"><img style="width:30px;height:30px;" src="<?php echo base_url()?>themes/default/images/ajax_loading.gif"/></div>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<script type="text/javascript">
								//关闭日历
								function toclosethiscalendar(){
									$('.calendar_area_parent').hide();
									$('.calendar_area').html('');
								}
								//选择日历中的某一天
								function togetrilidatatoinput(id, year, month, day){
									if(day < 10){
										var day_show='0'+day;
									}else{
										var day_show=day;
									}
									$('input[name="select_date"]').val(year+'-'+month+'-'+day_show);
					
									$('.calendar_area_parent').hide();
									$('.calendar_area').html('');
								}
								//日历中 切换 年月
								function togetshiwucalendar_month(id, year, month){
									$('.calendar_area_parent').show();
									$('.calendar_area').html('<div style="float:left;width:100%;margin:50px 0px;text-align:center;"><img style="width:30px;height:30px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
									$.post(baseurl+'index.php/welcome/calendar_select_date_normal/'+year+'/'+month, function (data){
										$('.calendar_area').html(data);
									});
								}
								//改变日历的年月
								function tochangecalendar_yearmonth(){
									var select_date = $('input[name="select_date"]').val();
									var dateselectsplit = select_date.split('-');
									var calendar_show_year = $('select[name="calendar_show_year"]').val();
									var calendar_show_month = $('select[name="calendar_show_month"]').val();
									$('.calendar_area_parent').show();
									$('.calendar_area').html('<div style="float:left;width:100%;margin:50px 0px;text-align:center;"><img style="width:30px;height:30px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
									$.post(baseurl+'index.php/welcome/calendar_select_date_normal/'+calendar_show_year+'/'+calendar_show_month, {select_date: select_date}, function (data){
										$('.calendar_area').html(data);
									});
								}
								//打开日历，含有默认值
								function togetshiwucalendar_month_input(){
									var select_date = $('input[name="select_date"]').val();
									var dateselectsplit = select_date.split('-');
									$('.calendar_area_parent').show();
									$('.calendar_area').html('<div style="float:left;width:100%;margin:50px 0px;text-align:center;"><img style="width:30px;height:30px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
									$.post(baseurl+'index.php/welcome/calendar_select_date_normal/'+dateselectsplit[0]+'/'+dateselectsplit[1], {select_date: select_date}, function (data){
										$('.calendar_area').html(data);
									});
								}
					</script>
				<!-- 
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/order/dailytotalmealslist?status='.$status.'&keyword='.$keyword.'&is_excel=1'?>';" style="float: left;margin-top:7px;cursor:pointer;">
					<div style="float: left;margin-left:5px;">
						<img src="<?php echo base_url().'themes/default/images/icon_xls.gif'?>"/>
					</div>
					<div style="float: left;margin-left:5px;">
						<?php if($this->langtype == '_ch'){echo '导出表格';}else{echo 'Export Excel';}?>
					</div>
				</div>
				 -->
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td width="140" align="center"><p>Order Number</p></td>
			<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '日期';}else{echo 'Date';}?></p></td>
			<td width="150"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_username')?></p></td>
			<td width="250" align="center"><p><?php if($this->langtype == '_ch'){echo '午餐';}else{echo 'Lunch';}?></p></td>
			<td width="250" align="center"><p><?php if($this->langtype == '_ch'){echo '晚餐';}else{echo 'Dinner';}?></p></td>
			<td width="250" align="center"><p><?php if($this->langtype == '_ch'){echo '晚餐 + 第二天早餐';}else{echo 'Dinner + Next day’s breakfast';}?></p></td>
			<td width="120" align="center"><p><?php if($this->langtype == '_ch'){echo '操作时间';}else{echo 'Action Time';}?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($log_list)){for ($i = 0; $i < count($log_list); $i++) {?>
			<tr style="<?php if($log_list[$i]['log_isread'] == 1){echo 'opacity:0.4;';}?>">
				<td align="center"><?php echo ($i+1)?></td>
				<td align="center"><?php echo $log_list[$i]['order_number']?></td>
				<td align="center">
					<div style="float:left;width:100%;">
						<?php echo $log_list[$i]['date_show']?>
					</div>
					<?php if(!empty($changeto_dayinfo)){?>
						<div style="float:left;width:100%;margin-top:5px;color:green;">
							<?php echo $changeto_dayinfo['date_show']?>
						</div>
					<?php }?>
				</td>
				<td>
					<div style="float:left;width: 100%;">
						<div style="float:left;width: 23px;">
							<?php if($log_list[$i]['wechat_avatar'] != ''){?>
								<img style="float:left;width:18px;height:18px;" src="<?php echo $log_list[$i]['wechat_avatar']?>">
							<?php }else{?>
								<img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>">
							<?php }?>
						</div>
						<div style="float:left;width: calc(100% - 23px);line-height:18px;"><?php echo actionsearchdaxiaoxiezimu($keyword, userTextDecode($log_list[$i]['wechat_nickname']));?></div>
					</div>
				</td>
				
				<td align="center">
					<div style="float:left;width: 100%;">
						<?php 
							if($log_list[$i]['daily_meals_id'] == 1){//只有午餐
								if($log_list[$i]['from_time_id_lunch'] != $log_list[$i]['to_time_id_lunch'] || $log_list[$i]['from_address_id_lunch'] != $log_list[$i]['to_address_id_lunch']){
									echo '<div style="float:left;width:100%;margin-top:5px;text-decoration:line-through;">';
										echo $log_list[$i]['from_lunch_time_name2'.$this->langtype];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;text-decoration:line-through;">';
										echo $log_list[$i]['from_lunch_address_marked'].' - '.$log_list[$i]['from_lunch_address_formattedaddress'];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;">
										<div style="float:left;width:100px;margin-left:calc(50% - 51px);border:1px solid gray;line-height:25px;border-radius:8px;">
		 									change to 
										</div>
									</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $log_list[$i]['to_lunch_time_name2'.$this->langtype];
									echo '</div>';
										
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $log_list[$i]['to_lunch_address_marked'].' - '.$log_list[$i]['to_lunch_address_formattedaddress'];
									echo '</div>';
								}else{
									echo '<div style="float:left;width:100%;margin-top:5px;">';
										echo $log_list[$i]['from_lunch_time_name2'.$this->langtype];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $log_list[$i]['from_lunch_address_marked'].' - '.$log_list[$i]['from_lunch_address_formattedaddress'];
									echo '</div>';
								}
							}else if($log_list[$i]['daily_meals_id'] == 2){//只有晚餐
								
							}else if($log_list[$i]['daily_meals_id'] == 3){//午餐 + 晚餐
								if($log_list[$i]['from_time_id_lunch'] != $log_list[$i]['to_time_id_lunch'] || $log_list[$i]['from_address_id_lunch'] != $log_list[$i]['to_address_id_lunch']){
									echo '<div style="float:left;width:100%;margin-top:5px;text-decoration:line-through;">';
										echo $log_list[$i]['from_lunch_time_name2'.$this->langtype];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;text-decoration:line-through;">';
										echo $log_list[$i]['from_lunch_address_marked'].' - '.$log_list[$i]['from_lunch_address_formattedaddress'];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;">
										<div style="float:left;width:100px;margin-left:calc(50% - 51px);border:1px solid gray;line-height:25px;border-radius:8px;">
		 									change to 
										</div>
									</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $log_list[$i]['to_lunch_time_name2'.$this->langtype];
									echo '</div>';
										
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $log_list[$i]['to_lunch_address_marked'].' - '.$log_list[$i]['to_lunch_address_formattedaddress'];
									echo '</div>';
								}else{
									echo '<div style="float:left;width:100%;margin-top:5px;">';
										echo $log_list[$i]['from_lunch_time_name2'.$this->langtype];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $log_list[$i]['from_lunch_address_marked'].' - '.$log_list[$i]['from_lunch_address_formattedaddress'];
									echo '</div>';
								}
							}else if($log_list[$i]['daily_meals_id'] == 4){//早餐 + 午餐 + 晚餐
								
							}
						?>
					</div>
				</td>
				<td align="center">
					<div style="float:left;width: 100%;">
						<?php 
							if($log_list[$i]['daily_meals_id'] == 1){//只有午餐
								
							}else if($log_list[$i]['daily_meals_id'] == 2){//只有晚餐
								if($log_list[$i]['from_time_id_dinner'] != $log_list[$i]['to_time_id_dinner'] || $log_list[$i]['from_address_id_dinner'] != $log_list[$i]['to_address_id_dinner']){
									echo '<div style="float:left;width:100%;margin-top:5px;text-decoration:line-through;">';
										echo $log_list[$i]['from_dinner_time_name2'.$this->langtype];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;text-decoration:line-through;">';
										echo $log_list[$i]['from_dinner_address_marked'].' - '.$log_list[$i]['from_dinner_address_formattedaddress'];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;">
										<div style="float:left;width:100px;margin-left:calc(50% - 51px);border:1px solid gray;line-height:25px;border-radius:8px;">
		 									change to 
										</div>
									</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $log_list[$i]['to_dinner_time_name2'.$this->langtype];
									echo '</div>';
										
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $log_list[$i]['to_dinner_address_marked'].' - '.$log_list[$i]['to_dinner_address_formattedaddress'];
									echo '</div>';
								}else{
									echo '<div style="float:left;width:100%;margin-top:5px;">';
										echo $log_list[$i]['from_dinner_time_name2'.$this->langtype];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $log_list[$i]['from_dinner_address_marked'].' - '.$log_list[$i]['from_dinner_address_formattedaddress'];
									echo '</div>';
								}
								
							}else if($log_list[$i]['daily_meals_id'] == 3){//午餐 + 晚餐
								if($log_list[$i]['from_time_id_dinner'] != $log_list[$i]['to_time_id_dinner'] || $log_list[$i]['from_address_id_dinner'] != $log_list[$i]['to_address_id_dinner']){
									echo '<div style="float:left;width:100%;margin-top:5px;text-decoration:line-through;">';
										echo $log_list[$i]['from_dinner_time_name2'.$this->langtype];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;text-decoration:line-through;">';
										echo $log_list[$i]['from_dinner_address_marked'].' - '.$log_list[$i]['from_dinner_address_formattedaddress'];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;">
										<div style="float:left;width:100px;margin-left:calc(50% - 51px);border:1px solid gray;line-height:25px;border-radius:8px;">
		 									change to 
										</div>
									</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $log_list[$i]['to_dinner_time_name2'.$this->langtype];
									echo '</div>';
										
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $log_list[$i]['to_dinner_address_marked'].' - '.$log_list[$i]['to_dinner_address_formattedaddress'];
									echo '</div>';
								}else{
									echo '<div style="float:left;width:100%;margin-top:5px;">';
										echo $log_list[$i]['from_dinner_time_name2'.$this->langtype];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $log_list[$i]['from_dinner_address_marked'].' - '.$log_list[$i]['from_dinner_address_formattedaddress'];
									echo '</div>';
								}
							}else if($log_list[$i]['daily_meals_id'] == 4){//早餐 + 午餐 + 晚餐
								
							}
						?>
					</div>
				</td>
				<td align="center">
					<div style="float:left;width: 100%;">
						<?php 
							if($log_list[$i]['daily_meals_id'] == 1){//只有午餐
								
							}else if($log_list[$i]['daily_meals_id'] == 2){//只有晚餐
								
							}else if($log_list[$i]['daily_meals_id'] == 3){//午餐 + 晚餐
								
							}else if($log_list[$i]['daily_meals_id'] == 4){//早餐 + 午餐 + 晚餐
								if($log_list[$i]['from_time_id_dinner'] != $log_list[$i]['to_time_id_dinner'] || $log_list[$i]['from_address_id_dinner'] != $log_list[$i]['to_address_id_dinner']){
									echo '<div style="float:left;width:100%;margin-top:5px;text-decoration:line-through;">';
										echo $log_list[$i]['from_dinner_time_name2'.$this->langtype];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;text-decoration:line-through;">';
										echo $log_list[$i]['from_dinner_address_marked'].' - '.$log_list[$i]['from_dinner_address_formattedaddress'];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;">
										<div style="float:left;width:100px;margin-left:calc(50% - 51px);border:1px solid gray;line-height:25px;border-radius:8px;">
		 									change to 
										</div>
									</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $log_list[$i]['to_dinner_time_name2'.$this->langtype];
									echo '</div>';
										
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $log_list[$i]['to_dinner_address_marked'].' - '.$log_list[$i]['to_dinner_address_formattedaddress'];
									echo '</div>';
								}else{
									echo '<div style="float:left;width:100%;margin-top:5px;">';
										echo $log_list[$i]['from_dinner_time_name2'.$this->langtype];
									echo '</div>';
									
									echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $log_list[$i]['from_dinner_address_marked'].' - '.$log_list[$i]['from_dinner_address_formattedaddress'];
									echo '</div>';
								}
							}
						?>
					</div>
				</td>
				<td align="center">
					<div style="float:left;width:100%;">
						<?php echo date('Y-m-d H:i', $log_list[$i]['created'])?>
					</div>
				</td>
			</tr>
			
			<?php 
// 				//设置该条数据为已读
// 				$this->OrderModel->edit_day($log_list[$i]['day_id'], array('log_isread'=>1));
			?>
		<?php }}?>
	</tbody>
</table>

<?php $this->load->view('admin/footer')?>