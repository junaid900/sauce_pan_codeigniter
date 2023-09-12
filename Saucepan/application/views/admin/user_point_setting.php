<?php $this->load->view('admin/header')?>
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
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '积分';}else{echo 'Points';}?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '积分说明';}else{echo 'Point Description';}?></p></td>
			<td width="150"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_time_lastedited')?></p></td>
			<td width="100"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<?php 
		$sql = "SELECT * FROM `".DB_PRE()."user_point_setting` ORDER BY `pointsetting_id` ASC";
		$pointsettinglist = $this->db->query($sql)->result_array();
	?>
	<tbody>
		<?php if(!empty($pointsettinglist)){for ($i = 0; $i < count($pointsettinglist); $i++) {?>
			<tr>
				<td align="center"><?php echo ($i+1)?></td>
				<td>
					<?php 
						if($pointsettinglist[$i]['pointsetting_id'] == 1){
						if($this->langtype == '_ch'){
							echo '用户购买获取的积分';
						}else{
							echo 'Points earned';
						}
						}else if($pointsettinglist[$i]['pointsetting_id'] == 2){
							echo '被分享的用户加入的用户返回给分享者积分（可重复）';
						}else if($pointsettinglist[$i]['pointsetting_id'] == 3){
							echo '积分可以抵扣钱的设置';
						}
					?>
				</td>
				<td>
					<?php if($pointsettinglist[$i]['pointsetting_id'] == 1){?>
							100 元 = <?php echo ($pointsettinglist[$i]['pointsetting_value'] * 100);?><?php if($this->langtype == '_ch'){echo '积分';}else{echo 'Points';}?>
					<?php }else if($pointsettinglist[$i]['pointsetting_id'] == 2){?>
							100 元 = <?php echo ($pointsettinglist[$i]['pointsetting_value'] * 100);?><?php if($this->langtype == '_ch'){echo '积分';}else{echo 'Points';}?>
					<?php }else if($pointsettinglist[$i]['pointsetting_id'] == 3){?>
							100 <?php if($this->langtype == '_ch'){echo '积分';}else{echo 'Points';}?> = <?php echo ($pointsettinglist[$i]['pointsetting_value'] * 100).' 元';?>
					<?php }?>
					
				</td>
				<td>
					<div style="float:left;">
						<?php echo date('Y-m-d H:i:s', $pointsettinglist[$i]['edited'])?>
					</div>
					<div style="float:left;width:100%;margin-top:5px;">
						<?php 
							$con = array('pointsetting_id'=>$pointsettinglist[$i]['pointsetting_id']);
							$count = $this->UserModel->getuser_pointsetting_historylist($con, 1);
							if($count > 0){
								$alink = base_url().'index.php/admins/user/pointsetting_historylist/'.$pointsettinglist[$i]['pointsetting_id'].'?backurl='.$current_url_encode;
								$text = '历史记录 <font style="color:#000;font-weight:bold;">('.$count.')</font>';
							}else{
								$alink = base_url().'index.php/admins/user/pointsetting_historylist/'.$pointsettinglist[$i]['pointsetting_id'].'?backurl='.$current_url_encode;
								$text = '历史记录 <font style="color:#000;font-weight:bold;">('.$count.')</font>';
							}
							echo '<a href="'.$alink.'">'.$text.'</a>';
						?>
					</div>
				</td>
				<td>
					<div style="float:right;">
						<?php 
							echo '<a href="'.base_url().'index.php/admins/user/toedit_pointsetting/'.$pointsettinglist[$i]['pointsetting_id'].'?backurl='.$current_url_encode.'"><img style="float:left;margin-right:15px;" src="'.base_url().'themes/default/images/icon_edit.gif"/></a>';
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>
<?php $this->load->view('admin/footer')?>