<?php $this->load->view('default/home_header')?>
<style>
	.header_list_two{display: none;}
	body,html{height: 100%;}
	.luteagarden_body{width: 100%;display: flex;align-items: flex-start;justify-content: space-between;flex-wrap: wrap;height: 100%;}
	.luteagarden_body .luteagarden_body_box{width: calc(25% - 2px);height: 100%;border-left:1px solid #163943;border-right:1px solid #163943;}
	.luteagarden_body .luteagarden_body_box:nth-child(1){width: calc(25% - 1px);border-right:none;}
	.luteagarden_body .luteagarden_body_box:nth-child(2){width: calc(50% - 2px);}
	.luteagarden_body .luteagarden_body_box:nth-child(3){width: calc(25% - 0px);border:none}
	.luteagarden_body .luteagarden_body_box .section_title{width: calc(100% - 40px);padding:20px;font-size: 30px;font-weight: bold;background-color:#163943 ;color: white;display: flex;justify-content: center;align-items: center;}
	/* .luteagarden_body .luteagarden_body_box .section_title .title{  text-shadow: 0 0 10px #fff,
                     0 0 20px #fff,
                     0 0 30px #fff,
                     0 0 40px #00a67c,
                     0 0 70px #00a67c,
                     0 0 80px #00a67c,
                     0 0 100px #00a67c,
                     0 0 150px #00a67c;} */
	.luteagarden_body .luteagarden_body_box .section_box{width: 100%;display: flex;align-items: flex-start;justify-content: center;flex-wrap: wrap;}
	.luteagarden_body .luteagarden_body_box .section_box .box{width: calc(100% - 0px);border-bottom:1px solid #163943;border-top:none;color: #163943;font-size: 40px;font-weight: bold;display: flex;align-items: flex-start;justify-content: center;flex-wrap: wrap;padding:20px 0;}
	.luteagarden_body .luteagarden_body_box .section_boxs{width: 100%;display: flex;align-items: flex-start;justify-content: flex-start;flex-wrap: wrap;}
	.luteagarden_body .luteagarden_body_box .section_boxs .box{width: calc(50% - 1px);border-bottom:1px solid #163943;border-top:none;border-right:1px solid #163943;color: #163943;font-size: 40px;font-weight: bold;display: flex;align-items: flex-start;justify-content: center;flex-wrap: wrap;padding:20px 0;}
	.luteagarden_body .luteagarden_body_box .section_boxs .box:nth-child(even){width: calc(50% - 0px);border-bottom:1px solid #163943;border-right:none;color: #163943;font-size: 40px;font-weight: bold;}
</style>
<div class="luteagarden_body">
	<div class="luteagarden_body_box">
		<div class="section_title" style="background-color: rgba(22,57,67,.9);"><div class="title">准备中...</div></div>
		<div class="section_box">
			<div class="box">A001222</div>
			<div class="box">A002</div>
			<div class="box">A003</div>
		</div>
	</div>
	<div class="luteagarden_body_box luteagarden_body_boxs">
		<div class="section_title"><div class="title">请取餐：A052</div></div>
		<div class="section_box section_boxs">
			<div class="box">A052</div>
			<div class="box">A053</div>
			<div class="box">A068</div>
		</div>
	</div>
	<div class="luteagarden_body_box" style='background: url("https://www.luteagarden.com/themes/default/images/home_bg_banner06_16_02.jpg") center center / cover no-repeat;'>
		
	</div>
</div>
<?php $this->load->view('default/home_footer')?>