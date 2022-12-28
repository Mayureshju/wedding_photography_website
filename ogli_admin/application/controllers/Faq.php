<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CI_Controller
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


    public function add_faq()
    {
        if (!in_array("Manage FAQ", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $this->load->view("add_faq");
        }
    }


    public function add_faq_data()
    {
		$this->form_validation->set_rules('MQa_title', 'Question', 'trim|required');
		$this->form_validation->set_rules('pagename', 'Page Name', 'trim|required');
        $this->form_validation->set_rules('MQa_answer', 'Answer', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('');
        } else{

            $id = $this->session->userdata('id');
            $MM_ID = $this->input->post('pagename');
            $MQa_title = $this->input->post('MQa_title');
            $MQa_answer = $this->input->post('MQa_answer');
            $MQa_status = $this->input->post('status');
                    
            $insertdata = array(
                'MQa_title' => $MQa_title,
                'MM_ID' => $MM_ID,
                'MQa_answer' => $MQa_answer,
                'MQa_status' => $MQa_status,
                'MQa_CreatedBY' => $id,
                'MQa_UpdatedBY' => $id,
                'MQa_CreatedDate' => date("Y-m-d H:i:s"),
            );
          

            $faqID = $this->Master_model->Insertdata('mov_qa', $insertdata);
           
            if ($faqID > 0) {
				$this->session->set_flashdata('success', "Data Save Successfully!");
                redirect('Faq/add_faq/');
            } else {
				$this->session->set_flashdata('error', "Failed!");
                redirect('Faq/add_faq/'.$MQa_title);
			}
		}
             //}
    }


    public function edit_faq($editid = "", $search = 'bm8=', $page = 0)
    {
        if (!in_array("Manage FAQ", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $editdata['editfaq'] = $this->Master_model->select_data('mov_qa', '*', "MQa_id =$editid");
            $editdata['searchval'] = $search;
            $editdata['pageval'] = $page;

            $taskid = $editid;
            $this->load->view('faq_edit', $editdata);
        }
    }
	

    public function edit_faq_data()
    {
        //$id=$this->session->userdata('id');

        $this->form_validation->set_rules('editid', 'Edit Id', 'trim');
        $editid = $this->input->post('editid');
        $original_value = $this->Master_model->select_data('mov_qa', '*', "MQa_id=$editid");

        foreach ($original_value as $original_value1) {
            $original_value1->MQa_title;
        }

        if ($this->input->post('MQa_title') != $original_value1->MQa_title) {
            $is_unique =  '|is_unique[mov_qa.MQa_title]';
        } else {
            $is_unique =  '';
        }
        
        $this->form_validation->set_rules('MQa_title', 'Title', 'trim|required');
        $aptype = $this->input->post('MQa_title');

        $this->form_validation->set_rules('pagename', 'Page Name', 'trim|required');
        $this->form_validation->set_rules('MQa_title', 'Title', 'trim|required');
        $this->form_validation->set_rules('MQa_answer', 'Answer', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim');

        $search = $this->input->post('search');
        $page = $this->input->post('page');
        $rechedule = 0;
        if ($this->input->post('rechedule')) {
            $rechedule = 1;
        }


        $status = $this->input->post('status');
     

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Faq/edit_faq/' . $editid . '/' . $search . '/' . $page);
        } else {
            $id = $this->session->userdata('id');
            $editid = $this->input->post('editid');
          
            $MM_ID = $this->input->post('pagename');

            $MQa_title = $this->input->post('MQa_title');      
            $MQa_answer = $this->input->post('MQa_answer'); 
            //$userid = $this->input->post('userid');
            $userid = 0 ;
            if($this->input->post('userid'))
            {
                $selectedids = $this->input->post('userid');
                $userid = implode(",",$selectedids);
            }
           
            $data = array(
                'MM_ID' => $MM_ID,
                'MQa_title' => $MQa_title,
                'MQa_answer' => $MQa_answer,
                'MQa_status' => $status,
                'MQa_UpdatedBY' => $id,
            );
            
            $profileres = $this->Master_model->updatedata('MQa_id', $editid, $data, 'mov_qa');

            if ($profileres > 0) {
                $this->session->set_flashdata('success', "Update Record Successfully!");
                redirect('Faq/edit_faq/' . $editid . '/' . $search . '/' . $page);
            } else {
                $this->session->set_flashdata('error', 'Problem With Update!');
                redirect('Faq/edit_faq/' . $editid . '/' . $search . '/' . $page);
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
        // if ($this->form_validation->run() == FALSE) {
        //     $this->session->set_flashdata('error', validation_errors());
        //    // redirect('Appointment/edit_appointment/' . $editid . '/' . $search . '/' . $page);
        // } else {
            // if(is_array($this->input->post('userid')))
            // {
            //     $selectedids = $this->input->post('userid');
            //     $userid = implode(",",$selectedids);
            // }else{
            //     $userid =$this->input->post('userid');
            // }
        $editdata['orderdata'] = $this->Master_model->select_data('mov_order', '*', "MOR_id = $orderid");
        //print_r($editdata);
        $instruction = $editdata['orderdata'][0]->MOR_special_instruction;
       // $appointmentdates = get_list("mov_appointment","FORMAT(MA_start_datetime,'DD/MM/YYYY') as MA_start_datetime,FORMAT(MA_end_datetime,'DD/MM/YYYY') as MA_end_datetime,FORMAT(MA_reschedule_start_datetime,'DD/MM/YYYY') as MA_reschedule_start_datetime,FORMAT(MA_reschedule_end_datetime,'DD/MM/YYYY') as MA_reschedule_end_datetime","MA_assignto IN (".$userid.")");
       $editdata['clientid'] = get_list("mov_clients","MC_cl_id","MC_cl_name LIKE '%".$editdata['orderdata'][0]->MOR_client_name."%'");
        $clienid = $editdata['clientid'][0]->MC_cl_id;
       $data = $clienid.','.$instruction;
       print_r($data); exit;
       
       //print_r($editdata); exit;
        //$noticevaluecomma ='';
        // $noticevaluecomma = implode(',', array_column($appointmentdates, 'MA_start_datetime'));
        // $noticevaluecommaend = implode(',', array_column($appointmentdates, 'MA_end_datetime'));
        // $noticevaluecommarest = implode(',', array_column($appointmentdates, 'MA_reschedule_start_datetime'));
        // $noticevaluecommareend = implode(',', array_column($appointmentdates, 'MA_reschedule_end_datetime'));
        // $finalalldates = $noticevaluecomma.','.$noticevaluecommaend.','.$noticevaluecommarest.','.$noticevaluecommareend;
        // $appointmentdatesvaluecomma = implode(',', array_unique(explode(',', $finalalldates)));
        //echo $this->db->last_query(); die();
       
       // print_r($appointmentdatesvaluecomma); exit;
        // }
    }
}
