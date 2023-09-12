<?php
class WelModel extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->AppID=WECHAT_APPID();                     //AppID(应用ID)
		$this->AppSecret=WECHAT_APPSECRET();   //AppSecret(应用密钥)
	}
	
	//添加临时文件
	function add_file_interim($arr){
		$this->db->insert(DB_PRE().'file_interim',$arr);
		return $this->db->insert_id();
	}
	
	//删除临时文件信息
	function delete_file_interim($path){
		$this->db->delete(DB_PRE().'file_interim',array('file_path'=>$path));
	}
	
	//删除临时文件
	function truncate_file_interim(){
		$sql="SELECT * FROM ".DB_PRE()."file_interim WHERE created < ".(mktime()-86400);
		$result=$this->db->query($sql)->result_array();
		if(!empty($result)){
			for($i=0;$i<count($result);$i++){
				$filename="".$result[$i]['file_path'];  //只能是相对路径
				@unlink($filename);
				$this->db->delete(DB_PRE().'file_interim',array('file_path'=>$result[$i]['file_path']));
			}
		}
	}
	
	
	//获取语言列表
	function getlanguage_list($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " status = ".$con['status'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount==0){
			$sql="SELECT * FROM ".DB_PRE()."language_list $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."language_list $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}

	//durationdateshow
	function toshowdurationdate_starttoend($duration_start, $duration_end){
		if($this->langtype == '_ch'){
			$weekarray = array('日', '一', '二', '三', '四', '五', '六');
		}else{
			$weekarray = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		}
		if($this->langtype == '_ch'){
			echo date('Y年m月d日', $duration_start).' 星期'.$weekarray[date('w', $duration_start)].' - '.date('Y年m月d日', $duration_end).' 星期'.$weekarray[date('w', $duration_end)];
		}else{
			echo $weekarray[date('w', $duration_start)].' '.date('d M Y', $duration_start).' - '.$weekarray[date('w', $duration_end)].' '.date('d M Y', $duration_end);
		}
	}
	//durationdateshow
	function toshowdurationdate($plan_id, $weekdayplan_id, $start_date){
		$planinfo = $this->PlanModel->getplaninfo($plan_id);
		if($this->langtype == '_ch'){
			$weekarray = array('日', '一', '二', '三', '四', '五', '六');
		}else{
			$weekarray = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		}
		if($plan_id == 1){
			$start_time = strtotime($start_date.' 00:00:00');
			$end_time = strtotime($start_date.' 00:00:00') + 86400*(3 - 1);
			
			if($this->langtype == '_ch'){
				return date('Y年m月d日', $start_time).' 星期'.$weekarray[date('w', $start_time)].' - '.date('Y年m月d日', $end_time).' 星期'.$weekarray[date('w', $end_time)];
			}else{
				return $weekarray[date('w', $start_time)].' '.date('d M Y', $start_time).' - '.$weekarray[date('w', $end_time)].' '.date('d M Y', $end_time);
			}
		}else{
			$start_time = strtotime($start_date.' 00:00:00');
			
			if($weekdayplan_id == 1){//full week
				$end_time = strtotime($start_date.' 00:00:00') + 86400*($planinfo['plan_days'] - 1);
			}else{//weekday only
				$end_time = $start_time;
				for ($i = 1; $i < $planinfo['plan_days']; $i++) {
					$end_time = $end_time + 86400;
					if(date('w', $end_time) == 0){//星期日
						$end_time = $end_time + 86400;
					}else if(date('w', $end_time) == 6){//星期六
						$end_time = $end_time + 86400*2;
					}
				}
			}
			
			if($this->langtype == '_ch'){
				return date('Y年m月d日', $start_time).' 星期'.$weekarray[date('w', $start_time)].' - '.date('Y年m月d日', $end_time).' 星期'.$weekarray[date('w', $end_time)];
			}else{
				return $weekarray[date('w', $start_time)].' '.date('d M Y', $start_time).' - '.$weekarray[date('w', $end_time)].' '.date('d M Y', $end_time);
			}
		}
	}
	
	
}
