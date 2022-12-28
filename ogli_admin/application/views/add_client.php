<?php include 'header.php'; ?>
<div class="app-content">
  <section class="section">
    <div class="row">
      <div class="col-sm-3 col-md-3 col-xs-2">
        <ol class=" breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_clients/<?= $no;?>">Manage Client</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Client</li>
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
    <div class="row">
      <div class="col-12">
        <div class="card overflow-hidden">
          <div class="card-body">
			 	<form action="<?php echo base_url()?>index.php/Client/add_client_data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal " enctype="multipart/form-data">				  
							   <!-- <div class="col-md-12 col-xs-12 col-sm-12">  
                            	<div class="col-md-6 col-xs-12 col-sm-12">   -->							 
					<div class="form-group mb-0 overflow-hidden mt-3">
						<label for="clientname">Client Name *</label>
						<input type="text" id="clientname" name="clientname"  class="form-control" value="<?php echo  set_value('clientname'); ?>">
					</div>

					<div class="form-group mb-0 overflow-hidden mt-4">
						<label for="email">Email *</label>
						<input type="email" id="email" name="email" required="required" class="form-control" autocomplete="off" value="<?php echo  set_value('email'); ?>">
					</div>
					
					<div class="form-group mb-0 overflow-hidden mt-4">
						<label for="category">Phone Number *</label>
						<input type="text" required="required" id="phnumber" name="phnumber" class="form-control" pattern="^\+?\d{1,3}?[-\s\d]{9,13}$" value="<?php echo  set_value('phnumber'); ?>">
						(eg. +020-1234567 or 9859674415 or 020 113 123 1234)
					</div>
							  
					<div class="form-group mb-0 overflow-hidden mt-4">
						<label for="address">Address *</label>
						<textarea id="address" class="form-control" required="required" name="address"><?php echo  set_value('address'); ?></textarea>
					</div>

					<div class="form-group mb-0 overflow-hidden mt-4">
						<label for="cljoindate">Client Join Date * </label>
						<input type="text" id="cljoindate" name="cljoindate" class="form-control" value="<?php echo  set_value('cljoindate'); ?>" readonly/>
					</div>
					
					<div class="form-group mb-0 overflow-hidden mt-4">
						<label for="clbirthdate">Client Date of Birth  <i class="fa fa-birthday-cake" aria-hidden="true"></i>	 *</label>
						<input type="text" id="clbirthdate" name="clbirthdate" class="form-control" value="<?php echo  set_value('clbirthdate'); ?>" readonly/>
					</div>

					<div class="form-group mb-0 overflow-hidden mt-4">
						<label for="clienttype">Client Type *</label>
						<select class="form-control select2" name="clienttype" id="clienttype" style="width:100%;" required>
							<option value="">Select Type</option>	
							<option value="direct">Direct</option>	
							<option value="referred">Referred </option>	
							<option value="googlesearch">Google search </option>	
							<option value="googlead">Google ad</option>	
							<option value="instagram">Instagram</option>	
							<option value="linkedin">linkedin</option>	
							<option value="pinterest">Pinterest</option>	
							<option value="printmedia">Print Media</option>	
						</select>
					</div>

					<div id="referred_id">
						<div class="form-group mb-0 overflow-hidden mt-3">
							<label for="MC_cl_referred_id">Referred Name *</label>
							<select class="form-control select2" name="MC_cl_referred_id" id="MC_cl_referred_id" style="width:100%;">											
							<option value="">Select Client</option>
							<?php 
							$getscat = get_list('mov_clients','MC_cl_id,MC_cl_name',"MC_cl_status = '1' ORDER BY MC_cl_name ASC");
							if(isset($getscat)){
								foreach($getscat as $getscatdata)	{ ?>
									<option value="<?php echo $getscatdata->MC_cl_id; ?>"><?php echo ucwords($getscatdata->MC_cl_name); ?></option>  
								<?php } 
							} ?>
							</select>
						</div>
					</div>

					<div class="form-group mb-0 overflow-hidden mt-4">
						<label style="padding-top:12px;" >Status</label>	
						<label class="custom-switch" style="margin-left: 20px;">
							<input type="checkbox" name="status" id="status" class="custom-switch-input">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

					<div class="box-footer">	
						<?php if(in_array("Clients",$pagemodify)){?>
						<div class="form-group mb-0 overflow-hidden mt-4">
							<div class="col-md-6 col-sm-4 col-xs-12 col-md-offset-3">
							<button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Submit</button>
							</div>
						</div>
						<?php }?>
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
echo my_file1('web/custom/client',2);
?>
<script>
function IsChkNumc(source) {
    bmobile = $(source).val();
    if (isNaN(bmobile)) {
        bmobile = bmobile.replace(/\D/g, '');
        $(source).val(bmobile);
    }
}

$('#cljoindate').datepicker({dateFormat: "d-MM-yy DD"});
$('#clbirthdate').datepicker({changeMonth: true, changeYear: true, dateFormat: "d-MM-yy DD", yearRange: "-90:+00" });

$("#refdiv").hide();

$('#clientsource').change(function(){
	var clientsource = $("#clientsource").val();
	if(clientsource == 2){
		$("#refdiv").show();
	}else{
		$("#refdiv").hide();	
	}

});

$("#referred_id").hide()
$("#clienttype").change(function(){
	var searchfilters = $("#clienttype").val();  

	if(searchfilters == 'referred'){
		$("#referred_id").show()
	}
	else if(searchfilters == 'direct'){
		$("#referred_id").hide()
	}
})
</script>
				

 