<?php
class UserModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//用户登录
	function checkUser_login($phone, $pwd){
		$sql="
				SELECT 
				
				* 
				
				FROM ".DB_PRE()."user_list 
		
				WHERE (
					(user_phone = '$phone' and password = '$pwd')
					OR 
					(contact1_phone = '$phone' and contact1_password = '$pwd')
					OR 
					(contact2_phone = '$phone' and contact2_password = '$pwd')
					OR 
					(contact3_phone = '$phone' and contact3_password = '$pwd')
				)
		
		";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return $result;
		}else{
			return null;
		}
	}
	//根据 wechat_id 获取用户信息
	function getuserinfo_byWechatID($wechat_id){
		if($wechat_id != ''){
			$sql = "SELECT * FROM ".DB_PRE()."user_list WHERE wechat_id='".$wechat_id."'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				return $query->row_array();
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	//用户详细
	function getuserinfo($uid){
		$sql="select * from ".DB_PRE()."user_list where uid=".$uid;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//用户详细----根据手机号
	function getuserinfo_ByPhone($phone){
		$sql="SELECT * FROM ".DB_PRE()."user_list WHERE user_phone='$phone'";
		$result=$this->db->query($sql)->row_array();
		if(!empty($result)){
			return $result;
		}else{
			return null;
		}
	}
	//添加用户
	function add_user($arr){
		$this->db->insert(DB_PRE().'user_list',$arr);
		return $this->db->insert_id();
	}
	//修改用户
	function edit_user($uid,$arr){
		$this->db->update(DB_PRE().'user_list',$arr,array('uid'=>$uid));
	}
	// 添加用户日志
	function adduserlog($arr){
		$this->db->insert ( DB_PRE () . 'user_log', $arr );
		return $this->db->insert_id ();
	}
	//删除用户
	function del_user($uid){
		$this->db->delete(DB_PRE().'user_list', array('uid'=>$uid));
		
		$sql = "SELECT * FROM ".DB_PRE()."user_favorite WHERE uid = ".$uid;
		$result = $this->db->query($sql)->result_array();
		if(!empty($result)){
			for ($i = 0; $i < count($result); $i++) {
				$this->db->delete(DB_PRE().'user_favorite', array('favorite_id'=>$result[$i]['favorite_id']));
				$this->ProductModel->updatefavoritenum($result[$i]['product_id']);//计算一个产品的收藏数量
			}
		}
		
		$this->db->delete(DB_PRE().'user_address', array('uid'=>$uid));
		$this->db->delete(DB_PRE().'user_log', array('uid'=>$uid));
		$this->db->delete(DB_PRE().'user_notice_list', array('uid'=>$uid));
		$this->db->delete(DB_PRE().'user_point_list', array('uid'=>$uid));
		$this->db->delete(DB_PRE().'user_sharescore', array('uid'=>$uid));
	}
	//查询用户列表
	function getuserlist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['username'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " u.wechat_nickname LIKE '%".addslashes($con['username'])."%'";}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((u.user_company_name LIKE '%".addslashes($con['keyword'])."%') OR (u.user_email LIKE '%".addslashes($con['keyword'])."%') OR (u.user_phone LIKE '%".addslashes($con['keyword'])."%') OR (Concat(u.user_firstname, ' ', u.user_lastname) LIKE '%".addslashes($con['keyword'])."%') OR (u.wechat_nickname LIKE '%".addslashes($con['keyword'])."%')) ";}
		if(isset($con['parent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " u.parent = ".$con['parent'];}
		if(isset($con['user_type'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " u.user_type = ".$con['user_type'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " u.status =".$con['status'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount==0){
			$sql="SELECT u.* FROM ".DB_PRE()."user_list u $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."user_list u $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	//检查邮箱是否已经被注册
	function checkemailisexists($user_email){
		$sql = "SELECT * FROM ".DB_PRE()."user_list WHERE user_email = '".$user_email."'";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return 'yes';
		}else{
			return 'no';
		}
	}
	//检查手机号码是否已经被注册
	function checkphoneisexists($user_phone){
		$sql = "
			SELECT 
				
				* 
				
			FROM ".DB_PRE()."user_list 
						
			WHERE 
				(user_phone = '".$user_phone."')
						
				OR (contact1_phone = '".$user_phone."')
								
				OR (contact2_phone = '".$user_phone."')
										
				OR (contact3_phone = '".$user_phone."')
		";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return 'yes';
		}else{
			return 'no';
		}
	}
	//查询用户发票列表
	function getinvoicelist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['uid'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " uid =".$con['uid'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="SELECT * FROM ".DB_PRE()."user_invoice $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."user_invoice $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	//用户发票详细
	function getinvoiceinfo($invoice_id){
		$sql = "SELECT * FROM ".DB_PRE()."user_invoice WHERE invoice_id=".$invoice_id;
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return $result;
		}else{
			return null;
		}
	}
	//添加用户发票
	function add_invoice($arr, $isdefault = 0){
		if($isdefault == 1){
			$this->db->update(DB_PRE().'user_invoice',array('isdefault'=>0),array('uid'=>$arr['uid']));
			$arr['isdefault'] = 1;
			$this->db->insert(DB_PRE().'user_invoice',$arr);
			return $this->db->insert_id();
		}else{
			$this->db->insert(DB_PRE().'user_invoice', $arr);
			$invoice_id = $this->db->insert_id();
		}
		return $invoice_id;
		
	}
	//修改用户发票
	function edit_invoice($invoice_id, $arr){
		$this->db->update(DB_PRE().'user_invoice', $arr, array('invoice_id'=>$invoice_id));
	}
	//删除用户发票
	function del_invoice($invoice_id){
		$this->db->delete(DB_PRE().'user_invoice', array('invoice_id'=>$invoice_id));
	}
	//查询用户地址列表
	function getaddresslist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['uid'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " uid =".$con['uid'];}
		if(isset($con['isdel_status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " isdel_status =".$con['isdel_status'];}
		
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="SELECT * FROM ".DB_PRE()."user_address $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."user_address $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	//用户地址详细
	function getaddressinfo($address_id){
		$sql = "SELECT * FROM ".DB_PRE()."user_address WHERE address_id=".$address_id;
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return $result;
		}else{
			return null;
		}
	}
	//添加用户地址
	function add_useraddress($arr){
		$this->db->insert(DB_PRE().'user_address', $arr);
		return $this->db->insert_id();
	}
	//修改用户地址
	function edit_useraddress($address_id, $arr){
		$this->db->update(DB_PRE().'user_address',$arr,array('address_id'=>$address_id));
	}
	//删除用户地址
	function del_useraddress($uid, $address_id){
		$this->db->delete(DB_PRE().'user_address', array('uid'=>$uid, 'address_id'=>$address_id));
	}
	
	//查出用户密码
	function check_user_pass($uid){
		$sql="select * from ".DB_PRE()."user_list where uid='$uid'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	/*
	 * 用户添加自己的地址管理
	 * */
	function insert_address($arr,$default=0){
		if($default==1){
			$this->db->update(DB_PRE().'user_address',array('default'=>0),array('uid'=>$arr['uid']));
			$this->db->insert(DB_PRE().'user_address',$arr);
			return $this->db->insert_id();
		}else{
			$this->db->insert(DB_PRE().'user_address',$arr);
			return $this->db->insert_id();
		}
	}
	
	function edit_address($address_id,$arr,$default){
		if($default==1){
			$this->db->update(DB_PRE().'user_address',array('default'=>0));
			$arr['default']=$default;
			$this->db->update(DB_PRE().'user_address',$arr,array('address_id'=>$address_id));
		}else{
			$this->db->update(DB_PRE().'user_address',$arr,array('address_id'=>$address_id));
		}
	}
	/*
	 * 删除用户的地址
	 * */
	function deleteaddress($address_id){
		$this->db->update(DB_PRE().'user_address', array('isdel_status'=>1, 'isdel_time'=>mktime()), array('address_id'=>$address_id));
	}
	//获取用户的积分列表
	function getpointlist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['uid'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.uid = ".$con['uid'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount == 0){
			$sql = "
				SELECT a.* 
					
				, b.wechat_avatar, b.wechat_nickname, b.user_firstname, b.user_lastname, b.user_phone, b.user_email
					
				FROM ".DB_PRE()."user_point_list AS a
				
				LEFT JOIN ".DB_PRE()."user_list AS b ON a.uid = b.uid
			
				$where $order_by $limit
			
			";
			$result = $this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql = "
				SELECT count(*) as count
			
				FROM ".DB_PRE()."user_point_list AS a
			
				LEFT JOIN ".DB_PRE()."user_list AS b ON a.uid = b.uid
								
				$where $order_by
			";
			$result = $this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	// 更新用户的qrcode
	function updateqrcodepic($thiswechat_id) {
		$ACC_TOKEN = $this->JssdkModel->getAccessToken ();
	
		$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=" . $ACC_TOKEN;
		$post_data = '{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "' . $thiswechat_id . '"}}}';
	
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		// post数据
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		// post的变量
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
		$output = curl_exec ( $ch );
		curl_close ( $ch );
		// print_r($output);exit;
	
		$output = json_decode ( $output );
		// print_r($output);exit;
		// 打印获得的数据
		$getticketres = $output->ticket;
		// {"errcode":0,"errmsg":"ok"}
		// print_r($getticketres);exit;
		$pathxdlj = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . $getticketres . ''; // 初始 路径
		$this->db->update ( DB_PRE () . 'user_list', array ('qrcode_pic' => $pathxdlj ), array ('wechat_id' => $thiswechat_id ) );
	}
	
	//查询用户列表
	function getuser_pointsetting_historylist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['pointsetting_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " pointsetting_id =".$con['pointsetting_id'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="SELECT * FROM ".DB_PRE()."user_point_setting_history $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."user_point_setting_history $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	//计算一个用户的总积分
	function tocalallsppoints($uid){
		$sql = "SELECT SUM(point) AS allpoint FROM ".DB_PRE()."user_point_list WHERE uid = ".$uid." AND point_action = 1";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			if($result['allpoint'] != ''){
				$allpoint_add = $result['allpoint'];
			}else{
				$allpoint_add = 0;
			}
		}else{
			$allpoint_add = 0;
		}
		
		$sql = "SELECT SUM(point) AS allpoint FROM ".DB_PRE()."user_point_list WHERE uid = ".$uid." AND point_action = 2";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			if($result['allpoint'] != ''){
				$allpoint_min = $result['allpoint'];
			}else{
				$allpoint_min = 0;
			}
		}else{
			$allpoint_min = 0;
		}
		
		if($allpoint_add >= $allpoint_min){
			$cha = $allpoint_add - $allpoint_min;
		}else{
			$cha = 0;
		}
		
		$this->UserModel->edit_user($uid, array('totalpoint'=>$cha));
	}

	
	
	
	
	
}
