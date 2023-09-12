<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	function publicaccount(){
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
	        $order_id = $out_trade_no;
	        $bank_type = $nnnn['bank_type'];
	        $total_fee = $nnnn['total_fee'];
	        $fee_type = $nnnn['fee_type'];
	        $transaction_id = $nnnn['transaction_id'];
	        
	        $arr = array();
	        $arr['payment_method'] = 'WeChat_Pay';
	        $arr['payment_status'] = 'Paid';
	        
	        $arr['wechatpay_total'] = $total_fee/100;
	        $arr['wechatpay_bank_type'] = $bank_type;
	        $arr['wechatpay_fee_type'] = $fee_type;
	        $arr['wechatpay_transaction_id'] = $transaction_id;
	        $arr['wechatpay_time'] = time();
	        $arr['wechatpay_transaction_data'] = json_encode($nnnn);
	        
	        $this->db->update('order', $arr, array('order_id'=>$out_trade_no));

	        $orderinfo = $this->OrderModel->getorderinfo_byordernumber($out_trade_no);
// 	        $this->OrderModel->edit_order($orderinfo['order_id'], $arr);

	        $orderRes = $this->db->get_where('order', ['order_id'=>$order_id]);
	        if($orderRes){
	            $order = $orderRes->first_row();
	            if($order->payment_status == "Paid"){
	                $sp_points = $order->requested_sp_points;
	                $sp_amount = $sp_points / 100;
	                $userResult = $this->db->get_where("users_system",["users_system_id"=>$order->users_system_id])->first_row();
	                if($userResult->sp_points >=  $sp_points){
	                    //判断是否会重复执行
	                    $sql = "SELECT * FROM points_log WHERE user_id = ".$order->users_system_id." AND source_id = ".$order->order_id;
	                    $checkres = $this->db->query($sql)->result_array();
	                    if(empty($checkres)){
	                        if($sp_points > 0){
    // 	                        $res2 = $this->db->update('order',["sp_points"=>$sp_points,"sp_points_discount"=>$sp_amount,"grand_total"=>($order->grand_total - $sp_amount)],["order_id"=>$order_id]);
    	                        $sp_points_update = $this->db->insert("points_log",["user_id"=>$order->users_system_id,"source"=>"Order","description"=>"Add Discount To Order. Order No: ".$order->order_id,"type"=>"Decrement","source_id"=>$order->order_id,"points"=>$sp_points,"current_points"=>((double)$userResult->sp_points-(double)$sp_points)]);
    	                        $user_sp_points = $this->db->update("users_system",["sp_points"=>((double)$userResult->sp_points-(double)$sp_points)],["users_system_id"=>$order->users_system_id]);
	                        }
	                        
	                        $grand_total = $orderinfo['grand_total'];
	                        $user_id = $orderinfo['users_system_id'];
	                        
	                        $nborder = empty($userResult->c_nborders)?1: $userResult->c_nborders + 1;
// 	                        $c_sp_points =  !empty($userResult->sp_points)?$userResult->sp_points - $sp_points:0;
// 	                        if($sp_points > 0){
// 	                            $this->db->insert("points_log",["source"=>"Order","user_id"=>$order_id,"description"=>"Used Points in while checkout in order_no ". $order_id,"type"=>"Decrement","source_id"=>$order_id,"points"=>$sp_points,"current_points"=>$c_sp_points]);
// 	                        }
	                        $new_sp_points =  !empty($userResult->sp_points)?$userResult->sp_points + $grand_total - $sp_points:$grand_total;
	                        if($grand_total > 0){
	                            $this->db->insert("points_log",["source"=>"Order","user_id"=>$user_id,"description"=>"Gained Points in while checkout in order_no ". $order_id,"type"=>"Increment","source_id"=>$order_id,"points"=>$grand_total,"current_points"=>$new_sp_points]);
	                        }
	                        $this->db->update("users_system", ["c_nborders"=>$nborder, "sp_points"=>$new_sp_points], ["users_system_id"=>$user_id]);
	                    }
	                }
	                
	                
	                
	            }
	        }
	        $this->OrderModel->sendwechatnotice_ordernotice($order_id);//付款成功后发送微信订单通知
	        
	        echo 'SUCCESS';
	    }
	}
	
}
