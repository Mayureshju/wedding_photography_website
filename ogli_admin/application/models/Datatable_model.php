<?php 
if(!defined('BASEPATH')) exit('NO ACCESS');
Class Datatable_model extends CI_Model 
{	
	var $select_column = array("FWCT_ID","fc.FC_City_Name","w.FWM_Website_Name","fn.FCnt_Country_name","FWCT_CreatedDate","FWCT_UpdatedDate","FWCT_UpdatedBY","FWCT_delivery_charges","FWCT_delivery_freq","FWCT_midnight_delivery","FWCT_Status");  
	var $table = "flr_city fc, flr_country fn, flr_city_web_mapping cms, flr_website w,flr_web_country_mapping wc"; 
	var $where = "fc.FCnt_ID = wc.FCnt_ID AND fc.FC_CityId = cms.FC_CityId and FWM_Active=1 and w.FWM_ID = wc.FWM_ID AND cms.FWCM_ID = wc.FWCM_ID";
	var $order_column = array("FWCT_ID","fc.FC_City_Name","w.FWM_Website_Name","fn.FCnt_Country_name","FWCT_CreatedDate","FWCT_UpdatedDate","FWCT_UpdatedBY","FWCT_delivery_charges",null,null,null);  
      
	function make_query()  
	{  
	   $this->db->select($this->select_column); 
	  $this->db->where($this->where);	 
	   $this->db->from($this->table);   
	   if(isset($_POST["search"]["value"]))  
	   {    
			$searchstring = $_POST["search"]["value"];
						
			$where = "(`FWCT_ID` LIKE '%$searchstring%' OR" ;
			$where .= "`FC_City_Name` LIKE '%$searchstring%' OR" ;
			$where .= "`FWM_Website_Name` LIKE '%$searchstring%' OR" ;
			$where .= "`FCnt_Country_name` LIKE '%$searchstring%' OR" ;
			$where .= "`FWCT_CreatedDate` LIKE '%$searchstring%' OR" ;
			$where .= "`FWCT_UpdatedDate` LIKE '%$searchstring%' OR" ;
			$where .= "`FWCT_UpdatedBY` LIKE '%$searchstring%' OR" ;
			$where .= "`FWCT_delivery_charges` LIKE '%$searchstring%' )" ;
			$this->db->where($where);  
			
			
	   }  
	   if(isset($_POST["order"]))  
	   {  
			$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
	   }  
	   else  
	   {  
			$this->db->order_by('FWCT_ID', 'ASC');  
	   }  
	} 
	
	function make_datatables()
	{  
	   $this->make_query();  
		if(isset($_POST["length"]))  
	   {  
			$this->db->limit($_POST['length'], $_POST['start']);  
	   }  
	   $query = $this->db->get();  
	   return $query->result();  
	} 
	
	function get_filtered_data()
	{  
	   $this->make_query();  
	   $query = $this->db->get();  
	   return $query->num_rows();  
	}       
	
	function get_all_data()  
	{  
	   $this->db->select($this->select_column); 
	   $this->db->from($this->table);  
	   $this->db->where($this->where);
	   return $this->db->count_all_results();  
	} 
	
	
  //-------------------------- for area table ---------------//

	 
	var $select_column_area = array("FA_AREA_ID","FA_AREA_NAME","fc.FC_City_Name","FA_DESCRIPTION","FA_CREATED_DATE","FA_UPDATED_BY","FA_UPDATED_DATE","FA_STATUS");  
	var $table_area = "flr_area fa, flr_city fc"; 
	var $where_area = "fa.FC_CityId = fc.FC_CityId";
	var $order_column_area = array("FA_AREA_ID","FA_AREA_NAME","fc.FC_City_Name","FA_DESCRIPTION","FA_CREATED_DATE","FA_UPDATED_BY","FA_UPDATED_DATE",null,null);  
      
	function make_query_area()  
	{  
	   $this->db->select($this->select_column_area); 
	  $this->db->where($this->where_area);	 
	   $this->db->from($this->table_area);   
	   if(isset($_POST["search"]["value"]))  
	   {    
			$searchstring = $_POST["search"]["value"];
						
			$where = "(`FA_AREA_ID` LIKE '%$searchstring%' OR" ;
			$where .= "`FA_AREA_NAME` LIKE '%$searchstring%' OR" ;
			$where .= "`FC_City_Name` LIKE '%$searchstring%' OR" ;
			$where .= "`FA_DESCRIPTION` LIKE '%$searchstring%' OR" ;
			$where .= "`FA_CREATED_DATE` LIKE '%$searchstring%' OR" ;
			$where .= "`FA_UPDATED_BY` LIKE '%$searchstring%' OR" ;
			$where .= "`FA_UPDATED_DATE` LIKE '%$searchstring%' )" ;
			$this->db->where($where);  
			
			
	   }  
	   if(isset($_POST["order"]))  
	   {  
			$this->db->order_by($this->order_column_area[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
	   }  
	   else  
	   {  
			$this->db->order_by('FA_AREA_ID', 'ASC');  
	   }  
	} 
	
	function make_datatables_area()
	{  
	   $this->make_query_area();  
		if(isset($_POST["length"]))  
	   {  
			$this->db->limit($_POST['length'], $_POST['start']);  
	   }  
	   $query = $this->db->get();  
	   return $query->result();  
	} 
	
	function get_filtered_data_area()
	{  
	   $this->make_query_area();  
	   $query = $this->db->get();  
	   return $query->num_rows();  
	}       
	
	function get_all_data_area()  
	{  
	   $this->db->select($this->select_column_area); 
	   $this->db->from($this->table_area);  
	   $this->db->where($this->where_area);
	   return $this->db->count_all_results();  
	} 
 } 
		
		



?>