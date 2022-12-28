<?php include 'header.php'; ?>
<div class="app-content">
  <section class="section">
  <div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
      <ol class="breadcrumb">
      <?php $serachurl = isset($searchval) ? $searchval : 'bm8=';?>
              <?php $pageurl = isset($pageval) ? $pageval : '0'; ?>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_appointment/<?php echo $no;?>">Manage Appointment</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Appointment</li>
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
				//print_r($editsite);
					if(isset($editappointment))
					{ 
						foreach($editappointment as $key => $val)
						{
							?>
				<form action="<?php echo base_url()?>index.php/Appointment/edit_appointment_data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
						<input type="hidden" name="editid" id="editid" value="<?php echo $val->MA_id;?>">
						<!-- <input type="hidden" name="MUM_ID" id="MUM_ID" value="<?php //echo $val->MUM_ID;?>"> -->
						<input type="hidden" name="search" value="<?= $serachurl ?>">
						<input type="hidden" name="page" value="<?= $pageurl ?>">
						<input type="hidden" name="erfile" id="erfile" value="<?php echo $val->MA_sample_attachment ;?>">		  
					 				  
          
            <div class="row mt-3">
											<div class="col-md-6">	

											<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="aptype">Appointment Type *</label>
													<?php $aptype =  set_value('aptype'); ?>
														<select class="form-control select2" name="aptype" id="aptype" style="width:100%;">											
														<option value="">Select Tattoo type</option>
															<?php  $getscat = get_list('mov_lov','ML_ID,ML_LOV_Value,ML_LOV_Type',"ML_LOV_Status = '1' and ML_LOV_Name like '%Appointment Type%' ");
															if($getscat){ foreach($getscat as $getscatdata)	{								
																?>
															<option value="<?php echo $getscatdata->ML_ID; ?>" <?php  if($getscatdata->ML_ID == $val->MA_appt_type) echo 'selected'; ?>><?php echo $getscatdata->ML_LOV_Value; ?></option>
															<?php  } } else {?>  
																<option value="<?php echo  set_value('aptype'); ?>">No Data</option>  
															<?php }?>                                       														
														</select>
												</div>


											<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="orderid">Order *</label>													
													<?php $orderid =  set_value('orderid'); ?>
														<select class="form-control select2" name="orderid" id="orderid" style="width:100%;">											
														<option value="">Select Order</option>
														<?php 				
														$getspack = get_list('mov_order','MOR_id,MOR_number',"MOR_booking_status = '0' ORDER BY MOR_number ASC");
														if($getspack){
														foreach($getspack as $getspackdata)	{	 ?>												
															<option value="<?php echo $getspackdata->MOR_id; ?>" <?php if($val->MOR_id == $getspackdata->MOR_id) echo 'selected';?>><?php echo ucwords($getspackdata->MOR_number); ?></option>
															<?php } } else {?>  
															<option value="<?php echo  set_value('orderid'); ?>">No Data</option>  
														<?php }?>	
														</select>
												</div>

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="clientid">Client *</label>													
														<select class="form-control select2" name="clientid" id="clientid" style="width:100%;">											
														<option value="">Select Client</option>
														<?php 				
														$getspack = get_list('mov_clients','MC_cl_id,MC_cl_name',"MC_cl_status = '1' ORDER BY MC_cl_name ASC");
														if($getspack){
														foreach($getspack as $getspackdata)	{	 ?>												
															<option value="<?php echo $getspackdata->MC_cl_id; ?>" <?php if($val->MC_cl_id == $getspackdata->MC_cl_id) echo 'selected';?>><?php echo ucwords($getspackdata->MC_cl_name); ?></option>
															<?php } } else {?>  
															<option value="<?php echo  set_value('clientid'); ?>">No Data</option>  
														<?php }?>	
														</select>
												</div>

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="aptname">Appointment Name * </label>
													<input id="aptname" name="aptname" class="form-control" type="text" value="<?php echo $val->MA_name; ?>">                             
												</div>

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="tattootype">Tattoo Type *</label>
														<select class="form-control select2" name="tattootype" id="tattootype" style="width:100%;">											
														<option value="">Select Tattoo type</option>
															<?php  $getscat = get_list('mov_lov','ML_ID,ML_LOV_Value,ML_LOV_Type',"ML_LOV_Status = '1' and ML_LOV_Name like '%Tattoo Type%' ");
															if($getscat){ foreach($getscat as $getscatdata)	{								
																?>
															<option value="<?php echo $getscatdata->ML_ID; ?>" <?php  if($val->MA_tattoo_type == $getscatdata->ML_ID) { echo 'selected'; } ?> ><?php echo $getscatdata->ML_LOV_Value; ?></option>
															<?php  } } else {?>  
																<option value="<?php echo  set_value('projtype'); ?>">No Data</option>  
															<?php }?>                                       														
														</select>
												</div>

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="bodypart">Body Part *</label>
														<select class="form-control select2" name="bodypart" id="bodypart" style="width:100%;">											
														<option value="">Select</option>
															<option value="Back" <?php  if($val->MA_body_part == "Back") { echo 'selected'; } ?> >Back</option> 
															<option value="Shoulders" <?php  if($val->MA_body_part == "Shoulders") { echo 'selected'; } ?> >Shoulders</option>   
															<option value="Outer Collarbone" <?php  if($val->MA_body_part == "Outer Collarbone") { echo 'selected'; } ?> >Outer Collarbone</option>   
															<option value="Hand" <?php  if($val->MA_body_part == "Hand") { echo 'selected'; } ?> >Hand</option>   
															<option value="Wrist" <?php  if($val->MA_body_part == "Wrist") { echo 'selected'; } ?> >Wrist</option>                                          														
														</select>
												</div>

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="assid">Assigned to *</label>
													<?php
														$ids =  '';
														if($val->MA_assignto){$ids = explode(',',$val->MA_assignto);}?>
														<?php //echo dropdown_keyval_with_select_multiple2("MUM_ID","MUM_Full_name","MUM_Email",$ids,"mov_user_master","MUM_status='1' and (MUM_User_type = 1 or MUM_User_type = 4) ORDER BY MUM_Full_name ASC","userid");?>
												
														<?php $userid =  set_value('userid'); ?>
														<select class="form-control select2" name="userid" id="userid" style="width:100%;">											
														<option value="">Select</option>
															<?php  $getscat = get_list('mov_user_master','MUM_ID,MUM_Full_name',"MUM_status='1' and (MUM_User_type = 4) ORDER BY MUM_Full_name ASC");
															if($getscat){ foreach($getscat as $getscatdata)	{								
																?>
															<option value="<?php echo $getscatdata->MUM_ID; ?>" <?php  if(in_array($getscatdata->MUM_ID,$ids)) echo 'selected'; ?>><?php echo $getscatdata->MUM_Full_name; ?></option>
															<?php  } } else {?>  
																<option value="<?php echo  set_value('userid'); ?>">No Data</option>  
															<?php }?>                                       														
														</select>
												
													</div>
												
												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="tattoodt">Tattoo Details </label>
														<textarea id="tattoodt" class="form-control inputheight" rows="5" name="tattoodt"><?php echo $val->MA_tattoo_details; ?></textarea>
												</div>

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label>Attachment </label><br>
														<label><input type="file" name="attachfile[]" class="form-control" aria-describedby="fileHelp" onchange="readURLbanr(this);" value="<?php echo set_value('attachfile');?>" accept="image/png, image/jpeg,.pdf,.doc,.docx" multiple/> </label><br/>
														<font color="#0000FF" size="1">[ Maximum Image Size : <?php echo image_size();?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
														<!-- <font color="#0000FF" size="1">[ Maximum File Size :<?php echo file_size();?> MB and Upload Only .pdf / .doc /.docx extension file. ]&nbsp;</font>                                      -->
														<!-- <img id="blahbanr" src="">                    -->

														<?php if($val->MA_sample_attachment !='') { ?> 
                                            <table class="table table-bordered table-hover" id="example1">											
											<tbody>
                                            <tr>
                                         <?php   $attachments = explode(',',$val->MA_sample_attachment);  
                                            $numCols = 2;    
                                            $taskid = $val->MA_id;                               
                                            foreach($attachments as $i => $att){ 
                                                $arrindex = array_search($att,$attachments,true);
                                                if ( $i != 0 && $i++ % $numCols == 0 ){
                                                    echo "\t</tr>\n\t<tr>\n";
                                                }
                                                ?> 
                                                
                                            <?php if(preg_match("/\.(png|jpeg|jpg)$/", $att)) { ?>                                
                                                <td ><img id="blahbanr" src="<?php echo base_url();?>uploads/appointment-data/<?php echo $att;?>" style="width: 50px; height:50px;"></td>
                                                <td>
                                                    <i style="float:right; cursor:pointer;" class="fa fa-times" onclick="removefile(<?php  echo $arrindex.','.$taskid; ?>)"></i>
                                                    <p><?php echo $att;?></p>                                                   
                                                    <a href="<?php echo base_url();?>Task/filedownload/<?php echo $att.'/'.$val->MA_id;?>" target="_blank">Download</a> 
                                                </td>
                                            <?php  }else if(preg_match("/\.(pdf)$/", $att)) { ?>
                                                <td><img id="blahbanr" src="<?php echo base_url();?>uploads/appointment-data/pdf.png" style="width: 50px; height:50px;"></td>
                                                <td>
                                                    <i style="float:right; cursor:pointer;" class="fa fa-times" onclick="removefile(<?php  echo $arrindex.','.$taskid; ?>)"></i>
                                                    <p><?php echo $att;?></p>                                                
                                                    <a href="<?php echo base_url();?>Task/filedownload/<?php echo $att.'/'.$val->MA_id;?>" target="_blank">Download</a> 
                                                </td>
                                            <?php } else if(preg_match("/\.(doc|docx)$/", $att)) { ?>
                                                <td><img id="blahbanr" src="<?php echo base_url();?>uploads/appointment-data/doc.png" style="width: 50px; height:50px;"></td>
                                                <td>
                                                    <i style="float:right; cursor:pointer;" class="fa fa-times" onclick="removefile(<?php  echo$arrindex.','.$taskid; ?>)"></i>
                                                    <p><?php echo $att;?></p>                                                
                                                    <a href="<?php echo base_url();?>Task/filedownload/<?php echo $att.'/'.$val->MA_id;?>" target="_blank">Download</a> 
                                                </td>            
                                            <?php }   else {?>
                                                <img id="blahbanr" src="">
                                        <?php } } ?>
                                        </tr>
                                        </tbody>
											</table>   
                                        <?php     }?> 
									</div>
								</div>


									<div class="col-md-6">
										
										
									

									<div class="form-group mb-0 overflow-hidden mt-3">
										<label for="totalmanhrs">Total Man hours </label>														
										<input type="text" id="totalmanhrs" name="totalmanhrs" class="form-control" value="<?php echo $val->MA_total_man_hour; ?>" />
									</div>

									<div class="form-group mb-0 overflow-hidden mt-3">
												<label>Start Date and Time: *</label>
												<div class="input-group date">
													<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-left" id="startdate" name="startdate"  style="background:transparent;"  value="<?php echo date("d-F-Y l", strtotime($val->MA_start_datetime)); ?>" readonly>
													<!-- <input type="text" id="startdate" name="startdate" class="form-control" value="<?php //echo  set_value('startdate'); ?>" readonly/> -->
												</div>
											</div>

											<div class="form-group mb-0 overflow-hidden mt-3">
												<label>End Date and Time: </label>
												<div class="input-group date">
													<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-left" id="enddate" name="enddate"  style="background:transparent;" value="<?php echo date("d-F-Y l", strtotime($val->MA_end_datetime)); ?>" readonly>
													<!-- <input type="text" id="enddate" name="enddate"  class="form-control" value="<?php //echo  set_value('enddate'); ?>" readonly/> -->
													</div>
											</div>

											<div class="form-group mb-0 overflow-hidden mt-3">
												<label>Followup Date: </label>
												<div class="input-group date">
													<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</div>
													<input type="text" id="followupdate" name="followupdate" class="form-control pull-left" value="<?php echo date("d-F-Y l", strtotime($val->MA_followup_dates)); ?>" readonly/>
												</div>
											</div>

											<div class="form-group mb-0 overflow-hidden mt-4">
											<label for="paymentgateway" >Status</label>
												<label class="radio-inline" style="padding-left:28px;">	                                                               
														<input type="radio" name="status" value="0" class="flat prstatus" <?php if($val->MA_status == '0') echo 'checked'; ?> />  Pending
																						</label>
																						<label class="radio-inline" style="padding-left:10px;">
														<input type="radio" name="status" value="1" class="flat prstatus" <?php if($val->MA_status == '1') echo 'checked'; ?>>  Ongoing
																						</label>
																						<label class="radio-inline" style="padding-left:10px;">
														<input type="radio" name="status" value="2" class="flat prstatus" <?php if($val->MA_status == '2') echo 'checked'; ?>>  Completed
																						</label> 
																						<label class="radio-inline" style="padding-left:10px;">
														<input type="radio" name="status" value="3" class="flat prstatus" <?php if($val->MA_status == '3') echo 'checked'; ?>>  Cancel
																						</label>  
											</div>

											<div class="form-group mb-0 overflow-hidden mt-3" id="canceldiv">
												<label for="cancelreason">Reason of cancelation *</label>
													<textarea id="cancelreason" class="form-control inputheight" rows="5" name="cancelreason"><?php echo $val->MA_cancel_reason; ?></textarea>
											</div>
											<div class="form-group mb-0 overflow-hidden mt-4">
												<label for="paymentgateway" >Reschedule</label>
												<label class="custom-switch" style="margin-left: 20px;">
													<input type="checkbox" name="rechedule" id="rechedule" class="custom-switch-input" <?php if($val->MA_is_reschedule == '1') echo 'checked'; ?>>
													<span class="custom-switch-indicator"></span>
												</label>
											</div>


											<div class="form-group mb-0 overflow-hidden mt-3">
												<label>Reschedule Start Date and Time: *</label>
												<div class="input-group date">
													<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-left" id="restartdate" name="restartdate"  style="background:transparent;"  value="<?php if($val->MA_reschedule_start_datetime != '0000-00-00'){ echo date("d-F-Y l", strtotime($val->MA_reschedule_start_datetime)); } ?>" readonly>
													<!-- <input type="text" id="startdate" name="startdate" class="form-control" value="<?php //echo  set_value('startdate'); ?>" readonly/> -->
												</div>
											</div>

											<div class="form-group mb-0 overflow-hidden mt-3">
												<label>Reschedule End Date and Time: </label>
												<div class="input-group date">
													<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-left" id="reenddate" name="reenddate"  style="background:transparent;" value="<?php if($val->MA_reschedule_end_datetime != '0000-00-00'){ echo date("d-F-Y l", strtotime($val->MA_reschedule_end_datetime)); } ?>" readonly>
													<!-- <input type="text" id="enddate" name="enddate"  class="form-control" value="<?php //echo  set_value('enddate'); ?>" readonly/> -->
													</div>
											</div>

										</div>
										</div>
										<div class="row mt-4">
											<div class="col-md-6 col-sm-6 col-xs-12 text-right mobbtn">
												<button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Submit </button>
											</div>
										</div>
                    </form>
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
echo my_file1('web/custom/appointment.js?v=191120.0',2);
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
 