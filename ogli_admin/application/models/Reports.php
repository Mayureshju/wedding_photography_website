<?php
 
if(!defined('BASEPATH')) exit('NO ACCESS');
Class Reports extends CI_Model
{
	public function view_sales_report($query,$limit,$offset){
		// $this->db->select('FO_Pay_Amount,Fo_Forward_ext_amt,FO_VendorID,FO_Order_Status,flr_orders.FO_OID,flr_orders.FWCM_ID,FO_Order_No,lo.FL_LOV_Value as order_status,ls.FL_LOV_Value as pay_status,FPG_Pay_Method,FO_Order_Amount,FO_Forward_Amt,recby.FUM_Comp_Name,recby.FUM_Email as vendor_email,FO_Order_Mode,recby.FUM_Full_name as orderfwdto');
		// $this->db->from('flr_orders  FORCE INDEX (PRIMARY,FWCM_ID,Fo_Pay_Get_Status,FO_Order_Status)');
		// $this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		// $this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		// $this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		// $this->db->join('flr_user_master AS recby', 'recby.FUM_ID = flr_orders.FO_VendorID','left');
		// //$this->db->where("FO_Paymet_Method <> 2");
		// $this->db->where('flr_orders.Fo_Pay_Get_Status','100');
		// $this->db->where("flr_orders.FO_Order_Status in (93,94,95,98)");
		// $this->db->where("FO_Paymet_Method <> 2");
		// //$query = base64_decode($query);
		// if($query != ''){
		// 	$this->db->where($query);
		// }
		// $this->db->order_by("FO_Order_Placed_Date", "asc");



		$this->db->select('MOR_id,MOR_number,MOR_total_amount,MOR_payment_status,MOR_payment_type,recby.MUM_Full_name as orderfwdto');
		$this->db->from('mov_order');
		//$this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		//$this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		//$this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		$this->db->join('mov_user_master AS recby', 'recby.MUM_ID = mov_order.MUM_ID','left');
		//$this->db->where("FO_Paymet_Method <> 2");
		$this->db->where("MOR_payment_type = 1");
		$this->db->where('mov_order.MOR_payment_status','1');
		//$this->db->where("mov_order.FO_Order_Status in (93,94,95,98)");
		//$this->db->where("FO_Paymet_Method <> 2");
		//$query = base64_decode($query);
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("MOR_created_date", "asc");
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function view_sales_report_all($query,$val){
		// $this->db->select('FO_Invoice,FO_Invoice_date,FO_Bill_gstin_no,	FO_Bill_State_gstcode,FO_Bill_Name,FO_Del_Amt,FO_Discount_Percentage,FO_Promoid,FO_Order_Placed_Date,FO_Pay_Amount,Fo_Forward_ext_amt,FO_Order_Status,flr_orders.FO_OID,flr_orders.FWCM_ID,FO_Order_No,lo.FL_LOV_Value as order_status,ls.FL_LOV_Value as pay_status,FPG_Pay_Method,FO_Order_Amount,FO_Forward_Amt,recby.FUM_Comp_Name,recby.FUM_Email as vendor_email,FO_Order_Mode,recby.FUM_Full_name as orderfwdto,cust.FUM_Comp_Name as compname');
		// $this->db->from('flr_orders  FORCE INDEX (PRIMARY,FWCM_ID,Fo_Pay_Get_Status,FO_Order_Status)');
		// $this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		// $this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		// $this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		// $this->db->join('flr_user_master AS recby', 'recby.FUM_ID = flr_orders.FO_VendorID','left');
		// $this->db->join('flr_user_master AS cust', 'cust.FUM_ID = flr_orders.FO_CustomerID','left');
		// $this->db->where('flr_orders.Fo_Pay_Get_Status','100');
		// $this->db->where("flr_orders.FO_Order_Status in (93,94,95,98)");
		
		
		
		$this->db->select('MOR_total_amount,MOR_payment_status,MOR_booking_date,MOR_client_name,MOR_number,MOR_type,MOR_payment_date,MOR_Description,recby.MUM_Full_name as orderfwdto');
		$this->db->from('mov_order');
		//$this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		//$this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		//$this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		$this->db->join('mov_user_master AS recby', 'recby.MUM_ID = mov_order.MUM_ID','left');
		//$this->db->where("FO_Paymet_Method <> 2");
		$this->db->where("MOR_payment_type = 1");
		$this->db->where('mov_order.MOR_payment_status','1');

		if($val==1){
			$this->db->where("MOR_payment_type <> 2");
		}
		
		//$query = base64_decode($query);
		if($query != ''){
			$this->db->where($query);
		}
		//$this->db->order_by("FO_Invoice", "asc");
		$this->db->order_by("MOR_payment_date", "asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	//cancel report
	public function view_cancel_report_all($query){// compname FO_Bill_Name
		$this->db->select('FO_Order_Cancel_Date,FO_Reason_hold_cancel,FO_Invoice,FO_Invoice_date,FO_Bill_gstin_no,	FO_Bill_State_gstcode,FO_Bill_Name,FO_Del_Amt,FO_Discount_Percentage,FO_Promoid,FO_Order_Placed_Date,FO_Pay_Amount,Fo_Forward_ext_amt,FO_Order_Status,flr_orders.FO_OID,flr_orders.FWCM_ID,FO_Order_No,lo.FL_LOV_Value as order_status,ls.FL_LOV_Value as pay_status,FPG_Pay_Method,FO_Order_Amount,FO_Forward_Amt,recby.FUM_Comp_Name,recby.FUM_Email as vendor_email,FO_Order_Mode,recby.FUM_Full_name as orderfwdto,cust.FUM_Comp_Name as compname');
		$this->db->from('flr_orders  FORCE INDEX (PRIMARY,FWCM_ID,Fo_Pay_Get_Status,FO_Order_Status)');
		$this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		$this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		$this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		$this->db->join('flr_user_master AS recby', 'recby.FUM_ID = flr_orders.FO_VendorID','left');			
		$this->db->join('flr_user_master AS cust', 'cust.FUM_ID = flr_orders.FO_CustomerID','left');
		$this->db->where('flr_orders.Fo_Pay_Get_Status','100');
		$this->db->where("flr_orders.FO_Order_Status = 96");
		/* if($val==1){
			$this->db->where("FO_Paymet_Method <> 2");
		} */
		
		//$query = base64_decode($query);
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("FO_Order_Placed_Date", "asc");
		$query = $this->db->get();
		return $query->result();
	}
	//Purchase report
	
	
	public function view_purchase_report_all($query){ //FVFA_Invoice_No FO_Del_Date FIM_Vendor_Invoice_No FIM_Vendor_Invoice_No,inv.FUM_ID
		$this->db->select('flr_orders.FO_OID,FO_Forward_Amt,FO_Del_Date,FO_Del_Amt,FO_Promoid,FO_Order_Placed_Date,Fo_Forward_ext_amt,flr_orders.FWCM_ID,FO_Order_No,recby.FUM_Comp_Name,recby.FUM_Full_name as orderfwdto,recby.FUM_GSTIN,	FVFA_Flower,FVFA_Cake,FVFA_Chocolate,FVFA_Fruit,FVFA_Dryfruit,FVFA_Stufftoy,FVFA_Mithai,FVFA_Delivery_Charges,vf.FUM_ID,FUM_State_code');
		$this->db->from('flr_vendor_forward_amt as vf');	
		$this->db->join('flr_orders', 'vf.FO_OID = flr_orders.FO_OID','left');
		$this->db->join('flr_user_master AS recby', 'recby.FUM_ID = flr_orders.FO_VendorID','left');
		//$this->db->join('flr_invoice_master AS inv', 'inv.FUM_ID = flr_orders.FO_VendorID','left');
		$this->db->where('flr_orders.Fo_Pay_Get_Status','100');
		$this->db->where("flr_orders.FO_Order_Status = 95");
		$this->db->where("recby.FUM_status",'1');
		/* if($val==1){
			$this->db->where("FO_Paymet_Method <> 2");
		} */
		
		//$query = base64_decode($query);
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("FO_Del_Date", "asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	public function view_payment_report_all($query){
		$this->db->select('FO_Promoid,FO_OID,o.FWCM_ID,FO_Order_Placed_Date,FO_Bill_State_gstcode,recby.FUM_Comp_Name,recby.FUM_Email as vendor_email,FO_Order_Mode,recby.FUM_Full_name as orderfwdto,recby.FUM_State_code,recby.FUM_GSTIN,o.FO_VendorID');
		$this->db->from('flr_orders o');
		$this->db->join('flr_user_master AS recby', 'recby.FUM_ID = o.FO_VendorID','left');
		$this->db->where('o.Fo_Pay_Get_Status','100');
		$this->db->where("o.FO_Order_Status = 95");
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("FO_Order_Placed_Date", "asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	public function select_forward_order($order){
		$q =$this->db->where('FO_OID',$order)
					->get('flr_vendor_forward_amt');
					return $q->result();
	}
	
	public function paymentreport_vendorpayment($query){
		$this->db->select('FUA_ID as voucherno,DATE(FUA_Payment_Date) as voucherdate,fum.`FUM_Comp_Name`,fum.FUM_Full_name,fum.FUM_ID, sum(fu.FUA_debit) as amount,fum.FUM_State_code, fum.FUM_GSTIN');
		$this->db->from('flr_user_master fum');
		$this->db->join('flr_user_accounts fu','fum.FUM_ID =fu.FUM_ID','left');
		$this->db->where($query);
		$this->db->group_by('fu.FUM_ID'); 
		$query = $this->db->get();
		return $query->result();
	}
	
	public function sales_num_rows($query){
		// $this->db->select('FO_Pay_Amount,Fo_Forward_ext_amt,FO_Order_Status,flr_orders.FO_OID,flr_orders.FWCM_ID,FO_Order_No,lo.FL_LOV_Value as order_status,ls.FL_LOV_Value as pay_status,FPG_Pay_Method,FO_Order_Amount,	FO_Forward_Amt,recby.FUM_Comp_Name,recby.FUM_Email as vendor_email,FO_Order_Mode,recby.FUM_Full_name as orderfwdto');
		// $this->db->from('flr_orders');
		// $this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		// $this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		// $this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		// $this->db->join('flr_user_master AS recby', 'recby.FUM_ID = flr_orders.FO_VendorID','left');
		// $this->db->where('flr_orders.Fo_Pay_Get_Status','100');
		// $this->db->where("flr_orders.FO_Order_Status in (93,94,95,98)");
		// $this->db->where("FO_Paymet_Method <> 2");
		//$query = base64_decode($query);




		$this->db->select('MOR_total_amount,MOR_payment_status,recby.MUM_Full_name as orderfwdto');
		$this->db->from('mov_order');
		//$this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		//$this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		//$this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		$this->db->join('mov_user_master AS recby', 'recby.MUM_ID = mov_order.MUM_ID','left');
		//$this->db->where("FO_Paymet_Method <> 2");
		$this->db->where("MOR_payment_type = 1");
		$this->db->where('mov_order.MOR_payment_status','1');
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("MOR_created_date", "asc");
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function paymentgatewaytotal($query){
		$this->db->select('`FPG_Pay_Method`, sum(`FO_Pay_Amount`) as paytotal');
		$this->db->from('flr_orders');
		$this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		$this->db->where('flr_orders.FO_Pay_Get_Status','100');
		$this->db->where("flr_orders.FO_Order_Status in (93,94,95,98)");
		$this->db->where("FO_Paymet_Method <> 2");
		$this->db->where($query);
		$this->db->group_by('FPG_Pay_Method');
		$querydata = $this->db->get();
		return $querydata->result();
	}
	
	/*public function gstdata($query){
		$querydata = $this->db->query('select (sum(FOPM_FLOWER_PRICE) + sum(FOPM_DTQ_PRICE) + sum(FOPM_ADD_VASE_PRICE)) - ((sum(FOPM_FLOWER_PRICE) + sum(FOPM_DTQ_PRICE) + sum(FOPM_ADD_VASE_PRICE)) * avg(FO_Discount_Percentage) / 100) as flowersum,(sum(FOPM_CAKE_PRICE) + sum(FOPM_MAKE_EGGLESS) * FO_Discount_Percentage / 100) as cakesum,(sum(FOPM_CHOCOLATE_PRICE) * FO_Discount_Percentage / 100) as chsum,(sum(FOPM_FRUIT_PRICE) * FO_Discount_Percentage / 100) as fruitsum, (sum(FOPM_MITHAI_PRICE)* FO_Discount_Percentage / 100) as mithaisum, (sum(FOPM_STUFF_TOY_PRICE)* FO_Discount_Percentage / 100) as toysum, (sum(FOPM_DRY_FRUIT_PRICE)* FO_Discount_Percentage / 100) as drysum, (sum(FO_Del_Amt)* FO_Discount_Percentage / 100) as delsum, (sum(FOPM_CK_VAR_PRICE)* FO_Discount_Percentage / 100) as cksum from flr_orders o left join flr_orders_product_mapping op on o.FO_OID=op.FO_OID where o.FO_Pay_Get_Status =100 and o.FO_Order_Status in (93,94,95,98) and o.FO_Paymet_Method <> 2 and FOPM_Discount = 0 and '.$query.' ');
		 $this->db->from('flr_orders');
		$this->db->join('flr_orders_product_mapping as op','flr_orders.FO_OID=op.FO_OID','left');
		$this->db->where('flr_orders.FO_Pay_Get_Status','100');
		$this->db->where("flr_orders.FO_Order_Status in (93,94,95,98)");
		$this->db->where("FO_Paymet_Method <> 2");
		$this->db->where($query); 
		$querydata = $this->db->get();
		return $querydata->result();
	}*/
	
/* 	public function view_delivery_report($query,$limit,$offset){
		$this->db->select('		FO_Ship_City,FO_Acc_BY,Fo_Forward_ext_amt,FO_VendorID,FO_Order_Status,flr_orders.FO_OID,flr_orders.FWCM_ID,FO_Order_No,lo.FL_LOV_Value as order_status,ls.FL_LOV_Value as pay_status,FPG_Pay_Method,FO_Order_Amount,FO_Forward_Amt,recby.FUM_Comp_Name,recby.FUM_Email as vendor_email,FO_Order_Mode,recby.FUM_Full_name as orderfwdto,	FO_Bill_Name,FO_Ship_Name,FO_Ship_Add,FO_Ship_Zip,FO_Ship_Phone,FO_Ship_Mobile,FO_Ship_Mobile_alt,FO_Ship_Email');
		$this->db->from('flr_orders');
		$this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		$this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		$this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		$this->db->join('flr_user_master AS recby', 'recby.FUM_ID = flr_orders.FO_VendorID','left');
		//$this->db->where("FO_Paymet_Method <> 2");
		$this->db->where('flr_orders.Fo_Pay_Get_Status','100');
		$this->db->where("flr_orders.FO_Order_Status in (94,95)");
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("FO_OID", "ASC");
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	} */
	public function view_delivery_report($query){
		$this->db->select('		FO_Ship_City,FO_Acc_BY,Fo_Forward_ext_amt,FO_VendorID,FO_Order_Status,flr_orders.FO_OID,flr_orders.FWCM_ID,FO_Order_No,lo.FL_LOV_Value as order_status,ls.FL_LOV_Value as pay_status,FPG_Pay_Method,FO_Order_Amount,FO_Forward_Amt,recby.FUM_Comp_Name,recby.FUM_Email as vendor_email,FO_Order_Mode,recby.FUM_Full_name as orderfwdto,	FO_Bill_Name,FO_Ship_Name,FO_Ship_Add,FO_Ship_Zip,FO_Ship_Phone,FO_Ship_Mobile,FO_Ship_Mobile_alt,FO_Ship_Email');
		$this->db->from('flr_orders');
		$this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		$this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		$this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		$this->db->join('flr_user_master AS recby', 'recby.FUM_ID = flr_orders.FO_VendorID','left');
		//$this->db->where("FO_Paymet_Method <> 2");
		$this->db->where('flr_orders.Fo_Pay_Get_Status','100');
		//$this->db->where("flr_orders.FO_Order_Status in (94,95)");
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("FO_OID", "ASC");
		$query = $this->db->get();
		return $query->result();
	}
	
	public function delivery_num_rows($query){
		$this->db->select('	FO_Ship_City,FO_Acc_BY,Fo_Forward_ext_amt,FO_VendorID,FO_Order_Status,flr_orders.FO_OID,flr_orders.FWCM_ID,FO_Order_No,lo.FL_LOV_Value as order_status,ls.FL_LOV_Value as pay_status,FPG_Pay_Method,FO_Order_Amount,FO_Forward_Amt,recby.FUM_Comp_Name,recby.FUM_Email as vendor_email,FO_Order_Mode,recby.FUM_Full_name as orderfwdto,	FO_Bill_Name,FO_Ship_Name,FO_Ship_Add,FO_Ship_Zip,FO_Ship_Phone,FO_Ship_Mobile,FO_Ship_Mobile_alt,FO_Ship_Email');
		$this->db->from('flr_orders');
		$this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		$this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		$this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		$this->db->join('flr_user_master AS recby', 'recby.FUM_ID = flr_orders.FO_VendorID','left');
		//$this->db->where("FO_Paymet_Method <> 2");
		$this->db->where('flr_orders.Fo_Pay_Get_Status','100');
		//$this->db->where("flr_orders.FO_Order_Status in (94,95)");
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("FO_OID", "ASC");
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function view_vendor_purchase_invoice($query){
		$this->db->distinct();
		$this->db->select('FO_VendorID');
		$this->db->from('flr_orders');
		$this->db->join('flr_user_master AS recby', 'recby.FUM_ID = flr_orders.FO_VendorID','left');
		$this->db->where('flr_orders.Fo_Pay_Get_Status','100');
		$this->db->where("flr_orders.FO_Order_Status = 95");
		$this->db->where("recby.FUM_status",'1');
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("FO_Order_Placed_Date", "asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	public function view_outstanding_report($query,$limit,$offset){

		$this->db->select('MOR_id,MOR_number,MOR_total_amount,MOR_pay_amount,MOR_payment_status,MOR_payment_type,recby.MUM_Full_name as orderfwdto');
		$this->db->from('mov_order');
		$this->db->join('mov_user_master AS recby', 'recby.MUM_ID = mov_order.MUM_ID','left');
		$this->db->where("mov_order.MOR_payment_type = 2");
		//$this->db->where('mov_order.MOR_payment_status','1');
		//$this->db->where("mov_order.FO_Order_Status in (93,94,95,98)");
		//$this->db->where("FO_Paymet_Method <> 2");
		//$query = base64_decode($query);
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("MOR_created_date", "asc");
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function outstanding_num_rows($query){

		$this->db->select('MOR_total_amount,MOR_payment_status,recby.MUM_Full_name as orderfwdto');
		$this->db->from('mov_order');
		//$this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		//$this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		//$this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		$this->db->join('mov_user_master AS recby', 'recby.MUM_ID = mov_order.MUM_ID','left');
		$this->db->where("mov_order.MOR_payment_type = 2");
		//$this->db->where('mov_order.MOR_payment_status','1');
		if($query != ''){
			$this->db->where($query);
		}
		$this->db->order_by("MOR_created_date", "asc");
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function view_outstanding_report_all($query,$val){

		$this->db->select('MOR_total_amount,MOR_pay_amount,MOR_payment_status,MOR_booking_date,MOR_client_name,MOR_number,MOR_type,MOR_payment_date,MOR_Description,recby.MUM_Full_name as orderfwdto');
		$this->db->from('mov_order');
		//$this->db->join('flr_lov as lo','flr_orders.FO_Order_Status=lo.FL_ID','left');
		//$this->db->join('flr_lov as ls','flr_orders.Fo_Pay_Get_Status=ls.FL_ID','left');
		//$this->db->join('flr_payment_gateway as pg','FO_Paymet_Method=pg.FPG_ID','left');
		$this->db->join('mov_user_master AS recby', 'recby.MUM_ID = mov_order.MUM_ID','left');
		//$this->db->where("FO_Paymet_Method <> 2");
		//$this->db->where('mov_order.MOR_payment_status','1');

		if($val==2){
			$this->db->where("MOR_payment_type = 2");
		}
		
		//$query = base64_decode($query);
		if($query != ''){
			$this->db->where($query);
		}
		//$this->db->order_by("FO_Invoice", "asc");
		$this->db->order_by("MOR_payment_date", "asc");
		$query = $this->db->get();
		return $query->result();
	}

}