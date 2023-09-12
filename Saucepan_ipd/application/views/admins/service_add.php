<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Hygento</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input/dist/magic-input.min.css">
    <script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/jquery-1.7.2.min.js?date=<?php echo CACHE_USETIME()?>'></script>
    <script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/lan<?php echo $this->langtype?>.js?date=<?php echo CACHE_USETIME()?>'></script>
    <script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_common.js?date=<?php echo CACHE_USETIME()?>'></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/admin.css?date=<?php echo CACHE_USETIME()?>"/>
    <link rel="shortcut icon" href="<?php echo base_url()?>themes/default/images/revo_favicon.ico?date=<?php echo CACHE_USETIME()?>" type="image/x-icon" />
</head>
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
$menu = $this->session->userdata('menu');
?>
<script type="text/javascript">
    var baseurl='<?php echo base_url()?>';
    var cdnurl='<?php echo CDN_URL()?>';
    var currenturl='<?php echo $current_url?>';
    var current_url_encode='<?php echo $current_url_encode?>';
    var langtype = '<?php echo $this->langtype?>';
</script>

<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input.min.css">
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/xiumi-ue-dialog-v5.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/common.css?date=<?php echo CACHE_USETIME()?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/index.css?date=<?php echo CACHE_USETIME()?>" />
<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
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
    </style>
