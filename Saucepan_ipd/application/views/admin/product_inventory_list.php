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
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_name')?></p></td>
			<td width="200" align="center"><p><?php if($this->langtype == '_ch'){echo '数量';}else{echo 'Quantity';}?></p></td>
			<td width="200" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($sizelist)){for ($i = 0; $i < count($sizelist); $i++) {?>
			<?php 
				//查询该产品的不同大小的 数量
				$sql = "
					SELECT * FROM ".DB_PRE()."product_inventory_list WHERE product_id = ".$productinfo['product_id']." AND size_id = ".$sizelist[$i]['size_id']."
				";
				$res = $this->db->query($sql)->row_array();
				if(!empty($res)){
					$inventory_num = $res['inventory_num'];
				}else{
					$inventory_num = 0;
				}
			?>
			<tr>
				<td width="50" align="center"><?php echo $i+1?></td>
				<td><?php echo $sizelist[$i]['size_name'.$this->langtype]?></td>
				<td width="200" align="center">
					<?php 
						echo $inventory_num;
					?>
				</td>
				<td width="200" align="center">
					<div style="float:right;">
						<?php 
							if($this->langtype == '_ch'){
								$text_number = '库存数量记录';
							}else{
								$text_number = 'Inventory Number Record';
							}
							echo '<a href="'.base_url().'index.php/admins/product/numberlist/'.$product_id.'/'.$sizelist[$i]['size_id'].'?backurl='.$backurl.'&subbackurl='.$current_url_encode.'" class="gksel_btn_action_on">'.$text_number.'</a>';
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
			
</table>
<?php $this->load->view('admin/footer')?>