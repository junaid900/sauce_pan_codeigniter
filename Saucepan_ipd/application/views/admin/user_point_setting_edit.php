<?php $this->load->view('admin/header')?>
<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_user.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost">
			<tr>
				<td align="right" width="150">
					<?php 
					if($pointsetting_id == 1){
						if($this->langtype == '_ch'){
							echo '用户购买获取的积分';
						}else{
							echo 'Points earned';
						}
					}else if($pointsetting_id == 2){
						echo '被分享的用户加入的用户返回给分享者积分（可重复）';
					}else if($pointsetting_id == 3){
						echo '积分可以抵扣钱的设置';
					}
					?>
				</td>
				<td align="left">
					<?php if($pointsetting_id == 1){?>
						<div style="float:left;margin-right:5px;margin-top:4px;">100 元 = </div>
						<input type="text" name="pointsetting_value" style="width:40px" value="<?php echo $pointsetting_value * 100?>"/> 
						<div class="tipsgroupbox"><div class="request">*</div></div>
						<div style="float:left;margin-left:5px;margin-top:4px;"><?php if($this->langtype == '_ch'){echo '积分';}else{echo 'Points';}?></div>
					<?php }else if($pointsetting_id == 2){?>
						<div style="float:left;margin-right:5px;margin-top:4px;">100 元 = </div>
						<input type="text" name="pointsetting_value" style="width:40px" value="<?php echo $pointsetting_value * 100?>"/> 
						<div class="tipsgroupbox"><div class="request">*</div></div>
						<div style="float:left;margin-left:5px;margin-top:4px;"><?php if($this->langtype == '_ch'){echo '积分';}else{echo 'Points';}?></div>
					<?php }else if($pointsetting_id == 3){?>
						<div style="float:left;margin-right:5px;margin-top:4px;">100 <?php if($this->langtype == '_ch'){echo '积分';}else{echo 'Points';}?> = </div>
						<input type="text" name="pointsetting_value" style="width:40px" value="<?php echo $pointsetting_value * 100?>"/> 
						<div class="tipsgroupbox"><div class="request">*</div></div>
						<div style="float:left;margin-left:5px;margin-top:4px;">元</div>
					<?php }?>
					
				</td>
			</tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_userpointsetting(<?php echo $pointsetting_id?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<?php $this->load->view('admin/footer')?>