<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('my_file'))
{
	function my_file($filename,$type)
	{
		$path=base_url()."public/";
		
		if($type==1)
		{
			$str= "<link href='".$path."css/$filename.css' rel='stylesheet'/>";
		}
		if($type==2)
		{
			$str="<script src='".$path."js/$filename.js' ></script>";
		}
		
		return $str;
	}
}
if(!function_exists('my_file1'))
{
	function my_file1($filename,$type)
	{
		$path=base_url()."public/";
		
		if($type==1)
		{
			$str= "<link href='".$path."$filename.css' rel='stylesheet'/>";
		}
		if($type==2)
		{
			$str="<script src='".$path."$filename.js' ></script>";
		}
		
		return $str;
	}
}
if(!function_exists('my_files_in_vendor'))
{
	function my_files_in_vendor($filename,$type)
	{
		$path=base_url()."public/vendors/";
		
		if($type==1)
		{
			$str= "<link href='".$path."$filename.css' rel='stylesheet'/>";
		}
		if($type==2)
		{
			$str="<script src='".$path."$filename.js' ></script>";
		}
		
		return $str;
	}
}

if (!function_exists('get_row')) {
    function get_row($tbl, $field, $where)
    {
        $CI =& get_instance();
        $CI->db->select($field);
        if ($where != '') {
            $CI->db->where($where);
        }
            
        $query=$CI->db->get($tbl);
        return $query->row();
    }
}

if(!function_exists('get_list'))
{
	function get_list($tbl,$field,$where)
	{
			$CI =& get_instance();
			$CI->db->select($field);
			if($where != '')
			{
				$CI->db->where($where);	
			}
			
			$query=$CI->db->get($tbl);
			return $query->result();
		
	}
}

if(!function_exists('get_list_order_by')) /* //varun */
{
	function get_list_order_by($tbl,$field,$where,$order)
	{
			$CI =& get_instance();
			$CI->db->select($field);
			if($where != '')
			{
				$CI->db->where($where);	
			}
			if($order != '')
			{
				$CI->db->order_by($order);	
			}
			
			
			$query=$CI->db->get($tbl);
			return $query->result();
		
	}
}

if(!function_exists('get_list_data'))
{
	function get_list_data($query)
	{
			$CI =& get_instance();
			$q = $CI->db->query($query);
			return $q->result();
		
	}
}

if(!function_exists('convert_commas_to_value'))
{
	function convert_commas_to_value($table,$field,$str,$where)
	{
		
			$CI =& get_instance();
			$finalstring = '';
			$array = explode(",",$str);
			$arr = array();
			
			for($i=0;$i<count($array);$i++)
			{
				$CI->db->select($field);
				$CI->db->where($where,$array[$i]);	
				$query = $CI->db->get($table);
				$data = $query->result();
				
				foreach($data as $obj)
				{
					$arr[$i] = $obj->$field;
				}
				
			}
			$finalstring = implode(", ",$arr);
			
			return $finalstring;
		
	}
}




if(!function_exists('dropdown'))
{
	function dropdown($field1,$field2,$table,$condition,$name)
	{
			$CI =& get_instance();
			
			echo "<select name='$name' class='form-control' id='$name'>";
			
			$CI->db->select("$field1,$field2"); 
			$CI->db->from($table);
			$CI->db->where($condition);
			$ans = $CI->db->get();
			
			$ans1 = $ans->result();
			
			if($ans->num_rows() == 0)
			{
				echo"<option>No data</option>";
			}
			else
			{
				
				foreach($ans1 as $key=>$value)
				{	
					echo "<option value='".$value->$field1."'>".$value->$field2."</option>";
				}
			}
			echo "</select>";
	}
}

if(!function_exists('dropdown_with_select'))
{
	function dropdown_with_select($field1,$field2,$id,$table,$condition,$name)
	{
		
		
			$CI =& get_instance();
			echo "<select name='$name' class='form-control select2_single' id='$name' tabindex='-1'>";
			
			$CI->db->select("$field1,$field2"); 
			$CI->db->from($table);
			if($condition != '')
			{
				$CI->db->where($condition);
			}	
			
			$ans = $CI->db->get();
			
			$ans1 = $ans->result();
			//echo $CI->db->last_query();
			
			if($ans->num_rows() == 0)
			{
				echo"<option>No data</option>";
			}
			else
			{
				echo "<option value='' ></option>";
				foreach($ans1 as $key=>$value)
				{	
					if($id == trim($value->$field1))
					echo "<option value='".$value->$field1."' selected/>".$value->$field2."</option>";
					else
					echo "<option value='".$value->$field1."'/>".$value->$field2."</option>";
				}
			}
			echo "</select>";
	}
}

