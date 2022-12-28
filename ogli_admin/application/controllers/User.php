<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Master_model');
		$this->load->library('email');
		$this->load->library('upload');	
		$this->load->library('image_lib');		
		
		$id = $this->session->userdata('id');
		$page = array();
		$roledata = get_list('mov_user_master',"MUM_Access_Permission","MUM_ID=$id");
		//print_r($roledata);exit;
		if(!empty($roledata[0])){
			$rolids = explode(',',$roledata[0]->MUM_Access_Permission);
			if(!empty($rolids[0])){
			for($i=0;$i<count($rolids);$i++){
			$roleid = $rolids[$i];
			$pagename = get_list('mov_module_name',"MMN_Page_Name","MMN_ID=$roleid");
			if(!empty($pagename[0])){
			$this->page[] = $pagename[0]->MMN_Page_Name;
			}
			}	}else{
				$this->page = array();
			}
		}else{
			redirect('Registration/logout');
		}
	}
	
	public function add_customers()
	{
		$this->load->view('add_customers');
	}
	
	public function add_vendor()
	{
		$this->load->view('add_vendor');
	}
	
	public function add_adminuser()
	{
		if(!in_array("Administrator",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->view('add_user');
		}
	}
	
	public function edit_vendor($edit_id=0)
	{
			$data['vendor'] = $this->Master_model->select_data('zap_vendor_customer','*',"ZVC_User_type=1 and ZVC_ID = $edit_id");//user type 3 means vendor
			$data['edit_id'] = $edit_id;
			$this->load->view('edit_vendor',$data);
	}
	
	public function edit_customers($edit_id)
	{
			$data['customer'] = $this->Master_model->select_data('zap_vendor_customer','*',"ZVC_User_type=2 and ZVC_ID = $edit_id");//user type 3 means vendor
			$data['edit_id'] = $edit_id;
			$this->load->view('edit_customer',$data);
	}
	
	public function edit_user($edit_id)
	{
		$adm = $this->session->userdata('id');
		$role = $this->session->userdata('role');
		$cond1= '';
		if($role != 1){
			//$cond1= "$adm != $edit_id";
			if(!in_array("Administrator",$this->page) || $adm != $edit_id){echo "<center><h3>Access Denied!</h3></center>";}else{
				//echo "inif";
				$data['user'] = $this->Master_model->select_data('mov_user_master','*',"MUM_User_type in (1,2,3,4) and MUM_ID = $edit_id");
				$data['edit_id'] = $edit_id;
				$this->load->view('edit_user',$data);
			}
		}
		else if($role == 1){
			if(!in_array("Administrator",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
				//echo "inif";
				$data['user'] = $this->Master_model->select_data('mov_user_master','*',"MUM_User_type in (1,2,3,4) and MUM_ID = $edit_id");//user type 1 means super admin and 4 is user
				$data['edit_id'] = $edit_id;
				$this->load->view('edit_user',$data);
			}
		}
		//echo $cond1;
		//echo $adm.''.$edit_id.''.in_array("Administrator",$this->page);
		
	}
	
	
	public function edit_admin_user_profile($edit_id,$select,$usertype)
	{
		$adm = $this->session->userdata('id');
		$role = $this->session->userdata('role');
		$cond1= '';
		if($role != 1){
			//$cond1= "$adm != $edit_id || $role != $usertype";
			if(!in_array("Administrator",$this->page) || $adm != $edit_id || $role != $usertype){echo "<center><h3>Access Denied!</h3></center>";}else{
				$data['userdata'] = $this->Master_model->select_data('mov_user_master','*',"MUM_User_type=".$usertype." and MUM_ID = $edit_id");//user type 1 means admin
			
				$data['edit_id'] = $edit_id;
				$data['usertype'] = $usertype;
				$data['isactive'] = $select;
				$this->load->view('edit_admin_user_data',$data);
			}
		}
		else if($role == 1){
			if(!in_array("Administrator",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
				$data['userdata'] = $this->Master_model->select_data('mov_user_master','*',"MUM_User_type=".$usertype." and MUM_ID = $edit_id");//user type 1 means admin
				$data['moduledata'] = $this->Master_model->select_data('mov_module_name','MMN_ID,MMN_Page_Name',"");//modules list
				$data['otheruserdata'] = $this->Master_model->select_data('mov_user_master','*'," MUM_ID <> $edit_id");
				
				$data['edit_id'] = $edit_id;
				$data['usertype'] = $usertype;
				$data['isactive'] = $select;
				$this->load->view('edit_admin_user_data',$data);
			}
		}
		
	}
	
	
	public function edit_user_profile($edit_id,$select,$usertype)
	{
		
			$data['userdata'] = $this->Master_model->select_data('zap_vendor_customer','*',"ZVC_User_type=".$usertype." and ZVC_ID = $edit_id");//user type 1 means admin
		
			$data['edit_id'] = $edit_id;
			$data['usertype'] = $usertype;
			$data['isactive'] = $select;
			$this->load->view('edit_user_data',$data);
	}
	
	public function add_admin_user()
	{
		$this->form_validation->set_rules("usr_name","Username","trim|required|valid_email");
		$this->form_validation->set_rules("password","password","trim|required");
		// $this->form_validation->set_rules("comp_name","Company Name","trim|required");
		$this->form_validation->set_rules("full_name","Full Name","trim|required");
		$this->form_validation->set_rules("u_phone","Phone / Mobile","trim|required");
		$this->form_validation->set_rules("usr_type","User type","trim|required");
		
		$this->form_validation->set_rules("u_city","City","trim");
		$this->form_validation->set_rules("u_country","Country","trim");
		$this->form_validation->set_rules("u_zip","Zip","trim");
		$this->form_validation->set_rules("u_email_alt","Email Alt","trim|valid_email");
		$this->form_validation->set_rules("u_address","Current Address","trim");

		$this->form_validation->set_rules("designation","Designation","trim|required");
		$this->form_validation->set_rules("userrole","User role","trim|required");
		
		$usr_type=$this->input->post('usr_type');
		$req='|required';
		$req2='';
		if($usr_type == 2 || $usr_type == 3){
		$req='';
		$req2='|required';
		}	
		$this->form_validation->set_rules("bankaccno","Bank Account number","trim".$req);
		$this->form_validation->set_rules("ifsccode","IFSC code","trim".$req);
		$this->form_validation->set_rules("panno","Pan Card number","trim".$req);
		$this->form_validation->set_rules("joiningdate","Joining Date","trim".$req);
		$this->form_validation->set_rules("projectid","project","trim".$req2);
		
		
		$this->form_validation->set_rules("p_address","Permanent Address","trim");
		
		$this->form_validation->set_rules("status","status","trim");
		$this->form_validation->set_rules("logstatus","logstatus","trim");
		
		
		
		$usr_name=$this->input->post('usr_name');
		$checkemailusertype = $this->Master_model->checkdata('MUM_ID','mov_user_master',"MUM_Email='".$usr_name."'");
		
		if($checkemailusertype == 0)
		{
			if($this->form_validation->run()==FALSE)
			{
					$this->session->set_flashdata('usernotadd', validation_errors());
					//redirect('User/add_adminuser');
					$this->load->view('add_user');
			}
			else
			{
				$adm = $this->session->userdata('id');
				// $comp_name=$this->input->post('comp_name'); 
				
				$password=$this->input->post('password');
				//$hash = password_hash($password, PASSWORD_DEFAULT);
				$hash = base64_encode($password);
				$full_name=$this->input->post('full_name');
				$u_phone=$this->input->post('u_phone');
				
				$u_city=$this->input->post('u_city');
				$u_country=$this->input->post('u_country');
				$u_zip=$this->input->post('u_zip');
				$u_email_alt=$this->input->post('u_email_alt');
				$u_address=$this->input->post('u_address');

				
				$designation = $this->input->post('designation');
				$bankaccno = $this->input->post('bankaccno');
				$ifsccode = $this->input->post('ifsccode');
				$panno = $this->input->post('panno');
				$joiningdate = $this->input->post('joiningdate');
				$p_address = $this->input->post('p_address');
				$userrole=$this->input->post('userrole');

				$logstatus = 0;
				if($this->input->post('logstatus'))
				{
					$logstatus = 1;
				}	
				
				
				$status = 0;
				if($this->input->post('status'))
				{
					$status = 1;
				}
				
				// $projectid = 0;
				// if($this->input->post('projectid'))
				// {
				// 	$projectid = $this->input->post('projectid');
				// }	
				// $getclient = $this->Master_model->select_row('mov_projects','MC_cl_id,',"MP_proj_id = $projectid");
				// $MC_cl_id_val = 0;
				// if(isset($getclient) && $getclient !=''){
				// $MC_cl_id_val = $getclient->MC_cl_id;
				// }
				
				// $getclient_company = $this->Master_model->select_row('mov_clients','MC_cl_company_name,',"MC_cl_id = $MC_cl_id_val");
				
				// $MC_cl_company_name_val = '';
				// if(isset($getclient_company) && $getclient_company !=''){
				// $MC_cl_company_name_val = $getclient_company->MC_cl_company_name;
				// }
				
				
				// $comp_name= WEBNAME;
				// if(($usr_type == 2 || $usr_type == 3) && $MC_cl_company_name_val != ''){
				// 	$comp_name = $MC_cl_company_name_val;
					
				// 	$bankaccno = 0;
				// 	$ifsccode = 0;
				// 	$panno = 0;
					
				// }
				//echo $usr_type.' / '.$comp_name.' / '.$MC_cl_company_name_val; exit;

				$imagemax_size = image_size()*1048576;	
				$uploadbannersize = $_FILES["userprofimg"]['size'];
	
				if($uploadbannersize > $imagemax_size ){
					$this->session->set_flashdata('error', 'Image size is greater than '.image_size().' mb ! Kindly resize the image and upload');
					redirect("User/add_adminuser");
				}else
				{
					// for banner image
					//print_r($_FILES);exit;
					if(!empty($_FILES["userprofimg"]['name']))
					{
						$userprofimg = time().'_'.$_FILES["userprofimg"]['name'];
						$config['file_name'] = $userprofimg;
						$userprofimg = str_replace(' ', '_', $userprofimg);
						$config['upload_path'] = 'uploads/user-profile-pic/';
						$config['allowed_types']        = 'jpg|jpeg|png';
						$config['max_size']             = 20000000; //50000
						$config['max_width']            = 20000000;
						$config['max_height']           = 20000000;
						$this->load->library("upload", $config);
						$this->upload->initialize($config);
						//print_r($config); die();
						if (!$this->upload->do_upload('userprofimg'))
						{
							$userprofimg = '';
						}
						}
						else
						{
							$userprofimg = '';
						}



					$hash_pin = base64_encode('1234');
					$this->load->helper('string');
					$insertdata=array(
					'MUM_Email'=>$usr_name,
					'MUM_Passcode'=>$hash,
					'MUM_Pin'=>$hash_pin,
					'MUM_Access_Permission'=>'13,1',
					//'MUM_Comp_Name'=>$comp_name,
					'MUM_Full_name'=>$full_name,
					'MUM_Phone'=>$u_phone,
					
					'MUM_City'=>$u_city,
					'MUM_Country'=>$u_country,
					'MUM_ZippCode'=>$u_zip,
					'MUM_alt_email'=>$u_email_alt,
					'MUM_Add'=>$u_address,
				     
					'MUM_designation'=>$designation,
					'MUM_roles'=>$userrole,
					'MUM_bank_accno'=>$bankaccno,
					'MUM_ifsc_code'=>$ifsccode,
					'MUM_pancard_number'=>$panno,
					'MUM_joining_date'=>date('Y-m-d',strtotime($joiningdate)),
					'MUM_permanent_address'=>$p_address,
					
					'MUM_User_type'=>$usr_type,
					'MUM_login_status'=>$logstatus,
					'MUM_status'=>$status,
					'MUM_CreatedBY'=>$adm,
					'MUM_CreatedDate'=>date('Y-m-d'),
					'MUM_UpdatedBY'=>$adm
					);

					
					if($userprofimg !=''){
						$insertdata['MUM_Profilepic'] = $userprofimg;
					}
					
					// if($usr_type == 2 || $usr_type == 3){
					// 	$insertdata['MP_proj_id'] = $projectid;
					// }
					
					$datainserted = $this->Master_model->InsertdatawithlastID('mov_user_master',$insertdata);
					if($datainserted > 0)
					{
						/*mail code starts*/
						
						if($logstatus == 1){
							$config = get_email_data();     
							$this->email->initialize($config); 
							$from_email = 'NoReply'; 
							$to_email = $usr_name; 
							
							$subject = "Registration Confirmation Mail";
							
							
							$this->email->from($from_email, WEBNAME); 
							$this->email->to($to_email);
							$this->email->subject($subject); 
						
							$message = '';
							$message .= '<body>';
							$message .= '<table style="font-family: arial, sans-serif;   border-collapse: collapse;">';

							$message .= '<tr valign=top>';
							$message .= '<th style="text-align: left;padding: 8px; width:50%;">Name :</th>';
							$message .= '<td style="text-align: left;padding: 8px;">'.$full_name.'</td>';   
							$message .= '</tr>';

							$message .= '<tr valign=top>';
							$message .= '<th style="text-align: left;padding: 8px; width:50%;">Mobile Number :</th>';
							$message .= '<td style="text-align: left;padding: 8px;">'.$u_phone.'</td>';   
							$message .= '</tr>';


							$message .= '<tr valign=top>';
							$message .= '<th style="text-align: left;padding: 8px;  width:50%;">Email :</th>';
							$message .= '<td style="text-align: left;padding: 8px;">'.$usr_name.'</td>';   
							$message .= '</tr>';					

							$message .= '<tr valign=top>';
							$message .= '<th style="text-align: left;padding: 8px;  width:50%;">Password :</td>';
							$message .= '<td style="text-align: left;padding: 8px; text-align:justify;">'.$password.'</td>';   
							$message .= '</tr>';

							$message .= '</table>';
							$message .= '</body>';
						
						
							$this->email->message($message); 
							//$this->email->send();
							//echo $this->email->print_debugger(); exit;
							if($this->email->send()){	
								$this->session->set_flashdata('useradd', 'Successfully save!');
								redirect('User/add_adminuser');
							}
							else{
								$this->session->set_flashdata('useradd', 'Successfully save! But Mail Not Send !');
								redirect('User/add_adminuser');
							}
						}
						else{
								$this->session->set_flashdata('useradd', 'Successfully save!');
								redirect('User/add_adminuser');
						}
					}
					else{
						$this->session->set_flashdata('usernotadd', 'Problem with insert!');
						redirect('User/add_adminuser');

					}

				}
			}
		
		}
		else
		{
			$this->session->set_flashdata('usernotadd', $usr_name." is already registered with us.");
			redirect('User/add_adminuser');
		}	
	}
	
	
	public function resendmail()
	{
		$id = $this->session->userdata('id');	
		$this->form_validation->set_rules('adminuid', 'adminuid', 'trim');
		$this->form_validation->set_rules('adminemail', 'adminemail', 'trim');
		$this->form_validation->set_rules('adminpassword', 'adminpassword', 'trim');
		$this->form_validation->set_rules('adminname', 'adminname', 'trim');
		$this->form_validation->set_rules('adminphone', 'adminphone', 'trim');
		if ($this->form_validation->run() == FALSE)
		{
			echo "1";
		}
		else
		{		
			$id = $this->session->userdata('id');	
			$adminuid = $this->input->post('adminuid');
			$adminemail = $this->input->post('adminemail');
			$adminpassword = $this->input->post('adminpassword');
			$adminname = $this->input->post('adminname');
			$adminphone = $this->input->post('adminphone');

			$config = get_email_data();     
			$this->email->initialize($config); 
			$from_email = 'NoReply'; 
			$to_email = $adminemail; 

			$subject = "Credential Details";


			$this->email->from($from_email, WEBNAME); 
			$this->email->to($to_email);
			$this->email->subject($subject); 

			$message = '';
			$message .= '<body>';
			$message .= '<table style="font-family: arial, sans-serif;   border-collapse: collapse;">';

			$message .= '<tr valign=top>';
			$message .= '<th style="text-align: left;padding: 8px; width:50%;">Name :</th>';
			$message .= '<td style="text-align: left;padding: 8px;">'.$adminname.'</td>';   
			$message .= '</tr>';

			$message .= '<tr valign=top>';
			$message .= '<th style="text-align: left;padding: 8px; width:50%;">Mobile Number :</th>';
			$message .= '<td style="text-align: left;padding: 8px;">'.$adminphone.'</td>';   
			$message .= '</tr>';


			$message .= '<tr valign=top>';
			$message .= '<th style="text-align: left;padding: 8px;  width:50%;">Email :</th>';
			$message .= '<td style="text-align: left;padding: 8px;">'.$adminemail.'</td>';   
			$message .= '</tr>';					

			$message .= '<tr valign=top>';
			$message .= '<th style="text-align: left;padding: 8px;  width:50%;">Password :</td>';
			$message .= '<td style="text-align: left;padding: 8px; text-align:justify;">'.$adminpassword.'</td>';   
			$message .= '</tr>';

			$message .= '</table>';
			$message .= '</body>';


			$this->email->message($message); 

			if($this->email->send()){	
				echo '1';
			}
			else{
				echo '2';
			}
		}	
	}
	
	
	public function uploadprofilepic($file,$id)
	{
			$ext = explode('.',$_FILES[$file]['name']);
			$new_name = 'profile_'.md5($id).$id.'.'.$ext[1];
			//$new_name = time().'_'.$_FILES[$file]['name'];
			$config['file_name'] = $new_name;
			$config['upload_path']          = './uploads/user-profile-pic/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 5000;
			$config['overwrite'] = TRUE;


			$this->upload->initialize($config);

			if (!$this->upload->do_upload('userfile'))
			{
				return $this->upload->display_errors(); 
			}
			else
			{
				return 'yes';
			}
	}
	
	
	public function update_admin_user_profile($selected,$usertype)
	{
		$role = $this->session->userdata('role');
		if($role == 1){
		$this->form_validation->set_rules("comp_name","Company Name","trim");
		$this->form_validation->set_rules("full_name","Full Name","trim|required");
		$this->form_validation->set_rules("u_phone","Phone / Mobile","trim|required");
		$this->form_validation->set_rules("status","status","trim");
		$this->form_validation->set_rules("logstatus","logstatus","trim");
		$this->form_validation->set_rules("designation","Designation","trim|required");		
		$this->form_validation->set_rules("joiningdate","Joining Date","trim|required");		
		$this->form_validation->set_rules("userrole","User role","trim|required");
		}
		
		$this->form_validation->set_rules("u_city","City","trim");
		$this->form_validation->set_rules("u_country","Country","trim");
		$this->form_validation->set_rules("u_zip","Zip","trim");
		$this->form_validation->set_rules("u_email_alt","Email Alt","trim|valid_email");
		$this->form_validation->set_rules("u_address","Address","trim");
		
		$usr_type = $usertype;
		$req='|required';
		$req2='';
		if($usr_type == 2 || $usr_type == 3){
		$req='';
		$req2='|required';
		}	
		
		
		$this->form_validation->set_rules("bankaccno","Bank Account number","trim".$req);
		$this->form_validation->set_rules("ifsccode","IFSC code","trim".$req);
		$this->form_validation->set_rules("panno","Pan Card number","trim".$req);
		$this->form_validation->set_rules("projectid","projectid","trim".$req2);
		
		$this->form_validation->set_rules("p_address","Permanent Address","trim");
		
		$this->form_validation->set_rules("edit_id","edit_id","trim");
		$edit_id = $this->input->post('edit_id');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('userupdateerror',  validation_errors());
			redirect("User/edit_admin_user_profile/".$edit_id.'/'.$selected.'/'.$usr_type);
		}
		else{
			$adm = $this->session->userdata('id');
			$comp_name=$this->input->post('comp_name');		
			$full_name=$this->input->post('full_name');
			if($this->input->post('usr_type'))
			{
				$usr_type=$this->input->post('usr_type');
			}
			
			$u_phone=$this->input->post('u_phone');
			
			$u_city=$this->input->post('u_city');
			$u_country=$this->input->post('u_country');
			$u_zip=$this->input->post('u_zip');
			$u_email_alt=$this->input->post('u_email_alt');
			$u_address=$this->input->post('u_address');

			$designation = $this->input->post('designation');
			$bankaccno = $this->input->post('bankaccno');
			$ifsccode = $this->input->post('ifsccode');
			$panno = $this->input->post('panno');
			$joiningdate = $this->input->post('joiningdate');
			$p_address = $this->input->post('p_address');
			$userrole = $this->input->post('userrole');
			
			//echo $this->input->post('status');exit;
			
			$logstatus = 0;
			if($this->input->post('logstatus'))
			{
				$logstatus = 1;
			}
			
			$status = 0;
			if($this->input->post('status'))
			{
				$status = 1;
			}
			
			$projectid = 0;
			$MC_cl_id_val = 0;
			$MC_cl_company_name_val = '';

			$comp_name= WEBNAME;
			if(($usr_type == 2 || $usr_type == 3) && $MC_cl_company_name_val != ''){
				$comp_name = $MC_cl_company_name_val;
			}
		
			
			$imagemax_size = image_size()*1048576;	
			$uploadbannersize = $_FILES["userprofimg"]['size'];

			if($uploadbannersize > $imagemax_size ){
				$this->session->set_flashdata('error', 'Image size is greater than '.image_size().' mb ! Kindly resize the image and upload');
				redirect("User/edit_admin_user_profile/".$edit_id.'/'.$selected.'/'.$usr_type);
			}
			else
			{
				// for banner image
				//print_r($_FILES);exit;
				if(!empty($_FILES["userprofimg"]['name']))
				{
					$userprofimg = time().'_'.$_FILES["userprofimg"]['name'];
					$config['file_name'] = $userprofimg;
					$userprofimg = str_replace(' ', '_', $userprofimg);
					$config['upload_path'] = 'uploads/user-profile-pic/';
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 20000000; //50000
					$config['max_width']            = 20000000;
					$config['max_height']           = 20000000;
					$this->load->library("upload", $config);
					$this->upload->initialize($config);
					//print_r($config); die();
					if (!$this->upload->do_upload('userprofimg'))
					{
						//echo $this->upload->display_errors();					
						$userprofimg = '';
					}
					}
					else
					{
						$userprofimg = '';
					}
					
			
			$updatedata = array(				
				'MUM_User_type'=>$usr_type,							
				'MUM_City'=>$u_city,
				'MUM_Country'=>$u_country,
				'MUM_ZippCode'=>$u_zip,
				'MUM_alt_email'=>$u_email_alt,
				'MUM_Add'=>$u_address,

				
				'MUM_bank_accno'=>$bankaccno,
				'MUM_ifsc_code'=>$ifsccode,
				'MUM_pancard_number'=>$panno,
				'MUM_permanent_address'=>$p_address,
				'MUM_UpdatedBY'=>$adm
				);
				
				if($role == 1){
					$updatedata['MUM_status'] = $status;
					$updatedata['MUM_login_status'] = $logstatus;
				}

				if($comp_name != ''){
					$updatedata['MUM_Comp_Name'] = $comp_name;
				}
				if($full_name != ''){
					$updatedata['MUM_Full_name'] = $full_name;
				}
				if($u_phone != ''){
					$updatedata['MUM_Phone'] = $u_phone;
				}
				// if($this->input->post('status')){
				// 	$updatedata['MUM_status'] = $status;
				// }
				if($designation != ''){
					$updatedata['MUM_designation'] = $designation;
				}
				if($joiningdate != ''){
					$updatedata['MUM_joining_date'] = date('Y-m-d',strtotime($joiningdate));
				}
				if($userrole !=''){
					$updatedata['MUM_roles'] = $userrole;
				}
				
				if($userprofimg !=''){				
					$updatedata['MUM_Profilepic'] = $userprofimg;
				}
				if($usr_type == 3){
						$updatedata['MP_proj_id'] = $projectid;
					}

				$dataupdate = $this->Master_model->updatedata('MUM_ID',$edit_id,$updatedata,'mov_user_master');
				if($dataupdate > 0)
				{
					$this->session->set_flashdata('userupdatesuccess','Successfully Update!');
					redirect("User/edit_admin_user_profile/".$edit_id.'/'.$selected.'/'.$usr_type);
				}
				else{
					
					$this->session->set_flashdata('userupdateerror','Problem with Update!');
					redirect("User/edit_admin_user_profile/".$edit_id.'/'.$selected.'/'.$usr_type);
				}

			}
			
		}
	}
	
	public function update_admin_login_details($selected,$usertype)
	{
		$role = $this->session->userdata('role');
		if($role == 1){
		$this->form_validation->set_rules("u_name","User Name","trim|required");
		}
		$this->form_validation->set_rules("password","password","trim");
		$this->form_validation->set_rules("edit_id","edit_id","trim");
		$edit_id = $this->input->post('edit_id');
		$usr_type = $usertype;
		
		if($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('userupdateerror',  validation_errors());
			redirect("User/edit_admin_user_profile/".$edit_id.'/'.$selected.'/'.$usertype);	
		}
		else
		{
			$adm = $this->session->userdata('id');
			$u_name= '';
			if($role == 1){
			$u_name=$this->input->post('u_name');
			}
			$password=base64_encode($this->input->post('password'));
			// $password=$this->input->post('password');
			// $password = password_hash($password, PASSWORD_DEFAULT);
			
			$updatedata = array('MUM_Passcode'=>$password,'MUM_UpdatedBY'=>$adm);
			if($u_name != ''){
				$updatedata['MUM_Email'] = $u_name;
			}
				$dataupdate = $this->Master_model->updatedata('MUM_ID',$edit_id,$updatedata,'mov_user_master');
				if($dataupdate > 0)
				{
					$this->session->set_flashdata('userupdatesuccess','Successfully Update!');
					redirect("User/edit_admin_user_profile/".$edit_id.'/'.$selected.'/'.$usertype);
				}
				else{
					
					$this->session->set_flashdata('userupdateerror','Problem with Update!');
					redirect("User/edit_admin_user_profile/".$edit_id.'/'.$selected.'/'.$usertype);
				}
			
		}
	}
	
	public function mailsend()
	{
		$this->form_validation->set_rules("emailfrom","emailfrom","trim|required");
		$this->form_validation->set_rules("emailto","emailto","trim|required");
		$this->form_validation->set_rules("emailsub","emailsub","trim|required");
		$this->form_validation->set_rules("msg","msg","trim|required");
		
		if($this->form_validation->run()==FALSE)
		{
			echo validation_errors();	
		}
		else {
			
			
					$config = get_email_data();         

					$this->email->initialize($config); 
					
					//$from_email = "flowersandfruits10@gmail.com";
					$from_email = $this->input->post('emailfrom');				
					$to_email = $this->input->post('emailto'); 
					$subject = $this->input->post('emailsub');
					$message = $this->input->post('msg');
					
					$this->email->from($from_email, 'Flowers And Fruits '); 
					$this->email->to($to_email);
					$this->email->subject($subject); 
					
					$this->email->message($message); 
					if($this->email->send()) 
					{
						echo "Sent mail";
					}
					else
					{			
						echo "not sent";
					}
			
		}
		
	}
	
	
	public function paymailsend()
	{
		$this->form_validation->set_rules("payemailfrom","emailfrom","trim|required");
		$this->form_validation->set_rules("payemailto","emailto","trim|required");
		$this->form_validation->set_rules("payemailsub","emailsub","trim|required");
		$this->form_validation->set_rules("paymsg","msg","trim|required");
		$this->form_validation->set_rules("outstandingamt","outstanding amount","trim|required");
		$this->form_validation->set_rules("detailtoflorist","Detail to Florist","trim|required");
		$this->form_validation->set_rules("payfullname","Full Name","trim|required");
		$this->form_validation->set_rules("paycompname","Company Name","trim|required");
		
		if($this->form_validation->run()==FALSE)
		{
			echo validation_errors();	
		}
		else{
			
					$config = get_email_data();        
					$this->email->initialize($config); 
					
					//$from_email = "flowersandfruits10@gmail.com"; 
					$from_email = $this->input->post('payemailfrom'); 
					$to_email = $this->input->post('payemailto'); 
					$subject = $this->input->post('payemailsub');
					
					$msg =$this->input->post('paymsg');
			
					$payfullname =$this->input->post('payfullname');
					$paycompname =$this->input->post('paycompname');
					$outstandingamt =$this->input->post('outstandingamt');
					$detailtoflorist =$this->input->post('detailtoflorist');
					
					$msg = str_replace("(~Person-Name~)",$payfullname,$msg);
					$msg = str_replace("(~OutStanding-AMOUNT~)",$outstandingamt,$msg);
					$msg = str_replace("(~Company-Name~)",$paycompname,$msg);
					$msg = str_replace("(~Details-to-florist~)",$detailtoflorist,$msg);
					
					
					$this->email->from($from_email, 'Flowers And Fruits '); 
					$this->email->to($to_email);
					$this->email->subject($subject); 
					
					$this->email->message($msg);					 
					if($this->email->send()) 
					 {
						echo "Sent mail";
					 }
					 else
					 {			
						echo "no";
					 }
			
		}
		
	}
	
	
	
	
	public function mailsendto()
	{
		$this->form_validation->set_rules("emailfrom","emailfrom","trim|required");
		$this->form_validation->set_rules("emailto","emailto","trim|required");
		$this->form_validation->set_rules("ccemail","ccemail","trim");
		$this->form_validation->set_rules("emailsub","emailsub","trim|required");
		$this->form_validation->set_rules("msg","msg","trim|required");
		$this->form_validation->set_rules("oid","oid","trim|required");
		$this->form_validation->set_rules("mobile","mobile","trim");
		$this->form_validation->set_rules("sms","sms","trim|required");
		$this->form_validation->set_rules("web","web","trim|required");
		$this->form_validation->set_rules("smsstatus","SMS Status","trim|required");
		
		if($this->form_validation->run()==FALSE)
		{
			echo validation_errors();	
		}
		else{
			
					$config = get_email_data();     
					$this->email->initialize($config); 
					//$from_email = "flowersandfruits10@gmail.com"; 
					$from_email = $this->input->post('emailfrom'); 
					$to_email = $this->input->post('emailto'); 
					$subject = $this->input->post('emailsub');
					$message = $this->input->post('msg');
					$mobile = $this->input->post('mobile');
					$smsstatus = $this->input->post('smsstatus');
					$web = $this->input->post('web');
					$ccemail = $this->input->post('ccemail');
					//echo $ccemail;exit;
					$sms = $this->input->post('sms');
					$oid = $this->input->post('oid');
					$this->email->from($from_email, 'Flowers And Fruits '); 
					$this->email->to($to_email);
					$this->email->subject($subject); 
					$this->email->cc($ccemail);
					$this->email->message($message); 
					 if($this->email->send()) 
					 {
						$updatedata = array('FO_Email_Sended'=>'Confirmation Sent');
						$dataupdate = $this->Master_model->updatedata('FO_OID',$oid,$updatedata,'flr_orders');
						if($dataupdate > 0){
							
							if($mobile != '' && $smsstatus == 1)
							{
								if($mobile != '' && $sms != '' && $web != ''){sendSMS_globalsms($mobile,$sms,$web);}
								echo "Sent mail";
							}
						}
						
					 }
					 else
					 {			
						echo "not sent";
					 }
			
		}
		
	}
	
	public function update_order_status_to_delete()
	{
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
		$this->form_validation->set_rules('oid', 'oid', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			echo "1";
		}
		else{
				$id = $this->session->userdata('id');
				$pass = base64_encode($this->input->post('pass'));
				$oid = $this->input->post('oid');
				$where = "FUM_ID='".$id."' and FUM_Passcode='".$pass."'";
				$ans = $this->Master_model->checklogin("flr_user_master","FUM_Role,FUM_ID,FUM_Full_name",$where);
				if($ans == 'no')
				{
					echo "2";
				}
				else
				{
					$arr = array('FO_Order_Status'=>97);
					$updatestatus = $this->Master_model->updatedata('FO_OID',$oid,$arr,'flr_orders');
					if($updatestatus)
					{
						echo "3";
					}
					else{
						echo "4";
					}
				} 
		}
	}
	
	public function latlongcust(){
		$ans = $this->Master_model->checklogin("flr_user_master","FUM_ID,FUM_Add,FUM_City,FUM_state,FUM_Country","FUM_status=1 And FUM_User_type = 3 ");
		//FUM_Latitude,FUM_Longtitude
		foreach($ans as $data)
		{
			$faddr = array();
			$finaladdr='';
		    if($data->FUM_Add != '' || $data->FUM_Add != 0)
			{
				$faddr[] = $data->FUM_Add;
			}
			if($data->FUM_City != '' || $data->FUM_City != 0){
				$faddr[] = $data->FUM_City;
			}
			if($data->FUM_state != '' || $data->FUM_state != 0){
				$faddr[] = $data->FUM_state;
			}
			if($data->FUM_Country != '' || $data->FUM_Country != 0){
				$faddr[] = $data->FUM_Country;
			}
			if(!empty($faddr))
			{
				$finaladdr=implode(",",$faddr);
				$formattedAddr = str_replace(' ','+',$finaladdr);
				$geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
				$output = json_decode($geocodeFromAddr);//print_r($output);exit;
				if(!empty($output->results[0]))
				{
					//Get latitude and longitute from json data
					$lat  = $output->results[0]->geometry->location->lat; 
					$lng = $output->results[0]->geometry->location->lng;
					$arr = array('FUM_Latitude'=>$lat,'FUM_Longtitude'=>$lng);
					$this->Master_model->updatedatawhere("FUM_ID=$data->FUM_ID",$arr,"flr_user_master");
					
				}
			}
			
		}
	}
	
	public function latlongdata()
	{
		$ans = $this->Master_model->checklogin("flr_user_master","FUM_ID,FUM_Add,FUM_City,FUM_state,FUM_Country","FUM_status=1 And FUM_User_type = 3 And FUM_Latitude = 0" );
		foreach($ans as $data)
		{
			$latlong = explode(",",$data->FUM_Country);
			//print_r($latlong);echo "<br/>";
			if(count($latlong) == 2){
				$arr = array('FUM_Latitude'=>$latlong[0],'FUM_Longtitude'=>$latlong[1]);
				$this->Master_model->updatedatawhere("FUM_ID=$data->FUM_ID",$arr,"flr_user_master");
			}
			
		}
	}
	
	public function monthlireport($vendor_id=0){
		if($vendor_id != 0){
			$data['vendor_id'] = $vendor_id;
			$datav = $this->Master_model->select_data('flr_user_master','FUM_Comp_Name,FUM_Full_name',"FUM_ID=$vendor_id");
			if(!empty($datav[0])){
				$data['vendorname'] =  $datav[0]->FUM_Comp_Name != '' ? $datav[0]->FUM_Comp_Name : $datav[0]->FUM_Full_name;
			}
			$this->load->view('monthlireport',$data);
		}	
	}
	
	public function filterdate($vendor_id=0,$dt=null){
		
		if($dt!=null){
			$dt = explode('-',$dt);
			$data['mnth'] = $dt[0];
			$data['yr'] = $dt[1];
		}
		$data['vendor_id'] = $vendor_id;
		$datav = $this->Master_model->select_data('flr_user_master','FUM_Comp_Name,FUM_Full_name',"FUM_ID=$vendor_id");
		if(!empty($datav[0])){
			$data['vendorname'] =  $datav[0]->FUM_Comp_Name != '' ? $datav[0]->FUM_Comp_Name : $datav[0]->FUM_Full_name;
		}
		$this->load->view('monthlireport',$data);
		
	}
	
	public function account_summery($vendor_id=0){
		$data['vendor_id'] = $vendor_id;
		$datav = $this->Master_model->select_data('flr_user_master','FUM_Comp_Name,FUM_Full_name',"FUM_ID=$vendor_id");
		if(!empty($datav[0])){
			$data['vendorname'] =  $datav[0]->FUM_Comp_Name != '' ? $datav[0]->FUM_Comp_Name : $datav[0]->FUM_Full_name;
		}
		$this->load->view('account_summery',$data);
		
	}
	
	public function makepayment($vendor_id=0){
		$data['vendor_id'] = $vendor_id;
		$this->load->view('makepayment',$data);
	}
	
	public function addpayment($vendor_id=0){
		
		$this->form_validation->set_rules('paydesc', 'Payment Description', 'trim|required');
		$this->form_validation->set_rules('paymod', 'Payment Mode', 'trim|required');
		$this->form_validation->set_rules('amt', 'Amount', 'trim|required');
		$this->form_validation->set_rules('transaction', 'Transaction', 'trim|required');
		$this->form_validation->set_rules('from_date', 'From Date', 'trim|required');
		$this->form_validation->set_rules('to_date', 'To Date', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$datas['vendor_id'] = $vendor_id;
			$this->load->view('makepayment',$datas);
			
		}else{
			$data = $this->input->post();
			$fromdate= $data['from_date'];
			$todate= $data['to_date'];
			//check selected date payment is done or not
			//'$to_date' >= fu.FUA_To_Date and '$from_date' <= fu.FUA_From_Date and fu.FUA_debit <> 0 and fum.FUM_status=1
			//$chk = $this->Master_model->checkdata("FUA_To_Date","flr_user_accounts","'$todate' >= FUA_To_Date and '$fromdate' <= FUA_From_Date and FUM_ID = $vendor_id");
			/* echo $this->db->last_query();exit;
			print_r($chk);exit; */
			//if(!$chk){
				$transaction = array('FUM_ID'=>	$vendor_id,'FUA_payment_description'=>$data['paydesc'],'FPM_ID'=>$data['paymod'],'FUA_debit'=>$data['amt'],'FUA_status'=>1,'FUA_From_Date'=>$fromdate,'FUA_To_Date'=>$todate);
				if($data['transaction'] == 2){
					$transaction = array('FUM_ID'=>	$vendor_id,'FUA_payment_description'=>$data['paydesc'],'FPM_ID'=>$data['paymod'],'FUA_credit'=>$data['amt'],'FUA_status'=>1,'FUA_From_Date'=>$fromdate,'FUA_To_Date'=>$todate);
				}
				
				$payment = $this->Master_model->InsertdatawithlastID('flr_user_accounts',$transaction);
				if($payment > 0){
					$this->session->set_flashdata('success', "Payment Successfully Added!");
					redirect("User/makepayment/".$vendor_id);
				}else{
					$datas['vendor_id'] = $vendor_id;
					$datas['error'] = "Problem with reocrd insert!";
					$this->load->view('makepayment',$datas);
				}
			/* }else{
				$datas['vendor_id'] = $vendor_id;
				$datas['error'] = "Payment done for the selected date!";
				$this->load->view('makepayment',$datas);
			} */
			
		}
		
	}
	
	public function accessrole($roleid=0){
		if($roleid!=0){
			$data['uaccess'] = $this->Master_model->select_data('flr_user_role','*',"FUR_ID=$roleid");
			$data['roleiddata'] = $roleid;
			//echo $roleid;
			$this->load->view('access_permission',$data);
		 }
		else{
			$this->load->view('access_permission');
		} 
	}
	
	
	public function addaccess($edit_id,$select,$usertype){
		/*$this->form_validation->set_rules('role', 'User Role', 'trim|required');*/
		$this->form_validation->set_rules('useraccess[]', 'Select Page', 'trim|required');
		$this->form_validation->set_rules('usermodify[]', 'Select Page', 'trim');
		$role = $this->input->post('role');
		if ($this->form_validation->run() == FALSE)
		{
			$data['error'] = validation_errors();
			$data['userdata'] = $this->Master_model->select_data('flr_user_master','*',"FUM_User_type=$usertype and FUM_ID = $edit_id");
			$data['edit_id'] = $edit_id;
			$data['usertype'] = $usertype;
			$data['isactive'] = $select;
			$this->load->view('edit_user_data',$data);
			
		}else{
			
			$useraccess = $this->input->post('useraccess');
			$usermodify = $this->input->post('usermodify');
			
			$uacc = implode(',',$useraccess);
			$id = $this->session->userdata('id');
			$umodify = '';
			$ins = array('FUM_Access_Permission'=>$uacc,'FUM_UpdatedBY'=>$id);
			if(!empty($usermodify)){
				$umodify = implode(',',$usermodify);
				$ins = array('FUM_Access_Permission'=>$uacc,'FUM_Modify_Permission'=>$umodify,'FUM_UpdatedBY'=>$id);
			}
			
			//$inserted = $this->Master_model->insert_data('',$ins);
			$updatedata = $this->Master_model->updatedatawhere("FUM_ID=$edit_id",$ins,"flr_user_master");
			if($updatedata > 0){
				$this->session->set_flashdata('userupdatesuccess', "Accesss modify Successfully !");
				redirect("User/edit_user_profile/$edit_id/$select/$usertype");
			}else{
				$data['error'] = "Opps there is problem with update access!";
				$data['userdata'] = $this->Master_model->select_data('flr_user_master','*',"FUM_User_type=$usertype and FUM_ID = $edit_id");
				$data['edit_id'] = $edit_id;
				$data['usertype'] = $usertype;
				$data['isactive'] = $select;
				$this->load->view('edit_user_data',$data);
			}	
		}
	}
	
	public function addadminaccess($edit_id,$select,$usertype){
		$this->form_validation->set_rules('useraccess[]', 'Select Page', 'trim|required');
		$this->form_validation->set_rules('usermodifyaccess[]', 'Select Page', 'trim|required');
		$this->form_validation->set_rules('userdeleteaccess[]', 'Select Page', 'trim|required');
		$role = $this->input->post('role');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('userupdateerror', validation_errors());
			redirect("User/edit_admin_user_profile/$edit_id/$select/$usertype");
			
		}else{
					
			$id = $this->session->userdata('id');

			$uacc = '';
			if($this->input->post('useraccess')){
				$useraccess = $this->input->post('useraccess');	
				$uacc = implode(',',$useraccess);
			}
			
			$umodifyacc = '';
			if($this->input->post('usermodifyaccess')){
				$usermodifyaccess = $this->input->post('usermodifyaccess');
				$umodifyacc = implode(',',$usermodifyaccess);
			}
			
			$udeleteacc = '';
			if($this->input->post('userdeleteaccess')){
				$userdeleteaccess = $this->input->post('userdeleteaccess');
				$udeleteacc = implode(',',$userdeleteaccess);
			}


			$ins = array('MUM_Access_Permission'=>$uacc,'MUM_Modify_Permission'=>$umodifyacc,'MUM_Delete_Permission'=>$udeleteacc,'MUM_UpdatedBY'=>$id);			
	

			$updatedata = $this->Master_model->updatedatawhere("MUM_ID=$edit_id",$ins,"mov_user_master");
			if($updatedata > 0){
				$this->session->set_flashdata('userupdatesuccess', "Accesss modify Successfully !");
				redirect("User/edit_admin_user_profile/$edit_id/$select/$usertype");
			}else{
				$this->session->set_flashdata('userupdateerror', 'Opps there is problem with update access!');
				redirect("User/edit_admin_user_profile/$edit_id/$select/$usertype");
				
			}	
		}
	}
	

	public function add_role(){
		$this->load->view('add_role');
	}
	public function addroledata(){
		$this->form_validation->set_rules('role', 'User Role', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['error'] = validation_errors();
			$this->load->view('add_role',$data);
			
		}else{
			$role = $this->input->post('role');
			$insertdata = array('FUR_Role_Name'=>$role,'FUR_CreatedBY'=>$this->session->userdata('id'),'FUR_CreatedDate'=>date("Y-m-d"),'FUR_UpdatedBY'=>$this->session->userdata('id'));
			$datainserted = $this->Master_model->InsertdatawithlastID('flr_user_role',$insertdata);
			if($datainserted > 0){
				$this->session->set_flashdata('success', "Role Added Successfully !");
				redirect("User/add_role/".$role);
			}else{
				$data['error'] ="Problem With Role Adding!";
				$this->load->view('add_role',$data);
			}
		}
	}
	
	public function getvoucher($id){
		
	}
	
	//security pin feture
	
	public function security_pin_generator(){
		
		
		$userdata = $this->Master_model->select_data('mov_user_master','MUM_ID,MUM_Phone,MUM_Email',"MUM_User_type in (1,2,3,4) and MUM_status = 1 and MUM_login_status = 1");
		//print_r($userdata);exit;
		//$userdata = Array('FUM_ID' => '3','FUM_Phone'=> '7083120546','FUM_Email'=> 'dhananjay@movinnza.in');	
		//print_r($userdata);exit;
		
		if(!empty($userdata)){
			foreach($userdata as $user){
				//update pin and send msg to every active admin, user  
				$digits = 6;
				//generate 4 digit pin
				$pin =  rand(pow(10, $digits-1), pow(10, $digits)-1);
				//update with pin and current date
				date_default_timezone_set('Asia/Kolkata');
				$currentdateandtime  = date('Y-m-d h:i:s');
				//echo $user->FUM_ID;
				$this->Master_model->updatedatawhere("MUM_ID=$user->MUM_ID",['MUM_Pin_DateTime'=>$currentdateandtime,'MUM_Pin'=>base64_encode($pin)],"mov_user_master");
				//send msg and email to user
					$config = get_email_data();     
					$this->email->initialize($config); 
					$from_email = 
					$to_email = $user->MUM_Email; 
					$subject = 'Your new key';
					$message = 'Please find your new verification key below:- <br/>'.$pin;
					$mobile = $user->MUM_Phone;
					//get current website data
					//$web = $this->db->select('FWM_Mail_SenderID,FWM_Website_Name')->from('flr_website')->where(['FWM_ID'=>CURRENT_WEBSITE])->get()->row();
					//if(isset($web)){
						$from_email = 'NoReply'; 
						$this->email->from($from_email,WEBNAME); 
						$this->email->to($to_email);
						$this->email->subject($subject); 
						
						$this->email->message($message); 
						if($this->email->send()) 
						{
							echo "Sent mail";	
						}
					//}
					
			}
		}
	}
	
	public function getschedulemail(){
		$this->form_validation->set_rules('webcountryid','webcountryid','required|trim');
		$this->form_validation->set_rules('vendor','vendor','required|trim');
		$this->form_validation->set_rules('logo','logo','required|trim');
		$this->form_validation->set_rules('schedule_date','schedule_date','required|trim');
		if($this->form_validation->run() == FALSE){
			echo validation_errors();
		}else{
			$webcountryid = $this->input->post('webcountryid');
			$vendor = $this->input->post('vendor');
			$logo = $this->input->post('logo');
			$scheduledate = $this->input->post('schedule_date');
			$web = get_list('flr_website','FWM_Website_Name,FWM_Mail_SenderID,FWM_Domain_Name',"FWM_ID = (Select FWM_ID from flr_web_country_mapping where FWCM_ID = $webcountryid)");
			$email_format = get_list('flr_email_format','FEF_Email_Code',"FWM_ID = (Select FWM_ID from flr_web_country_mapping where FWCM_ID = $webcountryid) and FEF_Email_list_id = 24");
			
			$obj = $this->Master_model->select_row('flr_user_master','*',['FUM_ID'=>$vendor]);
			//print_r($schedule_date);
			if(isset($obj))
			{
			if(!empty($web[0]) && !empty($email_format[0]))
			{
				$emaildata = $email_format[0]->FEF_Email_Code;
				$imgurl = base_url().'uploads/cpanel-logo/'.$logo;
				$emaildata = str_replace("(~VENDER_FULL_NAME~)",$obj->FUM_Full_name,$emaildata);
				$emaildata = str_replace("(~WEBSITE_LOGO~)",$imgurl,$emaildata);
				$schedule_date = date("d M, Y",strtotime($scheduledate));
				$emaildata = str_replace("(~DELIVERY_DATE~)",$schedule_date,$emaildata);
				//get the table data from vendor order
				$vendororder = $this->Master_model->select_data('flr_orders','*',"FO_Del_Date = '$scheduledate' and FO_VendorID = $vendor and FO_Order_Status <> 95 and Fo_Pay_Get_Status = 100");
				//print_r($vendororder);
				//echo $this->db->last_query();
				
				if(!empty($vendororder)){
					$ordertable = '';
					$ordertable .= '<style>td, th {
    padding: 10px;
}</style><table border="1" width="99%" align="center" bordercolor="#909090" cellspacing="0" cellpadding="4">
								<tbody><tr bgcolor="#efefef"><th width="5%">#</th><th width="12%">Order ID</th><th width="30%">Recievers Details</th><th width="45%">Product Details</th><th width="10%">Forward Amount</th></tr>';
								$i=1;
						foreach($vendororder as $vorder){
							
						   $ordertable .= '<tr valign="top"><td><b>'.$i.'.</b></td>
						   <td align="center"><b>'.$vorder->FO_Order_No.'</b></td>
						   <td><b>'.$vorder->FO_Ship_Name.'</b><br>'.$vorder->	FO_Ship_Add.',<br>
							'.$vorder->	FO_Ship_Area.',<br>
							'.$vorder->FO_Ship_City.' ,'.$vorder->FO_SHIP_State.'<br>
							Pin '.$vorder->FO_Ship_Zip.'<br>'.$vorder->	FO_Ship_Country.'<br>Contact no. - '.$vorder->	FO_Ship_Mobile.', <br>Email - '.$vorder->	FO_Ship_Email.'</td>
						   <!--<b><font color=#c10000 size=2><u>Products Order</u></font></b><br>-->
						   <td>';
							$vendororderproduct = $this->Master_model->select_data('flr_orders_product_mapping','*',['FO_OID'=>$vorder->FO_OID]);
							if(isset($vendororderproduct)){
								foreach($vendororderproduct as $prd){
								$ordertable .=   'Product ID #'.$prd->FP_ProID.'<br><b>'.$prd->FOPM_PRODUCT_DETAILS.'</b><br>Quantity :- '.$prd->FOPM_PRODUCT_QUANTITY.' Pc(s)<br>.';
						   }}
							$ordertable .=   '</td>
							<td align="right">Rs.'.$vorder->FO_Forward_Amt.'</td>
							</td>
							</tr>';$i++;
						}
					$ordertable .='</tbody></table>';
					/* $emaildata = str_replace("(~DELIVERY_DATE~)","$day $month,$yr",$emaildata); */
					$link = "https://".$web[0]->FWM_Domain_Name."/florist-login";
					 $emaildata = str_replace("(~DELIVERY_ORDER_LIST~)",$ordertable,$emaildata);$emaildata = str_replace("(~LOGIN_LINK~)",$link,$emaildata);$emaildata = str_replace("(~ORDER_COUNT~)",$i,$emaildata);
					//echo $ordertable;
				}else{
					echo "";
				}
				echo  $emaildata;
			}
			else{
				echo "Assign user to website or Add email format to website!";
			}
		}
		
		}
	}


	public function addsubuseraccess($edit_id,$select,$usertype){
		$this->form_validation->set_rules('subuseraccess[]', 'Select User', 'trim|required');
		$role = $this->input->post('role');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('userupdateerror', validation_errors());
			redirect("User/edit_admin_user_profile/$edit_id/$select/$usertype");
			
		}else{
					
			$id = $this->session->userdata('id');

			$subuacc = '';
			if($this->input->post('subuseraccess')){
				$subuseraccess = $this->input->post('subuseraccess');	
				$subuacc = implode(',',$subuseraccess);
			}
			
			$ins = array('MUM_Subuser_Access_Permission'=>$subuacc,'MUM_UpdatedBY'=>$id);			
	

			$updatedata = $this->Master_model->updatedatawhere("MUM_ID=$edit_id",$ins,"mov_user_master");
			if($updatedata > 0){
				$this->session->set_flashdata('userupdatesuccess', "Accesss modify Successfully !");
				redirect("User/edit_admin_user_profile/$edit_id/$select/$usertype");
			}else{
				$this->session->set_flashdata('userupdateerror', 'Opps there is problem with update access!');
				redirect("User/edit_admin_user_profile/$edit_id/$select/$usertype");
				
			}	
		}
	}



