<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_banner extends CI_Controller
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


    public function home_banner()
    {
        $data['data'] = $this->Master_model->select_data('mov_home_banner', '*',"");
        // print_r($data);die();
        $this->load->view("add_home_banner",$data);
    }

    public function add_home_banner()
    {
        $id = $this->input->post('id');

        if (!empty($_FILES['home_banner']['name'])) {
            $fn1 = $_FILES['home_banner']['name'];
            $sourceapplicant = $_FILES['home_banner']['tmp_name'];
            $targetapplicant = "uploads/homebanner/".$fn1;
            move_uploaded_file($sourceapplicant, $targetapplicant);
            $imagedata['Mpg_home_banner'] = $fn1;
        } 

        if($id){
            $data = $this->Master_model->updatedata('Mpg_home_banner_id', $id, $imagedata, 'mov_home_banner');
        }else{
            $data = $this->Master_model->Insertdata('mov_home_banner', $imagedata);
        }
       
        if ($data > 0) {
            $this->session->set_flashdata('success', "Insert Record Successfully!");
            redirect('Home_banner/home_banner/');
        } else {
            $this->session->set_flashdata('error', "Insert Failed!");
            redirect('Home_banner/home_banner/');
        }
    }

    public function delete_home_banner()
    {
        $id = $this->input->post('id');
        
        $data = $this->Master_model->deletedatawhere("Mpg_home_banner_id=$id",'mov_home_banner');
       
        if ($data > 0) {
            $this->session->set_flashdata('success', "Delete Successfully!");
            redirect('Home_banner/home_banner');
        } else {
            $this->session->set_flashdata('error', "Failed!");
            redirect('Home_banner/home_banner');
        }
        
    }

}
