<?php
class CouponModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//优惠券详细
	function getcouponinfo($coupon_id){
		$sql="SELECT * FROM ".DB_PRE()."coupon_list WHERE coupon_id=".$coupon_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加优惠券
	function add_coupon($arr){
		$this->db->insert(DB_PRE().'coupon_list',$arr);
		return $this->db->insert_id();
	}
	//修改优惠券
	function edit_coupon($coupon_id,$arr){
		$this->db->update(DB_PRE().'coupon_list',$arr,array('coupon_id'=>$coupon_id));
	}
	//删除优惠券
	function del_coupon($coupon_id){
		$this->db->delete(DB_PRE().'coupon_list', array('coupon_id'=>$coupon_id));
	}
	//查询优惠券列表
	function getcouponlist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['parent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.parent = ".$con['parent'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="SELECT a.* FROM ".DB_PRE()."coupon_list AS a $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."coupon_list AS a $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	

}