if(!function_exists('dropdown_with_select_disabled'))
{
	function dropdown_with_select_disabled($field1,$field2,$id,$table,$condition,$name)
	{
		
		
			$CI =& get_instance();
			echo "<select name='$name' class='form-control select2_single' id='$name' tabindex='-1' disabled>";
			
			$CI->db->select("$field1,$field2"); 
			$CI->db->from($table);
			if($condition != '')
			{
				$CI->db->where($condition);
			}	
			
			$ans = $CI->db->get();
			
			$ans1 = $ans->result();
			//echo $CI->db->last_query();
			
			if($ans->num_rows() == 0)
			{
				echo"<option>No data</option>";
			}
			else
			{
				echo "<option value='' ></option>";
				foreach($ans1 as $key=>$value)
				{	
					if($id == $value->$field1)
					echo "<option value='".$value->$field1."' selected/>".$value->$field2."</option>";
					else
					echo "<option value='".$value->$field1."'/>".$value->$field2."</option>";
				}
			}
			echo "</select>";
	}
}




if(!function_exists('dropdown_with_select_class'))
{
	function dropdown_with_select_class($field1,$field2,$id,$table,$condition,$name,$class)
	{
		
		
			$CI =& get_instance();
			echo "<select name='$name' class='$class' id='$name' tabindex='-1' multiple='multiple'>";
			
			$CI->db->select("$field1,$field2"); 
			$CI->db->from($table);
			if($condition != '')
			{
				$CI->db->where($condition);
			}	
			
			$ans = $CI->db->get();
			
			$ans1 = $ans->result();
			//echo $CI->db->last_query();
			
			if($ans->num_rows() == 0)
			{
				echo"<option>No data</option>";
			}
			else
			{
				echo "<option value='' ></option>";
				foreach($ans1 as $key=>$value)
				{	
					if($id == $value->$field1)
					echo "<option value='".$value->$field1."' selected/>".$value->$field2."</option>";
					else
					echo "<option value='".$value->$field1."'/>".$value->$field2."</option>";
				}
			}
			echo "</select>";
	}
}




if(!function_exists('dropdown_with_select_multiple'))
{
	function dropdown_with_select_multiple($field1,$field2,$id,$table,$condition,$name)
	{
		
		
			$CI =& get_instance();
			echo "<select name='".$name."[]' class='form-control' id='$name' multiple='multiple'>";
			
			$CI->db->select("$field1,$field2"); 
			$CI->db->from($table);
			if($condition != '')
			{	
				$CI->db->where($condition);
			}	
			$ans = $CI->db->get();
			
			$ans1 = $ans->result();
			
			if($ans->num_rows() == 0)
			{
				echo"<option>No data</option>";
			}
			else
			{
				
				foreach($ans1 as $key=>$value)
				{	
					if(in_array($value->$field1, $id))
					
					echo "<option value='".$value->$field1."' selected/>".$value->$field2."</option>";
					else
					echo "<option value='".$value->$field1."'/>".$value->$field2."</option>";
				}
			}
			echo "</select>";
	}
}


if(!function_exists('dropdown_with_select_multiple_all'))
{
	function dropdown_with_select_multiple_all($field1,$field2,$id,$table,$condition,$name)
	{
			$CI =& get_instance();
			echo "<select name='".$name."[]' class='form-control' id='$name' multiple='multiple'>";
			
			$CI->db->select("$field1,$field2"); 
			$CI->db->from($table);
			if($condition != '')
			{	
				$CI->db->where($condition);
			}	
			$ans = $CI->db->get();
			
			$ans1 = $ans->result();
			
			if($ans->num_rows() == 0)
			{
				echo"<option>No data</option>";
			}
			else
			{
				//echo "<select name='langOpt3[]' class='form-control' id='langOpt3' multiple='multiple'>";
				
				foreach($ans1 as $key=>$value)
				{	
					if(in_array($value->$field1, $id))
					
					echo "<option value='".$value->$field1."' selected/>".$value->$field2."</option>";
					else
					echo "<option value='".$value->$field1."'/>".$value->$field2."</option>";
				}
			}
			echo "</select>";
	}
}






