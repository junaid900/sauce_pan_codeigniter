<?php
class PartnerModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//合作伙伴详细
	function getpartnerinfo($partner_id){
		$sql="
				
				SELECT a.* 
				
				FROM ".DB_PRE()."partner_list AS a 
						
				WHERE a.partner_id = ".$partner_id
		;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//合作伙伴详细
	function getpartnerinfo_byshorturl($shorturl){
		$sql="
	
				SELECT a.*
	
				FROM ".DB_PRE()."partner_list AS a
	
				WHERE a.shorturl = '".$shorturl."'"
		;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加合作伙伴
	function add_partner($arr){
		$this->db->insert(DB_PRE().'partner_list',$arr);
		return $this->db->insert_id();
	}
	//修改合作伙伴
	function edit_partner($partner_id,$arr){
		// 配置图片字段
		$picarr = array ('partner_pic', 'partner_pic_100', 'partner_pic_200', 'partner_pic_400', 'partner_pic_600', 'partner_pic_800', 'partner_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "partner_list WHERE partner_id=$partner_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'partner_list', $arr, array ('partner_id' => $partner_id ) );
		}
	}
	//删除合作伙伴
	function del_partner($partner_id){
		// 配置图片字段
		$picarr = array ('partner_pic', 'partner_pic_100', 'partner_pic_200', 'partner_pic_400', 'partner_pic_600', 'partner_pic_800', 'partner_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "partner_list WHERE partner_id = $partner_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if ($filename != "" && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->delete ( DB_PRE () . 'partner_list', array ('partner_id' => $partner_id ) );
		}
	}
	//查询合作伙伴列表
	function getpartnerlist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		$leftjoin = "";
		$groupby = "";
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.partner_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.partner_name_ch LIKE '%".addslashes($con['keyword'])."%') ) ";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){
			if($con['orderby'] == 'rand()'){
				$order_by .=" ORDER BY rand() ";
			}else{
				$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";
			}
		}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		if(isset($con['groupby'])){$groupby = ' GROUP BY '.$con['groupby'];}
		
		if($iscount == 0){
			$sql="
				SELECT a.*
				
				FROM ".DB_PRE()."partner_list AS a 
				
				$leftjoin
				
				$where $groupby $order_by $limit
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
					
					FROM ".DB_PRE()."partner_list a 
			
					$leftjoin
					
					$where $groupby $order_by
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
