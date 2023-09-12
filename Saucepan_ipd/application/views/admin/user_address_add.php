<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_user.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr><td colspan="2"></td></tr>
		<tr>
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></td>
			<td align="left">
				<input type="text" name="address_realname" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr style="display: none;">
			<td align="right" width="150"><?php echo lang('dz_user_firstname')?></td>
			<td align="left">
				<input type="text" name="address_firstname" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr style="display: none;">
			<td align="right" width="150"><?php echo lang('dz_user_lastname')?></td>
			<td align="left">
				<input type="text" name="address_lastname" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php echo lang('dz_user_phone')?></td>
			<td align="left">
				<input type="text" name="address_phone" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr style="display: none;">
			<td align="right" width="150"><?php echo lang('dz_user_email')?></td>
			<td align="left">
				<input type="text" name="address_email" value=""/>
				<div class="tipsgroupbox"></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '地址 1';}else{echo 'Address 1';}?></td>
			<td align="left">
				<select id="provinceID" name="provinceID" style="display:none;">
					<option value="0"><?php if($this->langtype == '_ch'){echo '选择省份';}else{echo 'Select Province';}?></option>
					<?php 
						$province = $this->UserModel->getprovince();
						if(!empty($province)){
							for($i=0;$i<count($province);$i++){
									$isselected = '';
								echo '<option value="'.$province[$i]['provinceID'].'" '.$isselected.'>'.$province[$i]['province'.$this->langtype].'</option>';
							}
						}
					?>
				</select>
				<div class="tipsgroupbox" style="display:none;"><div class="request">*</div></div>
				<select id="cityID" name="cityID" style="display:none;">
					<option value=0><?php if($this->langtype == '_ch'){echo '选择城市';}else{echo 'Select City';}?></option>
					<?php 
							$city = $this->UserModel->getcity($addressinfo['address_province_id']);
							if(!empty($city)){
								for($i=0;$i<count($city);$i++){
										$isselected = '';
									echo '<option value="'.$city[$i]['cityID'].'" '.$isselected.'>'.$city[$i]['city'.$this->langtype].'</option>';
								}
							}
					?>
				</select>
				<div class="tipsgroupbox" style="display:none;"><div class="request">*</div></div>
				<select id="areaID" name="areaID" style="display:none;">
					<option value=0><?php if($this->langtype == '_ch'){echo '选择区域';}else{echo 'Select Area';}?></option>
					<?php 
							$area = $this->UserModel->getarea($addressinfo['address_city_id']);
							if(!empty($area)){
								for($i=0;$i<count($area);$i++){
										$isselected = '';
									echo '<option value="'.$area[$i]['areaID'].'" '.$isselected.'>'.$area[$i]['area'.$this->langtype].'</option>';
								}
							}
					?>
				</select>
				<div class="tipsgroupbox" style="display:none;"><div class="request">*&nbsp;&nbsp;</div></div>
				<input type="text" name="address_street_address" style="width:400px;" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php echo lang('dz_user_zipcode')?></td>
			<td align="left">
				<input type="text" name="address_zip_code" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="toadd_useraddressinfo(<?php echo $userinfo['uid']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>

<?php $this->load->view('admin/footer')?>