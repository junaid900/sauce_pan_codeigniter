<?php $this->load->view('admin/header')?>
    <meta charset="UTF-8">
    <title>Hygento</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input/dist/magic-input.min.css">
    <script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/jquery-1.7.2.min.js?date=<?php echo CACHE_USETIME()?>'></script>
    <script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/lan<?php echo $this->langtype?>.js?date=<?php echo CACHE_USETIME()?>'></script>
    <script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_common.js?date=<?php echo CACHE_USETIME()?>'></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/admin.css?date=<?php echo CACHE_USETIME()?>"/>
    <link rel="shortcut icon" href="<?php echo base_url()?>themes/default/images/revo_favicon.ico?date=<?php echo CACHE_USETIME()?>" type="image/x-icon" />
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
$current_url = current_url().$get_str;
$current_url_encode = urlencode($current_url);
$current_url_encode = rawurlencode($current_url_encode);
$current_url_encode = base64_encode($current_url_encode);
$current_url_encode = str_replace('/', 'hygento', $current_url_encode);
?>
<script type="text/javascript">
    var baseurl='<?php echo base_url()?>';
    var cdnurl='<?php echo CDN_URL()?>';
    var currenturl='<?php echo $current_url?>';
    var current_url_encode='<?php echo $current_url_encode?>';
    var langtype = '<?php echo $this->langtype?>';
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input.min.css">
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/xiumi-ue-dialog-v5.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/common.css?date=<?php echo CACHE_USETIME()?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/index.css?date=<?php echo CACHE_USETIME()?>" />
<script src="<?php echo base_url()?>themes/default/js/upload.js?date=<?php echo CACHE_USETIME()?>"></script>

    <style>

        .inner{
            position:relative;
            width:58px;
            height:34px;
            /*   background:linear-gradient(dimgray, silver); */
            border-radius:50px;
            background:linear-gradient(#FF387D,#FF387D);

        }
        .inner::before{
            content:'';
            font-size:25px;
            color:#808080;
            line-height:100px;
            text-align:center;
            position:absolute;
            left:0px;
            width:28px;
            height:28px;
            margin-top:3px;
            margin-left:3px;
            /*   background:radial-gradient(whitesmoke ,silver ); */
            background:white;
            border-radius:48px;
            transition:left 0.5s ease-in-out;
            /*	 box-shadow: 2px 1px 2px gray;*/
        }
        .toggle{
            position:absolute;
            width:58px;
            height:34px;
            z-index:3;
            cursor:pointer;
            filter:opacity(0%);
        }
        .toggle:checked ~ .inner::before{
            content:"";
            color:limegreen;
            left:50%;

            margin-left:-2px;
        }
        .toggle:checked ~ .inner{
            background:linear-gradient(#1C9EAD,#1C9EAD);
        }
        .toggle ~ .inner::before{
            content:"";
            color:#808080;
            left:0px;
            margin-left:3px;
        }
        .toggle ~ .inner{
            background:linear-gradient(#FF387D,#FF387D);
        }
		input[type=text], input[type=password], textarea{padding: 10px 0;;}
		input[disabled=disabled],textarea[disabled=disabled]{outline:0;background:#1069D2}
		input[type=number]:focus,input[type=password]:focus,input[type=text]:focus,textarea:focus{outline:0;border:1px solid #1069D2;background:#EFFCFD;box-shadow:0 0 5px #1069D2}
    </style>
<style>
    html,body{background-color: #F2F5F9;}
    .clinics_body{width:calc(100% - 180px);margin-left:180px;;float:left;height: 1000px;margin-top:69px;background-color: #F2F5F9;;}
    .clinics_body .clinics_body_wecome{width:calc(100% - 72px);background-color: white;float:left;padding: 28px;border-radius:8px;margin-top:28px;margin-left:16px;}
    .clinics_body .clinics_body_wecome .title{width: 100%;color: #1069D2;font-size: 20px;font-weight: bold;}
    .clinics_body .clinics_body_wecome .text{width: 100%;color: #101010;font-size: 16px;font-weight: bold;margin-top:48px;}
    .clinics_body .clinics_body_wecome .box_section{width: 100%;float:left;margin-top:28px;}
    .clinics_body .clinics_body_wecome .box_section .box{width:310px;float:left;}
    .clinics_body .clinics_body_wecome .box_section .box .bxo_title{width: 100%;color:#666666;font-size: 14px;}
    .clinics_body .clinics_body_wecome .box_section .box .box_section_box{width: 100%;background-color: #F2F5F9;border-radius: 4px;;margin-top:10px;padding:45px 0;display: flex;justify-content: center;align-items: center;cursor: pointer;}
    .clinics_body .clinics_body_wecome .box_section .box .box_section_box div{float:left;margin-left: 12px;color:#1069D2;font-size: 14px;}
	.gksel_normal_tabpost{font-size: 14px;;}
</style>
<div class="clinics_body" style="">
    <div class="clinics_body_wecome" style="">

<form method="post">
	<table class="gksel_normal_tabpost" style="width: 55%;">
        <style>
            #usernamesearch_auto {position: absolute;width: 280px;margin-left: 0px;border: 1px solid #ddd;display: none;margin-top: 30px;z-index:1000;}
            #usernamesearch_auto ul {float:left;width:100%;padding: 0px;margin: 0px;list-style: none;}
            #usernamesearch_auto li {float:left;width:100%;padding: 0px;margin: 0px;list-style: none;}
            #usernamesearch_auto li.ressearch {float: left;width: 100%;background: #FFF;height: 28px;}
            #usernamesearch_auto li.ressearch table {float:left;width: 100%;height: 100%;}
            #usernamesearch_auto li.ressearch_close {float: left;width: 100%;background: #FFF;height: 28px;text-align: right;}
            #usernamesearch_auto li.ressearch_close table {float:left;width: 100%;height: 100%;}
            #usernamesearch_auto li a {float:left;width:calc(100% - 12px);line-height:28px;display: block;padding: 0px 6px;cursor: pointer;color: #666;}
            #usernamesearch_auto li a:hover {float:left;background: #D8D8D8;text-decoration: none;color: #000;}
        </style>
            <tr>
                <td align="right"><?php if($this->langtype=="_ch"){echo '店主';}else{echo 'Owner';}?></td>
                <td align="left">
                    <input type="text" name="user_name" style="width:280px;" value=""/>
                    <div class="tipsgroupbox"><div class="request">*</div></div>
                    <input type="hidden" name="uid" value=""/>

                    <div id="usernamesearch_auto"></div>
                </td>
            </tr>
			<tr>
				<td colspan="2">
					<div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php if($this->langtype=="_ch"){echo '店铺名称(French)';}else{echo 'Store Name(French)';}?></td>
				<td align="left">
					<input type="text" name="store_name_fr" style="width:280px;" value=""/>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php if($this->langtype=="_ch"){echo '店铺名称(English)';}else{echo 'Store Name(English)';}?></td>
				<td align="left">
					<input type="text" name="store_name_en" style="width:280px;" value=""/>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php if($this->langtype=="_ch"){echo '联系人';}else{echo 'Contact Name';}?></td>
				<td align="left">
					<input type="text" name="store_contact_name" style="width:280px;" value=""/>
				</td>
			</tr>
            <tr>
            <td align="right" width="150"><?php if($this->langtype=="_ch"){echo '联系人号码';}else{echo 'Contact Number';}?></td>
            <td align="left">
                <input type="text" name="store_contact_phone" style="width:280px;" value=""/>
            </td>
            </tr>

			<?php
				$sql = "SELECT * FROM ".DB_PRE()."store_type";
				$store_type_list = $this->db->query($sql)->result_array();
			?>
			<tr>
				<td align="right" width="150">Store Type</td>
				<td align="left">
					<select name="store_type_id" style="float: left;width:280px;background: url(<?php echo base_url()?>themes/default/images/select_arrow_black.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;appearance: none;-moz-appearance: none;-webkit-appearance: none;height: 35px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;width:283px;margin-right:0px;">
						<option value="0">Select Store Type</option>
	    				<?php
		    				if($store_type_list){
		    					for ($i = 0; $i < count($store_type_list); $i++) {
		    							$isselected = '';
		    						echo '<option value="'.$store_type_list[$i]['id'].'" '.$isselected.'>'.$store_type_list[$i]['store_type_name'.$this->langtype].'</option>';
		    					}
		    				}
	    				?>
					</select>
				</td>
			</tr>
			<?php
				$sql = "SELECT * FROM ".DB_PRE()."service_type";
				$service_type_list = $this->db->query($sql)->result_array();
			?>
			<tr style="display: none;">
				<td align="right" width="150">Service Type</td>
				<td align="left">
					<select name="service_type_id" style="float: left;background: url(<?php echo base_url()?>themes/default/images/select_arrow_black.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;appearance: none;-moz-appearance: none;-webkit-appearance: none;height: 35px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;width:165px;margin-right:0px;">
						<option value="0">Select Service Type</option>
	    				<?php
		    				if($service_type_list){
		    					for ($i = 0; $i < count($service_type_list); $i++) {
		    							$isselected = '';
		    						echo '<option value="'.$service_type_list[$i]['id'].'" '.$isselected.'>'.$service_type_list[$i]['service_type_name'.$this->langtype].'</option>';
		    					}
		    				}
	    				?>
					</select>
				</td>
			</tr>
			<?php
				$sql = "SELECT * FROM ".DB_PRE()."store_insurance_type WHERE parent = 0";
				$store_insurance_type_list = $this->db->query($sql)->result_array();
			?>
			<tr>
				<td align="right" width="150">Insurance Type</td>
				<td align="left">
					<?php if($store_insurance_type_list){for ($iii = 0; $iii < count($store_insurance_type_list); $iii++) {?>
	    				
	    				<div style="float: left;width:100%;font-weight:bold;font-style:italic;margin-top:10px;">
		            		<?php echo $store_insurance_type_list[$iii]['insurance_type_name'.$this->langtype]?>
		                </div>
	    				<?php
		    				$sql = "SELECT * FROM ".DB_PRE() ."store_insurance_type WHERE parent = ".$store_insurance_type_list[$iii]['id'];
		    				$sub_insurance_type_list = $this->db->query($sql)->result_array();
		    				if($sub_insurance_type_list){
		    					foreach ($sub_insurance_type_list as $key=>$value) {
		    							$isselected = '';
		    						?>
		    						<div style="float:left;width:100%;">
                                    <input type="checkbox" name="insurance_type_id" value="<?php echo $value['id']?>"> <?php echo $value['insurance_type_name_en']?>
                                    </div>
                                <?php   }
		    				}
	    				?>
	    			<?php }?>
				</td>
			</tr>
            <?php
                $sql = "SELECT * FROM ".DB_PRE()."system_language_type";
                $language_list = $this->db->query($sql)->result_array();
            ?>
			<tr style="display: none;">
				<td align="right" width="150">Language</td>
				<td align="left">
                    <?php if($language_list){
                        foreach ($language_list as $key=>$value){
                            ?>
                            <input type="checkbox" name="language_id" value="<?php echo $value['id']?>"> <?php echo $value['language_type_name_en']?>
                            <br>
                            <?php
                        }
                    }?>
				</td>
			</tr>
            <tr style="display: none;">
                <td align="right" width="150">Store Website</td>
                <td align="left">
                    <input style="width: 280px;" type="text" name="store_website" value=""/>
                </td>
            </tr>
            <tr>
                <td align="right" width="150">Store Address (French)</td>
                <td align="left">
                    <input style="width: 280px;" type="text" name="store_address_fr" value=""/>
                </td>
            </tr>
            <tr>
                <td align="right" width="150">Store Address (English)</td>
                <td align="left">
                    <input style="width: 280px;" type="text" name="store_address_en" value=""/>
                </td>
            </tr>
            <tr>
                <td align="right" width="150">Store postal_code</td>
                <td align="left">
                    <input style="width: 280px;" type="text" name="postal_code" value=""/>
                </td>
            </tr>
            <tr>
                <td align="right" width="150">Store longitude</td>
                <td align="left">
                    <input style="width: 280px;" type="text" name="longitude" value=""/>
                </td>
            </tr>
            <tr>
                <td align="right" width="150">Store latitude</td>
                <td align="left">
                    <input style="width: 280px;" type="text" name="latitude" value=""/>
                </td>
            </tr>


            <tr>
                <td colspan="2">
                    <div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
                </td>
            </tr>
			<tr>
				<td colspan="2">
					<div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
				</td>
			</tr>
			<tr>
				<td align="right">Photos</td>
				<td>
                    <div style="width:calc(100% - 42px);float:left;margin-left:21px;margin-top:0px;overflow:hidden;">
                        <div class="img-box full" style="width:90%;float:left;box-sizing: border-box;">
                            <section class=" img-section" style="width:100%;">
                                <div class="z_photo upimg-div clear" style="width:300px;">
                                    <div style="width:100px;height: 100px;padding:2px;border-radius:10px;float:left;margin-top:0px;border:2px solid #1069D2;position: relative;">
                                        <div style="width: 100%;display:none;font-size:12px;padding: 10px 0;color:gray;text-align:center;"><?php if($this->langtype == '_ch'){echo '上传';}else{echo 'Upload';}?></div>
                                        <div style="width: 100%;height: 100%;position: absolute;left: 0;top: 0;">
                                            <div style="width:100%;height:100%;position: absolute;left: 0;top: 0;">
                                                <table style="width:100%;height: 100%;">
                                                    <tr>
                                                        <td>
                                                            <div style="width:100%;height:100%;position: relative;">
                                                                <div style="width:100%;height:100%;position: absolute;left: 0;top: 0;">
                                                                    <table style="width:100%;height: 100%;">
                                                                        <tr>
                                                                            <td>
                                                                                <div style="width:100%;margin-top: 10px;" class="jia2">
                                                                                    <input type="file" name="file" id="file" style="width: 100%;opacity: 0;    position: absolute;" class="file" value="" accept="image/*" multiple />
                                                                                    <div style="width:20px;height:4px;margin:auto;background-color:#1069D2;"></div>
                                                                                    <div style="width:4px;height:20px;margin:auto;margin-top:-12px;background-color:#1069D2;"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>
                        </div>

                        <aside class="mask works-mask">
                            <div class="mask-content">
                                <p class="del-p">Are you sure you want to delete the artwork image？</p>
                                <p class="check-p"><span class="del-com wsdel-ok">Confirm</span><span class="wsdel-no">Cancel</span></p>
                            </div>
                        </aside>
                    </div>
                </td>
			</tr>

			<tr>
				<td colspan="2">
					<div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
				</td>
			</tr>
        <?php $lancodelist = getlancodelist();?>

        <?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
            <tr>
                <td align="right" width="150">Store Description <?php if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
                <td align="left">
                    <textarea name="store_description<?php echo $lancodelist[$lc]['langtype']?>" cols="30" rows="10"></textarea>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
                </td>
            </tr>
        <?php }?>
        <tr>
            <td align="right" width="150"><?php if($this->langtype=="_ch"){echo '状态';}else{echo 'Status';}?></td>
            <td align="left">
                <input name="status" type="checkbox" class="mgc-switch" value="1" checked/>
            </td>
        </tr>
        <tr>
            <td align="right" width="150"></td>
            <td align="left">
                <div class="gksel_btn_action_on" onclick="toadd_storeinfo()" style="margin-top:20px;wifth:200px;"><?php echo lang('cy_save')?></div>
            </td>
        </tr>
    </table>
</form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('input[name="user_name"]').keyup(function(){
            console.log(111);
            if($(this).val().length>=1){
                $.post(baseurl+'index.php/admins/user/user_search',{keyword:$(this).val()}, function(data){
                    if(data=='0'){
                        $('#usernamesearch_auto').html('').css('display','none');
                    }else{
                        $('#usernamesearch_auto').html(data).css('display','block');
                    }
                });
            }else{
                $('#usernamesearch_auto').html('').css('display','none');
                $('input[name="uid"]').val('');
            }
        })
    });
    function choose_user(uid,user_name){
        $('input[name="user_name"]').val(user_name);
        $('input[name="uid"]').val(uid);
    }
</script>


<script type="text/javascript">
//用户信息---保存
function toadd_storeinfo(){

    if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="toadd_storeinfo()"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.attr('background-color', '#EFEFEF');
		actionsubmit_button.html('Loading');


		var ispass=1;

        var uid = $('input[name="uid"]').val();
		var store_name_fr = $('input[name="store_name_fr"]').val();
		var store_name_en = $('input[name="store_name_en"]').val();
		var store_contact_name = $('input[name="store_contact_name"]').val();
		var store_contact_phone = $('input[name="store_contact_phone"]').val();
		var store_type_id = $('select[name="store_type_id"]').val();
		// var service_type_id = $('select[name="service_type_id"]').val();
		// var insurance_type_id = $('select[name="insurance_type_id"]').val();
		var store_website = $('input[name="store_website"]').val();
		var store_address_en = $('input[name="store_address_en"]').val();
		var store_address_fr = $('input[name="store_address_fr"]').val();
		var postal_code = $('input[name="postal_code"]').val();
		var longitude = $('input[name="longitude"]').val();
		var latitude = $('input[name="latitude"]').val();

        var store_description_fr = $('textarea[name="store_description_fr"]').val();
        var store_description_en = $('textarea[name="store_description_en"]').val();

        var insurance_type_arr=[];
        $('input[name="insurance_type_id"]:checked').each(function(){
            insurance_type_arr.push($(this).val());
        });

        var internal_photo=[];
        $('input[name="path"]').each(function(){
            internal_photo.push($(this).val());
        });

		var img1_gksel = $('input[name="img1_gksel"]').val();

        if($('input[name="status"]').is(':checked')){status = 1;}else{status = 2;}

        var language_id=[];
        $('input[name="language_id"]').each(function(){
            language_id.push($(this).val());
        });

        if(ispass == 1){
			var postOBJ = new Object();
			postOBJ.backurl = backurl;

			postOBJ.uid = uid;
			postOBJ.store_name_fr = store_name_fr;
			postOBJ.store_name_en = store_name_en;
			postOBJ.store_contact_name = store_contact_name;
			postOBJ.store_contact_phone = store_contact_phone;
			postOBJ.store_type_id = store_type_id;
			// postOBJ.service_type_id = service_type_id;
			postOBJ.insurance_type_arr = insurance_type_arr;
			postOBJ.language_id = language_id;
			postOBJ.store_address_fr = store_address_fr;
			postOBJ.store_address_en = store_address_en;
			postOBJ.store_website = store_website;
			postOBJ.postal_code = postal_code;
			postOBJ.longitude = longitude;
			postOBJ.latitude = latitude;

			postOBJ.img1_gksel = img1_gksel;

			postOBJ.internal_photo = internal_photo;

            postOBJ.status = status;

            postOBJ.store_description_en = store_description_en;
            postOBJ.store_description_fr = store_description_fr;

            $.post(baseurl+'index.php/admins/clinic/add_clinic/' + uid, postOBJ, function (data){
				var obj = eval( "(" + data + ")" );
				if(obj.status=='success'){
                    actionsubmit_button.html('Success');
                }
			})
		}else{
			actionsubmit_button.attr('class', 'gksel_btn_action_on');
			actionsubmit_button.html(L['cy_save']);
			isajaxsaveing = 0;//ajax正在保存中 --- 释放
		}
	}
}
</script>
<script type="text/javascript">
    var delParent;
    $(".file").change(function(){
        var imgArr = [];
        var imgContainer = $(this).parents(".z_photo");
        var form = new FormData();
        var idFile = $(this).attr("id");
        var file = document.getElementById(idFile);
        var fileList = validateUp(file.files); //获取的图片文件
        $.each(fileList,function(i,item){
            form.append(i, item);
        });
        $.ajax({
            url : "<?=base_url()?>index.php/admins/welcome/upload_batch_img",
            data : form,
            type:'POST',
            // datatype:'json',
            processData: false,
            contentType: false,
            success:function(res) {
                var fileList=eval('('+res+')');
                console.log(fileList);
                for(var i = 0;i<fileList.length;i++){

                    var imgUrl = fileList[i];
                    imgArr.push(imgUrl);
                    console.log(5,imgArr[i]['path']);
                    var $section = $("<section class='up-section fl loading' style='padding-bottom:0 !important;'>");
                    imgContainer.prepend($section);
                    var $span = $("<span class='up-span'>");
                    $span.appendTo($section);

                    var $img0 = $("<img class='close-upimg'>").on("click",function(event){
                        event.preventDefault();
                        event.stopPropagation();
                        $(".works-mask").show();
                        delParent = $(this).parent();
                    });
                    $img0.attr("src",baseurl+"themes/default/images/a7.png").appendTo($section);
                    var $img = $("<img class='up-img'>");
                    $img.attr("src",imgArr[i]['path_url']);
                    $img.appendTo($section);
                    var $input3 = $("<input name='path' value='' type='hidden'/>");
                    $input3.val(imgArr[i]['path']);
                    $input3.appendTo($section);
                }
            },
        });
    })
    //
    function validateUp(files){
        var arrFiles = [];//替换的文件数组
        for(var i = 0, file; file = files[i]; i++){
            //获取文件上传的后缀名
            var newStr = file.name.split("").reverse().join("");
            arrFiles.push(file);
        }
        return arrFiles;
    }
    $(".close-upimg").click(function () {
        $(".works-mask").show();
        delParent = $(this).parent();
    });
    $(".wsdel-ok").click(function(){
        $(".works-mask").hide();
        var numUp = delParent.siblings().length;
        if(numUp < 6){
            delParent.parent().find(".z_file").show();
        }
        console.log(delParent);
        delParent.remove();

    });
    $(".wsdel-no").click(function(){
        $(".works-mask").hide();
    });
</script>
</html>