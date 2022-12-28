<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qualitycheck extends CI_Controller
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


    public function add_qualitycheck()
    {
        if (!in_array("Manage Quality", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $this->load->view("add_qualitycheck");
        }
    }


    public function add_qualitycheck_data()
    {
    //    echo "<pre>"; print_r($this->input->post());die();
		// $this->form_validation->set_rules('Mqua_checkby', 'Quality Check By', 'trim|required');
		$this->form_validation->set_rules('MUM_ID', 'Quality Check To', 'trim|required');
        $this->form_validation->set_rules('Mqua_number', 'Quality Number', 'trim|required');
        $this->form_validation->set_rules('Mqua_designation', 'Quality Number', 'trim|required');
        $this->form_validation->set_rules('ML_ID', 'Department', 'trim|required');
        $this->form_validation->set_rules('Mqua_criteria', 'Criteria', 'trim|required');
        $this->form_validation->set_rules('Mqua_status', 'Status', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Qualitycheck/add_qualitycheck/');
        } else{

            $id = $this->session->userdata('id');
            $Mqua_checkby = $this->input->post('Mqua_checkby');
            $Mqua_designation = $this->input->post('Mqua_designation');
            $MUM_ID = $this->input->post('MUM_ID');
            $Mqua_number = $this->input->post('Mqua_number');
            $ML_ID = $this->input->post('ML_ID');
            $Mqua_criteria = $this->input->post('Mqua_criteria');
            $Mqua_status = $this->input->post('Mqua_status');
                    
            $insertdata = array(
                //'Mqua_checkby' => $Mqua_checkby,
                'Mqua_checkby' => $id,
                'Mqua_designation' => $Mqua_designation,
                'MUM_ID' => $MUM_ID,
                'Mqua_number' => $Mqua_number,
                'ML_ID' => $ML_ID,
                'Mqua_criteria' => $Mqua_criteria,
                'Mqua_status' => $Mqua_status,
                'Mqua_CreatedBY' => $id,
                'Mqua_UpdatedBY' => $id,
                'Mqua_CreatedDate' => date("Y-m-d H:i:s"),
            );
          

            $qaulityID = $this->Master_model->Insertdata('mov_quality_check', $insertdata);
           
            if ($qaulityID > 0) {
				$this->session->set_flashdata('success', "Data Save Successfully!");
                redirect('Qualitycheck/add_qualitycheck/');
            } else {
				$this->session->set_flashdata('error', "Failed!");
                redirect('Qualitycheck/add_qualitycheck/'.$Mqua_checkby);
			}
		}
             //}
    }


    public function edit_qualitycheck($editid = "", $search = 'bm8=', $page = 0)
    {
        if (!in_array("Manage Quality", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $editdata['editfaq'] = $this->Master_model->select_data('mov_quality_check', '*', "Mqua_id =$editid");
            $editdata['searchval'] = $search;
            $editdata['pageval'] = $page;

            $taskid = $editid;
            $this->load->view('edit_qualitycheck', $editdata);
        }
    }
	

    public function edit_qualitycheck_data()
    {
        //$id=$this->session->userdata('id');

        $this->form_validation->set_rules('editid', 'Edit Id', 'trim');
        $editid = $this->input->post('editid');
        $original_value = $this->Master_model->select_data('mov_quality_check', '*', "Mqua_id=$editid");

        foreach ($original_value as $original_value1) {
            $original_value1->Mqua_checkby;
        }

        // if ($this->input->post('Mqua_checkby') != $original_value1->Mflnc_name) {
        //     $is_unique =  '|is_unique[mov_quality_check.Mqua_checkby]';
        // } else {
        //     $is_unique =  '';
        // }
        
        // $this->form_validation->set_rules('Mqua_checkby', 'Title', 'trim|required');
        // $aptype = $this->input->post('Mqua_checkby');

        // $this->form_validation->set_rules('Mqua_checkby', 'Quality Check By', 'trim|required');
		$this->form_validation->set_rules('MUM_ID', 'Quality Check To', 'trim|required');
		$this->form_validation->set_rules('Mqua_designation', 'Designation', 'required');
        $this->form_validation->set_rules('Mqua_number', 'Quality Number', 'trim|required');
        $this->form_validation->set_rules('ML_ID', 'Department', 'trim|required');
        $this->form_validation->set_rules('Mqua_criteria', 'Criteria', 'trim|required');
        $this->form_validation->set_rules('Mqua_status', 'Status', 'trim');

        $search = $this->input->post('search');
        $page = $this->input->post('page');
        $rechedule = 0;
        if ($this->input->post('rechedule')) {
            $rechedule = 1;
        }


        $status = $this->input->post('Mqua_status');
     

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Qualitycheck/edit_qualitycheck/' . $editid . '/' . $search . '/' . $page);
        } else {
            $id = $this->session->userdata('id');
            $editid = $this->input->post('editid');
          
            //$Mqua_checkby = $this->input->post('Mqua_checkby');
            $MUM_ID = $this->input->post('MUM_ID');
            $Mqua_designation = $this->input->post('Mqua_designation');
            $Mqua_number = $this->input->post('Mqua_number');
            $ML_ID = $this->input->post('ML_ID');
            $Mqua_criteria = $this->input->post('Mqua_criteria');
            $Mqua_status = $this->input->post('Mqua_status');
            //$userid = $this->input->post('userid');
            $userid = 0 ;
            if($this->input->post('userid'))
            {
                $selectedids = $this->input->post('userid');
                $userid = implode(",",$selectedids);
            }
           
            $data = array(
                // 'Mqua_checkby' => $Mqua_checkby,
                'Mqua_checkby' => $id,
                'Mqua_designation' => $Mqua_designation,
                'MUM_ID' => $MUM_ID,
                'Mqua_number' => $Mqua_number,
                'ML_ID' => $ML_ID,
                'Mqua_criteria' => $Mqua_criteria,
                'Mqua_status' => $Mqua_status,
                'Mqua_UpdatedBY' => $id,
            );
            
            $profileres = $this->Master_model->updatedata('Mqua_id', $editid, $data, 'mov_quality_check');

            if ($profileres > 0) {
                $this->session->set_flashdata('success', "Update Record Successfully!");
                redirect('Qualitycheck/edit_qualitycheck/' . $editid . '/' . $search . '/' . $page);
            } else {
                $this->session->set_flashdata('error', 'Problem With Update!');
                redirect('Qualitycheck/edit_qualitycheck/' . $editid . '/' . $search . '/' . $page);
            }
        }
    }



    // public function get_userdates()
    // { 
    //     $this->form_validation->set_rules('userid', 'User Id', 'trim');
    //     $userid = $this->input->post('userid');
    //     // if ($this->form_validation->run() == FALSE) {
    //     //     $this->session->set_flashdata('error', validation_errors());
    //     //    // redirect('Appointment/edit_appointment/' . $editid . '/' . $search . '/' . $page);
    //     // } else {
    //         if(is_array($this->input->post('userid')))
    //         {
    //             $selectedids = $this->input->post('userid');
    //             $userid = implode(",",$selectedids);
    //         }else{
    //             $userid =$this->input->post('userid');
    //         }
    //     //$editdata['editappointment'] = $this->Master_model->select_data('mov_appointment', 'MA_start_datetime,MA_end_datetime,MA_reschedule_start_datetime,MA_reschedule_end_datetime', "MA_assignto IN (".$userid.")");
    //    // $appointmentdates = get_list("mov_appointment","FORMAT(MA_start_datetime,'DD/MM/YYYY') as MA_start_datetime,FORMAT(MA_end_datetime,'DD/MM/YYYY') as MA_end_datetime,FORMAT(MA_reschedule_start_datetime,'DD/MM/YYYY') as MA_reschedule_start_datetime,FORMAT(MA_reschedule_end_datetime,'DD/MM/YYYY') as MA_reschedule_end_datetime","MA_assignto IN (".$userid.")");
    //     $appointmentdates = get_list("mov_appointment","MA_start_datetime,MA_end_datetime,MA_reschedule_start_datetime,MA_reschedule_end_datetime","MA_assignto IN (".$userid.")");
    //     $noticevaluecomma ='';
    //     $noticevaluecomma = implode(',', array_column($appointmentdates, 'MA_start_datetime'));
    //     $noticevaluecommaend = implode(',', array_column($appointmentdates, 'MA_end_datetime'));
    //     $noticevaluecommarest = implode(',', array_column($appointmentdates, 'MA_reschedule_start_datetime'));
    //     $noticevaluecommareend = implode(',', array_column($appointmentdates, 'MA_reschedule_end_datetime'));
    //     $finalalldates = $noticevaluecomma.','.$noticevaluecommaend.','.$noticevaluecommarest.','.$noticevaluecommareend;
    //     $appointmentdatesvaluecomma = implode(',', array_unique(explode(',', $finalalldates)));
    //     //echo $this->db->last_query(); die();
       
    //     print_r($appointmentdatesvaluecomma); exit;
    //     // }
    // }

    // public function get_orderdata()
    // { 
    //     $this->form_validation->set_rules('orderid', 'User Id', 'trim');
    //     $orderid = $this->input->post('orderid');
    //     $editdata['orderdata'] = $this->Master_model->select_data('mov_order', '*', "MOR_id = $orderid");
    //     //print_r($editdata);
    //     $instruction = $editdata['orderdata'][0]->MOR_special_instruction;
    //     // $appointmentdates = get_list("mov_appointment","FORMAT(MA_start_datetime,'DD/MM/YYYY') as MA_start_datetime,FORMAT(MA_end_datetime,'DD/MM/YYYY') as MA_end_datetime,FORMAT(MA_reschedule_start_datetime,'DD/MM/YYYY') as MA_reschedule_start_datetime,FORMAT(MA_reschedule_end_datetime,'DD/MM/YYYY') as MA_reschedule_end_datetime","MA_assignto IN (".$userid.")");
    //     $editdata['clientid'] = get_list("mov_clients","MC_cl_id","MC_cl_name LIKE '%".$editdata['orderdata'][0]->MOR_client_name."%'");
    //     $clienid = $editdata['clientid'][0]->MC_cl_id;
    //     $data = $clienid.','.$instruction;
    //     print_r($data); exit;
    // }
}
