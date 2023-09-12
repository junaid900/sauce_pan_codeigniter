<?php 

if($this->langtype == '_ch'){
	$text_productlist = '产品列表';
	$text_skuno = '产品编号';
	$text_brand = '品牌';
	$text_size = '尺寸';
	$text_weight = '重量';
	$text_netweight = '净重';
	$text_daopan = '刀盘';
	$text_chubeiliang = '出杯量';
	$text_color = '颜色';
	$text_placeoforigin = '产地';
	$text_quantity = '数量';
	$text_price_normal = '普通价';
	$text_price_sale = '促销价';
	$text_price_daili_1 = '一般代理商';
	$text_price_daili_2 = '中级代理商';
	$text_price_daili_3 = '高级代理商';
	$text_product_picture = '产品图片';
}else{
	$text_productlist = 'Product List';
	$text_skuno = 'SKU NO.';
	$text_brand = 'Brand';
	$text_size = 'Size';
	$text_weight = 'Weight';
	$text_netweight = 'Net Weight';
	$text_daopan = '刀盘';
	$text_chubeiliang = '出杯量';
	$text_color = 'Color';
	$text_placeoforigin = 'place of origin';
	$text_quantity = 'Quantity';
	$text_price_normal = 'Normal Price';
	$text_price_sale = 'Sale Price';
	$text_price_daili_1 = '一般代理商';
	$text_price_daili_2 = '中级代理商';
	$text_price_daili_3 = '高级代理商';
	$text_product_picture = 'Product Picture';
}



	header('Content-Type: text/html; charset=utf-8');
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Disposition: attachment;filename=productlist_".date('Y-m-d').".xls ");
	header("Content-Transfer-Encoding: binary ");
	echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:x="urn:schemas-microsoft-com:office:excel"
		xmlns="http://www.w3.org/TR/REC-html40">
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
		<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<style id="Classeur1_16681_Styles"></style>
		<style type="text/css">
			.dddadfasfdads img{width:70px;height:70px;}
			.shulist{mso-style-parent:style0;color:windowtext;text-align:left;border:.5pt solid windowtext;mso-protection:unlocked visible;white-space:normal;mso-rotate:90;text-align:center;}
		</style>
		</head>
		<body>
		<div id="Classeur1_16681" align=center x:publishsource="Excel">
			<table x:str border=0 cellpadding=0 cellspacing=0 style="font-family: Calibri, Helvetica, SimSun, sans-serif;border-collapse: collapse;padding:5px;">
				<tr>
					<th height="50" style="font-size:20px;border:.5pt solid windowtext;" colspan="13" align="center" class="xl2216681 nowrap">'.$text_productlist.'</th>
				</tr>
				<tr>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" height="30" align="center" class="xl2216681 nowrap">'.lang('cy_sn').'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="center" class="xl2216681 nowrap">'.$text_skuno.'</th>
					<td style="width:60px;height:60px;min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="center" class="xl2216681 nowrap"><img width="60" height="60" style="float:left;width:60px;height:60px;" src="'.$peoplelist[$i]['wechat_avatar'].'"/></td>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="left" class="xl2216681 nowrap">'.lang('dz_product_name').'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="left" class="xl2216681 nowrap">'.lang('dz_product_category').'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="center" class="xl2216681 nowrap">'.$text_brand.'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="center" class="xl2216681 nowrap">'.$text_price_normal.'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="center" class="xl2216681 nowrap">'.$text_price_sale.'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="center" class="xl2216681 nowrap">'.$text_quantity.'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="center" class="xl2216681 nowrap">'.$text_size.'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="center" class="xl2216681 nowrap">'.$text_weight.'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="center" class="xl2216681 nowrap">'.$text_netweight.'</th>
					
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);color:white;" align="center" class="xl2216681 nowrap">'.lang('cy_time_lastedited').'</th>
				</tr>';
				//选择数据--开始
				if(!empty($productlist)){for($i=0;$i<count($productlist);$i++){
					
					if($productlist[$i]['inventory_totalnum'] == 0){
						$productlist[$i]['inventory_totalnum'] = '';
					}
					
					
					if($productlist[$i]['product_weight_1'] == 0){
						$productlist[$i]['product_weight_1'] = '';
					}else{
						$productlist[$i]['product_weight_1'] = $productlist[$i]['product_weight_1'].'kg';
					}
					if($productlist[$i]['product_weight_2'] == 0){
						$productlist[$i]['product_weight_2'] = '';
					}else{
						$productlist[$i]['product_weight_2'] = $productlist[$i]['product_weight_2'].'kg';
					}
					
					if($productlist[$i]['product_price_regular'] == 0){
						$productlist[$i]['product_price_regular'] = '';
					}else{
						$productlist[$i]['product_price_regular'] = '&yen;'.$productlist[$i]['product_price_regular'];
					}
					if($productlist[$i]['product_price_promotion'] == 0){
						$productlist[$i]['product_price_promotion'] = '';
					}else{
						$productlist[$i]['product_price_promotion'] = '&yen;'.$productlist[$i]['product_price_promotion'];
					}
					
					$sql = "
		
						SELECT 
	
						c.category_name_en AS parentcategory_name_en, c.category_name_ch AS parentcategory_name_ch
						, b.category_name_en AS secondcategory_name_en, b.category_name_ch AS secondcategory_name_ch
						, d.category_name_en AS thirdcategory_name_en, d.category_name_ch AS thirdcategory_name_ch
		
						FROM ".DB_PRE()."product_category AS a 
		
						LEFT JOIN ".DB_PRE()."system_product_category AS c ON a.parentcategory_id = c.category_id
	
						LEFT JOIN ".DB_PRE()."system_product_category AS b ON a.subcategory_id = b.category_id
	
						LEFT JOIN ".DB_PRE()."system_product_category AS d ON a.thirdcategory_id = d.category_id
		
						WHERE a.product_id = ".$productlist[$i]['product_id']
					;
					$checkres = $this->db->query($sql)->result_array();
					$product_category_str = '';
					if(!empty($checkres)){
						for ($aa = 0; $aa < count($checkres); $aa++) {
							$product_category_str .= $checkres[$aa]['parentcategory_name'.$this->langtype];
							if($checkres[$aa]['secondcategory_name'.$this->langtype] != ''){
								$product_category_str .= ' -> '.$checkres[$aa]['secondcategory_name'.$this->langtype].'';
							}
							if($checkres[$aa]['thirdcategory_name'.$this->langtype] != ''){
								$product_category_str .= ' -> '.$checkres[$aa]['thirdcategory_name'.$this->langtype];
							}
						}
					}
					
					echo '<tr>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.($i+1).'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$productlist[$i]['product_SKUno'].'</td>';
					echo '<td style="width:60px;height:60px;min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;padding:10px;" align="center"><img width="54" height="54" style="float:left;width:54px;height:54px;" src="'.base_url().$productlist[$i]['product_pic_100'].'"/></td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="left" class="xl2216681 nowrap">'.$productlist[$i]['product_name'.$this->langtype].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="left" class="xl2216681 nowrap">'.$product_category_str.'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$productlist[$i]['brand_name'.$this->langtype].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$productlist[$i]['product_price_regular'].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$productlist[$i]['product_price_promotion'].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$productlist[$i]['inventory_totalnum'].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$productlist[$i]['product_size'].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$productlist[$i]['product_weight_1'].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$productlist[$i]['product_weight_2'].'</td>';
					
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.date('Y-m-d H:i:s', $productlist[$i]['edited']).'</td>';
					echo '</tr>';
				}}
				//选择数据--结束
		echo '</table>
		</div>
		</body>
		</html>';
