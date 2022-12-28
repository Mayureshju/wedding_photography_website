<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page_banner extends CI_Controller
{
    function __construct()
    {
        parent::__construct();    
        $this->load->model('Master_model');
        $this->load->library('image_lib');
        $this->load->library('upload');
        $this->load->database();
        $id = $this->session->userdata('id');
        $page = array();
        $roledata = get_list('mov_user_master', "MUM_Access_Permission", "MUM_ID=$id");
        //print_r($roledata);exit;
        if (!empty($roledata[0])) {
            $rolids = explode(',', $roledata[0]->MUM_Access_Permission);
            if (!empty($rolids[0])) {
                for ($i = 0; $i < count($rolids); $i++) {
                    $roleid = $rolids[$i];
                    $pagename = get_list('mov_module_name', "MMN_Page_Name", "MMN_ID=$roleid");
                    if (!empty($pagename[0])) {
                        $this->page[] = $pagename[0]->MMN_Page_Name;
                    }
                }
            } else {
                $this->page = array();
            }
        } else {
            redirect('Registration/logout');
        }
    }


    public function page_banner()
    {
        $data['data'] = $this->Master_model->select_data('mov_pages_banner', '*',"");
        // print_r($data);die();
        $this->load->view("add_page_banner",$data);
    }

    public function add_pages_banner()
    {

        if (!empty($_FILES['residential_banner']['name'])) {
            $fn1 = $_FILES['residential_banner']['name'];
            $sourceapplicant = $_FILES['residential_banner']['tmp_name'];
            $targetapplicant = "uploads/pagesbanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_bnr_residential_banner'] = $fn1;
        } 
        if (!empty($_FILES['residential_side_image']['name'])) {
            $fn1 = $_FILES['residential_side_image']['name'];
            $sourceapplicant = $_FILES['residential_side_image']['tmp_name'];
            $targetapplicant = "uploads/pagesbanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_bnr_residential_side_image'] = $fn1;
        } 

        if (!empty($_FILES['restaurant_banner']['name'])) {
            $fn1 = $_FILES['restaurant_banner']['name'];
            $sourceapplicant = $_FILES['restaurant_banner']['tmp_name'];
            $targetapplicant = "uploads/pagesbanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_bnr_restaurant_banner'] = $fn1;
        } 
        if (!empty($_FILES['restaurant_side_image']['name'])) {
            $fn1 = $_FILES['restaurant_side_image']['name'];
            $sourceapplicant = $_FILES['restaurant_side_image']['tmp_name'];
            $targetapplicant = "uploads/pagesbanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_bnr_restaurant_side_image'] = $fn1;
        } 

        if (!empty($_FILES['commercial_banner']['name'])) {
            $fn1 = $_FILES['commercial_banner']['name'];
            $sourceapplicant = $_FILES['commercial_banner']['tmp_name'];
            $targetapplicant = "uploads/pagesbanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_bnr_commercial_banner'] = $fn1;
        } 
        if (!empty($_FILES['commercial_side_image']['name'])) {
            $fn1 = $_FILES['commercial_side_image']['name'];
            $sourceapplicant = $_FILES['commercial_side_image']['tmp_name'];
            $targetapplicant = "uploads/pagesbanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_bnr_commercial_side_image'] = $fn1;
        } 

        if (!empty($_FILES['architecture_banner']['name'])) {
            $fn1 = $_FILES['architecture_banner']['name'];
            $sourceapplicant = $_FILES['architecture_banner']['tmp_name'];
            $targetapplicant = "uploads/pagesbanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_bnr_architecture_banner'] = $fn1;
        } 
        if (!empty($_FILES['architecture_side_image']['name'])) {
            $fn1 = $_FILES['architecture_side_image']['name'];
            $sourceapplicant = $_FILES['architecture_side_image']['tmp_name'];
            $targetapplicant = "uploads/pagesbanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_bnr_architecture_side_image'] = $fn1;
        } 

        if (!empty($_FILES['contact_banner']['name'])) {
            $fn1 = $_FILES['contact_banner']['name'];
            $sourceapplicant = $_FILES['contact_banner']['tmp_name'];
            $targetapplicant = "uploads/pagesbanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_bnr_contact_banner'] = $fn1;
        }
        if (!empty($_FILES['contact_side_image']['name'])) {
            $fn1 = $_FILES['contact_side_image']['name'];
            $sourceapplicant = $_FILES['contact_side_image']['tmp_name'];
            $targetapplicant = "uploads/pagesbanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_bnr_contact_side_image'] = $fn1;
        }
       
        $data = $this->Master_model->updatedata('Mpg_bnr_id', 1, $imagedata, 'mov_pages_banner');

        if ($data > 0) {
            $this->session->set_flashdata('success', "Insert Record Successfully!");
            redirect('Page_banner/page_banner/');
        } else {
            $this->session->set_flashdata('error', "Insert Failed!");
            redirect('Page_banner/page_banner/');
        }

    }

    

}
