<?php $this->load->view('admin/header');?>


<?php 
	$userinfo = $this->UserModel->getuserinfo($orderinfo['uid']);
?>
<?php 
	if($this->langtype == '_ch'){
		$text_shipped = '已配送';
		$text_paused = '已暂停';
		$text_cancelled = '已取消';
	}else{
		$text_shipped = 'Shipped';
		$text_paused = 'Paused';
		$text_cancelled = 'Cancelled';
	}
?>
<div class="gksel_shippingproduct_box_bg"></div>
<div class="gksel_shippingproduct_box">
	<table>
		<tr>
			<td>
				<div class="gksel_shippingproduct_content">
					<div class="close"><img onclick="toclose_shippingproductbox()" src="<?php echo base_url().'themes/default/images/close.png'?>"></div>
					<div class="title"></div>
					<div class="subtitle"></div>
					<div style="float:left;width:100%;">&nbsp;</div>
				</div>
			</td>
		</tr>
	</table>
</div>



	

	
<div style="float:left;width:100%;margin:10px 0px;font-weight:bold;font-size:16px;">&nbsp;<?php echo lang('order_number')?>&nbsp;&nbsp;<?php echo $orderinfo['order_number']?></div>
<table width="100%" cellspacing=0 cellpadding=0>
			<tr>
				<td valign="top" width="50%">
					<table width="100%" cellspacing=0 cellpadding=0>
							<tr>
								<td colspan="2">
									<div class="refund_loglist_l">
										<table width="100%" cellpadding="0" cellspacing="0" border=0 style="border:1px solid #ddd;">
											<tr>
												<th colspan="2" align="center"><?php if($this->langtype == '_ch'){echo '订单信息';}else{echo 'Order Information';}?></th>
											</tr>
											<tr>
												<td align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '微信';}else{echo 'Wechat';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<div style="float:left;width: 100%;">
														<div style="float:left;width: 23px;">
															<?php if($orderinfo['wechat_avatar'] != ''){?>
																<img style="float:left;width:18px;height:18px;" src="<?php echo $orderinfo['wechat_avatar']?>">
															<?php }else{?>
																<img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>">
															<?php }?>
														</div>
														<div style="float:left;width: calc(100% - 23px);line-height:18px;"><?php echo userTextDecode($userinfo['wechat_nickname']);?></div>
													</div>
												</td>
											</tr>
											<tr>
												<td align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '用户名';}else{echo 'Username';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<?php echo $userinfo['user_firstname'].' '.$userinfo['user_lastname'];?>
												</td>
											</tr>
											<tr>
												<td align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '手机号码';}else{echo 'Phone';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<?php echo $userinfo['user_phone'];?>
												</td>
											</tr>
											<tr>
												<td align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '邮箱';}else{echo 'Email';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<?php echo $userinfo['user_email'];?>
												</td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php echo lang('cy_status')?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<?php 
														if($this->langtype == '_ch'){
															if($orderinfo['status'] == 0){
																echo '<span style="color:red;">未付款</span>';
															}else if($orderinfo['status'] == 1 || $orderinfo['status'] == 11){
																if($orderinfo['lastday_int'] > strtotime(date('Y-m-d').' 00:00:00')){
																	echo '<span style="color:orange;">进行中</span>';
																}else{
																	echo '<span style="color:green;">已完成</span>';
																}
															}
														}else{
															if($orderinfo['status'] == 0){
																echo '<span style="color:red;">Unpaid</span>';
															}else if($orderinfo['status'] == 1 || $orderinfo['status'] == 11){
																if($orderinfo['lastday_int'] > strtotime(date('Y-m-d').' 00:00:00')){
																	echo '<span style="color:orange;">Process</span>';
																}else{
																	echo '<span style="color:green;">Completed</span>';
																}
															}
														}
													?>
												</td>
											</tr>
											<tr>
												<td align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '付款方式';}else{echo 'Payment method';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<div style="float:left;width:100%;">
														<?php 
															if($orderinfo['status'] == 0){
																
															}else if($orderinfo['status'] == 10){
																if($this->langtype == '_ch'){echo '公司转账';}else{echo 'Wire Transfer';}
																
																if($orderinfo['transfer_pic'] != ''){
																	echo '<br /><img style="width:100px;height:100px;" src="'.base_url().$orderinfo['transfer_pic'].'"/>';
																}
															}else{
																if($orderinfo['paymentmethod_id'] == 1){
																	if($this->langtype == '_ch'){echo '微信支付';}else{echo 'Wechat Pay';}
																}else if($orderinfo['paymentmethod_id'] == 2){
																	if($this->langtype == '_ch'){echo '支付宝';}else{echo 'Alipay';}
																}else if($orderinfo['paymentmethod_id'] == 7){
																	if($this->langtype == '_ch'){echo '公司转账';}else{echo 'Wire Transfer';}
																	
																	if($orderinfo['transfer_pic'] != ''){
																		echo '<br /><img style="width:100px;height:100px;" src="'.base_url().$orderinfo['transfer_pic'].'"/>';
																	}
																	
																}
															}
														?>
													</div>
													<?php if($orderinfo['wechatpay_transaction_id'] != ''){?>
														<div style="float:left;width:calc(100% - 20px);margin-top:5px;background:#EFEFEF;padding:10px;border-radius:6px;">
															<div style="float:left;width:100%;">
																<div style="float:left;width:90px;text-align:left;">Bank Type</div>
																<div style="float:left;width:calc(100% - 90px);"><?php echo $orderinfo['wechatpay_bank_type']?></div>
															</div>
															<div style="float:left;width:100%;margin-top:5px;">
																<div style="float:left;width:90px;text-align:left;">Fee Type</div>
																<div style="float:left;width:calc(100% - 90px);"><?php echo $orderinfo['wechatpay_fee_type']?></div>
															</div>
															<div style="float:left;width:100%;margin-top:5px;">
																<div style="float:left;width:90px;text-align:left;">Pay Amount</div>
																<div style="float:left;width:calc(100% - 90px);"><?php echo '&yen;'.$orderinfo['wechatpay_total']?></div>
															</div>
															<div style="float:left;width:100%;margin-top:5px;">
																<div style="float:left;width:90px;text-align:left;">Transaction ID</div>
																<div style="float:left;width:calc(100% - 90px);"><?php echo $orderinfo['wechatpay_transaction_id']?></div>
															</div>
															<div style="float:left;width:100%;margin-top:5px;">
																<div style="float:left;width:90px;text-align:left;">Pay Time</div>
																<div style="float:left;width:calc(100% - 90px);"><?php echo date('Y-m-d H:i:s', $orderinfo['wechatpay_time'])?></div>
															</div>
														</div>
													<?php }?>
												</td>
											</tr>
											<tr>
												<td align="right" style="border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '订单时间';}else{echo 'Order Time';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;"><?php echo date('Y-m-d H:i:s',$orderinfo['created'])?></td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="refund_loglist_l">
										<table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #ddd;">
											<tr>
												<th colspan="2" align="center"><?php if($this->langtype == '_ch'){echo '价格';}else{echo 'Price';}?></th>
											</tr>
											<tr >
												<td width="150" align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '套餐价格';}else{echo 'Plan Price';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;"><?php echo '&yen;'.number_format($orderinfo['plan_price_rmb'], 2, ".", ",")?></td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;">Cutlery price&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<?php 
														if($orderinfo['cutlery_price_rmb'] > 0){
															echo '&yen;'.number_format($orderinfo['cutlery_price_rmb'], 2, ".", ",");
														}else{
															echo '<span>--</span>';
														}
													?>
												</td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;">Shipping fee&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<?php 
														if($orderinfo['express_price_rmb'] > 0){
															echo '&yen;'.number_format($orderinfo['express_price_rmb'], 2, ".", ",");
														}else{
															echo '<span>for free</span>';
														}
													?>
												</td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;">Use sp points&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;"><?php echo '&yen;'.number_format($orderinfo['sppoints_price_rmb'], 2, ".", ",").' ('.$orderinfo['sppoints_use'].' pts)'?></td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;">Coupon price&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<?php 
														if($orderinfo['coupon_percent'] != 0){
															echo '&yen;'.number_format($orderinfo['coupon_price_rmb'], 2, ".", ",");
															echo ' ('.((1 - $orderinfo['coupon_percent'])*100).'% OFF)';
														}else{
															echo '&yen;'.number_format($orderinfo['coupon_price_rmb'], 2, ".", ",");
														}
													?>
												</td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '总价';}else{echo 'Total Price';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;"><?php echo '&yen;'.number_format($orderinfo['total_price_rmb'], 2, ".", ",")?></td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
							
							<tr>
								<td colspan="2">
									<?php 
										$userinfo = $this->UserModel->getuserinfo($orderinfo['uid']);
										$planinfo = $this->PlanModel->getplaninfo($orderinfo['plan_id']);
										$productinfo = $this->ProductModel->getproductinfo($orderinfo['product_id']);
										
										$plan_id = $orderinfo['plan_id'];
										$weekdayplan_id = $orderinfo['weekdayplan_id'];
										$daily_meals_id = $orderinfo['daily_meals_id'];
										$start_date = $orderinfo['start_date_show'];
										$week_num = $orderinfo['week_num'];
										$week_days = $orderinfo['week_days'];
										
										$time_id_lunch = $orderinfo['time_id_lunch'];
										$address_id_lunch = $orderinfo['address_id_lunch'];
										
										$time_id_dinner = $orderinfo['time_id_dinner'];
										$address_id_dinner = $orderinfo['address_id_dinner'];
									?>
									<div class="refund_loglist_l">
										<table width="100%" cellpadding="0" cellspacing="0" border=0 style="border:1px solid #ddd;">
											<tr>
												<th colspan="2" align="center"><?php if($this->langtype == '_ch'){echo '套餐详细';}else{echo 'Plan Detail';}?></th>
											</tr>
											<tr>
												<td align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '套餐';}else{echo 'Plan';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<div style="float:left;width: 100%;">
														<?php echo $planinfo['plan_name'.$this->langtype]?>
													</div>
													<div style="float:left;width:100%;margin-top:5px;">
														<?php 
															if($this->langtype == '_ch'){
																$weekarray = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期日');
																$montharray = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
															}else{
																$weekarray = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
																$montharray = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
															}
														?>
														<?php echo $weekarray[date('w', $orderinfo['firstday_int'])].' '.date('d M Y', $orderinfo['firstday_int'])?>
														- 
														<?php echo $weekarray[date('w', $orderinfo['lastday_int'])].' '.date('d M Y', $orderinfo['lastday_int'])?>
													</div>
												</td>
											</tr>
											<tr>
												<td align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php 
														if($plan_id == 1){
															if($this->langtype == '_ch'){echo '每周日期';}else{echo 'Weekly delivery days';}
														}else{
															if($weekdayplan_id == 1){
																if($this->langtype == '_ch'){echo '整周';}else{echo 'Full week plan';}
															}else if($weekdayplan_id == 2){
																if($this->langtype == '_ch'){echo '工作日';}else{echo 'Weekday only plan';}
															}
														}
														?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<div style="float:left;width: 100%;">
														<?php 
															if($plan_id == 1){
																if($week_days != ''){
																	$week_days_split = explode('_', $week_days);
																	if(!empty($week_days_split)){
																		for ($i = 0; $i < count($week_days_split); $i++) {
																			if($i != 0){
																				echo ', ';
																			}
																			if($week_days_split[$i] == 1){
																				if($this->langtype == '_ch'){echo '星期一';}else{echo 'Monday';}
																			}else if($week_days_split[$i] == 2){
																				if($this->langtype == '_ch'){echo '星期二';}else{echo 'Tuesday';}
																			}else if($week_days_split[$i] == 3){
																				if($this->langtype == '_ch'){echo '星期三';}else{echo 'Wednesday';}
																			}else if($week_days_split[$i] == 4){
																				if($this->langtype == '_ch'){echo '星期四';}else{echo 'Thursday';}
																			}else if($week_days_split[$i] == 5){
																				if($this->langtype == '_ch'){echo '星期五';}else{echo 'Friday';}
																			}else if($week_days_split[$i] == 6){
																				if($this->langtype == '_ch'){echo '星期六';}else{echo 'Saturday';}
																			}else{
																				if($this->langtype == '_ch'){echo '星期日';}else{echo 'Sunday';}
																			}
																		}
																	}
																}
															}else{
																if($weekdayplan_id == 1){
																	if($this->langtype == '_ch'){echo '周一至周日';}else{echo 'Monday - Sunday';}
																}else if($weekdayplan_id == 2){
																	if($this->langtype == '_ch'){echo '周一至周五';}else{echo 'Monday - Friday';}
																}
															}
														?>
													</div>
												</td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '菜单选择';}else{echo 'Menu Select';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;"><?php echo $productinfo['product_name'.$this->langtype].'// '.$productinfo['product_tagline'.$this->langtype]?></td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><?php if($this->langtype == '_ch'){echo '每日膳食';}else{echo 'Daily meals';}?>&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<?php 
														if($daily_meals_id == 1){//只有午餐
															if($this->langtype == '_ch'){echo '午餐';}else{echo 'Lunch';}
														}else if($daily_meals_id == 2){//只有晚餐
															if($this->langtype == '_ch'){echo '晚餐';}else{echo 'Dinner';}
														}else if($daily_meals_id == 3){//午餐和晚餐
															if($this->langtype == '_ch'){echo '午餐和晚餐';}else{echo 'Lunch and dinner';}
														}else{
															if($this->langtype == '_ch'){echo '早餐，午餐和晚餐';}else{echo 'Breakfast, Lunch and dinner';}
														}
													?>
												</td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;">Cutlery&nbsp;&nbsp;&nbsp;</td>
												<td style="color:gray;padding:5px 5px;border-bottom:1px solid #ddd;">
													<?php 
														if($orderinfo['cutlery_price_rmb'] > 0){
															echo '<span style="color:green;font-weight:bold;">Yes</span>';
														}else{
															echo '<span style="color:gray;font-weight:bold;">No</span>';
														}
													?>
												</td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;">Delivery notes&nbsp;&nbsp;&nbsp;</td>
												<td style="color:red;padding:5px 5px;border-bottom:1px solid #ddd;">
													<?php echo $orderinfo['receive_memo_delivery']?>
												</td>
											</tr>
											<tr>
												<td width="150" align="right" style="border-right:1px solid #ddd;">Kitchen notes&nbsp;&nbsp;&nbsp;</td>
												<td style="color:red;padding:5px 5px;">
													<?php echo $orderinfo['receive_memo_dietary']?>
												</td>
											</tr>
											
										</table>
									</div>
								</td>
							</tr>
							<?php if($orderinfo['status'] == 1 || $orderinfo['status'] == 11){?>
								<!-- 
								<tr>
									<td height="30" align="right" width="40%"></td>
									<td><a href="javascript:;" onclick="toshippingproduct_order(<?php echo $orderinfo['order_id']?>, '<?php echo $orderinfo['order_number']?>')" class="gksel_btn_action_on"><?php if($this->langtype == '_ch'){echo '发货';}else{echo 'Process Order';}?></a></td>
								</tr>
								 -->
							<?php }else if($orderinfo['status'] == 2 || $orderinfo['status'] == 12){?>
								<!--
								<tr>
									<td height="30" align="right" width="40%"></td>
									<td><a href="javascript:;" onclick="tofinishorder_order(<?php echo $orderinfo['order_id']?>, '<?php echo $orderinfo['order_number']?>')" class="gksel_btn_action_on"><?php if($this->langtype == '_ch'){echo '确认收货';}else{echo 'Confirm Received';}?></a></td>
								</tr>
								-->
							<?php }else if($orderinfo['status'] == 10){?>
								<tr>
									<td height="30" align="right" width="40%"></td>
									<td><a href="javascript:;" onclick="toconfirmtransfer_order(<?php echo $orderinfo['order_id']?>, '<?php echo $orderinfo['order_number']?>')" class="gksel_btn_action_on"><?php if($this->langtype == '_ch'){echo '确认已收到公司转账';}else{echo '确认已收到公司转账';}?></a></td>
								</tr>
							<?php }?>
						</table>
					</td>
					<td valign="top">
						<table width="100%" cellspacing=0 cellpadding=0>
							<tr>
								<td colspan="2">
									<div class="refund_loglist_l">
										<table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #ddd;">
											<tr>
												<th colspan="2" align="center"><?php if($this->langtype == '_ch'){echo '配送详细';}else{echo 'Delivery Detail';}?></th>
											</tr>
											<?php if(isset($day_list)){for ($d = 0; $d < count($day_list); $d++) {?>
													<?php 
														if($day_list[$d]['action_status'] == 1){
															$linethrough_style = 'text-decoration:line-through;color:orange;';
														}else if($day_list[$d]['action_status'] == 2){
															$linethrough_style = 'text-decoration:line-through;color:red;';
														}else{
															$linethrough_style = '';
														}
													?>
													<tr style="<?php echo $linethrough_style;?>">
														<td style="<?php if($d != (count($day_list) - 1)){echo 'border-bottom:1px solid #ddd;';}?>border-right:1px solid #ddd;" width="90" align="right"><?php echo $day_list[$d]['date_show']?>&nbsp;&nbsp;&nbsp;</td>
														<td style="<?php if($d != (count($day_list) - 1)){echo 'border-bottom:1px solid #ddd;';}?>">
															<?php 
																if($orderinfo['daily_meals_id'] == 1){//只有午餐
																	if($this->langtype == '_ch'){
																		echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">午餐</div>';
																	}else{
																		echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">Lunch</div>';
																	}
																	echo '<div style="float:left;width:calc(100% - 70px - 5px  - 1px - 85px - 1px);padding-left:5px;border-left:1px solid #ddd;border-right:1px solid #ddd;">';
																		echo '<div style="float:left;width:100%;margin-top:5px;'.$linethrough_style.'">';
																			if($time_id_lunch != 0){
																				echo $day_list[$d]['lunch_time_name2'.$this->langtype];
																			}
																		echo '</div>';
																		echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;'.$linethrough_style.'">';
																				if($address_id_lunch != 0){
																					echo $day_list[$d]['lunch_address_marked'].' - '.$day_list[$d]['lunch_address_formattedaddress'];
																				}
																		echo '</div>';
																	echo '</div>';
																	if($day_list[$d]['action_status'] == 1){//暂停
																		echo '
																			<div style="float:left;width:85px;line-height:16px;">
																				<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_1.png"/></div>
																				<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_paused.'</div>
																			</div>
																		';
																	}else if($day_list[$d]['action_status'] == 2){//取消
																		echo '
																			<div style="float:left;width:85px;line-height:16px;">
																				<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_3.png"/></div>
																				<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_cancelled.'</div>
																			</div>
																		';
																	}else{
																		//已发货
																		if($day_list[$d]['date_address_id_lunch_shipped'] == 1){
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_shipped.'</div>
																				</div>
																			';
																		}else{
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_tips.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'"><span style="color:gray;">Waiting</span></div>
																				</div>
																			';
																		}
																	}
																}else if($orderinfo['daily_meals_id'] == 2){//只有晚餐
																	if($this->langtype == '_ch'){
																		echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">晚餐</div>';
																	}else{
																		echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">Dinner</div>';
																	}
																	echo '<div style="float:left;width:calc(100% - 70px - 5px  - 1px - 85px - 1px);padding-left:5px;border-left:1px solid #ddd;border-right:1px solid #ddd;">';
																		echo '<div style="float:left;width:100%;margin-top:5px;'.$linethrough_style.'">';
																		if($day_list[$d]['date_time_id_dinner'] != 0){
																			echo $day_list[$d]['dinner_time_name2'.$this->langtype];
																		}
																		echo '</div>';
																		echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;'.$linethrough_style.'">';
																		if($day_list[$d]['date_address_id_dinner'] != 0){
																			echo $day_list[$d]['dinner_address_marked'].' - '.$day_list[$d]['dinner_address_formattedaddress'];
																		}
																		echo '</div>';
																	echo '</div>';
																	if($day_list[$d]['action_status'] == 1){//暂停
																		echo '
																			<div style="float:left;width:85px;line-height:16px;">
																				<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_1.png"/></div>
																				<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_paused.'</div>
																			</div>
																		';
																	}else if($day_list[$d]['action_status'] == 2){//取消
																		echo '
																			<div style="float:left;width:85px;line-height:16px;">
																				<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_3.png"/></div>
																				<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_cancelled.'</div>
																			</div>
																		';
																	}else{
																		//已发货
																		if($day_list[$d]['date_address_id_dinner_shipped'] == 1){
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_shipped.'</div>
																				</div>
																			';
																		}else{
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_tips.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'"><span style="color:gray;">Waiting</span></div>
																				</div>
																			';
																		}
																	}
																}else if($orderinfo['daily_meals_id'] == 3){//午餐和晚餐
																	echo '<div style="float:left;width:100%;border-bottom:1px solid #ddd;">';
																		if($this->langtype == '_ch'){
																			echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">午餐</div>';
																		}else{
																			echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">Lunch</div>';
																		}
																		echo '<div style="float:left;width:calc(100% - 70px - 5px  - 1px - 85px - 1px);padding-left:5px;border-left:1px solid #ddd;border-right:1px solid #ddd;">';
																			echo '<div style="float:left;width:100%;margin-top:5px;'.$linethrough_style.'">';
																				if($day_list[$d]['date_time_id_lunch'] != 0){
																					echo $day_list[$d]['lunch_time_name2'.$this->langtype];
																				}
																			echo '</div>';
																			echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;'.$linethrough_style.'">';
																				if($day_list[$d]['date_address_id_lunch'] != 0){
																					echo $day_list[$d]['lunch_address_marked'].' - '.$day_list[$d]['lunch_address_formattedaddress'];
																				}
																			echo '</div>';
																		echo '</div>';
																		if($day_list[$d]['action_status'] == 1){//暂停
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_1.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_paused.'</div>
																				</div>
																			';
																		}else if($day_list[$d]['action_status'] == 2){//取消
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_3.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_cancelled.'</div>
																				</div>
																			';
																		}else{
																			//已发货
																			if($day_list[$d]['date_address_id_lunch_shipped'] == 1){
																				echo '
																					<div style="float:left;width:85px;line-height:16px;">
																						<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
																						<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_shipped.'</div>
																					</div>
																				';
																			}else{
																				echo '
																					<div style="float:left;width:85px;line-height:16px;">
																						<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_tips.png"/></div>
																						<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'"><span style="color:gray;">Waiting</span></div>
																					</div>
																				';
																			}
																		}
																	echo '</div>';
																	
																	
																	if($this->langtype == '_ch'){
																		echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">晚餐</div>';
																	}else{
																		echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">Dinner</div>';
																	}
																	echo '<div style="float:left;width:calc(100% - 70px - 5px  - 1px - 85px - 1px);padding-left:5px;border-left:1px solid #ddd;border-right:1px solid #ddd;">';
																		echo '<div style="float:left;width:100%;margin-top:5px;'.$linethrough_style.'">';
																		if($day_list[$d]['date_time_id_dinner'] != 0){
																			echo $day_list[$d]['dinner_time_name2'.$this->langtype];
																		}
																		echo '</div>';
																		echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;'.$linethrough_style.'">';
																		if($day_list[$d]['date_address_id_dinner'] != 0){
																			echo $day_list[$d]['dinner_address_marked'].' - '.$day_list[$d]['dinner_address_formattedaddress'];
																		}
																		echo '</div>';
																	echo '</div>';
																	if($day_list[$d]['action_status'] == 1){//暂停
																		echo '
																			<div style="float:left;width:85px;line-height:16px;">
																				<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_1.png"/></div>
																				<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_paused.'</div>
																			</div>
																		';
																	}else if($day_list[$d]['action_status'] == 2){//取消
																		echo '
																			<div style="float:left;width:85px;line-height:16px;">
																				<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_3.png"/></div>
																				<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_cancelled.'</div>
																			</div>
																		';
																	}else{
																		//已发货
																		if($day_list[$d]['date_address_id_dinner_shipped'] == 1){
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_shipped.'</div>
																				</div>
																			';
																		}else{
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_tips.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'"><span style="color:gray;">Waiting</span></div>
																				</div>
																			';
																		}
																	}
																}else{//早餐，午餐和晚餐]
																	echo '<div style="float:left;width:100%;border-bottom:1px solid #ddd;">';
																		if($this->langtype == '_ch'){
																			echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">午餐</div>';
																		echo '<div style="float:left;width:calc(100% - 70px - 5px  - 1px - 85px - 1px);padding-left:5px;border-left:1px solid #ddd;border-right:1px solid #ddd;">';
																		}else{
																			echo '<div style="float:left;width:calc(120px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">Lunch</div>';
																		echo '<div style="float:left;width:calc(100% - 120px - 5px  - 1px - 85px - 1px);padding-left:5px;border-left:1px solid #ddd;border-right:1px solid #ddd;">';
																		}
																		
																			echo '<div style="float:left;width:100%;margin-top:5px;'.$linethrough_style.'">';
																				if($day_list[$d]['date_time_id_lunch'] != 0){
																					echo $day_list[$d]['lunch_time_name2'.$this->langtype];
																				}
																			echo '</div>';
																			echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;'.$linethrough_style.'">';
																				if($day_list[$d]['date_address_id_lunch'] != 0){
																					echo $day_list[$d]['lunch_address_marked'].' - '.$day_list[$d]['lunch_address_formattedaddress'];
																				}
																			echo '</div>';
																		echo '</div>';
																		if($day_list[$d]['action_status'] == 1){//暂停
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_1.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_paused.'</div>
																				</div>
																			';
																		}else if($day_list[$d]['action_status'] == 2){//取消
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_3.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_cancelled.'</div>
																				</div>
																			';
																		}else{
																			//已发货
																			if($day_list[$d]['date_address_id_lunch_shipped'] == 1){
																				echo '
																					<div style="float:left;width:85px;line-height:16px;">
																						<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
																						<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_shipped.'</div>
																					</div>
																				';
																			}else{
																				echo '
																					<div style="float:left;width:85px;line-height:16px;">
																						<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_tips.png"/></div>
																						<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'"><span style="color:gray;">Waiting</span></div>
																					</div>
																				';
																			}
																		}
																	echo '</div>';
																	
																	
																	if($this->langtype == '_ch'){
																		echo '<div style="float:left;width:calc(70px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">晚餐 + 第二天早餐</div>';
																		echo '<div style="float:left;width:calc(100% - 70px - 5px  - 1px - 85px - 1px);padding-left:5px;border-left:1px solid #ddd;border-right:1px solid #ddd;">';
																	}else{
																		echo '<div style="float:left;width:calc(120px - 5px);margin-top:5px;padding-left:5px;'.$linethrough_style.'">Dinner + <br />next day’s breakfast</div>';
																		echo '<div style="float:left;width:calc(100% - 120px - 5px  - 1px - 85px - 1px);padding-left:5px;border-left:1px solid #ddd;border-right:1px solid #ddd;">';
																	}
																	
																		echo '<div style="float:left;width:100%;margin-top:5px;'.$linethrough_style.'">';
																		if($day_list[$d]['date_time_id_dinner'] != 0){
																			echo $day_list[$d]['dinner_time_name2'.$this->langtype];
																		}
																		echo '</div>';
																		echo '<div style="float:left;width:100%;margin-top:5px;margin-bottom:5px;'.$linethrough_style.'">';
																		if($day_list[$d]['date_address_id_dinner'] != 0){
																			echo $day_list[$d]['dinner_address_marked'].' - '.$day_list[$d]['dinner_address_formattedaddress'];
																		}
																		echo '</div>';
																	echo '</div>';
																	if($day_list[$d]['action_status'] == 1){//暂停
																		echo '
																			<div style="float:left;width:85px;line-height:16px;">
																				<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_1.png"/></div>
																				<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_paused.'</div>
																			</div>
																		';
																	}else if($day_list[$d]['action_status'] == 2){//取消
																		echo '
																			<div style="float:left;width:85px;line-height:16px;">
																				<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/msg_3.png"/></div>
																				<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_cancelled.'</div>
																			</div>
																		';
																	}else{
																		//已发货
																		if($day_list[$d]['date_address_id_dinner_shipped'] == 1){
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'">'.$text_shipped.'</div>
																				</div>
																			';
																		}else{
																			echo '
																				<div style="float:left;width:85px;line-height:16px;">
																					<div style="float:left;margin-left:5px;margin-top:15px;"><img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/global_tips.png"/></div>
																					<div style="float:left;margin-left:5px;margin-top:15px;'.$linethrough_style.'"><span style="color:gray;">Waiting</span></div>
																				</div>
																			';
																		}
																	}
																	
																}
															?>
															
														</td>
													</tr>
											<?php }}?>
											
										</table>
									</div>
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
						</table>
					</td>
			</tr>
		</table>
<?php $this->load->view('admin/footer')?>
