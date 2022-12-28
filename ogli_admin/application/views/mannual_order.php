<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
		<div class="row">
			<div class="col-sm-3 col-md-3 col-xs-2">
				<ol class=" breadcrumb">
					<li class="breadcrumb-item"><a href="#">Manage Order</a></li>
					<li class="breadcrumb-item active" aria-current="page">Manual Order</li>
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


						<form action="<?php echo base_url()?>Order/addmanualorder" method="post" id="demo-form2"
							data-parsley-validate enctype="multipart/form-data">
							
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="cemail">Client Email *</label>
										<input type="email" class="form-control inputheight" id="cemail" list="emaillist" name="cemail" autocomplete="nope" value="">
											
										<datalist id="emaillist">
										<?php 				
										$getncat = get_list('mov_clients','MC_cl_email',"");
										if($getncat){
										foreach($getncat as $getncatdata)	{	 ?>	
										  <option value="<?php echo ($getncatdata->MC_cl_email); ?>"><?php echo ($getncatdata->MC_cl_email); ?></option>
										<?php } }?>
										</datalist>
									</div>
									<div class="form-group mt-3">
										<label for="cname">Client Name *</label>
										<input type="text" class="form-control inputheight" id="cname" name="cname">
									</div>
									<div class="form-group">
										<label for="cnumber">Client Number *</label>
										<input type="text" id="cnumber" name="cnumber" onkeypress="return IsNumeric(event);" required="required" class="form-control inputheight">
									</div>
									

								</div>
								<div class="col-md-6">
									<div class="form-group mt-3">
										<label for="caddress">Client Address *</label>
										<textarea type="text" class="form-control inputheight" id="caddress" name="caddress"></textarea>
									</div>
									<div class="form-group">
										<label for="cage">Client Age *</label>
										<input type="text" onkeypress="return IsNumeric(event);" min="1" id="cage"
											name="cage" required="required" class="form-control inputheight" />
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
											<option value="<?php echo $alistdata->MUM_ID; ?>">
												<?php echo ucwords($alistdata->MUM_Full_name); ?></option>
											<?php } }?>
										</select>
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-md-6 col-xs-12 col-sm-12">

									<div class="form-group mb-0 overflow-hidden mt-3">
										<label for="description"> Description *
										</label>
										<textarea id="orderdesc" class="form-control" name="orderdesc"></textarea>
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="tattoosize">Tattoo Size *</label>
										<input id="tattoosize" name="tattoosize" class="form-control"
											required="required" type="text" placeholder="eg: 4x4">
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="bodypart">Body Part </label>
										
											<select class="form-control select2" name="bodypart" id="bodypart" style="width:100%;">											
														<option value="">Select</option>
															<option value="Back">Back</option> 
															<option value="Shoulders">Shoulders</option>   
															<option value="Outer Collarbone">Outer Collarbone</option>   
															<option value="Hand">Hand</option>   
															<option value="Wrist">Wrist</option>                                          														
														</select>
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="tamount">Total Amount *</label>
										<input id="tamount" name="tamount" class="form-control" required="required"
											type="text" onkeypress="return IsNumeric(event);">
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="paypercentage">Paid Amount *</label>
										<input id="paypercentage" name="paypercentage" class="form-control"
											required="required" type="text" onkeypress="return IsNumeric(event);">
									</div>


								</div>
								<div class="col-md-6 col-xs-12 col-sm-12">

									<div class="form-group mb-0 overflow-hidden mt-3">
										<label for="sdescription">Special Description *
										</label>
										<textarea id="sdescription" class="form-control" name="sdescription"></textarea>
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
											<option value="<?php echo $plistdata->MP_ProID; ?>">
												<?php echo ucwords($plistdata->MP_Product_Name); ?></option>
											<?php } }?>
										</select>
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;">Payment Type</label><br>
										<label class="radio-inline">
											<input type="radio" name="ptype" value="1" checked> Full Payment
										</label>
										<label class="radio-inline">
											<input type="radio" name="ptype" value="2"> Part Payment
										</label>
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;">Payment Mode</label><br>
										<label class="radio-inline">
											<input type="radio" name="payvia" checked value="1"> Online
										</label>
										<label class="radio-inline">
											<input type="radio" name="payvia" value="2"> Offline
										</label>
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
echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/jquery-ui-1.12.1.custom/jquery-ui.min',2);
echo my_file1('web/custom/jquery-ui-1.12.1.custom/jquery-ui.min',1); 
			
echo my_file1('web/custom/product',2);
?>
		
<!--<script>
$(function () {
$("#cemail").autocomplete({
source: CI_ROOT = '<?php echo base_url();?>Order/get_client_email', // path to the get_birds method
focus: function (event, ui) {
$("#cemail").val(ui.item.label);
return false;
}
, select: function (event, ui) {
$("#cemail").val(ui.item.value);
return false; 
}
});
});
	
	

</script>-->
<script>
//cname cnumber caddress	
$( "#cemail" ).change(function() {
var cemail = document.getElementById("cemail").value;
$.ajax({
type : "POST",
url : CI_ROOT+'Order/get_client_data',
data : {
cemail : cemail
},
success :function(result)
{
if(result != 'no')
{
var data = result.split('#');
$("#cname").val(data[0]);					
$("#cnumber").val(data[1]);					
$("#caddress").val(data[2]);					
}
}
});
});
</script>