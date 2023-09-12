<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_event.js?date=<?php echo CACHE_USETIME()?>'></script>
	
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

$parentcategory_id = $this->input->get('parentcategory_id');
$subcategory_id = $this->input->get('subcategory_id');

$keyword = $this->input->get('keyword');
?>
<script>
	function tochooseparentcategory_id(category_id){
		$.post(baseurl+'index.php/admins/event/togetsubcategory_select/'+category_id, function (data){
			var obj = eval( "(" + data + ")" );
			$('.subcategory_area').html('<option value="0"><?php if($this->langtype == '_ch'){echo '选择子分类';}else{echo 'Select subcategory';}?></option>'+obj.item);
		})
	}
</script>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/event/index'?>" method="get">
					<?php 
						if($parentcategory_id == ''){
							$parentcategory_id = 0;
						}
						if($subcategory_id == ''){
							$subcategory_id = 0;
						}
						
						$parentcategory_id = 39;
						
// 						$con = array('parent'=>0, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
// 						$fenleilist = $this->EventModel->geteventcategorylist($con);
						
// 						echo '<select onchange="tochooseparentcategory_id(this.value)" name="parentcategory_id" style="float:left;background: url(\''.base_url().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:200px;margin:0px 10px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
// 						echo '<option value="0">-</option>';
// 						if(!empty($fenleilist)){
// 							for ($aaa = 0; $aaa < count($fenleilist); $aaa++) {
// 								$ischecked = '';
// 								if($parentcategory_id == $fenleilist[$aaa]['category_id']){
// 									$ischecked = 'selected';
// 								}
// 								echo '<option value="'.$fenleilist[$aaa]['category_id'].'" '.$ischecked.'>'.$fenleilist[$aaa]['category_name'.$this->langtype].'</option>';
// 							}
// 						}
// 						echo '</select>';
						
					?>
					
					<?php 
						if($parentcategory_id != 0){
							$con = array('parent'=>$parentcategory_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
							$subcategorylist = $this->EventModel->geteventcategorylist($con);
						}else{
							$subcategorylist = array();
						}
						
						echo '<select class="subcategory_area" name="subcategory_id" style="float:left;background: url(\''.base_url().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:200px;margin:0px 10px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
						echo '<option value="0">-</option>';
						if(!empty($subcategorylist)){
							for ($aaa = 0; $aaa < count($subcategorylist); $aaa++) {
								$ischecked = '';
								if($subcategory_id == $subcategorylist[$aaa]['category_id']){
									$ischecked = 'selected';
								}
								echo '<option value="'.$subcategorylist[$aaa]['category_id'].'" '.$ischecked.'>'.$subcategorylist[$aaa]['category_name'.$this->langtype].'</option>';
							}
						}
						echo '</select>';
					?>
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
				<a href="<?php echo base_url().'index.php/admins/event/toadd_event'?>">
					<font class="nav_on">
						<font class="plus">
							<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
							<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
						</font>
						<span><?php if($this->langtype == '_ch'){echo '添加活动';}else{echo 'Add Event';}?></span>
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
			<td width="100" align="center"><p><?php echo lang('cy_picture')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?></p></td>
		
			<td width="150" align="center"><p><?php if($this->langtype == '_ch'){echo '创建时间';}else{echo 'Created';}?></p></td>
			
			<td width="100" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_author')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_status')?></p></td>
			<td width="200" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($eventlist)){for ($i = 0; $i < count($eventlist); $i++) {?>
			<tr style="<?php if($eventlist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
				<td align="center"><?php echo ($i+1)?></td>
				<td align="center">
					<?php if($eventlist[$i]['event_pic_200']!=""){?>
						<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().$eventlist[$i]['event_pic_200']?>"/>
					<?php }else{?>
						
					<?php }?>
				</td>
				<td>
					<div style="float:left;width: 100%;">
						<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($eventlist[$i]['event_name'.$this->langtype]));?>
					</div>
					<div style="float:left;width: 100%;margin-top:5px;">
						<?php 
							$sql = "
								SELECT a.* 
		
								, b.category_name_en AS subcategory_name_en, b.category_name_ch AS subcategory_name_ch
		
								FROM ".DB_PRE()."event_category AS a 
		
								LEFT JOIN ".DB_PRE()."system_event_category AS b ON a.subcategory_id = b.category_id
		
								WHERE a.event_id = ".$eventlist[$i]['event_id']."
		
							";
							$checkres = $this->db->query($sql)->result_array();
							if(!empty($checkres)){
								for ($ccc = 0; $ccc < count($checkres); $ccc++) {
									echo '<div style="float:left;line-height:24px;font-weight:bold;padding:0px 10px;border-radius:4px;margin-top:5px;margin-right:5px;background:#EFEFEF;color:gray;">'.$checkres[$ccc]['subcategory_name'.$this->langtype].'</div>';
								}
							}
						?>
					</div>
				</td>
				<td align="center"><?php echo date("Y-m-d",$eventlist[$i]['datepicker']);?></td>
				<!--
				<td>
					<div style="float:left;width: 100%;<?php if($eventlist[$i]['event_price_regular'] == 0){echo 'color:#CCC;';}?>">
						<?php echo '&yen;'.number_format($eventlist[$i]['event_price_regular'], 2, ".", ",");?>
					</div>
				</td>
				-->
				<td align="center"><?php echo date('Y-m-d', $eventlist[$i]['created']).'<br />'.date('H:i:s', $eventlist[$i]['created'])?></td>
				<td align="center"><?php echo $eventlist[$i]['edited_author']?></td>
				<td align="center">
					<?php 
						if($eventlist[$i]['status'] == 1){
							echo lang('cy_online');
						}else{
							echo lang('cy_offline');
						}
					
					?>
				</td>
				<td align="center">
					<div style="float:right;">
						<?php 
							$con = array('event_id'=>$eventlist[$i]['event_id']);
							$count_pic = $this->ProductModel->getpicturelist($con, 1);
							if($count_pic > 0){
								$text = lang('cy_picture_manage').' '.'<font class="fonterror">('.$count_pic.')</font>';
							}else{
								$text = lang('cy_picture_manage');
							}
// 							echo '<a href="'.base_url().'index.php/admins/event/picturelist/'.$eventlist[$i]['event_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.$text.'</a>';
						
							echo '<a href="'.base_url().'index.php/admins/event/toedit_event/'.$eventlist[$i]['event_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
								
							echo '<a onclick="todel_event('.$eventlist[$i]['event_id'].', \''.$eventlist[$i]['event_name'.$this->langtype].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
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
<script type="text/javascript">
//删除新闻
function todel_event(id, name){
	var title = '您确定要删除<font style="color:red;">【'+name+'】</font>吗？';
	var subtitle = '';
	del_url = encodeURI(baseurl+"index.php/admins/event/del_event/"+id);
	todel(title, subtitle);
}
</script>
<?php $this->load->view('admin/footer')?>