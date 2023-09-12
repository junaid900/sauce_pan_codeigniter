<?php
class FeedbackModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//意见反馈详细
	function getfeedbackinfo($feedback_id){
		$sql="
				SELECT a.*, 
				
				b.user_realname AS request_user_realname, b.user_phone AS request_user_phone
				
				FROM ".DB_PRE()."feedback_list AS a 
				
				LEFT JOIN ".DB_PRE()."user_list AS b ON a.uid = b.uid 
		
				WHERE a.feedback_id = ".$feedback_id."
		";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return $result;
		}else{
			return null;
		}
	}
	
	//添加意见反馈
	function add_feedback($arr){
		$this->db->insert(DB_PRE().'feedback_list',$arr);
		return $this->db->insert_id();
	}
	
	//修改意见反馈
	function edit_feedback($feedback_id,$arr){
		$this->db->update(DB_PRE().'feedback_list',$arr,array('feedback_id'=>$feedback_id));
	}
	//删除意见反馈
	function del_feedback($feedback_id){
		$this->db->update(DB_PRE().'feedback_list',array('status'=>0), array('feedback_id'=>$feedback_id));
	}
	
	//查询反馈列表
	function getfeedbacklist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['parent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.parent =".$con['parent'];}
		if(isset($con['uid'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.uid =".$con['uid'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status =".$con['status'];}
		if(isset($con['isreply'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.isreply =".$con['isreply'];}
		if(isset($con['isread'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.isread =".$con['isread'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount==0){
			$sql="
					SELECT a.*
					
					FROM ".DB_PRE()."feedback_list AS a 
					
					LEFT JOIN ".DB_PRE()."user_list AS b ON a.uid = b.uid 
			
					$where $order_by $limit
			";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="
					SELECT count(*) as count 
					
					FROM ".DB_PRE()."feedback_list AS a 
					
					LEFT JOIN ".DB_PRE()."user_list AS b ON a.uid = b.uid 
			
					$where $order_by
			";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	

}
