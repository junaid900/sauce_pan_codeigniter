<?php
class StepModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//添加步骤
	function addstep($arr){		
		$this->db->insert(DB_PRE().'system_product_step',$arr);
		return $this->db->insert_id();
	}
	//编辑查询步骤信息
	function getstepinfo($step_id){
		$sql="select * from ".DB_PRE ()."system_product_step where step_id=$step_id";
		return $this->db->query($sql)->row_array();
	}
	//修改步骤
	function edit_step($step_id, $arr){
		// 配置图片字段
		$picarr = array ('step_logo');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " . DB_PRE () . "system_product_step WHERE step_id = $step_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update ( DB_PRE () . 'system_product_step', $arr, array ('step_id' => $step_id ) );
		}
	}
	//删除步骤
	function del_step($step_id){
		$this->db->delete(DB_PRE ().'system_product_step',array("step_id"=>$step_id));
	}
	//查询步骤列表
	function getsteplist($con = array(),$iscount=0){
		$where = "";
		$order_by="";
		$limit="";		
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.step_name_en LIKE '%".$con['keyword']."%') OR (a.step_name_ch LIKE '%".$con['keyword']."%') OR (a.step_name_tw LIKE '%".$con['keyword']."%'))";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount==0){
			$sql="SELECT * FROM ".DB_PRE()."system_product_step AS a $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="
					SELECT count(*) as count
			
					FROM ".DB_PRE()."system_product_step AS a
			
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