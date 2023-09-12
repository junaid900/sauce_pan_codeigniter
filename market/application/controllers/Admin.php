<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $userData = ["directory" => "madmin"];
        $this->session->set_userdata($userData);
    }

    /***** ADMIN INDEX *********/
    public function index()
    {


        if ($this->session->userdata('login') == 1) {
            redirect(base_url() . 'admin' . '/dashboard', 'refresh');
        }
//        echo "here";
//        exit();
        $this->load->view('madmin/login');
    }
    /***** ADMIN INDEX *********/
    /* VERIFY ACCOUNT */
    public function login()
    {
        
        // Validate the user can login
        $result = $this->Db_model->login_varify_accounts();

        /*	if($result =='blocked'){
                $this->session->set_flashdata('msg_error', 'Due to many unsuccessful times, your account is now locked. Please try again 2hours later.');
                redirect(base_url().'admin', 'refresh');
                l
            }else if($result =='permanent_blocked'){

                $this->session->set_flashdata('msg_error', 'Please contact the administrator to unlock your account. Please check your email for contact information');
                redirect(base_url().'admin', 'refresh');
            }*/

        // Now we verify the result
        if ($result) {
            if ($result->status == 'Inactive') {
//                echo "here";
//                exit();
                $this->session->set_flashdata('msg_error', 'your account is Inactive!');
                redirect(base_url() . 'admin', 'refresh');
            }
            /* $check_login_status = $this->db->get_where('user_login',array('user_accounts_id'=>$result->user_accounts_id));
             if($check_login_status->num_rows()>0){
                 //$_SERVER['REMOTE_ADDR'] == $check_login_status->row()->user_ip &&
                 if($check_login_status->row()->status == 'Active'){
                    $this->session->set_flashdata('msg_error', 'your account is already login from other device!');
                    redirect(base_url().'admin', 'refresh');
                 }else{
                     $s_update['status']  = 'Inactive';
                     $this->db->where('user_accounts_id',$result->user_accounts_id);
                     $this->db->update('user_login',$s_update);
                 }
             }
             $loginData['user_accounts_id'] = $result->user_accounts_id;
             $loginData['user_ip']          = $_SERVER['REMOTE_ADDR'];
             $loginData['date_added']       = date('Y-m-d h:i:s');
             $loginData['status']           = 'Active';
             $this->db->insert('user_login', $loginData);*/
            $this->session->set_userdata('user_name', $result->first_name);
            $this->session->set_userdata('users_id', $result->users_system_id);
            $this->session->set_userdata('users_email', $result->email);
            $this->session->set_userdata('user_roles_id', $result->users_roles_id);
            $this->session->set_userdata('directory', 'madmin');
            $this->session->set_userdata('login', 1);
            $this->session->set_flashdata('msg_success', 'Login Successfully.');
            redirect(base_url() . 'admin/dashboard', 'refresh');
        } else {
//            echo "reror";
//            exit();
            // If user did validate,
            $this->session->set_flashdata('msg_error', 'Email or password not correct!');
            redirect(base_url() . 'admin', 'refresh');
        }
    }


    public function forgot_password()
    {
        $this->load->view('admin/forgot_password');
    }

    public function CheckEmail($param1 = '', $param2 = '')
    {
        $email = $this->input->post('email');
        $db_val = $this->db->get_where('user_accounts', array('email' => $email))->num_rows();
        if ($db_val > 0) {
            echo 'email already exist';
        } else {
            echo 'notexist';
        }
        exit;
    }

    public function retrieve_password($param1 = '', $param2 = '')
    {
        $user_email = $this->input->post('retrive_email');
        $response = $this->Db_model->retrieve_password($user_email);
        if ($response == 'Mail Sent') {
            $this->session->set_flashdata('msg_success', ' Password Reset Link Sent To Your Email Successfully');
        } else if ($response == 'Mail Not Sent') {
            $this->session->set_flashdata('msg_error', ' Error In Sending Mail. Try Again.');
        } else if ($response == 'Email Not Found') {
            $this->session->set_flashdata('msg_error', ' Email Not Found, Please Check Your Email');
        }
        $this->load->view('admin/login');
    }

    /***** APPROVAL REGISTER EMAIL *********/
    public function contact_email($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'contact') {
            $data['subject'] = $this->input->post('subject');
            $data['body'] = $this->input->post('body');
            $result = $this->Db_model->update_email_data('email_templates', 'contact_email', $data);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . admin_ctrl() . '/contact_email', 'refresh');

        }

        $data['request'] = $this->Db_model->get_data_row('email_templates', 'type', 'contact_email');
        $data['page_title'] = 'Contact Email';
        $data['page_sub_title'] = '';
        $data['page_name'] = 'contact_email';
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** APPROVAL REGISTER EMAIL *********/
    /***** Language *********/
    public function change_language()
    {
        $lang = $this->input->post('lang');

        if ($lang == 'english') {
            $this->session->set_userdata('current_language', 'english');
            $this->session->set_userdata('language_country', 'english');
        } else {
            $this->session->set_userdata('current_language', 'Chinese');
            $this->session->set_userdata('language_country', 'Chinese');
        }

        exit;

    }

    public function language($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['profile_data'] = $this->db->get_where('users_system', array('users_system_id' => '1'))->row();
        $data['page_title'] = get_phrase('manage_language');
        $data['page_sub_title'] = 'Manage Language';
        $data['page_name'] = 'manage_language';
        $data['actor'] = 'manage_language';
        $data['main_page_name'] = 'manage_language';
        $data["htmlPage"] = "manage_language";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    public function edit_language($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'edit') {
            $phrase_id = $this->input->post('phrase_id');
            $lang = $this->input->post('lang');
            $data[$lang] = $this->input->post('phrase_value');
            //$this->db->where('Spainish',$this->input->post('phrase_value'));
            $this->db->where('phrase_id', $phrase_id);
            $result = $this->db->update('language', $data);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }

        $data['profile_data'] = $this->db->get_where('users_system', array('users_system_id' => '1'))->row();
        $data['param1'] = $param1;
        $data['page_title'] = get_phrase('edit_language');
        $data['page_sub_title'] = 'Edit Language';
        $data['page_name'] = 'edit_language';
        $data['actor'] = 'edit_language';
        $data['main_page_name'] = 'edit_language';
        $data["htmlPage"] = "edit_language";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** Language *********/

    /***** DASBOARD *********/
    public function dashboard()
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }

        $date = '';
        $cdate = date('Y-m-d');
        $prevDay = $cdate;
        $prevMonth = strtotime("-30 day", strtotime($cdate));
        $response2 = json_decode(json_encode([]), false);

        $response2 = $this->db->query("select sum(order_sub_total) as sub_total,sum(grand_total) as grand_total, sum(attributes_cost) as attr_cost,sum(discount) as discount , sum(order_fee) as order_fee , sum(order_cost) as distance_cost ,avg(grand_total) as avg_grand_total from `order` where created_at > '" . $prevDay . " 00:00:00" . "' And created_at <= '" . date('Y-m-d h:i:s') . "' order by created_at ASC")->first_row();
        $response2Mon = $this->db->query("select sum(order_sub_total) as sub_total,sum(grand_total) as grand_total,sum(discount) as discount, sum(attributes_cost) as attr_cost , sum(order_fee) as order_fee , sum(order_cost) as distance_cost, avg(grand_total) as avg_grand_total from `order` where created_at > '" . $prevMonth . " 00:00:00" . "' And created_at <= '" . date('Y-m-d h:i:s') . "' order by created_at ASC")->first_row();
        if (empty($response2)) {
            $response2->sub_total = 0;
            $response2->grand_total = 0;
            $response2->attr_cost = 0;
            $response2->order_fee = 0;
            $response2->distance_cost = 0;
            $response2->avg_grand_total = 0;
            $response2Mon->sub_total = 0;
            $response2Mon->grand_total = 0;
            $response2Mon->attr_cost = 0;
            $response2Mon->order_fee = 0;
            $response2Mon->distance_cost = 0;
            $response2Mon->avg_grand_total = 0;
        }
        $response = $this->db->query("select * from `order`  where created_at > '" . $prevMonth . " 00:00:00" . "' And created_at <= '" . date('Y-m-d h:i:s') . "' order by created_at ASC")->result();
