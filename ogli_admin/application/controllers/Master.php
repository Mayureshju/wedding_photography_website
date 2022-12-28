<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Master_model');
	}
	
	public function add_nichecat()
	{
		
		$this->form_validation->set_rules('ncatname', 'niche catgory name', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim');	
		$this->form_validation->set_rules('edit_id', 'edit_id', 'trim');


		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('Nav/nichecat');
			
		}
		else
		{
				$ncatname = $this->input->post('ncatname');
				$edit_id = $this->input->post('edit_id');
				$id=$this->session->userdata('id');
				$status = 0;
				if ($this->input->post('status')) {
					$status = 1;
				}
								
				if( $this->input->post('edit_id') == '')
				{
					//Insert
					
					//check data alerady exist or not
					$wheredata = 'MNC_cat_name="'.$ncatname.'"';				
					$alreadydata = $this->Master_model->checkdata('MNC_cat_id','mov_niche_category',$wheredata);
					if($alreadydata == 0)
					{
						$ncatdata=array('MNC_cat_name'=>$ncatname,'MNC_cat_status'=>$status,'MNC_CreatedBY'=>$id,'MNC_UpdatedBy'=>$id,'MNC_Created_Date'=> date("Y-m-d H:i:s"));
						$insertdata=$this->Master_model->Insertdata('mov_niche_category',$ncatdata);
						if($insertdata>0)
						{
							$this->session->set_flashdata('success','Save Successfull!');
							redirect('Nav/nichecat');
						}
						else
						{
							$this->session->set_flashdata('error', 'Problem With Save!');
							redirect('Nav/nichecat');
						}
					}
					else{
						$this->session->set_flashdata('error', 'Category already exist!');
						redirect('Nav/nichecat');
					}
				}
				else{
					//Update
					
					$wheredata = 'MNC_cat_name="'.$ncatname.'"';	
					$alreadydata = $this->Master_model->select_data('mov_niche_category','MNC_cat_id',$wheredata);
					
					if(!empty($alreadydata[0]))
					{
						if($alreadydata[0]->MNC_cat_id != $edit_id)
						{
							$this->session->set_flashdata('error',  "Category Already Exist!");
							redirect('Nav/nichecat');
						}
					}	
					
					
					$catdata = array('MNC_cat_name'=>$ncatname,'MNC_cat_status'=>$status,'MNC_UpdatedBy'=>$id);			   
					$Updatedata = $this->Master_model->updatedata('MNC_cat_id',$edit_id,$catdata,'mov_niche_category');
					
					//echo $this->db->last_query();die();
					if($Updatedata > 0)
					{
						$this->session->set_flashdata('success','Update Successfull!');
						redirect('Nav/nichecat');
					}
					else
					{
						$this->session->set_flashdata('error', 'Problem With Update!');
						redirect('Nav/nichecat');					
					}
				}	
		}
		
	}	

	public function changenichecatstatus()
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
                $arr = array('MNC_cat_status' => $statuscl, 'MNC_UpdatedBY' => $id);
                $updatestatus = $this->Master_model->updatedata('MNC_cat_id', $cntid, $arr, 'mov_niche_category');

                if ($updatestatus) {
                    echo "3";
                } else {
                    echo "4";
                }
            }
        }
    }
	
	
	
	public function add_lov()
	{
		
		/*-------- List of value for storing the values drop downs and checkboxes -----------*/
		$this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('value', 'value', 'trim|required');
		$this->form_validation->set_rules('name', 'name', 'trim');
		$this->form_validation->set_rules('edit_id', 'edit_id', 'trim');
		$this->form_validation->set_rules('status', 'status', 'trim');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('Nav/lov');
			
		}
		else
		{
				$title = $this->input->post('title');
				$value = $this->input->post('value');
				$name = $this->input->post('name');
				$edit_id = $this->input->post('edit_id');
				$id=$this->session->userdata('id');
				$status = 0;	
					
				if($this->input->post('status'))
				{
					$status = 1;
				}
				
				if( $this->input->post('edit_id') == '')
				{
					//Insert
					
					//check data alerady exist or not
					$wheredata = 'ML_LOV_Name="'.$title.'" and ML_LOV_Value="'.$value.'"  and ML_LOV_Type="'.$name.'"';				
					$alreadydata = $this->Master_model->checkdata('ML_ID','mov_lov',$wheredata);
					if($alreadydata == 0)
					{
						$lovdata=array('ML_LOV_Name'=>$title,'ML_LOV_Value'=>$value,'ML_LOV_Type'=>$name,'ML_CreatedBY'=>$id,'ML_LOV_Status'=>$status,'ML_CreatedDate'=> date("Y-m-d H:i:s"));
						$insertdata=$this->Master_model->Insertdata('mov_lov',$lovdata);
						if($insertdata>0)
						{
							$this->session->set_flashdata('success','Save Successfull!');
							redirect('Nav/lov');
						}
						else
						{
							$this->session->set_flashdata('error', 'Problem With Save!');
							redirect('Nav/lov');
						}
					}
					else{
						$this->session->set_flashdata('error', 'Lov already exist!');
						redirect('Nav/lov');
					}
				}
				else{
					//Update
					
					//$wheredata = 'ML_LOV_Name="'.$title.'" and ML_LOV_Value="'.$value.'"';
					$wheredata = 'ML_LOV_Name="'.$title.'" and ML_LOV_Value="'.$value.'"  and ML_LOV_Type="'.$name.'"';		
					$alreadydata = $this->Master_model->select_data('mov_lov','ML_ID',$wheredata);
					
					if(!empty($alreadydata[0]))
					{
						if($alreadydata[0]->ML_ID != $edit_id)
						{
							$this->session->set_flashdata('error',  "LOV Already Exist!");
							redirect('Nav/lov');
						}
					}	
					
					
					$lovdata = array('ML_LOV_Name'=>$title,'ML_LOV_Value'=>$value,'ML_LOV_Type'=>$name,'ML_UpdatedBY'=>$id,'ML_LOV_Status'=>$status);			   
					$Updatedata = $this->Master_model->updatedata('ML_ID',$edit_id,$lovdata,'mov_lov');
					
					//echo $this->db->last_query();die();
					if($Updatedata > 0)
					{
						$this->session->set_flashdata('success','Update Successfull!');
						redirect('Nav/lov');
					}
					else
					{
						$this->session->set_flashdata('error', 'Problem With Update!');
						redirect('Nav/lov');					
					}
				}	
		}
		
	}	
	
	public function get_lov()
	{
		if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->Master_model->get_flov($q);
		}
	}

	
		
}
?>