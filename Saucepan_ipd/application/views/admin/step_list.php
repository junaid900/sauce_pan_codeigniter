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

$product_type = $this->input->get('product_type');
$keyword = $this->input->get('keyword');
?>

<script type="text/javascript">
//删除步骤
function todel_step(step_id){
	var title = '您确定要删除该品牌吗?';
	var subtitle = '';
	del_url = encodeURI(baseurl+"index.php/admins/step/delstep/"+step_id);
	todel(title, subtitle);
}
</script>
<!-- 
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div class="searcharea">
				<form action = "" method="get">
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
				<a href="<?php echo base_url().'index.php/admins/step/tostepadd';?>"><font class="nav_on"><img class="plus" src="<?php echo base_url().'themes/default/images/plus.png'?>"/> <?php if($this->langtype == "_ch"){echo "添加步骤";}else{echo "Add Step";}?></font></a>
			</div>
		</td>
	</tr>
</table>
 -->
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td align="center"><p style="border-left:0px;"><?php echo lang('cy_sn')?></p></td>
			<td width="100" align="center"><p><?php echo lang('cy_picture')?></p></td>
			<td align="left"><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '步骤名称';}else{echo 'Step Name';}?></p></td>
			<td align="center"><p><?php echo lang('cy_status')?></p></td>
			<!--
			<td align="center"><p><?php if($this->langtype == '_ch'){echo '创建时间';}else{echo 'Created Time';}?></p></td>
			<td align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			-->
			<td width="160" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($steplist)){for ($i = 0; $i < count($steplist); $i++) {?>
			<tr style="<?php if($steplist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
				<td align="center"><?php echo $i+1?></td>
				<td align="center">
					<?php if($steplist[$i]['step_logo']!=""){?>
						<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().$steplist[$i]['step_logo']?>"/>
					<?php }else{?>
						<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().'themes/default/images/none_product.png'?>"/>
					<?php }?>
				</td>
				<td align="left">
					<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($steplist[$i]["step_name".$this->langtype]));?>
				</td>
				<td align="center"><?php 
								if($steplist[$i]['status'] == 1){
									echo lang('cy_online');
								}else{
									echo lang('cy_offline');
								}
							
							?></td>
				<!--
				<td align="center"><?php echo date('Y-m-d', $steplist[$i]['created']).'<br />'.date('H:i:s', $steplist[$i]['created'])?></td>
				<td align="center"><?php echo date('Y-m-d', $steplist[$i]['edited']).'<br />'.date('H:i:s', $steplist[$i]['edited'])?></td>
				-->
				<td align="center">
					<div style="float:right;">
						<?php 
							echo '<a href="'.base_url().'index.php/admins/step/toedit_step/'.$steplist[$i]['step_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
						?>
						<!-- 
						<?php 
							$con = array('step_id'=>$steplist[$i]['step_id']);
							$count = $this->ProductModel->getproductlist($con, 1);
						?>
						<?php if($count > 0){?>
							<div title="该品牌有<?php echo $count?>个产品, 不能删除" class="gksel_btn_action_off">
								<label><?php if($this->langtype == '_ch'){echo '删除';}else{echo 'Delete';}?></label>
							</div>
						<?php }else{?>
							<div onclick="todel_step(<?php echo $steplist[$i]["step_id"]?>)" class="gksel_btn_action_on">
								<label><?php if($this->langtype == '_ch'){echo '删除';}else{echo 'Delete';}?></label>
							</div>
						<?php }?>
						 -->
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

<?php $this->load->view('admin/footer')?>