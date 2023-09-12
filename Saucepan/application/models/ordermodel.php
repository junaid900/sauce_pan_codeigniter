<?php
class OrderModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function getorderlist($con = array(),$iscount=0){
		$where="";
		$group_by="";
		$order_by="";
		$limit = "";
		$where1 = "";
		$where2 = "";
		$where3 = "";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.status = ".$con['status'];}
		if(isset($con['plan_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.plan_id = ".$con['plan_id'];}
		if(isset($con['uid'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.uid = ".$con['uid'];}
		if(isset($con['uidin'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.uid IN ( ".$con['uidin']." )";}
		if(isset($con['statusin'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.status IN ( ".$con['statusin']." )";}
		if(isset($con['statusnotin'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.status NOT IN ( ".$con['statusnotin']." )";}
		if(isset($con['islivein'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.lastday_int > ".strtotime(date('Y-m-d').' 00:00:00');}
		if(isset($con['isexpired'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.lastday_int <= ".strtotime(date('Y-m-d').' 00:00:00');}
		if(isset($con['order_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.order_id = ".$con['order_id'];}
		if(isset($con['coupon_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.coupon_id = ".$con['coupon_id'];}
		if(isset($con['order_number'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " o.order_number LIKE '%".$con['order_number']."%'";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount == 0){
			$sql="
					
					SELECT o.*
					
					, u.wechat_nickname, u.wechat_avatar, u.user_firstname, u.user_lastname
					, a.plan_name_en, a.plan_name_ch, a.plan_days
					, b.product_name_en, b.product_name_ch, b.product_tagline_en, b.product_tagline_ch
					
					FROM ".DB_PRE()."order_list AS o 
					
					LEFT JOIN ".DB_PRE()."user_list AS u ON o.uid = u.uid
					
					LEFT JOIN ".DB_PRE()."system_product_plan AS a ON o.plan_id = a.plan_id
					
					LEFT JOIN ".DB_PRE()."product_list AS b ON o.product_id = b.product_id
			
			
			$where $group_by $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="
					SELECT count(*) as count 

					FROM ".DB_PRE()."order_list AS o 

					LEFT JOIN ".DB_PRE()."user_list AS u ON o.uid = u.uid

					LEFT JOIN ".DB_PRE()."system_product_plan AS a ON o.plan_id = a.plan_id

					LEFT JOIN ".DB_PRE()."product_list AS b ON o.product_id = b.product_id
					
					$where $group_by $order_by
			
			";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	//获取订单所在的周
	function getweeklist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['order_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " b.order_id = ".$con['order_id'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount == 0){
			$sql="
			
				SELECT a.*
		
				, b.plan_id
		
				FROM ".DB_PRE()."order_week AS a
		
				LEFT JOIN ".DB_PRE()."order_list AS b ON a.order_id = b.order_id
			
				$where $order_by $limit
			";
			
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				for ($i = 0; $i < count($result); $i++) {
					$con = array('week_id'=>$result[$i]['week_id'], 'orderby'=>'a.day_id', 'orderby_res'=>'ASC');
					$result[$i]['day_list'] = $this->OrderModel->getdaylist($con);
				}
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="
				SELECT count(*) as count

				FROM ".DB_PRE()."order_week AS a
	
				LEFT JOIN ".DB_PRE()."order_list AS b ON a.order_id = b.order_id
							
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
	
	//获取订单所在的天
	function getdaylist($con = array(), $iscount = 0){
		$where=" WHERE c.order_id IS NOT NULL";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['date_show'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.date_show = '".$con['date_show']."'";}
		if(isset($con['week_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " b.week_id = ".$con['week_id'];}
		if(isset($con['order_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " c.order_id = ".$con['order_id'];}
		if(isset($con['plan_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " c.plan_id = ".$con['plan_id'];}
		if(isset($con['order_status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " c.status IN (".$con['order_status'].")";}
		if(isset($con['action_status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.action_status = ".$con['action_status'];}
		if(isset($con['action_cancelorpauseisread'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.action_cancelorpauseisread = ".$con['action_cancelorpauseisread'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount == 0){
			$sql="
		
				SELECT a.*
	
				, b.week_date_start, b.week_date_end
				, c.plan_id, c.product_id, c.daily_meals_id, c.cutlery_price_rmb, c.receive_memo_delivery, c.receive_memo_dietary
				, d.wechat_nickname, d.wechat_avatar, d.user_firstname, d.user_lastname, d.user_phone, d.user_phone2, d.user_email
				, e.product_name_en, e.product_name_ch, e.product_tagline_en, e.product_tagline_ch
				, f.plan_name_en, f.plan_name_ch
					
				, aaaa.address_marked AS breakfast_address_marked, aaaa.address_dingwei AS breakfast_address_dingwei, aaaa.address_formattedaddress AS breakfast_address_formattedaddress
				, bbbb.address_marked AS lunch_address_marked, bbbb.address_dingwei AS lunch_address_dingwei, bbbb.address_formattedaddress AS lunch_address_formattedaddress
				, cccc.address_marked AS dinner_address_marked, cccc.address_dingwei AS dinner_address_dingwei, cccc.address_formattedaddress AS dinner_address_formattedaddress
	
				, dddd.time_name_en AS breakfast_time_name_en, dddd.time_name_ch AS breakfast_time_name_ch, dddd.time_name2_en AS breakfast_time_name2_en, dddd.time_name2_ch AS breakfast_time_name2_ch
				, eeee.time_name_en AS lunch_time_name_en, eeee.time_name_ch AS lunch_time_name_ch, eeee.time_name2_en AS lunch_time_name2_en, eeee.time_name2_ch AS lunch_time_name2_ch
				, ffff.time_name_en AS dinner_time_name_en, ffff.time_name_ch AS dinner_time_name_ch, ffff.time_name2_en AS dinner_time_name2_en, ffff.time_name2_ch AS dinner_time_name2_ch
	
				FROM ".DB_PRE()."order_day AS a
	
				LEFT JOIN ".DB_PRE()."order_week AS b ON a.week_id = b.week_id
						
				LEFT JOIN ".DB_PRE()."order_list AS c ON b.order_id = c.order_id
						
				LEFT JOIN ".DB_PRE()."user_list AS d ON c.uid = d.uid
						
				LEFT JOIN ".DB_PRE()."product_list AS e ON c.product_id = e.product_id
						
				LEFT JOIN ".DB_PRE()."system_product_plan AS f ON f.plan_id = c.plan_id
				
				LEFT JOIN ".DB_PRE()."user_address AS aaaa ON a.date_address_id_breakfast = aaaa.address_id
				LEFT JOIN ".DB_PRE()."user_address AS bbbb ON a.date_address_id_lunch = bbbb.address_id
				LEFT JOIN ".DB_PRE()."user_address AS cccc ON a.date_address_id_dinner = cccc.address_id
				
				LEFT JOIN ".DB_PRE()."system_time_list AS dddd ON a.date_time_id_breakfast = dddd.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS eeee ON a.date_time_id_lunch = eeee.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS ffff ON a.date_time_id_dinner = ffff.time_id
						
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
	
				FROM ".DB_PRE()."order_day AS a
	
				LEFT JOIN ".DB_PRE()."order_week AS b ON a.week_id = b.week_id
						
				LEFT JOIN ".DB_PRE()."order_list AS c ON b.order_id = c.order_id
						
				LEFT JOIN ".DB_PRE()."user_list AS d ON c.uid = d.uid
						
				LEFT JOIN ".DB_PRE()."product_list AS e ON c.product_id = e.product_id
								
				LEFT JOIN ".DB_PRE()."system_product_plan AS f ON f.plan_id = c.plan_id
				
				LEFT JOIN ".DB_PRE()."user_address AS aaaa ON a.date_address_id_breakfast = aaaa.address_id
				LEFT JOIN ".DB_PRE()."user_address AS bbbb ON a.date_address_id_lunch = bbbb.address_id
				LEFT JOIN ".DB_PRE()."user_address AS cccc ON a.date_address_id_dinner = cccc.address_id
				
				LEFT JOIN ".DB_PRE()."system_time_list AS dddd ON a.date_time_id_breakfast = dddd.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS eeee ON a.date_time_id_lunch = eeee.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS ffff ON a.date_time_id_dinner = ffff.time_id
						
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
	
	//获取订单的某一天详情
	function getdayinfo($day_id){
		$sql="

			SELECT a.*

			, b.week_date_start, b.week_date_end
			, c.order_id, c.order_number, c.plan_id, c.daily_meals_id, c.cutlery_price_rmb, c.receive_memo_delivery, c.receive_memo_dietary
			, d.wechat_nickname, d.wechat_avatar, d.user_firstname, d.user_lastname, d.user_phone, d.user_phone2, d.user_email
			, e.product_name_en, e.product_name_ch, e.product_tagline_en, e.product_tagline_ch
				
			, f.plan_name_en, f.plan_name_ch, f.plan_days
		
			, aaaa.address_marked AS breakfast_address_marked, aaaa.address_dingwei AS breakfast_address_dingwei, aaaa.address_formattedaddress AS breakfast_address_formattedaddress
			, bbbb.address_marked AS lunch_address_marked, bbbb.address_dingwei AS lunch_address_dingwei, bbbb.address_formattedaddress AS lunch_address_formattedaddress
			, cccc.address_marked AS dinner_address_marked, cccc.address_dingwei AS dinner_address_dingwei, cccc.address_formattedaddress AS dinner_address_formattedaddress

			, dddd.time_name_en AS breakfast_time_name_en, dddd.time_name_ch AS breakfast_time_name_ch, dddd.time_name2_en AS breakfast_time_name2_en, dddd.time_name2_ch AS breakfast_time_name2_ch
			, eeee.time_name_en AS lunch_time_name_en, eeee.time_name_ch AS lunch_time_name_ch, eeee.time_name2_en AS lunch_time_name2_en, eeee.time_name2_ch AS lunch_time_name2_ch
			, ffff.time_name_en AS dinner_time_name_en, ffff.time_name_ch AS dinner_time_name_ch, ffff.time_name2_en AS dinner_time_name2_en, ffff.time_name2_ch AS dinner_time_name2_ch

			FROM ".DB_PRE()."order_day AS a

			LEFT JOIN ".DB_PRE()."order_week AS b ON a.week_id = b.week_id

			LEFT JOIN ".DB_PRE()."order_list AS c ON b.order_id = c.order_id
					
			LEFT JOIN ".DB_PRE()."user_list AS d ON c.uid = d.uid
					
			LEFT JOIN ".DB_PRE()."product_list AS e ON c.product_id = e.product_id
					
			LEFT JOIN ".DB_PRE()."system_product_plan AS f ON c.plan_id = f.plan_id

			LEFT JOIN ".DB_PRE()."user_address AS aaaa ON a.date_address_id_breakfast = aaaa.address_id
			LEFT JOIN ".DB_PRE()."user_address AS bbbb ON a.date_address_id_lunch = bbbb.address_id
			LEFT JOIN ".DB_PRE()."user_address AS cccc ON a.date_address_id_dinner = cccc.address_id

			LEFT JOIN ".DB_PRE()."system_time_list AS dddd ON a.date_time_id_breakfast = dddd.time_id
			LEFT JOIN ".DB_PRE()."system_time_list AS eeee ON a.date_time_id_lunch = eeee.time_id
			LEFT JOIN ".DB_PRE()."system_time_list AS ffff ON a.date_time_id_dinner = ffff.time_id

			WHERE a.day_id = $day_id AND c.order_id IS NOT NULL
		";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return $result;
		}else{
			return null;
		}
	}
	
	//获取订单的某一天详情
	function getdayinfo_byorderandday($order_id, $date){
		$sql="
	
			SELECT a.*
	
			, b.week_date_start, b.week_date_end
			, c.plan_id, c.daily_meals_id, c.cutlery_price_rmb, c.receive_memo_delivery, c.receive_memo_dietary
			, d.wechat_nickname, d.wechat_avatar
			, e.product_name_en, e.product_name_ch, e.product_tagline_en, e.product_tagline_ch
	
			, aaaa.address_marked AS breakfast_address_marked, aaaa.address_dingwei AS breakfast_address_dingwei, aaaa.address_formattedaddress AS breakfast_address_formattedaddress
			, bbbb.address_marked AS lunch_address_marked, bbbb.address_dingwei AS lunch_address_dingwei, bbbb.address_formattedaddress AS lunch_address_formattedaddress
			, cccc.address_marked AS dinner_address_marked, cccc.address_dingwei AS dinner_address_dingwei, cccc.address_formattedaddress AS dinner_address_formattedaddress
	
			, dddd.time_name_en AS breakfast_time_name_en, dddd.time_name_ch AS breakfast_time_name_ch, dddd.time_name2_en AS breakfast_time_name2_en, dddd.time_name2_ch AS breakfast_time_name2_ch
			, eeee.time_name_en AS lunch_time_name_en, eeee.time_name_ch AS lunch_time_name_ch, eeee.time_name2_en AS lunch_time_name2_en, eeee.time_name2_ch AS lunch_time_name2_ch
			, ffff.time_name_en AS dinner_time_name_en, ffff.time_name_ch AS dinner_time_name_ch, ffff.time_name2_en AS dinner_time_name2_en, ffff.time_name2_ch AS dinner_time_name2_ch
	
			FROM ".DB_PRE()."order_day AS a
	
			LEFT JOIN ".DB_PRE()."order_week AS b ON a.week_id = b.week_id
	
			LEFT JOIN ".DB_PRE()."order_list AS c ON b.order_id = c.order_id
							
			LEFT JOIN ".DB_PRE()."user_list AS d ON c.uid = d.uid
					
			LEFT JOIN ".DB_PRE()."product_list AS e ON c.product_id = e.product_id
	
			LEFT JOIN ".DB_PRE()."user_address AS aaaa ON a.date_address_id_breakfast = aaaa.address_id
			LEFT JOIN ".DB_PRE()."user_address AS bbbb ON a.date_address_id_lunch = bbbb.address_id
			LEFT JOIN ".DB_PRE()."user_address AS cccc ON a.date_address_id_dinner = cccc.address_id
	
			LEFT JOIN ".DB_PRE()."system_time_list AS dddd ON a.date_time_id_breakfast = dddd.time_id
			LEFT JOIN ".DB_PRE()."system_time_list AS eeee ON a.date_time_id_lunch = eeee.time_id
			LEFT JOIN ".DB_PRE()."system_time_list AS ffff ON a.date_time_id_dinner = ffff.time_id
	
			WHERE c.order_id = $order_id AND a.date_show = '".$date."'
		";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return $result;
		}else{
			return null;
		}
	}
	
	
	function getcouponlist($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		$group_by="";
		if(isset($con['uid'])){if($where!=""){$where .=" AND ";}else{$where .=" WHERE ";} $where .= " uid =".$con['uid'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount==0){
			$sql="SELECT * FROM ".DB_PRE()."coupon_list  $where $group_by $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."coupon_list  $where $group_by $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	function get_ordernumber($order_id){
		//
		$time_start = strtotime(date('Y-m-d').' 00:00:00');
		$time_end = strtotime(date('Y-m-d').' 23:59:59');

		$sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."order_list WHERE created >= ".$time_start." AND created <= ".$time_end;
		$res = $this->db->query($sql)->row_array();
		if(!empty($res)){
			if($res['numcount'] != ''){
				$count = $res['numcount'];
			}else{
				$count = 0;
			}
		}else{
			$count = 0;
		}
		if($count < 10){
			$count_show = '00'.$count;
		}else if($count >= 10 & $count < 100){
			$count_show = '0'.$count;
		}else{
			$count_show = $count;
		}
		return $newcode = 'REVO-'.date('Ymd').$count_show;
	}
	
	function add_order($arr, $address_id_breakfast_str='', $address_id_lunch_str='', $address_id_dinner_str='', $time_id_breakfast_str='', $time_id_lunch_str='', $time_id_dinner_str=''){
		$this->db->insert(DB_PRE().'order_list', $arr);
		$order_id = $this->db->insert_id();
		$order_number = $this->get_ordernumber($order_id);
		$this->db->update(DB_PRE().'order_list', array('order_number'=>$order_number), array('order_id'=>$order_id));
		
		$orderinfo = $this->OrderModel->getorderinfo($order_id);
		$plan_id = $orderinfo['plan_id'];
		$weekdayplan_id = $orderinfo['weekdayplan_id'];
		$week_num = $orderinfo['week_num'];
		$week_days = $orderinfo['week_days'];
		$duration_start_int = $orderinfo['duration_start_int'];
		$duration_end_int = $orderinfo['duration_end_int'];
		
		$address_id_breakfast = $orderinfo['address_id_breakfast'];
		$address_id_lunch = $orderinfo['address_id_lunch'];
		$address_id_dinner = $orderinfo['address_id_dinner'];

		$time_id_breakfast = $orderinfo['time_id_breakfast'];
		$time_id_lunch = $orderinfo['time_id_lunch'];
		$time_id_dinner = $orderinfo['time_id_dinner'];
		
		$getallweek_day = array();
		if($orderinfo['plan_id'] == 1){
			$week_days_split = explode('_', $week_days);
		
			for ($i = $duration_start_int; $i <= $duration_end_int; $i = $i+86400) {
				$isadd = 0;
				for ($j = 0; $j < count($week_days_split); $j++) {
					if(date('w', $i) == $week_days_split[$j]){
						$isadd = 1;
					}
				}
				if($isadd == 1){
					$getallweek_day[] =  date('Y-m-d', $i);
				}
			}
		}else{
			for ($i = $duration_start_int; $i <= $duration_end_int; $i = $i+86400) {
				$isadd = 0;
				if($weekdayplan_id == 1){//整周
					$isadd = 1;
				}else if($weekdayplan_id == 2){//工作日
					if(date('w', $i) != 0 && date('w', $i) != 6){
						$isadd = 1;
					}
				}
				if($isadd == 1){
					$getallweek_day[] =  date('Y-m-d', $i);
				}
			}
		}
		//分别将这所有的天归纳到某个星期里面
		$getallweek_list_pre = array();
		$getweekstartdaty_pre = 0;
		
		if(!empty($getallweek_day)){
			for ($i = 0; $i < count($getallweek_day); $i++) {
				if((strtotime($getallweek_day[$i].' 12:00:00') - $getweekstartdaty_pre) >= 86400*7){
					if(isset($thisweekarr) && !empty($thisweekarr)){
						$getallweek_list_pre[] = $thisweekarr;
					}
						
					$thisweekarr = array();
					if(date('w', strtotime($getallweek_day[$i].' 12:00:00')) == 0){//判断当前是星期几
						$getweekstartdaty_pre = strtotime($getallweek_day[$i].' 12:00:00') - 6*86400;
					}else{//判断当前是星期几
						$getweekstartdaty_pre = strtotime($getallweek_day[$i].' 12:00:00') - (date('w', strtotime($getallweek_day[$i].' 12:00:00')) - 1)*86400;
					}
				}
				$thisweekarr[] = $getallweek_day[$i];
		
				if($i == (count($getallweek_day) - 1)){
					if(isset($thisweekarr) && !empty($thisweekarr)){
						$getallweek_list_pre[] = $thisweekarr;
					}
				}
			}
		}
		//重新整理这一周
		$getallweek_list_new = array();
		if(!empty($getallweek_list_pre)){
			for ($i = 0; $i < count($getallweek_list_pre); $i++) {
		
				if(isset($getallweek_list_pre[$i][0])){
					//判断当前是星期几
					if(date('w', strtotime($getallweek_list_pre[$i][0].' 12:00:00')) == 0){//判断当前是星期几
						$getweekstartdaty_new = strtotime($getallweek_list_pre[$i][0].' 12:00:00') - 6*86400;
					}else{//判断当前是星期几
						$getweekstartdaty_new = strtotime($getallweek_list_pre[$i][0].' 12:00:00') - (date('w', strtotime($getallweek_list_pre[$i][0].' 12:00:00')) - 1)*86400;
					}
						
					$thisweekarr = array('week_date_start'=>date('Y-m-d', $getweekstartdaty_new), 'week_date_end'=>date('Y-m-d', $getweekstartdaty_new + 86400*6), 'week_date_arr'=>$getallweek_list_pre[$i]);
					$getallweek_list_new[] = $thisweekarr;
				}
			}
		}
		
		//添加到数据库中 -- 开始
		$allday_index = 0;
		if(isset($getallweek_list_new)){for ($i = 0; $i < count($getallweek_list_new); $i++) {
			$week_date_start = $getallweek_list_new[$i]['week_date_start'];
			$week_date_end = $getallweek_list_new[$i]['week_date_end'];
			$week_date_arr = $getallweek_list_new[$i]['week_date_arr'];
			
			if(!empty($week_date_arr)){
			
				$arr = array('order_id'=>$order_id, 'week_date_start'=>$week_date_start, 'week_date_end'=>$week_date_end, 'created'=>time());
				$this->db->insert(DB_PRE().'order_week', $arr);
				$week_id = $this->db->insert_id();
			
				if($address_id_lunch_str != '' || $address_id_dinner_str != ''){
					$address_id_breakfast_arr = explode(',', $address_id_breakfast_str);
					$address_id_lunch_arr = explode(',', $address_id_lunch_str);
					$address_id_dinner_arr = explode(',', $address_id_dinner_str);
					
					$time_id_breakfast_arr = explode(',', $time_id_breakfast_str);
					$time_id_lunch_arr = explode(',', $time_id_lunch_str);
					$time_id_dinner_arr = explode(',', $time_id_dinner_str);
					//customize
					for ($j = 0; $j < count($week_date_arr); $j++) {
						$arr = array('week_id'=>$week_id, 'date_show'=>$week_date_arr[$j], 'date_int'=>strtotime($week_date_arr[$j].' 12:00:00'));
						$arr['date_address_id_breakfast'] = $address_id_breakfast_arr[$allday_index];
						$arr['date_address_id_lunch'] = $address_id_lunch_arr[$allday_index];
						$arr['date_address_id_dinner'] = $address_id_dinner_arr[$allday_index];
							
						$arr['date_time_id_breakfast'] = $time_id_breakfast_arr[$allday_index];
						$arr['date_time_id_lunch'] = $time_id_lunch_arr[$allday_index];
						$arr['date_time_id_dinner'] = $time_id_dinner_arr[$allday_index];
							
						$arr['created'] = time();
						$this->db->insert(DB_PRE().'order_day', $arr);
							
						$allday_index++;
					}
				}else{
					for ($j = 0; $j < count($week_date_arr); $j++) {
						$arr = array('week_id'=>$week_id, 'date_show'=>$week_date_arr[$j], 'date_int'=>strtotime($week_date_arr[$j].' 12:00:00'));
						$arr['date_address_id_breakfast'] = $address_id_breakfast;
						$arr['date_address_id_lunch'] = $address_id_lunch;
						$arr['date_address_id_dinner'] = $address_id_dinner;
							
						$arr['date_time_id_breakfast'] = $time_id_breakfast;
						$arr['date_time_id_lunch'] = $time_id_lunch;
						$arr['date_time_id_dinner'] = $time_id_dinner;
							
						$arr['created'] = time();
						$this->db->insert(DB_PRE().'order_day', $arr);
							
						$allday_index++;
					}
				}
				
			}
		}}
		//添加到数据库中 -- 结束
		return $order_id;
	}

	function getorderinfo_byordernumber($order_number){
		$sql="select * from ".DB_PRE()."order_list where order_number = '$order_number'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return null;
		}
	}
	function getorderinfo($order_id){
		$sql="

				SELECT 
				
				o.* 
				, u.wechat_nickname, u.wechat_avatar
				, a.plan_name_en, a.plan_name_ch, a.plan_days
				, b.product_name_en, b.product_name_ch, b.product_tagline_en, b.product_tagline_ch

				FROM ".DB_PRE()."order_list AS o

				LEFT JOIN ".DB_PRE()."user_list AS u ON o.uid = u.uid
	
				LEFT JOIN ".DB_PRE()."system_product_plan AS a ON o.plan_id = a.plan_id

				LEFT JOIN ".DB_PRE()."product_list AS b ON o.product_id = b.product_id
		
				WHERE o.order_id = $order_id
		";
		
		$query=$this->db->query($sql);
		if($query->num_rows()>0){           
			return $query->row_array();    
		}else{
			return null;   
		}
	}
	
	function get_and_check_orderinfo($order_id,$uid=0){
		$sql="select * from ".DB_PRE()."order_list where order_id=$order_id and uid=$uid";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){           
			return $query->row_array();    
		}else{
			return null;   
		}
	}
	//修改订单中的某一天
	function edit_day($day_id, $arr){
		$this->db->update(DB_PRE().'order_day', $arr,array('day_id'=>$day_id));
	}

	function edit_order($order_id,$arr){
		$this->db->update(DB_PRE().'order_list',$arr,array('order_id'=>$order_id));
	}

	function del_order($order_id){
		$sql = "SELECT * FROM ".DB_PRE()."order_week WHERE order_id = ".$order_id;
		$weeklist = $this->db->query($sql)->result_array();
		if(!empty($weeklist)){
			for ($i = 0; $i < count($weeklist); $i++) {
				
				$sql = "SELECT * FROM ".DB_PRE()."order_day WHERE week_id = ".$weeklist[$i]['week_id'];
				$daylist = $this->db->query($sql)->result_array();
				if(!empty($daylist)){
					for ($j = 0; $j < count($daylist); $j++) {
						$this->db->delete(DB_PRE().'order_day_log_changedelivery', array('day_id'=>$daylist[$j]['day_id']));
					
					
						$this->db->delete(DB_PRE().'order_day', array('day_id'=>$daylist[$j]['day_id']));
					}
				}
				
				$this->db->delete(DB_PRE().'order_week', array('week_id'=>$weeklist[$i]['week_id']));
			}
		}
		
		$this->db->delete(DB_PRE().'order_list',array('order_id'=>$order_id));
	}
	
	//自动清理所有 超过一天未付款的订单
	function autocleanup_unpayorder(){
		$con = array('other_con'=>'o.created < '.(time() - 86400*3), 'statusin'=>'0', 'orderby'=>'o.order_id', 'orderby_res'=>'DESC');
		$orderlist = $this->OrderModel->getorderlist($con);
		if(!empty($orderlist)){
			for ($i = 0; $i < count($orderlist); $i++) {
				$this->OrderModel->del_order($orderlist[$i]['order_id']);
			}
		}
	}
	
	function calculate_allprice($plan_id, $weekdayplan_id, $product_id, $daily_meals_id, $address_id_breakfast, $address_id_lunch, $address_id_dinner, $address_id_breakfast_str, $address_id_lunch_str, $address_id_dinner_str, $week_num, $week_days){
		$planinfo = $this->PlanModel->getplaninfo($plan_id);
		//计算 plan_price 和 shipping fee
		if($plan_id == 1){
			if($address_id_lunch_str != '' || $address_id_dinner_str != ''){
				
				if($week_days != ''){
					$week_days_split = explode('_', $week_days);
					if(count($week_days_split) > 0){
						if($daily_meals_id == 1){//只有午餐
							if($product_id == 164){
								$price_plan = $planinfo['plan_price_lunch_164']*count($week_days_split)*$week_num;
							}else if($product_id == 165){
								$price_plan = $planinfo['plan_price_lunch_165']*count($week_days_split)*$week_num;
							}else{
								$price_plan = $planinfo['plan_price_lunch_163']*count($week_days_split)*$week_num;
							}
						}else if($daily_meals_id == 2){//只有晚餐
							if($product_id == 164){
								$price_plan = $planinfo['plan_price_dinner_164']*count($week_days_split)*$week_num;
							}else if($product_id == 165){
								$price_plan = $planinfo['plan_price_dinner_165']*count($week_days_split)*$week_num;
							}else{
								$price_plan = $planinfo['plan_price_dinner_163']*count($week_days_split)*$week_num;
							}
						}else if($daily_meals_id == 3){//午餐和晚餐
							if($product_id == 164){
								$price_plan = $planinfo['plan_price_unit_164']*count($week_days_split)*$week_num;
							}else if($product_id == 165){
								$price_plan = $planinfo['plan_price_unit_165']*count($week_days_split)*$week_num;
							}else{
								$price_plan = $planinfo['plan_price_unit_163']*count($week_days_split)*$week_num;
							}
						}
					}else{
						$price_plan = 0;
					}
				}else{
					$price_plan = 0;
				}
				
				$price_shippingfee = 0;//计算运费
				//customize
				if($address_id_lunch_str != '' || $address_id_dinner_str != ''){
					$address_id_lunch_arr = explode(',', $address_id_lunch_str);
					$address_id_dinner_arr = explode(',', $address_id_dinner_str);
					if($daily_meals_id == 1){//只有午餐
						for ($i = 0; $i < count($address_id_lunch_arr); $i++) {
							$address_id_lunch_info = $this->UserModel->getaddressinfo($address_id_lunch_arr[$i]);
							if(!empty($address_id_lunch_info)){
								if($address_id_lunch_info['address_distance'] <= 6){
									$price_shippingfee = $price_shippingfee + 0;//计算运费
								}else{
									$price_shippingfee = $price_shippingfee + 12;//计算运费
								}
							}
						}
					}else if($daily_meals_id == 2){//只有晚餐
						for ($i = 0; $i < count($address_id_dinner_arr); $i++) {
							$address_id_dinner_info = $this->UserModel->getaddressinfo($address_id_dinner_arr[$i]);
							if($address_id_dinner_info['address_distance'] <= 6){
								$price_shippingfee = $price_shippingfee + 0;//计算运费
							}else{
								$price_shippingfee = $price_shippingfee + 12;//计算运费
							}
						}
					}else if($daily_meals_id == 3){//午餐 + 晚餐
						for ($i = 0; $i < count($address_id_lunch_arr); $i++) {
							$address_id_lunch_info = $this->UserModel->getaddressinfo($address_id_lunch_arr[$i]);
							if(!empty($address_id_lunch_info)){
								if($address_id_lunch_info['address_distance'] <= 6){
									$price_shippingfee = $price_shippingfee + 0;//计算运费
								}else{
									$price_shippingfee = $price_shippingfee + 12;//计算运费
								}
							}
								
							$address_id_dinner_info = $this->UserModel->getaddressinfo($address_id_dinner_arr[$i]);
							if($address_id_dinner_info['address_distance'] <= 6){
								$price_shippingfee = $price_shippingfee + 0;//计算运费
							}else{
								$price_shippingfee = $price_shippingfee + 12;//计算运费
							}
						}
					}
				}
			}else{
				if($week_days != ''){
					$week_days_split = explode('_', $week_days);
					if(count($week_days_split) > 0){
						$oneday = 0;
						if($daily_meals_id == 1){//只有午餐
							if($product_id == 164){
								$price_plan = $planinfo['plan_price_lunch_164']*count($week_days_split)*$week_num;
							}else if($product_id == 165){
								$price_plan = $planinfo['plan_price_lunch_165']*count($week_days_split)*$week_num;
							}else{
								$price_plan = $planinfo['plan_price_lunch_163']*count($week_days_split)*$week_num;
							}
								
							$address_id_lunch_info = $this->UserModel->getaddressinfo($address_id_lunch);
							if($address_id_lunch_info['address_distance'] <= 6){
								$oneday = $oneday + 0;
							}else{
								$oneday = $oneday + 12;
							}
						}else if($daily_meals_id == 2){//只有晚餐
							if($product_id == 164){
								$price_plan = $planinfo['plan_price_dinner_164']*count($week_days_split)*$week_num;
							}else if($product_id == 165){
								$price_plan = $planinfo['plan_price_dinner_165']*count($week_days_split)*$week_num;
							}else{
								$price_plan = $planinfo['plan_price_dinner_163']*count($week_days_split)*$week_num;
							}
								
							$address_id_dinner_info = $this->UserModel->getaddressinfo($address_id_dinner);
							if($address_id_dinner_info['address_distance'] <= 6){
								$oneday = $oneday + 0;
							}else{
								$oneday = $oneday + 12;
							}
						}else if($daily_meals_id == 3){//午餐和晚餐
							if($product_id == 164){
								$price_plan = $planinfo['plan_price_unit_164']*count($week_days_split)*$week_num;
							}else if($product_id == 165){
								$price_plan = $planinfo['plan_price_unit_165']*count($week_days_split)*$week_num;
							}else{
								$price_plan = $planinfo['plan_price_unit_163']*count($week_days_split)*$week_num;
							}
								
							$address_id_lunch_info = $this->UserModel->getaddressinfo($address_id_lunch);
							if($address_id_lunch_info['address_distance'] <= 6){
								$oneday = $oneday + 0;
							}else{
								$oneday = $oneday + 12;
							}
							$address_id_dinner_info = $this->UserModel->getaddressinfo($address_id_dinner);
							if($address_id_dinner_info['address_distance'] <= 6){
								$oneday = $oneday + 0;
							}else{
								$oneday = $oneday + 12;
							}
						}
				
						$price_shippingfee = $oneday * count($week_days_split) * $week_num;//计算运费
					}else{
						$price_plan = 0;
						$price_shippingfee = 0;
					}
				}else{
					$price_plan = 0;
					$price_shippingfee = 0;
				}
			}
			
		}else{
			
			if($product_id == 164){
				$price_plan = $planinfo['plan_price_unit_164']*$planinfo['plan_days'];
			}else if($product_id == 165){
				$price_plan = $planinfo['plan_price_unit_165']*$planinfo['plan_days'];
			}else{
				$price_plan = $planinfo['plan_price_unit_163']*$planinfo['plan_days'];
			}
			
			
			if($address_id_lunch_str != '' || $address_id_dinner_str != ''){
				$price_shippingfee = 0;//计算运费
				//customize 
				if($address_id_lunch_str != '' || $address_id_dinner_str != ''){
					$address_id_lunch_arr = explode(',', $address_id_lunch_str);
					$address_id_dinner_arr = explode(',', $address_id_dinner_str);
					for ($i = 0; $i < count($address_id_lunch_arr); $i++) {
						$address_id_lunch_info = $this->UserModel->getaddressinfo($address_id_lunch_arr[$i]);
						if(!empty($address_id_lunch_info)){
							if($address_id_lunch_info['address_distance'] <= 6){
								$price_shippingfee = $price_shippingfee + 0;//计算运费
							}else{
								$price_shippingfee = $price_shippingfee + 12;//计算运费
							}
						}
					
						$address_id_dinner_info = $this->UserModel->getaddressinfo($address_id_dinner_arr[$i]);
						if($address_id_dinner_info['address_distance'] <= 6){
							$price_shippingfee = $price_shippingfee + 0;//计算运费
						}else{
							$price_shippingfee = $price_shippingfee + 12;//计算运费
						}
					}
				}
			}else{
				$address_id_lunch_info = $this->UserModel->getaddressinfo($address_id_lunch);
				if($address_id_lunch_info['address_distance'] <= 6){
					$oneday = 0;
				}else{
					$oneday = 12;
				}
				$address_id_dinner_info = $this->UserModel->getaddressinfo($address_id_dinner);
				if($address_id_dinner_info['address_distance'] <= 6){
					$oneday = $oneday + 0;
				}else{
					$oneday = $oneday + 12;
				}
				$price_shippingfee = $oneday * $planinfo['plan_days'];//计算运费
			}
			
		}
		return json_encode(array('price_plan'=>$price_plan, 'price_shippingfee'=>$price_shippingfee));
	}
	//发送微信订单通知
	function sendwechat_ordernotice($order_id, $istest = 0){
		$orderinfo = $this->OrderModel->getorderinfo($order_id);
		$userinfo = $this->UserModel->getuserinfo($orderinfo['uid']);
		
		$tousercon=array();
		if($istest == 1){
			$tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
		}else{
			$tousercon[] = array('touser_wechat_id'=>$userinfo['wechat_id'], 'touser_name'=>'Customer');
			$tousercon[] = array('touser_wechat_id'=>'oWTCLwcJqHuC1_RJ0672e1V2TRhE', 'touser_name'=>'浦文龙');
			$tousercon[] = array('touser_wechat_id'=>'oWTCLwdi5khyAaxygm2ipHWF7s4s', 'touser_name'=>'Wolf | Saucepan');
		}
		
		if(!empty($tousercon)){
			for($tt = 0; $tt < count($tousercon); $tt++){
				$con = array('touser'=>$tousercon[$tt]['touser_wechat_id'],'url'=>site_url('wechat/order/toview_order?order_id='.$order_id.'&randkey='.$orderinfo['randkey']));
	
				$con['first_value']='';
				$con['first_color']='#173177';
	
				$con['keyword1_value'] = date('Y-m-d H:i:s');//Time
				$con['keyword1_color'] = '#333333';
	
				$con['keyword2_value'] = 'REVO NEW ORDER';//Type
				$con['keyword2_color'] = '#333333';
				
				$con['keyword3_value'] = $userinfo['wechat_nickname'].' '.$userinfo['user_firstname'].' '.$userinfo['user_lastname'];//Client
				$con['keyword3_color'] = '#333333';
				
				$con['keyword4_value'] = $orderinfo['order_number'].'\\nPlan：'.$orderinfo['plan_name_en'].'\\nMeals：'.$orderinfo['product_name_en'].'\\nTotal Price：￥'.$orderinfo['total_price_rmb'];//Order No.
				$con['keyword4_color'] = '#333333';
					
				$con['remark_value'] = '';//备注
				$con['remark_color'] = '#333333';
				$res = notice_neworder($con);//发送模版消息 --订单消息通知
			}
		}
	}
	
	//更新一个订单的第一天和最后一天
	function updateorderfirstlast_day($order_id){
		$con = array('order_id'=>$order_id, 'action_status'=>0, 'orderby'=>'a.date_int', 'orderby_res'=>'ASC', 'row'=>0, 'page'=>1);
		$first_day_res = $this->OrderModel->getdaylist($con);
		if(!empty($first_day_res)){
			$firstday_int = $first_day_res[0]['date_int'];
			$firstday_show = $first_day_res[0]['date_show'];
		}else{
			$firstday_int = 0;
			$firstday_show = '';
		}
		$con = array('order_id'=>$order_id, 'action_status'=>0, 'orderby'=>'a.date_int', 'orderby_res'=>'DESC', 'row'=>0, 'page'=>1);
		$last_day_res = $this->OrderModel->getdaylist($con);
		if(!empty($last_day_res)){
			$lastday_int = $last_day_res[0]['date_int'];
			$lastday_show = $last_day_res[0]['date_show'];
		}else{
			$lastday_int = 0;
			$lastday_show = '';
		}
		
		$arr = array('firstday_int'=>$firstday_int, 'firstday_show'=>$firstday_show, 'lastday_int'=>$lastday_int, 'lastday_show'=>$lastday_show);
		$this->OrderModel->edit_order($order_id, $arr);
	}
	
	//获取 某天 改变了 delivery address and time 记录
	function getday_changedeliverylist($con = array(), $iscount = 0){
		$where=" WHERE c.order_id IS NOT NULL";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['date_show'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.date_show = '".$con['date_show']."'";}
		if(isset($con['week_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " b.week_id = ".$con['week_id'];}
		if(isset($con['order_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " c.order_id = ".$con['order_id'];}
		if(isset($con['order_status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " c.status IN (".$con['order_status'].")";}
		if(isset($con['action_status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.action_status = ".$con['action_status'];}
		if(isset($con['log_isread'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " iiii.log_isread = ".$con['log_isread'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount == 0){
			$sql="
	
				SELECT iiii.*
				, a.date_show, a.action_status
				, b.week_date_start, b.week_date_end
				, c.plan_id, c.daily_meals_id, c.order_number
				, d.wechat_nickname, d.wechat_avatar
				, e.product_name_en, e.product_name_ch, e.product_tagline_en, e.product_tagline_ch
			
				, aaaa.address_marked AS from_breakfast_address_marked, aaaa.address_dingwei AS from_breakfast_address_dingwei, aaaa.address_formattedaddress AS from_breakfast_address_formattedaddress
				, bbbb.address_marked AS from_lunch_address_marked, bbbb.address_dingwei AS from_lunch_address_dingwei, bbbb.address_formattedaddress AS from_lunch_address_formattedaddress
				, cccc.address_marked AS from_dinner_address_marked, cccc.address_dingwei AS from_dinner_address_dingwei, cccc.address_formattedaddress AS from_dinner_address_formattedaddress
	
				, dddd.time_name_en AS from_breakfast_time_name_en, dddd.time_name_ch AS from_breakfast_time_name_ch, dddd.time_name2_en AS from_breakfast_time_name2_en, dddd.time_name2_ch AS from_breakfast_time_name2_ch
				, eeee.time_name_en AS from_lunch_time_name_en, eeee.time_name_ch AS from_lunch_time_name_ch, eeee.time_name2_en AS from_lunch_time_name2_en, eeee.time_name2_ch AS from_lunch_time_name2_ch
				, ffff.time_name_en AS from_dinner_time_name_en, ffff.time_name_ch AS from_dinner_time_name_ch, ffff.time_name2_en AS from_dinner_time_name2_en, ffff.time_name2_ch AS from_dinner_time_name2_ch
	
					
					
				, aaaaaaaa.address_marked AS to_breakfast_address_marked, aaaaaaaa.address_dingwei AS to_breakfast_address_dingwei, aaaaaaaa.address_formattedaddress AS to_breakfast_address_formattedaddress
				, bbbbbbbb.address_marked AS to_lunch_address_marked, bbbbbbbb.address_dingwei AS to_lunch_address_dingwei, bbbbbbbb.address_formattedaddress AS to_lunch_address_formattedaddress
				, cccccccc.address_marked AS to_dinner_address_marked, cccccccc.address_dingwei AS to_dinner_address_dingwei, cccccccc.address_formattedaddress AS to_dinner_address_formattedaddress
	
				, dddddddd.time_name_en AS to_breakfast_time_name_en, dddddddd.time_name_ch AS to_breakfast_time_name_ch, dddddddd.time_name2_en AS to_breakfast_time_name2_en, dddddddd.time_name2_ch AS to_breakfast_time_name2_ch
				, eeeeeeee.time_name_en AS to_lunch_time_name_en, eeeeeeee.time_name_ch AS to_lunch_time_name_ch, eeeeeeee.time_name2_en AS to_lunch_time_name2_en, eeeeeeee.time_name2_ch AS to_lunch_time_name2_ch
				, ffffffff.time_name_en AS to_dinner_time_name_en, ffffffff.time_name_ch AS to_dinner_time_name_ch, ffffffff.time_name2_en AS to_dinner_time_name2_en, ffffffff.time_name2_ch AS to_dinner_time_name2_ch
	
					
					
				
					
				FROM ".DB_PRE()."order_day_log_changedelivery AS iiii
						
				LEFT JOIN ".DB_PRE()."order_day AS a ON iiii.day_id = a.day_id
	
				LEFT JOIN ".DB_PRE()."order_week AS b ON a.week_id = b.week_id
	
				LEFT JOIN ".DB_PRE()."order_list AS c ON b.order_id = c.order_id
	
				LEFT JOIN ".DB_PRE()."user_list AS d ON c.uid = d.uid
	
				LEFT JOIN ".DB_PRE()."product_list AS e ON c.product_id = e.product_id

				LEFT JOIN ".DB_PRE()."user_address AS aaaa ON iiii.from_address_id_breakfast = aaaa.address_id
				LEFT JOIN ".DB_PRE()."user_address AS bbbb ON iiii.from_address_id_lunch = bbbb.address_id
				LEFT JOIN ".DB_PRE()."user_address AS cccc ON iiii.from_address_id_dinner = cccc.address_id
	
				LEFT JOIN ".DB_PRE()."system_time_list AS dddd ON iiii.from_time_id_breakfast = dddd.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS eeee ON iiii.from_time_id_lunch = eeee.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS ffff ON iiii.from_time_id_dinner = ffff.time_id
				
				
				
				
				LEFT JOIN ".DB_PRE()."user_address AS aaaaaaaa ON iiii.to_address_id_breakfast = aaaaaaaa.address_id
				LEFT JOIN ".DB_PRE()."user_address AS bbbbbbbb ON iiii.to_address_id_lunch = bbbbbbbb.address_id
				LEFT JOIN ".DB_PRE()."user_address AS cccccccc ON iiii.to_address_id_dinner = cccccccc.address_id
	
				LEFT JOIN ".DB_PRE()."system_time_list AS dddddddd ON iiii.to_time_id_breakfast = dddddddd.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS eeeeeeee ON iiii.to_time_id_lunch = eeeeeeee.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS ffffffff ON iiii.to_time_id_dinner = ffffffff.time_id
	
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
	
				FROM ".DB_PRE()."order_day_log_changedelivery AS iiii
						
				LEFT JOIN ".DB_PRE()."order_day AS a ON iiii.day_id = a.day_id
	
				LEFT JOIN ".DB_PRE()."order_week AS b ON a.week_id = b.week_id
	
				LEFT JOIN ".DB_PRE()."order_list AS c ON b.order_id = c.order_id
	
				LEFT JOIN ".DB_PRE()."user_list AS d ON c.uid = d.uid
	
				LEFT JOIN ".DB_PRE()."product_list AS e ON c.product_id = e.product_id
	
				LEFT JOIN ".DB_PRE()."user_address AS aaaa ON iiii.from_address_id_breakfast = aaaa.address_id
				LEFT JOIN ".DB_PRE()."user_address AS bbbb ON iiii.from_address_id_lunch = bbbb.address_id
				LEFT JOIN ".DB_PRE()."user_address AS cccc ON iiii.from_address_id_dinner = cccc.address_id
	
				LEFT JOIN ".DB_PRE()."system_time_list AS dddd ON iiii.from_time_id_breakfast = dddd.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS eeee ON iiii.from_time_id_lunch = eeee.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS ffff ON iiii.from_time_id_dinner = ffff.time_id
				
				
				
				
				LEFT JOIN ".DB_PRE()."user_address AS aaaaaaaa ON iiii.to_address_id_breakfast = aaaaaaaa.address_id
				LEFT JOIN ".DB_PRE()."user_address AS bbbbbbbb ON iiii.to_address_id_lunch = bbbbbbbb.address_id
				LEFT JOIN ".DB_PRE()."user_address AS cccccccc ON iiii.to_address_id_dinner = cccccccc.address_id
	
				LEFT JOIN ".DB_PRE()."system_time_list AS dddddddd ON iiii.to_time_id_breakfast = dddddddd.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS eeeeeeee ON iiii.to_time_id_lunch = eeeeeeee.time_id
				LEFT JOIN ".DB_PRE()."system_time_list AS ffffffff ON iiii.to_time_id_dinner = ffffffff.time_id
	
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
	
	//查看订单的开票状态
	function toshow_order_kaipiaozhuangtai($order_id) {
		header("Content-type: text/html; charset=utf-8");
		 
		$uploaddir = "upload/fapiao";
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
		$uploaddir = "upload/fapiao/".date('Y');
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
		$uploaddir = "upload/fapiao/".date('Y')."/".date('m');
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
		 
		require './lib/DD.php';
		 
		//正式
		$baseUri = "http://api.360ddj.com";//http://api.360ddj.com
		$platCode = "NYCT";
		$orgCode = "DDJFP202106080003N";
		$authCode = "95549880";
		$privateKey = "MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAMNefkuOYPfkpFHYuEzGw9Mn6edRPTnNeeHFlJev6NGotKithVHTFzO+HhJdPl9NXsc3plnA0CqergcgZLAWTBbulrQnMxzxSyHWMAUuqZLgWLXm93Rooj9UcSeH5TZgmcaTXplIxJJXigr3mLb8VWoQnG47Ck1XiZynv1Nd0y+5AgMBAAECgYEAqPmSjHDxx5Y21R93j9geSQRtlwc5yEPC1hYYxfV8jdG3p2ilNbc4iyU1RzbkmnMFtZKZS2mr4iDqbfmDfJVcaro9mCL1xrVrw705YJy+jH1+cEOnEPfKoiqM8efWkjP5sPUThTP5xdYji8r7PKFVHjkdbGegnlUm1vcQG1aQJwECQQDi2AdIMgTjONYJulxhnGVAl+Z96BiDNg/oTSgGdsDwBzYHQnpkwk/dHKgjWg3yRjcoP7wpXOLHpztFANt7L+zZAkEA3HrVY6ZUmabIpOC5f1MO/nYUTowspZX6zTk1k4WVDmM8+AfALRep2m8ckgfOeQN4z4PHFoAxu+G6wpbuLvUN4QJBAKp0plQrsdyEMuGwdgarHLKC8iIeK309PIrUn4Tr62LyKDkgTRQ1pwmBpR6bZutss7m82slCEO7xzOm3ETXp91ECQD3LL4N+Wre1xwZu9Y55+PnYnlhlcR33qxNZtWpjRiOCLNRXV8VLnI9cFOXYykWgc3u1s1bbFxVRbsabBqaiiAECQQDXgUlk4MYgJQNkN+H9OA5WAAP7ebiYH4NXE7n1ipOCikRi2yxSk7VKmHHz1WavW69Q16yh1PfbtxoJtpy0+qS+";
		 
		$sql = "SELECT * FROM ".DB_PRE()."order_invoice WHERE order_id = ".$order_id;
		$orderinfo = $this->db->query($sql)->row_array();
		 
		if($orderinfo['res_fapiao_pdfUrl'] != ''){
			//已经扫描申请过了
			$res_fapiao_date = $orderinfo['res_fapiao_date'];
			$res_fapiao_no = $orderinfo['res_fapiao_no'];
			$res_fapiao_code = $orderinfo['res_fapiao_code'];
			$res_fapiao_pdfUrl = $orderinfo['res_fapiao_pdfUrl'];
			$res_fapiao_tax = $orderinfo['res_fapiao_tax'];
			$res_fapiao_amount = $orderinfo['res_fapiao_amount'];
			 
			return 'has_invoiced';//已经开票了
		}else{
			////
			if($orderinfo['fapiao_qrimage'] != '' && $orderinfo['fapiao_qrUrl'] != '' && $orderinfo['fapiao_orderNo'] != ''){
				$fapiao_qrUrl = $orderinfo['fapiao_qrUrl'];
				$fapiao_qrimage = $orderinfo['fapiao_qrimage'];
				$fapiao_orderNo = $orderinfo['fapiao_orderNo'];
				 
				$client = new DD($baseUri, $platCode, $orgCode, $authCode, $privateKey);
				$d = $client->queryInvoice($fapiao_orderNo);
				if($d['code'] == 1000){
					return 'unscan';//用户还没有扫描二维码开票
				}else{
					if(isset($d['contentMsgDecode']['pdfUrl'])){
						//已经扫描申请过了
						$res_fapiao_date = $d['contentMsgDecode']['date'];
						$res_fapiao_no = $d['contentMsgDecode']['no'];
						$res_fapiao_code = $d['contentMsgDecode']['code'];
						$res_fapiao_pdfUrl = $d['contentMsgDecode']['pdfUrl'];
						$res_fapiao_tax = $d['contentMsgDecode']['tax'];
						$res_fapiao_amount = $d['contentMsgDecode']['amount'];
						 
						if($res_fapiao_date != '' && $res_fapiao_no != '' && $res_fapiao_no != '' && $res_fapiao_tax != '' && $res_fapiao_amount != ''){
							$arr = array();
							$arr['res_fapiao_date'] = $res_fapiao_date;
							$arr['res_fapiao_code'] = $res_fapiao_code;
							$arr['res_fapiao_no'] = $res_fapiao_no;
							$arr['res_fapiao_pdfUrl'] = $res_fapiao_pdfUrl;
							$arr['res_fapiao_tax'] = $res_fapiao_tax;
							$arr['res_fapiao_amount'] = $res_fapiao_amount;
							$arr['res_fapiao_data'] = json_encode($d);
							$this->OrderModel->edit_invoice($order_id, $arr);
							 
							return 'has_invoiced';//已经开票了
						}else{
							return 'zhengzaikaipiaozhong';//正在开票中
						}
					}else{
						return 'scaned_butunapply';//扫描了，但是还没有申请
					}
				}
			}else{
				return 'needto_loadqrcode';//需要去申请开票
			}
		}
	}
	
	function edit_invoice($order_id, $arr){
		$this->db->update(DB_PRE().'order_invoice', $arr, array('order_id'=>$order_id));
	}
	
	
	
}
