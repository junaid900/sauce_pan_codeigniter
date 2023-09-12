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
			<td width="165" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
<?php 
	$sql = "SELECT * FROM ".DB_PRE()."faq_list WHERE status = 1 ORDER BY faq_id ASC";
	$faqlist = $this->db->query($sql)->result_array();
?>
	<tbody>
		<?php if(!empty($faqlist)){for ($j = 0; $j < count($faqlist); $j++) {?>
			<tr>
				<td align="center"><?php echo $j + 1?></td>
				<td>
					<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($faqlist[$j]['faq_name'.$this->langtype]));?>
				</td>
				<td align="center"><?php echo date('Y-m-d H:i:s', $faqlist[$j]['edited'])?></td>
				<td align="center">
					<div style="float:right;">
						<?php 
							echo '<a href="'.base_url().'index.php/admins/cms/toedit_faq/'.$faqlist[$j]['faq_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>
<?php $this->load->view('admin/footer')?>