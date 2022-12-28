<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
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
    
	
	public function add_product()
    {
        if (!in_array("Product", $this->page)) {
            echo "<center><h3>Access Denied!</h3></center>";
        } else {
            $this->load->view("add_product");
        }
    }
	
	public function add_product_data()
    {
        $id = $this->session->userdata('id');

        $this->form_validation->set_rules('ncatid', 'Category ', 'trim|required');
        $this->form_validation->set_rules('pname', 'Tattoo name', 'trim|required|is_unique[mov_products.MP_Product_Name]'); 
        $this->form_validation->set_rules('admindesc', 'Tattoo Description (For Admin)', 'trim'); 
        $this->form_validation->set_rules('clientdesc', 'Tattoo Description (For Client)', 'trim|required'); 
        $this->form_validation->set_rules('tncpolicy', 'Tattoo Terms And Condition', 'trim'); 
        $this->form_validation->set_rules('costprice', 'Price (Admin)', 'trim|required'); 
        $this->form_validation->set_rules('currentprice', 'Price (Customer)', 'trim|required'); 
	 	$this->form_validation->set_rules('trending', 'trending', 'trim');
	 	$this->form_validation->set_rules('showonfront', 'showonfront', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
     
        //echo $perror;//exit;
       
        if ($this->form_validation->run() == FALSE ) {
           
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('add_product');
           
           
        } else {
            $id = $this->session->userdata('id');			
            $ncatid = $this->input->post('ncatid');   
            $pname = $this->input->post('pname');    
            $admindesc = $this->input->post('admindesc');    
            $clientdesc = $this->input->post('clientdesc');    
            $tncpolicy = $this->input->post('tncpolicy');    
            $costprice = $this->input->post('costprice');    
            $currentprice = $this->input->post('currentprice'); 
			$trending = 0;
            if ($this->input->post('trending')) {
                $trending = 1;
            }
			$showonfront = 0;
            if ($this->input->post('showonfront')) {
                $showonfront = 1;
            }
             $status = 0;
             if ($this->input->post('status')) {
                $status = 1;
           }
           
            $pnamecheck = $this->Master_model->checkdata('MP_ProID','mov_products',"MP_Product_Name='$pname'");
            if($pnamecheck >= 1){
                //echo 'in pro';//exit;
                $this->session->set_flashdata('error', 'Tattoo with name '.$pname.' is already available.');
               $this->load->view('add_product');
            }
            else{
                $imagemax_size = image_size()*1048576;	
				
				$uploadbannersize1 = $_FILES["tattoo1"]['size'];
				$uploadbannersize2 = $_FILES["tattoo2"]['size'];
				$uploadbannersize3 = $_FILES["tattoo3"]['size'];
	
				if($uploadbannersize1 > $imagemax_size || $uploadbannersize2 > $imagemax_size || $uploadbannersize3 > $imagemax_size){
					$this->session->set_flashdata('error', 'Image size is greater than '.image_size().' mb ! Kindly resize the image and upload');
                    //redirect("User/add_adminuser");
                    $this->load->view('add_product');
				}else
				{

                    if(!empty($_FILES["tattoo1"]['name']))
					{
						$tattoo1 = time().'_'.$_FILES["tattoo1"]['name'];
						$config['file_name'] = $tattoo1;
						$tattoo1 = str_replace(' ', '_', $tattoo1);
						$config['upload_path'] = 'uploads/product-images/';
						$config['allowed_types']        = 'jpg|jpeg|png';
						$config['max_size']             = 20000000; //50000
						$config['max_width']            = 20000000;
						$config['max_height']           = 20000000;
						$this->load->library("upload", $config);
						$this->upload->initialize($config);
						//print_r($config); die();
						if (!$this->upload->do_upload('tattoo1'))
						{
							$tattoo1 = '';
						}
					}
					else
					{
						$tattoo1 = '';
					}
					
					if(!empty($_FILES["tattoo2"]['name']))
					{
						$tattoo2 = time().'_'.$_FILES["tattoo2"]['name'];
						$config['file_name'] = $tattoo2;
						$tattoo2 = str_replace(' ', '_', $tattoo2);
						$config['upload_path'] = 'uploads/product-images/';
						$config['allowed_types']        = 'jpg|jpeg|png';
						$config['max_size']             = 20000000; //50000
						$config['max_width']            = 20000000;
						$config['max_height']           = 20000000;
						$this->load->library("upload", $config);
						$this->upload->initialize($config);
						//print_r($config); die();
						if (!$this->upload->do_upload('tattoo2'))
						{
							$tattoo2 = '';
						}
					}
					else
					{
						$tattoo2 = '';
					}
					
					if(!empty($_FILES["tattoo3"]['name']))
					{
						$tattoo3 = time().'_'.$_FILES["tattoo3"]['name'];
						$config['file_name'] = $tattoo3;
						$tattoo3 = str_replace(' ', '_', $tattoo3);
						$config['upload_path'] = 'uploads/product-images/';
						$config['allowed_types']        = 'jpg|jpeg|png';
						$config['max_size']             = 20000000; //50000
						$config['max_width']            = 20000000;
						$config['max_height']           = 20000000;
						$this->load->library("upload", $config);
						$this->upload->initialize($config);
						//print_r($config); die();
						if (!$this->upload->do_upload('tattoo3'))
						{
							$tattoo3 = '';
						}
					}
					else
					{
						$tattoo3 = '';
					}


            $insertdata = array(
                       //       
                'MNC_cat_id' => $ncatid,
                'MP_Product_Name' => $pname,
                'MP_Product_Desc_Admin' => $admindesc, 
                'MP_Product_Desc_Front' => $clientdesc,
				'MP_TnC_Policy' => $tncpolicy,

                'MP_Current_Price' => $currentprice,
                'MP_Cost_Price' => $costprice,
                
				'MP_Hot_Offers' => $trending,
                'MP_Show_OnHome' => $showonfront,
                'MP_status' => $status,
                'MP_CreatedBY' => $id,              
                'MP_UpdatedBy' => $id,              
                'MP_Created_Date' => date("Y-m-d H:i:s"),
            );

            if($tattoo1 !=''){
                $insertdata['MP_Image_1'] = $tattoo1;
            }
			if($tattoo2 !=''){
                $insertdata['MP_Image_2'] = $tattoo2;
            }
			if($tattoo3 !=''){
                $insertdata['MP_Image_3'] = $tattoo3;
            }

            $projectID = $this->Master_model->InsertdatawithlastID('mov_products', $insertdata);
           
        
            if ($projectID > 0) {
				$this->session->set_flashdata('success', "Insert Record Successfully!");
				redirect('Product/add_product/');
            } else {
                $this->session->set_flashdata('error', "Insert Failed!");
                redirect('Product/add_product/' . $pname);
            }
             
            }
        
        }

        }
    }

	public function edit_product($editid = 0, $search = 'bm8=', $page = 0)
    {
		$id = $this->session->userdata('id');
		$editdata['editproject'] = $this->Master_model->select_data('mov_products', '*', "MP_ProID =$editid");
		$editdata['searchval'] = $search;
		$editdata['pageval'] = $page;
		$this->load->view('edit_product', $editdata);
       
    }
	

	public function edit_product_data()
    {
        $id=$this->session->userdata('id');

        $this->form_validation->set_rules('editid', 'Edit Id', 'trim');
        $editid = $this->input->post('editid');
        $original_value = $this->Master_model->select_row('mov_products', 'MP_Product_Name', "MP_ProID=$editid");
       
        if ($this->input->post('pname') != $original_value->MP_Product_Name) {
            $is_unique =  '|is_unique[mov_products.MP_Product_Name]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules('pname', 'Tattoo name', 'required|trim' . $is_unique);
        $this->form_validation->set_rules('ncatid', 'Category ', 'trim|required');
       
	 	$this->form_validation->set_rules('admindesc', 'Tattoo Description (For Admin)', 'trim'); 
        $this->form_validation->set_rules('clientdesc', 'Tattoo Description (For Client)', 'trim|required'); 
        $this->form_validation->set_rules('tncpolicy', 'Tattoo Terms And Condition', 'trim'); 
        $this->form_validation->set_rules('costprice', 'Price (Admin)', 'trim|required'); 
        $this->form_validation->set_rules('currentprice', 'Price (Customer)', 'trim|required'); 
	 	$this->form_validation->set_rules('trending', 'trending', 'trim');
	 	$this->form_validation->set_rules('showonfront', 'showonfront', 'trim');
		
        $search = $this->input->post('search');
        $page = $this->input->post('page');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Product/edit_product/'. $editid . '/' . $search . '/' . $page);
        } else {
          
		 	$ncatid = $this->input->post('ncatid');   
            $pname = $this->input->post('pname');  
            $admindesc = $this->input->post('admindesc');    
            $clientdesc = $this->input->post('clientdesc');    
            $tncpolicy = $this->input->post('tncpolicy');    
            $costprice = $this->input->post('costprice');    
            $currentprice = $this->input->post('currentprice'); 
			$trending = 0;
            if ($this->input->post('trending')) {
                $trending = 1;
            }
			$showonfront = 0;
            if ($this->input->post('showonfront')) {
                $showonfront = 1;
            }
             $status = 0;
             if ($this->input->post('status')) {
                $status = 1;
           }
           
            $imagemax_size = image_size()*1048576;	
            $uploadbannersize1 = $_FILES["tattoo1"]['size'];
			$uploadbannersize2 = $_FILES["tattoo2"]['size'];
			$uploadbannersize3 = $_FILES["tattoo3"]['size'];

			if($uploadbannersize1 > $imagemax_size || $uploadbannersize2 > $imagemax_size || $uploadbannersize3 > $imagemax_size){
                $this->session->set_flashdata('error', 'Image size is greater than '.image_size().' mb ! Kindly resize the image and upload');
                redirect('Product/edit_product/'.$editid.'/'.$search.'/'.$page);
            }else
            {
                if(!empty($_FILES["tattoo1"]['name']))
					{
						$tattoo1 = time().'_'.$_FILES["tattoo1"]['name'];
						$config['file_name'] = $tattoo1;
						$tattoo1 = str_replace(' ', '_', $tattoo1);
						$config['upload_path'] = 'uploads/product-images/';
						$config['allowed_types']        = 'jpg|jpeg|png';
						$config['max_size']             = 20000000; //50000
						$config['max_width']            = 20000000;
						$config['max_height']           = 20000000;
						$this->load->library("upload", $config);
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('tattoo1'))
						{
							$tattoo1 = '';
						}
					}
					else
					{
						$tattoo1 = '';
					}
					
					if(!empty($_FILES["tattoo2"]['name']))
					{
						$tattoo2 = time().'_'.$_FILES["tattoo2"]['name'];
						$config['file_name'] = $tattoo2;
						$tattoo2 = str_replace(' ', '_', $tattoo2);
						$config['upload_path'] = 'uploads/product-images/';
						$config['allowed_types']        = 'jpg|jpeg|png';
						$config['max_size']             = 20000000; //50000
						$config['max_width']            = 20000000;
						$config['max_height']           = 20000000;
						$this->load->library("upload", $config);
						$this->upload->initialize($config);
						//print_r($config); die();
						if (!$this->upload->do_upload('tattoo2'))
						{
							$tattoo2 = '';
						}
					}
					else
					{
						$tattoo2 = '';
					}
					
					if(!empty($_FILES["tattoo3"]['name']))
					{
						$tattoo3 = time().'_'.$_FILES["tattoo3"]['name'];
						$config['file_name'] = $tattoo3;
						$tattoo3 = str_replace(' ', '_', $tattoo3);
						$config['upload_path'] = 'uploads/product-images/';
						$config['allowed_types']        = 'jpg|jpeg|png';
						$config['max_size']             = 20000000; //50000
						$config['max_width']            = 20000000;
						$config['max_height']           = 20000000;
						$this->load->library("upload", $config);
						$this->upload->initialize($config);
						//print_r($config); die();
						if (!$this->upload->do_upload('tattoo3'))
						{
							$tattoo3 = '';
						}
					}
					else
					{
						$tattoo3 = '';
					}

            $data = array(
                        
                'MNC_cat_id' => $ncatid,
                'MP_Product_Name' => $pname,
                'MP_Product_Desc_Admin' => $admindesc, 
                'MP_Product_Desc_Front' => $clientdesc,
				'MP_TnC_Policy' => $tncpolicy,

                'MP_Current_Price' => $currentprice,
                'MP_Cost_Price' => $costprice,
                
				'MP_Hot_Offers' => $trending,
                'MP_Show_OnHome' => $showonfront,
                'MP_status' => $status,          
                'MP_UpdatedBy' => $id
            );

            if($tattoo1 !=''){
                $data['MP_Image_1'] = $tattoo1;
            }
			if($tattoo2 !=''){
                $data['MP_Image_2'] = $tattoo2;
            }
			if($tattoo3 !=''){
                $data['MP_Image_3'] = $tattoo3;
            }

            $profileres = $this->Master_model->updatedata('MP_ProID', $editid, $data, 'mov_products');

            if($profileres > 0) {
				$this->session->set_flashdata('success', "Update Record Successfully!");
				redirect('Product/edit_product/' . $editid . '/' . $search . '/' . $page);
                
            } else {
                $this->session->set_flashdata('error', 'Problem With Update!');
                redirect('Product/edit_product/' . $editid . '/' . $search . '/' . $page);
            }
        }
        }
    }

    public function add_portfolio_data()
    {
		$id = $this->session->userdata('id');
		$this->form_validation->set_rules('MC_page_name', 'Page Name', 'trim|required');
		$this->form_validation->set_rules('pname', 'Protfolio Name', 'trim|required');
		$this->form_validation->set_rules('pdesc', 'Portfolio Description ', 'trim|required');
		$this->form_validation->set_rules('purl', 'Portfolio URL ', 'required');
		if ($this->form_validation->run() == FALSE ) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Nav/add_portfolio');
		} else 
		{
			// $MC_page_name = $this->input->post('MC_page_name');  
			$pname = $this->input->post('pname');  
			$purl = $this->input->post('purl');  
			$MC_page_name = $this->input->post('MC_page_name');  
			$pYear = $this->input->post('pYear');  
			$pBudget = $this->input->post('pBudget');  
			$pConfiguration = $this->input->post('pConfiguration');  
			$pdesc = $this->input->post('pdesc'); 
			$status = 0;
            if ($this->input->post('status')) {
                $status = 1;
            }
			$data=array(
			'MC_page_name'=>$MC_page_name,
			'purl'=>$purl,
			'MP_Name'=>$pname,
			'pYear'=>$pYear,
			'pBudget'=>$pBudget,
			'pConfiguration'=>$pConfiguration,
			'MP_Desc'=>$pdesc,
			'MP_Status'=>$status,
			'MP_CreatedBY'=>$id,
			'MP_CreatedDate'=>date("Y-m-d H:i:s"),
			'MP_UpdatedBY'=>$id
			);
			$protID = $this->Master_model->InsertdatawithlastID('mov_portfolio', $data);

			$this->load->library('upload');
  			$image = array();
  			$ImageCount = count($_FILES['pimages']['name']);
        	for($i = 0; $i < $ImageCount; $i++){

                
            $_FILES['file']['name']       = $_FILES['pimages']['name'][$i];
            $_FILES['file']['type']       = $_FILES['pimages']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['pimages']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['pimages']['error'][$i];
            $_FILES['file']['size']       = $_FILES['pimages']['size'][$i];
            // File upload configuration
            $uploadPath = 'uploads/portfolio-images/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('file')){
                // Uploaded file data
                $imageData = $this->upload->data();
                $imagedata=array(
                'MP_Id'=>$protID,
                'MPI_Images'=>$imageData['file_name']
                );
                $this->Master_model->InsertdatawithlastID('mov_portfolio_images', $imagedata);
                }

            }
            if ($protID > 0) {
                $this->session->set_flashdata('success', "Insert Record Successfully!");
                redirect('Nav/add_portfolio/');
            } else {
                $this->session->set_flashdata('error', "Insert Failed!");
                redirect('Nav/add_portfolio/');
            }
		
		}
    }
    
    public function edit_portfolio_data()
    {
        $id = $this->session->userdata('id');
        $search = $this->input->post('search');
        $page = $this->input->post('page');
        $editid = $this->input->post('editid');
		$this->form_validation->set_rules('pname', 'Protfolio Name ', 'trim|required');
		$this->form_validation->set_rules('pdesc', 'Portfolio Description ', 'trim|required');
		$this->form_validation->set_rules('purl', 'Portfolio URL ', 'trim|required');
		if ($this->form_validation->run() == FALSE ) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Nav/add_portfolio');
		} else 
		{
			// $MC_page_name = $this->input->post('MC_page_name');  
			$pname = $this->input->post('pname');  
			$purl = $this->input->post('purl');  
			$MC_page_name = $this->input->post('MC_page_name');  
			$pdesc = $this->input->post('pdesc'); 
            // $hiddenpimages = implode(',',$this->input->post('hiddenpimages')); 
			$status = 0;
            if ($this->input->post('status')) {
                $status = 1;
           }
			$data=array(
            'MC_page_name'=>$MC_page_name,
            'purl'=>$purl,
            'MP_Name'=>$pname,
            'MP_Desc'=>$pdesc,
			'MP_Status'=>$status,
			'MP_UpdatedBY'=>$id
			);
            $protID = $this->Master_model->updatedata('MP_Id', $editid, $data, 'mov_portfolio');
            // if($hiddenpimages!='')
            // {
            // $this->db->query('delete from mov_portfolio_images where MPI_Id NOT IN('.$hiddenpimages.')');
            // }
            // else
            // {
            // $this->db->query('delete from mov_portfolio_images');
            // }
			$this->load->library('upload');
  			$image = array();
  			$ImageCount = count($_FILES['pimages']['name']);
        	for($i = 0; $i < $ImageCount; $i++){
            $_FILES['file']['name']       = $_FILES['pimages']['name'][$i];
            $_FILES['file']['type']       = $_FILES['pimages']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['pimages']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['pimages']['error'][$i];
            $_FILES['file']['size']       = $_FILES['pimages']['size'][$i];
            // File upload configuration
            $uploadPath = 'uploads/portfolio-images/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('file')){
                // Uploaded file data
			$imageData = $this->upload->data();
			$imagedata=array(
			'MP_Id'=>$editid,
			// 'MP_Name'=>$imageData['file_name'],
			'MPI_Images'=>$imageData['file_name']
            );
            $this->Master_model->InsertdatawithlastID('mov_portfolio_images', $imagedata);
            // $profileres = $this->Master_model->updatedata('MP_Id', $protID, $imagedata, 'mov_portfolio_images');
            }
        }
		if ($protID > 0) {
			$this->session->set_flashdata('success', "Update Record Successfully!");
			redirect('Nav/edit_portfolio/'. $editid . '/' . $search . '/' . $page);
		} else {
			$this->session->set_flashdata('error', "Update Failed!");
			redirect('Nav/edit_portfolio/'. $editid . '/' . $search . '/' . $page);
		}
		
		}
	}


	public function changeprostatus()
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
                $arr = array('MP_status' => $statuscl, 'MP_UpdatedBy' => $id);
                $updatestatus = $this->Master_model->updatedata('MP_ProID', $cntid, $arr, 'mov_products');

                if ($updatestatus) {
                    echo "3";
                } else {
                    echo "4";
                }
            }
        }
	}
	
	




		
}
?>