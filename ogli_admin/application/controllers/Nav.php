<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nav extends CI_Controller 
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
	public function index()
	{
		//$this->load->view('login');
	}
	
	 public function manage_websites()
	 {	if(!in_array("Manage Website",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
	 	$website = $this->session->userdata('website');
	 	$dataselect['website'] = $this->Master_model->select_data('mov_website','*','');
	 	$this->load->view('manage_websites',$dataselect);}
	 }
	public function lov()
	{
		//print_r($page);exit;
		if(!in_array("List Of Value",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$lov['lovinfo'] = $this->Master_model->select_data('mov_lov','*','');
		$this->load->view('list-of-value',$lov);}
	}
	public function dashboard()
	{
		if(!in_array("Dashboard",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->view('home');}
	}

	public function manual_order()
	{
		$this->load->view('mannual_order');
	}
	
	public function search_user()
	{
		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('website','website','trim');
		$this->form_validation->set_rules('status','Status','trim');
		if($this->form_validation->run()){
				$search = $this->input->post('search');
				$filter = $this->input->post('filter');
			
				
			
				$website = $this->input->post('website');
				$status = $this->input->post('status');
				$query = $search.'-'.$filter.'-'.$website.'-'.$status;
				$query  = base64_encode($query);
				redirect("Nav/manage_user/$query");
		}	
	}
	
	
	public function manage_user($querydata)
	{
		if(!in_array("Administrator",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$sess_role = $this->session->userdata('role');
		$sess_uid = $this->session->userdata('id');
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		if($sess_role == '1'){
			$where = "MUM_User_type in ('1','2','3','4')";
		}
		else{
			$where = "MUM_ID = ".$sess_uid." ";
		}
			
		if($querydata != 'no'){
			$q = explode('-',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$website = $q[2];
			$status = $q[3];
			
			if($filter == 'MUM_ID'){
				$search	= str_replace('u','',$search);
				$search	= str_replace('U','',$search);
			}
			
			
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['website'] = $q[2];
			$lov['status'] = $q[3];	
			
			//$web = $website != ''?" and MWM_ID = $website":''; 
			$cur_status = $status != ''?" and MUM_status = '$status'":''; 
			
			//filter
			//echo $filter; exit;
			$filterval = "";
			if($filter == 'client'){ $filterval = "  MUM_User_type = '2'"; }
			if($filter == 'procod'){ $filterval = "  MUM_User_type = '3'"; }
			
			if($filter == 'client' || $filter == 'procod'){
				$where .= " and  $filterval $cur_status"; 
			}
			else{			
			if($q[0] != ''){
				$where .= " and  $filter like '%$search%' $cur_status"; 
			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
			}
		}else{
			
			$where  .= " and MUM_status = '1' ";
			$lov['search'] = '';
			$lov['filter'] = '';
			$lov['website'] = '';
			$lov['status'] = '1';
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_user/$querydata"), 
			'per_page' => 50,
			'total_rows' =>$this->Master_model->user_count("MUM_ID","mov_user_master",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
		$this->pagination->initialize($config);	
			
		$this->pagination->initialize($config);
		$lov['listofuser'] = $this->Master_model->user_data('*','mov_user_master',$where,$config['per_page'],$this->uri->segment(4));//user type 2 means customer
		//echo $this->db->last_query(); die();
		$this->load->view('manage_user',$lov);	
		}
	}
	
	
	public function nichecat()
	{
		//print_r($page);exit;
		if(!in_array("Category",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$seocat['nichecatinfo'] = $this->Master_model->select_data('mov_niche_category','*','');
		$this->load->view('niche-category',$seocat);}
	}
	
	public function search_client_master(){
		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('status','Status','trim');
		
		if($this->form_validation->run()){
			$search = $this->input->post('search');
			$filter = $this->input->post('filter');
			$status = $this->input->post('status');	
			
			$query = $search.'-'.$filter.'-'.$status;
			$query = base64_encode($query);
			redirect("Nav/manage_clients/$query");
			
		}else{
			$this->session->set_flashdata('error',validation_errors());
			redirect('Nav/manage_clients');
		}
	}

	
	public function manage_clients($querydata)
	{
		if(!in_array("Clients",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		$where = "MC_cl_id <> '0'";
		if($querydata != 'no'){
			$q = explode('-',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
		
			$cur_status = $status != ''?" and MC_cl_status = '".$status."'":''; 
			if($status == 2){ $cur_status = " and MC_cl_status <>'". $status."'"; }

			if($q[0] != ''){
				$where .= " and  $filter like '%$search%' $cur_status"; 
			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
		}else{
			
			$where  .= " and MC_cl_status = '1'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '1';	
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_clients/$querydata"), 
			'per_page' => 10,
			'total_rows' =>$this->Master_model->user_count("MC_cl_id","mov_clients",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>', 
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
			
		$this->pagination->initialize($config);
		$whereorder = $where.' order by MC_cl_id desc';
		$lov['clients'] = $this->Master_model->user_data('*','mov_clients',$whereorder,$config['per_page'],$this->uri->segment(4));
		//echo $this->db->last_query(); //die();
		//$lov['totalclients'] = $this->Master_model->user_count("MC_cl_id","mov_clients",$whereorder);
		
		$this->load->view('manage_clients',$lov);	
		}
	}

	public function search_product_master(){
		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('status','Status','trim');
		
		if($this->form_validation->run()){
			$search = $this->input->post('search');
			$filter = $this->input->post('filter');
			$fltcond = 1;
			if($filter == 'MNC_cat_id'){
				$fltcond = 5;
				$search = $this->input->post('catid');
			}
			$status = $this->input->post('status');	
			
			$query = $search.'-'.$filter.'-'.$status.'-'.$fltcond;
			$query = base64_encode($query);
			redirect("Nav/manage_product/$query");
			
		}else{
			$this->session->set_flashdata('error',validation_errors());
			redirect('Nav/manage_product');
		}
	}

	public function manage_product($querydata)
	{
		if(!in_array("Product",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		$uid = $this->session->userdata('id');
		$whrusrchk = "";
		$where = "MP_ProID <> '0' $whrusrchk";
		if($querydata != 'no'){
			$q = explode('-',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			$fltcond = $q[3];
			
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
		
			$cur_status = $status != ''?" and MP_status = '".$status."'":''; 
			if($status == 2){ $cur_status = " and MP_status <>'".$status."'"; }

			if($q[0] != ''){
				if($fltcond == 2){
				$where .= " and  $filter = '$search' $cur_status"; 	
				}
				$where .= " and  $filter like '%$search%' $cur_status"; 	

			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
		}else{
			
			$where  .= " and MP_status <> '2'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '2';	
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_product/$querydata"), 
			'per_page' => 50,
			'total_rows' =>$this->Master_model->user_count("MP_ProID","mov_products",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
			
		$this->pagination->initialize($config);
		$whereorder = $where.' order by MP_ProID desc';
		$lov['projectdts'] = $this->Master_model->user_data('*','mov_products',$whereorder,$config['per_page'],$this->uri->segment(4));
		//echo $this->db->last_query(); die();
		//$lov['totalprojectdts'] = $this->Master_model->user_count("MP_ProID","mov_products",$whereorder);
		
		$this->load->view('manage_product',$lov);	
		}
	}

	public function search_order_master(){
		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('status','Status','trim');
		
		if($this->form_validation->run()){
			$search = $this->input->post('search');
			$filter = $this->input->post('filter');
			
			$status = $this->input->post('status');	
			
			$query = $search.'-'.$filter.'-'.$status.'-'.$fltcond;
			$query = base64_encode($query);
			redirect("Nav/manage_order/$query");
			
		}else{
			$this->session->set_flashdata('error',validation_errors());
			redirect('Nav/manage_order');
		}
	}

	public function manage_order($querydata)
	{
		if(!in_array("Order",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		$uid = $this->session->userdata('id');
		$whrusrchk = "";
		$where = "MOR_id <> '0' $whrusrchk";
		if($querydata != 'no'){
			$q = explode('-',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			$fltcond = $q[3];
			
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
		
			$cur_status = $status != ''?" and MOR_booking_status = '".$status."'":''; 
			if($status == 3){ $cur_status = " and MOR_booking_status <>'".$status."'"; }

			if($q[0] != ''){
				if($fltcond == 2){
				$where .= " and  $filter = '$search' $cur_status"; 	
				}
				$where .= " and  $filter like '%$search%' $cur_status"; 	

			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
		}else{
			
			$where  .= " and MOR_booking_status <> '3'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '3';	
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_order/$querydata"), 
			'per_page' => 50,
			'total_rows' =>$this->Master_model->user_count("MOR_id","mov_order",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
			
		$this->pagination->initialize($config);
		$whereorder = $where.' order by MOR_id desc';
		$lov['projectdts'] = $this->Master_model->user_data('*','mov_order',$whereorder,$config['per_page'],$this->uri->segment(4));

		$this->load->view('manage_order',$lov);	
		}
	}


	public function add_portfolio()
    {
        if (!in_array("Manage Portfolio", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $this->load->view("add_portfolio");
        }
	}
	
	public function edit_portfolio($editid = 0, $search = 'bm8=', $page = 0)
    {
		$id = $this->session->userdata('id');
		$editdata['editproject'] = $this->Master_model->select_row('mov_portfolio', '*', "MP_Id =$editid");
		$editdata['searchval'] = $search;
		$editdata['pageval'] = $page;
		$editdata['data'] = $this->Master_model->select_data('mov_portfolio_images', '*', "MP_Id =$editid");
		$this->load->view('edit_portfolio', $editdata);
       
    }
	

	public function search_portfolio_master(){
		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('status','Status','trim');
		if($this->form_validation->run()){
			$search = $this->input->post('search');
			$filter = $this->input->post('filter');
			$status = $this->input->post('status');	
			$query = $search.'-'.$filter.'-'.$status.'-'.$fltcond;
			$query = base64_encode($query);
			redirect("Nav/manage_portfolio/$query");
		}else{
			$this->session->set_flashdata('error',validation_errors());
			redirect('Nav/manage_portfolio');
		}
	}

	public function manage_portfolio($querydata)
	{
		if(!in_array("Order",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		$uid = $this->session->userdata('id');
		$whrusrchk = "";
		$where = "MP_Id <> '0' $whrusrchk";
		if($querydata != 'no'){
			$q = explode('-',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			$fltcond = $q[3];
			
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
		
			$cur_status = $status != ''?" and MP_Status = '".$status."'":''; 
			if($status == 2){ $cur_status = " and MP_Status <>'".$status."'"; }

			if($q[0] != ''){
				if($fltcond == 2){
				$where .= " and  $filter = '$search' $cur_status"; 	
				}
				$where .= " and  $filter like '%$search%' $cur_status"; 	

			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
		}else{
			
			$where  .= " and MP_Status <> '2'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '2';	
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_portfolio/$querydata"), 
			'per_page' => 50,
			'total_rows' =>$this->Master_model->user_count("MP_Id","mov_portfolio",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
			
		$this->pagination->initialize($config);
		$whereorder = $where.' order by MP_Id desc';
		$lov['projectdts'] = $this->Master_model->user_data('*','mov_portfolio',$whereorder,$config['per_page'],$this->uri->segment(4));

		$this->load->view('manage_portfolio',$lov);	
		}
	}

	public function deleteportfolio(){	
		$this->form_validation->set_rules('delid','Delete Link','trim');
		if($this->form_validation->run()==FALSE){
				 echo validation_errors();
		}else{
			$delid = $this->input->post('delid');
				$this->Master_model->deletedatawhere("MP_Id=$delid",'mov_portfolio');
			echo 'yes';
		}
	}


	public function search_appointment_master(){
		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('status','Status','trim');
		
		if($this->form_validation->run()){
			$search = $this->input->post('search');
			$filter = $this->input->post('filter');
			$fltcond = 1;
			if($filter == 'MC_cl_id'){
				$fltcond = 2;
				$search = $this->input->post('clientid');
			}
			else if($filter == 'MA_assignto'){
				$fltcond = 3;
				$search = $this->input->post('assigntoid');
			}
			else if($filter == 'MA_start_datetime' || $filter == 'MA_end_datetime'){
				$fltcond = 4;
				$search = $this->input->post('searchdate');
			}
			
			

			$status = $this->input->post('status');	
			
			$query = $search.'#'.$filter.'#'.$status.'#'.$fltcond;
			$query = base64_encode($query);
			redirect("Nav/manage_appointment/$query");
			
		}else{
			$this->session->set_flashdata('error',validation_errors());
			redirect('Nav/manage_appointment');
		}
	}


	public function manage_appointment($querydata)
	{
		if(!in_array("Manage Appointment",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		
		$id = $this->session->userdata('id');
		$whrprojchk = "";
		// $wheressub = " and (find_in_set('".$id."',MP_assignto_seo) or find_in_set('".$id."',MP_assignto_devlopment))";
		// $projectids = $this->db->query("SELECT `MP_ProID` FROM mov_projects where `MP_ProID`<> '' and `MP_ProID`<> 0  ".$wheressub." ORDER BY `MP_ProID` ASC");
		// $projectvalue = $projectids->result_array();
		// $projectvaluecomma = implode(',', array_column($projectvalue, 'MP_ProID'));
		// $whrprojchk = " and  `MP_ProID` IN(" . $projectvaluecomma . ") ";
		

		$wheretask ="";
		$checkusertype = $this->Master_model->select_row('mov_user_master','*',['MUM_ID'=>$id]);
		if(isset($checkusertype)){	
			//if($checkusertype->MUM_User_type == 4){
				
				$wheretask .= ' and find_in_set(' . $id . ',MA_assignto)';
				// $subuser = $checkusertype->MUM_Subuser_Access_Permission;
				// if($subuser != ''){
				// 	$wheretask = 'and ((find_in_set(' . $id . ',MT_ts_primary_assign) OR find_in_set(' . $id . ',MT_ts_secondary_assign)) OR (find_in_set(' . $subuser . ',MT_ts_primary_assign) OR find_in_set(' . $subuser . ',MT_ts_secondary_assign)))';
				// }
			//}
		}
		if($id == 1 ||  $id == 4 || $id == 7 || $id == 3){
			$whrprojchk = "";
			$wheretask ="";
		}

		 $where = "MA_id <> 0 and (MA_status = 0 or MA_status = 1) $whrprojchk $wheretask";
		//$where = "MT_ts_id <> 0 $whrprojchk $wheretask";
		if($querydata != 'no'){
			$q = explode('#',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			$fltcond = $q[3];
			//print_r($search);
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
		
			$cur_status = $status != ''?" and MA_status ='". $status."'":'';
			if($status == 3){ $cur_status = " and MA_status <>'". $status."'"; }

			if($q[0] != ''){
				$where .= " and  $filter like '%$search%' $cur_status"; 	

			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
		}else{
			
			$where  .= " and MA_status <> '4'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '3';	
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_appointment/$querydata"), 
			'per_page' => 50,
			'total_rows' =>$this->Master_model->user_count("MA_id","mov_appointment",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
			
		$this->pagination->initialize($config);
		$ordrby = " Order by `MA_UpdatedDate` DESC ";
		$lov['appointmentdts'] = $this->Master_model->user_data('*','mov_appointment',$where.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		//echo $this->db->last_query(); die();
		// $wherehigh = " and MT_priority = '2'";
		// $lov['taskdtshigh'] = $this->Master_model->user_data('*','mov_task',$where.$wherehigh.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		// $lov['totaltaskhigh'] = $this->Master_model->user_count("MT_ts_id","mov_task",$where.$wherehigh.''.$ordrby);
		
		// $wheremid = " and MT_priority = '1'";
		// $lov['taskdtsmid'] = $this->Master_model->user_data('*','mov_task',$where.$wheremid.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		// $lov['totaltaskmid'] = $this->Master_model->user_count("MT_ts_id","mov_task",$where.$wheremid.''.$ordrby);
		
		// $wherelow = " and MT_priority = '0'";
		// $lov['taskdtslow'] = $this->Master_model->user_data('*','mov_task',$where.$wherelow.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		// $lov['totaltasklow'] = $this->Master_model->user_count("MT_ts_id","mov_task",$where.$wherelow.''.$ordrby);
		
					
		$whereworking =" (MA_status = '0' OR MA_status = '1')";
		$lov['totaltaskdts'] = $this->Master_model->user_count("MA_id","mov_appointment",$whereworking);
		//echo $this->db->last_query(); die();
		$wherecompl =" MA_status = '2' ";
		$lov['totalcompltaskd'] = $this->Master_model->user_count("MA_id","mov_appointment",$wherecompl);
		$wherenew =" MA_status = '0' AND MA_CreatedDate > DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ";
		$lov['totalnewtaskd'] = $this->Master_model->user_count("MA_id","mov_appointment",$wherenew);
		
		
		
		
		
		
		$wheretodaystask =" and find_in_set(date_format(curdate(), '%Y-%m-%d'), `MA_start_datetime`) > '0' ";
		$lov['appointmentdtstodays'] = $this->Master_model->user_data('*','mov_appointment',$where.$wheretodaystask.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		//echo $this->db->last_query(); die();

		$wherethisweektask =" and WEEKOFYEAR(`MA_start_datetime`) = WEEKOFYEAR(NOW()) and find_in_set(date_format(curdate(), '%Y-%m-%d'), `MA_start_datetime`) = '0' ";
		$lov['appointmentdtsthisweek'] = $this->Master_model->user_data('*','mov_appointment',$where.$wherethisweektask.''.$ordrby,$config['per_page'],$this->uri->segment(4));

		$wherenextweektask =" and WEEKOFYEAR(`MA_start_datetime`) = WEEKOFYEAR(NOW() + INTERVAL 7 DAY) and find_in_set(date_format(curdate(), '%Y-%m-%d'), `MA_start_datetime`) = '0' ";
		$lov['appointmentdtsnextweek'] = $this->Master_model->user_data('*','mov_appointment',$where.$wherenextweektask.''.$ordrby,$config['per_page'],$this->uri->segment(4));


		
		$wherefollowuptask =" and find_in_set(date_format(curdate(), '%Y-%m-%d'), `MA_followup_dates`) > '0' ";
		$lov['appointmentdtsfollowup'] = $this->Master_model->user_data('*','mov_appointment',$where.$wherefollowuptask.''.$ordrby,$config['per_page'],$this->uri->segment(4));

		$this->load->view('manage_appointment',$lov);	
		}
	}

	public function search_view_appointment_master(){
		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('status','Status','trim');
		
		if($this->form_validation->run()){
			$search = $this->input->post('search');
			$filter = $this->input->post('filter');
			$fltcond = 1;
			if($filter == 'MC_cl_id'){
				$fltcond = 2;
				$search = $this->input->post('clientid');
			}
			else if($filter == 'MA_assignto'){
				$fltcond = 3;
				$search = $this->input->post('assigntoid');
			}
			else if($filter == 'MA_start_datetime' || $filter == 'MA_end_datetime'){
				$fltcond = 4;
				$search = $this->input->post('searchdate');
			}
			
			

			$status = $this->input->post('status');	
			
			$query = $search.'#'.$filter.'#'.$status.'#'.$fltcond;
			$query = base64_encode($query);
			redirect("Nav/view_appointment/$query");
			
		}else{
			$this->session->set_flashdata('error',validation_errors());
			redirect('Nav/view_appointment');
		}
	}


	public function view_appointment($querydata)
	{
		if(!in_array("Manage Appointment",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		
		$id = $this->session->userdata('id');
		$whrprojchk = "";
		// $wheressub = " and (find_in_set('".$id."',MP_assignto_seo) or find_in_set('".$id."',MP_assignto_devlopment))";
		// $projectids = $this->db->query("SELECT `MP_ProID` FROM mov_projects where `MP_ProID`<> '' and `MP_ProID`<> 0  ".$wheressub." ORDER BY `MP_ProID` ASC");
		// $projectvalue = $projectids->result_array();
		// $projectvaluecomma = implode(',', array_column($projectvalue, 'MP_ProID'));
		// $whrprojchk = " and  `MP_ProID` IN(" . $projectvaluecomma . ") ";
		

		$wheretask ="";
		$checkusertype = $this->Master_model->select_row('mov_user_master','*',['MUM_ID'=>$id]);
		if(isset($checkusertype)){	
			//if($checkusertype->MUM_User_type == 4){
				
				$wheretask .= ' and find_in_set(' . $id . ',MA_assignto)';
				// $subuser = $checkusertype->MUM_Subuser_Access_Permission;
				// if($subuser != ''){
				// 	$wheretask = 'and ((find_in_set(' . $id . ',MT_ts_primary_assign) OR find_in_set(' . $id . ',MT_ts_secondary_assign)) OR (find_in_set(' . $subuser . ',MT_ts_primary_assign) OR find_in_set(' . $subuser . ',MT_ts_secondary_assign)))';
				// }
			//}
		}
		if($id == 1 ||  $id == 4 || $id == 7 || $id == 3){
			$whrprojchk = "";
			$wheretask ="";
		}

		 $where = "MA_id <> 0 and (MA_status = 0 or MA_status = 1) $whrprojchk $wheretask";
		//$where = "MT_ts_id <> 0 $whrprojchk $wheretask";
		if($querydata != 'no'){
			$q = explode('#',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			$fltcond = $q[3];
			//print_r($search);
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
		
			$cur_status = $status != ''?" and MA_status ='". $status."'":'';
			if($status == 3){ $cur_status = " and MA_status <>'". $status."'"; }

			if($q[0] != ''){
				$where .= " and  $filter like '%$search%' $cur_status"; 	

			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
		}else{
			
			$where  .= " and MA_status <> '5'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '3';	
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_appointment/$querydata"), 
			'per_page' => 50,
			'total_rows' =>$this->Master_model->user_count("MA_id","mov_appointment",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
			
		$this->pagination->initialize($config);
		$ordrby = " Order by `MA_UpdatedDate` DESC ";
		$lov['appointmentdts'] = $this->Master_model->user_data('*','mov_appointment',$where.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		//echo $this->db->last_query(); die();
		// $wherehigh = " and MT_priority = '2'";
		// $lov['taskdtshigh'] = $this->Master_model->user_data('*','mov_task',$where.$wherehigh.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		// $lov['totaltaskhigh'] = $this->Master_model->user_count("MT_ts_id","mov_task",$where.$wherehigh.''.$ordrby);
		
		// $wheremid = " and MT_priority = '1'";
		// $lov['taskdtsmid'] = $this->Master_model->user_data('*','mov_task',$where.$wheremid.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		// $lov['totaltaskmid'] = $this->Master_model->user_count("MT_ts_id","mov_task",$where.$wheremid.''.$ordrby);
		
		// $wherelow = " and MT_priority = '0'";
		// $lov['taskdtslow'] = $this->Master_model->user_data('*','mov_task',$where.$wherelow.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		// $lov['totaltasklow'] = $this->Master_model->user_count("MT_ts_id","mov_task",$where.$wherelow.''.$ordrby);
		
					
		// $whereworking =" (MA_status = '0' OR MA_status = '1')";
		// $lov['totaltaskdts'] = $this->Master_model->user_count("MA_id","mov_appointment",$whereworking);
		// //echo $this->db->last_query(); die();
		// $wherecompl =" MA_status = '2' ";
		// $lov['totalcompltaskd'] = $this->Master_model->user_count("MA_id","mov_appointment",$wherecompl);
		// $wherenew =" MA_status = '0' AND MA_CreatedDate > DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ";
		// $lov['totalnewtaskd'] = $this->Master_model->user_count("MA_id","mov_appointment",$wherenew);
		
		
		
		
		
		
		// $wheretodaystask =" and find_in_set(date_format(curdate(), '%Y-%m-%d'), `MA_start_datetime`) > '0' ";
		// $lov['appointmentdtstodays'] = $this->Master_model->user_data('*','mov_appointment',$where.$wheretodaystask.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		// //echo $this->db->last_query(); die();

		// $wherethisweektask =" and WEEKOFYEAR(`MA_start_datetime`) = WEEKOFYEAR(NOW()) and find_in_set(date_format(curdate(), '%Y-%m-%d'), `MA_start_datetime`) = '0' ";
		// $lov['appointmentdtsthisweek'] = $this->Master_model->user_data('*','mov_appointment',$where.$wherethisweektask.''.$ordrby,$config['per_page'],$this->uri->segment(4));

		// $wherenextweektask =" and WEEKOFYEAR(`MA_start_datetime`) = WEEKOFYEAR(NOW() + INTERVAL 7 DAY) and find_in_set(date_format(curdate(), '%Y-%m-%d'), `MA_start_datetime`) = '0' ";
		// $lov['appointmentdtsnextweek'] = $this->Master_model->user_data('*','mov_appointment',$where.$wherenextweektask.''.$ordrby,$config['per_page'],$this->uri->segment(4));


		
		$wherefollowuptask =" and find_in_set(date_format(curdate(), '%Y-%m-%d'), `MA_followup_dates`) > '0' ";
		$lov['appointmentdtsfollowup'] = $this->Master_model->user_data('*','mov_appointment',$where.$wherefollowuptask.''.$ordrby,$config['per_page'],$this->uri->segment(4));

		$this->load->view('view_appointment',$lov);	
		}
	}

	
	
	public function search_manage_enquiry(){
		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('status','Status','trim');
		$this->form_validation->set_rules('result','result','trim');
		
		if($this->form_validation->run()){
			$search = $this->input->post('search');
			$filter = $this->input->post('filter');		
			$fltcond = 1;
			if($filter == 'MEnq_assigned_to'){
				$fltcond = 2;
				$search = $this->input->post('sentbyid');
			}
			
			
			$status = $this->input->post('status');	
			$result = $this->input->post('result');	
			
			$query = $search.'-'.$filter.'-'.$status.'-'.$result.'-'.$fltcond;
			$query = base64_encode($query);
			redirect("Nav/manage_enquiry/$query");
			
		}else{
			$this->session->set_flashdata('error',validation_errors());
			redirect('Nav/manage_enquiry');
		}
	}


	public function manage_enquiry($querydata)
	{
		if(!in_array("Manage Enquiry",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
			
		
		$whrusrchk = "";
			
			
		$where = "MEnq_id <> '0' $whrusrchk";
		if($querydata != 'no'){
			$q = explode('-',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			$result = $q[3];
			$fltcond = $q[4];
			
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
			$lov['result'] = $q[3];	
		
			$cur_status = $status != ''?" and MEnq_status = '".$status."'":''; 
			if($status == 10){ $cur_status = " and MEnq_status <> '".$status."'"; }
			
			if($q[0] != ''){
				$where .= " and  $filter like '%$search%' $cur_status"; 
			}else if($cur_status != ''){
				$where .= $cur_status; 
			}
			
			
		}else{
			$result = '50';
			$where  .= " and MEnq_status <> '10'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '10';	
			$lov['result'] = $result;	
		}
		$querydata = base64_encode($querydata);
		$total_rows=$this->Master_model->user_count("MEnq_id","mov_enquiry",$where);
		$config = [
			'base_url' => base_url("Nav/manage_enquiry/$querydata"), 
			'per_page' => $result,
			'total_rows' =>$total_rows,
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
		$whereorder = $where.' order by MEnq_id desc';	
		$this->pagination->initialize($config);
		$lov['contentwriterdts'] = $this->Master_model->user_data('*','mov_enquiry',$whereorder,$config['per_page'],$this->uri->segment(4));
		//echo $this->db->last_query(); die();
		$lov['encdbquery'] = base64_encode($this->db->last_query());
		$lov['totalcontentwriterdts'] = $this->Master_model->user_count("MEnq_id","mov_enquiry",$whereorder);
		
		$this->load->view('manage_enquiry',$lov);	
		}
	}


	public function search_manage_promotion(){
		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('status','Status','trim');
		
		if($this->form_validation->run()){
			$search = $this->input->post('search');
			$filter = $this->input->post('filter');
			$status = $this->input->post('status');	
			
			$query = $search.'-'.$filter.'-'.$status;
			$query = base64_encode($query);
			redirect("Nav/manage_promotion/$query");
			
		}else{
			$this->session->set_flashdata('error',validation_errors());
			redirect('Nav/manage_promotion');
		}
	}

	
	public function manage_promotion($querydata)
	{
		if(!in_array("Manage Promotions",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		$where = "Mprm_ID <> '0'";
		if($querydata != 'no'){
			$q = explode('-',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
		
			$cur_status = $status != ''?" and Mprm_Status = '".$status."'":''; 
			if($status == 2){ $cur_status = " and Mprm_Status <>'". $status."'"; }

			if($q[0] != ''){
				$where .= " and  $filter like '%$search%' $cur_status"; 
			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
		}else{
			
			$where  .= " and Mprm_Status = '1'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '1';	
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_promotion/$querydata"), 
			'per_page' => 10,
			'total_rows' =>$this->Master_model->user_count("Mprm_ID","mov_promocode",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>', 
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
			
		$this->pagination->initialize($config);
		$whereorder = $where.' order by Mprm_ID desc';
		$lov['clients'] = $this->Master_model->user_data('*','mov_promocode',$whereorder,$config['per_page'],$this->uri->segment(4));
		//echo $this->db->last_query(); //die();
		//$lov['totalclients'] = $this->Master_model->user_count("MC_cl_id","mov_clients",$whereorder);
		
		$this->load->view('manage_promotion',$lov);	
		}
	}





	public function search_sales_report(){
		$this->form_validation->set_rules('from_date','From Date','trim|required');
		$this->form_validation->set_rules('to_date','To Date','trim|required');
		$this->form_validation->set_rules('website','Website','trim');
		$this->form_validation->set_rules('selectdate','selectdate','trim');
		
		if($this->form_validation->run()){
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$website = $this->input->post('website');
			$selectdate = $this->input->post('selectdate');
			//$website_country = $this->session->userdata('websitecountry');
			//$alter_sql = $website != ''?" and flr_orders.FWCM_ID = $website":" and flr_orders.FWCM_ID in (".$website_country.")";
			$query = "DATE(MOR_payment_date) between '".$from_date."' and '".$to_date."' ";
			$query .= "@$selectdate,$from_date,$to_date,$website";
			//echo $query;exit;
			$query = base64_encode($query);
			redirect("Nav/sales_report/$query");
			
		}else{
			$this->session->set_flashdata('',validation_errors());
			redirect('Nav/sales_report');
		}
	}
	
	public function sales_report($querydata='bm8='){
		$querydata = base64_decode($querydata);
		//echo $querydata;exit;
		$frontdata = array();
		//$website_country = $this->session->userdata('websitecountry');
		if($querydata == 'no'){
			//echo "$querydata"; die();
			//$website_country_in = str_replace(",","','",$website_country);
			$query = "DATE(MOR_payment_date) between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
			$order['selectdate'] = 'today';
			$order['from_date'] = date('Y-m-d');
			$order['to_date'] = date('Y-m-d');
			$order['website'] = '';
		}else{
			//echo " ! $querydata"; die();
			$salesdata = explode('@',$querydata);
			$query =$salesdata[0];
			//print_r($salesdata);
			$frontdata = explode(',',$salesdata[1]);
			$order['selectdate'] = $frontdata[0];
			$order['from_date'] = $frontdata[1];
			$order['to_date'] = $frontdata[2];
			$order['website'] = $frontdata[3];
		}
		$this->load->model('Reports');
		$this->load->library('pagination');
		if(!in_array("Sales Report",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
			$q = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/sales_report/$q"), 
			'per_page' => 10,
			'total_rows' =>$this->Reports->sales_num_rows($query),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
		];
		
		$this->pagination->initialize($config);
		$order['listoforders']=$this->Reports->view_sales_report($query,$config['per_page'],$this->uri->segment(4));
		//	echo $this->db->last_query(); die();
		//total order
		$order['totalorder'] = $this->Reports->sales_num_rows($query);
		$listall =$this->Reports->view_sales_report_all($query,1);
		//print_r($listall); exit;
		$order['listofallorders'] = $listall;
$overalltotal = 0; $gsttotal = 0; $gstprodtotal= 0; $prodtotal =0; 
		if(!empty($listall[0])){
			foreach($listall as $l){
				$orderplacedt = date("Y-m-d", strtotime($l->MOR_booking_date));
				$product_vat="0";
				$pricediscount = $l->MOR_total_amount;
				$tax = $pricediscount - ($pricediscount * 100 /($product_vat+100));
				$gstprodtotal += $tax;
				$prodtotal += $pricediscount;
			}
		}

		// $gsttotal = 
		// $overalltotal =

		$tbl = '';
		$tbl .= '<div class="table-responsive table-lg">
		<table class="table table-bordered table-hover">
		<thead>
		<tr class="textC">
		<th>Tattoo</th><th>Total</th></tr></thead>
		<tbody>
		<tr>	
		<td> Amount</td>
		<td>Rs. '.moneyFormatIndia(round($prodtotal)).'</td>
		</tr>
		<tr>
		
		<td> GST</td>
		<td>Rs. '.moneyFormatIndia(round($gstprodtotal)).'</td>
		</tr>
		</tbody>
		</table></div>';

		$order['tbl'] = $tbl;
			$this->load->view('sales_report',$order);

		}
	}

	public function sales_report_download(){
		if(!in_array("Sales Report Download",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->view('sales_report_download'); }
	}



	public function search_outstanding_report(){
		$this->form_validation->set_rules('from_date','From Date','trim|required');
		$this->form_validation->set_rules('to_date','To Date','trim|required');
		$this->form_validation->set_rules('website','Website','trim');
		$this->form_validation->set_rules('selectdate','selectdate','trim');
		
		if($this->form_validation->run()){
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$website = $this->input->post('website');
			$selectdate = $this->input->post('selectdate');
			//$website_country = $this->session->userdata('websitecountry');
			//$alter_sql = $website != ''?" and flr_orders.FWCM_ID = $website":" and flr_orders.FWCM_ID in (".$website_country.")";
			$query = "DATE(MOR_payment_date) between '".$from_date."' and '".$to_date."' ";
			$query .= "@$selectdate,$from_date,$to_date,$website";
			//echo $query;exit;
			$query = base64_encode($query);
			redirect("Nav/outstanding_report/$query");
			
		}else{
			$this->session->set_flashdata('',validation_errors());
			redirect('Nav/outstanding_report');
		}
	}
	
	public function outstanding_report($querydata='bm8='){
		$querydata = base64_decode($querydata);
		//echo $querydata;exit;
		$frontdata = array();
		//$website_country = $this->session->userdata('websitecountry');
		if($querydata == 'no'){
			//echo "$querydata"; die();
			//$website_country_in = str_replace(",","','",$website_country);
			$query = "DATE(MOR_payment_date) between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
			$order['selectdate'] = 'today';
			$order['from_date'] = date('Y-m-d');
			$order['to_date'] = date('Y-m-d');
			$order['website'] = '';
		}else{
			//echo " ! $querydata"; die();
			$salesdata = explode('@',$querydata);
			$query =$salesdata[0];
			//print_r($salesdata);
			$frontdata = explode(',',$salesdata[1]);
			$order['selectdate'] = $frontdata[0];
			$order['from_date'] = $frontdata[1];
			$order['to_date'] = $frontdata[2];
			$order['website'] = $frontdata[3];
		}
		$this->load->model('Reports');
		$this->load->library('pagination');
		if(!in_array("Outstanding Report",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
			$q = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/outstanding_report/$q"), 
			'per_page' => 10,
			'total_rows' =>$this->Reports->outstanding_num_rows($query),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
		];
		
		$this->pagination->initialize($config);
		$order['listoforders']=$this->Reports->view_outstanding_report($query,$config['per_page'],$this->uri->segment(4));
		//	echo $this->db->last_query(); die();
		//total order
		$order['totalorder'] = $this->Reports->outstanding_num_rows($query);
		$listall =$this->Reports->view_outstanding_report_all($query,2);
		//print_r($listall); exit;
		$order['listofallorders'] = $listall;
$overalltotal = 0; $paidamt = 0; $totalamt= 0; $outstandingamt =0; 
		if(!empty($listall[0])){
			foreach($listall as $l){
				$orderplacedt = date("Y-m-d", strtotime($l->MOR_booking_date));
				// $product_vat="20";
				$totalamt = $l->MOR_total_amount;
				$paidamt = $l->MOR_pay_amount;
				// $tax = $pricediscount - ($pricediscount * 100 /($product_vat+100));
				// $gstprodtotal += $tax;
				//$prodtotal += $pricediscount;
				$outstandingamt +=  $totalamt - $paidamt;
			}
		}

		// $gsttotal = 
		// $overalltotal =

		$tbl = '';
		$tbl .= '<div class="table-responsive table-lg">
		<table class="table table-bordered table-hover">
		<thead>
		<tr class="textC">
		<th>Tattoo</th><th>Total</th></tr></thead>
		<tbody>
		<tr>	
		<td>Outstanding Amount</td>
		<td>Rs. '.moneyFormatIndia(round($outstandingamt)).'</td>
		</tr>
		</tbody>
		</table></div>';

		$order['tbl'] = $tbl;
			$this->load->view('outstanding_report',$order);

		}
	}


	public function manage_page($querydata)
	{
		if(!in_array("Manage Page",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		
		$this->load->view('manage_page');	
		}
	}


	public function search_view_faq(){

		// echo "<pre>"; print_r($this->input->post());die();

		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('status','Status','trim');
		
		if($this->form_validation->run()){
			$search = $this->input->post('search');
			$filter = $this->input->post('filter');
			
			$status = $this->input->post('status');	

			if($filter == 'MQa_UpdatedDate' || $filter == 'MQa_CreatedDate'){
				$fltcond = 4;
				$search = $this->input->post('searchdate');
			}
			else if($filter == 'MM_ID'){
				$fltcond = 3;
				$search = $this->input->post('MM_ID');
			}

			$query = $search.'#'.$filter.'#'.$status.'#';
			$query = base64_encode($query);
			redirect("Nav/manage_faq/$query");
			
		}else{
			$this->session->set_flashdata('error',validation_errors());
			redirect('Nav/manage_faq');
		}
	}

	public function manage_faq($querydata)
	{
		if(!in_array("Manage FAQ",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		
		$id = $this->session->userdata('id');
		$whrprojchk = "";
		// $wheressub = " and (find_in_set('".$id."',MP_assignto_seo) or find_in_set('".$id."',MP_assignto_devlopment))";
		// $projectids = $this->db->query("SELECT `MP_ProID` FROM mov_projects where `MP_ProID`<> '' and `MP_ProID`<> 0  ".$wheressub." ORDER BY `MP_ProID` ASC");
		// $projectvalue = $projectids->result_array();
		// $projectvaluecomma = implode(',', array_column($projectvalue, 'MP_ProID'));
		// $whrprojchk = " and  `MP_ProID` IN(" . $projectvaluecomma . ") ";
		

		$wheretask ="";
		$checkusertype = $this->Master_model->select_row('mov_qa','*',['MQa_id'=>$id]);
		// if(isset($checkusertype)){	
		// 	//if($checkusertype->MUM_User_type == 4){
				
		// 		$wheretask .= ' and find_in_set(' . $id . ',MA_assignto)';
		// 		// $subuser = $checkusertype->MUM_Subuser_Access_Permission;
		// 		// if($subuser != ''){
		// 		// 	$wheretask = 'and ((find_in_set(' . $id . ',MT_ts_primary_assign) OR find_in_set(' . $id . ',MT_ts_secondary_assign)) OR (find_in_set(' . $subuser . ',MT_ts_primary_assign) OR find_in_set(' . $subuser . ',MT_ts_secondary_assign)))';
		// 		// }
		// 	//}
		// }
		// if($id == 1 ||  $id == 4 || $id == 7 || $id == 3){
		// 	$whrprojchk = "";
		// 	$wheretask ="";
		// }

		 $where = "MQa_id <> 0 and (MQa_status = 0 or MQa_status = 1) $whrprojchk $wheretask";
		//$where = "MT_ts_id <> 0 $whrprojchk $wheretask";
		if($querydata != 'no'){
			$q = explode('#',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			$fltcond = $q[3];
			//print_r($search);
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
		
			$cur_status = $status != ''?" and MQa_status ='". $status."'":'';
			if($status == 3){ $cur_status = " and MQa_status <>'". $status."'"; }

			if($q[0] != ''){
				$where .= " and  $filter like '%$search%' $cur_status"; 	

			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
		}else{
			
			$where  .= " and MQa_status <> '5'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '3';	
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_faq/$querydata"), 
			'per_page' => 50,
			'total_rows' =>$this->Master_model->user_count("MQa_id","mov_qa",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
			
		$this->pagination->initialize($config);
		$ordrby = " Order by `MQa_UpdatedDate` DESC ";
		$lov['faqs'] = $this->Master_model->user_data('*','mov_qa',$where.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		//echo $this->db->last_query(); die();
		
		$this->load->view('manage_faq',$lov);	
		}
	}

	public function search_view_influencer(){

	//  echo "<pre>"; print_r($this->input->post());die();

	   $this->form_validation->set_rules('search','Search','trim');
	   $this->form_validation->set_rules('filter','filter','trim');
	   $this->form_validation->set_rules('status','Status','trim');
	   
	   if($this->form_validation->run()){
		   $search = $this->input->post('search');
		   $filter = $this->input->post('filter');
		   
		   $status = $this->input->post('status');	

		   if($filter == 'Mflnc_Updated_Date' || $filter == 'Mflnc_Created_Date'){
			   $fltcond = 4;
			   $search = $this->input->post('searchdate');
		   }
		   else if($filter == 'MM_ID'){
			   $fltcond = 3;
			   $search = $this->input->post('MM_ID');
		   }
		   else if($filter == 'MNC_cat_id'){
			$fltcond = 3;
			$search = $this->input->post('MNC_cat_id');
		   }
		   else if($filter == 'Mprm_ID'){
			$fltcond = 3;
			$search = $this->input->post('Mprm_ID');
		   }
		   

		   $query = $search.'#'.$filter.'#'.$status.'#';
		   $query = base64_encode($query);
		   redirect("Nav/manage_influencer/$query");
		   
	   }else{
		   $this->session->set_flashdata('error',validation_errors());
		   redirect('Nav/manage_influencer');
	   }
   }

	public function manage_influencer($querydata)
	{
		if(!in_array("Manage Influencer",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		
		$id = $this->session->userdata('id');
		$whrprojchk = "";
	
		$wheretask ="";
		$checkusertype = $this->Master_model->select_row('mov_influencer','*',['Mflnc_id'=>$id]);
			
		 $where = "Mflnc_id <> 0 and (Mflnc_cat_status = 0 or Mflnc_cat_status = 1) $whrprojchk $wheretask";
		//$where = "MT_ts_id <> 0 $whrprojchk $wheretask";
		if($querydata != 'no'){
			$q = explode('#',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			$fltcond = $q[3];
			//print_r($search);
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
		
			$cur_status = $status != ''?" and Mflnc_cat_status ='". $status."'":'';
			if($status == 3){ $cur_status = " and Mflnc_cat_status <>'". $status."'"; }

			if($q[0] != ''){
				$where .= " and  $filter like '%$search%' $cur_status"; 	

			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
		}else{
			
			$where  .= " and Mflnc_cat_status <> '5'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '3';	
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_influencer/$querydata"), 
			'per_page' => 50,
			'total_rows' =>$this->Master_model->user_count("Mflnc_id","mov_influencer",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
			
		$this->pagination->initialize($config);
		$ordrby = " Order by `Mflnc_Updated_Date` DESC ";
		$lov['inflncr'] = $this->Master_model->user_data('*','mov_influencer',$where.''.$ordrby,$config['per_page'],$this->uri->segment(4));
		
		$this->load->view('manage_influencer',$lov);	
		}
	}


	public function search_view_internalhelp(){

		// echo "<pre>"; print_r($this->input->post());die();

		$this->form_validation->set_rules('search','Search','trim');
		$this->form_validation->set_rules('filter','filter','trim');
		$this->form_validation->set_rules('status','Status','trim');
		
		if($this->form_validation->run()){
			$search = $this->input->post('search');
			$filter = $this->input->post('filter');
			
			$status = $this->input->post('status');	
			
			if($filter == 'MIh_UpdatedDate' || $filter == 'MIh_CreatedDate'){
				$fltcond = 4;
				$search = $this->input->post('searchdate');
			}
			
			$query = $search.'#'.$filter.'#'.$status.'#';
			$query = base64_encode($query);
			redirect("Nav/manage_internalhelp/$query");
			
		}else{
			$this->session->set_flashdata('error',validation_errors());
			redirect('Nav/manage_internalhelp');
		}
	}

	public function manage_internalhelp($querydata)
	{
		
		if(!in_array("Manage Internalhelp",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$this->load->library('pagination');
		$querydata = base64_decode($querydata);
		$website_country = WEBCOUNTRY;
		
		$id = $this->session->userdata('id');
		$whrprojchk = "";
		
		$wheretask ="";
		$checkusertype = $this->Master_model->select_row('mov_internalhelp','*',['MIh_id'=>$id]);
	
		 $where = "MIh_id <> 0 and (MIh_status = 0 or MIh_status = 1) $whrprojchk $wheretask";
		//$where = "MT_ts_id <> 0 $whrprojchk $wheretask";
		if($querydata != 'no'){
			
			$q = explode('#',$querydata);
			$search = $q[0];
			$filter = $q[1];
			$status = $q[2];
			$fltcond = $q[3];
			//print_r($search);
			$lov['search'] = $q[0];
			$lov['filter'] = $q[1];
			$lov['status'] = $q[2];	
		
			$cur_status = $status != ''?" and MIh_status ='". $status."'":'';
			if($status == 3){ $cur_status = " and MIh_status <>'". $status."'"; }

			if($q[0] != ''){
				$where .= " and  $filter like '%$search%' $cur_status"; 	

			}else if($cur_status != ''){
				$where .= "$cur_status"; 
			}
		}else{
			
			$where  .= " and MIh_status <> '5'";
			$lov['search'] = '';
			$lov['filter'] = '';	
			$lov['status'] = '3';	
		}
		$querydata = base64_encode($querydata);
		$config = [
			'base_url' => base_url("Nav/manage_internalhelp/$querydata"), 
			'per_page' => 50,
			'total_rows' =>$this->Master_model->user_count("MIh_id","mov_internalhelp",$where),
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'first_tag_open' => '<li>',
			'uri_segment' => 4,
			'first_tag_close' => '</li>',
			'first_link' => 'first',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'last_link' => 'last',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a>',
			'cur_tag_close' => '</a></li>'
			
		];
		
			
		$this->pagination->initialize($config);
		$ordrby = " Order by `MIh_UpdatedDate` DESC ";
		$lov['internalhelps'] = $this->Master_model->user_data('*','mov_internalhelp',$where.''.$ordrby,$config['per_page'],$this->uri->segment(4));
			$this->load->view('manage_internalhelp',$lov);	
		}
	}


	/* ********************Quality Check Module Code Start Here******************* */
	
	public function search_view_quality(){

	    // echo "<pre>"; print_r($this->input->post());die();
	
		   $this->form_validation->set_rules('search','Search','trim');
		   $this->form_validation->set_rules('filter','filter','trim');
		   $this->form_validation->set_rules('status','Status','trim');
		   
		   if($this->form_validation->run()){
			   $search = $this->input->post('search');
			   $filter = $this->input->post('filter');
			   
			   $status = $this->input->post('status');	
	
			   if($filter == 'Mqua_UpdatedDate' || $filter == 'Mqua_CreatedDate'){
				   $fltcond = 4;
				   $search = $this->input->post('searchdate');
			   }
			   else if($filter == 'Mqua_checkby'){
				   $fltcond = 3;
				   $search = $this->input->post('Mqua_checkby');
			   }
			   else if($filter == 'MUM_ID'){
				$fltcond = 3;
				$search = $this->input->post('MUM_ID');
				}
				else if($filter == 'ML_ID'){
					$fltcond = 3;
					$search = $this->input->post('ML_ID');
				}
	
			   $query = $search.'#'.$filter.'#'.$status.'#';
			   $query = base64_encode($query);
			   redirect("Nav/manage_quality/$query");
			   
		   }else{
			   $this->session->set_flashdata('error',validation_errors());
			   redirect('Nav/manage_quality');
		   }
	   }
	
		public function manage_quality($querydata)
		{
			//    echo "<pre>"; print_r($this->input->post());die();
			if(!in_array("Manage Quality",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
			$this->load->library('pagination');
			$querydata = base64_decode($querydata);
			$website_country = WEBCOUNTRY;
			
			$id = $this->session->userdata('id');
			$whrprojchk = "";
		
			$wheretask ="";
			$checkusertype = $this->Master_model->select_row('mov_quality_check','*',['Mqua_id'=>$id]);
				
			 $where = "Mqua_id <> 0 and (Mqua_status = 0 or Mqua_status = 1) $whrprojchk $wheretask";
			//$where = "MT_ts_id <> 0 $whrprojchk $wheretask";
			if($querydata != 'no'){
				$q = explode('#',$querydata);
				$search = $q[0];
				$filter = $q[1];
				$status = $q[2];
				$fltcond = $q[3];
				//print_r($search);
				$lov['search'] = $q[0];
				$lov['filter'] = $q[1];
				$lov['status'] = $q[2];	
			
				$cur_status = $status != ''?" and Mqua_status ='". $status."'":'';
				if($status == 3){ $cur_status = " and Mqua_status <>'". $status."'"; }
	
				if($q[0] != ''){
					$where .= " and  $filter like '%$search%' $cur_status"; 	
	
				}else if($cur_status != ''){
					$where .= "$cur_status"; 
				}
			}else{
				
				$where  .= " and Mqua_status <> '5'";
				$lov['search'] = '';
				$lov['filter'] = '';	
				$lov['status'] = '3';	
			}
			$querydata = base64_encode($querydata);
			$config = [
				'base_url' => base_url("Nav/manage_quality/$querydata"), 
				'per_page' => 50,
				'total_rows' =>$this->Master_model->user_count("Mqua_id","mov_quality_check",$where),
				'full_tag_open' => '<ul class="pagination">',
				'full_tag_close' => '</ul>',
				'first_tag_open' => '<li>',
				'uri_segment' => 4,
				'first_tag_close' => '</li>',
				'first_link' => 'first',
				'last_tag_open' => '<li>',
				'last_tag_close' => '</li>',
				'last_link' => 'last',
				'next_tag_open' => '<li>',
				'next_tag_close' => '</li>',
				'prev_tag_open' => '<li>',
				'prev_tag_close' => '</li>',
				'num_tag_open' => '<li>',
				'num_tag_close' => '</li>',
				'cur_tag_open' => '<li class="active"><a>',
				'cur_tag_close' => '</a></li>'
				
			];
			
				
			$this->pagination->initialize($config);
			$ordrby = " Order by `Mqua_UpdatedDate` DESC ";
			$lov['qualitycheck'] = $this->Master_model->user_data('*','mov_quality_check',$where.''.$ordrby,$config['per_page'],$this->uri->segment(4));
			
			$this->load->view('manage_qualitycheck',$lov);	
			}
		}


		// manage review code start here ******************************************

		public function search_view_review(){

			//  echo "<pre>"; print_r($this->input->post());die();
	
		   $this->form_validation->set_rules('search','Search','trim');
		   $this->form_validation->set_rules('filter','filter','trim');
		   $this->form_validation->set_rules('status','Status','trim');
		   
		   if($this->form_validation->run()){
			   $search = $this->input->post('search');
			   $filter = $this->input->post('filter');
			   
			   $status = $this->input->post('status');	
	
			   if($filter == 'Mflnc_Updated_Date' || $filter == 'Mflnc_Created_Date'){
				   $fltcond = 4;
				   $search = $this->input->post('searchdate');
			   }
			   else if($filter == 'MM_ID'){
				   $fltcond = 3;
				   $search = $this->input->post('MM_ID');
			   }
			   else if($filter == 'MNC_cat_id'){
				$fltcond = 3;
				$search = $this->input->post('MNC_cat_id');
			}
	
			   $query = $search.'#'.$filter.'#'.$status.'#';
			   $query = base64_encode($query);
			   redirect("Nav/manage_review/$query");
			   
		   }else{
			   $this->session->set_flashdata('error',validation_errors());
			   redirect('Nav/manage_review');
		   }
	   }
	
		public function manage_review($querydata)
		{
			if(!in_array("Manage Review",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
			$this->load->library('pagination');
			$querydata = base64_decode($querydata);
			$website_country = WEBCOUNTRY;
			
			$id = $this->session->userdata('id');
			$whrprojchk = "";
		
			$wheretask ="";
			$checkusertype = $this->Master_model->select_row('mov_review','*',['MRV_revid'=>$id]);
				
			 $where = "MRV_revid <> 0 and (MRV_status = 0 or MRV_status = 1) $whrprojchk $wheretask";
			//$where = "MT_ts_id <> 0 $whrprojchk $wheretask";
			if($querydata != 'no'){
				$q = explode('#',$querydata);
				$search = $q[0];
				$filter = $q[1];
				$status = $q[2];
				$fltcond = $q[3];
				//print_r($search);
				$lov['search'] = $q[0];
				$lov['filter'] = $q[1];
				$lov['status'] = $q[2];	
			
				$cur_status = $status != ''?" and MRV_status ='". $status."'":'';
				if($status == 3){ $cur_status = " and MRV_status <>'". $status."'"; }
	
				if($q[0] != ''){
					$where .= " and  $filter like '%$search%' $cur_status"; 	
	
				}else if($cur_status != ''){
					$where .= "$cur_status"; 
				}
			}else{
				
				$where  .= " and MRV_status <> '5'";
				$lov['search'] = '';
				$lov['filter'] = '';	
				$lov['status'] = '3';	
			}
			$querydata = base64_encode($querydata);
			$config = [
				'base_url' => base_url("Nav/manage_review/$querydata"), 
				'per_page' => 50,
				'total_rows' =>$this->Master_model->user_count("MRV_revid ","mov_review",$where),
				'full_tag_open' => '<ul class="pagination">',
				'full_tag_close' => '</ul>',
				'first_tag_open' => '<li>',
				'uri_segment' => 4,
				'first_tag_close' => '</li>',
				'first_link' => 'first',
				'last_tag_open' => '<li>',
				'last_tag_close' => '</li>',
				'last_link' => 'last',
				'next_tag_open' => '<li>',
				'next_tag_close' => '</li>',
				'prev_tag_open' => '<li>',
				'prev_tag_close' => '</li>',
				'num_tag_open' => '<li>',
				'num_tag_close' => '</li>',
				'cur_tag_open' => '<li class="active"><a>',
				'cur_tag_close' => '</a></li>'
				
			];
			
				
			$this->pagination->initialize($config);
			$ordrby = " Order by `MRV_UpdatedDate` DESC ";
			$lov['datareview'] = $this->Master_model->user_data('*','mov_review',$where.''.$ordrby,$config['per_page'],$this->uri->segment(4));
			
			$this->load->view('manage_review',$lov);	
			}
		}

		// manage review code end here ********************************************
		
		
		// manage appoinment letter code syart here ********************************************
		
		public function search_view_appt_letter(){

			// echo "<pre>"; print_r($this->input->post());die();
	
			$this->form_validation->set_rules('search','Search','trim');
			$this->form_validation->set_rules('filter','filter','trim');
			$this->form_validation->set_rules('status','Status','trim');
			
			if($this->form_validation->run()){
				$search = $this->input->post('search');
				$filter = $this->input->post('filter');
				
				$status = $this->input->post('status');	
	
				if($filter == 'MQa_UpdatedDate' || $filter == 'MQa_CreatedDate'){
					$fltcond = 4;
					$search = $this->input->post('searchdate');
				}
				else if($filter == 'MM_ID'){
					$fltcond = 3;
					$search = $this->input->post('MM_ID');
				}
	
				$query = $search.'#'.$filter.'#'.$status.'#';
				$query = base64_encode($query);
				redirect("Nav/manage_appt_letter/$query");
				
			}else{
				$this->session->set_flashdata('error',validation_errors());
				redirect('Nav/manage_appt_letter');
			}
		}
	
		public function manage_appt_letter($querydata)
		{
			if(!in_array("Manage FAQ",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
			$this->load->library('pagination');
			$querydata = base64_decode($querydata);
			$website_country = WEBCOUNTRY;
			
			$id = $this->session->userdata('id');
			$whrprojchk = "";
		
			$wheretask ="";
			$checkusertype = $this->Master_model->select_row('mov_appt_letter','*',['Ml_id'=>$id]);
			$where = "Ml_id <> 0 and (Ml_status = 0 or Ml_status = 1) $whrprojchk $wheretask";
			//$where = "MT_ts_id <> 0 $whrprojchk $wheretask";
			if($querydata != 'no'){
				$q = explode('#',$querydata);
				$search = $q[0];
				$filter = $q[1];
				$status = $q[2];
				$fltcond = $q[3];
				//print_r($search);
				$lov['search'] = $q[0];
				$lov['filter'] = $q[1];
				$lov['status'] = $q[2];	
			
				$cur_status = $status != ''?" and Ml_status ='". $status."'":'';
				if($status == 3){ $cur_status = " and Ml_status <>'". $status."'"; }
	
				if($q[0] != ''){
					$where .= " and  $filter like '%$search%' $cur_status"; 	
	
				}else if($cur_status != ''){
					$where .= "$cur_status"; 
				}
			}else{
				
				$where  .= " and Ml_status <> '5'";
				$lov['search'] = '';
				$lov['filter'] = '';	
				$lov['status'] = '3';	
			}
			$querydata = base64_encode($querydata);
			$config = [
				'base_url' => base_url("Nav/manage_appt_letter/$querydata"), 
				'per_page' => 50,
				'total_rows' =>$this->Master_model->user_count("Ml_id","mov_appt_letter",$where),
				'full_tag_open' => '<ul class="pagination">',
				'full_tag_close' => '</ul>',
				'first_tag_open' => '<li>',
				'uri_segment' => 4,
				'first_tag_close' => '</li>',
				'first_link' => 'first',
				'last_tag_open' => '<li>',
				'last_tag_close' => '</li>',
				'last_link' => 'last',
				'next_tag_open' => '<li>',
				'next_tag_close' => '</li>',
				'prev_tag_open' => '<li>',
				'prev_tag_close' => '</li>',
				'num_tag_open' => '<li>',
				'num_tag_close' => '</li>',
				'cur_tag_open' => '<li class="active"><a>',
				'cur_tag_close' => '</a></li>'
			];
			
				
			$this->pagination->initialize($config);
			$ordrby = " Order by `Ml_UpdatedDate` DESC ";
			$lov['appt_letter'] = $this->Master_model->user_data('*','mov_appt_letter',$where.''.$ordrby,$config['per_page'],$this->uri->segment(4));
			//echo $this->db->last_query(); die();
			
			$this->load->view('manage_appt_letter',$lov);	
			}
		}

		// manage appoinment letter code end here ********************************************

		
}
?>
