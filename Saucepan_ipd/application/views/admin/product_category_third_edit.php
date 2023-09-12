<?php $this->load->view('admin/header')?>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_product.js?date=<?php echo CACHE_USETIME()?>'></script>
<?php $lancodelist = getlancodelist();?>
<form method="post">
	<table class="gksel_normal_tabpost">
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_product_category_name')?> <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
				<td align="left">
					<input type="text" name="category_name<?php echo $lancodelist[$lc]['langtype']?>" style="width:300px;" value="<?php echo $categoryinfo['category_name'.$lancodelist[$lc]['langtype']]?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
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
				<input name="thirdbackurl" type="hidden" value="<?php echo $thirdbackurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_productthirdcategoryinfo(<?php echo $parent?>, <?php echo $second_id?>, <?php echo $categoryinfo['category_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<?php $this->load->view('admin/footer')?>