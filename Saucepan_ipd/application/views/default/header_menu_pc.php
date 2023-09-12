<?php 
$menu = $this->session->userdata('menu');
$lang = $this->session->userdata('lang');

$get_str='';
if($_GET){
	$arr = geturlparmersGETS();
	for($i=0;$i<count($arr);$i++){
		if(isset($_GET[$arr[$i]])){
			if($get_str!=""){$get_str .='&';}else{$get_str .='?';}
			$get_str .=$arr[$i].'='.$_GET[$arr[$i]];
		}
	}
}
$current_url_encode = str_replace('/','slash_tag',base64_encode(current_url().$get_str));
?>
<div class="header_top_nav" style="display:none">
  <div style="width:96%;max-width:1100px;overflow:hidden;margin:auto;" class="wow bounceInLeft" data-wow-duration="2s"  data-wow-delay="1s">
      <div style="float:right;width:40%;">
          <a href="<?php echo base_url().'index.php/welcome/about'?>">
            <div class="languagearea" style="">
					<a href="<?php echo base_url().'index.php/welcome/changelanguage/ch/'.$current_url_encode?>">中文</a>
			        <a href="<?php echo base_url().'index.php/welcome/changelanguage/tw/'.$current_url_encode?>">繁体</a>
					<a href="<?php echo base_url().'index.php/welcome/changelanguage/en/'.$current_url_encode?>">English</a>
			</div>
          </a>
      </div>
  </div>
</div>
<div class="nav_body">
    <div class="nav_body_section lanchoose">
        <div href="<?php echo base_url().'index.php/welcome/'?>">
        	<?php if($this->langtype == '_en'){?>
						<img  style="display:none" src="<?php echo base_url()."themes/default/images/ezdesign_logo.png"?>" class="logo white_logo" />
						<img   src="<?php echo base_url()."themes/default/images/ezdesign_logo2.png"?>" class="logo black_logo" />
					<?php }else{?>
						 <img style="display:none;width:240px" src="<?php echo base_url()."themes/default/images/ezdesign_logo_white.png"?>" class="logo phone_logo_ch white_logo" />
						 <img   src="<?php echo base_url()."themes/default/images/ezdesign_logo_black.png"?>" class="logo phone_logo_ch black_logo" style="width:240px" />
					<?php } ?>
				
        	
        </div>
    
        <div class="box">
          <div class="language" id='language' style="display:none;">
            <?php if($lang == 'en'){?>
						<a href="<?php echo base_url().'index.php/welcome/changelanguage/ch/'.$current_url_encode?>" style="color:white;font-size:14px;font-weight:normal;">CN</a>
					<?php }else{?>
						<a href="<?php echo base_url().'index.php/welcome/changelanguage/en/'.$current_url_encode?>" style="color:white;font-size:14px;font-weight:normal;">EN</a>
					<?php }?>
          </div>
          <div class="menu lanchoose" style="display:none;">
            <img class="menu_i1" style="width:20px;" src="<?php echo base_url().'themes/default/images/menu_w.png'?>"  />
            <img class="menu_i2" style="width:20px;display:none;" src="<?php echo base_url().'themes/default/images/menu_b.png'?>" />
          </div>
        </div>
    </div>
</div>

<div class="gksel_menu" style="background:url('<?php echo base_url().'themes/default/images/menu_bg2.png'?>') center center / cover no-repeat;">
   <div class="gksel_ssmenu">
      <p style="width:90%;margin-left:5%;text-align:right;margin-top:35px;cursor:pointer;"><img src="<?php echo base_url().'themes/default/images/dinfo_white_close.png'?>" style="width:20px;"/></p>
       <table style="width:100%;height:100%;">
           <tr>
              <td>
                  <div style="width:96%;color:white;">
                     <a href="<?php echo base_url().'index.php'?>" style="width:300px;display:block;text-align:center;font-size:35px;" class="op2">
                     	<?php if($this->langtype == '_ch'){echo '主页';}else{echo 'HOME';}?>
                     </a>
                     <a href="<?php echo base_url().'index.php/welcome/about_us'?>" style="width:300px;display:block;text-align:center;margin-top:20px;font-size:35px;" class="op3">
					 	 <?php 
								if($this->langtype == '_ch'){
									echo '关于我们';
								}else{
									echo 'ABOUT US';
								}
							?>
					 </a>
                     <a href="<?php echo base_url().'index.php/welcome/faq'?>" style="width:300px;display:block;text-align:center;margin-top:20px;font-size:35px;display:none;" class="op4">
						<?php 
								if($this->langtype == '_ch'){
									echo '常遇问题';
								}else{
									echo 'FAQ';
								}
						?>
					 </a>
					 <a href="<?php echo base_url().'index.php/welcome/services'?>" style="width:300px;display:block;text-align:center;margin-top:20px;font-size:35px;display:none;" class="op5">
						<?php 
								if($this->langtype == '_ch'){
									echo '服务';
								}else{
									echo 'SERVICES';
								}
						?>
					 </a>
					 <a href="<?php echo base_url().'index.php/welcome/events'?>" style="width:300px;display:block;text-align:center;margin-top:20px;font-size:35px;display:none;" class="op6">
						<?php 
								if($this->langtype == '_ch'){
									echo '活动';
								}else{
									echo 'EVENTS';
								}
						?>
					 </a>
                     <a href="<?php echo base_url().'index.php/welcome/contact'?>" style="width:300px;display:block;text-align:center;margin-top:20px;font-size:35px;" class="op7">
						<?php 
								if($this->langtype == '_ch'){
									echo '联系我们';
								}else{
									echo 'CONTACT US';
								}
						?>
					 </a>
					 <div style="width:300px;display:white;text-align:center;margin-top:20px;font-size:25px;" class="op8">
                        
            						<a href="<?php echo base_url().'index.php/welcome/changelanguage/ch/'.$current_url_encode?>" style="color:white;font-size:35px;font-weight:normal;">中文</a>
            					&nbsp;&nbsp;|&nbsp;&nbsp;
            						<a href="<?php echo base_url().'index.php/welcome/changelanguage/en/'.$current_url_encode?>" style="color:white;font-size:35px;font-weight:normal;">EN</a>
            					
                      </div>
                  </div>
              </td>
           </tr>
       </table>
      
	</div>
