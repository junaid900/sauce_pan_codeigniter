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

$uid = $this->input->get('uid');
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
	$con = array('other_con'=>' a.date_int >= '.strtotime(date('Y-m-d').' 00:00:00'), 'order_status'=>'1', 'orderby'=>'a.day_id', 'orderby_res'=>'DESC');
	$count_live = $this->OrderModel->getdaylist($con, 1);
	
	$con = array('other_con'=>' a.date_int < '.strtotime(date('Y-m-d').' 00:00:00'), 'order_status'=>'1', 'orderby'=>'a.day_id', 'orderby_res'=>'DESC');
	$count_expirated = $this->OrderModel->getdaylist($con, 1);
?>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div style="float:left;">
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/order/alltotalmealslist'?>';" style="cursor:pointer;float:left;margin-left:5px;margin-top:-4px;background:#CCC;color:gray;font-size:12px;padding:6px 8px;">
					Live meals <span style="color:green;">(<?php echo $count_live?>)</span>
				</div>
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/order/alltotalmealslist_expirated'?>';" style="cursor:pointer;float:left;margin-left:5px;margin-top:-4px;background:rgb(171,16,50);color:white;font-size:12px;padding:6px 8px;">
					Expirated meals <span style="color:gray;">(<?php echo $count_expirated?>)</span>
				</div>
			</div>
		</td>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/order/dailytotalmealslist'?>" method="get">
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
			<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '日期';}else{echo 'Date';}?></p></td>
			<td width="150"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_username')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '套餐';}else{echo 'Plan';}?></p></td>
			<td width="250" align="center"><p><?php if($this->langtype == '_ch'){echo '午餐';}else{echo 'Lunch';}?></p></td>
			<td width="250" align="center"><p><?php if($this->langtype == '_ch'){echo '晚餐';}else{echo 'Dinner';}?></p></td>
			<td width="250" align="center"><p><?php if($this->langtype == '_ch'){echo '晚餐 + 第二天早餐';}else{echo 'Dinner + next day\'s breakfast';}?></p></td>
			<td width="150" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($day_list)){for ($i = 0; $i < count($day_list); $i++) {?>
			<?php 
				if($day_list[$i]['action_status'] == 1 || $day_list[$i]['action_status'] == 2){
					$thisliststyle = 'opacity:0.2;';
				}else{
					if($day_list[$i]['date_int'] >= strtotime(date('Y-m-d').' 00:00:00')){
						$thisliststyle = '';
					}else{
						//已经过期
						$thisliststyle = 'opacity:0.2;';
					}
				}
				
			?>
			<tr style="<?php echo $thisliststyle?>">
				<td align="center"><?php echo ($i+1)?></td>
				<td align="center">
					<div style="float:left;width: 100%;">
						<?php echo $day_list[$i]['date_show']?>
					</div>
					<div style="float:left;width: 100%;margin-top:5px;">
						<?php 
							if($day_list[$i]['action_status'] == 1){
								echo '<span style="border-bottom:2px solid orange;color:orange;font-size:20px;">Paused</span>';
							}else if($day_list[$i]['action_status'] == 2){
								echo '<span style="border-bottom:2px solid red;color:red;font-size:20px;">Cancelled</span>';
							}else{
								echo '';
							}
						?>
					</div>
				</td>
				<td>
					<div style="float:left;width: 100%;">
						<div style="float:left;width: 23px;">
							<?php if($day_list[$i]['wechat_avatar'] != ''){?>
								<img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($day_list[$i]['wechat_avatar'])?>">
							<?php }else{?>
								<img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>">
							<?php }?>
						</div>
						<div style="float:left;width: calc(100% - 23px);line-height:18px;"><?php echo actionsearchdaxiaoxiezimu($keyword, userTextDecode($day_list[$i]['wechat_nickname']));?></div>
					</div>
				</td>
				<td align="left">
					<div style="float:left;width: 100%;">
						<?php 
							if($day_list[$i]['daily_meals_id'] == 1){//只有午餐
								if($this->langtype == '_ch'){
									echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;">午餐</div>';
								}else{
									echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;">Lunch</div>';
								}
							}else if($day_list[$i]['daily_meals_id'] == 2){//只有晚餐
								if($this->langtype == '_ch'){
									echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;">晚餐</div>';
								}else{
									echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;">Dinner</div>';
								}
							}else if($day_list[$i]['daily_meals_id'] == 3){//午餐 + 晚餐
							if($this->langtype == '_ch'){
																			echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;">午餐</div>';
																		}else{
																			echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;">Lunch</div>';
																		}
							}else if($day_list[$i]['daily_meals_id'] == 4){//早餐 + 午餐 + 晚餐
							if($this->langtype == '_ch'){
																			echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;">午餐</div>';
																		echo '<div style="float:left;width:100%;">';
																		}else{
																			echo '<div style="float:left;width:calc(120px - 5px);margin-top:5px;padding-left:5px;">Lunch</div>';
																		echo '<div style="float:left;width:calc(100% - 120px - 5px  - 1px - 80px - 1px);">';
																		}
							}
						?>
					</div>
					<div style="float:left;width: 100%;margin-top:5px;">
						<?php echo $day_list[$i]['product_name'.$this->langtype].'// '.$day_list[$i]['product_tagline'.$this->langtype]?>
					</div>
				</td>
				
				<td align="center">
					<div style="float:left;width: 100%;">
						<?php 
							if($day_list[$i]['daily_meals_id'] == 1){//只有午餐
								echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $day_list[$i]['lunch_time_name2'.$this->langtype];
								echo '</div>';
								echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $day_list[$i]['lunch_address_marked'].' - '.$day_list[$i]['lunch_address_formattedaddress'];
								echo '</div>';
								if($day_list[$i]['date_address_id_lunch_shipped'] == 1){
									echo '
										<div style="float:left;width:100%;">
											<div style="float:left;width:80px;margin-left:calc(50% - 40px);line-height:16px;">
												<div style="float:left;margin-left:5px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
												<div style="float:left;margin-left:5px;">'.$text_shipped.'</div>
											</div>
										</div>
									';
									if($day_list[$i]['date_address_id_lunch_memo'] != ''){
										echo '
											<div style="float:left;width:100%;">
												'.$day_list[$i]['date_address_id_lunch_memo'].'
											</div>
										';
									}
								}
							}else if($day_list[$i]['daily_meals_id'] == 2){//只有晚餐
								
							}else if($day_list[$i]['daily_meals_id'] == 3){//午餐 + 晚餐
								echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $day_list[$i]['lunch_time_name2'.$this->langtype];
								echo '</div>';
								echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $day_list[$i]['lunch_address_marked'].' - '.$day_list[$i]['lunch_address_formattedaddress'];
								echo '</div>';
								
								if($day_list[$i]['date_address_id_lunch_shipped'] == 1){
									echo '
										<div style="float:left;width:100%;">
											<div style="float:left;width:80px;margin-left:calc(50% - 40px);line-height:16px;">
												<div style="float:left;margin-left:5px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
												<div style="float:left;margin-left:5px;">'.$text_shipped.'</div>
											</div>
										</div>
									';
									if($day_list[$i]['date_address_id_lunch_memo'] != ''){
										echo '
											<div style="float:left;width:100%;">
												'.$day_list[$i]['date_address_id_lunch_memo'].'
											</div>
										';
									}
								}
							}else if($day_list[$i]['daily_meals_id'] == 4){//早餐 + 午餐 + 晚餐
								echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $day_list[$i]['lunch_time_name2'.$this->langtype];
								echo '</div>';
								echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $day_list[$i]['lunch_address_marked'].' - '.$day_list[$i]['lunch_address_formattedaddress'];
								echo '</div>';
								

								if($day_list[$i]['date_address_id_lunch_shipped'] == 1){
									echo '
										<div style="float:left;width:100%;">
											<div style="float:left;width:80px;margin-left:calc(50% - 40px);line-height:16px;">
												<div style="float:left;margin-left:5px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
												<div style="float:left;margin-left:5px;">'.$text_shipped.'</div>
											</div>
										</div>
									';
									if($day_list[$i]['date_address_id_lunch_memo'] != ''){
										echo '
											<div style="float:left;width:100%;">
												'.$day_list[$i]['date_address_id_lunch_memo'].'
											</div>
										';
									}
								}
							}
							
						?>
					</div>
				</td>
				
				<td align="center">
					<div style="float:left;width: 100%;">
						<?php 
							if($day_list[$i]['daily_meals_id'] == 1){//只有午餐
								
							}else if($day_list[$i]['daily_meals_id'] == 2){//只有晚餐
								echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $day_list[$i]['dinner_time_name2'.$this->langtype];
								echo '</div>';
								echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $day_list[$i]['dinner_address_marked'].' - '.$day_list[$i]['dinner_address_formattedaddress'];
								echo '</div>';
								
								if($day_list[$i]['date_address_id_dinner_shipped'] == 1){
									echo '
										<div style="float:left;width:100%;">
											<div style="float:left;width:80px;margin-left:calc(50% - 40px);line-height:16px;">
												<div style="float:left;margin-left:5px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
												<div style="float:left;margin-left:5px;">'.$text_shipped.'</div>
											</div>
										</div>
									';
									if($day_list[$i]['date_address_id_dinner_memo'] != ''){
										echo '
											<div style="float:left;width:100%;">
												'.$day_list[$i]['date_address_id_dinner_memo'].'
											</div>
										';
									}
								}
							}else if($day_list[$i]['daily_meals_id'] == 3){//午餐 + 晚餐
								echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $day_list[$i]['dinner_time_name2'.$this->langtype];
								echo '</div>';
								echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $day_list[$i]['dinner_address_marked'].' - '.$day_list[$i]['dinner_address_formattedaddress'];
								echo '</div>';
								
								if($day_list[$i]['date_address_id_dinner_shipped'] == 1){
									echo '
										<div style="float:left;width:100%;">
											<div style="float:left;width:80px;margin-left:calc(50% - 40px);line-height:16px;">
												<div style="float:left;margin-left:5px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
												<div style="float:left;margin-left:5px;">'.$text_shipped.'</div>
											</div>
										</div>
									';
									if($day_list[$i]['date_address_id_dinner_memo'] != ''){
										echo '
											<div style="float:left;width:100%;">
												'.$day_list[$i]['date_address_id_dinner_memo'].'
											</div>
										';
									}
								}
							}else if($day_list[$i]['daily_meals_id'] == 4){//早餐 + 午餐 + 晚餐
								
							}
						?>
					</div>
				</td>
				
				
				<td align="center">
					<div style="float:left;width: 100%;">
						<?php 
							if($day_list[$i]['daily_meals_id'] == 1){//只有午餐
								
							}else if($day_list[$i]['daily_meals_id'] == 2){//只有晚餐
								
							}else if($day_list[$i]['daily_meals_id'] == 3){//午餐 + 晚餐
								
							}else if($day_list[$i]['daily_meals_id'] == 4){//早餐 + 午餐 + 晚餐
								echo '<div style="float:left;width:100%;margin-top:5px;">';
									echo $day_list[$i]['dinner_time_name2'.$this->langtype];
								echo '</div>';
								echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;">';
									echo $day_list[$i]['dinner_address_marked'].' - '.$day_list[$i]['dinner_address_formattedaddress'];
								echo '</div>';
								
								if($day_list[$i]['date_address_id_dinner_shipped'] == 1){
									echo '
										<div style="float:left;width:100%;">
											<div style="float:left;width:80px;margin-left:calc(50% - 40px);line-height:16px;">
												<div style="float:left;margin-left:5px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
												<div style="float:left;margin-left:5px;">'.$text_shipped.'</div>
											</div>
										</div>
									';
									if($day_list[$i]['date_address_id_dinner_memo'] != ''){
										echo '
											<div style="float:left;width:100%;">
												'.$day_list[$i]['date_address_id_dinner_memo'].'
											</div>
										';
									}
								}
							}
						?>
					</div>
				</td>
				
				<td align="center">
					<?php 
// 						if($day_list[$i]['action_status'] == 0){
// 							if(strtotime(date('Y-m-d', $day_list[$i]['date_int']).' 00:00:00') > strtotime(date('Y-m-d').' 00:00:00')){
// 								echo '<a href="javascript:;" class="gksel_btn_action_off">Ship</a>';
// 							}else if(strtotime(date('Y-m-d', $day_list[$i]['date_int']).' 00:00:00') == strtotime(date('Y-m-d').' 00:00:00')){
// 								echo '<a href="'.base_url().'index.php/admins/order/meals_toview/'.$day_list[$i]['day_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">Ship</a>';
// 							}else{
// 								echo '<a href="'.base_url().'index.php/admins/order/meals_toview/'.$day_list[$i]['day_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">Ship</a>';
// 							}
// 						}
						
						echo '<a href="'.base_url().'index.php/admins/order/meals_toview/'.$day_list[$i]['day_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">View</a>';
					?>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>

<?php $this->load->view('admin/footer')?>