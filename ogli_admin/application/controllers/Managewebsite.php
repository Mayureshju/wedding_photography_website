<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managewebsite extends CI_Controller {
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
		
	}
	public function index()	{ }
	
	
	
	
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
				$arr = array('MWM_Status'=>$statuscl,'MWM_UpdatedBY'=>$id); 
				$updatestatus = $this->Master_model->updatedata('MWM_ID',$cntid,$arr,'mov_website');

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
	
	public function edit_website($id,$isactive='basic')
	{
		if(!in_array("Manage Website",$this->page)){echo "<center><h3>Access Denied!</h3></center>";}else{
		$website['websitedata'] = $this->Master_model->select_data('mov_website','*','MWM_ID='.$id);
		$website['isactive'] = $isactive;
		$this->load->view('edit_website',$website);
		}
	}
	
	public function edit_website_data()
	{
		//print_r($this->input->post()); 
		$ids = $this->session->userdata('id');
		$this->form_validation->set_rules('webname', 'Website Name', 'trim|required');
		$this->form_validation->set_rules('domainname', 'Domain Name', 'trim|required');
		$this->form_validation->set_rules('emailsender', 'Email', 'trim|required');
		$this->form_validation->set_rules('ccemailsender', 'CC Email Sender', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim');
		$this->form_validation->set_rules('maintencestatus', 'maintencestatus', 'trim');
		$this->form_validation->set_rules('compname', 'Company Name', 'trim|required');
		$this->form_validation->set_rules('gstin', 'GSTIN', 'trim|required');
		$this->form_validation->set_rules('phno', 'Phone Number', 'trim|required');
		$this->form_validation->set_rules('phnoalt', 'Phone Number Alt', 'trim|required');
		$this->form_validation->set_rules('phnowhatsapp', 'Phone Number Whatsapp', 'trim|required');
		$this->form_validation->set_rules('compaddr', 'Company Address', 'trim|required');
		$this->form_validation->set_rules('contactperson', 'Contact Person', 'trim');
		$this->form_validation->set_rules('locationmap', 'Location Map', 'trim');
		$this->form_validation->set_rules('imagesize', 'Image Size', 'trim');
		$this->form_validation->set_rules('googlerating', 'googlerating', 'trim');
		$this->form_validation->set_rules('editid', 'Edit ID', 'trim');
		
		$id = $this->input->post('editid');
		
		if ($this->form_validation->run() == FALSE)
		{	
			$error['error'] = validation_errors();
			$error['websitedata'] = $this->Master_model->select_data('mov_website','*','MWM_ID='.$id);
			$this->load->view('edit_website',$error);
		}
		else
		{
			$webname = $this->input->post('webname');
			$domainname = $this->input->post('domainname');
			$emailsender = $this->input->post('emailsender');
			$ccemailsender = $this->input->post('ccemailsender');
			$active = 0; if($this->input->post('active')){ $active = 1;	}
			$maintencestatus = 0; if($this->input->post('maintencestatus')){ $maintencestatus = 1;	}
			$compname = $this->input->post('compname');
			$gstin = $this->input->post('gstin');
			$phno = $this->input->post('phno');
			$phnoalt = $this->input->post('phnoalt');
			$phnowhatsapp = $this->input->post('phnowhatsapp');
			$compaddr = $this->input->post('compaddr'); 
			$compaddralt = $this->input->post('compaddralt');
			$contactperson = $this->input->post('contactperson');
			$locationmap = $this->input->post('locationmap');
			$imagesize = $this->input->post('imagesize');
			$googlerating = $this->input->post('googlerating');

			//get the upload file path
			$upload_path = $this->input->post('upload_path');
			if($id == CURRENT_WEBSITE){
				$upload_path = UPLOAD_PATH;
			}
		//	echo $upload_path; die();
			//print_r($_POST); die();
			//print_r($_FILES); die();
			$imagemax_size = image_size()*1048576;
			//echo $imagemax_size; exit;
			$uploadimagesize = $_FILES["userfile"]['size'];
			$uploadimagesizefoot = $_FILES["userfilefoot"]['size'];
			
			if($uploadimagesize > $imagemax_size || $uploadimagesizefoot > $imagemax_size){
				$this->session->set_flashdata('error', 'Image size is greater than '.image_size().' mb ! Kindly resize the image and upload');
				redirect("Managewebsite/edit_website/$id/");
			}
			
			else{
			
				if(!empty($_FILES["userfile"]['name']))
				{
					$new_name = $_FILES["userfile"]['name'];				
					$new_name = str_replace(' ', '_', $new_name);
					$new_name = str_replace('(', '', $new_name);
					$new_name = str_replace(')', '', $new_name);
					$config['file_name'] = $new_name;
					$config['upload_path'] = 'uploads/cpanel-logo/header/';
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 20000000; //50000
					$config['max_width']            = 20000000;
					$config['max_height']           = 20000000;
					$this->load->library("upload", $config);
					$this->upload->initialize($config);
					//print_r($config); die();
					if (@getimagesize('uploads/cpanel-logo/header/'.$new_name)) {
						//$this->session->set_flashdata('error', 'Image with same name '.$new_name.' already exist');
						//redirect("Managewebsite/edit_website/$id/");
						unlink('uploads/cpanel-logo/header/'.$new_name);
					}
					if (!$this->upload->do_upload('userfile'))
					{
						$new_name = '';
						//echo "123"; exit;
					}
					else{
						//echo $new_name; exit;
						$new_name = $new_name;
						
						
						
						
					}
				}
				else
				{
					$new_name = '';
				}
				
				
				if(!empty($_FILES["userfilefoot"]['name']))
				{
					$new_name_foot = $_FILES["userfilefoot"]['name'];				
					$new_name_foot = str_replace(' ', '_', $new_name_foot);
					$new_name_foot = str_replace('(', '', $new_name_foot);
					$new_name_foot = str_replace(')', '', $new_name_foot);
					$config['file_name'] = $new_name_foot;
					$config['upload_path'] = 'uploads/cpanel-logo/footer/';
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 20000000; //50000
					$config['max_width']            = 20000000;
					$config['max_height']           = 20000000;
					$this->load->library("upload", $config);
					$this->upload->initialize($config);
					//print_r($config); die();
					if (@getimagesize('uploads/cpanel-logo/footer/'.$new_name_foot)) {
						//$this->session->set_flashdata('error', 'Image with same name '.$new_name_foot.' already exist');
						//redirect("Managewebsite/edit_website/$id/");
						
						unlink('uploads/cpanel-logo/footer/'.$new_name_foot);
					}
					if (!$this->upload->do_upload('userfilefoot'))
					{
						$new_name_foot = '';
						//echo "123"; exit;
					}
					else{
						//echo '456'; exit;
					}
				}
				else
				{
					$new_name_foot = '';
				}

				$updatedata = array(
				'MWM_Website_Name'=>$webname,
				'MWM_Domain_Name'=>$domainname,
				'MWM_Mail_SenderID'=>$emailsender,
				'MWM_CCMAIL_SenderID'=>$ccemailsender,
				'MWM_Status'=>$active,
				'MWM_maintanence_Status'=>$maintencestatus,
				'MWM_Company_Name'=>$compname,
				'MWM_GSTIN'=>$gstin,
				'MWM_Contact_Person'=>$contactperson,
				'MWM_Company_Phone'=>$phno,
				'MWM_Company_Phone_alt'=>$phnoalt,
				'MWM_Company_Phone_whatsapp'=>$phnowhatsapp,
				'MWM_Company_Address'=>$compaddr,
				'MWM_Company_Address_alt'=>$compaddralt,
				'MWM_Company_location_Map'=>$locationmap,
				'MWM_Imagesize'=>$imagesize,
				'MWM_rating_count'=>$googlerating,
				'MWM_UpdatedBY'=> $ids
				);
				if($new_name !=''){
					$updatedata['MWM_Logo'] = $new_name;
				}
				if($new_name_foot !=''){
					$updatedata['MWM_Logo_footer'] = $new_name_foot;
				}

				$dataupdated = $this->Master_model->updatedata('MWM_ID',$id,$updatedata,'mov_website');
				if($dataupdated > 0)
				{
					$this->session->set_flashdata('success', 'Successfully update');
					$this->output->delete_cache("Managewebsite/edit_website/$id/");
					redirect("Managewebsite/edit_website/$id/",'refresh');
				}
				else{
					$error['error'] = "Problem with insert!";
					$error['websitedata'] = $this->Master_model->select_data('mov_website','*','MWM_ID='.$id);
					$this->load->view('edit_website',$error);
				}
			}
		}		
	}
	
	public function analiticformat()
	{
		$ids = $this->session->userdata('id');
		$this->form_validation->set_rules('analitics', 'Analitics', 'trim|required');
		$this->form_validation->set_rules('emailwebid', 'WebSite', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{	
			echo 'no';
		}
		else
		{	
			$analitics = $this->input->post('analitics');
			$emailwebid = $this->input->post('emailwebid');

			$analitcdataarray = array('MWM_Google_Analytics'=>$analitics,'MWM_UpdatedBY'=>$ids);
			$dataupdated = $this->Master_model->updatedatawhere("MWM_ID=$emailwebid",$analitcdataarray,'mov_website');

			if($dataupdated > 0)
			{ 
				echo '1';
			}
			else{
				echo 'no';
			}
		}
		
	}
	
	public function fbvalue()
	{
		$this->form_validation->set_rules('fblist', 'Facebook List', 'trim|required');
		$this->form_validation->set_rules('emailwebid', 'WebSite', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{	
				echo 'no';
		}
		else
		{	
				
			$fblist = $this->input->post('fblist');
			$emailwebid = $this->input->post('emailwebid');

			$data = $this->Master_model->select_data('flr_social_plugin','FSP_Code,FSP_Status',"FSP_NAME=$fblist and FWM_ID = $emailwebid");

			if($data)
			{
				foreach($data as $obj)
				{
					echo $obj->FSP_Code.",".$obj->FSP_Status;
				}
			}
			else{
				echo 'no';
			} 
		}
	}
	
	
	public function fbconfig()
	{
		$ids = $this->session->userdata('id');
		$this->form_validation->set_rules('fblist', 'Facebook List', 'trim|required');
		$this->form_validation->set_rules('fbdesc', 'Facebook Description', 'trim|required');
		$this->form_validation->set_rules('emailwebid', 'WebSite', 'trim|required');
		$this->form_validation->set_rules('fbactive', 'Facebook Active', 'trim');
		
		if ($this->form_validation->run() == FALSE)
		{	
				echo 'no';
		}
		else
		{	
			$fblist = $this->input->post('fblist');
			$fbdesc = $this->input->post('fbdesc');
			$emailwebid = $this->input->post('emailwebid');
			$fbactive = $this->input->post('fbactive');

			$count = $this->Master_model->checkdata('FSP_NAME,FWM_ID','flr_social_plugin',"FSP_NAME=$fblist and FWM_ID = $emailwebid");

			if($count > 0)
			{
				$fbdataarray = array('FSP_NAME'=>$fblist,'FWM_ID'=>$emailwebid,'FSP_Code'=>$fbdesc,'FSP_Status'=>$fbactive,'FSP_UpdatedBY'=>$ids);
				$dataupdated = $this->Master_model->updatedatawhere("FSP_NAME=$fblist and FWM_ID = $emailwebid",$fbdataarray,'flr_social_plugin');
			}
			else{
				$fbdataarray = array('FSP_NAME'=>$fblist,'FWM_ID'=>$emailwebid,'FSP_Code'=>$fbdesc,'FSP_Status'=>$fbactive,'FSP_CreatedBY'=>$ids,'FSP_CreatedDate'=>date("Y-m-d H:i:s"),'FSP_UpdatedBY'=>$ids);
				$dataupdated = $this->Master_model->Insertdata('flr_social_plugin',$fbdataarray);
			}

			if($dataupdated > 0)
			{ 
				echo '1';
			}
			else{
				echo 'no';
			} 	
		} 
	}
	
	
	
	
	public function googleconfig()
	{
		$ids = $this->session->userdata('id');
		$this->form_validation->set_rules('googlelist', 'Google List', 'trim|required');
		$this->form_validation->set_rules('googledesc', 'Google Pluse Description', 'trim|required');
		$this->form_validation->set_rules('emailwebid', 'WebSite', 'trim|required');
		$this->form_validation->set_rules('googleactive', 'Facebook Active', 'trim');
		
		if ($this->form_validation->run() == FALSE)
		{	
				echo 'no';
		}
		else
		{	
			$googlelist = $this->input->post('googlelist');
			$googledesc = $this->input->post('googledesc');
			$emailwebid = $this->input->post('emailwebid');
			$googleactive = $this->input->post('googleactive');

			$count = $this->Master_model->checkdata('FSP_NAME,FWM_ID','flr_social_plugin',"FSP_NAME=$googlelist and FWM_ID = $emailwebid");

			if($count > 0)
			{
				$googledataarray = array('FSP_NAME'=>$googlelist,'FWM_ID'=>$emailwebid,'FSP_Code'=>$googledesc,'FSP_Status'=>$googleactive,'FSP_UpdatedBY'=>$ids);
				$dataupdated = $this->Master_model->updatedatawhere("FSP_NAME=$googlelist and FWM_ID = $emailwebid",$googledataarray,'flr_social_plugin');
			}
			else{
				$googledataarray = array('FSP_NAME'=>$googlelist,'FWM_ID'=>$emailwebid,'FSP_Code'=>$googledesc,'FSP_Status'=>$googleactive,'FSP_CreatedBY'=>$ids,'FSP_CreatedDate'=>date("Y-m-d H:i:s"),'FSP_UpdatedBY'=>$ids);
				$dataupdated = $this->Master_model->Insertdata('flr_social_plugin',$googledataarray);
			}

			if($dataupdated > 0)
			{ 
				echo '1';
			}
			else{
				echo 'no';
			} 	
		} 
	}
	
	
	public function display_webcms($web,$page)
	{
		$data['webcms'] = $this->Master_model->select_data('flr_webcms','FWC_SEOUrl,FWC_OGTag,FWC_MetaTitle,FWC_MetaKeyword,FWC_MetaDescription,FWC_PageCantent,FWC_PageContent_map,FWC_PageContent_2,FWC_PageContent_address',"FWCM_ID=$web and FWC_PageID=$page");
		//$data['pagename'] = $this->Master_model->select_data('flr_lov','FL_LOV_Value',"FL_ID=$page");
		//print_r($data['pagename']);  die();
		
		$data['pageid'] = $page;
		$data['webid'] = $web;
		$this->load->view('add_webcms',$data);
	}
	
	public function add_website_cms()
	{
		$ids = $this->session->userdata("id");
		$this->form_validation->set_rules('website', 'Website Name', 'required|trim');
		$this->form_validation->set_rules('page', 'Page', 'required|trim');
		$this->form_validation->set_rules('metatitle', 'Meta Title', 'trim');
		$this->form_validation->set_rules('metakeyword', 'Meta Keyword', 'trim');
		$this->form_validation->set_rules('metadesc', 'Meta Description', 'trim');
		$this->form_validation->set_rules('pagecontent', 'Page Content', 'trim');
		//$this->form_validation->set_rules('pagecontent2', 'Page Content Contact Page', 'trim');
		//$this->form_validation->set_rules('maplink', 'Map Link', 'trim');
		//$this->form_validation->set_rules('address', 'Address', 'trim');
		$this->form_validation->set_rules('seourl', 'SEO Url', 'trim');
		$this->form_validation->set_rules('ogtag', 'OF Tag', 'trim');
		
		$website = $this->input->post('website');
		$page = $this->input->post('page');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('Managewebsite/display_webcms/'.$website.'/'.$page);
			
		}
		else{
			
			$metatitle = $this->input->post('metatitle');
			$metakeyword = $this->input->post('metakeyword');
			$metadesc = $this->input->post('metadesc');
			
			$pagecontent = $this->input->post('pagecontent');
			/* $pagecontent = str_replace('<p>', '', $pagecontent);
			$pagecontent = str_replace('</p>', '', $pagecontent); */
			
			$seourl = $this->input->post('seourl');
			$ogtag = $this->input->post('ogtag');
			
			$webcsmdata = $this->Master_model->select_data('flr_webcms','FWC_PageID,FWCM_ID',"FWC_PageID = $page and FWCM_ID=$website");
			if(empty($webcsmdata[0]))
			{
				$arr = array('FWCM_ID'=>$website,'FWC_PageID'=>$page,'FWC_SEOUrl'=>$seourl,'FWC_OGTag'=>$ogtag,'FWC_MetaTitle'=>$metatitle,'FWC_MetaKeyword'=>$metakeyword,'FWC_MetaDescription'=>$metadesc,'FWC_PageCantent'=>$pagecontent,'FWC_CreatedBy'=>$ids,'FWC_CreatedDate'=>date('Y-m-d'),'FWC_UpdatedBy'=>$ids);
				$dataupdated = $this->Master_model->Insertdata('flr_webcms',$arr);
			}
			else{
				$arr = array('FWCM_ID'=>$website,'FWC_PageID'=>$page,'FWC_SEOUrl'=>$seourl,'FWC_OGTag'=>$ogtag,'FWC_MetaTitle'=>$metatitle,'FWC_MetaKeyword'=>$metakeyword,'FWC_MetaDescription'=>$metadesc,'FWC_PageCantent'=>$pagecontent,'FWC_UpdatedBy'=>$ids);
				$dataupdated = $this->Master_model->updatedatawhere("FWC_PageID = $page and FWCM_ID=$website",$arr,'flr_webcms');
			}
			
			if($dataupdated > 0)
			{
				$this->session->set_flashdata('success',"Website CMS Updated!");
				redirect('Managewebsite/display_webcms/'.$website.'/'.$page);
			}
			else{
				$this->session->set_flashdata('error', "Problem with Website CMS Updation!");
				redirect('Managewebsite/display_webcms/'.$website.'/'.$page);
			}
		}
	}
	
	
	
	
	public function chkusertmp()
	{
		
		$ids = $this->session->userdata('id');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
		$this->form_validation->set_rules('statuscl', 'Statuscl', 'trim|required');
		$this->form_validation->set_rules('newsletterid', 'newsletterid', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			echo "1";
		}
		else{
			
				$id = $this->session->userdata('id');
				$pass = base64_encode($this->input->post('pass'));
				
				
				$newsletterid = $this->input->post('newsletterid');
				$statuscl = $this->input->post('statuscl');
							
				$where = "FUM_ID='".$id."' and FUM_Passcode='".$pass."'";
				$ans = $this->Master_model->checklogin("flr_user_master","FUM_Role,FUM_ID,FUM_Full_name",$where);
				if($ans == 'no')
				{
					echo "2";
				}
				else
				{
					$arr = array('FNL_Status'=>$statuscl,'FNL_UpdatedBy'=>$ids);					
					$updatestatus = $this->Master_model->updatedata('FNL_ID',$newsletterid,$arr,'flr_newsletter');
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
	
	
	
	
	public function dbbackup()
	{
		$filename = date('Y-m-d').'-zapingo.sql';
		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		
		$backup = $this->dbutil->backup();

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		//check 1 means server back up 2 means localback download
		// if($check == 1)
		// {
			write_file(UPLOAD_PATH.".dbbackup/$filename", $backup);
		// }	
		// else{
			$this->load->helper('download');
			force_download("$filename", $backup);
		// }
		
		
		$this->session->set_flashdata('success',"Database Backup successfully path uploads/dbbackup/$filename");
		redirect("Managewebsite/edit_website/".CURRENT_WEBSITE."/");
		
	}
	
	
	
}
?>