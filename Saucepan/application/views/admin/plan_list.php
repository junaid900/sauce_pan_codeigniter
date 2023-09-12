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
//删除套餐
function todel_plan(plan_id){
	var title = '您确定要删除该品牌吗?';
	var subtitle = '';
	del_url = encodeURI(baseurl+"index.php/admins/plan/delplan/"+plan_id);
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
				<a href="<?php echo base_url().'index.php/admins/plan/toplanadd';?>"><font class="nav_on"><img class="plus" src="<?php echo base_url().'themes/default/images/plus.png'?>"/> <?php if($this->langtype == "_ch"){echo "添加套餐";}else{echo "Add Step";}?></font></a>
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
			<td align="left"><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '套餐名称';}else{echo 'Plan Name';}?></p></td>
			<td align="center"><p>General price</p></td>
			<td align="center"><p>Vegetarian price</p></td>
			<td align="center"><p>Pescatarian price</p></td>
			<!--
			<td align="center"><p><?php if($this->langtype == '_ch'){echo '创建时间';}else{echo 'Created Time';}?></p></td>
			-->
			<td width="120" align="center"><p><?php echo lang('cy_time_lastedited')?></p></td>
			<td width="160" align="center"><p><?php echo lang('cy_actions')?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($planlist)){for ($i = 0; $i < count($planlist); $i++) {?>
			<tr style="<?php if($planlist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
				<td align="center"><?php echo $i+1?></td>
				<td align="center">
					<?php if($planlist[$i]['plan_logo']!=""){?>
						<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().$planlist[$i]['plan_logo']?>"/>
					<?php }else{?>
						<img style="max-width:70px;max-height: 70px;" src="<?php echo CDN_URL().'themes/default/images/none_product.png'?>"/>
					<?php }?>
				</td>
				<td align="left">
					<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($planlist[$i]["plan_name".$this->langtype]));?>
				</td>
				<td align="center">
					<?php 
						if($planlist[$i]['plan_id'] == 1){
							echo 'Lunch only: &yen;'.$planlist[$i]['plan_price_lunch_163'];
							echo '<br />Dinner only: &yen;'.$planlist[$i]['plan_price_dinner_163'];
							echo '<br />Lunch and dinner: &yen;'.$planlist[$i]['plan_price_unit_163'];
						}else{
							echo '&yen;'.$planlist[$i]['plan_price_unit_163'];
						}
					?>
				</td>
				<td align="center">
					<?php 
						if($planlist[$i]['plan_id'] == 1){
							echo 'Lunch only: &yen;'.$planlist[$i]['plan_price_lunch_164'];
							echo '<br />Dinner only: &yen;'.$planlist[$i]['plan_price_dinner_164'];
							echo '<br />Lunch and dinner: &yen;'.$planlist[$i]['plan_price_unit_164'];
						}else{
							echo '&yen;'.$planlist[$i]['plan_price_unit_164'];
						}
					?>
				</td>
				<td align="center">
					<?php 
						if($planlist[$i]['plan_id'] == 1){
							echo 'Lunch only: &yen;'.$planlist[$i]['plan_price_lunch_165'];
							echo '<br />Dinner only: &yen;'.$planlist[$i]['plan_price_dinner_165'];
							echo '<br />Lunch and dinner: &yen;'.$planlist[$i]['plan_price_unit_165'];
						}else{
							echo '&yen;'.$planlist[$i]['plan_price_unit_165'];
						}
					?>
				</td>
				<!--
				<td align="center"><?php echo date('Y-m-d', $planlist[$i]['created']).'<br />'.date('H:i:s', $planlist[$i]['created'])?></td>
				-->
				<td align="center"><?php echo date('Y-m-d', $planlist[$i]['edited']).'<br />'.date('H:i:s', $planlist[$i]['edited'])?></td>
				<td align="center">
					<div style="float:right;">
						<?php 
							echo '<a href="'.base_url().'index.php/admins/plan/toedit_plan/'.$planlist[$i]['plan_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
						?>
						<!-- 
						<?php 
							$con = array('plan_id'=>$planlist[$i]['plan_id']);
							$count = $this->ProductModel->getproductlist($con, 1);
						?>
						<?php if($count > 0){?>
							<div title="该品牌有<?php echo $count?>个产品, 不能删除" class="gksel_btn_action_off">
								<label><?php if($this->langtype == '_ch'){echo '删除';}else{echo 'Delete';}?></label>
							</div>
						<?php }else{?>
							<div onclick="todel_plan(<?php echo $planlist[$i]["plan_id"]?>)" class="gksel_btn_action_on">
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