<?php $this->load->view('admin/header')?>

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
$product_id = $this->input->get('product_id');
$select_date = $this->input->get('select_date');
$select_delivery_time = $this->input->get('select_delivery_time');
$islive = $this->input->get('islive');

if($this->langtype == '_ch'){
	$text_select_plan = '选择套餐';
}else{
	$text_select_plan = 'Select Plan';
}
if($this->langtype == '_ch'){
	$text_shipped = '已配送';
}else{
	$text_shipped = 'Shipped';
}
?>
<?php 
	$sql = "
		SELECT DISTINCT(date_show)
	
		FROM ".DB_PRE()."order_day
	
		WHERE date_int >= ".strtotime(date('Y-m-d').' 00:00:00')." AND action_status = 0
			
		ORDER BY date_int ASC
	";
	$query = $this->db->query($sql);
	if($query->num_rows()>0){
		$count_live = $query->num_rows();
	}else{
		$count_live = 0;
	}
	
	$sql = "
		SELECT DISTINCT(date_show)
	
		FROM ".DB_PRE()."order_day
	
		WHERE date_int < ".strtotime(date('Y-m-d').' 00:00:00')." AND action_status = 0
		
		ORDER BY date_int ASC
	";
	$query = $this->db->query($sql);
	if($query->num_rows()>0){
		$count_expirated = $query->num_rows();
	}else{
		$count_expirated = 0;
	}
?>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div style="float:left;">
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/report/daily_manager_report?islive=1'?>';" style="cursor:pointer;float:left;margin-left:5px;margin-top:-4px;<?php if($islive == 1){echo 'background:rgb(171,16,50);color:white;';}else{echo 'background:#CCC;color:gray;';}?>font-size:12px;padding:6px 8px;">
					Live dates <span style="color:green;">(<?php echo $count_live?>)</span>
				</div>
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/report/daily_manager_report?islive=0'?>';" style="cursor:pointer;float:left;margin-left:5px;margin-top:-4px;<?php if($islive == 0){echo 'background:rgb(171,16,50);color:white;';}else{echo 'background:#CCC;color:gray;';}?>font-size:12px;padding:6px 8px;">
					Expirated dates <span style="color:gray;">(<?php echo $count_expirated?>)</span>
				</div>
			</div>
		</td>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/report/daily_manager_report'?>" method="get">
					<?php 
						$con = array('orderby'=>'plan_id', 'orderby_res'=>'ASC');
						$planlist = $this->PlanModel->getplanlist($con);
						
					?>
					
					<input type="text" name="select_date" style="width:100px;" placeholder="Kitchen date" value="<?php echo $select_date;?>"/>
					<input type="hidden" name="islive" value="<?php echo $islive;?>"/>
					<img onclick="togetshiwucalendar_month_input()" style="cursor:pointer;float:left;width:26px;height:26px;margin-top:3px;margin-right:10px;" src="<?php echo base_url().'themes/default/images/btn_calendar_backend.png'?>"/>
					
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
			</div>
		</td>
	</tr>
</table>

