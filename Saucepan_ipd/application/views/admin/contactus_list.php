<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_contactus.js?date=<?php echo CACHE_USETIME()?>'></script>
	
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

$category_id = $this->input->get('category_id');
$keyword = $this->input->get('keyword');
?>

<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td width="150"><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></p></td>
			<td width="150" align="center"><p><?php if($this->langtype == '_ch'){echo '邮箱';}else{echo 'Email';}?></p></td>
			<td width="240" align="center"><p><?php if($this->langtype == '_ch'){echo '电话';}else{echo 'phone';}?></p></td>
			
			<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '创建时间';}else{echo 'Create Time';}?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_status')?></p></td>
			<td width="200" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($contactuslist)){for ($i = 0; $i < count($contactuslist); $i++) {?>
			<tr>
				<td align="center"><?php echo ($i+1)?></td>
				<td>
					<div style="float:left;width: 100%;">
						<?php 
							if($contactuslist[$i]['contactus_name'] != ''){
								echo actionsearchdaxiaoxiezimu($keyword, strip_tags($contactuslist[$i]['contactus_name']));
							}else{
								echo $contactuslist[$i]['form_firstname'].' '.$contactuslist[$i]['form_lastname'];
							}
						?>
					</div>
				</td>
				<td align="center">
					<div style="float:left;width: 100%;">
						<?php 
							if($contactuslist[$i]['contactus_email'] != ''){
								echo actionsearchdaxiaoxiezimu($keyword, strip_tags($contactuslist[$i]['contactus_email']));
							}else{
								echo $contactuslist[$i]['form_email'];
							}
						?>
					</div>
				</td>
				<td align="center">
					<div style="float:left;width: 100%;">
						<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($contactuslist[$i]['contactus_phone']));?>
					</div>
				</td>
				
				<td align="center"><?php echo date('Y-m-d', $contactuslist[$i]['created']).'<br />'.date('H:i:s', $contactuslist[$i]['created'])?></td>
				<td align="center">
					<?php 
						if($contactuslist[$i]['isread'] == 1){
							if($this->langtype == '_ch'){echo '<span style="color:green;">已读</span>';}else{echo '<span style="color:green;">Readed</span>';}
						}else{
							if($this->langtype == '_ch'){echo '<span style="color:red;">未读</span>';}else{echo '<span style="color:red;">Unread</span>';}
						}
					?>
				</td>
				
				<td align="center">
					<div style="float:right;">
						<?php 
							echo '<a href="'.base_url().'index.php/admins/contactus/toview_contactus/'.$contactuslist[$i]['contactus_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_view').'</a>';
								
							echo '<a onclick="todel_contactus('.$contactuslist[$i]['contactus_id'].', \''.$contactuslist[$i]['contactus_name'].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
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