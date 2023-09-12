<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Welcome extends CI_Controller {
function __construct() {
		session_start ();
		parent::__construct ();
		
		$lang = $this->session->userdata('lang');
		if($lang == 'ch'){
			$this->session->set_userdata('lang','ch');
			$this->langtype='_ch';
			$this->lang->load('gksel','chinese');
		}else{
			$this->session->set_userdata('lang','en');
			$this->langtype='_en';
			$this->lang->load('gksel','english');
		}
		
		if(isset($_COOKIE[DB_PRE().'userinfo'])){
			$userinfo = unserialize($_COOKIE[DB_PRE().'userinfo']);
			$this->uid = $userinfo['uid'];
		}else{
			$this->uid = 0;
		}
		
	}
	public function index() {
		$this->session->set_userdata ( 'menu', 'home' );
		$data ['website_title'] = 'saucepan';
//  		$con = array('orderby'=>'a.created','orderby_res'=>'ASC');
//  		$data["whowearelist"] = $this->WhoweareModel->getwhowearelist($con);
		$this->load->view ( 'default/home',$data);
	}
	function authorizedgetwechatcode(){
	  $code = $this->input->get('code');
	   
	  //网页授权   拉取用户信息
	  if($code != ""){//用户同意获取资料 -- 获得 code
	   
	  }else{
	   redirect('https://open.weixin.qq.com/connect/oauth2/authorize?appid='.WECHAT_APPID().'&redirect_uri='.current_url().'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
	  }
	  
	  $data['code'] = $code;
	  $this->load->view ( 'default/login_loading',$data);
	 }
	 function userLogin(){
	     $this->load->view('default/login');
	 }
	function product(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/product_list');
	}
	function address_list_map(){
		$this->session->set_userdata ( 'menu', 'address' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/address_list_map');
	}
	
	function address_list_map_edit(){
		$this->session->set_userdata ( 'menu', 'address' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/address_list_map_edit');
	}
	function account_address_list(){
		$this->session->set_userdata ( 'menu', 'address' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/account_address_list');
	}
	function wechat_checkout(){
		$this->session->set_userdata ( 'menu', 'address' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/wechat_checkout');
	}
	function luteagarden(){
		$this->session->set_userdata ( 'menu', 'address' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/luteagarden');
	}
	function product_details(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/product_details');
	}
	function product_show_details(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/product_show_details');
	}
	function homeshow(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/homeshow');
	}
	function cart_list(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/cart_list');
	}
	function login(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/login');
	}
	function admin_login(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/admin_login');
	}
	function register(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/register');
	}
	
	function password_list(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/password_list');
	}
	function password_reset(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/password_reset');
	}
	function password_sms_reset(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/password_sms_reset');
	}
	function account_list(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/account_list');
	}
	function account_personalinfo(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/account_personalinfo');
	}
	function address_list(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/address_list');
	}
	function account_address(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/account_address');
	}
	function account_orderhistory(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/account_orderhistory');
	}
	function account_invoices(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/account_invoices');
	}
	function account_invoicestitle(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/account_invoicestitle');
	}
	function account_loyaltypoints(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/account_loyaltypoints');
	}
	function account_referral(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/account_referral');
	}
	function product_categories(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/product_categories');
	}
	function checkcode(){
// 	    session_start();
	    $code=$this->input->post('code');
	    $data['code']=$code;
	    $this->load->view('default/ajax_checkcode_oneortwo',$data);
	}
	function send_contactformpage(){
	    $first_name=$this->input->post('first_name');
	
	    $email=$this->input->post('email');
	    $purpose=$this->input->post('purpose');
	    $phone=$this->input->post('phone');
	   
	    $message=$this->input->post('message');
		$created=$this->input->post('created');
	    $arr=array('contactus_name'=>$first_name,'contactus_email'=>$email,'contactus_phone'=>$phone,'contactus_question'=>$message,'contactus_purpose'=>$purpose,'created'=>$created);
	    $contact_id=$this->ContactusModel->insert_contact($arr);
	    
// 	    $this->send_contactform_page(13,$contact_id,$subject,$this->langtype);
	}
    function about_us(){
		$this->session->set_userdata ( 'menu', 'about' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/about_us');
	}
	function faq(){
	    $this->session->set_userdata ( 'menu', 'faq' );
	    $data ['website_title'] = 'saucepan';
	    $this->load->view('default/faq');
	}
	function services(){
	    $this->session->set_userdata ( 'menu', 'services' );
	    $data ['website_title'] = 'saucepan';
	    $this->load->view('default/services');
	}
	function events(){
		$this->session->set_userdata ( 'menu', 'events' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/events');
	}
	function contact(){
		$this->session->set_userdata ( 'menu', 'contact' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/contact');
	}
	function case_studies(){
		$this->session->set_userdata ( 'menu', 'studies' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/case_studies');
	}

	function case_detail($id){
        $data['case_detail_info'] = $this->CasestudyModel->getcasestudyinfo($id);
        $this->load->view('default/case_detail',$data);
    }
	
	function details_determinant(){
		$this->session->set_userdata ( 'menu', 'home' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/details_determinant');
	}
	function details_ratio(){
		$this->session->set_userdata ( 'menu', 'home' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/details_ratio');
	}
	
	function details_mthd(){
		$this->session->set_userdata ( 'menu', 'home' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/details_mthd');
	}
	
	function details_wecare(){
		$this->session->set_userdata ( 'menu', 'home' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/details_wecare');
	}
	function details_mila(){
		$this->session->set_userdata ( 'menu', 'home' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/details_mila');
	}
	function details_cali(){
		$this->session->set_userdata ( 'menu', 'home' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/details_cali');
	}
	function details_ideal(){
	    $this->session->set_userdata ( 'menu', 'home' );
	    $data ['website_title'] = 'saucepan';
	    $this->load->view('default/details_ideal');
	}
	function details_book(){
	    $this->session->set_userdata ( 'menu', 'home' );
	    $data ['website_title'] = 'saucepan';
	    $this->load->view('default/details_book');
	}
	function details_mthd_fitness(){
		$this->session->set_userdata ( 'menu', 'home' );
		$data ['website_title'] = 'saucepan';
		$this->load->view('default/details_mthd_fitness');
	}
	
	
	
	/*
	 * 上传图片
	 */
	function uplogo($default_width = 0, $default_height = 0) {
		$this->load->library ( 'app' );
		$pic = $_FILES ['logo'];
		$picname = explode ( '.', $pic ['name'] );
		$pic ['name'] = time () . rand ( 0, 1000 ) . '.' . $picname [count ( $picname ) - 1];
	
		$uploaddir = "upload/";
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
		$path = $uploaddir . $pic ['name'];
		if (file_exists ( $path )) {
			$path = 'upload/' . '(new)' . $pic ['name'];
		}
		move_uploaded_file ( $pic ['tmp_name'], $path );
		if ($default_width > 0 && $default_height > 0) {
			$img_width = getImgWidth ( $path ); /* 获取宽度 */
			$img_height = getImgHeight ( $path ); /* 获取高度 */
			if ($img_width == $default_width && $img_height == $default_height) {
				// 如果上传的图片大小和给定的图片尺寸大小一致则不操作
			} else {
				$this->app->my_image_resize ( $path, $path, $default_width, $default_height );
			}
		}
		// 添加到临时文件表中
		$this->WelModel->add_file_interim ( array ('file_path' => $path,'created' => time () ) );
	
		$jsonarr = array ('name' => $pic ['name'],'logo' => $path );
		$jsonarr = json_encode ( $jsonarr );
		echo $jsonarr;
	}
	
	/*
	 * 等比例缩放
	 */
	function uplogo_deng($default_width = 0, $default_height = 0) {
		$this->load->library ( 'app' );
		$pic = $_FILES ['logo'];
		$picname = explode ( '.', $pic ['name'] );
		$pic ['name'] = time () . rand ( 0, 1000 ) . '.' . $picname [count ( $picname ) - 1];
	
		$uploaddir = "upload/";
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
		$path = $uploaddir . $pic ['name'];
		if (file_exists ( $path )) {
			$path = 'upload/' . '(new)' . $pic ['name'];
		}
		move_uploaded_file ( $pic ['tmp_name'], $path );
		$img_width = getImgWidth ( $path ); /* 获取宽度 */
		$img_height = getImgHeight ( $path ); /* 获取高度 */
		if ($img_width >= $img_height && $img_width > $default_width) {
			resizeImage ( $path, $img_width, $img_height, ($default_width / $img_width) ); // 等比例压缩
		} else if ($img_height > $img_width && $img_height > $default_width) {
			resizeImage ( $path, $img_width, $img_height, ($default_width / $img_height) ); // 等比例压缩
		}
		// 添加到临时文件表中
		$this->WelModel->add_file_interim ( array ('file_path' => $path,'created' => time () ) );
	
		$jsonarr = array ('name' => $pic ['name'],'logo' => $path );
		$jsonarr = json_encode ( $jsonarr );
		echo $jsonarr;
	}
	
	
	
	
	
	// function changelanguage($lan, $url) {
	// 	$url = str_replace ( 'slash_tag', '/', $url );
	// 	$url = base64_decode ( $url );
	// 	$this->session->set_userdata ( 'lang', $lan );
	// 	redirect ( $url );
	// }
	function changelanguage($lan, $url) {
		$url = str_replace ( 'slash_tag', '/', $url );
		$url = base64_decode ( $url );
		
		if($lan == 'ch'){
			$url = str_replace('/en/', '/cn/', $url);
		}else{
			$url = str_replace('/cn/', '/en/', $url);
		}
		
		$this->session->set_userdata ( 'lang', $lan );
		redirect ($url);
	}
	//加载发票按钮
	function loading_invoice_button($order_id, $order_price){
		$sql = "SELECT * FROM ".DB_PRE()."order_invoice WHERE order_id = ".$order_id;
		$orderinfo = $this->db->query($sql)->row_array();
		if(!empty($orderinfo)){
			
		}else{
			$arr = array('order_id'=>$order_id, 'order_price'=>$order_price);
			$this->db->insert(DB_PRE().'order_invoice', $arr);
			$invoice_id = $this->db->insert_id();
			
			$sql = "SELECT * FROM ".DB_PRE()."order_invoice WHERE order_id = ".$order_id;
			$orderinfo = $this->db->query($sql)->row_array();
		}
		echo '<div style="text-align:center">';
			if($orderinfo['res_fapiao_pdfUrl'] != ''){
				echo '<div  onclick="toapplyfapiaowith_qrcode('.$orderinfo['order_id'].')" style="cursor:pointer;background-color:green;color:white;line-height:42px;padding:0px 6px;border-radius:4px;">
					View Invoice
				</div>';
			}else{
				if($orderinfo['fapiao_orderNo'] != ''){
					$kaipiaozhuangtai = $this->OrderModel->toshow_order_kaipiaozhuangtai($orderinfo['order_id']);
					if($kaipiaozhuangtai == 'has_invoiced'){//已经开票了
		    			echo '<div  onclick="toapplyfapiaowith_qrcode('.$orderinfo['order_id'].')" style="cursor:pointer;background-color:green;color:white;line-height:42px;padding:0px 6px;border-radius:4px;">
        						View Invoice
        				</div>';
					}else if($kaipiaozhuangtai == 'unscan'){//用户还没有扫描二维码开票
		    			echo '<div  onclick="toapplyfapiaowith_qrcode('.$orderinfo['order_id'].')" style="cursor:pointer;background-color:orange;color:white;line-height:42px;padding:0px 6px;border-radius:4px;">
		        				Not Scanned
		        		</div>';
					}else if($kaipiaozhuangtai == 'scaned_butunapply'){//扫描了，但是还没有申请
		    			echo '<div  onclick="toapplyfapiaowith_qrcode('.$orderinfo['order_id'].')" style="cursor:pointer;background-color:purple;color:white;line-height:42px;padding:0px 6px;border-radius:4px;">
		        			Scanned, Not Applied
		        		</div>';
					}else if($kaipiaozhuangtai == 'zhengzaikaipiaozhong'){//正在开票中
		    			echo '<div class="row" onclick="toapplyfapiaowith_qrcode('.$orderinfo['order_id'].')" style="cursor:pointer;background-color:#EFEFEF;color:gray;line-height:42px;padding:0px 6px;border-radius:4px;">
		        			Billing in progress
		        		</div>';
					}
				}else{
		    		echo '<div  onclick="toapplyfapiaowith_xunwen('.$orderinfo['order_id'].')" style="cursor:pointer;background-color:red;color:white;line-height:42px;padding:0px 6px;border-radius:4px;">
		    			Apply for invoice
		    		</div>';
				}
			}
		echo '</div>';
	}
	//发票
	function fapiao_content_show($order_id) {
		header("Content-type: text/html; charset=utf-8");
	
		$uploaddir = "upload/fapiao";
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
		$uploaddir = "upload/fapiao/".date('Y');
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
		$uploaddir = "upload/fapiao/".date('Y')."/".date('m');
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
	
		require './lib/DD.php';
	
		// 		//测试
		// 		$baseUri = "http://fptest.360ddj.com";
		// 		$platCode = "DCCS";
		// 		$orgCode = "DDJFP202105240002B";
		// 		$authCode = "67994740";
		// 		$privateKey = "MIICdQIBADANBgkqhkiG9w0BAQEFAASCAl8wggJbAgEAAoGBAJabMEW7MaYbjO2KE4r5QCWAPJYnUP4t/2W2BI+XCYJfmVgt0ZzXrRFkHjwCFNDBWqE3deoV4TfRgiujDLSV8lsgQJTuYi8Uua6clZwfnC9wwdAcxXVHhtEutH8WuXzDf9rxFabQse8H2on2ItzG3BY8z2eoAM+3N2fSQXGcilCnAgMBAAECgYAWYy9DzlXNCV9jmBjbmb2NVYisEWAayJ+kcPAwoBULykYzM2xrUiwp36YW6YBKn9NnD6V5jJMUBxLAhdZHqdqCsipxelm0KeDB1ETBZdjAX5d0wELYOE3ZzCWvRzvt6baY7t3e2j9KELsGWHj0GyrYFCWHg5eOVDpP2t9RFrUrQQJBAOWoRNBJlu5C8NKz1bh2vo9aNfF8DXUJH6lFdsb/U2IyiWeZ5psVR1lDKBgtTL+bC4tOfhh2XDyyzr7ufwsRADcCQQCn4aNK8qKsJFdh9qYDO8V8jegQfmv/G+/M0Xwe3vkko5kvVC7+h5JldRZo74DjmJ6qNWX71JwOtXkJrOyg+JsRAkAU5xzkTF5lb0hWFTI1qPEtQQu54A2lgmAUWxM1h5XCUVE6UcKwiN5GnJswoCblJaqGUm2dsmAw0iGJNVHw4uo/AkAFFwc/Z3ndJEDt/G9uG6rSKu9FSL/3fR5ZJGTR/sqo/LjRQYknOG8M2m7ygYhz3hW5bWMJLpoIrCHeVDrcao0xAkAjccZwFESfXKmDAufgyH0p3+2WieVbT3+oKqK+4H8xzAewOPyaSDfdlITzYtYtsjwRciLBTMAP7iE7c65KgUfb";
	
		//正式
		$baseUri = "http://api.360ddj.com";//http://api.360ddj.com
		$platCode = "NYCT";
		$orgCode = "DDJFP202106080003N";
		$authCode = "95549880";
		$privateKey = "MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAMNefkuOYPfkpFHYuEzGw9Mn6edRPTnNeeHFlJev6NGotKithVHTFzO+HhJdPl9NXsc3plnA0CqergcgZLAWTBbulrQnMxzxSyHWMAUuqZLgWLXm93Rooj9UcSeH5TZgmcaTXplIxJJXigr3mLb8VWoQnG47Ck1XiZynv1Nd0y+5AgMBAAECgYEAqPmSjHDxx5Y21R93j9geSQRtlwc5yEPC1hYYxfV8jdG3p2ilNbc4iyU1RzbkmnMFtZKZS2mr4iDqbfmDfJVcaro9mCL1xrVrw705YJy+jH1+cEOnEPfKoiqM8efWkjP5sPUThTP5xdYji8r7PKFVHjkdbGegnlUm1vcQG1aQJwECQQDi2AdIMgTjONYJulxhnGVAl+Z96BiDNg/oTSgGdsDwBzYHQnpkwk/dHKgjWg3yRjcoP7wpXOLHpztFANt7L+zZAkEA3HrVY6ZUmabIpOC5f1MO/nYUTowspZX6zTk1k4WVDmM8+AfALRep2m8ckgfOeQN4z4PHFoAxu+G6wpbuLvUN4QJBAKp0plQrsdyEMuGwdgarHLKC8iIeK309PIrUn4Tr62LyKDkgTRQ1pwmBpR6bZutss7m82slCEO7xzOm3ETXp91ECQD3LL4N+Wre1xwZu9Y55+PnYnlhlcR33qxNZtWpjRiOCLNRXV8VLnI9cFOXYykWgc3u1s1bbFxVRbsabBqaiiAECQQDXgUlk4MYgJQNkN+H9OA5WAAP7ebiYH4NXE7n1ipOCikRi2yxSk7VKmHHz1WavW69Q16yh1PfbtxoJtpy0+qS+";
	
		$sql = "SELECT * FROM ".DB_PRE()."order_invoice WHERE order_id = ".$order_id;
		$orderinfo = $this->db->query($sql)->row_array();
			
		if(!empty($orderinfo)){
			if($orderinfo['res_fapiao_pdfUrl'] != ''){
				//已经扫描申请过了
				$res_fapiao_date = $orderinfo['res_fapiao_date'];
				$res_fapiao_no = $orderinfo['res_fapiao_no'];
				$res_fapiao_code = $orderinfo['res_fapiao_code'];
				$res_fapiao_pdfUrl = $orderinfo['res_fapiao_pdfUrl'];
				$res_fapiao_tax = $orderinfo['res_fapiao_tax'];
				$res_fapiao_amount = $orderinfo['res_fapiao_amount'];
	
				echo '
					<div style="float:left;width:calc(100% - 40px);padding:20px;">
						<div style="float:left;width:100%;text-align:left;line-height:25px;">
							Billing orderNo: <span style="color:gray;">'.$orderinfo['fapiao_orderNo'].'</span>
						</div>
						<div style="float:left;width:100%;text-align:left;line-height:25px;">
							Billing date: <span style="color:gray;">'.$res_fapiao_date.'</span>
						</div>
						<div style="float:left;width:100%;text-align:left;line-height:25px;">
							Billing code: <span style="color:gray;">'.$res_fapiao_code.'</span>
						</div>
						<div style="float:left;width:100%;text-align:left;line-height:25px;">
							Billing no: <span style="color:gray;">'.$res_fapiao_no.'</span>
						</div>
						<div style="float:left;width:100%;text-align:left;line-height:25px;">
							Billing tax: <span style="color:gray;">'.$res_fapiao_tax.'</span>
						</div>
						<div style="float:left;width:100%;text-align:left;line-height:25px;">
							Billing amount: <span style="color:gray;">'.$res_fapiao_amount.'</span>
						</div>
						<div style="display:none;float:left;width:100%;text-align:left;line-height:16px;padding:4px 0px;color:blue;word-wrap: break-word;word-break:break-all;">
							'.$res_fapiao_pdfUrl.'
						</div>
						<div style="float:left;width:100%;text-align:left;line-height:25px;">
							Download: <a href="'.$res_fapiao_pdfUrl.'" target="blank;" style="color:blue;border-bottom:1px solid blue;">Download</a>
						</div>
						<div style="display:none;float:left;width:100%;text-align:left;line-height:25px;">
							Copy the URL above and paste it into the browser to download
						</div>
					</div>
				';
			}else{
				////
				if($orderinfo['fapiao_qrimage'] != '' && $orderinfo['fapiao_qrUrl'] != '' && $orderinfo['fapiao_orderNo'] != ''){
					$fapiao_qrUrl = $orderinfo['fapiao_qrUrl'];
					$fapiao_qrimage = $orderinfo['fapiao_qrimage'];
					$fapiao_orderNo = $orderinfo['fapiao_orderNo'];
	
					$client = new DD($baseUri, $platCode, $orgCode, $authCode, $privateKey);
					$d = $client->queryInvoice($fapiao_orderNo);
					if($d['code'] == 1000){
						//表示用户还没有扫描二维码开票
						echo '
						<div style="float:left;width:calc(100% - 40px);padding:20px;">
							<div style="float:left;width:100%;">
								<img style="float:left;width:240px;height:240px;margin-left:calc(50% - 120px);" src="'.base_url().$fapiao_qrimage.'"/>
							</div>
							<div style="float:left;width:100%;text-align:center;">
								Scan or identify the QR code for billing
							</div>
						</div>
					';
					}else{
						if(isset($d['contentMsgDecode']['pdfUrl'])){
							//已经扫描申请过了
							$res_fapiao_date = $d['contentMsgDecode']['date'];
							$res_fapiao_no = $d['contentMsgDecode']['no'];
							$res_fapiao_code = $d['contentMsgDecode']['code'];
							$res_fapiao_pdfUrl = $d['contentMsgDecode']['pdfUrl'];
							$res_fapiao_tax = $d['contentMsgDecode']['tax'];
							$res_fapiao_amount = $d['contentMsgDecode']['amount'];
	
							if($res_fapiao_date != '' && $res_fapiao_no != '' && $res_fapiao_no != '' && $res_fapiao_tax != '' && $res_fapiao_amount != ''){
								$arr = array();
								$arr['res_fapiao_date'] = $res_fapiao_date;
								$arr['res_fapiao_code'] = $res_fapiao_code;
								$arr['res_fapiao_no'] = $res_fapiao_no;
								$arr['res_fapiao_pdfUrl'] = $res_fapiao_pdfUrl;
								$arr['res_fapiao_tax'] = $res_fapiao_tax;
								$arr['res_fapiao_amount'] = $res_fapiao_amount;
								$arr['res_fapiao_data'] = json_encode($d);
								$this->OrderModel->edit_invoice($order_id, $arr);
	
								echo '
									<div style="float:left;width:calc(100% - 40px);padding:20px;">
										<div style="float:left;width:100%;text-align:left;line-height:25px;">
											Billing orderNo: <span style="color:gray;">'.$orderinfo['fapiao_orderNo'].'</span>
										</div>
										<div style="float:left;width:100%;text-align:left;line-height:25px;">
											Billing date: <span style="color:gray;">'.$res_fapiao_date.'</span>
										</div>
										<div style="float:left;width:100%;text-align:left;line-height:25px;">
											Billing code: <span style="color:gray;">'.$res_fapiao_code.'</span>
										</div>
										<div style="float:left;width:100%;text-align:left;line-height:25px;">
											Billing no: <span style="color:gray;">'.$res_fapiao_no.'</span>
										</div>
										<div style="float:left;width:100%;text-align:left;line-height:25px;">
											Billing tax: <span style="color:gray;">'.$res_fapiao_tax.'</span>
										</div>
										<div style="float:left;width:100%;text-align:left;line-height:25px;">
											Billing amount: <span style="color:gray;">'.$res_fapiao_amount.'</span>
										</div>
										<div style="display:none;float:left;width:100%;text-align:left;line-height:16px;padding:4px 0px;color:blue;word-wrap: break-word;word-break:break-all;">
											'.$res_fapiao_pdfUrl.'
										</div>
										<div style="float:left;width:100%;text-align:left;line-height:25px;">
											Download: <a href="'.$res_fapiao_pdfUrl.'" target="blank;" style="color:blue;border-bottom:1px solid blue;">Download</a>
										</div>
										<div style="display:none;float:left;width:100%;text-align:left;line-height:25px;">
											Copy the URL above and paste it into the browser to download
										</div>
									</div>
								';
							}else{
								echo '
									<div style="float:left;width:calc(100% - 40px);padding:20px;">
										<div style="float:left;width:100%;text-align:left;line-height:25px;">
											Billing in progress
										</div>
									</div>
								';
							}
								
						}else{
							//扫描了但是还没有申请
							echo '
								<div style="float:left;width:calc(100% - 40px);padding:20px;">
									<div style="float:left;width:100%;">
										<img style="float:left;width:240px;height:240px;margin-left:calc(50% - 120px);" src="'.base_url().$fapiao_qrimage.'"/>
									</div>
									<div style="float:left;width:100%;text-align:center;">
										Scan or identify the QR code for billing
									</div>
								</div>
							';
						}
					}
				}else{
					//创建新的二维码
					$client = new DD($baseUri, $platCode, $orgCode, $authCode, $privateKey);
	
					$d = $client->getQrCode($orderinfo['order_price']);
					if(!empty($d)){
						if(isset($d['contentMsgDecode']['qrUrl'])){
							$fapiao_qrUrl = $d['contentMsgDecode']['qrUrl'];
						}else{
							$fapiao_qrUrl = '';
						}
						if(isset($d['contentMsgDecode']['orderNo'])){
							$fapiao_orderNo = $d['contentMsgDecode']['orderNo'];
						}else{
							$fapiao_orderNo = '';
						}
							
						$qrcode_url = $fapiao_qrUrl;
							
						include 'lib/phpqrcode/phpqrcode.php';
						$value = $qrcode_url; //二维码内容
						$errorCorrectionLevel = 'L';//容错级别
						$matrixPointSize = 8;//生成图片大小
						//生成二维码图片
						QRcode::png($value, 'upload/qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);
						$logo = 'themes/default/images/saucepan_logo_letter.png';//准备好的logo图片
						$QR = 'upload/qrcode.png';//已经生成的原始二维码图
	
						if ($logo !== FALSE) {
							$QR = imagecreatefromstring(file_get_contents($QR));
							$logo = imagecreatefromstring(file_get_contents($logo));
							$QR_width = imagesx($QR);//二维码图片宽度
							$QR_height = imagesy($QR);//二维码图片高度
							$logo_width = imagesx($logo);//logo图片宽度
							$logo_height = imagesy($logo);//logo图片高度
							$logo_qr_width = $QR_width / 5;
							$scale = $logo_width/$logo_qr_width;
							$logo_qr_height = $logo_height/$scale;
							$from_width = ($QR_width - $logo_qr_width) / 2;
	
							//$dst_img = imagecreatetruecolor($logo_width, $logo_height);
							//imagealphablending($dst_img, false);//这里很重要,意思是不合并颜色,直接用$img图像颜色替换,包括透明色;
							//imagesavealpha($dst_img, true);//这里很重要,意思是不要丢了$thumb图像的透明色;
	
							//重新组合图片并调整大小
							imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
							$logo_qr_height, $logo_width, $logo_height);
						}
						//输出图片
						imagepng($QR, $uploaddir.'/fapiao_qrcode_'.$orderinfo['order_id'].'.png');
							
						$fapiao_qrimage = $uploaddir.'/fapiao_qrcode_'.$orderinfo['order_id'].'.png';
							
							
						$arr = array('fapiao_applytime'=>mktime());
						$arr['fapiao_qrUrl'] = $fapiao_qrUrl;
						$arr['fapiao_qrimage'] = $fapiao_qrimage;
						$arr['fapiao_orderNo'] = $fapiao_orderNo;
						$arr['fapiao_data'] = json_encode($d);
						$this->OrderModel->edit_invoice($order_id, $arr);
							
						echo '
							<div style="float:left;width:calc(100% - 40px);padding:20px;">
								<div style="float:left;width:100%;">
									<img style="float:left;width:240px;height:240px;margin-left:calc(50% - 120px);" src="'.base_url().$fapiao_qrimage.'"/>
								</div>
								<div style="float:left;width:100%;text-align:center;">
									Scan or identify the QR code for billing
								</div>
							</div>
						';
					}
				}
				////
			}
				
		}
	
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */