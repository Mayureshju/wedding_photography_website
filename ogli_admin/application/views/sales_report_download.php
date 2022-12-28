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
									<a href=""><h4 style="font-size: 1.1rem !important;">Report Download</h4></a>
								</div>
								<div class="col-sm-12 col-md-8 col-xs-12">
                  
						                               
								<?=form_open('Salesreport/search_sales_report',['class'=>'form-inline'])?>
                                
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
								<a href="<?php echo base_url();?>Nav/sales_report_download/<?php echo $no;?>" data-toggle="tooltip" title="Reset" class="btn btn-default" data-original-title="Rebuild">
											<i class="fa fa-refresh"></i>
										</a>
								</div>
							</div>

            <!-- End of Container-fluid -->

            <!-- Container-fluid -->

            <!-- <div class="container-fluid"> -->


                

									<div class="row" style="height:250px;">

									<div class="container well download" style="<?php if(isset($from_date) && isset($to_date)){echo "disply:block";}else{ echo "display:none";}?>">
									<div class="row">
									<?php 
										$dateview = isset($selectdate)?$selectdate:'';
										$datefrom = isset($from_date)?$from_date:'';
										$dateto = isset($to_date)?$to_date:'';
										$web = isset($website) && $website != ''?$website:'no';
									?>
										<div class="">
											<h4 style="margin-left:379px;margin-top: 180px;">
											<b><a style="color:blue;padding-left:120px;margin-top:150px;" href="<?php echo base_url();?>Salesreport/sales_report_download/<?php echo base64_encode($dateview);?>/<?php echo base64_encode($datefrom);?>/<?php echo base64_encode($dateto);?>/<?php echo base64_encode($web);?>">Download Report</b></h4></a></div>
									</div>
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
										<?php //echo $this->pagination->create_links();?>
                            </div>-->
							<!-- <br> -->
							
							<!-- <div class="row"> -->
								<!-- <div class="table-responsive table-bordered"> -->
									<?php //if(isset($tbl)){ echo $tbl;}?>
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
