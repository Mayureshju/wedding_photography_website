<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Master_model');


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

	public function add_enquiry()
    {
        if (!in_array("Manage Enquiry", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $this->load->view("add_enquiry");
        }
    }

	public function add_enquiry_data()
    {

    	// print_r($this->input->post());die();

		$this->form_validation->set_rules('firstname', 'Name', 'trim|required');
        $this->form_validation->set_rules('mail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobiel number', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('');
        } else{

            $id = $this->session->userdata('id');
            $MPC_ID = $this->input->post('MPC_ID');
            $MPC_seo_url = $this->input->post('MPC_seo_url');
            $MEnq_contact_name_f = $this->input->post('firstname');
            $MEnq_contact_name_l = $this->input->post('lastname');
            $MC_cl_phone = $this->input->post('mobile');
            $MEnq_email = $this->input->post('mail');
            $MEnq_budgeted = $this->input->post('budgeted');
            $MEnq_message = $this->input->post('message');
            $MEnq_city = $this->input->post('city');
            $MEnq_enquiry_type = $this->input->post('MEnq_enquiry_type');
            $status = 0;
                    
            $insertdata = array(
                'MPC_ID' => $MPC_ID,
                'MEnq_contact_name' => $MEnq_contact_name_f .' '. $MEnq_contact_name_l,
                'MEnq_phone' => $MC_cl_phone,
                'MEnq_email' => $MEnq_email,
                'MEnq_budgeted' => $MEnq_budgeted,
                'MEnq_message' => $MEnq_message,
                'MEnq_city' => $MEnq_city,
                'MEnq_enquiry_type' => $MEnq_enquiry_type,
                'MEnq_status' => $status,
                'MEnq_CreatedDate' => date("Y-m-d H:i:s"),
            );
          

            $clientID = $this->Master_model->Insertdata('mov_enquiry', $insertdata);
           
            if ($clientID > 0) {
				$this->session->set_flashdata('success', "Data Save Successfully!");
                redirect('Enquiry/add_enquiry/');
            } else {
				$this->session->set_flashdata('error', "Failed!");
                redirect('Enquiry/add_enquiry/'.$clientID);
			}
		}
    }
	
	public function edit_enquiry($editid = 0, $search = 'bm8=', $page = 0){
		$editdata['editenquiry'] =  $this->Master_model->select_row('mov_enquiry','*',"MEnq_id = ".$editid);
		$editdata['mode'] =get_list('mov_lov','*','ML_LOV_Name="Enquiry Followup Modes"');
		$editdata['followup'] =get_list_order_by('mov_follow_up','*','MEnq_id='.$editid,'MF_id DESC');
		$editdata['user'] =get_list('mov_user_master','*','MUM_status="1"');
		$editdata['searchval'] = $search;
		$editdata['pageval'] = $page;
		$this->load->view('edit_enquiry', $editdata);
			
		}

	public function changestatus()
	{
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		$this->Master_model->updatedata('MF_id',$id,array('MF_status'=>$status),'mov_follow_up');
	}
	

	public function edit_enquiry_data()
    {
        $id=$this->session->userdata('id');
        $this->form_validation->set_rules('editid', 'Edit Id', 'trim');
	 	$this->form_validation->set_rules('comments', 'comments', 'trim');
	 	$this->form_validation->set_rules('followup', 'followup', 'trim');
		 $this->form_validation->set_rules('mode', 'mode', 'trim');
		 $this->form_validation->set_rules('reminder_time', 'reminder_time', 'trim');
		 $this->form_validation->set_rules('assignto', 'assignto', 'trim');
		 $this->form_validation->set_rules('enquirystatus', 'enquirystatus', 'trim');
      	$admin_ip = $_SERVER['REMOTE_ADDR'];
		$editid = $this->input->post('editid');
		$search = $this->input->post('search');
		$page = $this->input->post('page');
		$comments = $this->input->post('comments');
		$followup = $this->input->post('followup');
		$mode = $this->input->post('mode');
		$reminder_time = $this->input->post('reminder_time');
		$assignto = $id;
		if($this->input->post('assignto')){
		$assignto = $this->input->post('assignto');
		}
		$enquirystatus = $this->input->post('enquirystatus');
	 if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
             redirect($actual_link);
        } else {

			if(!empty($_FILES["followUpAttachment"]['name']))
			{
				$followUpAttachment = time().'_'.$_FILES["followUpAttachment"]['name'];
				$config['file_name'] = $followUpAttachment;
				$tattoo1 = str_replace(' ', '_', $followUpAttachment);
				$config['upload_path'] = 'uploads/attachment/';
				$config['allowed_types']        = 'jpg|jpeg|png|doc|pdf';
				$config['max_size']             = 20000000; //50000
				$config['max_width']            = 20000000;
				$config['max_height']           = 20000000;
				$this->load->library("upload", $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('followUpAttachment'))
				{
					$followUpAttachment = '';
				}
			}
			else
			{
				$followUpAttachment = '';
			}
      
            $insertdata = array(
				'MEnq_id'=>$editid,
                'MF_comment' => $comments,
                'MF_follow_date' => $followup,
                'MF_follow_mode' => $mode,
				'MF_reminder' => $reminder_time  ,
				'MF_assigned_to'=>$assignto,
				'MEnq_status'=> $enquirystatus,
				'MF_status'=>0,
				'MF_CreatedBY'=>$id ,
				'MF_file'=> $followUpAttachment        
            );

			$profileres = $this->Master_model->Insertdata('mov_follow_up',$insertdata);
			$this->Master_model->updatedata('MEnq_id',$editid,array('MEnq_status'=>$enquirystatus,'MEnq_follow_up'=>$followup),'mov_enquiry');

            if ($profileres > 0) {
                $this->session->set_flashdata('success', "Update Record Successfully!");
				redirect('Enquiry/edit_enquiry/' . $editid . '/' . $search . '/' . $page);
            } else {
                $this->session->set_flashdata('error', 'Problem With Update!');
				redirect('Enquiry/edit_enquiry/' . $editid . '/' . $search . '/' . $page);
            }
            //}
        }
    }


	
	
	
	
