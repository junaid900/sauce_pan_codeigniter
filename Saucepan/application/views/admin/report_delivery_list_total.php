<?php $this->load->view('admin/header')?>

<script language="javascript" src="<?php echo CDN_URL();?>themes/default/js/jquery.jqprint-0.3.js?date=<?php echo CACHE_USETIME()?>"></script>
<script src="http://www.jq22.com/jquery/jquery-migrate-1.2.1.min.js"></script>

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
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/report/totalkitchen?islive=1'?>';" style="cursor:pointer;float:left;margin-left:5px;margin-top:-4px;<?php if($islive == 1){echo 'background:rgb(171,16,50);color:white;';}else{echo 'background:#CCC;color:gray;';}?>font-size:12px;padding:6px 8px;">
					Live dates <span style="color:green;">(<?php echo $count_live?>)</span>
				</div>
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/report/totalkitchen?islive=0'?>';" style="cursor:pointer;float:left;margin-left:5px;margin-top:-4px;<?php if($islive == 0){echo 'background:rgb(171,16,50);color:white;';}else{echo 'background:#CCC;color:gray;';}?>font-size:12px;padding:6px 8px;">
					Expirated dates <span style="color:gray;">(<?php echo $count_expirated?>)</span>
				</div>
			</div>
		</td>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/report/totalkitchen'?>" method="get">
					<?php 
						$con = array('orderby'=>'plan_id', 'orderby_res'=>'ASC');
						$planlist = $this->PlanModel->getplanlist($con);
						
						if($plan_id != '' && $plan_id != 0){
							$thisselectstyle = 'color:black;';
						}else{
							$thisselectstyle = 'color:gray;';
						}
						echo '<select name="plan_id" style="float:left;background: url(\''.CDN_URL().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;'.$thisselectstyle.'appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:160px;margin:0px 10px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
						echo '<option value="0">'.$text_select_plan.'</option>';
						if(!empty($planlist)){
							for ($aaa = 0; $aaa < count($planlist); $aaa++) {
								$ischecked = '';
								if($plan_id == $planlist[$aaa]['plan_id']){
									$ischecked = 'selected';
								}
								echo '<option value="'.$planlist[$aaa]['plan_id'].'" '.$ischecked.'>'.$planlist[$aaa]['plan_name'.$this->langtype].'</option>';
							}
						}
						echo '</select>';
						
						$con = array('orderby'=>'product_id', 'orderby_res'=>'ASC');
						$productlist = $this->ProductModel->getproductlist($con);
						
						if($product_id != '' && $product_id != 0){
							$thisselectstyle = 'color:black;';
						}else{
							$thisselectstyle = 'color:gray;';
						}
						echo '<select name="product_id" style="float:left;background: url(\''.CDN_URL().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;'.$thisselectstyle.'appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:160px;margin:0px 10px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
						echo '<option value="0">Select protein</option>';
						if(!empty($productlist)){
							for ($aaa = 0; $aaa < count($productlist); $aaa++) {
								$ischecked = '';
								if($product_id == $productlist[$aaa]['product_id']){
									$ischecked = 'selected';
								}
								echo '<option value="'.$productlist[$aaa]['product_id'].'" '.$ischecked.'>'.$productlist[$aaa]['product_name'.$this->langtype].'</option>';
							}
						}
						echo '</select>';
					?>
					
					<input type="text" name="select_date" style="width:100px;" placeholder="Kitchen date" value="<?php echo $select_date;?>"/>
					<input type="hidden" name="islive" value="<?php echo $islive;?>"/>
					<img onclick="togetshiwucalendar_month_input()" style="cursor:pointer;float:left;width:26px;height:26px;margin-top:3px;margin-right:10px;" src="<?php echo base_url().'themes/default/images/btn_calendar_backend.png'?>"/>
					
					
					<?php 
						echo '<select name="select_delivery_time" style="float:left;background: url(\''.CDN_URL().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:180px;margin:0px 10px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
						echo '<option value="0">Select delivery time</option>';
								$ischecked = '';
								if($select_delivery_time == 1){
									$ischecked = 'selected';
								}
								echo '<option value="1" '.$ischecked.'>Lunch period</option>';
								
								$ischecked = '';
								if($select_delivery_time == 2){
									$ischecked = 'selected';
								}
								echo '<option value="2" '.$ischecked.'>Dinner period</option>';
						
								$ischecked = '';
								if($select_delivery_time == 3){
									$ischecked = 'selected';
								}
								echo '<option value="3" '.$ischecked.'>10.00 - 11.00</option>';
								
								$ischecked = '';
								if($select_delivery_time == 4){
									$ischecked = 'selected';
								}
								echo '<option value="4" '.$ischecked.'>11.00 - 12.00</option>';

								$ischecked = '';
								if($select_delivery_time == 5){
									$ischecked = 'selected';
								}
								echo '<option value="5" '.$ischecked.'>12.00 - 13.00</option>';

								$ischecked = '';
								if($select_delivery_time == 6){
									$ischecked = 'selected';
								}
								echo '<option value="6" '.$ischecked.'>13.00 - 14.00</option>';
								
								
								
								
								

								$ischecked = '';
								if($select_delivery_time == 7){
									$ischecked = 'selected';
								}
								echo '<option value="7" '.$ischecked.'>17.00 - 18.00</option>';

								$ischecked = '';
								if($select_delivery_time == 8){
									$ischecked = 'selected';
								}
								echo '<option value="8" '.$ischecked.'>18.00 - 19.00</option>';

								$ischecked = '';
								if($select_delivery_time == 9){
									$ischecked = 'selected';
								}
								echo '<option value="9" '.$ischecked.'>19.00 - 20.00</option>';

								$ischecked = '';
								if($select_delivery_time == 10){
									$ischecked = 'selected';
								}
								echo '<option value="10" '.$ischecked.'>20.00 - 21.00</option>';
						echo '</select>';
						
					?>
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
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/report/totalkitchen?plan_id='.$plan_id.'&select_date='.$select_date.'&select_delivery_time='.$select_delivery_time.'&is_excel=1'?>';" style="float: left;margin-top:7px;cursor:pointer;">
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

