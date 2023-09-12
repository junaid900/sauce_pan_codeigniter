<?php $this->load->view('admin/header')?>
<div class="navigation">
	<span style="text-decoration:underline"><?php echo lang('CouponsManagement')?></span>
</div>
<div class="tips_text">
	<div style="float:left;width:500px;line-height:20px;">
		<?php echo lang('CouponsManagementsection')?>
	</div>
</div>

<table class="gksel_normal_tablist">
	<thead>
		<tr valign="top">
			<td width="120" align="center"><?php echo lang('xuhao')?></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_username')?></p></td>
			<td width="140" align="center"><p><?php if($this->langtype == '_ch'){echo '订单号';}else{echo 'Order Number';}?></p></td>
			<td width="140" align="center"><p>Coupon Price</p></td>
			<td width="130" align="center">Used Time</td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($orderlist)){for($i=0;$i<count($orderlist);$i++){?>
	  	 	<tr style="background-color:<?php if($i%2==0){echo '#FFFFFF;';}else{echo '#f6f5f5;';}?>">
				<td align="center">
					<?php echo $i+1;?>
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
						<div style="float:left;width: calc(100% - 23px);line-height:18px;"><?php echo userTextDecode($orderlist[$i]['wechat_nickname']);?></div>
					</div>
				</td>
				<td align="center">
					<?php echo $orderlist[$i]['order_number']?>
				</td>
				<td align="center">
					<?php echo '&yen;'.$orderlist[$i]['coupon_price_rmb']?>
				</td>
				<td align="center">
					<?php 
						echo date('Y-m-d H:i:s', $orderlist[$i]['created']);
					?>
				</td>
		    </tr>
	  	<?php }}?>
  	</tbody>
</table>
<?php $this->load->view('admin/footer')?>