//        echo $this->db->last_query();
//        print_r($response);
        $orderIds = [];
        foreach ($response as $order) {
            $orderIds[] = $order->order_id;
        }
        $in = implode(",", $orderIds);
        $productResponse = [];
        $categoryResponse = [];
        if (!empty($in)) {
            $productResponse = $this->db->query("select p.*,op.price as price ,sum(op.qty) qty,sum(op.total) as total  from order_products op left join product p on op.product_id = p.product_id left join category c on p.category_id = c.category_id Where op.order_id IN ($in)  group by p.product_id order by qty DESC")->result();
            $categoryResponse = $this->db->query("select c.*,avg(op.price) as price ,sum(op.qty) qty,sum(op.total) as total  from order_products op left join product p on op.product_id = p.product_id left join category c on p.category_id = c.category_id Where op.order_id IN ($in)  group by p.category_id order by qty DESC")->result();
        }
        $productSum = 0;
        $categorySum = 0;
        foreach ($productResponse as $pr) {
            $productSum += $pr->qty;
        }
        foreach ($categoryResponse as $cr) {
            $categorySum += $cr->qty;
        }

        $data['actor'] = 'dashboard';
        $data['main_page_name'] = 'dashboard';
        $data["htmlPage"] = "dashboard";
        $data['page_title'] = 'dashboard';
        $data['page_sub_title'] = 'dashboard';
        $data['page_name'] = 'dashboard';
        $data['totals'] = $response2;
        $data['totalsMon'] = $response2Mon;
        $data['products'] = $productResponse;
        $data['categories'] = $categoryResponse;
        $data['product_sum'] = $productSum;
        $data['category_sum'] = $categorySum;
        $data['orders'] = $response;

        $this->load->view(strtolower($this->session->userdata('directory')) . '/dashboard', $data);
    }
    /***** DASBOARD *********/
    /***** REVENUE REPORT *********/
    // update_order_payment_status
    public function update_order_payment_status(){
        $id = $_POST['id'];
        $status = $_POST['status'];
        $res = $this->db->update("order",["payment_status"=>$status],["order_id"=>$id]);
        if($res){
            echo json_encode(["status"=>1,"message"=>"success"]);
        }else{
            echo json_encode(["status"=>0,"message"=>"failed"]);
        }
    }
    public function revenue_report($type = "product", $day = "today")
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['actor'] = 'revenue_report';
        $data['main_page_name'] = 'revenue_report';
        $data["htmlPage"] = "revenue_report";
        $data['page_title'] = 'revenue_report';
        $data['page_sub_title'] = 'revenue_report';
        $data['page_name'] = 'revenue_report';
        $date = '';
        $cdate = date('Y-m-d');
        $edate = date('Y-m-d') . " 23:59:59";
        if ($day == "week") {
            $date = strtotime("-7 day", strtotime($cdate));
        } else if ($day == "month") {
            $date = strtotime("-30 day", strtotime($cdate));
        } else if ($day == "date") {
            $startdate = $_REQUEST['start'];
            $enddate = $_REQUEST['end'];
            $date = strtotime($startdate);
            $edate = date('Y-m-d', strtotime($enddate)) . " 23:59:59";
        }
        if ($date != '') {
            $date = date('Y-m-d', $date);
        } else {
            $date = date('Y-m-d');
        }

        $response2 = $this->db->query("select sum(order_sub_total) as sub_total,sum(grand_total) as grand_total, sum(attributes_cost) as attr_cost , sum(order_fee) as order_fee , sum(order_cost) as distance_cost from `order` o where (order_status = 'Completed' or order_status = 'Refund' or (order_status != 'Cancel' and payment_status = 'Paid' )) And  o.created_at > '" . $date . " 00:00:00" . "' And o.created_at <= '" . $edate . "' order by created_at ASC")->first_row();
        $response = $this->db->query("select * from `order` o where (order_status = 'Completed' or order_status = 'Refund' or (order_status != 'Cancel' && payment_status = 'Paid' )) and created_at > '" . $date . " 00:00:00" . "' And created_at <= '" . $edate . "' order by o.created_at ASC")->result();
        $monthly_payment_response = $this->db->query("select * from `order` o where payment_method = 'Monthly_Payment' and created_at > '" . $date . " 00:00:00" . "' And created_at <= '" . $edate . "' order by o.created_at ASC")->result();
        
        // echo $this->db->last_query();
        // print_r($response);
        $orderIds = [];
        foreach ($response as $order) {
            $orderIds[] = $order->order_id;
        }
        $in = implode(",", $orderIds);
        $productResponse = [];
        $categoryTypeResponse = [];
        $attTotals = [];
        $data["refunds"] = 0;
        $data["num_of_refunds"] = 0;
        $data["refund_amount"] = 0;
        $monthly_payment = 0;
        if (!empty($in)) {
            $categoryTypeResponse = $this->db->query("select c.*,avg(op.price) as price ,sum(op.qty) qty, sum(op.total) as total
            from order_products op left join product p on op.product_id = p.product_id 
            left join category c on p.category_id = c.category_id
            Where op.order_id IN ($in) group by c.category_type")->result();
            $attrTypeQuery = "select sum(at_price) as at_price, c.* from order_product_attributes opa left join product opp on opp.product_id = opa.product_id
            left join category c on c.category_id = opp.category_id
            where opa.order_id IN ($in) group by c.category_type";
            $attrTypeResponse = $this->db->query($attrTypeQuery)->result();
            $attTotals = [];
            foreach($attrTypeResponse as $attr){
                $attTotals[$attr->category_type] = $attr->at_price;
            }
            // print_r($attTotals);
            
            // echo $this->db->last_query();
            
            // $productResponse = $this->db->query("select p.*,op.price as price ,sum(op.qty) qty,sum(op.total) as total  from order_products op left join product p on op.product_id = p.product_id left join category c on p.category_id = c.category_id Where op.order_id IN ($in)  group by p.product_id")->result();
            if ($type == "category") {
                $productResponse = $this->db->query("select c.*,avg(op.price) as price ,sum(op.qty) qty, sum(op.total) as total from order_products op left join product p on op.product_id = p.product_id left join category c on p.category_id = c.category_id Where op.order_id IN ($in) group by p.category_id")->result();
            } else if ($type == "product") {
                $productResponse = $this->db->query("select p.*,op.price as price ,sum(op.qty) qty,sum(op.total) as total  from order_products op left join product p on op.product_id = p.product_id left join category c on p.category_id = c.category_id Where op.order_id IN ($in)  group by p.product_id")->result();

            } else if ($type == "payment") {
//                refund_sp_points

                $productResponse = $this->db->query("select o.*,sum(o.grand_total) as total , count(o.order_id) as num_orders from `order` o Where o.order_id IN ($in)  group by o.payment_method")->result();
                $ppResponse = [];
                $methods = ["Cash","WeChat_Pay","ImDada","In-House","Shansong","Walk-Ins","Sherpas","JSS","Ele.Me","Manual","Wuzhong"];
                $sendByArr = [];
                $sendByResponse = $this->db->query("select count(o.order_id) as num_order,o.send_by from `order` o Where o.order_id IN ($in)  group by o.send_by")->result();
                foreach($sendByResponse as $sendRes){
                    $sendByArr[$sendRes->send_by] = $sendRes->num_order;
                }
                
                foreach ($methods as $method){
                    $found = false;
                    $sendByVal = 0;
                     if(isset($sendByArr[$method])){
                         $sendByVal = $sendByArr[$method];
                     }
                    foreach ($productResponse as $p){
                       
                        if($p->payment_method == $method){
                            $p->num_orders+= $sendByVal;
                            $ppResponse[] = $p;
                            $found = true;
                            break;
                        } 
                        if($p->payment_method == "Monthly_Payment"){
                            $monthly_payment = $p->total;
                        }
                        
                    }
                    if(!$found){
                        $obj = json_decode(json_encode(["payment_method"=>""]),false);
                        $obj->payment_method = $method;
                        $obj->total = 0;
                        $obj->num_orders = 0+$sendByVal;
                        $ppResponse[] = $obj;
                    }
                }
                $productResponse = $ppResponse;
            }
        }
//        refund_sp_points
        $respRefund = $this->db->query("select sum(refund_sp_points) as refunds, count(order_id) as num_of_refunds from `order` o where created_at > '" . $date . " 00:00:00" . "' And created_at <= '" . $edate . "' and order_status = 'Refund' order by o.created_at ASC")->first_row();
//        echo $this->db->last_query();
//        print_r($respRefund);
        if($respRefund) {
            $data["refunds"] = $respRefund->refunds;
            $data["num_of_refunds"] = $respRefund->num_of_refunds;
            $data["refund_amount"] = $respRefund->refunds / 100;
        }
        $data["totals"] = $response2;
        $data["orders"] = $response;
        $data["products"] = $productResponse;
        $data['category_type'] = $categoryTypeResponse;
        $data['att_totals'] = $attTotals;
        $data["day"] = $day;
        $data["type"] = $type;
        $data["monthly_payment"] = $monthly_payment;
        $data["monthly_payment_data"] = $monthly_payment_response;
        // echo "<pre>";
        // print_r($data["monthly_payment_data"]);
        $this->load->view(strtolower($this->session->userdata('directory')) . '/revenue_report', $data);
    }

    public function cashier_report($type = "product", $day = "today")
    {
         if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['actor'] = 'cashier_report';
        $data['main_page_name'] = 'cashier_report';
        $data["htmlPage"] = "cashier_report";
        $data['page_title'] = 'cashier_report';
        $data['page_sub_title'] = 'cashier_report';
        $data['page_name'] = 'cashier_report';
        $date = '';
        $cdate = date('Y-m-d');
        $edate = date('Y-m-d') . " 23:59:59";
        if ($day == "week") {
            $date = strtotime("-7 day", strtotime($cdate));
        } else if ($day == "month") {
            $date = strtotime("-30 day", strtotime($cdate));
        } else if ($day == "date") {
            $startdate = $_REQUEST['start'];
            $enddate = $_REQUEST['end'];
            $date = strtotime($startdate);
            $edate = date('Y-m-d', strtotime($enddate)) . " 23:59:59";
        }
        if ($date != '') {
            $date = date('Y-m-d', $date);
        } else {
            $date = date('Y-m-d');
        }

        $response2 = $this->db->query("select sum(mass_discount) as mass_discount,sum(discount) as discount from `order` where (order_status = 'Completed' or order_status = 'Refund' or (order_status != 'Cancel' and payment_status = 'Paid' )) And  created_at > '" . $date . " 00:00:00" . "' And created_at <= '" . $edate . "' order by created_at ASC")->first_row();
        $response = $this->db->query("select o.*,c.*,count(order_id) as order_no,sum(grand_total) as gtotal,sum(discount) as discount from `order` o inner join coupons c on o.coupon_id = c.coupons_id  where (order_status = 'Completed' or order_status = 'Refund' or (order_status != 'Cancel' and payment_status = 'Paid' )) and o.created_at > '" . $date . " 00:00:00" . "' And o.created_at <= '" . $edate . "' group by o.coupon_id order by o.created_at ASC")->result();
//        echo $this->db->last_query();

        // echo $this->db->last_query();
//        echo $this->db->last_query();
        // print_r($response);
        // exit();
        $orderIds = [];
        foreach ($response as $order) {
            $orderIds[] = $order->order_id;
        }
        $in = implode(",", $orderIds);
        $productResponse = [];
        if (!empty($in)) {
            // $productResponse = $this->db->query("select p.*,op.price as price ,sum(op.qty) qty,sum(op.total) as total  from order_products op left join product p on op.product_id = p.product_id left join category c on p.category_id = c.category_id Where op.order_id IN ($in)  group by p.product_id")->result();
            if ($type == "category") {
                $productResponse = $this->db->query("select c.*,avg(op.price) as price ,sum(op.qty) qty, sum(op.total) as total from order_products op left join product p on op.product_id = p.product_id left join category c on p.category_id = c.category_id Where op.order_id IN ($in) group by p.category_id")->result();
            } else if ($type == "product") {
                $productResponse = $this->db->query("select p.*,op.price as price ,sum(op.qty) qty,sum(op.total) as total  from order_products op left join product p on op.product_id = p.product_id left join category c on p.category_id = c.category_id Where op.order_id IN ($in)  group by p.product_id")->result();

            } else if ($type == "payment") {
                $productResponse = $this->db->query("select o.*,sum(o.grand_total) as total , count(o.order_id) as num_orders from `order` o Where o.order_id IN ($in)  group by o.payment_method")->result();
                $ppResponse = [];
                $methods = ["Cash","WeChat_Pay","ImDada","In-House","Shansong","Walk-Ins","Sherpas","JSS","Ele.Me"];
                foreach ($methods as $method){
                    $found = false;
                    foreach ($productResponse as $p){
                        if($p->payment_method == $method){
                            $ppResponse[] = $p;
                            $found = true;
                            break;
                        }
                    }
                    if(!$found){
                        $obj = json_decode(json_encode(["payment_method"=>""]),false);
                        $obj->payment_method = $method;
                        $obj->total = 0;
                        $obj->num_orders = 0;
                        $ppResponse[] = $obj;
                    }
                }
                $productResponse = $ppResponse;
            }
        }
        $data["totals"] = $response2;
        $data["orders"] = $response;
        $data["products"] = $productResponse;
        $data["day"] = $day;
        $data["type"] = $type;
        $this->load->view(strtolower($this->session->userdata('directory')) . '/cashier_report', $data);
    }
    /***** REVENUE REPORT *********/
    /***** DETAIL REPORT *********/
    public function detail_report($type = "product", $day = "today")
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['actor'] = 'detail_report';
        $data['main_page_name'] = 'detail_report';
        $data["htmlPage"] = "detail_report";
        $data['page_title'] = 'detail_report';
        $data['page_sub_title'] = 'detail_report';
        $data['page_name'] = 'detail_report';
        $report_by = "day";
//        $date = date('Y-m-d');
        $date = '';
        $cdate = date('Y-m-d');
        if ($day == "week") {
            $date = strtotime("-7 day", strtotime($cdate));
        } else if ($day == "month") {
            $date = strtotime("-30 day", strtotime($cdate));
        }
        if ($date != '') {
            $date = date('Y-m-d', $date);
        } else {
            $date = date('Y-m-d');
        }

        $response = $this->db->query("select * from `order` where created_at > '" . $date . " 00:00:00" . "' And created_at <= '" . date('Y-m-d h:i:s') . "' order by created_at ASC")->result();
//        echo $this->db->last_query();
        $orderIds = [];
        foreach ($response as $order) {
            $orderIds[] = $order->order_id;
        }
        $in = implode(",", $orderIds);
        $productResponse = [];
        if (!empty($in)) {
            if ($type == "category") {
                $productResponse = $this->db->query("select c.*,avg(op.price) as price ,sum(op.qty) qty, sum(op.total) as total from order_products op left join product p on op.product_id = p.product_id left join category c on p.category_id = c.category_id Where op.order_id IN ($in) group by p.category_id")->result();
            } else if ($type == "product") {
                $productResponse = $this->db->query("select p.*,op.price as price ,sum(op.qty) qty,sum(op.total) as total  from order_products op left join product p on op.product_id = p.product_id left join category c on p.category_id = c.category_id Where op.order_id IN ($in)  group by p.product_id")->result();

            }
        }
