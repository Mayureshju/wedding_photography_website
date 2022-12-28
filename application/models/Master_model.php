<?php 
if(!defined('BASEPATH')) exit('NO ACCESS');
Class Master_model extends CI_Model
{
    
	
	 /* ---------------functions mostly use --------------- */
		 
		public function delete_data($table,$where,$del_id)
		{
			$this-> db->where($where, $del_id);
			$this->db->delete($table);
			return $this->db->affected_rows(); 
		}
	 
		public function updatedata($field,$id,$arr,$table)
		{
			$this->db->where($field,$id);
			$res = $this->db->update($table,$arr);
			return $res;
		}
		
		public function Insertdata($table,$insertdata)
		{
		    $this->db->insert($table,$insertdata);
			return $this->db->affected_rows();
		}
		
		public function InsertdatawithlastID($table,$insertdata)
		{
		    $this->db->insert($table,$insertdata);
			return $this->db->insert_id();
		}
		
		public function select_edit_data($table,$field,$edit_id)
		{
				$this->db->select('*'); 
				$this->db->from($table);
				$this->db->where($field,$edit_id);
				$query = $this->db->get();
				return $query->result();
		}
		
		public function delete_document($table,$where,$del_id,$doc,$dest)
		{
			$this-> db->where($where, $del_id);
			copy($doc, $dest);
			unlink($doc);
			$this->db->delete($table);
			return $this->db->affected_rows();
		
		}
		
		public function delete_doc($table,$where,$del_id)
		{
			 $this->db->where($where, $del_id);
			 $this->db->from($table);
			 $query = $this->db->get();
			 $doc = $query->result();
			 
			 $path = "./uploads/case/";
			 foreach($doc as $d)
			 {
				unlink($path.$d->LCMU_FILENAME);
			 }
			
				 $this-> db->where($where, $del_id);
				$this->db->delete($table);
				return $this->db->affected_rows();
		}
		
		
		public function select_data($table,$field,$where)
		{
				$this->db->select($field); 
				$this->db->from($table);
				if($where != '')
				{
					$this->db->where($where);
				}
				$query = $this->db->get();
				return $query->result();
		}
		
		public function select_row($table,$field,$where)
		{
				$this->db->select($field); 
				$this->db->from($table);
				if($where != '')
				{
					$this->db->where($where);
				}
				$query = $this->db->get();
				return $query->row();
		}
		
		
		public function select_data_orderby($table,$field,$where,$orderby)
		{
				$this->db->select($field); 
				$this->db->order_by($orderby); 

				$this->db->from($table);
				if($where != '')
				{
					$this->db->where($where);
				}
				$query = $this->db->get();
				return $query->result();
		}
		
		 public function checklogin($table,$field,$where)
		 {
				$this->db->select($field);
				$this->db->from($table);
				$this->db->where($where);
				
				$query = $this->db->get();
				if ( $query->num_rows() > 0 )
				{
					$row = $query->result();
					return $row;
				}
				else{
					return 'no';
				}

		 }
		 public function updatedatawhere($where,$arr,$table)
		{
			$this->db->where($where);
			$res = $this->db->update($table,$arr);
			return $res;
		}
	
		public function deletedatawhere($where,$table)
		{
			$this->db->where($where);
			$res = $this->db->delete($table);
			return $res;
		}
	
		public function checkdata($field,$table,$where)
		{
				
				$this->db->select($field);
				$this->db->from($table);
				$this->db->where($where);
				$query = $this->db->get();
				
				if ( $query->num_rows() > 0 )
				{
					$row = $query->num_rows();
					return $row;
				}
				else{
					return 0;
				}

		}
		
		/* varun deleteslider  */
		public function delete_slider($table,$where,$del_id,$doc)
		{
			$this-> db->where($where, $del_id);
			$this->db->delete($table);
			return $this->db->affected_rows();
		
		}
		/* varun deleteslider  */
		
		public function select_data_grp_by($table,$field,$grpby,$join,$on)
		{
			//echo $join;die();
				$this->db->select($field); 
				$this->db->from($table);
				$this->db->join($join,$on);
				$this->db->group_by($grpby); 
				$query = $this->db->get();
				return $query->result();
		}
			
		
		
		public function get_where($table,$field,$where)
		{
				$this->db->select($field); 
				$this->db->from($table);
				if($where != '')
				{
					$this->db->where($where);
				}
				$query = $this->db->get();
				if($query->num_rows == 0)
				{
					echo "no";
				}
				else{
					return $query->result();
				}	
		}
		
		function nearest_search_result($select,$where)
		{
			if($select != ''){
				$this->db->select($select);       
				$this->db->from('flr_products');
				$this->db->having($where); 			
				//$this->db->order_by('distance'); 
				}
				else{
						$this->db->select("`FP_ProID`,`FWM_ID`,`fp.FWCM_ID`,`fp.FCWM_ID`,`FP_Product_Name`,`FP_Product_Desc`,`FP_New_Price`,`FP_InStock`,`FP_Status`,`FP_UpdatedDate`,`FP_Thumbnail`,(select `FCWM_ID` from flr_cat_web_mapping fcw where fp.`FCWM_ID` = fcw.`FCWM_ID` ), (select `FWCM_ID` from flr_web_country_mapping fwc where fp.`FWCM_ID` = fwc.`FWCM_ID` )");       
						$this->db->from('flr_products fp');
						$this->db->where($where); 
				}
				//$this->db->limit(20, 0);
				$query = $this->db->get();
				return $query->result();	
		} 
		
		public function search_result($where)
		{
			$this->db->select("`FP_ProID`,`FWM_ID`,`FWCM_ID`,`FP_Product_Name`,`FP_Product_Desc`,`FP_New_Price `,`FP_InStock`,`FP_Status`,`FP_UpdatedDate`,`FP_Thumbnail`");       
			$this->db->from('flr_products');
			$this->db->where($where); 	
			$query = $this->db->get();
			return $query->result();
		} 
		 public function drop_down_data($table,$field)
		 {
				$this->db->select($field);
				$this->db->from($table);
				$query = $this->db->get();
				return $query->result();
		 }
	 
	 function get_flov($q)
		{
			$this->db->select('ML_ID,ML_LOV_Name');
			$this->db->like('ML_LOV_Name', $q);
			
			$query = $this->db->get('mov_lov');
			if($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$new_row['label']=htmlentities(stripslashes($row['ML_LOV_Name']));
					$new_row['value']=htmlentities(stripslashes($row['ML_LOV_Name']));
					$row_set[] = $new_row; //build an array
				}
				echo json_encode($row_set); //format the array into json data
			}
		}
		

		public function select_grp_by($where)
		{
			$this->db->select('fl.FL_ID,fl.FL_LOV_Value,SUM(fe.Fexp_amount) as Fexp_amount,fe.Fexp_payment_mode,fe.Fexp_date');
			$this->db->from('flr_lov fl');
			$this->db->join('flr_expenses fe', 'fl.FL_ID = fe.Fexp_name');
			$this->db->where($where);
			$this->db->group_by('fl.FL_ID');
			$query = $this->db->get();
			return $query->result();
		}
		public function select_grp_by_join($where)
		{
			$this->db->select('fl.FL_ID,fl.FL_LOV_Value,SUM(fe.Fexp_amount) as Fexp_amount,fe.Fexp_payment_mode,fe.Fexp_date');
			$this->db->from('flr_lov fl');
			$this->db->join('flr_expenses fe', 'fl.FL_ID = fe.Fexp_name');
			$this->db->where($where);
			$this->db->group_by('fl.FL_ID');
			$query = $this->db->get();
			return $query->result();
		}
