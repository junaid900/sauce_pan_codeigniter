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
//                     $(".digital1").css({"color":"#1069D2","borderColor":"#1069D2"});
                    $(".digital1").css({"color":"black","borderColor":"#1069D2"});
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
    $date_time = $this->input->get('date_time');
    $clinic_id = $this->input->get('clinic_id');
    $patient_name = $this->input->get('patient_name');
    $service_type_id = $this->input->get('service_type_id');
    $keyword = $this->input->get('keyword');
?>

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
        			    'orderby'=>'o.status_id ASC, o.created',
        			    'orderby_res'=>'DESC',
        			    'statusin'=>'8,10'
        			];
        			$total_bookings = $this->OrderModel->get_order_list($con, 1);
    			?>
    			<div style="float: left;"><?php echo $total_bookings;?></div>
    			<div style="float: left;font-size: 14px;color: #999999;margin-left:10px;">Total bookings</div>
    		</div>
    		<div class="search_box">
    			<div class="title" style="align-items: center;">
                    <img style="width: 14px;float: left;position: relative;z-index: 2;margin-left: 10px;"  src="<?php echo base_url().'themes/default/images/date_li.png'?>" alt="">

					<div style="float: left;width: 160px;position: relative;margin-left:-24px;">
						<div onclick="toggle_calendar_common('date_time')" style="width:160px;float:left;height: 35px;line-height: 35px;cursor: pointer;;padding:0 0px;color:#999999 ;font-size: 12px;text-indent: 30px;    border-radius: 4px;border-radius: 4px;  border: 1px solid #DEDEDE;color: #999999;background-color: white;;" class="data_box">
						    <?php if($date_time){echo $date_time;}else{?>
						        <?php if($this->langtype=='_en'){echo "Date";}else{echo "Toutes les dates";}?>
						    <?php }?>
						</div>
						
						<div style="float:left;width:100%;display:none;"><input type="text" isopten="0" name="date_time" id="date_time" value="<?php if($date_time){echo $date_time;}?>" readOnly="true" style="width: 100%;height: 100%;position: absolute;top:0;left:0;opacity: 0;"/></div>
						<div style="display:none;position: absolute;top:0;left:0;width:320px;margin:40px 0px 0px 0px;font-weight:normal;z-index: 1;" id="date_time_area">
							
						</div>
					</div>
					<script>
						function toggle_calendar_common(id){
							
							var isopten=$('#'+id).attr('isopten');
							if(isopten == 0){
								var default_val=$('#'+id).val();
								$('#'+id+'_area').show().html('<img style="float:left;width:20px;height:20px;" src="<?php echo base_url()?>themes/default/images/ajax_loading.gif"/>');
								$.post(baseurl+'index.php/welcome/toremind_calendar',{id:id,default_val:default_val},function (data){
									$('#'+id+'_area').show().html(data);
									$('#'+id+'_error').html('');
									$('#'+id).attr('isopten', 1);
								});
							}else{
								$('#'+id+'_area').hide().html('');
								$('#'+id+'_error').html('');
								$('#'+id).attr('isopten',0);
							}
						}

						function toclear_calendar(id){
							$('#'+id+'_area').hide().html('');
							$('#'+id+'_error').html('');
							$('#'+id).attr('isopten',0);

							$('div[onclick="toggle_calendar_common(\'date_time\')"]').html('Date');

							$('#'+id).val('');

							$('#ico_date_show').show();
							$('#ico_date_clear').hide();
							
						}
						
						function toremind_getrilidatatoinput(id,year,month,day){
							$(".data_box").css("color","black")
							if(day<10){
								var day_show='0'+day;
							}else{
								var day_show=day;
							}
							$('#'+id).val(year+'-'+month+'-'+day_show);

							$('div[onclick="toggle_calendar_common(\'date_time\')"]').html(year+'-'+month+'-'+day_show);

							$('#ico_date_show').hide();
							$('#ico_date_clear').show();
							
							var timee = year+'-'+month+'-'+day_show;
							var timeetest= new Date(Date.parse(timee.replace(/-/g,   "/"))); //转换成Data();
							
							toggle_calendar_common(id);
						}
						
						function toremindcalendar_month(id,year,month){
							$.post(baseurl+'index.php/welcome/toremind_calendar/'+year+'/'+month,{id:id},function (data){
								$('#'+id+'_area').html(data);
							});
						}

						// $('body').click(function (){
						// 	if($('#search_auto').css('display') == 'none'){

						// 	}else{
						// 		toclose_keywordbox();
						// 	}

						// 	if($('#date_time_area').css('display') == 'none'){

						// 	}else{
						// 		$('#date_time_area').hide().html('');
						// 		$('#date_time_error').html('');
						// 		$('#date_time').attr('isopten', 0);
						// 	}

						// })
						function toclose_keywordbox(){
							$('#search_auto').fadeOut(100);
							
						}
					</script>
                </div>
                <div class="search_select" style="position: relative;width: 150px; height: 23px;;font-size: 14px; line-height: 35px;padding: 6px 0px 6px 10px;background-color: white;">
						<div class="service_text2"style="z-index:2;width:160px;<?php if($service_type_id){echo 'display:none;';}?>;float:left;position: absolute;top:0;left:0;height: 100%;;padding:0 0px;<?php if($service_type_id != '' && $service_type_id != 0){echo 'color:black;';}else{echo 'color:#999999;';}?>font-size: 12px;text-indent: 20px;   ">
							<?php if($this->langtype=='_en'){echo "All Service";}else{echo "Tous les services";}?>
						</div>
						<div class="service_btn2" style="z-index:3;width:160px;float:left;position: absolute;top:0;left:0;height: 100%;cursor: pointer;;padding:0 0px;<?php if($service_type_id != '' && $service_type_id != 0){echo 'color:black;';}else{echo 'color:#999999;';}?>font-size: 12px;text-indent: 20px;    border-radius: 4px;border-radius: 4px;background: url(<?php echo base_url()?>themes/default/images/select_arrow_blue.png) no-repeat scroll right center rgba(255,255,255,0);    border: 1px solid #DEDEDE;">
							<?php if($service_type_list){
							    foreach ($service_type_list as $key=>$value){
							        $is_selected = '';
							        if($service_type_id && $service_type_id == $value['id']){
							            $is_selected = 'display:block';
							        }
							
							        ?>
									<span style="display:none;<?php echo $is_selected;?>"><?php echo $value['service_type_name'.$this->langtype]?></span>
									<?php
								}
							}?>
						</div>
						<input type="hidden" name="service_type_id" value="0"/>
						
						<div class="service_section_box2" style="display:none;width: 160px;float:left;position: absolute;top:39px;left:1px;;padding:0 0px;background-color: white;font-size: 12px;z-index: 1;;">
							<?php if($service_type_list){
							    foreach ($service_type_list as $key=>$value){
							        ?>
								<div class="boxs" style="width: calc(100% - 20px);float:left;padding:5px 10px;text-align: left;" id="<?php echo $value['id']?>" class="select_div_box">
									<?php echo $value['service_type_name'.$this->langtype]?>
								</div>
								<?php
									}
							}?>
							<div class="close_btn2" style="width: calc(100% - 20px);float:left;text-align: center;padding:0 10px;text-align: right;height: 25px;line-height: 25px;;" id="" class="select_div_box">
								Close
							</div>
							
						</div>
					</div>
    			<div class="search_select">
    				<?php 
        				if($clinic_id != '' && $clinic_id != 0){
        				    $thiscolor = 'color:black;';
        				}else{
        				    $thiscolor = 'color:#999999;';
        				}
    				?>
    				<select name="clinic_id" onchange="tochoose_clinic_id(this.value)" style="float: left;background: url(<?php echo base_url()?>themes/default/images/select_arrow_blue.png) no-repeat scroll right center rgba(255,255,255,1);appearance: none;-moz-appearance: none;-webkit-appearance: none;width:158px;height: 35px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;<?php echo $thiscolor;?>">
    					<option value="0">All Clinics</option>
    					<?php 
        					if(!empty($store_list)){
        					    for ($i = 0; $i < count($store_list); $i++) {
        					        $isselected = '';
        					        if($clinic_id == $store_list[$i]['id']){
        					            $isselected = 'selected';
        					        }
        					        echo '<option value="'.$store_list[$i]['id'].'" '.$isselected.'>'.$store_list[$i]['store_name'.$this->langtype].'</option>';
        					    }
        					}
    					?>
    				</select>
    				<script>
						function tochoose_clinic_id(clinic_id){
							if(clinic_id != 0){
								$('select[name="clinic_id"]').css({'color':'black'});
							}else{
								$('select[name="clinic_id"]').css({'color':'#999999'});
							}
						}
    				</script>
    			</div>
    			
    			<div class="search_section">
    				<img style="width: 12px;" src="<?php echo base_url().'themes/default/images/clinic_reach.png'?>" />
    				<input type="text" name="keyword" placeholder="Search" value="<?php echo $keyword;?>" />
    				<input type="hidden" name="entrytype" value="<?php echo $entrytype;?>" />
                    <div onclick = "search()" style="width:100px;height: 38px;line-height: 38px;color: white;text-align: center;font-size:16px;border-radius:4px; background-color: #1069D2;float: left; margin-left: 20px;">
                        <?php if($this->langtype=='_en'){echo "Search";}else{echo "Chercher";}?>
                    </div>
    			</div>

    		</div>
    	</div>
    	

    	
    	<div style="float:left;width:calc(100% - 32px);margin-left:16px;margin-top:20px;">
    		<?php 
    			$con = [
    			    'orderby'=>'o.status_id ASC, o.created',
    			    'orderby_res'=>'DESC',
    			    'statusin'=>'8,10'
    			];
    			$total_bookings = $this->OrderModel->get_order_list($con, 1);
    			if($entrytype == '' || $entrytype == 1){
    			    $numushow_color = 'color:#00FFFF;';
    			}else{
    			    $numushow_color = 'color:#1069D2;';
    			}
			?>
    		<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/welcome/booking?entrytype=1'?>';" style="cursor:pointer;float:left;line-height:30px;padding:0px 20px;<?php if($entrytype == '' || $entrytype == 1){echo 'background-color:#1069D2;color:white;border-radius:4px;';}?>">Booked/Paid <?php if($total_bookings != 0){echo '<span style="'.$numushow_color.'">('.$total_bookings.')</span>';}?></div>
    		<?php 
    			$con = [
    			    'orderby'=>'o.status_id ASC, o.created',
    			    'orderby_res'=>'DESC',
    			    'statusin'=>'11'
    			];
    			$total_cancelled = $this->OrderModel->get_order_list($con, 1);
    			
    			$con = [
    			    'orderby'=>'o.status_id ASC, o.created',
    			    'orderby_res'=>'DESC',
    			    'statusin'=>'11',
    			    'isrefund_status'=>0
    			];
    			$total_cancelled_pending = $this->OrderModel->get_order_list($con, 1);
			?>
    		<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/welcome/booking?entrytype=2'?>';" style="cursor:pointer;float:left;line-height:30px;padding:0px 20px;<?php if($entrytype != '' && $entrytype == 2){echo 'background-color:#1069D2;color:white;border-radius:4px;';}?>">
        		<div style="float:left;">
        			Cancelled <?php if($total_cancelled != 0){echo '<span style="color:#CCC;">('.$total_cancelled.')</span>';}?>
        		</div>
        		<?php if($total_cancelled_pending != 0){?>
            		<div style="float:left;width:1px;">
            			<div style="float:left;width:16px;margin-left:2px;">
            				<div style="float:left;width:16px;height:16px;line-height:16px;margin-top:-4px;text-align:center;border-radius:50%;background:red;color:white;font-size:12px;"><?php echo $total_cancelled_pending;?></div>
            			</div>
        			</div>
    			<?php }?>
    		</div>
    		
    	</div>
    	
    	<div class="section_box_body">
    		<div class="section_box_body_title">
				<div style="width: 60px;float: left;">
					S/N
				</div>
    			<div style="width: calc(100%  / 8);float: left;">
    				Order Number
    			</div>
				<div style="width: calc(100%  / 8);float: left;">
					User
				</div>
				<div style="width: calc(100%  / 8);float: left;">
					Order Time
				</div>
    			<div style="width: calc(100%  / 8);float: left;">
    				Product Name
    			</div>
				<div style="width: calc(100%  / 8);float: left;">
					Picture
				</div>
				<div style="width: calc(100%  / 8);float: left;">
					Hygienist
				</div>
				<div style="width: calc(100%  / 8);float: left;">
					payments
				</div>
				<div style="width: calc(100%  / 8 - 60px);float: left;">
					Type
				</div>
    		</div>
            <?php if(!empty($order_list)){for ($i = 0; $i < count($order_list); $i++) {?>
    			<div class="section_box_body_section" <?php if($order_list[$i]['status_id']==11){echo 'style="color: #999999;"';}?>>
    				<div style="width: 60px;float: left;">
    					<?php echo ($i + 1)?>
    				</div>
    				<div style="width: calc(100%  / 8);float: left;">
    					<?php echo actionsearchdaxiaoxiezimu($keyword, $order_list[$i]['order_number']);?>
    				</div>
    				<div style="width: calc(100%  / 8);float: left;">
    					<?php if($order_list[$i]['user_name']){?>
                            <?php echo $order_list[$i]['user_name']?><br>
                        <?php }else{?>
                            <?php echo $order_list[$i]['first_name'].' '.$order_list[$i]['last_name']?><br>
                        <?php }?>
                        <?php echo $order_list[$i]['user_email']?>
    				</div>
    				<div style="width: calc(100%  / 8);float: left;">
                        <?php echo date('D, d M, Y', $order_list[$i]['created'])?>
                        <br />
                        <?php echo date('H:i:s', $order_list[$i]['created'])?>
    				</div>
    				<div style="width: calc(100%  / 8);float: left;">
    					<?php echo actionsearchdaxiaoxiezimu($keyword, $order_list[$i]['service_type_name'.$this->langtype])?>
    				</div>
    				<div style="width: calc(100%  / 8);float: left;">
    					<img style="float:left;width: 52px;height:52px;border-radius:4px;margin-left: calc(50% - 26px);cursor: pointer;" src="<?php echo base_url().$order_list[$i]['dentist_avatar']?>" />
    				</div>
    				<div style="width: calc(100%  / 8);float: left;">
    					<?php echo $order_list[$i]['dentist_name']?>
    				</div>
    				<div style="width: calc(100%  / 8);float: left;color: #1069D2;line-height:18px;font-size:12px;">
    					<div style="display:none;float: left;width:100%;">
        					<?php if($order_list[$i]['discount_price'] && $order_list[$i]['discount_price']!=0){?>
                                $<?php echo $order_list[$i]['discount_price']?>CAD<br>
                                <span style="text-decoration:line-through;">$<?php echo $order_list[$i]['normal_price']?>CAD</span>
                            <?php }else{?>
                                $<?php echo $order_list[$i]['normal_price']?>CAD
                            <?php }?>
                        </div>
                        
                        <?php if($order_list[$i]['payment_method'] == 1){?>
                        	<div style="float: left;width:100%;"><span style="color:gray;">Service:</span> <?php echo ($order_list[$i]['total_price'] - $order_list[$i]['booking_price'] - $order_list[$i]['booking_tpstax'] - $order_list[$i]['booking_tvqtax'])?> CAD</div>
                        <?php }else if($order_list[$i]['payment_method'] == 2){?>
                        	<div style="float: left;width:100%;"><span style="color:gray;">Service:</span> <span style="color:red;">(Pay at clinic)</span> <?php if($order_list[$i]['discount_price'] && $order_list[$i]['discount_price']!=0){echo floatval($order_list[$i]['discount_price']);}else{echo floatval($order_list[$i]['normal_price']);}?> CAD</div>
                        <?php }?>
                        <div style="float: left;width:100%;"><span style="color:gray;">Booking:</span> <?php echo $order_list[$i]['booking_price']?> CAD</div>
                        <div style="float: left;width:100%;"><span style="color:gray;">TPS Tax:</span> <?php echo $order_list[$i]['booking_tpstax']?> CAD</div>
                        <div style="float: left;width:100%;"><span style="color:gray;">TVQ Tax:</span> <?php echo $order_list[$i]['booking_tvqtax']?> CAD</div>
                        
                        <?php if($order_list[$i]['payment_method'] == 1){?>
                        	<div style="float: left;width:100%;"><span style="color:gray;">Total:</span> <?php echo $order_list[$i]['total_price']?> CAD</div>
                        	<div style="float: left;width:100%;"><span style="color:gray;">Amount Due:</span> 0 CAD</div>
                        <?php }else if($order_list[$i]['payment_method'] == 2){?>
                        	<div style="float: left;width:100%;"><span style="color:gray;">Total:</span> <?php echo ($order_list[$i]['booking_price'] + $order_list[$i]['booking_tpstax'] + $order_list[$i]['booking_tvqtax'])?> CAD</div>
                            <div style="float: left;width:100%;"><span style="color:gray;">Amount Due:</span> <?php if($order_list[$i]['discount_price'] && $order_list[$i]['discount_price']!=0){echo floatval($order_list[$i]['discount_price']);}else{echo floatval($order_list[$i]['normal_price']);}?> CAD</div>
                        <?php }?>
    				</div>
    				<div style="width: calc(100%  / 8 - 60px);float: left;position: relative;color: #1069D2;">
    					<?php if($order_list[$i]['status_id'] == 8){ ?>
                            <?php if($order_list[$i]['payment_method'] == 1){?>
		                        <span style="width: 100px;float: left;color: #1069D2;" class="edit_btn">
                                    Paid
                                </span>
	                        <?php }else if($order_list[$i]['payment_method'] == 2){?>
		                        <span style="width: 100px;float: left;color: orange;" class="edit_btn">
                                    Booked
                                </span>
	                        <?php }?>
                        <?php }else if($order_list[$i]['status_id'] == 10){ ?>
                            <span style="width: 100px;float: left;color: #1069D2;" class="edit_btn">
                                Done
                            </span>
                        <?php }elseif($order_list[$i]['status_id'] == 11){?>
                        	<div style="float: left;width:100%;">
                                <span style="width: 100px;float: left;color: #CF1322;" class="edit_btn">
                                    Cancelled
                                </span>
                            </div>
                            <?php if($order_list[$i]['isrefund_status'] == 0){?>
                                <div style="float: left;width:100%;margin-top:3px;">
                                    <span onclick="tosetto_refund(<?php echo $order_list[$i]['id'];?>, '<?php echo $order_list[$i]['order_number'];?>')" style="float: left;width: 100%;font-size:12px;line-height:17px;padding:5px 0px;cursor:pointer;background-color: #CF1322;color:white;border-radius:4px;">
                                       	Set to refunded
                                    </span>
                                </div>
                            <?php }?>
                        <?php }?>
    				</div>
    			</div>
			<?php }}?>
			
                  
    	</div>
    </div>
