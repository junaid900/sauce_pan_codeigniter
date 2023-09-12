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

$user_type = $this->input->get('user_type');
$keyword = $this->input->get('keyword');
if($this->langtype == '_ch'){
	$text_view_order = '查看订单';
}else{
	$text_view_order = 'View Orders';
}
?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_user.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'index.php/admins/user/index'?>" method="get">
					<select name="user_type" class="select_usertype displaynone">
						<option value=""><?php echo lang('cy_all')?></option>
						<option value="1" <?php if($user_type != '' && $user_type == 1){echo 'selected';}?>>客户</option>
						<option value="2" <?php if($user_type != '' && $user_type == 2){echo 'selected';}?>>供应商</option>
					</select>
					<input type="text" name="keyword" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
					<input type="submit" value="<?php echo lang('cy_search')?>"/>
				</form>
			</div>
		</td>
	</tr>
</table>
<!-- 
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<a href="<?php echo base_url().'index.php/admins/user/toadd_user/'.$user_type.'?backurl='.$current_url_encode?>">
					<font class="nav_on">
						<font class="plus">
							<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
							<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
						</font>
						<span><?php if($user_type == 1){echo lang('dz_user_add');}else if($user_type == 2){echo lang('dz_company_business_add');}else if($user_type == 3){echo lang('dz_user_contentproviders_add');}?></span>
					</font>
				</a>
				
				<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/user/index?user_type='.$user_type.'&keyword='.$keyword.'&is_excel=1'?>';" style="float: left;margin-top:7px;cursor:pointer;">
					<div style="float: left;margin-left:5px;">
						<img src="<?php echo base_url().'themes/default/images/icon_xls.gif'?>"/>
					</div>
					<div style="float: left;margin-left:5px;">
						<?php if($this->langtype == '_ch'){echo '导出表格';}else{echo 'Export Excel';}?>
					</div>
				</div>
				
			</div>
		</td>
	</tr>
