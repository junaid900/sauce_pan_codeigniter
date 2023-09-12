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

<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/partner/index'?>" method="get">
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
				<a href="<?php echo base_url().'index.php/admins/partner/toadd_partner'?>">
					<font class="nav_on">
						<font class="plus">
							<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
							<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
						</font>
						<span><?php if($this->langtype == '_ch'){echo '添加合作伙伴';}else{echo 'Add event';}?></span>
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
			<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '合作伙伴名称';}else{echo 'News name';}?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_author')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_status')?></p></td>
			<td width="200" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
</table>
<ul id="tasks" style="float:left;width:100%;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;">
	<?php if(isset($partnerlist)){for ($i = 0; $i < count($partnerlist); $i++) {?>
		<li class="articlelist" id="<?php echo $partnerlist[$i]['partner_id']?>" iid="<?php echo $i+1?>" style="width:100%;padding:0px;margin:0px;list-style-type: none;">
			<table class="gksel_normal_tablist" style="margin-top: 0px;">
				<tbody>
					<tr style="<?php if($partnerlist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
						<td width="50" align="center" style="padding-left:0px;padding-right:0px;"><?php echo ($i+1)?></td>
						<td width="100" align="center">
							<?php if($partnerlist[$i]['partner_pic']!=""){?>
								<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().$partnerlist[$i]['partner_pic_100']?>"/>
							<?php }else{?>
								<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().'themes/default/images/none_partner.png'?>"/>
							<?php }?>
						</td>
						<td style="padding-left:0px;padding-right:0px;">
							<div style="float:left;width: 100%;">
								<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($partnerlist[$i]['partner_name'.$this->langtype]));?>
							</div>
						</td>
						<td style="padding-left:0px;padding-right:0px;" width="100" align="center"><?php echo date('Y-m-d', $partnerlist[$i]['created']).'<br />'.date('H:i:s', $partnerlist[$i]['created'])?></td>
						<td style="padding-left:0px;padding-right:0px;" width="100" align="center"><?php echo $partnerlist[$i]['edited_author']?></td>
						<td style="padding-left:0px;padding-right:0px;" width="100" align="center">
							<?php 
								if($partnerlist[$i]['status'] == 1){
									echo lang('cy_online');
								}else{
									echo lang('cy_offline');
								}
							
							?>
						</td>
						<td style="padding-left:0px;padding-right:0px;" width="200" align="center">
							<div style="float:right;">
								<?php 
									$con = array('partner_id'=>$partnerlist[$i]['partner_id']);
									$count_pic = $this->ProductModel->getpicturelist($con, 1);
									if($count_pic > 0){
										$text = lang('cy_picture_manage').' '.'<font class="fonterror">('.$count_pic.')</font>';
									}else{
										$text = lang('cy_picture_manage');
									}
		// 							echo '<a href="'.base_url().'index.php/admins/partner/picturelist/'.$partnerlist[$i]['partner_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.$text.'</a>';
								
									echo '<a href="'.base_url().'index.php/admins/partner/toedit_partner/'.$partnerlist[$i]['partner_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
										
									echo '<a onclick="todel_partner('.$partnerlist[$i]['partner_id'].', \''.$partnerlist[$i]['partner_name'.$this->langtype].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
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
				$.post(baseurl+'index.php/admins/partner/editpartner_sort',{idarr:idarr,newsrot:newsrot},function (data){
					
				})
			},
			scroll: true,
		});
		
	})
</script>


<script type="text/javascript">
//删除合作伙伴
function todel_partner(id, name){
	var title = '您确定要删除合作伙伴<font style="color:red;">【'+name+'】</font>吗？';
	var subtitle = '';
	del_url = encodeURI(baseurl+"index.php/admins/partner/del_partner/"+id);
	todel(title, subtitle);
}
</script>
<?php $this->load->view('admin/footer')?>