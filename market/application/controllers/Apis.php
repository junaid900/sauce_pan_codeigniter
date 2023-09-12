<?php
defined('BASEPATH') or exit('No direct script access allowed');

//use Restserver\Libraries\REST_Controller;
use CodeIgniter\HTTP\RequestInterface;

class Apis extends CI_Controller
{

    public $language = "ch";

    public function __construct()
    {
        parent::__construct();
        error_reporting(-1);
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, *');      //  echo json_encode($_SERVER);

        if (!isset($this->input->request_headers()['Apikey'])) {
            $this->response(0, "Unauthorized access", []);
        }
        if ($this->input->request_headers()['Apikey'] != apikey()) {
            $this->response(0, "Unauthorized access", []);
        }
        $this->output->set_header('Authorization : APIKEY ' . apikey() . '');
        $this->output->set_header('Content-Type : application/json; charset=UTF-8');
        $postdata = file_get_contents("php://input");
        // echo $postdata
        if (isset($postdata)) {
            if (!empty($postdata)) {
                $post_data = json_decode($postdata, true);
                //  print_r($post_data);
                $_REQUEST = $post_data;
//                  print_r($_REQUEST);
            }
        }
        if($_REQUEST == null){
            $_REQUEST = [];
        }
        if(count($_POST) > 0){
            // array_push($_REQUEST,$_POST);
            foreach($_POST as $k => $v){
                $_REQUEST[$k] = $v;
            }
        }

        if(count($_GET) > 0){
            foreach($_GET as $k => $v){
                $_REQUEST[$k] = $v;
            }
        }
        // print_r($_POST);
        // print_r($_GET);
        // print_r($_REQUEST);
        if (isset($_POST["lang"])) {
            $this->language = $_POST["lang"];
        }
        if (isset($_GET["lang"])) {
            $this->language = $_GET["lang"];
        }
        if (isset($_REQUEST["lang"])) {
            $this->language = $_REQUEST["lang"];
        }
        
    }

    public function index()
    {
        echo "<h1>Invalid Access</h1>";
    }


    public function sign_in()
    {
        // print_r($_REQUEST);
        if (!isset($_REQUEST['email']) || !isset($_REQUEST['password'])) {
            $this->response(0, "missing params", []);
        }
        if(!isset($_REQUEST['date_time'])){
            $this->response(0, "missing params", []);
        }
        $email = $_REQUEST['email'];
        $password = md5($_REQUEST["password"]);
        $date = $_REQUEST['date_time'];
        $tokenId = generateToken();
        $sessionId = generateSession();
        $user = $this->db->get_where("users_system", ["email" => $email, "password" => $password]);
        if (!$user) {
            $this->response(0, "unable to get response", []);
        }
        $data = $user->result();
        if (count($data) != 1) {
            $this->response(0, "invalid credentials", []);
        }
        $userData = $user->first_row();
        $date = date("Y-m-d h:i:s", strtotime($date . ' +2 day'));
        $this->db->update("users_system", ["session_id" => $sessionId, "token_id" => $tokenId, "token_expiry" => $date], ["users_system_id" => $userData->users_system_id]);
        $userData->session_id = $sessionId;
        $userData->token_id = $tokenId;
        $userData->token_expiry = $date;
        $this->response(1, "successfully loggedIn", $userData);
    }
    
    public function sign_up_with_check()
    {
        // print_r($_REQUEST);
        if (!isset($_REQUEST['email']) || !isset($_REQUEST['tel_number']) || !isset($_REQUEST['open_id'])) {
            $this->response(0, "missing params", []);
        }
        // if(!isset($_REQUEST['date_time'])){
        //     $this->response(0, "missing params", []);
        // }
        $email = $_REQUEST['email'];
        $tel_number = $_REQUEST["tel_number"];
        $open_id = $_REQUEST["open_id"];
        // $date = $_REQUEST['date_time'];
        $tokenId = generateToken();
        $sessionId = generateSession();
        $user = $this->db->get_where("users_system", ["email" => $email, "mobile" => $tel_number,"c_open_id"=>$open_id]);
        if (!$user) {
            $this->response(0, "unable to get response", []);
        }
        $userData = $user->result();
        if(count($userData) > 0){
             $this->response(1, "user already exists", []);
        }
        $userSystem = $this->db->get_where("users_backup", ["email" => $email, "mobile" => $tel_number,"c_open_id"=>$open_id]);
        if(!$userSystem){
            $this->response(1, "unable to get response", []);
        }
        $userSystemData = $userSystem->first_row();
        if (count($userSystemData) < 1) {
            $this->response(0, "no user found", []);
        }
       // $userData = $user->first_row();
       $this->db->insert("users_system",["first_name"=>$userSystemData->first_name,"last_name"=>$userSystemData->last_name,"users_system_id"=>$userSystemData->users_system_id ,"c_open_id"=>$open_id,"email"=>$email,"mobile"=>$tel_number,"sp_points"=>$userSystemData->sp_points]);
        $date = date("Y-m-d h:i:s", strtotime(date('Y-m-d h:i:s') . ' +2 day'));
        $this->db->update("users_system", ["session_id" => $sessionId, "token_id" => $tokenId, "token_expiry" => $date], ["users_system_id" => $userSystemData->users_system_id]);
        $userSystemData->session_id = $sessionId;
        $userSystemData->token_id = $tokenId;
        $userSystemData->token_expiry = $date;
        $this->response(1, "successfully loggedIn", $userSystemData);
    }



    public function sign_in_with_open_id()
    {
        // print_r($_REQUEST);
        if (!isset($_REQUEST['open_id'])) {
            $this->response(0, "missing params", []);
        }
        if(!isset($_REQUEST['date_time'])){
            $this->response(0, "missing params", []);
        }
        $email = $_REQUEST['open_id'];
        $tokenId = generateToken();
        $sessionId = generateSession();
        $date = $_REQUEST['date_time'];
        $user = $this->db->get_where("users_system", ["c_open_id" => $email]);
        if (!$user) {
            $this->response(0, "unable to get response", []);
        }
        $data = $user->result();
        if (count($data) != 1) {
            $this->response(0, "invalid credentials", []);
        }
        $userData = $user->first_row();
        $date = date("Y-m-d h:i:s", strtotime($date . ' +2 day'));
        $this->db->update("users_system", ["session_id" => $sessionId, "token_id" => $tokenId, "token_expiry" => $date], ["users_system_id" => $userData->users_system_id]);
        $userData->session_id = $sessionId;
        $userData->token_id = $tokenId;
        $userData->token_expiry = $date;
        $this->response(1, "successfully loggedIn", $userData);
    }

    public function sign_up()
    {
        // print_r($_REQUEST);
        if (!isset($_REQUEST['email']) || !isset($_REQUEST['password']) || !isset($_REQUEST["first_name"]) || !isset($_REQUEST["last_name"])) {
            $this->response(0, "missing params", []);
        }
        $email = $_REQUEST['email'];
        $checkUser = $this->db->get_where("users_system", ["email" => $email]);
        if ($checkUser) {
            if (count($checkUser->result()) > 0) {
                $this->response(0, "this email is already in use", []);
            }
        }
        $first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $password = md5($_REQUEST["password"]);
        $userArray = ["email" => $email, "password" => $password, "first_name" => $first_name, "last_name" => $last_name];
        if (isset($_REQUEST["loyalty_points"])) {
            $userArray["c_loyalty_points"] = $_REQUEST["loyalty_points"];
        }
        if (isset($_REQUEST["mobile"])) {
            $userArray["mobile"] = $_REQUEST["mobile"];
        }
        if (isset($_REQUEST["thumbnail"])) {
            $userArray["c_thumb"] = $_REQUEST["thumbnail"];
        }

        $tokenId = generateToken();
        $sessionId = generateSession();
        $userArray["session_id"] = $sessionId;
        $userArray["token_id"] = $tokenId;
        $userArray["users_roles_id"] = 3;

        $user = $this->db->insert("users_system", $userArray);
        if (!$user) {
            $this->response(0, "unable to get response", []);
        }
        $userId = $this->db->insert_id();
        $user = $this->db->get_where("users_system", ["users_system_id" => $userId])->first_row();
//        $data = $user->result();
//        if (count($user) != 1) {
//            $this->response(0, "invalid credentials", []);
//        }
        $this->response(1, "successfully loggedIn", $user);
    }

    public function sign_up_with_open_id()
    {
        // print_r($_REQUEST);
        if (!isset($_REQUEST['open_id']) || !isset($_REQUEST["first_name"]) || !isset($_REQUEST["last_name"])) {
            $this->response(0, "missing params", []);
        }
        $email = $_REQUEST['open_id'];
        $checkUser = $this->db->get_where("users_system", ["c_open_id" => $email]);
        if ($checkUser) {
            if (count($checkUser->result()) > 0) {
                $this->response(0, "this email is already in use", []);
            }
        }
        $first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $password = md5("#@@!(@(#**(MJCOD__ER????A<XA<><<<>sa3829?___ GENRATED PASSWOERD:????___");
        $userArray = ["c_open_id" => $email, "password" => $password, "first_name" => $first_name, "last_name" => $last_name];
        if (isset($_REQUEST["loyalty_points"])) {
            $userArray["c_loyalty_points"] = $_REQUEST["loyalty_points"];
        }
        if (isset($_REQUEST["mobile"])) {
            $userArray["mobile"] = $_REQUEST["mobile"];
        }
        if (isset($_REQUEST["thumbnail"])) {
            $userArray["c_thumb"] = $_REQUEST["c_thumb"];
        }

        $tokenId = generateToken();
        $sessionId = generateSession();
        $userArray["session_id"] = $sessionId;
        $userArray["token_id"] = $tokenId;
        $userArray["users_roles_id"] = 3;

        $user = $this->db->insert("users_system", $userArray);
        if (!$user) {
            $this->response(0, "unable to get response", []);
        }
        $userId = $this->db->insert_id();
        $user = $this->db->get_where("users_system", ["users_system_id" => $userId])->first_row();
//        $data = $user->result();
//        if (count($user) != 1) {
//            $this->response(0, "invalid credentials", []);
//        }
        $this->response(1, "successfully loggedIn", $user);
    }

    public function update_profile()
    {
        $array = array();
        if (!isset($_REQUEST["user_id"])) {
            $this->response(0, "missing params", []);
        }
        if (isset($_REQUEST['first_name'])) {
            $array["first_name"] = $_REQUEST['first_name'];
        }
        if (isset($_REQUEST['last_name'])) {
            $array["last_name"] = $_REQUEST['last_name'];
        }
        if (isset($_REQUEST['first_name_en'])) {
            $array["first_name_en"] = $_REQUEST['first_name_en'];
        }
        if (isset($_REQUEST['last_name_en'])) {
            $array["last_name_en"] = $_REQUEST['last_name_en'];
        }
        if (isset($_REQUEST['first_name_ch'])) {
            $array["first_name_ch"] = $_REQUEST['first_name_ch'];
        }
        if (isset($_REQUEST['last_name_ch'])) {
            $array["last_name_ch"] = $_REQUEST['last_name_ch'];
        }
        if (isset($_REQUEST['address'])) {
            $array["address"] = $_REQUEST['address'];
        }
        if (isset($_REQUEST['city'])) {
            $array["city"] = $_REQUEST['city'];
        }
        if (isset($_REQUEST['mobile'])) {
            $array["mobile"] = $_REQUEST['mobile'];
        }
        if (isset($_REQUEST['c_open_id'])) {
            $array["c_open_id"] = $_REQUEST['c_open_id'];
        }
         if (isset($_REQUEST['date_of_birth'])) {
            $array["date_of_birth"] = $_REQUEST['date_of_birth'];
        }
         if (isset($_REQUEST['registration_date'])) {
            $array["register_date"] = $_REQUEST['registration_date'];
        }
        if (isset($_REQUEST['c_gender'])) {
            if ($_REQUEST['c_gender'] == "Male" || $_REQUEST['c_gender'] == "Female" || $_REQUEST['c_gender'] == "Other") {
                $array["c_gender"] = $_REQUEST['c_gender'];
            }
        }

        if (isset($_REQUEST['c_loyalty_points'])) {
            $array["sp_points"] = $_REQUEST['c_loyalty_points'];
            
        }
        if (isset($_REQUEST['c_company_name'])) {
            $array["c_company_name"] = $_REQUEST['c_company_name'];
        }
        if (isset($_REQUEST['c_company_name_en'])) {
            $array["c_company_name_en"] = $_REQUEST['c_company_name_en'];
        }
        if (isset($_REQUEST['c_company_name_ch'])) {
            $array["c_company_name_ch"] = $_REQUEST['c_company_name_ch'];
        }
        if (isset($_REQUEST['c_thumb'])) {
            $array["c_thumb"] = $_REQUEST['c_thumb'];
        }
        if (isset($_REQUEST['status'])) {
            $array["status"] = $_REQUEST['status'];
        }
        if (isset($_REQUEST['password'])) {
            $array["password"] = md5($_REQUEST['password']);
        }
        if (isset($_REQUEST['email'])) {
            $array["email"] = $_REQUEST['email'];
        }
        $user_id = $_REQUEST["user_id"];
        $res = $this->db->update("users_system", $array, ["users_system_id" => $user_id]);
        if ($res) {
            $respo = $this->db->get_where("users_system", ["users_system_id" => $user_id])->first_row();
            $this->response(1, "Successfully updated", $respo);

        } else {
            $this->response(0, "Failed updated", []);
        }
    }

