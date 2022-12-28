<?php include 'header.php'; ?>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
</style>
<div class="app-content">
  <section class="section">
  <div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
      <ol class="breadcrumb">
      <?php $serachurl = isset($searchval) ? $searchval : 'bm8=';?>
              <?php $pageurl = isset($pageval) ? $pageval : '0'; ?>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_influencer/<?php echo $no;?>">Manage Review</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Review</li>
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
						if(isset($viewreview)) { ?>
                            <div class="row">
                                <div class="col-12">
                                    <form action="<?php echo base_url()?>index.php/Review/edit_review_data" method="post" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                        <input type="hidden" name="editid" id="editid" value="<?php echo $viewreview->MRV_revid;?>">
                                        <!-- <input type="hidden" name="MUM_ID" id="MUM_ID" value="<?php //echo $viewreview->MUM_ID;?>"> -->
                                        <input type="hidden" name="search" value="<?= $serachurl ?>">
                                        <input type="hidden" name="page" value="<?= $pageurl ?>">	  
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mb-0 overflow-hidden mt-3">
                                                    <label for="MRV_rating">Rating</label>    
                                                    <?php if($viewreview->MRV_rating == '5'){ ?>
                                                        <div class="rate">
                                                            <input type="radio" id="star5" name="MRV_rating" value="5" checked/><label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="MRV_rating" value="4" /><label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="MRV_rating" value="3"/><label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="MRV_rating" value="2"/><label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="MRV_rating" value="1"/><label for="star1" title="text">1 star</label>
                                                        </div>  
                                                    <?php }elseif($viewreview->MRV_rating == '4'){ ?>
                                                        <div class="rate">
                                                            <input type="radio" id="star5" name="MRV_rating" value="5" /><label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="MRV_rating" value="4" checked/><label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="MRV_rating" value="3"/><label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="MRV_rating" value="2"/><label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="MRV_rating" value="1"/><label for="star1" title="text">1 star</label>
                                                        </div> 
                                                    <?php }elseif($viewreview->MRV_rating == '3'){ ?>
                                                        <div class="rate">
                                                            <input type="radio" id="star5" name="MRV_rating" value="5" /><label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="MRV_rating" value="4" /><label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="MRV_rating" value="3" checked/><label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="MRV_rating" value="2"/><label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="MRV_rating" value="1"/><label for="star1" title="text">1 star</label>
                                                        </div> 
                                                    <?php }elseif($viewreview->MRV_rating == '2'){ ?>
                                                        <div class="rate">
                                                            <input type="radio" id="star5" name="MRV_rating" value="5" /><label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="MRV_rating" value="4" /><label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="MRV_rating" value="3" /><label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="MRV_rating" value="2" checked/><label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="MRV_rating" value="1"/><label for="star1" title="text">1 star</label>
                                                        </div> 
                                                    <?php }elseif($viewreview->MRV_rating == '1'){ ?>
                                                        <div class="rate">
                                                            <input type="radio" id="star5" name="MRV_rating" value="5" /><label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="MRV_rating" value="4" /><label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="MRV_rating" value="3" /><label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="MRV_rating" value="2" /><label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="MRV_rating" value="1" checked/><label for="star1" title="text">1 star</label>
                                                        </div>  
                                                    <?php }else{ ?>
                                                        <div class="rate">
                                                            <input type="radio" id="star5" name="MRV_rating" value="5" /><label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="MRV_rating" value="4" /><label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="MRV_rating" value="3" /><label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="MRV_rating" value="2" /><label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="MRV_rating" value="1" /><label for="star1" title="text">1 star</label>
                                                        </div> 
                                                    <?php } ?>                          
                                                </div>
                                                <div class="form-group mb-0 overflow-hidden mt-3">
                                                    <label for="MRV_review_title">Title</label>    
                                                    <?= $viewreview->MRV_review_title; ?>                            
                                                </div>
                                                <div class="form-group mb-0 overflow-hidden mt-3">
                                                    <label for="MRV_review">Review</label>    
                                                    <?= $viewreview->MRV_review; ?>                         
                                                </div>
                                                <div class="form-group mb-0 overflow-hidden mt-3">
                                                    <label for="MRV_name">Your Name</label>    
                                                    <?= $viewreview->MRV_name; ?>                         
                                                </div>
                                                <div class="form-group mb-0 overflow-hidden mt-3">
                                                    <label for="MRV_email">Email</label>    
                                                    <?= $viewreview->MRV_review_title; ?>                             
                                                </div>
                                                <div class="form-group mb-0 overflow-hidden mt-3">
                                                    <label for="MRV_phone">Mobile No</label>    
                                                    <?= $viewreview->MRV_phone; ?>                         
                                                </div>
                                                <div class="form-group mb-0 overflow-hidden mt-4">
                                                    <label style="padding-top:12px;" >Status</label>  
                                                    <label class="custom-switch" style="margin-left: 20px;">
                                                        <input type="checkbox" Value="1" name="MRV_status" id="status" class="custom-switch-input" <?php echo ($viewreview->MRV_status =='1')?'checked':'' ?>>
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                                    
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Send</h4>
                                                </div>
                                                <div class="card-body	text-center">
                                                    <!-- <button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-3">Send </button> -->
                                                    <?php //if ($obj->MUM_User_type == 1 || $obj->MUM_User_type == 4){?>
                                                            <?php //if ((in_array("Apply Leave", $pagemodify)) && $usid == $edit_id) { ?>
                                                            <!-- <a href="#"  id="invoicedisplay" class="btn btn-primary btn-primary-1 mt-3 mb-3" >Send or Print Invoice</a> -->
                                                            <!-- <span class="mailloader" style="display:none;" ><img style="max-width:200px;" src="<?php echo base_url().'public/img1/spinner2.gif';?>" alt="Img" title="Img" class="img-circle"></span	> -->
                                                            <a href="#inline1" data-modaal-type="inline" data-modaal-animation="fade" class="modaal"><button class="btn btn-primary btn-primary-1 mt-3 mb-3" onclick="invoicedisplay(<?php echo $viewreview->MRV_revid;?>)" data-toggle="modal" type="button">Send Review</button> 
                                                            </a>
                                                            <?php //}?>
                                                    <?php //}?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
						<?php } ?>
				</div>
			</div>
		</div>
  </div>
                <!-- End of product layout -->
				
<script type="text/javascript" src="<?php echo base_url() ; ?>assets/ckeditor/ckeditor.js"></script>		
<?php include('footer.php');?>
<script>
 CI_ROOT = '<?php echo base_url()?>index.php/';
 Userid = '<?php echo $viewreview->MA_assignto;?>';
</script>
<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/influencer.js?v=191120.0',2);
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
 