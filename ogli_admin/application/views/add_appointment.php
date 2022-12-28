<?php include 'header.php'; ?>
<!-- <style>
.tooltip {
  position: relative !important;
  display: inline-block !important;
  border-bottom: 1px dotted black !important;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px !important;
  background-color: black !important;
  color: #fff !important;
  text-align: center !important;
  border-radius: 6px !important;
  padding: 5px 0 !important;

  /* Position the tooltip */
  position: absolute !important;
  z-index: 1 !important;
}

.tooltip:hover .tooltiptext {
  visibility: visible !important;
}
</style> -->
<div class="app-content">
					<section class="section">
					<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
            <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_appointment/<?php echo $no;?>">Manage Appointment</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Add Appointment</li>
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
                  						<form action="<?php echo base_url() ?>/Appointment/add_appointment_data" method="post" id="demo-form3" data-parsley-validate class="form-horizontal " enctype="multipart/form-data">  
                 						 <div class="row">
											<div class="col-sm-12 col-md-4 mb-3">
												<a href=""><h4> Add Appointment</h4></a>
											</div>                    
										</div>
										<div class="row">
											<div class="col-md-6">
											
											<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="aptype">Appointment Type *</label>
													<?php $aptype =  set_value('aptype'); ?>
														<select class="form-control select2" name="aptype" id="aptype" style="width:100%;">											
														<option value="">Select Tattoo type</option>
															<?php  $getscat = get_list('mov_lov','ML_ID,ML_LOV_Value,ML_LOV_Type',"ML_LOV_Status = '1' and ML_LOV_Name like '%Appointment Type%' ");
															if($getscat){ foreach($getscat as $getscatdata)	{								
																?>
															<option value="<?php echo $getscatdata->ML_ID; ?>" <?php if(!empty($aptype)){ if($getscatdata->ML_ID == $aptype) echo 'selected'; }?>><?php echo $getscatdata->ML_LOV_Value; ?></option>
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
															<option value="<?php echo $getspackdata->MOR_id; ?>" <?php if($orderid == $getspackdata->MOR_id) echo 'selected';?>><?php echo ucwords($getspackdata->MOR_number); ?></option>
															<?php } } else {?>  
															<option value="<?php echo  set_value('orderid'); ?>">No Data</option>  
														<?php }?>	
														</select>
												</div>										
												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="clientid">Client *</label>													
													<?php $clientid =  set_value('clientid'); ?>
														<select class="form-control select2" name="clientid" id="clientid" style="width:100%;">											
														<option value="">Select Client</option>
														<?php 				
														$getspack = get_list('mov_clients','MC_cl_id,MC_cl_name',"MC_cl_status = '1' ORDER BY MC_cl_name ASC");
														if($getspack){
														foreach($getspack as $getspackdata)	{	 ?>												
															<option value="<?php echo $getspackdata->MC_cl_id; ?>" <?php if($clientid == $getspackdata->MC_cl_id) echo 'selected';?>><?php echo ucwords($getspackdata->MC_cl_name); ?></option>
															<?php } } else {?>  
															<option value="<?php echo  set_value('clientid'); ?>">No Data</option>  
														<?php }?>	
														</select>
												</div>

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="aptname">Appointment Name * </label>
													<input id="aptname" name="aptname" class="form-control" type="text" value="<?php echo set_value('aptname'); ?>">                             
												</div>

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="tattootype">Tattoo Type *</label>
													<?php $tattootype =  set_value('tattootype'); ?>
														<select class="form-control select2" name="tattootype" id="tattootype" style="width:100%;">											
														<option value="">Select Tattoo type</option>
															<?php  $getscat = get_list('mov_lov','ML_ID,ML_LOV_Value,ML_LOV_Type',"ML_LOV_Status = '1' and ML_LOV_Name like '%Tattoo Type%' ");
															if($getscat){ foreach($getscat as $getscatdata)	{								
																?>
															<option value="<?php echo $getscatdata->ML_ID; ?>" <?php if(!empty($tattootype)){ if($getscatdata->ML_ID == $tattootype) echo 'selected'; }?>><?php echo $getscatdata->ML_LOV_Value; ?></option>
															<?php  } } else {?>  
																<option value="<?php echo  set_value('tattootype'); ?>">No Data</option>  
															<?php }?>                                       														
														</select>
												</div>

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="bodypart">Body Part *</label>
														<select class="form-control select2" name="bodypart" id="bodypart" style="width:100%;">											
														<option value="">Select</option>
															<option value="Back">Back</option> 
															<option value="Shoulders">Shoulders</option>   
															<option value="Outer Collarbone">Outer Collarbone</option>   
															<option value="Hand">Hand</option>   
															<option value="Wrist">Wrist</option>                                          														
														</select>
												</div>

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="assid">Assigned to *</label>
														<?php //echo dropdown_keyval_with_select_multiple2("MUM_ID","MUM_Full_name","MUM_Email",set_value('userid'),"mov_user_master","MUM_status='1' and (MUM_User_type = 4) ORDER BY MUM_Full_name ASC","userid");?>
												
													<?php $userid =  set_value('userid'); ?>
													<select class="form-control select2" name="userid" id="userid" style="width:100%;">											
													<option value="">Select</option>
														<?php  $getscat = get_list('mov_user_master','MUM_ID,MUM_Full_name',"MUM_status='1' and (MUM_User_type = 4) ORDER BY MUM_Full_name ASC");
														if($getscat){ foreach($getscat as $getscatdata)	{								
															?>
														<option value="<?php echo $getscatdata->MUM_ID; ?>" <?php if(!empty($userid)){ if($getscatdata->MUM_ID == $userid) echo 'selected'; }?>><?php echo $getscatdata->MUM_Full_name; ?></option>
														<?php  } } else {?>  
															<option value="<?php echo  set_value('userid'); ?>">No Data</option>  
														<?php }?>                                       														
													</select>
												</div>

												

												<div class="form-group mb-0 overflow-hidden mt-3">
													<label>Attachment </label><br>
														<label><input type="file" name="attachfile[]" class="form-control" aria-describedby="fileHelp" onchange="readURLbanr(this);" value="<?php echo set_value('attachfile');?>" accept="image/png, image/jpeg,.pdf,.doc,.docx" multiple/> </label><br/>
														<font color="#0000FF" size="1">[ Maximum Image Size : <?php echo image_size();?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
														<!-- <font color="#0000FF" size="1">[ Maximum File Size :<?php echo file_size();?> MB and Upload Only .pdf / .doc /.docx extension file. ]&nbsp;</font>                                      -->
														<img id="blahbanr" src="">                   
												</div>

											</div>


											<div class="col-md-6">
											<div class="form-group mb-0 overflow-hidden mt-3">
													<label for="tattoodt">Tattoo Details </label>
														<textarea id="tattoodt" class="form-control inputheight" rows="5" name="tattoodt"><?php echo  set_value('tattoodt'); ?></textarea>
												</div>
											

											<div class="form-group mb-0 overflow-hidden mt-3">
												<label for="totalmanhrs">Total Man hours </label>														
												<input type="text" id="totalmanhrs" name="totalmanhrs" class="form-control" value="<?php echo  set_value('totalmanhrs'); ?>" />
											</div>

											<div class="form-group mb-0 overflow-hidden mt-3">
														<label>Start Date and Time: *</label>
														<div class="input-group date">
															<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
															</div>
															<input type="text" class="form-control pull-left" id="startdate" name="startdate"  style="background:transparent;"  value="<?php echo  set_value('startdate'); ?>" readonly>
															<!-- <input type="text" id="startdate" name="startdate" class="form-control" value="<?php //echo  set_value('startdate'); ?>" readonly/> -->
														</div>
													</div>

													<div class="form-group mb-0 overflow-hidden mt-3">
														<label>End Date and Time: *</label>
														<div class="input-group date">
															<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
															</div>
															<input type="text" class="form-control pull-left" id="enddate" name="enddate"  style="background:transparent;" value="<?php echo  set_value('enddate'); ?>" readonly>
															<!-- <input type="text" id="enddate" name="enddate"  class="form-control" value="<?php //echo  set_value('enddate'); ?>" readonly/> -->
															</div>
													</div>

													<div class="form-group mb-0 overflow-hidden mt-3">
														<label>Followup Date: </label>
														<div class="input-group date">
															<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
															</div>
															<input type="text" id="followupdate" name="followupdate" class="form-control pull-left" value="<?php echo  set_value('followupdate'); ?>" readonly/>
														</div>
													</div>

													<div class="form-group mb-0 overflow-hidden mt-4">
													<label for="paymentgateway" >Status</label>
													<!-- <label class="custom-switch" style="margin-left: 20px;">
														<input type="checkbox" name="status" id="status" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
														</label> -->
														<label class="radio-inline" style="padding-left:28px;">	                                                               
														<input type="radio" name="status" value="0" class="flat prstatus" checked />  Pending
																						</label>
																						<label class="radio-inline" style="padding-left:10px;">
														<input type="radio" name="status" value="1" class="flat prstatus">  Ongoing
																						</label>
																						<label class="radio-inline" style="padding-left:10px;">
														<input type="radio" name="status" value="2" class="flat prstatus">  Completed
																						</label>   
													</div>

										</div>
										</div>
										

								

							<!-- </div>
						</div>
					</div> -->

					<div class="row artistheading" id="artistnameschedule"></div>

						<div class="row cal" id="schedulecalender">
										<?php
														// if (isset($viewsitepolicy)) {
														// 	foreach ($viewsitepolicy as $key => $pval) {
														?>
											<!-- <div class="col-md-4" style="padding-top:10px;">
												<a href="<?php //echo base_url(); ?>uploads/document/<?php //echo $pval->BSP_Document; ?>" class="pdf" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?php //echo $pval->BSP_Title; ?></a>
											</div> -->
											
											<!-- <div class="col-md-4">
												<a href="assets/img/pdf/pdf1.pdf" class="pdf" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Information</a>
											</div>
											
											<div class="col-md-4">
												<a href="assets/img/pdf/pdf1.pdf" class="pdf" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> New</a>
											</div> -->
										<!-- <form action="" method="POST" id="frm_mgtdate">	 -->
										<!-- <label class="control-label col-md-12 col-sm-12 col-xs-12" for="chkdate">Select Date </label> -->
										<div >
											<?php echo $calendar;?>
										
										
											<div class="box-footer">

												<div class="foot">
												<div class="date-book">
												<span class="past1"></span> Dates in the past		
												</div>
												<div class="date-book">
												<span class="today1"></span> Today		
												</div>
												<div class="date-book">
												<span class="avail1"></span> Available	
												</div>
												<div class="date-book">
												<span class="book1"></span> Fully Booked or Day Off
												</div>

												<!-- <a href="#" data-toggle="tooltip" id="something" title=""  class="a1"
data-original-title="<h1><b>Another</b> <em>one</em> here too</h1>" >whatever you want</a> -->

<!-- <div class="tooltip a1">Hover over me
  <span class="tooltiptext">Tooltip text</span>
</div> -->
												</div>


												<!-- <div class="form-group mb-0 overflow-hidden mt-4"> -->
													<!-- <div class="col-md-6 col-sm-4 col-xs-12 col-md-offset-3"> -->
													<!-- <button type="button" id="applyleavebtn" class="btn btn-primary btn-primary-1 btnfont">Submit</button> -->
													<!-- </div> -->
													<?php 
													
													// $start = $month = strtotime('2021-01-01');
													// $end = strtotime('2021-01-31');
													// $today = strtotime(date("Y-m-d"));
													// //echo $month.'-'.$today;
													// while($month < $today)
													// {
													// 	echo date('d-m-Y', $month), PHP_EOL;
													// 	$month = strtotime("+1 day", $month);
													// }
													?>
												</div>
												<input type="hidden" name="info-boxtext" id="info-boxtext" value="">
												<div class="info-box" id="info-box">
																												
												</div>											
											</div>
											<!-- </form> -->														
										</div>







										<div class="row mt-4">
											<!-- <div class="col-md-6 col-sm-6 col-xs-12 mobbtn">
												<button type="button" class="btn btn-primary btn-primary-1 mt-3 mb-0" onClick="add_more_policy()">Additional Information<i class="fa fa-plus" aria-hidden="true"></i></button>
											</div>
											 -->
											<div class="col-md-6 col-sm-6 col-xs-12 text-right mobbtn">
												<button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Submit </button>
											</div>
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>



	  <!-- End of product layout -->
	  <style>
		  .calendar .days td {
		
		padding: 4% 0;
    margin: 0 1px 1px 0;
    font-size: 15px;
	}
	 .ymd {display:none;} 
	 .calendar .highlight {
		font-weight: bold;
		/* color: #00F; */
		background: #ffdb99;
	}
	  </style>
	  <?php include('footer.php'); ?>
	  <script>
  $(function(){
	    $.fn.select2.amd.require(["optgroup-data", "optgroup-results"], 
	        function (OptgroupData, OptgroupResults) {
	        $('#worker').select2({
	            dataAdapter: OptgroupData,
	            resultsAdapter: OptgroupResults,
	            closeOnSelect: false,
			//	placeholder: "Search"
	        }); 
	    });
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
      

	
	$('#followupdate').Zebra_DatePicker({
				format: 'Y-m-d H:i',
				direction: -1,
       	 current_date: localTime
	  });


 $("#startdate").change(function() {
     //alert('hi')
 	 $('#enddate').val('');
 });


  $("#enddate").change(function() {
    var startDate = document.getElementById("startdate").value;
    var endDate = document.getElementById("enddate").value;
    //var DateCreated = new Date(Date.parse(startDate)).format("MM/dd/yyyy");
   // var d = new Date(startDate);
   // startDate = d.toISOString();
    //alert((Date.endDate));
    if ((Date.parse(endDate) < Date.parse(startDate))) {
      alert("End date should be greater than Start date");
      document.getElementById("enddate").value = "";
    }
  });




	</script>
      <script>
		CI_ROOT = '<?php echo base_url() ?>';
		Userid = '';
      </script>
      <?php
      //echo my_file1('web/plugins/datatables/jquery.dataTables.min', 2);
     // echo my_file1('web/plugins/datatables/dataTables.bootstrap.min', 2);
      echo my_file1('web/custom/appointment.js?v=191120.0', 2);
      ?>
     
      <script>
      

        

        function IsChkNumc(source) {
          bmobile = $(source).val();
          if (isNaN(bmobile)) {
            bmobile = bmobile.replace(/\D/g, '');
            $(source).val(bmobile);
          }
        }

        $('#cljoindate').datepicker({
          dateFormat: "d-MM-yy DD"
		});
		
		$('#bookingdate').datepicker({
				// dateFormat: "d-MM-yy DD"
				format:"yyyy-mm-dd",
				minViewMode:0,
				autoclose:true
			});
	  </script>
	  <script type="text/javascript">
//var avlparentid = '';
$('.a1').mouseenter(function(){
var date1 = $(this).children('.day_num').text();
var yearmont = $(this).children('.ymd').text();
var wholedate = yearmont+'-'+date1;
// $('#mouseoverdate').html(yearmont+'-'+date1);
// $('.info-box').attr("id",yearmont+'-'+date1);
//   $('.info-box').show();
//alert(date1);
var today = new Date().toISOString().slice(0,10);;
//alert(today);
var earlyselections = $('#info-boxtext').val();
var useridartist = $('#userid').val();
if(date1 != ''){
	if(wholedate >= today){
$.ajax({
		type: "POST",
		url: CI_ROOT + 'Appointment/get_slots',
		data: {
			wholedate: wholedate,
			earlyselections: earlyselections,
			useridartist: useridartist
		},
		success: function(result) {
			//alert(result); 
			if (result != 'no') {
				// var data = result.split(',');
				// $("#clientid").val(data[0]).change();
				// $("#tattoodt").val(data[1]);
				//$("#tattoodt option[value="+data[1]+"]").attr('selected', 'selected');
				//$('#something').attr('data-original-title',result); 
				// $('.tooltiptext').html(result); 
				//info-box
				$('.info-box').html(result);
				$('.info-box').attr("id",wholedate);
				$('.info-box').show();
			}
			
		}
	});
}
}
});

// $(".permissionch").change(function(){
// 	var hid =  $(this).attr('id');
// 	//var childclass =  $(this).closest('td').next().find('input').attr('id');
// 	var avlparentid = $(this).parent().parent().attr('id');
// 	if(!this.checked){
		
// 		//$('#info-boxtext').attr("value",'');
// 	}
// 	else{
// 		alert(hid+" checked.");
// 		// $("."+hid).prop('disabled', false);
// 		//alert(hid +'@'+avlparentid);
		
// 		//alert(preval);
// 		if($('#info-boxtext').val()!= ''){
// 			var preval = $('#info-boxtext').val();
// 			//alert(preval+'&'+avlparentid);
// 			if(preval != avlparentid){
// 				$('#info-boxtext').attr("value",preval+'&'+avlparentid);
// 			}
			
// 		}else{
// 			$('#info-boxtext').attr("value",hid+'@'+avlparentid);
// 		}
		
// 	}

// });
$('#schedulecalender').hide();
$('#artistnameschedule').hide();
$("#userid").change(function(){
	$('#schedulecalender').show();
	var useridartist = $('#userid option:selected').text();
	$('#artistnameschedule').show();
	$('#artistnameschedule').html('Schedule for '+useridartist);
});



$('.a1').mouseleave(function(){
  $('.info-box').hide(); 
});

$('.info-box').mouseenter(function(){
  $('.info-box').show(); 
});
$('.info-box').mouseleave(function(){
  $('.info-box').hide(); 
});

//$('.content').mouseenter(function(){
  $('.day .content').hide();
  //alert($('.day .content').parent().attr('class'));
  //alert($('.day .content > p:eq(0)').attr('id'));
  var date = new Date();
  var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
while(firstDay < date){
	//if($('.day .content > p:eq(0)').attr('id') == 'pastdate'){
		$('.day .content').parent().css("background-color","#dde4e6");
		firstDay = date.setDate(date.getDate() + 1);
	//}
	
}

   
//});
// $(document).on('hide.bs.modal', '.info-box', function() {
// 	//var input = document.getElementById("pimage");
// 	//var storetype = $("#storetype").val();
// 	alert("iiinn");
// 	var selectedimg = [];
// 	$(".permissionch:checked").each(function(){
// 		selectedimg.push($(this).val());
// 	});
// 	var joinimg = '';
// 	if (selectedimg.length > 0) {  
// 		joinimg = selectedimg.join(",");      
// 	}

// 		$('#info-boxtext').attr("value",joinimg);
// 		// alert(selectedimg); return false;
// 		// if(storetype == '1')
// 		// {
// 		//$("#productimage").val(joinimg);
// 		// }else if(storetype == '2'){
// 		// 	$("#onlineproductimage").val(joinimg);
// 		// }
// 		// myFunction33();
// 		//Do stuff here
// });



$(document).on('change', '.permissionch', function () {
    //do stuff
	var hid =  $(this).attr('id');
	//var childclass =  $(this).closest('td').next().find('input').attr('id');
	var avlparentid = $(this).parent().parent().attr('id');
	if(!this.checked){	
		//$('#info-boxtext').attr("value",'');


		if($('#info-boxtext').val()!= ''){
			var preval = $('#info-boxtext').val();
			if(preval.indexOf('&') > -1)
			{
				//alert("hello found inside your_string");
					var diffdateval = preval.split('&');
					//alert(diffdateval);
					var orgval = '';  var beforevalifdfdate = ''; var beforeval = ''; var elsecount = 0;
					for (var i = 0; i < diffdateval.length; i++)
					{
						//dynamicvalues.push(str_array[i]);
						var prevalsec = diffdateval[i].split('@');
						var datevalsec = prevalsec[1];
						
						if(datevalsec != avlparentid){
							beforevalifdfdate += diffdateval[i]+'&';
						}else{
							var dcommval ='';
							if(prevalsec[0].indexOf(',') > -1){
								var dcommval = prevalsec[0].split(',');
								dcommval.splice(dcommval.indexOf(hid), 1);
							}else{
								dcommval = '';
							}
							if(dcommval != ''){
								//$('#info-boxtext').attr("value",dcommval+'@');
								diffdateval[i] = dcommval+'@'+prevalsec[1];
								beforevalifdfdate +=diffdateval[i]+'&';
							}else{

							}
						}
					}
					$('#info-boxtext').attr("value",beforevalifdfdate.slice(0, -1));
			}else{
					var prevalsec = preval.split('@');
						var datevalsec = prevalsec[1];
						
						if(datevalsec != avlparentid){
							//beforevalifdfdate += preval+'&';
						}else{
							var dcommval ='';
							if(prevalsec[0].indexOf(',') > -1){
								var dcommval = prevalsec[0].split(',');
								dcommval.splice(dcommval.indexOf(hid), 1);
							}else{
								dcommval = '';
							}
							if(dcommval != ''){
								//$('#info-boxtext').attr("value",dcommval+'@');
								preval = dcommval+'@'+prevalsec[1];
								//beforevalifdfdate +=preval+'&';
							}else{
								preval = '';
							}
						}
						$('#info-boxtext').attr("value",preval);

			}

		}





	}
	else{
		//alert(hid+" checked.");
		if($('#info-boxtext').val()!= ''){
			var preval = $('#info-boxtext').val();
			if(preval.indexOf('&') > -1)
			{
				//alert("hello found inside your_string");
					var diffdateval = preval.split('&');
					//alert(diffdateval);
					var orgval = '';  var beforevalifdfdate = ''; var beforeval = ''; var elsecount = 0;
					for (var i = 0; i < diffdateval.length; i++)
					{
						//dynamicvalues.push(str_array[i]);
						var prevalsec = diffdateval[i].split('@');
						var datevalsec = prevalsec[1];
						
						if(datevalsec != avlparentid){
							//orgval = diffdateval+'&';
							//alert(diffdateval[i]);
							
							// for (var j = i-1; j >=0 ; j--)
							// {
								beforevalifdfdate += diffdateval[i]+'&';
							// }
							// var naval = hid+'@'+avlparentid;
							// $('#info-boxtext').attr("value",beforeval+'&'+naval);
						}else{
							elsecount++;
							var beforeval = '';
							for (var j = i-1; j >=0 ; j--)
							{
								beforeval += diffdateval[j]+'&';
							}
							// alert(beforeval);
							 var onedateslots = prevalsec[0]+','+hid;
							
							// var fnval = beforeval;
							// fnval +=onedateslots+'@'+prevalsec[1];
							// alert(fnval);
							$('#info-boxtext').attr("value",beforeval+onedateslots+'@'+prevalsec[1]);
						}
						
					}
					if(beforevalifdfdate != '' && elsecount == 0){
							var naval = hid+'@'+avlparentid;
							$('#info-boxtext').attr("value",beforevalifdfdate+naval);
						}
				}else{
				var prevalsec = preval.split('@');
				var datevalsec = prevalsec[1];
				var naval = hid+'@'+avlparentid;
				if(datevalsec != avlparentid){
					$('#info-boxtext').attr("value",preval+'&'+naval);
				}else{
					var onedateslots = prevalsec[0]+','+hid;
					$('#info-boxtext').attr("value",onedateslots+'@'+prevalsec[1]);
				}	
			}	
		}else{
			$('#info-boxtext').attr("value",hid+'@'+avlparentid);
		}		
	}
});


</script>