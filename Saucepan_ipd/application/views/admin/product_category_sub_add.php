<?php $this->load->view('admin/header')?><script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_product.js?date=<?php echo CACHE_USETIME()?>'></script><?php $lancodelist = getlancodelist();?><form method="post">	<table class="gksel_normal_tabpost">		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>			<tr>				<td align="right" width="150"><?php echo lang('dz_product_category_name')?> <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>				<td align="left">					<input type="text" name="category_name<?php echo $lancodelist[$lc]['langtype']?>" style="width:300px;" value=""/>					<div class="tipsgroupbox"><div class="request">*</div></div>				</td>			</tr>		<?php }?>		<tr>			<td>				<input name="backurl" type="hidden" value="<?php echo $backurl?>"/>				<input name="subbackurl" type="hidden" value="<?php echo $subbackurl?>"/>			</td>			<td align="left">				<div class="gksel_btn_action_on" onclick="toadd_productsubcategoryinfo(<?php echo $parent;?>)"><?php echo lang('cy_save')?></div>			</td>		</tr>	</table></form><?php $this->load->view('admin/footer')?>