/*View Order*///FWCM_ID
		
		
		public function nearestvendor($select,$where)
		{
				$this->db->select($select);       
				$this->db->from('flr_user_master');
				$this->db->having($where); 			
				$this->db->order_by('distance'); 
				$query = $this->db->get();
				$this->db->limit(10, 0);
				return $query->result();	
		}
		
		public function user_data($select,$table,$where,$limit,$offset)
		{
			$this->db->select($select);       
			$this->db->from($table);
			$this->db->where($where); 		
			$this->db->limit($limit,$offset);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function user_count($select,$table,$where)
		{
			$this->db->select($select);       
			$this->db->from($table);
			$this->db->where($where); 	
			$query = $this->db->get();
			return $query->num_rows();	
		}
		
		
		 public function getgstdata($web,$orderplacedate='0000-00-00'){
			//get current date
			$q = $this->db->select('FVAT_Flower,FVAT_Cake,FVAT_Chocolate,FVAT_Fruit,FVAT_Mithai,FVAT_DryFruit,FVAT_Toys,FVAT_Wine,FVAT_OtherGifts,FVAT_DeliveryCharges')
			->from('flr_vat v,flr_website w,flr_web_country_mapping wcm')
			->where("v.FWM_ID = wcm.FWM_ID and wcm.FWCM_ID = '$web' and FVAT_ApplyDate <= '$orderplacedate'")
			->order_by('FVAT_ApplyDate','DESC')
			->limit(1)
			->get();
			return $q->result();
			
		}

		public function get_websitedata($webcoutry){
			$this->db->select('fw.FWM_ID,fw.FWM_Imagepath,fw.FWM_Uploadpath,FWM_Domain_Name,FWM_Tax_Applicable,FWM_Website_Name');
			$this->db->from('flr_website fw');
			$this->db->join('flr_web_country_mapping fwc','fw.FWM_ID=fwc.FWM_ID');
			$this->db->where(['FWCM_ID'=>$webcoutry]);
			$query = $this->db->get();
			return $query->row();
		}
		
		public function get_redirectdata($query,$limit,$offset=0){
			 $q = $this->db->select('*')
					->from('flr_url_redirect')
					->where($query)
					->limit($limit,$offset)
					->order_by('FURL_ID','DESC')
					->get(); 
					/* if($offset != 0){
					$q = $this->db->query("Select * from flr_url_redirect  LIMIT $limit OFFSET $offset");}else{
					$q = $this->db->query("Select * from flr_url_redirect  LIMIT $limit"); 
			}		*/
					
			return $q->result();
		}
		
		public function get_redirectdata_num($query){
			$q = $this->db->select('*')
					->from('flr_url_redirect')
					->where($query)
					->get();
			return $q->num_rows();	
		}
		
		
		
		public function filtered_category($query,$limit,$offset)
		{
			
			$this->db->select('MCT_ID,MCT_Name,MCT_Desc,MCT_UpdatedDate,MCT_Status,MWM_Website_Name');
			$this->db->from('mov_category as c');		
			$this->db->join('mov_website as w','c.MWM_ID = w.MWM_ID','left');
			if($query != ''){
				$this->db->where($query);
			}
			$this->db->order_by("MCT_ID", "asc");
			$this->db->limit($limit,$offset);
			$query = $this->db->get();			
			return $query->result();
		}
		
		public function category_num_rows($query)
		{
			
			$this->db->select('MCT_ID,MCT_Name,MCT_Desc,MCT_UpdatedDate,MCT_Status,MWM_Website_Name');
			$this->db->from('mov_category as c');		
			$this->db->join('mov_website as w','c.MWM_ID = w.MWM_ID','left');	
			if($query != ''){
				$this->db->where($query);
			}
			$this->db->order_by("MCT_ID", "asc");
			$query = $this->db->get();
			return $query->num_rows();
		}
	
		
		
		public function get_rating($query,$limit,$offset=0){
			 $q = $this->db->select('*')
					->from('flr_rating')
					->where($query)
					->limit($limit,$offset)
					->order_by('FR_ID','DESC')
					->get(); 
					
					
			return $q->result();
		}
		
		public function get_rating_num($query){
			$q = $this->db->select('*')
					->from('flr_rating')
					->where($query)
					->get();
			return $q->num_rows();	
		}
	
		public function search_user_data($select,$table,$where,$limit,$offset,$order)
		{
			$this->db->select($select);       
			$this->db->from($table);
			if($where != '')
			{
				$this->db->where($where);
			}	
			$this->db->order_by($order, "asc");
			$this->db->limit($limit,$offset);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function search_user_count($select,$table,$where,$order)
		{
			$this->db->select($select);       
			$this->db->from($table);
			if($where != '')
			{
				$this->db->where($where);
			}
			$this->db->order_by($order, "asc");
			$query = $this->db->get();
			return $query->num_rows();	
		}
	
	
	function get_client_email($q)
		{
			$this->db->select('MC_cl_id,MC_cl_email');
			$this->db->like('MC_cl_email', $q);
			
			$query = $this->db->get('mov_clients');
			if($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$new_row['label']=htmlentities(stripslashes($row['MC_cl_email']));
					$new_row['value']=htmlentities(stripslashes($row['MC_cl_email']));
					$row_set[] = $new_row; //build an array
				}
				echo json_encode($row_set); //format the array into json data
			}
		}

		public function get_data_by_limit($table,$fields,$where,$orderby_col,$limit,$offset=0){
			$q = $this->db->select($fields)
				   ->from($table)
				   ->where($where)
				   ->limit($limit,$offset)
				   ->order_by($orderby_col)
				   ->get(); 
			   
		   return $q->result();
	   }
	
	
}


?>