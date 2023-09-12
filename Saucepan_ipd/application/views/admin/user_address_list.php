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
	
<table class="gksel_normal_tabaction">
	<tr>
		<td></td>
		<td>
			<div class="searcharea">
				<a href="<?php echo base_url().'index.php/admins/user/toadd_address/'.$uid.'?backurl='.$current_url_encode?>"><font class="nav_on"><img class="plus" src="<?php echo base_url().'themes/default/images/plus.png'?>"/> <?php if($this->langtype == '_ch'){echo '添加地址';}else{echo 'Add Address';}?></font></a>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_address')?></p></td>
			<td width="130" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="130" align="center"><p><?php echo lang('cy_status')?></p></td>
			<td width="200"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($addresslist)){for ($i = 0; $i < count($addresslist); $i++) {?>
			<?php 
				$address_distance = number_format($addresslist[$i]['address_distance'], 2, ".", ",");
				if($address_distance <= 6){
					$shippingfee_show = '<span style="color:#F2C3C1;font-weight:bold;">free</span>';
				}else if($address_distance > 6 && $address_distance <= 10){
					$shippingfee_show = '<span style="color:#F2C3C1;font-weight:bold;">12rmb per delivery</span>';
				}else{
					$shippingfee_show = '<span style="color:red;font-weight:bold;">don’t deliver</span>';
				}
				
				if($addresslist[$i]['isdel_status'] == 0){
					$linethrough_style = '';
				}else{
					$linethrough_style = 'text-decoration:line-through;color:red;';
				}
			?>
			<tr>
				<td align="center" style="border-bottom:0px;"><?php echo $i+1?></td>
				<td style="border-bottom:0px;">
					<div style="float:left;width:100%;<?php echo $linethrough_style;?>">
						<span style="color:#F2C3C1;font-weight:bold;">[<?php echo $addresslist[$i]['address_marked']?>]</span>
						<?php echo trim($addresslist[$i]['address_dingwei']);?>
						<?php if($addresslist[$i]['address_otherdetail'] != ''){echo ', '.$addresslist[$i]['address_otherdetail'];}?>
					</div>
					<div style="float:left;width:100%;margin-top:5px;<?php echo $linethrough_style;?>">
						<?php echo $addresslist[$i]['address_formattedaddress'].', '.$addresslist[$i]['address_district'].', '.$addresslist[$i]['address_city']?>
					</div>
					<div style="float:left;width:100%;margin-top:5px;<?php echo $linethrough_style;?>">
						<?php echo $address_distance;?>km &nbsp;
						<?php echo $shippingfee_show;?>
					</div>
				</td> 
				<td style="border-bottom:0px;" align="center"><div style="float:left;width:100%;<?php echo $linethrough_style;?>"><?php echo date('Y-m-d H:i', $addresslist[$i]['edited'])?></div></td>
				<td style="border-bottom:0px;" align="center">
					<?php 
						if($addresslist[$i]['isdel_status'] == 0){
							echo '<span style="color:green;">Online</span>';
						}else {
							echo '<span style="color:red;">Deleted</span>';
							echo '<br /><span style="color:gray;">'.date('Y-m-d H:i', $addresslist[$i]['isdel_time']).'</span>';
						}
					?>
				</td>
				<td style="border-bottom:0px;">
					<div style="float:right;">
						<?php 
							if($addresslist[$i]['isdel_status'] == 0){
								echo '<a href="'.base_url().'index.php/admins/user/toedit_address/'.$uid.'/'.$addresslist[$i]['address_id'].'?backurl='.$backurl.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
								echo '<a onclick="todel_address('.$addresslist[$i]['address_id'].')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
							}else {
								echo '';
							}
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td style="padding:0px;">
					
				</td>
				<td colspan="4" style="padding:0px;">
					<?php 
						$sql = "SELECT * FROM ".DB_PRE()."user_address WHERE isdel_status = 2 AND isdel_target = ".$addresslist[$i]['address_id'];
						$parentinfo = $this->db->query($sql)->row_array();
						if(!empty($parentinfo)){
					?>
					<div style="float:left;width:100%;border-top:1px dashed gray;marign:10px 0px;"></div>
					<div style="float:left;width:100%;margin-top:-8px;text-align:center;"><span style="text-align:center;background:white;padding:5px 10px;">Change Logs</div></div>
						<?php 
							$sub_id = $addresslist[$i]['address_id'];
							for ($tttt = 1; $tttt <= 50; $tttt++) {
								$subinfo = $this->UserModel->getaddressinfo($sub_id);
								$sql = "SELECT * FROM ".DB_PRE()."user_address WHERE isdel_status = 2 AND isdel_target = ".$subinfo['address_id'];
								$parentinfo = $this->db->query($sql)->row_array();
								if(!empty($parentinfo)){
									echo '<div style="float:left;width:100%;marign:10px 0px;"><table class="gksel_normal_tablist" style="margin:0px;padding:0px;">';
									echo '<tr>';
								
									if($parentinfo['address_otherdetail'] != $subinfo['address_otherdetail']){
										if($parentinfo['address_otherdetail'] != ''){
											$address_otherdetail = ', <span style="text-decoration:line-through;color:red;">'.$parentinfo['address_otherdetail'].'</span>';
										}else{
											$address_otherdetail = '<span style="text-decoration:line-through;color:red;">&nbsp;&nbsp;&nbsp;&nbsp;</span>';
										}
									}else{
										if($parentinfo['address_otherdetail'] != ''){
											$address_otherdetail = ', '.$parentinfo['address_otherdetail'];
										}else{
											$address_otherdetail = '&nbsp;&nbsp;&nbsp;&nbsp;';
										}
									}
								
									if($parentinfo['address_dingwei'] != $subinfo['address_dingwei']){
										$address_dingwei = '<span style="text-decoration:line-through;color:red;">'.$parentinfo['address_dingwei'].'</span>';
									}else{
										$address_dingwei = $parentinfo['address_dingwei'];
									}
								
									if($parentinfo['address_marked'] != $subinfo['address_marked']){
										$address_marked = '<span style="text-decoration:line-through;color:red;">['.$parentinfo['address_marked'].']</span>';
									}else{
										$address_marked = '<span style="">['.$parentinfo['address_marked'].']</span>';
									}
								
									if($parentinfo['address_formattedaddress'].', '.$parentinfo['address_district'].', '.$parentinfo['address_city'] != $subinfo['address_formattedaddress'].', '.$subinfo['address_district'].', '.$subinfo['address_city']){
										$address_formattedaddress_andmore = '<span style="text-decoration:line-through;color:red;">'.$parentinfo['address_formattedaddress'].', '.$parentinfo['address_district'].', '.$parentinfo['address_city'].'</span>';
									}else{
										$address_formattedaddress_andmore = '<span style="">'.$parentinfo['address_formattedaddress'].', '.$parentinfo['address_district'].', '.$parentinfo['address_city'].'</span>';
									}
								
									if($parentinfo['address_distance'] != $subinfo['address_distance']){
										$address_distance = '<span style="text-decoration:line-through;color:red;">'.$parentinfo['address_distance'].'km &nbsp;</span>';
									}else{
										$address_distance = '<span style="">'.$parentinfo['address_distance'].'km &nbsp;</span>';
									}
								
									if($parentinfo['address_distance'] <= 6){
										$shippingfee_show = '<span style="color:#F2C3C1;font-weight:bold;">free</span>';
									}else if($parentinfo['address_distance'] > 6 && $parentinfo['address_distance'] <= 10){
										$shippingfee_show = '<span style="color:#F2C3C1;font-weight:bold;">12rmb per delivery</span>';
									}else{
										$shippingfee_show = '<span style="color:red;font-weight:bold;">don’t deliver</span>';
									}
								
									echo '
											<td style="border:0px;">
												<div style="float:left;width:100%;color:#CCC;">
													'.$address_marked.'
													'.$address_dingwei.'
													'.$address_otherdetail.'
												</div>
												<div style="float:left;width:100%;margin-top:5px;color:#CCC;">
													'.$address_formattedaddress_andmore.'
												</div>
												<div style="float:left;width:100%;margin-top:5px;color:#CCC;">
													'.$address_distance.'
													'.$shippingfee_show.'
												</div>
											</td>
											<td width="130" align="center" style="padding:0px;border:0px;color:#CCC;">
												'.date('Y-m-d H:i', $parentinfo['created']).'
											</td>
											<td width="130" align="center" style="padding:0px;border:0px;color:#CCC;">
												↑
											</td>
											<td width="182" style="padding:0px;border:0px;color:#CCC;">
								
											</td>
										';
									echo '</tr>';
									echo '</table></div>';
									
									$sub_id = $parentinfo['address_id'];
								}else{
									break;
								}
							}
							
							
						?>
					
					<?php }?>
				</td>
				
			</tr>
		<?php }}?>
	</tbody>
</table>

<?php $this->load->view('admin/footer')?>