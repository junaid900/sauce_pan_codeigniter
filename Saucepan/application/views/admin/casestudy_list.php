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
				<form action = "<?php echo base_url().'index.php/admins/casestudy/index'?>" method="get">
					<input type="text" name="keyword" placeholder="请输入关键字" value="<?php echo $keyword?>"/>
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
				<a href="<?php echo base_url().'index.php/admins/casestudy/toadd_casestudy';?>"><font class="nav_on"><img class="plus" src="<?php echo base_url().'themes/default/images/plus.png'?>"/> <?php if($this->langtype == "_ch"){echo "添加案例";}else{echo "Add Step";}?></font></a>
			</div>
		</td>
	</tr>
</table>

<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td align="center"><p style="border-left:0px;"><?php if($this->langtype == '_ch'){echo '序号';}else{echo 'S/N';}?></p></td>
			<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '图片';}else{echo 'Picture';}?></p></td>
			<td align="left"><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '案例名称';}else{echo 'Casestudy Name';}?></p></td>
			<td width="200" align="center"><p><?php if($this->langtype == '_ch'){echo '服务内容';}else{echo 'Scope';}?></p></td>
            <td width="120" align="center"><p><?php if($this->langtype == '_ch'){echo '网址';}else{echo 'URL';}?></p></td>
            <td align="center"><p><?php if($this->langtype == '_ch'){echo '修改时间';}else{echo 'Edit Time';}?></p></td>
			<td width="160" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($casestudylist)){for ($i = 0; $i < count($casestudylist); $i++) {?>
			<tr style="<?php if($casestudylist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
				<td align="center"><?php echo $i+1?></td>
				<td align="center">
					<?php if($casestudylist[$i]['casestudy_pic']!=""){?>
						<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().$casestudylist[$i]['casestudy_pic']?>"/>
					<?php }?>
				</td>
				<td align="left">
					<?php echo actionsearchdaxiaoxiezimu($keyword, $casestudylist[$i]["casestudy_name".$this->langtype]);?>
				</td>
				<td align="center">
					<?php echo actionsearchdaxiaoxiezimu($keyword, $casestudylist[$i]["casestudy_tagline".$this->langtype]);?>
				</td>
				<td align="center">
					<?php echo actionsearchdaxiaoxiezimu($keyword, $casestudylist[$i]["casestudy_href"]);?>
				</td>
				<td align="center"><?php echo date('Y-m-d', $casestudylist[$i]['edited']).'<br />'.date('H:i:s', $casestudylist[$i]['edited'])?></td>
				<td align="center">
					<div style="float:right;">
						<?php 
							echo '<a href="'.base_url().'index.php/admins/casestudy/toedit_casestudy/'.$casestudylist[$i]['casestudy_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
						?>
						<div onclick="todel_casestudy(<?php echo $casestudylist[$i]["casestudy_id"]?>)" class="gksel_btn_action_on">
							<label><?php if($this->langtype == '_ch'){echo '删除';}else{echo 'Delete';}?></label>
						</div>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
	<?php if(isset($fy)){?>
		<thead>
			<tr>
				<td colspan="8"><?php echo $fy?></td>
			</tr>
		</thead>
	<?php }?>
</table>
<script type="text/javascript">
//删除案例
function todel_casestudy(casestudy_id){
	var title = '您确定要删除该案例吗?';
	var subtitle = '';
	del_url = encodeURI(baseurl+"index.php/admins/casestudy/delcasestudy/"+casestudy_id);
	todel(title, subtitle);
}
</script>
<?php $this->load->view('admin/footer')?>