<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves extends CI_Controller 
{


	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Master_model');
	    $this->load->library('form_validation');
		
		$this->load->library('email');
		$this->load->library('upload');
		
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
		date_default_timezone_set('Asia/Kolkata');
		
	}
	
	public function manage_leaves($year = null, $month = null, $web = 1)
	{
		if(!in_array("Apply Leave",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->model('Calendar_model');
		if(!$year){
			$year = date('Y');
		}
		if(!$month){
			$month = date('m');
		}
		
		
		$web = $this->session->userdata('id');
		
		if($this->input->post('day'))
		//if($day != 0 || !empty($day))
		{
			
			$strday = $this->input->post('day');
			$day  = base64_decode($strday);
			$day  = json_decode(json_encode($day));
			//print_r($day);exit;
			if($day != 0 || !empty($day)){
				$daycount = explode('/', $day);
				//print_r($daycount);exit;
				foreach ($daycount as $fhead) {

					$web = $this->session->userdata('id');
					//print_r($fhead);exit;
					$daydivide = explode('-', $fhead);
					$newday = intval($daydivide[0]);
					$newmonth = intval($daydivide[1]);
					$newyear = intval($daydivide[2]);
					//print_r(intval($fhead));
					$this->Calendar_model->add_calendar_data_hike(
						"$newyear-$newmonth-$newday",$web
					);
				}

				$data = $this->Master_model->select_data('mov_user_master','*',"MUM_ID=".$web."");
				$config = get_email_data();     
				$this->email->initialize($config); 
				$from_email = 'NoReply'; 
				//$to_email = $data[0]->MUM_Email; 
				$to_email = 'ankita.chandole@movinnza.in'; 
				
				$subject = "Leave Application";
				
				
				$this->email->from($from_email, 'Movinnza'); 
				$this->email->to($to_email);
				$this->email->subject($subject); 
				$message = $data[0]->MUM_Full_name.' has applied for '.count($daycount).' days Leave on following dates:- <br/>';
				foreach($daycount as $val){
					$daydivide = explode('-', $val);
					$newday = intval($daydivide[0]);
					$newmonth = intval($daydivide[1]);
					$newyear = intval($daydivide[2]);
					$message .=''."$newday-$newmonth-$newyear" .'<br/>';
				}

				$this->email->message($message); 
				if($this->email->send()){	
					$this->session->set_flashdata('success', "Applied for Leave Successfully!");				
					redirect('Leaves/manage_leaves/');
			   }
			   else{
					$this->session->set_flashdata('success', 'Applied for Leave Successfully! But Mail Not Send !');
					redirect('Leaves/manage_leaves/');
				}


			}
			
			//print_r($day.'hi');exit;
		//	echo $this->db->last_query();exit;
		}		
		
		$data['website'] = $web;
		//$data['page'] = '';
		$data['calendar'] = $this->Calendar_model->generate_hike($year,$month,$web);	
		//print_r($data['calendar']); exit;
		//echo $this->db->last_query();
		//print_r('hi');
		$this->load->view('manage_leaves', $data);
		}
	}
	
	public function approve_leaves($userid=0){
	$adm = $this->session->userdata('id');
		if($adm == 1){
			$data['userid'] = $userid;
			$this->load->view('approve_leaves',$data);
		}
		else{
			echo "<center><h3>Access Denied!</h3></center>";
		}
	}
	
	public function getleaves_user(){
	
	$userid = $this->input->post('userid');
	$today = date('Y-m-d');
	$getleavelist = get_list('mov_leaves','MLV_ID,MLV_DATE,MLV_STATUS',"MUM_ID = '".$userid."' and MLV_DATE >='".$today."' ORDER BY MLV_DATE ASC");
	//	echo $this->db->last_query(); exit;
	if($getleavelist)
	{
	$existing = '';
	$country = '';
	
	foreach($getleavelist as $getleavelistdata)	
	{
		$checked = '';
		if($getleavelistdata->MLV_STATUS == 1){ $checked = 'checked'; }
		$country .='<div class="col-md-4 col-sm-6 col-xs-12">
		<input  type="checkbox"  class="checkboxc" name="leavelist[]" '.$checked.'  value="'.$getleavelistdata->MLV_ID.'">&nbsp;<b>'.date("d-F-Y l", strtotime($getleavelistdata->MLV_DATE)).'</b>
		</div>';
	}
	
	echo $country; 

	}
	else{
	echo 'no';
	} 

	}

	public function approve_leaves_data()
	{
		$this->form_validation->set_rules('leavelist[]', 'apporved leaves', 'trim|required');
		
			
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('Leaves/approve_leaves/');
		}
		else
		{ 
			$userid = $this->input->post('userid');
			$status = 1;
			$selectedids = $this->input->post('leavelist');
			$data = array(
				'MLV_STATUS' => $status
			);
			$ldates = array();
			foreach($selectedids as $lid){
				$profileres = $this->Master_model->updatedata('MLV_ID', $lid, $data, 'mov_leaves');
				$leavedate = $this->Master_model->select_data('mov_leaves','MLV_DATE',"MLV_ID=".$lid."");
				array_push($ldates,$leavedate[0]->MLV_DATE);
			}
			print_r($profileres.'-'.$leavedate);
			if ($profileres > 0) {
				$data = $this->Master_model->select_data('mov_user_master','*',"MUM_ID=".$userid."");
				$config = get_email_data();     
				$this->email->initialize($config); 
				$from_email = 'NoReply'; 
				$to_email = $data[0]->MUM_Email; 
				
				$subject = "Leave approved Confirmation Mail";
				
				
				$this->email->from($from_email, 'Movinnza'); 
				$this->email->to($to_email);
				$this->email->subject($subject); 
				$message = 'Your Leave is approved for following dates:- <br/>';
				foreach($ldates as $val){
					$message .=''.date("d-F-Y l", strtotime($val)) .'<br/>';
				}

				$this->email->message($message); 
				if($this->email->send()){	
					$this->session->set_flashdata('success', "Leave approved Successfully!");				
					redirect('Leaves/approve_leaves/');
			   }
			   else{
					$this->session->set_flashdata('success', 'Leave approved Successfully! But Mail Not Send !');
					redirect('Leaves/approve_leaves/');
				}
			} else {
				$this->session->set_flashdata('error', 'Problem With Update!');
				redirect('Leaves/approve_leaves/');
			}
													
		}	
	}
	

}
?>
