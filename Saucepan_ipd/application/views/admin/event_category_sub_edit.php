<?php $this->load->view('admin/header')?>
    <script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
    <script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_event.js?date=<?php echo CACHE_USETIME()?>'></script>
<?php $lancodelist = getlancodelist();?>
<form method="post">
	<table class="gksel_normal_tabpost">
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '标签名称';}else{echo 'Label Name';}?> <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
				<td align="left">
					<input type="text" name="category_name<?php echo $lancodelist[$lc]['langtype']?>" style="width:300px;" value="<?php echo $categoryinfo['category_name'.$lancodelist[$lc]['langtype']]?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '广告语';}else{echo 'Tagline';}?> <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
				<td align="left">
					<textarea name="category_tagline<?php echo $lancodelist[$lc]['langtype']?>" style="width:600px;height:60px;"><?php echo $categoryinfo['category_tagline'.$lancodelist[$lc]['langtype']]?></textarea>
					<div class="tipsgroupbox"><div class="request"></div></div>
				</td>
			</tr>
		<?php }?>
		<tr>
			<td align="right" width="150"><?php echo lang('cy_status')?></td>
			<td align="left">
				<input name="status" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" <?php if($categoryinfo['status'] == 1){echo 'checked';}?>/>
			</td>
		</tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
				<input name="subbackurl" type="hidden" value="<?php echo $subbackurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_eventsubcategoryinfo(<?php echo $parent?>, <?php echo $categoryinfo['category_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<?php $this->load->view('admin/footer')?>