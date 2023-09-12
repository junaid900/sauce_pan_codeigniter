<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ch extends CI_Controller {
	/***** Home INDEX *********/
	public function index(){
	    
	    $data['images'] 	    = $this->db->get_where('images',array('page'=>'home'))->result_array();
	    $data['news_data'] 	    = $this->Db_model->get_all_news_by_cat(3);
	    $data['upcoming_news'] 	= $this->Db_model->get_all_news_by_cat(2);
	    $data['slider'] 	    = $this->Db_model->get_home_slider();
	    $data['department'] 	= $this->Db_model->get_department_all_detail();
	    $this->Db_model->unique_visit();
	    $data['page_title'] 	= 'Home';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'home';
		$this->load->view('home/index',$data);
	}
	/***** Home INDEX *********/

    /***** CONTACT *********/
    public function contact($param1=''){
         if($param1 =='save'){
           $saveData['name']    = $this->input->post('name');
           $saveData['email']   = $this->input->post('email');
           $saveData['phone']   = $this->input->post('phone');
           $saveData['subject'] = $this->input->post('subject');
           $saveData['message'] = $this->input->post('message');
       //    $this->db->insert('contact_queries',$saveData);
           $this->Email_model->admin_message($saveData);
           
           $this->session->set_flashdata('msg_success', 'Query Submitted to Admin Successfully.');
		   redirect(control_helper().'contact', 'refresh');
        }
        $data['images'] 	    = $this->db->get_where('images',array('page'=>'others'))->result_array();
        $data['page_title'] 	= 'Contact';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'contact';
       	$this->load->view('home/index', $data);
    }
    /***** CONTACT *********/
     /***** DEPARTMENTs *********/
    public function department($param1=''){
        if($param1=='search'){
            $data['sub_data'] 	    = $this->Db_model->get_department_list_search($_POST);
            $data['post_data']      = $_POST;
            
        }else{
            $data['post_data']      = '';
            $data['sub_data'] 	    = $this->Db_model->get_department_list();
        }
        $data['page_data'] 	    = $this->Db_model->get_cat_departments();
        
        
        $data['page_title'] 	= 'Department';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'department';
       	$this->load->view('home/index', $data);
    }
    public function department_detail($param1=''){
        
        $data['page_data'] 	    = $this->Db_model->get_department_detail($param1);
       
        if(empty($param1)){
            $this->not_found();
        }else{
            $data['page_title'] 	= $this->replace_underscore_space($param1);;
    		$data['page_sub_title'] = '';
    		$data['page_name'] 		= 'department_detail';
           	$this->load->view('home/index', $data);
        }
    }
    /***** DEPARTMENTs *********/
    /***** PORTFOLIO *********/
    public function portfolio(){
        $data['page_title'] 	= 'Portfolio';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'portfolio';
       	$this->load->view('home/index', $data);
    }
    /***** PORTFOLIO *********/
    public function loadLanguage(){
		$country = $this->input->post('country');
		$language ='';
		if($country == 'english'){
			$language ='english';
			$this->session->set_userdata('controller_name','en');
		}else if($country == 'chinese'){
			$language ='Chinese';
			$this->session->set_userdata('controller_name','ch');
		}
		
		$this->session->set_userdata('current_language',$language);
		$this->session->set_userdata('language_country',$country);
		echo $this->session->userdata('current_language');
		exit;
	}
     /***** NEWS *********/
    public function news($param1='',$param2='',$param3=''){
        if(!empty($param1) && $param2 == ''){
            $category_id = $this->db->get_where('news_category',array('title'=>$param1))->row()->news_category_id;
            $data['sub_category_data'] = $this->Db_model->get_all_news_sub_category($category_id);
            $data['sb_nav_id'] = $category_id;
            $data['tree_category_id'] = 0;
            $data['news_sub_category_id'] = 0;
            $data['param1'] = $param1;
        }else if(!empty($param1) && !empty($param2) && $param3 == ''){
             $category_id = $this->db->get_where('news_category',array('title'=>$param1))->row()->news_category_id;
             $data['sub_category_data'] = $this->Db_model->get_all_news_sub_category($category_id);
             $data['sb_nav_id'] = $category_id;
             $news_sub_category_id = $this->db->get_where('news_sub_category',array('title'=>$param2))->row()->news_sub_category_id;
            
             $data['tree_category_id'] = 0;
             $data['news_sub_category_id'] = $news_sub_category_id;
             $data['param1'] = $param1;
             $data['param2'] = $param2;
        }else if(!empty($param1) && !empty($param2) && !empty($param3)){
             $category_id = $this->db->get_where('news_category',array('title'=>$param1))->row()->news_category_id;
             $data['sub_category_data'] = $this->Db_model->get_all_news_sub_category($category_id);
             $data['sb_nav_id'] = $category_id;
             $news_sub_category_id = $this->db->get_where('news_sub_category',array('title'=>$param2))->row()->news_sub_category_id;
             $data['tree_category_id'] = $this->db->get_where('news_sub_tree_category',array('title'=>$param3))->row()->news_sub_tree_category_id;
             $data['news_sub_category_id'] = $news_sub_category_id;
             $data['param1'] = $param1;
             $data['param2'] = $param2;
             $data['param3'] = $param3;
            
        }else{
            $data['sb_nav_id'] = 0;
            $data['tree_category_id'] = 0;
        }
        $data['images'] 	    = $this->db->get_where('images',array('page'=>'others'))->result_array();
        $data['page_title'] 	= 'News';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'news';
       	$this->load->view('home/index', $data);
    }
    /***** NEWS *********/
    /***** CAMPUS LIFE *********/
    public function campus_life(){
        $data['images'] 	    = $this->db->get_where('images',array('page'=>'others'))->result_array();
        $data['page_data'] 	    = $this->Db_model->get_all_campus_info();
        $data['page_title'] 	= 'Campus Life';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'campus_life';
       	$this->load->view('home/index', $data);
    }
    public function campus_detail($param1=''){
        if(empty($param1)){
            $this->not_found();
        }else{
            $campus_info            = $this->Db_model->get_all_campus_info_detail($param1);
            $data['page_data'] 	    = $campus_info;
            $data['meta_image'] 	= base_url().'uploads/campuslife/'.$campus_info['image'];
            $data['page_title'] 	= $this->replace_underscore_space($param1);;
    		$data['page_sub_title'] = '';
    		$data['page_name'] 		= 'campus_detail';
           	$this->load->view('home/index', $data);
        }
    }
    /***** CAMPUS LIFE *********/
    /***** SEARCH KEYWORDS *********/
    public function search_keywords(){
        if(isset($_POST['search'])){
            $search = $_POST['search'];
            $datas = $this->db->query("SELECT * FROM keywords WHERE en_title like'%".$search."%'")->result_array();
            foreach($datas as $row){
                $response[] = array("value"=>$row['keywords_id'],"label"=>$row['en_title']);
            }
        
            echo json_encode($response);
            exit;
        }
    }
    /***** SEARCH KEYWORDS *********/
    
    /***** Category *********/
    public function category($param1='',$param2=''){
        if(empty($param1) || empty($param1)){
            $this->not_found();
        }else{
            $data['images'] 	    = $this->db->get_where('images',array('page'=>'others'))->result_array();
            $data['param2'] 	    = $param2;
            $category_id            = $this->db->get_where('category',array('title'=>$param1))->row()->category_id;
            $data['parent_category_id']= $category_id;
            $data['labels'] 	    = $this->Db_model->get_all_sub_category($category_id);
            $data['page_title'] 	= $this->replace_underscore_space($param1);
            $data['param1'] 	    = $param1;
    		$data['page_sub_title'] = '';
    		$data['page_name'] 		= 'category';
           	$this->load->view('home/index', $data);
        }
    }
    /***** Prospective *********/
     /***** NEWS DETAIl*********/
    public function news_detail($param1=''){
        if(empty($param1)){
            $this->not_found();
        }else{
            $all_news               = $this->Db_model->get_all_news_detail($param1);
            $data['page_data'] 	    = $all_news;
            $data['page_title'] 	= $this->replace_underscore_space($param1);
            $data['meta_image']     = base_url().'uploads/news/'.$all_news['image'];
    		$data['page_sub_title'] = '';
    		$data['page_name'] 		= 'news_detail';
           	$this->load->view('home/index', $data);
        }
    }
    /***** NEWS DETAIl*********/
    /***** Login*********/
    public function login(){
        $data['page_title'] 	= 'Login';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'login';
       	$this->load->view('home/index', $data);
    }
    /***** Login*********/
    /***** Signup *********/
    public function signup(){
        $data['page_title'] 	= 'Signup';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'signup';
       	$this->load->view('home/index', $data);
    }
    /***** Signup*********/
     /***** faqs *********/
    public function faqs(){
        $data['page_title'] 	= 'faqs';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'faqs';
       	$this->load->view('home/index', $data);
    }
    /***** Signup*********/
    /***** notice *********/
    public function notice(){
        
        $data['page_data'] 	    = $this->Db_model->get_all_notices();
        $data['page_title'] 	= 'notice';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'notice';
       	$this->load->view('home/index', $data);
    }
    /***** notice*********/
    /***** visitus********/
    public function visitus(){
        $data['gallery'] 	    = $this->db->get_where('gallery',array('status'=>'Active'))->result_array();
        $data['page_title'] 	= 'visitus';
		$data['page_sub_title'] = '';
		$data['page_name'] 		= 'visitus';
       	$this->load->view('home/index', $data);
    }
    /***** visitus********/
    /***** news letter ********/
    function news_letter(){
        $saveData['email']      = $this->input->post('email');
        $saveData['date_added'] = date('Y-m-d h:i:s');
        $this->db->insert('news_letter',$saveData);
        $this->session->set_flashdata('msg_success', 'Email Submitted to Admin Successfully.');
		redirect(control_helper(), 'refresh');
    }
    /***** news letter ********/
    function not_found(){
            $data['page_title'] 	= 'Not Found';
    		$data['page_sub_title'] = '';
    		$data['page_name'] 		= 'not_found';
            $this->load->view('home/index', $data);
    }
    function search(){
            if(!empty($_POST['title'])){
               $data['search_results'] 	= $this->Db_model->seach_results($_POST['title']);
               $data['search_title'] 	= $_POST['title'];
            }
            $data['page_title'] 	= 'Search';
    		$data['page_sub_title'] = '';
    		$data['page_name'] 		= 'search';
            $this->load->view('home/index', $data);
    }
    function replace_underscore_space($state=''){
        $state = str_replace("_"," ",$state);
        $state = ucwords($state);
        return $state;
    }
}