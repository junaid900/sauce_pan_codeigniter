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
</style>
<div class="personal_body" style="">
    <div class="personal_oreder_body">
    	<div class="header_box_section">
    		<div class="title">
    			<div style="float: left;"><?php echo $user_count;?></div>
				<div style="float: left;font-size: 14px;color: #999999;margin-left:10px;">Total users</div>
    		</div>
    		<div class="search_box">
    			<div class="search_select">
                    <div class="input_section">
                        <img style="width: 14px;float: left;margin-top:12px;position: relative;z-index: 2;"  src="<?php echo base_url().'themes/default/images/date_li.png'?>" alt="">

                        <input id="flatpickr-tryme" name="date_time" value="<?php if($date_time){echo $date_time;}?>" placeholder="<?php if($date_time){echo $date_time;}else{?>All Date<?php }?>" data-date-format="Y-m-d" style="width: 120px;border: 1px solid #DEDEDE;padding:0px 30px;margin-left:-20px;float: left;border-radius:4px;color:#999999;height: 36px;">
                    </div>
    			</div>
    			
    			<div class="search_section">
    				<img style="width: 12px;" src="<?php echo base_url().'themes/default/images/clinic_reach.png'?>" />
    				<input type="text" name="keyword" placeholder="Search" value="<?php if($keyword){echo $keyword;}?>" />
                    <div onclick = search() style="width:100px;height: 38px;line-height: 38px;color: white;text-align: center;font-size:16px;border-radius:4px; background-color: #1069D2;float: left; margin-left: 20px;cursor: pointer;">
                        <?php if($this->langtype=='_en'){echo "Search";}else{echo "Chercher";}?>
                    </div>
    			</div>

    		</div>
    	</div>
    	
    	<div class="section_box_body">
    		<div class="section_box_body_title">
				<div style="width: 60px;float: left;">
					S/N
				</div>
    			<div style="width: calc(20% - 0px);float: left;">
    				Name
    			</div>
    			<div style="width: calc(20% - 0px);float: left;">
    				Email
    			</div>
    			<div style="width: calc(20% - 0px);;float: left;">
    				Logon Time
    			</div>
    			<div style="width: calc(20% - 0px);float: left;">
    				Total Orders
    			</div>
    			<div style="width: calc(20% - 60px);float: left;">
    				Actions
    			</div>
    		</div>
           <?php if($user_list){$i=0;
               foreach ($user_list as $key=>$value){$i++;
                   ?>
                   <div class="section_box_body_section">
                       <div style="width: 60px;float: left;">
                           <?php echo $i;?>
                       </div>
                       <div style="width: calc(20% - 0px);float: left;">
                           <?php echo $value['user_name']?>
                       </div>
                       <div style="width: calc(20% - 0px);float: left;">
                           <?php echo $value['user_email']?>
                       </div>
                       <div style="width: calc(20% - 0px);;float: left;">
                           <?php echo date('D, d M, Y',$value['last_login_time'])?><br>
                           <?php echo date('H:i:s',$value['last_login_time'])?>
                       </div>
                       <div style="width: calc(20% - 0px);float: left;">
                           <?php echo $value['total_order'];?>
                       </div>
                       <div style="width: calc(20% - 60px);float: left;color: #1069D2;cursor: pointer;" onclick="location.href='<?php echo base_url().'index.php/admins/welcome/user_order_view/'.$value['uid']?>'">
                           View
                       </div>
                   </div>
            <?php
               }
           }?>


                  
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