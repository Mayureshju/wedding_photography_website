<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
//	echo '1'; exit;
	$this->load->view('login');
	
	}
	
	public function displayonlineusers(){
	$online_user_wel = get_list('mov_user_master','MUM_ID,MUM_Full_name,MUM_Mac_Address,MUM_Email,MUM_Profilepic',"MUM_Mac_Address <> ''");
		
		$userhtml = '';
		if(isset($online_user_wel) && $online_user_wel !=''){
		foreach($online_user_wel as $online_user_weldata){
		$usr_img_folder_foot = 'user-profile-pic/';
		$external_link_usr_foot = IMAGE_PATH.$usr_img_folder_foot.$online_user_weldata->MUM_Profilepic;
		if (@getimagesize($external_link_usr_foot)) {
			$get_usr_logo_foot = $online_user_weldata->MUM_Profilepic;
		} else {
			$get_usr_logo_foot = 'user2-160x160.jpg';
		}
			$userhtml .='<tr>
						<td>'.$online_user_weldata->MUM_Full_name.'</td>
						<td>'.$online_user_weldata->MUM_Email.'</td>
						<td><img style="max-width:50px;" src="'.IMAGE_PATH.$usr_img_folder_foot.$get_usr_logo_foot.'" alt="'.$online_user_weldata->MUM_Full_name.'" title="'.$online_user_weldata->MUM_Full_name.'" class="img-circle"></td>
						</tr>';
		} } 
		
		echo $userhtml;
			
		
	}
	
	
}
