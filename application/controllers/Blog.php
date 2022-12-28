<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('Master_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('email');	
		$this->load->helper('my_helper');
		$this->load->helper('menu');
	}
	

	public function index()
	{
		$data['recentblogs'] = $this->Master_model->get_data_by_limit('aow_post','APC_Post_ID,APC_Post_Name,APC_Post_featured_image,APC_Post_seo_url', "APC_Status = 1"," APC_Post_ID DESC",5);
		// echo $this->db->last_query(); die();

		$this->load->library('pagination');
		$config = [
			'base_url' => base_url("blog/"), 
			'per_page' => 3,
			'total_rows' =>$this->Master_model->user_count("APC_Post_ID ","aow_post","APC_Status = '1'"),
			'full_tag_open' => '<div class="pagination mt-30"><ul class="list-inline">',
			'next_link' => '<span aria-hidden="true">»</span>',
			'prev_link' => '<span aria-hidden="true">«</span>',
			'full_tag_close' => '</ul></div>',
			'first_tag_open' => '<li>',
			'uri_segment' => 2,
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
		$data['blogs'] = $this->Master_model->user_data('*','aow_post',"APC_publish_status=1  and APC_Status = '1'",$config['per_page'],$this->uri->segment(2));
		$this->load->view('blog_index',$data);
	}
	
	public function blog_details($blogid=0)
	{
	$data['bloglist'] = $this->Master_model->select_data('aow_post','*',"APC_publish_status=1 and APC_Status = 1 and APC_post_type = 1 and APC_Post_ID = $blogid");
	$data['blogname'] =  '';
	//print_r($data['bloglist'][0]->APC_Post_Name);
		
	$this->load->view('blog-details',$data);
	}

	public function about_us()
	{
		$this->load->view('about-us');
	}
	public function contact()
	{
		$this->load->view('contact-us');
	}
}
