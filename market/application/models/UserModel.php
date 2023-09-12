<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	//根据 c_open_id 获取用户信息
	function getuserinfo_byopenID($c_open_id){
		$sql = "SELECT * FROM users_system WHERE c_open_id = '".$c_open_id."'";
		$query=$this->db->query($sql);
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//用户详细
	function getuserinfo($users_system_id){
		$sql = "SELECT * FROM users_system WHERE users_system_id = ".$users_system_id;
		$query=$this->db->query($sql);
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加用户
	function add_user($arr){
		$this->db->insert('users_system', $arr);
		return $this->db->insert_id();
	}
	//修改用户
	function edit_user($users_system_id, $arr){
		$this->db->update('users_system', $arr, array('users_system_id'=>$users_system_id));
	}
	//查询用户列表
	function getuserlist($con=array(), $iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['username'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " u.wechat_nickname LIKE '%".addslashes($con['username'])."%'";}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((u.user_phone LIKE '%".addslashes($con['keyword'])."%') OR (u.user_realname LIKE '%".addslashes($con['keyword'])."%') OR (u.wechat_nickname LIKE '%".addslashes($con['keyword'])."%')) ";}
		if(isset($con['parent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " u.parent = ".$con['parent'];}
		if(isset($con['user_type'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " u.user_type = ".$con['user_type'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " u.status =".$con['status'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount==0){
			$sql = "SELECT u.* FROM users_system u $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql = "SELECT count(*) as count FROM users_system u $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}

	
}
