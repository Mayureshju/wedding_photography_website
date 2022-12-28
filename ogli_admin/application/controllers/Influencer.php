<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Influencer extends CI_Controller
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


    public function add_influencer()
    {
        if (!in_array("Manage Influencer", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $this->load->view("add_influencer");
        }
    }


    public function add_influencer_data()
    {
		$this->form_validation->set_rules('Mflnc_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('MNC_cat_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('Mprm_ID', 'Promocode', 'trim|required');
        $this->form_validation->set_rules('Mflnc_cat_status', 'Status', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('');
        } else{

            $id = $this->session->userdata('id');
            $Mflnc_name = $this->input->post('Mflnc_name');
            $MNC_cat_id = $this->input->post('MNC_cat_id');
            $Mprm_ID = $this->input->post('Mprm_ID');
            $Mflnc_cat_status = $this->input->post('Mflnc_cat_status');
                    
            $insertdata = array(
                'Mflnc_name' => $Mflnc_name,
                'MNC_cat_id' => $MNC_cat_id,
                'Mprm_ID' => $Mprm_ID,
                'Mflnc_cat_status' => $Mflnc_cat_status,
                'Mflnc_CreatedBY' => $id,
                'Mflnc_UpdatedBy' => $id,
                'Mflnc_Created_Date' => date("Y-m-d H:i:s"),
            );
          

            $faqID = $this->Master_model->Insertdata('mov_influencer', $insertdata);
           
            if ($faqID > 0) {
				$this->session->set_flashdata('success', "Data Save Successfully!");
                redirect('Influencer/add_influencer/');
            } else {
				$this->session->set_flashdata('error', "Failed!");
                redirect('Influencer/add_influencer/'.$Mflnc_name);
			}
		}
             //}
    }


    public function edit_influencer($editid = "", $search = 'bm8=', $page = 0)
    {
        if (!in_array("Manage Influencer", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $editdata['editfaq'] = $this->Master_model->select_data('mov_influencer', '*', "Mflnc_id =$editid");
            $editdata['searchval'] = $search;
            $editdata['pageval'] = $page;

            $taskid = $editid;
            $this->load->view('edit_influencer', $editdata);
        }
    }
	

    public function edit_influencer_data()
    {
        //$id=$this->session->userdata('id');

        $this->form_validation->set_rules('editid', 'Edit Id', 'trim');
        $editid = $this->input->post('editid');
        $original_value = $this->Master_model->select_data('mov_influencer', '*', "Mflnc_id=$editid");

        foreach ($original_value as $original_value1) {
            $original_value1->Mflnc_name;
        }

        if ($this->input->post('Mflnc_name') != $original_value1->Mflnc_name) {
            $is_unique =  '|is_unique[mov_influencer.Mflnc_name]';
        } else {
            $is_unique =  '';
        }
        
        $this->form_validation->set_rules('Mflnc_name', 'Title', 'trim|required');
        $aptype = $this->input->post('Mflnc_name');

        $this->form_validation->set_rules('Mflnc_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('MNC_cat_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('Mprm_ID', 'Promocode', 'trim|required');
        $this->form_validation->set_rules('Mflnc_cat_status', 'Mflnc_cat_status', 'trim');

        $search = $this->input->post('search');
        $page = $this->input->post('page');
        $rechedule = 0;
        if ($this->input->post('rechedule')) {
            $rechedule = 1;
        }


        $status = $this->input->post('status');
     

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Influencer/edit_influencer/' . $editid . '/' . $search . '/' . $page);
        } else {
            $id = $this->session->userdata('id');
            $editid = $this->input->post('editid');
          
            $Mflnc_name = $this->input->post('Mflnc_name');   
            $MNC_cat_id = $this->input->post('MNC_cat_id'); 
            $Mprm_ID = $this->input->post('Mprm_ID'); 
            $Mflnc_cat_status = $this->input->post('Mflnc_cat_status'); 
            //$userid = $this->input->post('userid');
            $userid = 0 ;
            if($this->input->post('userid'))
            {
                $selectedids = $this->input->post('userid');
                $userid = implode(",",$selectedids);
            }
           
            $data = array(
                'Mflnc_name' => $Mflnc_name,
                'MNC_cat_id' => $MNC_cat_id,
                'Mprm_ID' => $Mprm_ID,
                'Mflnc_cat_status' => $Mflnc_cat_status,
                'Mflnc_UpdatedBy' => $id,
            );
            
            $profileres = $this->Master_model->updatedata('Mflnc_id', $editid, $data, 'mov_influencer');

            if ($profileres > 0) {
                $this->session->set_flashdata('success', "Update Record Successfully!");
                redirect('Influencer/edit_influencer/' . $editid . '/' . $search . '/' . $page);
            } else {
                $this->session->set_flashdata('error', 'Problem With Update!');
                redirect('Influencer/edit_influencer/' . $editid . '/' . $search . '/' . $page);
            }
        }
    }



    public function get_userdates()
    { 
        $this->form_validation->set_rules('userid', 'User Id', 'trim');
        $userid = $this->input->post('userid');
        // if ($this->form_validation->run() == FALSE) {
        //     $this->session->set_flashdata('error', validation_errors());
        //    // redirect('Appointment/edit_appointment/' . $editid . '/' . $search . '/' . $page);
        // } else {
            if(is_array($this->input->post('userid')))
            {
                $selectedids = $this->input->post('userid');
                $userid = implode(",",$selectedids);
            }else{
                $userid =$this->input->post('userid');
            }
        //$editdata['editappointment'] = $this->Master_model->select_data('mov_appointment', 'MA_start_datetime,MA_end_datetime,MA_reschedule_start_datetime,MA_reschedule_end_datetime', "MA_assignto IN (".$userid.")");
       // $appointmentdates = get_list("mov_appointment","FORMAT(MA_start_datetime,'DD/MM/YYYY') as MA_start_datetime,FORMAT(MA_end_datetime,'DD/MM/YYYY') as MA_end_datetime,FORMAT(MA_reschedule_start_datetime,'DD/MM/YYYY') as MA_reschedule_start_datetime,FORMAT(MA_reschedule_end_datetime,'DD/MM/YYYY') as MA_reschedule_end_datetime","MA_assignto IN (".$userid.")");
        $appointmentdates = get_list("mov_appointment","MA_start_datetime,MA_end_datetime,MA_reschedule_start_datetime,MA_reschedule_end_datetime","MA_assignto IN (".$userid.")");
        $noticevaluecomma ='';
        $noticevaluecomma = implode(',', array_column($appointmentdates, 'MA_start_datetime'));
        $noticevaluecommaend = implode(',', array_column($appointmentdates, 'MA_end_datetime'));
        $noticevaluecommarest = implode(',', array_column($appointmentdates, 'MA_reschedule_start_datetime'));
        $noticevaluecommareend = implode(',', array_column($appointmentdates, 'MA_reschedule_end_datetime'));
        $finalalldates = $noticevaluecomma.','.$noticevaluecommaend.','.$noticevaluecommarest.','.$noticevaluecommareend;
        $appointmentdatesvaluecomma = implode(',', array_unique(explode(',', $finalalldates)));
        //echo $this->db->last_query(); die();
       
        print_r($appointmentdatesvaluecomma); exit;
        // }
    }

    public function get_orderdata()
    { 
        $this->form_validation->set_rules('orderid', 'User Id', 'trim');
        $orderid = $this->input->post('orderid');
        $editdata['orderdata'] = $this->Master_model->select_data('mov_order', '*', "MOR_id = $orderid");
        //print_r($editdata);
        $instruction = $editdata['orderdata'][0]->MOR_special_instruction;
        // $appointmentdates = get_list("mov_appointment","FORMAT(MA_start_datetime,'DD/MM/YYYY') as MA_start_datetime,FORMAT(MA_end_datetime,'DD/MM/YYYY') as MA_end_datetime,FORMAT(MA_reschedule_start_datetime,'DD/MM/YYYY') as MA_reschedule_start_datetime,FORMAT(MA_reschedule_end_datetime,'DD/MM/YYYY') as MA_reschedule_end_datetime","MA_assignto IN (".$userid.")");
        $editdata['clientid'] = get_list("mov_clients","MC_cl_id","MC_cl_name LIKE '%".$editdata['orderdata'][0]->MOR_client_name."%'");
        $clienid = $editdata['clientid'][0]->MC_cl_id;
        $data = $clienid.','.$instruction;
        print_r($data); exit;
    }
}
