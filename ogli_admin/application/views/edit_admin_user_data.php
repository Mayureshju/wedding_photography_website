<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
		<div class="row">
			<div class="col-sm-3 col-md-3 col-xs-2">
				<ol class="breadcrumb">
					<?php $no = base64_encode('no'); ?>
					<?php if($this->uri->segment('5') != ''){?>
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_user/<?= $no ?>">Manage User</a></li>
					<li  class="breadcrumb-item"><a href="<?php echo base_url()?>User/edit_user/<?php echo $edit_id;?>">Edit User</a></li>
					<li class="breadcrumb-item active" aria-current="page">Edit Details</li>
					<?php }else{ ?>
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_user/<?= $no ?>">Manage User</a></li>
						<li class="breadcrumb-item active" aria-current="page">Edit Details</li>
					<?php }?>
				
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
					<!-- <li class="<?php //if(isset($isactive) && $isactive == 1){ echo "active";}else{echo "";}?>" ><a data-toggle="tab" href="#userprofile">User Profile</a></li>
					
					<li class="<?php //if(isset($isactive) && $isactive == 2){ echo "active";}else{echo "";}?>"><a data-toggle="tab" href="#logindetails">Login Details</a></li>
					<?php //if($sess_role == '1'){?>		
					<li class="<?php //if(isset($isactive) && $isactive == 3){ echo "active";}else{echo "";}?>"><a data-toggle="tab" href="#permission">Permission</a></li> -->
					<!--<li class="<?php //if(isset($isactive) && $isactive == 4){ echo "active";}else{echo "";}?>"><a data-toggle="tab" href="#subuserpermission">Sub User Access Permission</a></li>-->
					<?php // }  ?>


					<li class="nav-item">
						<a class="nav-link <?php if(isset($isactive) && $isactive == 1){ echo "active";}else{echo "";}?>" id="home-tab3" data-toggle="tab" href="#userprofile" role="tab" aria-controls="home" aria-selected="true">Users	Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if(isset($isactive) && $isactive == 2){ echo "active";}else{echo "";}?>" id="profile-tab3" data-toggle="tab" href="#logindetails" role="tab" aria-controls="profile" aria-selected="false">Login	Detail</a>
					</li>
					<?php if($sess_role == '1'){?>
					<li class="nav-item">
						<a class="nav-link <?php if(isset($isactive) && $isactive == 3){ echo "active";}else{echo "";}?>" id="profile-tab4" data-toggle="tab" href="#permission" role="tab" aria-controls="profile1" aria-selected="false">Permission</a>
					</li>
					<?php }?>
				</ul>
				
				
				<div class="tab-content border-top p-3" id="myTabContent3">	
						<div id="userprofile" class="tab-pane fade show <?php if(isset($isactive) && $isactive == 1){ echo "in active";}else{echo "";}?> p-0" role="tabpanel" aria-labelledby="home-tab3">
							<!-- <div style="height:20px;"></div> -->
							<?php 
								if(isset($userdata)){
									foreach($userdata as $userobj)
									{
							?>		
							<form action="<?php echo base_url()?>index.php/User/update_admin_user_profile/1/<?php echo $usertype;?>" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
							<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id;?>">
							<input type="hidden" name="website" id="website" value="1">
							
						<div class="row">		
						<div class="col-md-6">		
								
							<?php if($sess_role == '1'){?>							
							<div class="form-group mb-2 overflow-hidden mt-4">
							<label for="first-name">Select User Type *
							</label>								
									<select name="usr_type" id="usr_type" required="required" class="form-control select2 w-100">
										<option value=''> Select </option>
										<option value="1" <?php if($userobj->MUM_User_type == 1) { echo 'selected/'; } ?>>Administrator</option>
										<option value="4" <?php if($userobj->MUM_User_type == 4) { echo 'selected/'; } ?>>Artist</option>
									</select>									
							</div>
							<?php }?>
							
									
							<div class="form-group mb-2 overflow-hidden mt-3">
								<label for="comp_name">Company Name </label>
								<div>				
									<label id="comname" class="inputheight" style="font-size: 15px;"><?php echo $userobj->MUM_Comp_Name;?> </label>								
								</div>
							</div>

							<div class="form-group mb-2 overflow-hidden mt-3">
								<label for="full_name">Person Full Name *</label>
								<?php if($sess_role == 1){?>
								  <input type="text" id="full_name" name="full_name"  class="form-control" value="<?php echo $userobj->MUM_Full_name;?>">
								  <?php }else {?>
									
									<label id="fname" class="inputheight" style="font-size: 15px;"><?php echo $userobj->MUM_Full_name;?> </label>
									
									<?php }?>
							</div>
		
							<div class="form-group mb-2 overflow-hidden mt-3">
								<label for="designation">Designation * </label>
								<?php if($sess_role == 1){?>
									<input id="designation" name="designation" class="form-control" type="text" value="<?php echo $userobj->MUM_designation;?>">
									<?php }else {?>
										<label id="desig" class="inputheight" style="font-size: 15px;"><?php echo $userobj->MUM_designation;?> </label>
									<?php }?>
							</div>

							<div class="form-group mb-2 overflow-hidden mt-3">
                                    <label>Role *</label>	
                                        <label class="radio-inline" style="padding-left:28px;">	                                                               
											<input type="radio" name="userrole" value="1" class="flat" <?php if($userobj->MUM_roles == '1') echo 'checked'; ?>/>Administrator
											</label>
											<label class="radio-inline" style="padding-left:10px;">
											<input type="radio" name="userrole" value="2" class="flat" <?php if($userobj->MUM_roles == '2') echo 'checked'; ?> >Artist
											</label>
											<label class="radio-inline"style="padding-left:10px;">
											<input type="radio" name="userrole" value="0" class="flat"  <?php if($userobj->MUM_roles == '0') echo 'checked'; ?>>Both
                                         </label>                                                              
                                </div>




							<div class="form-group mb-2 overflow-hidden mt-3">
								<label for="joiningdate">Joining Date * </label>
								<?php if($sess_role == 1){?>
									<input type="text" id="joiningdate" name="joiningdate" class="form-control" value="<?php if($userobj->MUM_joining_date != NULL ){echo date("d-F-Y l", strtotime($userobj->MUM_joining_date));}?>" readonly />
									<?php }else {?>
									<label id="jdate" class="inputheight" style="font-size: 15px;"><?php if($userobj->MUM_joining_date != NULL ){echo date("d-F-Y l", strtotime($userobj->MUM_joining_date));}?> </label>
								<?php }?>
							</div>

							<div class="form-group mb-2 overflow-hidden mt-3">
								<label for="middle-name">Phone / Mobile *</label>
								<?php if($sess_role == 1){?>
								  <input id="u_phone" name="u_phone" class="form-control" pattern="^\+?\d{1,3}?[-\s\d]{9,13}$" type="text" value="<?php echo $userobj->MUM_Phone;?>">
								  (eg. +020-1234567 or 9859674415 or 020 113 123 1234)
								  <?php }else {?>
									<label id="pno" class="inputheight" style="font-size: 15px;"><?php echo $userobj->MUM_Phone;?> </label>
									<?php }?>
							</div>
							
							<div class="form-group mb-2 overflow-hidden mt-3">
								<label for="logstatus" >Login Status (if it is close user unable to login) </label>
								<!-- <div class="col-md-4 col-sm-4 col-xs-12" >
									<div class="checkbox col-md-4">
										<div class="">
										<?php if($sess_role == 1){?>
											<label>
											<input type="checkbox" name="logstatus" id="logstatus" class="js-switch" <?php if($userobj->MUM_login_status) echo 'checked'; ?>> 
											</label>
											<?php }else {?>
											
											<label id="st" class="inputheight" style="font-size: 15px;"><?php if($userobj->MUM_login_status == 1) { echo 'Active'; }else{ echo 'In-Active';}?> </label>
											<?php }?>
										</div>
									</div>
								</div> -->
								<?php if($sess_role == 1){?>
									<label class="custom-switch" style="margin-left: 20px;">
										<input type="checkbox" name="logstatus" id="logstatus" class="custom-switch-input" <?php if($userobj->MUM_login_status) echo 'checked'; ?>>
										<span class="custom-switch-indicator"></span>
									</label>
								<?php }else {?>											
									<label id="st" class="inputheight" style="font-size: 15px;"><?php if($userobj->MUM_login_status == 1) { echo 'Active'; }else{ echo 'In-Active';}?> </label>
									<?php }?>
							</div>
								
							<div class="form-group mb-2 overflow-hidden mt-3">
								<label for="status" >Status </label>
								<!-- <div class="col-md-4 col-sm-4 col-xs-12" >
									<div class="checkbox col-md-4">
										<div class="">
										<?php if($sess_role == 1){?>
											<label>
											<input type="checkbox" name="status" id="status" class="js-switch" <?php if($userobj->MUM_status) echo 'checked'; ?>> 
											</label>
											<?php }else {?>
											
											<label id="st" class="inputheight" style="font-size: 15px;"><?php if($userobj->MUM_status == 1) { echo 'Active'; }else{ echo 'In-Active';}?> </label>
											<?php }?>
										</div>
									</div>
								</div> -->
								<?php if($sess_role == 1){?>
								<label class="custom-switch" style="margin-left: 20px;">
									<input type="checkbox" name="status" id="status" class="custom-switch-input" <?php if($userobj->MUM_status) echo 'checked'; ?>>
									<span class="custom-switch-indicator"></span>
								</label>
								<?php }else {?>
								
								<label id="st" class="inputheight" style="font-size: 15px;"><?php if($userobj->MUM_status == 1) { echo 'Active'; }else{ echo 'In-Active';}?> </label>
								<?php }?>
							</div>

							


								<div class="form-group mb-2 overflow-hidden mt-3">
									<label>Profile Image </label><br />
										<label>
											<input type="file" class="form-control" name="userprofimg" aria-describedby="fileHelp" onchange="readURLbanr(this);" value="<?php echo set_value('userprofimg');?>" accept="image/png, image/jpeg"/> </label><br/>
										<font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size(); ?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
										<?php if($userobj->MUM_Profilepic !='') {
											$nimg = "";
											$img_folder = 'user-profile-pic/';
											$external_link = IMAGE_PATH . $img_folder . $userobj->MUM_Profilepic;
											if (@getimagesize($external_link)) {
												$get_cat_logo = $userobj->MUM_Profilepic;
											} else {
												$nimg = 'style="color : #666"';
												$get_cat_logo = 'user2-160x160.jpg';
											}
											?><br />
										<img id="blahbanr" src="<?php echo IMAGE_PATH . $img_folder . $get_cat_logo; ?>" style="width: 100px; height: 100px;">
										<?php } else {?>
											<img id="blahbanr" src="">
										<?php } ?>									
								</div>
							
			</div>





			<div class="col-md-6">

				 <?php if($userobj->MUM_User_type == 1 || $userobj->MUM_User_type == 4) { ?>
				<div id="cldiv1">
					<div class="form-group mb-2 overflow-hidden mt-3">
					<label for="bankaccno">Bank Account Details </label>
					</div>
				
					<div class="form-group mb-2 overflow-hidden">
					<label for="bankaccno">Bank Account Number *</label>
						<input type="number" id="bankaccno" name="bankaccno" class="form-control" value="<?php echo $userobj->MUM_bank_accno;?>">
					</div>

					<div class="form-group mb-2 overflow-hidden mt-4">
					<label for="ifsccode">IFSC Code *</label>
						<input type="text" id="ifsccode" name="ifsccode" class="form-control" value="<?php echo $userobj->MUM_ifsc_code;?>">
					</div>

					<div class="form-group mb-2 overflow-hidden mt-4">
					<label for="panno">Pan Card Number *</label>
						<input type="text" id="panno" name="panno" value="<?php echo $userobj->MUM_pancard_number;?>" class="form-control" autocomplete="off">
					</div>
				</div>
				 <hr>
				<?php }?>
								
				<div class="form-group mb-2 overflow-hidden mt-4">
					<label for="u_city">City </label>
						<input id="u_city" name="u_city" class="form-control" type="text" value="<?php echo $userobj->MUM_City;?>">
				</div>

				<div class="form-group mb-2 overflow-hidden mt-4">
					<label for="u_country">Country </label>
						<input id="u_country" name="u_country" class="form-control" type="text" value="<?php echo $userobj->MUM_Country;?>">
				</div>
								
				<div class="form-group mb-2 overflow-hidden mt-4">
					<label for="u_zip">Zipcode </label>
						<input id="u_zip" name="u_zip" class="form-control" type="text" value="<?php echo $userobj->MUM_ZippCode;?>">
				</div>
					
				<div class="form-group mb-2 overflow-hidden mt-4">
					<label for="u_email_alt">Email Alt </label>
					<input id="u_email_alt" name="u_email_alt" class="form-control" type="text" value="<?php echo $userobj->MUM_alt_email;?>">
				</div>
								
				<div class="form-group mb-2 overflow-hidden mt-4">
					<label for="description">Address </label>
					<textarea id="u_address"  class="form-control" name="u_address" > <?php echo $userobj->MUM_Add; ?></textarea>
				</div>
								
							</div>


							</div>
							<div class="row mt-4">
									<div class="col-md-6">
									<button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0" style="float:right;">Update </button>
									</div>
								</div>
							</form>
							<?php
									}
							
								}
								?>
						</div>	
						
						
						
						<div id="logindetails" class="tab-pane fade p-0 <?php if(isset($isactive) && $isactive == 2){ echo "show active";}else{echo "";}?>" role="tabpanel" aria-labelledby="profile-tab3">
							<div style="height:20px;"></div>
							<form action="<?php echo base_url()?>index.php/User/update_admin_login_details/2/<?php echo $usertype;?>" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
								<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id;?>">
								
								<div class="row">
									<div class="col-md-4">
										<div class="form-group mb-0 overflow-hidden">
											<label for="u_name">Username (Email)</label>
											<?php if($sess_role == 1){?>
												<input id="u_name" name="u_name" class="form-control" type="email" value="<?php echo $userobj->MUM_Email;?>" >
											<?php }else {?>
												<label id="uname" class="inputheight" style="font-size: 15px;"><?php echo $userobj->MUM_Email;?> </label>
											<?php }?>
										</div>
									</div>
									<div class="col-md-4">
										<label>Password </label>
										<input type="Password" id="password" name="password" class="form-control " type="text" value="<?php echo base64_decode($userobj->MUM_Passcode);?>" >
									</div>
									<div class="col-md-4 text-center" style="margin-top:35px;">
										<button type="submit" class="btn btn-primary btn-primary-1">Update </button>
									</div>
								</div>
							</form>		
						</div>	

						<?php if($sess_role == '1'){?>		
						<!--permission start-->
							<div id="permission" class="tab-pane fade p-0  <?php if(isset($isactive) && $isactive == 3){ echo "show active";}else{echo "";}?>" role="tabpanel" aria-labelledby="profile-tab4">
								<!-- <div style="height:20px;"></div>
									<div class="row"> -->
									<form method="POST"  action="<?php echo base_url();?>User/addadminaccess/<?php echo $edit_id;?>/3/<?php echo $usertype;?>">
									<div class="col-lg-12">
										<div class="card">
											<div class="card-header">
												<h4>Access	Permission</h4>
											</div>
											<div class="card-body">
												<?php
												
												$useraccess = array();
												if($userobj->MUM_Access_Permission != ''){
													$useraccess = explode(',',$userobj->MUM_Access_Permission);
												}
												$usermodifyaccess = array();
												if($userobj->MUM_Modify_Permission != ''){
													$usermodifyaccess = explode(',',$userobj->MUM_Modify_Permission);
												}
												$userdeleteaccess = array();
												if($userobj->MUM_Delete_Permission != ''){
													$userdeleteaccess = explode(',',$userobj->MUM_Delete_Permission);
												}
												
												?>											
												<div class="table-responsive">
													<table class="table table-bordered mb-0 text-nowrap">
													<tbody><tr class="bg-primary">
														<th>Module</th>
														<th>Access(View)</th>
														<th>Modify(Add/Edit)</th>
														<th>Delete</th>
													</tr>	
														<?php 
														foreach($moduledata as $module){
														
														?>
														<tr>
															
															<?php
															$MMN_Page_Name_adm = $module->MMN_Page_Name;
															if($module->MMN_ID == 1){
															$MMN_Page_Name_adm = 'User Management';
															}
															if($module->MMN_ID == 4){
															$MMN_Page_Name_adm = 'Tattoo Management (Product Management)';
															}
															
															?>
															
															<td align="center"><b><?php echo $MMN_Page_Name_adm;?></b></td>
													
															<!-- <td><?php //echo form_checkbox(['name'=>'useraccess[]'],$module->MMN_ID,in_array($module->MMN_ID, $useraccess)?TRUE:FALSE,['class'=>'permissionch','id'=>str_replace(' ', '-', $module->MMN_Page_Name).'acc']);?></td>
															<td><?php //echo form_checkbox(['name'=>'usermodifyaccess[]'],$module->MMN_ID,in_array($module->MMN_ID, $usermodifyaccess)?TRUE:FALSE,['class'=>str_replace(' ', '-', $module->MMN_Page_Name).'acc permissionch','id'=>str_replace(' ', '-', $module->MMN_Page_Name).'mod','disabled'=>'disabled']);?></td>
															<td><?php //echo form_checkbox(['name'=>'userdeleteaccess[]'],$module->MMN_ID,in_array($module->MMN_ID, $userdeleteaccess)?TRUE:FALSE,['class'=>str_replace(' ', '-', $module->MMN_Page_Name).'mod permissionch','disabled'=>'disabled']);?></td> -->
														
														
															<td>
																<div class="custom-checkbox custom-control">
																	<!-- <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1"> -->
																	<?php echo form_checkbox(['name'=>'useraccess[]'],$module->MMN_ID,in_array($module->MMN_ID, $useraccess)?TRUE:FALSE,['class'=>'custom-control-input permissionch','id'=>str_replace(' ', '-', $module->MMN_Page_Name).'acc','data-checkboxes'=>'mygroup']);?>
																	<label for="<?php echo str_replace(' ', '-', $module->MMN_Page_Name).'acc'; ?>" class="custom-control-label"></label>
																</div>
															</td>
															<td>
																<div class="custom-checkbox custom-control">
																	<!-- <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2"> -->
																	<?php echo form_checkbox(['name'=>'usermodifyaccess[]'],$module->MMN_ID,in_array($module->MMN_ID, $usermodifyaccess)?TRUE:FALSE,['class'=>str_replace(' ', '-', $module->MMN_Page_Name).'acc permissionch custom-control-input','id'=>str_replace(' ', '-', $module->MMN_Page_Name).'mod','disabled'=>'disabled','data-checkboxes'=>'mygroup']);?>
																	<label for="<?php echo str_replace(' ', '-', $module->MMN_Page_Name).'mod'; ?>" class="custom-control-label"></label>
																</div>
															</td>
															<td>
																<div class="custom-checkbox custom-control">
																	<!-- <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-3"> -->
																	<?php echo form_checkbox(['name'=>'userdeleteaccess[]'],$module->MMN_ID,in_array($module->MMN_ID, $userdeleteaccess)?TRUE:FALSE,['class'=>str_replace(' ', '-', $module->MMN_Page_Name).'mod permissionch custom-control-input','id'=>str_replace(' ', '-', $module->MMN_Page_Name).'del','disabled'=>'disabled','data-checkboxes'=>'mygroup']);?>
																	<label for="<?php echo str_replace(' ', '-', $module->MMN_Page_Name).'del'; ?>" class="custom-control-label"></label>
																</div>
															</td>
														
														</tr>						
														<?php 
														}
														
														?>
														
													</tbody>
													</table>
												</div>
												<button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0"> Submit</button>
											</div>
										</div>
									 </div>
									 
									 <!-- <div class="col-md-12">
									 <div class="form-group row" >
													<div class=" col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
													  <button type="submit" class="btn btn-primary">Submit</button>
													</div>
											    </div>
										</div> -->
									</form>	
				                </div>
							<!-- </div> -->
						<!--permission end -->

						
						<?php }?>
						</div>	
						</div>
					

				</div>
		</div>
	</div>
