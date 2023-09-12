<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Welcome extends CI_Controller {
function __construct() {
		session_start ();
		parent::__construct ();

        // if(isset($_COOKIE[DB_PRE().'admin_info'])){
        //     $admin_info = unserialize($_COOKIE[DB_PRE().'admin_info']);
        //     $this->admin_id = $admin_info['uid'];
        //     $this->admin_username = $admin_info['user_name'];
        // }else{
        //     $this->admin_id = 0;
        //     $this->admin_username = '';
        //     redirect('admin/index');
        // }

		$lang = $this->session->userdata('lang');
		if($lang == 'ch'){
			$this->session->set_userdata('lang','ch');
			$this->langtype='_ch';
			$this->lang->load('gksel','chinese');
		}else if($lang == 'tw'){
			$this->session->set_userdata('lang','tw');
			$this->langtype='_tw';
			$this->lang->load('gksel','taiwan');
		}else{
			$this->session->set_userdata('lang','en');
			$this->langtype='_en';
			$this->lang->load('gksel','english');
		}
		// if($lang == 'fr'){
		//     $this->session->set_userdata('lang','fr');
		//     $this->langtype='_fr';
		//     $this->lang->load('gksel','french');
		    
		// }else{
		//     $this->session->set_userdata('lang','en');
		//     $this->langtype='_en';
		//     $this->lang->load('gksel','english');
		// }
		
		if(isset($_COOKIE[DB_PRE().'admin_info'])){
			$admin_info = unserialize($_COOKIE[DB_PRE().'admin_info']);
			$this->admin_id = $admin_info['uid'];
		}else{
			$this->admin_id = 0;
		}
		
	}
	public function index() {
		$this->session->set_userdata ( 'menu', 'home' );
		// $data ['website_title'] = 'HYGENTO';

		// //Total No. of Users
  //       $arr = array(
  //           'user_type_id_in'=>'2,3'
  //       );
  //       $user_count = $this->UserModel->get_user_list($arr,1);
  //       $data['user_count'] = $user_count;

  //       //Number of New Users Today
  //       $today_start = strtotime(date('Y-m-d'). ' 00:00:00');
  //       $arr = array(
  //           'user_type_id_in'=>'2,3',
  //           'sign_up_start_time'=>$today_start,
  //           'sign_up_end_time'=>time(),
  //       );
  //       $new_user_count = $this->UserModel->get_user_list($arr,1);
  //       $data['new_user_count'] = $new_user_count;

  //       //Total Clinics
  //       $arr = array(
  //           'status_id'=>'1'
  //       );
  //       $clinic_count = $this->ClinicModel->get_store_list($arr,1);
  //       $data['clinic_count'] = $clinic_count;

  //       //New Clinics Today
  //       $arr = array(
  //           'status_id'=>'1',
  //           'sign_up_start_time'=>$today_start,
  //           'sign_up_end_time'=>time(),
  //       );
  //       $new_clinic_count = $this->ClinicModel->get_store_list($arr,1);
  //       $data['new_clinic_count'] = $new_clinic_count;

  //       //Total Products online
  //       $arr = [
  //           'status' => 6,
  //           //是否已过期
  //           'expired_time'=>time(),
  //           'orderby' => 'a.created',
  //           'orderby_res' => 'DESC'
  //       ];
  //       $online_service_count = $this->ServiceModel->get_service_list($arr,1);
  //       $data['online_service_count'] = $online_service_count;

  //       //Number of Bookings
  //       $arr = [
  //           'statusin'=>'8,10',
  //           'group_by' => 't.id'
  //       ];

  //       $booking_service_count = $this->OrderModel->get_order_list($arr, 1);
  //       $data['booking_service_count'] = $booking_service_count;

  //       //Sales Summary
  //       $total_sales = $this->OrderModel->get_order_list($arr, 2);
  //       $data['total_sales'] = $total_sales;

		$this->load->view ('admins/home' );
	}
	
	/**
	 *分类修改
	 */
	function category_list(){
		$this->session->set_userdata ( 'menu', 'category' );
	    $this->load->view ('admins/category_list' );
	}
    /**
     *获取预定人数
     */
	function get_booking_service_count(){
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        
        $arr = [
            'statusin'=>'8,10',
            'group_by' => 't.id'
        ];
        if($start_time != ''){
            $arr['start_time'] = strtotime($start_time.' 00:00:00');
        }
        if($end_time != ''){
            $arr['end_time'] = strtotime($end_time.' 23:59:59');
        }
        
        $booking_service_count = $this->OrderModel->get_order_list($arr, 1);

        echo json_encode(array('booking_service_count'=>$booking_service_count));
    }
    /**
     *获取营业额
     */
    function get_sales_summary(){
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        //Number of Bookings
        $arr = [
            'statusin'=>'8,10',
            'group_by' => 't.id'
        ];
        if($start_time != ''){
            $arr['start_time'] = strtotime($start_time.' 00:00:00');
        }
        if($end_time != ''){
            $arr['end_time'] = strtotime($end_time.' 23:59:59');
        }

        $total_sales = $this->OrderModel->get_order_list($arr, 2);

        echo json_encode(array('total_sales'=>$total_sales));
    }

	function user() {
		$this->session->set_userdata ( 'menu', 'user' );
		$data ['website_title'] = 'HYGENTO';
		$keyword = $this->input->get('keyword');
		$date_time = $this->input->get('date_time');

        //Total No. of Users
        $arr = array(
            'user_type_id_in'=>'2,3'
        );
        if($keyword){
            $arr['user_search_keyword'] = $keyword;
        }
        if($date_time){
            $arr['sign_up_start_time'] = strtotime($date_time.' 00:00:00');
            $arr['sign_up_end_time'] = strtotime($date_time.' 23:59:59');
        }
        $user_list = $this->UserModel->get_user_list($arr);
        $user_count = $this->UserModel->get_user_list($arr,1);

        if($user_list){
            foreach ($user_list as $key=>$value){
                $arr = [
                    'status' => 10,
                    'group_by' => 't.id',
                    'uid' => $value['uid']
                ];

                $booking_service_list = $this->OrderModel->get_order_list($arr);
                $booking_service_count = count($booking_service_list);
                $user_list[$key]['total_order'] = $booking_service_count;
            }
        }
        $data['user_list'] = $user_list;
        $data['user_count'] = $user_count;

	
		$this->load->view ('admin/user_list', $data );
	}
	function clinics_cms(){
		$this->session->set_userdata ( 'menu', 'cms' );
		$data ['website_title'] = 'HYGENTO';
	    $this->load->view ('admin/cms_list',$data);
	}
	function cms_banner_info(){
		$this->session->set_userdata ( 'menu', 'cms' );
		$data ['website_title'] = 'HYGENTO';
	    $this->load->view ('admin/cms_banner_info',$data);
	}
	
	function clinics_profile(){
		$this->session->set_userdata ( 'menu', 'clinic' );
		$data ['website_title'] = 'HYGENTO';
	    $this->load->view ('admin/clinics_profile',$data);
	}
	
	function user_order_view($user_id){
        $user_info = $this->UserModel->get_user_info($user_id);
        $data['user_info'] = $user_info;
        $data['order_list'] = '';
        $this->load->view ('admin/user_order_view',$data);
    }
	function clinic() {
		$this->session->set_userdata ( 'menu', 'clinic' );
		$data ['website_title'] = 'HYGENTO';
		
		$service_type_id = $this->input->get('service_type_id');
		$insurance_type_id = $this->input->get('insurance_type_id');
		$keyword = $this->input->get('keyword');
		
		$con = array('row'=>0, 'page'=>100);
		if($service_type_id){
			$con['service_type_id'] = $service_type_id;
		}
		if($insurance_type_id){
			$con['insurance_type_id'] = $insurance_type_id;
		}
		if($keyword != ''){
			$con['keyword'] = $keyword;
		}
		$data['store_list'] = $this->ClinicModel->get_store_list($con);
		$data['count'] = $this->ClinicModel->get_store_list($con, 1);
	
		$this->load->view ('admin/clinic_list', $data );
	}
	
	function clinic_info($store_id) {
		$this->session->set_userdata ('menu', 'clinic');
		$data ['website_title'] = 'HYGENTO';
		
		$data['store_info'] = $this->ClinicModel->get_store_info($store_id);
	
		$this->load->view ('admin/clinic_info', $data);
	}
	
	function clinic_edit() {
		$this->session->set_userdata ( 'menu', 'clinic' );
		$data ['website_title'] = 'HYGENTO';
	
		$this->load->view ('admin/clinic_edit', $data );
	}
	
	function product() {
		$this->session->set_userdata ( 'menu', 'product' );
		$data ['website_title'] = 'HYGENTO';
		$con = [
			'orderby' => 'a.created',
			'orderby_res' => 'DESC'
		];
		
		$entrytype = $this->input->get('entrytype');
		if($entrytype == '' || $entrytype == 1){
			$con['isexpired'] = 0;
		}else{
			$con['isexpired'] = 1;
		}
		
		if($_GET){
			$date_time = $this->input->get('date_time');
			$service_type_id = $this->input->get('service_type_id');
			$insurance_type_id = $this->input->get('insurance_type_id');
			$location_id = $this->input->get('location_id');
		
			if($date_time && date('Y-m-d',strtotime($date_time)) == $date_time){
				$con['date_time'] = strtotime($date_time);
			}
			if($service_type_id){
				$con['service_type_id'] = $service_type_id;
			}
			if($insurance_type_id){
				$con['insurance_type_id'] = $insurance_type_id;
			}
		
			if($location_id != ''){
				$con['location_id'] = $location_id;
			}
		}
		$data['service_list'] = $this->ServiceModel->get_service_list($con);
		$this->load->view ('admin/clinic_product', $data);
	}
	function booking() {
		$this->session->set_userdata ( 'menu', 'booking' );
		$data ['website_title'] = 'HYGENTO';
		
		$entrytype = $this->input->get('entrytype');
		
		$con = [
		    'orderby'=>'o.created',
		    'orderby_res'=>'DESC'
		];
		if($entrytype == '' || $entrytype == 1){
		    $con['statusin'] = '8,10';
		}else if($entrytype != '' && $entrytype == 2){
		    $con['statusin'] = '11';
		}
		
		if($_GET){
		    $date_time = $this->input->get('date_time');
		    $clinic_id = $this->input->get('clinic_id');
		    $service_type_id = $this->input->get('service_type_id');
		    $keyword = $this->input->get('keyword');
		    
		    if($date_time && date('Y-m-d',strtotime($date_time)) == $date_time){
		        $con['date_time'] = strtotime($date_time);
		    }
		    if($clinic_id != '' && $clinic_id != 0){
		        $con['clinic_id'] = $clinic_id;
		    }
		    if($service_type_id){
		        $con['service_type_id'] = $service_type_id;
		    }
		    if($keyword){
		        $con['keyword'] = $keyword;
		    }
		}
		
		$order_list = $this->OrderModel->get_order_list($con);
		$data['order_list'] = $order_list;
		
		$con = array('row'=>0, 'page'=>100);
		$data['store_list'] = $this->ClinicModel->get_store_list($con);
		
		$service_type_list = $this->ServiceModel->get_service_type_list();
		$data['service_type_list'] = $service_type_list;
	
		$this->load->view ('admin/clinic_booking', $data );
	}
	function setto_refundorder($order_id){
	    $arr = array('isrefund_status'=>1);
	    $this->OrderModel->edit_order($order_id, $arr);
	}
	
	
	
	
	
    function index_404(){
        $this->load->view('admin/page_404');
    }

    /**
     * 上传图片
     */
    public function uplogo($default_width = 0, $default_height = 0)
    {
        log_message('debug', '========================================welcome->uplogo()');
        //sessionId输出
        $session_id = $this->session->userdata('session_id');
        log_message('debug', 'session_id='.$session_id);

        $this->load->library('app');
        $pic = $_FILES ['logo'];
        $picname = explode('.', $pic ['name']);
        $pic ['name'] = time() . rand(0, 1000) . '.' . $picname [count($picname) - 1];

        $uploaddir = "upload/clinic/";
        if (! is_dir($uploaddir)) {
            mkdir($uploaddir, 0777);
        }
        $path = $uploaddir . $pic ['name'];
        if (file_exists($path)) {
            $path = 'upload/clinic/' . '(new)' . $pic ['name'];
        }
        move_uploaded_file($pic ['tmp_name'], $path);
        if ($default_width > 0 && $default_height > 0) {
            $img_width = getImgWidth($path); /* 获取宽度 */
            $img_height = getImgHeight($path); /* 获取高度 */
            if ($img_width == $default_width && $img_height == $default_height) {
                // 如果上传的图片大小和给定的图片尺寸大小一致则不操作
            } else {
                $this->app->my_image_resize($path, $path, $default_width, $default_height);
            }
        }

        $jsonarr = array('name' => $pic ['name'],'logo' => $path );
        $jsonarr = json_encode($jsonarr);
        echo $jsonarr;
    }

    /**
     * 多图上传
     */
    public function upload_batch_img() {
        $baseDir = './upload/clinic';
        $ret = array();
//            $file = request()->file('field');
        if (!empty($_FILES)) {
            foreach ($_FILES as $key => $value) {
                if (is_uploaded_file($value['tmp_name'])) {
                    $uploadPath = createDateTimeDir($baseDir);
                    $uniqueFileName = getUniqueFileName($uploadPath);
                    $fileExt = 'png';
                    $uploadFile['name'] = $uniqueFileName . rand(0,99).'.' . $fileExt;
                    $uploadFile['filename'] = $uploadPath . '/' . $uploadFile['name'];
                    if (@move_uploaded_file($value['tmp_name'], $uploadFile['filename'])) {
//                            if ($this->_resize($uploadFile['filename'], $width, $height)) {

                        $path = substr($uploadFile['filename'], 2);
                        $tmp_image_arr = $this->_fliter_image_path($path);
//                                $fields = array(
//                                    'img_path' => $path,
//                                    'promotion_id'=>$promotion_id
//                                );
//                                var_dump($fields);
//                                $attachmentId = $this->UserModel->add_promotion_path($fields);
//                                if ($attachmentId) {
                        $ret[] = array('path' => $path, 'path_url' => $tmp_image_arr['path'],
//                                        'path_thumb_url' => $tmp_image_arr['path_thumb']
                        );
//                                } else {
//                                    echo '上传图片失败';
//                                }
//                            } else {
//                                echo '生成缩略图失败';
//                            }
                    } else {
                        echo '复制文件错误';
                    }
                }
            }

        }
        echo json_encode($ret);
    }
    private function _fliter_image_path($image_path = NULL) {
        $path = '';
//        $path_thumb = '';
        if ($image_path) {
            $path = base_url() . $image_path;
//            $path_thumb = base_url() . preg_replace('/\./', '_thumb.', $image_path);
        }

        return array('path' => $path,
//            'path_thumb' => $path_thumb
        );
    }
    
    
    function approve_clinic($id) {
    	$this->db->update(DB_PRE().'store_list', array('status_id'=>1), array('id'=>$id));
    	
    	$this->OrderModel->send_approved_email($id);
    }
    
    /*
     * 批准诊所账号
     * */
    function send_approved_email($id){
    	$this->OrderModel->send_approved_email($id);
    }
    
    /*
     * 下订单
     * */
    function send_order_email($order_id){
    	$this->OrderModel->send_order_email($order_id);
    }
    /*
     * 下订单
     * */
    function send_forgetpassword_email($uid){
        $this->OrderModel->send_forgetpassword_email($uid);
    }
    
    /*
     * 上传图片
     */
    function upImg($default_width = 0, $default_height = 0) {
        $this->load->library ( 'app' );
        $pic = $_FILES['importFilePath'];
        $picname = explode ( '.', $pic ['name'] );
        $pic ['name'] = mktime () . rand ( 0, 1000 ) . '.' . $picname [count ( $picname ) - 1];
        
        $uploaddir = "upload/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0777 );
        }
        $uploaddir = "upload/clinic/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0777 );
        }
        $uploaddir = "upload/clinic/hygienist/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0777 );
        }
        $path = $uploaddir . $pic ['name'];
        if (file_exists ( $path )) {
            $path = 'upload/clinic/hygienist/' . '(new)' . $pic ['name'];
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
        
        $jsonarr = array ('name' => $pic ['name'],'path' => $path );
        $jsonarr = json_encode ( $jsonarr );
        echo $jsonarr;
    }
    
    
}

/* End of file welcome.php */