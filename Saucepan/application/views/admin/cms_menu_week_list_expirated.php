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


<?php 
$sql = "
	SELECT DISTINCT a.week_id

	FROM ".DB_PRE()."menu_box AS a

	LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id

	WHERE a.menu_id = ".$menu_id." AND a.status = 1

	AND b.week_id >= ".$current_week_id."
";
$query = $this->db->query($sql);
if($query->num_rows()>0){
	$count_live = $query->num_rows();
}else{
	$count_live = 0;
}
	
$sql = "
	SELECT DISTINCT a.week_id

	FROM ".DB_PRE()."menu_box AS a

	LEFT JOIN ".DB_PRE()."system_week_list AS b ON a.week_id = b.week_id

	WHERE a.menu_id = ".$menu_id." AND a.status = 1

	AND b.week_id < ".$current_week_id."
";
$query = $this->db->query($sql);
if($query->num_rows()>0){
	$count_expirated = $query->num_rows();
}else{
	$count_expirated = 0;
}
?>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div style="float:left;">
				<?php 
					if($menu_id == 1){
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">5, 10 and 21 days plan</div>';
						echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">General Menu</div>';
					}else if($menu_id == 2){
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">5, 10 and 21 days plan</div>';
						echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Vegetarian Menu</div>';
					}else if($menu_id == 3){
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">5, 10 and 21 days plan</div>';
						echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Pescetarian Menu</div>';
					}
					
					else if($menu_id == 4){
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Flexible weekly plan</div>';
						echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">General Menu</div>';
					}else if($menu_id == 5){
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Flexible weekly plan</div>';
						echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Vegetarian Menu</div>';
					}else if($menu_id == 6){
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Flexible weekly plan</div>';
						echo '<div style="float:left;line-height:22px;padding:0px 8px;margin-right:5px;">></div>';
						echo '<div style="float:left;background:#EFEFEF;line-height:22px;padding:0px 8px;margin-right:5px;">Pescetarian Menu</div>';
					}
				?>
			</div>
			<div style="float:right;margin-right:10px;">
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/cms/menuweeklist/'.$menu_id?>';" style="cursor:pointer;float:left;margin-left:5px;margin-top:-4px;background:#CCC;color:gray;font-size:12px;padding:6px 8px;">
					Live weeks <span style="color:green;"><?php echo '('.$count_live.')';?></span>
				</div>
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/cms/menuweek_expiratedlist/'.$menu_id?>';" style="cursor:pointer;float:left;margin-left:5px;margin-top:-4px;background:rgb(171,16,50);color:white;font-size:12px;padding:6px 8px;">
					Expirated weeks <span style="color:gray;"><?php echo '('.$count_expirated.')';?></span>
				</div>
			</div>
		</td>
	</tr>
</table>
<?php 
	$sql = "SELECT * FROM ".DB_PRE()."system_week_list WHERE week_id < ".$current_week_id." ORDER BY week_end DESC";
	$weeklist = $this->db->query($sql)->result_array();
