<?php $this->load->view('admin/header')?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input.min.css">
<script src="<?php echo base_url()?>themes/default/js/upload.js?date=<?php echo CACHE_USETIME()?>"></script>
<script src="<?php echo base_url()?>themes/default/js/num-alignment.js?date=<?php echo CACHE_USETIME()?>"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/swiper.min.css?date=<?php echo CACHE_USETIME()?>" />
<script src="<?php echo base_url()?>themes/default/js/swiper.min.js?date=<?php echo CACHE_USETIME()?>"></script>
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

<link rel="stylesheet" type="text/css" id=cal_style  href="<?php echo base_url()?>themes/default/flatpickr/flatpickr.min.css?date=<?php echo CACHE_USETIME()?>" />
<script async onload="fp_ready()"  src="<?php echo base_url()?>themes/default/flatpickr/flatpickr.js?date=<?php echo CACHE_USETIME()?>" ></script>
<style>
    html,body{background-color: #F2F5F9;}
	.cur_year{text-indent: 0 !important;}
    .personal_body{width:calc(100% - 180px);margin-left:180px;;float:left;margin-top:69px;background-color: #F2F5F9;;}
</style>
<script>
	Checkbix.init();
</script>

<style>
	.cur_year{text-indent: 0 !important;}
	input::-webkit-input-placeholder { /* WebKit browsers 适配谷歌 */
	    color: #999999;
	}
	
</style>
<style>
	.cur_year{text-indent: 0 !important;}
	html,body{background-color:#F5F8F9 ;}
@media screen and (max-width: 1000px) { 
	.search_body_banner{float:left;width:100%;margin-top:86px;background:none;padding-bottom:0;}
}
@media screen and (min-width: 1000px) { 
    .search_body_banner{float:left;width:100%;margin-top:124px;background:none;padding-bottom:0;}
}
.swiper-container{width:100%;height: 100%;}
.swiper-slide {
	text-align: center;
	font-size: 18px;
   
	position: relative;
	/* Center slide text vertically */
	display: -webkit-box;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
	-webkit-box-pack: center;
	-ms-flex-pack: center;
	-webkit-justify-content: center;
	justify-content: center;
	-webkit-box-align: center;
	-ms-flex-align: center;
	-webkit-align-items: center;
	align-items: center;
	flex-wrap: wrap;
  }
</style>
<div class="personal_body" style="">
    <div class="personal_oreder_body">
    	<div class="header_box_section">
    		<div class="title" style="border: none;width:300px;">
				<div style="float: left;font-size: 16px;color: #999999;">Clinic >> </div>
				<div style="float: left;font-size: 16px;margin-left:0px;"><?php echo $store_info['store_name'.$this->langtype]?></div>
    		</div>
    		<div class="search_box" style="width: calc(100% - 301px);">
    			
    			<div class="search_section" style="margin-top:0;padding:20px 0;padding-left: 20px;cursor: pointer;" onclick="javascript:location.href='<?php echo base_url().'index.php/admins/welcome/clinic_edit';?>';">
    				 <img style="width: 18px;float: left;    position: initial;"  src="<?php echo base_url().'themes/default/images/edit.png'?>" alt="">
    				 <span style="color: #1069D2;font-size: 14px;margin-left: 10px;float:left;;">Edit</span>
    			</div>
    			<div class="search_section" style="border-right: 1px solid rgba(214,224,237,1);padding:20px 0;margin-top:0;padding-right: 20px;;">
    				<input onclick="change_status()" id="" name="status" type="checkbox" class="mgc-switch" value="" style="width: 36px;float: left;"  />
					<span style="color: gray;font-size: 14px;float:left;margin-left:10px;;">Online</span>
    			</div>
				
    		</div>
    	</div>
    	
    	<div class="section_box_body clinics_detail_body">
    		<div class="section_box_body_title clinics_detail_body_section" style="max-width: 100%;">
				<div class="left_box">
					<div class="box">
						<?php 
							$store_picture = $this->ClinicModel->get_store_picture($store_info['id']);
						?>
						<div class="box_bg" style="position:relative;">
							<div style="width: 100%;height: 100%;position: absolute;top:0;left:0;">
								<div class="swiper-container swiper-container1">
									<div class="swiper-button-prev"></div>
									<div class="swiper-button-next"></div>
								    <div class="swiper-wrapper">
								    	<?php if(!empty($store_picture)){for ($i = 0; $i < count($store_picture); $i++) {?>
				                        	<div class="swiper-slide" style="background:url(<?php echo base_url().$store_picture[$i]['picture_pic']?>) center center / cover no-repeat;position:relative;"></div>
								    	<?php }}?>
								    </div>
								    <!-- Add Pagination -->
								    <div class="swiper-pagination"></div>
								</div>
							</div>
						</div>
						<div class="box_title">
							<div class="title"> 
								<div class="title_title"><?php echo $store_info['store_name'.$this->langtype]?></div>
								<?php
									$sql = "SELECT * FROM ".DB_PRE()."store_insurance_type WHERE parent != 0";
									$insurance_type_list = $this->db->query($sql)->result_array();
									if($insurance_type_list){
						                for ($aaa = 0; $aaa < count($insurance_type_list); $aaa++) {
						                    if(in_array($insurance_type_list[$aaa]['id'], explode(',', $store_info['insurance_type_id']))){
						                        echo '<div class="title_text" style="margin-right:3px;">'.$insurance_type_list[$aaa]['insurance_type_name'.$this->langtype].'</div>';
						                    }
						                }
						            }
						        ?>
							</div>
							<div class="btn">
								<div class="table">
									<?php 
										$con = array(
											'store_id' => $store_info['id'],
											'orderby' => 'a.date_time',
											'orderby_res' => 'DESC',
											'status' => 6
										);
										$service_list = $this->ServiceModel->get_service_list($con);
										if($service_list){
											$min_price = 0;
											foreach ($service_list as $k1=>$v1){
												if($v1['discount_price'] && $v1['discount_price'] <> 0){
													$temp = min($v1['normal_price'],$v1['discount_price']);
												}else{
													$temp = $v1['normal_price'];
												}
												if($temp){
													if($k1 == 0 || $min_price > $temp){
														$min_price = $temp;
													}
												}
											}
											$min_price = floatval($min_price);
										
										}else{
											$min_price = 0;
										}
									?>
									<div class="title">Starting form</div>
									<div class="price">$<?php echo $min_price?></div>
											
								</div>
							</div>
						</div>
						<div class="box_name">
				            <div style="float:left;">
                                <?php echo $store_info['store_address'.$this->langtype]?>
                            	<span style="color:#CCC;">&nbsp;&nbsp;<?php echo $store_info['city_name'].', '.$store_info['province_name']?></span>
                            </div>
						</div>
						<div class="box_section">
							<?php echo $store_info['store_description'.$this->langtype]?>
						</div>
					</div>
				</div>
				<div class="right_box">
					<div style="width: calc(50% - 69px);padding:30px;border-radius: 8px;background-color: white;float: left;margin-top:0px;">
						<div style="width: 100%;font-size: 20px;float:left;font-weight: 700;height: 38px;text-align: left;color: #101010;">
							Product
						</div>
						<?php 
							$con = array(
								'store_id' => $store_info['id'],
								'orderby' => 'a.date_time',
								'orderby_res' => 'DESC'
							);
							$service_list = $this->ServiceModel->get_service_list($con);
							$count_service = $this->ServiceModel->get_service_list($con, 1);
						?>
						<div style="width: calc(100% - 1px);float:left;margin-top:50px;display: flex;justify-content: space-between;align-items: center;">
							<div style="float:left;margin-top:50px;">
								<div style="width: 100%;font-size: 60px;color: #1069D2;">
					               <?php echo $count_service;?>
								</div>
								<div style="width: 100%;font-size: 12px;color: #999999;">
									Number of online products
								</div>
							</div>
						</div>
						<div style="float:left;margin-top:50px;cursor: pointer;">
							<div style="float: left;height: 39px;line-height: 39px;text-align: center;color: black;background: #f2f5f9;border-radius: 4px;padding:0 10px;font-size: 14px;" onclick="location.href='<?php echo base_url().'index.php/clinic/welcome/clinics_service'?>'">
								Manage Products
							</div>
							<img style="width: 37px;float: left;"  src="<?php echo base_url().'themes/default/images/clinic_today_booking_more.png'?>" alt="">
						</div>
					</div>
					<div style="width: calc(50% - 69px);padding:30px;border-radius: 8px;background-color: white;float: left;margin-left:16px;">
						<div style="width: 100%;font-size: 20px;float:left;font-weight: 700;">
							<div style="position: relative;float: left;width: calc(50% - 20px);">
								<img style="width: 14px;float: left;margin-top:12px;position: absolute;top:1px;;z-index: 2;left: 5px;"  src="<?php echo base_url().'themes/default/images/date_li.png'?>" alt="">
							
								<input id="flatpickr-tryme" name="date_time" value="" placeholder="Please pick a data" data-date-format="Y-m-d" style="width: calc(100% - 62px);border: 1px solid #DEDEDE;padding:0px 30px;float: left;border-radius:4px;color:#999999;height: 36px;">
							</div>
							<div style="position: relative;float: left;width:40px;margin-top:5px;text-align: center;">
								-
							</div>
							<div style="position: relative;float: left;width: calc(50% - 20px);">
								<img style="width: 14px;float: left;margin-top:12px;position: absolute;top:1px;;z-index: 2;left: 5px;"  src="<?php echo base_url().'themes/default/images/date_li.png'?>" alt="">
							
								<input id="flatpickr-tryme2" name="date_time" value="" placeholder="Please pick a data" data-date-format="Y-m-d" style="width: calc(100% - 62px);border: 1px solid #DEDEDE;padding:0px 30px;float: left;border-radius:4px;color:#999999;height: 36px;">
							</div>
						</div>
						<?php 
							$con = [
								'clinic_id'=>$store_info['id'],
								'orderby'=>'o.status_id ASC, o.created',
								'orderby_res'=>'DESC',
								'statusin'=>'8, 10'
							];
							$count_order = $this->OrderModel->get_order_list($con, 1);
						?>
						<div style="width: calc(100% - 1px);float:left;margin-top:50px;display: flex;justify-content: space-between;align-items: center;">
							<div style="float:left;margin-top:50px;">
								<div style="width: 100%;font-size: 60px;color: #1069D2;">
					                <?php echo $count_order;?>
								</div>
								<div style="width: 100%;font-size: 12px;color: #999999;">
									Number of Bookings
								</div>
							</div>
						</div>
						<div style="float:left;margin-top:50px;cursor: pointer;">
							<div style="float: left;height: 39px;line-height: 39px;text-align: center;color: black;background: #f2f5f9;border-radius: 4px;padding:0 10px;font-size: 14px;;">
								More
							</div>
							<img style="width: 37px;float: left;"  src="<?php echo base_url().'themes/default/images/clinic_today_booking_more.png'?>" alt="">
						</div>
					</div>
					<div style="width: calc(100% - 40px);float:left;padding:20px;border-top:1px solid #D6E0ED;border-bottom: 1px solid #D6E0ED;margin-top:27px;margin-bottom:27px;display: flex;justify-content: space-between;align-items: center;">
						<div style="color: #1069D2;font-size: 16px;">
							Products List
						</div>
						<div style="color: #1069D2;width: 188px;position: relative;float: left;    ">
							<img style="width: 12px;float: left;left: 0px;position: absolute;z-index: 1;top: 13px;    " src="<?php echo base_url().'themes/default/images/clinic_reach.png'?>" />
							<input type="text" name="keyword" placeholder="Search" value="" style="width: 188px;float: left;border-radius: 18px;margin-left: -10px;text-indent: 30px;    padding-right: 20px;"/>
						</div>
					</div>
					<?php 
						$con = ['user_type_id' => 4, 'store_id'=>$store_info['id']];
						$dentist_list = $this->UserModel->get_user_list($con);
					?>
					<?php if(!empty($dentist_list)){for ($i = 0; $i < count($dentist_list); $i++) {?>
						<div class="doctor_box" style="margin-top:0;">
						    <div class="box_header">
						        <div class="box_header_bg" style="background:url(<?php echo base_url().$dentist_list[$i]['dentist_avatar']?>) center center / cover no-repeat;position:relative;"></div>
						        <div class="box_header_text">
						            <div class="title"> <?php echo $dentist_list[$i]['dentist_name']?></div>
						            <div class="year"><?php echo $dentist_list[$i]['dentist_work']?> Years Exp</div>
						        </div>
						    </div>
							<?php 
							
								$date_arr = array();
							
								$con = [
									'store_id' => $store_info['id'],
									'dentist_id' => $dentist_list[$i]['uid'],
									'orderby' => 'a.created',
									'orderby_res' => 'DESC'
								];
								$service_list = $this->ServiceModel->get_service_list($con);
							?>
							<?php if(!empty($service_list)){for ($j = 0; $j < count($service_list); $j++) {?>
								<?php $date_time = strtotime($service_list[$j]['date_time']);?>
								<?php 
									$isadd = 1;
									if(!empty($date_arr)){
										for ($d = 0; $d < count($date_arr); $d++) {
											if($date_arr[$d] == date('Y-m-d', $date_time)){
												$isadd = 0;
											}
										}
									}
								?>
								<?php if($isadd == 1){?>
									<div class="box_center">
										<div class="time" style="text-align: left;color: #101010;">
											<?php echo date('D, d M, Y', $date_time)?>
										</div>
									</div>
									<?php $date_arr[] = date('Y-m-d', $date_time)?>
								<?php }?>
								<div class="line_box" style="text-align: left;">
									<div class="time"><?php echo $service_list[$j]['start_time'].' - '.$service_list[$j]['end_time']?></div>
									<div class="text">
										<?php echo $service_list[$j]['service_type_name'.$this->langtype]?>
									</div>
									<div class="price">
										  <span style="float: left;">
				                            <?php if($service_list[$j]['discount_price'] && $service_list[$j]['discount_price']!=0){echo '$'.floatval($service_list[$j]['discount_price']);}else{echo '$'.floatval($service_list[$j]['normal_price']);}?>CAD</span>
				                            <?php if($service_list[$j]['discount_price'] && $service_list[$j]['discount_price']!=0 && $service_list[$j]['normal_price']){?>
				                                <span style="float: left;margin-left: 20px;text-decoration:line-through;;"><?php echo '$'.floatval($service_list[$j]['normal_price']);?>CAD</span>
				                            <?php }?>
									</div>
								</div>
							<?php }}?>
							<div class="line_box" style="text-align: left;">
								<div class="time">09:00am - 10:30am</div>
								<div class="text">Cleaning & Polish</div>
								<div class="price">
								  $150/<span style="text-decoration:line-through">$250</span>
								</div>
							</div>
						</div>
					<?php }}?>
				</div>
			</div>    
    	</div>
    </div>
</div>

<script type="text/javascript">
	$(".more_btn").click(function(){
		$(".more_box").css("display","block")
	})
</script>
<script>
var swiper = new Swiper('.swiper-container1', {
  loop : true,
  autoplay:true,
  centeredSlides: true,
  // autoplay: 1000,
  speed:1000,

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
var swiper = new Swiper('.swiper-container2', {
	slidesPerView: 2,
	spaceBetween: 30,
	
});
</script>
