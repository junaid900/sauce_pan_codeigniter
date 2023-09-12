<?php
class CmsModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	//cms详细
	function getcmsinfo($cms_id){
		$sql="select * from ".DB_PRE()."cms_list where cms_id=".$cms_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//cms详细 - by shorturl
	function getcmsinfo_byshorturl($shorturl){
		$sql="SELECT * FROM ".DB_PRE()."cms_list WHERE shorturl = '".$shorturl."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加cms
	function add_cms($arr){
		$this->db->insert(DB_PRE().'cms_list',$arr);
		return $this->db->insert_id();
	}
//修改cms
	function edit_cms($cms_id,$arr){
		// 配置图片字段
		$picarr = array ('pic_1');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "cms_list WHERE cms_id=$cms_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'cms_list', $arr, array ('cms_id' => $cms_id ) );
		}
	}
	//删除cms
	function del_cms($cms_id){
		// 配置图片字段
		$picarr = array ('pic_1');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "cms_list WHERE cms_id = $cms_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if ($filename != "" && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->delete ( DB_PRE () . 'cms_list', array ('cms_id' => $cms_id ) );
		}
	}
	//查询cms列表
	function getcmslist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['parent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.parent = ".$con['parent'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.cms_name_en LIKE '%".addslashes($con['keyword'])."%')) ";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="SELECT a.* FROM ".DB_PRE()."cms_list a $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."cms_list a $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	
	
	//查询关键字列表
	function getdishlist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		$leftjoin="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.article_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.article_name_ch LIKE '%".addslashes($con['keyword'])."%')) ";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="
				SELECT a.*
	
				FROM ".DB_PRE()."dish_list a
						
				$leftjoin
					
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
		
				FROM ".DB_PRE()."dish_list a
							
				$leftjoin
					
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
	//添加关键字
	function add_dish($arr){
		$this->db->insert(DB_PRE().'dish_list',$arr);
		return $this->db->insert_id();
	}
	//关键字详细
	function getdishinfo($dish_id){
		$sql="
			SELECT a.*

			FROM ".DB_PRE()."dish_list AS a

			WHERE a.dish_id = ".$dish_id."
		";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return $result;
		}else{
			return null;
		}
	}
	//修改关键字
	function edit_dish($dish_id,$arr){
		$this->db->update(DB_PRE().'dish_list',$arr,array('dish_id'=>$dish_id));
	}
	//删除关键字
	function del_dish($dish_id){
		$this->db->delete(DB_PRE().'dish_list', array('dish_id'=>$dish_id));
	}
	

	
	
	
}
