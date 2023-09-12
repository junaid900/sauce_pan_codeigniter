<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Webservice extends CI_Controller {
	/* CONSTRUCTOR */
	public function __construct() {
		parent::__construct();
		
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST ,OPTIONS, PUT');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		header('Content-Type: application/json');
		
		
		
	}
	/* CONSTRUCTOR */
	/* INVALID PAGE */
	public function index($param1 = '', $param2 = '', $param3 = ''){
		$json['status_code']	=	'500';
		$json['status_error']	=	get_phrase('invalid_request_uri');
		echo json_encode($json);
		exit;
	}
	/* INVALID PAGE */
	public function get_products(){
		$postdata 	= file_get_contents("php://input"); 
		$post_data 	= json_decode($postdata); 
		$response 	= array();
		if(!empty($post_data->request_type)){
		if($post_data->request_type =='get_all_data'){ 
		    $product_array      = array();
		    $product_image_array= array();
    		$category_array     = array();
    		$attribute_array    = array();
    		$images_array       = array();
    		$category_data      = $this->db->get_where('categories',array('status'=>'Active'))->result_array();
    		foreach($category_data as $cat){
    		   $cat_data['category_name']        =  $cat['name'];
    		   $cat_data['description']          =  $cat['description'];
    		   $cat_data['image']                =  $cat['image'];
    		   array_push($category_array, $cat_data);
    		   
    		   
    		   
    		   $product_data = $this->db->get_where('products',array('categories_id'=>$cat['categories_id'],'status'=>'In Stock'))->result_array();
    		   foreach($product_data as $pro){
    		        $pro_data['product_name']           =  $pro['product_name'];
    		        $pro_data['product_description']    =  $pro['product_description'];
    		        $pro_data['product_quantity']       =  $pro['product_quantity'];
    		        $pro_data['product_code']           =  $pro['product_code'];
    		        $pro_data['product_cost']           =  $pro['product_cost'];
    		        $pro_data['product_sale_price']     =  $pro['product_sale_price'];
    		        $pro_data['product_purchase_price'] =  $pro['product_purchase_price'];
    		        $pro_data['product_unit']           =  $pro['product_unit'];
    		        $pro_data['date']                   =  $pro['date_added'];
    		        $pro_data['status']                 =  $pro['status'];
    		        array_push($product_array, $pro_data);
    		        $attribute_data = $this->db->get_where('attributes',array('products_id'=>$pro['products_id'],'status'=>'Active'))->result_array();
    		        foreach($attribute_data as $attr){
    		            $attr_data['attribute_name']            =  $attr['attribute_name'];
    		            $attr_data['attribute_description']     =  $attr['attribute_description'];
    		            $attr_data['attribute_price']           =  $attr['attribute_price'];
    		            array_push($attribute_array, $attr_data);
    		        }
    		        $product_array[$pro['product_name']] = $attribute_array;
    		        
    		           $product_images = $this->db->get_where('product_images',array('products_id'=>$pro['products_id'],'status'=>'Active'))->result_array();
            		   foreach($product_images as $images){
            		       array_push($images_array, $images['product_image']);
            		   }
            		$product_image_array[$pro['product_name']] = $images_array;
    		    }
    		    $catArray[$cat['name']] =  $product_array;
    		}
    		$response['category_data']  =  $category_array;
    		$response['product_data']   =  $product_array;
    		$response['attribute_data'] =  $attribute_array;
    		$response['sequence_data']  =  $catArray;
    		$response['product_images']  =  $product_image_array;
    		/*echo '<pre>';
    		print_r($response);*/
    		echo json_encode($response); 
    		exit;
		   }
		}
		    
	}
	
}