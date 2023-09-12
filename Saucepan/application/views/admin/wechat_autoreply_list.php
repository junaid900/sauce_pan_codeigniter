<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_wechat.js?date=<?php echo CACHE_USETIME()?>'></script>
	
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
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<a href="<?php echo base_url().'index.php/admins/wechat/toadd_autoreply?backurl='.$current_url_encode?>"><font class="nav_on"><img class="plus" src="<?php echo base_url().'themes/default/images/plus.png'?>"/> Add Auto Reply</font></a>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '自动回复词语';}else{echo 'Auto Reply Words';}?></p></td>
			<td width="150" align="center"><p><?php if($this->langtype == '_ch'){echo '自动回复类型';}else{echo 'Auto Reply Type';}?></p></td>
			<td width="165" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_author')?></p></td>
			<td width="150" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($autoreplylist)){for ($i = 0; $i < count($autoreplylist); $i++) {?>
				<tr>
					<td width="50" align="center" style="padding:0px;"><?php echo ($i+1)?></td>
					<td>
						<?php 
							if($autoreplylist[$i]['autoreply_id'] == 1){
								if($this->langtype == '_ch'){
									echo '微信关注自动回复';
								}else{
									echo 'Wechat Follow Auto Reply';
								}
							}else{
								echo actionsearchdaxiaoxiezimu($keyword, strip_tags($autoreplylist[$i]['autoreply_name']));
							}
						?>
					</td>
					<td width="100" align="center" style="padding:0px;">
						<?php 
							if($autoreplylist[$i]['autoreply_type'] == 1){
								if($this->langtype == '_ch'){
									echo '文本';
								}else{
									echo 'Text';
								}
							}else if($autoreplylist[$i]['autoreply_type'] == 2){
								echo lang('cy_picture');
							}else if($autoreplylist[$i]['autoreply_type'] == 3){
								if($this->langtype == '_ch'){
									echo '图文消息';
								}else{
									echo 'News';
								}
							}else if($autoreplylist[$i]['autoreply_type'] == 4){
								if($this->langtype == '_ch'){
									echo '文字 + 图片';
								}else{
									echo 'Text + Picture';
								}
							}
						?>
					</td>
					<td width="165" align="center" style="padding:0px;"><?php echo date('Y-m-d H:i:s', $autoreplylist[$i]['edited'])?></td>
					<td width="100" align="center" style="padding:0px;"><?php echo $autoreplylist[$i]['edited_author']?></td>
					<td width="150" align="center" style="padding:0px;">
						<div style="float:right;">
							<?php 
								echo '<a href="'.base_url().'index.php/admins/wechat/toedit_autoreply/'.$autoreplylist[$i]['autoreply_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
								if($autoreplylist[$i]['autoreply_id'] != 1){
									echo '<a onclick="todel_autoreply('.$autoreplylist[$i]['autoreply_id'].', \''.addslashes($autoreplylist[$i]['autoreply_name']).'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
								}
							?>
						</div>
					</td>
				</tr>
		<?php }}?>
	</tbody>
</table>
<?php $this->load->view('admin/footer')?>