<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
    public function __construct() {
        parent::__construct();      
        include APPPATH . 'third_party/stripe-php-3.20.0/vendor/autoload.php';
    }

	/***** ADMIN INDEX *********/
	public function index(){
		
		$this->load->view('admin/stripe');
	}
	
	public function stripe(){
	    if(!empty($_POST['user_id'])){
	        $user_id = $_POST['user_id'];
	        $this->db->where('user_accounts_id',$user_id);
	        $this->db->delete('payment');
    	    
	    }else{ 
	    
	        $save_data['name']              = $_POST['user_name'];
    	    $save_data['email']             = $_POST['user_email'];
    	    $save_data['phone_number']      = $_POST['user_contact'];
    	    $save_data['user_organization'] = $_POST['user_organization'];
    	    $save_data['password']          = $_POST['user_password'];
    	    $save_data['user_website']      = $_POST['user_website'];
    	    $save_data['user_roles_id']     = 2;
    	    $save_data['status']            = 'Inactive';
    	    $this->db->insert('user_accounts',$save_data);
    	    $user_id = $this->db->insert_id();
	    }
	    $save_payment['user_accounts_id']      = $user_id;
	    $save_payment['amount']                = $_POST['user_package_amount'];
	    if($_POST['user_package_amount'] ==15){
	        $save_payment['plan']      = 'Plan A';
	    }else{
	        $save_payment['plan']      = 'Plan B';
	    }
	    $save_payment['currency']              = 'USD';
	    $save_payment['date_added']            = date('Y-m-d');
	    $save_payment['status']                = 'Pending';
	    $this->db->insert('payment',$save_payment);
	    $payment_id = $this->db->insert_id();
	    if($_POST['user_package_amount'] == 0){
	        $update_payment['status'] = 'Completed';
		    $this->db->where('payment_id',$payment_id);
		    $this->db->update('payment',$update_payment);
            
            $update_user['status'] = 'Active';
		    $this->db->where('user_accounts_id',$user_id);
		    $this->db->update('user_accounts',$update_user);
		    
		    $result = $this->db->get_where('user_accounts',array('user_accounts_id'=>$user_id))->row();
		    $this->session->set_userdata('user_name',$result->name);
			$this->session->set_userdata('users_id',$result->user_accounts_id);
			$this->session->set_userdata('users_email',$result->email);
			$this->session->set_userdata('user_roles_id',$result->user_roles_id);
			$this->session->set_userdata('directory','admin');
			$this->session->set_userdata('login',1);
			$this->session->set_flashdata('msg_success', 'Login Successfully.');
			redirect(base_url().'admin/dashboard', 'refresh');
	    }
		$secret_key 	 = 'sk_test_5rLlHDednjEwQAcFaUkwKBPI';
		$publishable_key = 'pk_test_svizLm1vuVgGkLJYoJiBGvts';
			$stripe = array(
			  "secret_key"      =>  $secret_key,
			  "publishable_key" =>  $publishable_key
			);

		\Stripe\Stripe::setApiKey($stripe['secret_key']);

		$name       = $_POST['name'];
		$token  	= $_POST['stripeToken'];
		$email  	= $_POST['email'];
		
		$customer = \Stripe\Customer::create([
			'email' => $email,
			'source'  => $token
		]);
		$customer_id = $customer->id;
		
		$pkg_fee  	  = $_POST['user_package_amount'];
		$currency     = 'USD';
		$charge = \Stripe\Charge::create(array( 
			'customer' => $customer_id, 
			'amount'   => $pkg_fee *100, 
			'currency' => $currency, 
			'description' => $name, 
			'metadata' => array( 
				'order_id' => $payment_id 
			) 
		)); 
	    $chargeJson = $charge->jsonSerialize(); 
		if($chargeJson){
			if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 
                        // Transaction details  
                        
                        $transactionID = $chargeJson['balance_transaction']; 
                        $paidAmount = $chargeJson['amount']; 
                        $paidCurrency = $chargeJson['currency']; 
                        $payment_status = $chargeJson['status']; 
						if($payment_status == 'succeeded'){ 
						    $update_payment['status'] = 'Completed';
						    $this->db->where('payment_id',$payment_id);
						    $this->db->update('payment',$update_payment);
                            
                            $update_user['status'] = 'Active';
						    $this->db->where('user_accounts_id',$user_id);
						    $this->db->update('user_accounts',$update_user);
                                
                                
                            $result = $this->db->get_where('user_accounts',array('user_accounts_id'=>$user_id))->row();
            				// $message = "<b>Dear ".$user_name." </b><br> The link for change your password is down here. <br> <b>Please Note:<b> This link will be valid only for 1 time,<br> after that this link will be expire. <br> <a href='".$recovery_link."' target='_blank'> Reset Password </a> ";
            				$user_email = $result->email;
            				$get_template = $this->db->get_where('email_templates', array('type'=>'register_email'))->row();
            				$sub = $get_template->subject;
            				$message = $get_template->body;
            				$message = str_replace("{user_name}",$result->name , $message);
            				$message = str_replace("{user_email}", $user_email , $message);
            				$mail_response = $this->Email_model->do_email($message, $sub, $user_email);
            				
            				$get_template = $this->db->get_where('email_templates', array('type'=>'payment_email'))->row();
            				$sub = $get_template->subject;
            				$message = $get_template->body;
            				$message = str_replace("{user_name}",$result->name , $message);
            				$message = str_replace("{user_email}",$user_email , $message);
            				$message = str_replace("{user_plan}",$save_payment['amount'] , $message);
            				$message = str_replace("{plan_cost}",$save_payment['plan'] , $message);
            				$message = str_replace("{date}",$save_payment['date_added'] , $message);
            				
            				
            				$mail_response = $this->Email_model->do_email($message, $sub, $user_email);
                                
                                
						    
                		    $this->session->set_userdata('user_name',$result->name);
                			$this->session->set_userdata('users_id',$result->user_accounts_id);
                			$this->session->set_userdata('users_email',$result->email);
                			$this->session->set_userdata('user_roles_id',$result->user_roles_id);
                			$this->session->set_userdata('directory','admin');
                			$this->session->set_userdata('login',1);
                			$this->session->set_flashdata('msg_success', 'Login Successfully.');
                			redirect(base_url().'admin/dashboard', 'refresh');
						//	$this->sucessPayment($payment_id); 
						}else{
							$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
							redirect(base_url(). 'admin/signup', 'refresh');
						} 
			}
			
		}
		exit;
	}
	
}