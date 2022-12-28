<?php include 'header.php'; ?>
<div class="app-content">
  <section class="section">
  <div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
      <ol class="breadcrumb">
      <?php $serachurl = isset($searchval) ? $searchval : 'bm8=';?>
              <?php $pageurl = isset($pageval) ? $pageval : '0'; ?>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_quality/<?php echo $no;?>">Manage Quality</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Quality</li>
      </ol>
      </div>
		<div class="col-sm-9 col-md-9 col-xs-4">
			<button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;" onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
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
					// echo "<pre>"; print_r($editfaq); 
						if(isset($editfaq))
						{ 
							foreach($editfaq as $key => $val)
							{
								?>
								<div class="row">
									<div class="col-12">
										<form action="<?php echo base_url()?>index.php/Qualitycheck/edit_qualitycheck_data" method="post" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
											<input type="hidden" name="editid" id="editid" value="<?php echo $val->Mqua_id;?>">
											<!-- <input type="hidden" name="MUM_ID" id="MUM_ID" value="<?php //echo $val->MUM_ID;?>"> -->
											<input type="hidden" name="search" value="<?= $serachurl ?>">
											<input type="hidden" name="page" value="<?= $pageurl ?>">	  
											<div class="row">
												<div class="col-6">
													<!-- <div class="form-group mb-0 overflow-hidden mt-3">
														<label for="Mqua_checkby">Quality Check By</label>    
														<select class="form-control select2" name="Mqua_checkby" id="Mqua_checkby" style="width:100%;">											
															<option value="">Quality Check By</option>                                
															<?php 
																// $getsData = get_list('mov_user_master','MUM_ID,MUM_Full_name',"MUM_status = '1' ORDER BY MUM_Full_name ASC");
																// if(isset($getsData)){
																// 	foreach($getsData as $getsdatavalue)	{ ?>
																		<option value="<?php //echo $getsdatavalue->MUM_ID; ?>" <?php if(!empty($val->Mqua_checkby)){ if($getsdatavalue->MUM_ID == $val->Mqua_checkby) echo 'selected'; }?>><?php echo ucwords($getsdatavalue->MUM_Full_name); ?></option>  
																	<?php //} 
																//} ?>
														</select>                            
													</div> -->
													<?php $userid =  set_value('userid'); ?>
													<div class="form-group mb-0 overflow-hidden mt-3">
														<label for="MUM_ID">Quality Check To</label>    
														<select class="form-control select2" name="MUM_ID" id="MUM_ID" style="width:100%;">											
															<option value="">Select Artist</option>
															<?php  $getscat = get_list('mov_user_master','MUM_ID,MUM_Full_name',"MUM_status='1' and (MUM_User_type = 4) ORDER BY MUM_Full_name ASC");
															if($getscat){ foreach($getscat as $getscatdata)	{								
																?>
															<option value="<?php echo $getscatdata->MUM_ID; ?>" <?php if(!empty($val->MUM_ID)){ if($getscatdata->MUM_ID == $val->MUM_ID) echo 'selected'; }?>><?php echo $getscatdata->MUM_Full_name; ?></option>
															<?php  } } else {?>  
																<option value="<?php echo  set_value('userid'); ?>">No Data</option>  
															<?php }?>  
														</select>                         
													</div>
													<div class="form-group mb-0 overflow-hidden mt-3">
														<label for="MUM_ID">Designation</label>    
														<select class="form-control select2" name="Mqua_designation" id="Mqua_designation" style="width:100%;">											
															<option value="">Designation</option>                                
																<?php  $getscat = get_list('mov_lov','ML_ID,ML_LOV_Value,ML_LOV_Type',"ML_LOV_Status = '1' and ML_LOV_Name like '%designation%' ");
																if($getscat){ foreach($getscat as $getscatdata)	{								
																	?>
																<option value="<?php echo $getscatdata->ML_ID; ?>" <?php if(!empty($getscatdata->ML_ID)){ if($getscatdata->ML_ID == $val->Mqua_designation) echo 'selected'; }?>><?php echo $getscatdata->ML_LOV_Value; ?></option>
																<?php  } } else {?>  
																	<option value="<?php echo set_value('ML_ID'); ?>">No Data</option>  
																<?php }?>
														</select>                            
													</div>
													<div class="form-group mb-0 overflow-hidden mt-3">
														<label for="Mqua_number">Quality Number</label>    
														<input name="Mqua_number" value="<?= $val->Mqua_number; ?>" class="form-control" type="number">                             
													</div>
													<div class="form-group mb-0 overflow-hidden mt-3">
														<label for="ML_ID">Department</label>
														<select class="form-control select2" name="ML_ID" id="ML_ID" style="width:100%;">											
															<option value="">Select Department</option>                                
																<?php  $getscat = get_list('mov_lov','ML_ID,ML_LOV_Value,ML_LOV_Type',"ML_LOV_Status = '1' and ML_LOV_Name like '%Department%' ");
																if($getscat){ foreach($getscat as $getscatdata)	{								
																	?>
																<option value="<?php echo $getscatdata->ML_ID; ?>" <?php if(!empty($val->ML_ID)){ if($getscatdata->ML_ID == $val->ML_ID) echo 'selected'; }?>><?php echo $getscatdata->ML_LOV_Value; ?></option>
																<?php  } } else {?>  
																	<option value="<?php echo set_value('ML_ID'); ?>">No Data</option>  
																<?php }?>
														</select>                             
													</div>
													
													
												</div>

												<div class="col-6">
													<div class="form-group mb-0 overflow-hidden mt-3">
														<label for="Mqua_criteria">Criteria</label>
														<textarea class="form-control" name="Mqua_criteria" id="Mqua_criteria"><?= $val->Mqua_criteria; ?></textarea>
													</div>
													<div class="form-group mb-0 overflow-hidden mt-4">
				                                        <label style="padding-top:12px;" >Status</label>  
				                                       <label class="custom-switch" style="margin-left: 20px;">
															<input type="checkbox" Value="1" name="Mqua_status" id="Mqua_status" class="custom-switch-input" <?php echo ($val->Mqua_status =='1')?'checked':'' ?>>
															<span class="custom-switch-indicator"></span>
														</label>
				                                    </div>
												</div>
											</div>
											<div class="row mt-4">
												<div class="col-md-6 col-sm-6 col-xs-12 text-right mobbtn">
													<button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Submit </button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<?php
								}
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
 Userid = '<?php echo $val->MA_assignto;?>';
</script>
<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/qualitycheck.js?v=191120.0',2);
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

$("#canceldiv").hide();
var prstatus = $(".prstatus").val();
//var prstatus = $("input[name='status']:checked").val();
var prstatus = $("input[name='status']:checked").val();
//alert(prstatus);
if(prstatus == 3){
		$("#canceldiv").show();
}

$('.prstatus').change(function(){
	//var prstatus = $(".prstatus").val();
	var prstatus = $("input[name='status']:checked").val();
	//alert(prstatus);
	if(prstatus == 3){
		$("#canceldiv").show();
	}else{
		$("#canceldiv").hide();	
	}

});

var datestr1 = $('#startdate').val();
	var localTime = new Date();
	$('#startdate').Zebra_DatePicker({
				format: 'Y-m-d H:i',
        current_date: localTime
	  });
	  
	  $('#enddate').Zebra_DatePicker({
				format: 'Y-m-d H:i',
        current_date: localTime
      });

	  $('#restartdate').Zebra_DatePicker({
				format: 'Y-m-d H:i',
        current_date: localTime,
	  });
	  
	  $('#reenddate').Zebra_DatePicker({
				format: 'Y-m-d H:i',
       	 current_date: localTime
	  });
	  $('#followupdate').Zebra_DatePicker({
				format: 'Y-m-d H:i',
				direction: -1,
       	 current_date: localTime
	  });

	//   $('#followupdate').datepicker({
    //     //dateFormat: "yy-mm-dd" ,
        
    //     format:"yyyy-mm-dd",
    //     startDate: new Date(),
    // //     minViewMode:0,
    // //     inline: false,
    //  lang: 'en',
	// // // step: 5,
	// //multidate: 5,
    //  multidate: 1,
    //  assumeNearbyYear: 20,
    //  autoclose: true,
    // todayHighlight:true,
    // // startView: 2,
    //  defaultViewDate: new Date(),
    //    // multidate: 3
	// });

// 	$('#startdate').click(function(){
// 		var userid = $("#userid").val();
// 	$.ajax({
// 		type: "POST",
// 		url: CI_ROOT + 'Appointment/get_userdates',
// 		data: {
// 			userid: userid			
// 		},
// 		success: function(result) {
// 			//alert(result); 
// 			if (result != 'no') {
// 				var data = result.split(',');
// 				var dates=[];
// 				//alert(data);
// 				// $("#tasktype").html('');
// 				// $("#tasktype").html(result);
// 				for(i=0;i<data.length;i++){
					
// 					if(data[i] != '0000-00-00'){
// 					var covdate = convertDate(data[i]);
// 					///alert(covdate)
// 					var date_formate = covdate.replace(/-/g, ' ');
// 					//alert(date_formate)
// 					dates.push(date_formate)
// 					}
// 				}
// 				$("#startdate").Zebra_DatePicker({
// 					direction: true,
// 					disabled_dates: dates
// 				});
// 				$("#enddate").Zebra_DatePicker({
// 					direction: true,
// 					disabled_dates: dates
// 				});
// 				$("#restartdate").Zebra_DatePicker({
// 					direction: true,
// 					disabled_dates: dates
// 				});
// 				$("#reenddate").Zebra_DatePicker({
// 					direction: true,
// 					disabled_dates: dates
// 				});

// 			}
			
// 		}
// 	});
// });


</script>
 