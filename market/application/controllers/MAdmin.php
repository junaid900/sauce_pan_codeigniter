<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Madmin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $userData = ["directory" => "madmin"];
        $this->session->set_userdata($userData);
    }

    public function index()
    {
        // $data['unique_visitor'] = $this->Db_model->get_unique_visitor();
        $data['page_title'] = get_phrase('product');
        $data['page_sub_title'] = 'Main Category';
        $data['actor'] = 'category';
        $data['page_name'] = 'table_body';
        $data['main_page_name'] = 'products';


        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    public function manage_category($page = NULL, $info = NULL)
    {
        $data['page_title'] = get_phrase('categories');
        $data['page_sub_title'] = 'main_category';
        $data['actor'] = 'category';
        $data['page_name'] = 'manage_category';
        $data['main_page_name'] = 'products';
        if (empty($page)) {
            $data["htmlPage"] = "manage_category";
            $this->db->order_by("position_order", "desc");
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
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->update($data["actor"], ["category_title" => $name_en, "category_title_en" => $name_en, "category_title_ch" => $name_ch, "status" => $status], ["category_id" => $info]);
            $this->redirect_me("manage_category");
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Main Category';
            $data["htmlPage"] = "add_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->redirect_me($data["page_name"]);
        }
        if ($page == "save") {
//            print_r($_POST);
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["category_title" => $name_en, "category_title_en" => $name_en, "category_title_ch" => $name_ch, "status" => $status]);
            $this->redirect_me($data["page_name"]);
            exit();

        }//        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE category_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            }
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

    public function manage_product_category($page = NULL, $info = NULL)
    {
        $data['page_title'] = get_phrase('product_categories');
        $data['page_sub_title'] = 'product_category';
        $data['actor'] = 'product_category';
        $data['subactor1'] = 'category';
        $data['page_name'] = 'manage_product_category';
        $data['main_page_name'] = 'products';

        if (empty($page)) {
            $data["htmlPage"] = "manage_product_category";
            $resp = $this->Db_model->join2Tables($data['actor'], $data['subactor1'], 1, "a.position_order DESC");
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
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["product_category_title" => $name_en, "product_category_title_en" => $name_en, "product_category_title_ch" => $name_ch, "status" => $status, "category_id" => $category]);
            $this->redirect_me($data["page_name"]);
            exit();

        }
        if ($page == "edit") {
            $data['page_sub_title'] = 'edit_product_category';
            $data["htmlPage"] = "edit_product_category";
            $data['category'] = $this->Db_model->join2Tables($data['actor'], $data['subactor1'], $data['actor'] . "_id = $info")->first_row();
//            echo $this->db->last_query();
//            exit();
            $data["sub_data"] = $this->db->get_where($data['subactor1'])->result();
        }
        if ($page == "update") {
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $category = $this->input->post("category");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->update($data["actor"], ["product_category_title" => $name_en, "product_category_title_en" => $name_en, "product_category_title_ch" => $name_ch, "status" => $status, "category_id" => $category], [$data['actor'] . "_id" => $info]);
//            echo $this->db->last_query();
            $this->redirect_me($data['page_name']);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Product Category';
            $data["htmlPage"] = "add_product_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->redirect_me($data["page_name"]);
        }
        //        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE " . $data['actor'] . "_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            }
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
        $data['page_title'] = get_phrase('product_attribute');
        $data['page_sub_title'] = 'product_attribute';
        $data['actor'] = 'product_attribute';
        $data['subactor1'] = 'product_category';
        $data['page_name'] = 'manage_product_attribute';
        $data['main_page_name'] = 'products';

        if (empty($page)) {
            $data["htmlPage"] = "manage_product_attribute";
            $resp = $this->Db_model->join2Tables($data['actor'], $data['subactor1'], 1, " a.position_order DESC");
            $data["table_data"] = $resp->result();
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
//            echo $this->db->last_query();
            $this->redirect_me($data['page_name']);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Product Category';
            $data["htmlPage"] = "add_product_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->redirect_me($data["page_name"]);
        }
        //        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE " . $data['actor'] . "_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            }
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

    public function manage_product($page = NULL, $info = NULL)
    {
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
            $resp = $this->db->get("product");
//            print_r($resp->result());
//            exit();
            $data["table_data"] = $resp->result();
        }
        if ($page == "add") {
            $data['page_sub_title'] = 'add_product';
            $data["htmlPage"] = "add_product";
            $data['categories'] = $this->db->get_where('category')->result();
            $data['sub_categories'] = $this->db->get_where("product_category", ['status' => "Online"])->result();
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
//            print_r($_POST);
            $name_en = $this->input->post("name_en");
            $name_ch = $this->input->post("name_ch");
            $category = $this->input->post("category");
            $o_price = $this->input->post("or_price");
            $c_price = $this->input->post("cur_price");
            $status = $this->input->post("status");
            $status = $status == "active" ? "Online" : "Offline";
            $resp = $this->db->insert($data["actor"], ["product_attribute_title" => $name_en, "product_attribute_title_en" => $name_en, "product_attribute_title_ch" => $name_ch, "status" => $status, "product_category_id" => $category, "original_price" => $o_price, "current_price" => $c_price]);
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
//            echo $this->db->last_query();
            $this->redirect_me($data['page_name']);
            exit();
        }
        if ($page == "delete") {
            $data['page_sub_title'] = 'Add Product Category';
            $data["htmlPage"] = "add_product_category";
            $this->db->delete($data['actor'], array($data["actor"] . "_id" => $info));
            $this->redirect_me($data["page_name"]);
        }
        //        print_r($data);
        if ($page == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            foreach ($position as $k => $v) {
                $sql = "Update " . $data['actor'] . " SET position_order=" . $i . " WHERE " . $data['actor'] . "_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            }
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


    public function redirect_me($path, $controller = "mAdmin")
    {
        echo "<script>location.href = '" . base_url() . $controller . "/" . $path . "'; </script>";
//        redirect(strtolower($this->session->userdata('directory')) . '/' . $controller . "/".$path);
    }
}