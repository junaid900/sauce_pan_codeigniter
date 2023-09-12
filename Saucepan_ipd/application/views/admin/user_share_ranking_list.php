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

$user_type = $this->input->get('user_type');
$keyword = $this->input->get('keyword');

$sql = "
	SELECT a.totalnum, b.*
		
	FROM ".DB_PRE()."user_sharescore AS a
	
	LEFT JOIN ".DB_PRE()."user_list AS b ON a.uid = b.uid
	
	WHERE a.totalnum > 0
			
	ORDER BY a.totalnum DESC, b.created DESC
";
$userlist = $this->db->query($sql)->result_array();
if(!empty($userlist)){
	
}else{
	$userlist = null;
}
?>
<table class="gksel_normal_tablist" style="min-width:950px;">
	<thead>
		<tr>
			<td width="40" align="center">排名</td>
			<td width="70" align="center"><p><?php if($this->langtype == '_ch'){echo '头像';}else{echo 'Avatar';}?></a></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;联系方式</a></p></td>
			<td width="140" align="center"><p>分享数量</p></td>
		</tr>
	</thead>
	<tbody>
		<?php 
		if(isset($userlist)){for ($i = 0; $i < count($userlist); $i++) {?>
			<tr>
				<td align="center" style="<?php if($userlist[$i]['wechat_subscribe'] == 0){echo 'opacity:0.3;';}?>"><?php echo $i+1?></td>
				<td align="center">
					<div style="float: left;width:100%;<?php if($userlist[$i]['wechat_subscribe'] == 0){echo 'opacity:0.3;';}?>">
						
					</div>
					<?php if($userlist[$i]['wechat_subscribe'] == 0){?>
						<div style="float: left;width:100%;color:red;margin-top:5px;">
							<?php echo 'Unfollowed';?>
						</div>
					<?php }?>
				</td>
				<td style="<?php if($userlist[$i]['wechat_subscribe'] == 0){echo 'opacity:0.3;';}?>">
					<div style="float: left;width:100%;">
						<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($userlist[$i]['user_realname']));?>
						<span style="color:#ccc;padding-left:10px;">
							<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags(userTextDecode($userlist[$i]['wechat_nickname'])));?>
						</span>
					</div>
					<div style="float: left;width:100%;">
						<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($userlist[$i]['user_phone'])).'&nbsp;&nbsp;&nbsp;&nbsp;';?>
						<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($userlist[$i]['user_email']));?>
					</div>
				</td>
				<td align="center" style="<?php if($userlist[$i]['wechat_subscribe'] == 0){echo 'opacity:0.3;';}?>">
					<?php echo $userlist[$i]['totalnum']?>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>

<?php $this->load->view('admin/footer')?>