<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
	<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
		<ol class="breadcrumb"> 
		<?php $usid = $this->session->userdata('id'); ?>
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>index.php/User/edit_user/<?php echo $usid;?>">Approve Leaves</a></li>
			<li class="breadcrumb-item active" aria-current="page">Apply Leave <b><?php echo convert_commas_to_value('mov_user_master', 'MUM_Full_name', $usid, 'MUM_ID'); ?></b></li>
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
							<form action="<?= base_url()?>Leaves/approve_leaves_data" method="POST" id="frm_mgtdate">
							<div class="form-group row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select User *
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										 <select class="form-control select2" name="userid" id="userid" required="required">											
                                        <option value="">Select Name</option>
											<?php  $getscat = get_list('mov_user_master','MUM_ID,MUM_Full_name,MUM_Email',"MUM_status = '1' ORDER BY MUM_Full_name ASC");
											if($getscat){ foreach($getscat as $getscatdata)	{	
									
										?>
											<option value="<?php echo $getscatdata->MUM_ID; ?>" <?php if($userid == $getscatdata->MUM_ID){ echo 'Selected/'; }?>><?php echo ucwords($getscatdata->MUM_Full_name).' - ('.$getscatdata->MUM_Email.')'; ?></option>
											<?php  } } else {?>  
                                            <option value="<?php echo  set_value('userid'); ?>">No Data</option>  
                                        <?php }?>	
                                        </select>
									</div>
							  </div>
								
						<div class="form-group row">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Leaves List
						</label>
						<div class="col-md-9 col-sm-6 col-xs-12">
							<input type="checkbox" id="select_all" > Select all <br>
							
							 <br>
							<div id="appleave">
							
						<?php 				
							$getleavelist = get_list('mov_leaves','MLV_ID,MLV_DATE',"MLV_STATUS = '0' ORDER BY MLV_DATE ASC");
							if($getleavelist){
							foreach($getleavelist as $getleavelistdata)	{	 ?>	
							
							
						<?php } }?>	
								
							</div>	
								
						</div>
						</div>
							
						<div class="box-footer">
						<div class="form-group">
							<div class="col-md-6 col-sm-4 col-xs-12 col-md-offset-3">
							<button type="submit" class="btn btn-primary btnfont">Submit</button>
							</div>
						</div>
						</div>
						</form>
									
				</div>
			</div>
		</div>
	</div>
                <!-- End of product layout -->
				
	
	
<?php include 'footer.php'; ?>
<script>CI_ROOT = '<?php echo base_url();?>index.php/'</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkboxc').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkboxc').each(function(){
                this.checked = false;
            });
        }
    });
    
    // $('.checkboxc').on('click',function(){
    //     if($('.checkboxc:checked').length == $('.checkboxc').length){
    //         $('#select_all').prop('checked',true);
    //     }else{
    //         $('#select_all').prop('checked',false);
    //     }
    // });
});
	
	
	
$("#userid").change(function(){
	var userid = $("#userid").val();

	//alert(userid);
	$("#appleave").html('');

	$.ajax({
		type : "POST",
		url : CI_ROOT+'Leaves/getleaves_user',
		data : {
			userid : userid,				 
		},
		success : function(result)
		{
		//alert(result);
			if(result != 'no')
			{
				$("#appleave").html(result);					
			}

		}
	});
}); 	


// $("#leavelbox").on('click',function(){
// 	alert("inchange");
// 	if(this.checked){
// 		//alert("checked");
//             // $('.checkboxc').each(function(){
//             //     this.checked = true;
//             // });
//         }else{
//             //  $('.checkboxc').each(function(){
//             //     this.checked = false;
//             // });
// 			alert("unchecked");
//         }
// });
</script>

