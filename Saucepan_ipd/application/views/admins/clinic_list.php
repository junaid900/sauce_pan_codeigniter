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
                    $('input[name="date_time"]').css({'color': 'black'});
                    $(".digital1").css({"color":"#1069D2","borderColor":"#1069D2"})
                    // $(".line1").css("backgroundColor","#1069D2")
                }else{
                	$('input[name="date_time"]').css({'color': '#999'});
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
	.personal_oreder_body .header_box_section .search_box .search_add {float: left;margin-left: 20px;margin-top: 20px;background-color: #1069D2;color: #FFFFFF;font-size: 14px;width: 120px;height: 17px;padding: 9px 10px;display: flex;justify-content: space-between; align-items: center;border-radius: 4px;cursor: pointer;}
	.personal_oreder_body .header_box_section .search_box .search_add img {float: left;}
	.personal_oreder_body .header_box_section .search_box .search_add div {float: left;}
</style>
<?php 
	$sql = "SELECT * FROM ".DB_PRE()."store_insurance_type WHERE parent = 0";
	$insurance_type_list = $this->db->query($sql)->result_array();
	
	$sql = "SELECT * FROM ".DB_PRE()."service_type";
	$service_type_list = $this->db->query($sql)->result_array();
	
	
	$date_time = $this->input->get('date_time');
	$service_type_id = $this->input->get('service_type_id');
	$insurance_type_id = $this->input->get('insurance_type_id');
	$keyword = $this->input->get('keyword');
?>
<div class="personal_body" style="">
    <div class="personal_oreder_body">
    	<form id="search_form" method="get" action="<?php echo base_url().'index.php/admins/welcome/clinic';?>">
	    	<div class="header_box_section">
	    		<div class="title">
	    			<?php 
		    			$con = array();
		    			$count_allclinics = $this->ClinicModel->get_store_list($con, 1);
	    			?>
	    			<div style="float: left;"><?php echo $count_allclinics?></div>
	    			<div style="float: left;font-size: 14px;color: #999999;margin-left:10px;">Total clinics</div>
	    		</div>
	    		<div class="search_box">
	    			<div class="search_select">
	                    <div class="input_section">
	                        <img style="width: 14px;float: left;margin-top:12px;position: relative;z-index: 2;"  src="<?php echo base_url().'themes/default/images/date_li.png'?>" alt="">
	                        <input id="flatpickr-tryme" name="date_time" value="<?php echo $date_time;?>" data-default-date="<?php echo $date_time;?>" placeholder="All date" data-date-format="Y-m-d" style="width: 120px;border: 1px solid #DEDEDE;padding:0px 30px;margin-left:-20px;float: left;border-radius:4px;<?php if($date_time != ''){echo 'color:black;';}else{echo 'color:#999;';}?>height: 36px;">
	                    </div>
	    			</div>
	    			<?php 
	    				if($service_type_id != '' && $service_type_id != 0){
	    					$thiscolor = 'color:black;';	
	    				}else{
	    					$thiscolor = 'color:#999;';	
	    				}
	    			?>
	    			<div class="search_select">
	    				<select name="service_type_id" onchange="tochoose_service_type_id(this.value)" style="float: left;background: url(<?php echo base_url()?>themes/default/images/select_arrow_blue.png) no-repeat scroll right center rgba(255,255,255,1);appearance: none;-moz-appearance: none;-webkit-appearance: none;width:158px;height: 38px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;<?php echo $thiscolor;?>">
	    					<option value="0">Service Type</option>
	    					<?php 
		    					if($service_type_list){
		    						foreach ($service_type_list as $key=>$value){
		    							if($service_type_id == $value['id']){
		    								$isselected = 'selected';
		    							}else{
		    								$isselected = '';
		    							}
		    							echo '<option value="'.$value['id'].'" '.$isselected.'>'.$value['service_type_name'.$this->langtype].'</option>';
		    						}
		    					}
	    					?>
	    				</select>
	    				<script>
							function tochoose_service_type_id(service_type_id){
								if(service_type_id != '' && service_type_id != 0){
									$('select[name="service_type_id"]').css({'color': 'black'});
								}else{
									$('select[name="service_type_id"]').css({'color': '#999'});
								}
							}
	    				</script>
	    			</div>
	    			<?php 
	    				if($insurance_type_id != '' && $insurance_type_id != 0){
	    					$thiscolor = 'color:black;';	
	    				}else{
	    					$thiscolor = 'color:#999;';	
	    				}
	    			?>
	    			<div class="search_select">
	    				<select name="insurance_type_id" onchange="tochoose_insurance_type_id(this.value)" style="float: left;background: url(<?php echo base_url()?>themes/default/images/select_arrow_blue.png) no-repeat scroll right center rgba(255,255,255,1);appearance: none;-moz-appearance: none;-webkit-appearance: none;width:158px;height: 38px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;<?php echo $thiscolor;?>">
	    					<option value="0">insurance Type</option>
	    					<?php 
	    					
	    					if($insurance_type_list){for ($iii = 0; $iii < count($insurance_type_list); $iii++) {
	    						$sql = "SELECT * FROM ".DB_PRE() ."store_insurance_type WHERE parent = ".$insurance_type_list[$iii]['id'];
	    						$sub_insurance_type_list = $this->db->query($sql)->result_array();
	    						
	    						echo '<optgroup label="'.$insurance_type_list[$iii]['insurance_type_name'.$this->langtype].'">';
	    						
		    					if($sub_insurance_type_list){
		    						foreach ($sub_insurance_type_list as $key=>$value){
		    							if($insurance_type_id == $value['id']){
		    								$isselected = 'selected';
		    							}else{
		    								$isselected = '';
		    							}
		    							echo '<option value="'.$value['id'].'" '.$isselected.'>'.$value['insurance_type_name'.$this->langtype].'</option>';
		    						}
		    					}
		    					echo '</optgroup>';
	    					}}
	    					?>
	    				</select>
	    				<script>
							function tochoose_insurance_type_id(insurance_type_id){
								if(insurance_type_id != '' && insurance_type_id != 0){
									$('select[name="insurance_type_id"]').css({'color': 'black'});
								}else{
									$('select[name="insurance_type_id"]').css({'color': '#999'});
								}
							}
	    				</script>
	    			</div>
	    			<div class="search_add add_btn" style="width:95px;" onclick="javascript:location.href='<?php echo base_url().'index.php/admins/welcome/clinics_profile'?>';">
	    				<img style="width: 15px;" src="<?php echo base_url().'themes/default/images/clinic_add_hygienist.png'?>" />
	    				<div>Add Clinic</div>
	    			</div>
	    			<div class="search_section">
	    				<img style="width: 12px;" src="<?php echo base_url().'themes/default/images/clinic_reach.png'?>" />
	    				<input type="text" name="keyword" placeholder="Keyword" value="<?php echo $keyword;?>" />
	                    <div onclick = "search()" style="cursor:pointer;width:100px;height: 38px;line-height: 38px;color: white;text-align: center;font-size:16px;border-radius:4px; background-color: #1069D2;float: left; margin-left: 20px;">
	                        <?php if($this->langtype=='_en'){echo "Search";}else{echo "Chercher";}?>
	                    </div>
	    			</div>
	
	    		</div>
	    	</div>
    	</form>
    	<script type="text/javascript">
			function search(){
				$('#search_form').submit();
			}
    	</script>
    	
    	<?php 
	    	$sql = "SELECT * FROM ".DB_PRE()."store_insurance_type WHERE parent != 0";
	    	$insurance_type_list = $this->db->query($sql)->result_array();
    	?>
    	
    	<div class="section_box_body">
    		<div class="section_box_body_title">
				<div style="width: 40px;float: left;">
					S/N
				</div>
    			<div style="width: calc(100%  / 8);float: left;">
    				Name
    			</div>
    			<div style="width: calc(100%  / 8);float: left;">
    				Email
    			</div>
    			<div style="width: calc(100%  / 8);;float: left;">
    				Logon Time
    			</div>
    			<div style="width: calc(100%  / 8);float: left;">
    				Insurance Type
    			</div>
    			<div style="width: calc(100%  / 8);float: left;">
    				Service Type
    			</div>
    			<div style="width: calc(100%  / 8);float: left;">
    				Total Orders
    			</div>
				<div style="width: calc(100%  / 8);float: left;">
					Status
				</div>
				<div style="width: calc(100%  / 8 - 40px);float: left;">
					Actions
				</div>
    		</div>
            <?php if(isset($store_list)){for ($i = 0; $i < count($store_list); $i++) {?>
            	<?php 
            		$connectuserinfo = $this->UserModel->get_user_info($store_list[$i]['user_id']);
            		
            		$con = ['clinic_id'=>$store_list[$i]['id'], 'orderby'=>'o.status_id ASC, o.created', 'orderby_res'=>'DESC', 'statusin'=>'8,10'];
            		$count_orders = $this->OrderModel->get_order_list($con, 1);
            	?>
				<div class="section_box_body_section">
					<div style="width: 40px;float: left;">
						<?php echo ($i + 1)?>
					</div>
					<div style="width: calc(100%  / 8);float: left;">
						<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($store_list[$i]['store_name'.$this->langtype]));?>
					</div>
					<div style="width: calc(100%  / 8);float: left;">
						<?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($store_list[$i]['login_email']));?>
					</div>
					<div style="width: calc(100%  / 8);float: left;">
						<?php if(!empty($connectuserinfo)){?>
							<?php echo date('D, d M, Y', $connectuserinfo['last_login_time'])?><br>
	                        <?php echo date('H:i:s', $connectuserinfo['last_login_time'])?>
                        <?php }?>
					</div>
					<div style="width: calc(100%  / 8);float: left;">
						<?php
				            if($insurance_type_list){
				                for ($aaa = 0; $aaa < count($insurance_type_list); $aaa++) {
				                    if(in_array($insurance_type_list[$aaa]['id'], explode(',', $store_list[$i]['insurance_type_id']))){
				                        echo '<div class="title_text" style="margin-right:3px;">'.$insurance_type_list[$aaa]['insurance_type_name'.$this->langtype].'</div>';
				                    }
				                }
				            }
				        ?>
					</div>
					<div style="width: calc(100%  / 8);float: left;">
						<?php
				            
				            
				            $sql = "
								SELECT 
            					c.id AS service_type_id
								, c.service_type_name_en, c.service_type_name_fr
								FROM ".DB_PRE()."service_type AS c
							";
				            $allservicetypelist = $this->db->query($sql)->result_array();
				            if(!empty($allservicetypelist)){
				            	for ($aaa = 0; $aaa < count($allservicetypelist); $aaa++) {
				            		$sql = "
										SELECT a.*
										,c.service_type_name_en, c.service_type_name_fr
										,d.normal_price, d.discount_price
										
										FROM ".DB_PRE()."time_slots_list AS a 
										
										LEFT JOIN ".DB_PRE()."service_list AS b ON a.service_id = b.id
										
										LEFT JOIN ".DB_PRE()."service_type AS c ON b.service_type_id = c.id
										
										LEFT JOIN ".DB_PRE()."price_list AS d ON a.price_id = d.id
										
		            					WHERE a.store_id = ".$store_list[$i]['id']." AND c.id = ".$allservicetypelist[$aaa]['service_type_id']."
									";
				            		$ishavearr = $this->db->query($sql)->row_array();
				            		if(!empty($ishavearr)){
				            			echo '<div style="float:left;width:100%;">'.$allservicetypelist[$aaa]['service_type_name'.$this->langtype].'</div>';
				            		}
				            	}
				            }
				        ?>
					</div>
					<div style="width: calc(100%  / 8);float: left;">
						<?php echo $count_orders;?>
					</div>
					<div style="width: calc(100%  / 8);float: left;">
						<?php 
							if($store_list[$i]['status_id'] == 1){
								echo 'Approved';
							}else{
								echo 'Pending';
							}
						?>
					</div>
					<div style="width: calc(100%  / 8 - 40px);float: left;position: relative;">
						<div style="float: left;position: relative;width: 100%;;" class="more_btn">
							<img style="width: 20px;float:left;margin-left: calc(50% - 10px);cursor: pointer;" src="<?php echo base_url().'themes/default/images/more_btn.png'?>" />
							<div style="width: 100px;line-height: 40px;font-size: 14px;color: #1069D2;box-shadow:6px 10px 30px rgba(0,0,0,0.16);position: absolute;top:10px;left: -40px;background-color: white;cursor: pointer;display: none;display:none;" class="more_box">
								<?php if($store_list[$i]['status_id'] == 0){?>
									<div class="approve_btn" onclick="toapprove_clinic(<?php echo $store_list[$i]['id']?>)">Audit</div>
								<?php }?>
								<div onclick="location.href='<?php echo base_url().'index.php/admins/welcome/clinic_info/'.$store_list[$i]['id'];?>'">View </div>
								<div onclick="javascript:location.href='<?php echo base_url().'index.php/admins/welcome/clinic_edit';?>';">Edit </div>
							</div>
						</div>
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
						<div class="view_btn" onclick="approve_clinic()" style="width: 143px;cursor:pointer;height: 46px;line-height: 46px;float: left;font-size: 12px;color: white;text-align: center;margin-top:18px;background-color: #1069D2;margin-left:20px;border-radius:4px;margin-bottom: 28px;;">
							Approve
						</div>
						<div class="loading_btn" style="display:none;width: 143px;cursor:pointer;height: 46px;line-height: 46px;float: left;font-size: 12px;color:gray;text-align: center;margin-top:18px;background-color: #EFEFEF;margin-left:20px;border-radius:4px;margin-bottom: 28px;;">
							Loading...
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
		$(this).find(".more_box").css("display", "block");
	})
	$(".cancel, .delete_btn").click(function(){
	    $(".pay_box").css("display","none")
	})
	
// 	$(".approve_btn").click(function(){
		 
// 	})
	var current_store_id = 0;
	function toapprove_clinic(id){
		current_store_id = id;
		$(".pay_box").css("display", "none");
	    $(".pay_box3").css("display", "block");
	}
	function approve_clinic(){
		$('.view_btn').hide();
		$('.loading_btn').show();

		$.post(baseurl+'index.php/admins/welcome/approve_clinic/'+current_store_id, function (){
			location.reload();
		})
	}
</script>
