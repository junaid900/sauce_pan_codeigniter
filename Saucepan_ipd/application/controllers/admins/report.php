<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller{
	function __construct(){
		parent::__construct();
	
		if(isset($_COOKIE[DB_PRE().'admininfo'])){
			$admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
			$this->admin_id = $admininfo['admin_id'];
			$this->admin_username = $admininfo['admin_username'];
		}else{
			$this->admin_id = 0;
			$this->admin_username = '';
			
			redirect('admin/index');
		}
		$lang = $this->session->userdata('lang');
		if($lang == 'ch'){
		    $this->session->set_userdata('lang','ch');
		    $this->langtype='_ch';
		    $this->lang->load('gksel','chinese');
		}else{
		    $this->session->set_userdata('lang','en');
		    $this->langtype='_en';
		    $this->lang->load('gksel','english');
		}
	}
	
	//
	function index(){
		
	}
	
	//kitchen report ----- total
	function totalkitchen(){
		$this->session->set_userdata('menu', 'report_kitchen_total');
	
		$select_date = $this->input->get('select_date');
		$islive = $this->input->get('islive');
		
		$where = "";
		if($select_date != ''){
			$where .= " AND date_show = '".$select_date."' ";
		}
		if($islive == 1){
			$where .= " AND date_int >= ".strtotime(date('Y-m-d').' 00:00:00');
		}else{
			$where .= " AND date_int < ".strtotime(date('Y-m-d').' 00:00:00');
		}
		$sql = "
			SELECT DISTINCT(date_show)
		
			FROM ".DB_PRE()."order_day
		
			WHERE action_status = 0
						
			$where
						
			ORDER BY date_int ASC
		";
		$grouplist = $this->db->query($sql)->result_array();
		if(!empty($grouplist)){
			$data['grouplist'] = $grouplist;
		}else{
			$data['grouplist'] = null;
		}
		
	
		$this->load->view('admin/report_kitchen_list_total', $data);
	}
	
	
	//delivery report ----- total
	function totaldelivery(){
		$this->session->set_userdata('menu', 'report_delivery_total');
	
		$select_date = $this->input->get('select_date');
		$islive = $this->input->get('islive');
	
		$where = "";
		if($select_date != ''){
			$where .= " AND date_show = '".$select_date."' ";
		}
		if($islive == 1){
			$where .= " AND date_int >= ".strtotime(date('Y-m-d').' 00:00:00');
		}else{
			$where .= " AND date_int < ".strtotime(date('Y-m-d').' 00:00:00');
		}
		$sql = "
			SELECT DISTINCT(date_show)
	
			FROM ".DB_PRE()."order_day
	
				WHERE action_status = 0
	
				$where
	
				ORDER BY date_int ASC
				";
		$grouplist = $this->db->query($sql)->result_array();
		if(!empty($grouplist)){
			$data['grouplist'] = $grouplist;
		}else{
			$data['grouplist'] = null;
		}
	
		$this->load->view('admin/report_delivery_list_total', $data);
	}
	
	//daily summary
	function daily_summary(){
		$this->session->set_userdata('menu', 'daily_summary');
	
		$select_date = $this->input->get('select_date');
		$islive = $this->input->get('islive');
	
		$where = "";
		if($select_date != ''){
			$where .= " AND date_show = '".$select_date."' ";
		}
		if($islive == 1){
			$where .= " AND date_int >= ".strtotime(date('Y-m-d').' 00:00:00');
		}else{
			$where .= " AND date_int < ".strtotime(date('Y-m-d').' 00:00:00');
		}
		$sql = "
			SELECT DISTINCT(date_show)
	
			FROM ".DB_PRE()."order_day
	
				WHERE action_status = 0
	
				$where
	
				ORDER BY date_int ASC
				";
		$grouplist = $this->db->query($sql)->result_array();
		if(!empty($grouplist)){
			$data['grouplist'] = $grouplist;
		}else{
			$data['grouplist'] = null;
		}
		
		$this->load->view('admin/report_daily_summary', $data);
	}
	

	//daily_manager_report
	function daily_manager_report(){
		$this->session->set_userdata('menu', 'daily_manager_report');
	
		$select_date = $this->input->get('select_date');
		$islive = $this->input->get('islive');
	
		$where = "";
		if($select_date != ''){
			$where .= " AND date_show = '".$select_date."' ";
		}
		if($islive == 1){
			$where .= " AND date_int >= ".strtotime(date('Y-m-d').' 00:00:00');
		}else{
			$where .= " AND date_int < ".strtotime(date('Y-m-d').' 00:00:00');
		}
		$sql = "
			SELECT DISTINCT(date_show)
	
			FROM ".DB_PRE()."order_day
	
				WHERE action_status = 0
	
				$where
	
				ORDER BY date_int ASC
				";
		$grouplist = $this->db->query($sql)->result_array();
		if(!empty($grouplist)){
			$data['grouplist'] = $grouplist;
		}else{
			$data['grouplist'] = null;
		}
		
		$this->load->view('admin/report_daily_manager_report', $data);
	}
	
	
	
}
