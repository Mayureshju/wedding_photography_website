<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promotion extends CI_Controller
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

    public function add_promotion()
    {
        if (!in_array("Manage Promotions", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $this->load->view("add_promotion");
        }
    }


    public function add_promotion_data()
    {
        $id = $this->session->userdata('id');

        $this->form_validation->set_rules('promoname', 'promoname', 'trim|required');
        $this->form_validation->set_rules('promopercentage', 'promopercentage', 'trim|required');
        $this->form_validation->set_rules('val_from', 'val_from', 'trim');
        $this->form_validation->set_rules('val_to', 'val_to', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');

      
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('add_promotion');
        } else {
            $id = $this->session->userdata('id');
            $promoname = $this->input->post('promoname');
            $promopercentage = $this->input->post('promopercentage');
            $val_from = $this->input->post('val_from');
            $val_to = $this->input->post('val_to');
            $status = 0;
            if ($this->input->post('status')) {
                $status = 1;
            }
            $checkcatname = $this->Master_model->checkdata('Mprm_ID', 'mov_promocode', ' Mprm_PromoCode = "' . $promoname . '"');
            if ($checkcatname >= 1) {
                $this->session->set_flashdata('error', 'Code ' . $promoname . ' is already available.');
                redirect('Promotion/add_promotion/');
            }


            $insertdata = array(
                'Mprm_PromoCode' => $promoname,
                'Mprm_Percentage' => $promopercentage,
                'Mprm_StarteDate' => date('Y-m-d',strtotime($val_from)),
                'Mprm_EndDate' => date('Y-m-d',strtotime($val_to)),
                'Mprm_Status' => $status,
                'Mprm_CreatedBY' => $id,
                'Mprm_UpdatedBY' => $id,
                'Mprm_CreatedDate' => date("Y-m-d H:i:s")
            );
          

            $clientID = $this->Master_model->InsertdatawithlastID('mov_promocode', $insertdata);
           
            if ($clientID > 0) {
                $this->session->set_flashdata('success', "Insert Record Successfully!");
                redirect('Promotion/add_promotion/');
            } else {
                $this->session->set_flashdata('error', "Insert Failed!");
                redirect('Promotion/add_promotion/' . $clientname);
            }
             //}
        }
    }


    public function edit_promotion($editid = "", $search = 'bm8=', $page = 0)
    {
        if (!in_array("Manage Promotions", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $editdata['editclient'] = $this->Master_model->select_data('mov_promocode', '*', "Mprm_ID=$editid");

            $editdata['searchval'] = $search;
            $editdata['pageval'] = $page;
            $this->load->view('edit_promotion', $editdata);
        }
    }

    public function edit_promotion_data()
    {
        //$id=$this->session->userdata('id');

        $this->form_validation->set_rules('editid', 'Edit Id', 'trim');
        $editid = $this->input->post('editid');
        $original_value = $this->Master_model->select_data('mov_promocode', '*', "Mprm_ID=$editid");

        foreach ($original_value as $original_value1) {
            $original_value1->Mprm_PromoCode;
        }

        if ($this->input->post('promoname') != $original_value1->Mprm_PromoCode) {
            $is_unique =  '|is_unique[mov_clients.Mprm_PromoCode]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules('promoname', 'promoname', 'required|trim' . $is_unique);
		$this->form_validation->set_rules('promopercentage', 'promopercentage', 'trim|required');
        $this->form_validation->set_rules('val_from', 'val_from', 'trim');
        $this->form_validation->set_rules('val_to', 'val_to', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $search = $this->input->post('search');
        $page = $this->input->post('page');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Promotion/edit_promotion/' . $editid . '/' . $search . '/' . $page);
        } else {
            $id = $this->session->userdata('id');
            $editid = $this->input->post('editid');
            $promoname = $this->input->post('promoname');
            $promopercentage = $this->input->post('promopercentage');
            $val_from = $this->input->post('val_from');
            $val_to = $this->input->post('val_to');
            $status = 0;
            if ($this->input->post('status')) {
                $status = 1;
            }

            $data = array(
				'Mprm_PromoCode' => $promoname,
				'Mprm_Percentage' => $promopercentage,
				'Mprm_StarteDate' => date('Y-m-d',strtotime($val_from)),
				'Mprm_EndDate' => date('Y-m-d',strtotime($val_to)),
				'Mprm_Status' => $status,
				'Mprm_UpdatedBY' => $id
            );
          
            $profileres = $this->Master_model->updatedata('Mprm_ID', $editid, $data, 'mov_promocode');

            if ($profileres > 0) {

                $this->session->set_flashdata('success', "Update Record Successfully!");
                redirect('Promotion/edit_promotion/' . $editid . '/' . $search . '/' . $page);
            } else {
                $this->session->set_flashdata('error', 'Problem With Update!');
                redirect('Promotion/edit_promotion/' . $editid . '/' . $search . '/' . $page);
            }
          
        }
    }


    public function chkuser()
    {
        $id = $this->session->userdata('id');
        $this->form_validation->set_rules('statuscl', 'Statuscl', 'trim|required');
        $this->form_validation->set_rules('cntid', 'cntid', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo "1";
        } else {
            $id = $this->session->userdata('id');
            $cntid = $this->input->post('cntid');
            $statuscl = $this->input->post('statuscl');

            $where = "MUM_ID='" . $id . "'";
            $ans = $this->Master_model->checklogin("mov_user_master", "MUM_ID", $where);
            if ($ans == 'no') {
                echo "There is somthing wrong";
            } else {
				
                $arr = array('Mprm_Status' => $statuscl, 'Mprm_UpdatedBY' => $id);
                $updatestatus = $this->Master_model->updatedata('Mprm_ID', $cntid, $arr, 'mov_promocode');

                if ($updatestatus) {
                    echo "3";
                } else {
                    echo "4";
                }
            }
        }
    }
}
