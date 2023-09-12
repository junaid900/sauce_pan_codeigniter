<?php $this->load->view('admin/header')?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/checkbix.min.css?date=<?php echo CACHE_USETIME()?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/uploadImg.css?date=<?php echo CACHE_USETIME()?>" />
<script src="<?php echo base_url()?>themes/default/js/uploadImg.js?date=<?php echo CACHE_USETIME()?>"></script>
<script src="<?php echo base_url()?>themes/default/js/checkbix.min.js?date=<?php echo CACHE_USETIME()?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/index.css?date=<?php echo CACHE_USETIME()?>" />
<script>
    Checkbix.init();
</script>
<style>
	.input_box{width: 100%;float:left;margin-top:30px;}
	.input_box .title{width:100%;float: left;font-size: 16px;color: #666666;}
	#choose{display: none;}
	canvas{width: 100%;border: 1px solid #000000;}
	#upload{display: block;margin: 10px;height: 60px;text-align: center;line-height: 60px;border: 1px solid;border-radius: 5px;cursor: pointer;}
	.touch{background-color: #ddd;}
	.img-list{margin: 10px 5px;}
	.img-list li{position: relative;display: inline-block;width: 100px;height: 100px;margin: 5px 5px 20px 5px;border: 1px solid rgb(100,149,198);background: #fff no-repeat center;background-size: cover;}
	.progress{position: absolute;width: 100%;height: 20px;line-height: 20px;bottom: 0;left: 0;background-color:rgba(100,149,198,.5);}
	.progress span{display: block;width: 0;height: 100%;background-color:rgb(100,149,198);text-align: center;color: #FFF;font-size: 13px;}
	.size{position: absolute;width: 100%;height: 15px;line-height: 15px;bottom: -18px;text-align: center;font-size: 13px;color: #666;}
	.tips{display: block;text-align:center;font-size: 13px;margin: 10px;color: #999;}
	.pic-list{margin: 10px;line-height: 18px;font-size: 13px;}
	.pic-list a{display: block;margin: 10px 0;}
	.pic-list a img{vertical-align: middle;max-width: 30px;max-height: 30px;margin: -4px 0 0 10px;}
</style>
<div class="clinics_body" style="">
    <div class="clinics_body_wecome">
		

		<div class="input_box">
			<div class="title">Please enter your clinic name</div>
			<input name="store_address_en" type="text" placeholder="Dr. Lanchance" style="width: 500px;float: left;margin-top:10px;" value="">
		</div>
		<div class="input_box">
			<div class="title">Please enter your clinic Address</div>
			<input name="store_address_fr" type="text" placeholder="Street Address" style="width: 500px;float: left;margin-top:10px;" value="">
		</div>
		<div class="input_box">
			<select style="float: left;;background: url(<?php echo base_url()?>themes/default/images/select_arrow_blue.png) no-repeat scroll right center rgba(255,255,255,1);appearance: none;-moz-appearance: none;-webkit-appearance: none;width:245px;height: 35px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;color: #101010;">
				<option>City</option>
			</select>
			<select style="float: left;width:245px;margin-left:10px;;background: url(<?php echo base_url()?>themes/default/images/select_arrow_blue.png) no-repeat scroll right center rgba(255,255,255,1);appearance: none;-moz-appearance: none;-webkit-appearance: none;width:245px;height: 35px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;color: #101010;">
				<option>Region</option>
			</select>
		</div>
		<div class="input_box">
			<div class="title">Please enter a brief introduction of your clinic(English) </div>
			<textarea name="store_description_en" style="width: 500px;height:200px;float:left;margin-top:10px;;"></textarea>
		</div>
        <div class="input_box">
			<div class="title">Please enter a brief introduction of your clinic(French) </div>
			<textarea name="store_description_fr" style="width: 500px;height:200px;float:left;margin-top:10px;;"></textarea>
		</div>

		<div class="input_box">
			<div class="title">Please upload profile picture </div>
			<div style="width: 300px;float: left;margin-top:10px; display: none;" >
				<input type="file" id="choose" accept="image/*" multiple>
				<ul class="img-list"></ul>
				<a id="upload">Upload</a>
				<span class="tips">jpg.jpeg.png. only, each picture less than 500kb</span>
			</div>
            <div>
                <div style="width:calc(100% - 42px);float:left;margin-left:21px;margin-top:0px;overflow:hidden;">
                    <div class="img-box full" style="width:90%;float:left;box-sizing: border-box;">
                        <section class=" img-section" style="width:100%;">
                            <div class="z_photo upimg-div clear" style="width:300px;">

                               <!-- <section class="up-section fl">
                                    <span class="up-span"></span>
                                    <img src="<?php echo base_url().'themes/default/images/a7.png'?>" class="close-upimg">
                                    <img src="" class="up-img">
                                    <p class="img-namep"></p>
                                    <input name="path" value="" type="hidden">
                                </section> -->

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
            </div>
		</div>
		<div class="input_box">
			<div class="title">Please enter a brief introduction of your clinic </div>
            
                    <div style="width: 200px;float: left;margin-top:10px;">
                        <input  name="insurance_type_id" id="mycheckbox" style="float:left;" type="checkbox" class="checkbix" data-text="TPA MANAGER" value="">
                    </div>
           
		</div>
		<div class="input_box">
			<div style="width:71px;height:35px;line-height: 35px;text-align: center;color:white;background:rgba(16,105,210,1);opacity:1;border-radius:4px;font-size: 14px;cursor: pointer;margin-top:50px;" onclick="toadd_storeinfo()">Save</div>
		</div>
	</div>
</div>
<script>
    var dragImgUpload = new DragImgUpload("#drop_area",{
        callback:function (files) {
            //回调函数，可以传递给后台等等
            var file = files[0];

            var formData = new FormData();
            formData.append("importFilePath",file );
            formData.append("folderId",file.name);
            formData.append("softType",file.type);
            if(!/\.(gif|jpg|jpeg|png|GIF|JPG|PNG)$/.test(file.name))
            {
                return false;
            }else{
                $.ajax({
                    url: baseurl+'index.php/clinic/welcome/upImg',
                    type:'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    success:function(data){
                        var obj = eval("(" + data + ")");
                        if(obj){
                            $('input[name="dentist_avatar"]').val(obj.path);
                            //回台返回上传成功操作
                            console.log(111,obj.path);
                        }
                    }
                });
            }
            console.log(file.name);
        }
    })
</script>
<script type="text/javascript">
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

            var store_name_fr = $('input[name="store_name_fr"]').val();
            var store_name_en = $('input[name="store_name_en"]').val();
            var store_address_en = $('input[name="store_address_en"]').val();
            var store_address_fr = $('input[name="store_address_fr"]').val();

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

            // var img1_gksel = $('input[name="img1_gksel"]').val();

            // if($('input[name="status"]').is(':checked')){status = 1;}else{status = 2;}

            // var language_id=[];
            // $('input[name="language_id"]').each(function(){
            //     language_id.push($(this).val());
            // });

            if(ispass == 1){
                var postOBJ = new Object();
                postOBJ.store_name_fr = store_name_fr;
                postOBJ.store_name_en = store_name_en;
                // postOBJ.store_contact_name = store_contact_name;
                // postOBJ.store_contact_phone = store_contact_phone;
                // postOBJ.store_type_id = store_type_id;
                // postOBJ.service_type_id = service_type_id;
                postOBJ.insurance_type_arr = insurance_type_arr;
                postOBJ.internal_photo = internal_photo;
                // postOBJ.language_id = language_id;
                postOBJ.store_address_fr = store_address_fr;
                postOBJ.store_address_en = store_address_en;
                // postOBJ.store_website = store_website;
                // postOBJ.postal_code = postal_code;
                // postOBJ.longitude = longitude;
                // postOBJ.latitude = latitude;

                // postOBJ.img1_gksel = img1_gksel;

                // postOBJ.internal_photo = internal_photo;

                // postOBJ.status = status;

                postOBJ.store_description_en = store_description_en;
                postOBJ.store_description_fr = store_description_fr;

                $.post(baseurl+'index.php/clinic/welcome/edit_clinic', postOBJ, function (data){
                    var obj = eval( "(" + data + ")" );
                    if(obj.status=='success'){
                        actionsubmit_button.html('Success');
                        location.href=baseurl+'index.php/clinic/welcome/clinics_service';
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
            url : "<?=base_url()?>index.php/clinic/welcome/upload_batch_img",
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
                    var $section = $("<section class='up-section fl loading' style='width:100px;height:100px;padding-bottom:0 !important;'>");
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

<script>
  var filechooser = document.getElementById("choose");
  //    用于压缩图片的canvas
  var canvas = document.createElement("canvas");
  var ctx = canvas.getContext('2d');
  //    瓦片canvas
  var tCanvas = document.createElement("canvas");
  var tctx = tCanvas.getContext("2d");
  var maxsize = 100 * 1024;
  $("#upload").on("click", function() {
        filechooser.click();
      })
      .on("touchstart", function() {
        $(this).addClass("touch")
      })
      .on("touchend", function() {
        $(this).removeClass("touch")
      });
  filechooser.onchange = function() {
    if (!this.files.length) return;
    var files = Array.prototype.slice.call(this.files);
    if (files.length > 9) {
      alert("最多同时只可上传9张图片");
      return;
    }
    files.forEach(function(file, i) {
      if (!/\/(?:jpeg|png|gif)/i.test(file.type)) return;
      var reader = new FileReader();
      var li = document.createElement("li");
//          获取图片大小
      var size = file.size / 1024 > 1024 ? (~~(10 * file.size / 1024 / 1024)) / 10 + "MB" : ~~(file.size / 1024) + "KB";
      li.innerHTML = '<div class="progress"><span></span></div><div class="size">' + size + '</div>';
      $(".img-list").append($(li));
      reader.onload = function() {
        var result = this.result;
        var img = new Image();
        img.src = result;
        $(li).css("background-image", "url(" + result + ")");
        //如果图片大小小于100kb，则直接上传
        if (result.length <= maxsize) {
          img = null;
          upload(result, file.type, $(li));
          return;
        }
//      图片加载完毕之后进行压缩，然后上传
        if (img.complete) {
          callback();
        } else {
          img.onload = callback;
        }
        function callback() {
          var data = compress(img);
          upload(data, file.type, $(li));
          img = null;
        }
      };
      reader.readAsDataURL(file);
    })
  };
  //    使用canvas对大图片进行压缩
  function compress(img) {
    var initSize = img.src.length;
    var width = img.width;
    var height = img.height;
    //如果图片大于四百万像素，计算压缩比并将大小压至400万以下
    var ratio;
    if ((ratio = width * height / 4000000) > 1) {
      ratio = Math.sqrt(ratio);
      width /= ratio;
      height /= ratio;
    } else {
      ratio = 1;
    }
    canvas.width = width;
    canvas.height = height;
//        铺底色
    ctx.fillStyle = "#fff";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    //如果图片像素大于100万则使用瓦片绘制
    var count;
    if ((count = width * height / 1000000) > 1) {
      count = ~~(Math.sqrt(count) + 1); //计算要分成多少块瓦片
//            计算每块瓦片的宽和高
      var nw = ~~(width / count);
      var nh = ~~(height / count);
      tCanvas.width = nw;
      tCanvas.height = nh;
      for (var i = 0; i < count; i++) {
        for (var j = 0; j < count; j++) {
          tctx.drawImage(img, i * nw * ratio, j * nh * ratio, nw * ratio, nh * ratio, 0, 0, nw, nh);
          ctx.drawImage(tCanvas, i * nw, j * nh, nw, nh);
        }
      }
    } else {
      ctx.drawImage(img, 0, 0, width, height);
    }
    //进行最小压缩
    var ndata = canvas.toDataURL('image/jpeg', 0.1);
    console.log('压缩前：' + initSize);
    console.log('压缩后：' + ndata.length);
    console.log('压缩率：' + ~~(100 * (initSize - ndata.length) / initSize) + "%");
    tCanvas.width = tCanvas.height = canvas.width = canvas.height = 0;
    return ndata;
  }
  //    图片上传，将base64的图片转成二进制对象，塞进formdata上传
  function upload(basestr, type, $li) {
    var text = window.atob(basestr.split(",")[1]);
    var buffer = new Uint8Array(text.length);
    var pecent = 0, loop = null;
    for (var i = 0; i < text.length; i++) {
      buffer[i] = text.charCodeAt(i);
    }
    var blob = getBlob([buffer], type);
    var xhr = new XMLHttpRequest();
    var formdata = getFormData();
    formdata.append('imagefile', blob);
    xhr.open('post', baseurl+'index.php/welcome/multi_imgupload');
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var jsonData = JSON.parse(xhr.responseText);
        var imagedata = jsonData[0] || {};
        var text = imagedata.path ? '上传成功' : '上传失败';
        console.log(text + '：' + imagedata.path);
        clearInterval(loop);
        //当收到该消息时上传完毕
        $li.find(".progress span").animate({'width': "100%"}, pecent < 95 ? 200 : 0, function() {
          $(this).html(text);
        });
        if (!imagedata.path) return;
        $(".pic-list").append('<a href="' + imagedata.path + '">' + imagedata.name + '（' + imagedata.size + '）<img src="' + imagedata.path + '" /></a>');
      }
    };
    //数据发送进度，前50%展示该进度
    xhr.upload.addEventListener('progress', function(e) {
      if (loop) return;
      pecent = ~~(100 * e.loaded / e.total) / 2;
      $li.find(".progress span").css('width', pecent + "%");
      if (pecent == 50) {
        mockProgress();
      }
    }, false);
    //数据后50%用模拟进度
    function mockProgress() {
      if (loop) return;
      loop = setInterval(function() {
        pecent++;
        $li.find(".progress span").css('width', pecent + "%");
        if (pecent == 99) {
          clearInterval(loop);
        }
      }, 100)
    }
    xhr.send(formdata);
  }
  /**
   * 获取blob对象的兼容性写法
   * @param buffer
   * @param format
   * @returns {*}
   */
  function getBlob(buffer, format) {
    try {
      return new Blob(buffer, {type: format});
    } catch (e) {
      var bb = new (window.BlobBuilder || window.WebKitBlobBuilder || window.MSBlobBuilder);
      buffer.forEach(function(buf) {
        bb.append(buf);
      });
      return bb.getBlob(format);
    }
  }
  /**
   * 获取formdata
   */
  function getFormData() {
    var isNeedShim = ~navigator.userAgent.indexOf('Android')
        && ~navigator.vendor.indexOf('Google')
        && !~navigator.userAgent.indexOf('Chrome')
        && navigator.userAgent.match(/AppleWebKit\/(\d+)/).pop() <= 534;
    return isNeedShim ? new FormDataShim() : new FormData()
  }
  /**
   * formdata 补丁, 给不支持formdata上传blob的android机打补丁
   * @constructor
   */
  function FormDataShim() {
    console.warn('using formdata shim');
    var o = this,
        parts = [],
        boundary = Array(21).join('-') + (+new Date() * (1e16 * Math.random())).toString(36),
        oldSend = XMLHttpRequest.prototype.send;
    this.append = function(name, value, filename) {
      parts.push('--' + boundary + '\r\nContent-Disposition: form-data; name="' + name + '"');
      if (value instanceof Blob) {
        parts.push('; filename="' + (filename || 'blob') + '"\r\nContent-Type: ' + value.type + '\r\n\r\n');
        parts.push(value);
      }
      else {
        parts.push('\r\n\r\n' + value);
      }
      parts.push('\r\n');
    };
    // Override XHR send()
    XMLHttpRequest.prototype.send = function(val) {
      var fr,
          data,
          oXHR = this;
      if (val === o) {
        // Append the final boundary string
        parts.push('--' + boundary + '--\r\n');
        // Create the blob
        data = getBlob(parts);
        // Set up and read the blob into an array to be sent
        fr = new FileReader();
        fr.onload = function() {
          oldSend.call(oXHR, fr.result);
        };
        fr.onerror = function(err) {
          throw err;
        };
        fr.readAsArrayBuffer(data);
        // Set the multipart content type and boudary
        this.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);
        XMLHttpRequest.prototype.send = oldSend;
      }
      else {
        oldSend.call(this, val);
      }
    };
  }
</script>