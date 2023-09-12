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

?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_user.js?date=<?php echo CACHE_USETIME()?>'></script>
	
	
<div class="gksel_pluspoint_box_bg"></div>
<div class="gksel_pluspoint_box">
	<table>
		<tr>
			<td>
				<div class="gksel_pluspoint_content">
					<div class="close"><img onclick="toclose_pluspointbox()" src="<?php echo base_url().'themes/default/images/close.png'?>"></div>
					<div class="title"></div>
					<div class="subtitle"></div>
					<div style="float:left;width:100%;">&nbsp;</div>
					<input type="text" name="plus_point" placeholder="<?php if($this->langtype == '_ch'){echo '积分';}else{echo 'Points';}?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
					<textarea name="plus_point_desc" placeholder="说明"></textarea>
					<div class="control">
						<div class="yes" onclick="pluspoint_order()">提交</div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
<div class="gksel_minuspoint_box_bg"></div>
<div class="gksel_minuspoint_box">
	<table>
		<tr>
			<td>
				<div class="gksel_minuspoint_content">
					<div class="close"><img onclick="toclose_minuspointbox()" src="<?php echo base_url().'themes/default/images/close.png'?>"></div>
					<div class="title"></div>
					<div class="subtitle"></div>
					<div style="float:left;width:100%;">&nbsp;</div>
					<input type="text" name="minus_point" placeholder="<?php if($this->langtype == '_ch'){echo '积分';}else{echo 'Points';}?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
					<textarea name="minus_point_desc" placeholder="说明"></textarea>
					<div class="control">
						<div class="yes" onclick="minuspoint_order()">提交</div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
	
<table class="gksel_normal_tabaction" style="display:none;">
	<tr>
		<td></td>
		<td>
			<a href="javascript:;" onclick="topluspoint_order(<?php echo $uid?>)">
				<font class="nav_on">
					<font class="plus">
						<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
						<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
					</font>
					<span><?php if($this->langtype == '_ch'){echo '添加积分';}else{echo 'Add Point';}?></span>
				</font>
			</a>
			<a href="javascript:;" onclick="tominuspoint_order(<?php echo $uid?>)">
				<font class="nav_on">
					<font class="plus">
						<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
					</font>
					<span><?php if($this->langtype == '_ch'){echo '消费积分';}else{echo 'Reduce point';}?></span>
				</font>
			</a>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_username')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '积分';}else{echo 'Points';}?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '积分说明';}else{echo 'Point Description';}?></p></td>
			<td width="150"><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '时间';}else{echo 'Time';}?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($pointlist)) {for ($i = 0; $i < count($pointlist); $i++) {?>
			<tr>
				<td align="center"><?php echo ($i+1)?></td>
				<td>
					<div style="float:left;width: 100%;">
						<div style="float:left;width: 23px;">
							<?php if($pointlist[$i]['wechat_avatar'] != ''){?>
								<img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($pointlist[$i]['wechat_avatar'])?>">
							<?php }else{?>
								<img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>">
							<?php }?>
						</div>
						<div style="float:left;width: calc(100% - 23px);line-height:18px;">
							<?php echo '<span style="color:#999;">'.userTextDecode($pointlist[$i]['wechat_nickname']).'</span>';?>
							<?php echo '&nbsp;&nbsp;'.strip_tags($pointlist[$i]['user_firstname'].' '.$pointlist[$i]['user_lastname']);?>
						</div>
					</div>
				</td>
				<td>
					<?php 
						if($pointlist[$i]['point_type'] == 'order'){
							echo '<span style="font-size:18px;color:green;">+'.$pointlist[$i]['point'].'</span>';
						}else if($pointlist[$i]['point_type'] == 'sppoints_use'){
							echo '<span style="font-size:18px;color:red;">-'.$pointlist[$i]['point'].'</span>';
						}else if($pointlist[$i]['point_type'] == 'plus'){
							echo '<span style="font-size:18px;color:green;">+'.$pointlist[$i]['point'].'</span>';
						}else if($pointlist[$i]['point_type'] == 'minus'){
							echo '<span style="font-size:18px;color:red;">-'.$pointlist[$i]['point'].'</span>';
						}
					?>
				</td>
				<td>
					<?php if($pointlist[$i]['point_type'] == 'order'){?>
						<?php 
							$orderinfo = $this->OrderModel->getorderinfo($pointlist[$i]['order_id']);
						?>
						Buy plan, <?php if($this->langtype == '_ch'){echo '订单号：';}else{echo 'order NO: ';}?><?php echo $orderinfo['order_number']?>
					<?php }else if($pointlist[$i]['point_type'] == 'sppoints_use'){?>
						<?php 
							$orderinfo = $this->OrderModel->getorderinfo($pointlist[$i]['order_id']);
						?>
						Use sp points, <?php if($this->langtype == '_ch'){echo '订单号：';}else{echo 'order NO: ';}?><?php echo $orderinfo['order_number']?>
					<?php }else if($pointlist[$i]['point_type'] == 'plus'){?>
						<?php echo $pointlist[$i]['point_desc']?>
					<?php }else if($pointlist[$i]['point_type'] == 'minus'){?>
						<?php echo $pointlist[$i]['point_desc']?>
					<?php }?>
				</td>
				<td>
					<?php echo date('Y-m-d H:i',$pointlist[$i]['created'])?>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>

<?php $this->load->view('admin/footer')?>