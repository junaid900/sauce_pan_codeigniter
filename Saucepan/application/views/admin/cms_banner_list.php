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

$keyword = $this->input->get('keyword');
?>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_name')?></p></td>
			<td width="165" align="center"><?php echo lang('cy_posttime')?></td>
			<td width="100" align="center"><p><?php echo lang('cy_author')?></p></td>
			<td width="200" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		
		<?php 
		if(isset($cmslist)){for ($i = 0; $i < count($cmslist); $i++) {?>
			<tr style="<?php if($i==1) {echo 'display: none;';}?>">
				<td align="center">
					<?php echo $i+1;?>
				</td>
				<td>
					<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($cmslist[$i]['cms_name'.$this->langtype]));?>
				</td>
				<td align="center"><?php echo date('Y-m-d H:i:s', $cmslist[$i]['created'])?></td>
				<td align="center"><?php echo $cmslist[$i]['edited_author']?></td>
				<td align="center">
					<div style="float:right;">
						<?php 
							$con = array('parent'=>$cmslist[$i]['cms_id'],'orderby'=>'a.sort', 'orderby_res'=>'ASC');
							$count = $this->CmsModel->getcmslist($con,1);
							if($count > 0){
								$text = '<font class="fonterror">('.$count.')</font>';
							}else{
								$text = '';
							}
							echo '<a href="'.base_url().'index.php/admins/cms/bannersublist/'.$cmslist[$i]['cms_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_content_manage').' '.$text.'</a>';
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>

<?php $this->load->view('admin/footer')?>