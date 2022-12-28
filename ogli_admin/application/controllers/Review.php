<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Review extends CI_Controller
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


    public function add_review()
    {
        if (!in_array("Manage Review", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $this->load->view("add_review");
        }
    }


    public function add_review_data()
    {
    //    echo "<pre>"; print_r($this->input->post());die();
		$this->form_validation->set_rules('MRV_rating', 'Rate', 'trim|required');
		$this->form_validation->set_rules('MRV_review_title', 'Page Name', 'trim|required');
        $this->form_validation->set_rules('MRV_review', 'Review', 'trim|required');
        $this->form_validation->set_rules('MRV_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('MRV_email', 'Email', 'trim|required');
        $this->form_validation->set_rules('MRV_phone', 'Phone', 'required');
        $this->form_validation->set_rules('MRV_status', 'Status', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('');
        } else{

            $id = $this->session->userdata('id');
            $MRV_rating = $this->input->post('MRV_rating');
            $MRV_review_title = $this->input->post('MRV_review_title');
            $MRV_review = $this->input->post('MRV_review');
            $MRV_name = $this->input->post('MRV_name');
            $MRV_email = $this->input->post('MRV_email');
            $MRV_phone = $this->input->post('MRV_phone');
            $MRV_status = $this->input->post('MRV_status');
                    
            $insertdata = array(
                'MRV_rating' => $MRV_rating,
                'MRV_review_title' => $MRV_review_title,
                'MRV_review' => $MRV_review,
                'MRV_name' => $MRV_name,
                'MRV_email' => $MRV_email,
                'MRV_phone' => $MRV_phone,
                'MRV_status' => $MRV_status,
                'MRV_CreatedBY' => $id,
                'MRV_UpdatedBY' => $id,
                'MRV_CreatedDate' => date("Y-m-d H:i:s"),
            );
          

            $MRV_revid = $this->Master_model->Insertdata('mov_review', $insertdata);
           
            if ($MRV_revid > 0) {
				$this->session->set_flashdata('success', "Data Save Successfully!");
                redirect('Review/add_review/');
            } else {
				$this->session->set_flashdata('error', "Failed!");
                redirect('Review/add_review/'.$MRV_review_title);
			}
		}
             //}
    }

    public function view_review($editid = 0, $search = 'bm8=', $page = 0)
	{
		$id = $this->session->userdata('id');
		$editdata['viewreview'] = $this->Master_model->select_row('mov_review', '*', "MRV_revid =$editid");
        // echo"<pre>";print_r($editdata);die();
        $editdata['searchval'] = $search;
		$editdata['pageval'] = $page;
		$this->load->view('view_review', $editdata);
	}

    public function edit_review($editid = "", $search = 'bm8=', $page = 0)
    {
        if (!in_array("Manage Review", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $editdata['editreview'] = $this->Master_model->select_data('mov_review', '*', "MRV_revid =$editid");
            $editdata['searchval'] = $search;
            $editdata['pageval'] = $page;

            $taskid = $editid;
            $this->load->view('edit_review', $editdata);
        }
    }
	

    public function edit_review_data()
    {
    //    echo "<pre>"; print_r($this->input->post());die();
        
        $id=$this->session->userdata('id');

        $this->form_validation->set_rules('editid', 'Edit Id', 'trim');
        $editid = $this->input->post('editid');
        $original_value = $this->Master_model->select_data('mov_review', '*', "MRV_revid=$editid");

        foreach ($original_value as $original_value1) {
            $original_value1->MQa_title;
        }

        if ($this->input->post('MRV_review_title') != $original_value1->MQa_title) {
            $is_unique =  '|is_unique[mov_review.MRV_review_title]';
        } else {
            $is_unique =  '';
        }
        
       
        $this->form_validation->set_rules('MRV_rating', 'Rate', 'trim|required');
		// $this->form_validation->set_rules('MRV_review_title', 'Page Name', 'trim|required');
        $this->form_validation->set_rules('MRV_review', 'Review', 'trim|required');
        $this->form_validation->set_rules('MRV_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('MRV_email', 'Email', 'trim|required');
        $this->form_validation->set_rules('MRV_phone', 'Phone', 'required');
        $this->form_validation->set_rules('MRV_status', 'Status', 'trim');

        $search = $this->input->post('search');
        $page = $this->input->post('page');
        $rechedule = 0;
        if ($this->input->post('rechedule')) {
            $rechedule = 1;
        }


        $MRV_status = $this->input->post('MRV_status');
     

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Review/edit_review/' . $editid . '/' . $search . '/' . $page);
        } else {
            $id = $this->session->userdata('id');
            $editid = $this->input->post('editid');
          
          
            $id = $this->session->userdata('id');
            $MRV_rating = $this->input->post('MRV_rating');
            $MRV_review_title = $this->input->post('MRV_review_title');
            $MRV_review = $this->input->post('MRV_review');
            $MRV_name = $this->input->post('MRV_name');
            $MRV_email = $this->input->post('MRV_email');
            $MRV_phone = $this->input->post('MRV_phone');
            $MRV_status = $this->input->post('MRV_status');
            
            //$userid = $this->input->post('userid');
            $userid = 0 ;
            if($this->input->post('userid'))
            {
                $selectedids = $this->input->post('userid');
                $userid = implode(",",$selectedids);
            }
           
            $data = array(
                'MRV_rating' => $MRV_rating,
                'MRV_review_title' => $MRV_review_title,
                'MRV_review' => $MRV_review,
                'MRV_name' => $MRV_name,
                'MRV_email' => $MRV_email,
                'MRV_phone' => $MRV_phone,
                'MRV_status' => $MRV_status,
                'MRV_CreatedBY' => $id,
                'MRV_UpdatedBY' => $id,
            );
            
            $profileres = $this->Master_model->updatedata('MRV_revid', $editid, $data, 'mov_review');

            if ($profileres > 0) {
                $this->session->set_flashdata('success', "Update Record Successfully!");
                redirect('Review/edit_review/' . $editid . '/' . $search . '/' . $page);
            } else {
                $this->session->set_flashdata('error', 'Problem With Update!');
                redirect('Review/edit_review/' . $editid . '/' . $search . '/' . $page);
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
        print_r($appointmentdatesvaluecomma); exit;
    }

    public function get_orderdata()
    { 
        $this->form_validation->set_rules('orderid', 'User Id', 'trim');
        $orderid = $this->input->post('orderid');
        $editdata['orderdata'] = $this->Master_model->select_data('mov_order', '*', "MOR_id = $orderid");
        $instruction = $editdata['orderdata'][0]->MOR_special_instruction;
        $editdata['clientid'] = get_list("mov_clients","MC_cl_id","MC_cl_name LIKE '%".$editdata['orderdata'][0]->MOR_client_name."%'");
        $clienid = $editdata['clientid'][0]->MC_cl_id;
       $data = $clienid.','.$instruction;
       print_r($data); exit;
    }
}