<form method="post">
	<table class="gksel_normal_tabpost" style="width: 55%;">
            <?php
            $sql = "SELECT * FROM ".DB_PRE()."store_list";
            $store_list = $this->db->query($sql)->result_array();
            ?>
            <tr>
                <td align="right" width="150">Clinic</td>
                <td align="left">
                    <select id="store_id" name="store_id" style="float: left;background: url(<?php echo base_url()?>themes/default/images/select_arrow_black.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;appearance: none;-moz-appearance: none;-webkit-appearance: none;height: 35px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;width:165px;margin-right:0px;">
                        <option value="0">Select Clinic</option>
                        <?php
                        if($store_list){
                            for ($i = 0; $i < count($store_list); $i++) {
                                $isselected = '';
                                echo '<option value="'.$store_list[$i]['id'].'" '.$isselected.'>'.$store_list[$i]['store_name'.$this->langtype].'</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
                </td>
            </tr>
			<tr>
				<td align="right" width="150">Date Time</td>
				<td align="left">
					<input type="text" name="date_time" value=""/>
				</td>
			</tr>
            <tr>
                <td align="right" width="150">Start Time</td>
                <td align="left">
                    <input type="text" name="start_time" value=""/>
                </td>
            </tr>
            <tr>
                <td align="right" width="150">End Time</td>
                <td align="left">
                    <input type="text" name="end_time" value=""/>
                </td>
            </tr>

            <tr>
                <td align="right" width="150">Hygienist</td>
                <td align="left">
                    <select id="dentist_id" name="dentist_id" style="float: left;background: url(<?php echo base_url()?>themes/default/images/select_arrow_black.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;appearance: none;-moz-appearance: none;-webkit-appearance: none;height: 35px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;width:165px;margin-right:0px;">
                        <option value="0">Select Hygienist</option>
                    </select>
                </td>
            </tr>
            <?php
            $sql = "SELECT * FROM ".DB_PRE()."service_type";
            $service_type_list = $this->db->query($sql)->result_array();
            ?>
            <tr>
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
        <tr>
            <td align="right" width="150">Original price</td>
            <td align="left">
                <input type="number" name="normal_price" value="0"/>
            </td>
        </tr>
        <tr>
            <td align="right" width="150">Discount price </td>
            <td align="left">
                <input type="number" name="discount_price" value="0"/>
            </td>
        </tr>


			<tr>
				<td colspan="2">
					<div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
				</td>
			</tr>
        <tr>
            <td align="right" width="150">Tax</td>
            <td align="left">
                <input name="have_tax" type="checkbox" class="mgc-switch" value="1" checked/>
            </td>
        </tr>
        <tr>
            <td align="right" width="150"><?php if($this->langtype=="_ch"){echo '状态';}else{echo 'Status';}?></td>
            <td align="left">
                <input name="status" type="checkbox" class="mgc-switch" value="1" checked/>
            </td>
        </tr>
        <tr>
            <td align="right" width="150"></td>
            <td align="left">
                <div class="gksel_btn_action_on" onclick="toadd_serviceinfo()"><?php echo lang('cy_save')?></div>
            </td>
        </tr>
    </table>
</form>
<script>
    $(document).ready(function () {
        $('#store_id').change(function(){
            var store_id = $(this).val();
            if(store_id!=0){
                $.post(baseurl+'index.php/admins/clinic/get_dentist/'+store_id,function(data){
                    $('#dentist_id').html(data);
                });
            }
        })
    })
</script>
<script type="text/javascript">
//用户信息---保存
function toadd_serviceinfo(){
    if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="toadd_serviceinfo()"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.attr('background-color', '#EFEFEF');
		actionsubmit_button.html('Loading');


		var ispass=1;

		var store_id = $('select[name="store_id"]').val();
		var normal_price = $('input[name="normal_price"]').val();
		var discount_price = $('input[name="discount_price"]').val();
		var date_time = $('input[name="date_time"]').val();
		var start_time = $('input[name="start_time"]').val();
		var end_time = $('input[name="end_time"]').val();
		var dentist_id = $('select[name="dentist_id"]').val();
		var service_type_id = $('select[name="service_type_id"]').val();

        if($('input[name="status"]').is(':checked')){status = 1;}else{status = 2;}
        if($('input[name="have_tax"]').is(':checked')){have_tax = 1;}else{have_tax = 0;}

        if(ispass == 1){
			var postOBJ = new Object();
			postOBJ.backurl = backurl;

			postOBJ.store_id = store_id;
			postOBJ.normal_price = normal_price;
			postOBJ.discount_price = discount_price;
			postOBJ.date_time = date_time;
			postOBJ.start_time = start_time;
            postOBJ.end_time = end_time;
            postOBJ.dentist_id = dentist_id;
            postOBJ.service_type_id = service_type_id;
            postOBJ.status = status;
            postOBJ.have_tax = have_tax;

            $.post(baseurl+'index.php/admins/clinic/add_service', postOBJ, function (data){
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
                    var $section = $("<section class='up-section fl loading' style='width:200px;height:200px;padding-bottom:0 !important;'>");
                    imgContainer.prepend($section);
                    var $span = $("<span class='up-span'>");
                    $span.appendTo($section);

                    var $img0 = $("<img class='close-upimg'>").on("click",function(event){
                        event.preventDefault();
                        event.stopPropagation();
                        $(".works-mask").show();
                        delParent = $(this).parent();
                    });
                    $img0.attr("src","../../themes/default/images/a7.png").appendTo($section);
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
<script>
    <?php if($this->langtype=='_ch'){?>
    var loading = '上传中';
    var upload = '上传';
    <?php }else{?>
    var loading = 'Loading';
    var upload = 'Upload';
    <?php }?>
    $(document).ready(function(){
        var button_gksel1 = $('#img1_gksel_choose'), interval;
            new AjaxUpload(button_gksel1, {
                action: baseurl+'index.php/admins/welcome/uplogo/800/800',
                name: 'logo',onSubmit : function(file, ext){
                    if (ext && /^(jpg|jpeg|png|gif)$/.test(ext)){
                        $('.img_gksel_choose').text(loading);
                        this.disable();
                        interval = window.setInterval(function(){
                            var text = $('.img_gksel_choose').text();
                            if (text.length < 13){
                                $('.img_gksel_choose').text(text + '.');
                            } else {
                                $('.img_gksel_choose').text(loading);
                            }
                        }, 200);
                    } else {
                        $('#img1_gksel_error').html('上传失败');
                        return false;
                    }
                },
                onComplete: function(file, response){
                    $('.img_gksel_choose').text(upload);
                    window.clearInterval(interval);
                    this.enable();
                    if(response=='false'){
                        $('#img1_gksel_error').html('上传失败');
                    }else{
                        var pic = eval("("+response+")");
                        $('#img1_gksel_show').show().html('<img style="float:left;max-width:200px;max-height:200px;border-radius:6px;" src="'+baseurl+pic.logo+'" />');
                        $('#img1_btn_show').hide();
                        $('#img1_gksel').attr('value',pic.logo);
                        $('#img1_gksel_error').html('');
                    }
                }
            });
    })
</script>
</html>