//        echo $this->db->last_query();
//        print_r($productResponse);
        $data["orders"] = $response;
        $data["products"] = $productResponse;
        $data["type"] = $type;
        $data["day"] = $day;

        $this->load->view(strtolower($this->session->userdata('directory')) . '/detail_report', $data);
    }
    /***** DETAIL REPORT *********/

    /**** customer list *****/
    public function customer_list($param1 = '', $param2 = '')
    {
        if($param1 != 'order')
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
         if ($param2 == "get_ajax") { 
            $draw = $_POST['draw'];
            $row = $_POST['start'];
            $rowperpage = $_POST['length']; // Rows display per page
            $columnIndex = $_POST['order'][0]['column']; // Column index
            $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
            if ($columnName == "name") {
                $columnName = "first_name";
            }
            $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
            $searchValue = $_POST['search']['value']; // Search value

            ## Search 
            $searchQuery = " ";
            if ($searchValue != '') {
                $searchQuery = " and (first_name like '%" . $searchValue . "%' or last_name like '%" . $searchValue . "%' or 
                    email like '%" . $searchValue . "%' ) ";
            }
            $totalRecords = $this->db->count_all("users_system");
            
            $twoMonthDate = date("Y-m-d h:i:s", strtotime(" -2 months"));
            $today = date('Y-m-d h:i:s');
            
            // $res = $this->db->query("Select count(users_system_id) as c FROM (select a.*"
            // ." from users_system as a "
            // ." WHERE 1 " . " $searchQuery "   . " "   . ") x where x.count = 0")->first_row();
            // echo $this->db->last_query();
            $totalRecordwithFilter = null;
            
            $query = "Select * FROM (select a.*, (select count(order_id) from `order` where users_system_id = a.users_system_id and created_at >= '$twoMonthDate') as count,"
            ." (select created_at from `order` where users_system_id = a.users_system_id order by created_at desc limit 1) as last_order_date from users_system as a "
            ." WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . ") x where x.count = 0 " . " limit " . $row . "," . $rowperpage;
            // echo $query;
            $users = $this->db->query($query)->result();
            $tabledata = [];
            foreach ($users as $user) {
                $data = [];
                $data["users_system_id"] = $user->users_system_id;
                $data["name"] = $user->first_name . " " . $user->last_name;
                // $data["sp_points"] = $user->count;
                $data["phone"] = $user->mobile;
                $data["email"] = $user->email;
                $data["date"] = empty($user->last_order_date)? 'no order': $user->last_order_date;
                $status = '';
                // $data["status"] = $twoMonthDate;
                $action = "<a href='" . base_url() . "admin/edit_user/" . $user->users_system_id . "'>
                                            <i class='fa fa-pencil'></i>
                                        </a>";
                $d["user"] = ["users_system_id" => $user->users_system_id];
                $d["count"] = $user->users_system_id;
                // $data["action"] = '';
                $tabledata[] = $data;
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $tabledata
            );

            echo json_encode($response);
            exit();
        }
        if ($param1 == "get_ajax") {
            $draw = $_POST['draw'];
            $row = $_POST['start'];
            $rowperpage = $_POST['length']; // Rows display per page
            $columnIndex = $_POST['order'][0]['column']; // Column index
            $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
            if ($columnName == "name") {
                $columnName = "first_name";
            }
            $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
            $searchValue = $_POST['search']['value']; // Search value

            ## Search 
            $searchQuery = " ";
            if ($searchValue != '') {
                $searchQuery = " and (first_name like '%" . $searchValue . "%' or last_name like '%" . $searchValue . "%' or 
                    email like '%" . $searchValue . "%' or sp_points like '%" . $searchValue . "%' or 
                    mobile like'%" . $searchValue . "%' ) ";
            }
            $totalRecords = $this->db->count_all("users_system");
            $res = $this->db->query("select count(users_system_id) as c from users_system where users_system_id != '-1' $searchQuery")->first_row();
            // echo $this->db->last_query();
            $totalRecordwithFilter = $res->c;
            $query = "select * from users_system WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
            // echo $query;
            $users = $this->db->query($query)->result();
            $tabledata = [];
            foreach ($users as $user) {
                $data = [];
                $data["users_system_id"] = $user->users_system_id;
                $data["name"] = $user->first_name . " " . $user->last_name;
                $data["sp_points"] = $user->sp_points;
                $data["email"] = $user->email;
                $data["mobile"] = $user->mobile;
                $status = '<div class="toggle-btn1 ';
                if ($user->status == 'Active') {
                    $status .= 'active"';
                }
                $status .= ">";
                $status .= '<input type="checkbox"   class="cb-value" value="' . $user->users_system_id . '"';
                if ($user->status == 'Active') {
                    $status .= ' checked';
                }
                $status .= "/>";
                $status .= '<span class="round-btn"></span></div>';

                $data["status"] = $status;
                $action = "<a href='" . base_url() . "admin/edit_user/" . $user->users_system_id . "'>
                                            <i class='fa fa-pencil'></i>
                                        </a>";
                // $user['users_system_id']
                // $count;

                // $action .= "<a href='javascript:;' onclick=confirm_modal_action('". base_url().strtolower($this->session->userdata('directory')) . "/manage_users/delete/". $user->users_system_id ."')><i class='fa fa-trash-o'></i></a>";
                // $action .= "<a href='javascript:;' onclick=confirm_modal_action('". base_url().strtolower($this->session->userdata('directory')) . "/manage_users/delete/". $user->users_system_id ."')><i class='fa fa-trash-o'></i></a>";
                // $action .= "<a href='javascript:;' onclick=confirm_modal_action('". base_url().strtolower($this->session->userdata('directory')) . "/manage_users/delete/". $user->users_system_id ."')><i class='fa fa-trash-o'></i></a>";
                $d["user"] = ["users_system_id" => $user->users_system_id];
                $d["count"] = $user->users_system_id;
                $data["action"] = $this->load->view(strtolower($this->session->userdata('directory')) . '/manage_user_actions', $d, true);
                $tabledata[] = $data;
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $tabledata
            );

            echo json_encode($response);
            exit();
        }
        if ($param1 == 'get_logs') {
            $id = $_REQUEST['id'];
            $this->db->order_by("points_log_id", "DESC");
            $res = $this->db->get_where("points_log", ["user_id" => $id]);
            $data = [];
            if ($res) {
                $data["result"] = $res->result();
                $data["status"] = 1;

            } else {
                //   $data["result"] = $res->result();
                $data["status"] = 1;
            }
            echo json_encode($data);

            exit;
        }
        if ($param1 == 'delete') {
            $this->db->where('users_system_id', $param2);
            $this->db->delete('users_system');
            $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
            redirect(base_url() . admin_ctrl() . '/customer_list', 'refresh');
        }
        if ($param1 == 'update_status') {
            $user_id = $this->input->post('user_id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('users_system_id', $user_id);
            $result = $this->db->update('users_system', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }
        if ($param1 == 'upload_xml') {
            libxml_use_internal_errors(TRUE);
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'xlsx';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('excel_file')) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                $this->load->library("Excel");
                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load('upload/' . $file_name);
                $sheetnumber = 0;                        //echo $config['upload_path'];			//echo '<br>';			//echo $file_name;						//echo "here again"; exit;
                foreach ($objPHPExcel->getWorksheetIterator() as $sheet) {
                    $s = $sheet->getTitle(); // get the sheet name 
                    $sheet = str_replace(' ', '', $s); // remove the spaces between sheet name 
                    $sheet = strtolower($sheet);
                    $objWorksheet = $objPHPExcel->getSheetByName($s);
                    $lastRow = $objPHPExcel->setActiveSheetIndex($sheetnumber)->getHighestRow();
                    $sheetnumber++;

                    for ($j = 2; $j <= $lastRow; $j++) {
                        $ID = $objWorksheet->getCellByColumnAndRow(0, $j)->getValue();
                        $firstname = $objWorksheet->getCellByColumnAndRow(2, $j)->getValue();
                        $lastname = $objWorksheet->getCellByColumnAndRow(1, $j)->getValue();

                        $phone = $objWorksheet->getCellByColumnAndRow(3, $j)->getValue();

                        $email = $objWorksheet->getCellByColumnAndRow(4, $j)->getValue();
                        $spPoint = $objWorksheet->getCellByColumnAndRow(10, $j)->getValue();
                        $openID = $objWorksheet->getCellByColumnAndRow(11, $j)->getValue();
                        /*	$first_name = $objWorksheet->getCellByColumnAndRow(3, $j)->getValue();
                            $last_name = $objWorksheet->getCellByColumnAndRow(4, $j)->getValue();
                            $c_open_id = $objWorksheet->getCellByColumnAndRow(39, $j)->getValue();
                            $c_gender = $objWorksheet->getCellByColumnAndRow(41, $j)->getValue();
                            $c_loyalty_points = $objWorksheet->getCellByColumnAndRow(36, $j)->getValue();
                            $name = $objWorksheet->getCellByColumnAndRow(7, $j)->getValue();
                            $home_number = $objWorksheet->getCellByColumnAndRow(8, $j)->getValue();
                            $serial_number = $objWorksheet->getCellByColumnAndRow(9, $j)->getCalculatedValue();	 */
                        echo $ID . '<br>';
                        echo $phone . '<br>';
                        echo $spPoint . '<br>';
                        echo $openID . '<br>';


                        //  $upData['mobile'] = $phone;
                        // $this->db->where('users_system_id',$ID);
                        // $this->db->update('users_system',$upData);

                        //echo $last_name.'<br>';
                        $excel = array(
                            'users_system_id' => $ID,
                            'users_roles_id' => 3,
                            'email' => $email,
                            'password' => '',
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'first_name_en' => '',
                            'last_name_en' => '',
                            'first_name_ch' => '',
                            'last_name_ch' => '',
                            'mobile' => $phone,
                            'city' => '',
                            'address' => '?',
                            'is_deleted' => 'No',
                            'status' => 'Active',
                            'c_open_id' => $openID,
                            'c_gender' => '',
                            'loyalty_program_tier_id' => '',
                            'c_loyalty_points' => 0,
                            'sp_points' => $spPoint,
                            'c_deactivated' => '',
                            'c_company_name' => '',
                            'c_company_name_en' => '',
                            'c_company_name_ch' => '',
                            'c_nborders' => '',
                            'c_lastorder' => '',
                            'c_referral_id' => '',
                            'reference_id' => '',
                            'session_id' => '',
                            'token_id' => '',
                        );
                        $this->db->insert('users_system', $excel);
                        // print_r($excel);
                        // exit;
                        /*
                        if ($polling_station_no != '' || $polling_station != '' || $booth_number != '' || $address != '' || $cnic != '' || $father_name != '' || $name != '' || $home_number != '') {
                            $excel = array(

                                'block_code' => $block_code,
                                'gender' => $gender,
                                'polling_station_no' => $polling_station_no,
                                'polling_station' => $polling_station,
                                'booth_number' => $booth_number,
                                'address' => $address,
                                'cnic' => $cnic,
                                'father_name' => $father_name,
                                'name' => $name,
                                'home_number' => $home_number,
                                'serial_number' => $serial_number,
                                'status' => '?'
                                );
                            $this->db->insert('voters', $excel);
                        }	 */
                    }
                    /*
                    $result = ($this->db->affected_rows() != 0);
                    if ($result == true) {
                        $this->session->set_flashdata('flash_message', get_phrase('data_uploded'));
                        redirect(base_url() . 'admin/import_excel/', 'refresh');
                    } else {
                        $this->session->set_flashdata('flash_message', get_phrase('data_failed_to_upload'));
                        redirect(base_url() . 'admin/import_excel/', 'refresh');
                    } */
                }
                exit;
            }


        }
        // $this->db->limit($limit, $start);
        // $this->db->limit(300);  
        // $data['customer_list'] = $this->db->get_where('users_system')->result_array();
        $data['page_title'] = 'Manage Users';
        $data['page_sub_title'] = 'manage_users';
        if($param1 == 'order'){
            $data['page_name'] = 'manage_users_order';
            $data['main_page_name'] = 'manage_users_order';
            $data["htmlPage"] = "manage_users_order";
            $data['actor'] = 'manage_users_order';
            $this->load->view(strtolower($this->session->userdata('directory')) . '/manage_users_order', $data);
            return;
        }else{
            $data['page_name'] ='manage_users';
            $data['main_page_name'] = 'manage_users';
            $data["htmlPage"] = "manage_users";
            $data['actor'] = 'manage_users';
        }
        // print_r($data);
        
        // if($param1 =='order'){
            $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
        // }else{
            
        // }
    }

    public function add_user($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'add') {
            if (!empty($_FILES['image']['name'])) {
                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/users/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $saveData['user_image'] = $file_name;
            }
            $saveData['first_name'] = $this->input->post('name');
            $saveData['email'] = $this->input->post('email');
            $saveData['mobile'] = $this->input->post('mobile');
            $saveData['password'] = $this->input->post('password');
            $saveData['city'] = $this->input->post('city');
            $saveData['address'] = $this->input->post('address');
            $sp_points = $this->input->post('sp_points');
            if (!empty($sp_points)) {
                $saveData['sp_points'] = $sp_points;
            }
            $saveData['users_roles_id'] = $this->input->post('roles');
            $saveData['status'] = 'Active';
            $result = $this->db->insert('users_system', $saveData);
            if (!empty($saveData['sp_points'])) {
                $id = $this->db->insert_id();
                $saveData2 = ["user_id" => $id, "type" => "Increment", "description" => "Added from admin panel", "points" => $saveData['sp_points'], "current_points" => $saveData['sp_points']];
                $result2 = $this->db->insert('points_log', $saveData2);
            }
            if ($result) {
                $this->session->set_flashdata('msg_success', ' User Added Successfully');
            }
            redirect(base_url() . admin_ctrl() . '/customer_list', 'refresh');
        }

        $data['page_title'] = 'Add User';
        $data['page_sub_title'] = 'add_user';
        $data['page_name'] = 'add_user';
        $data['actor'] = 'add_user';
        $data['main_page_name'] = 'add_user';
        $data["htmlPage"] = "add_user";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    public function edit_user($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'edit') {
            if (!empty($_FILES['image']['name'])) {
                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/users/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $saveData['user_image'] = $file_name;
            }
            $muser = $this->db->get_where('users_system', array('users_system_id' => $param2))->first_row();
            $saveData['first_name'] = $this->input->post('name');
            $saveData['email'] = $this->input->post('email');
            $saveData['mobile'] = $this->input->post('mobile');
//            $saveData['password'] = $this->input->post('password');
            $saveData['city'] = $this->input->post('city');
            $saveData['address'] = $this->input->post('address');
            $saveData['users_roles_id'] = $this->input->post('roles');
            $saveData['status'] = 'Active';
            $sp_type = $this->input->post("sp_points_type");
            $sp_points = $this->input->post('sp_points');
            if (!empty($sp_points)) {
                if ($sp_type == "increase") {
                    $saveData['sp_points'] = $sp_points + $muser->sp_points;
                } else if ($sp_type == "decrease") {
                    $saveData['sp_points'] = $muser->sp_points - $sp_points;
                }
            }

            $this->db->where('users_system_id', $param2);
            $result = $this->db->update('users_system', $saveData);
            if (!empty($sp_points)) {
                $id = $param2;
                $type = $sp_type == "increase" ? "Increment" : "Decrement";
                $points = $sp_points;
                $saveData2 = ["user_id" => $id, "type" => $type, "description" => "Added from admin panel", "points" => $points, "current_points" => $saveData['sp_points']];
                $result2 = $this->db->insert('points_log', $saveData2);

            }
            if ($result) {
                $this->session->set_flashdata('msg_success', ' User Added Successfully');
            }
            redirect(base_url() . admin_ctrl() . '/customer_list', 'refresh');
        }
        $data['page_data'] = $this->db->get_where('users_system', array('users_system_id' => $param1))->row();
        $data['page_title'] = 'Edit User';
        $data['page_sub_title'] = 'edit_user';
        $data['page_name'] = 'edit_user';
        $data['actor'] = 'edit_user';
        $data['main_page_name'] = 'edit_user';
        $data["htmlPage"] = "edit_user";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** customer list ****/
    /***** manage orders ****/
    public function manage_orders($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['order_list'] = $this->db->get_where('order')->result_array();
        $data['page_title'] = 'Manage Orders';
        $data['page_sub_title'] = 'manage_orders';
        $data['page_name'] = 'manage_orders';
        $data['actor'] = 'manage_orders';
        $data['main_page_name'] = 'manage_orders';
        $data["htmlPage"] = "manage_orders";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** manage orders ****/
    /***** MY PROFILE *********/
    public function myprofile($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        // exit;
        /*	if($this->session->userdata('login') != 1){
                redirect(base_url().strtolower($this->session->userdata('directory')), 'refresh');
            } */

        if ($param1 == 'update') {
            $response = $this->Db_model->update_admin_profile();

            $this->session->set_flashdata('msg_success', ' Updated Successfully');
            redirect(base_url() . admin_ctrl() . '/myprofile', 'refresh');
        }

        $data['profile_data'] = $this->db->get_where('users_system', array('users_system_id' => $this->session->userdata('users_id')))->row();
        $data['actor'] = 'profile';
        $data['main_page_name'] = 'profile';
        $data['page_title'] = 'Update Your Profile';
        $data['page_sub_title'] = 'profile';
        $data['page_name'] = 'myprofile';
        $data["htmlPage"] = "myprofile";

        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** MY PROFILE *********/

    /***** SYSTEM SETTINGS *********/
    public function system_settings($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }

        if ($param1 == 'update') {
            $response = $this->Db_model->update_system_settings();
            $this->session->set_flashdata('msg_success', ' Updated Successfully');
            redirect(base_url() . admin_ctrl() . '/system_settings', 'refresh');
        }

        $data['system_data'] = $this->db->get('system_settings')->result();
        $data['actor'] = 'system_settings';
        $data['main_page_name'] = 'system_settings';
        $data['page_title'] = 'Update Your System Settings';
        $data['page_sub_title'] = 'system_settings';
        $data['page_name'] = 'system_settings';
        $data["htmlPage"] = "system_settings";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    /***** SYSTEM SETTINGS *********/

    function edit_image($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'edit') {
            $save_data['page'] = $this->input->post('page');
            $save_data['link'] = $this->input->post('link');

            $save_data['en_description'] = $this->input->post('en_description');
            $save_data['ch_description'] = $this->input->post('ch_description');
            if (!empty($_FILES['image']['name'])) {
                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/general/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $save_data['image_preview'] = $file_name;
            }
            $this->db->where('images_id', $param2);
            $this->db->update('images', $save_data);
            $this->session->set_flashdata('msg_success', ' Data Updated Successfully');
            redirect(base_url() . strtolower($this->session->userdata('directory')) . '/manage_images', 'refresh');
        }
        $data['page_data'] = $this->db->get_where('images', array('images_id' => $param1))->row();
        $data['page_title'] = 'Edit Image';
        $data['page_sub_title'] = '';
        $data['page_name'] = 'edit_image';
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    /**** manage images *****/

    public function resetpassword($verification_code = '')
    {
        $decoded_code = base64_decode($verification_code);
        $code_array = explode("_", $decoded_code);
        $user_id = $code_array[0];
        $data['user_id'] = $user_id;
        $this->load->view('admin/reset_password', $data);
    }

    public function reset_password($verification_code = '', $user_id = '')
    {
        if ($verification_code == 'update_password') {
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
            if ($new_password != $confirm_password) {
                $this->session->set_flashdata('msg_error', ' Your password did not match, try again.');
                redirect(base_url() . 'admin', 'refresh');
            } else if ($new_password == $confirm_password) {
                $this->db->query("UPDATE user_accounts SET password = '" . $new_password . "', reset_password_code = ''  WHERE user_accounts_id = '" . $user_id . "'  ");
                $this->session->set_flashdata('msg_success', ' Password Updated Successfully.');
                redirect(base_url() . 'admin', 'refresh');
            }
        }
    }

    /***** Retrieve Password Page *********/
    public function logout()
    {
        /*  $s_update['status']  = 'Inactive';
          $this->db->where('user_accounts_id',$this->session->userdata('users_id'));
          $this->db->update('user_login',$s_update);*/
        $this->session->unset_userdata('login');
        $this->session->sess_destroy();
        $this->session->set_flashdata('msg_error', 'logout Successfully!.');
        redirect(base_url() . 'admin', 'refresh');
    }

    /* VERIFY ACCOUNT */

    public function manage_category($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('categories');
        $data['page_sub_title'] = 'main_category';
        $data['actor'] = 'category';
        $data['page_name'] = 'manage_category';
        $data['main_page_name'] = 'products';
        if (empty($page)) {
            $data["htmlPage"] = "manage_category";
            $this->db->order_by("position_order", "asc");
            $categories = $this->db->get_where($data['actor'], ["1" => "1"]);
//            print_r($categories->result());
            $data["categories"] = $categories->result();
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'add_main_category';
            $data["htmlPage"] = "add_category";
        }
        if ($page == "edit") {
            $data['page_sub_title'] = 'Edit Main Category';
            $data["htmlPage"] = "edit_category";
            $data['category'] = $this->db->get_where($data['actor'], array($data['actor'] . '_id' => $info))->first_row();
        }
        if ($page == "update") {
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $type = $this->input->post("type");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->update($data["actor"], ["category_title" => $name_en, "category_title_en" => $name_en, "category_title_ch" => $name_ch, "status" => $status,"category_type"=>$type], ["category_id" => $info]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me("manage_category");
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Main Category';
            $data["htmlPage"] = "add_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        if ($page == "save") {
//            print_r($_POST);
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $status = $this->input->post("status");
            $type = $this->input->post("type");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["category_title" => $name_en, "category_title_en" => $name_en, "category_title_ch" => $name_ch, "status" => $status,"category_type"=>$type]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }//        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE category_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
                //  $i--;
            }

            /*foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE category_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            echo "success";
            exit();
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], ["category_id" => $id]);

            echo "success";
            exit();
        }
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }


    public function manage_suggested_product($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('suggested_product');
        $data['page_sub_title'] = 'suggested_product';
        $data['actor'] = 'c_suggested_product';
        $data['subactor1'] = "product";
        $data['page_name'] = 'manage_suggested_product';
        $data['main_page_name'] = 'products';
        if (empty($page)) {
            $data["htmlPage"] = "manage_suggested_product";
            //$this->db->order_by("position_order", "asc");
            $categories = $this->Db_model->join2Tables($data['actor'], $data['subactor1']);
            $data["products"] = $this->db->get("product")->result();
//            print_r($categories->result());
            $data["table_data"] = $categories->result();
        }
        if ($page == "save") {
            print_r($_POST);

            $product = $this->input->post("product_id");
            if (empty($product)) {
                $this->session->set_flashdata('msg_error', 'Product Cannot Be Empty');
                $this->redirect_me($data["page_name"]);
            }
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["product_id" => $product]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }//
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Main Category';
            $data["htmlPage"] = "add_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], ["c_suggested_product_id" => $id]);

            echo "success";
            exit();
        }
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE category_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
                //  $i--;
            }

            /*foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE category_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            echo "success";
            exit();
        }


        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);


    }

    public function manage_product_watermark($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('product_watermark');
        $data['page_sub_title'] = 'product_watermark';
        $data['actor'] = 'product_watermark';
        $data['subactor1'] = "product";
        $data['page_name'] = 'manage_product_watermark';
        $data['main_page_name'] = 'products';
        if (empty($page)) {
            $data["htmlPage"] = "manage_product_watermark";
            //$this->db->order_by("position_order", "asc");
            // $categories = $this->Db_model->join2Tables($data['actor'], $data['subactor1']);
            $data["table_data"] = $this->db->get("product_watermark")->result();
//            print_r($categories->result());
            // $data["table_data"] = $categories->result();
        }
        if ($page == "add") {
            // echo "here";
            $data["htmlPage"] = "add_product_watermark";
        }
        if ($page == "save") {
            // print_r($_POST);
            //  print_r($_FILES);
            if (!empty($_FILES['image']['name'])) {

                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/products_watermark/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
            }
            $imagePath = isset($path_to_file) ? $path_to_file : "";
            // exit;
            $product = $this->input->post("title");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";

            $resp = $this->db->insert($data["actor"], ["title" => $product, "status" => $status, "watermark_url" => $imagePath]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }//
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_product_watermark';
            $data["htmlPage"] = "edit_product_watermark";
            $data['data'] = $this->db->get_where($data['actor'], array($data['actor'] . '_id' => $info))->first_row();
        }
        if ($page == "update") {
            // print_r($_POST);
            if (!empty($_FILES['image']['name'])) {

                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/products_watermark/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $imagePath = isset($path_to_file) ? $path_to_file : "";
                $arr["watermark_url"] = $imagePath;
            }
            // exit;
            $product = $this->input->post("title");
            $arr["title"] = $product;
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $arr["status"] = $status;
            // print_r($arr);
            // exit;
            $resp = $this->db->update($data["actor"], $arr, [$data['actor'] . '_id' => $info]);
            // $resp = $this->db->update($data["actor"],  ["name" => $name_en,"size" => $size,"status" => $status], [$data['actor'] . '_id' => $info]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Main Category';
            $data["htmlPage"] = "add_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], ["product_watermark_id" => $id]);

            echo "success";
            exit();
        }
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE category_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
                //  $i--;
            }

            /*foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE category_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            echo "success";
            exit();
        }


        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);


    }

    public function manage_points_log($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('sp_points_log');
        $data['page_sub_title'] = 'sp_points_log';
        $data['actor'] = 'points_log';
        $data['subactor1'] = "users_system";
        $data['page_name'] = 'manage_points_log';
        $data['main_page_name'] = 'sp_points_log';
        if (empty($page)) {
            $data["htmlPage"] = "manage_points_log";
            //$this->db->order_by("position_order", "asc");

            // $categories = $this->Db_model->join2Tables($data['actor'], $data['subactor1']);

            $categories = $this->db->query("select * from points_log pl left join users_system u on u.users_system_id = pl.user_id order by pl.points_log_id DESC Limit 1000");
            // $data["table_data"] = $this->db->get("product_watermark")->result();
//            print_r($categories->result());
            $data["table_data"] = $categories->result();
        }
        if ($page == "add") {
            // echo "here";
            $data["htmlPage"] = "add_product_watermark";
        }
        if ($page == "save") {
            // print_r($_POST);
            //  print_r($_FILES);
            if (!empty($_FILES['image']['name'])) {

                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/products_watermark/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
            }
            $imagePath = isset($path_to_file) ? $path_to_file : "";
            // exit;
            $product = $this->input->post("title");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";

            $resp = $this->db->insert($data["actor"], ["title" => $product, "status" => $status, "watermark_url" => $imagePath]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }//
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_product_watermark';
            $data["htmlPage"] = "edit_product_watermark";
            $data['data'] = $this->db->get_where($data['actor'], array($data['actor'] . '_id' => $info))->first_row();
        }
        if ($page == "update") {
            // print_r($_POST);
            if (!empty($_FILES['image']['name'])) {

                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/products_watermark/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $imagePath = isset($path_to_file) ? $path_to_file : "";
                $arr["watermark_url"] = $imagePath;
            }
            // exit;
            $product = $this->input->post("title");
            $arr["title"] = $product;
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $arr["status"] = $status;
            // print_r($arr);
            // exit;
            $resp = $this->db->update($data["actor"], $arr, [$data['actor'] . '_id' => $info]);
            // $resp = $this->db->update($data["actor"],  ["name" => $name_en,"size" => $size,"status" => $status], [$data['actor'] . '_id' => $info]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Main Category';
            $data["htmlPage"] = "add_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], ["product_watermark_id" => $id]);

            echo "success";
            exit();
        }
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE category_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
                //  $i--;
            }

            /*foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE category_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            echo "success";
            exit();
        }


        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);


    }

    public function manage_additional_product($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('additional_product');
        $data['page_sub_title'] = 'additional_product';
        $data['actor'] = 'additional_product';
        $data['subactor1'] = "additional_product";
        $data['page_name'] = 'manage_additional_product';
        $data['main_page_name'] = 'products';
        if (empty($page)) {
            $data["htmlPage"] = "manage_additional_product";
            $data["table_data"] = $this->db->get($data['actor'])->result();
        }
        if ($page == "add") {
            // echo "here";
            $data["htmlPage"] = "add_additional_product";
        }
        if ($page == "save") {
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $price = $this->input->post("price");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";

            $resp = $this->db->insert($data["actor"], ["additional_product_title" => $name_en, "additional_product_title_en" => $name_en, "additional_product_title_ch" => $name_ch, "ap_price" => $price, "status" => $status]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }//
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_additional_product';
            $data["htmlPage"] = "edit_additional_product";
            $data['data'] = $this->db->get_where($data['actor'], array($data['actor'] . '_id' => $info))->first_row();
        }
        if ($page == "update") {
            // print_r($_POST);
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $price = $this->input->post("price");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            // print_r($arr);
            // exit;
            $arr = ["additional_product_title" => $name_en, "additional_product_title_en" => $name_en, "additional_product_title_ch" => $name_ch, "ap_price" => $price, "status" => $status];
            $resp = $this->db->update($data["actor"], $arr, [$data['actor'] . '_id' => $info]);
            // $resp = $this->db->update($data["actor"],  ["name" => $name_en,"size" => $size,"status" => $status], [$data['actor'] . '_id' => $info]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Main Category';
            $data["htmlPage"] = "add_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], [$data["actor"] . "_id" => $id]);

            echo "success";
            exit();
        }
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE category_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
                //  $i--;
            }

            /*foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE category_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            echo "success";
            exit();
        }


        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);


    }

    public function manage_banner($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('manage_banner');
        $data['page_sub_title'] = 'manage_banner';
        $data['actor'] = 'banner';
        $data['subactor1'] = "manage_banner";
        $data['page_name'] = 'manage_banner';
        $data['main_page_name'] = 'manage_banner';
        if (empty($page)) {
            $data["htmlPage"] = "manage_banner";
            $this->db->order_by("position_order", "ASC");
            $data["table_data"] = $this->db->get($data['actor'])->result();
        }
        if ($page == "add") {
            // echo "here";
            $data["htmlPage"] = "add_banner";
        }
        if ($page == "save") {
            $arr = [];
            $arr["banner_title"] = $this->input->post("name_en");
            $arr["banner_title_en"] = $this->input->post("name_en");
            $arr["banner_title_ch"] = $this->input->post("name_ch");
            $arr["banner_description"] = $this->input->post("desc_en");
            $arr["banner_description_en"] = $this->input->post("desc_en");
            $arr["banner_description_ch"] = $this->input->post("desc_ch");
            if (!empty($_FILES['image']['name'])) {
                $file_name = date('Ymd') . time() . '_image.jpg';
                $path_to_file = 'uploads/banner_images/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $imagePath = isset($path_to_file) ? $path_to_file : "";
                $arr["banner_url"] = $imagePath;
            }
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $arr["status"] = $status;

            $resp = $this->db->insert($data["actor"], $arr);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }//
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_banner';
            $data["htmlPage"] = "edit_banner";

            $data['data'] = $this->db->get_where($data['actor'], array($data['actor'] . '_id' => $info))->first_row();
        }
        if ($page == "update") {
            $arr = [];
            $arr["banner_title"] = $this->input->post("name_en");
            $arr["banner_title_en"] = $this->input->post("name_en");
            $arr["banner_title_ch"] = $this->input->post("name_ch");
            $arr["banner_description"] = $this->input->post("desc_en");
            $arr["banner_description_en"] = $this->input->post("desc_en");
            $arr["banner_description_ch"] = $this->input->post("desc_ch");
            if (!empty($_FILES['image']['name'])) {
                $file_name = date('Ymd') . time() . '_image.jpg';
                $path_to_file = 'uploads/banner_images/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $imagePath = isset($path_to_file) ? $path_to_file : "";
                $arr["banner_url"] = $imagePath;
            }
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $arr["status"] = $status;

            $resp = $this->db->update($data["actor"], $arr, [$data['actor'] . '_id' => $info]);
            // $resp = $this->db->update($data["actor"],  ["name" => $name_en,"size" => $size,"status" => $status], [$data['actor'] . '_id' => $info]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Main Category';
            $data["htmlPage"] = "add_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], [$data["actor"] . "_id" => $id]);

            echo "success";
            exit();
        }
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE " . $data['actor'] . "_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
                //  $i--;
            }

            /*foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE category_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            echo "success";
            exit();
        }


        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);


    }

    public function manage_attribute_size($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('attribute_size');
        $data['page_sub_title'] = 'attribute_size';
        $data['actor'] = 'attribute_size';
        $data['subactor1'] = 'product_attribute';
        $data['page_name'] = 'manage_attribute_size';
        $data['main_page_name'] = 'products';
        if (empty($page)) {
            $data["htmlPage"] = "manage_attribute_size";
            //$this->db->order_by("position_order", "asc");
            $categories = $this->db->get($data['actor']);
//            print_r($categories->result());
            $data["table_data"] = $categories->result();
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'add_attribute_size';
            $data["htmlPage"] = "add_attribute_size";
            //$data["attributes"]=  $categories;
        }
        if ($page == "save") {
//            print_r($_POST);
            $name_en = $this->input->post("name");
            $size = $this->input->post("size");
            // $attr_id = $this->input->post("attr_id");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["name" => $name_en, "size" => $size, "status" => $status]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }//  
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_attribute_size';
            $data["htmlPage"] = "edit_attribute_size";
            $data['category'] = $this->db->get_where($data['actor'], array($data['actor'] . '_id' => $info))->first_row();
        }
        if ($page == "update") {
            // print_r($_POST);
            $name_en = $this->input->post("name");
            $size = $this->input->post("size");
            // $attr_id = $this->input->post("attr_id");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->update($data["actor"], ["name" => $name_en, "size" => $size, "status" => $status], [$data['actor'] . '_id' => $info]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Main Category';
            $data["htmlPage"] = "add_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        //      print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE category_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
                //  $i--;
            }

            /*foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE category_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            echo "success";
            exit();
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], [$data["actor"] . "_id" => $id]);

            echo "success";
            exit();
        }
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }

    public function manage_order_source($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('manage_order_source');
        $data['page_sub_title'] = 'manage_order_source';
        $data['actor'] = 'order_source';
        $data['page_name'] = 'manage_order_source';
        $data['main_page_name'] = 'manage_order_source';
        if (empty($page)) {
            $data["htmlPage"] = "manage_order_source";
            $categories = $this->db->get($data['actor']);
            $data["table_data"] = $categories->result();
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'manage_order_source';
            $data["htmlPage"] = "add_order_source";
        }
        if ($page == "save") {
//            print_r($_POST);
            $name_en = $this->input->post("name");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["source_title" => $name_en, "status" => $status]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }//  
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_order_source';
            $data["htmlPage"] = "edit_order_source";
            $data['category'] = $this->db->get_where($data['actor'], array($data['actor'] . '_id' => $info))->first_row();
        }
        if ($page == "update") {
            // print_r($_POST);
            $name_en = $this->input->post("name");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->update($data["actor"], ["source_title" => $name_en, "status" => $status], [$data['actor'] . '_id' => $info]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Main Category';
            $data["htmlPage"] = "add_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        //      print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE category_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
                //  $i--;
            }

            /*foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE category_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            echo "success";
            exit();
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], [$data["actor"] . "_id" => $id]);

            echo "success";
            exit();
        }
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }

    public function manage_printer_group($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('printer_group');
        $data['page_sub_title'] = 'printer_group';
        $data['actor'] = 'printer_group';
        $data['page_name'] = 'manage_printer_group';
        $data['main_page_name'] = 'products';
        if (empty($page)) {
            $data["htmlPage"] = "manage_printer_group";
            //$this->db->order_by("position_order", "asc");
            $categories = $this->db->get_where($data['actor'], ["1" => "1"]);
//            print_r($categories->result());
            $data["categories"] = $categories->result();
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'add_printer_group';
            $data["htmlPage"] = "add_printer_group";
        }
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_printer_group';
            $data["htmlPage"] = "edit_printer_group";
            $data['category'] = $this->db->get_where($data['actor'], array($data['actor'] . '_id' => $info))->first_row();
        }
        if ($page == "update") {
            $name_en = $this->input->post("title");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->update($data["actor"], ["group_title" => $name_en, "status" => $status], [$data['actor'] . '_id' => $info]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Main Category';
            $data["htmlPage"] = "add_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        if ($page == "save") {
//            print_r($_POST);
            $name_en = $this->input->post("title");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["group_title" => $name_en, "status" => $status]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }//        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE category_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
                //  $i--;
            }

            /*foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE category_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            echo "success";
            exit();
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], ["printer_group_id" => $id]);

            echo "success";
            exit();
        }
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }

    public function manage_product_category($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('product_categories');
        $data['page_sub_title'] = 'product_category';
        $data['actor'] = 'product_category';
        $data['subactor1'] = 'category';
        $data['page_name'] = 'manage_product_category';
        $data['main_page_name'] = 'products';

        if (empty($page)) {
            $data["htmlPage"] = "manage_product_category";
            $this->db->order_by("position_order","ASC");
            $resp = $this->db->get($data['actor']);//$this->Db_model->join2Tables($data['actor'], $data['subactor1'], 1, "a.position_order asc");
            $data["table_data"] = $resp->result();
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'add_product_category';
            $data["htmlPage"] = "add_product_category";
            $data['sub_data'] = $this->db->get_where($data['subactor1'])->result();
        }
        if ($page == "save") {
//            print_r($_POST);
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $category = $this->input->post("category");
            $status = $this->input->post("status");
            $num_of_a = $this->input->post("no_of_attr");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["product_category_title" => $name_en, "product_category_title_en" => $name_en, "product_category_title_ch" => $name_ch, "status" => $status, "category_id" => $category, "number_of_attributes" => $num_of_a]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_product_category';
            $data["htmlPage"] = "edit_product_category";
            $data['category'] = $this->db->get_where($data['actor'],[$data['actor'] . "_id ="=>$info])->first_row(); //$this->Db_model->join2Tables($data['actor'], $data['subactor1'], $data['actor'] . "_id = $info")->first_row();
//            echo $this->db->last_query();
//            exit();
            $data["sub_data"] = $this->db->get_where($data['subactor1'])->result();
        }
        if ($page == "update") {
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $category = $this->input->post("category");
            $status = $this->input->post("status");
            $num_of_a = $this->input->post("no_of_attr");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->update($data["actor"], ["product_category_title" => $name_en, "product_category_title_en" => $name_en, "product_category_title_ch" => $name_ch, "status" => $status, "category_id" => $category, "number_of_attributes" => $num_of_a], [$data['actor'] . "_id" => $info]);
//            echo $this->db->last_query();
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data['page_name']);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Product Category';
            $data["htmlPage"] = "add_product_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        //        print_r($data);


        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE " . $data['actor'] . "_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
            }

            /* foreach ($position as $k => $v) {
                 $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE " . $data['actor'] . "_id=" . $v . " ORDER BY position_order desc";
                 $this->db->query($sql);
                 $i--;
             }*/
            exit();
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], [$data['actor'] . "_id" => $id]);

            echo "success";
            exit();
        }
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }

    public function manage_product_attribute($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('product_attribute');
        $data['page_sub_title'] = 'product_attribute';
        $data['actor'] = 'product_attribute';
        $data['subactor1'] = 'product_category';
        $data['page_name'] = 'manage_product_attribute';
        $data['main_page_name'] = 'products';

        if (empty($page)) {
            $data["htmlPage"] = "manage_product_attribute";
            $resp = $this->Db_model->join2Tables($data['actor'], $data['subactor1'], 1, " a.position_order ASC");
            $printers = $this->db->get("printer_group")->result();
            $printer_group = [];
            foreach($printers as $printer){
                $printer_group[$printer->printer_group_id] = $printer->group_title;
            }
            $data["groups"] = $printer_group;
            $data["table_data"] = $resp->result();
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'add_product_attribute';
            $data["htmlPage"] = "add_product_attribute";
            $data["sizes"] = $this->db->get_where("attribute_size", ["status" => "Online"])->result();
            $data["printer_groups"] = $this->db->get_where("printer_group", ["status" => "Online"])->result();
            $data['sub_data'] = $this->db->get_where($data['subactor1'])->result();
        }
        if ($page == "save") {
            // print_r($_POST);
            // exit();
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $category = $this->input->post("category");
            $o_price = $this->input->post("or_price");
            $c_price = $this->input->post("cur_price");
            $sizes = $this->input->post("size_id");
            $printer_group = $this->input->post("printer_group");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["printer_group_id"=>$printer_group,"product_attribute_title" => $name_en, "product_attribute_title_en" => $name_en, "product_attribute_title_ch" => $name_ch, "status" => $status, "product_category_id" => $category, "original_price" => $o_price, "current_price" => $c_price]);
            $id = $this->db->insert_id();
//            foreach ($sizes as $size) {
            if(!empty($sizes))
                $resp = $this->db->insert("product_attribute_sizes", ["product_attribute_id" => $id, "	product_attribute_size_id" => $sizes]);
//            }
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_product_attribute';
            $data["htmlPage"] = "edit_product_attribute";
            $data["sizes"] = $this->db->get_where("attribute_size", ["status" => "Online"])->result();
            $data["printer_groups"] = $this->db->get_where("printer_group", ["status" => "Online"])->result();
            $data["atts"] = $this->db->get_where("product_attribute_sizes", [$data['actor'] . "_id" => $info])->result();

            $data['category'] = $this->Db_model->join2Tables($data['actor'], $data['subactor1'], $data['actor'] . "_id = $info")->first_row();
//            echo $this->db->last_query();
//            exit();
            $data["sub_data"] = $this->db->get_where($data['subactor1'])->result();
        }
        if ($page == "update") {
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $category = $this->input->post("category");
            $o_price = $this->input->post("or_price");
            $c_price = $this->input->post("cur_price");
            $status = $this->input->post("status");
            $sizes = $this->input->post("size_id");
            $printer_group = $this->input->post("printer_group");

            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->update($data["actor"], ["printer_group_id"=>$printer_group,"product_attribute_title" => $name_en, "product_attribute_title_en" => $name_en, "product_attribute_title_ch" => $name_ch, "status" => $status, "product_category_id" => $category, "original_price" => $o_price, "current_price" => $c_price], [$data['actor'] . "_id" => $info]);
            $this->db->delete("product_attribute_sizes", ["product_attribute_id" => $info]);
//            foreach ($sizes as $size) {
            if(!empty($sizes))
                $resp = $this->db->insert("product_attribute_sizes", ["product_attribute_id" => $info, "	product_attribute_size_id" => $sizes]);
//            }
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data['page_name']);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Product Category';
            $data["htmlPage"] = "add_product_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->db->delete("product_attribute_sizes", ["product_attribute_id" => $info]);
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        //        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE " . $data['actor'] . "_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
            }

            /* foreach ($position as $k => $v) {
                 $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE " . $data['actor'] . "_id=" . $v . " ORDER BY position_order desc";
                 $this->db->query($sql);
                 $i--;
             } */
            exit();
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];

            $res = $this->db->update($data["actor"], ["status" => $status], [$data['actor'] . "_id" => $id]);

            echo "success";
            exit();
        }
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }

    public function manage_product($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('products');
        $data['page_sub_title'] = 'products';
        $data['actor'] = 'product';
        $data['subactor1'] = 'product_category';
        $data['subactor2'] = 'product_categories';
        $data['page_name'] = 'manage_product';
        $data['main_page_name'] = 'products';

        if (empty($page)) {
            $data["htmlPage"] = "manage_product";
//            $resp = $this->Db_model->join2Tables($data['actor'],$data['subactor1'],1," a.position_order DESC");
            $this->db->order_by("position_order ASC");
            $arr = [];
            if (isset($_REQUEST['cat'])) {
                if ($_REQUEST['cat'] == "all" || empty($_REQUEST['cat'])) {
                    $arr["1"] = "1";
                } else {
                    $arr["category_id"] = $_REQUEST['cat'];
                }
            } else {
                $arr["1"] = "1";
            }
            $resp = $this->db->get_where("product", $arr);

//            print_r($resp->result());
//            exit();
            $data["table_data"] = $resp->result();
            $this->db->order_by("position_order ASC");
            $data["categories"] = $this->db->get_where("category", ["status" => "Online"])->result();
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'add_product';
            $data["htmlPage"] = "add_product";
            $data['categories'] = $this->db->get_where('category')->result();
            $data['sub_categories'] = $this->db->get_where("product_category", ['status' => "Online"])->result();
            $this->db->select("product_id,product_name_en,product_name_ch,product_name");
            $data['products'] = $this->db->get_where("product", ['status' => "Online"])->result();
            $data['printer_group'] = $this->db->get_where("printer_group", ["status" => "Online"])->result();
            $data['watermarks'] = $this->db->get_where("product_watermark", ['status' => "Online"])->result();
            $data['attributes'] = $this->db->get_where("product_attribute", ["status" => "Online"])->result();
            $pageData = array();
            for ($i = 0; $i < count($data['sub_categories']); $i++) {
                $subCat = $data['sub_categories'][$i];
//                    $data['sub_categories']->productCategory = $subCat;
                for ($j = 0; $j < count($data["attributes"]); $j++) {
                    if ($subCat->product_category_id == $data['attributes'][$j]->product_category_id) {
                        $subCat->attributes[] = $data['attributes'][$j];
                    }
                }
                $pageData[] = $subCat;
            }
//              echo "<pre>";
//            print_r($pageData);
//            exit();
            $data["json"] = json_encode($pageData);
            $data["catData"] = $pageData;
        }
        if ($page == "save") {
//            print_r($_FILES);
            if (!empty($_FILES['image']['name'])) {
                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/products/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                //$saveData['user_image'] = $file_name;
            }
//            echo $path_to_file;
//            exit();
// f($result){
// 		       $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
//             }else{
// 		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
//             }
// 		    redirect(base_url() . admin_ctrl() . '/manage_orders', 'refresh');
            $imagePath = isset($path_to_file) ? $path_to_file : "";
            $name_en = $this->input->post("name_en");
            if(empty($name_en)){
                 $this->session->set_flashdata('msg_error', 'Oops! name cannot be empty');
                 $this->redirect_me($data["page_name"]."/add");
            }
            $name_ch = $this->input->post("name_ch");
             if(empty($name_ch)){
                 $this->session->set_flashdata('msg_error', 'Oops! name chinese cannot be empty');
                 $this->redirect_me($data["page_name"] . '/add');
            }
            $text_en = $this->input->post("text_en");
            if(empty($text_en)){
                 $this->session->set_flashdata('msg_error', 'Oops! text_en  cannot be empty');
                 $this->redirect_me($data["page_name"].'/add');
            }
            $text_ch = $this->input->post("text_ch");
            if(empty($text_en)){
                 $this->session->set_flashdata('msg_error', 'Oops! text_ch  cannot be empty');
                 $this->redirect_me($data["page_name"].'/add');
            }
            $category = $this->input->post("category");
            if(empty($category)){
                 $this->session->set_flashdata('msg_error', 'Oops! category  cannot be empty');
                 $this->redirect_me($data["page_name"].'/add');
            }
            $pcategories = $this->input->post("product_category");
             if(empty($pcategories)){
                 $this->session->set_flashdata('msg_error', 'Oops! product categories  cannot be empty');
                 $this->redirect_me($data["page_name"].'/add');
            }
            $o_price = $this->input->post("or_price");
             if(empty($o_price)){
                 $this->session->set_flashdata('msg_error', 'Oops! original price cannot be empty');
                 $this->redirect_me($data["page_name"].'/add');
            }
            $c_price = $this->input->post("cur_price");
            if(empty($c_price)){
                 $this->session->set_flashdata('msg_error', 'Oops! current price cannot be empty');
                 $this->redirect_me($data["page_name"].'/add');
            }
            $status = $this->input->post("status");
            
            $watermarks = [];
            if (isset($_POST['watermarks'])) {
                $watermarks = $this->input->post("watermarks");
            }
            $printer_group = $this->input->post("printer_group");
            if (isset($_POST['products'])) {
                $suggested_products = $this->input->post("products");
            } else {
                $suggested_products = [];
            }
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["printer_group_id" => $printer_group, "product_name" => $name_en, "product_name_en" => $name_en, "product_name_ch" => $name_ch, "status" => $status, "category_id" => $category, "original_price" => $o_price, "current_price" => $c_price, "product_image" => $imagePath, "product_detail" => $text_en, "product_detail_en" => $text_en, "product_detail_ch" => $text_ch]);
            if ($resp) {
                $pid = $this->db->insert_id();
                foreach ($pcategories as $pc) {
                    $resp = $this->db->insert("product_categories", ["product_id" => $pid, "product_category_id" => $pc]);
                }
                foreach ($suggested_products as $product) {
                    $resp = $this->db->insert("suggested_products", ["product_id" => $pid, "suggested_product_id" => $product]);
                }
                foreach ($watermarks as $watermark) {
                    $resp = $this->db->insert("product_watermarks", ["product_id" => $pid, "product_watermark_id" => $watermark]);
                }
            }
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_product_attribute';
            $data["htmlPage"] = "edit_product_attribute";
            $data['category'] = $this->Db_model->join2Tables($data['actor'], $data['subactor1'], $data['actor'] . "_id = $info")->first_row();

//            echo $this->db->last_query();
//            exit();
            $data["sub_data"] = $this->db->get_where($data['subactor1'])->result();
        }
        if ($page == "update") {
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $category = $this->input->post("category");
            $o_price = $this->input->post("or_price");
            $c_price = $this->input->post("cur_price");
            $status = $this->input->post("status");
            $printer_group = $this->input->post("printer_group");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->update($data["actor"], ["printer_group_id" => $printer_group, "product_attribute_title" => $name_en, "product_attribute_title_en" => $name_en, "product_attribute_title_ch" => $name_ch, "status" => $status, "product_category_id" => $category, "original_price" => $o_price, "current_price" => $c_price], [$data['actor'] . "_id" => $info]);
//            echo $this->db->last_query();
            $this->redirect_me($data['page_name']);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Product Category';
            $data["htmlPage"] = "add_product_category";
            $resp = $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
        }
        //        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE " . $data['actor'] . "_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
            }
            /*foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE " . $data['actor'] . "_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            exit();
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], [$data['actor'] . "_id" => $id]);

            echo "success";
            exit();
        }
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }

    public function edit_product($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }

        // print_r($_POST);
        // exit();
        if ($param1 == 'save') {
            $product_id = $param2;
            //  print_r($_POST);
            //  exit();

            if (!empty($_FILES['image']['name'])) {
                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/products/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                //$saveData['user_image'] = $file_name;
                $imagePath = $path_to_file;
                $saveData['product_image'] = $imagePath;
                $this->db->where('product_id', $product_id);
                $this->db->update('product', $saveData);
            }

            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $text_en = $this->input->post("text_en");
            $text_ch = $this->input->post("text_ch");
            $category = $this->input->post("category");
            $pcategories = $this->input->post("p_cat");
            $o_price = $this->input->post("or_price");
            $c_price = $this->input->post("cur_price");
            $status = $this->input->post("status");
            $printer_group = $this->input->post("printer_group");
            $watermarks = [];
            if (isset($_POST['watermarks'])) {
                $watermarks = $this->input->post("watermarks");
            }
            if (isset($_POST['products'])) {
                $suggested_products = $this->input->post("products");
            } else {
                $suggested_products = [];
            }

            $status = $status == "active" ? "Online" : "Offline";
            $this->db->where('product_id', $product_id);
            $resp = $this->db->update('product', ["printer_group_id" => $printer_group, "product_name" => $name_en, "product_name_en" => $name_en, "product_name_ch" => $name_ch, "status" => $status, "category_id" => $category, "original_price" => $o_price, "current_price" => $c_price, "product_detail" => $text_en, "product_detail_en" => $text_en, "product_detail_ch" => $text_ch]);
            if ($resp) {
                $this->db->where('product_id', $product_id);
                $this->db->delete('product_categories');
                for ($i = 0; $i < count($pcategories); $i++) {
                    $resp = $this->db->insert("product_categories", ["product_id" => $product_id, "product_category_id" => $pcategories[$i]]);
                }
                // }
                // foreach ($pcategories as $pc) {
                //     $resp = $this->db->insert("product_categories", ["product_id" => $product_id, "product_category_id" => $pc]);
                // }
                $this->db->where('product_id', $product_id);
                $this->db->delete('suggested_products');

                foreach ($suggested_products as $product1) {
                    $resp = $this->db->insert("suggested_products", ["product_id" => $product_id, "suggested_product_id" => $product1]);
                }
                $this->db->where('product_id', $product_id);
                $this->db->delete('product_watermarks');
                foreach ($watermarks as $watermark) {
                    $resp = $this->db->insert("product_watermarks", ["product_id" => $product_id, "product_watermark_id" => $watermark]);
                }

            }
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . admin_ctrl() . '/manage_product', 'refresh');
            exit;
        }


        $data['actor'] = 'edit_product';
        $data['main_page_name'] = 'edit_product';
        $data["htmlPage"] = "edit_product";
        $data['page_title'] = 'Manage Products';
        $data['page_sub_title'] = 'edit_product';
        $data['page_name'] = 'edit_product';
        $data['categories'] = $this->db->get_where('category')->result();
        $data['sub_categories'] = $this->db->get_where("product_category", ['status' => "Online"])->result();
        $data['attributes'] = $this->db->get_where("product_attribute", ["status" => "Online"])->result();
        $data['products'] = $this->db->get_where("product", ["status" => "Online"])->result();
        $data['suggested_products'] = $this->db->get_where("suggested_products", ["product_id" => $param1])->result();
        $data['sel_pr_data'] = $this->db->get_where('product', array('product_id' => $param1))->row();
        $data['sel_pr_cat_data'] = $this->db->get_where('product_categories', array('product_id' => $param1))->result_array();
        $data['watermarks'] = $this->db->get_where("product_watermark", ['status' => "Online"])->result();
        $data["p_watermarks"] = $this->db->get_where("product_watermarks", ["product_id" => $param1])->result();
        // print_r($data["p_watermarks"]);
        // exit;
        $data['printer_group'] = $this->db->get_where("printer_group", ["status" => "Online"])->result();
        $pageData = array();
        for ($i = 0; $i < count($data['sub_categories']); $i++) {
            $subCat = $data['sub_categories'][$i];
            //                    $data['sub_categories']->productCategory = $subCat;
            for ($j = 0; $j < count($data["attributes"]); $j++) {
                if ($subCat->product_category_id == $data['attributes'][$j]->product_category_id) {
                    $subCat->attributes[] = $data['attributes'][$j];
                }
            }
            $pageData[] = $subCat;
        }

        $data["json"] = json_encode($pageData);
        $data["catData"] = $pageData;


        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }

    public function manage_coupon($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('coupons');
        $data['page_sub_title'] = 'coupons';
        $data['actor'] = 'coupons';
        $data['subactor1'] = 'category';
        $data['subactor2'] = 'product';
        $data['subactor3'] = 'coupon_frequency';
//        $data['subactor4'] = 'product';
        $data['page_name'] = 'manage_coupon';
        $data['main_page_name'] = 'coupons';

        if (empty($page)) {
            $data["htmlPage"] = "manage_coupon";
            $resp = $this->db->get($data['actor']);
//            print_r($resp->result());
//            exit();
            $data["table_data"] = $resp->result();
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'add_coupon';
            $data["htmlPage"] = "add_coupon";
            $data['categories'] = $this->db->get_where($data['subactor1'])->result();
            $data['products'] = $this->db->get_where($data['subactor2'])->result();
            $data['frequencies'] = $this->db->get_where($data['subactor3'])->result();
//            $data['products'] = $this->db->get_where($data['subactor2'])->result();

        }
        if ($page == "save") {
//            print_r($_POST);
//            exit();
            $name = $this->input->post("name");
//            $name_ch = $this->input->post("name_ch");
            $categories = [];
            if (isset($_POST['product_category'])) {
                $categories = $this->input->post("product_category");
            }
            $products = [];
            if (isset($_POST['product'])) {
                $products = $this->input->post("product");
            }
            $frequencies = [];
            if (isset($_POST['frequency'])) {
                $frequencies = $this->input->post("frequency");
            }
            $discount_type = $this->input->post("discount_type");
            $discount = $this->input->post("discount");
            $qty = $this->input->post("qty");
            $end_date = $this->input->post("end_date");
            $end_time = $this->input->post("end_time");
            $start_date = $this->input->post("start_date");
            $start_time = $this->input->post("start_time");
            $type = $this->input->post("type");
            $c_type = $this->input->post("c_type");
            $code = $this->input->post("code");
            $password = $c_type == "Coupon" ? "" : $this->input->post("password");
            $isCategory = false;
            if ($type == "For Categories") {
                $isCategory = true;
            }
            $percent = 0;
            $amount = 0;
            if ($discount_type == "Percentage") {
                $percent = $discount;
            } else {
                $amount = $discount;
            }
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            // Dates
                $convDate = explode("-",$start_date);
                $mon = trim($convDate[0]);
                $day = trim($convDate[1]);
                $year = trim($convDate[2]);
                $convertedStartDate = $year . "-" . $mon . "-" . $day;
                
                $convDate = explode("-",$end_date);
                $mon = trim($convDate[0]);
                $day = trim($convDate[1]);
                $year = trim($convDate[2]);
                $convertedEndDate = $year . "-" . $mon . "-" . $day;
                
                $s_date = $convertedStartDate ." ". $start_time;
                $e_date = $convertedEndDate. " " .$end_time;
                // exit();
            // Dates End
            // $s_date = date("Y-m-d h:i:s", strtotime($start_date . " " . $start_time . ":00"));
            // $e_date = date("Y-m-d h:i:s", strtotime($end_date . " " . $end_time . ":00"));
            if (empty($e_date)) {
                $e_date = date('Y-m-d h:i:s');
            }
            if (empty($s_date)) {
                $s_date = date('Y-m-d h:i:s');
            }
            $resp = $this->db->insert($data["actor"], ["coupons_name" => $name, "discount_type" => $discount_type, "amount" => $amount, "percentage" => $percent, "coupon_qty" => $qty, "status" => $status, "start_time" => $s_date, "end_time" => $e_date, "coupon_condition" => $type, "c_type" => $c_type, "code" => $code, "password" => $password]);
            if ($resp) {
                $c_id = $this->db->insert_id();
                foreach ($frequencies as $frequency) {
                    $resp1 = $this->db->insert("coupon_frequencies", ["coupons_id" => $c_id, "coupon_frequency_id" => $frequency]);
                }
                if ($isCategory) {
                    foreach ($categories as $category) {
                        $resp1 = $this->db->insert("coupon_categories", ["coupons_id" => $c_id, "category_id" => $category]);
                    }
                } else {
                    foreach ($products as $product) {
                        $resp1 = $this->db->insert("coupon_products", ["coupons_id" => $c_id, "	product_id" => $product]);
                    }
                }
            }
//            $this->session->set_flashdata();
            $this->session->set_flashdata('msg_success', 'Data Added Successfully!');
            $this->redirect_me($data["page_name"]);
            exit();
        }
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_coupon';
            $data["htmlPage"] = "edit_coupon";
            $data['categories'] = $this->db->get_where($data['subactor1'])->result();
            $data['products'] = $this->db->get_where($data['subactor2'])->result();
            $data['frequencies'] = $this->db->get_where($data['subactor3'])->result();
            $data['coupon'] = $this->db->get_where($data['actor'], $data['actor'] . "_id = $info")->first_row();
            $data['coupon_categories'] = $this->db->get_where("coupon_categories", $data['actor'] . "_id = $info")->result();
            $data['coupon_products'] = $this->db->get_where("coupon_products", $data['actor'] . "_id = $info")->result();
            $data['coupon_frequencies'] = $this->db->get_where("coupon_frequencies", $data['actor'] . "_id = $info")->result();
//            print_r($data);
//            echo $this->db->last_query();
//            exit();
//            $data["sub_data"] = $this->db->get_where($data['subactor1'])->result();

        }
        if ($page == "update") {
            $name = $this->input->post("name");
//            $name_ch = $this->input->post("name_ch");
            $categories = [];
            if (isset($_POST['product_category'])) {
                $categories = $this->input->post("product_category");
            }
            $products = [];
            if (isset($_POST['product'])) {
                $products = $this->input->post("product");
            }
            $frequencies = [];
            if (isset($_POST['frequency'])) {
                $frequencies = $this->input->post("frequency");
            }
            $discount_type = $this->input->post("discount_type");
            $discount = $this->input->post("discount");
            $qty = $this->input->post("qty");
            $end_date = $this->input->post("end_date");
            $end_time = $this->input->post("end_time");
            $start_date = $this->input->post("start_date");
            $start_time = $this->input->post("start_time");
            $type = $this->input->post("type");
            $isCategory = false;
            $c_type = $this->input->post("c_type");
            $code = $this->input->post("code");
            $password = $c_type == "Coupon" ? "" : $this->input->post("password");
            if ($type == "For Categories") {
                $isCategory = true;
            }
            $percent = 0;
            $amount = 0;
            if ($discount_type == "Percentage") {
                $percent = $discount;
            } else {
                $amount = $discount;
            }
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            // Dates
                $convDate = explode("-",$start_date);
                $mon = trim($convDate[0]);
                $day = trim($convDate[1]);
                $year = trim($convDate[2]);
                $convertedStartDate = $year . "-" . $mon . "-" . $day;
                
                $convDate = explode("-",$end_date);
                $mon = trim($convDate[0]);
                $day = trim($convDate[1]);
                $year = trim($convDate[2]);
                $convertedEndDate = $year . "-" . $mon . "-" . $day;
                
                $s_date = $convertedStartDate ." ". $start_time;
                $e_date = $convertedEndDate. " " .$end_time;
                // exit();
            // Dates End
            if (empty($e_date)) {
                $e_date = date('Y-m-d h:i:s');
            }
            if (empty($s_date)) {
                $s_date = date('Y-m-d h:i:s');
            }
            $resp = $this->db->update($data["actor"], ["password" => $password, "code" => $code, "c_type" => $c_type, "coupons_name" => $name, "discount_type" => $discount_type, "amount" => $amount, "percentage" => $percent, "coupon_qty" => $qty, "status" => $status, "start_time" => $s_date, "end_time" => $e_date, "coupon_condition" => $type], [$data['actor'] . "_id" => $info]);
//            echo $this->db->last_query();

            if ($resp) {
                $c_id = $info;
                $this->db->delete("coupon_frequencies", ["coupons_id" => $c_id]);
                $this->db->delete("coupon_products", ["coupons_id" => $c_id]);
                $this->db->delete("coupon_categories", ["coupons_id" => $c_id]);


                foreach ($frequencies as $frequency) {
                    $resp1 = $this->db->insert("coupon_frequencies", ["coupons_id" => $c_id, "coupon_frequency_id" => $frequency]);
                }
                if ($isCategory) {
                    foreach ($categories as $category) {
                        $resp1 = $this->db->insert("coupon_categories", ["coupons_id" => $c_id, "category_id" => $category]);
                    }
                } else {
                    foreach ($products as $product) {
                        $resp1 = $this->db->insert("coupon_products", ["coupons_id" => $c_id, "	product_id" => $product]);
                    }
                }
            }
//            $this->session->set_flashdata();
            $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            $this->redirect_me($data['page_name']);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Product Category';
            $data["htmlPage"] = "add_product_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->db->delete("coupon_frequencies", array($data["actor"] . "_id" => $info));
            $this->db->delete("coupon_products", array($data["actor"] . "_id" => $info));
            $this->db->delete("coupon_categories", array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        //        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE " . $data['actor'] . "_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
            }
            /*
            foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE " . $data['actor'] . "_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            exit();
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], [$data['actor'] . "_id" => $id]);

            echo "success";
            exit();
        }
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }

    public function manage_mass_discount($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('mass_discount');
        $data['page_sub_title'] = 'mass_discount';
        $data['actor'] = 'mass_discount';
        $data['subactor1'] = 'category';
        // $data['subactor2'] = 'product';
        // $data['subactor3'] = 'coupon_frequency';
//        $data['subactor4'] = 'product';
        $data['page_name'] = 'manage_mass_discount';
        $data['main_page_name'] = 'mass_discount';

        if (empty($page)) {
            $data["htmlPage"] = "manage_mass_discount";
            $resp = $this->db->get($data['actor']);
//            print_r($resp->result());
//            exit();
            $data["table_data"] = $resp->result();
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'add_mass_discount';
            $data["htmlPage"] = "add_mass_discount";
            $data['categories'] = $this->db->get_where($data['subactor1'])->result();
            // $data['products'] = $this->db->get_where($data['subactor2'])->result();
            // $data['frequencies'] = $this->db->get_where($data['subactor3'])->result();
//            $data['products'] = $this->db->get_where($data['subactor2'])->result();

        }
        if ($page == "save") {
//            print_r($_POST);
//            exit();
            $name = $this->input->post("name");
//            $name_ch = $this->input->post("name_ch");
            $categories = [];
            if (isset($_POST['product_category'])) {
                $categories = $this->input->post("product_category");
            }
            // $products = [];
            // if (isset($_POST['product'])) {
            //     $products = $this->input->post("product");
            // }
            // $frequencies = [];
            // if(isset($_POST['frequency'])) {
            //     $frequencies = $this->input->post("frequency");
            // }
            $discount_type = $this->input->post("discount_type");
            $discount = $this->input->post("discount");
            // $qty = $this->input->post("qty");
            $end_date = $this->input->post("end_date");
            $end_time = $this->input->post("end_time");
            $start_date = $this->input->post("start_date");
            $start_time = $this->input->post("start_time");
            $type = $this->input->post("type");
            // $c_type = $this->input->post("c_type");
            // $code = $this->input->post("code");
            // $password = $c_type == "Coupon"?"":$this->input->post("password");
            $isCategory = false;
            if ($type == "For Categories") {
                $isCategory = true;
            }
            $percent = 0;
            $amount = 0;
            if ($discount_type == "Percentage") {
                $percent = $discount;
            } else {
                $amount = $discount;
            }
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $s_date = date("Y-m-d h:i:s", strtotime($start_date . " " . $start_time . ":00"));
            $e_date = date("Y-m-d h:i:s", strtotime($end_date . " " . $end_time . ":00"));
            if (empty($e_date)) {
                $e_date = date('Y-m-d h:i:s');
            }
            if (empty($s_date)) {
                $s_date = date('Y-m-d h:i:s');
            }
            $resp = $this->db->insert($data["actor"], ["mass_discount_name" => $name, "discount_type" => $discount_type, "amount" => $amount, "percentage" => $percent, "status" => $status, "start_time" => $s_date, "end_time" => $e_date, "coupon_condition" => $type]);
            if ($resp) {
                $c_id = $this->db->insert_id();
                // foreach ($frequencies as $frequency){
                //     $resp1 = $this->db->insert("coupon_frequencies", ["coupons_id"=>$c_id,"coupon_frequency_id"=>$frequency]);
                // }
                if ($isCategory) {
                    foreach ($categories as $category) {
                        $resp1 = $this->db->insert("mass_discount_categories", ["mass_discount_id" => $c_id, "category_id" => $category]);
                    }
                } else {
                    // foreach ($products as $product){
                    //     $resp1 = $this->db->insert("coupon_products", ["coupons_id"=>$c_id,"	product_id"=>$product]);
                    // }
                }
            }
//            $this->session->set_flashdata();
            $this->session->set_flashdata('msg_success', 'Data Added Successfully!');
            $this->redirect_me($data["page_name"]);
            exit();
        }
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_mass_discount';
            $data["htmlPage"] = "edit_mass_discount";
            $data['categories'] = $this->db->get_where($data['subactor1'])->result();
            // $data['products'] = $this->db->get_where($data['subactor2'])->result();
            // $data['frequencies'] = $this->db->get_where($data['subactor3'])->result();
            $data['coupon'] = $this->db->get_where($data['actor'], $data['actor'] . "_id = $info")->first_row();
            $data['coupon_categories'] = $this->db->get_where("mass_discount_categories", $data['actor'] . "_id = $info")->result();
            // $data['coupon_products'] = $this->db->get_where("coupon_products",$data['actor'] . "_id = $info")->result();
            // $data['coupon_frequencies'] = $this->db->get_where("coupon_frequencies",$data['actor'] . "_id = $info")->result();
//            print_r($data);
//            echo $this->db->last_query();
//            exit();
//            $data["sub_data"] = $this->db->get_where($data['subactor1'])->result();

        }
        if ($page == "update") {
            // print_r($_POST);
            // exit;
            $name = $this->input->post("name");
//            $name_ch = $this->input->post("name_ch");
            $categories = [];
            if (isset($_POST['product_category'])) {
                $categories = $this->input->post("product_category");
            }
            // $products = [];
            // if (isset($_POST['product'])) {
            //     $products = $this->input->post("product");
            // }
            // $frequencies = [];
            // if(isset($_POST['frequency'])) {
            //     $frequencies = $this->input->post("frequency");
            // }
            $discount_type = $this->input->post("discount_type");
            $discount = $this->input->post("discount");
            // $qty = $this->input->post("qty");
            $end_date = $this->input->post("end_date");
            $end_time = $this->input->post("end_time");
            $start_date = $this->input->post("start_date");
            $start_time = $this->input->post("start_time");
            $type = $this->input->post("type");
            // $c_type = $this->input->post("c_type");
            // $code = $this->input->post("code");
            // $password = $c_type == "Coupon"?"":$this->input->post("password");
            $isCategory = false;
            if ($type == "For Categories") {
                $isCategory = true;
            }
            $percent = 0;
            $amount = 0;
            if ($discount_type == "Percentage") {
                $percent = $discount;
            } else {
                $amount = $discount;
            }
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            // echo strtotime($start_date . " " . $start_time . ":00") . "<br>";
            // echo strtotime($end_date . " " . $end_time . ":00") . "<br>";
            $s_date = date("Y-m-d", strtotime($start_date)) . " " . $start_time . ":00";
            $e_date = date("Y-m-d", strtotime($end_date)) . " " . $end_time . ":00";
            // print_r(["mass_discount_name" => $name, "discount_type" => $discount_type, "amount" => $amount, "percentage" => $percent, "status" => $status, "start_time" => $s_date, "end_time" => $e_date, "coupon_condition" => $type]);
            // exit;
            if (empty($e_date)) {
                $e_date = date('Y-m-d h:i:s');
            }
            if (empty($s_date)) {
                $s_date = date('Y-m-d h:i:s');
            }
            $resp = $this->db->update($data["actor"], ["mass_discount_name" => $name, "discount_type" => $discount_type, "amount" => $amount, "percentage" => $percent, "status" => $status, "start_time" => $s_date, "end_time" => $e_date, "coupon_condition" => $type], [$data['actor'] . "_id" => $info]);
//            echo $this->db->last_query();

            if ($resp) {
                $c_id = $info;
                // $this->db->delete("coupon_frequencies",["coupons_id"=>$c_id]);
                // $this->db->delete("coupon_products",["coupons_id"=>$c_id]);
                $this->db->delete("mass_discount_categories", ["mass_discount_id" => $c_id]);


                // foreach ($frequencies as $frequency){
                //     $resp1 = $this->db->insert("coupon_frequencies", ["coupons_id"=>$c_id,"coupon_frequency_id"=>$frequency]);
                // }
                if ($isCategory) {
                    foreach ($categories as $category) {
                        $resp1 = $this->db->insert("mass_discount_categories", ["mass_discount_id" => $c_id, "category_id" => $category]);
                    }
                } else {
                    // foreach ($products as $product){
                    //     $resp1 = $this->db->insert("coupon_products", ["coupons_id"=>$c_id,"	product_id"=>$product]);
                    // }
                }
            }
//            $this->session->set_flashdata();
            $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            $this->redirect_me($data['page_name']);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Product Category';
            $data["htmlPage"] = "add_product_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            // $this->db->delete("coupon_frequencies", array($data["actor"] . "_id" => $info));
            // $this->db->delete("coupon_products", array($data["actor"] . "_id" => $info));
            $this->db->delete("mass_discount_categories", array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        //        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE " . $data['actor'] . "_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
            }
            /*
            foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE " . $data['actor'] . "_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            exit();
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["status" => $status], [$data['actor'] . "_id" => $id]);

            echo "success";
            exit();
        }
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }

    public function manage_order($page = NULL, $info = NULL)
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['page_title'] = get_phrase('orders');
        $data['page_sub_title'] = 'orders';
        $data['actor'] = 'order';
        $data['subactor1'] = 'user';
        $data['subactor2'] = 'user_address';
        $data['page_name'] = 'manage_order';
        $data['main_page_name'] = 'order';

        if (empty($page)) {
            // $data["htmlPage"] = "manage_order";
            // $condition = '';
            // if (isset($_REQUEST['user_id'])) {
            //     $user_id = $_REQUEST['user_id'];
            //     $condition = "Where o.users_system_id = $user_id";
            // }
            // $resp = $this->db->query("select * from `order` o left join users_system u on u.users_system_id = o.users_system_id left join user_address ua on ua.address_id = o.address_id $condition Order by order_id desc Limit 200");
            // foreach ($resp->result() as $order) {
            //  $orderIds[] = $order->order_id;
            // }
            // $in = implode(",", $orderIds);
            // $orderProducts = [];
            // $productIds = [];
            // $pin = '';
            // if(!empty($in)){
            //     $products = $this->db->query("select * from order_products op left join product p on p.product_id = op.product_id where op.order_id IN (" . $in . ")" )->result();
            //     foreach($products as $p){
            //         $orderProducts[$p->order_id][$p->product_id] = $p;
            //         $productIds[] = $p->product_id;
            //     }
            //     $pin =  implode(",", $productIds);
            // }
            // $productAttributes = [];
            // if(!empty($pin)){
            //     $attributes = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on opa.product_attribute_id = pa.product_attribute_id where opa.product_id IN (" . $pin . ") And opa.order_id IN (" . $in . ")")->result();
            //     foreach($attributes as $attr){
            //         $productAttributes[$attr->order_id][$attr->product_id][] = $attr;
            //     }
            // }
            // $orders = array();
            // foreach ($resp->result() as $order) {
            //     $products = $orderProducts[$order->order_id];
            //     $_prods = [];
            //     foreach($products as $product){
            //         // echo $product->product_id;
            //         $product->attributes = isset($productAttributes[$order->order_id][$product->product_id])?$productAttributes[$order->order_id][$product->product_id]:[];
            //             //  = $productAttributes[$order->order_id][$product->product_id];
            //         $_prods[] = $product;
            //     }
            //     $order->products = $_prods;
            //     $orders[] = $order;
            
            // }
            // echo "<pre>";
            // print_r($orders);

            // $data["table_dat a"] = $orders;
              $data["htmlPage"] = "manage_order";
            $condition = '';
            if (isset($_REQUEST['user_id'])) {
                $user_id = $_REQUEST['user_id'];
                $condition = "Where o.users_system_id = $user_id";
            }
            $resp = $this->db->query("select *,o.created_at from `order` o left join users_system u on u.users_system_id = o.users_system_id left join user_address ua on ua.address_id = o.address_id $condition Order by order_id desc Limit 200");
            $orders = array();
            foreach ($resp->result() as $order) {
                $products = $this->db->query("select * from order_products op left join product p on p.product_id = op.product_id where op.order_id = " . $order->order_id)->result();
                $prods = [];
                foreach ($products as $product) {
                    $product->attributes = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on opa.product_attribute_id = pa.product_attribute_id where opa.order_product_id = " . $product->order_products_id . " And opa.order_id = " . $order->order_id)->result();
                    $prods[] = $product;
                }
                $order->products = $prods;
                $orders[] = $order;
            }
//           echo "<pre>";
//           print_r($orders);

            $data["table_data"] = $orders;
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'add_product_attribute';
            $data["htmlPage"] = "add_product_attribute";
            $data['sub_data'] = $this->db->get_where($data['subactor1'])->result();
        }
        if ($page == "save") {
//            print_r($_POST);
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $category = $this->input->post("category");
            $o_price = $this->input->post("or_price");
            $c_price = $this->input->post("cur_price");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["product_attribute_title" => $name_en, "product_attribute_title_en" => $name_en, "product_attribute_title_ch" => $name_ch, "status" => $status, "product_category_id" => $category, "original_price" => $o_price, "current_price" => $c_price]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data["page_name"]);
            exit();

        }
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_product_attribute';
            $data["htmlPage"] = "edit_product_attribute";
            $data['category'] = $this->Db_model->join2Tables($data['actor'], $data['subactor1'], $data['actor'] . "_id = $info")->first_row();
//            echo $this->db->last_query();
//            exit();
            $data["sub_data"] = $this->db->get_where($data['subactor1'])->result();
        }
        if ($page == "update") {
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $category = $this->input->post("category");
            $o_price = $this->input->post("or_price");
            $c_price = $this->input->post("cur_price");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->update($data["actor"], ["product_attribute_title" => $name_en, "product_attribute_title_en" => $name_en, "product_attribute_title_ch" => $name_ch, "status" => $status, "product_category_id" => $category, "original_price" => $o_price, "current_price" => $c_price], [$data['actor'] . "_id" => $info]);
            if ($resp) {
                $this->session->set_flashdata('msg_success', 'Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            $this->redirect_me($data['page_name']);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Product Category';
            $data["htmlPage"] = "add_product_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->db->delete("order_products", array($data["actor"] . "_id" => $info));
            $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');

            $this->redirect_me($data["page_name"]);
        }
        if ($page == "search") {
            $data["htmlPage"] = "manage_order";
            $condition = '';
            if (isset($_REQUEST['user_id'])) {
                $user_id = $_REQUEST['user_id'];
                $condition = "Where o.users_system_id = $user_id";
            }
            if (isset($_REQUEST['order_no'])) {
                if(!empty($_REQUEST['order_no'])){
                    $order_no = $_REQUEST['order_no'];
                    if(empty($condition)){
                        $condition .= "Where ";
                    }else{
                         $condition .= " And ";
                    }
                    $condition .= " o.order_id = $order_no";
                }
            }
             if (isset($_REQUEST['search_status'])) {
                if(!empty($_REQUEST['search_status'])){
                    $search_status = $_REQUEST['search_status'];
                    if(empty($condition)){
                        $condition .= "Where ";
                    }else{
                         $condition .= " And ";
                    }
                    $condition .= " o.order_status = '$search_status'";
                }
            }
            $resp = $this->db->query("select * from `order` o left join users_system u on u.users_system_id = o.users_system_id left join user_address ua on ua.address_id = o.address_id $condition Order by order_id desc Limit 500");
            $orders = array();
            foreach ($resp->result() as $order) {
                $products = $this->db->query("select * from order_products op left join product p on p.product_id = op.product_id where op.order_id = " . $order->order_id)->result();
                $prods = [];
                foreach ($products as $product) {
                    $product->attributes = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on opa.product_attribute_id = pa.product_attribute_id where opa.product_id = " . $product->product_id . " And opa.order_id = " . $order->order_id)->result();
                    $prods[] = $product;
                }
                $order->products = $prods;
                $orders[] = $order;
            }
//           echo "<pre>";
//           print_r($orders);

            $data["table_data"] = $orders;
        }
        //        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            $counter = 0;
            for ($j = 0; $j < $i; $j++) {
                $counter++;
                $sql = "Update " . $data['actor'] . " SET position_order=" . $counter . " WHERE " . $data['actor'] . "_id=" . $position[$j] . " ORDER BY position_order asc";
                $this->db->query($sql);
            }
            /*
            foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE " . $data['actor'] . "_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            } */
            exit();
        }
        if ($page == 'update_status') {
            $status = $_POST["status"];
            $id = $_POST["id"];
            $this->db->update($data["actor"], ["order_status" => $status], [$data['actor'] . "_id" => $id]);

            echo "success";
            exit();
        }