</div>
<script>
	var current_order_id = 0;
	function tosetto_refund(order_id, order_number){
		current_order_id = order_id;
		$('.refundbox3').show();
		$('.refund_ordernumber_show').html('['+order_number+']');
	}
	function setto_refund(){
		$('.btn_refund_submit').hide();
		$('.btn_refund_loading').show();
		$.post(baseurl+'index.php/admins/welcome/setto_refundorder/'+current_order_id, function (data){
			location.reload();
		})
	}
</script>
<div style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: rgb(0,0,0,0.5);z-index: 2000;display: none;" class="pay_box refundbox3">
	<table style="width: 100%;height: 100%;">
		<tr>
			<td>
				<div style="width:350px;border-radius: 10px;margin: auto;overflow: hidden;background-color: white;;">
					<div style="width: 100%;float: left;height: 56px;font-weight: bold;line-height:56px;font-size: 16px;color: #1069D2;text-align: center;position: relative;">

						<img class="delete_btn" style="width: 28px;position: absolute;top:15px;right:20px;cursor: pointer;"  src="<?php echo base_url().'themes/default/images/de.png'?>" alt="">
					</div>
					<div style="width: calc(100% - 40px);padding:0 20px;float: left;font-weight: bold;font-size: 16px;color: #101010;text-align: left;position: relative;">
						Set to refunded
					</div>
					<div style="width: calc(100% - 40px);padding:0 20px;float: left;font-weight: bold;font-size: 12px;color: #666666;text-align: left;position: relative;margin-top:18px;">
						Are you sure you want to set this order <span class="refund_ordernumber_show" style="color:red;"></span> to refunded?
					</div>
					<div style="width: 100% ;float: left;">
						<div class="btn_refund_submit" onclick="setto_refund()" style="width: 143px;cursor:pointer;height: 46px;line-height: 46px;float: left;font-size: 12px;color: white;text-align: center;margin-top:18px;background-color: #1069D2;margin-left:20px;border-radius:4px;margin-bottom: 28px;;">
							OK
						</div>
						<div class="btn_refund_loading" style="display:none;width: 143px;cursor:pointer;height: 46px;line-height: 46px;float: left;font-size: 12px;color: gray;text-align: center;margin-top:18px;background-color: #EFEFEF;margin-left:20px;border-radius:4px;margin-bottom: 28px;;">
							Loading
						</div>
						<div class="cancel" style="width: 143px;cursor:pointer;height: 46px;line-height: 46px;float: left;font-size: 12px;color: white;text-align: center;margin-top:18px;background-color: #CF1322;margin-left:20px;border-radius:4px;margin-bottom: 28px;;">
							Cancel
						</div>
					</div>
					
				</div>
			</td>
		</tr>
	</table>
