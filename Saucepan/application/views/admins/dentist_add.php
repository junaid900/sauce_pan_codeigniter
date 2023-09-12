<?php $this->load->view('admin/header')?>

<script src="<?php echo base_url()?>themes/default/js/upload.js?date=<?php echo CACHE_USETIME()?>"></script>
<script src="<?php echo base_url()?>themes/default/js/num-alignment.js?date=<?php echo CACHE_USETIME()?>"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input/dist/magic-input.min.css">
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/jquery-1.7.2.min.js?date=<?php echo CACHE_USETIME()?>'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/lan<?php echo $this->langtype?>.js?date=<?php echo CACHE_USETIME()?>'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_common.js?date=<?php echo CACHE_USETIME()?>'></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/admin.css?date=<?php echo CACHE_USETIME()?>"/>
<link rel="shortcut icon" href="<?php echo base_url()?>themes/default/images/revo_favicon.ico?date=<?php echo CACHE_USETIME()?>" type="image/x-icon" />


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
	input[type=text], input[type=password], textarea{padding: 10px 0;;}
	input[disabled=disabled],textarea[disabled=disabled]{outline:0;background:#1069D2}
	input[type=number]:focus,input[type=password]:focus,input[type=text]:focus,textarea:focus{outline:0;border:1px solid #1069D2;background:#EFFCFD;box-shadow:0 0 5px #1069D2}
	.gksel_normal_tabpost{font-size: 14px;;}
</style>

<div class="clinics_body" style="">
	<!-- 
	<div class="clinics_body_wecome" style="display: none;">
		<form method="post">
			<table class="gksel_normal_tabpost" style="width: 55%;">
				<style>
					#usernamesearch_auto {position: absolute;width: 280px;margin-left: 0px;border: 1px solid #ddd;display: none;margin-top: 30px;z-index:1000;}
					#usernamesearch_auto ul {float:left;width:100%;padding: 0px;margin: 0px;list-style: none;}
					#usernamesearch_auto li {float:left;width:100%;padding: 0px;margin: 0px;list-style: none;}
					#usernamesearch_auto li.ressearch {float: left;width: 100%;background: #FFF;height: 28px;}
					#usernamesearch_auto li.ressearch table {float:left;width: 100%;height: 100%;}
					#usernamesearch_auto li.ressearch_close {float: left;width: 100%;background: #FFF;height: 28px;text-align: right;}
					#usernamesearch_auto li.ressearch_close table {float:left;width: 100%;height: 100%;}
					#usernamesearch_auto li a {float:left;width:calc(100% - 12px);line-height:28px;display: block;padding: 0px 6px;cursor: pointer;color: #666;}
					#usernamesearch_auto li a:hover {float:left;background: #D8D8D8;text-decoration: none;color: #000;}
				</style>
				<script>
					$(document).ready(function(){
						$('input[name="clinic_name"]').keyup(function(){
							console.log(111);
							if($(this).val().length>=1){
								$.post(baseurl+'index.php/admins/clinic/clinic_search',{keyword:$(this).val()}, function(data){
									if(data=='0'){
										$('#usernamesearch_auto').html('').css('display','none');
									}else{
										$('#usernamesearch_auto').html(data).css('display','block');
									}
								});
							}else{
								$('#usernamesearch_auto').html('').css('display','none');
								$('input[name="store_id"]').val('');
							}
						})
					});
					function choose_clinic(uid,clinic_name){
						$('input[name="clinic_name"]').val(clinic_name);
						$('input[name="store_id"]').val(uid);
					}
				</script>
					<tr>
						<td align="right">Clinic</td>
						<td align="left">
							<input type="text" name="clinic_name" style="width:280px;" value=""/>
							<div class="tipsgroupbox"><div class="request">*</div></div>
							<input type="hidden" name="store_id" value=""/>

							<div id="usernamesearch_auto"></div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
						</td>
					</tr>
					<tr>
						<td align="right" width="150">Please enter hygienist’s name</td>
						<td align="left">
							<input type="text" name="dentist_name" style="width:280px;" value=""/>
						</td>
					</tr>
					<tr>
					<td align="right" width="150">Please enter hygienist’s education background</td>
					<td align="left">
						<input type="text" name="dentist_school" style="width:280px;"  value=""/>
					</td>
					</tr>
					<tr>
					<td align="right" width="150">Years of work experience</td>
					<td align="left">
						<input type="number" name="dentist_work" style="width:280px;" value=""/>
					</td>
					</tr>
					<tr>
					<td align="right">Hygienist Photo</td>
					<td>
						<div class="img_gksel_show" id="dentist_avatar_show">

						</div>
						<div class="img_gksel_choose" id="dentist_avatar_choose">
							<input type="file" name="logo">
							Upload
						</div>
						<div style="float:left;"><input type="hidden" id="dentist_avatar" name="dentist_avatar" value=""/></div>
						<div style="float:left;margin-left:5px;margin-top:5px;"><font class="fonterror" id="dentist_avatar_error"><font style="color:gray;">仅支持 Jpg, Png, Gif 格式 (800px * 800px)</font></div>
					</td>
				</tr>
					<tr>
						<td colspan="2">
							<div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
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
						<div class="gksel_btn_action_on" onclick="toadd_dentistinfo()"><?php echo lang('cy_save')?></div>
					</td>
				</tr>
			</table>
		</form>
	</div>
	 -->
	

	<div class="clinics_hygienist_body">
		<div class="header_box_section">
			<?php 
    			$con = ['user_type_id' => 4, 'is_del' => 0, 'orderby'=>'u.uid', 'orderby_res'=>'DESC'];
    			$dentist_count = $this->UserModel->get_user_list($con, 1);
			?>
			<div class="title">
				<div><?php echo $dentist_count;?></div>
				<span>Total Hygienist</span>
			</div>
			<div class="search_box">
				<?php 
				    $dentist_name_search = $this->input->get('dentist_name_search');
				?>
				<div class="search_input">
					<input type="text" name="dentist_name_search" placeholder="Hygienist name" value="<?php echo $dentist_name_search?>" style="color:black;"/>
					<img onclick="tosearchdentist()" style="width: 12px;" src="<?php echo base_url().'themes/default/images/clinic_reach.png'?>" />
				</div>
				<script>
					function tosearchdentist(){
						var dentist_name_search = $('input[name="dentist_name_search"]').val();
						location.href = baseurl+'index.php/admins/clinic/toadd_dentist?dentist_name_search='+dentist_name_search;
					}
				</script>
				<div class="search_add add_btn" >
					<img style="width: 15px;" src="<?php echo base_url().'themes/default/images/clinic_add_hygienist.png'?>" />
					<div>Add Hygienist</div>
				</div>
				<div class="search_section" style="display:none;">
					<img style="width: 12px;" src="<?php echo base_url().'themes/default/images/clinic_reach.png'?>" />
					<input type="text" name="keyword" placeholder="Search" value="" />
	
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
				<div style="width: 20%;float: left;">
					Hygienist
				</div>
				<div style="width: 20%;float: left;">
					ClinicName
				</div>
				<div style="width: 20%;float: left;">
					Education
				</div>
				<div style="width: 20%;float: left;">
					Work experience
				</div>
				<div style="width: calc(20% - 120px);float: left;">
					Picture
				</div>
				<div style="width: 60px;float: left;">
					Edit
				</div>
			</div>
	        <?php if($dentist_list){for($i = 0; $i < count($dentist_list); $i++){?>
    			<div class="section_box_body_section">
    				<div style="width: 60px;float: left;">
    				   <?php echo ($i + 1)?>
    				</div>
    				<div style="width: 20%;float: left;">
    					<?php echo actionsearchdaxiaoxiezimu($dentist_name_search, $dentist_list[$i]['dentist_name']);?>
    				</div>
    				<div style="width: 20%;float: left;">
    					<?php 
        					$storeinfo = $this->ClinicModel->get_store_info($dentist_list[$i]['dentist_store_id']);
        					if(!empty($storeinfo)){
        					    echo $storeinfo['store_name'.$this->langtype];
        					}
    					?>
    				</div>
    				<div style="width: 20%;float: left;">
    					<?php if($dentist_list[$i]['dentist_school'] != ''){?>
                        	University of <?php echo $dentist_list[$i]['dentist_school']?>
                        <?php }?>
    				</div>
    				<div style="width: 20%;float: left;">
    					<?php if($dentist_list[$i]['dentist_work'] != '' && $dentist_list[$i]['dentist_work'] != 0){?>
                        	<?php echo $dentist_list[$i]['dentist_work']?> years
                        <?php }?>
    				</div>
    				<div style="width: calc(20% - 120px);float: left;">
    					<img style="float:left;width:52px;height:52px;margin-left: calc(50% - 26px);border-radius:4px;"
    						 src="<?php echo base_url() . $dentist_list[$i]['dentist_avatar'] ?>"
    						 alt="">
    				</div>
    				<div style="width: 60px;float: left;" onclick="toedit_hygienist(<?php echo $dentist_list[$i]['uid']?>)">
    					<img style="width: 18px;float:left;margin-left: calc(50% - 9px);cursor: pointer;"
    						 src="<?php echo base_url() . 'themes/default/images/clinic_hygienist_edit.png' ?>"
    						 alt="">
    				</div>
    			</div>
	        <?php }}?>
		</div>
	</div>
</div>
<div style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: rgb(0,0,0,.5);z-index: 2000;display: none;" class="hy_box">
	<table style="width: 100%;height: 100%;">
		<tr>
			<td>
				<div style="width:600px;height:600px;border-radius: 10px;margin: auto;overflow-y: scroll;background-color: white;;">
					<div style="width: 100%;float: left;height: 56px;font-weight: bold;line-height:56px;font-size: 16px;color: #1069D2;text-align: center;position: relative;">
						Please add a hygienist
						<img class="delete_btn" style="width: 28px;position: absolute;top:15px;right:20px;cursor: pointer;"  src="<?php echo base_url().'themes/default/images/de_b.png'?>" alt="">
					</div>
					<div style="width: 100%;float:left;;">
						<div style="width: calc(100% - 200px);padding:20px 100px;float:left;background-color: white;;">
							<div style="width:100%;float:let;font-size: 14px;">
								<div style="width: 100%;float:left;color: #101010;">
									Please choose hygienist’s clinic <font style="font-size:18px;color:red;">*</font>
								</div>
								<div style="width: 100%;float:left;color: #101010;padding:10px 0px;">
                    				<select name="clinic_id" onchange="tochoose_clinic_id(this.value)" style="float: left;background: url(<?php echo base_url()?>themes/default/images/select_arrow_blue.png) no-repeat scroll right center rgba(255,255,255,1);appearance: none;-moz-appearance: none;-webkit-appearance: none;width:158px;height: 35px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;color:black;">
                    					<option value="0"></option>
                    					<?php 
                        					$con = array();
                        					$store_list = $this->ClinicModel->get_store_list($con);
                        					if(!empty($store_list)){
                        					    for ($i = 0; $i < count($store_list); $i++) {
                        					        $isselected = '';
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
							</div>
							<div class="clinic_id_error" style="display:none;float:let;width:100%;font-size: 14px;color: red;">
								Please choose hygienist’s clinic
							</div>
							
							<div style="width:100%;float:let;font-size: 14px;">
								<div style="width: 100%;float:left;color: #101010;">
									Please enter hygienist’s name <font style="font-size:18px;color:red;">*</font>
								</div>
								<input type="text" placeholder="Dr. Lachance" name="dentist_name" style="width: 100%;padding:10px 0;float: left;border-radius:4px;color:black;margin-top:10px;" />
							</div>
							<div class="dentist_name_error" style="display:none;float:let;width:100%;font-size: 14px;color: red;">
								Please enter hygienist’s name
							</div>
							<div style="width:100%;float:left;font-size: 14px;margin-top:38px;">
								<div style="width: 100%;float:left;color: #101010;">
									Please enter hygienist’s education background <font style="font-size:18px;color:red;">*</font>
								</div>
								<input type="text" placeholder="University Name" name="dentist_school" style="width: 100%;padding:10px 0;float: left;border-radius:4px;color:black;margin-top:10px;" />
							</div>
							<div class="dentist_school_error" style="display:none;float:let;width:100%;font-size: 14px;color: red;">
								Please enter hygienist’s education background
							</div>
							<div style="width:100%;float:left;font-size: 14px;margin-top:38px;display: flex;justify-content: left;align-items: center;">
								<div style="width: 50%;float:left;color: #101010;">
									Years of work experience
								</div>
								<div style="float:left;width: 50%;display: flex;justify-content: flex-end;">
									<input id="5" data-step="1" data-min="0" data-max="" data-digit="0" value="0" name="dentist_work"/>
								</div>
							</div>
							<div style="width:100%;float:left;font-size: 14px;margin-top:28px;">
								<div style="width: 100%;float:left;color: #101010;">
									Please upload hygienist’s profile picture <font style="font-size:18px;color:red;">*</font>
								</div>

								<div id="drop_area" style="float:left;margin-top:10px;;"></div>

                                <input type="hidden" name="dentist_avatar">
							</div>
							<div class="dentist_avatar_error" style="display:none;float:let;width:100%;font-size: 14px;color: red;">
								Please upload hygienist’s profile picture
							</div>
							<div style="width:100%;float:left;font-size:14px;color:#101010;margin-top:20px;">
								Or chose a profile picture from
							</div>
							<div style="width:100%;float:left;display: flex;justify-content: space-between;align-items: center;margin-top:10px;">
                           		<div onclick="avatar('themes/default/images/avatar1.png')" style="position:relative;" class="model_pic">
                           			<img src="<?php echo base_url().'themes/default/images/avatar1.png'?>" alt="" style="width:60px">
                           			<div style="width:100%;height:100%;background-color:rgba(0,0,0,.5);position:absolute;top:0;">
                           				
                           			</div>
                           		</div>
                            	<div onclick="avatar('themes/default/images/avatar2.png')" style="position:relative;" class="model_pic">
                            		<div style="width:100%;height:100%;background-color:rgba(0,0,0,.5);position:absolute;top:0;">
                           				
                           			</div>
                            		<img src="<?php echo base_url().'themes/default/images/avatar2.png'?>" alt="" style="width:60px">
                            	</div>
                            	<div onclick="avatar('themes/default/images/avatar3.png')" style="position:relative;" class="model_pic">
                            		<img src="<?php echo base_url().'themes/default/images/avatar3.png'?>" alt="" style="width:60px">
                            		<div style="width:100%;height:100%;background-color:rgba(0,0,0,.5);position:absolute;top:0;">
                           				
                           			</div>
                            	</div>
                            	<div onclick="avatar('themes/default/images/avatar4.png')" style="position:relative;" class="model_pic">
                            		<img src="<?php echo base_url().'themes/default/images/avatar4.png'?>" alt="" style="width:60px">
                            		<div style="width:100%;height:100%;background-color:rgba(0,0,0,.5);position:absolute;top:0;">
                           				
                           			</div>
                            	</div>
                           </div>
							<div style="width:calc(100% - 00px);margin-left:0px;float:left;font-size: 14px;color: #1069D2;margin-top:20px;position: relative;display: flex;justify-content: flex-end;align-items: center;">
								<div style="width: 78px;height: 38px;cursor:pointer;line-height: 38px;text-align: center;text-align: center;color: white;background-color: #1069D2;margin-left:20px;border:1px solid #1069D2;border-radius: 4px;cursor:pointer;" class="pay_btn" onclick="toadd_dentistinfo()">Save</div>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
<div style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: rgb(0,0,0,.5);z-index: 2000;display: none;" class="hy_box2" id="edit_hygienist">
    <table style="width: 100%;height: 100%;">
        <tr>
            <td>
                <div style="width:600px;height:600px;border-radius: 10px;margin: auto;overflow-y: scroll;background-color: white;;">
                    <div style="width: 100%;float: left;height: 56px;font-weight: bold;line-height:56px;font-size: 16px;color: #1069D2;text-align: center;position: relative;">
                        Please edit a hygienist
                        <img class="delete_btn" style="width: 28px;position: absolute;top:15px;right:20px;cursor: pointer;"  src="<?php echo base_url().'themes/default/images/de_b.png'?>" alt="">
                    </div>
                    <div class="ajax_load_editaction_content" style="width: 100%;float:left;;">
                        
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
//用户信息---保存
function toadd_dentistinfo(){

    if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="toadd_dentistinfo()"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.attr('background-color', '#EFEFEF');
		actionsubmit_button.html('Loading');


		var ispass = 1;

		var store_id = $('select[name="clinic_id"]').val();
		var dentist_name = $('input[name="dentist_name"]').val();
		var dentist_school = $('input[name="dentist_school"]').val();
		var dentist_work = $('input[name="dentist_work"]').val();

		var dentist_avatar = $('input[name="dentist_avatar"]').val();

        if($('input[name="status"]').is(':checked')){status = 1;}else{status = 2;}

        if(isNull.test(dentist_name)){
			ispass = 0;
			$('.dentist_name_error').show();
		}else{
			$('.dentist_name_error').hide();
		}
		if(isNull.test(dentist_school)){
			ispass = 0;
			$('.dentist_school_error').show();
		}else{
			$('.dentist_school_error').hide();
		}
		if(isNull.test(dentist_avatar)){
			ispass = 0;
			$('.dentist_avatar_error').show();
		}else{
			$('.dentist_avatar_error').hide();
		}
		if(store_id == 0){
			ispass = 0;
			$('.clinic_id_error').show();
		}else{
			$('.clinic_id_error').hide();
		}

        if(ispass == 1){
			var postOBJ = new Object();
			postOBJ.backurl = backurl;

			postOBJ.store_id = store_id;
			postOBJ.dentist_name = dentist_name;
			postOBJ.dentist_school = dentist_school;
			postOBJ.dentist_work = dentist_work;
			postOBJ.dentist_avatar = dentist_avatar;
            postOBJ.status = status;

            $.post(baseurl+'index.php/admins/clinic/add_dentist', postOBJ, function (data){
				var obj = eval( "(" + data + ")" );
				if(obj.status=='success'){
                    actionsubmit_button.html('Success');

                    location.reload();
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
	$(".add_btn").click(function(){
	    $(".hy_box").css("display","block")
	})
	function toedit_hygienist(hygienist_id){
		$(".hy_box2").css("display","block");

		$('.ajax_load_editaction_content').html('<img style="float:left;width:20px;height:20px;margin-left:calc(50% - 10px);" src="'+baseurl+'themes/default/images/ajax_loading.gif"/>');
		$.post(baseurl+'index.php/admins/clinic/toajax_edithygienist/'+hygienist_id, function (data){
			$('.ajax_load_editaction_content').html(data);
		})
	}
	$(".delete_btn").click(function(){
	    $(".hy_box,.hy_box2").css("display","none")
	})
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
        var button_gksel1 = $('#dentist_avatar_choose'), interval;
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
                        $('#dentist_avatar_error').html('上传失败');
                        return false;
                    }
                },
                onComplete: function(file, response){
                    $('.img_gksel_choose').text(upload);
                    window.clearInterval(interval);
                    this.enable();
                    if(response=='false'){
                        $('#dentist_avatar_error').html('上传失败');
                    }else{
                        var pic = eval("("+response+")");
                        $('#dentist_avatar_show').show().html('<img style="float:left;max-width:200px;max-height:200px;border-radius:6px;" src="'+baseurl+pic.logo+'" />');
                        $('#img1_btn_show').hide();
                        $('#dentist_avatar').attr('value',pic.logo);
                        $('#dentist_avatar_error').html('');
                    }
                }
            });
    })
	
	
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
	                url: baseurl+'index.php/admins/welcome/upImg',
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
	
// 	var dragImgUpload2 = new DragImgUpload("#drop_area2",{
// 	    callback:function (files) {
// 	        //回调函数，可以传递给后台等等
// 	        var file = files[0];
	
// 	        var formData = new FormData();
// 	        formData.append("importFilePath",file );
// 	        formData.append("folderId",file.name);
// 	        formData.append("softType",file.type);
// 	        if(!/\.(gif|jpg|jpeg|png|GIF|JPG|PNG)$/.test(file.name))
// 	        {
// 	            return false;
// 	        }else{
// 	            $.ajax({
// 	                url: baseurl+'index.php/clinic/welcome/upImg',
// 	                type:'POST',
// 	                contentType: false,
// 	                processData: false,
// 	                data: formData,
// 	                success:function(data){
// 	                    var obj = eval("(" + data + ")");
// 	                    if(obj){
// 	                        $('input[name="dentist_avatar2"]').val(obj.path);
// 	                        //回台返回上传成功操作
// 	                        console.log(111,obj.path);
// 	                    }
// 	                }
// 	            });
// 	        }
// 	        console.log(file.name);
// 	    }
// 	})
	$(".add_btn").click(function(){
	    $(".hy_box").css("display","block")
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
	})
	$(".edit_btn").click(function(){
	    $(".hy_box2").css("display","block")
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
	})
	$(".delete_btn").click(function(){
	    $(".hy_box,.hy_box2").css("display","none")
	})
	
	function avatar(pic) {
        $('input[name="dentist_avatar"]').val(pic)
    }
	$(".model_pic").click(function(){
        var src_value=$(this).find("img").attr('src')
    	 $(".model_pic").find("div").css("backgroundColor","rgba(0,0,0,0.5)");
 		$(this).find("div").css("backgroundColor","none")
 		$("#preview").find("img").attr("src", src_value);
    })
</script>
</html>