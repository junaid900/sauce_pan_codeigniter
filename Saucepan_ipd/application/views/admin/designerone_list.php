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

$parentcategory_id = $this->input->get('parentcategory_id');
$subcategory_id = $this->input->get('subcategory_id');
$thirdcategory_id = $this->input->get('thirdcategory_id');

$keyword = $this->input->get('keyword');
?>
<script>
	function tochooseparentcategory_id(category_id){
		$.post(baseurl+'index.php/admins/designerone/togetsubcategory_select/'+category_id, function (data){
			var obj = eval( "(" + data + ")" );
			$('.subcategory_area').html('<option value="0"><?php if($this->langtype == '_ch'){echo '选择子分类';}else{echo 'Select subcategory';}?></option>'+obj.item);
		})
	}

	function tochoosesubcategory_id(subcategory_id){
		$.post(baseurl+'index.php/admins/designerone/togetthirdcategory_select/'+subcategory_id, function (data){
			var obj = eval( "(" + data + ")" );
			$('.thirdcategory_area').html('<option value="0">-</option>'+obj.item);
		})
	}
	
	function tochoosecategory_id(category_id){
		if(category_id == 16 || category_id == 40){
			$('.otherdesigneroneshuxing').show();
		}else{
			$('.otherdesigneroneshuxing').hide();
		}
	}
</script>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<a href="<?php echo base_url().'index.php/admins/designerone/toadd_designerone?backurl='.$current_url_encode?>"><font class="nav_on"><img class="plus" src="<?php echo base_url().'themes/default/images/plus.png'?>"/> <?php if($this->langtype == '_ch'){echo '添加团队成员';}else{echo 'Add Team';}?></font></a>
			</div>
		</td>
	</tr>
</table>
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_picture')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_author')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_status')?></p></td>
			<td width="200" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
</table>
<ul id="tasks" style="float:left;width:100%;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;">
	<?php if(isset($designeronelist)){for ($i = 0; $i < count($designeronelist); $i++) {?>
		<li class="articlelist" id="<?php echo $designeronelist[$i]['designerone_id']?>" iid="<?php echo $i+1?>" style="width:100%;padding:0px;margin:0px;list-style-type: none;">
			<table class="gksel_normal_tablist" style="margin-top: 0px;">
				<tbody>
					<tr style="<?php if($designeronelist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
						<td style="padding-left:0px;padding-right:0px;" width="50" align="center"><?php echo ($i+1)?></td>
						<td width="100" align="center">
							<?php if($designeronelist[$i]['designerone_pic']!=""){?>
								<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().$designeronelist[$i]['designerone_pic_100']?>"/>
							<?php }else{?>
								
							<?php }?>
						</td>
						<td style="padding-left:0px;padding-right:0px;">
							<div style="float:left;width: 100%;">
								<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($designeronelist[$i]['designerone_name'.$this->langtype]));?>
							</div>
							<?php if($designeronelist[$i]['designerone_position'.$this->langtype] != ''){?>
								<div style="float:left;width: 100%;margin-top:5px;color:#999;">
									<?php echo $designeronelist[$i]['designerone_position'.$this->langtype];?>
								</div>
							<?php }?>
						</td>
						<td style="padding-left:0px;padding-right:0px;" width="100" align="center"><?php echo date('Y-m-d', $designeronelist[$i]['edited']).'<br />'.date('H:i:s', $designeronelist[$i]['edited'])?></td>
						<td style="padding-left:0px;padding-right:0px;" width="100" align="center"><?php echo $designeronelist[$i]['edited_author']?></td>
						<td style="padding-left:0px;padding-right:0px;" width="100" align="center">
							<?php 
								if($designeronelist[$i]['status'] == 1){
									echo lang('cy_online');
								}else{
									echo lang('cy_offline');
								}
							
							?>
						</td>
						<td style="padding-left:0px;padding-right:0px;" width="200" align="center">
							<div style="float:right;">
								<?php 
									echo '<a href="'.base_url().'index.php/admins/designerone/toedit_designerone/'.$designeronelist[$i]['designerone_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
								
									echo '<a onclick="todel_designerone('.$designeronelist[$i]['designerone_id'].', \''.$designeronelist[$i]['designerone_name'.$this->langtype].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
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
				var newsrot=[];
				var idarr=[];
				var i=0;
				$('.articlelist').each(function (){
					i++;
					newsrot.push(i);
					idarr.push($(this).attr('id'));
				})
				$.post(baseurl+'index.php/admins/designerone/editdesignerone_sort',{idarr:idarr,newsrot:newsrot},function (data){
					
				})
			},
			scroll: true,
		});
		
	})
</script>

<script type="text/javascript">
//删除设计师
function todel_designerone(id, name){
	var title = '您确定要删除设计师<font style="color:red;">【'+name+'】</font>吗？';
	var subtitle = '';
	del_url = encodeURI(baseurl+"index.php/admins/designerone/del_designerone/"+id);
	todel(title, subtitle);
}
</script>
<?php $this->load->view('admin/footer')?>