</div>
<script>
    function search() {
        var date_time = $("input[name='date_time']").val()
        var clinic_id = $('select[name="clinic_id"]').val()
        var service_type_id = $('input[name="service_type_id"]').val()
        var keyword = $('input[name="keyword"]').val()

        location.href = baseurl+ 'index.php/admins/welcome/booking?date_time='+date_time+'&clinic_id='+clinic_id+'&service_type_id='+service_type_id+'&keyword='+keyword;
    }
</script>

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
	
	
	
		$(".service_btn").click(function(){
		$(".service_section_box").css("display","block");
		
	});
	$(".close_btn").click(function(){
		$(".service_section_box").css("display","none");
		
	});
	$(".service_section_box .boxs").click(function(){
		$(".service_section_box").css("display","none");
		var service_val=$(this).text();
		var service_type_id = $(this).attr('id');
		$('input[name="clinic_id"]').val(service_type_id);
		
		console.log();
		$(".service_btn").text(service_val);
		$(".service_btn").css("color","black")
		$(".service_text").text('');
		
	})
	
	$(".service_btn2").click(function(){
		$(".service_section_box2").css("display","block");
		
	});
	$(".close_btn2").click(function(){
		$(".service_section_box2").css("display","none");
		
	});
	$(".service_section_box2 .boxs").click(function(){
		$(".service_section_box2").css("display","none");
		var service_val=$(this).text();
		var service_type_id = $(this).attr('id');
		$('input[name="service_type_id"]').val(service_type_id);
		
		console.log();
		$(".service_btn2").text(service_val);
		$(".service_btn2").css("color","black")
		$(".service_text2").text('');
		
	})
</script>
