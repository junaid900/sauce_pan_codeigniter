<?php $this->load->view('admin/header')?>
<?php
    $date_time = $this->input->get('date_time');
    $keyword = $this->input->get('keyword');
?>
<script type="text/javascript">

    function fp_ready(){
        // setting custom defaults
        Flatpickr.l10n.firstDayOfWeek = 1;
        //Regular flatpickr
        document.getElementById("flatpickr-tryme").flatpickr();
        document.getElementsByClassName("calendar").flatpickr();
        console.log()
        // var  y = createElement("input", "flatpickr-input");; //将输入框的值赋给div标签
        // alert(y)
        var check_in=document.getElementById("flatpickr-tryme").flatpickr({
            minDate: "",
            enableTime: false,
            onChange: function(dateObj, dateStr, instance) {
                console.log(dateStr);
                $(".date_html").html(dateStr);
                $("#flatpickr-tryme").val(dateStr);
                if(dateStr!=''){
                    $(".digital1").css({"color":"#1069D2","borderColor":"#1069D2"})
                    // $(".line1").css("backgroundColor","#1069D2")
                }else{
                    $(".digital1").css({"color":"#DEDEDE","borderColor":"#DEDEDE"})
                    // $(".line1").css("backgroundColor","#DEDEDE")
                }
            },
        });
    }


</script>
<link rel="stylesheet" type="text/css" id=cal_style  href="<?php echo base_url()?>themes/default/flatpickr/flatpickr.min.css?date=<?php echo CACHE_USETIME()?>" />
<script async onload="fp_ready()"  src="<?php echo base_url()?>themes/default/flatpickr/flatpickr.js?date=<?php echo CACHE_USETIME()?>" ></script>
<style>
    html,body{background-color: #F2F5F9;}
	.cur_year{text-indent: 0 !important;}
    .personal_body{width:calc(100% - 180px);margin-left:180px;;float:left;margin-top:69px;background-color: #F2F5F9;;}
	
	.input_box{width: 100%;float:left;margin-top:30px;}
	.input_box .title{width:100%;float: left;font-size: 16px;color: #666666;}
	
	
	.img_gksel_show{float:left;width:100%;}
	.img_gksel_choose{float:left;margin-top:3px;background:#bababa;padding:4px 8px 4px 8px;-moz-border-radius: 4px;-webkit-border-radius: 4px;font-size: 14px;;}
</style>
<div class="personal_body" style="">
    <div class="personal_oreder_body">
    	<div class="header_box_section">
    		<div class="title" style="border: none;">
    			<div style="float: left;font-size: 14px;color: #999999;">CMS>> </div>
				<div style="float: left;font-size: 14px;color: #999999;margin-left:10px;">Home Banner</div>
    		</div>
    		<div class="search_box">

    		</div>
    	</div>
		
		<div class="section_box_body">
			<div style="width:100%;float:left;">
				<div style="width: calc(100% - 00px);padding:50px 0;border-radius: 8px;background-color: white;float: left;margin-top:20px;">
					<div style="width: calc(100% - 60px);padding:0 30px;font-size: 20px;float:left;;">
						<div class="input_box" style="">
							<div class="title">Please enter your clinic name</div>
							<div class="img_gksel_show" id="img1_gksel_show">
								<?php 
									$img1_gksel = '';
								?>
							</div>
							<div class="img_gksel_choose" id="img1_gksel_choose">上传图片</div>
							<div style="float:left;"><input type="hidden" id="img1_gksel" name="img1_gksel" value="<?php echo $img1_gksel;?>"/></div>
							<div style="float:left;margin-left:5px;margin-top:5px;"><font class="fonterror" id="img1_gksel_error"><font style="color:gray;font-size: 12px;">jpg.jpeg.png. only, each picture less than 500kb(1280*799)</font></div>
						</div>
						
					</div>
				</div>
			</div>		
		</div>
    </div>
</div>

			
<script>
    function search() {
        var date_time = $("input[name='date_time']").val()
        var keyword = $('input[name="keyword"]').val()

        location.href = baseurl+ 'index.php/admins/welcome/user?date_time='+date_time+'&keyword='+keyword;
    }
</script>