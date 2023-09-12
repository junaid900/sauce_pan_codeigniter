<?php $this->load->view('admin/header')?>
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
            minDate: "today",
            enableTime: false,
            onChange: function(dateObj, dateStr, instance) {
                console.log(dateStr);
                $(".date_html").html(dateStr);
                $("#flatpickr-tryme").val(dateStr)
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

<?php 
	$entrytype = $this->input->get('entrytype');
?>

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
    			<?php
	    			$con = [
    					'orderby' => 'a.created',
    					'orderby_res' => 'DESC'
	    			];
	    			$count_service = $this->ServiceModel->get_service_list($con, 1);
    			?>
    			<div style="float: left;"><?php echo $count_service;?></div>
    			<div style="float: left;font-size: 14px;color: #999999;margin-left:10px;">Total Service</div>
    		</div>
    		<div class="search_box">
    			<div class="search_select">
                    <div class="input_section">
                        <img style="width: 14px;float: left;margin-top:12px;position: relative;z-index: 2;"  src="<?php echo base_url().'themes/default/images/date_li.png'?>" alt="">

                        <input id="flatpickr-tryme" name="date_time" value="" placeholder="" data-date-format="Y-m-d" style="width: 120px;border: 1px solid #DEDEDE;padding:0px 30px;margin-left:-20px;float: left;border-radius:4px;color:#999999;height: 36px;">
                    </div>
    			</div>
    			<div class="search_select">
    				<select name="clinic_id" style="float: left;background: url(<?php echo base_url()?>themes/default/images/select_arrow_blue.png) no-repeat scroll right center rgba(255,255,255,1);appearance: none;-moz-appearance: none;-webkit-appearance: none;width:158px;height: 35px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;color: #101010;">
    					<option value="0">All Clinics</option>
    				</select>
    			</div>
    			
    			<div class="search_section">
    				<img style="width: 12px;" src="<?php echo base_url().'themes/default/images/clinic_reach.png'?>" />
    				<input type="text" name="keyword" placeholder="Search" value="" />
    				<input type="hidden" name="entrytype" value="<?php echo $entrytype;?>" />
                    <div onclick = search() style="width:100px;height: 38px;line-height: 38px;color: white;text-align: center;font-size:16px;border-radius:4px; background-color: #1069D2;float: left; margin-left: 20px;">
                        <?php if($this->langtype=='_en'){echo "Search";}else{echo "Chercher";}?>
                    </div>
    			</div>

    		</div>
    	</div>
    	
    	<div style="float:left;width:calc(100% - 32px);margin-left:16px;margin-top:20px;">
    		<?php
    			$con = [
    			    'isexpired' => 0,
					'orderby' => 'a.created',
					'orderby_res' => 'DESC'
    			];
    			$count_service_upcomming = $this->ServiceModel->get_service_list($con, 1);
			?>
    		<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/welcome/product?entrytype=1'?>';" style="cursor:pointer;float:left;line-height:30px;padding:0px 20px;<?php if($entrytype == '' || $entrytype == 1){echo 'background-color:#1069D2;color:white;border-radius:4px;';}?>">Upcomming <?php if($count_service_upcomming != 0){echo '<span style="color:orange;">('.$count_service_upcomming.')</span>';}?></div>
    		<?php
    			$con = [
    			    'isexpired' => 1,
					'orderby' => 'a.created',
					'orderby_res' => 'DESC'
    			];
    			$count_service_past = $this->ServiceModel->get_service_list($con, 1);
			?>
    		<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/welcome/product?entrytype=2'?>';" style="cursor:pointer;float:left;line-height:30px;padding:0px 20px;<?php if($entrytype != '' && $entrytype == 2){echo 'background-color:#1069D2;color:white;border-radius:4px;';}?>">Past <?php if($count_service_past != 0){echo '<span style="color:#CCC;">('.$count_service_past.')</span>';}?></div>
    	</div>
    	
    	<div class="section_box_body">
    		<div class="section_box_body_title">
				<div style="width: 60px;float: left;">
					S/N
				</div>
    			<div style="width: calc(100%  / 6);float: left;">
    				Product Name
    			</div>
    			<div style="width: calc(100%  / 6);float: left;">
    				Picture
    			</div>
				<div style="width: calc(100%  / 6);float: left;">
					Hygienist
				</div>
				<div style="width: calc(100%  / 6);float: left;">
					Date / Time
				</div>
				<div style="width: calc(100%  / 6);float: left;">
					Status
				</div>
				<div style="width: calc(100%  / 6 - 60px);float: left;">
					Price
				</div>
    		</div>
            <?php if(isset($service_list)){for ($i = 0; $i < count($service_list); $i++) {?>
				<div class="section_box_body_section">
					<div style="width: 60px;float: left;">
						<?php echo ($i + 1)?>
					</div>
					<div style="width: calc(100%  / 6);float: left;">
						<?php echo $service_list[$i]['service_type_name'.$this->langtype]?>
					</div>
					<div style="width: calc(100%  / 6);float: left;">
						<img style="width: 52px;float:left;margin-left: calc(50% - 26px);cursor: pointer;" src="<?php echo base_url().$service_list[$i]['dentist_avatar']?>" />
					</div>
					<div style="width: calc(100%  / 6);float: left;">
						 <?php echo $service_list[$i]['dentist_name']?>
					</div>
					<div style="width: calc(100%  / 6);float: left;color: #1069D2;">
						<?php $date_time = strtotime($service_list[$i]['date_time']);?>
                            <?php echo date('D, d M, Y', $date_time)?><br>
                            <?php echo $service_list[$i]['start_time'].' - '.$service_list[$i]['end_time']?>
					</div>
					<div style="width: calc(100%  / 6);float: left;">
						<?php 
							if($service_list[$i]['status_id'] == 6){
								//判断有没有被 booking
								$con = [
									'clinic_id'=>$service_list[$i]['store_id'],
									'time_slots_id'=>$service_list[$i]['id'],
									'orderby'=>'o.status_id ASC,o.created',
									'orderby_res'=>'DESC',
									'statusin'=>'8,10'
								];
								$order_list = $this->OrderModel->get_order_list($con);
								if(!empty($order_list)){
									if($order_list[0]['payment_method'] == 1){
										echo '<span style="color:gray;">Paid</span>';
									}else if($order_list[0]['payment_method'] == 2){
										echo '<span style="color:orange;">Booked</span>';
									}
								}else{
									if(strtotime($service_list[$i]['date_time'].' '.$service_list[$i]['start_time']) > mktime()){
										echo '<span style="color:#49C496;">Available</span>';
									}else{
										echo '<span style="color:red;">Expired</span>';
									}
								}
							}else if($service_list[$i]['status_id'] == 7){
								echo '<span style="color:red;">Offline</span>';
							}else if($service_list[$i]['status_id'] == 16){
								echo '<span style="color:red;">Unavailable (Booking)</span>';
							}else{
								echo $service_list[$i]['status_id'];
							}
						?>
					</div>
					<div style="width: calc(100%  / 6 - 60px);float: left;position: relative;color: #1069D2;">
						<span style="float: left;">
                            <?php if($service_list[$i]['discount_price'] && $service_list[$i]['discount_price']!=0){echo '$'.floatval($service_list[$i]['discount_price']);}else{echo '$'.floatval($service_list[$i]['normal_price']);}?>CAD</span>
                            <?php if($service_list[$i]['discount_price'] && $service_list[$i]['discount_price']!=0 && $service_list[$i]['normal_price']){?>
                                <span style="float: left;margin-left: 20px;text-decoration:line-through;color:#999;"><?php echo '$'.floatval($service_list[$i]['normal_price']);?>CAD</span>
                            <?php }?>
					</div>
				</div>
			<?php }}?>
			
                  
    	</div>
    </div>
</div>
<div style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: rgb(0,0,0,0.5);z-index: 2000;display: none;" class="pay_box pay_box3">
	<table style="width: 100%;height: 100%;">
		<tr>
			<td>
				<div style="width:350px;border-radius: 10px;margin: auto;overflow: hidden;background-color: white;;">
					<div style="width: 100%;float: left;height: 56px;font-weight: bold;line-height:56px;font-size: 16px;color: #1069D2;text-align: center;position: relative;">

						<img class="delete_btn" style="width: 28px;position: absolute;top:15px;right:20px;cursor: pointer;"  src="<?php echo base_url().'themes/default/images/de.png'?>" alt="">
					</div>
					<div style="width: calc(100% - 40px);padding:0 20px;float: left;font-weight: bold;font-size: 16px;color: #101010;text-align: left;position: relative;">
						Clinic Approval
					</div>
					<div style="width: calc(100% - 40px);padding:0 20px;float: left;font-weight: bold;font-size: 12px;color: #666666;text-align: left;position: relative;margin-top:18px;">
						Are you sure you want to approve this clinic?
					</div>
					<div style="width: 100% ;float: left;">
						<div class="view_btn" style="width: 143px;cursor:pointer;height: 46px;line-height: 46px;float: left;font-size: 12px;color: white;text-align: center;margin-top:18px;background-color: #1069D2;margin-left:20px;border-radius:4px;margin-bottom: 28px;;">
							Approve
						</div>
						<div class="cancel" style="width: 143px;cursor:pointer;height: 46px;line-height: 46px;float: left;font-size: 12px;color: white;text-align: center;margin-top:18px;background-color: #CF1322;margin-left:20px;border-radius:4px;margin-bottom: 28px;;">
							pending
						</div>
					</div>
					
				</div>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	$(".more_btn").click(function(){
		$(".more_box").css("display","block")
	})
	$(".cancel,.delete_btn").click(function(){
	    $(".pay_box").css("display","none")
	})
	
	$(".approve_btn").click(function(){
	    $(".pay_box").css("display","none")
	    $(".pay_box3").css("display","block")
	})
</script>