function encode_url($string, $key="", $url_safe=TRUE)
{
    if($key==null || $key=="")
    {
        $key="tyz_mydefaulturlencryption";
    }
      $CI =& get_instance();
    $ret = $CI->encrypt->encode($string, $key);

    if ($url_safe)
    {
        $ret = strtr(
                $ret,
                array(
                    '+' => '.',
                    '=' => '-',
                    '/' => '~'
                )
            );
    }

    return $ret;
}
function decode_url($string, $key="")
{
     if($key==null || $key=="")
    {
        $key="tyz_mydefaulturlencryption";
    }
        $CI =& get_instance();
    $string = strtr(
            $string,
            array(
                '.' => '+',
                '-' => '=',
                '~' => '/'
            )
        );

    return $CI->encrypt->decode($string, $key);
}
if(!function_exists('p_mail'))
{
	function p_mail($encode,$email)
	{
		
			//print_r("<a href=".site_url('index.php/register/reset_password?abc='.$encode).">Link</a>");
			$to = $email;
			$subject = "Reset Your Password";
			$from ="info@creaadesigns.com";
			$str=base_url()."index.php/register/verify_pass"; 
			$url_to_be_send="<a href=".site_url('index.php/register/reset_password?abc='.$encode).">Link</a>";
			$message = "
			<html>
			<head>
			<title>HTML email</title>
			</head>
				<body>
				link:Click on the link to reset your password".$url_to_be_send."
				</body>
			</html>
				";
						
			// Always set content-type when sending HTML email
		$headers  = "MIME-Version: 1.0\r\n";
	    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
	    $headers .= "From: <".$from. ">" ;
						
			if(mail($to,$subject,$message,$headers))
			{
				echo "1";			
			} 
			else
			{
				echo "Your Enquiry is not send";
			}
			
	}
	
}

if(!function_exists('dropdown_with_select_multiple2'))
{
	function dropdown_with_select_multiple2($field1,$field2,$id,$table,$condition,$name)
	{
		
		
			$CI =& get_instance();
			echo "<select name='".$name."[]' class='form-control select2'  id='$name' multiple='multiple' style='width:100%;' >";
			
			$CI->db->select("$field1,$field2"); 
			$CI->db->from($table);
			if($condition != '')
			{	
				$CI->db->where($condition);
			}	
			$ans = $CI->db->get();
			
			$ans1 = $ans->result();
			
			if($ans->num_rows() == 0)
			{
				echo"<option>No data</option>";
			}
			else
			{
				
				foreach($ans1 as $key=>$value)
				{	
					if(in_array($value->$field1, $id))
					
					echo "<option value='".$value->$field1."' selected/>".$value->$field2."</option>";
					else
					echo "<option value='".$value->$field1."'/>".$value->$field2."</option>";
				}
			}
			echo "</select>";
	}
}



if(!function_exists('dropdown_with_typo'))
{
	function dropdown_with_typo($field1,$field2,$id,$table,$condition,$name,$param)
	{
		
		
			$CI =& get_instance();
			echo "<select name='".$name."' class='form-control select2'  id='$name'  style='width:100%;' >";
			
			$CI->db->select("$field1,$field2"); 
			$CI->db->from($table);
			if($condition != '')
			{	
				$CI->db->where($condition);
			}	
			$ans = $CI->db->get();
			
			$ans1 = $ans->result();
			
			if($ans->num_rows() == 0)
			{
				echo"<option>No data</option>";
			}
			else
			{
				echo "<option value=''> ".$param." </option>";
				foreach($ans1 as $key=>$value)
				{	
					if($value->$field1 == $id)
					
					echo "<option value='".$value->$field1."' selected/>".$value->$field2."</option>";
					else
					echo "<option value='".$value->$field1."'/>".$value->$field2."</option>";
				}
			}
			echo "</select>";
	}
}





