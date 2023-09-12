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

<?php if($parent != 3 && $second_id != 6){?>
	<table class="gksel_normal_tabaction">
		<tr>
			<td>
				<div class="ma_actions">
					<ul>
						<li><b><?php echo lang('cy_actions')?> :</b></li>
						<li>
							<a style="display: none;" href="<?php echo base_url().'index.php/admins/cms/tomanage_sub_banner/'.$parent.'/'.$second_id.'?backurl='.$backurl.'&subbackurl='.$current_url_encode?>"><font class="nav_on"><?php echo lang('cy_picture_manage')?></font></a>
						
							<a href="<?php echo base_url().'index.php/admins/cms/toadd_third_banner/'.$parent.'/'.$second_id.'?backurl='.$backurl.'&subbackurl='.$current_url_encode?>"><font class="nav_off"><?php echo lang('cy_picture_add')?></font></a>
						</li>
					</ul>
				</div>
			</td>
			<td>
				
			</td>
		</tr>
	</table>
<?php }?>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="165" align="center"><?php echo lang('cy_posttime')?></td>
			<?php if($second_id == 5 || $second_id == 106 || $second_id == 126 || $second_id == 108 || $second_id == 110 || $second_id == 112 || $second_id == 114 || $second_id == 83 || $second_id == 85 || $second_id == 87 || $second_id == 96){?>
				<td width="100" align="center"><p><?php echo lang('cy_picture')?></p></td>
			<?php }?>
			<td ><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_name')?></p></td>
			<?php if($parent != 3){?>
				<td style="display: none;"><p>&nbsp;&nbsp;&nbsp;动画</p></td>
			<?php }?>
			<td width="100" align="center" style="display: none;"><p><?php echo lang('cy_author')?></p></td>
			<td width="250" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
</table>
<ul id="tasks" style="float:left;width:100%;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;">
	<?php if(isset($cmslist)){for ($i = 0; $i < count($cmslist); $i++) {?>
<li class="articlelist" id="<?php echo $cmslist[$i]['cms_id']?>" id="<?php echo $i+1?>" style="width:100%;padding:0px;margin:0px;list-style-type: none;">
<table class="gksel_normal_tablist" style="margin:0px;padding:0px;">
	<tbody>
			<tr >
				<td align="center" width="165"><?php echo date('Y-m-d H:i:s', $cmslist[$i]['created'])?></td>
				<?php if($second_id == 5 || $second_id == 106 || $second_id == 126 || $second_id == 108 || $second_id == 110 || $second_id == 112 || $second_id == 114 || $second_id == 83 || $second_id == 85 || $second_id == 87 || $second_id == 96){?>
					<td align="center" width="100">
						<?php if($cmslist[$i]['pic_1']!=""){?>
							<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().$cmslist[$i]['pic_1']?>"/>
						<?php }else{?>
							<?php if($second_id != 96){?>
								<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().'themes/default/images/none_product.png'?>"/>
							<?php }?>
						<?php }?>
					</td>
				<?php }?>
				<td>
					<div style="float:left;width:100%;">
						<?php echo debaseurlcontent($cmslist[$i]['cms_profile'.$this->langtype]);?>
					</div>
					<?php if($cmslist[$i]['shorturl'] != ''){?>
						<div style="display:none;float:left;width:100%;color:#CCC;">
							<?php echo base_url().'index.php/cms/'.$cmslist[$i]['shorturl'];?>
						</div>
					<?php }?>
				</td>
				<?php if($parent != 3){?>
					<td style="display: none;">
						<?php echo debaseurlcontent($cmslist[$i]['cms_link']);?>
					</td>
				<?php }?>
				<td align="center" style="display: none;"><?php echo $cmslist[$i]['edited_author']?></td>
				<td align="center">
					<div style="float:right;">
						<?php 
							echo '<a href="'.base_url().'index.php/admins/cms/toedit_third_banner/'.$parent.'/'.$second_id.'/'.$cmslist[$i]['cms_id'].'?backurl='.$backurl.'&subbackurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
							
							if($parent != 3 && $second_id != 6 && $second_id != 110 && $second_id != 112){
								echo '<a onclick="todel_cms('.$cmslist[$i]['cms_id'].', \''.$cmslist[$i]['cms_name_en'].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
							}
						?>
					</div>
				</td>
			</tr>
		
	</tbody>
</table>
<?php }}?>
</li>
</ul>
<script src="<?php echo base_url()?>themes/default/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript">
	jQuery(function($) {
		$('.articlelist').each(function (){
			var height=$(this).find('table').height();
			$(this).css({'height':height+'px'});
		})
		$('#tasks').sortable({
			opacity:0.8,
			revert:true,
			forceHelperSize:true,
			placeholder: 'draggable-placeholder',
			forcePlaceholderSize:true,
			tolerance:'pointer',
			stop: function( event,ui) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
				$(ui.item).css('z-index', 'auto');
				var sortarr = [];
				var idarr=[];
				var i=0;
				$('.articlelist').each(function (){
					i++;
					sortarr.push(i);
					idarr.push($(this).attr('id'));
				})
				$.post(baseurl+'index.php/admins/cms/editcms_sort',{idarr:idarr, sortarr:sortarr},function (data){
					
				})
			},
			scroll: true,
		});
		
	})
</script>
<?php $this->load->view('admin/footer')?>