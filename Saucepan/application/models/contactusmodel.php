<?php
class ContactusModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//商品详细
	function getcontactusinfo($contactus_id){
		$sql="
				
				SELECT a.* 
				
				FROM ".DB_PRE()."contactus_list AS a 
						
				WHERE a.contactus_id=".$contactus_id
		;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加商品
	function add_contactus($arr){
		$this->db->insert(DB_PRE().'contactus_list',$arr);
		return $this->db->insert_id();
	}
	//修改商品
	function edit_contactus($contactus_id,$arr){
		// 配置图片字段
		$picarr = array ();
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
// 		$sql = "SELECT $picstr FROM " . DB_PRE () . "contactus_list WHERE contactus_id=$contactus_id";
// 		$info = $this->db->query ( $sql )->row_array ();
// 		if (! empty ( $info )) {
// 			for($i = 0; $i < count ( $picarr ); $i ++) {
// 				$filename = $info [$picarr [$i]]; // 只能是相对路径
// 				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
// 					@unlink ( $filename );
// 				}
// 			}
			$this->db->update ( DB_PRE () . 'contactus_list', $arr, array ('contactus_id' => $contactus_id ) );
// 		}
	}
	//删除商品
	function del_contactus($contactus_id){
		// 配置图片字段
		$picarr = array ();
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
// 		$sql = "SELECT $picstr FROM " . DB_PRE () . "contactus_list WHERE contactus_id = $contactus_id";
// 		$info = $this->db->query ( $sql )->row_array ();
// 		if (! empty ( $info )) {
// 			for($i = 0; $i < count ( $picarr ); $i ++) {
// 				$filename = $info [$picarr [$i]]; // 只能是相对路径
// 				if ($filename != "" && file_exists ( $filename )) {
// 					@unlink ( $filename );
// 				}
// 			}
			$this->db->delete ( DB_PRE () . 'contactus_list', array ('contactus_id' => $contactus_id ) );
// 		}
	}
	//查询商品列表
	function getcontactuslist($con=array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		$leftjoin = "";
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['contactus_type_IN'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.contactus_type IN (".$con['contactus_type_IN'].")";}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['isread'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.isread = ".$con['isread'];}
		if(isset($con['parent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.parent = ".$con['parent'];}
		if(isset($con['isreply'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.isreply = ".$con['isreply'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.contactus_colour LIKE '%".addslashes($con['keyword'])."%') OR (a.contactus_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.contactus_name_ch LIKE '%".addslashes($con['keyword'])."%')) ";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount==0){
			$sql="
				SELECT a.*
					
				FROM ".DB_PRE()."contactus_list AS a 
				
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
				
				FROM ".DB_PRE()."contactus_list a 
				
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
	function insert_contact($arr){
	    $this->db->insert(DB_PRE().'contactus_list',$arr);
	    return $this->db->insert_id();
	}
	
}
