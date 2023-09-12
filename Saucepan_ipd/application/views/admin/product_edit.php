<?php $this->load->view('admin/header')?>
<?php $lancodelist = getlancodelist();?>


<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
<!--以下两行加载秀米的ueditor插件的脚本和CSS，请编辑您的UEditor网页加入他们-->
<!--您也可以下载这两个文件并根据您的需要改动相关的内容，当然，改动后您必须将新文件存放到您的服务器上了-->
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/xiumi-ue-dialog-v5.js"></script>
<link rel="stylesheet" href="http://xiumi.us/connect/ue/v5/xiumi-ue-v5.css">
<style type="text/css">
	.logo40{vertical-align: middle;}
	.tn-footer{font-size: 0.9em;}
	html, body{font-size:12px;}
	
img {border:0px;}
p{
	-webkit-margin-before: 0em;
	-webkit-margin-after: 0em;
	-webkit-margin-start: 0px;
	-webkit-margin-end: 0px;
}
a{text-decoration: none;color: #1a5178;}
a:hover{text-decoration:none;}
</style>


<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_product.js?date=<?php echo CACHE_USETIME()?>'></script>

<form method="post">
	<table class="gksel_normal_tabpost">
		<tr>
			<td align="right"><?php echo lang('dz_product_picture')?></td>
			<td>
				<script>
					function toviewproductoriginal(path){
						$('#img1_gksel_show').html('<img style="float:left;max-width:400px;max-height:400px;" src="'+baseurl+path+'" />');
					}
				</script>
				<div class="img_gksel_show" id="img1_gksel_show">
					<div style="float:left;">
						<?php 
							$img1_gksel = '';
							if(file_exists($productinfo['product_pic_800']) && $productinfo['product_pic_800']!=""){
								echo '<img style="float:left;max-width:400px;max-height:400px;" src="'.base_url().$productinfo['product_pic_800'].'" />';
							}
							
							if(file_exists($productinfo['product_pic_original']) && $productinfo['product_pic_original']!=""){
								$img1_gksel = $productinfo['product_pic_original'];
							}
						?>
					</div>
					<div style="float:left;margin-left:10px;">
						<?php if(file_exists($productinfo['product_pic_original']) && $productinfo['product_pic_original']!=""){?>
							<a href="javascript:;" onclick="toviewproductoriginal('<?php echo $productinfo['product_pic_original']?>')"><?php if($this->langtype == '_ch'){echo '查看原图';}else{echo 'View original photo';}?></a>
						<?php }?>
					</div>
				</div>
				<div class="img_gksel_choose" id="img1_gksel_choose">上传图片</div>
				<div style="float:left;"><input type="hidden" id="img1_gksel" name="img1_gksel" value="<?php echo $img1_gksel;?>"/></div>
				<div style="float:left;margin-left:5px;margin-top:5px;"><font class="fonterror" id="img1_gksel_error"><font style="color:gray;">仅支持 Jpg, Png, Gif (800px * 800px)</font></div>
			</td>
		</tr>
		<script>
			function tochooseparentcategory_id(category_id){
				$.post(baseurl+'index.php/admins/product/togetsubcategory_select/'+category_id, function (data){
					var obj = eval( "(" + data + ")" );
					$('.subcategory_area').html(obj.item);

					tochoosesubcategory_id(obj.first_id);
				})
			}

			function tochoosesubcategory_id(subcategory_id){
				$.post(baseurl+'index.php/admins/product/togetthirdcategory_select/'+subcategory_id, function (data){
					var obj = eval( "(" + data + ")" );
					$('.thirdcategory_area').html(obj.item);
				})
			}

			
			function tochoosecategory_id(category_id){
				if(category_id == 16 || category_id == 40){
					$('.otherproductshuxing').show();
				}else{
					$('.otherproductshuxing').hide();
				}
			}
		</script>
		<?php 
		$fenlei_style_id = 3;//多选 checkbox的
		
		if($fenlei_style_id == 1){?>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_product_category')?></td>
				<td align="left">
					<?php 
						$sql = "SELECT * FROM ".DB_PRE()."product_category WHERE product_id = ".$productinfo['product_id'];
						$checkres = $this->db->query($sql)->result_array();
						
						$con = array('parent'=>0, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
						$fenleilist = $this->ProductModel->getproductcategorylist($con);
						if(!empty($fenleilist)){
							for ($aaa = 0; $aaa < count($fenleilist); $aaa++) {
								echo '<div style="float:left;width:100%;margin-top:10px;font-weight:bold;">'.$fenleilist[$aaa]['category_name'.$this->langtype].'</div>';
								echo '<div style="float:left;width:100%;margin-top:10px;">';
									$con = array('parent'=>$fenleilist[$aaa]['category_id'], 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
									$articlecategorylist=$this->ProductModel->getproductcategorylist($con);
									if(!empty($articlecategorylist)){
										for ($i = 0; $i < count($articlecategorylist); $i++) {
											$ischecked = '';
											if(!empty($checkres)){
												for ($j = 0; $j < count($checkres); $j++) {
													if($checkres[$j]['category_id'] == $articlecategorylist[$i]['category_id']){
														$ischecked = 'checked';
													}
												}
											}
											echo '<div style="float:left;background:#EFEFEF;margin-right:10px;padding:5px 10px;">';
											echo '<input style="float:left;" id="category_id_'.$articlecategorylist[$i]['category_id'].'" name="category_id[]" type="checkbox" class="mgc mgc-success" value="'.$articlecategorylist[$i]['category_id'].'" '.$ischecked.'/>';
											echo '<label style="float:left;" for="category_id_'.$articlecategorylist[$i]['category_id'].'">'.$articlecategorylist[$i]['category_name'.$this->langtype].'</label>';
											echo '</div>';
										}
									}
								echo '</div>';
							}
						}
						
					?>
				</td>
			</tr>
		<?php }else if($fenlei_style_id == 2){?>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_product_category')?></td>
				<td align="left">
					<?php 
						$sql = "SELECT * FROM ".DB_PRE()."product_category WHERE product_id = ".$productinfo['product_id'];
						$checkres = $this->db->query($sql)->result_array();
						
						$con = array('parent'=>0, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
						$fenleilist = $this->ProductModel->getproductcategorylist($con);
						
						echo '<select onchange="tochoosecategory_id(this.value)" name="category_id" style="float:left;background: url(\''.base_url().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:200px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
						if(!empty($fenleilist)){
							for ($aaa = 0; $aaa < count($fenleilist); $aaa++) {
								echo '<optgroup label="'.$fenleilist[$aaa]['category_name'.$this->langtype].'">';
									$con = array('parent'=>$fenleilist[$aaa]['category_id'], 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
									$articlecategorylist=$this->ProductModel->getproductcategorylist($con);
									if(!empty($articlecategorylist)){
										for ($i = 0; $i < count($articlecategorylist); $i++) {
											$ischecked = '';
											if(!empty($checkres)){
												for ($j = 0; $j < count($checkres); $j++) {
													if($checkres[$j]['category_id'] == $articlecategorylist[$i]['category_id']){
														$ischecked = 'checked';
													}
												}
											}
											echo '<option value="'.$articlecategorylist[$i]['category_id'].'">'.$articlecategorylist[$i]['category_name'.$this->langtype].'</option>';
										}
									}
								echo '</optgroup>';
							}
						}
						echo '</select>';
						
					?>
				</td>
			</tr>
		<?php }else{?>
			<tr style="display:none;">
				<td align="right" width="150"><?php echo lang('dz_product_category')?></td>
				<td align="left">
					<?php 
						$sql = "SELECT * FROM ".DB_PRE()."product_category WHERE product_id = ".$productinfo['product_id'];
						$checkres = $this->db->query($sql)->result_array();
						if(!empty($checkres)){
							$parentcategory_id = $checkres[0]['parentcategory_id'];
							$subcategory_id = $checkres[0]['subcategory_id'];
							$thirdcategory_id = $checkres[0]['thirdcategory_id'];
						}else{
							$parentcategory_id = 0;
							$subcategory_id = 0;
							$thirdcategory_id = 0;
						}
						
						$con = array('parent'=>0, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
						$fenleilist = $this->ProductModel->getproductcategorylist($con);
						
						echo '<select onchange="tochooseparentcategory_id(this.value)" name="parentcategory_id" style="float:left;background: url(\''.base_url().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:200px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
						if(!empty($fenleilist)){
							if($parentcategory_id == 0){
								$parentcategory_id = $fenleilist[0]['category_id'];
							}
							for ($aaa = 0; $aaa < count($fenleilist); $aaa++) {
								$ischecked = '';
								if(!empty($checkres)){
									for ($j = 0; $j < count($checkres); $j++) {
										if($parentcategory_id == $fenleilist[$aaa]['category_id']){
											$ischecked = 'selected';
										}
									}
								}
								echo '<option value="'.$fenleilist[$aaa]['category_id'].'" '.$ischecked.'>'.$fenleilist[$aaa]['category_name'.$this->langtype].'</option>';
							}
						}
						echo '</select>';
						
					?>
				</td>
			</tr>
			<tr style="display:none;">
				<td align="right"></td>
				<td align="left">
					<?php 
						$con = array('parent'=>$parentcategory_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
						$subcategorylist = $this->ProductModel->getproductcategorylist($con);
						
						echo '<select class="subcategory_area" onchange="tochoosesubcategory_id(this.value)" name="subcategory_id" style="float:left;background: url(\''.base_url().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:200px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
						if(!empty($subcategorylist)){
							if($subcategory_id == 0){
								$subcategory_id = $subcategorylist[0]['category_id'];
							}
							for ($aaa = 0; $aaa < count($subcategorylist); $aaa++) {
								$ischecked = '';
								if(!empty($checkres)){
									for ($j = 0; $j < count($checkres); $j++) {
										if($subcategory_id == $subcategorylist[$aaa]['category_id']){
											$ischecked = 'selected';
										}
									}
								}
								echo '<option value="'.$subcategorylist[$aaa]['category_id'].'" '.$ischecked.'>'.$subcategorylist[$aaa]['category_name'.$this->langtype].'</option>';
							}
						}
						echo '</select>';
					?>
				</td>
			</tr>
			<tr style="display:none;">
				<td align="right"></td>
				<td align="left">
					<?php 
						$con = array('parent'=>$subcategory_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
						$thirdcategorylist = $this->ProductModel->getproductcategorylist($con);
						
						if($thirdcategory_id == 0){
							$thirdssstyle = 'display:none;';
						}else{
							$thirdssstyle = '';
						}
						
						echo '<select class="thirdcategory_area" name="thirdcategory_id" style="'.$thirdssstyle.'float:left;background: url(\''.base_url().'themes/default/images/select_arrow.png\') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:200px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">';
						if(!empty($thirdcategorylist)){
							for ($aaa = 0; $aaa < count($thirdcategorylist); $aaa++) {
								$ischecked = '';
								if(!empty($checkres)){
									for ($j = 0; $j < count($checkres); $j++) {
										if($thirdcategory_id == $thirdcategorylist[$aaa]['category_id']){
											$ischecked = 'selected';
										}
									}
								}
								echo '<option value="'.$thirdcategorylist[$aaa]['category_id'].'" '.$ischecked.'>'.$thirdcategorylist[$aaa]['category_name'.$this->langtype].'</option>';
							}
						}else{
							echo '<option value="0">---</option>';
						}
						echo '</select>';
					?>
				</td>
			</tr>
		<?php }?>
		
		<tr style="display:none;">
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '品牌';}else{echo 'Brand';}?></td>
			<td align="left">
				<select name="brand_id" style="float:left;background: url('<?php echo base_url().'themes/default/images/select_arrow.png'?>') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:200px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
					<option value="0"><?php if($this->langtype == '_ch'){echo '选择品牌';}else{echo 'Choose Brand';}?></option>
					<?php echo $this->WelModel->getbrand_select($this->langtype, $productinfo['brand_id']);?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right"><?php echo lang('dz_product_price')?></td>
			<td>
				<div style="float: left;width:310px;background:#EFEFEF;">
					<div style="float: left;width:100%;margin:8px 0px 0px 0px;">
						<div style="float: left;width:100px;margin-left:5px;"><?php if($this->langtype == '_ch'){echo '普通价';}else{echo 'Normal Price';}?></div>
						<div style="float: left;">
							<input type="text" defaultvalue="0" value="<?php if($productinfo['product_price_regular']!=0){echo $productinfo['product_price_regular'];}?>" name="product_price_regular" />
							<div class="tipsgroupbox"><div class="request">*</div></div>
						</div>
					</div>
					<div style="display:none;float: left;width:100%;margin:8px 0px 8px 0px;">
						<div style="float: left;width:100px;margin-left:5px;"><?php if($this->langtype == '_ch'){echo '需要积分';}else{echo 'Need Points';}?></div>
						<div style="float: left;">
							<input type="text" defaultvalue="0" value="<?php if($productinfo['product_price_promotion']!=0){echo $productinfo['product_price_promotion'];}?>" name="product_price_promotion" />
							<div class="tipsgroupbox"><div class="request">*</div></div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr style="display: none;">
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '产品编号';}else{echo 'SKU NO.';}?></td>
			<td align="left">
				<input name="product_SKUno" type="text" value="<?php echo $productinfo['product_SKUno']?>"/>
			</td>
		</tr>
		<tr style="display: none;">
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '尺寸';}else{echo 'Size';}?></td>
			<td align="left">
				<input name="product_size" type="text" value="<?php echo $productinfo['product_size']?>"/>
			</td>
		</tr>
		<tr style="display: none;">
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '重量';}else{echo 'Weight';}?></td>
			<td align="left">
				<div style="float:left;">
					<input name="product_weight_1" type="text" defaultvalue="0" value="<?php if($productinfo['product_weight_1'] != 0){echo $productinfo['product_weight_1'];}?>" style="width:60px;"/>
				</div>
				<div style="float:left;margin-left:5px;margin-top:5px;">
					kg
				</div>
			</td>
		</tr>
		<tr style="display: none;">
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '净重';}else{echo 'Net Weight';}?></td>
			<td align="left">
				<div style="float:left;">
					<input name="product_weight_2" type="text" defaultvalue="0" value="<?php if($productinfo['product_weight_2'] != 0){echo $productinfo['product_weight_2'];}?>" style="width:60px;"/>
				</div>
				<div style="float:left;margin-left:5px;margin-top:5px;">
					kg
				</div>
			</td>
		</tr>
		<tr style="display:none;">
			<td align="right" width="150"><?php echo lang('cy_keywords')?></td>
			<td align="left" style="padding-top:10px;">
				<div class="choosekeywordarea" style="float:left;">
					<?php 
						$sql = "SELECT * FROM ".DB_PRE()."product_keyword WHERE product_id = ".$productinfo['product_id'];
						$checkres = $this->db->query($sql)->row_array();
						
						$con = array('orderby'=>'a.sort','orderby_res'=>'ASC');
						$articlekeywordlist=$this->CmsModel->getkeywordlist($con);
						if(!empty($articlekeywordlist)){
							for ($i = 0; $i < count($articlekeywordlist); $i++) {
								$ischecked = '';
								if(!empty($checkres)){
									for ($j = 1; $j <= 10; $j++) {
										if($checkres['keyword_id_'.$j] == $articlekeywordlist[$i]['keyword_id']){
											$ischecked = 'checked';
										}
									}
								}
								echo '<div style="float:left;background:#EFEFEF;margin-right:10px;margin-bottom:10px;padding:5px 10px;">';
								echo '<input style="float:left;" id="keyword_id_'.$articlekeywordlist[$i]['keyword_id'].'" name="keyword_id[]" type="checkbox" class="mgc mgc-success" value="'.$articlekeywordlist[$i]['keyword_id'].'" '.$ischecked.'/>';
								echo '<label style="float:left;" for="keyword_id_'.$articlekeywordlist[$i]['keyword_id'].'">'.$articlekeywordlist[$i]['keyword_name'.$this->langtype].'</label>';
								echo '</div>';
							}
						}
					?>
				</div>
				<div onclick="toapprove_ajaxkeyword()" style="cursor:pointer;float:left;margin-right:10px;margin-bottom:10px;padding:5px 10px;">Add new</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
			</td>
		</tr>
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_product_name')?> <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
				<td align="left">
					<input type="text" name="product_name<?php echo $lancodelist[$lc]['langtype']?>" style="width:300px;" value="<?php echo $productinfo['product_name'.$lancodelist[$lc]['langtype']]?>"/>
					<div class="tipsgroupbox"></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_product_tagline')?> <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
				<td align="left">
					<textarea name="product_tagline<?php echo $lancodelist[$lc]['langtype']?>"><?php echo $productinfo['product_tagline'.$lancodelist[$lc]['langtype']]?></textarea>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_product_description')?> <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
				<td align="left">
					<script id="product_description<?php echo $lancodelist[$lc]['langtype']?>" type="text/plain" style="width:800px;height:300px;"><?php echo debaseurlcontent($productinfo['product_description'. $lancodelist[$lc]['langtype']])?></script>
					<script type="text/javascript">
						var product_description<?php echo $lancodelist[$lc]['langtype']?> = UE.getEditor('product_description<?php echo $lancodelist[$lc]['langtype']?>');
					</script>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
				</td>
			</tr>
		<?php }?>
		<tr>
			<td align="right" width="150"><?php echo lang('cy_status')?></td>
			<td align="left">
				<input name="status" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" <?php if($productinfo['status'] == 1){echo 'checked';}?>/>
			</td>
		</tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_productinfo(<?php echo $productinfo['product_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">

//1、window.location.href(设置或获取整个 URL 为字符串)
var jsurl_fullurl = window.location.href;
//返回：http://i.cnblogs.com/EditPosts.aspx?opt=1

//2、window.location.protocol(设置或获取 URL 的协议部分)
var jsurl_protocol = window.location.protocol;
//返回：http:

//3、window.location.host(设置或获取 URL 的主机部分)
var jsurl_host = window.location.host;
//返回：i.cnblogs.com

var jsurl_sp = jsurl_fullurl.split(jsurl_host);

var jsurl_sp2 = jsurl_sp[1];
jsurl_sp2 = jsurl_sp2.split('/');
if(jsurl_sp2[1] != 'admins' && jsurl_sp2[1] != 'index.php'){
	var project_name = jsurl_sp2[1]+'/';
}else{
	var project_name = '';
}
var jsurl_baseurl = jsurl_protocol+'//'+jsurl_host+'/'+project_name;





$(document).ready(function(){
	var button_gksel1 = $('#img1_gksel_choose'), interval;
	if(button_gksel1.length>0){
		new AjaxUpload(button_gksel1,{
			action: baseurl+'index.php/welcome/uplogo/1000/516', 
			name: 'logo',onSubmit : function(file, ext){
				if (ext && /^(jpg|png|gif)$/.test(ext)){
					button_gksel1.text('上传中');
					this.disable();
					interval = window.setInterval(function(){
						var text = button_gksel1.text();
						if (text.length < 13){
							button_gksel1.text(text + '.');					
						} else {
							button_gksel1.text('上传中');				
						}
					}, 200);
				} else {
					$('#img1_gksel_error').html('上传失败');
					return false;
				}
			},
			onComplete: function(file, response){
				button_gksel1.text('上传图片');						
				window.clearInterval(interval);
				this.enable();
				if(response=='false'){
					$('#img1_gksel_error').html('上传失败');
				}else{
					var pic = eval("("+response+")");
					$('#img1_gksel_show').html('<img style="float:left;max-width:400px;max-height:400px;" src="'+baseurl+pic.logo+'" />');
					$('#img1_gksel').attr('value',pic.logo);
					$('#img1_gksel_error').html('');
				}	
			}
		});
	}
})
</script>
<?php $this->load->view('admin/footer')?>