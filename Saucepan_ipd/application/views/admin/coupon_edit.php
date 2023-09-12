<?php $this->load->view('admin/header')?>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.imgareaselect.min.js"></script>
	<form id="" action="<?php echo base_url().'index.php/admins/coupon/edit_coupon'?>" method="post" enctype="multipart/form-data">
		<table class="gksel_normal_tabpost">
			<tr><td height="10px"></td></tr>
			<tr>
				<td width="120" height="32" align="right"><?php if($this->langtype == '_ch'){echo '频率';}else{echo 'Frequency';}?>&nbsp;&nbsp;</td>
				<td>
					<input type="radio" name="isonlyonce" id="isonlyonce_1" value="1" class="mgr mgr-success" disabled <?php if($couponinfo['isonlyonce']==1){echo 'checked';}?>/>
					<label for="isonlyonce_1" style="color:gray;"><?php if($this->langtype == '_ch'){echo '仅仅一次';}else{echo 'Only Once';}?></label>
					
					<input type="radio" name="isonlyonce" id="isonlyonce_0" value="0" class="mgr mgr-success" disabled <?php if($couponinfo['isonlyonce']==0){echo 'checked';}?>/>
					<label for="isonlyonce_0" style="color:gray;"><?php if($this->langtype == '_ch'){echo '永久';}else{echo 'Always';}?></label>
				</td>
			</tr>
			<tr>
				<td width="120" height="32" align="right"><?php if($this->langtype == '_ch'){echo '优惠券类型';}else{echo 'Coupon Type';}?>&nbsp;&nbsp;</td>
				<td>
					<select name="coupon_type" onchange="tochangecoupontype(this.value)" style="float:left;background: url('<?php echo base_url().'themes/default/images/select_arrow.png';?>') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:120px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
						<option value="1" <?php if($couponinfo['coupon_type']==1){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '固定价格';}else{echo 'Fixed price';}?></option>
						<option value="2" <?php if($couponinfo['coupon_type']==2){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '百分比';}else{echo 'Percent';}?></option>
					</select>
					<script>
						function tochangecoupontype(coupon_type){
							if(coupon_type==2){
								$('.coupon_startprice_area').hide();
								$('.coupon_price_area').hide();
								$('.coupon_percent_area').show();
							}else{
								$('.coupon_startprice_area').show();
								$('.coupon_price_area').show();
								$('.coupon_percent_area').hide();
							}
						}
					</script>
				</td>
			</tr>
			<tr>
				<td width="120" height="32" align="right"><?php if($this->langtype == '_ch'){echo '优惠券名称';}else{echo 'Coupon Name';}?>&nbsp;&nbsp;</td>
				<td>
					<input type="text" name="coupon_name" style="width:200px;" value="<?php echo $couponinfo['coupon_name']?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tbody class="coupon_price_area" <?php if($couponinfo['coupon_type']==2){echo 'style="display:none;"';}?>>
				<tr>
					<td width="120" height="32" align="right"><?php if($this->langtype == '_ch'){echo '优惠券价格';}else{echo 'Coupon Price';}?>&nbsp;&nbsp;</td>
					<td>
						<div style="float:left;margin-top:5px;margin-right:5px;">&yen;</div>
						<input type="text" name="coupon_price" defaultvalue="0" style="width:80px;" value="<?php if($couponinfo['coupon_price'] != 0){echo $couponinfo['coupon_price'];}?>"/>
						<div class="tipsgroupbox"><div class="request">*</div></div>
					</td>
				</tr>
			</tbody>
			<tr>
				<td width="120" height="32" align="right"><?php if($this->langtype == '_ch'){echo '优惠券代码';}else{echo 'Coupon Code';}?>&nbsp;&nbsp;</td>
				<td>
					<input type="text" name="coupon_code" style="width:120px;" value="<?php echo $couponinfo['coupon_code']?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tbody class="coupon_percent_area" <?php if($couponinfo['coupon_type']!=2){echo 'style="display:none;"';}?>>
				<tr>
					<td height="32" align="right"><?php if($this->langtype == '_ch'){echo '优惠券折扣';}else{echo 'Coupon Discount';}?>&nbsp;&nbsp;</td>
					<td>
						<select name="coupon_percent" style="float:left;background: url('<?php echo base_url().'themes/default/images/select_arrow.png';?>') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:120px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
							<option value="0.95" <?php if($couponinfo['coupon_percent'] == 0.95){echo 'selected';}?>>5% OFF</option>
							<option value="0.9" <?php if($couponinfo['coupon_percent'] == 0.9){echo 'selected';}?>>10% OFF</option>
							<option value="0.85" <?php if($couponinfo['coupon_percent'] == 0.85){echo 'selected';}?>>15% OFF</option>
							<option value="0.8" <?php if($couponinfo['coupon_percent'] == 0.8){echo 'selected';}?>>20% OFF</option>
							<option value="0.75" <?php if($couponinfo['coupon_percent'] == 0.75){echo 'selected';}?>>25% OFF</option>
							<option value="0.7" <?php if($couponinfo['coupon_percent'] == 0.7){echo 'selected';}?>>30% OFF</option>
							<option value="0.65" <?php if($couponinfo['coupon_percent'] == 0.65){echo 'selected';}?>>35% OFF</option>
							<option value="0.6" <?php if($couponinfo['coupon_percent'] == 0.6){echo 'selected';}?>>40% OFF</option>
							<option value="0.55" <?php if($couponinfo['coupon_percent'] == 0.55){echo 'selected';}?>>45% OFF</option>
							<option value="0.5" <?php if($couponinfo['coupon_percent'] == 0.5){echo 'selected';}?>>50% OFF</option>
						</select>
					</td>
				</tr>
			</tbody>
			<tbody class="coupon_startprice_area" <?php if($couponinfo['coupon_type']==2){echo 'style="display:none;"';}?>>
				<tr>
					<td height="32" align="right"><?php if($this->langtype == '_ch'){echo '优惠券最低购买价格';}else{echo 'Coupon Start Price';}?>&nbsp;&nbsp;</td>
					<td>
						<div style="float:left;margin-top:5px;margin-right:5px;">&yen;</div>
						<input type="text" name="coupon_starprice" defaultvalue="0" style="width:80px;" value="<?php if($couponinfo['coupon_starprice'] != 0){echo $couponinfo['coupon_starprice'];}?>"/>
						<div class="tipsgroupbox"><div class="request">*</div></div>
					</td>
				</tr>
			</tbody>
			<tr>
				<td height="32" align="right"><?php if($this->langtype == '_ch'){echo '优惠券数量';}else{echo 'Coupon Quantity';}?>&nbsp;&nbsp;</td>
				<td>
					<select name="coupon_quantity" style="float:left;background: url('<?php echo base_url().'themes/default/images/select_arrow.png';?>') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:120px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
						<?php 
							for ($i = 1; $i <= 500; $i++) {
								if($couponinfo['coupon_quantity'] == $i){
									$isselected = 'selected';
								}else{
									$isselected = '';
								}
								echo '<option value="'.$i.'" '.$isselected.'>'.$i.'</option>';	
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td height="32" align="right">Start Time&nbsp;&nbsp;</td>
				<td>
					<input type="text" name="coupon_start_time" defaultvalue="0" style="width:150px;" value="<?php if($couponinfo['coupon_start_time'] != 0){echo date('Y-m-d H:i:s', $couponinfo['coupon_start_time']);}?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
					<div class="tipsgroupbox" style="margin-left:5px;margin-top:3px;color:gray;">EG: 2018-01-01 00:00:00</div>
				</td>
			</tr>
			<tr>
				<td height="32" align="right">End Time&nbsp;&nbsp;</td>
				<td>
					<input type="text" name="coupon_end_time" defaultvalue="0" style="width:150px;" value="<?php if($couponinfo['coupon_end_time'] != 0){echo date('Y-m-d H:i:s', $couponinfo['coupon_end_time']);}?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
					<div class="tipsgroupbox" style="margin-left:5px;margin-top:3px;color:gray;">EG: 2018-01-31 23:59:59</div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('cy_status')?></td>
				<td align="left">
					<input name="status" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" <?php if($couponinfo['status'] == 1){echo 'checked';}?>/>
				</td>
			</tr>
			<tr>
				<td height="32" align="right">
					<input name="backurl" type="hidden" value=""/>
				</td>
				<td>
					<div class="gksel_btn_action_on" onclick="tosave_couponinfo(<?php echo $couponinfo['coupon_id']?>)"><?php echo lang('cy_save')?></div>
				</td>
			</tr>
			
		</table>
	</form>	
<script type="text/javascript">
	//商品第三级分类---保存
	function tosave_couponinfo(coupon_id){
		var lancodelist = getlancodelist();
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_couponinfo('+coupon_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			var subbackurl = $('input[name="subbackurl"]').val();
			var thirdbackurl = $('input[name="thirdbackurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			//----定义的字段------START
				var GETOBJ = [];
				var GETOBJ_num = 0;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'status';
				GETOBJ[GETOBJ_num]['field_realname'] = 'status';
				GETOBJ[GETOBJ_num]['field_type'] = "checkboxradio";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = L['cy_status'];


				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'isonlyonce';
				GETOBJ[GETOBJ_num]['field_realname'] = 'isonlyonce';
				GETOBJ[GETOBJ_num]['field_type'] = "radio";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'coupon_type';
				GETOBJ[GETOBJ_num]['field_realname'] = 'coupon_type';
				GETOBJ[GETOBJ_num]['field_type'] = "select";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'coupon_name';
				GETOBJ[GETOBJ_num]['field_realname'] = 'coupon_name';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'coupon_code';
				GETOBJ[GETOBJ_num]['field_realname'] = 'coupon_code';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'coupon_price';
				GETOBJ[GETOBJ_num]['field_realname'] = 'coupon_price';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'coupon_starprice';
				GETOBJ[GETOBJ_num]['field_realname'] = 'coupon_starprice';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'coupon_percent';
				GETOBJ[GETOBJ_num]['field_realname'] = 'coupon_percent';
				GETOBJ[GETOBJ_num]['field_type'] = "select";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';
				
				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'coupon_quantity';
				GETOBJ[GETOBJ_num]['field_realname'] = 'coupon_quantity';
				GETOBJ[GETOBJ_num]['field_type'] = "select";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'coupon_start_time';
				GETOBJ[GETOBJ_num]['field_realname'] = 'coupon_start_time';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'coupon_end_time';
				GETOBJ[GETOBJ_num]['field_realname'] = 'coupon_end_time';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '';
				
			//----定义的字段------END
				
			//----定义多语言的字段------START
				var GETLANGOBJ = new Array();
				var GETLANGOBJ_num = 0;
			//----定义多语言的字段------END
			
			var returnOBJ = checkjsformcontent(lancodelist, GETOBJ, GETLANGOBJ);//----定义字段变量, 检查是否为空或格式错误------START
			var postOBJ = returnOBJ.postOBJ;
			postOBJ.backurl = backurl;
			postOBJ.subbackurl = subbackurl;
			postOBJ.thirdbackurl = thirdbackurl;
			postOBJ.GETOBJ = returnOBJ.GETOBJ_arr;
			postOBJ.GETOBJ_type = returnOBJ.GETOBJ_type_arr;
			postOBJ.GETOBJ_realname = returnOBJ.GETOBJ_realname_arr;
			postOBJ.GETLANGOBJ = returnOBJ.GETLANGOBJ_arr;
			if(returnOBJ.ispass == 1){
				$.post(baseurl+'index.php/admins/coupon/edit_coupon/'+coupon_id, postOBJ, function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
					location.href = obj.backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html(L['cy_save']);
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
</script>
<?php $this->load->view('admin/footer')?>
