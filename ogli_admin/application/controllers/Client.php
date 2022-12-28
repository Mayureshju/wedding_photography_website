<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
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

    public function add_client()
    {
        if (!in_array("Clients", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $this->load->view("add_client");
        }
    }


    public function add_client_data()
    {
        $id = $this->session->userdata('id');
       

        $this->form_validation->set_rules('clientname', 'Client Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phnumber', 'Phone number', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
     //   $this->form_validation->set_rules('username', 'Username', 'trim|required');
     //   $this->form_validation->set_rules('password', 'password', 'trim|required');
    
        $this->form_validation->set_rules('cljoindate', 'Client join date', 'trim|required');
        $this->form_validation->set_rules('clbirthdate', 'Client birth date', 'trim');

        $this->form_validation->set_rules('status', 'Status', 'trim');

        $clnttype = $this->input->post('clienttype');
        $this->form_validation->set_rules('clienttype', 'Client Type', 'trim|required');
        if($clnttype == 'referred'){
            $this->form_validation->set_rules('MC_cl_referred_id', 'Referred Name', 'trim|required');
        }
      
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('add_client');
        } else {
            $id = $this->session->userdata('id');
            $clientname = $this->input->post('clientname');

            $email = $this->input->post('email');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               // $emailErr = "Invalid email format";
                $this->session->set_flashdata('error', 'Invalid email format.');
                redirect('Client/add_client/');
            }
            $phnumber = $this->input->post('phnumber');

            $address = $this->input->post('address');
			// $username = $this->input->post('username');
			// $password = $this->input->post('password');
			// $enpass = base64_encode($password);
			// $enusername = base64_encode($username);
        
            $cljoindate = $this->input->post('cljoindate');
            $clbirthdate = $this->input->post('clbirthdate');
         

            $status = 0;
            if ($this->input->post('status')) {
                $status = 1;
            }


            $clienttype = $this->input->post('clienttype');
            $MC_cl_referred_id = $this->input->post('MC_cl_referred_id');


           

            $checkcatname = $this->Master_model->checkdata('MC_cl_id', 'mov_clients', ' MC_cl_name = "' . $clientname . '"');
            if ($checkcatname >= 1) {
                $this->session->set_flashdata('error', 'client ' . $clientname . ' is already available.');
                redirect('Client/add_client/');
            }


            $insertdata = array(
                'MC_cl_name' => $clientname,
                'MC_cl_email' => $email,
                'MC_cl_phone' => $phnumber,
                'MC_cl_add' => $address,
             
                'MC_cl_join_date' => date('Y-m-d',strtotime($cljoindate)),
                'MC_cl_DOB' => date('Y-m-d',strtotime($clbirthdate)),
               
                'MC_cl_status' => $status,
                'MC_CreatedBY' => $id,
                'MC_UpdatedBY' => $id,

                'MC_cl_clienttype' => $clienttype,
                'MC_cl_referred_id' => $MC_cl_referred_id,
                
                'MC_CreatedDate' => date("Y-m-d H:i:s"),
            );
          

            $clientID = $this->Master_model->InsertdatawithlastID('mov_clients', $insertdata);
            if ($insertdata > 0) {


                $this->session->set_userdata('sessreq_category', '');
            }

            if ($clientID > 0) {
                $this->session->set_flashdata('success', "Insert Record Successfully!");
                redirect('Client/add_client/');
            } else {
                $this->session->set_flashdata('error', "Insert Failed!");
                redirect('Client/add_client/' . $clientname);
            }
             //}
        }
    }


    public function edit_client($editid = "", $search = 'bm8=', $page = 0)
    {
        if (!in_array("Clients", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $editdata['editclient'] = $this->Master_model->select_data('mov_clients', '*', "MC_cl_id=$editid");

            $editdata['searchval'] = $search;
            $editdata['pageval'] = $page;
            $this->load->view('edit_client', $editdata);
        }
    }

    public function edit_client_data()
    {
        //$id=$this->session->userdata('id');

        $this->form_validation->set_rules('editid', 'Edit Id', 'trim');
        $editid = $this->input->post('editid');
        // $MUM_ID = $this->input->post('MUM_ID');
        $original_value = $this->Master_model->select_data('mov_clients', '*', "MC_cl_id=$editid");

        foreach ($original_value as $original_value1) {
            $original_value1->MC_cl_name;
        }

        if ($this->input->post('clientname') != $original_value1->MC_cl_name) {
            $is_unique =  '|is_unique[mov_clients.MC_cl_name]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules('clientname', 'Category Name', 'required|trim' . $is_unique);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phnumber', 'Phone number', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
       // $this->form_validation->set_rules('username', 'Username', 'trim|required');
      //  $this->form_validation->set_rules('password', 'password', 'trim|required');
        
        $this->form_validation->set_rules('cljoindate', 'Client join date', 'trim|required');
	 	$this->form_validation->set_rules('clbirthdate', 'Client birth date', 'trim');

   
        $this->form_validation->set_rules('status', 'Status', 'trim');

        $clnttype = $this->input->post('clienttype');
        $this->form_validation->set_rules('clienttype', 'Client Type', 'trim|required');
        if($clnttype == 'referred'){
            $this->form_validation->set_rules('MC_cl_referred_id', 'Referred Name', 'trim|required');
        }

        $search = $this->input->post('search');
        $page = $this->input->post('page');

        $clienttype = $this->input->post('clienttype');
        $MC_cl_referred_id = $this->input->post('MC_cl_referred_id');
     

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Client/edit_client/' . $editid . '/' . $search . '/' . $page);
        } else {
            $id = $this->session->userdata('id');
            $editid = $this->input->post('editid');

            $clientname = $this->input->post('clientname');
            $email = $this->input->post('email');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // $emailErr = "Invalid email format";
                 $this->session->set_flashdata('error', 'Invalid email format.');
                 redirect('Client/add_client/');
             }
            $phnumber = $this->input->post('phnumber');
            $address = $this->input->post('address');
			
           // $username = $this->input->post('username');
           // $password = $this->input->post('password');
		   // $enpass = base64_encode($password);
		   // $enusername = base64_encode($username);
			
           
            $cljoindate = $this->input->post('cljoindate');
		 	$clbirthdate = $this->input->post('clbirthdate');
            
			$status = 0;
            if ($this->input->post('status')) {
                $status = 1;
            }


           

            $data = array(
                'MC_cl_name' => $clientname,
                'MC_cl_email' => $email,
                'MC_cl_phone' => $phnumber,
                'MC_cl_add' => $address,
             //   'MC_cl_username' => $enusername,
             //   'MC_cl_password' => $enpass,
               
                'MC_cl_join_date' => date('Y-m-d',strtotime($cljoindate)),
			 	'MC_cl_DOB' => date('Y-m-d',strtotime($clbirthdate)),
             
                 'MC_cl_clienttype' => $clienttype,
                 'MC_cl_referred_id' => $MC_cl_referred_id,

                'MC_cl_status' => $status,
                'MC_UpdatedBY' => $id,
            );
          
            $profileres = $this->Master_model->updatedata('MC_cl_id', $editid, $data, 'mov_clients');

            if ($profileres > 0) {

                $this->session->set_flashdata('success', "Update Record Successfully!");
                redirect('Client/edit_client/' . $editid . '/' . $search . '/' . $page);
            } else {
                $this->session->set_flashdata('error', 'Problem With Update!');
                redirect('Client/edit_client/' . $editid . '/' . $search . '/' . $page);
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
				
				$getclientuser = $this->Master_model->select_row("mov_clients","MUM_ID","MC_cl_id = '".$cntid."'");
				$clientMUM_ID = 0;
				if(isset($getclientuser) && $getclientuser !=''){
				$clientMUM_ID = $getclientuser->MUM_ID;
				}
				
                $arr = array('MC_cl_status' => $statuscl, 'MC_UpdatedBY' => $id);
                $updatestatus = $this->Master_model->updatedata('MC_cl_id', $cntid, $arr, 'mov_clients');
                
				$arr2 = array('MUM_status' => $statuscl, 'MUM_UpdatedBY' => $id);
				$updatestatus2 = $this->Master_model->updatedata('MUM_ID', $clientMUM_ID, $arr2, 'mov_user_master');

                if ($updatestatus) {
                    echo "3";
                } else {
                    echo "4";
                }
            }
        }
    }
}
