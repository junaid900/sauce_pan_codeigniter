<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_cms_keyword.js?date=<?php echo CACHE_USETIME()?>'></script>
	
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

$keyword = $this->input->get('keyword');
?>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;Name</p></td>
			<td width="180" align="center"><p>MACRONUTRIENTS (KAL)</p></td>
			<td width="180" align="center"><p>MACRONUTRIENTS (GRAMS)</p></td>
			<td width="165" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
<?php 
	$sql = "SELECT * FROM ".DB_PRE()."dish_group WHERE status = 1 ORDER BY group_id ASC";
	$grouplist = $this->db->query($sql)->result_array();
?>
	<tbody>
	<?php if(isset($grouplist)){for ($i = 0; $i < count($grouplist); $i++) {?>
		<?php 
			$sql = "SELECT * FROM ".DB_PRE()."dish_list WHERE status = 1 AND group_id = ".$grouplist[$i]['group_id']." ORDER BY dish_id ASC";
			$dishlist = $this->db->query($sql)->result_array();
		?>
			<tr>
				<td align="center" style="border-bottom:0px;"><?php echo $i+1?></td>
				<td style="border-bottom:1px solid #CCC;font-weight:bold;">
					<?php echo $grouplist[$i]['group_name'.$this->langtype];?>
				</td>
				<td style="border-bottom:1px solid #CCC;" align="center"></td>
				<td style="border-bottom:1px solid #CCC;" align="center"></td>
				<td style="border-bottom:1px solid #CCC;" align="center"></td>
				<td style="border-bottom:1px solid #CCC;" align="center">
					
				</td>
			</tr>
			<?php if(!empty($dishlist)){for ($j = 0; $j < count($dishlist); $j++) {?>
				<tr>
					<td align="center" <?php if($j != (count($dishlist) - 1)){echo 'style="border-bottom:0;"';}?>></td>
					<td <?php if($j != (count($dishlist) - 1)){echo 'style="border-bottom:1px solid #CCC;"';}?>>
						<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($dishlist[$j]['dish_name'.$this->langtype]));?>
					</td>
					<td <?php if($j != (count($dishlist) - 1)){echo 'style="border-bottom:1px solid #CCC;"';}?> align="left">
						<?php if($dishlist[$j]['dish_kal_protein'] != 0){?>
							<div style="float:left;width:100%;">
								Protein: <?php echo $dishlist[$j]['dish_kal_protein']?>
							</div>
						<?php }?>
						<?php if($dishlist[$j]['dish_kal_fat'] != 0){?>
							<div style="float:left;width:100%;margin-top:5px;">
								Fat: <?php echo $dishlist[$j]['dish_kal_fat']?>
							</div>
						<?php }?>
						<?php if($dishlist[$j]['dish_kal_carbohydrate'] != 0){?>
							<div style="float:left;width:100%;margin-top:5px;">
								Carbohydrate: <?php echo $dishlist[$j]['dish_kal_carbohydrate']?>
							</div>
						<?php }?>
					</td>
					<td <?php if($j != (count($dishlist) - 1)){echo 'style="border-bottom:1px solid #CCC;"';}?> align="left">
						<?php if($dishlist[$j]['dish_grams_protein'] != 0){?>
							<div style="float:left;width:100%;">
								Protein: <?php echo $dishlist[$j]['dish_grams_protein']?> g
							</div>
						<?php }?>
						<?php if($dishlist[$j]['dish_grams_fat'] != 0){?>
							<div style="float:left;width:100%;margin-top:5px;">
								Fat: <?php echo $dishlist[$j]['dish_grams_fat']?> g
							</div>
						<?php }?>
						<?php if($dishlist[$j]['dish_grams_carbohydrate'] != 0){?>
							<div style="float:left;width:100%;margin-top:5px;">
								Carbohydrate: <?php echo $dishlist[$j]['dish_grams_carbohydrate']?> g
							</div>
						<?php }?>
					</td>
					<td <?php if($j != (count($dishlist) - 1)){echo 'style="border-bottom:1px solid #CCC;"';}?> align="center"><?php echo date('Y-m-d H:i:s', $dishlist[$j]['edited'])?></td>
					<td <?php if($j != (count($dishlist) - 1)){echo 'style="border-bottom:1px solid #CCC;"';}?> align="center">
						<div style="float:right;">
							<?php 
								echo '<a href="'.base_url().'index.php/admins/cms/toedit_dish/'.$dishlist[$j]['dish_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
							?>
						</div>
					</td>
				</tr>
			<?php }}?>
	<?php }}?>
	</tbody>
</table>
<?php $this->load->view('admin/footer')?>