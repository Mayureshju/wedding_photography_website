<?php include 'header.php'; ?>
<div class="app-content">
  <section class="section">
  <div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
      <ol class="breadcrumb">
      <?php $serachurl = isset($searchval) ? $searchval : 'bm8=';?>
              <?php $pageurl = isset($pageval) ? $pageval : '0'; ?>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_internalhelp/<?php echo $no;?>">Manage Internal Help</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Internal Help</li>
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
						if(isset($editinternalhelp))
						{ 
							foreach($editinternalhelp as $key => $val)
							{
								?>
								<div class="row">
									<div class="col-6">
										<form action="<?php echo base_url()?>index.php/Internalhelp/edit_internalhelp_data" method="post" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
											<input type="hidden" name="editid" id="editid" value="<?php echo $val->MIh_id;?>">
											<!-- <input type="hidden" name="MUM_ID" id="MUM_ID" value="<?php //echo $val->MUM_ID;?>"> -->
											<input type="hidden" name="search" value="<?= $serachurl ?>">
											<input type="hidden" name="page" value="<?= $pageurl ?>">	  

											<div class="form-group mb-0 overflow-hidden mt-3">
												<label for="metatitle">Question</label>
												<input name="MIh_title" class="form-control" type="text" value="<?php echo $val->MIh_title; ?>">                             
											</div>
											<div class="form-group mb-0 overflow-hidden mt-3">
												<label for="metakeyword">Answer</label>
												<textarea class="form-control inputheight" rows="5" name="MIh_answer"><?php echo $val->MIh_answer; ?></textarea>
											</div>
											<div class="form-group mb-0 overflow-hidden mt-4">
												<label style="padding-top:12px;" >Status</label>  
												<label class="custom-switch" style="margin-left: 20px;">
												<input type="checkbox" Value="1" name="status" id="status" class="custom-switch-input" <?php if(!empty($val->MIh_status)){ echo ($val->MIh_status =='1')?'checked':''; } ?> >
												<span class="custom-switch-indicator"></span>
												</label>
											</div>

											<div class="row mt-4">
												<button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Submit </button>
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
echo my_file1('web/custom/internalhelp.js?v=191120.0',2);
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
 