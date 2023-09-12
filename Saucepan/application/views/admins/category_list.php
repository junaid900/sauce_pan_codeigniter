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
		
		.personal_body{width:calc(100% - 212px);margin-left:196px;float:left;background-color: #F2F5F9;margin-top:85px;border-radius: 8px;background-color: white;}
		.personal_body .personal_oreder_body{width: calc(100% - 100px);padding:50px;float: left;}
		.week_box{width: 100%;float: left;display: flex;justify-content: flex-start;align-items: center;}
		.week_box2{margin-top:32px}
		.week_box .week_box_title{width: 150px;float: left;text-align: right;color: #999999;}
		.week_box .week_box_section{width: calc(100% - 150px);margin-left:0px;float: left;}
		.week_box .week_box_section  .box{float:left;margin-left:20px;display: flex;justify-content: flex-start;align-items: center;}
		.week_box .week_box_section  .box .roundedOne{float: left;}
		.week_box .week_box_section  .box .title{float: left;font-size: 16px;color: #999999;margin-left:10px;}
		
		
		/* .roundedOne */
		.roundedOne {
		  width: 28px;
		  height: 28px;
		  position: relative;
		  margin: 0px auto;
		  background: #fcfff4;
		 /* background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
		  background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
		  background: linear-gradient(to bottom, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
		  -moz-border-radius: 50px;
		  -webkit-border-radius: 50px;
		  border-radius: 50px;
		  -moz-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
		  -webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
		  box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5); */
		  border:1px solid gray;
		  border-radius: 50px;
		}
		.roundedOne label {
		  width: 20px;
		  height: 20px;
		  cursor: pointer;
		  position: absolute;
		  left: 4px;
		  top: 4px;
		  /* background: -moz-linear-gradient(top, #222222 0%, #45484d 100%);
		  background: -webkit-linear-gradient(top, #222222 0%, #45484d 100%);
		  background: linear-gradient(to bottom, #222222 0%, #45484d 100%);
		  -moz-border-radius: 50px;
		  -webkit-border-radius: 50px;
		  border-radius: 50px;
		  -moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.5), 0px 1px 0px white;
		  -webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.5), 0px 1px 0px white;
		  box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.5), 0px 1px 0px white; */
		}
		.roundedOne label:after {
		  content: '';
		  width: 16px;
		  height: 16px;
		  position: absolute;
		  top: 2px;
		  left: 2px;
		  background: #00bf00;
		  background: -moz-linear-gradient(top, #00bf00 0%, #009400 100%);
		  background: -webkit-linear-gradient(top, #00bf00 0%, #009400 100%);
		  background: linear-gradient(to bottom, #00bf00 0%, #009400 100%);
		  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
		  opacity: 0;
		  -moz-border-radius: 50px;
		  -webkit-border-radius: 50px;
		  border-radius: 50px;
		  
		}
		.roundedOne label:hover::after {
		  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=30);
		  opacity: 0.3;
		}
		.roundedOne input[type=checkbox] {
		  visibility: hidden;
		}
		.roundedOne input[type=checkbox]:checked + label:after {
		  filter: progid:DXImageTransform.Microsoft.Alpha(enabled=false);
		  opacity: 1;
		}
		.categories_box{width: 100%;float: left;margin-top:32px;display: flex;justify-content: flex-start;align-items: center;}
		.categories_box .categories_box_title{width: 150px;float: left;text-align: right;color: #999999;}
		.categories_box .categories_box_section{width: calc(100% - 150px);margin-left:0px;float: left;}
		.categories_box .categories_box_section  .box{float:left;margin-left:20px;display: flex;justify-content: flex-start;align-items: center;padding:10px 10px;border-radius: 9px;border: 1px solid #707070;font-size: 14px;;}
		
		.categories_name_box{width: 100%;float: left;margin-top:32px;display: flex;justify-content: flex-start;align-items: center;}
		.categories_name_box .categories_name_box_title{width: 150px;float: left;text-align: right;color: #999999;}
		.categories_name_box .categories_name_box_section{width: calc(100% - 150px);margin-left:0px;float: left;}
		.categories_name_box .categories_name_box_section  .box{float:left;margin-left:20px;}
		.categories_name_box .categories_name_box_section  .box input{float:left;padding:5px 10px;border-radius: 8px;border: 1px solid #999999;width: 428px;height: 33px;}
		
		.{}
	</style>
<div class="personal_body" style="">
    <div class="personal_oreder_body">
		<div class="week_box">
			<div class="week_box_title">
				Frequency
			</div>
			<div class="week_box_section">
				<div class="box" title=".roundedOne">
					<div class="roundedOne">
					  <input type="checkbox" value="None" id="roundedOne1" name="check" checked />
					  <label for="roundedOne1"></label>
					</div>
					<div class="title">mon</div>
				</div>
				<div class="box" title=".roundedOne">
					<div class="roundedOne">
					  <input type="checkbox" value="None" id="roundedOne2" name="check" />
					  <label for="roundedOne2"></label>
					</div>
					<div class="title">tue</div>
				</div>
				<div class="box" title=".roundedOne">
					<div class="roundedOne">
					  <input type="checkbox" value="None" id="roundedOne3" name="check" />
					  <label for="roundedOne3"></label>
					</div>
					<div class="title">wed</div>
				</div>
				<div class="box" title=".roundedOne">
					<div class="roundedOne">
					  <input type="checkbox" value="None" id="roundedOne4" name="check" />
					  <label for="roundedOne4"></label>
					</div>
					<div class="title">thu</div>
				</div>
				<div class="box " title=".roundedOne">
					<div class="roundedOne">
					  <input type="checkbox" value="None" id="roundedOne5" name="check" />
					  <label for="roundedOne5"></label>
					</div>
					<div class="title">fri</div>
				</div>
				<div class="box" title=".roundedOne">
					<div class="roundedOne">
					  <input type="checkbox" value="None" id="roundedOne6" name="check" />
					  <label for="roundedOne6"></label>
					</div>
					<div class="title">sat</div>
				</div>
				<div class="box">
					<div class="roundedOne">
					  <input type="checkbox" value="None" id="roundedOne7" name="check" />
					  <label for="roundedOne7"></label>
					</div>
					<div class="title">sun</div>
				</div>
			</div>
		</div>
		
		<div class="categories_box">
			<div class="categories_box_title">
				Categories
			</div>
			<div class="categories_box_section">
				<div class="box">MONTHLY POP-UP</div>
				<div class="box">MAKE YOUR OWN</div>
				<div class="box">NUTRIENT ZONE</div>
				<div class="box">CLASSICS</div>
				<div class="box">SIDES & DESSERTS</div>
				<div class="box">TONICS & DESSERTS</div>
				<div class="box">WINE SHOP</div>
			</div>
				
		</div>
		<div class="categories_name_box">
			<div class="categories_name_box_title">
				Coupon Name
			</div>
			<div class="categories_name_box_section">
				<div class="box">
					<input  type="text" />
				</div>
			</div>
		</div>
		
		<div class="categories_name_box">
			<div class="categories_name_box_title">
				Coupon Type
			</div>
			<div class="categories_name_box_section">
				<div class="box">
					<input  type="text" />
				</div>
			</div>
		</div>
		
		<div class="categories_name_box">
			<div class="categories_name_box_title">
				Coupon Discount
			</div>
			<div class="categories_name_box_section">
				<div class="box">
					<input  type="text" />
				</div>
			</div>
		</div>
		<div class="categories_name_box">
			<div class="categories_name_box_title">
				Coupon Quantity
			</div>
			<div class="categories_name_box_section">
				<div class="box">
					<input  type="text" />
				</div>
			</div>
		</div>
		<div class="categories_name_box">
			<div class="categories_name_box_title">
				Start Time
			</div>
			<div class="categories_name_box_section">
				<div class="box">
					<input  type="text" />
				</div>
			</div>
		</div>
		<div class="categories_name_box">
			<div class="categories_name_box_title">
				End Time
			</div>
			<div class="categories_name_box_section">
				<div class="box">
					<input  type="text" />
				</div>
			</div>
		</div>
		<div class="week_box week_box2">
			<div class="week_box_title">
				Condition
			</div>
			<div class="week_box_section">
				<div class="box" title=".roundedOne">
					<div class="roundedOne">
					  <input type="checkbox" value="None" id="roundedOne8" name="check" checked />
					  <label for="roundedOne8"></label>
					</div>
					<div class="title">Not limited</div>
				</div>
				<div class="box" title=".roundedOne">
					<div class="roundedOne">
					  <input type="checkbox" value="None" id="roundedOne9" name="check" />
					  <label for="roundedOne9"></label>
					</div>
					<div class="title">For categories</div>
				</div>
				<div class="box" title=".roundedOne">
					<div class="roundedOne">
					  <input type="checkbox" value="None" id="roundedOne10" name="check" />
					  <label for="roundedOne10"></label>
					</div>
					<div class="title">For products</div>
				</div>
				
				
			</div>
		</div>
		<div class="week_box week_box2">
			<div class="week_box_title">
				Status
			</div>
			<div class="week_box_section">
				<div class="box" title=".roundedOne">
					<div style="float: left;">
					  <input name="status" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" />
					</div>
				</div>
				
			</div>
		</div>
		<div class="week_box week_box2">
			<div class="week_box_title">
				
			</div>
			<div class="week_box_section">
				<div style="width: 100px;height: 35px;line-height: 35px;background: #465c62;border-radius: 4px;text-align: center;color: #f7f297;margin-left:20px;cursor: pointer;">
					Save
				</div>
				
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input/dist/magic-input.min.css">
