<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_product.js?date=<?php echo CACHE_USETIME()?>'></script>
	
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

$product_type = $this->input->get('product_type');
$keyword = $this->input->get('keyword');
?>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<a href="<?php echo base_url().'index.php/admins/product/toadd_picture/'.$product_id.'?backurl='.$backurl.'&subbackurl='.$current_url_encode?>"><font class="nav_on"><img class="plus" src="<?php echo base_url().'themes/default/images/plus.png'?>"/> <?php echo lang('cy_picture_add')?></font></a>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_picture')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_name')?></p></td>
			<td width="165" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="200" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
</table>
<ul id="tasks" style="float:left;width:100%;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;">
<?php if(isset($picturelist)){for ($i = 0; $i < count($picturelist); $i++) {?>
	<li class="articlelist" id="<?php echo $picturelist[$i]['picture_id']?>" iid="<?php echo $i+1?>" style="width:100%;padding:0px;margin:0px;list-style-type: none;">
		<table class="gksel_normal_tabsublist">
			<tbody>
					<tr>
						<td width="50" align="center"><?php echo ($i+1)?></td>
						<td width="100" align="center">
							<?php if($picturelist[$i]['picture_pic_100']!=""){?>
								<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().$picturelist[$i]['picture_pic_100']?>"/>
							<?php }?>
						</td>
						<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($picturelist[$i]['picture_name_en']));?></td>
						<td width="165" align="center"><?php echo date('Y-m-d H:i:s', $picturelist[$i]['edited'])?></td>
						<td width="200" align="center">
							<div style="float:right;">
								<?php 
									echo '<a href="'.base_url().'index.php/admins/product/toedit_picture/'.$picturelist[$i]['product_id'].'/'.$picturelist[$i]['picture_id'].'?backurl='.$backurl.'&subbackurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
										
									echo '<a onclick="todel_productpicture('.$picturelist[$i]['picture_id'].', \''.$picturelist[$i]['picture_name_en'].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
								?>
							</div>
						</td>
					</tr>
			</tbody>
		</table>
	</li>
<?php }}?>
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
					var newsrot=[];
					var idarr=[];
					var i=0;
					$('.articlelist').each(function (){
						i++;
						newsrot.push(i);
						idarr.push($(this).attr('id'));
					})
					$.post(baseurl+'index.php/admins/product/editpicture_sort',{idarr:idarr,newsrot:newsrot},function (data){
						
					})
				},
				scroll: true,
			});
			
		})
	</script>
<table class="gksel_normal_tabactionlist">
	<thead>
		<tr>
			<td colspan="9" style="padding:15px 15px;color:#b32948;font-size:16px;">
				<?php echo lang('cy_list_dragtips')?>
			</td>
		</tr>
	</thead>
</table>
<?php $this->load->view('admin/footer')?>