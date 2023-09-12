<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_cms_cms.js?date=<?php echo CACHE_USETIME()?>'></script>
	
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
			
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="165" align="center"><?php echo lang('cy_posttime')?></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_name')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_author')?></p></td>
			<td width="250" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($cmslist)){for ($i = 0; $i < count($cmslist); $i++) {?> <!-- //count($cmslist) -->
			<tr style="<?php if($i==1) {echo 'display:none;';}?>">
				<td align="center"><?php echo date('Y-m-d H:i:s', $cmslist[$i]['created'])?></td>
				<td>
					<?php if($cmslist[$i]['cms_id'] == 83 || $cmslist[$i]['cms_id'] == 85 || $cmslist[$i]['cms_id'] == 87){?>
						<div style="float:left;margin-right:10px;">
							<img style="height:40px;" src="<?php echo base_url().$cmslist[$i]['pic_1']?>"/>
						</div>
						<div style="float:left;margin-top:12px;">
							<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($cmslist[$i]['cms_name'.$this->langtype]));?>
						</div>
					<?php }else{?>
						<div style="float:left;">
							<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($cmslist[$i]['cms_name'.$this->langtype]));?>
						</div>
					<?php }?>
				</td>
				<td align="center"><?php echo $cmslist[$i]['edited_author']?></td>
				<td align="center">
					<div style="float:right;">
						<?php 
							if($cmslist[$i]['cms_id'] == 63 || $cmslist[$i]['cms_id'] == 81 || $cmslist[$i]['cms_id'] == 83 || $cmslist[$i]['cms_id'] == 85 || $cmslist[$i]['cms_id'] == 87 || $cmslist[$i]['cms_id'] == 100 || $cmslist[$i]['cms_id'] == 101){
								echo '<a href="'.base_url().'index.php/admins/cms/toedit_sub_banner/'.$parent.'/'.$cmslist[$i]['cms_id'].'?backurl='.$backurl.'&subbackurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
							}
						
							if($cmslist[$i]['cms_id'] != 63 && $cmslist[$i]['cms_id'] != 83 && $cmslist[$i]['cms_id'] != 85 && $cmslist[$i]['cms_id'] != 87 && $cmslist[$i]['cms_id'] != 100 && $cmslist[$i]['cms_id'] != 101){
								$con = array('parent'=>$cmslist[$i]['cms_id'],'orderby'=>'a.sort', 'orderby_res'=>'ASC');
								$count = $this->CmsModel->getcmslist($con,1);
								if($count > 0){
									$text = '<font class="fonterror">('.$count.')</font>';
								}else{
									$text = '';
								}
								echo '<a href="'.base_url().'index.php/admins/cms/tomanage_sub_banner/'.$parent.'/'.$cmslist[$i]['cms_id'].'?backurl='.$backurl.'&subbackurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_content_manage').''.$text.'</a>';
							}
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>

<?php $this->load->view('admin/footer')?>