</table>
 -->
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_username')?></p></td>
			<td width="165"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_contact')?></p></td>
			<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '用户积分';}else{echo 'SP Points';}?></p></td>
			<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo 'REVO余额';}else{echo 'REVO credit';}?></p></td>
			<td width="130" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="380" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($userlist)){for ($i = 0; $i < count($userlist); $i++) {?>
			<tr>
				<td align="center"><?php echo $i+1?></td>
				<td>
					<div style="float:left;width: 100%;">
						<div style="float:left;width: 23px;">
							<?php if($userlist[$i]['wechat_avatar'] != ''){?>
								<img style="float:left;width:18px;height:18px;" src="<?php echo urlHttpToHttps($userlist[$i]['wechat_avatar'])?>">
							<?php }else{?>
								<img style="float:left;width:18px;height:18px;" src="<?php echo base_url().'themes/default/images/none.jpg'?>">
							<?php }?>
						</div>
						<div style="float:left;width: calc(100% - 23px);line-height:18px;">
							<?php echo '<span style="color:#999;">'.actionsearchdaxiaoxiezimu($keyword, userTextDecode($userlist[$i]['wechat_nickname'])).'</span>';?>
							<?php echo '&nbsp;&nbsp;'.actionsearchdaxiaoxiezimu($keyword, strip_tags($userlist[$i]['user_firstname'].' '.$userlist[$i]['user_lastname']));?>
						</div>
					</div>
				</td>
				<td>
					<?php if($userlist[$i]['user_phone'] != ''){?>
						<div style="float:left;width:100%;"><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($userlist[$i]['user_phone']));?></div>
					<?php }?>
					<?php if($userlist[$i]['user_email'] != ''){?>
						<div style="float:left;width:100%;margin-top:5px;"><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($userlist[$i]['user_email']));?></div>
					<?php }?>
					<?php if($userlist[$i]['user_company_name'] != ''){?>
						<div style="float:left;width:100%;margin-top:5px;"><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($userlist[$i]['user_company_name']));?></div>
					<?php }?>
				</td>
				<td align="center">
					<?php 
						$alink = base_url().'index.php/admins/user/pointer_list/'.$userlist[$i]['uid'].'?backurl='.$current_url_encode;
						echo '<a href="'.$alink.'">'.$userlist[$i]['totalpoint'].'</a>';
					?>
				</td>
				<td align="center">
					<?php 
						echo 0;
					?>
				</td>
				<td align="center">
					<?php 
						if($userlist[$i]['edited'] == 0){
							echo date('Y-m-d', $userlist[$i]['created']).'<br />'.date('H:i:s', $userlist[$i]['created']);
						}else{
							echo date('Y-m-d', $userlist[$i]['edited']).'<br />'.date('H:i:s', $userlist[$i]['edited']);
						}
					?>
				</td>
				<td align="center">
					<div style="float:right;">
						<?php 
								$con = array('other_con'=>' o.status NOT IN (0)', 'uid'=>$userlist[$i]['uid'], 'orderby'=>'o.order_id', 'orderby_res'=>'DESC');
								$count = $this->OrderModel->getorderlist($con, 1);
								if($count > 0){
									$text_class = 'gksel_btn_action_on';
									$text = '<span style="color:black;">('.$count.')</span>';
									
									$alt_text = '';
								}else{
									$text_class = 'gksel_btn_action_off';
									$text = '';
									
									$alt_text = '当前没有订单';
								}
								$url = base_url().'index.php/admins/order/index?status=all&uid='.$userlist[$i]['uid'];
								
								echo '<a title="'.$alt_text.'" alt="'.$alt_text.'" href="'.$url.'" class="'.$text_class.'">'.$text_view_order.' '.$text.'</a>';
						
								$con = array('isdel_status'=>0, 'uid'=>$userlist[$i]['uid'], 'orderby'=>'address_id', 'orderby_res'=>'DESC');
								$count_address = $this->UserModel->getaddresslist($con, 1);
								
								$con = array('isdel_status'=>1, 'uid'=>$userlist[$i]['uid'], 'orderby'=>'address_id', 'orderby_res'=>'DESC');
								$count_deleted = $this->UserModel->getaddresslist($con, 1);
								
								
								if($count_address + $count_deleted > 0){
									$class = 'gksel_btn_action_on';
									$alink = base_url().'index.php/admins/user/address_list/'.$userlist[$i]['uid'].'?backurl='.$current_url_encode;
									$text = lang('dz_user_address_manage').' <font style="color:green;font-weight:bold;">('.$count_address.')</font> <font style="color:#000;font-weight:bold;">+</font> <font style="color:orange;font-weight:bold;">('.$count_deleted.')</font>';
								}else{
									$class = 'gksel_btn_action_off';
									$alink = base_url().'index.php/admins/user/address_list/'.$userlist[$i]['uid'].'?backurl='.$current_url_encode;
									$text = lang('dz_user_address_manage');
								}
								echo '<a href="'.$alink.'" class="'.$class.'">'.$text.'</a>';
								
								echo '<a href="'.base_url().'index.php/admins/user/toedit_user/'.$userlist[$i]['user_type'].'/'.$userlist[$i]['uid'].'?backurl='.$current_url_encode.'"><img style="float:left;margin-right:15px;" src="'.base_url().'themes/default/images/icon_edit.gif"/></a>';
								
								if($count == 0 && $count_address == 0 && $count_deleted == 0){
									echo '<a onclick="todel_user('.$userlist[$i]['uid'].', \''.$userlist[$i]['user_phone'].'\')" href="javascript:;"><img style="float:left;margin-right:15px;" src="'.base_url().'themes/default/images/icon_del.gif"/></a>';
								}
								
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
	<?php if(isset($fy)){?>
		<thead>
			<tr>
				<td colspan="7"><?php echo $fy?></td>
			</tr>
		</thead>
	<?php }?>
</table>
<?php $this->load->view('admin/footer')?>