if(!function_exists('sendSMS_globalsms'))
{
	function sendSMS_globalsms($mobile,$message,$from)
	 {
		/*  echo $mobile.'<br/>';
		 echo $message.'<br/>';
		 echo $from.'<br/>'; */
		/* $handler= curl_init();
		curl_setopt($handler, CURLOPT_HTTPAUTH, CURLAUTH_BASIC | CURLAUTH_ANY ) ; */
		//curl_setopt($handler, CURLOPT_URL, "http://sms.sms2india.info/sendsms.asp?user=fnfindia&password=jamuna2007&sender=FNF&track=1&from=".urlencode($from)."&PhoneNumber=".trim($mobile)."&text=".urlencode(trim($message)));
		//curl_setopt($handler, CURLOPT_URL, "http://bulksms.sms2india.info/sendsmsv1.php?user=fnfindia&password=jamuna2007&sender=FNFmum&countrycode=91&PhoneNumber=".trim($mobile)."&text=".urlencode(trim($message))."&gateway=UES3B2ZX");
		/* curl_setopt($handler, CURLOPT_URL, "https://www.smsglobal.com/http-api.php?action=sendsms&user=fnfindia&password=jamfox&from=".urlencode($from)."&to=".trim($mobile)."&text=".urlencode(trim($message))); */
		/* curl_setopt($handler, CURLOPT_URL, "https://api.smsglobal.com/http-api.php?action=sendsms&user=fnfindia&password=jamfox&from=".urlencode($from)."&to=".trim($mobile)."&text=".urlencode(trim($message)));
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
		$data= curl_exec($handler);
		/* echo $data; */
		/*curl_close($handler); */
		
	//$mobile=$mobilenumber;
	//$mobile=$mobilenumber;
		
	$replysms=$message;
	$unicode='';
	$output = array();	
	$response = '';
	if(strlen($message) != strlen(utf8_decode($message)))
	{
		$unicode=1;
	}		
				
	$request = ""; //initialize the request variable
					
	$param["user"] = 'fnfindia'; //this is the username of your account signup
			
	$param["password"] = 'jamuna2007'; //this is the password of your account

	$param["text"] = $replysms; //this is the message that we want to send
		
	$param["unicode"] = $unicode; //this is the message that we want to send

	$param["PhoneNumber"] = $mobile; //these are the recipients of the message 
		
	$param["group"] = ""; //these are the recipients of the message which are already stored in your sms account as groups
		
	$param["countrycode"] = '91'; 

	$param["sender"] = 'FNFmum';//this is your sender which is approved, FNFmum
		
	$param["gateway"] = '';//this is your sender which is approved, 
		
	foreach($param as $key=>$val) //traverse through each member of the param array
	{
		/*** here variable value is getting urlencoded ***/
		$request.= $key."=".urlencode($val); //we have to urlencode the values
		$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "bulksms.sms2india.info";
	$script = "/sendsmsv1.php";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
	
	if($method == "GET")
	{
		$script .= "?$request";
	}
	
	//Now comes the header which we are going to post.
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";
		
	//echo $header;
	//die;
		
	//Now we open up the connection
	$socket = @fsockopen($host, 80, $errno, $errstr);
	if ($socket) //if its open, then...
	{
		fputs($socket, $header); // send the details over
		
		while(!feof($socket))
		{
			$output[] = fgets($socket); //get the results
		}
		
		fclose($socket);
	}
	if(!empty($output)){
		$response_array_length=count($output);
		$response=$output[$response_array_length-1];
	}	
	

	//print "<pre>";
	//print_r($output);
	// THE ABOVE CODE WILL PRINT THE RESPONSE FROM SNOWEBS, INCASE YOU WANT TO PRINT REMOVE THE COMMENT STATEMENT
	//print "Sent";
	//print "</pre>";

	//END SENDING SMS TO THE USER.
	
	return $response;
		
	 }
	 
	 
	 
	 
	 
	 
}







if(!function_exists('get_menuname'))
{
	function get_menuname($menu_type,$menuid)
	 {
		$CI =& get_instance();
		//echo $menu_type;
		 if($menu_type != 0 && $menuid != 0){
			 if($menu_type == 1){
			$query=$CI->db->query("select FCT_NAME as menu_name from flr_category where FCT_ID = $menuid");
		}else if($menu_type == 2){
			$query=$CI->db->query("select FO_NAME as menu_name from flr_occasions where FO_ID = $menuid");
		}else if($menu_type == 3){
			$query=$CI->db->query("select FFV_NAME as menu_name from flr_flowers_variety where FFV_ID = $menuid");
		}
		 $row = $query->result();return $row[0]->menu_name;
		 }else{
			 return '';
		 }
	 }
}

if(!function_exists('get_email_data'))
{
	function get_email_data()
	{
		$CI =& get_instance();
		$config['protocol']    = 'smtp';		
		$config['smtp_host']    = 'ssl://smtp.googlemail.com';
		$config['smtp_port']    =  '587';
		$config['smtp_timeout'] = '7';
		// $config['smtp_user']    =  'lookbookproject123@gmail.com';
		// $config['smtp_pass']    =  'lookbook123456';
		$config['smtp_user']    =  'movinnzaseo@gmail.com';
		$config['smtp_pass']    =  'seorsp253';
		$config['charset']    = 'utf-8';		
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = TRUE; 
		return $config;


		// $CI =& get_instance();
        // $config['protocol']    = 'smtp';
        // $config['smtp_host']    = 'smtp.sendgrid.net';
        // $config['smtp_user']    = 'jamfox14';
        // $config['smtp_pass']    = '@Abhinav2112';
        // $config['smtp_port']    = '587';
        // $config['crlf']    = "\r\n";
        // $config['newline']    = "\r\n";
        // $config['charset']    = 'utf-8';
        // $config['mailtype'] = 'html';
        // $config['validation'] = true;
        // return $config;
		
	}
}

if(!function_exists('maildata')){
	 function maildata($webid,$emailtmp,$order){
		$CI =& get_instance();
		$webquery = $CI->db->query("Select FWM_Logo, FWM_Imagepath,FWM_Website_Name,FWM_Company_Name,FWM_CCMAIL_SenderID,FWM_Mail_SenderID,FWM_Domain_Name,FWM_GSTIN,FWM_CIN,FWM_Statecode,FWM_Company_Address,FWM_Company_Phone,FWM_valentineprice_precent,FWM_valentine1314_status from flr_website where FWM_ID = (Select FWM_ID from flr_web_country_mapping where FWCM_ID = $webid)");
		$web = $webquery->result();//print_r($web);
		$emailquery = $CI->db->query("Select FEF_Email_Code from flr_email_format where FWM_ID = (Select FWM_ID from flr_web_country_mapping where FWCM_ID = $webid) and FEF_Email_list_id = $emailtmp");
		$email_format = $emailquery->result();
		if(!empty($web[0]) && !empty($email_format[0]))
		{
			$emaildata = $email_format[0]->FEF_Email_Code;
			$imgurl = base_url().'uploads/cpanel-logo/'.$web[0]->FWM_Logo;
			$templateurl = $web[0]->FWM_Imagepath;
			$valdispstatus = 'display : block';
			$notvaldispstatus = 'display : none';
			$place_date = date("d-m-Y",strtotime($order->place_date));
			$deldate = date("d-m-Y",strtotime($order->FO_Del_Date));
			$pre_delivery_time = $order->pre_delivery_time;
			if($web[0]->FWM_valentine1314_status == 1){
				 if($emailtmp == 11 || $emailtmp == 16){
					$r_del_date = date('Y-m-d',strtotime($order->FO_Del_Date));
					$d = date_parse_from_format("Y-m-d", $r_del_date);
					if($d['month'] == 2 && ($d['day'] == 14 || $d['day'] == 13)){
						$deldate = '13 or 14-Feb-2019';
						$valdispstatus = 'display : none';
						$notvaldispstatus = 'display : block';
						$pre_delivery_time = 'Anytime before 9 pm(Evening)';
					}
				} 
			} 
			else{
				$pre_delivery_time = $order->pre_delivery_time;
				$deldate = date("d-m-Y",strtotime($order->FO_Del_Date));
				$valdispstatus = 'display : block';
				$notvaldispstatus = 'display : none';
			}
			
			
			$dynamic_var = array("(~WEBSITE_LOGO~)","(~WEB_COMPANY_NAME~)","(~WEB_NAME~)","(~WEB_LINK~)","(~WEB_EMAIL~)","(~SENDER_NAME~)","(~ORDER_NO~)","(~DELIVERY_DATE~)","(~RECIEVER_NAME~)","(~ORDER_RECIEVER_BY~)","(~RECIEVER_ADDRESS~)",
			"(~RECIEVER_CITY~)","(~RECIEVER_AREA~)","(~RECIEVER_ZIP~)","(~RECIEVER_STATE~)","(~RECIEVER_COUNTRY~)","(~RECIEVER_MOBILE~)",
			"(~RECIEVER_PHONE~)","(~RECIEVER_EMAIL~)","(~MESSAGE_ON_CARD~)","(~SENDER_NAME_ON_CARD~)","(~SENDER_ADDRESS~)","(~SENDER_CITY~)","(~SENDER_STATE~)","(~SENDER_COUNTRY~)","(~SENDER_MOBILE~)","(~SENDER_PHONE~)","(~SENDER_EMAIL~)","(~VENDER_COMPANY_NAME~)","(~VENDER_FULL_NAME~)","(~SENDER_ZIP~)","(~SENDER_STATE_CODE~)","(~SENDER_GSTIN~)","(~RECIEVER_STATE_CODE~)","(~RECIEVER_GSTIN~)","(~COMPANY_GSTIN~)","(~COMPANY_STATE_CODE~)","(~COMPANY_CIN~)","(~WEB_COMPANY_ADDRESS~)","(~WEB_COMPANY_PHONE~)","(~TEMPLATE_LINK~)","(~ORDER_DATE~)","(~SPECIAL_INSTRUCTION~)","(~VAL1314_STATUS~)","(~NOT_VAL1314_STATUS~)","(~DELIVERY_TIME_SELECTED~)");
			$dynamic_val = array($imgurl,$web[0]->FWM_Company_Name,$web[0]->FWM_Website_Name,$web[0]->FWM_Domain_Name,$web[0]->FWM_Mail_SenderID,$order->FO_Bill_Name,$order->FO_Order_No,$deldate,$order->FO_Ship_Name,$order->FO_Ship_Name,$order->FO_Ship_Add,
			$order->FO_Ship_City,$order->FO_Ship_Area,$order->FO_Ship_Zip,$order->FO_SHIP_State,$order->FO_Ship_Country,$order->FO_Ship_Mobile,
			$order->FO_Ship_Mobile_alt,$order->FO_Ship_Email,$order->FO_Msg_ON_card,$order->FO_Sen_Name_On_card,$order->FO_Bill_Add,$order->FO_Bill_City,$order->FO_Bill_State,$order->FO_Bill_Country,$order->FO_Bill_Mobile,$order->Fo_Bill_Phone,$order->FO_Bill_email,$order->FUM_Comp_Name,$order->orderfwdto,$order->FO_Bill_Zip,$order->FO_Bill_State_gstcode,$order->FO_Bill_gstin_no,$order->FO_SHIP_State_gstcode,$order->FO_SHIP_gstin_no,$web[0]->FWM_GSTIN,$web[0]->FWM_Statecode,$web[0]->FWM_CIN,$web[0]->FWM_Company_Address,$web[0]->FWM_Company_Phone,$templateurl,$place_date,$order->FO_Special_Inst,$valdispstatus,$notvaldispstatus,$pre_delivery_time);
			$emaildata = str_replace($dynamic_var,$dynamic_val,$emaildata);
			return $emaildata;
		}else{
			return "no";
		}
	 }
}


if(!function_exists('getdropdownofmonthly')){
	function getdropdownofmonthly($uid){
		$CI =& get_instance();
		$query = $CI->db->query("select MONTH(FO_Del_Date) as mth,YEAR(FO_Del_Date) as yr from flr_orders where FO_CustomerID = $uid group by YEAR(FO_Del_Date), MONTH(FO_Del_Date)
		union select MONTH(FO_Del_Date) as mth,YEAR(FO_Del_Date) as yr from flr_orders where FO_VendorID = $uid group by YEAR(FO_Del_Date), MONTH(FO_Del_Date) order by yr DESC, mth DESC");
		$result = $query->result();
		if(!empty($result[0])){
			return $result;
		}else{
			return "no";
		}
	}
}

if(!function_exists('getmonthlydropdown')){
	function getmonthlydropdown(){
		$CI =& get_instance();
		$query = $CI->db->query("select MONTH(FO_Del_Date) as mth,YEAR(FO_Del_Date) as yr from flr_orders group by YEAR(FO_Del_Date), MONTH(FO_Del_Date) order by FO_Del_Date DESC");
		$result = $query->result();
		if(!empty($result[0])){
			return $result;
		}else{
			return "no";
		}
	}
}

/* if(!function_exists('convert_currency')){
	function convert_currency($from_Currency,$to_Currency,$amount){
		if($amount > 0){
			
		$amount = urlencode($amount);
		$from_Currency = urlencode($from_Currency);
		$to_Currency = urlencode($to_Currency);
		$checkinternet = (bool) @fsockopen('www.google.com', 80, $iErrno, $sErrStr, 5);
		if($checkinternet){
			$arrContextOptions=array("ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false));
			$get = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency",FALSE,stream_context_create($arrContextOptions));
	 	$get = explode("<span class=bld>",$get);
		$get = explode("</span>",$get[1]);  
		$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
		return $converted_amount; 
		}else{
			return 0;
		}
		
		}else{ return 0;}
	}
} */

if(!function_exists('convert_currency')){
	function convert_currency($from_Currency,$to_Currency,$amount){
		$arrContextOptions=array("ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false));
		
		if($amount > 0){
		$amount = urlencode($amount);
		$from_Currency = urlencode($from_Currency);
		$to_Currency = urlencode($to_Currency);
		$checkinternet = (bool) @fsockopen('www.google.com', 80, $iErrno, $sErrStr, 5);
		if($checkinternet){
			//$get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency",FALSE,stream_context_create($arrContextOptions));
			
			 // $get = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency",FALSE,stream_context_create($arrContextOptions));
			
			/* $get = file_get_contents("http://www.xe.com/currencyconverter/convert/?Amount=$amount&From=$from_Currency&To=$to_Currency",FALSE,stream_context_create($arrContextOptions)); */
		 
		
		
		// $get = explode("<span class=bld>",$get);
		// $get = explode("</span>",$get[1]);  
		// $converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]); 
		
		
		$converted_amount = ($amount * 0.0153893);
		return $converted_amount;
		}else{
			return 0;
		}
		
		}else{ return 0;}
	}
}

if(!function_exists('moneyFormatIndia')){
	function moneyFormatIndia($num) {
    $explrestunits = "" ;
    if(strlen($num)>3){
		if(strlen($num) == 4 && $num < 0){
			$thecash = $num;
		}else{
			$lastthree = substr($num, strlen($num)-3, strlen($num));
			$restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
			$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
			$expunit = str_split($restunits, 2);
			for($i=0; $i<sizeof($expunit); $i++) {
				// creates each of the 2's group and adds a comma to the end
				if($i==0) {
					$explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
				} else {
					$explrestunits .= $expunit[$i].",";
				}
			}
			$thecash = $explrestunits.$lastthree;
		}
        
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}
}

if(!function_exists('exports_data')){
	 function exports_data($data,$name){
            header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=\"$name".".csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");
            $handle = fopen('php://output', 'w');
            foreach ($data as $data) {
                fputcsv($handle, $data);
            }
                fclose($handle);
            exit;
        }
}

if(!function_exists('get_client_ip')){
	function get_client_ip() {
			$ipaddress = '';
			if (isset($_SERVER['HTTP_CLIENT_IP']))
				$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_X_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_FORWARDED'];
			else if(isset($_SERVER['REMOTE_ADDR']))
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			else
				$ipaddress = 'UNKNOWN';
			return $ipaddress;
		}
}
if(!function_exists('get_webname')){
	function get_webname($web_id){
		$CI =& get_instance();
		if($web_id){
			$webdata = $CI->db->query("select FWM_Website_Name from flr_web_country_mapping fwcm,flr_website fw where fwcm.FWM_ID = fw.FWM_ID and fw.FWM_Active=1 and FWCM_ID = $web_id");
			$r = $webdata->row();
			if($r){
				return $r->FWM_Website_Name;
			}
		}
		
	}
}
if(!function_exists('get_word_currency')){
	function get_word_currency(float $number){
		if($number < 0)
		{
			$number = str_replace("-","",$number);
		}	
			
			
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
	
    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
	//echo $paise;
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise ;

	}
}

if(!function_exists('webcountry_to_website')){
	function webcountry_to_website($ids){
		$CI =& get_instance();
		if($ids){
			$website = array();
			$webdata = $CI->db->query("select fw.FWM_ID from flr_web_country_mapping fwcm,flr_website fw where fwcm.FWM_ID = fw.FWM_ID and fw.FWM_Active=1 and fwcm.FWCM_ID in (".$ids.")");
			$r = $webdata->result();
			foreach($r as $obj){
				array_push($website,$obj->FWM_ID);
			}
			return implode(',',$website);
		}else{
			return '';
		}
	}
}

if(!function_exists('image_size'))
{
	function image_size()
	{
		 $CI =& get_instance();

		 $query=$CI->db->query("select MWM_Imagesize from mov_website where MWM_ID = 1");
		 $row = $query->result();
		
		 if($row !=''){
		 	return $row[0]->MWM_Imagesize;
		 }
		 else{
			return '1';
		 }
	}
}

if(!function_exists('file_size'))
{
	function file_size()
	{
		// $CI =& get_instance();

		// $query=$CI->db->query("select MWM_Imagesize from mov_website where MWM_ID = 1");
		// $row = $query->result();
		
		// if($row !=''){
		// 	return $row[0]->MWM_Imagesize;
		// }
		// else{
			return '5';
		// }
	}
}

if(!function_exists('getbranchofstore')){
	function getbranchofstore($storeid){
		$CI =& get_instance();
		$query = $CI->db->query("select ZB_Branch_ID from zap_branch where ZS_Store_ID = ".$storeid);
		$result = $query->result();
		if(!empty($result[0])){
			return $result;
		}else{
			return "0";
		}
	}
}

if(!function_exists('dropdown_keyval_with_select_multiple2'))
{
	function dropdown_keyval_with_select_multiple2($field1,$field2,$field3,$id,$table,$condition,$name)
	{
		
		
			$CI =& get_instance();
			echo "<select name='".$name."[]' class='form-control select2'  id='$name' multiple='multiple' style='width:100%;' >";
			
			$CI->db->select("$field1,$field2,$field3"); 
			$CI->db->from($table);
			if($condition != '')
			{	
				$CI->db->where($condition);
			}	
			$ans = $CI->db->get();
			
			$ans1 = $ans->result();
			
			if($ans->num_rows() == 0)
			{
				echo"<option>No data</option>";
			}
			else
			{
				
				foreach($ans1 as $key=>$value)
				{	
					if(in_array($value->$field1, $id))
					
					echo "<option value='".$value->$field1."' selected/>".$value->$field2." (".$value->$field3.")</option>";
					else
					echo "<option value='".$value->$field1."'/>".$value->$field2." (".$value->$field3.")</option>";
				}
			}
			echo "</select>";
	}
}

if(!function_exists('smart_wordwrap'))
{
function smart_wordwrap($string, $width = 75, $break = "\n") {
    // split on problem words over the line length
    $pattern = sprintf('/([^ ]{%d,})/', $width);
    $output = '';
    $words = preg_split($pattern, $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

    foreach ($words as $word) {
        if (false !== strpos($word, ' ')) {
            // normal behaviour, rebuild the string
            $output .= $word;
        } else {
            // work out how many characters would be on the current line
            $wrapped = explode($break, wordwrap($output, $width, $break));
            $count = $width - (strlen(end($wrapped)) % $width);

            // fill the current line and add a break
            $output .= substr($word, 0, $count) . $break;

            // wrap any remaining characters from the problem word
            $output .= wordwrap(substr($word, $count), $width, $break, true);
        }
    }

    // wrap the final output
    return wordwrap($output, $width, $break);
}

}
if(!function_exists('elipsis'))
{
function elipsis ($text, $words = 30) {
    // Check if string has more than X words
    if (str_word_count($text) > $words) {

        // Extract first X words from string
        preg_match("/(?:[^\s,\.;\?\!]+(?:[\s,\.;\?\!]+|$)){0,$words}/", $text, $matches);
        $text = trim($matches[0]);

        // Let's check if it ends in a comma or a dot.
        if (substr($text, -1) == ',') {
            // If it's a comma, let's remove it and add a ellipsis
            $text = rtrim($text, ',');
            $text .= '...';
        } else if (substr($text, -1) == '.') {
            // If it's a dot, let's remove it and add a ellipsis (optional)
            $text = rtrim($text, '.');
            $text .= '...';
        } else {
            // Doesn't end in dot or comma, just adding ellipsis here
            $text .= '...';
        }
    }
    // Returns "ellipsed" text, or just the string, if it's less than X words wide.
    return $text;
}
}


?>