<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Master_model');
        $this->load->library('form_validation');
        
    } 
    
    public function faq()
    {
        $this->load->view("faq");
    }
    
    
    public function display_page($pgid)
    {   
        $data['courses'] = $this->Master_model->select_data('lc_course','*',"LCC_STATUS = 1");
        $data['pagecontent'] = $this->Master_model->select_data('lc_dynamic_page','*',"LCDP_ID = $pgid");
        $data['testimonials'] = $this->Master_model->select_data('lc_testimonial','*',"LCT_STATUS = 1");
        $this->load->view("dynamic-page",$data);
    }   
    
    public function display_cms_details($page)
    {
        $data['webcms'] = $this->Master_model->select_data('mov_page_content','*',"MM_ID=$page");
        
        $data['pageid'] = $page;
        $this->load->view('manage_page',$data);
    }
    
    public function add_cms_details()
    {
        $ids = $this->session->userdata("id");
        $this->form_validation->set_rules('pagename', 'Page Name', 'required|trim');
        $this->form_validation->set_rules('metatitle', 'Meta Title', 'trim');
        $this->form_validation->set_rules('metakeyword', 'Meta Keyword', 'trim');
        $this->form_validation->set_rules('metadesc', 'Meta Description', 'trim');
        $this->form_validation->set_rules('seourl', 'SEO Url', 'trim');
        $this->form_validation->set_rules('pagecontent1', 'Page Content 1', 'trim');
        $this->form_validation->set_rules('pagecontent2', 'Page Content 2', 'trim');
        $this->form_validation->set_rules('pagecontent3', 'Page Content 3', 'trim');
        $this->form_validation->set_rules('pagecontent4', 'Page Content 4', 'trim');
        
        
        $page = $this->input->post('pagename');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Page/manage_page/'.$page);
            
        }
        else{

             $seourl = $this->input->post('seourl');
            $metatitle = $this->input->post('metatitle');
            $metakeyword = $this->input->post('metakeyword');
            $metadesc = $this->input->post('metadesc');
            $pagecontent1 = $this->input->post('pagecontent1');         
            $pagecontent2 = $this->input->post('pagecontent2');
            $pagecontent3 = $this->input->post('pagecontent3');         
            $pagecontent4 = $this->input->post('pagecontent4');
            
            $status = 0;
            if($this->input->post('status'))
            {
                $status = 1;
            }
            $cmurlname = '';
            //$coursename = $this->Master_model->select_data('mov_lov','ML_LOV_Value',"ML_LOV_Status = 1 and ML_ID = $page");
            //print_r($coursename); die();
            $coursename = $this->Master_model->select_data('mov_menu','MM_Name',"MM_Status = 1 and MM_ID = $page");
            foreach($coursename as $cmurl)
            {
                $cmurlname = $cmurl->MM_Name;
            }
            
            $seourl = $this->input->post('seourl');
            
            
            if($seourl == '')
            {
                $seourl = str_replace('&', 'and', $cmurlname);
                $seourl1 = str_replace(' ', '-', $seourl); 
                $seourl2 = str_replace("'", "", $seourl1); 
                $seourl3 = strtolower($seourl2); 
                $seourl4 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $seourl3);
                $seourl5 = str_replace('%', '', $seourl4);                      
            
                $count = $this->Master_model->checkdata('MPC_ID','mov_page_content',"MPC_seo_url='$seourl5'");                 
                if($count > 1)
                {
                    $maxid = 0;
                    $row = $this->db->query('SELECT MAX(MPC_ID) AS `maxid` FROM `mov_page_content`')->row();
                    if ($row) {
                        $maxid = $row->maxid; 
                    }
                $seourl5 = $seourl5.'-'.$maxid;
                }
            }
            else 
            {
                $seourl = str_replace('&', 'and', $seourl);
                $seourl1 = str_replace(' ', '-', $seourl); 
                $seourl2 = str_replace("'", "", $seourl1); 
                $seourl3 = strtolower($seourl2); 
                $seourl4 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $seourl3);
                $seourl5 = str_replace('%', '', $seourl4);                      
            
                $count = $this->Master_model->checkdata('MPC_ID','mov_page_content',"MPC_seo_url='$seourl5'");                 
                if($count > 1)
                {
                    $maxid = 0;
                    $row = $this->db->query('SELECT MAX(MPC_ID) AS `maxid` FROM `mov_page_content`')->row();
                    if ($row) {
                        $maxid = $row->maxid; 
                    }
                $seourl5 = $seourl5.'-'.$maxid;
                }       
            }
            
             //  pic 
            
            // if(!empty($_FILES["cimg"]['name']))
            // {
            //     $new_name_cimg = time().'_'.$_FILES["cimg"]['name'];
            //     $config['file_name'] = $new_name_cimg;
            //     $new_name_cimg = str_replace(' ', '_', $new_name_cimg);
            //     $config['upload_path'] = 'uploads/dynamic/';
            //     $config['allowed_types'] = 'jpg|jpeg|png';
            //     $config['max_size']             = 50000;
            //     $config['max_width']            = 50000;
            //     $config['max_height']           = 50000;
            //     $this->load->library("upload", $config);
            //     $this->upload->initialize($config);
            //     if (!$this->upload->do_upload('cimg'))
            //     {
            //         $new_name_cimg = '';
            //     }
            // }
            // else
            // {
            //     //echo "1"; die();
            //     $new_name_cimg = '';
            // }
                
            // pic
            
            // if(!empty($_FILES["cbanner"]['name']))
            // {
            //     //echo $new_name_cbanner; die();
            //     $new_name_cbanner = time().'_'.$_FILES["cbanner"]['name'];
            //     $config['file_name'] = $new_name_cbanner;
            //     $new_name_cbanner = str_replace(' ', '_', $new_name_cbanner);
            //     $config['upload_path'] = 'uploads/dynamic/';
            //     $config['allowed_types'] = 'jpg|jpeg|png';
            //     $config['max_size']             = 50000;
            //     $config['max_width']            = 50000;
            //     $config['max_height']           = 50000;
            //     $this->load->library("upload", $config);
            //     $this->upload->initialize($config);
            //     if (!$this->upload->do_upload('cbanner'))
            //     {
            //         $new_name_cbanner = '';
            //     }
            // }
            // else
            // {
            //     $new_name_cbanner = '';
            // }
            
            $webcsmdata = $this->Master_model->select_data('mov_page_content','*',"MM_ID = $page");
            if(empty($webcsmdata[0]))
            {
                $arr = array(
                'MM_ID' => $page,
                'MPC_seo_url' => $seourl,
                'MPC_seo_title' => $metatitle,
                'MPC_seo_keyword' =>  $metakeyword,
                'MPC_seo_description' => $metadesc,
                'MPC_content' => $pagecontent1,
                'MPC_content2' => $pagecontent2,
                'MPC_content3' =>$pagecontent3,
                'MPC_content4' =>$pagecontent4,
                'MPC_status'=>$status,
                );

                
                $dataupdated = $this->Master_model->Insertdata('mov_page_content',$arr);
            }
            else
            {
                $arr = array(
                'MM_ID' => $page,
                'MPC_seo_url' => $seourl,
                'MPC_seo_title' => $metatitle,
                'MPC_seo_keyword' =>  $metakeyword,
                'MPC_seo_description' => $metadesc,
                'MPC_content' => $pagecontent1,
                'MPC_content2' => $pagecontent2,
                'MPC_content3' =>$pagecontent3,
                'MPC_content4' =>$pagecontent4,
                'MPC_status'=>$status,
                 );
                
                // if($new_name_cimg !=''){
                // $arr['LCDP_display_img'] = $new_name_cimg;
                // }
                // if($new_name_cbanner !=''){
                // $arr['LCDP_banner_img'] = $new_name_cbanner;
                // } 
                
                $dataupdated = $this->Master_model->updatedatawhere("MM_ID = $page",$arr,'mov_page_content');
            }
            
            if($dataupdated > 0)
            {
                $this->session->set_flashdata('success',"CMS Updated!");
                redirect('Page/display_cms_details/'.$page);
            }
            else{
                $this->session->set_flashdata('error', "Problem with CMS Updation!");
                redirect('Page/display_cms_details/'.$page);
            }
        }
    }

    /*public function manage_page()
    {
        // echo '<pre>';        
$page = $this->input->post('pagename');
        $webcsmdata = $this->Master_model->select_data('mov_page_content','*',"MPC_ID = $page");
            if(empty($webcsmdata[0]))
            {
                
                   $arr = array(
            'ML_ID' => $_POST['pagename'],
            'MPC_seo_url' => $_POST['seourl'],
            'MPC_seo_title' => $_POST['metatitle'],
            'MPC_seo_keyword' => $_POST['metakeyword'],
            'MPC_seo_description' => $_POST['metadesc'],
            'MPC_content' => $_POST['pagecontent1'].$_POST['pagecontent2'].$_POST['pagecontent3'].$_POST['pagecontent4'],
            'MPC_status'=>$_POST['status'],
        );
        $dataupdated = $this->Master_model->Insertdata('mov_page_content',$arr);

            }else{

   $arr = array(
            'ML_ID' => $_POST['pagename'],
            'MPC_seo_url' => $_POST['seourl'],
            'MPC_seo_title' => $_POST['metatitle'],
            'MPC_seo_keyword' => $_POST['metakeyword'],
            'MPC_seo_description' => $_POST['metadesc'],
            'MPC_content' => $_POST['pagecontent1'].$_POST['pagecontent2'].$_POST['pagecontent3'].$_POST['pagecontent4'],
            'MPC_status'=>$_POST['status'],
        );
        $dataupdated = $this->Master_model->updatedatawhere("MPC_ID = $page",$arr,'mov_page_content');
            }
     

$this->load->library('user_agent');

            if($dataupdated > 0)
            {
                $this->session->set_flashdata('success',"Page Updated!");
                redirect($this->agent->referrer());
            }
            else{
                $this->session->set_flashdata('error', "Problem with Page Updation!");
                redirect($this->agent->referrer());
            }
    }*/

    public function edit($page = 0)
    {
        $webcsmdata = $this->Master_model->select_data('mov_page_content','*',"MPC_ID = $page");
        // var_dump($webcsmdata);
        $this->load->view('manage_page', array('data'=>$webcsmdata));
    }
    
    

}
    
    