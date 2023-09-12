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

?>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="140" align="center">
				<img width="120" height="120" src="<?php echo CDN_URL().$productinfo['product_pic']?>"/>
			</td>
			<td align="left">
				<div style="float: left;width:100%;">
					<?php echo $productinfo['product_name'.$this->langtype];?>
				</div>
				<div style="float:left;width: 100%;margin-top:5px;">
					<?php echo $productinfo['product_SKUno'];?>
				</div>
			</td>
		</tr>
	</thead>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="140" align="center">
				<?php if($this->langtype == '_ch'){echo '大小:';}else{echo 'Size:';}?>
			</td>
			<td align="left">
				<div style="float: left;width:100%;">
					<?php echo $sizeinfo['size_name'.$this->langtype];?>
				</div>
			</td>
		</tr>
		<tr>
			<td width="140" align="center">
				<?php if($this->langtype == '_ch'){echo '库存:';}else{echo 'Inventory:';}?>
			</td>
			<td align="left">
				<div style="float: left;width:100%;">
					<?php 
						//查询该产品的不同大小的 数量
						$sql = "
							SELECT * FROM ".DB_PRE()."product_inventory_list WHERE product_id = ".$productinfo['product_id']." AND size_id = ".$sizeinfo['size_id']."
						";
						$res = $this->db->query($sql)->row_array();
						if(!empty($res)){
							$inventory_num = $res['inventory_num'];
						}else{
							$inventory_num = 0;
						}
						echo $inventory_num;
					?>
				</div>
			</td>
		</tr>
		
	</thead>
</table>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<a href="javascript:;" onclick="toplusinventory_order(<?php echo $productinfo['product_id']?>, <?php echo $sizeinfo['size_id']?>)">
					<font class="nav_on">
						<font class="plus">
							<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
							<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
						</font>
						<span><?php if($this->langtype == '_ch'){echo '添加库存';}else{echo 'Add Inventory';}?></span>
					</font>
				</a>
				<a href="javascript:;" onclick="tominusinventory_order(<?php echo $productinfo['product_id']?>, <?php echo $sizeinfo['size_id']?>)">
					<font class="nav_on">
						<font class="plus">
							<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
						</font>
						<span><?php if($this->langtype == '_ch'){echo '减少库存';}else{echo 'Minus Inventory';}?></span>
					</font>
				</a>
			</div>
		</td>
	</tr>
</table>














	
<div class="gksel_plusinventory_box_bg"></div>
<div class="gksel_plusinventory_box">
	<table>
		<tr>
			<td>
				<div class="gksel_plusinventory_content">
					<div class="close"><img onclick="toclose_plusinventorybox()" src="<?php echo base_url().'themes/default/images/close.png'?>"></div>
					<div class="title"></div>
					<div class="subtitle"></div>
					<div style="float:left;width:100%;">&nbsp;</div>
					<input type="text" name="plus_action_num" placeholder="<?php if($this->langtype == '_ch'){echo '数量';}else{echo 'Quantity';}?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
					<textarea name="plus_action_desc" placeholder="<?php if($this->langtype == '_ch'){echo '说明';}else{echo 'Description';}?>"></textarea>
					<div class="tipsgroupbox"><div class="request">*</div></div>
					<div class="control">
						<div class="yes" onclick="plusinventory_order()"><?php echo lang('cy_submit')?></div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
<div class="gksel_minusinventory_box_bg"></div>
<div class="gksel_minusinventory_box">
	<table>
		<tr>
			<td>
				<div class="gksel_minusinventory_content">
					<div class="close"><img onclick="toclose_minusinventorybox()" src="<?php echo base_url().'themes/default/images/close.png'?>"></div>
					<div class="title"></div>
					<div class="subtitle"></div>
					<div style="float:left;width:100%;">&nbsp;</div>
					<input type="text" name="minus_action_num" placeholder="<?php if($this->langtype == '_ch'){echo '数量';}else{echo 'Quantity';}?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
					<textarea name="minus_action_desc" placeholder="<?php if($this->langtype == '_ch'){echo '说明';}else{echo 'Description';}?>"></textarea>
					<div class="tipsgroupbox"><div class="request">*</div></div>
					<div class="control">
						<div class="yes" onclick="minusinventory_order()"><?php echo lang('cy_submit')?></div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_name')?></p></td>
			<td width="200" align="center"><p><?php if($this->langtype == '_ch'){echo '数量';}else{echo 'Quantity';}?></p></td>
			<td width="300"><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '说明';}else{echo 'Description';}?></p></td>
			<td width="200" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($this->langtype == '_ch'){
				$inventory_num_add_text = '加库存';
				$inventory_num_minus_text = '减库存';
				$order_text = '订单';
				$order_number_text = '订单号';
			}else{
				$inventory_num_add_text = 'Add Inventory';
				$inventory_num_minus_text = 'Minus Inventory';
				$order_text = 'Order';
				$order_number_text = 'Order Number';
			}
		?>
		<?php if(isset($detailnumberlist)){for ($i = 0; $i < count($detailnumberlist); $i++) {?>
			<tr>
				<td width="50" align="center"><?php echo $i+1?></td>
				<td>
					<?php 
					
						if($detailnumberlist[$i]['action_type'] == 1){
							echo '<span style="color:green;font-weight:bold;">'.$inventory_num_add_text.'</span>';
						}else if($detailnumberlist[$i]['action_type'] == 2){
							echo '<span style="color:red;font-weight:bold;">'.$inventory_num_minus_text.'</span>';
						}else if($detailnumberlist[$i]['action_type'] == 3){
							echo '<span style="color:orange;font-weight:bold;">'.$order_text.'</span>';
						}
					?>
				</td>
				<td width="200" align="center">
					<?php 
						if($detailnumberlist[$i]['action_type'] == 1){
							echo '<span style="color:green;font-weight:bold;">+'.$detailnumberlist[$i]['action_num'].'</span>';
						}else if($detailnumberlist[$i]['action_type'] == 2){
							echo '<span style="color:red;font-weight:bold;">-'.$detailnumberlist[$i]['action_num'].'</span>';
						}else if($detailnumberlist[$i]['action_type'] == 3){
							echo '<span style="color:orange;font-weight:bold;">-'.$detailnumberlist[$i]['action_num'].'</span>';
						}
					?>
				</td>
				<td width="300">
					<?php 
						if($detailnumberlist[$i]['action_type'] == 1){
							echo $detailnumberlist[$i]['action_desc'];
						}else if($detailnumberlist[$i]['action_type'] == 2){
							echo $detailnumberlist[$i]['action_desc'];
						}else if($detailnumberlist[$i]['action_type'] == 3){
							echo $order_number_text.': '.$detailnumberlist[$i]['action_desc'];
						}
					?>
				</td>
				<td width="200" align="center">
					<?php echo date('Y-m-d H:i', $detailnumberlist[$i]['action_time'])?>
				</td>
			</tr>
		<?php }}?>
	</tbody>
			
</table>
<?php $this->load->view('admin/footer')?>