<div style="position:absolute;top:60px;bottom:0px;width:100%;overflow:auto;">
	<?php if(isset($grouplist)){for ($g = 0; $g < count($grouplist); $g++) {?>
		<div style="float:left;width:100%;margin-top:20px;font-size:20px;line-height:20px;font-weight:bold;">
			<?php echo $grouplist[$g]['date_show']?>
		</div>
		<table class="gksel_report_tablist" style="width:calc(2100px + 15px)">
			<thead>
				<tr>
					<td width="100" align="center" style="border-left:1px solid #000000;"><p style="border-left:0px;">Plan</p></td>
					
					<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 1 || $select_delivery_time == 3){?>
						<td width="250" align="center"><p>10.00 - 11.00</p></td>
					<?php }?>
					<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 1 || $select_delivery_time == 4){?>
						<td width="250" align="center"><p>11.00 - 12.00</p></td>
					<?php }?>
					<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 1 || $select_delivery_time == 5){?>
						<td width="250" align="center"><p>12.00 - 13.00</p></td>
					<?php }?>
					<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 1 || $select_delivery_time == 6){?>
						<td width="250" align="center"><p>13.00 - 14.00</p></td>
					<?php }?>
					<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 2 || $select_delivery_time == 7){?>
						<td width="250" align="center"><p>17.00 - 18.00</p></td>
					<?php }?>
					<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 2 || $select_delivery_time == 8){?>
						<td width="250" align="center"><p>18.00 - 19.00</p></td>
					<?php }?>
					<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 2 || $select_delivery_time == 9){?>
						<td width="250" align="center"><p>19.00 - 20.00</p></td>
					<?php }?>
					<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 2 || $select_delivery_time == 10){?>
						<td width="250" align="center"><p>20.00 - 21.00</p></td>
					<?php }?>
					<td width="0" align="center" style="border:0px;background:white;"></td>
				</tr>
			</thead>
			
			<?php if(!empty($planlist)){for ($p = 0; $p < count($planlist); $p++) {?>
			
				<?php if($plan_id == '' || $plan_id == 0 || $plan_id == $planlist[$p]['plan_id']){?>
					<?php 
						$con = array('date_show'=>$grouplist[$g]['date_show'], 'plan_id'=>$planlist[$p]['plan_id'], 'order_status'=>'1', 'orderby'=>'a.day_id', 'orderby_res'=>'ASC');
						$day_list = $this->OrderModel->getdaylist($con);
					?>
					<tbody>
						<tr>
							<td align="center" style="background:#EFEFEF;border-left:1px solid #000000;">
								<?php echo $planlist[$p]['plan_name'.$this->langtype]?>
							</td>
							<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 1 || $select_delivery_time == 3){?>
								<td align="left" valign="top">
									<?php $realitemnum = 0; if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {?>
										<?php if($day_list[$i]['date_time_id_lunch'] == 1 || $day_list[$i]['date_time_id_dinner'] == 1){//10.00 - 11.00?>
											<?php if($product_id == '' || $product_id == 0 || $product_id == $day_list[$i]['product_id']){?>
												<div style="float:left;width: calc(100% - 10px);background:#EFEFEF;padding:5px;<?php if($realitemnum != 0){echo 'margin-top:10px;';}?>border-radius:4px;">
													<div style="float:left;width: 23px;"><?php if($day_list[$i]['wechat_avatar'] != ''){?><img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($day_list[$i]['wechat_avatar'])?>"><?php }else{?><img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>"><?php }?></div>
													<div style="float:left;width: calc(100% - 23px);line-height:18px;color:gray;"><?php echo userTextDecode($day_list[$i]['wechat_nickname']);?> <span style="color:black;"><?php echo $day_list[$i]['user_firstname'].' '.$day_list[$i]['user_lastname'];?></span></div>
													<div style="float:left;width: 100%;margin-top:5px;">
														<div style="float:left;border:1px solid gray;line-height:18px;padding:0px 3px;border-radius:4px;">
															<?php echo $day_list[$i]['product_name'.$this->langtype]?>
														</div>
														<div style="float:left;line-height:18px;margin-left:5px;color:red;">
															<?php echo $day_list[$i]['receive_memo_dietary']?>
														</div>
													</div>
												</div>
												<?php $realitemnum++;?>
											<?php }?>
										<?php }}?>
									<?php }?>
								</td>
							<?php }?>
							<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 1 || $select_delivery_time == 4){?>
								<td align="left" valign="top">
									<?php $realitemnum = 0; if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {?>
										<?php if($day_list[$i]['date_time_id_lunch'] == 2 || $day_list[$i]['date_time_id_dinner'] == 2){//11:00 - 12:00?>
											<?php if($product_id == '' || $product_id == 0 || $product_id == $day_list[$i]['product_id']){?>
												<div style="float:left;width: calc(100% - 10px);background:#EFEFEF;padding:5px;<?php if($realitemnum != 0){echo 'margin-top:10px;';}?>border-radius:4px;">
													<div style="float:left;width: 23px;"><?php if($day_list[$i]['wechat_avatar'] != ''){?><img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($day_list[$i]['wechat_avatar'])?>"><?php }else{?><img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>"><?php }?></div>
													<div style="float:left;width: calc(100% - 23px);line-height:18px;color:gray;"><?php echo userTextDecode($day_list[$i]['wechat_nickname']);?> <span style="color:black;"><?php echo $day_list[$i]['user_firstname'].' '.$day_list[$i]['user_lastname'];?></span></div>
													<div style="float:left;width: 100%;margin-top:5px;">
														<div style="float:left;border:1px solid gray;line-height:18px;padding:0px 3px;border-radius:4px;">
															<?php echo $day_list[$i]['product_name'.$this->langtype]?>
														</div>
														<div style="float:left;line-height:18px;margin-left:5px;color:red;">
															<?php echo $day_list[$i]['receive_memo_dietary']?>
														</div>
													</div>
												</div>
												<?php $realitemnum++;?>
											<?php }?>
										<?php }}?>
									<?php }?>
								</td>
							<?php }?>
							<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 1 || $select_delivery_time == 5){?>
								<td align="left" valign="top">
									<?php $realitemnum = 0; if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {?>
										<?php if($day_list[$i]['date_time_id_lunch'] == 3 || $day_list[$i]['date_time_id_dinner'] == 3){//12:00 - 13:00?>
											<?php if($product_id == '' || $product_id == 0 || $product_id == $day_list[$i]['product_id']){?>
												<div style="float:left;width: calc(100% - 10px);background:#EFEFEF;padding:5px;<?php if($realitemnum != 0){echo 'margin-top:10px;';}?>border-radius:4px;">
													<div style="float:left;width: 23px;"><?php if($day_list[$i]['wechat_avatar'] != ''){?><img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($day_list[$i]['wechat_avatar'])?>"><?php }else{?><img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>"><?php }?></div>
													<div style="float:left;width: calc(100% - 23px);line-height:18px;color:gray;"><?php echo userTextDecode($day_list[$i]['wechat_nickname']);?> <span style="color:black;"><?php echo $day_list[$i]['user_firstname'].' '.$day_list[$i]['user_lastname'];?></span></div>
													<div style="float:left;width: 100%;margin-top:5px;">
														<div style="float:left;border:1px solid gray;line-height:18px;padding:0px 3px;border-radius:4px;">
															<?php echo $day_list[$i]['product_name'.$this->langtype]?>
														</div>
														<div style="float:left;line-height:18px;margin-left:5px;color:red;">
															<?php echo $day_list[$i]['receive_memo_dietary']?>
														</div>
													</div>
												</div>
												<?php $realitemnum++;?>
											<?php }?>
										<?php }}?>
									<?php }?>
								</td>
							<?php }?>
							<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 1 || $select_delivery_time == 6){?>
								<td align="left" valign="top">
									<?php $realitemnum = 0; if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {?>
										<?php if($day_list[$i]['date_time_id_lunch'] == 12 || $day_list[$i]['date_time_id_dinner'] == 12){//13:00 - 14:00?>
											<?php if($product_id == '' || $product_id == 0 || $product_id == $day_list[$i]['product_id']){?>
												<div style="float:left;width: calc(100% - 10px);background:#EFEFEF;padding:5px;<?php if($realitemnum != 0){echo 'margin-top:10px;';}?>border-radius:4px;">
													<div style="float:left;width: 23px;"><?php if($day_list[$i]['wechat_avatar'] != ''){?><img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($day_list[$i]['wechat_avatar'])?>"><?php }else{?><img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>"><?php }?></div>
													<div style="float:left;width: calc(100% - 23px);line-height:18px;color:gray;"><?php echo userTextDecode($day_list[$i]['wechat_nickname']);?> <span style="color:black;"><?php echo $day_list[$i]['user_firstname'].' '.$day_list[$i]['user_lastname'];?></span></div>
													<div style="float:left;width: 100%;margin-top:5px;">
														<div style="float:left;border:1px solid gray;line-height:18px;padding:0px 3px;border-radius:4px;">
															<?php echo $day_list[$i]['product_name'.$this->langtype]?>
														</div>
														<div style="float:left;line-height:18px;margin-left:5px;color:red;">
															<?php echo $day_list[$i]['receive_memo_dietary']?>
														</div>
													</div>
												</div>
												<?php $realitemnum++;?>
											<?php }?>
										<?php }}?>
									<?php }?>
								</td>
							<?php }?>
							
							
							
							<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 2 || $select_delivery_time == 7){?>
								<td align="left" valign="top">
									<?php $realitemnum = 0; if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {?>
										<?php if($day_list[$i]['date_time_id_lunch'] == 5 || $day_list[$i]['date_time_id_dinner'] == 5 || $day_list[$i]['date_time_id_lunch'] == 9 || $day_list[$i]['date_time_id_dinner'] == 9){//17.00 - 18.00?>
											<?php if($product_id == '' || $product_id == 0 || $product_id == $day_list[$i]['product_id']){?>
												<div style="float:left;width: calc(100% - 10px);background:#EFEFEF;padding:5px;<?php if($realitemnum != 0){echo 'margin-top:10px;';}?>border-radius:4px;">
													<div style="float:left;width: 23px;"><?php if($day_list[$i]['wechat_avatar'] != ''){?><img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($day_list[$i]['wechat_avatar'])?>"><?php }else{?><img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>"><?php }?></div>
													<div style="float:left;width: calc(100% - 23px);line-height:18px;color:gray;"><?php echo userTextDecode($day_list[$i]['wechat_nickname']);?> <span style="color:black;"><?php echo $day_list[$i]['user_firstname'].' '.$day_list[$i]['user_lastname'];?></span></div>
													<div style="float:left;width: 100%;margin-top:5px;">
														<div style="float:left;border:1px solid gray;line-height:18px;padding:0px 3px;border-radius:4px;">
															<?php echo $day_list[$i]['product_name'.$this->langtype]?>
														</div>
														<div style="float:left;line-height:18px;margin-left:5px;color:red;">
															<?php echo $day_list[$i]['receive_memo_dietary']?>
														</div>
													</div>
												</div>
												<?php $realitemnum++;?>
											<?php }?>
										<?php }}?>
									<?php }?>
								</td>
							<?php }?>
							<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 2 || $select_delivery_time == 8){?>
								<td align="left" valign="top">
									<?php $realitemnum = 0; if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {?>
										<?php if($day_list[$i]['date_time_id_lunch'] == 6 || $day_list[$i]['date_time_id_dinner'] == 6 || $day_list[$i]['date_time_id_lunch'] == 10 || $day_list[$i]['date_time_id_dinner'] == 10){//18.00 - 19.00?>
											<?php if($product_id == '' || $product_id == 0 || $product_id == $day_list[$i]['product_id']){?>
												<div style="float:left;width: calc(100% - 10px);background:#EFEFEF;padding:5px;<?php if($realitemnum != 0){echo 'margin-top:10px;';}?>border-radius:4px;">
													<div style="float:left;width: 23px;"><?php if($day_list[$i]['wechat_avatar'] != ''){?><img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($day_list[$i]['wechat_avatar'])?>"><?php }else{?><img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>"><?php }?></div>
													<div style="float:left;width: calc(100% - 23px);line-height:18px;color:gray;"><?php echo userTextDecode($day_list[$i]['wechat_nickname']);?> <span style="color:black;"><?php echo $day_list[$i]['user_firstname'].' '.$day_list[$i]['user_lastname'];?></span></div>
													<div style="float:left;width: 100%;margin-top:5px;">
														<div style="float:left;border:1px solid gray;line-height:18px;padding:0px 3px;border-radius:4px;">
															<?php echo $day_list[$i]['product_name'.$this->langtype]?>
														</div>
														<div style="float:left;line-height:18px;margin-left:5px;color:red;">
															<?php echo $day_list[$i]['receive_memo_dietary']?>
														</div>
													</div>
												</div>
												<?php $realitemnum++;?>
											<?php }?>
										<?php }}?>
									<?php }?>
								</td>
							<?php }?>
							<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 2 || $select_delivery_time == 9){?>
								<td align="left" valign="top">
									<?php $realitemnum = 0; if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {?>
										<?php if($day_list[$i]['date_time_id_lunch'] == 7 || $day_list[$i]['date_time_id_dinner'] == 7 || $day_list[$i]['date_time_id_lunch'] == 11 || $day_list[$i]['date_time_id_dinner'] == 11){//19.00 - 20.00?>
											<?php if($product_id == '' || $product_id == 0 || $product_id == $day_list[$i]['product_id']){?>
												<div style="float:left;width: calc(100% - 10px);background:#EFEFEF;padding:5px;<?php if($realitemnum != 0){echo 'margin-top:10px;';}?>border-radius:4px;">
													<div style="float:left;width: 23px;"><?php if($day_list[$i]['wechat_avatar'] != ''){?><img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($day_list[$i]['wechat_avatar'])?>"><?php }else{?><img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>"><?php }?></div>
													<div style="float:left;width: calc(100% - 23px);line-height:18px;color:gray;"><?php echo userTextDecode($day_list[$i]['wechat_nickname']);?> <span style="color:black;"><?php echo $day_list[$i]['user_firstname'].' '.$day_list[$i]['user_lastname'];?></span></div>
													<div style="float:left;width: 100%;margin-top:5px;">
														<div style="float:left;border:1px solid gray;line-height:18px;padding:0px 3px;border-radius:4px;">
															<?php echo $day_list[$i]['product_name'.$this->langtype]?>
														</div>
														<div style="float:left;line-height:18px;margin-left:5px;color:red;">
															<?php echo $day_list[$i]['receive_memo_dietary']?>
														</div>
													</div>
												</div>
												<?php $realitemnum++;?>
											<?php }?>
										<?php }}?>
									<?php }?>
								</td>
							<?php }?>
							<?php if($select_delivery_time == '' || $select_delivery_time == 0 || $select_delivery_time == 2 || $select_delivery_time == 10){?>
								<td align="left" valign="top">
									<?php $realitemnum = 0; if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {?>
										<?php if($day_list[$i]['date_time_id_lunch'] == 13 || $day_list[$i]['date_time_id_dinner'] == 13 || $day_list[$i]['date_time_id_lunch'] == 14 || $day_list[$i]['date_time_id_dinner'] == 14){//20.00 - 21.00?>
											<?php if($product_id == '' || $product_id == 0 || $product_id == $day_list[$i]['product_id']){?>
												<div style="float:left;width: calc(100% - 10px);background:#EFEFEF;padding:5px;<?php if($realitemnum != 0){echo 'margin-top:10px;';}?>border-radius:4px;">
													<div style="float:left;width: 23px;"><?php if($day_list[$i]['wechat_avatar'] != ''){?><img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($day_list[$i]['wechat_avatar'])?>"><?php }else{?><img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>"><?php }?></div>
													<div style="float:left;width: calc(100% - 23px);line-height:18px;color:gray;"><?php echo userTextDecode($day_list[$i]['wechat_nickname']);?> <span style="color:black;"><?php echo $day_list[$i]['user_firstname'].' '.$day_list[$i]['user_lastname'];?></span></div>
													<div style="float:left;width: 100%;margin-top:5px;">
														<div style="float:left;border:1px solid gray;line-height:18px;padding:0px 3px;border-radius:4px;">
															<?php echo $day_list[$i]['product_name'.$this->langtype]?>
														</div>
														<div style="float:left;line-height:18px;margin-left:5px;color:red;">
															<?php echo $day_list[$i]['receive_memo_dietary']?>
														</div>
													</div>
												</div>
												<?php $realitemnum++;?>
											<?php }?>
										<?php }}?>
									<?php }?>
								</td>
							<?php }?>
							<td width="0" align="center" style="border:0px;background:white;"></td>
						</tr>
					</tbody>
				<?php }?>
			<?php }}?>
			
			
		</table>
	<?php }}?>
</div>




<?php $this->load->view('admin/footer')?>