</div>
	<!-- End of product layout -->
				
		
<?php include('footer.php');
	// echo my_file1('web/multiselect/js/select2.full.min',2);
	//  echo my_file1('web/multiselect/css/select2.min',1);
	 echo my_file1('web/custom/user',2);
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
	


$("#users").change(function(){
	if(this.checked){
			 $(".users").prop('checked', true);
		}else{
			 $(".users").prop('checked', false);
		}
});

if ($('.users:checked').length == $('.users').length) {
       $("#users").prop('checked', true);
    }else{
		$("#users").prop('checked', false);
	}
$(".users").change(function(){
    if ($('.users:checked').length == $('.users').length) {
       $("#users").prop('checked', true);
    }else{
		$("#users").prop('checked', false);
	}
});


/*
*
*Code added by Ankita
*
*/
$(".permissionch").each(function() {
	var hid =  $(this).attr('id');
	var hclass =  $(this).attr('class');
	//alert(hid+'-'+hclass);
	if(hid != 'undefined'){
		if($("#"+hid).is(':checked')){
			$("."+hid).prop('disabled', false);
		}
	}

})


$(".permissionch").change(function(){
	var hid =  $(this).attr('id');
	var childclass =  $(this).closest('td').next().find('input').attr('id');
	if(!this.checked){
		if(childclass != undefined){
			$("."+hid).prop('checked', false);
			$("."+hid).prop('disabled', true);
			$("."+childclass).prop('checked', false);
			$("."+childclass).prop('disabled', true);
		}else{
			$("."+hid).prop('checked', false);
			$("."+hid).prop('disabled', true);
		}
		//alert(hid+" not checked."+"classname "+childclass);
	}
	else{
		//alert(hid+" checked.");
		$("."+hid).prop('disabled', false);
	}

});



	

$('#joiningdate').datepicker({changeMonth: true, changeYear: true, dateFormat: "d-MM-yy DD", yearRange: "-90:+00" });
 </script>