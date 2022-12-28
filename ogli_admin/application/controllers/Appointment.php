<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->model('Master_model');
        $this->load->library('email');


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
	
	public function add_appointment($year = null, $month = null, $web = 1)
    {
        if (!in_array("Manage Appointment", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            //$year = null; $month = null; $web = 1;
            $this->load->model('Calendar_model1');
            if(!$year){
                $year = date('Y');
            }
            if(!$month){
                $month = date('m');
            }
            //echo $month; exit;
            
            $web = $this->session->userdata('id');
            $data['website'] = $web;
            $data['calendar'] = $this->Calendar_model1->generate_hike($year,$month,$web);

            $this->load->view("add_appointment",$data);
        }
    }
	
	public function add_appointment_data()
    {
        $id = $this->session->userdata('id');
        $this->form_validation->set_rules('aptype', 'Appointment type', 'trim|required');
        $aptype = $this->input->post('aptype');

        $this->form_validation->set_rules('clientid', 'Client id', 'trim|required');
        $this->form_validation->set_rules('aptname', 'Appointment name', 'trim|required');
        $this->form_validation->set_rules('userid[]', 'Assinged user id', 'trim|required');
        $this->form_validation->set_rules('startdate', 'Start date', 'trim|required');
        $this->form_validation->set_rules('enddate', 'End date ', 'trim|required');

        if($aptype == 5){
            $this->form_validation->set_rules('orderid', 'Order id', 'trim|required');
            $this->form_validation->set_rules('tattootype', 'Tattoo type', 'trim|required');
            $this->form_validation->set_rules('bodypart', 'Tattoo Body Part', 'trim|required');
        }elseif($aptype == 6){
            $this->form_validation->set_rules('orderid', 'Order id', 'trim');
            $this->form_validation->set_rules('tattootype', 'Tattoo type', 'trim');
            $this->form_validation->set_rules('bodypart', 'Tattoo Body Part', 'trim');
        }

        $this->form_validation->set_rules('totalmanhrs', 'Total Man hour', 'trim');
        $this->form_validation->set_rules('followupdate', 'End date ', 'trim');
        $this->form_validation->set_rules('tattoodt', 'Tattoo detail', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        
        // $this->form_validation->set_rules('availableslot[]', 'Select slot', 'trim|required');
        // $avlslot = '';
        // if($this->input->post('availableslot')){
        //      //$pid=$this.parent.parent.
        //      $info = $this->input->post('info-boxtext');
        //     $availableslot = $this->input->post('availableslot');	
        //     $avlslot = implode(',',$availableslot);
        // }
        $startdate = date('Y-m-d',strtotime($this->input->post('startdate')));
        $this->form_validation->set_rules('info-boxtext', 'Selected slot', 'trim|required');
        $selectedslot = $this->input->post('info-boxtext');
        $present = 0;
       
        if(strpos($selectedslot, '&') !== false){
            $variousdates = explode('&', $selectedslot);
            foreach($variousdates as $valdate){
                $selectedval = explode('@', $valdate);
                if($selectedval[1] == $startdate){
                    $present++;
                }
            }
        }else{
            if($selectedslot != ''){
               // print_r($selectedslot); 
                $selectedval = explode('@', $selectedslot);
               // print_r($selectedval[1].'/'.$startdate); exit;
                if($selectedval[1] == $startdate){
                    
                    $present++;
                }
            }
        }
        if($present == 0){
            
            $this->session->set_flashdata('error', 'Appointment date and selected slots date does not match.');
            redirect("Appointment/add_appointment");
        }
        //print_r($selectedslot); exit;

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('add_appointment');
        } else {
            $id = $this->session->userdata('id');
            $clientid = $this->input->post('clientid');
            $orderid = $this->input->post('orderid');

            $aptname = $this->input->post('aptname');      
            $tattoodt = $this->input->post('tattoodt');
            $userid = 0 ; 
            $userid = $this->input->post('userid');
            
            // if($this->input->post('userid'))
            // {
            //     $selectedids = $this->input->post('userid');
            //     $userid = implode(",",$selectedids);
            // }
            // $startdate = $this->input->post('startdate');
            // $enddate = $this->input->post('enddate');
            
            // $enddate = date('Y-m-d h:i',strtotime($this->input->post('enddate')));
            $enddate = date('Y-m-d',strtotime($this->input->post('enddate')));
            $tattootype = $this->input->post('tattootype');
            $bodypart = $this->input->post('bodypart');
            $totalmanhrs = $this->input->post('totalmanhrs');
            $followupdate = $this->input->post('followupdate');
            


            $status = $this->input->post('status');
            // $status = 0;
            // if ($this->input->post('status')) {
            //     $status = 1;
            // }
           
            $imagemax_size = image_size()*1048576;	
            $file_size = file_size()*1048576;	
            $ferror =0;
            $filesCount = count($_FILES['attachfile']['name']);
            for($i = 0; $i < $filesCount; $i++){ 
                $uploadbannersize = $_FILES["attachfile"]['size'][$i];
                if($uploadbannersize > $imagemax_size || $uploadbannersize > $file_size){
                    $ferror++;
                }
            }
            if($ferror > 0){
                $this->session->set_flashdata('error', 'Image or file size is greater than '.image_size().' mb or '.file_size().' mb ! Kindly resize the image or file and upload');
                redirect("Appointment/add_appointment");
            }
            else
            {
                $uploadData =array();
                $errorUpload ='';
                //echo (count(array_filter($_FILES['attachfile']['name'])));exit;
                if(!empty($_FILES["attachfile"]['name']) && count(array_filter($_FILES['attachfile']['name'])) > 0)
                {
                    $filesCount = count($_FILES['attachfile']['name']); 
                    
                    for($i = 0; $i < $filesCount; $i++){ 
                        //$attachfile = time().'_'.$_FILES["attachfile"]['name'][$i];
                        //$config['file_name'] = $attachfile;
                       // $attachfile = str_replace(' ', '_', $attachfile);
                        $_FILES['file']['name']     = time().'_'.$_FILES['attachfile']['name'][$i]; 
                        $_FILES['file']['type']     = $_FILES['attachfile']['type'][$i]; 
                        $_FILES['file']['tmp_name'] = $_FILES['attachfile']['tmp_name'][$i]; 
                        $_FILES['file']['error']    = $_FILES['attachfile']['error'][$i]; 
                        $_FILES['file']['size']     = $_FILES['attachfile']['size'][$i];

                        $config['upload_path'] = 'uploads/appointment-data/';
                        $config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
                        // $config['max_size']             = 20000000; //50000
                        // $config['max_width']            = 20000000;
                        // $config['max_height']           = 20000000;
                        $this->load->library("upload", $config);
                        $this->upload->initialize($config);
                       // print_r($config); die();
                        if ($this->upload->do_upload('file'))
                        {
                            $fname = str_replace(' ', '_', $_FILES['file']['name']); 
                            $uploadData[$i] = $fname; 
                        }else{
                            $errorUpload .= $_FILES['file']['name'].'('.$this->upload->display_errors('', '').') | ';  
                        }
                    }

                    }
                    else
                    {
                        $uploadData = '';
                    }
                    // File upload error message 
                    $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                    if(!empty($errorUpload)){
                        $this->session->set_flashdata('error', $errorUpload.'fileup error');
                        redirect("Appointment/add_appointment");
                    }
                   if(!empty($uploadData)){
                    $afile = implode(',',$uploadData);
                   }
                   $ipAddress=$_SERVER['REMOTE_ADDR'];
            $insertdata = array(
                'MC_cl_id' => $clientid,
                'MOR_id' => $orderid,
                'MA_name' => $aptname,
                'MA_tattoo_details' => $tattoodt,
                'MA_assignto' => $userid,
                'MA_start_datetime' => date('Y-m-d',strtotime($startdate)),
                'MA_end_datetime' => date('Y-m-d',strtotime($enddate)),
                'MA_tattoo_type' => $tattootype,
                'MA_appt_type' => $aptype,
                'MA_body_part' => $bodypart,
                'MA_total_man_hour'=>$totalmanhrs,
                'MA_updatedfrom_ip_address' => $ipAddress,
                'MA_status' => $status,
                'MA_CreatedBY' => $id,              
                'MA_CreatedDate' => date("Y-m-d H:i:s"),
            );

            // if($attachfile !=''){
            //     $insertdata['MT_ts_attachment'] = $attachfile;
            // }
            if(!empty($uploadData)){
                $insertdata['MA_sample_attachment'] = $afile;
            }
            if(!empty($followupdate)){
                $insertdata['MA_followup_dates'] =$followupdate;
            }

            $taskID = $this->Master_model->InsertdatawithlastID('mov_appointment', $insertdata);
            if ($insertdata > 0) {


                $this->session->set_userdata('sessreq_category', '');
            }

            if ($taskID > 0) {

                    /*mail code starts*/
                    // foreach($selectedids as $val){
                    //     $emailtosend = $this->Master_model->select_data('mov_user_master', 'MUM_Email', "MUM_ID =$val");
                    //     //print_r($emailtosend[0]->MUM_Email);exit;
                    //     $config = get_email_data();     
                    //     $this->email->initialize($config); 
                    //     $from_email = 'NoReply'; 
                    //     $to_email = $emailtosend[0]->MUM_Email; 
                        
                    //     $subject = "New task assigned to you ";
                        
                        
                    //     $this->email->from($from_email, 'Movinnza'); 
                    //     $this->email->to($to_email);
                    //     $this->email->subject($subject); 

                    //     $message = '';
                    //     $message .= '<body>';
                    //     $message .= '<table style="font-family: arial, sans-serif;   border-collapse: collapse;">';

                    //     $message .= '<tr valign=top>';
                    //     $message .= '<th style="text-align: left;padding: 8px;">Task Name</th>';
                    //     $message .= '<td style="text-align: left;padding: 8px;">"'.$taskname.'" has assigned to you.</td>';   
                    //     $message .= '</tr>';

                        

                    //     $message .= '</table>';
                    //     $message .= '</body>';


                    //     $this->email->message($message); 
                    //     //$this->email->send();
                    //     //echo $this->email->print_debugger(); exit;
                    //     if($this->email->send()){	
                    //         $this->session->set_flashdata('useradd', 'Insert Record Successfully!');
                    //         redirect('Appointment/add_appointment');
                    //     }
                    //     else{
                    //         $this->session->set_flashdata('useradd', 'Insert Record Successfully! But Mail Not Send !');
                    //         redirect('Appointment/add_appointment');
                    //     }
                    // }
                    $slotaptID = 0;

                    if(strpos($selectedslot, '&') !== false){
                        $variousdates = explode('&', $selectedslot);
                        foreach($variousdates as $valdate){
                            $selectedval = explode('@', $valdate);
                            // if($selectedval[1] == $startdate){
                            //     $present++;
                            // }
                            $insertslotdata = array(
                                'MS_ID' => $selectedval[0],
                                'MA_id' =>  $taskID,
                                'MSAB_date' => date('Y-m-d',strtotime($selectedval[1])),
                                'MUM_ID' => $userid,
                                'MSAB_Status' => 1,
                                'MSAB_CreatedBY' => $id,              
                                'MSAB_CreatedDate' => date("Y-m-d H:i:s"),
                            );
                            $slotaptID = $this->Master_model->InsertdatawithlastID('mov_slots_apt_booking', $insertslotdata);
                        }
                    }else{
                        if($selectedslot != ''){
                           // print_r($selectedslot); 
                            $selectedval = explode('@', $selectedslot);
                           // print_r($selectedval[1].'/'.$startdate); exit;
                            // if($selectedval[1] == $startdate){
                                
                            //     $present++;
                            // }
                            $insertslotdata = array(
                                'MS_ID' => $selectedval[0],
                                'MA_id' =>  $taskID,
                                'MSAB_date' => date('Y-m-d',strtotime($selectedval[1])),
                                'MUM_ID' => $userid,
                                'MSAB_Status' => $status,
                                'MSAB_CreatedBY' => $id,              
                                'MSAB_CreatedDate' => date("Y-m-d H:i:s"),
                            );
                            $slotaptID = $this->Master_model->InsertdatawithlastID('mov_slots_apt_booking', $insertslotdata);
                        }
                    }



                  if($slotaptID > 0){
                    $this->session->set_flashdata('success', "Insert Record Successfully with slots!");
                    redirect('Appointment/add_appointment');
                  } 
                else{
                    $this->session->set_flashdata('success', "Insert Record Successfully but slots not saved!");
                    redirect('Appointment/add_appointment');
                }
                
            } else {
                $this->session->set_flashdata('error', "Insert Failed!");
                redirect('Appointment/add_appointment' . $aptname);
            }
            }
        }
    }


    public function edit_appointment($editid = "", $search = 'bm8=', $page = 0)
    {
        if (!in_array("Manage Appointment", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $editdata['editappointment'] = $this->Master_model->select_data('mov_appointment', '*', "MA_id =$editid");

            $editdata['searchval'] = $search;
            $editdata['pageval'] = $page;

            $taskid = $editid;
            ////// Getting Task Comment data/////////
            // $status = ' MCM_Status = 1 ';
            // $where = $status . 'and MT_ts_id='. $taskid;
            // $wherefilterorder = 'MCM_Comment_Date DESC';                   
            // $commentsdata = $this->Master_model->select_data_orderby('mov_comments', '*', $where, $wherefilterorder);
            // //echo $this->db->last_query(); exit;
            // $commentsvalue  = json_decode(json_encode($commentsdata));

            // if ($commentsvalue) {

            //     $editdata['taskcomments']=$commentsvalue;
            // } else {		
            //     $editdata['taskcomments']='';
            // }
           ////// Getting Who should be notifide data/////////
           // print_r($editdata['edittask'][0]->MP_proj_id);exit;
        //    $projid = $editdata['edittask'][0]->MP_proj_id;
        //    $editdata['pointofcontids'] = $this->Master_model->select_data('mov_projects', 'MP_proj_id,MP_pofcont', "MP_proj_id =$projid");
        //  // print_r($editdata['pointofcontids'][0]);exit;
        //    $editdata['pointofcont'] = $this->Master_model->select_data('mov_user_master', 'MUM_ID,MUM_Email,MUM_Full_name', "MUM_ID  IN ('".$editdata['pointofcontids'][0]->MP_pofcont."')");
        //    // print_r($editdata['pointofcont'][0]);exit;
        //    $prass =  $editdata['edittask'][0]->MT_ts_primary_assign;
        //    $reopenass = $editdata['edittask'][0]->MT_ts_secondary_assign;
        //    $createdby = $editdata['edittask'][0]->MT_CreatedBY;

        //    $userids = array();
        //    if (strpos($prass,',') !== false){
        //      $prassid= explode(",",$prass);             
        //      foreach($prassid as $val){
        //         array_push($userids,$val);
        //      }
        //    }else{
        //     array_push($userids,$prass);
        //    }
         
        //    if(!empty($reopenass)){
        //     if (strpos($reopenass, ',') !== false){
        //         $reopenassid= explode(",",$reopenass);
        //         foreach($reopenassid as $val){
        //         array_push($userids,$val);
        //         }
        //     }else{
        //         array_push($userids,$reopenass);
        //        }
        // }

       
        //     array_push($userids,$createdby);
          
            // $editdata['userids'] = array_unique($userids);
            //print_r($editdata['userids']);exit;
          
          // $editdata['isactive'] = $isactive;

            $this->load->view('edit_appointment', $editdata);
        }
    }
	

    public function edit_appointment_data()
    {
        //$id=$this->session->userdata('id');

        $this->form_validation->set_rules('editid', 'Edit Id', 'trim');
        $editid = $this->input->post('editid');
        $original_value = $this->Master_model->select_data('mov_appointment', '*', "MA_id=$editid");

        foreach ($original_value as $original_value1) {
            $original_value1->MA_name;
        }

        if ($this->input->post('aptname') != $original_value1->MA_name) {
            $is_unique =  '|is_unique[mov_appointment.MA_name]';
        } else {
            $is_unique =  '';
        }
        // $this->form_validation->set_rules('clientid', 'Client id', 'trim|required');
        // $this->form_validation->set_rules('orderid', 'Order id', 'trim|required');
        // $this->form_validation->set_rules('aptname', 'Appointment name', 'trim|required');
        // $this->form_validation->set_rules('tattoodt', 'Tattoo detail', 'trim');
        // $this->form_validation->set_rules('userid[]', 'Assinged user id', 'trim|required');
        // $this->form_validation->set_rules('startdate', 'Start date', 'trim|required');
        // $this->form_validation->set_rules('enddate', 'End date ', 'trim|required');
        // $this->form_validation->set_rules('tattootype', 'Tattoo type', 'trim|required');
        // $this->form_validation->set_rules('bodypart', 'Tattoo Body Part', 'trim|required');
        // $this->form_validation->set_rules('totalmanhrs', 'Total Man hour', 'trim');
        // $this->form_validation->set_rules('followupdate', 'End date ', 'trim');
        $this->form_validation->set_rules('aptype', 'Appointment type', 'trim|required');
        $aptype = $this->input->post('aptype');

        $this->form_validation->set_rules('clientid', 'Client id', 'trim|required');
        $this->form_validation->set_rules('aptname', 'Appointment name', 'trim|required');
        $this->form_validation->set_rules('userid[]', 'Assinged user id', 'trim|required');
        $this->form_validation->set_rules('startdate', 'Start date', 'trim|required');
        $this->form_validation->set_rules('enddate', 'End date ', 'trim|required');

        if($aptype == 5){
            $this->form_validation->set_rules('orderid', 'Order id', 'trim|required');
            $this->form_validation->set_rules('tattootype', 'Tattoo type', 'trim|required');
            $this->form_validation->set_rules('bodypart', 'Tattoo Body Part', 'trim|required');
        }elseif($aptype == 6){
            $this->form_validation->set_rules('orderid', 'Order id', 'trim');
            $this->form_validation->set_rules('tattootype', 'Tattoo type', 'trim');
            $this->form_validation->set_rules('bodypart', 'Tattoo Body Part', 'trim');
        }

        $this->form_validation->set_rules('totalmanhrs', 'Total Man hour', 'trim');
        $this->form_validation->set_rules('followupdate', 'End date ', 'trim');
        $this->form_validation->set_rules('tattoodt', 'Tattoo detail', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');

        $this->form_validation->set_rules('rechedule', 'Rechedule', 'trim');
        
        $erfile = $this->input->post('erfile');

        $search = $this->input->post('search');
        $page = $this->input->post('page');
        $rechedule = 0;
        if ($this->input->post('rechedule')) {
            $rechedule = 1;
        }
        if($rechedule == 1){
            $this->form_validation->set_rules('restartdate', 'Rechedule start date', 'trim|required');
            $this->form_validation->set_rules('reenddate', 'Rechedule End date ', 'trim|required');
            // $this->form_validation->set_rules('scuserid[]', 'Secondary Assinged user id', 'trim|required');
            // $this->form_validation->set_rules('reopenstatus', 'Reopen Status', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('Appointment/edit_appointment/' . $editid . '/' . $search . '/' . $page);
            } 
        }


        $status = $this->input->post('status');
        if($status == 3){
            $this->form_validation->set_rules('cancelreason', 'Reason of cancelation', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('Appointment/edit_appointment/' . $editid . '/' . $search . '/' . $page);
            } 
        }


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Appointment/edit_appointment/' . $editid . '/' . $search . '/' . $page);
        } else {
            $id = $this->session->userdata('id');
            $editid = $this->input->post('editid');
          
            $clientid = $this->input->post('clientid');
            $orderid = $this->input->post('orderid');

            $aptname = $this->input->post('aptname');      
            $tattoodt = $this->input->post('tattoodt'); 
            //$userid = $this->input->post('userid');
            $userid = 0 ;
            if($this->input->post('userid'))
            {
                $selectedids = $this->input->post('userid');
                $userid = implode(",",$selectedids);
            }
            // $startdate = $this->input->post('startdate');
            // $enddate = $this->input->post('enddate');
            $startdate = date('Y-m-d h:i',strtotime($this->input->post('startdate')));
            $enddate = date('Y-m-d h:i',strtotime($this->input->post('enddate')));
            $tattootype = $this->input->post('tattootype');
            $bodypart = $this->input->post('bodypart');
            $totalmanhrs = $this->input->post('totalmanhrs');
            $followupdate = $this->input->post('followupdate');

            





            // $reopenyesno = 0;
            // if ($this->input->post('reopenyesno')) {
            //     $reopenyesno = 1;
            // }

            $restartdate = $this->input->post('restartdate');
            $reenddate = $this->input->post('reenddate');    
            
            $cancelreason = $this->input->post('cancelreason');   
            // $scuserid = 0 ;
            // if($this->input->post('scuserid'))
            // {
            //     $selectedids = $this->input->post('scuserid');
            //     $scuserid = implode(",",$selectedids);
            // }
            // $reopenstatus = $this->input->post('reopenstatus');

           
            $imagemax_size = image_size()*1048576;	
            $file_size = file_size()*1048576;	
            $ferror =0;
            $filesCount = count($_FILES['attachfile']['name']);
            for($i = 0; $i < $filesCount; $i++){ 
                $uploadbannersize = $_FILES["attachfile"]['size'][$i];
                if($uploadbannersize > $imagemax_size || $uploadbannersize > $file_size){
                    $ferror++;
                }
            }
            if($ferror > 0){
                $this->session->set_flashdata('error', 'Image or file size is greater than '.image_size().' mb or '.file_size().' mb ! Kindly resize the image or file and upload');
                redirect("Appointment/edit_appointment/' . $editid . '/' . $search . '/' . $page");
            }
            else
            {
                $uploadData =array();
                $errorUpload ='';
                //echo (count(array_filter($_FILES['attachfile']['name'])));exit;
                if(!empty($_FILES["attachfile"]['name']) && count(array_filter($_FILES['attachfile']['name'])) > 0)
                {
                    $filesCount = count($_FILES['attachfile']['name']); 
                    
                    for($i = 0; $i < $filesCount; $i++){ 
                        // $attachfile = time().'_'.$_FILES["attachfile"]['name'];
                        // $config['file_name'] = $attachfile;
                        // $attachfile = str_replace(' ', '_', $attachfile);
                        $_FILES['file']['name']     = time().'_'.$_FILES['attachfile']['name'][$i]; 
                        $_FILES['file']['type']     = $_FILES['attachfile']['type'][$i]; 
                        $_FILES['file']['tmp_name'] = $_FILES['attachfile']['tmp_name'][$i]; 
                        $_FILES['file']['error']    = $_FILES['attachfile']['error'][$i]; 
                        $_FILES['file']['size']     = $_FILES['attachfile']['size'][$i];
                        
                        $config['upload_path'] = 'uploads/appointment-data/';
                        $config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
                        // $config['max_size']             = 20000000; //50000
                        // $config['max_width']            = 20000000;
                        // $config['max_height']           = 20000000;
                        $this->load->library("upload", $config);
                        $this->upload->initialize($config);
                        //print_r($config); die();
                        if ($this->upload->do_upload('file'))
                        {
                            $fname = str_replace(' ', '_', $_FILES['file']['name']); 
                            $uploadData[$i] = $fname; 
                        }else{
                            $errorUpload .= $_FILES['file']['name'].'('.$this->upload->display_errors('', '').') | ';  
                        }
                    }
                    }
                    else
                    {
                        $uploadData = '';
                    }
                    // File upload error message 
                    $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                    if(!empty($errorUpload)){
                        $this->session->set_flashdata('error', $errorUpload.'fileup error');
                        redirect("Appointment/edit_appointment/' . $editid . '/' . $search . '/' . $page");
                    }
                    $allfile = '';
                   if(!empty($uploadData)){
                    $afile = implode(',',$uploadData);                 
                    $allfile = $erfile.','.$afile;
                   }else{
                    $allfile = $erfile;
                   }
                   $ipAddress=$_SERVER['REMOTE_ADDR'];
            $data = array(
                'MC_cl_id' => $clientid,
                'MOR_id' => $orderid,
                'MA_name' => $aptname,
                'MA_tattoo_details' => $tattoodt,
                'MA_assignto' => $userid,
                'MA_start_datetime' => date('Y-m-d',strtotime($startdate)),
                'MA_end_datetime' => date('Y-m-d',strtotime($enddate)),
                'MA_tattoo_type' => $tattootype,
                'MA_appt_type' => $aptype,
                'MA_body_part' => $bodypart,
                'MA_total_man_hour'=>$totalmanhrs,
                'MA_updatedfrom_ip_address' => $ipAddress,
                'MA_status' => $status,            
                'MA_UpdatedBY' => $id,
            );
            // if($attachfile !=''){
            //     $data['MT_ts_attachment'] = $attachfile;
            // }
            if(!empty($uploadData)){
                $data['MA_sample_attachment'] = $allfile;
            }else{
                $data['MA_sample_attachment'] = $allfile; 
            }
            if($rechedule == 1){                 
                $data['MA_is_reschedule'] = $rechedule;
                $data['MA_reschedule_start_datetime'] = date('Y-m-d',strtotime($restartdate));
                $data['MA_reschedule_end_datetime'] = date('Y-m-d',strtotime($reenddate));                
            }
            if($status == 3){
                $data['MA_cancel_reason'] = $cancelreason;
            }

            if(!empty($followupdate)){
                $data['MA_followup_dates'] =$followupdate;
            }
            $profileres = $this->Master_model->updatedata('MA_id', $editid, $data, 'mov_appointment');

            if ($profileres > 0) {
                $this->session->set_flashdata('success', "Update Record Successfully!");
                redirect('Appointment/edit_appointment/' . $editid . '/' . $search . '/' . $page);
            } else {
                $this->session->set_flashdata('error', 'Problem With Update!');
                redirect('Appointment/edit_appointment/' . $editid . '/' . $search . '/' . $page);
            }
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
        // $appointmentdates = get_list("mov_appointment","MA_start_datetime,MA_end_datetime,MA_reschedule_start_datetime,MA_reschedule_end_datetime","MA_assignto IN (".$userid.")");
        // $noticevaluecomma ='';
        // $noticevaluecomma = implode(',', array_column($appointmentdates, 'MA_start_datetime'));
        // $noticevaluecommaend = implode(',', array_column($appointmentdates, 'MA_end_datetime'));
        // $noticevaluecommarest = implode(',', array_column($appointmentdates, 'MA_reschedule_start_datetime'));
        // $noticevaluecommareend = implode(',', array_column($appointmentdates, 'MA_reschedule_end_datetime'));
        // $finalalldates = $noticevaluecomma.','.$noticevaluecommaend.','.$noticevaluecommarest.','.$noticevaluecommareend;
        // $appointmentdatesvaluecomma = implode(',', array_unique(explode(',', $finalalldates)));
        //echo $this->db->last_query(); die();
        $bookedslot = get_list('mov_slots_apt_booking','*',"MSAB_Status='1' and MUM_ID='".$userid."' and CONCAT(",",`MS_ID`, ",") REGEXP ",('1,2,3,4,5,6,7,8,9,10'),"");
        print_r($bookedslot); exit;
        //print_r($appointmentdatesvaluecomma); exit;
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


    public function get_slots()
    { 
        $output = '';
        $wholedate = $this->input->post('wholedate');
        $earlyselections = $this->input->post('earlyselections');
        $useridartist = $this->input->post('useridartist');
        //print_r($wholedate.'-'.$useridartist); exit;
        $allreadyselecteddate = array();
        if(strpos($earlyselections, '&') !== false){
            $variousdates = explode('&', $earlyselections);
            foreach($variousdates as $valdate){
                $selectedval = explode('@', $valdate);
                if($selectedval[1] == $wholedate){
                    if(strpos($selectedval[0], ',') !== false){
                        $allreadyselecteddate = explode(',',$selectedval[0]);
                    }else{
                        array_push($allreadyselecteddate,$selectedval[0]);
                    }
                }
            }
        }else{
            if($earlyselections != ''){
                $selectedval = explode('@', $earlyselections);
                if($selectedval[1] == $wholedate){
                    if(strpos($selectedval[0], ',') !== false){
                        $allreadyselecteddate = explode(',',$selectedval[0]);
                    }else{
                        array_push($allreadyselecteddate,$selectedval[0]);
                    }
                }
            }
        }
       // print_r($allreadyselecteddate );
        // $output = '<div class="info-box" id="'.$wholedate.'" >';
        $getscat = get_list('mov_slots','*',"MS_Status='1'");
            //$today = date("Y-m-d"); //echo $today;
            // $bookedslot = get_list('mov_slots_apt_booking','*',"MSAB_Status='1' and MSAB_date ='".$today."'");
            $bookedslot = get_list('mov_slots_apt_booking','*',"MSAB_Status='1' and MUM_ID='".$useridartist."' and MSAB_date ='".$wholedate."'");
           // echo $this->db->last_query(); die();
       
            $bookedslotcomma = '';	
            if (isset($bookedslot) && !empty($bookedslot)) {
                $bookedslotcomma = implode(',', array_column($bookedslot, 'MS_ID'));
                $bookedslotcomma = implode(',', array_filter(array_unique(explode(',', $bookedslotcomma))));
            }	
            $bookedslots = [];
            if($bookedslotcomma != ''){	
            $bookedslots = explode(',',$bookedslotcomma);
            }
           /// echo $bookedslotcomma; exit;
                if($getscat){ 
                    foreach($getscat as $getscatdata)	{	
                        //print_r($getscatdata);
                        $valchecked = '';
                        if(in_array($getscatdata->MS_ID,$allreadyselecteddate)){
                            $valchecked = 'checked';
                        }
                        if(!in_array($getscatdata->MS_ID, $bookedslots)){
                            $output .= ' <div class="available c1">'.$getscatdata->MS_Start_Time.'-'.$getscatdata->MS_End_Time.'</div> 	<div class="available">available</div>
                            <label class="container2">
                            <input type="checkbox" name="availableslot[]" '.$valchecked.' value="'.$getscatdata->MS_ID.'" class="custom-control-input permissionch availableslot'.$getscatdata->MS_ID.'" id="'.$getscatdata->MS_ID.'" data-checkboxes="mygroup">
                            <span class="checkmark"></span>
                            </label>';
                        } else{
                            $output .= '<div class="booked b1">'.$getscatdata->MS_Start_Time.'-'.$getscatdata->MS_End_Time.' </div> <div class="booked">booked</div>
                            <label class="container2">
                            <input type="checkbox" disabled="disabled">
                            <span class="checkmarkbook"></span>
                            </label>
                            ';
                        } } }

                        // $output .= '  </div>';
   
                       
                        echo $output;
                    
                    
                    
                    }





		
}
?>