public function deletelink(){	
	$this->form_validation->set_rules('delid[]','Delete Link','trim');
	if($this->form_validation->run()==FALSE){
			 echo validation_errors();
	}else{
		$delid = $this->input->post('delid');
		for($i=0;$i<count($delid);$i++){
			$this->Master_model->deletedatawhere("MEnq_id=$delid[$i]",'mov_enquiry');
		}
		echo 'yes';
	}
}	
	
	
	
public function view_enquiry(){
$id=$this->session->userdata('id');
$this->form_validation->set_rules('pro_id', 'pro_id', 'trim');
$pro_id = $this->input->post('pro_id');	
$get_enquirydata = 	$this->Master_model->select_row('mov_enquiry','*',"MEnq_id = ".$pro_id);
$MEnq_id = '';
$MEnq_name = '';
$MEnq_message = '';
$MEnq_company_name = '';
$MEnq_website_url = '';
if(isset($get_enquirydata)){
$MEnq_id = $get_enquirydata->MEnq_id;
$MEnq_name = $get_enquirydata->MEnq_name;
$MEnq_message = $get_enquirydata->MEnq_message;	
$MEnq_company_name = $get_enquirydata->MEnq_company_name;	
$MEnq_website_url = $get_enquirydata->MEnq_website_url;	
}
$message = '';
	$message .= '<p> <b>Enquiry Id</b> : #'.$MEnq_id.'</p>';
	$message .= '<p> <b>Client Name</b> : '.$MEnq_name.'</p>';
	$message .= '<p> <b>Company Name</b> : '.$MEnq_company_name.'</p>';
	$message .= '<p> <b>Company Url</b> : '.$MEnq_website_url.'</p>';
	$message .= '<p> <b>Message</b> : '.$MEnq_message.'</p>';
echo $message;
}
	
	
		
}
?>