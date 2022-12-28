<?php include 'header.php'; ?>
<div class="app-content">
  <section class="section">
    <div class="row">
      <div class="col-sm-3 col-md-3 col-xs-2">
        <ol class=" breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_promotion/<?= $no;?>">Manage Promo Code</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Promo Code</li>
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

			 <form action="<?php echo base_url()?>index.php/Promotion/add_promotion_data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal " enctype="multipart/form-data">
								  
					<div class="form-group mb-0 overflow-hidden mt-3">
						<label for="promoname">Promo Code *</label>
						<input type="text" id="promoname" name="promoname"  class="form-control" value="<?php echo  set_value('promoname'); ?>">
					</div>

					<div class="form-group mb-0 overflow-hidden mt-4">
					<label for="promopercentage">Discount(%) *</label>
					<input type="number" id="promopercentage" name="promopercentage" required="required" class="form-control" autocomplete="off" value="<?php echo  set_value('promopercentage'); ?>">
					</div>
					<div class="form-group mb-0 overflow-hidden mt-4">
						<label for="val_from">Validity From * </label>
						<input type="text" id="val_from" name="val_from" class="form-control" value="<?php echo  set_value('val_from'); ?>" readonly/>
					</div>
					
					<div class="form-group mb-0 overflow-hidden mt-4">
						<label for="val_to">Validity To  *</label>
						<input type="text" id="val_to" name="val_to" class="form-control" value="<?php echo  set_value('val_to'); ?>" readonly/>
					</div>

					<div class="form-group mb-0 overflow-hidden mt-4">
						<label style="padding-top:12px;" >Status</label>	
						<label class="custom-switch" style="margin-left: 20px;">
							<input type="checkbox" name="status" id="status" class="custom-switch-input">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>

					<div class="box-footer">	
						<?php if(in_array("Manage Promotions",$pagemodify)){?>
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
echo my_file1('web/custom/promotion',2);
?>
<script>
function IsChkNumc(source) {
    bmobile = $(source).val();
    if (isNaN(bmobile)) {
        bmobile = bmobile.replace(/\D/g, '');
        $(source).val(bmobile);
    }
}

$('#val_from').datepicker({dateFormat: "d-MM-yy DD"});
$('#val_to').datepicker({changeMonth: true, changeYear: true, dateFormat: "d-MM-yy DD", yearRange: "-90:+00" });


</script>
				

 