<div style="position:absolute;top:60px;bottom:0px;width:100%;overflow:auto;">
	<?php if(isset($grouplist)){for ($g = 0; $g < count($grouplist); $g++) {?>
		<div style="float:left;width:100%;">
			<div style="float:left;width:100%;">
				<div style="float:left;width:410px;">
					<div style="float:left;width:calc(100% - 15px);margin-top:20px;font-size:20px;line-height:20px;font-weight:bold;">
						<div style="float:left;width:100%;padding-bottom:10px;border-bottom:1px solid black;">
							<div style="float:left;">
								<?php echo $grouplist[$g]['date_show']?>
							</div>
							<div class="num_<?php echo $grouplist[$g]['date_show']?>" style="float:right;width:80px;text-align:center;">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<table class="gksel_report_tablist" style="width:calc(395px + 15px)">
				<thead>
					<tr>
						<td width="100" align="center" style="border-left:1px solid #000000;"><p style="border-left:0px;"></p></td>
						<td width="135" align="center" style="border-left:1px solid #000000;"><p style="border-left:0px;">Plan</p></td>
						
						<td width="80" align="center"><p>Num</p></td>
						<td width="80" align="center"><p>Subtotal</p></td>
						<td width="15" align="center" style="border:0px;background:white;"></td>
					</tr>
				</thead>
				
				<?php 
				$num_day_lunch = 0;
				if(!empty($planlist)){for ($p = 0; $p < count($planlist); $p++) {?>
						<?php 
							$con = array('date_show'=>$grouplist[$g]['date_show'], 'plan_id'=>$planlist[$p]['plan_id'], 'order_status'=>'1', 'orderby'=>'a.day_id', 'orderby_res'=>'ASC');
							$day_list = $this->OrderModel->getdaylist($con);
						?>
							<tr>
								<?php if($p == 0){?>
									<td align="center" rowspan="<?php echo count($planlist)?>" style="background:#EFEFEF;border-left:1px solid #000000;">
										Lunch
									</td>
								<?php }?>
								<td align="left" style="background:#EFEFEF;border-left:1px solid #000000;">
									<?php echo $planlist[$p]['plan_short'.$this->langtype].' Lunch';?>
								</td>
								<td align="center" valign="top">
									<?php 
										$realitemnum = 0;
										if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {
											if($day_list[$i]['daily_meals_id'] == 1 || $day_list[$i]['daily_meals_id'] == 3 || $day_list[$i]['daily_meals_id'] == 4){
												//午餐
												//午餐 + 晚餐
												//早餐 + 午餐 + 晚餐
												$realitemnum++;
												$num_day_lunch++;
											}
										}}
										echo $realitemnum;
									?>
								</td>
								<?php if($p == 0){?>
									<td class="num_<?php echo $grouplist[$g]['date_show']?>_lunch" align="center" rowspan="<?php echo count($planlist)?>">
										
									</td>
								<?php }?>
								<td width="0" align="center" style="border:0px;background:white;"></td>
							</tr>
				<?php }}?>
				<script>
					$('.num_<?php echo $grouplist[$g]['date_show']?>_lunch').html(<?php echo $num_day_lunch;?>);
				</script>
				
				
				
				
				
				<?php 
				$num_day_dinner = 0;
				if(!empty($planlist)){for ($p = 0; $p < count($planlist); $p++) {?>
				
						<?php 
							$con = array('date_show'=>$grouplist[$g]['date_show'], 'plan_id'=>$planlist[$p]['plan_id'], 'order_status'=>'1', 'orderby'=>'a.day_id', 'orderby_res'=>'ASC');
							$day_list = $this->OrderModel->getdaylist($con);
						?>
							<tr>
								<?php if($p == 0){?>
									<td align="center" rowspan="<?php echo count($planlist)?>" style="background:#EFEFEF;border-left:1px solid #000000;">
										Dinner
									</td>
								<?php }?>
								<td align="left" style="background:#EFEFEF;border-left:1px solid #000000;">
									<?php echo $planlist[$p]['plan_short'.$this->langtype].' Dinner';?>
									<?php 
										if($planlist[$p]['plan_id'] != 1){
											echo ' + BF';
										}
									?>
								</td>
								<td align="center" valign="center">
									<?php 
										$realitemnum = 0;
										if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {
											if($day_list[$i]['daily_meals_id'] == 2 || $day_list[$i]['daily_meals_id'] == 3 || $day_list[$i]['daily_meals_id'] == 4){
												//晚餐
												//午餐 + 晚餐
												//早餐 + 午餐 + 晚餐
												$realitemnum++;
												$num_day_dinner++;
											}
										}}
										echo $realitemnum;
									?>
								</td>
								
								<?php if($p == 0){?>
									<td class="num_<?php echo $grouplist[$g]['date_show']?>_dinner" align="center" rowspan="<?php echo count($planlist)?>">
										
									</td>
								<?php }?>
								<td width="0" align="center" style="border:0px;background:white;"></td>
							</tr>
				<?php }}?>
				<script>
					$('.num_<?php echo $grouplist[$g]['date_show']?>_dinner').html(<?php echo $num_day_dinner;?>);
				</script>
			</table>
			
			
			<table class="gksel_report_tablist" style="width:calc(395px + 15px)">
				<thead>
					<tr>
						<td width="100" align="center" style="border-left:1px solid #000000;"><p style="border-left:0px;"></p></td>
						<td width="135" align="center" style="border-left:1px solid #000000;"><p style="border-left:0px;">Plan</p></td>
						
						<td width="80" align="center"><p>Num</p></td>
						<td width="80" align="center"><p>Subtotal</p></td>
						<td width="15" align="center" style="border:0px;background:white;"></td>
					</tr>
				</thead>
				
				<?php 
				$num_day_lunch = 0;
				if(!empty($planlist)){for ($p = 0; $p < count($planlist); $p++) {?>
						<?php 
							$con = array('date_show'=>$grouplist[$g]['date_show'], 'plan_id'=>$planlist[$p]['plan_id'], 'order_status'=>'1', 'orderby'=>'a.day_id', 'orderby_res'=>'ASC');
							$day_list = $this->OrderModel->getdaylist($con);
						?>
							<tr>
								<?php if($p == 0){?>
									<td align="center" rowspan="<?php echo count($planlist)?>" style="background:#EFEFEF;border-left:1px solid #000000;">
										Lunch
									</td>
								<?php }?>
								<td align="left" style="background:#EFEFEF;border-left:1px solid #000000;">
									<?php echo $planlist[$p]['plan_short'.$this->langtype].' Lunch';?>
								</td>
								<td align="center" valign="top">
									<?php 
										$realitemnum = 0;
										if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {
											if($day_list[$i]['daily_meals_id'] == 1 || $day_list[$i]['daily_meals_id'] == 3 || $day_list[$i]['daily_meals_id'] == 4){
												//午餐
												//午餐 + 晚餐
												//早餐 + 午餐 + 晚餐
												$realitemnum++;
												$num_day_lunch++;
											}
										}}
										echo $realitemnum;
									?>
								</td>
								<?php if($p == 0){?>
									<td class="num_<?php echo $grouplist[$g]['date_show']?>_lunch" align="center" rowspan="<?php echo count($planlist)?>">
										
									</td>
								<?php }?>
								<td width="0" align="center" style="border:0px;background:white;"></td>
							</tr>
				<?php }}?>
				
				
				
				
				
				<?php 
				$num_day_dinner = 0;
				if(!empty($planlist)){for ($p = 0; $p < count($planlist); $p++) {?>
				
						<?php 
							$con = array('date_show'=>$grouplist[$g]['date_show'], 'plan_id'=>$planlist[$p]['plan_id'], 'order_status'=>'1', 'orderby'=>'a.day_id', 'orderby_res'=>'ASC');
							$day_list = $this->OrderModel->getdaylist($con);
						?>
							<tr>
								<?php if($p == 0){?>
									<td align="center" rowspan="<?php echo count($planlist)?>" style="background:#EFEFEF;border-left:1px solid #000000;">
										Dinner
									</td>
								<?php }?>
								<td align="left" style="background:#EFEFEF;border-left:1px solid #000000;">
									<?php echo $planlist[$p]['plan_short'.$this->langtype].' Dinner';?>
									<?php 
										if($planlist[$p]['plan_id'] != 1){
											echo ' + BF';
										}
									?>
								</td>
								<td align="center" valign="center">
									<?php 
										$realitemnum = 0;
										if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {
											if($day_list[$i]['daily_meals_id'] == 2 || $day_list[$i]['daily_meals_id'] == 3 || $day_list[$i]['daily_meals_id'] == 4){
												//晚餐
												//午餐 + 晚餐
												//早餐 + 午餐 + 晚餐
												$realitemnum++;
												$num_day_dinner++;
											}
										}}
										echo $realitemnum;
									?>
								</td>
								
								<?php if($p == 0){?>
									<td class="num_<?php echo $grouplist[$g]['date_show']?>_dinner" align="center" rowspan="<?php echo count($planlist)?>">
										
									</td>
								<?php }?>
								<td width="0" align="center" style="border:0px;background:white;"></td>
							</tr>
				<?php }}?>
				
				
				
			</table>
		</div>
		
		<script>
			$('.num_<?php echo $grouplist[$g]['date_show']?>').html(<?php echo $num_day_lunch+$num_day_dinner;?>);
		</script>
		
	<?php }}?>
	
</div>




<?php $this->load->view('admin/footer')?>