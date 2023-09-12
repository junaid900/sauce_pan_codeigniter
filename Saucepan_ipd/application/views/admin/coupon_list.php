<?php $this->load->view('admin/header')?>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_coupon.js?date=<?php echo CACHE_USETIME()?>'></script>
	
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

$product_type = $this->input->get('product_type');
$keyword = $this->input->get('keyword');
?>

<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<a href="<?php echo site_url('admins/coupon/toadd_coupon')?>"><font class="nav_on"><img class="plus" src="<?php echo base_url().'themes/default/images/plus.png'?>"/> <?php if($this->langtype == '_ch'){echo '添加优惠券';}else{echo 'Add Coupon Code';}?></font></a>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr valign="top">
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '优惠券代码';}else{echo 'Coupon Code';}?></p></td>
			
			<td width="150" align="center"><p><?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?></p></td>
			  
			<td width="150" align="center"><p><?php if($this->langtype == '_ch'){echo '优惠券类型';}else{echo 'Coupon Type';}?></p></td>
			<td width="120" align="center"><p><?php if($this->langtype == '_ch'){echo '优惠券最低购买价格';}else{echo 'Coupon Start Price';}?></p></td>
			<td width="80" align="center"><p><?php if($this->langtype == '_ch'){echo '频率';}else{echo 'Frequency';}?></p></td>
			<td width="80" align="center"><p><?php if($this->langtype == '_ch'){echo '数量';}else{echo 'Quantity';}?></p></td>
			<td width="80" align="center"><p><?php echo lang('cy_status')?></p></td>
			<td width="130" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="300" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
	<?php if(isset($couponlist)){for($i=0;$i<count($couponlist);$i++){?>
	  	 	<tr style="<?php if($couponlist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
				<td align="center">
					<?php echo $i+1;?>
				</td>
				<td><?php echo $couponlist[$i]['coupon_code'];?></td>
				<td align="center">
					<?php 
						echo $couponlist[$i]['coupon_name'];
					?>
				</td>
				
				<td align="center">
					<?php 
						if($couponlist[$i]['coupon_type']==2){
							echo '<div style="float:left;width:100%;">';
								if($this->langtype == '_ch'){echo '百分比';}else{echo 'Percent';}
							echo '</div>';
							echo '<div style="float:left;width:100%;">'.(100-($couponlist[$i]["coupon_percent"]*100)).'% OFF</div>';
						}else{
							echo '<div style="float:left;width:100%;">';
								if($this->langtype == '_ch'){echo '固定价格';}else{echo 'Fixed price';}
							echo '</div>';
							echo '<div style="float:left;width:100%;">&yen;'.$couponlist[$i]['coupon_price'].'</div>';
						}
					?>
				</td>
				<td align="center">
					<?php 
						if($couponlist[$i]['coupon_type']==2){
							echo '-';
						}else{
							echo $couponlist[$i]["coupon_starprice"];
						}
					?>
				</td>
				<td align="center">
					<?php 
						if($couponlist[$i]['isonlyonce']==1){
							if($this->langtype == '_ch'){echo '仅仅一次';}else{echo 'Only Once';}
						}else{
							if($this->langtype == '_ch'){echo '永久';}else{echo 'Always';}
						}
					?>
				</td>
				<td align="center">
					<?php echo $couponlist[$i]['coupon_quantity']?>
				</td>
				<td align="center">
					<?php 
						if($couponlist[$i]['status']==1){
							if($this->langtype == '_ch'){echo '上线';}else{echo 'Online';}
						}else{
							if($this->langtype == '_ch'){echo '下线';}else{echo 'Offline';}
						}
					?>
				</td>
				<td align="center"><?php echo date('Y-m-d H:i',$couponlist[$i]['edited'])?></td>
				<td align="center">
					<div style="float:right;">
						<?php 
							$sql = "
								SELECT count(*) as tt 
	
								FROM ".DB_PRE()."order_list 
	
								WHERE status NOT IN (0) AND coupon_id = ".$couponlist[$i]['coupon_id']."
							";
							$num_res = $this->db->query($sql)->row_array();
							if(!empty($num_res)){
								$num = $num_res['tt'];
							}else{
								$num = 0;
							}
						?>
						<a class="<?php if($num != 0){echo 'gksel_btn_action_on';}else{echo 'gksel_btn_action_off';}?>" <?php if($couponlist[$i]['status']==1){}else{echo 'style="background:#9E9E9E;"';}?> href="<?php echo base_url().'index.php/admins/coupon/coupons_userlist/'.$couponlist[$i]["coupon_id"]?>">
							<?php if($this->langtype == '_ch'){echo '用户列表';}else{echo 'People List';}?>
							<?php if($num > 0){echo '<span style="color:red;font-weight:bold;">('.$num.')</span>';}?>
						</a>
						<a class="gksel_btn_action_on" <?php if($couponlist[$i]['status']==1){}else{echo 'style="background:#9E9E9E;"';}?> href="<?php echo base_url().'index.php/admins/coupon/toedit_coupon/'.$couponlist[$i]["coupon_id"]?>"><?php echo lang('cy_edit')?></a>
						<?php if($num == 0){?>
							&nbsp;&nbsp;
							<a class="gksel_btn_action_on" <?php if($couponlist[$i]['status']==1){}else{echo 'style="background:#9E9E9E;"';}?> href="javascript:;" onclick="todel_coupon('<?php echo $couponlist[$i]["coupon_id"]?>', '<?php echo $couponlist[$i]["coupon_code"]?>')"><?php echo lang('cy_delete')?></a>
						<?php }?>
					</div>
				</td>
		    </tr>
	    
  	<?php }}?>
  	</tbody>
	</table>
	<div class="houtai_fy">
		<div style="float:left;">
			<div id="fyarea">
				<?php if(isset($fy)){echo $fy;}?> 
			</div>
		</div>
	</div>
<?php $this->load->view('admin/footer')?>