public function chkuser()
	{
		$id = $this->session->userdata('id');	
		$this->form_validation->set_rules('statuscl', 'Statuscl', 'trim|required');
		$this->form_validation->set_rules('cntid', 'cntid', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			echo "1";
		}
		else
		{		
			$id = $this->session->userdata('id');			
			$cntid = $this->input->post('cntid');
			$statuscl = $this->input->post('statuscl');

			$where = "MUM_ID='".$id."'";
			$ans = $this->Master_model->checklogin("mov_user_master","MUM_ID",$where);
			if($ans == 'no')
			{
				echo "There is somthing wrong";
			}
			else		
			{			
				$arr = array('MUM_status'=>$statuscl,'MUM_UpdatedBY'=>$id); 
				$updatestatus = $this->Master_model->updatedata('MUM_ID',$cntid,$arr,'mov_user_master');

				if($updatestatus)
				{
					echo "3";
				}
				else{
					echo "4";
				}
			} 
		}	
	}
	
	public function chkuser_login()
	{
		$id = $this->session->userdata('id');	
		$this->form_validation->set_rules('statuscl', 'Statuscl', 'trim|required');
		$this->form_validation->set_rules('cntid', 'cntid', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			echo "1";
		}
		else
		{		
			$id = $this->session->userdata('id');			
			$cntid = $this->input->post('cntid');
			$statuscl = $this->input->post('statuscl');

			$where = "MUM_ID='".$id."'";
			$ans = $this->Master_model->checklogin("mov_user_master","MUM_ID",$where);
			if($ans == 'no')
			{
				echo "There is somthing wrong";
			}
			else		
			{			
				$arr = array('MUM_login_status'=>$statuscl,'MUM_UpdatedBY'=>$id); 
				$updatestatus = $this->Master_model->updatedata('MUM_ID',$cntid,$arr,'mov_user_master');

				if($updatestatus)
				{
					echo "3";
				}
				else{
					echo "4";
				}
			} 
		}	
	}





}