</div>
<script type="text/javascript">
$(document).ready(function (){
	$(".lanchoose").click(function(){
		if($(".gksel_menu").css("display")=="none"){
			$(".gksel_menu").fadeIn(500);  
			$(".gksel_header_logos,.op2,.op3,.op4,.op5,.op6,.op7,.op8,.op9,.op10,.op11,.op12,.op13").css({"opacity": "1"});
			$(".gksel_header_logos,.op2,.op3,.op4,.op5,.op6,.op7,.op8,.op9,.op10,.op11,.op12,.op13").css({"-moz-opacity": "1"});
			$(".gksel_header_logos,.op2,.op3,.op4,.op5,.op6,.op7,.op8,.op9,.op10,.op11,.op12,.op13").css({"transition": "all .4s ease-out"});
			$(".gksel_header_logos,.op2,.op3,.op4,.op5,.op6,.op7,.op8,.op9,.op10,.op11,.op12,.op13").css({"marginLeft": "calc(50% - 150px)"});
			$(".gksel_header_logos").css({"transition-delay": "0.36s"});
			$(".op2").css({"transition-delay": "0.4s"});
			$(".op3").css({"transition-delay": "0.44s"});
			$(".op4").css({"transition-delay": "0.48s"});
			$(".op5").css({"transition-delay": "0.52s"});
			$(".op6").css({"transition-delay": "0.56s"});
			$(".op7").css({"transition-delay": "0.60s"});
			$(".op8").css({"transition-delay": "0.64s"});
			$(".op9").css({"transition-delay": "0.68s"});
			$(".op10").css({"transition-delay": "0.72s"});
			$(".op11").css({"transition-delay": "0.76s"});
			$(".op12").css({"transition-delay": "0.80s"});
			$(".op13").css({"transition-delay": "0.84s"});
		}else{
			$(".gksel_menu").fadeOut(500);
		}
	})
	$(".gksel_menu p").click(function(){
		$(".gksel_menu").fadeOut(500);
		$(".gksel_header_logos,.op2,.op3,.op4,.op5,.op6,.op7,.op8,.op9,.op10,.op11,.op12,.op13").css({"opacity": "0"});
		$(".gksel_header_logos,.op2,.op3,.op4,.op5,.op6,.op7,.op8,.op9,.op10,.op11,.op12,.op13").css({"transition": "all .4s ease-out"});
		$(".gksel_header_logos,.op2,.op3,.op4,.op5,.op6,.op7,.op8,.op9,.op10,.op11,.op12,.op13").css({"marginLeft": "-30px"});
	});
	$(".contact_us_btn").mouseover(function(){
		
		$(".contact_us_btn").css("borderColor","#DD3924")
        $(".contact_us_btn").css("color","#DD3924")
	});
$(".contact_us_btn").mouseout(function(){
		
		$(".contact_us_btn").css("borderColor","black")
        $(".contact_us_btn").css("color","black")
        
	});
$(".footer_contact a").mouseout(function(){
	$(".footer_contact a").css("borderColor","white")
    $(".footer_contact a").css("color","white")   
});
$(".header_box a,.gksel_menu a").click(function(){
	 $(".header_box a").css("color","black")
	  $(".header_box a").css("borderBottom","none")
	 $(this).css("color","#DD3924")
//      $(this).css("borderBottom","1px solid #DD3924")
     $(this).siblings().css({"color":"white"})
     $(this).siblings().find("a").css({"color":"white"})
     $(".gksel_menu").fadeOut(1000);
    
});
	
})
</script>








