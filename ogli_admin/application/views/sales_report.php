<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
	<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Daily Collection Report</li>
		</ol>
		</div>
		<div class="col-sm-9 col-md-9 col-xs-4">
			<button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;" onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i>
				</button>
		</div>
	</div> 
				<div class="row">
							<div class="alert alert-danger alert-dismissible" style="<?php if ($this->session->flashdata('error')) echo 'display:block';
                                                                                      else echo 'display:none'; ?>">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Error!</h4>
                  <?php if ($this->session->flashdata('error')) echo $this->session->flashdata('error'); ?>
                </div>
              <div class="alert alert-success alert-dismissible" style="<?php if ($this->session->flashdata('success')) echo 'display:block';
                                                                                      else echo 'display:none';
                                                                          ?>">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php if ($this->session->flashdata('success')) echo $this->session->flashdata('success'); ?>
                </div>
            </div>

		<div class="section-body ">
			<div class="row">
				<div class="col-lg-12">
					<div class="e-panel card">
						<div class="card-body">
							<div class="e-table">
								
							<div class="row">
								<div class="col-sm-12 col-md-2 col-xs-12 mb-3">
									<a href=""><h4 style="font-size: 1.1rem !important;">Daily Collection Report</h4></a>
								</div>
								<div class="col-sm-12 col-md-8 col-xs-12">
                  
						                               
								<?=form_open('Nav/search_sales_report',['class'=>'form-inline'])?>
                                
                                    <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                        <label class="control-label" for="title">View Report
                                        </label>
										<?php 
										$selecteddt = '';
											if(isset($selectdate)){ $selecteddt = $selectdate;}
										?>
										<select class="form-control select2" name="selectdate" id="selectdate">
											<option <?php echo $selecteddt == 'custom'?"selected":"";?> value="custom">Custom Range</option>											
											<option <?php echo $selecteddt == 'today'?"selected":"";?> value="today">Today</option>											
											<option <?php echo $selecteddt == 'yesterday'?"selected":"";?> value="yesterday">Yesterday</option>											
											<option <?php echo $selecteddt == 'thisweek'?"selected":"";?> value="thisweek">This Week</option>										
											<option <?php echo $selecteddt == 'lastweek'?"selected":"";?> value="lastweek">Last Week</option>											
											<option <?php echo $selecteddt == 'thismonth'?"selected":"";?> value="thismonth">This Month</option>											
											<option <?php echo $selecteddt == 'lastmonth'?"selected":"";?> value="lastmonth">Last Month</option>											
											<option <?php echo $selecteddt == 'thisyear'?"selected":"";?> value="thisyear">This Year</option>											
											<option <?php echo $selecteddt == 'lastyear'?"selected":"";?> value="lastyear">Last Year</option>
										</select>
                                    </div>
                                
								
                               
									<div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                        <label>From</label>
                                       <input type="text" name="from_date" data-date-format="yyyy-mm-dd" id="from_date" class="form-control" value="<?php if(isset($from_date)){echo $from_date;} ?>" autoload="off" readonly/>
                                    </div>
                               
								
									<div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                        <label class="control-label" for="status">TO</label>
                                         <input type="text" name="to_date" data-date-format="yyyy-mm-dd" id="to_date" class="form-control" value="<?php if(isset($to_date)){echo $to_date;} ?>" autoload="off" readonly/>
									</div>
									
									<div class="col-md-2 col-sm-2 col-xs-12 form-group">
									<label></label>
                                        <button type="submit" id="addlov" class="btn btn-primary btnserch" >
                                            <i class="fa fa-search"></i>
										</button>
										
                                    </div>
									<?=form_close()?>
								
								</div>
								<div class="col-sm-12 col-md-2 col-xs-12">
								<a href="<?php echo base_url();?>Nav/sales_report/<?php echo $no;?>" data-toggle="tooltip" title="Reset" class="btn btn-default" data-original-title="Rebuild">
											<i class="fa fa-refresh"></i>
										</a>
								</div>
							</div>

            <!-- End of Container-fluid -->

            <!-- Container-fluid -->

            <!-- <div class="container-fluid"> -->


                <!-- product layout -->
				
                <div class="row" >
                   
                        <!-- <div class="panel-body">
							<div class="container" >
								<div class="row">-->
									<div class="col-md-offset-3 col-md-6" style="margin-left: 25%;"> 
									<?php
										$wbsale = '';
										$totalamt = 0;
										$per_Web_sales = array(); 
										$myWebName = array();
										$totalforwardamt = 0;
										// $webdata = get_list('flr_web_country_mapping fwcm,flr_website fw,flr_country fc','FWCM_ID,FCnt_Country_name,FWM_Website_Name','fwcm.FWM_ID = fw.FWM_ID and fwcm.FCnt_ID = fc.FCnt_ID and fc.FCnt_Status=1 and fw.FWM_Active=1');
										// 				$webseletect = '';
										// 				foreach($webdata as $web){
										// 					$myWebName[(int)$web->FWCM_ID]=(string)$web->FWM_Website_Name;
										// 					$per_Web_sales[(int)$web->FWCM_ID] = 0; 
										// 				}
										if(isset($listofallorders)){
											foreach($listofallorders as $listall){
													// $per_Web_sales[$listall->FWCM_ID] += (float)$listall->MOR_total_amount;
													 $totalamt += $listall->MOR_total_amount;
													// $totalforwardamt += $listall->FO_Forward_Amt+$listall->Fo_Forward_ext_amt;
													$totalforwardamt += $listall->MOR_total_amount;
											}
										}
										
													
										// echo "<script>document.getElementById('websale').innerHTML='".$wbsale."';</script>";
										 
									?>
									<div class="table-responsive table-lg" style="margin-top: 10px;">
										<table class="table table-bordered" >
										<th colspan="5" style="text-align:center;" bgcolor="#efefef">Sales Report</th>
											<tr>
												<td>Sales Date</td>
												<td><strong>From</strong> -  <?php if(isset($from_date)){ echo date("d M, Y",strtotime($from_date));}?><br/><strong>To</strong>-  <?php if(isset($to_date)){ echo date("d M, Y",strtotime($to_date));}?></td>
												
										  
												
											</tr>
											<tr>
												<td>Total Orders</td>
												<td><strong class="text-danger"><?php if(isset($totalorder)){echo $totalorder;}?></strong> Received</td>
											 
											</tr>
											<tr>
												<td>Total Sales</td>
												<!--<td id="totalsale"><strong><p class="text-danger">Rs. 0<br>
																	 $0</p></strong> </td>-->

												<td id="totalsale"><?php 
												 $totalusdamt = convert_currency('INR','USD',$totalamt);
												 $totalsale = '<strong><p class="text-danger">Rs. '.moneyFormatIndia(round($totalamt)).'
																	 <br>$'.$totalusdamt.'</p></strong>';
												 echo $totalsale;
												
												?> </td>
											</tr>
											
										</table>
										</div>
									</div>
									</div>

									<div class="row" >





									<div class="table-responsive table-lg">
								
                                
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                        <tr class="textC">
											<th class="text-left">Order No</th>
											<!-- <th class="text-left">Order Status</th> -->
											<th class="text-left">Payment Status</th>
											<th class="text-left">Payment Type</th>
											<th class="text-left">Amount</th>
											<!-- <th class="text-left">Forwarded To</th>
											<th class="text-left">Forwarded Amount</th>	 -->
                                        </tr>
                                    </thead>
                                    <tbody> 
										<?php 
										
										if(isset($listoforders)){
											$class = '';
											foreach($listoforders as $list){
												switch($list->MOR_payment_status){
													case 0 : $class = 'text-danger';break;
													case 1 : $class = 'text-success';break;	
												}
												?>
													<tr><td><a href="<?php echo base_url();?>/Order/edit_order/<?php echo $list->MOR_id ;?>/1/<?= $no ?>/0"><?php echo $list->MOR_number;?></a></td>
													<!-- <td><p class="<?php echo $class;?>"><?php //echo $list->order_status;?></p></td> -->
													<td><p class="<?php echo $class;?>"><?php if($list->MOR_payment_status == 1) { echo 'Received'; }else{ echo 'Pending'; } ?></p></td>
													<td><?php if($list->MOR_payment_type == "1"){ echo 'Full'; }else if($list->MOR_payment_type == "2"){ echo 'Part'; }?></td>
													<td><?php echo moneyFormatIndia(round($list->MOR_total_amount));?></td>
													<!-- <td><a href="<?php echo base_url();?>User/edit_vendor/<?php echo $list->FO_VendorID;?>/<?= $no ?>/0"><?php echo ($list->FUM_Comp_Name != '')?$list->FUM_Comp_Name:$list->orderfwdto;?></a></td>
													<td><?php echo moneyFormatIndia(round($list->FO_Forward_Amt+$list->Fo_Forward_ext_amt));?></td></tr> -->
												<?php
											}
										}
										?>
									 </tbody>  
								</table>
								<?php echo $this->pagination->create_links();?>
					 </div>





									</div>
									
								
							
                                                                    

						
							<!--<div class="table-responsive table-bordered">
								<div class="col-md-12" id="bs-example-navbar-collapse-1">
										
								</div>
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                        <tr class="textC">
											<th class="text-left">Order No</th>
											<th class="text-left">Order Status</th>
											<th class="text-left">Payment Status</th>
											<th class="text-left">Payment Gateway</th>
											<th class="text-left">Amount</th>
											<th class="text-left">Forwarded To</th>
											<th class="text-left">Forwarded Amount</th>	
                                        </tr>
                                    </thead>
                                    <tbody> 
										
                                    </tbody>  
								</table>
										<?php echo $this->pagination->create_links();?>
                            </div>-->
							<br>
							<div class="">
								<div class="table-responsive">
								<?php if(isset($paymentgatewaytotal)){?>
									<table class="table table-bordered">
									<tr>
									<?php 
											foreach($paymentgatewaytotal as $pay ){
												?>
												<td><strong><?php echo $pay->FPG_Pay_Method;?></strong></td>
												<?php
											}
									?>
									<td><strong>Total Sales</strong></td>
									<td><strong>Total Forwarded</strong></td>
									</tr>
									<tr>
									<?php 
										foreach($paymentgatewaytotal as $pay ){
												?>
												<td><strong><p class="text-danger">Rs. <?php echo moneyFormatIndia(round($pay->paytotal));?></p></strong></td>
												<?php
											}
									?>
									<td><strong><p class="text-danger">Rs. <?php echo moneyFormatIndia(round($totalamt));?></p></strong></td>
									<td><strong><p class="text-danger">Rs. <?php echo moneyFormatIndia(round($totalforwardamt));?></p></strong></td>
									</tr>
									</table>
									<?php 
									}
									?>
								</div>
							</div>
							<!-- <div class="row"> -->
								<!-- <div class="table-responsive table-bordered"> -->
									<?php if(isset($tbl)){ echo $tbl;}?>
									<!--<table class="table">
									<tr><th>Flowers</th><th>Cakes</th><th>Chocolates</th><th>Fruits</th><th>Mithai</th>
									<th>Stuff Toys</th><th>Dry Fruits</th><th>Delivery Charges</th><th>Total</th></tr>
									<tr>
									
									</tr>
									</table>-->
								<!-- </div> -->
							<!-- </div> -->
							</div>
							</div>
                        </div>
                    </div>
				</div>
				</div>
                    </div>
                </div>

                <!-- End of product layout -->

				

		

<?php include('footer.php');?>

 <script>

 //CI_ROOT = '<?php echo base_url()?>index.php/';

</script>


<?php 

echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/expense',2);

?>
<script>

CI_ROOT = '<?php echo base_url()?>index.php/';
$('#from_date').datepicker({
     dateFormat: "yy-mm-dd"
    });
	//$('#from_date').datepicker('setDate', 'today');
	$('#to_date').datepicker({
	  dateFormat: "yy-mm-dd"
    });
	//$('#to_date').datepicker('setDate', 'today');

</script>
