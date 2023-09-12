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

$product_type = $this->input->get('product_type');
$keyword = $this->input->get('keyword');
?>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/product/categorylist'?>" method="get">
					<input type="text" name="keyword" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
					<input type="submit" value="<?php echo lang('cy_search')?>"/>
				</form>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<a href="<?php echo base_url().'index.php/admins/product/toadd_product_category'?>"><font class="nav_on"><img class="plus" src="<?php echo base_url().'themes/default/images/plus.png'?>"/> <?php echo lang('dz_product_category_add')?></font></a>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;优惠券名称</p></td>
			<td width="165" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_author')?></p></td>
			<td width="350" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($couponlist)){for ($i = 0; $i < count($couponlist); $i++) {?>
			<tr>
				<td align="center" style="padding:0px;"><?php echo ($i+1)?></td>
				<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($couponlist[$i]['category_name'.$this->langtype]));?></td>
				<td align="center" style="padding:0px;"><?php echo date('Y-m-d H:i:s', $couponlist[$i]['edited'])?></td>
				<td align="center" style="padding:0px;"><?php echo $couponlist[$i]['edited_author']?></td>
				<td align="center" style="padding:0px;">
					<div style="float:right;">
						<?php 
							$con = array('parent'=>$couponlist[$i]['category_id']);
							$countsubcategory = $this->ProductModel->getproductcategorylist($con, 1);
							if($countsubcategory > 0){
								$text = lang('dz_product_subcategory_manage').' '.'<font class="fonterror">('.$countsubcategory.')</font>';
							}else{
								$text = lang('dz_product_subcategory_manage');
							}
						
							echo '<a href="'.base_url().'index.php/admins/product/subcategorylist/'.$couponlist[$i]['category_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.$text.'</a>';
							echo '<a href="'.base_url().'index.php/admins/product/toedit_productcategory/'.$couponlist[$i]['category_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
							if($countsubcategory > 0){
								echo '<a href="javascript:;" class="gksel_btn_action_off">'.lang('cy_delete').'</a>';
							}else{
								echo '<a onclick="todel_productcategory('.$couponlist[$i]['category_id'].', \''.$couponlist[$i]['category_name'.$this->langtype].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
							}
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>
<?php $this->load->view('admin/footer')?>