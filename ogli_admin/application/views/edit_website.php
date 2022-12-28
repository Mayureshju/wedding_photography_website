<?php include 'header.php'; ?>
<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

<div class="app-content">
<section class="section">
	 <div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
			<ol class="breadcrumb">
				<?php $no = base64_encode('no'); ?>
				<li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_websites">Manage Website</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Website</li>
			</ol>
		</div>
		<div class="col-sm-9 col-md-9 col-xs-4">
			<button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;" onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i>
				</button>
		</div>
	</div> 

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

<div class="section-body">

	<div class="row">
		<div class="col-12">
			<div class="card">
				
				<div class="card-body">
					<ul class="nav nav-pills pb-3" id="myTab3" role="tablist">
						<li class="nav-item">
							<a class="nav-link <?php if(isset($isactive) && $isactive == "basic"){ echo "active";}else{echo "";}?>" id="home-tab3" data-toggle="tab" href="#basicdetails" role="tab" aria-controls="basicdetails" aria-selected="true">Basic Details</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php if(isset($isactive) && $isactive == 2){ echo "active";}else{echo "";} ?>" id="profile-tab4" data-toggle="tab" href="#analitic" role="tab" aria-controls="analitic" aria-selected="false">Google Analitics Code</a>
						</li>					
					</ul>
					<!-- <li class="<?php if(isset($isactive) && $isactive == "basic"){ echo "active";}?>" ><a data-toggle="tab" href="#home">Basic Details</a></li>
						<li><a data-toggle="tab" href="#analitic">Google Analitics Code</a></li> -->

					<div class="tab-content border-top p-3" id="myTabContent3">
						<div class="tab-pane fade show <?php if(isset($isactive) && $isactive == "basic"){ echo "active";}else{echo "";}?> p-0" id="basicdetails" role="tabpanel" aria-labelledby="home-tab3">														
									
							
						
								<?php 
								if(isset($websitedata)){
									foreach($websitedata as $key=>$val)
									{
										$image_path = $val->MWM_Imagepath;
								?>
							<form action="<?php echo base_url()?>index.php/Managewebsite/edit_website_data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
								<input type="hidden" name="editid" value="<?php echo $val->MWM_ID;?>">
											  
								<div class="row">
									<div class="col-md-6 border-right">
										<div class="form-group mb-2 overflow-hidden mt-4">
											<label>Website Name *</label>
											<input type="text" id="webname" name="webname"  required="required" class="form-control" value="<?php echo $val->MWM_Website_Name;?>">		
										</div>

										<div class="form-group mb-2 overflow-hidden mt-3">
											<label>Domain Name * https://	</label>
											<input type="text" id="domainname" name="domainname" required="required" placeholder="" class="form-control " value="<?php echo $val->MWM_Domain_Name;?>">
										</div>
										
										<div class="form-group mb-0 overflow-hidden mt-4">
											<label>Primary Email *</label>
											<input type="email" id="emailsender" name="emailsender" required="required" class="form-control" value="<?php echo  $val->MWM_Mail_SenderID;?>">
										</div>
										<div class="form-group mb-0 overflow-hidden mt-4">
											<label>Secondary Email *</label>
											<input type="email" id="ccemailsender" name="ccemailsender" required="required" class="form-control" value="<?php echo  $val->MWM_CCMAIL_SenderID;?>">
										</div>
										
										<div class="form-group mb-0 overflow-hidden mt-4">
											<label>Google Rating </label>											
											<input type="number" id="googlerating" name="googlerating" min="1"  class="form-control" value="<?php echo  $val->MWM_rating_count;?>">
										</div>
										<div class="form-group mb-2 overflow-hidden mt-4">
											<label>Image Size (in mb)</label>							
											<input type="number" id="imagesize" name="imagesize" placeholder="" min="1"  class="form-control" value="<?php echo  $val->MWM_Imagesize;?>">
										</div>

										<div class="form-group mb-0 overflow-hidden mt-4">
												<label> Logo *</label>
												<!-- <div class="col-md-6 col-sm-6 col-xs-12" > -->
													
														<!-- <label> -->
															<input onchange="readURLbanr1(this);" type="file" name="userfile" value="<?php echo set_value('userfile');?>" accept="image/png, image/jpeg"/> 
														<!-- </label><br/> -->
														<!-- <font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size();?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font> -->
												<!-- </div> -->
											  </div>
											  
											  
											  <div class="form-group mb-0 overflow-hidden mt-4">
												<!-- <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-12" > -->
													 
													<img id="blahbanr1" src="<?php echo $image_path;?>cpanel-logo/header/<?php echo $val->MWM_Logo;?>" style="width: 100px; height: 100px;">	
													
												<!-- </div> -->
												<input type="hidden" name="upload_path" value="<?php echo $val->MWM_Uploadpath;?>">
											  </div>
												
												
											<div class="form-group mb-0 overflow-hidden mt-4">
												<label>Footer Logo *</label>
												<!-- <div class="col-md-6 col-sm-6 col-xs-12" > -->
													
														<!-- <label> -->
															<input onchange="readURLbanr2(this);" type="file" name="userfilefoot" value="<?php echo set_value('userfilefoot');?>" accept="image/png, image/jpeg"/> 
														<!-- </label><br/> -->
														<!-- <font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size();?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font> -->
												<!-- </div> -->
											  </div>
											  
											  
											  <div class="form-group mb-0 overflow-hidden mt-4">
												<!-- <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-12" > -->
													 
													<img id="blahbanr2"  src="<?php echo $image_path;?>cpanel-logo/footer/<?php echo $val->MWM_Logo_footer;?>" style="background: gainsboro; width: 100px; height: 100px;">	
													
												<!-- </div> -->
											  </div>



										
								
										<div class="form-group mb-2 overflow-hidden mt-4">
											<label>Activate/Deactivate</label>		
												<label class="custom-switch" style="margin-left: 20px;">
													<input type="checkbox" name="active" class="custom-switch-input" <?php if($val->MWM_Status == 1) echo 'checked'; ?>>
													<span class="custom-switch-indicator"></span>
												</label>
										</div>
										
									</div>
									
									<div class="col-md-6">
									<div class="card-header">
										<h4>Company Details</h4>
									</div>
									<div class="form-group mb-2 overflow-hidden mt-4">
											<label>Company Name *</label>
											<input type="text" id="compname" name="compname"  required="required" class="form-control" value="<?php echo $val->MWM_Company_Name;?>">
										</div>

										<div class="form-group mb-2 overflow-hidden mt-3">
											<label>GSTIN *</label>
											<input type="text" id="gstin" name="gstin"  required="required" class="form-control" value="<?php echo $val->MWM_GSTIN;?>">
										</div>


										<div class="form-group mb-2 overflow-hidden mt-3">
											<label>Phone *</label>
											<input  id="phno" name="phno"  required="required" class="form-control" pattern="^\+?\d{1,3}?[-\s\d]{9,13}$" type="text" minlength="8" maxlength="15" value="<?php echo $val->MWM_Company_Phone;?>">
											(eg. +020-1234567 or 9859674415 or 020 113 123 1234)		
										</div>

										<div class="form-group mb-2 overflow-hidden mt-3">
											<label>Phone Alt</label>				
											<input  id="phnoalt" name="phnoalt"  class="form-control"  pattern="^\+?\d{1,3}?[-\s\d]{9,13}$" type="text" minlength="8" maxlength="15" value="<?php echo $val->MWM_Company_Phone_alt;?>">
											(eg. +020-1234567 or 9859674415 or 020 113 123 1234)		
										</div>
										<div class="form-group mb-2 overflow-hidden mt-3">
											<label>Phone Whatsapp</label>				
											<input  id="phnowhatsapp" name="phnowhatsapp"  class="form-control"  pattern="^\+?\d{1,3}?[-\s\d]{9,13}$" type="text" minlength="8" maxlength="15" value="<?php echo $val->MWM_Company_Phone_whatsapp;?>">
											(eg. +020-1234567 or 9859674415 or 020 113 123 1234)		
										</div>

										

										<div class="form-group mb-2 overflow-hidden mt-4">
											<label>Address *</label>
											<textarea id="compaddr"  required="required" name="compaddr" class="form-control" rows="3" placeholder=""><?php echo $val->MWM_Company_Address;?></textarea>
										</div>
										
										
										<div class="form-group mb-2 overflow-hidden mt-4">
											<label>Address Alt</label>
											<textarea id="compaddralt"  name="compaddralt" class="form-control" rows="3" placeholder=""><?php echo $val->MWM_Company_Address_alt;?></textarea>
										</div>
										
										<div class="form-group mb-2 overflow-hidden mt-4">
											<label>Contact Person *</label>											
											<input type="text" id="contactperson" name="contactperson"  required="required" class="form-control" value="<?php echo $val->MWM_Contact_Person;?>">
										</div>
										
										<div class="form-group mb-2 overflow-hidden mt-4">
											<label>Location Map *</label>
											<textarea id="locationmap" name="locationmap" class="form-control" rows="3" placeholder=""><?php echo $val->MWM_Company_location_Map;?></textarea>
										</div>
										
										
										
										
										
									</div>
								</div>




								<?php if(in_array("Manage Website",$pagemodify)){?>
									<div class="row mt-4">
										<div class="col-md-6">
										<button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Update Basic Details</button>
										</div>
									</div>
								<?php }?>
								
							</form>
							<?php  }											
								}
								?>
							
						</div>
						<input type="hidden" id="emailwebid" name="emailwebid" value="<?php echo $val->MWM_ID;?>">
						
						<!--permission start-->
						<div class="tab-pane fade p-0 <?php if(isset($isactive) && $isactive == 2){ echo "active show";}else{echo "";}?>" id="analitic" role="tabpanel" aria-labelledby="profile-tab4">
							<form method="" >
							<div class="col-lg-12">
								<!-- <div class="card"> -->
									<!-- <div class="card-header">
										<h4>Access	Permission</h4>
									</div> -->
									<!-- <div class="card-body"> -->
										<div class="form-group mb-2 overflow-hidden mt-4">
											<label>Google Analitics Code *</label>
											
											<?php 
										if(isset($websitedata)){
											foreach($websitedata as $key=>$val)
											{
										?>
											<textarea name="analitics" id="analitics" class="form-control " rows="15"  placeholder="Enter ..."><?php echo $val->MWM_Google_Analytics;?></textarea>
										<?php }
										} ?>	
											
										</div>
                
										<div class="box-footer">
											<?php if(in_array("Manage Website",$pagemodify)){?>
												<!-- <div class="form-group"> -->
																<!-- <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">	 -->
																	<button type="button" onclick="analiticdata();" id="emailsubmit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Update Analitic Details</button>
											<!-- </div> -->
											<!-- </div> -->
											<?php }?>
										</div>
										<!-- <button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0"><?php //if($sess_role == 1 || $sess_role == '2'){ echo 'Save';}else { echo 'Submit'; } ?> </button> -->
									<!-- </div> -->
								<!-- </div> -->
							</div>
							</form>
						</div>
						<!--permission end -->

						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		
