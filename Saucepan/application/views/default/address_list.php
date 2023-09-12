<?php $this->load->view('default/home_header')?>
<div style="width: calc(100% - 30px);padding:0 15px;float:left;font-size: 15px;margin-top:90px;margin-bottom:25px;">
	<?php if($this->langtype=='_ch'){echo "添加新地址";}else{echo "Add New Address";}?>
</div>

<div class="address_title">
	<?php if($this->langtype=='_ch'){echo "地址类型";}else{echo "Address Type";}?>
</div>
<div class="address_input">
	<select>
		<option>Home 家</option>
	</select>
</div>
<div class="address_title">
	<?php if($this->langtype=='_ch'){echo "地址";}else{echo "Address";}?>
</div>
<div class="address_input">
	<input type="text" />
</div>
<div class="address_title">
	<?php if($this->langtype=='_ch'){echo "街道";}else{echo "Nearest Cross Street";}?>
</div>
<div class="address_input">
	<input type="text" />
</div>
<div class="address_title">
	<?php if($this->langtype=='_ch'){echo "地址注释";}else{echo "Address Notes";}?>
</div>
<div class="address_input">
	<input type="text" />
</div>

<div class="address_save_btn">
	<?php if($this->langtype=='_ch'){echo "保存";}else{echo "SAVE";}?>
</div>
<?php $this->load->view('default/home_footer')?>