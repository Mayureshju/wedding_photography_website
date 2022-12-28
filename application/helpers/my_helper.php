<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// if(!function_exists('get_email_data'))
// {
// 	function get_email_data()
// 	{
// 		$CI =& get_instance();
// 		$config['protocol']    = 'smtp';		
//     	$config['smtp_host']    = 'ssl://smtp.googlemail.com';
// 	//	$config['smtp_host']    = 'smtp.gmail.com';
// 		$config['smtp_port']    =  '465';
// 		$config['smtp_timeout'] = '7';
// 		$config['smtp_user']    =  'formspaceanddesign@gmail.com';
// 		$config['smtp_pass']    =  'pscl1988';
// 		$config['charset']    = 'utf-8';		
// 		// $config['charset']    = 'iso-8859-1';	
// 		$config['newline']    = "\r\n";
// 		$config['mailtype'] = 'html';
// 		$config['validation'] = TRUE; 
// 		return $config;
		
// 	}
// }


if(!function_exists('get_email_data'))
{
	function get_email_data()
	{
		$CI =& get_instance();
		$config['protocol']    = 'smtp';		
		$config['smtp_host']    = 'ssl://mail.webswizards.in';
		$config['smtp_port']    =  '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    =  'contactus@webswizards.in';
// 		$config['smtp_pass']    =  'Qxr9w5L101I&';
        $config['smtp_pass']    =  'Mayuresh1234@';
		$config['charset']    = 'utf-8';		
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = TRUE; 
		return $config;
	}
}


?>