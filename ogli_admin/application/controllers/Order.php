<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Master_model');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('image_lib');
		$id = $this->session->userdata('id');
        $page = array();
        $roledata = get_list('mov_user_master', "MUM_Access_Permission", "MUM_ID=$id");
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

	public function send_invoice()
	{
		$to_email=$this->input->post('email');
		$subject=$this->input->post('subject');
		$message=$this->input->post('html');
		$website = $this->Master_model->select_data('mov_website','*','');
		//print_r($website[0]->MWM_Company_Name); exit;
		//$from_email='avisworld3@gmail.com';
		$from_email = $website[0]->MWM_Mail_SenderID;
		$config = get_email_data();
         $this->email->initialize($config);
		 $this->email->from($from_email, $website[0]->MWM_Company_Name);
		 $this->email->to($to_email);
         $this->email->subject($subject);
         $this->email->message($message);
		 //Send mail 
		//  $this->email->send();				
		//  echo $this->email->print_debugger(); exit;

         if($this->email->send() && $to_email!='') 
         echo 'send'; 
         else 
         echo 'error';
	}

	
	
	
	public function addmanualorder()
	{
		$ids = $this->session->userdata('id');
		$this->form_validation->set_rules("orderdesc","Order Description","trim|required");
		$this->form_validation->set_rules("sdescription","Special Description","trim|required");
		$this->form_validation->set_rules("tattoosize","Tattoo Size","trim|required");
		$this->form_validation->set_rules("bodypart","Body Part","trim");
		$this->form_validation->set_rules("productid","Produt","trim");
		$this->form_validation->set_rules("tamount","Total Amount","trim|required");
		$this->form_validation->set_rules("ptype","Payment Type","trim|required");
		$this->form_validation->set_rules("paypercentage","Payment Percentage","trim|required");
		$this->form_validation->set_rules("payvia","Payment Via","trim|required");
		$this->form_validation->set_rules("cname","Client Name","trim|required");
		$this->form_validation->set_rules("caddress","Client Address","trim|required");
		$this->form_validation->set_rules("cnumber","Client Number","trim|required");
		$this->form_validation->set_rules("cage","Client Age","trim|required");
		$this->form_validation->set_rules("artistid","Artist","trim|required");
		$this->form_validation->set_rules("cemail","client email","trim|required");
		if($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect("Nav/manual_order/bm8=");
		}else
		{
			
			$upload_path = UPLOAD_PATH;
			if(!empty($_FILES["tattooimg"]['name']))
					{
						$img_name = time().'_'.$_FILES["tattooimg"]['name'];
						$config['file_name'] = $img_name;
						$img_name = str_replace(' ', '_', $img_name);
						$config['upload_path'] = 'uploads/product-images/';
						$config['allowed_types']        = 'jpg|jpeg|png';
						$config['max_size']             = 20000000; //50000
						$config['max_width']            = 20000000;
						$config['max_height']           = 20000000;
						$this->load->library("upload", $config);
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('tattooimg'))
						{
							$img_name = '';
						}
					}
					else
					{
						$img_name = '';
					}
			$data = $this->input->post();
			$chkclient = $this->Master_model->select_data('mov_clients','*',"MC_cl_email='".$data['cemail']."'");
			if(count($chkclient)==0)
			{
			$cdata=array(
			'MC_cl_name'=>$data['cname'],
			'MC_cl_email'=>$data['cemail'],
			'MC_cl_phone'=>$data['cnumber'],
			'MC_cl_add'=>$data['caddress'],
			'MC_cl_status'=>1,
			'MC_CreatedBY'=>$ids,
			'MC_CreatedDate'=>date('Y-m-d')
			);
			$this->Master_model->InsertdatawithlastID('mov_clients',$cdata);
			}
			$chk = $this->Master_model->select_data('mov_order','*',"MOR_client_email='".$data['cemail']."'");
			$rclient=0;
			if(count($chk)>0)
			{
				$rclient=1;
			}
			$orderarr =  array(
					'MOR_Description'=>$data['orderdesc'],
					'MOR_special_instruction'=>$data['sdescription'],
					'MOR_Tattoo_size'=>$data['tattoosize'],
					'MOR_image'=>$img_name,
					'MOR_body_part'=>$data['bodypart'],
					'MP_ProID'=>$data['productid'],
					'MUM_ID'=>$data['artistid'],
					'MOR_booking_status'=>0,
					'MOR_payment_status'=>0,
					'MOR_total_amount'=>$data['tamount'], 
					'MOR_payment_type'=>$data['ptype'],
					'MOR_payment_percent'=>$data['paypercentage'],
					'MOR_booking_date'=>date('Y-m-d'),
					'MOR_type'=>$data['payvia'],
					'MOR_client_name'=>$data['cname'],
					'MOR_client_number'=>$data['cnumber'], 
					'MOR_client_email'=>$data['cemail'], 
					'MOR_client_address'=>$data['caddress'],
					'MOR_client_age'=>$data['cage'], 
					'MOR_returning_client'=>$rclient, 
					'MOR_created_by'=>$ids, 
					'MOR_created_date'=>date('Y-m-d'),
					'MOR_updated_by'=>$ids);
					$lastid=$this->Master_model->InsertdatawithlastID('mov_order',$orderarr);
					$orderprefix='';
					if(!empty($lastid)){
						$orderprefix ='IBT2021'.$lastid;
						$arr = array('MOR_number'=>$orderprefix);
						$this->Master_model->updatedatawhere("MOR_id=$lastid",$arr,'mov_order');
					}
					if($lastid > 0){
						$this->session->set_flashdata('success', "New Manual Order $orderprefix has been registered sucessfully.");
						redirect("Nav/manual_order/bm8=");
					}
					else
					{
						$this->session->set_flashdata('error', 'Problem with inserting custome order');
						redirect("Nav/manual_order/bm8=");
					}
			
		}

	}

	public function editmanualorder()
	{
		$ids = $this->session->userdata('id');
		$this->form_validation->set_rules("editid","editid","trim|required");
		$this->form_validation->set_rules("orderdesc","Order Description","trim|required");
		$this->form_validation->set_rules("sdescription","Special Description","trim|required");
		$this->form_validation->set_rules("tattoosize","Tattoo Size","trim|required");
		$this->form_validation->set_rules("bodypart","Body Part","trim");
		$this->form_validation->set_rules("productid","Produt","trim");
		$this->form_validation->set_rules("tamount","Total Amount","trim|required");
		$this->form_validation->set_rules("ptype","Payment Type","trim|required");
		$this->form_validation->set_rules("paypercentage","Payment Percentage","trim|required");
		$this->form_validation->set_rules("payvia","Payment Via","trim|required");
		$this->form_validation->set_rules("cname","Client Name","trim|required");
		$this->form_validation->set_rules("caddress","Client Address","trim|required");
		$this->form_validation->set_rules("cnumber","Client Number","trim|required");
		$this->form_validation->set_rules("cage","Client Age","trim|required");
		$this->form_validation->set_rules("artistid","Artist","trim|required");
		$data = $this->input->post();
		if($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('Order/edit_order/' . $data['editid'] . '/' .$data['search'] . '/' . $data['page']);
		}else
		{
			
			$upload_path = UPLOAD_PATH;
			if(!empty($_FILES["tattooimg"]['name']))
					{
						$img_name = time().'_'.$_FILES["tattooimg"]['name'];
						$config['file_name'] = $img_name;
						$img_name = str_replace(' ', '_', $img_name);
						$config['upload_path'] = 'uploads/product-images/';
						$config['allowed_types']        = 'jpg|jpeg|png';
						$config['max_size']             = 20000000; //50000
						$config['max_width']            = 20000000;
						$config['max_height']           = 20000000;
						$this->load->library("upload", $config);
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('tattooimg'))
						{
							$img_name = '';
						}
					}
					else
					{
						$img_name = '';
					}
					if($img_name!='')
					{
						$this->Master_model->updatedata('MOR_id',$data['editid'], array('MOR_image'=>$img_name), 'mov_order');
					}
			$orderarr =  array(
					'MOR_Description'=>$data['orderdesc'],
					'MOR_special_instruction'=>$data['sdescription'],
					'MOR_Tattoo_size'=>$data['tattoosize'],
					'MOR_body_part'=>$data['bodypart'],
					'MP_ProID'=>$data['productid'],
					'MUM_ID'=>$data['artistid'],
					'MOR_total_amount'=>$data['tamount'], 
					'MOR_payment_type'=>$data['ptype'],
					'MOR_payment_percent'=>$data['paypercentage'],
					'MOR_type'=>$data['payvia'],
					'MOR_client_name'=>$data['cname'],
					'MOR_client_number'=>$data['cnumber'], 
					'MOR_client_email'=>$data['cemail'], 
					'MOR_client_address'=>$data['caddress'],
					'MOR_client_age'=>$data['cage'], 
					'MOR_updated_by'=>$ids);
					$lastid=$this->Master_model->updatedata('MOR_id',$data['editid'], $orderarr, 'mov_order');
					if($lastid > 0){
						$this->session->set_flashdata('success', "Update Order Successfully!.");
						redirect('Order/edit_order/' . $data['editid'] . '/' .$data['search'] . '/' . $data['page']);
					}
					else
					{
						$this->session->set_flashdata('error', 'Problem with Order');
						redirect('Order/edit_order/' . $data['editid'] . '/' .$data['search'] . '/' . $data['page']);
					}
			
		}

	}

	public function edit_order($editid = 0, $search = 'bm8=', $page = 0)
	{
		$id = $this->session->userdata('id');
		$editdata['editorder'] = $this->Master_model->select_row('mov_order', '*', "MOR_id =$editid");
		$editdata['searchval'] = $search;
		$editdata['pageval'] = $page;
		$this->load->view('edit_order', $editdata);
	}

	public function view_order($editid = 0, $search = 'bm8=', $page = 0)
	{
		$id = $this->session->userdata('id');
		$editdata['vieworder'] = $this->Master_model->select_row('mov_order', '*', "MOR_id =$editid");
		$editdata['searchval'] = $search;
		$editdata['pageval'] = $page;
		$this->load->view('view_order', $editdata);
	}
	

	public function displayinvoice(){
		//$this->form_validation->set_rules("oid","Order Id","trim|required");
		// $this->form_validation->set_rules("webid","Web Contry Id","trim|required");
		// $this->form_validation->set_rules("web","Website ID","trim|required");
		$this->form_validation->set_rules('order_id', 'competency_id', 'trim');
		$this->form_validation->set_rules('actual_link', 'actual_linkactual_link', 'trim');
		$order_id = 1; 
		if($this->input->post('order_id')){
			$order_id = $this->input->post('order_id');				
		}
		$actual_link = $this->input->post('actual_link');
		if($this->form_validation->run()==FALSE)
		{
			echo validation_errors();	
		}
		else{
			//$oid = $this->input->post('order_id');
			// $webid = $this->input->post('webid');
			// $web = $this->input->post('web');
			$query = $this->db->query("SELECT `MOR_payment_date` FROM `mov_order` WHERE `MOR_id`=$order_id");
			$row = $query->row();
			
			//$webdata= $this->Master_model->select_data('flr_website','FWM_Tax_Applicable',"FWM_ID = $web");
			
			$tax = 0;
			// if(!empty($webdata[0])){
			// 	$tax = $webdata[0]->FWM_Tax_Applicable;	
			// }
			
			if (isset($row))
			{ 	
				if($row->MOR_payment_date != 0){
					if($tax == 1){
						//echo $this->createinvoice($oid,$webid);
						//echo $this->createinvoice($oid);
						echo 'crating invoice for'.$row->MOR_payment_date;
					}else{
						//echo $this->createinvoicenontax($oid,$webid,$web);
						//echo $this->createinvoicenontax($oid);
						echo 'crating invoice for one'.$row->MOR_payment_date;
					}
				}else{
					echo "Invoice not generated";
				}
			}
		}
	}


	public function createinvoice($order){}
	public function createinvoicenontax($order){}
	
	
	public function get_client_email()
	{
		if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->Master_model->get_client_email($q);
		}
	}
	
	public function get_client_data(){
		$cemail = $this->input->post('cemail');
		$getclientdata = $this->Master_model->select_row('mov_clients','MC_cl_id,MC_cl_name,MC_cl_phone,MC_cl_add',"MC_cl_email='".$cemail."'");
		$MC_cl_name = ""; $MC_cl_phone = ""; $MC_cl_add = "";
		if(isset($getclientdata) && $getclientdata !=''){
			$MC_cl_name = $getclientdata->MC_cl_name; $MC_cl_phone = $getclientdata->MC_cl_phone; $MC_cl_add = $getclientdata->MC_cl_add;
			$result = $MC_cl_name.'#'.$MC_cl_phone.'#'.$MC_cl_add;
		}
		else {
		$result = "no";
		}
		echo $result;
	}
		
}
?>