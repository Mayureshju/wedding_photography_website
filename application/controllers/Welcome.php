<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->library('email');	
        $this->load->helper('my_helper');
        //$this->output->cache(60);
    }
    public function head()
    {
        $this->load->view('basic/head');
    }

    public function header()
    {
        $this->head();
        $this->load->view('basic/header');
    }

    public function footer()
    {
        $this->load->view('basic/footer');
    }

   public function index()
    {
        $data['homebanners'] = $this->Mymdl->select_data('mov_home_banner', '*', "");
        $this->load->view('home', $data);
    }

    public function about()
    {
      
        $data['data'] = $this->Mymdl->select_data('mov_pages_banner', '*', "");
        $this->load->view('about', $data);

    }

    // residential ***************

    public function residential_interior()
    {
        $data['all_residential'] = $this->Mymdl->all_residential_interior();
        $data['data'] = $this->Mymdl->select_data('mov_pages_banner', '*', "");
        $this->load->view('photography', $data);
    }
    public function portfolio_details($id)
    {
        $data['all_residential'] = $this->Mymdl->all_residential_interior();
        $data['residential_details'] = $this->Mymdl->all_residential_details($id);
        $this->load->view('portfolio_details', $data);
    }

    // restaurant **************

    public function portfolio_details_restaurant($id)
    {
        $data['all_restaurant'] = $this->Mymdl->all_restaurant_interior();
        $data['details_restaurant'] = $this->Mymdl->portfolio_details_restaurant($id);
        $this->load->view('portfolio_details_restaurant', $data);
    }

    public function restaurant_design()
    {
        $data['all_restaurant'] = $this->Mymdl->all_restaurant_interior();
        $data['data'] = $this->Mymdl->select_data('mov_pages_banner', '*', "");
        $this->load->view('restaurant_design', $data);
    }

    // commercial ****************

    public function commercial_interior()
    {
        $data['all_commercial'] = $this->Mymdl->all_commercial_interior();
        $data['data'] = $this->Mymdl->select_data('mov_pages_banner', '*', "");
        $this->load->view('commercial_interior', $data);
    }

    public function portfolio_details_commercial($id)
    {
        $data['all_commercial'] = $this->Mymdl->all_commercial_interior();
        $data['details_commercial'] = $this->Mymdl->portfolio_details_commercial($id);
        $this->load->view('commercial_details_restaurant', $data);
    }

    // architecture *****************

    public function architecture()
    {
        $data['all_architecture'] = $this->Mymdl->all_architecture_interior();
        $data['data'] = $this->Mymdl->select_data('mov_pages_banner', '*', "");
        $this->load->view('architecture', $data);
    }

    public function architecture_details($id)
    {
        
        $data['all_architecture'] = $this->Mymdl->all_architecture_interior();
        $data['details_architecture'] = $this->Mymdl->portfolio_details_architecture($id);
        $this->load->view('architecture_details', $data);
       
    }

    public function interior_design_blogs()
    {
        $this->header();
        $this->load->view('interior_design_blogs');
        $this->footer();
    }

    public function contactus()
    {
       
        $data['data'] = $this->Mymdl->select_data('mov_pages_banner', '*', "");
        $this->load->view('contactus', $data);
       
    }

    public function blog_one()
    {
        $this->header();
        $this->load->view('blog/top-10-types-of-good-quality-wood-for-your-home-furniture');
        $this->footer();
    }


    public function send_mail()
    {


        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        if (($_POST['first_name'] != "") && ($_POST['email'] != "")) {
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $message = $this->input->post('message');

            $subject = 'New inquiry';

            $from = "formspaceanddesign@gmail.com";
            $to = "nmalviya575@gmail.com";

            $subject = $subject;

            $message = "First name: $first_name \n \n Last name: $last_name \n \n Email : $email \n \n Phone Number: $phone \n \n Message: $message";

            $sent =  mail($to, $subject, $message);
            if ($sent) {
                $this->session->set_flashdata("success", "Message sent successfully");
                // redirect(base_url('myctrl/user_signup'));
                redirect(base_url('contact-us'));
            } else {
                $this->session->set_flashdata("failure", "Failed!");
                // redirect(base_url('myctrl/user_signup'));
                redirect(base_url('contact-us'));
            }
        }
    }

    // quick contact

    public function quick_contact()
    {
        $this->form_validation->set_rules("first_name", "Name", "trim|required");
        $this->form_validation->set_rules("last_name", "Name", "trim|required");
        $this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
        $this->form_validation->set_rules("phone", "Mobile", "trim|required");
        $this->form_validation->set_rules("message", "Message", "trim|required");
        
        // $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
      
        // $url = $this->input->post('url');
        // if (filter_var($url, FILTER_VALIDATE_URL)) {
        if ($this->form_validation->run() == true) {

            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $name =  $first_name . ' ' . $last_name;
            $mobile = $this->input->post('phone');
            $email = $this->input->post('email');
            $msg = $this->input->post('message');
            $msg = str_replace("href=", "", $msg);
           
            $config = get_email_data();

            $this->email->initialize($config);	

            // $this->email->from('formspaceanddesign@gmail.com', 'pscl1988');
            // $this->email->to('nmalviya575@gmail.com');

            // $config = get_email_data(); 
            			
			
			$this->email->from($email, 'New Enquiry From Website'); 		
			$this->email->to(OWNER_MAIL);	

            $this->email->subject('New Enquiry');

            $message = "<html>
                <head>
                <title>New Enquiry</title>
                </head>
                <body>					
                        Hello, <br><br><br>
                        Enquiry form details,<br><br>
                        <table>
                        <tr><td>Name:</td><td>" . $name . "</td></tr>
                        <tr><td>Email ID:</td><td>" . $email . "</td></tr>
                        <tr><td>Contact No:</td><td>" . $mobile . "</td></tr>
                        <tr><td>Message:</td><td>" . $msg . "</td></tr>
                        </table>
                        
                </body>
                </html>
                ";

            $this->email->message($message);
            $this->load->library('email', $config);
		
        //  $this->email->send();				
				//  echo $this->email->print_debugger(); exit;

            
                if($this->email->send()) {
                    $this->session->set_flashdata('success', "Thank you ......, Your inquiry has been sent, We will contact you soon !");
                    redirect(base_url() . 'contact-us');
            
            } else {
                $this->session->set_flashdata('error', "Your inquiry not been sent,Please try again!");
                redirect(base_url() . 'contact-us');
            }
        } else {
            $this->session->set_flashdata('error', "Invalid url ! Please enter a valid url!");
            redirect(base_url() . 'contact-us');
        }
    }


    public function quick_contact_home()
    {
        $this->form_validation->set_rules("first_name", "Name", "trim|required");
        $this->form_validation->set_rules("last_name", "Name", "trim|required");
        $this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
        $this->form_validation->set_rules("phone", "Mobile", "trim|required");
        $this->form_validation->set_rules("message", "Message", "trim|required");
        
        // $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
      
        // $url = $this->input->post('url');
        // if (filter_var($url, FILTER_VALIDATE_URL)) {
        if ($this->form_validation->run() == true) {

            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $name =  $first_name . ' ' . $last_name;
            $mobile = $this->input->post('phone');
            $email = $this->input->post('email');
            $msg = $this->input->post('message');
            $msg = str_replace("href=", "", $msg);
           
            $config = get_email_data();

            $this->email->initialize($config);	

            // $this->email->from('formspaceanddesign@gmail.com', 'pscl1988');
            // $this->email->to('nmalviya575@gmail.com');

            // $config = get_email_data(); 
            			
			
			$this->email->from($email, 'New Enquiry From Website'); 		
			$this->email->to(OWNER_MAIL);	

            $this->email->subject('New Enquiry');

            $message = "<html>
                <head>
                <title>New Enquiry</title>
                </head>
                <body>					
                        Hello, <br><br><br>
                        Enquiry form details,<br><br>
                        <table>
                        <tr><td>Name:</td><td>" . $name . "</td></tr>
                        <tr><td>Email ID:</td><td>" . $email . "</td></tr>
                        <tr><td>Contact No:</td><td>" . $mobile . "</td></tr>
                        <tr><td>Message:</td><td>" . $msg . "</td></tr>
                        </table>
                        
                </body>
                </html>
                ";

            $this->email->message($message);
            $this->load->library('email', $config);
		
        //  $this->email->send();				
				//  echo $this->email->print_debugger(); exit;

            
                if($this->email->send()) {
                    $this->session->set_flashdata('success', "Thank you ......, Your inquiry has been sent, We will contact you soon !");
                    redirect(base_url());
            
            } else {
                $this->session->set_flashdata('error', "Your inquiry not been sent,Please try again!");
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('error', "Invalid url ! Please enter a valid url!");
            redirect(base_url());
        }
    }
    
  
    
   


   
}