<?php include('footer.php');?>
<script>
			// CI_ROOT = '<?php //echo base_url() ?>index.php/';
			// CI_actual_link = '<?php //echo $actual_link; ?>';
		</script>


<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
echo my_file1('web/custom/manageweb',2);
?>
  <style>
  .multiselect-container,dropdown-menu{
	  min-width : 100% !important;
  }
  .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
    color: #fff;
    text-decoration: none;
    background-color: #89AA27;
    outline: 0;
  }
  </style>
 <script>
 CI_ROOT = '<?php echo base_url()?>index.php/';
 var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
elems.forEach(function(html) {
	var switchery = new Switchery(html,{size: 'small'});
});
</script>
<script>

  $(function () {
	//$("#example").DataTable({"order": [[ 0, "desc" ]]});
    $("#example1").DataTable({"order": [[ 0, "desc" ]]});
	$(".dataTables_filter").addClass("pull-right");
	$(".pagination").addClass("pull-right");
	$('#applydt').datepicker({
     dateFormat: "yy-mm-dd"
    });
	$('#applydt1').datepicker({
	  dateFormat: "yy-mm-dd"
    });
	
	
	
  });
  
  function IsChkNumc(source){
bmobile = $(source).val();
if(isNaN(bmobile)){
bmobile = bmobile.replace(/\D/g,'');
$(source).val(bmobile);
}
}  
	
	
function readURLbanr1(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {			
			$('#blahbanr1') .attr('src', e.target.result) .width(100) .height(100);;
		};

		reader.readAsDataURL(input.files[0]);
	}
}	
	
function readURLbanr2(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {			
			$('#blahbanr2') .attr('src', e.target.result) .width(100) .height(100);;
		};

		reader.readAsDataURL(input.files[0]);
	}
}	
	
</script>
				<script>
/* if my var reload isn't set locally.. in the first time it will be true */
if (!localStorage.getItem("reload")) {
/* set reload locally and then reload the page */
localStorage.setItem("reload", "true");
location.reload();
}
/* after reload clear the localStorage */
else {
localStorage.removeItem("reload");
// localStorage.clear(); // an option
}
</script>