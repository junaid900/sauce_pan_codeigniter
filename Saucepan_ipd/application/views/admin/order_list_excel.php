<?php 
	header('Content-Type: text/html; charset=utf-8');
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Disposition: attachment;filename=orderlist_".date('Y-m-d').".xls ");
	header("Content-Transfer-Encoding: binary ");
	
	if($this->langtype == '_ch'){
		$text_orderlist = '订单列表';
		$text_ordernumber = '订单号';
		$text_totalprice = '总价';
		$text_ordertime = '订单时间';
		$text_orderstatus_unpaid = '未付款';
		$text_orderstatus_waitforshipping = '待发货';
		$text_orderstatus_hasshipped = '已发货';
		
		$text_order_shipping_fee = '运费';
		$text_order_receiver = '收件人';
	}else{
		$text_orderlist = 'Order List';
		$text_ordernumber = 'Order Number';
		$text_totalprice = 'Total Price';
		$text_ordertime = 'Order Time';
		$text_orderstatus_unpaid = 'Unpaid';
		$text_orderstatus_waitforshipping = 'Wait for Shipping';
		$text_orderstatus_hasshipped = 'Has Shipped';
		
		$text_order_shipping_fee = 'Shipping Fee';
		$text_order_receiver = 'Recipient';
	}
	echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:x="urn:schemas-microsoft-com:office:excel"
		xmlns="http://www.w3.org/TR/REC-html40">
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
		<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<style id="Classeur1_16681_Styles"></style>
		<style type="text/css">
			.shulist{mso-style-parent:style0;color:windowtext;text-align:left;border:.5pt solid windowtext;mso-protection:unlocked visible;white-space:normal;mso-rotate:90;text-align:center;}
		</style>
		</head>
		<body>
		<div id="Classeur1_16681" align=center x:publishsource="Excel">
			<table x:str border=0 cellpadding=0 cellspacing=0 style="font-family: Calibri, Helvetica, SimSun, sans-serif;border-collapse: collapse;">
				<tr>
					<th height="50" style="font-size:20px;border:.5pt solid windowtext;" colspan="10" align="center" class="xl2216681 nowrap">'.$text_orderlist.'</th>
				</tr>
				<tr>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);" height="30" align="center" class="xl2216681 nowrap">'.lang('cy_sn').'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);" align="center" class="xl2216681 nowrap">'.$text_ordernumber.'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);" align="center" class="xl2216681 nowrap">'.lang('dz_user_username').'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);" align="center" class="xl2216681 nowrap">'.$text_totalprice.'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);" align="center" class="xl2216681 nowrap">'.$text_ordertime.'</th>		
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);" align="center" class="xl2216681 nowrap">'.$text_order_shipping_fee.'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);" align="center" class="xl2216681 nowrap">'.$text_order_receiver.'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);" align="center" class="xl2216681 nowrap">'.lang('dz_user_phone').'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);" align="center" class="xl2216681 nowrap">'.lang('dz_user_address').'</th>
					<th style="min-height:30px;border:.5pt solid windowtext;background:rgb(171,16,50);" align="center" class="xl2216681 nowrap">'.lang('cy_status').'</th>
				</tr>';
				//选择数据--开始
				if(!empty($orderlist)){for($i=0;$i<count($orderlist);$i++){
					
					echo '<tr>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.($i+1).'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$orderlist[$i]['order_number'].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.userTextDecode(strip_tags($orderlist[$i]['user_username'])).'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.'&yen;'.$orderlist[$i]['total_price_rmb'].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.date('Y-m-d H:i:s', $orderlist[$i]['created']).'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.'&yen;'.number_format($orderlist[$i]['express_price_rmb'], 2, ".", ",").'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$orderlist[$i]['address_username'].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$orderlist[$i]['address_phone'].'</td>';
					echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$orderlist[$i]['address_province'].' '.$orderlist[$i]['address_city'].' '.$orderlist[$i]['address_area'].' '.$orderlist[$i]['address_street_address'].'</td>';
					if($orderlist[$i]['status'] == 0){
						echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$text_orderstatus_unpaid.'</td>';
					}else if($orderlist[$i]['status'] == 1){
						echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$text_orderstatus_waitforshipping.'</td>';
					}else if($orderlist[$i]['status'] == 2){
						echo '<td style="min-height:30px;border:.5pt solid windowtext;background:#EFEFEF;" align="center" class="xl2216681 nowrap">'.$text_orderstatus_hasshipped.'</td>';
					}
					
					echo '</tr>';
				}}
				//选择数据--结束
		echo '</table>
		</div>
		</body>
		</html>';
