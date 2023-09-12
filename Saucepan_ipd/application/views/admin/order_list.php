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

$all_long_plan_daysnum = 28;
?>
<?php 
	if($this->langtype == '_ch'){
		$weekarray = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期日');
		$montharray = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	}else{
		$weekarray = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
		$montharray = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	}
?>

<table class="gksel_normal_tabaction">
	<tr>
		<td>
			
		</td>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/order/index'?>" method="get">
					<input type="hidden" name="uid" value="<?php echo $uid?>"/>
					<?php 
						if($uid != ''){
							$chaxunuserinfo = $this->UserModel->getuserinfo($uid);
							echo '<div style="float:left;margin:8px 15px 0px 0px;color:red;">';
								if($this->langtype == '_ch'){
									echo '用户: '.userTextDecode($chaxunuserinfo['wechat_nickname']);
								}else{
									echo 'User: '.userTextDecode($chaxunuserinfo['wechat_nickname']);
								}
							echo '</div>';
						}
					?>
					<?php 
						$con = array('orderby'=>'plan_id', 'orderby_res'=>'ASC');
						$planlist = $this->PlanModel->getplanlist($con);
						
						echo '<select name="plan_id" style="float:left;background: url(\''.CDN_URL().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:160px;margin:0px 10px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
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
						
					?>
					<input type="hidden" name="status" value="<?php echo $status?>"/>
					<input type="text" name="keyword" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
					<input type="submit" value="<?php echo lang('cy_search')?>"/>
				</form>
				<!-- 
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/order/index?status='.$status.'&keyword='.$keyword.'&is_excel=1'?>';" style="float: left;margin-top:7px;cursor:pointer;">
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
			<td width="140" align="center"><p><?php if($this->langtype == '_ch'){echo '订单号';}else{echo 'Order Number';}?></p></td>
			<td width="150"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_username')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '套餐';}else{echo 'Plan';}?></p></td>
			<?php if($status != '' && $status == 9){?>
				<td width="150" align="center"><p><?php if($this->langtype == '_ch'){echo '取消原因';}else{echo 'Reason for Cancellation';}?></p></td>
				<td width="90" align="center"><p><?php if($this->langtype == '_ch'){echo '订单金额';}else{echo 'Total Price';}?></p></td>
				<td width="90" align="center"><p><?php if($this->langtype == '_ch'){echo '取消时间';}else{echo 'Cancel Time';}?></p></td>
			<?php }else{?>
				<td width="90" align="center"><p><?php if($this->langtype == '_ch'){echo '实付款';}else{echo 'Total Price';}?></p></td>
				<td width="90" align="center"><p><?php if($this->langtype == '_ch'){echo '订单时间';}else{echo 'Order Time';}?></p></td>
			<?php }?>
			<td width="90" align="center"><p><?php echo lang('cy_status')?></p></td>
			<td width="180" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($orderlist)){for ($i = 0; $i < count($orderlist); $i++) {?>
			<tr>
				<td align="center"><?php echo ($i+1)?></td>
				<td align="left">
					<div style="float:left;width: 100%;">
						<?php echo $orderlist[$i]['order_number']?>
					</div>
					
					<?php if($orderlist[$i]['receive_memo_delivery'] != ''){?>
						<div style="float:left;width: 100%;margin-top:5px;color:red;line-height:24px;">
							<span style="border:1px solid red;padding:3px 3px;border-radius:4px;">Delivery notes:</span> <?php echo $orderlist[$i]['receive_memo_delivery']?>
						</div>
					<?php }?>
					<?php if($orderlist[$i]['receive_memo_dietary'] != ''){?>
						<div style="float:left;width: 100%;margin-top:5px;color:red;line-height:24px;">
							<span style="border:1px solid red;padding:3px 3px;border-radius:4px;">Kitchen notes:</span> <?php echo $orderlist[$i]['receive_memo_dietary']?>
						</div>
					<?php }?>
				</td>
				<td>
					<div style="float:left;width: 100%;">
						<div style="float:left;width: 23px;">
							<?php if($orderlist[$i]['wechat_avatar'] != ''){?>
								<img style="float:left;width:18px;height:18px;" src="<?php echo $orderlist[$i]['wechat_avatar']?>">
							<?php }else{?>
								<img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>">
							<?php }?>
						</div>
						<div style="float:left;width: calc(100% - 23px);line-height:18px;"><?php echo actionsearchdaxiaoxiezimu($keyword, userTextDecode($orderlist[$i]['wechat_nickname']));?></div>
					</div>
					
				</td>
				<td align="left">
					<div style="float:left;width: 100%;">
						<?php if($orderlist[$i]['plan_id'] == 1){?>
							<div style="float:left;border:2px solid #ddd;line-height:22px;padding:0px 5px;border-radius:5px;">
								<?php echo $orderlist[$i]['plan_name'.$this->langtype]?>
							</div>
						<?php }else if($orderlist[$i]['plan_id'] == 2){?>
							<div style="float:left;border:2px solid orange;line-height:22px;padding:0px 5px;border-radius:5px;">
								<?php echo $orderlist[$i]['plan_name'.$this->langtype]?>
							</div>
						<?php }else if($orderlist[$i]['plan_id'] == 3){?>
							<div style="float:left;border:2px solid #adf94b;line-height:22px;padding:0px 5px;border-radius:5px;">
								<?php echo $orderlist[$i]['plan_name'.$this->langtype]?>
							</div>
						<?php }else if($orderlist[$i]['plan_id'] == 4){?>
							<div style="float:left;border:2px solid green;line-height:22px;padding:0px 5px;border-radius:5px;">
								<?php echo $orderlist[$i]['plan_name'.$this->langtype]?>
							</div>
						<?php }?>
						<div style="float:left;margin-left:10px;color:#999;">
							<?php 
								if($orderlist[$i]['daily_meals_id'] == 1){//只有午餐
									if($this->langtype == '_ch'){echo '[午餐]';}else{echo '[Lunch]';}
								}else if($orderlist[$i]['daily_meals_id'] == 2){//只有晚餐
									if($this->langtype == '_ch'){echo '[晚餐]';}else{echo '[Dinner]';}
								}else if($orderlist[$i]['daily_meals_id'] == 3){//午餐和晚餐
									if($this->langtype == '_ch'){echo '[午餐和晚餐]';}else{echo '[Lunch and dinner]';}
								}else{
									if($this->langtype == '_ch'){echo '[早餐，午餐和晚餐]';}else{echo '[Breakfast, Lunch and dinner]';}
								}
							?>
						</div>
					</div>
					<div style="float:left;width:100%;margin-top:5px;">
						<?php echo $weekarray[date('w', $orderlist[$i]['firstday_int'])].' '.date('d M Y', $orderlist[$i]['firstday_int'])?>
						- 
						<?php echo $weekarray[date('w', $orderlist[$i]['lastday_int'])].' '.date('d M Y', $orderlist[$i]['lastday_int'])?>
					</div>
					<div style="float:left;width: 100%;margin-top:5px;">
						<?php echo $orderlist[$i]['product_name'.$this->langtype].'// '.$orderlist[$i]['product_tagline'.$this->langtype]?>
					</div>
					<div style="float:left;width: 100%;margin-top:5px;">
						Cutlery: 
						<?php
							if($orderlist[$i]['cutlery_price_rmb'] > 0){
								echo '<span style="color:green;font-weight:bold;">Yes</span>';
							}else{
								echo '<span style="color:red;font-weight:bold;">No</span>';
							}
						?>
					</div>
					<div style="float:left;width: 100%;margin-top:5px;">
						<?php 
							if($orderlist[$i]['plan_id'] == 1){
								if($this->langtype == '_ch'){echo '每周日期';}else{echo 'Weekly delivery days';}
							}else{
								if($orderlist[$i]['weekdayplan_id'] == 1){
									if($this->langtype == '_ch'){echo '整周';}else{echo 'Full week plan';}
								}else if($orderlist[$i]['weekdayplan_id'] == 2){
									if($this->langtype == '_ch'){echo '工作日';}else{echo 'Weekday only plan';}
								}
							}
						?>
						
						<div style="float:left;width: 100%;">
							<?php 
								if($orderlist[$i]['plan_id'] == 1){
									if($orderlist[$i]['week_days'] != ''){
										$week_days_split = explode('_', $orderlist[$i]['week_days']);
										if(!empty($week_days_split)){
											for ($w = 0; $w < count($week_days_split); $w++) {
												if($w != 0){
													echo ', ';
												}
												if($week_days_split[$w] == 1){
													if($this->langtype == '_ch'){echo '星期一';}else{echo 'Monday';}
												}else if($week_days_split[$w] == 2){
													if($this->langtype == '_ch'){echo '星期二';}else{echo 'Tuesday';}
												}else if($week_days_split[$w] == 3){
													if($this->langtype == '_ch'){echo '星期三';}else{echo 'Wednesday';}
												}else if($week_days_split[$w] == 4){
													if($this->langtype == '_ch'){echo '星期四';}else{echo 'Thursday';}
												}else if($week_days_split[$w] == 5){
													if($this->langtype == '_ch'){echo '星期五';}else{echo 'Friday';}
												}else if($week_days_split[$w] == 6){
													if($this->langtype == '_ch'){echo '星期六';}else{echo 'Saturday';}
												}else{
													if($this->langtype == '_ch'){echo '星期日';}else{echo 'Sunday';}
												}
											}
										}
									}
								}else{
									if($orderlist[$i]['weekdayplan_id'] == 1){
										if($this->langtype == '_ch'){echo '周一至周日';}else{echo 'Monday - Sunday';}
									}else if($orderlist[$i]['weekdayplan_id'] == 2){
										if($this->langtype == '_ch'){echo '周一至周五';}else{echo 'Monday - Friday';}
									}
								}
							?>
						</div>
					</div>
					
					<?php 
						$con = array('order_id'=>$orderlist[$i]['order_id'], 'action_status'=>0, 'orderby'=>'a.day_id', 'orderby_res'=>'ASC');
						$count_day_all = $this->OrderModel->getdaylist($con, 1);
						
						
						$con = array('other_con'=>' a.date_int < '.strtotime(date('Y-m-d').'00:00:00'), 'order_id'=>$orderlist[$i]['order_id'], 'action_status'=>0, 'orderby'=>'a.day_id', 'orderby_res'=>'ASC');
						$count_day_pasted = $this->OrderModel->getdaylist($con, 1);
					?>
					<div style="float:left;width:100%;">
						<div style="float:left;width:<?php echo ($count_day_all/$all_long_plan_daysnum) * 100?>%;height:20px;background:#EFEFEF;border:1px solid gray;margin-top:5px;border-radius:10px;">
							<div style="float:left;width:<?php echo ($count_day_pasted/$count_day_all) * 100?>%;height:20px;background:#adf94b;border-top-left-radius:10px;border-bottom-left-radius:10px;<?php if(($count_day_pasted/$count_day_all) == 1){echo 'border-top-right-radius:10px;border-bottom-right-radius:10px;';}?>"></div>
						</div>
					</div>
					<div style="float:left;width:100%;">
						<div style="float:left;width:<?php echo ($count_day_all/$all_long_plan_daysnum) * 100?>%;margin-top:5px;">
							<div style="float:left;">
								0 d
							</div>
							<div style="float:right;">
								<?php 
									if($this->langtype == '_ch'){echo $count_day_all.' d<br />';}else{echo $count_day_all.' d<br />';}
								?>
							</div>
						</div>
					</div>
				</td>
				<?php if($status != '' && $status == 9){?>
					<td><?php echo $orderlist[$i]['delete_memo']?></td>
				<?php }else{?>
					
				<?php }?>
				<td align="center">
					<div style="float:left;width: 100%;">
						<?php echo '&yen;'.number_format($orderlist[$i]['total_price_rmb'], 2, ".", ",")?>
					</div>
				</td>
				<?php if($status != '' && $status == 9){?>
					<td align="center"><?php echo date('Y-m-d', $orderlist[$i]['delete_time']).'<br />'.date('H:i:s', $orderlist[$i]['delete_time'])?></td>
				<?php }else{?>
					<td align="center"><?php echo date('Y-m-d', $orderlist[$i]['created']).'<br />'.date('H:i:s', $orderlist[$i]['created'])?></td>
				<?php }?>
				
				<td align="center">
					<?php 
						if($this->langtype == '_ch'){
							if($orderlist[$i]['status'] == 0){
								echo '<span style="color:red;">未付款</span>';
							}else if($orderlist[$i]['status'] == 1 || $orderlist[$i]['status'] == 11){
								if($orderlist[$i]['lastday_int'] > strtotime(date('Y-m-d').' 00:00:00')){
									echo '<span style="color:orange;">进行中</span>';
								}else{
									echo '<span style="color:green;">已完成</span>';
								}
							}
						}else{
							if($orderlist[$i]['status'] == 0){
								echo '<span style="color:red;">Unpaid</span>';
							}else if($orderlist[$i]['status'] == 1 || $orderlist[$i]['status'] == 11){
								if($orderlist[$i]['lastday_int'] > strtotime(date('Y-m-d').' 00:00:00')){
									echo '<span style="color:orange;">Process</span>';
								}else{
									echo '<span style="color:green;">Completed</span>';
								}
							}
						}
					?>
				</td>
				<td align="center">
					<div style="float:right;">
						<?php 
							
							if($this->langtype == '_ch'){
								$cy_view_text = '查看';
							}else{
								$cy_view_text = 'View';
							}
							echo '<a href="'.base_url().'index.php/admins/order/toview_order/'.$orderlist[$i]['order_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.$cy_view_text.'</a>';
						
							if($orderlist[$i]['status'] == 0){
								if(date('Y-m-d', $orderlist[$i]['created']) != date('Y-m-d')){
									echo '<a onclick="todel_order('.$orderlist[$i]["order_id"].', \''.$orderlist[$i]['order_number'].'\')" href="javascript:;" class="gksel_btn_action_on">Delete</a>';
								}else{
									echo '<a href="javascript:;" title="Can be deleted after 24 hours" class="gksel_btn_action_off">Delete</a>';
								}
							}
								
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>

<script>
//删除商品
function todel_order(id, name){
	var title = 'Are you sure to delete <font style="color:red;">【'+name+'】</font>?';
	var subtitle = '';
	del_url = encodeURI(baseurl+"index.php/admins/order/del_order/"+id);
	todel(title, subtitle);
}
</script>

<?php $this->load->view('admin/footer')?>