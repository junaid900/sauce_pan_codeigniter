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

$parentcategory_id = $this->input->get('parentcategory_id');
$subcategory_id = $this->input->get('subcategory_id');
$thirdcategory_id = $this->input->get('thirdcategory_id');

$brand_id = $this->input->get('brand_id');
$keyword = $this->input->get('keyword');
?>
<script>
	function tochooseparentcategory_id(category_id){
		$.post(baseurl+'index.php/admins/product/togetsubcategory_select/'+category_id, function (data){
			var obj = eval( "(" + data + ")" );
			$('.subcategory_area').html('<option value="0">-</option>'+obj.item);
		})
	}

	function tochoosesubcategory_id(subcategory_id){
		$.post(baseurl+'index.php/admins/product/togetthirdcategory_select/'+subcategory_id, function (data){
			var obj = eval( "(" + data + ")" );
			$('.thirdcategory_area').html('<option value="0">-</option>'+obj.item);
		})
	}

	
	function tochoosecategory_id(category_id){
		if(category_id == 16 || category_id == 40){
			$('.otherproductshuxing').show();
		}else{
			$('.otherproductshuxing').hide();
		}
	}
</script>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/product/index'?>" method="get">
					<?php 
						if($parentcategory_id == ''){
							$parentcategory_id = 0;
						}
						if($subcategory_id == ''){
							$subcategory_id = 0;
						}
						if($thirdcategory_id == ''){
							$thirdcategory_id = 0;
						}
						
						$con = array('parent'=>0, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
						$fenleilist = $this->ProductModel->getproductcategorylist($con);
						
// 						echo '<select onchange="tochooseparentcategory_id(this.value)" name="parentcategory_id" style="float:left;background: url(\''.base_url().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:200px;margin:0px 10px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
// 						echo '<option value="0">-</option>';
// 						if(!empty($fenleilist)){
// 							for ($aaa = 0; $aaa < count($fenleilist); $aaa++) {
// 								$ischecked = '';
// 								if($parentcategory_id == $fenleilist[$aaa]['category_id']){
// 									$ischecked = 'selected';
// 								}
// 								echo '<option value="'.$fenleilist[$aaa]['category_id'].'" '.$ischecked.'>'.$fenleilist[$aaa]['category_name'.$this->langtype].'</option>';
// 							}
// 						}
// 						echo '</select>';
						
					?>
					
					<?php 
						if($parentcategory_id != 0){
							$con = array('parent'=>$parentcategory_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
							$subcategorylist = $this->ProductModel->getproductcategorylist($con);
						}else{
							$subcategorylist = array();
						}
						
// 						echo '<select class="subcategory_area" onchange="tochoosesubcategory_id(this.value)" name="subcategory_id" style="float:left;background: url(\''.base_url().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:200px;margin:0px 10px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
// 						echo '<option value="0">-</option>';
// 						if(!empty($subcategorylist)){
// 							for ($aaa = 0; $aaa < count($subcategorylist); $aaa++) {
// 								$ischecked = '';
// 								if($subcategory_id == $subcategorylist[$aaa]['category_id']){
// 									$ischecked = 'selected';
// 								}
// 								echo '<option value="'.$subcategorylist[$aaa]['category_id'].'" '.$ischecked.'>'.$subcategorylist[$aaa]['category_name'.$this->langtype].'</option>';
// 							}
// 						}
// 						echo '</select>';
					?>
					
					
					<?php 
						if($subcategory_id != 0){
							$con = array('parent'=>$subcategory_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
							$thirdcategorylist = $this->ProductModel->getproductcategorylist($con);
						}else{
							$thirdcategorylist = array();
						}
						
						if(empty($thirdcategorylist)){
							$thirdssstyle = 'display:none;';
						}else{
							$thirdssstyle = '';
						}
						
						echo '<select class="thirdcategory_area" name="thirdcategory_id" style="'.$thirdssstyle.'float:left;background: url(\''.base_url().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:200px;margin:0px 10px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
						if(!empty($thirdcategorylist)){
							echo '<option value="0">-</option>';
							for ($aaa = 0; $aaa < count($thirdcategorylist); $aaa++) {
								$ischecked = '';
								if(!empty($checkres)){
									for ($j = 0; $j < count($checkres); $j++) {
										if($thirdcategory_id == $thirdcategorylist[$aaa]['category_id']){
											$ischecked = 'selected';
										}
									}
								}
								echo '<option value="'.$thirdcategorylist[$aaa]['category_id'].'" '.$ischecked.'>'.$thirdcategorylist[$aaa]['category_name'.$this->langtype].'</option>';
							}
						}else{
							echo '<option value="0">-</option>';
						}
						echo '</select>';
					?>
					
					<select name="brand_id">
						<option value=""><?php echo lang('cy_all')?></option>
						<?php echo $this->WelModel->getbrand_select($this->langtype, $brand_id)?>
					</select>
					<input type="text" name="keyword" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
					<input type="submit" value="<?php echo lang('cy_search')?>"/>
				</form>
			</div>
		</td>
	</tr>
</table>
<!-- 
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<a href="<?php echo base_url().'index.php/admins/product/toadd_product'?>">
					<font class="nav_on">
						<font class="plus">
							<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
							<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
						</font>
						<span>
							<?php echo lang('dz_product_add')?>
						</span>
					</font>
				</a>
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/product/index?parentcategory_id='.$parentcategory_id.'&subcategory_id='.$subcategory_id.'&thirdcategory_id='.$thirdcategory_id.'&brand_id='.$brand_id.'&keyword='.$keyword.'&is_excel=1'?>';" style="float: left;margin-top:7px;cursor:pointer;">
					<div style="float: left;margin-left:5px;">
						<img src="<?php echo base_url().'themes/default/images/icon_xls.gif'?>"/>
					</div>
					<div style="float: left;margin-left:5px;">
						<?php if($this->langtype == '_ch'){echo '导出表格';}else{echo 'Export Excel';}?>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
-->
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_picture')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_product_name')?></p></td>
			<td width="150" align="center"><p><?php echo lang('dz_product_price')?></p></td>
			
			<td width="100" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_author')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_status')?></p></td>
			<td width="400" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($productlist)){for ($i = 0; $i < count($productlist); $i++) {?>
			<tr style="<?php if($productlist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
				<td align="center"><?php echo ($i+1)?></td>
				<td align="center">
					<?php if($productlist[$i]['product_pic']!=""){?>
						<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().$productlist[$i]['product_pic_100']?>"/>
					<?php }else{?>
						<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().'themes/default/images/none_product.png'?>"/>
					<?php }?>
				</td>
				<td>
					<div style="float:left;width: 100%;">
						<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($productlist[$i]['product_name'.$this->langtype]));?>
					</div>
					<div style="display:none;float:left;width: 100%;margin-top:5px;">
						<?php 
// 							$sql = "
// 								SELECT 
		
// 								b.keyword_name_en AS keyword_name_1_en, b.keyword_name_ch AS keyword_name_1_ch
// 								, c.keyword_name_en AS keyword_name_2_en, c.keyword_name_ch AS keyword_name_2_ch
// 								, d.keyword_name_en AS keyword_name_3_en, d.keyword_name_ch AS keyword_name_3_ch
// 								, e.keyword_name_en AS keyword_name_4_en, e.keyword_name_ch AS keyword_name_4_ch
// 								, f.keyword_name_en AS keyword_name_5_en, f.keyword_name_ch AS keyword_name_5_ch
								
// 								, g.keyword_name_en AS keyword_name_6_en, g.keyword_name_ch AS keyword_name_6_ch
// 								, h.keyword_name_en AS keyword_name_7_en, h.keyword_name_ch AS keyword_name_7_ch
// 								, i.keyword_name_en AS keyword_name_8_en, i.keyword_name_ch AS keyword_name_8_ch
// 								, j.keyword_name_en AS keyword_name_9_en, j.keyword_name_ch AS keyword_name_9_ch
// 								, k.keyword_name_en AS keyword_name_10_en, k.keyword_name_ch AS keyword_name_10_ch
								
// 								FROM ".DB_PRE()."product_keyword AS a
		
// 								LEFT JOIN ".DB_PRE()."system_keyword_list AS b ON a.keyword_id_1 = b.keyword_id
// 								LEFT JOIN ".DB_PRE()."system_keyword_list AS c ON a.keyword_id_2 = c.keyword_id
// 								LEFT JOIN ".DB_PRE()."system_keyword_list AS d ON a.keyword_id_3 = d.keyword_id
// 								LEFT JOIN ".DB_PRE()."system_keyword_list AS e ON a.keyword_id_4 = e.keyword_id
// 								LEFT JOIN ".DB_PRE()."system_keyword_list AS f ON a.keyword_id_5 = f.keyword_id
// 								LEFT JOIN ".DB_PRE()."system_keyword_list AS g ON a.keyword_id_6 = g.keyword_id
// 								LEFT JOIN ".DB_PRE()."system_keyword_list AS h ON a.keyword_id_7 = h.keyword_id
// 								LEFT JOIN ".DB_PRE()."system_keyword_list AS i ON a.keyword_id_8 = i.keyword_id
// 								LEFT JOIN ".DB_PRE()."system_keyword_list AS j ON a.keyword_id_9 = j.keyword_id
// 								LEFT JOIN ".DB_PRE()."system_keyword_list AS k ON a.keyword_id_10 = k.keyword_id
			
// 								WHERE a.product_id = ".$productlist[$i]['product_id']."
// 							";
// 							$checkres = $this->db->query($sql)->row_array();
// 							if(!empty($checkres)){
// 								for ($j = 1; $j <= 10; $j++) {
// 									if($checkres['keyword_name_'.$j.$this->langtype] != ''){
// 										echo '<div style="float:left;background:#EFEFEF;padding:3px 5px;margin-bottom:5px;margin-right:5px;">';
// 											echo $checkres['keyword_name_'.$j.$this->langtype];
// 										echo '</div>';
// 									}
// 								}
// 							}
						?>
					</div>
					
					
					<div style="float:left;width: 100%;margin-top:5px;">
						<?php echo base_url().'index.php/product/'.$productlist[$i]['shorturl']?>
					</div>
					<?php if($productlist[$i]['brand_logo'] != ''){?>
						<div style="float:left;width: 100%;margin-top:5px;">
							<img style="max-width:60px;max-height: 60px;" src="<?php echo CDN_URL().$productlist[$i]['brand_logo']?>"/>
						</div>
					<?php }?>
					<div style="display:none;float:left;width: 100%;margin-top:10px;">
						<?php 
// 							$sql = "
				
// 								SELECT 
			
// 								c.category_name_en AS parentcategory_name_en, c.category_name_ch AS parentcategory_name_ch
// 								, b.category_name_en AS secondcategory_name_en, b.category_name_ch AS secondcategory_name_ch
// 								, d.category_name_en AS thirdcategory_name_en, d.category_name_ch AS thirdcategory_name_ch
				
// 								FROM ".DB_PRE()."product_category AS a 
				
// 								LEFT JOIN ".DB_PRE()."system_product_category AS c ON a.parentcategory_id = c.category_id
			
// 								LEFT JOIN ".DB_PRE()."system_product_category AS b ON a.subcategory_id = b.category_id
			
// 								LEFT JOIN ".DB_PRE()."system_product_category AS d ON a.thirdcategory_id = d.category_id
				
// 								WHERE a.product_id = ".$productlist[$i]['product_id']
// 							;
// 							$checkres = $this->db->query($sql)->result_array();
						
// 							if(!empty($checkres)){
// 								for ($aa = 0; $aa < count($checkres); $aa++) {
// 									echo '<div style="float:left;background:#f9dde3;margin-right:10px;margin-bottom:10px;padding:5px 10px;">';
// 									echo $checkres[$aa]['parentcategory_name'.$this->langtype];
// 									if($checkres[$aa]['secondcategory_name'.$this->langtype] != ''){
// 										echo ' -> '.$checkres[$aa]['secondcategory_name'.$this->langtype].'';
// 									}
// 									if($checkres[$aa]['thirdcategory_name'.$this->langtype] != ''){
// 										echo ' -> '.$checkres[$aa]['thirdcategory_name'.$this->langtype];
// 									}
// 									echo '</div>';
// 								}
// 							}
						?>
					</div>
				</td>
				<td>
					<div style="float:left;width: 100%;<?php if($productlist[$i]['product_price_regular'] == 0){echo 'color:#CCC;';}?>">
						<?php //if($this->langtype == '_ch'){echo '普通价: ';}else{echo 'Normal Price: ';}?>
						<?php echo '&yen;'.number_format($productlist[$i]['product_price_regular'], 2, ".", ",");?>
					</div>
					<div style="display:none;float:left;width: 100%;margin-top:5px;<?php if($productlist[$i]['product_price_promotion'] == 0){echo 'color:#CCC;';}?>">
						<?php if($this->langtype == '_ch'){echo '需要积分';}else{echo 'Need Points';}?>
						<?php echo $productlist[$i]['product_price_promotion'];?>
					</div>
				</td>
				<td align="center"><?php echo date('Y-m-d', $productlist[$i]['created']).'<br />'.date('H:i:s', $productlist[$i]['created'])?></td>
				<td align="center"><?php echo $productlist[$i]['edited_author']?></td>
				<td align="center">
					<?php 
						if($productlist[$i]['status'] == 1){
							echo lang('cy_online');
						}else{
							echo lang('cy_offline');
						}
					
					?>
				</td>
				<td align="center">
					<div style="float:right;">
						<?php 
// 							if($this->langtype == '_ch'){
// 								$inventory_text = '库存';
// 							}else{
// 								$inventory_text = 'Inventory';
// 							}
// 							if($productlist[$i]['inventory_totalnum'] != '' && $productlist[$i]['inventory_totalnum'] > 0){
// 								$inventory_text = $inventory_text.' <span style="color:red;">('.$productlist[$i]['inventory_totalnum'].')</span>';
// 							}
// 							echo '<a href="'.base_url().'index.php/admins/product/inventorylist/'.$productlist[$i]['product_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.$inventory_text.'</a>';

							$con = array('product_id'=>$productlist[$i]['product_id']);
							$count_pic = $this->ProductModel->getpicturelist($con, 1);
							if($count_pic > 0){
								$text = lang('cy_picture_manage').' '.'<font class="fonterror">('.$count_pic.')</font>';
							}else{
								$text = lang('cy_picture_manage');
							}
						
							echo '<a href="'.base_url().'index.php/admins/product/picturelist/'.$productlist[$i]['product_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.$text.'</a>';
						
							echo '<a href="'.base_url().'index.php/admins/product/toedit_product/'.$productlist[$i]['product_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
								
// 							echo '<a onclick="todel_product('.$productlist[$i]['product_id'].', \''.$productlist[$i]['product_name_en'].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
	<?php if(isset($fy)){?>
		<thead>
			<tr>
				<td colspan="9"><?php echo $fy?></td>
			</tr>
		</thead>
	<?php }?>
</table>

<?php $this->load->view('admin/footer')?>