<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_service.js?date=<?php echo CACHE_USETIME()?>'></script>
	
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
				<form action = "<?php echo base_url().'index.php/admins/service/categorylist'?>" method="get">
					<input type="text" name="keyword" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
					<input type="submit" value="<?php echo lang('cy_search')?>"/>
				</form>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<a href="<?php echo base_url().'index.php/admins/service/toadd_service_subcategory/'.$parent.'?backurl='.$backurl.'&subbackurl='.$current_url_encode?>">
					<font class="nav_on">
						<font class="plus">
							<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
							<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
						</font>
						<span><?php echo lang('dz_product_subcategory_add')?></span>
					</font>
				</a>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '子分类名称';}else{echo 'Subcategory Name';}?></p></td>
			<td width="165" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_author')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_status')?></p></td>
			<td width="300" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
</table>
<ul id="tasks" style="float:left;width:100%;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;">
	<?php if(isset($subcategorylist)){for ($i = 0; $i < count($subcategorylist); $i++) {?>
		<li class="articlelist" id="<?php echo $subcategorylist[$i]['category_id']?>" iid="<?php echo $i+1?>" style="width:100%;padding:0px;margin:0px;list-style-type: none;">
			<table class="gksel_normal_tablist" style="margin-top: 0px;">
				<tbody>
					<tr style="<?php if($subcategorylist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
						<td width="50" align="center" style="padding:0px;"><?php echo ($i+1)?></td>
						<td>
							<div style="float:left;width:100%;">
								<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($subcategorylist[$i]['category_name'.$this->langtype]));?>
							</div>
							<?php if($subcategorylist[$i]['category_tagline'.$this->langtype] != ''){?>
								<div style="float:left;width:100%;margin-top:5px;color:#999;">
									<?php echo $subcategorylist[$i]['category_tagline'.$this->langtype];?>
								</div>
							<?php }?>
						</td>
						<td width="165" align="center" style="padding:0px;"><?php echo date('Y-m-d H:i:s', $subcategorylist[$i]['edited'])?></td>
						<td width="100" align="center" style="padding:0px;"><?php echo $subcategorylist[$i]['edited_author']?></td>
						<td width="100" align="center" style="padding:0px;">
							<?php 
								if($subcategorylist[$i]['status'] == 1){
									echo lang('cy_online');
								}else{
									echo lang('cy_offline');
								}
							
							?>
						</td>
						<td width="300" align="center" style="padding:0px;">
							<div style="float:right;">
								<?php 
									$con = array('parent'=>$subcategorylist[$i]['category_id']);
									$countthirdcategory = $this->ServiceModel->getservicecategorylist($con, 1);
// 									if($countthirdcategory > 0){
// 										$text = lang('dz_product_thirdcategory_manage').' '.'<font class="fonterror">('.$countthirdcategory.')</font>';
// 									}else{
// 										$text = lang('dz_product_thirdcategory_manage');
// 									}
									
									//echo '<a href="'.base_url().'index.php/admins/product/thirdcategorylist/'.$parent.'/'.$subcategorylist[$i]['category_id'].'?backurl='.$backurl.'&subbackurl='.$current_url_encode.'" class="gksel_btn_action_on">'.$text.'</a>';
								
								
								
									echo '<a href="'.base_url().'index.php/admins/service/toedit_servicesubcategory/'.$parent.'/'.$subcategorylist[$i]['category_id'].'?backurl='.$backurl.'&subbackurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
										
									
									if($subcategorylist[$i]['category_id'] == 95){
										echo '<a href="javascript:;" class="gksel_btn_action_off">'.lang('cy_delete').'</a>';
									}else{
										if($countthirdcategory > 0){
											echo '<a href="javascript:;" class="gksel_btn_action_off">'.lang('cy_delete').'</a>';
										}else{
											echo '<a onclick="todel_servicecategory('.$subcategorylist[$i]['category_id'].', \''.$subcategorylist[$i]['category_name'.$this->langtype].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
										}
									}
									
									
								?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</li>
	<?php }}?>
</ul>
<table class="gksel_normal_tablist" style="margin-top: 0px;margin-bottom: 20px;">
	<thead>
		<tr>
			<td align="left" style="border-top: none;text-indent:15px;line-height:30px;"><?php echo lang('cy_list_dragtips')?></td>
		</tr>
	</thead>
</table>
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
				var servicerot=[];
				var idarr=[];
				var i=0;
				$('.articlelist').each(function (){
					i++;
					servicerot.push(i);
					idarr.push($(this).attr('id'));
				})
				$.post(baseurl+'index.php/admins/service/editcategory_sort',{idarr:idarr,servicerot:servicerot},function (data){
					
				})
			},
			scroll: true,
		});
		
	})
</script>
<?php $this->load->view('admin/footer')?>