    public function get_profile()
    {
        if (!isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $user = $_REQUEST['user_id'];
//        $userRes = $this->db->get_where("users_system",["users_system_id"=>$user])->first_row();
        $userAddressData = $this->get_user_addesses($user);
//        $userRes->addresses = $userAddressData;
        $this->response(1, "Success", $userAddressData);

    }

    public function get_main_categories()
    {
        $this->checkToken();

        $this->db->select("*,category.category_title_" . $this->language . " as lang_title");
        $this->db->from("category");
        $this->db->order_by("category.position_order","ASC");
        $response = $this->db->get()->result();
        //  $this->res["response"] = $response
        if ($response) {
            $this->response(1, "Successfully Loaded Categories", $response);
        } else {
            $this->response(0, "Cannot Load Categories", $response);
        }
    }
    
    public function add_discount_to_cart()
    {
        $this->checkToken();
        if (!isset($_REQUEST['discount_amt'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $user = $_REQUEST['user_id'];
        $discount_amt = $_REQUEST['discount_amt'];
        $cart = $this->db->get_where("cart", ["user_id" => $user]);
        $cartResult = $cart ? $cart->first_row() : [];
        if (count($cartResult) < 1) {
            $this->response(0, "Cart doesn't exist");
        }
        $this->hlp_update_cart_totals($cartResult->sub_total, $cartResult->cart_id, $discount_amt);
        $data = $this->get_current_cart($cartResult->cart_id);
        $this->response(1, "Successfully added discount", $data);
    }
    
    public function get_product_categories()
    {
        $this->checkToken();

        $data = $this->db->query("select pc.*, pc.product_category_title_" . $this->language . " as lang_product_category_title,c.category_title_" . $this->language . " as lang_category_title,c.category_title_en , c.category_title_ch  from product_category pc left join category c on c.category_id = pc.category_id  order by product_category_id desc limit 300 ")->result();

        if ($data) {
            $this->response(1, "Successfully Loaded Product Categories", $data);
        } else {
            $this->response(0, "Cannot Load Product Categories", []);
        }
    }
     public function get_additional_product()
    {
        $this->checkToken();

        $data = $this->db->query("select * from additional_product where status = 'Online'")->result();

        if ($data) {
            $this->response(1, "Successfully Loaded Product Categories", $data);
        } else {
            $this->response(0, "Cannot Load Product Categories", []);
        }
    }

    public function get_category_attributes()
    {
        $this->checkToken();
        $category = $this->db->query("select *, product_category_title_" . $this->language . " as lang_attribute_title from product_category order by product_category_id ASC ")->result();
        if (!$category) {
            $this->response(0, "Cannot Load Product Categories", []);
        }

        $attributes = $this->db->query("select *, product_attribute_title_" . $this->language . " as lang_category_title from product_attribute order by position_order ASC ")->result();
        if (!$attributes) {
            $this->response(0, "Cannot Load Attributes", []);
        }
        $categoryArray = [];
        foreach ($category as $c) {
            $id = $c->product_category_id;
            $attArray = array();
            for ($i = 0; $i < count($attributes); $i++) {
                if ($id == $attributes[$i]->product_category_id) {
                    $attArray[] = $attributes[$i];
                }
            }
            $c->attributes = $attArray;
//            $c->attributes = $data;
            $categoryArray[] = $c;
        }
        $this->response(1, "Success", $categoryArray);
    }


    public function get_product_details($product_id = '')
    {
        $this->checkToken();
        if (empty($product_id)) {
            $this->response(0, "Missing Params", []);
        }
        $products = $this->db->query("select p.*,p.status as product_status , p.product_name_" . $this->language . " as lang_product_name, p.product_detail_" . $this->language . " as lang_product_detail, c.category_title_" . $this->language . " as lang_category_title ,c.status as category_status,c.category_title_en,c.category_title_ch from product p left join category c on c.category_id = p.category_id where p.product_id = $product_id")->result();
       //Mass Discount
        $mass_discounts= $this->db->query("select * from mass_discount where status = 'Online' And start_time <= '".date("Y-m-d h:i:s")."' And end_time >= '".date("Y-m-d h:i:s")."'")->result();
            $ids = [];
            foreach($mass_discounts as $discount){
                $ids[] = $discount->mass_discount_id;
            }
             $categories = [];
            if(count($mass_discounts) > 0){
                $in = implode($ids,",");
                $categories = $this->db->query("select * from mass_discount_categories where mass_discount_id in ($in)")->result();
            }
            //Mass Discount Data Collection End
        if (count($products) < 1) {
            $this->response(0, "Cannot Find Product", []);
            exit();
        }
//        echo "select pc.*, pc.product_category_title_" . $this->language . " as lang_attribute_title from product_categories pcs left join product_category pc on pc.product_category_id = pcs.product_category_id where pcs.product_id = $product_id order by pc.product_category_id desc";
        $category = $this->db->query("select pc.*, pc.product_category_title_" . $this->language . " as lang_attribute_title from product_categories pcs left join product_category pc on pc.product_category_id = pcs.product_category_id where pcs.product_id = $product_id and pc.status = 'Online' order by pcs.product_categories_id ASC")->result();
        // if (!$category) {
        //     $this->response(0, "Cannot Load Product Categories", []);
        // }

        $attributes = $this->db->query("select *, product_attribute_title_" . $this->language . " as lang_category_title from product_attribute where status = 'Online' order by position_order ASC ")->result();
        if (!$attributes) {
            $this->response(0, "Cannot Load Attributes", []);
        }
        $suggestedProducts = $this->db->query("select p.* from suggested_products sp left join product p on sp.product_id = p.product_id where sp.product_id=$product_id")->result();
        $categoryArray = [];
        foreach ($category as $c) {
            $id = $c->product_category_id;
            $attArray = [];
            for ($i = 0; $i < count($attributes); $i++) {
                if ($id == $attributes[$i]->product_category_id) {
                    $attArray[] = $attributes[$i];
                }
            }
            $c->attributes = $attArray;
            $categoryArray[] = $c;
        }
        
        $product = $products[0];
         foreach($mass_discounts as $discount){
                    if($discount->coupon_condition == "For Categories"){
                        for($j = 0 ; $j < count($categories) ; $j++){
                            if($product->category_id == $categories[$j]->category_id){
                                $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
                                $product->price_after_discount = $product->original_price - $d_amount;
                                $product->discount_amount = $d_amount;
                                $product->disount_expiry = $discount->end_time;
                                $product->discount_start_time = $discount->start_time;
                                for($m = 0 ; $m < count($categoryArray) ; $m++ ){
//                                    $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
                                    $cats = $categoryArray[$m];
                                    for($z = 0 ; $z < count($cats->attributes) ; $z++){
                                         $attrs = $cats->attributes[$z];
                                        $d_amount = $discount->discount_type == "Cash"?$discount->amount:($attrs->original_price * $discount->percentage)/100;
                                        $attrs->price_after_discount = $d_amount < $attrs->original_price ? $attrs->original_price - $d_amount:0;
                                        $attrs->discount_amount = $d_amount;
                                        $cats->attributes[$z] = $attrs;
                                    }
                                    $categoryArray[$m] = $cats;
                                }
                                break;
                            }
                        }
                    }else{
                            $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
							if($product->original_price==0 || $product->original_price=='0'){
																
								$product->price_after_discount =0;
							}else{
								$product->price_after_discount = $product->original_price - $d_amount;
							}
                            // $product->price_after_discount = $product->original_price - $d_amount;
                            $product->discount_amount = $d_amount;
                            $product->disount_expiry = $discount->end_time;
                            $product->discount_start_time = $discount->start_time;
                        for($m = 0 ; $m < count($categoryArray) ; $m++ ){
//                                    $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
                            $cats = $categoryArray[$m];
                            for($z = 0 ; $z < count($cats->attributes) ; $z++){
                                $attrs = $cats->attributes[$z];
                                $d_amount = $discount->discount_type == "Cash"?$discount->amount:($attrs->original_price * $discount->percentage)/100;
                                $attrs->discount_amount = $d_amount;
                                $attrs->price_after_discount = $d_amount < $attrs->original_price ? $attrs->original_price - $d_amount:0;

                                $cats->attributes[$z] = $attrs;
                            }
                            $categoryArray[$m] = $cats;
                        }
                    }
                }
		$watermarks = $this->db->query("select * from product_watermarks a left join product_watermark b on b.product_watermark_id = a.product_watermark_id where a.product_id = ".$product->product_id)->result();
		$product->watermarks = $watermarks;
        $product->categories = $categoryArray;
        $product->suggested_products = $suggestedProducts;
        //Mass Discount Implementation
        // print_r($mass_discounts);
        
        $this->response(1, "Success", $product);

    }
	public function go_shipping()
	{	$order_id=$this->input->post('id');
	    $attributes=$this->OrderModel->sendwechatnotice_ordershipped($order_id);
	
	    if ($attributes) {
	        $this->response(1, "第一", $attributes);
	    } else {
	        $this->response(0, "走了", []);
	    }
	}
	
    public function get_attributes()
    {
        $this->checkToken();

        $attributes = $this->db->query("select pa.*, pa.product_attribute_title_" . $this->language . " as lang_attribute_title,pc.product_category_title_en,pc.product_category_title_ch ,pc.product_category_title_" . $this->language . " as lang_category_title  from product_attribute pa left join product_category pc on pc.product_category_id = pa.product_category_id
         order by pa.position_order ASC ")->result();

        if ($attributes) {
            $this->response(1, "Successfully Loaded Product Categories", $attributes);
        } else {
            $this->response(0, "Cannot Load Product Categories", []);
        }
    }

    public function get_products()
    {
        $this->checkToken();
        $pageNumber = 1;

        if (isset($_REQUEST['page'])) {
            // $this->response(0, "Missing Params", []);
            $pageNumber = $_REQUEST['page'];
        }
        $page = 10 * $pageNumber;
        $startPage = $page - 10;
        $products = $this->db->query("select p.*,p.status as product_status , p.product_name_" . $this->language . " as lang_product_name, p.product_detail_" . $this->language . " as lang_product_detail, c.category_title_" . $this->language . " as lang_category_title ,c.status as category_status,c.category_title_en,c.category_title_ch from product p left join category c on c.category_id = p.category_id  where p.status = 'Online' order by p.position_order ASC ")->result();
    
        
        if ($products) {

            $pageCount = $this->db->query(
                "select count(product_id) as count_res from product p left join category c on c.category_id = p.category_id"
            )->first_row();

            $count = $pageCount->count_res;
            $product_watermark = $this->db->query("select * from product_watermarks pws left join product_watermark pw on pws.product_watermark_id = pw.product_watermark_id")->result();
            $mass_discounts= $this->db->query("select * from mass_discount where status = 'Online' And start_time <= '".date("Y-m-d h:i:s")."' And end_time >= '".date("Y-m-d h:i:s")."'")->result();
            // echo $this->db->last_query();
            $ids = [];
            foreach($mass_discounts as $discount){
                $ids[] = $discount->mass_discount_id;
            }
            $categories = [];
            if(count($mass_discounts) > 0){
                $in = implode($ids,",");
                $categories = $this->db->query("select * from mass_discount_categories where mass_discount_id in ($in)")->result();
            }
            $prods = [];
            foreach($products as $product){
                $wm = [];
                for($i = 0 ; $i < count($product_watermark) ; $i++){
                    if($product_watermark[$i]->product_id == $product->product_id){
                        $wm[] = $product_watermark[$i];
                    }
                }
                
                foreach($mass_discounts as $discount){
                    if($discount->coupon_condition == "For Categories"){
                        for($j = 0 ; $j < count($categories) ; $j++){
                            if($product->category_id == $categories[$j]->category_id){
                                $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
								// var_dump($d_amount);
                                $product->price_after_discount = $product->original_price - $d_amount;
                                $product->discount_amount = $d_amount;
                                $product->disount_expiry = $discount->end_time;
                                $product->discount_start_time = $discount->start_time;
                                break;
                            }
                        }
                    }else{
                            $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
							if($product->original_price==0 || $product->original_price=='0'){
																
								$product->price_after_discount =0;
							}else{
								$product->price_after_discount = $product->original_price - $d_amount;
							}
					

                            // $product->price_after_discount = $product->original_price - $d_amount;
                            $product->discount_amount = $d_amount;
                            $product->disount_expiry = $discount->end_time;
                             $product->discount_start_time = $discount->start_time;
                    }
                }
                
                
                $product->product_watermark = $wm;
                
                $prods[] = $product;
            }
            $resp["products"] = $prods;
            $resp["current_page_index"] = $pageNumber;
            $resp["total_page_count"] = $this->get_total_page_count($count);


            $this->response(1, "Successfully Loaded Product", $resp);
        } else {
            $this->response(0, "Cannot Load Products", []);
        }
    }

    public function get_products_by_category($id = NULL)
    {
        $this->checkToken();
        if (empty($id)) {
            $this->response(0, "Missing Params", []);
        }
        $products = $this->db->query("select p.*,p.status as product_status , p.product_name_" . $this->language . " as lang_product_name, p.product_detail_" . $this->language . " as lang_product_detail, c.category_title_" . $this->language . " as lang_category_title ,c.status as category_status,c.category_title_en,c.category_title_ch from product p left join category c on c.category_id = p.category_id
         where p.category_id = '$id' order by p.position_order ASC ")->result();
        if ($products) {
            $this->response(1, "Successfully Loaded Product", $products);
        } else {

            $this->response(0, "Cannot Load Products", []);
        }
    }
    public function get_banners()
    {
        $this->checkToken();
        $products = $this->db->query("select b.* , b.banner_title_" . $this->language . " as lang_banner_name, b.banner_description_" . $this->language . " as lang_banner_detail from banner b where status = 'Online' order by b.position_order ASC ")->result();
        if ($products) {
            $this->response(1, "Successfully Loaded Product", $products);
        } else {
            $this->response(0, "Cannot Load Products", []);
        }
    }
    public function update_user_sp_points(){
         $this->checkToken();
         $arr = [];
        if (!isset($_REQUEST['user_id'])) {
            // echo "here";
            $this->response(0, "Missing Params", []);
        }
        $arr["user_id"] = $_REQUEST['user_id'];
        if (!isset($_REQUEST['points'])) {
            // echo "here2";
            $this->response(0, "Missing Params", []);
        }
        $arr["points"] = $_REQUEST['points'];
        $points = $_REQUEST['points'];
        if (!isset($_REQUEST['description'])) {
            // echo "here2";
            $this->response(0, "Missing Params", []);
        }
        $arr["description"] = $_REQUEST['description'];
        if (!isset($_REQUEST['type'])) {
            $this->response(0, "Missing Params", []);
        }
        
        $type = $_REQUEST['type'];
        if($type != "Increment" && $type != "Increment"){
            $this->response(0, "Inavlid Type", []);
        }
        $arr["type"] = $type;
        if (!isset($_REQUEST['source'])) {
            $this->response(0, "Missing Params", []);
        }
        $source = $_REQUEST['source'];
        if($source != "Order" && $source != "Cart" && $source != "Referral" && $source != "Other"){
            $this->response(0, "Inavlid Source", []);
        }
        $arr["source"] = $source;
        if (isset($_REQUEST['source_id'])) {
            $arr["source_id"] = $source;
        }
        
        $user= $this->db->get_where("users_system", ["users_system_id" => $arr["user_id"]]);
        $userResult = $user ? $user->first_row() : [];
        if(count($userResult) < 1){
            $this->response(0, "No User Found", []);
        }
        if($type == "Increment"){
            $currentPoints = $userResult->sp_points + $points;
        }else{
            $currentPoints = $userResult->sp_points - $points; 
        }
        $arr["current_points"] = $currentPoints;
        // print_r($arr);
        // exit;

        $res = $this->db->update("users_system",["sp_points"=>$currentPoints],["users_system_id"=>$arr["user_id"]]);
        
        if($res){
            $log = $this->db->insert("points_log",$arr);
            $userAddressData = $this->get_user_addesses($arr["user_id"]);
            $this->response(1, "success", $userAddressData);
        }else{
            $this->response(0, "failed", []);
        }
    }
    public function user_sp_points_discount_in_cart()
    {
        $this->checkToken();
        if (!isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['points'])) {
            $this->response(0, "Missing Params", []);
        }
        $user = $_REQUEST['user_id'];
        $userResult = $this->db->get_where("users_system",["users_system_id"=>$user])->first_row();
        if(count($userResult) < 1){
             $this->response(0, "User not found", []);
        }
       
        $cart = $this->db->get_where("cart", ["user_id" => $user]);
        $cartResult = $cart ? $cart->first_row() : [];
        if (count($cartResult) < 1) {
            $this->response(0, "Cart doesn't exist");
        }
        $sp_points = $_REQUEST['points'];
        if($userResult->sp_points < $sp_points){
            $this->response(0, "Don't Have Enough Points Current Points Are ".$userResult->sp_points);
        }
        $discount = ($sp_points/100);
        $gtotal = (double)$cartResult->sp_points_discount > 1?$cartResult->grand_total+$cartResult->sp_points_discount:$cartResult->grand_total;
        $total = $gtotal - $discount;
        $res = $this->db->update("cart",["sp_points_discount"=>$discount,"sp_points"=>$sp_points,"grand_total"=>$total],["cart_id"=>$cartResult->cart_id]);
        // if((double)$cartResult->sp_points_discount > 0){
        //     $log_data = $this->db->query("select * from points_log where source='Cart' And user_id = $user And source_id = ".$cartResult->cart_id." order by points_log_id desc Limit 1")->first_row();
        //     $log_update = $this->db->update("points_log",["points"=>$sp_points,"current_points"=>($userResult->sp_points-$sp_points)],["points_log_id"=>$log_data->points_log_id]);
        // }else{
        //     $sp_points_update = $this->db->insert("points_log",["user_id"=>$user,"source"=>"Cart","description"=>"Add Discount To Cart","type"=>"Decrement","source_id"=>$cartResult->cart_id,"points"=>$sp_points,"current_points"=>($userResult->sp_points-$sp_points)]);
        // }
        $data = $this->get_current_cart($cartResult->cart_id);
        $this->response(1, "Successfully added discount", $data);
    }
    
    public function get_products_attributes($category_id)
    {
        $this->checkToken();
        $page = 1;
        if (!isset($_REQUEST['page'])) {
            $this->response(0, "Missing Params", []);
        }
        $pageNumber = $_REQUEST['page'];
        $page = 10 * $_REQUEST['page'];
        $startPage = $page - 10;
        $products = $this->db->query(
            "select pc.*, p.product_name_" . $this->language . " as lang_product_name,p.product_detail_" . $this->language . " as lang_product_detail , p.status as product_status , c.product_category_title_" . $this->language . " as lang_category_title ,c.status as category_status from product_categories pc left join product p on p.product_id = pc.product_id left join product_category c on c.product_category_id = pc.product_category_id where pc.product_category_id = $category_id order by p.position_order ASC LIMIT $startPage, $page "
        )->result();

        $pageCount = $this->db->query(
            "select count(pc.product_category_id) as count_res from product_categories pc left join product p on p.product_id = pc.product_id left join product_category c on c.product_category_id = pc.product_category_id where pc.product_category_id = $category_id"
        )->first_row();
        $count = $pageCount->count_res;

        $attributes = $this->db->get("product_attribute")->result();


        $res = array();
        foreach ($products as $product) {
            $productAttr = array();
            for ($i = 0; $i < count((array)$attributes); $i++) {
                if ($attributes[$i]->product_category_id == $product->product_category_id) {
                    $attr = (array)$attributes[$i];
                    $attributes[$i]->lang_attribute_title = $attr["product_attribute_title_" . $this->language];
                    array_push($productAttr, $attributes[$i]);
                }
            }
            $product->attributes = $productAttr;
            array_push($res, $product);
        }
        $resp = [];
        $resp["products"] = $res;
        $resp["current_page_index"] = $pageNumber;
        $resp["total_page_count"] = $this->get_total_page_count($count);
        $this->response(1, "Success", $resp);
    }

    public function get_coupons()
    {
        $this->checkToken();
        $couponsRes = $this->db->query("select * from coupons where status = 'Online'");
        if (!$couponsRes) {
            $this->response(0, "Unable to get response", []);
        }
        $couponProducts = $this->db->query("select * from coupon_products cp left join coupons c on c.coupons_id = cp.coupons_id left join product p on p.product_id = cp.product_id where p.status = 'Online' And c.status = 'Online'")->result();

        $couponCategories = $this->db->query("select * from coupon_categories cc left join coupons c on c.coupons_id = cc.coupons_id left join category cat on cat.category_id = cc.category_id where cat.status = 'Online' And c.status = 'Online'")->result();

        $couponFrequencies = $this->db->query("select * from coupon_frequencies cfs left join coupons c on c.coupons_id = cfs.coupons_id left join coupon_frequency cf on cf.coupon_frequency_id = cfs.coupon_frequency_id where cf.status = 'Online' And c.status = 'Online'")->result();

        $coupons = $couponsRes->result();
        $response = [];
        foreach ($coupons as $coupon) {

            if ($coupon->coupon_condition == "For Categories") {
                $categoryArray = [];
                for ($i = 0; $i < count($couponCategories); $i++) {
                    if ($coupon->coupons_id == $couponCategories[$i]->coupons_id) {
                        $coCategory = [];
                        $coCategory["category_id"] = $couponCategories[$i]->category_id;
                        $coCategory["category_title_en"] = $couponCategories[$i]->category_title_en;
                        $coCategory["category_title_ch"] = $couponCategories[$i]->category_title_en;
                        $categoryArray[] = $coCategory;
                    }
                }
                $coupon->categories = $categoryArray;
            } else if ("For Products") {
                $productsArray = [];
                for ($j = 0; $j < count($couponProducts); $j++) {
                    if ($coupon->coupons_id == $couponProducts[$j]->coupons_id) {
                        $coProduct = [];
                        $coProduct["product_id"] = $couponProducts[$j]->product_id;
                        $coProduct["product_name_en"] = $couponProducts[$j]->product_name_en;
                        $coProduct["product_name_ch"] = $couponProducts[$j]->product_name_ch;
                        $productsArray[] = $coProduct;
                    }
                }
                $coupon->products = $productsArray;
            }
            $frequencies = [];
            for ($k = 0; $k < count($couponFrequencies); $k++) {
                if ($couponFrequencies[$k]->coupons_id == $coupon->coupons_id) {
                    $frequencies[] = $couponFrequencies[$k]->day;
                }
            }
            $coupon->frequencies = $frequencies;


            $response[] = $coupon;
        }

        $this->response(1, "Success", $response);

    }
    
    

    //Addresses -------------------->
    public function get_user_addresses()
    {
        if (!isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $user = $_REQUEST['user_id'];
        $userAddressData = $this->get_user_addesses($user);
        $userAddressData ? $this->response(1, "Success", $userAddressData) : $this->response(0, "unable get data", []);
    }

    public function add_address()
    {
        $this->checkToken();
        if (!isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['address'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['address_cs'])) {
            $this->response(0, "Missing Params", []);
        }
        $user = $_REQUEST['user_id'];
        $address = $_REQUEST['address'];
        $address_en = '';
        if (isset($_REQUEST["address_en"])) {
            $address_en = $_REQUEST['address_en'];
        }
        $address_ch = '';
        if (isset($_REQUEST["address_ch"])) {
            $address_ch = $_REQUEST['address_ch'];
        }
        $address_cs = $_REQUEST['address_cs'];
        $address_cs_en = '';
        if (isset($_REQUEST['address_cs_en'])) {
            $address_cs_en = $_REQUEST['address_cs_en'];
        }
        $address_cs_ch = '';
        if (isset($_REQUEST['address_cs_ch'])) {
            $address_cs_ch = $_REQUEST['address_cs_ch'];
        }
        $city = '';
        if (isset($_REQUEST['city'])) {
            $city = $_REQUEST['city'];
        }
        $country = '';
        if (isset($_REQUEST['country'])) {
            $country = $_REQUEST['country'];
        }
        $postalCode = '';
        if (isset($_REQUEST['postal_code'])) {
            $postalCode = $_REQUEST['postal_code'];
        }
        $latitude = '';
        if (isset($_REQUEST['latitude'])) {
            $latitude = $_REQUEST['latitude'];
        }
        $longitude = '';
        if (isset($_REQUEST['longitude'])) {
            $longitude = $_REQUEST['longitude'];
        }

        $res = $this->db->insert(
            "user_address", [
                "user_id" => $user,
                "user_address" => $address,
                "user_address_en" => $address_en,
                "user_address_ch" => $address_ch,
                "user_address_cs" => $address_cs,
                "user_address_cs_en" => $address_cs_en,
                "user_address_cs_ch" => $address_cs_ch,
                "country" => $country,
                "city" => $city,
                "latitude" => $latitude,
                "longitude" => $longitude,
            ]
        );
        $userAddressData = $this->get_user_addesses($user);
        $res ? $this->response(1, "Successfully updated", $userAddressData) : $this->response(0, "unable to update", []);
    }

    public function update_address()
    {
        $this->checkToken();
        if (!isset($_REQUEST['address_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $updateArray = array();

        $address_id = $_REQUEST['address_id'];
        $userAddress = $this->db->get_where("user_address", ["address_id" => $address_id]);
        $userAddressResult = $userAddress ? $userAddress->first_row() : [];
        $address = '';
        if (isset($_REQUEST['address'])) {
            $address = $_REQUEST['address'];
            $updateArray["user_address"] = $address;
        }
        $address_en = '';
        if (isset($_REQUEST["address_en"])) {
            $address_en = $_REQUEST['address_en'];
            $updateArray["user_address_en"] = $address_en;
        }
        $address_ch = '';
        if (isset($_REQUEST["address_ch"])) {
            $address_ch = $_REQUEST['address_ch'];
            $updateArray["user_address_ch"] = $address_ch;
        }
        $address_cs = '';
        if (isset($_REQUEST['address_cs'])) {
            $address_cs = $_REQUEST['address_cs'];
            $updateArray["user_address_cs"] = $address_ch;

        }

        $address_cs_en = '';
        if (isset($_REQUEST['address_cs_en'])) {
            $address_cs_en = $_REQUEST['address_cs_en'];
            $updateArray["user_address_cs_en"] = $address_cs_en;

        }
        $address_cs_ch = '';
        if (isset($_REQUEST['address_cs_ch'])) {
            $address_cs_ch = $_REQUEST['address_cs_ch'];
            $updateArray["user_address_cs_ch"] = $address_ch;


        }
        $city = '';
        if (isset($_REQUEST['city'])) {
            $city = $_REQUEST['city'];
            $updateArray["city"] = $city;

        }
        $country = '';
        if (isset($_REQUEST['country'])) {
            $country = $_REQUEST['country'];
            $updateArray["country"] = $country;

        }
        $postalCode = '';
        if (isset($_REQUEST['postal_code'])) {
            $postalCode = $_REQUEST['postal_code'];
            $updateArray["postal_code"] = $postalCode;

        }
        $latitude = '';
        if (isset($_REQUEST['latitude'])) {
            $latitude = $_REQUEST['latitude'];
            $updateArray["latitude"] = $latitude;

        }
        $longitude = '';
        if (isset($_REQUEST['longitude'])) {
            $longitude = $_REQUEST['longitude'];
            $updateArray["longitude"] = $longitude;
        }

        $res = $this->db->update(
            "user_address", $updateArray, ["address_id" => $address_id]
        );
        $userAddressData = $this->get_user_addesses($userAddressResult->user_id);
        $res ? $this->response(1, "Successfully updated", $userAddressData) : $this->response(0, "unable to update", []);
    }

    public function delete_user_addresses()
    {
        $address_id = $_REQUEST['address_id'];
        $res = $this->db->delete("user_address", ["address_id" => $address_id]);
        $res ? $this->response(1, "successfully deleted", []) : $this->response(0, "Cannot delete", []);
    }

    //END ADDRESS <----------------------

    public function get_user_addesses($user_id)
    {
        $user = $this->db->get_where("users_system", ["users_system_id" => $user_id])->first_row();
        $addesses = $this->db->get_where("user_address", ["user_id" => $user_id])->result();
        $user->addresses = $addesses;
        return $user;
    }

    //CART ------------------->
    // public function add_discount_to_cart()
    // {
    //     $this->checkToken();
    //     if (!isset($_REQUEST['discount_amt'])) {
    //         $this->response(0, "Missing Params", []);
    //     }
    //     if (!isset($_REQUEST['user_id'])) {
    //         $this->response(0, "Missing Params", []);
    //     }
    //     $user = $_REQUEST['user_id'];
    //     $discount_amt = $_REQUEST['discount_amt'];
    //     $cart = $this->db->get_where("cart", ["user_id" => $user]);
    //     $cartResult = $cart ? $cart->first_row() : [];
    //     if (count($cartResult) < 1) {
    //         $this->response(0, "Cart doesn't exist");
    //     }
    //     $this->hlp_update_cart_totals($cartResult->sub_total, $cartResult->cart_id, $discount_amt);
    //     $data = $this->get_current_cart($cartResult->cart_id);
    //     $this->response(1, "Successfully added discount", $data);
    // }

    public function clear_cart()
    {
        $this->checkToken();
        if (!isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $user = $_REQUEST['user_id'];
        $cart = $this->db->get_where("cart", ["user_id" => $user]);
        $cartResult = $cart ? $cart->first_row() : [];
        if (count($cartResult) < 1) {
            $this->response(0, "Cart doesn't exist");
        }
        $updCartResult = $this->db->update("cart", ["sub_total" => "0", "grand_total" => 0, "discount" => 0,"attributes_cost"=>0,"sp_points"=>0,"sp_points_discount"=>0,"ap_total"=>0,"coupon_id"=>0], ["cart_id" => $cartResult->cart_id]);
        $delCartProductResult = $this->db->delete("cart_product", ["cart_id" => $cartResult->cart_id]);
        $delCartAttr = $this->db->delete("cart_product_attributes", ["cart_id" => $cartResult->cart_id]);
        $delCartAttr = $this->db->delete("cart_additional_product", ["cart_id" => $cartResult->cart_id]);
        if ($updCartResult && $delCartProductResult) {
            $data = $this->get_current_cart($cartResult->cart_id);
            $this->response(1, "Cart cleared", $data);
        } else {
            $this->response(0, "Something went wrong", []);
        }
    }
    public function add_cart_additional_product(){
        if (!isset($_REQUEST['additional_product_id'])) {
            $this->response(0, "Missing Params", []);
        }
//        if (!isset($_REQUEST['price'])) {
//            $this->response(0, "Missing Params", []);
//        }
        $qty = 1;
        if (isset($_REQUEST['qty'])) {
           // $this->response(0, "Missing Params", []);
           $qty = $_REQUEST['qty'];
        }
        if (!isset($_REQUEST['cart_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $cart_id = $_REQUEST['cart_id'];
        $ap_id = $_REQUEST['additional_product_id'];

        $ap_res = $this->db->get_where("additional_product",["additional_product_id"=>$ap_id])->result();
        $c = $this->db->get_where("cart", ["cart_id" => $cart_id])->result();
        if(count($c)<1) {
            $this->response(0, "invalid cart", []);
        }
        if(count($ap_res) < 1){
            $this->response(0, "invalid additional product", []);
        }
        $apres = $ap_res[0];
        $price = $apres->ap_price;
        $cart = $this->db->get_where("cart", ["cart_id" => $cart_id])->first_row();
        
        $total_attr_cost = $cart->ap_total + ($price*$qty);
        $res = $this->db->insert("cart_additional_product",["cart_id"=>$cart->cart_id,"additional_product_id"=>$ap_id,"ap_price"=>$price,"ap_qty"=>$qty,"ap_total"=>$qty*$price]);
            if($res){
                $this->db->update("cart",["ap_total"=>$total_attr_cost,"grand_total"=>($total_attr_cost+$cart->grand_total)],["cart_id"=>$cart_id]);
                $data = $this->get_current_cart($cart->cart_id);
                $this->response(1, "Successfully updated cart", $data);
            }else{
                $this->response(0, "cannot insert attribute");
            }
    }
    public function remove_cart_additional_product(){
        if (!isset($_REQUEST['cart_additional_product_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $cap_id = $_REQUEST['cart_additional_product_id'];
        $c = $this->db->get_where("cart_additional_product", ["cart_additional_product_id" => $cap_id])->result();
        if(count($c)<1) {
            $this->response(0, "invalid addition product", []);
        }
        $cap = $c[0];
        $cart = $this->db->get_where("cart", ["cart_id" => $cap->cart_id])->first_row();
        
        $total_attr_cost = $cart->ap_total - $cap->ap_total;
        $total_attr_cost = $total_attr_cost < 0 ? 0:$total_attr_cost;
        $res = $this->db->delete("cart_additional_product",["cart_additional_product_id"=>$cap_id]);
        if($res){
            $this->db->update("cart",["ap_total"=>$total_attr_cost,"grand_total"=>($cart->grand_total - $total_attr_cost)],["cart_id"=>$cart->cart_id]);
            $data = $this->get_current_cart($cart->cart_id);
            $this->response(1, "Successfully updated cart", $data);
        }else{
            $this->response(0, "cannot insert attribute");
        }
    }
     public function update_cart_qty_additional_product(){
        if (!isset($_REQUEST['cart_additional_product_id'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['qty'])) {
            $this->response(0, "Missing Params", []);
        }
        $cap_id = $_REQUEST['cart_additional_product_id'];
        $qty = $_REQUEST['qty'];
        $c = $this->db->get_where("cart_additional_product", ["cart_additional_product_id" => $cap_id])->result();
        if(count($c)<1) {
            $this->response(0, "invalid addition product", []);
        }
        $cap = $c[0];
        $cart = $this->db->get_where("cart", ["cart_id" => $cap->cart_id])->first_row();
        $cart_ap_total = $cart->ap_total>0?$cart->ap_total - $cap->ap_total:0;
        $cart_gr_total = $cart->grand_total - $cap->ap_total;
        $cap_total = $cap->ap_price * $qty;
//        echo $cap->ap_price . " " . $qty;
        //echo ($cart_ap_total+$cap_total);
        $res = $this->db->update("cart_additional_product",["ap_total"=>$cap_total,"ap_qty"=>$qty],["cart_additional_product_id"=>$cap_id]);
        if($res){
            $this->db->update("cart",["ap_total"=>$cart_ap_total + $cap_total,"grand_total"=>($cart_gr_total+$cap_total)],["cart_id"=>$cart->cart_id]);
            $data = $this->get_current_cart($cart->cart_id);
            $this->response(1, "Successfully updated cart", $data);
        }else{
            $this->response(0, "cannot insert attribute");
        }
    }
    public function add_cart_product_attribute(){
        if (!isset($_REQUEST['cart_product_id'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['add_attribute_cost'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['attribute_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $product_id = $_REQUEST['cart_product_id'];
        $attr_cost = $_REQUEST['add_attribute_cost'];
        $attr_id = $_REQUEST['attribute_id'];
        $cartProduct = $this->db->get_where("cart_product", ["cart_product_id" => $product_id]);
        $cartProduct = $cartProduct ? $cartProduct->first_row() : [];
        if (count($cartProduct) < 1) {
            $this->response(0, "product doesn't exist in cart");
        }
        $cart = $this->db->get_where("cart", ["cart_id" => $cartProduct->cart_id])->first_row();
        $total_attr_cost = $cart->attributes_cost + $attr_cost;
        $product_attr_cost = $cartProduct->attributes_cost + $attr_cost;
        $this->db->update("cart",["attributes_cost"=>$product_attr_cost],["cart_id"=>$cart->cart_id]);
        $this->db->update("cart_product",["attributes_cost"=>$product_attr_cost],["cart_product_id"=>$product_id]);
        $res = $this->db->insert("cart_product_attributes",["cart_id"=>$cart->cart_id,"cart_product_id"=>$cartProduct->cart_product_id,"product_id"=>$cartProduct->product_id,"product_attribute_id"=>$attr_id]);
        if($res){
            $data = $this->get_current_cart($cart->cart_id);
            $this->response(1, "Successfully updated cart", $data);
        }else{
            $this->response(0, "cannot insert attribute");
        }
        
        
    }
    public function remove_cart_product_attribute(){
         $this->checkToken();
        if (!isset($_REQUEST['cart_product_id'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['subtract_attribute_cost'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['attribute_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $product_id = $_REQUEST['cart_product_id'];
        $attr_cost = $_REQUEST['subtract_attribute_cost'];
        $attr_id = $_REQUEST['attribute_id'];
        $attrRes = $this->db->get_where("cart_product_attributes",["product_attribute_id"=>$attr_id,"cart_product_id"=>$product_id]);
        $attrRes = $attrRes ? $attrRes->first_row() : [];
        if (count($attrRes) < 1) {
            $this->response(0, "product attribute doesn't exist in cart");
        }
        $cartProduct = $this->db->get_where("cart_product", ["cart_product_id" => $product_id]);
        $cartProduct = $cartProduct ? $cartProduct->first_row() : [];
        if (count($cartProduct) < 1) {
            $this->response(0, "product doesn't exist in cart");
        }
        $cart = $this->db->get_where("cart", ["cart_id" => $cartProduct->cart_id])->first_row();
        $total_attr_cost = $cart->attributes_cost - $attr_cost;
        $product_attr_cost = $cartProduct->attributes_cost - $attr_cost;
        $this->db->update("cart",["attributes_cost"=>$product_attr_cost],["cart_id"=>$cart->cart_id]);
        $this->db->update("cart_product",["attributes_cost"=>$product_attr_cost],["cart_product_id"=>$product_id]);
        $this->db->delete("cart_product_attributes",["product_attribute_id"=>$attr_id,"cart_product_id"=>$product_id]);
        $data = $this->get_current_cart($cart->cart_id);
        $this->response(1, "Successfully updated cart", $data);
        
    }

    public function update_cart_product_qty()
    {
        $this->checkToken();
        if (!isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['cart_product_id'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['qty'])) {
            $this->response(0, "Missing Params", []);
        }
        $user = $_REQUEST['user_id'];
        $product_id = $_REQUEST['cart_product_id'];
        $qty = $_REQUEST['qty'];
        $cart = $this->db->get_where("cart", ["user_id" => $user]);
        $cartResult = $cart ? $cart->first_row() : [];
        if (count($cartResult) < 1) {
            $this->response(0, "Cart doesn't exist");
        }
        $cartProduct = $this->db->get_where("cart_product", ["cart_id" => $cartResult->cart_id, "cart_product_id" => $product_id]);
        $cartProduct = $cartProduct ? $cartProduct->first_row() : [];
        if (count($cartProduct) < 1) {
            $this->response(0, "product doesn't exist in cart");
        }
        $product = $this->db->get_where("product", ["product_id" => $cartProduct->product_id]);
        $productResult = $product ? $product->first_row() : [];
        if (count($productResult) < 1) {
            $this->response(0, "Cannot found product", []);
        }
        $cartSubTotal = $cartResult->sub_total - $cartProduct->total;
        $cpTotal = $productResult->original_price * $qty;
        $cartSubTotal = $cartSubTotal + $cpTotal;
        $this->db->update("cart_product", ["total" => $cpTotal, "quantity" => $qty], ["cart_product_id" => $product_id, "cart_id" => $cartResult->cart_id]);
        $this->hlp_update_cart_totals($cartSubTotal, $cartResult->cart_id);
        $data = $this->get_current_cart($cartResult->cart_id);
        $this->response(1, "Successfully updated cart", $data);
    }

    public function get_user_cart()
    {
        $this->checkToken();
        if (!isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $user = $_REQUEST['user_id'];
        $cart = $this->db->get_where("cart", ["user_id" => $user]);
        $cartResult = $cart ? $cart->first_row() : [];
        if (count((array)$cartResult) < 1) {
            $this->response(0, "Cart doesn't exist");
        }
        $currentCart = $this->get_current_cart($cartResult->cart_id);
        $this->response(1, "Success", $currentCart);
    }

    public function remove_product_from_cart()
    {
        $this->checkToken();
        if (!isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['cart_product_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $user = $_REQUEST['user_id'];
        $product_id = $_REQUEST['cart_product_id'];
        $cart = $this->db->get_where("cart", ["user_id" => $user]);
        $cartResult = $cart ? $cart->first_row() : [];
        if (count($cartResult) < 1) {
            $this->response(0, "Cart doesn't exist");
        }
        $cartProduct = $this->db->get_where("cart_product", ["cart_product_id" => $product_id]);
        $cartProduct = $cartProduct ? $cartProduct->first_row() : [];
        if (count($cartProduct) < 1) {
            $this->response(0, "product doesn't exist in cart");
        }
        $delResponse = $this->db->delete("cart_product", ["cart_product_id" => $product_id]);
//        echo $delResponse;
        if ($delResponse) {
            $newTotal = (double)$cartResult->sub_total - (double)$cartProduct->total;
            $resUpdate = $this->db->update("cart",["sub_total"=>$newTotal,"grand_total"=>($cartResult->grand_total - $cartProduct->total - $cartProduct->attributes_cost),"attributes_cost"=>($cartResult->attributes_cost - $cartProduct->attributes_cost)],["cart_id"=>$cartResult->cart_id]);
            //$this->hlp_update_cart_totals($newTotal, $cartResult->cart_id);
            $currentCart = $this->get_current_cart($cartResult->cart_id);
            $this->response(1, "Successfully removed", $currentCart);
        } else {
            $this->response(0, "Cannot remove product", []);
        }
    }

    public function add_product_to_cart()
    {
        $this->checkToken();
        if (!isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['product_id'])) {
            $this->response(0, "Missing Params", []);
        }
        if (!isset($_REQUEST['qty'])) {
            $this->response(0, "Missing Params", []);
        }
        $attributes = [];
        if (isset($_REQUEST['attributes'])) {
            $attributes = $_REQUEST['attributes'];
        }

        $user = $_REQUEST['user_id'];
        $qty = $_REQUEST['qty'];
        $product_id = $_REQUEST['product_id'];
        $attrcost = 0;
        if (isset($_REQUEST['attributes_cost'])) {
            $attrcost = $_REQUEST['attributes_cost'];
        }
       // print_r($attributes);
        $in = implode(",", $attributes);
        
        $product = $this->db->get_where("product", ["product_id" => $product_id]);
        $productResult = $product ? $product->first_row() : [];
        if (count((array)$productResult) < 1) {
            $this->response(0, "Cannot found product", []);
        }
        $attRes = [];
        //echo $in . "here";
        if(!empty($in)){
            $attRes1 = $this->db->query("Select * from product_attribute where product_attribute_id IN ($in)");
            $attRes = $attRes1->result();
        }
        if($attrcost == 0){
           $attribute_total = 0;
            foreach ($attRes as $att) {
                $attribute_total = $attribute_total + $att->original_price;
            }
            $attrcost = $attribute_total;
        }
        

//        print_r($attRes->result());
         //Mass Discount
        // $mass_discounts= $this->db->query("select * from mass_discount where status = 'Online' And start_time <= '".date("Y-m-d h:i:s")."' And end_time >= '".date("Y-m-d h:i:s")."'")->result();
        //     $ids = [];
        //     foreach($mass_discounts as $discount){
        //         $ids[] = $discount->mass_discount_id;
        //     }
        //      $categories = [];
        //     if(count($mass_discounts) > 0){
        //         $in = implode($ids,",");
        //         $categories = $this->db->query("select * from mass_discount_categories where mass_discount_id in ($in)")->result();
        //     }
        //     $product = $productResult;
        //       foreach($mass_discounts as $discount){
        //             if($discount->coupon_condition == "For Categories"){
        //                 for($j = 0 ; $j < count($categories) ; $j++){
        //                     if($product->category_id == $categories[$j]->category_id){
        //                         $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
        //                         $product->price_after_discount = $product->original_price - $d_amount;
        //                         $product->discount_amount = $d_amount;
        //                         $product->disount_expiry = $discount->end_time;
        //                         $product->discount_start_time = $discount->start_time;
        //                         break;
        //                     }
        //                 }
        //             }else{
        //                     $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
        //                     $product->price_after_discount = $product->original_price - $d_amount;
        //                     $product->discount_amount = $d_amount;
        //                     $product->disount_expiry = $discount->end_time;
        //                     $product->discount_start_time = $discount->start_time;
        //             }
        //         }
            
            
        $price = $productResult->current_price;
        $mass_discount_amount = 0;
        $total = $qty * ($price - $mass_discount_amount);
        $cart = $this->db->get_where("cart", ["user_id" => $user]);
        $cartResult = $cart ? $cart->first_row() : [];
        if (count((array)$cartResult) > 0) {
          
             
            $updateCart = $this->db->update("cart", ["sub_total" => (double)$cartResult->sub_total + (double)$total, "grand_total" => (double)$cartResult->sub_total + (double)($total + $attrcost + $cartResult->attributes_cost) - $cartResult->discount, "attributes_cost" => $attrcost + $cartResult->attributes_cost], ["cart_id" => $cartResult->cart_id]);
//            echo $this->db->last_query();
            $cartProduct = $this->db->get_where("cart_product", ["product_id" => $product_id, "cart_id" => $cartResult->cart_id]);
            $cartProductResult = $cartProduct ? $cartProduct->first_row() : [];
            //here
            $cartProductInsert = $this->db->insert("cart_product", ["price" => $price, "quantity" => $qty, "cart_id" => $cartResult->cart_id, "product_id" => $product_id, "total" => $total,"attributes_cost"=>$attrcost]);
            $cp_id = $this->db->insert_id();
               foreach ($attRes as $att) {
                    $this->db->insert("cart_product_attributes", ["cart_id" => $cartResult->cart_id, "product_id" => $product_id, "product_attribute_id" => $att->product_attribute_id,"cart_product_id"=>$cp_id]);
                }
//            print_r($cartProductResult);
            // if (count((array)$cartProductResult) > 0) {
            //     $cartProductUpdate = $this->db->update("cart_product", ["price" => $price, "quantity" => (double)$qty + (double)$cartProductResult->quantity, "total" => (double)$cartProductResult->total + (double)$total], ["product_id" => $product_id, "cart_id" => $cartResult->cart_id]);
            //     if ($attRes || !empty($attRes)) {
            //         foreach ($attRes as $att) {
            //             $this->db->delete("cart_product_attributes", ["cart_id" => $cartResult->cart_id, "product_id" => $product_id]);
            //         }
            //         foreach ($attRes as $att) {
            //             $this->db->insert("cart_product_attributes", ["cart_id" => $cartResult->cart_id, "product_id" => $product_id, "product_attribute_id" => $att->product_attribute_id]);
            //         }
            //     }
            // } else {
            //     //add product
            //     $cartProductInsert = $this->db->insert("cart_product", ["price" => $price, "quantity" => $qty, "cart_id" => $cartResult->cart_id, "product_id" => $product_id, "total" => $total]);
            //     foreach ($attRes as $att) {
            //         $this->db->insert("cart_product_attributes", ["cart_id" => $cartResult->cart_id, "product_id" => $product_id, "product_attribute_id" => $att->product_attribute_id]);
            //     }
            // }
            if ($updateCart) {
                $currentCart = $this->get_current_cart($cartResult->cart_id);
                $this->response(1, "Successfully added to cart", $currentCart);
            } else {
                $this->response(0, "Cannot add to cart", []);
            }
        } else {
            $cartInsert = $this->db->insert("cart", ["user_id" => $user, "sub_total" => $total, "grand_total" => $total + $attrcost, "attributes_cost" => $attrcost]);
            $id = $this->db->insert_id();
            $cartProductInsert = $this->db->insert("cart_product", ["cart_id" => $id, "product_id" => $product_id, "quantity" => $qty, "total" => $total,"attributes_cost" => $attrcost]);
            $cp_id = $this->db->insert_id();
            foreach ($attRes as $att) {
                $this->db->insert("cart_product_attributes", ["cart_id" => $id, "product_id" => $product_id, "product_attribute_id" => $att->product_attribute_id,"cart_product_id"=>$cp_id]);
            }
            $currentCart = $this->get_current_cart($id);
            $cartInsert && $cartProductInsert ? $this->response(1, "Successfully added to cart", $currentCart) : $this->response(0, "Cannot add to cart", []);
        }
    }

    public function hlp_update_cart_totals($new_total, $cart_id, $discount = 0)
    {
        $cartResult = $this->db->get_where("cart", ["cart_id" => $cart_id])->first_row();
        $this->db->update("cart", ["sub_total" => $new_total, "discount" => $discount, "grand_total" => $new_total + $cartResult->attributes_cost - $discount]);
//        echo $this->db->last_query();
    }

    public function get_current_cart($id)
    {
//        $currentCartArray = array();
        $currentCart = $this->db->get_where("cart", ["cart_id" => $id])->first_row();
     
        $currentCartProducts = $this->db->query("select * from cart_product cp left join product p on cp.product_id = p.product_id where cart_id = $id")->result();
        $caps = $this->db->query("select *,cap.ap_price as ap_price from cart_additional_product cap left join additional_product ap on cap.additional_product_id = ap.additional_product_id where cart_id = $id")->result();
        $attrRes = $this->db->query("select b.*,a.product_id,a.cart_product_id from cart_product_attributes a left join product_attribute b on a.product_attribute_id = b.product_attribute_id where cart_id = $id")->result();
        $productsRes = array();
            $product_watermark = $this->db->query("select * from product_watermarks pws left join product_watermark pw on pws.product_watermark_id = pw.product_watermark_id")->result();
            $mass_discounts= $this->db->query("select * from mass_discount where status = 'Online' And start_time <= '".date("Y-m-d h:i:s")."' And end_time >= '".date("Y-m-d h:i:s")."'")->result();
            // echo $this->db->last_query();
            //  print_r($mass_discounts);
            // echo $this->db->last_query();


//    START GET MASS DISCOUNT DATA
            $ids = [];
            foreach($mass_discounts as $discount){
                $ids[] = $discount->mass_discount_id;
            }
            $categories = [];
            if(count($mass_discounts) > 0){
                $in = implode($ids,",");
                $categories = $this->db->query("select * from mass_discount_categories where mass_discount_id in ($in)")->result();
            }
            $prods = [];
          $pptotal = 0;
          $final_attr_total = 0;
        foreach ($currentCartProducts as $product) {
            $attr = array();
            $attr_total = 0 ;
            for ($i = 0; $i < count($attrRes); $i++) {
                if ($product->cart_product_id == $attrRes[$i]->cart_product_id) {
                    $attr_total = $attr_total + ($attrRes[$i]->original_price * $product->quantity);
                    $attr[] = $attrRes[$i];
                }
            }
            $product->price_after_discount = $product->original_price;
            $product->discount_amount = 0;
              foreach($mass_discounts as $discount){
                //   print_r($discount);
                    if($discount->coupon_condition == "For Categories"){
                        for($j = 0 ; $j < count($categories) ; $j++){
                            if($product->category_id == $categories[$j]->category_id){
                                $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
                                $product->price_after_discount = $d_amount < $product->original_price ?($product->original_price - $d_amount):0;
                                $product->discount_amount = $d_amount;
                                $product->disount_expiry = $discount->end_time;
                                $product->discount_start_time = $discount->start_time;
//                                for($m = 0 ; $m < count($categoryArray) ; $m++ ){
////                                    $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
//                                    $cats = $categoryArray[$m];

                                    for($z = 0 ; $z < count($attr) ; $z++){
                                        $_attr_total = 0;
                                        $_attrs = $attr[$z];
                                        if ($product->cart_product_id == $_attrs->cart_product_id) {
                                            $d_amount = $discount->discount_type == "Cash" ? $discount->amount : ($_attrs->original_price * $discount->percentage) / 100;
                                            $_attrs->price_after_discount = $d_amount < $_attrs->original_price ? $_attrs->original_price - $d_amount : 0;
                                            $_attrs->discount_amount = $d_amount;
//                                        $cats->attributes[$z] = $_attrs;
                                            if ($d_amount > $_attrs->original_price) {
                                                $_attr_total = $_attr_total + ($_attrs->original_price * $product->quantity);
                                                $attr_total = $attr_total - $_attr_total;
                                            } else {
                                                $_attr_total = $_attr_total + ($d_amount * $product->quantity);
                                                $attr_total = $attr_total - $_attr_total;
                                            }
                                            $_attrs->original_price = $_attrs->price_after_discount;

                                        }
                                    }

//                                    $categoryArray[$m] = $cats;
//                                }
                                break;
                            }
                        }
                    }else{
                        // print_r($discount);
                            $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
				// 			if($product->original_price==0 || $product->original_price=='0'){
							                
				// 			        $product->price_after_discount =0;
				// 			       }else{
				// 			        $product->price_after_discount = $product->original_price - $d_amount;
				// 			       }
                            $product->price_after_discount = $d_amount < $product->original_price ?($product->original_price - $d_amount):0;
                            $product->discount_amount = $d_amount;
                            $product->disount_expiry = $discount->end_time;
                            $product->discount_start_time = $discount->start_time;
                        for($z = 0 ; $z < count($attr) ; $z++){
                            $_attr_total = 0;

                            $_attrs = $attr[$z];
                            if ($product->cart_product_id == $_attrs->cart_product_id) {
                                $d_amount = $discount->discount_type == "Cash" ? $discount->amount : ($_attrs->original_price * $discount->percentage) / 100;
                                $_attrs->price_after_discount = $d_amount < $_attrs->original_price ? $_attrs->original_price - $d_amount : 0;
                                $_attrs->discount_amount = $d_amount;

//                                        $cats->attributes[$z] = $_attrs;
                                if ($d_amount > $_attrs->original_price) {
                                    $_attr_total = $_attr_total + ($_attrs->original_price * $product->quantity);
                                     $attr_total = $attr_total - $_attr_total;
                                } else {
                                    $_attr_total = $_attr_total + ($d_amount * $product->quantity);
                                     $attr_total = $attr_total - $_attr_total;
                                }
                                $_attrs->original_price = $_attrs->price_after_discount;
                            }
                        }
                    }
                }
                
           
                
            $product->attributes = $attr;
            $product->price = $product->price_after_discount;
            $product->total = $product->price_after_discount * $product->quantity;
            $product->attributes_cost = $attr_total;
            $final_attr_total = $final_attr_total + $attr_total;
            $pptotal = $pptotal + $product->total;
            

            $productsRes[] = $product;
        }
        
        // 
        //        GET COUPONS CART DATA =====================+++++=========+++++++++++++====+>
        $Couponres = $this->db->get_where("coupons", ["coupons_id" => $currentCart->coupon_id])->result();

        $coupon_pre_discount = 0;
        $discountGrandTotal = ($currentCart->grand_total - ($currentCart->sub_total + $currentCart->attributes_cost)) + ($pptotal+$final_attr_total);
        // $this->db->update("cart",["grand_total"=>$discountGrandTotal],["cart_id"=>$currentCart->cart_id]);
        $totalDiscount = 0;
        if(count($Couponres) > 0) {
            $coupon = $Couponres[0];
            $cart_id = $currentCart->cart_id;
            $cart = $currentCart;
            if ($coupon->coupon_condition == "No Limit") {
                // $cart->grand_total =  $cart->grand_total - $coupon_pre_discount;
                // $cart->discount = $cart->discount $coupon_pre_discount;

                $totalDiscount = $coupon->discount_type == "Percentage" ? ($discountGrandTotal * $coupon->percentage) / 100 : $coupon->amount;

//                $grandTotal = $cart->grand_total - $totalDiscount;

            } else if ($coupon->coupon_condition == "For Categories") {

                // $cart->grand_total =  $cart->grand_total - $coupon_pre_discount;
                // $cart->discount = $cart->discount - $coupon_pre_discount;

                $categories = $this->db->query("select * from coupon_categories cc left join category c on c.category_id = cc.category_id where cc.coupons_id = " . $coupon->coupons_id)->result();

                $cart_products = $this->db->query("select * from cart_product cp left join product p on p.product_id = cp.product_id where cart_id = " . $cart_id)->result();
                $totalDiscount = 0;

                 foreach ($categories as $category) {
                    for ($i = 0; $i < count($cart_products); $i++) {
                        if ($category->category_id == $cart_products[$i]->category_id) {
                           $attibuteCostForDiscount = 0;
                            foreach($productsRes as $productAttriubtesCost){
                                if($productAttriubtesCost->cart_product_id == $cart_products[$i]->cart_product_id){
                                    $attibuteCostForDiscount = $productAttriubtesCost->attributes_cost;
                                    $cart_products[$i] = $productAttriubtesCost;
                                    break;
                                }
                            }
                            $totalDiscount += $coupon->discount_type == "Percentage" ? (($cart_products[$i]->total+$attibuteCostForDiscount) * $coupon->percentage) / 100 : $coupon->amount;
                            
                        }
                    }
                }
//                $grandTotal = $cart->grand_total - $totalDiscount;
//                $this->db->update("cart", ["coupon_id" => $coupon->coupons_id], ["cart_id" => $cart_id]);
//                $this->db->update("coupons", ["coupon_qty" => ($coupon->coupon_qty - 1)], ["coupons_id" => $coupon->coupons_id]);
            } else {
                $products = $this->db->query("select * from coupon_products cc left join product c on c.product_id = cc.product_id where cc.coupons_id = " . $coupon->coupons_id)->result();

                $cart_products = $this->db->query("select * from cart_product cp left join product p on p.product_id = cp.product_id where cart_id = " . $cart_id)->result();
                $totalDiscount = 0;

                foreach ($products as $product) {
                    for ($i = 0; $i < count($cart_products); $i++) {
                        if ($product->product_id == $cart_products[$i]->product_id) {
                            $attibuteCostForDiscount = 0;
                            foreach($productsRes as $productAttriubtesCost){
                                if($productAttriubtesCost->cart_product_id == $cart_products[$i]->cart_product_id){
                                    $attibuteCostForDiscount = $productAttriubtesCost->attributes_cost;
                                    $cart_products[$i] = $productAttriubtesCost;
                                    break;
                                }
                            }
                            $totalDiscount += $coupon->discount_type == "Percentage" ? (($cart_products[$i]->total+$attibuteCostForDiscount) * $coupon->percentage) / 100 : $coupon->amount;
                        }
                    }
                }
//                $grandTotal = $cart->grand_total - $totalDiscount;
//                $this->db->update("cart", ["coupon_id" => $coupon->coupons_id], ["cart_id" => $cart_id]);
//                $this->db->update("coupons", ["coupon_qty" => ($coupon->coupon_qty - 1)], ["coupons_id" => $coupon->coupons_id]);
            }
        }

//        END COUPONS CART DATA =====================+++++=========+++++++++++++====+>
        
        $currentCart->products = $productsRes;
        $g_total = 0; 
        // print_r($currentCart);
        
        //echo $pptotal;
        $g_total = ($currentCart->grand_total - ($currentCart->sub_total + $currentCart->attributes_cost)) + ($pptotal+$final_attr_total);
        
        $currentCart->attributes_cost = $final_attr_total;
        $currentCart->sub_total = $pptotal;
        $currentCart->g_grand_total = $currentCart->grand_total;
        $currentCart->grand_total = ($g_total - $totalDiscount) > 0 ? ($g_total - $totalDiscount) : 0;
        $currentCart->coupon_discount = $totalDiscount;
        $currentCart->original_price = $pptotal + $final_attr_total;
        $currentCart->discount =  $currentCart->discount+$totalDiscount;
        $currentCart->addition_products = $caps;
        return $currentCart;
    }
    public function clearMyCart($user_id)
    {
        $user = $user_id;
        $cart = $this->db->get_where("cart", ["user_id" => $user]);
        $cartResult = $cart ? $cart->first_row() : [];

        $updCartResult = $this->db->update("cart", ["sub_total" => "0", "grand_total" => 0,"sp_points_discount"=>0,"sp_points"=>0, "discount" => 0,"attributes_cost"=>0,"ap_total"=>0,"coupon_id"=>0], ["cart_id" => $cartResult->cart_id]);
        $delCartProductResult = $this->db->delete("cart_product", ["cart_id" => $cartResult->cart_id]);
        $delCartAttrResult = $this->db->delete("cart_product_attributes", ["cart_id" => $cartResult->cart_id]);
        $delCartAdditionalProduct = $this->db->delete("cart_additional_product", ["cart_id" => $cartResult->cart_id]);
    }
    //CART END <-----------------------------

    public function update_order_status()
    {
        if (!isset($_REQUEST["status"]) || !isset($_REQUEST["order_id"])) {
            $this->response(0, "Missing params", []);
        }
        $status = $_REQUEST["status"];
        $order_id = $_REQUEST["order_id"];
        if ($status != "Pending" && $status != "Process" && $status != "Shipping" && $status != "Cancel" && $status != "Completed" && $status != "Printed") {
            $this->response(0, "Not a valid status", []);
        }
        $res = $this->db->update("order", ["order_status" => $status], ["order_id" => $order_id]);
//        echo $this->db->last_query();
        $data = $res ? $this->getOrderData($order_id) : [];
        $res ? $this->response(1, "Successfully updated status", $data) : $this->response(0, "cannot update", []);

    }
    
    
    //需要微信支付的订单 --- 判断是否支付成功
    public function checkpayment_ishavepaidsuccess(){
        if (!isset($_REQUEST["order_id"])) {
            $this->response(0, "Missing params", []);
        }
        $order_id = $_REQUEST["order_id"];
        $orderinfo = $this->OrderModel->getorderinfo($order_id);
        if(!empty($orderinfo)){
            if($orderinfo['payment_status'] == 'Paid'){
                $this->response(1, "Paid", []);
            }else{
                $this->response(0, "Not paid yet", []);
            }
        }else{
            $this->response(0, "Order does not exist", []);
        }
    }

   

    public function submit_order()
    {
        $this->checkToken();
        if (!isset($_REQUEST['user_id']) || !isset($_REQUEST['distance']) || !isset($_REQUEST['products']) || !isset($_REQUEST['source_id']) || !isset($_REQUEST['note']) ) {
            $this->response(0, "Missing Params", []);
        }
        $preOrder = 0;
        if(isset($_REQUEST['preorder'])){
            $preOrder = $_REQUEST['preorder'];
        }
        $mDeliveryFee = 0;
        if(isset($_REQUEST['delivery_fee'])){
            $mDeliveryFee = $_REQUEST['delivery_fee'];
        }
        $note = $_REQUEST['note'];
        if (isset($_REQUEST['user_id'])) {
            $user = $_REQUEST["user_id"];
        }
        $address = "";
        if (isset($_REQUEST['address'])) {
            $address = $_REQUEST["address"];
        }

        $contact = "";
        if (isset($_REQUEST['contact'])) {
            $contact = $_REQUEST["contact"];
        }
        $subTotal = "";
        if (isset($_REQUEST['sub_total'])) {
            $subTotal = $_REQUEST["sub_total"];
        }
//        $total = "";
//        if (isset($_REQUEST['total'])) {
//            $total = $_REQUEST["total"];
//        }
        $status = "Pending";
        if (isset($_REQUEST['status'])) {
            $status = $_REQUEST["status"];
        }
        $discount = 0;
        if (isset($_REQUEST['discount'])) {
            $discount = $_REQUEST["discount"];
        }

        $products = [];
        if (isset($_REQUEST['products'])) {
            $productJson = $_REQUEST["products"];
            $products = $productJson;
        }

        $distance = $_REQUEST['distance'];

        $orderCostData = $this->db->get_where("order_cost", ["type" => "Current Location"])->result();
        $cost = "";
        foreach ($orderCostData as $orderCost) {
            if ($distance >= $orderCost->distance_s_range && $distance <= $orderCost->distance_e_range) {
                $cost = $orderCost;
                break;
            }
        }
        if ($cost == "") {
            $this->response(0, "Cannot calculate order cost", []);
        }
        $data = [
            "users_system_id" => $user,
            "address_id" => $address,
            "order_cost_id" => $cost->order_cost_id,
            "order_cost" => $cost->cost,
            "contact" => $contact,
            "distance" => $distance,
            "order_sub_total" => $subTotal,
//            "order_total" => $total,
            "order_status" => $status,
            "note" => $note,
            "discount" => $discount,
            "grand_total" => ($subTotal + $cost->cost) - $discount
        ];
        

        $orderInsertRes = $this->db->insert("order", $data);

        if ($orderInsertRes) {
            $id = $this->db->insert_id();
            $productArrayData = [];
            if ($products)
                foreach ($products as $product) {
                    $productData = [
                        "product_id" => $product['product_id'],
                        "qty" => $product['quantity'],
                        "price" => $product['price'],
                        "total" => $product['total'],
                        "order_id" => $id
                    ];
                    $orderInsertRes = $this->db->insert("order_products", $productData);
                }
            $orderResponse = $this->getOrderData($id);
            $this->response(1, "Success", $orderResponse);
        } else {
            $this->response(0, "cannot sumbit order try again later", []);

        }
    }
    public function update_sp_order_address(){
        if (!isset($_REQUEST['address_id']) || !isset($_REQUEST['order_id']) || !isset($_REQUEST['address']) || !isset($_REQUEST['user_id'])) {
            $this->response(0, "Missing Params", []);
        }
        $address = $_REQUEST['address'];
        $address_id = $_REQUEST['address_id'];
        $order_id = $_REQUEST['order_id'];
        $user_id = $_REQUEST['user_id'];
        
        $resp = $this->db->update('order',["c_address"=>$address],["order_id"=>$order_id]);
        $addresult = $this->db->get_where("user_address",["address_id"=>$address_id]);
        $addressRes = $addresult?$addresult->result():[];
        if(count($addressRes) > 0){
            $this->db->update('user_address',["user_address"=>$address],["address_id"=>$address_id]);
        }else{
            $res = $this->db->insert('user_address',["user_address"=>$address,"user_id"=>$user_id]);
            $id = $this->db->insert_id();
            $this->db->update('order',["address_id"=>$id],["order_id"=>$order_id]);
        }
        if($resp){
            $this->response(1, "Success", []);
        }else{
             $this->response(0, "cannot update address", []);
        }
    }
    public function submit_order2()
    {
        $this->checkToken();

        if (!isset($_REQUEST['cart_id']) || !isset($_REQUEST['address']) || !isset($_REQUEST['distance']) || !isset($_REQUEST['day']) || !isset($_REQUEST['time']) || !isset($_REQUEST['contact'] )|| !isset($_REQUEST['delivery_time']) || !isset($_REQUEST['order_source_id']) || !isset($_REQUEST['note']) || !isset($_REQUEST['payment_method'])) {
            #
            $this->response(0, "Missing Params", []);
        }
        // "preorder" => $preOrder,
        $preOrder = 0;
        if(isset($_REQUEST['preorder'])){
            $preOrder = $_REQUEST['preorder'];
        }
        $mDeliveryFee = 0;
        if(isset($_REQUEST['delivery_fee'])){
            $mDeliveryFee = $_REQUEST['delivery_fee'];
        }
        $cart_id = $_REQUEST['cart_id'];
        $cart = $this->db->get_where("cart", ["cart_id" => $cart_id]);
        if (!$cart) {
            $this->response(0, "Cart Doesn't exist");
        }
        $cartRes = $cart->first_row();

        $useer = $this->db->get_where("users_system", ["users_system_id" => $cartRes->user_id]);
        if (!$useer) {
            $this->response(0, "user does not exist");
        }
        $userResult = $useer->first_row();
        
        $pay_method = $_REQUEST['payment_method'];
        //SP POINTS
        $sp_points = 0;
        $sp_amount = 0;
		//  if($paymentStatus == "Paid"){
      
        $paymentStatus = "Not Paid";
        
        // 'Cash','WeChat_Pay','Other'
        if($userResult->users_roles_id == 1){
//            Wuzhong
//            Manual
            $paymentStatus = "Paid";
            if ($pay_method != "Cash" && $pay_method != 'WeChat_Pay' && $pay_method != 'Other' && $pay_method != 'ImDada' && $pay_method != 'In-House' && $pay_method != 'Shansong' && $pay_method != 'Walk-Ins' && $pay_method != 'Sherpas' && $pay_method != 'JSS' && $pay_method != 'Ele.Me' && $pay_method != 'Wuzhong' && $pay_method != 'Manual' && $pay_method != 'Monthly_Payment') {
                $this->response(0, "Invalid Payment Method", []);
            }
        }else {
            if ($pay_method != "Cash" && $pay_method != 'WeChat_Pay' && $pay_method != 'Other'  && $pay_method != 'Monthly_Payment') {
                $this->response(0, "Invalid Payment Method", []);
            }
            if($pay_method == "Cash"){
                $paymentStatus = "Paid";
            }
        }
		if(isset($_REQUEST['sp_points'])){
		    $sp_points = $_REQUEST['sp_points'];
		    $sp_amount = $sp_points / 100;
		    if($sp_points > $userResult->sp_points){
		         $this->response(0, "don't have enough sp points", []);
		    }
		    if($sp_points > 800){
		         $this->response(0, "sp points cannot be more then 800", []);
		    }
		}
        $note = $_REQUEST['note'];
        $day = $_REQUEST['day'];
        $time = $_REQUEST['time'];
        $d_time = $_REQUEST['delivery_time'];
        $source = $_REQUEST['order_source_id'];
        $timesArray = explode("-",$time);
        $timeToArr=  explode(":",trim($timesArray[0]," "));
        
        $timeToDouble = (double)$time[0]. ".".$time[1];
        $order_fee = ($timeToArr < 14.00 || $timeToArr >= 16.00) ? 0 : 0;
        // $order_time = $day == "today" ? 8 : 0;

        
        $address = $_REQUEST["address"];
        $contact = $_REQUEST["contact"];
        $status = "Pending";
        $products = [];
        $products = $this->db->query("select * from cart_product cp left join product p on p.product_id = cp.product_id where p.status = 'Online' and cart_id = ".$cart_id)->result_array();
        // $products = $this->db->get_where("cart_product", ["cart_id" => $cart_id])->result_array();
        if (count($products) < 1) {
            $this->response(0, "No Products In Cart");

        }
        $caps= $this->db->get_where("cart_additional_product", ["cart_id" => $cart_id])->result();
        $attributes = [];
        $attributes = $this->db->query("select * from cart_product_attributes a left join product_attribute b on a.product_attribute_id = b.product_attribute_id where  a.cart_id = $cart_id")->result_array();
        $distance = $_REQUEST['distance'];
        $c_address = '';
        $address_res = $this->db->get_where("user_address",["address_id"=>$address]);
        if($address_res){
            $addr = $address_res->first_row();
            if(count($addr) > 0){
                $c_address = $addr->user_address;
            }
        }
        $orderCostData = $this->db->get_where("order_cost", ["type" => "Current Location"])->result();
        if($distance > 35){
            $this->response(0, "your distance is more then 50km(20Km)", []);

        }
        $cost = "";
		 $response = $this->db->get_where("system_settings",["system_settings_id"=>39])->first_row();
			foreach ($orderCostData as $orderCost) {
				if($response->description == "Yes"){
					$orderCost->cost = ($orderCost->cost+$orderCost->adjust_cost);
				}
			   // $orderCost->cost = ($orderCost->cost+$orderCost->adjust_cost);
				if ($distance >= $orderCost->distance_s_range && $distance <= $orderCost->distance_e_range) {
					$cost = $orderCost;
					break;
				}
			}
        // foreach ($orderCostData as $orderCost) {
        //     if ($distance >= $orderCost->distance_s_range && $distance <= $orderCost->distance_e_range) {
        //         $cost = $orderCost;
        //         break;
        //     }
        // }
        if ($cost == "") {
            $this->response(0, "Cannot calculate order cost", []);
        }
        if($distance > 15){
            // if($cartRes->sub_total < 200){
            //     $this->response(0, "your distance is more then 8km must have product value atleast 200rmb", []);
            // }
            $cost->cost = 30;
        }
        //get latest product price
        $orderSubTotal = 0;
        $newProducts = [];
        
        // print_r($products);
        // exit();
        foreach($products as $product){
            $latestProductData = $this->db->get_where("product",["product_id"=>$product['product_id']])->first_row();
            $product["price"] = $latestProductData->original_price;
            $product["total"] = $product["quantity"]* $product["price"];
            // $product["cart_product_id"] =
            $newProducts[] = $product;
            $orderSubTotal = $orderSubTotal +  $product["total"];
        }
        $products = $newProducts;
        $cartRes->sub_total = $orderSubTotal;
        //get latest additional product price.
        // $ap_total = 0;
        // // "ap_price" => $cap->ap_price,
        // //             "ap_qty" => $cap->ap_qty,
        // //             "ap_total" => $cap->ap_total
        // $newCaps = [];
        // foreach($caps as $cap){
        //     $latestAdditionalProductData = $this->db->get_where("additional_product",["additional_product_id"=>$cap->additional_product_id])->first_row();
        //     $cap->ap_price = $latestAdditionalProductData->ap_price;
        //     $cap->ap_total = $cap->ap_price * $cap->ap_qty;
        //     $ap_total = $ap_total + $cap->ap_total;
        // }
        // $cartRes->ap_total = $ap_total;
        
         
        
        if($userResult->users_roles_id == 1){
           $cost->cost = 0;
	        $order_fee = 0;
        }

		 // 
		        $currentCart = $cartRes;
		        $Couponres = $this->db->get_where("coupons", ["coupons_id" => $currentCart->coupon_id])->result();
		        $isCheckOrderLimit = true;
		        $coupon_pre_discount = 0;
		//APPLY LATEST COUPON
		        $totalDiscount = 0;
		        if(count($Couponres) > 0) {
		            $coupon = $Couponres[0];
		            $cart_id = $currentCart->cart_id;
		            $cart = $currentCart;
		            if($coupon->percentage > 99){
		                    $isCheckOrderLimit = false;
							$cost->cost = 0;
							$order_fee = 0;
		            }
		        }
		
        // if($userResult->users_roles_id != 1 && $isCheckOrderLimit) {
        //     if ($cartRes->grand_total < 54) {
        //         $this->response(0, "cannot place order sub total is less than 54RMB");
        //         exit();
        //     }
        // }
        $order_fee = $order_fee + $mDeliveryFee;
		 if($currentCart->coupon_id == 78){
				$cost->cost = 0;
				$order_fee = 0;
			}
        //Requested Sp Points
        $rSpPoints = $sp_points;
        
        
        
        if($pay_method == 'WeChat_Pay'){//后面支付成功后再扣积分
            
        }else{
            if($paymentStatus != "Paid"){
                $sp_points = 0;
                $sp_amount = 0;
            }
        }
		
		
		$totalDiscount = 0;
        $data = [
            "users_system_id" => $cartRes->user_id,
            "address_id" => $address,
            'c_address' => $c_address,
            "order_cost_id" => $cost->order_cost_id,
            "order_cost" => $cost->cost,
//            "contact" => $contact,
            "distance" => $distance,
            "order_sub_total" => $cartRes->sub_total,
//            "order_total" => $total,
            "order_status" => $status,
            "discount" => ($cartRes->discount + $totalDiscount),
            "contact" => $contact,
            "order_day" => $day,
            "order_time" => $time,
            "coupon_id"=>$cartRes->coupon_id,
            "delivery_time" => $d_time,
            "sp_points"=>(double)$sp_points,
            "requested_sp_points"=> $rSpPoints,
            "sp_points_discount"=>(double)$sp_amount,
            "note" => $note,
            "payment_method"=>$pay_method,
            "attributes_cost" => $cartRes->attributes_cost,
            "order_fee" => $order_fee,
            "ap_total"=>$cartRes->ap_total,
            "order_source_id"=>$source,
            "payment_status"=>$paymentStatus,
            "preorder" => $preOrder,
            // "sp_points_discount"=> $cartRes->sp_points_discount,
            // "sp_points"=> $cartRes->sp_points,
            "grand_total" => ($cartRes->ap_total+$cartRes->sub_total + $cost->cost + $cartRes->attributes_cost + $order_fee) - ($cartRes->discount +  $sp_amount + $totalDiscount)
        ];

        $orderInsertRes = $this->db->insert("order", $data);
        if ($orderInsertRes) {
            $id = $this->db->insert_id();
            
            if($pay_method == 'WeChat_Pay'){//后面支付成功后再扣积分
                
            }else{
                if($sp_points > 0){
                    $sp_points_update = $this->db->insert("points_log",["user_id"=>$cartRes->user_id,"source"=>"Order","description"=>"Add Discount To Order. ORDER NO :".$id,"type"=>"Decrement","source_id"=>$id,"points"=>$sp_points,"current_points"=>((double)$userResult->sp_points-(double)$sp_points)]);
                    $user_sp_points = $this->db->update("users_system",["sp_points"=>((double)$userResult->sp_points-(double)$sp_points)],["users_system_id"=>$cartRes->user_id]);
                }
            }
            
            
            $productArrayData = [];
            
            $mass_discounts= $this->db->query("select * from mass_discount where status = 'Online' And start_time <= '".date("Y-m-d h:i:s")."' And end_time >= '".date("Y-m-d h:i:s")."'")->result();
            // echo $this->db->last_query();
            $ids = [];
            foreach($mass_discounts as $discount){
                $ids[] = $discount->mass_discount_id;
            }
            $categories = [];
            if(count($mass_discounts) > 0){
                $in = implode($ids,",");
                $categories = $this->db->query("select * from mass_discount_categories where mass_discount_id in ($in)")->result();
            }
          
            if ($products){
                $product_total = 0;
                $attribute_total = 0;
                $mass_discount = 0;
                //:::::::::::::::::::::::::::::::::::::::: LATER UPDATING ATTRIBUTE WITH CART ID
                $allAttributes = $attributes;
                // ::::::::::::::::::::::::::::::: FOR ATTRIBUTE COUPON DISCOUNT
                $productsForCouponsDiscount = [];
                foreach ($products as $product) {
                    $product_mass_discount = 0;
                    $product['price_after_discount'] = $product['original_price'];
                    $attributes = [];
                    foreach ($allAttributes as $attribute) {
                        if($attribute['cart_product_id'] ==  $product['cart_product_id']){
                            $attribute_total = $attribute_total + ($attribute["original_price"] * $product['quantity']);
                            $attributes[] = $attribute;
                        }
                    }
                    foreach($mass_discounts as $discount){
                    if($discount->coupon_condition == "For Categories"){
                         
                        for($j = 0 ; $j < count($categories) ; $j++){
                            if($product['category_id'] == $categories[$j]->category_id){
                                $d_amount = $discount->discount_type== "Cash"?$discount->amount:($product['original_price'] * $discount->percentage)/100;
                                $product['price_after_discount'] = $d_amount < $product['original_price']?($product['original_price'] - $d_amount):0;
                                $product_mass_discount = $product_mass_discount + $d_amount;
                                if($d_amount > $product['original_price']){
                                    $mass_discount = $mass_discount + $product['original_price'];
                                }else{
                                    $mass_discount = $mass_discount + $d_amount;
                                }
                                // $mass_discount = $mass_discount + $d_amount;
                                $product['discount_amount'] = $d_amount;
                                $product['disount_expiry'] = $discount->end_time;
                                $product['discount_start_time'] = $discount->start_time;

                                for($z = 0 ; $z < count($attributes) ; $z++) {
                                    $_attr_total = 0;
                                    $_attrs = $attributes[$z];
                                    if ($_attrs['product_id'] == $product['product_id']) {
                                        $d_amount = $discount->discount_type == "Cash" ? $discount->amount : ($_attrs['original_price'] * $discount->percentage) / 100;
                                        $_attrs['price_after_discount'] = $d_amount < $_attrs['original_price'] ? $_attrs['original_price'] - $d_amount : 0;
                                        $_attrs['discount_amount'] = $d_amount;
                                        //                                        $cats->attributes[$z] = $_attrs;
                                        if ($d_amount > $_attrs['original_price']) {
                                            $_attr_total = $_attr_total + ($_attrs['original_price'] * $product['quantity']);
                                            $mass_discount = $mass_discount + $_attrs['original_price'];

                                        } else {
                                            $_attr_total = $_attr_total + ($d_amount * $product['quantity']);
                                            $mass_discount = $mass_discount + $d_amount;

                                        }
                                        $_attrs['at_qty'] = $product['quantity'];
                                        $_attrs['at_price'] = $_attrs['price_after_discount'];
                                        $_attrs['at_total'] = ($_attrs['price_after_discount'] * $product['quantity']);
                                        $attributes[$z] = $_attrs;
                                        $attribute_total = $attribute_total - $_attr_total;
                                    }
                                }
                                break;
                            }
                        }
                    }else{
                            $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product['original_price'] * $discount->percentage)/100;
                            $product['price_after_discount'] = $d_amount < $product['original_price']?($product['original_price'] - $d_amount):0;
                            // $product->price_after_discount = $d_amount < $product->original_price ?($product->original_price - $d_amount):0;

                            $product['discount_amount'] = $d_amount;
                            $product_mass_discount = $product_mass_discount + $d_amount;
                            if($d_amount > $product['original_price']){
                                $mass_discount = $mass_discount + $product['original_price'];
                            }else{
                                $mass_discount = $mass_discount + $d_amount;
                            }
                            $product['disount_expiry'] = $discount->end_time;
                            $product['discount_start_time'] = $discount->start_time;

                        for($z = 0 ; $z < count($attributes) ; $z++) {

                            $_attr_total = 0;
                            $_attrs = $attributes[$z];
                            if ($_attrs['product_id'] == $product['product_id']) {
                                $d_amount = $discount->discount_type == "Cash" ? $discount->amount : ($_attrs['original_price'] * $discount->percentage) / 100;
                                $_attrs['price_after_discount'] = $d_amount < $_attrs['original_price'] ? $_attrs['original_price'] - $d_amount : 0;
                                $_attrs['discount_amount'] = $d_amount;
                                //                                        $cats->attributes[$z] = $_attrs;
                                if ($d_amount > $_attrs['original_price']) {
                                    $_attr_total = $_attr_total + ($_attrs['original_price'] * $product['quantity']);
                                    $mass_discount = $mass_discount + $_attrs['original_price'];

                                } else {
                                    $_attr_total = $_attr_total + ($d_amount * $product['quantity']);
                                    $mass_discount = $mass_discount + $d_amount;
                                }
                                $_attrs['at_qty'] = $product['quantity'];
                                $_attrs['at_price'] = $_attrs['price_after_discount'];
                                $_attrs['at_total'] = ($_attrs['price_after_discount'] * $product['quantity']);
                                $attributes[$z] = $_attrs;
                                $attribute_total = ($attribute_total - $_attr_total);
                            }
                        }
                    }
                }
                  $product['price'] = $product['price_after_discount'];
                  $product['total'] = $product['price_after_discount'] * $product['quantity'];
                  $product_total = $product_total + $product['total'];

                    $productData = [
                        "product_id" => $product['product_id'],
                        "qty" => $product['quantity'],
                        "price" => $product['price'],
                        "total" => $product['total'],
                        "order_id" => $id
                    ];

                    $orderInsertRes = $this->db->insert("order_products", $productData);
                    $ppid = $this->db->insert_id();
                    // need to insert attributes here
                    $attributes_cost_total = 0;
                        foreach ($attributes as $attribute) {
                            $price = 0;
                            if(isset($attribute['at_price'])){
                                $price = $attribute['at_price'];
                            }else{
                                $price = $attribute['original_price'];
                            }
                            $attributes_cost_total = $attributes_cost_total+$price;
                            $this->db->insert("order_product_attributes", [
                                "order_id" => $id,
                                "product_id" => $product["product_id"],
                                "order_product_id" => $ppid,
                                "product_attribute_id" => $attribute['product_attribute_id'],
                                "at_qty" => $product['quantity'],
                                "at_price" => $price,
                                "at_total" => ($product['quantity'] * $price) 
            
                            ]);
                        }
                        $product["attributes_cost"] = $attributes_cost_total;
                        $productsForCouponsDiscount[] = $product;
                }
        $discountGrandTotal = ($cartRes->ap_total+$product_total + $cost->cost + $attribute_total + $order_fee) - ($cartRes->discount +  $sp_amount);        
        //        GET COUPONS CART DATA =====================+++++=========+++++++++++++====+>
        $currentCart = $cartRes;
        $Couponres = $this->db->get_where("coupons", ["coupons_id" => $currentCart->coupon_id])->result();
        $isCheckOrderLimit = true;
        $coupon_pre_discount = 0;
//APPLY LATEST COUPON
        $totalDiscount = 0;
        if(count($Couponres) > 0) {
            $coupon = $Couponres[0];
            $cart_id = $currentCart->cart_id;
            $cart = $currentCart;
            if($coupon->percentage > 99){
                    $isCheckOrderLimit = false;
            }
            if ($coupon->coupon_condition == "No Limit") {
                // $cart->grand_total =  $cart->grand_total - $coupon_pre_discount;
                // $cart->discount = $cart->discount $coupon_pre_discount;

                $totalDiscount = $coupon->discount_type == "Percentage" ? ($discountGrandTotal * $coupon->percentage) / 100 : $coupon->amount;
                
//                $grandTotal = $cart->grand_total - $totalDiscount;

            }
            else if ($coupon->coupon_condition == "For Categories") {

                // $cart->grand_total =  $cart->grand_total - $coupon_pre_discount;
                // $cart->discount = $cart->discount - $coupon_pre_discount;

                $categories = $this->db->query("select * from coupon_categories cc left join category c on c.category_id = cc.category_id where cc.coupons_id = " . $coupon->coupons_id)->result();

                $cart_products = $this->db->query("select * from cart_product cp left join product p on p.product_id = cp.product_id where cart_id = " . $cart_id)->result();
                $totalDiscount = 0;

               foreach ($categories as $category) {
                    for ($i = 0; $i < count($cart_products); $i++) {
                        if ($category->category_id == $cart_products[$i]->category_id) {
                            $attibuteCostForDiscount = 0;
                            foreach($productsForCouponsDiscount as $productAttriubtesCost){
                                if($productAttriubtesCost['cart_product_id'] == $cart_products[$i]->cart_product_id){
                                    $attibuteCostForDiscount = $productAttriubtesCost['attributes_cost'];
                                    $cart_products[$i] = json_decode(json_encode($productAttriubtesCost),false);
                                    break;
                                }
                            }
                            $totalDiscount += $coupon->discount_type == "Percentage" ? (($cart_products[$i]->total+$attibuteCostForDiscount) * $coupon->percentage) / 100 : $coupon->amount;
                        }
                    }
                }
//                $grandTotal = $cart->grand_total - $totalDiscount;
//                $this->db->update("cart", ["coupon_id" => $coupon->coupons_id], ["cart_id" => $cart_id]);
//                $this->db->update("coupons", ["coupon_qty" => ($coupon->coupon_qty - 1)], ["coupons_id" => $coupon->coupons_id]);
            } else {
                $_products = $this->db->query("select * from coupon_products cc left join product c on c.product_id = cc.product_id where cc.coupons_id = " . $coupon->coupons_id)->result();

                $cart_products = $this->db->query("select * from cart_product cp left join product p on p.product_id = cp.product_id where cart_id = " . $cart_id)->result();
                $totalDiscount = 0;

                foreach ($_products as $product) {
                    for ($i = 0; $i < count($cart_products); $i++) {
                        if ($product->product_id == $cart_products[$i]->product_id) {
                            foreach($productsForCouponsDiscount as $productAttriubtesCost){
                                if($productAttriubtesCost['cart_product_id'] == $cart_products[$i]->cart_product_id){
                                    $attibuteCostForDiscount = $productAttriubtesCost['attributes_cost'];
                                    $cart_products[$i] = json_decode(json_encode($productAttriubtesCost),false);
                                    break;
                                }
                            }
                            $totalDiscount += $coupon->discount_type == "Percentage" ? (($cart_products[$i]->total+$attibuteCostForDiscount) * $coupon->percentage) / 100 : $coupon->amount;
                         }
                    }
                }
//                $grandTotal = $cart->grand_total - $totalDiscount;
//                $this->db->update("cart", ["coupon_id" => $coupon->coupons_id], ["cart_id" => $cart_id]);
//                $this->db->update("coupons", ["coupon_qty" => ($coupon->coupon_qty - 1)], ["coupons_id" => $coupon->coupons_id]);
            }
        }
    
        //        GET COUPONS CART DATA =====================+++++=========+++++++++++++====+>
                
                $grand_total = ($cartRes->ap_total+$product_total + $cost->cost + $attribute_total + $order_fee) - ($cartRes->discount +  $sp_amount + $totalDiscount);
                $grand_total = $grand_total > 0 ? $grand_total: 0;
                $dorder = [
                     "discount" => ($cartRes->discount + $totalDiscount),
                                "attributes_cost" =>$attribute_total,
                                "order_sub_total" => $product_total,
                                "grand_total" => $grand_total,
                                "mass_discount" => $mass_discount
                    ];
                $this->db->update("order",$dorder,["order_id"=>$id]);
            }
//            $grand_total=$grand_total;
            
            foreach($caps as $cap){
                 $this->db->insert("order_additional_product", [
                    "order_id" => $id,
                    "additional_product_id"=>$cap->additional_product_id,
                    "ap_price" => $cap->ap_price,
                    "ap_qty" => $cap->ap_qty,
                    "ap_total" => $cap->ap_total
                ]);
            }
            
           // $user = $this->db->get_where("users_system",["users_system_id"=>$cartRes->user_id])->first_row();
		 //  if($paymentStatus == "Paid"){
                if($pay_method == 'WeChat_Pay'){//后面支付成功后再扣积分
                    
                }else{
                    $nborder = empty($userResult->c_nborders)?1: $userResult->c_nborders + 1;
//                     $c_sp_points =  !empty($userResult->sp_points)?$userResult->sp_points - $sp_points:0;
//                     if($sp_points>0){
//                         $this->db->insert("points_log",["source"=>"Order","user_id"=>$cartRes->user_id,"description"=>"Used Points in while checkout in order_no ". $id,"type"=>"Decrement","source_id"=>$id,"points"=>$grand_total,"current_points"=>$c_sp_points]);
//                     }
                    $new_sp_points =  !empty($userResult->sp_points)?$userResult->sp_points + $grand_total - $sp_points:$grand_total;
                    if($grand_total > 0){
                        $this->db->insert("points_log",["source"=>"Order","user_id"=>$cartRes->user_id,"description"=>"Gained Points in while checkout in order_no ". $id,"type"=>"Increment","source_id"=>$id,"points"=>$grand_total,"current_points"=>$new_sp_points]);
                    }
                    $this->db->update("users_system",["c_nborders"=>$nborder,"sp_points"=>$new_sp_points],["users_system_id"=>$cartRes->user_id]);
                }
         //   }
			$orderResponse = $this->getOrderData($id);
            $this->clearMyCart($cartRes->user_id);
            $this->response(1, "Success", $orderResponse);
        } else {
            $this->response(0, "cannot sumbit order try again later", []);
        }
    }

    public function update_payment_status(){
        if(!isset($_REQUEST['payment_status'])){
            $this->response(0, "missing params", []);
        }
        if(!isset($_REQUEST['order_id'])){
            $this->response(0, "missing params", []);
        }
        if($_REQUEST['payment_status'] != "Paid" && $_REQUEST['payment_status'] != "Not Paid"){
            $this->response(0, "invalid status", []);
        }
        $res = $this->db->update('order',["payment_status"=>$_REQUEST['payment_status']],["order_id"=>$_REQUEST['order_id']]);
//         $orderRes = $this->db->get_where('order',['order_id'=>$_REQUEST['order_id']]);
//         if($orderRes){
//             $order = $orderRes->first_row();
//             if($order->payment_status == "Paid" && $order->sp_points < 1){
//                 $sp_points = $order->requested_sp_points;
// 		        $sp_amount = $sp_points / 100;
// 		        $userResult = $this->db->get_where("users_system",["users_system_id"=>$order->users_system_id])->first_row();
// 		        if($userResult->sp_points >=  $sp_points){
//     		        $res2 = $this->db->update('order',["sp_points"=>$sp_points,"sp_points_discount"=>$sp_amount,"grand_total"=>($order->grand_total - $sp_amount)],["order_id"=>$_REQUEST['order_id']]);
//                     $sp_points_update = $this->db->insert("points_log",["user_id"=>$order->users_system_id,"source"=>"Order","description"=>"Add Discount To Order. Order No: ".$order->order_id,"type"=>"Decrement","source_id"=>$order->order_id,"points"=>$sp_points,"current_points"=>((double)$userResult->sp_points-(double)$sp_points)]);
//                     $user_sp_points = $this->db->update("users_system",["sp_points"=>((double)$userResult->sp_points-(double)$sp_points)],["users_system_id"=>$order->users_system_id]);
// 		        }
// 		    }
//         }
//         if($res){
            $this->response(1, "Success", []);
//         }else{
//             $this->response(0, "failed try again", []);
//         }
    }

    public function get_all_orders()
    {
//        $this->checkToken();
//        if (!isset($_REQUEST["user_id"])) {
//            $this->response(0, "Missing params", []);
//        }

//        $user = $_REQUEST["user_id"];
//        $pageNumber = 1;

//        if (isset($_REQUEST['page'])) {
//            // $this->response(0, "Missing Params", []);
//            $pageNumber = $_REQUEST['page'];
//        }
//        $page = 10 * $pageNumber;
//        $startPage = $page - 10;
//        $pageCount = $this->db->query(
//            "select count(order_id) as count_res from `order` where users_system_id = '$user'"
//        )->first_row();

//        if ((int)$pageCount->count_res < 1) {
//            $this->response(1, "You haven't placed any order yet", []);
//        }
        $orders = $this->db->query("select o.order_day,o.ap_total,o.note,o.order_id,o.order_sub_total,o.grand_total,o.order_cost,o.order_cost as distance_cost,o.distance,o.order_time,o.delivery_time,o.order_fee,o.attributes_cost,o.c_address as address,o.payment_method , o.payment_status , u.first_name,u.last_name,u.mobile,os.order_source_id,os.source_title,o.print_status from `order` o left join user_address ua on ua.address_id = o.address_id left join users_system u on o.users_system_id = u.users_system_id left join order_source os on o.order_source_id = os.order_source_id where o.print_status != 'Completed' order by o.order_id DESC")->result();
//        echo count($orders) . "CC";
        $products = $this->db->query("select op.*,p.product_name,p.product_name_ch,p.product_detail,p.product_detail_ch,p.printer_group_id from order_products op left join product p on op.product_id = p.product_id")->result();
        $printer_group = $this->db->get_where("printer_group",["status"=>"Online"])->result();
//    print_r($products);
        $groupsId = [];
        foreach($printer_group as $group){
            $groupsDetails[$group->printer_group_id] = $group->group_title;
        }
        $ordersResp = array();
        $printer = [];
        foreach ($orders as $order) {
            $productss = [];
//            echo count($products) . " __ " . $order->order_id . "__<br>" ;
            for($i = 0 ; $i < count($products) ; $i++ ){
               // echo $products[$i]->order_id . " O" . $order->order_id . " ";
                if($products[$i]->order_id == $order->order_id){
                    $productss[] = $products[$i];
                }
            }
//            print_r($productss);
            $attrs = $this->db->query("select pa.*,opa.product_id from order_product_attributes opa left join product_attribute pa on pa.product_attribute_id = opa.product_attribute_id where order_id = ".$order->order_id." order by pa.product_attribute_id ASC")->result();

            $prod = [];
            foreach ($productss as $product) {
                $a = [];
                for ($j = 0; $j < count($attrs); $j++) {
                    if ($attrs[$j]->product_id == $product->product_id) {
                        if (isset($groupsDetails[$attrs[$j]->printer_group_id])) {
                            $group_name = str_replace(' ', '_', $groupsDetails[$attrs[$j]->printer_group_id]);
                            $a[$group_name][] = $attrs[$j];
                        }
                            $a['Receipt'][] = $attrs[$j];
                    }
                }

//                $mattrs = [];
//                foreach($attrs as $attr){
//                    if($attr->product_id == $product->product_id){
//
//                    }
//                }
                $pgroup = [];
                $check = false;
                $product->attributes = $a;
                if (isset($groupsDetails[$product->printer_group_id])) {
                    $group_name = str_replace(' ', '_', $groupsDetails[$product->printer_group_id]);
                    $prod[$group_name][] = $product;
                    $check = true;
                }
//                foreach($printer_group as $group){
//                    if($group->printer_group_id == $product->printer_group_id){
//                        $group_name = str_replace(' ', '_', $groupsDetails[$product->printer_group_id]));
//                        $prod[$group_name][] = $product;
//                        //$prod[$group->group_title][] = $product;
//                        $check = true;
//                    }
//                }
                
                $prod["Receipt"][] = $product;
                
                
               // $prod[] = $pgroup;
            }
            $caps = $this->db->get_where("order_additional_product",["order_id"=>$order->order_id])->result();
            $order->products = $prod;
            $order->additional_product = $caps;
            $ordersResp[] = $order;
        }
//        $resp["orders"] = $ordersResp;
//        $resp["total_page_count"] = $this->get_total_page_count($count);

        $this->response(1, "Successfully Loaded Product", $ordersResp);
    }
    public function order_print_status($order_id = ''){
        if(empty($order_id)){
            $this->response(0, "missing params", []);
        }
        $res = $this->db->update("order",["print_status"=>"Printed"],["order_id"=>$order_id]);
        if($res){
            $this->response(1, "successfully updated", []);
        }else{
            $this->response(0, "cannot updated", []);
        }
    }
    public function get_user_orders()
    {
//        $this->checkToken();
        if (!isset($_REQUEST["user_id"])) {
            $this->response(0, "Missing params", []);
        }

        $user = $_REQUEST["user_id"];
        $pageNumber = 1;

        if (isset($_REQUEST['page'])) {
            // $this->response(0, "Missing Params", []);
            $pageNumber = $_REQUEST['page'];
        }
        $page = 10 * $pageNumber;
        $startPage = $page - 10;
        $pageCount = $this->db->query(
            "select count(order_id) as count_res from `order` where users_system_id = '$user'"
        )->first_row();

        if ((int)$pageCount->count_res < 1) {
            $this->response(1, "You haven't placed any order yet", []);
        }
        $orders = $this->db->query("select o.*,u.user_address,os.source_title from `order` o left join user_address u on u.address_id = o.address_id left join order_source os on o.order_source_id = os.order_source_id where o.users_system_id = '$user' order by o.order_id desc LIMIT $startPage, $page")->result();
        $ordersResp = array();
        foreach ($orders as $order) {
            $productss = $this->db->query("select * from order_products op left join product on op.product_id = product.product_id where op.order_id = " . $order->order_id)->result();
            $attrs = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on pa.product_attribute_id = opa.product_attribute_id where order_id = ".$order->order_id)->result();

            $products = [];
            foreach ($productss as $product) {
                $a = [];
                for ($i = 0; $i < count($attrs); $i++) {
                    if ($attrs[$i]->order_product_id == $product->order_products_id) {
                        $a[] = $attrs[$i];
                    }
                }
                $product->attributes = $a;
                $products[] = $product;
            }
            $order->products = $products;
            $ordersResp[] = $order;
        }

        $count = $pageCount->count_res;

        $resp["orders"] = $ordersResp;
        $resp["current_page_index"] = $pageNumber;
        $resp["total_page_count"] = $this->get_total_page_count($count);

        $this->response(1, "Successfully Loaded Product", $resp);
    }
	
	public function get_user_orders2()
	    {
	//        $this->checkToken();
	        if (!isset($_REQUEST["user_id"])) {
	            $this->response(0, "Missing params", []);
	        }
	
	        $user = $_REQUEST["user_id"];
	        // $pageNumber = 1;
	
	        // if (isset($_REQUEST['page'])) {
	        //     // $this->response(0, "Missing Params", []);
	        //     $pageNumber = $_REQUEST['page'];
	        // }
	        // $page = 10 * $pageNumber;
	        // $startPage = $page - 10;
	        $pageCount = $this->db->query(
	            "select count(order_id) as count_res from `order` where users_system_id = '$user'"
	        )->first_row();
	
	        if ((int)$pageCount->count_res < 1) {
	            $this->response(1, "You haven't placed any order yet", []);
	        }
	        $orders = $this->db->query("select o.*,u.user_address,os.source_title from `order` o left join user_address u on u.address_id = o.address_id left join order_source os on o.order_source_id = os.order_source_id where o.users_system_id = '$user' order by o.order_id desc ")->result();
			$ordersResp = array();
	        foreach ($orders as $order) {
	            $productss = $this->db->query("select * from order_products op left join product on op.product_id = product.product_id where op.order_id = " . $order->order_id)->result();
	            $attrs = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on pa.product_attribute_id = opa.product_attribute_id where order_id = ".$order->order_id)->result();
	
	            $products = [];
	            foreach ($productss as $product) {
	                $a = [];
	                for ($i = 0; $i < count($attrs); $i++) {
	                    if ($attrs[$i]->order_product_id == $product->order_products_id) {
	                        $a[] = $attrs[$i];
	                    }
	                }
	                $product->attributes = $a;
	                $products[] = $product;
	            }
	            $order->products = $products;
	            $ordersResp[] = $order;
	        }
	
	        $count = $pageCount->count_res;
	
	        $resp["orders"] = $ordersResp;
	        // $resp["current_page_index"] = $pageNumber;
	        $resp["total_page_count"] = $this->get_total_page_count($count);
	
	        $this->response(1, "Successfully Loaded Product", $resp);
	    }

    public function getOrderData($order_id)
    {
        $order = $this->db->get_where("order", ["order_id" => $order_id])->first_row();
        // print_r($order_id);
        // exit;
        $order_products = $this->db->query("select * from order_products op left join product on op.product_id = product.product_id where op.order_id = " . $order->order_id)->result();
        $attrs = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on pa.product_attribute_id = opa.product_attribute_id where order_id = '$order_id'")->result();
        $orderap = $this->db->get_where("order_additional_product", ["order_id" => $order_id])->result();
        $products = [];
        foreach ($order_products as $product) {
            $a = [];
            for ($i = 0; $i < count($attrs); $i++) {
                if ($attrs[$i]->product_id == $product->product_id) {
                    $a[] = $attrs[$i];
                }
            }
            $product->attributes = $a;
            $products[] = $product;
        }

        $order->products = $order_products;
        $order->additional_products = $orderap;
        return $order;
    }
    public function get_order_sources(){
        $products = $this->db->get_where("order_source",["status"=>"Online"])->result();
        if ($products) {

            // $pageCount = $this->db->query(
            //     "select count(product_id) as count_res from product p left join category c on c.category_id = p.category_id"
            // )->first_row();

            // $count = $pageCount->count_res;

            $resp = $products;
            // $resp["current_page_index"] = $pageNumber;
            // $resp["total_page_count"] = $this->get_total_page_count($count);


            $this->response(1, "Successfully Loaded Product", $resp);
        } else {
            $this->response(0, "Cannot Load Products", []);
        }
    }
    public function c_suggested_products(){
        $this->checkToken();
        $pageNumber = 1;

        if (isset($_REQUEST['page'])) {
            // $this->response(0, "Missing Params", []);
            $pageNumber = $_REQUEST['page'];
        }
        $page = 10 * $pageNumber;
        $startPage = $page - 10;

        $products = $this->db->query("select p.*,p.status as product_status , p.product_name_" . $this->language . " as lang_product_name, p.product_detail_" . $this->language . " as lang_product_detail, c.category_title_" . $this->language . " as lang_category_title ,c.status as category_status,c.category_title_en,c.category_title_ch from c_suggested_product csp left join product p on p.product_id = csp.product_id left join category c on c.category_id = p.category_id order  by p.position_order ASC ")->result();
       if ($products) {

            $pageCount = $this->db->query(
                "select count(product_id) as count_res from product p left join category c on c.category_id = p.category_id"
            )->first_row();

            $count = $pageCount->count_res;
            $product_watermark = $this->db->query("select * from product_watermarks pws left join product_watermark pw on pws.product_watermark_id = pw.product_watermark_id")->result();
            $mass_discounts= $this->db->query("select * from mass_discount where status = 'Online' And start_time <= '".date("Y-m-d h:i:s")."' And end_time >= '".date("Y-m-d h:i:s")."'")->result();
            // echo $this->db->last_query();
            $ids = [];
            foreach($mass_discounts as $discount){
                $ids[] = $discount->mass_discount_id;
            }
            $categories = [];
            if(count($mass_discounts) > 0){
                $in = implode($ids,",");
                $categories = $this->db->query("select * from mass_discount_categories where mass_discount_id in ($in)")->result();
            }
            $prods = [];
            foreach($products as $product){
                $wm = [];
                for($i = 0 ; $i < count($product_watermark) ; $i++){
                    if($product_watermark[$i]->product_id == $product->product_id){
                        $wm[] = $product_watermark[$i];
                    }
                }
                
                foreach($mass_discounts as $discount){
                    if($discount->coupon_condition == "For Categories"){
                        for($j = 0 ; $j < count($categories) ; $j++){
                            if($product->category_id == $categories[$j]->category_id){
                                $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
                                $product->price_after_discount = $product->original_price - $d_amount;
                                $product->discount_amount = $d_amount;
                                $product->disount_expiry = $discount->end_time;
                                $product->discount_start_time = $discount->start_time;
                                break;
                            }
                        }
                    }else{
                            $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
                            $product->price_after_discount = $product->original_price - $d_amount;
                            $product->discount_amount = $d_amount;
                            $product->disount_expiry = $discount->end_time;
                            $product->discount_start_time = $discount->start_time;
                    }
                }
                
                
                $product->product_watermark = $wm;
                
                $prods[] = $product;
            }
            $resp["products"] = $prods;
            $resp["current_page_index"] = $pageNumber;
            $resp["total_page_count"] = $this->get_total_page_count($count);


            $this->response(1, "Successfully Loaded Product", $resp);
        } else {
            $this->response(0, "Cannot Load Products", []);
        }
    }

    public function use_cart_coupon()
    {
        if (!isset($_REQUEST["code"])) {
            $this->response(0, "Missing params", []);
        }
        $user_id = '';
        if (!isset($_REQUEST['cart_id'])) {
            $this->response(0, "Missing params", []);
        }
        $code = $_REQUEST["code"];
        $cart_id = $_REQUEST["cart_id"];
        $res = $this->db->get_where("coupons", ["code" => $code, "c_type" => "Coupon"])->result();
        if(count($res) < 1){
            $this->response(0, "Not valid coupon", []);
        }
		if($res[0]->coupon_qty < 1){
			 $this->response(0, "cannot use this coupon", []);
		}
        $cart = $this->db->get_where("cart",["cart_id"=>$cart_id])->first_row();
        if(count($cart) < 1){
            $this->response(0, "Not valid cart", []);
        }
        $coupon_pre_discount = 0;
//        if($cart->coupon_id != 0){
//            //$couponPreResult = $this->db->get_where("coupons",["coupons_id"=>$cart->coupon_id])->first_row();
//            // $coupon_pre_discount = $cart->coupon_discount;
//            $this->response(0, "Already used a coupon in this cart", []);
//        }
        $coupon = $res[0];
        if($coupon->coupon_condition == "No Limit"){
            // $cart->grand_total =  $cart->grand_total - $coupon_pre_discount;
            // $cart->discount = $cart->discount $coupon_pre_discount;
            
            $totalDiscount = $coupon->discount_type == "Percentage"?($cart->grand_total * $coupon->percentage)/100:$coupon->amount;
        
            $grandTotal = $cart->grand_total - $totalDiscount;
            $this->db->update("cart",["coupon_id"=>$coupon->coupons_id],["cart_id"=>$cart_id]);
            $this->db->update("coupons",["coupon_qty"=>($coupon->coupon_qty - 1)],["coupons_id"=>$coupon->coupons_id]);

        }else if($coupon->coupon_condition == "For Categories"){
            
            // $cart->grand_total =  $cart->grand_total - $coupon_pre_discount;
            // $cart->discount = $cart->discount - $coupon_pre_discount;
             
            $categories = $this->db->query("select * from coupon_categories cc left join category c on c.category_id = cc.category_id where cc.coupons_id = ".$coupon->coupons_id)->result();

            $cart_products =  $this->db->query("select * from cart_product cp left join product p on p.product_id = cp.product_id where cart_id = ".$cart_id)->result();
            $totalDiscount = 0;

            foreach($categories as $category){
                for( $i = 0 ; $i < count($cart_products) ; $i++){
                    if($category->category_id == $cart_products[$i]->category_id){
                        $totalDiscount += $coupon->discount_type == "Percentage"?($cart_products[$i]->total * $coupon->percentage)/100:$coupon->amount;
                    }
                }
            }
            $grandTotal = $cart->grand_total - $totalDiscount;
            $this->db->update("cart",["coupon_id"=>$coupon->coupons_id],["cart_id"=>$cart_id]);
            $this->db->update("coupons",["coupon_qty"=>($coupon->coupon_qty - 1)],["coupons_id"=>$coupon->coupons_id]);
        }else{
            $products = $this->db->query("select * from coupon_products cc left join product c on c.product_id = cc.product_id where cc.coupons_id = ".$coupon->coupons_id)->result();

            $cart_products =  $this->db->query("select * from cart_product cp left join product p on p.product_id = cp.product_id where cart_id = ".$cart_id)->result();
            $totalDiscount = 0;

            foreach($products as $product){
                for( $i = 0 ; $i < count($cart_products) ; $i++){
                    if($product->product_id == $cart_products[$i]->product_id){
                        $totalDiscount += $coupon->dicount_type == "Percentage"?($cart_products[$i]->total * $coupon->percentage)/100:$coupon->amount;
                    }
                }
            }
            $grandTotal = $cart->grand_total - $totalDiscount;
            $this->db->update("cart",["coupon_id"=>$coupon->coupons_id],["cart_id"=>$cart_id]);
            $this->db->update("coupons",["coupon_qty"=>($coupon->coupon_qty - 1)],["coupons_id"=>$coupon->coupons_id]);
        }

        $cart = $this->get_current_cart($cart_id);
        $this->response(1,"Success",$cart);

    }
    public function use_cart_voucher()
    {
        if (!isset($_REQUEST["code"])) {
            $this->response(0, "Missing params", []);
        }
        if (!isset($_REQUEST["password"])) {
            $this->response(0, "Missing params", []);
        }
        $user_id = '';
        if (!isset($_REQUEST['cart_id'])) {
            $this->response(0, "Missing params", []);
        }
        $code = $_REQUEST["code"];
        $password = $_REQUEST["password"];
        $cart_id = $_REQUEST["cart_id"];
        $res = $this->db->get_where("coupons", ["code" => $code,"password" => $password, "c_type" => "Voucher"])->result();
        if(count($res) < 1){
            $this->response(0, "Not valid coupon", []);
        }
        $cart = $this->db->get_where("cart",["cart_id"=>$cart_id])->first_row();
        if(count($cart) < 1){
            $this->response(0, "Not valid cart", []);
        }
        if($cart->coupon_id != 0){
            $this->response(0, "Already used a voucher in this cart", []);
        }
        $coupon = $res[0];
        if($coupon->coupon_condition == "No Limit"){
            $totalDiscount = $coupon->discount_type == "Percentage"?($cart->grand_total * $coupon->percentage)/100:$coupon->amount;
            $grandTotal = $cart->grand_total - $totalDiscount;
            $this->db->update("cart",["grand_total"=>$grandTotal,"discount"=>$totalDiscount+ $cart->discount,"coupon_id"=>$coupon->coupons_id],["cart_id"=>$cart_id]);
            $this->db->update("coupons",["coupon_qty"=>($coupon->coupon_qty - 1)],["coupons_id"=>$coupon->coupons_id]);

        }else if($coupon->coupon_condition == "For Categories"){
            $categories = $this->db->query("select * from coupon_categories cc left join category c on c.category_id = cc.category_id where cc.coupons_id = ".$coupon->coupons_id)->result();

            $cart_products =  $this->db->query("select * from cart_product cp left join product p on p.product_id = cp.product_id where cart_id = ".$cart_id)->result();
            $totalDiscount = 0;

            foreach($categories as $category){
                for( $i = 0 ; $i < count($cart_products) ; $i++){
                    if($category->category_id == $cart_products[$i]->category_id){
                        $totalDiscount += $coupon->dicount_type == "Percentage"?($cart_products[$i]->total * $coupon->percentage)/100:$coupon->amount;
                    }
                }
            }
            $grandTotal = $cart->grand_total - $totalDiscount;
            $this->db->update("cart",["grand_total"=>$grandTotal,"discount"=>$totalDiscount+ $cart->discount,"coupon_id"=>$coupon->coupons_id],["cart_id"=>$cart_id]);
            $this->db->update("coupons",["coupon_qty"=>($coupon->coupon_qty - 1)],["coupons_id"=>$coupon->coupons_id]);
        }else{
            $products = $this->db->query("select * from coupon_products cc left join product c on c.product_id = cc.product_id where cc.coupons_id = ".$coupon->coupons_id)->result();

            $cart_products =  $this->db->query("select * from cart_product cp left join product p on p.product_id = cp.product_id where cart_id = ".$cart_id)->result();
            $totalDiscount = 0;

            foreach($products as $product){
                for( $i = 0 ; $i < count($cart_products) ; $i++){
                    if($product->product_id == $cart_products[$i]->product_id){
                        $totalDiscount += $coupon->dicount_type == "Percentage"?($cart_products[$i]->total * $coupon->percentage)/100:$coupon->amount;
                    }
                }
            }
            $grandTotal = $cart->grand_total - $totalDiscount;
            $this->db->update("cart",["grand_total"=>$grandTotal,"discount"=>$totalDiscount+ $cart->discount,"coupon_id"=>$coupon->coupons_id],["cart_id"=>$cart_id]);
            $this->db->update("coupons",["coupon_qty"=>($coupon->coupon_qty - 1)],["coupons_id"=>$coupon->coupons_id]);
        }

        $cart = $this->get_current_cart($cart_id);
        $this->response(1,"Success",$cart);

    }

    public function use_coupon()
    {
        $this->checkToken();
        if (!isset($_REQUEST["code"])) {
            $this->response(0, "Missing params", []);
        }
        $user_id = '';
        if (isset($_REQUEST['user_id'])) {
            $user_id = $_REQUEST['user_id'];
        }
        $code = $_REQUEST["code"];
        $currentTime = date('Y-m-d h:i:s');
        $couponsRes = $this->db->query("select * from coupons where c_type = 'Coupon' And code = '$code' And coupon_qty > 0 And status = 'Online' And start_time < '$currentTime' And end_time > '$currentTime'");
//        echo $this->db->last_query();

        if (!$couponsRes) {
            $this->response(0, "Unable to get response", []);
        }
//        exit();
        $couponProducts = $this->db->query("select * from coupon_products cp left join coupons c on c.coupons_id = cp.coupons_id left join product p on p.product_id = cp.product_id where p.status = 'Online' And c.status = 'Online'")->result();

        $couponCategories = $this->db->query("select * from coupon_categories cc left join coupons c on c.coupons_id = cc.coupons_id left join category cat on cat.category_id = cc.category_id where cat.status = 'Online' And c.status = 'Online'")->result();

        $couponFrequencies = $this->db->query("select * from coupon_frequencies cfs left join coupons c on c.coupons_id = cfs.coupons_id left join coupon_frequency cf on cf.coupon_frequency_id = cfs.coupon_frequency_id where cf.status = 'Online' And c.status = 'Online'")->result();

        $coupons = $couponsRes->result();
        if (count($coupons) < 1) {
            $this->response(0, "cannot find coupon", []);
        }
        $response = [];
        foreach ($coupons as $coupon) {

            if ($coupon->coupon_condition == "For Categories") {
                $categoryArray = [];
                for ($i = 0; $i < count($couponCategories); $i++) {
                    if ($coupon->coupons_id == $couponCategories[$i]->coupons_id) {
                        $coCategory = [];
                        $coCategory["category_id"] = $couponCategories[$i]->category_id;
                        $coCategory["category_title_en"] = $couponCategories[$i]->category_title_en;
                        $coCategory["category_title_ch"] = $couponCategories[$i]->category_title_en;
                        $categoryArray[] = $coCategory;
                    }
                }
                $coupon->categories = $categoryArray;
            } else if ("For Products") {
                $productsArray = [];
                for ($j = 0; $j < count($couponProducts); $j++) {
                    if ($coupon->coupons_id == $couponProducts[$j]->coupons_id) {
                        $coProduct = [];
                        $coProduct["product_id"] = $couponProducts[$j]->product_id;
                        $coProduct["product_name_en"] = $couponProducts[$j]->product_name_en;
                        $coProduct["product_name_ch"] = $couponProducts[$j]->product_name_ch;
                        $productsArray[] = $coProduct;
                    }
                }
                $coupon->products = $productsArray;
            }
            $frequencies = [];
            for ($k = 0; $k < count($couponFrequencies); $k++) {
                if ($couponFrequencies[$k]->coupons_id == $coupon->coupons_id) {
                    $frequencies[] = $couponFrequencies[$k]->day;
                }
            }
            $coupon->frequencies = $frequencies;

            $res = $this->db->update("coupons", ["coupon_qty" => $coupon->coupon_qty - 1], ["coupons_id" => $coupon->coupons_id]);
            if ($res) {
                $coupon->coupon_qty -= 1;
            }
            $response[] = $coupon;
            if (!empty($user_id)) {
                $this->db->insert("coupon_use", ["user_id" => $user_id, "coupons_id" => $coupon->coupons_id]);
            }
        }
        return $this->response(1, "success", $response);
    }

    public function use_voucher()
    {
        $this->checkToken();
        if (!isset($_REQUEST["code"])) {
            $this->response(0, "Missing params", []);
        }
        if (!isset($_REQUEST["password"])) {
            $this->response(0, "Missing params", []);
        }
        $user_id = '';
        if (isset($_REQUEST['user_id'])) {
            $user_id = $_REQUEST['user_id'];
        }
        $code = $_REQUEST["code"];
        $password = $_REQUEST["password"];
        $couponsRes = $this->db->query("select * from coupons where c_type = 'Voucher' And code = '$code' AND password = '$password' And coupon_qty > 0 And status = 'Online'");

        if (!$couponsRes) {
            $this->response(0, "Unable to get response", []);
        }
        $couponProducts = $this->db->query("select * from coupon_products cp left join coupons c on c.coupons_id = cp.coupons_id left join product p on p.product_id = cp.product_id where p.status = 'Online' And c.status = 'Online'")->result();

        $couponCategories = $this->db->query("select * from coupon_categories cc left join coupons c on c.coupons_id = cc.coupons_id left join category cat on cat.category_id = cc.category_id where cat.status = 'Online' And c.status = 'Online'")->result();

        $couponFrequencies = $this->db->query("select * from coupon_frequencies cfs left join coupons c on c.coupons_id = cfs.coupons_id left join coupon_frequency cf on cf.coupon_frequency_id = cfs.coupon_frequency_id where cf.status = 'Online' And c.status = 'Online'")->result();

        $coupons = $couponsRes->result();
        if (count($coupons) < 1) {
            $this->response(0, "cannot find coupon", []);
        }
        $response = [];
        foreach ($coupons as $coupon) {

            if ($coupon->coupon_condition == "For Categories") {
                $categoryArray = [];
                for ($i = 0; $i < count($couponCategories); $i++) {
                    if ($coupon->coupons_id == $couponCategories[$i]->coupons_id) {
                        $coCategory = [];
                        $coCategory["category_id"] = $couponCategories[$i]->category_id;
                        $coCategory["category_title_en"] = $couponCategories[$i]->category_title_en;
                        $coCategory["category_title_ch"] = $couponCategories[$i]->category_title_en;
                        $categoryArray[] = $coCategory;
                    }
                }
                $coupon->categories = $categoryArray;
            } else if ("For Products") {
                $productsArray = [];
                for ($j = 0; $j < count($couponProducts); $j++) {
                    if ($coupon->coupons_id == $couponProducts[$j]->coupons_id) {
                        $coProduct = [];
                        $coProduct["product_id"] = $couponProducts[$j]->product_id;
                        $coProduct["product_name_en"] = $couponProducts[$j]->product_name_en;
                        $coProduct["product_name_ch"] = $couponProducts[$j]->product_name_ch;
                        $productsArray[] = $coProduct;
                    }
                }
                $coupon->products = $productsArray;
            }
            $frequencies = [];
            for ($k = 0; $k < count($couponFrequencies); $k++) {
                if ($couponFrequencies[$k]->coupons_id == $coupon->coupons_id) {
                    $frequencies[] = $couponFrequencies[$k]->day;
                }
            }
            $coupon->frequencies = $frequencies;

            $res = $this->db->update("coupons", ["coupon_qty" => $coupon->coupon_qty - 1], ["coupons_id" => $coupon->coupons_id]);
            if ($res) {
                $coupon->coupon_qty -= 1;
            }
            $response[] = $coupon;
            if (!empty($user_id)) {
                $this->db->insert("coupon_use", ["user_id" => $user_id, "coupons_id" => $coupon->coupons_id]);
            }
        }
        return $this->response(1, "success", $response);

    }

    public function get_all_vouchers()
    {
        $couponsRes = $this->db->query("select * from coupons where c_type = 'Voucher' And coupon_qty > 0 And status = 'Online'");

        if (!$couponsRes) {
            $this->response(0, "Unable to get response", []);
        }
        $couponProducts = $this->db->query("select * from coupon_products cp left join coupons c on c.coupons_id = cp.coupons_id left join product p on p.product_id = cp.product_id where p.status = 'Online' And c.status = 'Online'")->result();

        $couponCategories = $this->db->query("select * from coupon_categories cc left join coupons c on c.coupons_id = cc.coupons_id left join category cat on cat.category_id = cc.category_id where cat.status = 'Online' And c.status = 'Online'")->result();

        $couponFrequencies = $this->db->query("select * from coupon_frequencies cfs left join coupons c on c.coupons_id = cfs.coupons_id left join coupon_frequency cf on cf.coupon_frequency_id = cfs.coupon_frequency_id where cf.status = 'Online' And c.status = 'Online'")->result();

        $coupons = $couponsRes->result();
        if (count($coupons) < 1) {
            $this->response(0, "cannot find coupon", []);
        }
        $response = [];
        foreach ($coupons as $coupon) {

            if ($coupon->coupon_condition == "For Categories") {
                $categoryArray = [];
                for ($i = 0; $i < count($couponCategories); $i++) {
                    if ($coupon->coupons_id == $couponCategories[$i]->coupons_id) {
                        $coCategory = [];
                        $coCategory["category_id"] = $couponCategories[$i]->category_id;
                        $coCategory["category_title_en"] = $couponCategories[$i]->category_title_en;
                        $coCategory["category_title_ch"] = $couponCategories[$i]->category_title_en;
                        $categoryArray[] = $coCategory;
                    }
                }
                $coupon->categories = $categoryArray;
            } else if ("For Products") {
                $productsArray = [];
                for ($j = 0; $j < count($couponProducts); $j++) {
                    if ($coupon->coupons_id == $couponProducts[$j]->coupons_id) {
                        $coProduct = [];
                        $coProduct["product_id"] = $couponProducts[$j]->product_id;
                        $coProduct["product_name_en"] = $couponProducts[$j]->product_name_en;
                        $coProduct["product_name_ch"] = $couponProducts[$j]->product_name_ch;
                        $productsArray[] = $coProduct;
                    }
                }
                $coupon->products = $productsArray;
            }
            $frequencies = [];
            for ($k = 0; $k < count($couponFrequencies); $k++) {
                if ($couponFrequencies[$k]->coupons_id == $coupon->coupons_id) {
                    $frequencies[] = $couponFrequencies[$k]->day;
                }
            }
            $coupon->frequencies = $frequencies;

//            $res = $this->db->update("coupons",["coupon_qty"=>$coupon->coupon_qty-1],["coupons_id"=>$coupon->coupons_id]);
//            if($res){
//                $coupon->coupon_qty -= 1;
//            }
            $response[] = $coupon;
        }
        return $this->response(1, "success", $response);
    }

    public function get_all_coupons()
    {
        $couponsRes = $this->db->query("select * from coupons where c_type = 'Coupon' And coupon_qty > 0 And status = 'Online'");

        if (!$couponsRes) {
            $this->response(0, "Unable to get response", []);
        }
        $couponProducts = $this->db->query("select * from coupon_products cp left join coupons c on c.coupons_id = cp.coupons_id left join product p on p.product_id = cp.product_id where p.status = 'Online' And c.status = 'Online'")->result();

        $couponCategories = $this->db->query("select * from coupon_categories cc left join coupons c on c.coupons_id = cc.coupons_id left join category cat on cat.category_id = cc.category_id where cat.status = 'Online' And c.status = 'Online'")->result();

        $couponFrequencies = $this->db->query("select * from coupon_frequencies cfs left join coupons c on c.coupons_id = cfs.coupons_id left join coupon_frequency cf on cf.coupon_frequency_id = cfs.coupon_frequency_id where cf.status = 'Online' And c.status = 'Online'")->result();

        $coupons = $couponsRes->result();
        if (count($coupons) < 1) {
            $this->response(0, "cannot find coupon", []);
        }
        $response = [];
        foreach ($coupons as $coupon) {

            if ($coupon->coupon_condition == "For Categories") {
                $categoryArray = [];
                for ($i = 0; $i < count($couponCategories); $i++) {
                    if ($coupon->coupons_id == $couponCategories[$i]->coupons_id) {
                        $coCategory = [];
                        $coCategory["category_id"] = $couponCategories[$i]->category_id;
                        $coCategory["category_title_en"] = $couponCategories[$i]->category_title_en;
                        $coCategory["category_title_ch"] = $couponCategories[$i]->category_title_en;
                        $categoryArray[] = $coCategory;
                    }
                }
                $coupon->categories = $categoryArray;
            } else if ("For Products") {
                $productsArray = [];
                for ($j = 0; $j < count($couponProducts); $j++) {
                    if ($coupon->coupons_id == $couponProducts[$j]->coupons_id) {
                        $coProduct = [];
                        $coProduct["product_id"] = $couponProducts[$j]->product_id;
                        $coProduct["product_name_en"] = $couponProducts[$j]->product_name_en;
                        $coProduct["product_name_ch"] = $couponProducts[$j]->product_name_ch;
                        $productsArray[] = $coProduct;
                    }
                }
                $coupon->products = $productsArray;
            }
            $frequencies = [];
            for ($k = 0; $k < count($couponFrequencies); $k++) {
                if ($couponFrequencies[$k]->coupons_id == $coupon->coupons_id) {
                    $frequencies[] = $couponFrequencies[$k]->day;
                }
            }
            $coupon->frequencies = $frequencies;

//            $res = $this->db->update("coupons",["coupon_qty"=>$coupon->coupon_qty-1],["coupons_id"=>$coupon->coupons_id]);
//            if($res){
//                $coupon->coupon_qty -= 1;
//            }
            $response[] = $coupon;
        }
        return $this->response(1, "success", $response);
    }
    public function get_sp_points_log(){
            $id = $_REQUEST['id'];
            $this->db->order_by("points_log_id", "DESC");
            $res = $this->db->get_where("points_log", ["user_id" => $id]);
            $data = [];
            if ($res) {
                 $this->response(1, "success", $res->result());
                // $data["result"] = $res->result();
                // $data["status"] = 1;

            } else {
                $this->response(0, "cannot get sp points log", []);
                //   $data["result"] = $res->result();
                // $data["status"] = 1;
            }
            // echo json_encode($data);
    }
    
//=========:::::::::::::::::::::::::: SOURCE PAN IPAD SECTION :::::::::::::::::::::::::::::::::::::::::;
//=========:::::::::::::::::::::::::: SOURCE PAN IPAD SECTION :::::::::::::::::::::::::::::::::::::::::;
//=========:::::::::::::::::::::::::: SOURCE PAN IPAD SECTION :::::::::::::::::::::::::::::::::::::::::;
//=========:::::::::::::::::::::::::: SOURCE PAN IPAD SECTION :::::::::::::::::::::::::::::::::::::::::;
//=========:::::::::::::::::::::::::: SOURCE PAN IPAD SECTION :::::::::::::::::::::::::::::::::::::::::;


 public function update_sp_send_by(){
        $status = $_POST["status"];
        $id = $_POST["id"];
        $res = $this->db->update('order', ["send_by" => $status], ['order' . "_id" => $id]);
	/*	if($status=='Process'){
			$this->OrderModel->sendwechatnotice_orderprocessing($id);
		
		}else if($status=='Completed'){
			$this->OrderModel->sendwechatnotice_ordershipped($id);
		
		}else if($status=='Cancel'){
			$this->OrderModel->sendwechatnotice_ordercancelled($id);
		
		}*/
		if($res){
            $this->response(1,"success",[]);
		}else{
		    $this->response(0,"success",[]);
		}
        exit();
    }
    


    public function update_sp_order_status(){
       
        $status = $_POST["status"];
        $id = $_POST["id"];
        $this->db->update('order', ["order_status" => $status], ['order' . "_id" => $id]);
		if($status=='Process'){
			$this->OrderModel->sendwechatnotice_orderprocessing($id);
		}else if($status=='Completed'){
			$this->OrderModel->sendwechatnotice_ordershipped($id);
		}else if($status=='Cancel'){
			$this->OrderModel->sendwechatnotice_ordercancelled($id);
		}
        $this->response(1,"success",[]);
       
        exit();
    }
    
    
 public function update_sp_points(){
        $param2 = $_POST['user_id'];

        $muser = $this->db->get_where('users_system', array('users_system_id' => $param2))->first_row();
            
            $sp_type = $_POST['type'];
            $sp_points = $_POST['sp_points'];
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

	if($result){
        $this->response(1,"success",[]);
    }else{
        $this->response(0,"success",[]);
    }
        exit();
    }
    public function refund_sp_points(){
//        $param2 = $_POST['user_id'];
        $order_id = $_POST['order_id'];
        $sp_points = $_POST['sp_points'];

//        $param1 = $_POST['order_id'];
        $this->db->where("order_id",$order_id);
        $this->db->where("order_status!=","Refund");
        $order = $this->db->get("order");
        if(!$order){
            $this->response(0,"not a valid order",[]);
        }
        if(count($order->result()) < 1){
            $this->response(0,"not a valid order",[]);
        }
        $order = $order->first_row();

        $muser = $this->db->get_where('users_system', array('users_system_id' => $order->users_system_id))->first_row();

//        $sp_type = $_POST['type'];
        $sp_points = $_POST['sp_points'];
        if (!empty($sp_points)) {
            $saveData['sp_points'] = $sp_points + $muser->sp_points;
        }else{
            $this->response(0,"not sp points",[]);
        }

//        $this->db->where('users_system_id',  $order->users_system_id);
        $result = $this->db->update('users_system', $saveData,["users_system_id"=>$order->users_system_id]);
        if($result){
            //NEED TO RUN QURIES IN DATABASE
            $orderUpRes = $this->db->update("order",["order_status"=>"Refund","refund_sp_points"=>$sp_points],["order_id"=>$order->order_id]);
            if(!$orderUpRes){
                $this->response(0,"failed",[]);
            }
        }
        if (!empty($sp_points)) {
            $id =  $order->users_system_id;
//            $type = $sp_type == "increase" ? "Increment" : "Decrement";
            $points = $sp_points;
            $saveData2 = ["user_id" => $id, "type" => "Increment", "description" => "Added from refund for order# ".$order->order_id, "points" => $points, "current_points" => $saveData['sp_points']];
            $result2 = $this->db->insert('points_log', $saveData2);

        }

        if($result){
            $this->response(1,"success",[]);
        }else{
            $this->response(0,"failed",[]);
        }
        exit();
    }
    public function get_sp_customers(){
        $condition = '';
        if(isset($_POST['query'])){
            if(!empty($_POST['query'])){
                $query = $_POST['query'];
                $condition = ' Where first_name LIKE "%'.$query.'%"';
                $condition .= ' Or sp_points LIKE "%'.$query.'%"';
                $condition .= ' Or last_name LIKE "%'.$query.'%"';
                $condition .= ' Or email LIKE "%'.$query.'%"';
                $condition .= ' Or mobile LIKE "%'.$query.'%"';
            }
        }
        $res = $this->db->query("select * from users_system $condition Limit 500")->result();


	if($res){
        $this->response(1,"success",$res);
    }else{
        $this->response(0,"success",[]);
    }
        exit();
    }
//========
    public function get_sp_orders2(){
        $today = date('Y-m-d');
        $condition = ' where (o.order_status = "Pending" or o.order_status = "Shipping" or o.order_status = "Process") and o.payment_status = "Paid" and o.created_at > "'.$today.' 00:00:01"';
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $condition = " And o.users_system_id = $user_id";
        }
        if (isset($_POST['order_no'])) {
            if(!empty($_POST['order_no'])){
                $order_no = $_POST['order_no'];
                if(empty($condition)){
                    $condition .= "Where ";
                }else{
                    $condition .= " And ";
                }
                $condition .= " o.order_id = $order_no";
            }
        }
        if (isset($_POST['search_status'])) {
            if(!empty($_POST['search_status'])){
                $search_status = $_POST['search_status'];
                if(empty($condition)){
                    $condition .= "Where ";
                }else{
                    $condition .= " And ";
                }
                $condition .= " o.order_status = '$search_status'";
            }
        }
        $resp = $this->db->query("select *,o.created_at as o_created_at from `order` o left join users_system u on u.users_system_id = o.users_system_id left join user_address ua on ua.address_id = o.address_id $condition Order by order_id desc");

        $printer_group = $this->db->get_where("printer_group",["status"=>"Online"])->result();
        // $groupsId = [];
        $groupsDetails = [];
        foreach($printer_group as $group){
            $groupsDetails[$group->printer_group_id] = $group->group_title;
        }
        $orders = array();
        foreach ($resp->result() as $order) {
            $products = $this->db->query("select * from order_products op left join product p on p.product_id = op.product_id where op.order_id = " . $order->order_id . " order by op.order_products_id ASC")->result_array();
            $prods = [];
            foreach ($products as $k => $product) {

                $attrs = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on opa.product_attribute_id = pa.product_attribute_id where opa.product_id = " . $product['product_id'] . " And opa.order_id = " . $order->order_id . " order by pa.product_attribute_id desc")->result();
                $a = array();
              //  $mCheck = false;
                $tArray = array();
                for ($j = 0; $j < count($attrs); $j++) {
                    if ($attrs[$j]->product_id == $product['product_id']) {
                        if (isset($groupsDetails[$attrs[$j]->printer_group_id])) {
                            $group_name = str_replace(' ', '_', $groupsDetails[$attrs[$j]->printer_group_id]);
                            if($attrs[$j]->printer_group_id != 1)
                            $a[$group_name][] = $attrs[$j];
                        }
                        $a['Receipt'][] = $attrs[$j];

                    }
                }

                $product['attributes'] = $a;

                if (isset($groupsDetails[$product['printer_group_id']])) {
                    $group_name = str_replace(' ', '_', $groupsDetails[$product['printer_group_id']]);
                    if($product['printer_group_id'] != 1)
                        $prods[$group_name][] = $product;
//                    $check = true;
                }
                $pro = $product;
                if(count($attrs) > 0){
                  $pro['attributes'] = $product['attributes']['Receipt'];
                }
//                echo "<pre>";
//                print_r($pro);
//                exit();


                $prods['Receipt'][] = $pro;

            }

            $order->products = $prods;
            $orders[] = $order;
        }

        $this->response(1,"success",$orders);
        /*
        $today = date('Y-m-d');
        $condition = ' where (o.order_status = "Pending" or o.order_status = "Shipping" or o.order_status = "Process") and o.payment_status = "Paid" and o.created_at > "'.$today.' 00:00:01"';
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $condition = " And o.users_system_id = $user_id";
        }
        if (isset($_POST['order_no'])) {
            if(!empty($_POST['order_no'])){
                $order_no = $_POST['order_no'];
                if(empty($condition)){
                    $condition .= "Where ";
                }else{
                    $condition .= " And ";
                }
                $condition .= " o.order_id = $order_no";
            }
        }
        //print_r($_REQUEST);
//        $_REQUEST['order_no'] . " no";
        if (isset($_POST['search_status'])) {
            if(!empty($_POST['search_status'])){
                $search_status = $_POST['search_status'];
                if(empty($condition)){
                    $condition .= "Where ";
                }else{
                    $condition .= " And ";
                }
                $condition .= " o.order_status = '$search_status'";
            }
        }
        $resp = $this->db->query("select *,o.created_at as o_created_at from `order` o left join users_system u on u.users_system_id = o.users_system_id left join user_address ua on ua.address_id = o.address_id $condition Order by order_id desc");
        $printer_group = $this->db->get_where("printer_group",["status"=>"Online"])->result();
        // $groupsId = [];
        $groupsDetails = [];
        foreach($printer_group as $group){
            $groupsDetails[$group->printer_group_id] = $group->group_title;
        }
        $orders = array();
        foreach ($resp->result() as $order) {
            $products = $this->db->query("select * from order_products op left join product p on p.product_id = op.product_id where op.order_id = " . $order->order_id . " order by op.order_products_id ASC")->result();

            $_prods = [];
            $i = 0;
            foreach ($products as $k => $product) {
                $prods = [];
                $attrs = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on opa.product_attribute_id = pa.product_attribute_id where opa.product_id = " . $product->product_id . " And opa.order_id = " . $order->order_id . " order by pa.product_attribute_id ASC")->result();
               // $prods[] = $product;

// 		$pgroup = [];
//                 $check = false;
//                 //$product->attributes = $a;
//                 foreach($printer_group as $group){
//                     if($group->printer_group_id == $product->printer_group_id){
//                         $group_name = str_replace(' ', '_', $group->group_title);
//                         $prods[$group_name][] = $product;
//                         //$prod[$group->group_title][] = $product;
//                         $check = true;
//                     }
//                 }
                $a = array();
                $mCheck = false;
                $tArray = array();
                for ($j = 0; $j < count($attrs); $j++) {
                    if ($attrs[$j]->product_id == $product->product_id) {
                        if (isset($groupsDetails[$attrs[$j]->printer_group_id])) {
                            $group_name = str_replace(' ', '_', $groupsDetails[$attrs[$j]->printer_group_id]);
                            $a[$group_name][] = $attrs[$j];
                        }
                            $a['Receipt'][] = $attrs[$j];
                        $tArray[] = $attrs[$j];
                        $mCheck = true;
                    }
                }

//                $mattrs = [];
//                foreach($attrs as $attr){
//                    if($attr->product_id == $product->product_id){
//
//                    }
//                }
                $pgroup = [];
                $check = false;
                $rProduct = [];
                $rProduct = $product;
                $product->attributes = $a;
                if (isset($groupsDetails[$product->printer_group_id])) {
                    $group_name = str_replace(' ', '_', $groupsDetails[$product->printer_group_id]);
                    $prods[$group_name][$i] = $product;
                    $check = true;
                }
//                print_r()
                $attms = [];
                if($mCheck) {
                    $attms = $product->attributes["Receipt"];
                }

                $product->attributes = $attms;
                $prods["Receipt"][$i] = $product;

//                if($mCheck){
//                    $rProduct->attributes = $tArray;
//                }else{
//                    $rProduct->attributes = [];
//                }

//                $_prods = $prods;
//                $i++;

            }
            $order->products = $prods;
            $orders[] = $order;
        }
//        $data["table_data"] = $orders;
        $this->response(1,"success",$orders); */
    }
    // ================
    
    public function get_sp_orders($type = "not_pre"){
        $today = date('Y-m-d');
        // and o.created_at > "'.$today.' 00:00:01"
        $condition = ' where (o.order_status = "Pending" or o.order_status = "Shipping" or o.order_status = "Process") and o.payment_status = "Paid" ';
        if($type == "pre"){
            $condition .= " and preorder = 1 ";
        }else{
             $condition .= " and preorder = 0 ";
        }
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $condition = " And o.users_system_id = $user_id";
        }
        if (isset($_POST['order_no'])) {
            if(!empty($_POST['order_no'])){
                $order_no = $_POST['order_no'];
                if(empty($condition)){
                    $condition .= "Where ";
                }else{
                    $condition .= " And ";
                }
                $condition .= " o.order_id = $order_no";
            }
        }
        if (isset($_POST['search_status'])) {
            if(!empty($_POST['search_status'])){
                $search_status = $_POST['search_status'];
                if(empty($condition)){
                    $condition .= "Where ";
                }else{
                    $condition .= " And ";
                }
                $condition .= " o.order_status = '$search_status'";
            }
        }
        $resp = $this->db->query("select *,o.created_at as o_created_at from `order` o left join users_system u on u.users_system_id = o.users_system_id left join user_address ua on ua.address_id = o.address_id $condition Order by order_id desc");

        $printer_group = $this->db->get_where("printer_group",["status"=>"Online"])->result();
        // $groupsId = [];
        $groupsDetails = [];
        foreach($printer_group as $group){
            $groupsDetails[$group->printer_group_id] = $group->group_title;
        }
        $orders = array();
        foreach ($resp->result() as $order) {
            $userCountRes = $this->db->query("select count(order_id) as num_order from `order` where users_system_id = ".$order->users_system_id)->first_row();
            $userNumberOrders = $userCountRes->num_order;
            $products = $this->db->query("select * from order_products op left join product p on p.product_id = op.product_id where op.order_id = " . $order->order_id . " order by op.order_products_id ASC")->result_array();
            $prods = [];
            foreach ($products as $k => $product) {

                $attrs = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on opa.product_attribute_id = pa.product_attribute_id where opa.order_product_id = " . $product['order_products_id'] . " And opa.order_id = " . $order->order_id . " order by pa.product_category_id,pa.product_attribute_id desc")->result();
                $a = array();
                //  $mCheck = false;
                $tArray = array();
                $_mProducts = [];
                for ($j = 0; $j < count($attrs); $j++) {
                    if ($attrs[$j]->product_id == $product['product_id']) {
                        if (isset($groupsDetails[$attrs[$j]->printer_group_id])) {
                            $group_name = str_replace(' ', '_', $groupsDetails[$attrs[$j]->printer_group_id]);
                            if($attrs[$j]->printer_group_id != 1) {
                                $a[$group_name][] = $attrs[$j];
                            }
                        }
                        $a['Receipt'][] = $attrs[$j];

                    }
                }
                $check = 0;
                $checkAttrGroups = [];
                foreach($printer_group as $group){
                    if($group->printer_group_id != 1){
                        $group_name = str_replace(' ', '_', $group->group_title);
                        if(isset($a[$group_name])) {
                            $_attrs = $a[$group_name];
                            $product["attributes"] = $_attrs;
                            $prods[$group_name][] = $product;
                            $check++;
                            $checkAttrGroups[] = $group->printer_group_id;
                        }
                    }
                }
                $isProductExist = false;
                if(count($checkAttrGroups)>0)
                foreach($checkAttrGroups as $cag){
                    if($cag == $product['printer_group_id']){
                        $isProductExist = true;
                        break;
                    }
                }


//                if(!isset($prods[$]))
//                if($check == 0){
//                    $group_name = str_replace(' ', '_', $groupsDetails[$product->printer_group_id]);
//                    $product["attributes"] = $a['Receipt'];
//                    $prods[$group->group_title][] = $product;
//                    $check++;
//                }

                $product['attributes'] = $a;

                $pro = $product;
                if(count($attrs) > 0){
                    $pro['attributes'] = $a['Receipt'];
                }
                $prods['Receipt'][] = $pro;
//
                if(!$isProductExist && $product['printer_group_id'] != 1){
                    $product["attributes"] = [];
                    if(isset($groupsDetails[$product['printer_group_id']])){
    					$group_name = str_replace(' ', '_', $groupsDetails[$product['printer_group_id']]);
                        $prods[$group_name][] = $product;
                    }
                }

            }

            $order->products = $prods;
            $order->user_num_orders = $userNumberOrders;
            $orders[] = $order;
        }

        $this->response(1,"success",$orders);

    }
//===================
public function get_sp_orders_history(){
        $condition = ' where o.order_status = "Completed" or o.order_status = "Cancel" or o.order_status = "Refund" ';
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $condition = " And o.users_system_id = $user_id";
        }
        if (isset($_POST['order_no'])) {
            if(!empty($_POST['order_no'])){
                $order_no = $_POST['order_no'];
                if(empty($condition)){
                    $condition .= "Where ";
                }else{
                    $condition .= " And ";
                }
                $condition .= " o.order_id = $order_no";
            }
        }
        //print_r($_REQUEST);
//        $_REQUEST['order_no'] . " no";
        if (isset($_POST['search_status'])) {
            if(!empty($_POST['search_status'])){
                $search_status = $_POST['search_status'];
                if(empty($condition)){
                    $condition .= "Where ";
                }else{
                    $condition .= " And ";
                }
                $condition .= " o.order_status = '$search_status'";
            }
        }
        $resp = $this->db->query("select *,o.created_at as o_created_at from `order` o left join users_system u on u.users_system_id = o.users_system_id left join user_address ua on ua.address_id = o.address_id $condition Order by order_id desc Limit 100");
        // $printer_group = $this->db->get_where("printer_group",["status"=>"Online"])->result();

        // $orders = array();
    //   $resp = $this->db->query("select *,o.created_at as o_created_at from `order` o left join users_system u on u.users_system_id = o.users_system_id left join user_address ua on ua.address_id = o.address_id $condition Order by order_id desc");

        $printer_group = $this->db->get_where("printer_group",["status"=>"Online"])->result();
        // $groupsId = [];
        $groupsDetails = [];
        foreach($printer_group as $group){
            $groupsDetails[$group->printer_group_id] = $group->group_title;
        }
        $orders = array();
        foreach ($resp->result() as $order) {
            $products = $this->db->query("select * from order_products op left join product p on p.product_id = op.product_id where op.order_id = " . $order->order_id . " order by op.order_products_id ASC")->result_array();
            $userCountRes = $this->db->query("select count(order_id) as num_order from `order` where users_system_id = ".$order->users_system_id)->first_row();
            $userNumberOrders = $userCountRes->num_order;
            $prods = [];
            foreach ($products as $k => $product) {

                $attrs = $this->db->query("select * from order_product_attributes opa left join product_attribute pa on opa.product_attribute_id = pa.product_attribute_id where opa.order_product_id = " . $product['order_products_id'] . " And opa.order_id = " . $order->order_id . " order by pa.product_category_id,pa.product_attribute_id desc")->result();
                $a = array();
                //  $mCheck = false;
                $tArray = array();
                $_mProducts = [];
                for ($j = 0; $j < count($attrs); $j++) {
                    if ($attrs[$j]->product_id == $product['product_id']) {
                        if (isset($groupsDetails[$attrs[$j]->printer_group_id])) {
                            $group_name = str_replace(' ', '_', $groupsDetails[$attrs[$j]->printer_group_id]);
                            if($attrs[$j]->printer_group_id != 1) {
                                $a[$group_name][] = $attrs[$j];
                            }
                        }
                        $a['Receipt'][] = $attrs[$j];

                    }
                }
                $check = 0;
                $checkAttrGroups = [];
                foreach($printer_group as $group){
                    if($group->printer_group_id != 1){
                        $group_name = str_replace(' ', '_', $group->group_title);
                        if(isset($a[$group_name])) {
                            $_attrs = $a[$group_name];
                            $product["attributes"] = $_attrs;
                            $prods[$group_name][] = $product;
                            $check++;
                            $checkAttrGroups[] = $group->printer_group_id;
                        }
                    }
                }
                $isProductExist = false;
                if(count($checkAttrGroups)>0)
                foreach($checkAttrGroups as $cag){
                    if($cag == $product['printer_group_id']){
                        $isProductExist = true;
                        break;
                    }
                }


//                if(!isset($prods[$]))
//                if($check == 0){
//                    $group_name = str_replace(' ', '_', $groupsDetails[$product->printer_group_id]);
//                    $product["attributes"] = $a['Receipt'];
//                    $prods[$group->group_title][] = $product;
//                    $check++;
//                }

                $product['attributes'] = $a;

                $pro = $product;
                if(count($attrs) > 0){
                    $pro['attributes'] = $a['Receipt'];
                }
                $prods['Receipt'][] = $pro;
//
                if(!$isProductExist && $product['printer_group_id'] != 1){
                    $product["attributes"] = [];
                    if(isset($groupsDetails[$product['printer_group_id']])){
    					$group_name = str_replace(' ', '_', $groupsDetails[$product['printer_group_id']]);
                        $prods[$group_name][] = $product;
                    }
                }

            }
            $order->user_num_orders = $userNumberOrders;
            $order->products = $prods;
            $orders[] = $order;
        }

        $this->response(1,"success",$orders);
//        $data["table_data"] = $orders;
        // $this->response(1,"success",$orders);
    }
//=================
    public function update_sp_product_status(){
        $param2 = $_POST['status'];
        $param1 = $_POST['id'];
        $result = $this->db->update("product",["status"=>$param2],["product_id"=>$param1]);
//        $result = $this->db->get_where("product",["product_id"=>$param1])->first_row();

        if($result){
            $this->response(1,"success " ,[]);
        }else{
            $this->response(0,"failed",[]);
        }
        exit();
    }
    public function get_sp_products()
    {
        $this->checkToken();
        $pageNumber = 1;
        $condition = '';
        if(isset($_POST['query'])){
            $qu = $_POST['query'];
            $condition = " where product_name LIKE '%$qu%' OR product_name_en LIKE '%$qu%' OR product_name_ch LIKE '%$qu%' OR product_id = '$qu' ";
        }
        if (isset($_REQUEST['page'])) {
            // $this->response(0, "Missing Params", []);
            $pageNumber = $_REQUEST['page'];
        }
        $page = 10 * $pageNumber;
        $startPage = $page - 10;
        $products = $this->db->query("select p.*,p.status as product_status , p.product_name_" . $this->language . " as lang_product_name, p.product_detail_" . $this->language . " as lang_product_detail, c.category_title_" . $this->language . " as lang_category_title ,c.status as category_status,c.category_title_en,c.category_title_ch from product p left join category c on c.category_id = p.category_id $condition order by p.position_order ASC ")->result();


        if ($products) {

            $pageCount = $this->db->query(
                "select count(product_id) as count_res from product p left join category c on c.category_id = p.category_id"
            )->first_row();

            $count = $pageCount->count_res;
            $product_watermark = $this->db->query("select * from product_watermarks pws left join product_watermark pw on pws.product_watermark_id = pw.product_watermark_id")->result();
            $mass_discounts= $this->db->query("select * from mass_discount where status = 'Online' And start_time <= '".date("Y-m-d h:i:s")."' And end_time >= '".date("Y-m-d h:i:s")."'")->result();
            // echo $this->db->last_query();
            $ids = [];
            foreach($mass_discounts as $discount){
                $ids[] = $discount->mass_discount_id;
            }
            $categories = [];
            if(count($mass_discounts) > 0){
                $in = implode($ids,",");
                $categories = $this->db->query("select * from mass_discount_categories where mass_discount_id in ($in)")->result();
            }
            $prods = [];
            foreach($products as $product){
                $wm = [];
                for($i = 0 ; $i < count($product_watermark) ; $i++){
                    if($product_watermark[$i]->product_id == $product->product_id){
                        $wm[] = $product_watermark[$i];
                    }
                }

                foreach($mass_discounts as $discount){
                    if($discount->coupon_condition == "For Categories"){
                        for($j = 0 ; $j < count($categories) ; $j++){
                            if($product->category_id == $categories[$j]->category_id){
                                $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
                                $product->price_after_discount = $product->original_price - $d_amount;
                                $product->discount_amount = $d_amount;
                                $product->disount_expiry = $discount->end_time;
                                $product->discount_start_time = $discount->start_time;
                                break;
                            }
                        }
                    }else{
                        $d_amount = $discount->discount_type == "Cash"?$discount->amount:($product->original_price * $discount->percentage)/100;
                        $product->price_after_discount = $product->original_price - $d_amount;
                        $product->discount_amount = $d_amount;
                        $product->disount_expiry = $discount->end_time;
                        $product->discount_start_time = $discount->start_time;
                    }
                }


                $product->product_watermark = $wm;

                $prods[] = $product;
            }
            $resp["products"] = $prods;
            $resp["current_page_index"] = $pageNumber;
            $resp["total_page_count"] = $this->get_total_page_count($count);


            $this->response(1, "Successfully Loaded Product", $resp);
        } else {
            $this->response(0, "Cannot Load Products", []);
        }
    }
//==========
    public function update_sp_attribute_status(){
        $param2 = $_POST['status'];
        $param1 = $_POST['id'];
        $result = $this->db->update("product_attribute",["status"=>$param2],["product_attribute_id"=>$param1]);
//        $result = $this->db->get_where("product",["product_id"=>$param1])->first_row();

        if($result){
            $this->response(1,"success " ,[]);
        }else{
            $this->response(0,"failed",[]);
        }
        exit();
    }
    public function get_sp_product_attributes()
    {
        $this->checkToken();
        $condition = '';
        if(isset($_POST['query'])){
            $qu = $_POST['query'];
            $condition = " where pa.product_attribute_title_en LIKE '%$qu%' OR pa.product_attribute_title_ch LIKE '%$qu%' OR product_attribute_title LIKE '%$qu%' OR pc.product_category_title_ch LIKE '%$qu%' OR pc.product_category_title_en LIKE '%$qu%' OR pc.product_category_title LIKE '%$qu%' OR pa.product_attribute_id = '$qu'";
        }
//        if(!isset($_POST['id'])){
//            $this->response(0, "Cannot Load Product Categories", []);
//        }
//        $id = $_POST['id'];

        $attributes = $this->db->query("select pa.*,pa.status as pa_status, pa.product_attribute_title_" . $this->language . " as lang_attribute_title,pc.product_category_title_en,pc.product_category_title_ch ,pc.product_category_title_" . $this->language . " as lang_category_title  from product_category pc right join product_attribute pa on pa.product_category_id = pc.product_category_id $condition")->result();

        if ($attributes) {
            $this->response(1, "Successfully Loaded Product Categories", $attributes);
        } else {
            $this->response(0, "Cannot Load Product Categories", []);
        }
    }
//==========_____

    public function get_suggested_product($product_id = '')
    {
        $this->checkToken();
        if (empty($product_id)) {
            $this->response(0, "Missing Params", []);
        }
        $s_products = $this->db->get_where("suggested_products", ["product_id" => $product_id])->result();
        $s_p = array();
        foreach ($s_products as $s_product) {
            $s_p[] = $s_product->suggested_product_id;
        }
        $pro = implode(",", $s_p);
        $products = $this->db->query("select p.*,p.status as product_status , p.product_name_" . $this->language . " as lang_product_name, p.product_detail_" . $this->language . " as lang_product_detail, c.category_title_" . $this->language . " as lang_category_title ,c.status as category_status,c.category_title_en,c.category_title_ch from product p left join category c on c.category_id = p.category_id where p.product_id IN ($pro)")->result();
        if (count($products) < 1) {
            $this->response(0, "Cannot Find Product", []);
            exit();
        }
//        echo "select pc.*, pc.product_category_title_" . $this->language . " as lang_attribute_title from product_categories pcs left join product_category pc on pc.product_category_id = pcs.product_category_id where pcs.product_id = $product_id order by pc.product_category_id desc";
        $category = $this->db->query("select pc.*, pc.product_category_title_" . $this->language . " as lang_attribute_title,pcs.product_id from product_categories pcs left join product_category pc on pc.product_category_id = pcs.product_category_id where pcs.product_id IN ($pro) order by pc.product_category_id desc")->result();
        if (!$category) {
            $this->response(0, "Cannot Load Product Categories", []);
        }

        $attributes = $this->db->query("select *, product_attribute_title_" . $this->language . " as lang_category_title from product_attribute order by product_attribute_id desc ")->result();
        if (!$attributes) {
            $this->response(0, "Cannot Load Attributes", []);
        }
        $productData = array();
        foreach ($products as $product) {
            $categoryArray = [];
            foreach ($category as $c) {
                $id = $c->product_category_id;
                $attArray = [];
                if ($c->product_id == $product->product_id) {
                    for ($i = 0; $i < count($attributes); $i++) {
                        if ($id == $attributes[$i]->product_category_id) {
                            $attArray[] = $attributes[$i];
                        }
                    }
                    $c->attributes = $attArray;
                    $categoryArray[] = $c;
                }
            }
            $product->categories = $categoryArray;
            $productData[] = $product;
        }
        $this->response(1, "Success", $productData);
    }

    public function add_coupon()
    {
        $array = array();
//        ["password"=>$password,"code"=>$code,"c_type"=>$c_type,"coupons_name" => $name, "discount_type" => $discount_type, "amount" => $amount, "percentage" => $percent, "coupon_qty" => $qty, "status" => $status, "start_time" => $s_date, "end_time" => $e_date, "coupon_condition" => $type]
        $isCategory = false;

        if (!isset($_REQUEST["name"])) {
            $this->response(0, "Missing params", []);
        }
        $array["coupons_name"] = $_REQUEST["name"];

        if (!isset($_REQUEST["discount_type"])) {
            $this->response(0, "Missing params", []);
        }
        $array["discount_type"] = $_REQUEST["discount_type"];
        if (!isset($_REQUEST["discount"]) || !isset($_REQUEST["discount_type"])) {
            $this->response(0, "Missing params", []);
        }
        if ($_REQUEST["discount_type"] == "Percentage") {
            $percent = $_REQUEST["discount"];
            $array["percentage"] = $percent;
        } else {
            $amount = $_REQUEST["discount"];
            $array["amount"] = $amount;
        }

        if (!isset($_REQUEST["qty"])) {
            $this->response(0, "Missing params", []);
        }
        $array["coupon_qty"] = $_REQUEST["qty"];

        $array["coupon_condition"] = "No Limit";

        if (!isset($_REQUEST["c_type"])) {
            $this->response(0, "Missing params", []);
        }
        $array["c_type"] = $_REQUEST["c_type"];

        if (!isset($_REQUEST["code"])) {
            $this->response(0, "Missing params", []);
        }
        $array["code"] = $_REQUEST["code"];

        if (isset($_REQUEST["password"])) {
            $array["password"] = $_REQUEST["password"];
        }
        if (!isset($_REQUEST["c_type"])) {
            $this->response(0, "Missing params", []);
        }
        $array["c_type"] = $_REQUEST["c_type"];

        if (!isset($_REQUEST["status"])) {
            $this->response(0, "Missing params", []);
        }
        if (!isset($_REQUEST["start_date"]) || !isset($_REQUEST["end_date"])) {
            $this->response(0, "Missing params", []);
        }

        $array["start_time"] = $_REQUEST["start_date"];
        $array["end_time"] = $_REQUEST["end_date"];
        $array["status"] = $_REQUEST["status"];


//            $name_ch = $this->input->post("name_ch");

        $resp = $this->db->insert('coupons', $array);
//            echo $this->db->last_query();

        if ($resp) {
            $this->response(1, "Saved successfully");
        } else {
            $this->response(0, "Cannot Save successfully");

        }
    }

    public function update_coupon()
    {
        $array = array();
//        ["password"=>$password,"code"=>$code,"c_type"=>$c_type,"coupons_name" => $name, "discount_type" => $discount_type, "amount" => $amount, "percentage" => $percent, "coupon_qty" => $qty, "status" => $status, "start_time" => $s_date, "end_time" => $e_date, "coupon_condition" => $type]
        $isCategory = false;
        if (!isset($_REQUEST['coupon_id'])) {
            $this->response(0, "Missing params", []);
        }
        if (isset($_REQUEST["name"])) {
            $array["coupons_name"] = $_REQUEST["name"];
        }
        if (isset($_REQUEST["discount_type"])) {
            $array["discount_type"] = $_REQUEST["discount_type"];
        }
        if (isset($_REQUEST["discount"]) && isset($_REQUEST["discount_type"])) {
            if ($_REQUEST["discount_type"] == "Percentage") {
                $percent = $_REQUEST["discount"];
                $array["percentage"] = $percent;
                $array["amount"] = 0;
            } else {
                $amount = $_REQUEST["discount"];
                $array["amount"] = $amount;
                $array["percentage"] = 0;
            }
        }

        if (isset($_REQUEST["qty"])) {
            $array["coupon_qty"] = $_REQUEST["qty"];
        }
        if (isset($_REQUEST["type"])) {
            $array["coupon_condition"] = $_REQUEST["type"];
            if ($_REQUEST["type"] == "For Categories") {
                $isCategory = true;
            }

        }
        if (isset($_REQUEST["c_type"])) {
            $array["c_type"] = $_REQUEST["c_type"];
        }
        if (isset($_REQUEST["code"])) {
            $array["code"] = $_REQUEST["code"];
        }
        if (isset($_REQUEST["password"])) {
            $array["password"] = $_REQUEST["password"];
        }
        if (isset($_REQUEST["status"])) {
            $array["status"] = $_REQUEST["status"];
        }
        if (isset($_REQUEST["start_date"]) || isset($_REQUEST["end_date"])) {
            $array["start_time"] = $_REQUEST["start_date"];
            $array["end_time"] = $_REQUEST["end_date"];
        }

//            $name_ch = $this->input->post("name_ch");
        $coupon_id = $_REQUEST['coupon_id'];

        $resp = $this->db->update('coupons', $array, ["coupons_id" => $coupon_id]);
//            echo $this->db->last_query();

        if ($resp) {
//            $c_id = $coupon_id;
//            $this->db->delete("coupon_frequencies",["coupons_id"=>$c_id]);
//            $this->db->delete("coupon_products",["coupons_id"=>$c_id]);
//            $this->db->delete("coupon_categories",["coupons_id"=>$c_id]);
//
//
//            foreach ($frequencies as $frequency){
//                $resp1 = $this->db->insert("coupon_frequencies", ["coupons_id"=>$c_id,"coupon_frequency_id"=>$frequency]);
//            }
//            if($isCategory){
//                foreach ($categories as $category){
//                    $resp1 = $this->db->insert("coupon_categories", ["coupons_id"=>$c_id,"category_id"=>$category]);
//                }
//            }else{
//                foreach ($products as $product){
//                    $resp1 = $this->db->insert("coupon_products", ["coupons_id"=>$c_id,"	product_id"=>$product]);
//                }
//            }
            $this->response(1, "Updated successfully");
        } else {
            $this->response(0, "Cannot Updated successfully");

        }
    }

  function sns_checkregister(){
    	$this->checkToken();
    	if (!isset($_REQUEST["loginCode"])) {
    		$this->response(0, "Missing params", []);
    	}else{
    		$loginCode = $_REQUEST["loginCode"];
    	}
    	$postData = array();
    	$url = "https://api.weixin.qq.com/sns/jscode2session?appid=".WECHAT_APPID()."&secret=".WECHAT_APPSECRET()."&grant_type=authorization_code&js_code=".$loginCode;
    	$output = do_post_request($url, $postData);
    	$output = json_decode($output);
    	if(!empty($output)){
    		if(isset($output->openid)){
    			$open_id = $output->openid;
    			$open_id = 'oWTCLwafHdO2-G2NmV2pGI3NGnhc';
    			$userinfo = $this->UserModel->getuserinfo_byopenID($open_id);
    			if(!empty($userinfo)){
    				$users_system_id = $userinfo['users_system_id'];
    
    				$this->response(1, "已注册", array('c_open_id'=>$open_id, 'users_system_id'=>$users_system_id));
    			}else{
    				$this->response(0, "还未注册", array('c_open_id'=>$open_id, 'users_system_id'=>0));
    			}
    		}else{
    			$this->response(0, "loginCode 错误", []);
    		}
    	}else{
    		$this->response(0, "loginCode 错误", []);
    	}
    }
    /*
     * Date: 2021-07-12
     * 授权获取用户的基本信息
     */
    public function snsgetuserinfo_register(){
    	$this->checkToken();
    	if (!isset($_REQUEST["loginCode"])) {
    		$this->response(0, "Missing params", []);
    	}else{
    		$loginCode = $_REQUEST["loginCode"];
    	}
    	if (!isset($_REQUEST['date_time'])) {
    		$this->response(0, "Missing params", []);
    	}else{
    		$date = $_REQUEST['date_time'];
    	}
    	 
    	$wechatinfo = getwechatuserinfo($loginCode);
    	$c_open_id = $wechatinfo['wechat_openid'];
    	$wechat_nickname = $wechatinfo['wechat_nickname'];
    	$wechat_nickname = userTextEncode($wechat_nickname);
    
    	$wechat_avatar = $wechatinfo['wechat_avatar'];
    	
    	$tokenId = generateToken();
    	$sessionId = generateSession();
    	$date = date("Y-m-d h:i:s", strtotime($date . ' +2 day'));
    	
    	if($c_open_id != ''){
    		$userinfo = $this->UserModel->getuserinfo_byopenID($c_open_id);
    		if(empty($userinfo)){
    			$arr = array('c_open_id'=>$c_open_id, 'users_roles_id'=>3);
    			$arr['wechat_avatar'] = $wechat_avatar;
    			$arr['wechat_nickname'] = $wechat_nickname;
    			
    			$arr['session_id'] = $sessionId;
    			$arr['token_id'] = $tokenId;
    			$arr['token_expiry'] = $date;
    	
    			$users_system_id = $this->UserModel->add_user($arr);
    		}else{
    			$arr = array();
    			$arr['c_open_id'] = $c_open_id;
    			$arr['wechat_avatar'] = $wechat_avatar;
    			$arr['wechat_nickname'] = $wechat_nickname;
    			$arr['session_id'] = $sessionId;
    			$arr['token_id'] = $tokenId;
    			$arr['token_expiry'] = $date;
    	
    			$this->UserModel->edit_user($userinfo['users_system_id'], $arr);
    	
    			$users_system_id = $userinfo['users_system_id'];
    		}
    		$this->response(1, "Success", array('users_system_id'=>$users_system_id, 'c_open_id'=>$c_open_id, 'session_id'=>$sessionId, 'token_id'=>$tokenId, 'token_expiry'=>$date));
    	}else{
    		$this->response(0, "Fail", array('users_system_id'=>0, 'c_open_id'=>'', 'session_id'=>$sessionId, 'token_id'=>$tokenId, 'token_expiry'=>$date));
    	}
    }
    
	//订单支付
	function js_api_call(){
		if (!isset($_REQUEST['order_id'])) {
			$this->response(0, "missing params", []);
		}else{
			$order_id = $_REQUEST['order_id'];
		}
		if(!isset($_REQUEST['users_system_id'])){
			$this->response(0, "missing params", []);
		}else{
			$users_system_id = $_REQUEST['users_system_id'];
		}
		 
		$orderinfo = $this->OrderModel->getorderinfo($order_id);
		$userinfo = $this->UserModel->getuserinfo($users_system_id);
		 
		$order_number = $orderinfo['order_id'];
		if($userinfo['users_system_id'] == 62405){
			$total_fee = 0.01 * 100;
		}else if($userinfo['users_system_id'] == 61217){//小刘
			$total_fee = 0.01 * 100;
		}else if($userinfo['users_system_id'] == 56925){
			$total_fee = 0.01 * 100;
		}else if($userinfo['users_system_id'] == 44531){//龙哥
			$total_fee = 0.01 * 100;
		}else{
			$total_fee = $orderinfo['grand_total'] * 100;
		}

		/**
		 *
		 * example目录下为简单的支付样例，仅能用于搭建快速体验微信支付使用
		 * 样例的作用仅限于指导如何使用sdk，在安全上面仅做了简单处理， 复制使用样例代码时请慎重
		 * 请勿直接直接使用样例对外提供服务
		 *
		 **/
		require_once "lib/wechatpay/WxPay.Api.php";
		require_once "lib/wechatpay/WxPay.JsApiPay.php";
		require_once "lib/wechatpay/WxPay.Config.php";
		require_once 'lib/wechatpay/log.php';
		 
		//初始化日志
		$logHandler= new CLogFileHandler("lib/wechatpay/logs/".date('Y-m-d').'.log');
		$log = Log::Init($logHandler, 15);
		 
		//①、获取用户openid
		$tools = new JsApiPay();
		$openId = $userinfo['c_open_id'];
		 
		//②、统一下单
		$input = new WxPayUnifiedOrder();
		$input->SetBody("Saucepan");
		$input->SetAttach("");
		$input->SetOut_trade_no($order_number);
		$input->SetTotal_fee($total_fee);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("");
		$input->SetNotify_url(base_url()."index.php/wechat/notice/publicaccount");
// 		$input->SetNotify_url("https://www.mygksel.com/Saucepan/wechat/notice/publicaccount");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		$config = new WxPayConfig();
		$order = WxPayApi::unifiedOrder($config, $input);
		//            echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
		//            print_r($order);exit;
		$jsApiParameters = $tools->GetJsApiParameters($order);
		 
		$jsApiParameters = json_decode($jsApiParameters, true);
		 
		echo json_encode(array('status'=>1, 'statusmsg'=>'成功', 'data'=>$jsApiParameters));
		 
		// 	    print_r($jsApiParameters);
		// 	    exit;
		 
		 
		//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
		/**
		 * 注意：
		 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
		 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
		 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
		*/
	}
	//临时订单支付成功后调用
	function paysuccess_temporary(){
		if (!isset($_REQUEST['order_id'])) {
			$this->response(0, "missing params", []);
		}else{
			$order_id = $_REQUEST['order_id'];
		}
		if(!isset($_REQUEST['users_system_id'])){
			$this->response(0, "missing params", []);
		}else{
			$users_system_id = $_REQUEST['users_system_id'];
		}
			
		$orderinfo = $this->OrderModel->getorderinfo($order_id);
		$userinfo = $this->UserModel->getuserinfo($users_system_id);
		
		if(!empty($orderinfo) && !empty($userinfo)){
			$arr = array();
			$arr['payment_method'] = 'WeChat_Pay';
			$arr['payment_status'] = 'Paid';
			$arr['wechatpay_time'] = time();
			$this->OrderModel->edit_order($order_id, $arr);
			
			$this->response(1, "Success", []);
		}else{
			$this->response(0, "Error", []);
		}
	}


    public function get_total_page_count($count)
    {
        if ($count >= 10) {
            $total = $count % 10 == 0 ? $count / 10 : floor($count / 10) + 1;
            // $total =  $count / 10;
        } else {
            $total = 1;
        }
        return $total;
    }

    private function checkToken()
    {
        return;

        if (!isset($_REQUEST['token'])) {
            $this->response(0, "invalid token (Cannot connect)", []);
        }
        $isValid = isTokenValid($_REQUEST["token"]);
        if (!$isValid) {
            $this->response(0, "invalid token (Cannot connect)", []);
        }
    }

    public function response($status = 0, $message = "Unauthorized Access", $response = [])
    {
//        $this->checkToken();
        $resp = [
            "status" => $status,
            "message" => $message,
            "response" => (!empty($response)) ? $response : [],
        ];
//        $this->output
//            ->set_content_type('application/json')
//            ->set_output(json_encode($resp));
        echo json_encode($resp);
        exit();
    }


}