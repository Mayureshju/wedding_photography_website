<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
		<div class="row">
			<div class="col-sm-3 col-md-3 col-xs-2">
				<ol class=" breadcrumb">
				<?php $serachurl = isset($searchval) ? $searchval : 'bm8=';?>
              <?php $pageurl = isset($pageval) ? $pageval : '0'; ?>
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_order/<?= $serachurl ?>/<?= $pageurl ?>">Manage Order</a></li>
					<li class="breadcrumb-item active" aria-current="page">Edit Order</li>
				</ol>
			</div>
			<div class="col-sm-9 col-md-9 col-xs-4">
				<button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;"
					onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i>
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
		<div class="row">
			<div class="col-12">
				<div class="card overflow-hidden">
					<div class="card-body">


						<form action="<?php echo base_url()?>Order/editmanualorder" method="post" id="demo-form2"
							data-parsley-validate enctype="multipart/form-data">
							<input type="hidden" name="editid" id="editid" value="<?php echo $editorder->MOR_id ;?>">
					<input type="hidden" name="search" value="<?= $serachurl ?>">
					<input type="hidden" name="page" value="<?= $pageurl ?>">
							<div class="row">

								<div class="col-md-6 col-xs-12 col-sm-12">

									<div class="form-group mb-0 overflow-hidden mt-3">
										<label for="description"> Description *
										</label>
										<textarea id="orderdesc" class="form-control" name="orderdesc"><?php echo $editorder->MOR_Description; ?></textarea>
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="tattoosize">Tattoo Size *</label>
										<input id="tattoosize" name="tattoosize" class="form-control" required="required" type="text" placeholder="eg: 4x4" value="<?php echo $editorder->MOR_Tattoo_size; ?>">
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="bodypart">Body Part </label>
										<select class="form-control select2" name="bodypart" id="bodypart" style="width:100%;">											
														<option value="">Select</option>
															<option value="Back" <?php  if($editorder->MOR_body_part == "Back") { echo 'selected'; } ?> >Back</option> 
															<option value="Shoulders" <?php  if($editorder->MOR_body_part == "Shoulders") { echo 'selected'; } ?> >Shoulders</option>   
															<option value="Outer Collarbone" <?php  if($editorder->MOR_body_part == "Outer Collarbone") { echo 'selected'; } ?> >Outer Collarbone</option>   
															<option value="Hand" <?php  if($editorder->MOR_body_part == "Hand") { echo 'selected'; } ?> >Hand</option>   
															<option value="Wrist" <?php  if($editorder->MOR_body_part == "Wrist") { echo 'selected'; } ?> >Wrist</option>                                          														
														</select>
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="tamount">Total Amount *</label>
										<input id="tamount" name="tamount" class="form-control" required="required" value="<?php echo $editorder->MOR_total_amount; ?>"	type="text" onkeypress="return IsNumeric(event);">
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="paypercentage">Payment Percentage *</label>
										<input id="paypercentage" name="paypercentage" class="form-control" value="<?php echo $editorder->MOR_payment_percent; ?>"	required="required" type="text" onkeypress="return IsNumeric(event);">
									</div>


								</div>
								<div class="col-md-6 col-xs-12 col-sm-12">

									<div class="form-group mb-0 overflow-hidden mt-3">
										<label for="sdescription">Special Description *
										</label>
										<textarea id="sdescription" class="form-control" name="sdescription"><?php echo $editorder->MOR_special_instruction; ?></textarea>
									</div>

									<div class="form-group mb-0 overflow-hidden mt-3">
										<label>Tattoo Image</label>
										<input type="file" class="form-control" name="tattooimg"
											aria-describedby="fileHelp" onchange="readURLbanr1(this);" value=""
											accept="image/png, image/jpeg , image/JPEG, image/PNG" />

									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;">Product (Optional)</label>
										<select class="form-control select2 w-100" name="productid" id="productid"
											style="width:100%;">
											<option value="">Select Product</option>
											<?php 				
						$plist = get_list('mov_products','MP_ProID,MP_Product_Name',"MP_status = '1' ORDER BY MP_Product_Name ASC");
						if($plist){
						foreach($plist as $plistdata)	{	 ?>
											<option value="<?php echo $plistdata->MP_ProID; ?>" <?php if($editorder->MP_ProID==$plistdata->MP_ProID){ ?> selected <?php } ?>>
												<?php echo ucwords($plistdata->MP_Product_Name); ?></option>
											<?php } }?>
										</select>
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;">Payment Type</label><br>
										<label class="radio-inline">
						<input type="radio" name="ptype" value="1" <?php if($editorder->MOR_payment_type==1){ ?> checked <?php } ?>> Full Payment
										</label>
										<label class="radio-inline">
											<input type="radio" name="ptype" value="2" <?php if($editorder->MOR_payment_type==2){ ?> checked <?php } ?>> Part Payment
										</label>
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;">Order Mode</label><br>
										<label class="radio-inline">
											<input type="radio" name="payvia" checked value="1" <?php if($editorder->MOR_type==1){ ?> checked <?php } ?>> Online
										</label>
										<label class="radio-inline">
											<input type="radio" name="payvia" value="2" <?php if($editorder->MOR_type==2){ ?> checked <?php } ?>> Offline
										</label>
									</div>

								</div>

							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group mt-3">
										<label for="cname">Client Name *</label>
										<input type="text" class="form-control inputheight" id="cname" name="cname" value="<?php echo $editorder->MOR_client_name; ?>">
									</div>
									<div class="form-group">
										<label for="cnumber">Client Number *</label>
										<input type="text" id="cnumber" name="cnumber" value="<?php echo $editorder->MOR_client_number; ?>" onkeypress="return IsNumeric(event);" required="required"
											class="form-control inputheight">
									</div>
									<div class="form-group">
										<label for="cemail">Client Email *</label>
										<input type="text" class="form-control inputheight" id="cemail" name="cemail" value="<?php echo $editorder->MOR_client_email; ?>">
									</div>

								</div>
								<div class="col-md-6">
									<div class="form-group mt-3">
										<label for="caddress">Client Address *</label>
										<textarea type="text" class="form-control inputheight" id="caddress"
											name="caddress"><?php echo $editorder->MOR_client_address; ?></textarea>
									</div>
									<div class="form-group">
										<label for="cage">Client Age *</label>
										<input type="text" onkeypress="return IsNumeric(event);" min="1" id="cage"
											name="cage" required="required" class="form-control inputheight"  value="<?php echo $editorder->MOR_client_age; ?>"/>
									</div>
									<div class="form-group">
										<label for="cage">Artist *</label>
										<select class="form-control select2 w-100" name="artistid" id="artistid"
											style="width:100%;">
											<option value="">Select Artist</option>
											<?php 				
						$alist = get_list('mov_user_master','MUM_ID,MUM_Full_name',"MUM_status = '1' and MUM_User_type='4' ORDER BY MUM_Full_name ASC");
						if($alist){
						foreach($alist as $alistdata)	{	 ?>
											<option value="<?php echo $alistdata->MUM_ID; ?>" <?php if($editorder->MUM_ID==$alistdata->MUM_ID){ ?> selected <?php } ?>>
												<?php echo ucwords($alistdata->MUM_Full_name); ?></option>
											<?php } }?>
										</select>
									</div>
								</div>

							</div>
							<div class="col-md-12 col-xs-12 col-sm-12" style="text-align:center;">
								<hr />
								<div class="box-footer">
									<?php if(in_array("Product",$pagemodify)){?>
									<div class="form-group mb-0 overflow-hidden mt-4">
										<div class="col-md-6 col-sm-4 col-xs-12 col-md-offset-3">
											<button type="submit"
												class="btn btn-primary btn-primary-1 mt-3 mb-0">Submit</button>
										</div>
									</div>
									<?php }?>
								</div>
							</div>




						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End of product layout -->
		<?php include('footer.php');?>
		<script> CI_ROOT = '<?php echo base_url()?>'; </script>

		<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
//echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/product',2);
?>