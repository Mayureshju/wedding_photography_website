<?php include 'header.php'; ?>
<div class="app-content">
  <section class="section">
    <div class="row">
      <div class="col-sm-3 col-md-3 col-xs-2">
        <ol class=" breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>nav/manage_user/<?= $no ?>">Manage User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
          </ol>
      </div>
      <div class="col-sm-9 col-md-9 col-xs-4">
        <button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;" onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i>
            </button>
      </div> 
    </div>       
    <div class="row">
      <div class="alert alert-danger alert-dismissible" style="<?php if ($this->session->flashdata('usernotadd')) echo 'display:block';
                                                                  else echo 'display:none'; ?>">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          <?php if ($this->session->flashdata('usernotadd')) echo $this->session->flashdata('usernotadd'); ?>
        </div>
      <div class="alert alert-success alert-dismissible" style="<?php if ($this->session->flashdata('useradd')) echo 'display:block';
                                                                  else echo 'display:none';
                                                                  ?>">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Success!</h4>
          <?php if ($this->session->flashdata('useradd')) echo $this->session->flashdata('useradd'); ?>
        </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card overflow-hidden">
          <div class="card-body">
          <form method="post" action="<?php echo base_url(); ?>index.php/User/add_admin_user" name="frm_country" class="form-horizontal form-label-left" enctype="multipart/form-data">

            <div style="height:20px;"></div>

            <div class="row">
              <div class="col-md-6">
              <?php $utype =  set_value('usr_type'); ?>
                <div class="form-group mb-0 overflow-hidden mt-3">
                  <label for="first-name">Select User Type *
                  </label>
                    <select name="usr_type" id="usr_type" required="required" class="form-control select2 w-100" value="<?php echo  set_value('usr_type'); ?>">
                      <option value=''> Select </option>
                      <option value="1" <?php if($utype == '1') echo 'selected';?>>Administrator</option>
                      <option value="4" <?php if($utype == '4') echo 'selected';?>>Artist</option>
                    </select>
                </div>

                <div class="form-group mb-0 overflow-hidden mt-4">
                  <label for="first-name">Email ID (Username) * </label>
                    <input type="email" id="usr_name" name="usr_name" value="<?php echo set_value('usr_name'); ?>" required="required" class="form-control" autocomplete="off">
                    (Email will be sent)
                </div>

                <div class="form-group mb-0 overflow-hidden mt-4">
                  <label for="first-name">Password * </label>
                    <input type="password" id="password" value="<?php echo set_value('password'); ?>" name="password" required="required" class="form-control" autocomplete="off" >
                </div>
				  
			  	 <div class="form-group mb-0 overflow-hidden mt-4">
                  <label for="middle-name">Phone / Mobile * </label>
                    <input id="u_phone" name="u_phone" class="form-control" pattern="^\+?\d{1,3}?[-\s\d]{9,13}$" type="text" value="<?php echo  set_value('u_phone'); ?>">
                    (eg. +020-1234567 or 9859674415 or 020 113 123 1234)
                </div>


                <div class="form-group mb-0 overflow-hidden mt-4" id="compname">
                  <label for="last-name">Company Name * </label>
                    <label id="comname" class="inputheight" style="font-size: 15px;"><?php echo WEBNAME;?> </label>
                </div>

                <div class="form-group mb-0 overflow-hidden mt-4">
                  <label for="middle-name">Full Name * </label>
                    <input id="full_name" name="full_name" class="form-control" type="text" value="<?php echo set_value('full_name'); ?>">
                </div>

                <div class="form-group mb-0 overflow-hidden mt-4">
                  <label for="designation" >Designation * </label>
                    <input id="designation" name="designation" class="form-control" type="text" value="<?php echo set_value('designation'); ?>">
                </div>

                <div class="form-group mb-0 overflow-hidden mt-4">
                    <label>Role *</label>	
                        <label class="radio-inline" style="padding-left:28px;">	
                                                
                            <input type="radio" name="userrole" value="1" class="flat" checked/>Administrator
                                                            </label>
                                                            <label class="radio-inline" style="padding-left:10px;">
                            <input type="radio" name="userrole" value="2" class="flat"  >Artist
                                                            </label>
                                                            <label class="radio-inline" style="padding-left:10px;">
                            <input type="radio" name="userrole" value="0" class="flat"  >Both
                                                            </label>                                                              
                </div>

                  <div id="cldiv1">
                        <hr>
                        <div class="form-group mb-0 overflow-hidden mt-4">
                          <label  for="bankaccno">Bank Account Details </label>
                        </div>

                        <div class="form-group mb-0 overflow-hidden mt-4">
                          <label for="bankaccno">Bank Account Number *</label>
                            <input type="number" id="bankaccno" name="bankaccno" class="form-control" value="<?php echo  set_value('bankaccno'); ?>">
                        </div>

                        <div class="form-group mb-0 overflow-hidden mt-4">
                          <label for="ifsccode">IFSC Code * </label>
                            <input type="text" id="ifsccode" name="ifsccode" class="form-control" value="<?php echo  set_value('ifsccode'); ?>">
                        </div>

                        <div class="form-group mb-0 overflow-hidden mt-4">
                          <label for="panno">Pan Card Number *</label>
                            <input type="text" id="panno" name="panno" value="<?php echo  set_value('panno'); ?>" class="form-control" autocomplete="off">
                        </div>
                        <hr>
                </div>

                <div class="form-group mb-0 overflow-hidden mt-4">
                  <label>Profile Image </label><br />
                    <label>
                      <input type="file" class="form-control" name="userprofimg" aria-describedby="fileHelp" onchange="readURLbanr(this);" value="<?php echo set_value('userprofimg'); ?>" accept="image/png, image/jpeg" /> 
                    </label><br />
                    <font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size(); ?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>

                    <img id="blahbanr" src="">
                </div>



              </div>

              <div class="col-md-6">
			  
                <div id="cldiv2">
                      <div class="form-group mb-0 overflow-hidden mt-3">
                        <label for="joiningdate">Joining Date * </label>
                          <input type="text" id="joiningdate" name="joiningdate" class="form-control" value="<?php echo  set_value('joiningdate'); ?>" readonly />
                      </div>

                      <div class="form-group mb-0 overflow-hidden mt-4">
                        <label for="middle-name">City </label>
                          <input id="u_city" name="u_city" class="form-control" type="text" value="<?php echo  set_value('u_city'); ?>">
                      </div>

                      <div class="form-group mb-0 overflow-hidden mt-4">
                        <label for="middle-name">Country </label>
                          <input id="u_country" name="u_country" class="form-control" type="text" value="<?php echo  set_value('u_country'); ?>">
                      </div>

                      <div class="form-group mb-0 overflow-hidden mt-4">
                        <label for="middle-name">Zipcode </label>
                          <input id="u_zip" name="u_zip" class="form-control" type="text" value="<?php echo  set_value('u_zip'); ?>">
                      </div>

                      <div class="form-group mb-0 overflow-hidden mt-4">
                        <label for="middle-name">Email Alt </label>
                          <input id="u_email_alt" name="u_email_alt" class="form-control" type="email" value="<?php echo  set_value('u_email_alt'); ?>">
                      </div>

                      <div class="form-group mb-0 overflow-hidden mt-4">
                        <label for="middle-name">Current Address </label>
                          <textarea id="u_address" class="form-control" name="u_address" value="<?php echo  set_value('u_address'); ?>"></textarea>
                      </div>

                      <div class="form-group mb-0 overflow-hidden mt-4">
                        <label for="p_address">Permanent Address </label>
                          <textarea id="p_address" class="form-control" name="p_address" value="<?php echo  set_value('p_address'); ?>"></textarea>
                      </div>
              </div>
              
				       <div class="form-group mb-0 overflow-hidden mt-4">
                  <label for="paymentgateway">Login Status (if it is close user unable to login)</label>
                  <label class="custom-switch" style="margin-left: 20px;">
                      <input type="checkbox" name="logstatus" id="logstatus" class="custom-switch-input">
                      <span class="custom-switch-indicator"></span>
                    </label>
                </div>  

                <div class="form-group mb-0 overflow-hidden mt-4">
                  <label for="paymentgateway" >Active</label>
                  <label class="custom-switch" style="margin-left: 20px;">
                      <input type="checkbox" name="status" id="status" class="custom-switch-input">
                      <span class="custom-switch-indicator"></span>
                    </label>
                </div>
             
				  <div class="ln_solid"></div>
                <div class="box-footer">
                  <div class="form-group mb-0 overflow-hidden mt-4">
                    <div class="col-md-6 col-sm-4 col-xs-12 col-md-offset-3">
                      <button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Add User</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End of product layout -->


  <?php include('footer.php');
  // echo my_file1('web/multiselect/js/select2.full.min', 2);
  // echo my_file1('web/multiselect/css/select2.min', 1);
  echo my_file1('web/custom/user', 2);
  ?>
  <script>
    $(".select2").select2();
    $('#joiningdate').datepicker({changeMonth: true, changeYear: true, dateFormat: "d-MM-yy DD", yearRange: "-90:+00" });
  </script>
	
	
	
	