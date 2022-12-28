<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Internalhelp extends CI_Controller
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


    public function add_internalhelp()
    {
        if (!in_array("Manage Internalhelp", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $this->load->view("add_internalhelp");
        }
    }


    public function add_internalhelp_data()
    {
		$this->form_validation->set_rules('MIh_title', 'Question', 'trim|required');
        $this->form_validation->set_rules('MIh_answer', 'Answer', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('');
        } else{

            $id = $this->session->userdata('id');
            $MIh_title = $this->input->post('MIh_title');
            $MIh_answer = $this->input->post('MIh_answer');
            $MIh_status = $this->input->post('status');
                    
            $insertdata = array(
                'MIh_title' => $MIh_title,
                'MIh_answer' => $MIh_answer,
                'MIh_status' => $MIh_status,
                'MIh_CreatedBY' => $id,
                'MIh_UpdatedBY' => $id,
                'MIh_CreatedDate' => date("Y-m-d H:i:s"),
            );
          

            $internalhelp_id = $this->Master_model->Insertdata('mov_internalhelp', $insertdata);
           
            if ($internalhelp_id > 0) {
				$this->session->set_flashdata('success', "Data Save Successfully!");
                redirect('Internalhelp/add_internalhelp/');
            } else {
				$this->session->set_flashdata('error', "Failed!");
                redirect('Internalhelp/add_internalhelp/'.$MIh_title);
			}
		}
             //}
    }


    public function edit_internalhelp($editid = "", $search = 'bm8=', $page = 0)
    {
        if (!in_array("Manage Internalhelp", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $editdata['editinternalhelp'] = $this->Master_model->select_data('mov_internalhelp', '*', "MIh_id =$editid");
            $editdata['searchval'] = $search;
            $editdata['pageval'] = $page;

            $taskid = $editid;
            $this->load->view('edit_internalhelp', $editdata);
        }
    }
	

    public function edit_internalhelp_data()
    {
        //$id=$this->session->userdata('id');

        $this->form_validation->set_rules('editid', 'Edit Id', 'trim');
        $editid = $this->input->post('editid');
        $original_value = $this->Master_model->select_data('mov_internalhelp', '*', "MIh_id=$editid");

        foreach ($original_value as $original_value1) {
            $original_value1->MIh_title;
        }

        if ($this->input->post('MIh_title') != $original_value1->MIh_title) {
            $is_unique =  '|is_unique[mov_internalhelp.MIh_title]';
        } else {
            $is_unique =  '';
        }
        
        $this->form_validation->set_rules('MIh_title', 'Title', 'trim|required');
        $aptype = $this->input->post('MIh_title');

        $this->form_validation->set_rules('MIh_title', 'Title', 'trim|required');
        $this->form_validation->set_rules('MIh_answer', 'Answer', 'trim|required');
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
            redirect('Internalhelp/edit_internalhelp/' . $editid . '/' . $search . '/' . $page);
        } else {
            $id = $this->session->userdata('id');
            $editid = $this->input->post('editid');
          

            $MIh_title = $this->input->post('MIh_title');      
            $MIh_answer = $this->input->post('MIh_answer'); 
            //$userid = $this->input->post('userid');
            $userid = 0 ;
            if($this->input->post('userid'))
            {
                $selectedids = $this->input->post('userid');
                $userid = implode(",",$selectedids);
            }
           
            $data = array(
                'MIh_title' => $MIh_title,
                'MIh_answer' => $MIh_answer,
                'MIh_status' => $status,
                'MIh_UpdatedBY' => $id,
            );
            
            $profileres = $this->Master_model->updatedata('MIh_id', $editid, $data, 'mov_internalhelp');

            if ($profileres > 0) {
                $this->session->set_flashdata('success', "Update Record Successfully!");
                redirect('Internalhelp/edit_internalhelp/' . $editid . '/' . $search . '/' . $page);
            } else {
                $this->session->set_flashdata('error', 'Problem With Update!');
                redirect('Internalhelp/edit_internalhelp/' . $editid . '/' . $search . '/' . $page);
            }
        }
    }



    public function get_userdates()
    { 
        $this->form_validation->set_rules('userid', 'User Id', 'trim');
        $userid = $this->input->post('userid');
            if(is_array($this->input->post('userid')))
            {
                $selectedids = $this->input->post('userid');
                $userid = implode(",",$selectedids);
            }else{
                $userid =$this->input->post('userid');
            }
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
