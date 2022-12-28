<?php
class Myclass{
	protected $CI="";
	public function __construct()
	{
		$this->CI =& get_instance();
		//$this->CI->load->database();
		//pre($this->CI);
	}
	public function select($field,$table,$condition)
    {
		
		//$sql = "select $field from $table where $condition";
		//$sql = "select * from lcm_client";
		//echo $sql;
		$this->CI->db->select($field); 
		$this->CI->db->from($table);
		$this->CI->db->where($condition);
		$ans = $this->CI->db->get(); 
		//$rowcount = $query->num_rows();		
		//$ans = $this->CI->db->query($sql);
		//secho $this->CI->db->last_query();
		//pre($ans);
		
		if($ans->num_rows==0)
		{
			return "no";
		}
		else
		{
			$fans = $ans->result();
			//pre($fans);
			return $fans;
		}
    }
	
	public function dropdown($field1,$field2,$table,$condition,$name,$class)
	{
		
		$str = "<select name='$name' id='$name' class='$class'>";
		
		$str.="<option value=''>Please Select</option>";
		
		$ans = $this->select("$field1,$field2",$table,$condition);
		 
		if($ans == "no")
		{
			$str.="<option value=''>No Records</option>";
		}
		else
		{
			//pre($ans);
			foreach($ans as $val)
			{
				$data1 = $val->$field2;
				$data2 = $val->$field1;
				$str.="<option value='$data2'>$data1</option>";
			}
		}
		
		$str.="</select>";
		
		echo $str;
	}
	
	
	public function dropdown_selected($field1,$field2,$table,$condition,$name,$s_field1,$s_field2,$s_table1,$s_table2,$s_condition)
	{
			$ans1=$this->select("$s_field1,$s_field2","$s_table1,$s_table2",$s_condition);
			//print_r($ans1);
			foreach($ans1 as $res)
			{
			$selected=$res->$field1;
			}
			$selected;
			//echo $selected;
			//print_r($ans1);
				//echo $name;
			$ans=$this->select("$field1,$field2",$table,$condition);
			//if($selected==$value[0])
				//print_r($ans);
					//$selected="selected='$selected'";
			echo"<select name='$name'class='styledselect_form_5' id='$name'>";
			//print_r($ans);
			if($ans=="no")
			{
				echo"<option>No data</option>";
			}
			else
			{	
				foreach($ans as $value)
				{
					
					$data1=$value->$field1;
					$data2=$value->$field2;
					//print_r($data1);
					
					if($data1 == $selected)
					{
						echo "<option value='$data1' selected='selected'>$data2</option>";
					}
					else
					{
						echo "<option value='$data1'>$data2</option>";
					}
					
				}
			}
			echo "</select>";
	}
	function cascading_dropdown($field1,$field2,$table,$condition,$name)
	{
			$numerical = array();
			$sep = ':';
			$str="<select name='$name' id='$name'>";
			$ans=$this->select("$field1,$field2",$table,$condition);
			//print_r($ans);
			if($ans=="no")
			{
				$str .= "<option>No data</option>";
			}
			else
			{
					$str .= "<option value=''>Select</option>";
					
				foreach($ans as $k => $value)
				{
					
					$str .= "<option value=".$value->$field1.">".$value->$field2."</option>";
				}
			}
			$str .= "</select>";
			return $str;
	}
	
