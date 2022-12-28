<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesreport extends CI_Controller {

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
		
	}
	public function search_sales_report(){
		$this->form_validation->set_rules('selectdate','Select Date',"trim");
		$this->form_validation->set_rules('from_date','From Date','trim|required');
		$this->form_validation->set_rules('to_date','to_date','trim|required');
		$this->form_validation->set_rules('website','website','trim');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('sales_report_download',array(validation_errors()));
		}else{
			$data = $this->input->post();
			$report['selectdate'] = $data['selectdate'];
			$report['from_date'] = $data['from_date'];
			$report['to_date'] = $data['to_date'];
			// $report['website'] = $data['website'];
			$this->load->view('sales_report_download',$report);
		}
	}
	public function sales_report_download($selectdate='',$from_date='',$to_date ='',$website='no'){
		$this->load->model('Reports');
		$this->load->model('Master_model');
		if($from_date !='' && $to_date != ''){
			$from_date = base64_decode($from_date);
			$to_date = base64_decode($to_date);
			$website = base64_decode($website);
			
			//$website_country = $this->session->userdata('websitecountry');
			// $alter_sql = $website != 'no'?" and flr_orders.FWCM_ID = $website":" and flr_orders.FWCM_ID in (".$website_country.")";
			$query = "DATE(MOR_payment_date) between '".$from_date."' and '".$to_date."'";
			$listall = $this->Reports->view_sales_report_all($query,2);
			//echo $this->db->last_query();exit;
			$finalexcel = array();
			$firstheading = array('Order No.','Invoice No.','Invoice date','Payment Type','Client Name','Amount','GST','SGST','CGST','IGST');
			array_push($finalexcel,$firstheading);
			//$finalexcel[] = ;
			$currdate = date('Y-m-d');
			if(isset($listall)){
				foreach($listall as $l){
					// $get_websitedata = $this->Master_model->get_websitedata($l->FWCM_ID);
					// $FWM_Website_Name = $get_websitedata->FWM_Website_Name;
				//echo $this->db->last_query();exit;
				$orderplacedt = date("Y-m-d", strtotime($l->MOR_booking_date));
				// $web = $website != 'no'?$website:WEBCOUNTRY;
				//$product_vat=$this->Master_model->getgstdata($web,$orderplacedt);
				$product_vat="0";
				// 		$vatFlower = 0;
				// 		$vatCake = 0;
				// 		$vatChocolate = 0;
				// 		$vatFruit = 0;
				// 		$vatMithai = 0;
				// 		$vatStuff_Toys = 0;
				// 		$vatDry_Fruit = 0;
				// 		$vatWine = 0;
				// 		$vatOther_Gifts = 0;
				// 		$vatDelivery_Charges = 0;
				
				// if(!empty($product_vat[0])){
				// 	foreach($product_vat as $vat){
				// 		$vatFlower = $vat->FVAT_Flower;
				// 		$vatCake = $vat->FVAT_Cake;
				// 		$vatChocolate = $vat->FVAT_Chocolate;
				// 		$vatFruit = $vat->FVAT_Fruit;
				// 		$vatMithai = $vat->FVAT_Mithai;
				// 		$vatStuff_Toys = $vat->FVAT_Toys;
				// 		$vatDry_Fruit = $vat->FVAT_DryFruit;
				// 		$vatWine = $vat->FVAT_Wine;
				// 		$vatOther_Gifts = $vat->FVAT_OtherGifts;
				// 		$vatDelivery_Charges = $vat->FVAT_DeliveryCharges;
				// 	}
				// }
				//assign varible 0
				// $flowertotal = 0;
				// $caketotal = 0;
				// $chocolatetotal = 0;
				// $fruittotal = 0;
				// $toytotal = 0;
				// $drytotal = 0;
				// $mithaitotal = 0;
				// $deltotal = 0;
					$overalltotal =0;
				
					$pricediscount1 = 0;
				$flowertotal1 = 0;
				$gstflowertotal1 = 0;
				$gstfruittotal1 = 0;	
				
				
				$sgstoverall = 0;
				$cgstoverall= 0;
				$igsoverall = 0;
				
				//$pid = $l->FO_Promoid;
				
				$total= '';
				$pricediscount = $l->MOR_total_amount;
				$tax = $pricediscount - ($pricediscount * 100 /($product_vat+100));
				//$gstprodtotal += $tax;
				//print_r($pricediscount.'///'.number_format(((float)$tax),'2','.',''));
				$total .= $pricediscount - number_format(((float)$tax),'2','.','');
				$sgstoverall =  ($tax/2);
				$cgstoverall = ($tax/2);
				$igsoverall = 0;


				$name = $l->MOR_client_name;
				
					
				
				$sgstoverall = number_format(((float)$sgstoverall),'2','.','');	
				$cgstoverall = number_format(((float)$cgstoverall),'2','.','');	
				$igsoverall = number_format(((float)$igsoverall),'2','.','');
				$invoiceprefix = '1718';
				//$totalordamt =	($flowertotal1+$gstflowertotal1+$fruittotal+$gstfruittotal+$caketotal+$sgstcake+$cgstcake+$igstcake+$chocolatetotal+$sgstchocolate+$cgstchocolate+$igstchocolate+$mithaitotal+$sgstmithai+$cgstmithai+$igstmithai+$toytotal+$sgsttoy+$cgsttoy+$igsttoy+$drytotal+$sgstdry+$cgstdry+$igstdry+$deltotal+$sgstdel+$cgstdel+$igstdel);	
				$totalordamt =	($total+$sgstoverall+$cgstoverall+$igsoverall);	
				$totalordamt = number_format(((float)$totalordamt),'0','.','');	
				//$exceldata = array($l->FO_Order_No,$FWM_Website_Name,$invoiceprefix.$l->FO_Invoice,$l->FO_Invoice_date,$l->FPG_Pay_Method,$name,$l->FO_Bill_State_gstcode,$l->FO_Bill_gstin_no,round($totalordamt),round($flowertotal1,2),round($gstflowertotal1,2),round($fruittotal,2),round($gstfruittotal,2),round($caketotal,2),round($sgstcake,2),round($cgstcake,2),round($igstcake,2),round($chocolatetotal,2),round($sgstchocolate,2),round($cgstchocolate,2),round($igstchocolate,2),round($mithaitotal,2),round($sgstmithai,2),round($cgstmithai,2),round($igstmithai,2),round($toytotal,2),round($sgsttoy,2),round($cgsttoy,2),round($igsttoy,2),round($drytotal,2),round($sgstdry,2),round($cgstdry,2),round($igstdry,2),round($deltotal,2),round($sgstdel,2),round($cgstdel,2),round($igstdel,2));
				
				$exceldata = array($l->MOR_number,$invoiceprefix,$l->MOR_payment_date,$l->MOR_type,$name,($totalordamt),$tax,($sgstoverall),($cgstoverall),($igsoverall));
				array_push($finalexcel,$exceldata);
				
			}
			}
			exports_data($finalexcel,date('Y-m-d')."_Sales_Report");
		}
		
	}
	
	
	public function getproductdisc($prdid,$price,$discount,$pid,$orderplacedt,$qty){
		$disamount = 0;
		$catid = 0;
		
		if($prdid != 0){
				//promocode in order table not appeared in old system so in else part if promocode not apper check for discount and apply discount
					if($pid != 0){ 
					$promocode = get_list('flr_promocode','FCT_ID',"FP_ID = '$pid'");
					$catid = $promocode[0]->FCT_ID;
					if($catid != 0){
						$prddata = get_list('flr_products','FP_ProID',"FP_ProID = $prdid and (find_in_set('$catid',FCWM_ID) <> 0)");
						if(!empty($prddata[0])){
							$disamount = $price * ($discount / 100);
						}
					}else{
						$disamount = $price * ($discount / 100);
					}
					}else{
						if($discount != 0){
							$disamount = $price * ($discount / 100);	
						}
					}
				
				return ($price - $disamount) * $qty;
		}else{
			return $price * $qty;
		}
	}
	
	/* public function exports_data($data,$name){
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
        } */
	
}
