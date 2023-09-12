<?php
class DesignertwoModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//设计师详细
	function getdesignertwoinfo($designertwo_id){
		$sql="
				
				SELECT a.* 
				
				FROM ".DB_PRE()."designertwo_list AS a 
						
				WHERE a.designertwo_id = ".$designertwo_id
		;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//设计师详细
	function getdesignertwoinfo_byshorturl($shorturl){
		$sql="
	
				SELECT a.*
	
				FROM ".DB_PRE()."designertwo_list AS a
	
				WHERE a.shorturl = '".$shorturl."'"
		;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加设计师
	function add_designertwo($arr){
		$this->db->insert(DB_PRE().'designertwo_list',$arr);
		return $this->db->insert_id();
	}
	//修改设计师
	function edit_designertwo($designertwo_id,$arr){
		// 配置图片字段
		$picarr = array ('designertwo_pic', 'designertwo_pic_100', 'designertwo_pic_200', 'designertwo_pic_400', 'designertwo_pic_600', 'designertwo_pic_800', 'designertwo_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "designertwo_list WHERE designertwo_id=$designertwo_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'designertwo_list', $arr, array ('designertwo_id' => $designertwo_id ) );
		}
	}
	//删除设计师
	function del_designertwo($designertwo_id){
		// 配置图片字段
		$picarr = array ('designertwo_pic', 'designertwo_pic_100', 'designertwo_pic_200', 'designertwo_pic_400', 'designertwo_pic_600', 'designertwo_pic_800', 'designertwo_pic_original');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "designertwo_list WHERE designertwo_id = $designertwo_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if ($filename != "" && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->delete ( DB_PRE () . 'designertwo_list', array ('designertwo_id' => $designertwo_id ) );
		}
		$this->db->delete(DB_PRE().'designertwo_category', array('designertwo_id'=>$designertwo_id));
		
		$sql = "SELECT * FROM ".DB_PRE()."designertwo_picture WHERE designertwo_id = ".$designertwo_id;
		$result = $this->db->query($sql)->result_array();
		if(!empty($result)){
			for ($i = 0; $i < count($result); $i++) {
				$this->del_picture($result[$i]['picture_id']);
			}
		}
	}
	//查询设计师列表
	function getdesignertwolist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		$leftjoin = "";
		$groupby = "";
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.designertwo_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.designertwo_name_ch LIKE '%".addslashes($con['keyword'])."%') ) ";}
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
				
				FROM ".DB_PRE()."designertwo_list AS a 
				
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
					
					FROM ".DB_PRE()."designertwo_list a 
			
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