?>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;Name</p></td>
			<?php if($menu_id == 1 || $menu_id == 2 || $menu_id == 3){?>
				<td width="250" align="center"><p>Breakfast</p></td>
			<?php }?>
			<td width="250" align="center"><p>Lunch</p></td>
			<td width="250" align="center"><p>Booster</p></td>
			<td width="250" align="center"><p>Dinner</p></td>
			<td width="80" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<?php 
		$weekarray = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
	?>
	<tbody>
		<?php if(!empty($weeklist)){for ($i = 0; $i < count($weeklist); $i++) {?>			
			<tr>
				<td align="center" style="border-bottom:0px;"><?php echo $i+1?></td>
				<td <?php if($menu_id == 1 || $menu_id == 2 || $menu_id == 3){echo 'colspan="5"';}else{echo 'colspan="4"';}?> style="border-bottom:1px solid #CCC;font-weight:bold;font-size:16px;">
					
					<div style="float:left;">
						<?php echo date('Y-m-d', $weeklist[$i]['week_start']).' ~ '.date('Y-m-d', $weeklist[$i]['week_end'])?>
					</div>
					
					<?php if($current_week_id == $weeklist[$i]['week_id']){?>
						<div style="float:left;margin-left:5px;margin-top:-4px;background:green;color:white;font-size:14px;padding:4px 8px;border-radius:6px;">
							Current week
						</div>
					<?php }else{?>
						<div style="float:left;margin-left:5px;margin-top:-4px;background:orange;color:white;font-size:14px;padding:4px 8px;border-radius:6px;">
							<?php 
								if(($weeklist[$i]['week_id'] - $current_week_id) == 1){
									echo '+'.($weeklist[$i]['week_id'] - $current_week_id).' week';
								}else{
									echo '+'.($weeklist[$i]['week_id'] - $current_week_id).' weeks';
								}
							?>
						</div>
					<?php }?>
				</td>
				<td style="border-bottom:1px solid #CCC;" align="center">
					-
				</td>
			</tr>
			<?php for ($j = 1; $j <= 7; $j++) {?>
				<?php 
					$sql = "SELECT * FROM ".DB_PRE()."menu_box WHERE menu_id = ".$menu_id." AND week_id = ".$weeklist[$i]['week_id']." AND weekday_num = ".$j;
					$boxinfo =  $this->db->query($sql)->row_array();
				?>
				<tr>
					<td align="center" <?php if($j != 7){echo 'style="border-bottom:0;padding-top:5px;padding-bottom:5px;"';}else{echo 'style="padding-top:5px;padding-bottom:5px;"';}?>></td>
					<td <?php if($j != 7){echo 'style="border-bottom:1px solid #CCC;padding-top:5px;padding-bottom:5px;';}else{echo 'style="padding-top:5px;padding-bottom:5px;"';}?>">
						<div style="float:left;width:100%;">
							<?php echo date('Y-m-d', strtotime(date('Y-m-d H:i:s', $weeklist[$i]['week_start']).' +'.($j - 1).' day'));?>
						</div>
						<div style="float:left;width:100%;margin-top:5px;">
							<?php echo $weekarray[$j]?>
						</div>
					</td>
					<?php if($menu_id == 1 || $menu_id == 2 || $menu_id == 3){?>
						<td <?php if($j != 7){echo 'style="border-bottom:1px solid #CCC;padding-top:5px;padding-bottom:5px;"';}else{echo 'style="padding-top:5px;padding-bottom:5px;"';}?>" align="center" valign="top">
							<?php 
								if(!empty($boxinfo)){
									echo '<div style="float:left;width:100%;font-size:14px;font-weight:bold;">'.$boxinfo['box_breakfast_title'].'</div>';
									echo '<div style="float:left;width:100%;font-size:12px;margin-top:5px;">'.nl2br($boxinfo['box_breakfast_description']).'</div>';
								}
							?>
						</td>
					<?php }?>
					<td <?php if($j != 7){echo 'style="border-bottom:1px solid #CCC;padding-top:5px;padding-bottom:5px;"';}else{echo 'style="padding-top:5px;padding-bottom:5px;"';}?>" align="center" valign="top">
						<?php 
							if(!empty($boxinfo)){
								echo '<div style="float:left;width:100%;font-size:14px;font-weight:bold;">'.$boxinfo['box_lunch_title'].'</div>';
								echo '<div style="float:left;width:100%;font-size:12px;margin-top:5px;">'.nl2br($boxinfo['box_lunch_description']).'</div>';
							}
						?>
					</td>
					<td <?php if($j != 7){echo 'style="border-bottom:1px solid #CCC;padding-top:5px;padding-bottom:5px;"';}else{echo 'style="padding-top:5px;padding-bottom:5px;"';}?>" align="center" valign="top">
						<?php 
							if(!empty($boxinfo)){
								echo '<div style="float:left;width:100%;font-size:14px;font-weight:bold;">'.$boxinfo['box_booster_title'].'</div>';
								echo '<div style="float:left;width:100%;font-size:12px;margin-top:5px;">'.nl2br($boxinfo['box_booster_description']).'</div>';
							}
						?>
					</td>
					<td <?php if($j != 7){echo 'style="border-bottom:1px solid #CCC;padding-top:5px;padding-bottom:5px;"';}else{echo 'style="padding-top:5px;padding-bottom:5px;"';}?>" align="center" valign="top">
						<?php 
							if(!empty($boxinfo)){
								echo '<div style="float:left;width:100%;font-size:14px;font-weight:bold;">'.$boxinfo['box_dinner_title'].'</div>';
								echo '<div style="float:left;width:100%;font-size:12px;margin-top:5px;">'.nl2br($boxinfo['box_dinner_description']).'</div>';
							}
						?>
					</td>
					<td <?php if($j != 7){echo 'style="border-bottom:1px solid #CCC;padding-top:5px;padding-bottom:5px;"';}else{echo 'style="padding-top:5px;padding-bottom:5px;"';}?>" align="center">
						-
					</td>
				</tr>
			<?php }?>
		<?php }}?>
	</tbody>
</table>
<?php $this->load->view('admin/footer')?>