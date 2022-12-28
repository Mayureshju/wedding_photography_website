<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
* SMS Global Library for CodeIgniter
*
* author: PX Webdesign
* site: http://www.pxwebdesign.com.au/
*/

class Sms_global1 {

	var $user;
	var $pass;
	var $to;
	var $from;
	var $message;
	var $error;
	var $smsID;
	var $serverResponse;
	
	function _clear()
	{
		$this->user = '';
		$this->pass = '';
		$this->to = '';
		$this->from = '';
		$this->message = '';
		$this->error = '';
		//$this->smsID = '';
		
	}
	
	function Sms_global($config = array())
	{		
		$this->_clear();
		if (count($config) > 0)
		{
			foreach ($config as $key => $val)
			{
				$this->$key = $val;
			}
		}	

	}
	
	function user($user)
	{
		$this->user = $user;
	}
	
	function pass($pass)
	{
		$this->pass = $pass;
	}
	
	function to($to)
	{
		$this->to = $to;
	}
	
	function from($from)
	{
		$this->from = $from;
	}
	
	function message($message)
	{
		$this->message = $message;
	}
	
	
	
	function send()
	{
		// Check to is set
		if (!$this->to)
		{
			$this->error .= "No message entered<br />";
		}
		// Check msg is set
		if (!$this->message)
		{
			$this->error .= "No message entered<br />";
		}
		// Check from is set
		if (!$this->from)
		{
			$this->error .= "No 'from' number set<br />";
		}
		
		// If no error then send
		if (!$this->error)
		{
			$smsID = $this->sg_send_sms($this->user, $this->pass, $this->from, $this->to, $this->message);
		
			if (!$smsID)
			{
				$this->error = 'SMS Global failure';
			}
		}
		$this->smsID = $smsID;		
	}
	
	function get_sms_id()
	{
		return $this->smsID;
	}
	
	function print_debugger()
	{
		echo '<strong>Status:</strong> ';
		if ($this->error)
		{
			echo $this->error.'<br />';
		} 
		else
		{
			echo 'SMS sent succesfully<br />';
		}
		echo '<strong>SMS ID:</strong> '.$this->smsID.'<br />';
		echo '<strong>Username:</strong> '.$this->user.'<br />';
		echo '<strong>Password:</strong> '.$this->pass.'<br />';
		echo '<strong>From:</strong> '.$this->from.'<br />';
		echo '<strong>To:</strong> '.$this->to.'<br />';
		echo '<strong>Message:</strong> '.$this->message.'<br />';
		echo '<strong>Server Response</strong> '.$this->serverResponse;
		
	}
	
	function sg_send_sms($user,$pass,$sms_from,$sms_to,$sms_msg)  
	{  	
		$msg_type = "text";  	
		$unicode = "0";            
		$query_string = "http-api.php?action=sendsms&user=".$user."&password=".$pass;
		$query_string .= "&from=".rawurlencode($sms_from)."&to=".rawurlencode($sms_to);
		$query_string .= "&clientcharset=ISO-8859-1&";
		$query_string .= "text=".rawurlencode(stripslashes($sms_msg)) . "&detectcharset=1";
		//echo $query_string; die();
		//$url = "http://www.smsglobal.com.au/".$query_string;  	
		$url = "http://www.smsglobal.com.au/".$query_string;  	
		$curl_handle=curl_init();
		curl_setopt($curl_handle,CURLOPT_URL,$url);
		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,30);
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
		$response = curl_exec($curl_handle);
		curl_close($curl_handle);
		$this->serverResponse = $response;
		if ($response)  	
		{  		
			// got response from server  		
			$response = explode("; Sent queued message ID:",$response);  		
			$response1 = explode(":",$response[0]);  		
			$smsglobal_status = trim($response1[1]);  		
			$response2 = explode(":",$response[0]);  		
			$smsglobalmsgid = trim($response2[0]);    		
			if ($smsglobal_status=="0")  		
			{  			
				// message sent successfully  			
				$ok = $smsglobalmsgid;  		
			}  		
			else   		
			{  			
				// gateway will issue a pause here and output will be delayed
				// possible bad user name and password 
				$ok = false;  		
			}  	
		}  	
		else   	
		{  		
			// no contact with gateway  		
			$ok = false;  	
		}  	
		return $ok;  
	}

}	
?>  