	function checked($val,$prop_id)
	{
	//echo $val;
		 $ans=$this->select('propam_amid','dv_propaminity',"propam_amid='$val' AND propam_propid='$prop_id'");
			if(is_array($ans)){
				return 1;
			}
			
				
	}
	public function sel($sub1,$city1)
	{
		$str1="SELECT *,propimg_path,city_name FROM dv_city,dv_property,dv_propimage WHERE city_id=prop_city and prop_id=propimg_propid and prop_city='$city1' and prop_subcatid IN ( SELECT subcat_id FROM dv_subcat WHERE subcat_name='$sub1')";
		//$str1="SELECT * FROM dv_property WHERE prop_city =  '2'";
		
			$city2 = $this->CI->db->query($str1);	
		
		if($city2->num_rows==0)
		{
			return "no";
		}
		else
		{
			$fans = $city2->result();
			//pre($fans);
			return $fans;
		}
		
	}
	public function sel_adv($price,$bhk,$eminity)
	{
		if($price=="null" && $eminity=="null" && $bhk=="0")
		{
		$str1="SELECT *,city_name from dv_property,dv_propaminity,dv_propimage,dv_city where prop_city=city_id AND prop_id=propam_propid and prop_id=propimg_propid group by prop_id";	
		}
		else if($bhk=="0" && $eminity=="null")
		{
		$str1="SELECT *,city_name from dv_property,dv_propaminity,dv_propimage,dv_city where prop_city=city_id AND  prop_id=propam_propid AND prop_id=propimg_propid AND prop_price in ($price) group by prop_id";
		}
		else if($bhk=="0" && $price=="null")
		{
		$str1="SELECT *,city_name from dv_property,dv_propaminity,dv_propimage,dv_city where prop_city=city_id AND  prop_id=propam_propid AND prop_id=propimg_propid AND propam_amid in ($eminity) group by prop_id";
		}
		else if($price=="null" && $eminity=="null")
		{
		$str1="SELECT *,city_name from dv_property,dv_propaminity,dv_propimage,dv_city where prop_city=city_id AND  prop_bhk='$bhk'  AND prop_id=propam_propid AND prop_id=propimg_propid group by prop_id";
		//echo $str1;
		}
		else if($eminity=="null")
		{
			$str1="SELECT *,city_name from dv_property,dv_propaminity,dv_propimage,dv_city where prop_city=city_id AND  prop_bhk='$bhk'  AND prop_id=propam_propid AND prop_id=propimg_propid AND prop_price in ($price) group by prop_id";
		}
		else if($price=="null")
		{
			$str1="SELECT *,city_name from dv_property,dv_propaminity,dv_propimage,dv_city where prop_city=city_id AND  prop_bhk='$bhk'  AND prop_id=propam_propid AND prop_id=propimg_propid AND propam_amid in ($eminity) group by prop_id";
		}
		else if($bhk=="0")
		{
			$str1="SELECT *,city_name from dv_property,dv_propaminity,dv_propimage,dv_city where prop_city=city_id   AND prop_id=propam_propid AND prop_id=propimg_propid AND propam_amid in ($eminity) AND prop_price in ($price) group by prop_id";
		}
		
		else
		{
		$str1="SELECT *,city_name from dv_property,dv_propaminity,dv_propimage,dv_city where prop_city=city_id AND  prop_bhk='$bhk'  AND prop_id=propam_propid AND prop_id=propimg_propid AND propam_amid in ($eminity) AND prop_price in ($price) group by prop_id";	
		}
		// print_r($str1);
		// exit;
			$city2 = $this->CI->db->query($str1);	
		//echo $city2->num_rows;
		if($city2->num_rows==0)
		{
			
			return "no";
		}
		else
		{
			$fans = $city2->result();
			//echo "<pre>";
			//print_r($fans);
			return $fans;
		}
	}
	public function getalldetail($location,$areasq,$type,$category)
	{
		if($location=="" && $type=="" && $areasq=="")
		{
		$str2="SELECT *,propimg_path,city_name FROM dv_city,dv_property,dv_propimage WHERE city_id=prop_city and prop_id=propimg_propid and  prop_catid='$category'  group by prop_id limit 1";
	
		}
		
		else if($location=="" && $type=="")
		{
		$str2="SELECT *,propimg_path,city_name FROM dv_city,dv_property,dv_propimage WHERE city_id=prop_city and prop_id=propimg_propid and prop_area BETWEEN $areasq and prop_catid='$category' group by prop_id limit 1";
		//print_r(str2);
		}
		else if($location=="" && $areasq=="")
		{
			$str2="SELECT *,propimg_path,city_name FROM dv_city,dv_property,dv_propimage WHERE city_id=prop_city and prop_id=propimg_propid and prop_catid='$category' and  prop_subcatid IN ( SELECT subcat_id FROM dv_subcat WHERE subcat_name='$type') group by prop_id limit 1";
			//print_r(str2);
		}
		else if($areasq=="" && $type=="")
		{
		$loc = join(',',$location);
		//print_r($loc);
		$str2="SELECT *,propimg_path,city_name FROM dv_city,dv_property,dv_propimage WHERE city_id=prop_city and prop_id=propimg_propid and prop_catid='$category' and  prop_loc IN ($loc) group by prop_id limit 1";
		}
		else if($location=="")
		{
		$str2="SELECT *,propimg_path,city_name FROM dv_city,dv_property,dv_propimage WHERE city_id=prop_city and prop_id=propimg_propid and prop_area BETWEEN $areasq and prop_catid='$category'and prop_subcatid IN ( SELECT subcat_id FROM dv_subcat WHERE subcat_name='$type') group by prop_id limit 1";
		//print_r($str2);
			
		}
		else if($type=="")
		{
		$loc = join(',',$location);
		//print_r($loc);
		$str2="SELECT *,propimg_path,city_name FROM dv_city,dv_property,dv_propimage WHERE city_id=prop_city and prop_id=propimg_propid and prop_area BETWEEN $areasq and prop_catid='$category' and   prop_loc IN ($loc) group by prop_id limit 1";

		}
		else if($areasq=="")
		{
		$loc = join(',',$location);
		//print_r($loc);
		$str2="SELECT *,propimg_path,city_name FROM dv_city,dv_property,dv_propimage WHERE city_id=prop_city and prop_id=propimg_propid  and  prop_loc IN ($loc) and prop_catid='$category' and  prop_subcatid IN ( SELECT subcat_id FROM dv_subcat WHERE subcat_name='$type') group by prop_id limit 1 ";
		
		}
		else{
		$loc = join(',',$location);
		//print_r($loc);
		$str2="SELECT *,propimg_path,city_name FROM dv_city,dv_property,dv_propimage WHERE city_id=prop_city and prop_id=propimg_propid and prop_area BETWEEN $areasq and prop_catid='$category' and  prop_loc IN ($loc) and  prop_subcatid IN ( SELECT subcat_id FROM dv_subcat WHERE subcat_name='$type') group by prop_id limit 1";
		//print_r($str2);
	
		} 
		
		$detail = $this->CI->db->query($str2);	
		//print_r($detail);
		//exit;
		if($detail->num_rows==0)
		{
			return "no";
		}
		else
		{
			$fans1 = $detail->result();
			//pre($fans);
			return $fans1;
		}
	}
	public function dropdown_selected1($field1,$field2,$table,$condition,$name,$s_field1,$s_field2,$s_table1,$s_table2,$s_condition)
	{
			$ans1=$this->select("$s_field1,$s_field2","$s_table1,$s_table2",$s_condition);
			//print_r($ans1);
			foreach($ans1 as $res)
			{
			$selected=$res->$field1;
			}
			$selected;
			//echo $selected;
			//print_r($ans1);
				//echo $name;
			$ans=$this->select("$field1,$field2",$table,$condition);
			//if($selected==$value[0])
				//print_r($ans);
					//$selected="selected='$selected'";
			echo"<select name='$name'class='buy-search' id='$name'>";
			//print_r($ans);
			if($ans=="no")
			{
				echo"<option>No data</option>";
			}
			else
			{	
				foreach($ans as $value)
				{
					
					$data1=$value->$field1;
					$data2=$value->$field2;
					//print_r($data1);
					
					if($data1 == $selected)
					{
						echo "<option value='$data1' selected='selected'>$data2</option>";
					}
					else
					{
						echo "<option value='$data1'>$data2</option>";
					}
					
				}
			}
			echo "</select>";
	}
	}
	?>