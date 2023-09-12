<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->session->set_userdata('menu','feedback');
		if(isset($_COOKIE[DB_PRE().'admininfo'])){
			$admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
			$this->admin_id = $admininfo['admin_id'];
			$this->admin_username = $admininfo['admin_username'];
		}else{
			$this->admin_id = 0;
			$this->admin_username = '';
			
			redirect('admin/index');
		}
		$this->session->set_userdata('lang','en');
		$this->langtype='_en';
		$this->lang->load('gksel','english');
	}
	
	function index(){
		$row=$this->input->get('row');
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$keyword = $this->input->get('keyword');
		$con = array('parent'=>0, 'orderby'=>'a.feedback_id', 'orderby_res'=>'DESC', 'row'=>$row, 'page'=>$data['page']);
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		$data['feedbacklist']=$this->FeedbackModel->getfeedbacklist($con);
		$data['count']=$this->FeedbackModel->getfeedbacklist($con,1);
		$url = base_url().'index.php/admins/feedback/index?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$this->load->view('admin/feedback_list',$data);
	}
	
	//回复意见反馈
	function toreply_feedback($feedback_id){
		$arr = array('isread'=>1);
		$this->FeedbackModel->edit_feedback($feedback_id, $arr);
		
		
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/feedback/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/feedback/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_feedback_manage').'</a> &gt; 回复';
		
		$data['feedbackinfo']=$this->FeedbackModel->getfeedbackinfo($feedback_id);
		$this->load->view('admin/feedback_reply',$data);
	}
	//回复意见反馈 ------- 处理方法
	function reply_feedback($feedback_id){
		$feedback_content = $this->input->post('feedback_content');
		
		$this->FeedbackModel->edit_feedback($feedback_id, array('isreply'=>1));
		
		$arr = array('parent'=>$feedback_id, 'isreply'=>1, 'created'=>time(), 'edited'=>time());
		$arr['feedback_content'] = $feedback_content;
		$this->FeedbackModel->add_feedback($arr);
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/feedback/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/feedback/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除商品
	function del_feedback($feedback_id){
		$this->FeedbackModel->del_feedback($feedback_id);
	}
	
	
}