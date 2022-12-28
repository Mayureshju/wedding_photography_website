<?php include 'header.php'; ?>
<div id="content">
<style>
			.pagespace { margin-top:5px; padding-bottom:0px !important;}
			.faicon{font-size:12px;padding-right:5px; !important;}
			.listhead{margin-top:-20px !important;}
			.btnfont{font-size:12px !important;}
			.pullpluse{margin-top:-8px !important;}
			.bdm{padding-left:0px;margin-left: -22px;}
			.refreshbtn{margin-right:-68px;}
			.marginbotom{padding:0px 15px;}
</style><?php $no = base64_encode('no'); ?>
            <div class="page-header pagespace">
                <!-- Container-fluid -->
                <div class="container-fluid">
				<div class="col-md-4 pagespace bdm">
						<ul class="breadcrumb marginbotom">
						<?php if($this->uri->segment('5') != ''){?>
						
					  <?php if($this->uri->segment('5') == '2'){ ?> 
					  <li><a href="<?php echo base_url();?>Nav/customers_master/<?= $no ?>">Manage Customer</a></li> 
						<li><a href="<?php echo base_url()?>User/edit_customers/<?php echo $edit_id;?>">Edit Customer</a></li>
						<li><a href="">Edit Details</a></li>
					  <?php }else if($this->uri->segment('5') == '1'){ ?>
					    <li><a href="<?php echo base_url();?>Nav/vendors_master/<?= $no?>">Manage Vendor</a></li>
						<li><a href="<?php echo base_url()?>User/edit_vendor/<?php echo $edit_id;?>/<?= $no ?>/0">Edit Vendor</a></li>                        
						<li><a href="">Edit Details</a></li>
					  <?php }?>		
						<?php }else{ ?>
						<li><a href="<?php echo base_url();?>Nav/manage_user/<?= $no ?>">Manage User</a></li><li><a href="<?php echo base_url()?>User/edit_user/<?php echo $edit_id;?>">Edit User</a></li>                   
						<li><a href="">Edit Details</a></li>
						<?php }?>
						</ul> 					
				</div>
				
					
                </div>
            </div>
            <!-- End of Container-fluid -->
            <!-- Container-fluid -->
            <div class="container-fluid">
				<div class="row">
					<div class="alert alert-danger alert-dismissible" style="<?php if($this->session->flashdata('userupdateerror')) echo 'display:block'; else echo 'display:none';?>">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<h4><i class="icon fa fa-ban"></i> Error!</h4>
											<?php if($this->session->flashdata('userupdateerror')) echo $this->session->flashdata('userupdateerror');?>
					</div>		
					<div class="alert alert-success alert-dismissible" style="<?php if($this->session->flashdata('userupdatesuccess'))echo 'display:block'; else echo 'display:none';
										 ?>">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h4><i class="icon fa fa-check"></i> Success!</h4>
										<?php if($this->session->flashdata('userupdatesuccess')) echo $this->session->flashdata('userupdatesuccess');?>
					</div>
					<div class="alert alert-danger alert-dismissable" style="<?php if(isset($error)) echo 'display:block'; else echo 'display:none';?>">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Error!</strong> <?php if(isset($error)) echo $error;?>
						</div>
				</div>
		
                <!-- product layout -->
                <div class="row" style="margin-top: -18px;">
                    <div class="panel panel-default">
                        <!--<div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-list"></i>Edit User</h3>
                        </div>-->
                        <div class="panel-body">
								<ul class="nav nav-tabs">
					<li class="<?php if(isset($isactive) && $isactive == 1){ echo "active";}else{echo "";}?>" ><a data-toggle="tab" href="#userprofile">User Profile</a></li>
						  
					<li class="<?php if(isset($isactive) && $isactive == 3){ echo "active";}else{echo "";}?>"><a data-toggle="tab" href="#logindetails">Login Details</a></li>
					
				</ul>
				
				
				<div class="tab-content">	
						<div id="userprofile" class="tab-pane fade <?php if(isset($isactive) && $isactive == 1){ echo "in active";}else{echo "";}?>">
							<div style="height:20px;"></div>
							<?php 
								if(isset($userdata)){
									foreach($userdata as $userobj)
									{
							?>		
							<form action="<?php echo base_url()?>index.php/User/update_user_profile/1/<?php echo $usertype;?>" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
									<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id;?>">
									
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12"  for="comp_name">Company Name </label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										  <input type="text" id="comp_name" name="comp_name"   class="form-control col-md-5 col-xs-8" value="<?php echo $userobj->ZVC_Comp_Name;?>" <?php if($this->uri->segment('5') == '1') echo "readonly";?>>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12"  for="full_name">Person Full Name *</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										  <input type="text" id="full_name" name="full_name"  required="required" class="form-control col-md-5 col-xs-8" value="<?php echo $userobj->ZVC_Full_name;?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Address *</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										<textarea id="address"  class="form-control" name="address"  data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
										data-parsley-validation-threshold="10" value=""><?php echo $userobj->ZVC_Add;?></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">City *</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										  <input id="u_city" name="u_city" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $userobj->ZVC_City;?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">State / Province *</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										  <input id="u_state" name="u_state" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $userobj->ZST_Id;?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="gstin_composition" class="control-label col-md-3 col-sm-3 col-xs-12" >GST Check </label>
											<div class="col-md-4 col-sm-4 col-xs-12" >
												<div class="checkbox col-md-4">
													<div class="">
														<label>
														<input type="checkbox" name="gstin_check" id="gstin_check" class="js-switch" <?php if($userobj->ZVC_GST) echo 'checked'; ?>> 
														</label>
													</div>
												</div>
											</div>
									</div>
									
									<div class="form-group">
										<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">GSTIN</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										  <input id="state_gstin" name="state_gstin" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $userobj->ZVC_GSTIN;?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Zip code *</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										  <input id="u_zip" name="u_zip" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $userobj->ZVC_ZippCode;?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Country  *</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										  <input id="u_country" name="u_country" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $userobj->ZCnt_ID;?>" >
										</div>
									</div>
									
									<div class="form-group">
										<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone*</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										  <input id="u_phone" name="u_phone" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $userobj->ZVC_Phone;?>">
										</div>
										<!--<div class="col-md-5 col-sm-5 col-xs-12">
										  <small class="text-primary">(Sms will be send)</small>
										</div>-->
									</div>
									
									
									
									
									
									<div class="form-group">
										<label for="status" class="control-label col-md-3 col-sm-3 col-xs-12" >Account Status </label>
											<div class="col-md-4 col-sm-4 col-xs-12" >
												<div class="checkbox col-md-4">
													<div class="">
														<label>
														<input type="checkbox" name="status" id="status" class="js-switch" <?php if($userobj->ZVC_status) echo 'checked'; ?>> 
														</label>
													</div>
												</div>
											</div>
									</div>
									
									<div class="box-footer">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">					
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</div>
							</form>
							<?php
									}
							
								}
								?>
						</div>	
						
						
						
						<div id="logindetails" class="tab-pane fade <?php if(isset($isactive) && $isactive == 3){ echo "in active";}else{echo "";}?>">
							<div style="height:20px;"></div>
							<form action="<?php echo base_url()?>index.php/User/update_login_details/3/<?php echo $usertype;?>" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
									<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id;?>">
									<div class="form-group">
										<label for="u_name" class="control-label col-md-3 col-sm-3 col-xs-12">Username (Email)</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										  <input id="u_name" name="u_name" class="form-control col-md-7 col-xs-12" type="email" value="<?php echo $userobj->ZVC_Email;?>" >
										</div>
									</div>
									<div class="form-group">
										<label for="u_name" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
										  <input id="password" name="password" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo base64_decode($userobj->ZVC_Passcode);?>" >
										</div>
									</div>
									<div class="box-footer">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">					
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</div>
							</form>		
						</div>	


						
						</div>	
						</div>
					</div>
				</div>
	<!-- End of product layout -->
				
		
<?php include('footer.php');
	echo my_file1('web/multiselect/js/select2.full.min',2);
 	echo my_file1('web/multiselect/css/select2.min',1);
?>


 <script>
 var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
elems.forEach(function(html) {
	var switchery = new Switchery(html,{size: 'small'});
});
$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
	});

$("#all").change(function(){
		if(this.checked){
		   $('#useraccess option').prop('selected', true);
		}else{
			$('#useraccess option').prop('selected', false);
		}
	});
	
	$("#allmodify").change(function(){
		if(this.checked){
		   $('#usermodify option').prop('selected', true);
		}else{
			$('#usermodify option').prop('selected', false);
		}
	});	
 </script>