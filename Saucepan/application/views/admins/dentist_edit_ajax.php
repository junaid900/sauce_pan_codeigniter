<div style="width: calc(100% - 200px);padding:20px 100px;float:left;background-color: white;;">
    <div style="width:100%;float:let;font-size: 14px;">
		<div style="width: 100%;float:left;color: #101010;padding:10px 0px;">
			<?php 
			$storeinfo = $this->ClinicModel->get_store_info($dentist_info['dentist_store_id']);
			?>
			Clinic Name: <span style="color:gray;"><?php if(!empty($storeinfo)){
        					    echo $storeinfo['store_name'.$this->langtype];
        					}?></span>
		</div>
	</div>
    <div style="width:100%;float:let;font-size: 14px;">
        <div style="width: 100%;float:left;color: #101010;">
            Please enter hygienist’s name <font style="font-size:18px;color:red;">*</font>
        </div>
        <input type="text" placeholder="Dr. Lachance" name="dentist_name2" value="<?php echo $dentist_info['dentist_name']?>" style="width: 100%;padding:10px 0;float: left;border-radius:4px;color:black;margin-top:10px;" />
    </div>
    <div class="dentist_name2_error" style="display:none;float:let;width:100%;font-size: 14px;color: red;">
		Please enter hygienist’s name
	</div>
    <div style="width:100%;float:left;font-size: 14px;margin-top:38px;">
        <div style="width: 100%;float:left;color: #101010;">
            Please enter hygienist’s education background <font style="font-size:18px;color:red;">*</font>
        </div>
        <input type="text" placeholder="University Name" name="dentist_school2" value="<?php echo $dentist_info['dentist_school']?>" style="width: 100%;padding:10px 0;float: left;border-radius:4px;color:black;margin-top:10px;" />
    </div>
    <div class="dentist_school2_error" style="display:none;float:let;width:100%;font-size: 14px;color: red;">
		Please enter hygienist’s education background
	</div>
    <div style="width:100%;float:left;font-size: 14px;margin-top:38px;display: flex;justify-content: left;align-items: center;">
		<div style="width: 50%;float:left;color: #101010;">
			Years of work experience
		</div>
		<div style="float:left;width: 50%;display: flex;justify-content: flex-end;">
			<input id="5" data-step="1" data-min="0" data-max="" data-digit="0" value="<?php echo $dentist_info['dentist_work']?>" name="dentist_work2"/>
		</div>
	</div>
    <div style="width:100%;float:left;font-size: 14px;margin-top:38px;">
        <div style="width: 100%;float:left;color: #101010;">
			Please upload hygienist’s profile picture <font style="font-size:18px;color:red;">*</font>
		</div>
        <div id="drop_area2" style="float:left;margin-top:10px;"></div>
        <input type="hidden" name="dentist_avatar2" value="<?php echo $dentist_info['dentist_avatar']?>">
    </div>
    <div class="dentist_avatar2_error" style="display:none;float:let;width:100%;font-size: 14px;color: red;">
		Please upload hygienist’s profile picture
	</div>
    <div style="width:calc(100% - 00px);margin-left:0px;float:left;font-size: 14px;color: #1069D2;margin-top:20px;position: relative;display: flex;justify-content: flex-end;align-items: center;">
        <div style="width: 78px;height: 38px;cursor:pointer;line-height: 38px;text-align: center;text-align: center;color: white;background-color: #1069D2;margin-left:20px;border:1px solid #1069D2;border-radius: 4px;cursor:pointer;" class="pay_btn" onclick="edit_hygienist(<?php echo $dentist_info['uid']?>)">Save</div>
    </div>
</div>
<script>
// 自定义类型：参数为数组，可多条数据
alignmentFns.createType([{"test": {"step" : 10, "min" : 10, "max" : 999, "digit" : 0}}]);

// 初始化
alignmentFns.initialize();

// 销毁
alignmentFns.destroy();

// js动态改变数据
$("#4").attr("data-max", "12")
// 初始化
alignmentFns.initialize();


var dragImgUpload2 = new DragImgUpload("#drop_area2",{
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
                url: baseurl+'index.php/admins/welcome/upImg',
                type:'POST',
                contentType: false,
                processData: false,
                data: formData,
                success:function(data){
                    var obj = eval("(" + data + ")");
                    if(obj){
                        $('input[name="dentist_avatar2"]').val(obj.path);
                        //回台返回上传成功操作
                        console.log(111,obj.path);
                    }
                }
            });
        }
        console.log(file.name);
    }
})

setTimeout("tosetdefaultsssvalue()", 300);

function tosetdefaultsssvalue(){
// 	$(".model_pic").find("div").css("backgroundColor","rgba(0,0,0,0.5)");
// 	$(".model_pic").find("div").css("backgroundColor","none")
//$("#preview").find("img").attr("src", '<?php echo base_url().$dentist_info['dentist_avatar']?>');
	<?php if($dentist_info['dentist_avatar'] != ''){?>
		<?php if(file_exists($dentist_info['dentist_avatar'])){?>
			$('#drop_area2 .img-responsive').attr('src', '<?php echo base_url().$dentist_info['dentist_avatar']?>');
		<?php }?>
	<?php }?>
}

function edit_hygienist(dentist_id) {
    if(isajaxsaveing == 0){
        //具体点击的按钮
        actionsubmit_button = $('div[onclick="edit_dentistinfo('+dentist_id+')"]');
        //ajax正在保存中
        isajaxsaveing = 1;
        //将提交按钮设置为保存中
        actionsubmit_button.attr('background-color', '#EFEFEF');
        actionsubmit_button.html('Loading');


        var ispass=1;

        var dentist_name = $('input[name="dentist_name2"]').val();
        var dentist_school = $('input[name="dentist_school2"]').val();
        var dentist_work = $('input[name="dentist_work2"]').val();
        var dentist_avatar = $('input[name="dentist_avatar2"]').val();

        
        if(isNull.test(dentist_name)){
			ispass = 0;
			$('.dentist_name2_error').show();
		}else{
			$('.dentist_name2_error').hide();
		}
		if(isNull.test(dentist_school)){
			ispass = 0;
			$('.dentist_school2_error').show();
		}else{
			$('.dentist_school2_error').hide();
		}
		if(isNull.test(dentist_avatar)){
			ispass = 0;
			$('.dentist_avatar2_error').show();
		}else{
			$('.dentist_avatar2_error').hide();
		}

        if(ispass == 1){
            var postOBJ = new Object();

            postOBJ.dentist_name = dentist_name;
            postOBJ.dentist_school = dentist_school;
            postOBJ.dentist_work = dentist_work;
            postOBJ.dentist_avatar = dentist_avatar;

            $.post(baseurl+'index.php/admins/clinic/ajax_edithygienist/'+dentist_id, postOBJ, function (data){
                var obj = eval( "(" + data + ")" );
                if(obj.status=='success'){
                    actionsubmit_button.html('Success');
                    location.reload();
                }
            })
        }else{
            actionsubmit_button.attr('class', 'gksel_btn_action_on');
            actionsubmit_button.html('Save');
            isajaxsaveing = 0;//ajax正在保存中 --- 释放
        }
    }
}
</script>