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

$feedback_type = $this->input->get('feedback_type');
$keyword = $this->input->get('keyword');
?>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			
		</td>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/feedback/index'?>" method="get">
					<input type="text" name="keyword" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
					<input type="submit" value="<?php echo lang('cy_search')?>"/>
				</form>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_realname')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_feedback_content')?></p></td>
			<td width="90" align="center"><p><?php echo lang('cy_status')?></p></td>
			<td width="90"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_status')?></p></td>
			<td width="165" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="300" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($feedbacklist)){for ($i = 0; $i < count($feedbacklist); $i++) {?>
			<tr <?php if($feedbacklist[$i]['status'] == 0){echo 'style="opacity: 0.5;"';}?>>
				<td align="center"><?php echo $i+1?></td>
				<td>
					<div style="float:left;width:100%;">
						<?php 
							echo $feedbacklist[$i]['feedback_realname'];
						?>
					</div>
					<div style="float:left;width:100%;">
						<?php 
							echo $feedbacklist[$i]['feedback_phone'];
						?>
					</div>
					<div style="float:left;width:100%;">
						<?php 
							echo $feedbacklist[$i]['feedback_email'];
						?>
					</div>
				</td>
				<td>
					<div class="gksel_feedback_content_ellipsis">
						<?php 
							echo trim($feedbacklist[$i]['feedback_content']);
						?>
					</div>
				</td>
				<td align="center">
					<?php 
						if($feedbacklist[$i]['isread'] == 1){
							if($this->langtype == '_ch'){echo '<span style="color:green;">已读</span>';}else{echo '<span style="color:green;">Readed</span>';}
						}else{
							if($this->langtype == '_ch'){echo '<span style="color:red;">未读</span>';}else{echo '<span style="color:red;">Unread</span>';}
						}
					?>
				</td>
				<td>
					<?php 
						if($feedbacklist[$i]['status'] == 0){
							echo '<font class="fonterror">已删除</font>';
						}else if($feedbacklist[$i]['isreply'] == 1){
							echo '<font class="fontgreen">已回复</font>';
						}else{
							echo '<font class="fonterror">待回复</font>';
						}
					?>
				</td>
				<td align="center"><?php echo date('Y-m-d H:i:s', $feedbacklist[$i]['edited'])?></td>
				<td align="center">
					<div style="float:right;">
						<?php 
							echo '<a href="'.base_url().'index.php/admins/feedback/toreply_feedback/'.$feedbacklist[$i]['feedback_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">查看</a>';
// 							echo '<a onclick="todel_feedback('.$feedbacklist[$i]['feedback_id'].', \''.trim($feedbacklist[$i]['feedback_realname']).'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>

<?php $this->load->view('admin/footer')?>