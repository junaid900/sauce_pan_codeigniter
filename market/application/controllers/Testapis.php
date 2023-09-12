<?php
defined('BASEPATH') or exit('No direct script access allowed');

//use Restserver\Libraries\REST_Controller;
use CodeIgniter\HTTP\RequestInterface;

class Testapis extends CI_Controller
{

    public $language = "ch";

    public function __construct()
    {
        parent::__construct();
        error_reporting(-1);
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, *');      //  echo json_encode($_SERVER);

        if (!isset($this->input->request_headers()['Apikey'])) {
            $this->response(0, "Unauthorized access", []);
        }
        if ($this->input->request_headers()['Apikey'] != apikey()) {
            $this->response(0, "Unauthorized access", []);
        }
        $this->output->set_header('Authorization : APIKEY ' . apikey() . '');
        $this->output->set_header('Content-Type : application/json; charset=UTF-8');
        $postdata = file_get_contents("php://input");
        // echo $postdata
        if (isset($postdata)) {
            if (!empty($postdata)) {
                $post_data = json_decode($postdata, true);
                //  print_r($post_data);
                $_REQUEST = $post_data;
//                  print_r($_REQUEST);
            }
        }
//        if(count($_POST) > 0){
//            array_push($_REQUEST,$_POST);
//        }

//        if(count($_GET) > 0){
//            array_push($_REQUEST,$_GET);
//        }
//        print_r($_POST);
        if (isset($_REQUEST["lang"])) {
            $this->language = $_REQUEST["lang"];
        }
    }

	//临时订单支付成功后调用
	function paysuccess_temporary(){
// 	    $this->OrderModel->sendwechatnotice_ordernotice(207, 1);//付款成功后发送微信订单通知
// 	    exit;
// 	    $this->OrderModel->sendwechatnotice_ordershipped(207, 1);//付款成功后发送微信订单通知
// 	    exit;
	    
		if (!isset($_REQUEST['order_id'])) {
			$this->response(0, "missing params", []);
		}else{
			$order_id = $_REQUEST['order_id'];
		}
		if(!isset($_REQUEST['users_system_id'])){
			$this->response(0, "missing params", []);
		}else{
			$users_system_id = $_REQUEST['users_system_id'];
		}
			
		$orderinfo = $this->OrderModel->getorderinfo($order_id);
		$userinfo = $this->UserModel->getuserinfo($users_system_id);
		
		if(!empty($orderinfo) && !empty($userinfo)){
// 			$arr = array();
// 			$arr['payment_method'] = 'WeChat_Pay';
// 			$arr['payment_status'] = 'Paid';
// 			$arr['wechatpay_time'] = time();
// 			$this->OrderModel->edit_order($order_id, $arr);
			
// 			$this->OrderModel->sendwechatnotice_ordernotice($order_id);//付款成功后发送微信订单通知
			
			$this->response(1, "Success", []);
		}else{
			$this->response(0, "Error", []);
		}
	}


    private function checkToken()
    {
        return;

        if (!isset($_REQUEST['token'])) {
            $this->response(0, "invalid token (Cannot connect)", []);
        }
        $isValid = isTokenValid($_REQUEST["token"]);
        if (!$isValid) {
            $this->response(0, "invalid token (Cannot connect)", []);
        }
    }


    public function response($status = 0, $message = "Unauthorized Access", $response = [])
    {
//        $this->checkToken();
        $resp = [
            "status" => $status,
            "message" => $message,
            "response" => (!empty($response)) ? $response : [],
        ];
//        $this->output
//            ->set_content_type('application/json')
//            ->set_output(json_encode($resp));
        echo json_encode($resp);
        exit();
    }


}