//        echo "here";
        if ($page == 'get_order_products') {
//            $status = $_POST["status"];
            $id = $_POST["id"];
            $response = $this->db->query("select * from order_products op left join product p on op.product_id = p.product_id where op.order_id = $id");
            $attr = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on opa.product_attribute_id = pa.product_attribute_id where opa.order_id = $id")->result();
            $products = [];
            foreach ($response->result() as $product) {
                $attribute = [];
                for ($i = 0; $i < count($attr); $i++) {
                    if ($product->product_id == $attr[$i]->product_id) {
                        $attribute[] = $attr[$i];
                    }
                }
                $product->attributes = $attribute;
                $products[] = $product;
            }
            $res = [];
            if ($response) {
                $res["result"] = $products;
                $res['res_status'] = 1;
            } else {
                $res['res_status'] = 0;
            }
            echo json_encode($res);
            exit();
        }
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);

    }

    /**** manage roles *****/
    public function manage_roles($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }

        if ($param1 == 'edit') {
            $updateData['confirmation_number'] = $this->input->post('confirmation_number');
            $this->db->where('users_system_id', $param2);
            $result = $this->db->update('users_system', $updateData);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Govt Number Assigned Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . strtolower($this->session->userdata('directory')) . '/customer_list', 'refresh');
        }

        if ($param1 == 'delete') {
            $result = $this->Db_model->delete_data('user_roles', $param2);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Role Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . strtolower($this->session->userdata('directory')) . '/customer_list', 'refresh');
        }
        $data['user_roles'] = $this->db->get('user_roles')->result_array();
        $data['page_title'] = get_phrase('manage_roles');
        $data['page_sub_title'] = get_phrase('manage_roles');
        $data['page_name'] = 'manage_roles';
        $data['actor'] = 'manage_roles';
        $data['main_page_name'] = 'manage_roles';
        $data["htmlPage"] = "manage_roles";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    // Manage SUGGESTED PRODUCT

    /**** manage roles *****/
    /**** manage permission ****/
    public function manage_permissions($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data_per['account_setting'] = $this->check_value($this->input->post('account_setting'));
            $data_per['system_setting'] = $this->check_value($this->input->post('system_setting'));
            $data_per['dashboard'] = $this->check_value($this->input->post('dashboard'));
            $data_per['manage_pages'] = $this->check_value($this->input->post('manage_pages'));
            $data_per['manage_news'] = $this->check_value($this->input->post('manage_news'));
            $data_per['manage_campus_life'] = $this->check_value($this->input->post('manage_campus_life'));
            $data_per['manage_department'] = $this->check_value($this->input->post('manage_department'));
            $data_per['manage_news_letter'] = $this->check_value($this->input->post('manage_news_letter'));
            $data_per['manage_general_setting'] = $this->check_value($this->input->post('manage_general_setting'));
            $this->db->where('user_roles_id', $param2);
            $result = $this->db->update('user_privileges', $data_per);

            if ($result == 'success') {
                $this->session->set_flashdata('msg_success', 'Permissions Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'oops!Permissions not updated! try again.');
            }
            redirect(base_url() . 'admin/manage_roles/', 'refresh');
        }
        $data['param1'] = $param1;
        $data['roles'] = $this->db->get_where('user_roles', array('user_roles_id' => $param1))->result_array();
        $data['page_title'] = get_phrase('manage_permissions');
        $data['page_sub_title'] = '';
        $data['page_name'] = 'manage_permissions';
        $data['main_page_name'] = 'manage_permissions';
        
        $data['htmlPage'] = 'edit_roles';
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    public function ajax_calls($param1 = '', $param2 = '')
    {
        $response = [];
        if ($param1 == "get_user_addresses") {
            $id = $_REQUEST['id'];
            $addresses = $this->db->get_where("user_address", ["user_id" => $id]);
            if ($addresses) {
                $response["status"] = 1;
                $response["result"] = $addresses->result();
            } else {
                $response["status"] = 0;
            }
            echo json_encode($response);
        }
    }

    function check_value($check_box_value)
    {
        if ($check_box_value == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    /**** manage permission ****/
    public function replace_underscore($string)
    {
        $replaced = str_replace(' ', '_', $string);
        return $replaced;
    }

    public function check_null($param)
    {
        if ($param) {
            return $param;
        } else {
            return '0';
        }
    }

    public function getSortNumber($table)
    {
        $count = $this->db->get($table)->num_rows();
        $count = $count + 1;
        return $count;
    }

    public function redirect_me($path, $controller = "admin")
    {
        echo "<script>location.href = '" . base_url() . $controller . "/" . $path . "'; </script>";
//        redirect(strtolower($this->session->userdata('directory')) . '/' . $controller . "/".$path);
    }
}