<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	//微信支付成功后回调
	function index(){
	    header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	    
	    /**
	     * example目录下为简单的支付样例，仅能用于搭建快速体验微信支付使用
	     * 样例的作用仅限于指导如何使用sdk，在安全上面仅做了简单处理， 复制使用样例代码时请慎重
	     * 请勿直接直接使用样例对外提供服务
	     **/
	    
	    require_once "lib/wechatpay/WxPay.Api.php";
	    require_once 'lib/wechatpay/WxPay.Notify.php';
	    require_once "lib/wechatpay/WxPay.Config.php";
	    require_once 'lib/wechatpay/log.php';
	    require_once 'lib/wechatpay/WxPay.NotifyCallBack.php';
	    
	    
	    $config = new WxPayConfig();
	    $notify = new PayNotifyCallBack();
	    $nnnn = $notify->Handle($config, false);
	    
	    if($nnnn != false){
	        $out_trade_no = $nnnn['out_trade_no'];
	        $bank_type = $nnnn['bank_type'];
	        $total_fee = $nnnn['total_fee'];
	        $fee_type = $nnnn['fee_type'];
	        $transaction_id = $nnnn['transaction_id'];
	        
	        $wechatpay_transaction_data = json_encode($nnnn);
	        //continue
	    }
	    echo 'SUCCESS';
	}
	
}
