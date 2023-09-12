<?php
class OrderModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function getorderinfo_byordernumber($order_number){
	    $sql = "SELECT * FROM `order` WHERE order_id = '".$order_number."'";
	    $query = $this->db->query($sql);
	    if($query->num_rows() > 0){
	        return $query->row_array();
	    }else{
	        return null;
	    }
	}
	
	function getorderinfo($order_id){
		$sql = "
			SELECT a.* 
				
			, b.wechat_nickname, b.wechat_avatar
			
			FROM `order` AS a 
					
			LEFT JOIN `users_system` AS b ON a.users_system_id = b.users_system_id 
	
			WHERE a.order_id = ".$order_id."
		";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			return $query->row_array();    
		}else{
			return null;   
		}
	}
	
	function edit_order($order_id, $arr){
		$this->db->update('`order`', $arr, array('order_id'=>$order_id));
	}
	
	//付款成功后发送微信订单通知
	function sendwechatnotice_ordernotice($order_id, $istest = 0){
	    $orderinfo = $this->OrderModel->getorderinfo($order_id);
	    $userinfo = $this->UserModel->getuserinfo($orderinfo['users_system_id']);
	    
	    $tousercon=array();
	    if($istest == 1){
	        $tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
	    }else{
	        $tousercon[] = array('touser_wechat_id'=>$userinfo['c_open_id'], 'touser_name'=>'Customer');
	        //$tousercon[] = array('touser_wechat_id'=>'oWTCLwdi5khyAaxygm2ipHWF7s4s', 'touser_name'=>'Wolf | Saucepan');
	        //$tousercon[] = array('touser_wechat_id'=>'oWTCLwfInDdWewFpJ39gELhkbcwg', 'touser_name'=>'Lorraine');
	        $tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
			$tousercon[] = array('touser_wechat_id'=>'oWTCLwQSr-_uKIXF03hSKtQL8S-c', 'touser_name'=>'Saucepan');
	    }
	    
	    if(!empty($tousercon)){
	        for($tt = 0; $tt < count($tousercon); $tt++){
// 	            $con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>site_url('wechat/order/toview_order?order_id='.$order_id.'&randkey='.$orderinfo['randkey']));
	            $con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>'https://www.mygksel.com/Saucepan/index.php/welcome/account_orderhistory');
	            
	            $con['first_value']='';
	            $con['first_color']='#173177';
	            
	            $con['keyword1_value'] = date('Y-m-d H:i:s');//Time
	            $con['keyword1_color'] = '#333333';
	            
	            $con['keyword2_value'] = 'Saucepan NEW ORDER';//Type
	            $con['keyword2_color'] = '#333333';
	            
	            $con['keyword3_value'] = $userinfo['wechat_nickname'].' '.$userinfo['first_name'].' '.$userinfo['last_name'];//Client
	            $con['keyword3_color'] = '#333333';
	            
	            $con['keyword4_value'] = $orderinfo['contact'].'\\nTotal Price：￥'.$orderinfo['grand_total'];//Order No.
	            $con['keyword4_color'] = '#333333';
	            
	            $con['remark_value'] = '';//备注
	            $con['remark_color'] = '#333333';
	            $res = notice_neworder($con);//发送模版消息 --订单消息通知
	        }
	    }
	}
	
	//订单正在处理中发送微信订单通知
	function sendwechatnotice_orderprocessing($order_id, $istest = 0){
	    $orderinfo = $this->OrderModel->getorderinfo($order_id);
	    $userinfo = $this->UserModel->getuserinfo($orderinfo['users_system_id']);
	    
	    $tousercon=array();
	    if($istest == 1){
	        $tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
	    }else{
	        $tousercon[] = array('touser_wechat_id'=>$userinfo['c_open_id'], 'touser_name'=>'Customer');
	        //$tousercon[] = array('touser_wechat_id'=>'oWTCLwdi5khyAaxygm2ipHWF7s4s', 'touser_name'=>'Wolf | Saucepan');
	        //$tousercon[] = array('touser_wechat_id'=>'oWTCLwfInDdWewFpJ39gELhkbcwg', 'touser_name'=>'Lorraine');
	        $tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
	    }
	    
	    if(!empty($tousercon)){
	        for($tt = 0; $tt < count($tousercon); $tt++){
	            // 	            $con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>site_url('wechat/order/toview_order?order_id='.$order_id.'&randkey='.$orderinfo['randkey']));
	            $con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>'https://www.mygksel.com/Saucepan/index.php/welcome/account_orderhistory');
	            
	            $con['first_value']='';
	            $con['first_color']='#173177';
	            
	            $con['keyword1_value'] = $orderinfo['contact'].'\\nTotal Price：￥'.$orderinfo['grand_total'];//Order No.
	            $con['keyword1_color'] = '#333333';
	            
	            $con['keyword2_value'] = 'Saucepan processing order';//Status
	            $con['keyword2_color'] = '#333333';
	            
	            $con['keyword3_value'] = date('Y-m-d H:i:s');//Time
	            $con['keyword3_color'] = '#333333';
	            
	            $con['remark_value'] = '';//备注
	            $con['remark_color'] = '#333333';
	            $res = notice_orderstatus($con);//发送模版消息 --订单消息通知
	        }
	    }
	}
	
	//订单已经制作完成发送微信订单通知
	function sendwechatnotice_orderinprocess($order_id, $istest = 0){
	    $orderinfo = $this->OrderModel->getorderinfo($order_id);
	    $userinfo = $this->UserModel->getuserinfo($orderinfo['users_system_id']);
	    
	    $tousercon=array();
	    if($istest == 1){
	        $tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
	    }else{
	        $tousercon[] = array('touser_wechat_id'=>$userinfo['c_open_id'], 'touser_name'=>'Customer');
	        //$tousercon[] = array('touser_wechat_id'=>'oWTCLwdi5khyAaxygm2ipHWF7s4s', 'touser_name'=>'Wolf | Saucepan');
	        //$tousercon[] = array('touser_wechat_id'=>'oWTCLwfInDdWewFpJ39gELhkbcwg', 'touser_name'=>'Lorraine');
	        $tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
	    }
	    
	    if(!empty($tousercon)){
	        for($tt = 0; $tt < count($tousercon); $tt++){
	            // 	            $con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>site_url('wechat/order/toview_order?order_id='.$order_id.'&randkey='.$orderinfo['randkey']));
	            $con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>'https://www.mygksel.com/Saucepan/index.php/welcome/account_orderhistory');
	            
	            $con['first_value']='';
	            $con['first_color']='#173177';
	            
	            $con['keyword1_value'] = $orderinfo['contact'].'\\nTotal Price：￥'.$orderinfo['grand_total'];//Order No.
	            $con['keyword1_color'] = '#333333';
	            
	            $con['keyword2_value'] = 'Saucepan In-process order';//Status
	            $con['keyword2_color'] = '#333333';
	            
	            $con['keyword3_value'] = date('Y-m-d H:i:s');//Time
	            $con['keyword3_color'] = '#333333';
	            
	            $con['remark_value'] = '';//备注
	            $con['remark_color'] = '#333333';
	            $res = notice_orderstatus($con);//发送模版消息 --订单消息通知
	        }
	    }
	}
	
	
	//订单已经发货发送微信订单通知
	function sendwechatnotice_ordershipped($order_id, $istest = 0){
	    $orderinfo = $this->OrderModel->getorderinfo($order_id);
	    $userinfo = $this->UserModel->getuserinfo($orderinfo['users_system_id']);
	    
	    $tousercon=array();
	    if($istest == 1){
	        $tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
	    }else{
	        $tousercon[] = array('touser_wechat_id'=>$userinfo['c_open_id'], 'touser_name'=>'Customer');
	        //$tousercon[] = array('touser_wechat_id'=>'oWTCLwdi5khyAaxygm2ipHWF7s4s', 'touser_name'=>'Wolf | Saucepan');
	        //$tousercon[] = array('touser_wechat_id'=>'oWTCLwfInDdWewFpJ39gELhkbcwg', 'touser_name'=>'Lorraine');
	        $tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
	    }
	    
	    if(!empty($tousercon)){
	        for($tt = 0; $tt < count($tousercon); $tt++){
	            // 	            $con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>site_url('wechat/order/toview_order?order_id='.$order_id.'&randkey='.$orderinfo['randkey']));
	            $con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>'https://www.mygksel.com/Saucepan/index.php/welcome/account_orderhistory');
	            
	            $con['first_value']='';
	            $con['first_color']='#173177';
	            
	            $con['keyword1_value'] = $orderinfo['contact'].'\\nTotal Price：￥'.$orderinfo['grand_total'];//Order No.
	            $con['keyword1_color'] = '#333333';
	            
	            $con['keyword2_value'] = 'Saucepan ORDER SHIPPED';//Status
	            $con['keyword2_color'] = '#333333';
	            
	            $con['keyword3_value'] = date('Y-m-d H:i:s');//Time
	            $con['keyword3_color'] = '#333333';
	            
	            $con['remark_value'] = '';//备注
	            $con['remark_color'] = '#333333';
	            $res = notice_orderstatus($con);//发送模版消息 --订单消息通知
	        }
	    }
	}
	
	//订单已经取消发送微信订单通知
	function sendwechatnotice_ordercancelled($order_id, $istest = 0){
	    $orderinfo = $this->OrderModel->getorderinfo($order_id);
	    $userinfo = $this->UserModel->getuserinfo($orderinfo['users_system_id']);
	    
	    $tousercon=array();
	    if($istest == 1){
	        $tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
	    }else{
	        $tousercon[] = array('touser_wechat_id'=>$userinfo['c_open_id'], 'touser_name'=>'Customer');
	        //$tousercon[] = array('touser_wechat_id'=>'oWTCLwdi5khyAaxygm2ipHWF7s4s', 'touser_name'=>'Wolf | Saucepan');
	        //$tousercon[] = array('touser_wechat_id'=>'oWTCLwfInDdWewFpJ39gELhkbcwg', 'touser_name'=>'Lorraine');
	        $tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
	    }
	    
	    if(!empty($tousercon)){
	        for($tt = 0; $tt < count($tousercon); $tt++){
	            // 	            $con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>site_url('wechat/order/toview_order?order_id='.$order_id.'&randkey='.$orderinfo['randkey']));
	            $con = array('touser'=>$tousercon[$tt]['touser_wechat_id'], 'url'=>'https://www.mygksel.com/Saucepan/index.php/welcome/account_orderhistory');
	            
	            $con['first_value'] = 'Cancel';
	            $con['first_color'] = '#173177';
	            
	            $con['keyword1_value'] = $orderinfo['contact'].'\\nTotal Price：￥'.$orderinfo['grand_total'];//订单编号
	            $con['keyword1_color'] = '#333333';
	            
	            $con['keyword2_value'] = $orderinfo['created_at'];//订单时间
	            $con['keyword2_color'] = '#333333';
	            
	            $con['keyword3_value'] = date('Y-m-d H:i:s');//取消时间
	            $con['keyword3_color'] = '#333333';
	            
	            $con['remark_value'] = '';//备注
	            $con['remark_color'] = '#333333';
	            $res = notice_ordercancelled($con);//发送模版消息 --订单消息通知
	        }
	    }
	}

	
	
	
	
	
}
