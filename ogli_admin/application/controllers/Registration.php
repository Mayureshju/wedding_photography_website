<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Master_model');
	    $this->load->library('form_validation');
	}	
	
	public function index()
	{
		$this->load->view('login');
	}
	
	public function login()
	{
		$this->form_validation->set_rules("email","Email","trim|required");
		$this->form_validation->set_rules("password","Password","trim|required");
		if($this->form_validation->run()==FALSE)
		{	
			$error['error'] = validation_errors();
			$this->load->view('login',$error);
		}
		else
		{
				$email = $this->input->post('email');
				$pass = base64_encode($this->input->post('password'));
				
				$where = "MUM_Email='".$email."' and MUM_Passcode=LTRIM(RTRIM('".$pass."'))";
				$ans = $this->Master_model->checklogin("mov_user_master","*",$where);
				//echo $this->db->last_query();die;
				if($ans == 'no')
				{
					$error['error'] = 'Incorrect username and password combination';
					$this->load->view('login',$error);
				}
				else
				{
					if(isset($ans) && !empty($ans))
					{
						foreach($ans as $obj)
						{
								$utype = $obj->MUM_User_type;
								$ustatus = $obj->MUM_status;
								$MUM_login_status = $obj->MUM_login_status;
								if(($utype == 1  || $utype == 4 || $utype == 2 || $utype == 3) && $ustatus == 1 && $MUM_login_status == 1)
								{
									$role = $obj->MUM_User_type;
									$this->session->set_userdata('role',$role);
									$id = $obj->MUM_ID;
									//$this->session->set_userdata('auid',$id);
									$this->session->set_userdata('id',$id);
									$name = $obj->MUM_Full_name;
									$this->session->set_userdata('username',$name);
									$name = $obj->MUM_Email;
									$this->session->set_userdata('email',$name);
									$profile = $obj->MUM_Profilepic;
									$this->session->set_userdata('profile',$profile);
								//	$website_country = $obj->MWM_ID;
									$this->session->set_userdata('website_country',1);
									$MUM_roles = $obj->MUM_roles;
									$this->session->set_userdata('MUM_roles',$MUM_roles);
									$access = $obj->MUM_Access_Permission;
									$modifyper = $obj->MUM_Modify_Permission;
									$deleteper = $obj->MUM_Delete_Permission;									
									//redirect('Registration/pin');
									redirect('Registration/dashboard');
								}
								else{
									
									$error['error'] = 'Access Denied!';
									$this->load->view('login',$error);
								}
							}
						}
						else{
							
							$error['error'] = 'Access Denied!';
							$this->load->view('login',$error);
						}
				}
		}
		
	}
	
	public function dashboard(){
		//get total todays orders
		date_default_timezone_set(TIMEZONE);
		$current_date = date('Y-m-d');
		$data['current_date'] = $current_date;
		//$data['dsbid'] = $dsbid;
		$id = $this->session->userdata('id');
		$data['enquiries'] =get_list('mov_enquiry','*','MEnq_status=0 OR MEnq_status=1');
		$data['online_user'] = $this->Master_model->select_data('mov_user_master','MUM_ID,MUM_Full_name,MUM_Mac_Address,MUM_Email',"MUM_Email <> ''");
		$this->load->view('home',$data);
		
	}
	
	public function search_dashboard(){
		$this->form_validation->set_rules("dashboardid","user id","trim");
		$dashboardid = $this->input->post('dashboardid');
		redirect('Registration/dashboard/'.$dashboardid);
		
	}
	
	
	public function pin(){
		$this->load->view('pin');
	}
	
	public function ip() 
	{
		//echo system('getmac');
		$ipAddress=$_SERVER['REMOTE_ADDR'];
			$macAddr=false;
			#run the external command, break output into lines
			$arp=`arp -a $ipAddress`;
			$lines=explode("\n", $arp);

			#look for the output line describing our IP address
			foreach($lines as $line)
			{
			   $cols=preg_split('/\s+/', trim($line));
			   if ($cols[0]==$ipAddress)
			   {
				   $macAddr=$cols[1];
			   }
			}
			echo $macAddr;
	}
	
	public function checkpin(){
		
		$this->form_validation->set_rules("pin","Pin","trim|required");
		$id = $this->session->userdata('auid');
		if($this->form_validation->run()==FALSE)
		{
			$error['error'] = validation_errors();
			$this->load->view('pin',$error);
		}
		else
		{
			$pin = $this->input->post('pin');
			$ans = $this->Master_model->checklogin("mov_user_master","MUM_ID,MUM_Pin,MUM_Mac_Address",['MUM_ID'=>$id]);
			//print_r($ans); exit;
			if($ans == 'no')
			{
				redirect('Registration/logout');
			}
			else
			{
				//echo $pin; exit;
				foreach($ans as $obj){
					$MUM_Pin =	base64_decode(trim($obj->MUM_Pin));
					//echo $MUM_Pin; echo '<br/>'; echo $pin; exit;
					if($MUM_Pin == $pin){
						$mac = time().$pin.$id;
						//check database mac address is blank
						
						if($obj->MUM_Mac_Address == ''){
							//update mac address
							$this->db->update('mov_user_master',['MUM_Mac_Address'=>$mac], ['MUM_ID'=>$id]);
							$this->session->set_userdata('mac',$mac);
							$this->session->set_userdata('id',$id);
							redirect('Registration/dashboard');
						}else{
							$mac = $this->session->userdata('mac') != ''?$this->session->userdata('mac'):'';
							if($obj->MUM_Mac_Address == $mac){
								$this->db->update('mov_user_master',['MUM_Mac_Address'=>$mac], ['MUM_ID'=>$id]);
								$this->session->set_userdata('mac',$mac);
								$this->session->set_userdata('id',$id);
								redirect('Registration/dashboard');
							}else{
								$error['popup'] = $pin;
								$this->load->view('pin',$error);
							}
						}
					}else{
						$error['error'] = 'Incorrect pin';
						$this->load->view('pin',$error);	
					}
				}
			}
		}
		
	}
	
	public function forgot_pin(){	
		$this->load->library('email');
		//get pin details for login user
		$id = $this->session->userdata('auid');
		$user = $this->db->select('MUM_Pin,MUM_Email')->from('mov_user_master')->where(['MUM_ID'=>$id])->get()->row();
		if(isset($user)){
			$pin = base64_decode($user->MUM_Pin);
			$config = get_email_data();     
			$this->email->initialize($config); 
			$to_email = $user->MUM_Email; 
			$subject = 'Your new key';
			$message = 'Please find your new verification key below:- <br/>'.$pin;
			
			$from_email = 'NoReply'; 
			$this->email->from($from_email,'Movinnza'); 
			$this->email->to($to_email);
			$this->email->subject($subject); 
			$this->email->message($message); 
			if($this->email->send()) 
			{
				$error['error'] = 'Pin send to your register mail';
				$this->load->view('pin',$error);	
			}
			
		}
	}
	
	 
	public function updatemac(){
		$id = $this->session->userdata('auid');
		$updatedata = $this->db->update('mov_user_master',['MUM_Mac_Address'=>''], ['MUM_ID'=>$id]);
	}
	 
	public function logout()
	{
		if($this->session->userdata('id')){
		$id = $this->session->userdata('id');
		$mac = $this->session->userdata('mac');
		$ans = $this->Master_model->checklogin("mov_user_master","MUM_Pin,MUM_Mac_Address",['MUM_ID'=>$id]);
		if($ans != 'no'){
			foreach($ans as $obj){
				if($obj->MUM_Mac_Address == $mac){
					$this->updatemac();
				}
			}
		}}
		//$this->updatemac();
		$this->session->sess_destroy();
		$this->load->view('login');
	}
	  
	  /* Profile Pic  */
	  
	  public function pro_pic()
		{
			$id = $this->input->post('editid');
			if(!empty($_FILES['userfile']['name']))
			{
				$new_name = time().'_'.$_FILES["userfile"]['name'];
				$config['file_name'] = $new_name;
				$config['upload_path']          = './uploads/profile-pics/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 5000;
                $config['max_width']            = 500;
                $config['max_height']           = 500;
				
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('userfile'))
                {
					$error = array('error' => $this->upload->display_errors());
					$error['propic'] = $this->Master_model->select_data('mov_user_master','*','MUM_ID='.$id);
					$this->load->view('header',$error);
                }
                else
                {
					$success['success'] = "Successfully update!";
					$success['propic'] = $this->Master_model->select_data('mov_user_master','*','MUM_ID='.$id);
					$this->load->view('header',$success);
				}
			}

			else
			{				
				$error['error'] = "Problem with update!";
				$error['propic'] = $this->Master_model->select_data('mov_user_master','*','MUM_ID='.$id);
				$this->load->view('header',$error);							
			}			
		}			
	  
	   /* Profile Pic  */
	//fast cash login 
	
	
	
}
?>