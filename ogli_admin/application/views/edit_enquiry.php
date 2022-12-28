<?php include 'header.php'; ?>
<div class="app-content">
  <section class="section">
  <div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
      <ol class="breadcrumb">
      <?php $serachurl = isset($searchval) ? $searchval : 'bm8=';?>
              <?php $pageurl = isset($pageval) ? $pageval : '0'; ?>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_product/<?= $serachurl ?>/<?= $pageurl ?>">Manage Enquiry</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Enquiry</li>
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

			<?php 
					if(isset($editenquiry))
					{
						
							?>
				<form action="<?php echo base_url()?>Enquiry/edit_enquiry_data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
					<input type="hidden" name="editid" id="editid" value="<?php echo $editenquiry->MEnq_id;?>">
					<input type="hidden" name="search" value="<?= $serachurl ?>">
					<input type="hidden" name="page" value="<?= $pageurl ?>">
									
					<div class="row">  
								
						<div class="col-md-6 col-xs-12 col-sm-12"> 
									
							<div class="form-group mb-0 overflow-hidden mt-3">
								<label for="ncatid"> Company Name :</label>
								<b><?php echo $editenquiry->MEnq_company_name	;?></b>
							</div>	
                               
                                <div class="form-group mb-0 overflow-hidden mt-4">
									<label for="pname">Contact Person :</label>
									<b><?php echo $editenquiry->MEnq_contact_name	;?></b>
                                  </div>
                                  
								<div class="form-group mb-0 overflow-hidden mt-4">
									<label for="admindesc">Enquiry Date :</label>
									<b><?php echo $editenquiry->MEnq_CreatedDate	;?></b>
								</div>
								<div class="form-group mb-0 overflow-hidden mt-4">
									<label for="admindesc">Enquiry Source :</label>
									<b><?php echo $editenquiry->MEnq_enquiry_type	;?></b>
								</div>
                                   
								<div class="form-group mb-0 overflow-hidden mt-4">
									<label for="clientdesc">Phone :</label>
									<b><?php echo $editenquiry->MEnq_phone	;?></b>
								</div>
                                   
									
								<div class="form-group mb-0 overflow-hidden mt-4">
									<label for="tncpolicy">Email :</label>
									<b><?php echo $editenquiry->MEnq_email	;?></b>
								</div>
                                   		
								
                            </div>
						    <div class="col-md-6 col-xs-12 col-sm-12">
								
								<div class="form-group mb-0 overflow-hidden mt-3">
									<label for="costprice">Services / Products :</label>
									<b><?php echo $editenquiry->MEnq_service_product	;?></b>                                  
								</div>
								
								<div class="form-group mb-0 overflow-hidden mt-4">
									<label for="currentprice">Channel :</label>    
									<b><?php echo $editenquiry->MEnq_channel	;?></b>
								</div>
								
								<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;" >Assigned to :</label>	
										<b>
											<?php 
											$MUM_ID = convert_commas_to_value('mov_user_master', 'MUM_Full_name', $editenquiry->MEnq_assigned_to, 'MUM_ID');
											echo $MUM_ID	;?>
										</b>
								   </div>
								
									<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;" >Value :</label>	
										<b><?php echo $editenquiry->MEnq_value	;?></b>
								   </div>
								
									<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;" >Next Follow Up :</label>	
										<b><?php echo $editenquiry->MEnq_follow_up	;?></b>
								   </div>
                                			  
                             </div>
							  
                            </div>
								 
                            <div class="row"> 
							<hr/>
								 <br/>
								 <div class="col-md-4 col-xs-12 col-sm-12"> 
								  <div class="form-group mb-0 overflow-hidden mt-4">
                                    <label>Comments</label>
                                        <textarea name="comments" class="form-control" required="required"></textarea>
                                	</div>
								</div>
								
								 <div class="col-md-4 col-xs-12 col-sm-12"> 
								 <div class="form-group mb-0 overflow-hidden mt-4">
														<label>Next Follow Up</label>
														<div class="input-group date">
															<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
															</div>
															<input type="text" class="form-control pull-left" id="followup" name="followup"  style="background:transparent;"  value="<?php echo  set_value('startdate'); ?>" readonly>
														</div>
													</div>
								</div>
								
								 <div class="col-md-4 col-xs-12 col-sm-12"> 
								  <div class="form-group mb-0 overflow-hidden mt-4">
									<label>Follow Up Mode </label>
									<select class="form-control select2" name="mode" id="mode" style="width:100%;" required="required">											
									<option value="">Select Mode</option>
										<?php
										if($mode){
											foreach($mode as $modedata)	{ ?>											
													<option value="<?php echo $modedata->ML_ID; ?>"><?php echo $modedata->ML_LOV_Value; ?></option> 
											<?php }}?>	
										?>
										</select>
                               		 </div>
								</div>
								
								<div class="col-md-4 col-xs-12 col-sm-12"> 
								  <div class="form-group mb-0 overflow-hidden mt-4">
                                    <label>Reminder</label>
									<select id="followup-reminder_time" class="form-control select2" name="reminder_time" required="required">
<option value="">No reminder</option>
<option value="00.00">On Time</option>
<option value="1440.00">1 day before</option>
<option value="60.00">1 hour before</option>
<option value="30.00">30 mins before</option>
<option value="10.00">10 mins before</option>
</select>
                                	</div>
								</div>
								

								<div class="col-md-4 col-xs-12 col-sm-12"> 
								  <div class="form-group mb-0 overflow-hidden mt-4">
									<label>Assigned to </label>
									<select class="form-control select2" name="assignto" id="assignto" style="width:100%;" required="required">											
									<option value="">Select User</option>
										<?php
										if($user){
											foreach($user as $userdata)	{ ?>											
													<option value="<?php echo $userdata->MUM_ID; ?>"><?php echo $userdata->MUM_Full_name; ?></option> 
											<?php }}?>	
										?>
										</select>
                               		 </div>
								</div>
								
								<div class="col-md-4 col-xs-12 col-sm-12"> 
								  <div class="form-group mb-0 overflow-hidden mt-4">
									<label>Change Enquiry Status </label>
									<select id="followup-enq_status_id" class="form-control select2" name="enquirystatus" required="required">
<option value="">Change Enquiry Status</option>
<option value="0">New</option>
<option value="1">Open</option>
<option value="2">Lost</option>
<option value="43">Own</option>
</select>
                               		 </div>
								</div>

								<div class="col-md-4 col-xs-12 col-sm-12"> 
								  <div class="form-group mb-0 overflow-hidden mt-4">
									<label>Attachment </label>
									<input type="file" id="followup-followupattachment" class="form-control" name="followUpAttachment">
                               		 </div>
								</div>
								
							</div>		
                           
					
					
							<div class="col-md-12 col-xs-12 col-sm-12" > 
								<div class="box-footer">
								<?php if(in_array("Product",$pagemodify)){?>
									<div class="form-group mb-0 overflow-hidden mt-4">
										<div class="col-md-6 col-sm-4 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Submit</button>
										</div>
									</div>
								<?php }?>
								</div>
							</div>	
							<hr/>
							<div class="panel-body folloup_heading followUpComment">

                <div class="col-md-12 followup">

				   <?php
				   foreach($followup as $follow)
				   {
					$MUM_ID = convert_commas_to_value('mov_user_master', 'MUM_Full_name', $follow->MF_assigned_to, 'MUM_ID');
					$Mode = get_row('mov_lov','ML_LOV_Value','ML_ID='.$follow->MF_follow_mode);
				   ?>
                   
                    <div class="follow_text col-md-10">
                      <h5>
						<?php echo $MUM_ID; ?>
						<span style="font-size: 12px; margin-left: 2px;" data-toggle="tooltip" title="" data-original-title="<?php echo date('d-m-Y',strtotime($follow->MF_CreatedDate)); ?>">
						  -   <?php echo date('d-m-Y',strtotime($follow->MF_CreatedDate)); ?>  
						  Followup Mode: <?php echo $Mode->ML_LOV_Value; ?>
						  <?php
if($follow->MF_status==0)
{
						  ?>
						  <a onclick="changestatus('<?php echo $follow->MF_id; ?>','1')"><i class="fa fa-check isCompletedFlag hidden " title="Completed"></i></a>
						  <?php 
}
else
{
?>
<a onclick="changestatus('<?php echo $follow->MF_id; ?>','0')"><i class="fa fa-check isCompletedFlag comletedFlag" title="Completed"></i></a>
<?php
}
?>
						  &nbsp;&nbsp;<i class="fa fa-bell-o reminderText"></i>&nbsp;&nbsp;<?php echo $follow->MF_follow_date; ?>                        </span>
                        
                    
                      </h5>
                      <p>
                        <i class="fa fa-comment userCommentIcon"></i> <?php echo $follow->MF_comment; ?>
					  </p>
					  <?php
					  if($follow->MF_file!='')
					  {
					  ?>
					  <div class="fileContainer">
						  <a href="<?php echo base_url().'uploads/attachment/'.$follow->MF_file; ?>" target="_blank"><?php echo $follow->MF_file; ?></a>
                              <!-- <a data-confirm="Are you sure you to delete?" data-method="post"><i class="fa fa-remove">  </i>
                                </a> -->
							</div>
					  <?php } ?>
					</div>
					<?php
					}
					?>
                </div>
            </div>
															  
								  <div class="ln_solid"></div>
								  

                    </form>
					<?php
								
								}
							?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of product layout -->
				
<script type="text/javascript" src="<?php echo base_url() ; ?>assets/ckeditor/ckeditor.js"></script>		
<?php include('footer.php');?>
<script>
 CI_ROOT = '<?php echo base_url()?>index.php/';
 	
</script>
<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
//echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/product',2);
?>
<script>
$(function () {
			 //$('#followup').dateTimePicker({format: "yyyy-MM-dd"});
		 });
		 var localTime = new Date();
		 $('#followup').Zebra_DatePicker({
				format: 'Y-m-d H:i',
       	 current_date: localTime
	  });	 

 function changestatus(id,status)
{
	$.ajax({
	type : "POST",
	url : CI_ROOT+'Enquiry/changestatus',
	data : {
	id : id,status:status
	},
	success :function(result)
	{
		location.reload();
	}
});
}	
	
</script>
<style>
.Zebra_DatePicker_Icon_Wrapper{width:87% !important}
</style>


 