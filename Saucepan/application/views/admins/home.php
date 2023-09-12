<?php $this->load->view('admins/header')?>

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
		.clinics_body .clinics_body_wecome .box_section .box .box_section_box div{float:left;margin-left: 12px;color:#1069D2;font-size: 14px;;}
		
		.personal_body{width:calc(100% - 180px);margin-left:180px;;float:left;background-color: #F2F5F9;margin-top:69px;;}
    </style>
<div class="personal_body" style="">
    <div class="personal_oreder_body">
		<div class="section_box_body">
			<div style="width:100%;float:left;">
				
				
			</div>
		</div>
	</div>
</div>
<script>
    function get_booking_user_count() {
        var start_time = $("#flatpickr-tryme").val();
        var end_time = $("#flatpickr-tryme2").val();
        
//         if(start_time != '' || end_time != ''){
        	$('#booking_service_count').html('<img style="float:left;width:40px;height:40px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/>');
            $.post(baseurl+'index.php/admins/welcome/get_booking_service_count', {start_time:start_time, end_time:end_time}, function (data){
                var obj = eval( "(" + data + ")" );
                $('#booking_service_count').html(obj.booking_service_count);
            })
//         }
    }

    function get_sales_summary() {
        var start_time = $("#flatpickr-tryme3").val();
        var end_time = $("#flatpickr-tryme4").val();
//         if(start_time && end_time){
        		$('#total_sales').html('<img style="float:left;width:40px;height:40px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/>');
        		$.post(baseurl+'index.php/admins/welcome/get_sales_summary', {start_time:start_time,end_time:end_time}, function (data){
                    var obj = eval( "(" + data + ")" );
                    $('#total_sales').html('$'+obj.total_sales);
                })
//         }
    }



</script>

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
                    $('#cleardatetime_clear_date_time_1').show();
                    $(".digital1").css({"color":"#1069D2","borderColor":"#1069D2"})
                    // $(".line1").css("backgroundColor","#1069D2")
                }else{
                	$('#cleardatetime_clear_date_time_1').hide();
                    $(".digital1").css({"color":"#DEDEDE","borderColor":"#DEDEDE"})
                    // $(".line1").css("backgroundColor","#DEDEDE")
                }
                get_booking_user_count();
            },

        });
    }

    function fp_ready2(){
        // setting custom defaults
        Flatpickr.l10n.firstDayOfWeek = 1;
        //Regular flatpickr
        document.getElementById("flatpickr-tryme2").flatpickr();
        document.getElementsByClassName("calendar2").flatpickr();
        console.log()
        // var  y = createElement("input", "flatpickr-input");; //将输入框的值赋给div标签
        // alert(y)
        var check_in=document.getElementById("flatpickr-tryme2").flatpickr({
            minDate: "",
            enableTime: false,
            onChange: function(dateObj, dateStr, instance) {
                console.log(dateStr);
                $('#cleardatetime_clear_date_time_2').show();
                $(".date_html2").html(dateStr);
                $("#flatpickr-tryme2").val(dateStr);
                get_booking_user_count();
            },

        });
    }
    function fp_ready3(){
        // setting custom defaults
        Flatpickr.l10n.firstDayOfWeek = 1;
        //Regular flatpickr
        document.getElementById("flatpickr-tryme3").flatpickr();
        document.getElementsByClassName("calendar3").flatpickr();
        console.log()
        // var  y = createElement("input", "flatpickr-input");; //将输入框的值赋给div标签
        // alert(y)
        var check_in=document.getElementById("flatpickr-tryme3").flatpickr({
            minDate: "",
            enableTime: false,
            onChange: function(dateObj, dateStr, instance) {
                console.log(dateStr);
                $('#cleardatetime_clear_date_time_3').show();
                $(".date_html3").html(dateStr);
                $("#flatpickr-tryme3").val(dateStr);
                get_sales_summary();
            },

        });
    }
    function fp_ready4(){
        // setting custom defaults
        Flatpickr.l10n.firstDayOfWeek = 1;
        //Regular flatpickr
        document.getElementById("flatpickr-tryme4").flatpickr();
        document.getElementsByClassName("calendar4").flatpickr();
        console.log()
        // var  y = createElement("input", "flatpickr-input");; //将输入框的值赋给div标签
        // alert(y)
        var check_in=document.getElementById("flatpickr-tryme4").flatpickr({
            minDate: "",
            enableTime: false,
            onChange: function(dateObj, dateStr, instance) {
                console.log(dateStr);
                $('#cleardatetime_clear_date_time_4').show();
                $(".date_html4").html(dateStr);
                $("#flatpickr-tryme4").val(dateStr);
                get_sales_summary();
            },

        });
    }

    function tocleardatetimeinput(target){
    	$('input[name="'+target+'"]').val('');
    	$('#cleardatetime_clear_'+target+'').hide();

    	if(target == 'date_time_1' || target == 'date_time_2'){
    		get_booking_user_count();
        }else if(target == 'date_time_3' || target == 'date_time_4'){
        	get_sales_summary();
        }
    }

</script>

