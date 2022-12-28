<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
	<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
		<ol class="breadcrumb"> 
		<?php $usid = $this->session->userdata('id'); ?>
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>index.php/User/edit_user/<?php echo $usid;?>">Back To Profile</a></li>
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
							
														
								<div class="form-group row">
									
									<div class="col-md-6 col-sm-6 col-xs-12">
									<form action="<?= base_url()?>Leaves/manage_leaves" method="POST" id="frm_mgtdate">	
										<label class="control-label col-md-12 col-sm-12 col-xs-12" for="chkdate">Select Date </label>
										<?php echo $calendar;?>

										<div class="box-footer">
										<div class="form-group mb-0 overflow-hidden mt-4">
											<!-- <div class="col-md-6 col-sm-4 col-xs-12 col-md-offset-3"> -->
											<button type="button" id="applyleavebtn" class="btn btn-primary btn-primary-1 btnfont">Submit</button>
											<!-- </div> -->
										</div>
										</div>
									</form>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">	
									<label class="control-label col-md-12 col-sm-12 col-xs-12" for="chkdate">Company Leaves </label>
										<div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
											<table class="table table-bordered table-hover" id="example1">
											<thead>
											<tr class="textC">
                                            <td class="text-left">Festival Name</td>                                       
                                            <td class="text-left">Date</td>                                        
                                        </tr>
											</thead>
											<tbody> 
											<?php  
											$getcomplev = get_list('mov_company_leaves','MCLV_ID,MCLV_TEXT,MCLV_DATE',"MCLV_STATUS = '1' ORDER BY MCLV_DATE ASC");	

												if(isset($getcomplev))
												{
													foreach($getcomplev as $key=>$val)
													{
														?>
														<tr>
															
															<td class="text-left"><?php echo $val->MCLV_TEXT; ?></td>
															<td class="text-left"><?php echo $val->MCLV_DATE; ?></td>																													
														</tr>
														<?php
													}
												} 
											?>
											</tbody>
											</table>
										</div>
										
										<label class="control-label col-md-12 col-sm-12 col-xs-12" for="chkdate">Approved Leaves in this year </label>
										<div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
											<table class="table table-bordered table-hover" id="example1">
											<thead>
											<tr class="textC">
                                            <td class="text-left">Month</td>                                       
                                            <td class="text-left">No. of leaves</td>                                        
                                        </tr>
											</thead>
											<tbody> 
											<?php  
											$getcomplev = get_list("mov_leaves","MONTHNAME(`MLV_DATE`) AS 'Month', COUNT(*) AS 'count'","MLV_STATUS = '1' and MUM_ID ='".$usid."' and YEAR(`MLV_DATE`) = YEAR(CURDATE()) GROUP BY DATE_FORMAT(`MLV_DATE`, '%m-%Y')");	
											//echo $this->db->last_query();
												if(isset($getcomplev))
												{
													foreach($getcomplev as $key=>$val)
													{
														?>
														<tr>
															
															<td class="text-left"><?php echo $val->Month; ?></td>
															<td class="text-left"><?php echo $val->count; ?></td>																													
														</tr>
														<?php
													}
												} 
											?>
											</tbody>
											</table>
										</div>

									</div>
								</div>
								
							<!-- </form> -->
			
									
				</div>
			</div>
		</div>
	</div>
                <!-- End of product layout -->
<?php include('footer.php'); ?>			
	
<style>
			.pagespace { margin-top:10px; padding-bottom:2px !important;}
			.faicon{font-size:12px;padding-right:5px !important;}
			
			.btnfont{font-size:12px !important;}
   .calendar {
	   font-family: Arial;
	   font-size:12px;
	}
	
	table.calendar {		
		border-collapse:collapse;
	}
	
	.calendar .days td {
		/* width: 80px;
		height: 80px;
		padding: 4px;
		border: 1px solid #efefef;
		vertical-align: top;
		background:#ffff;	
		color: BLACK; */
		padding: 4% 0;
    margin: 0 1px 1px 0;
    font-size: 15px;
	}
	
	.calendar .days td:hover {
		background-color:#FFF3D3;
	} 
	
	.calendar .highlight {
		font-weight: bold;
		color: #00F;
	}
	
	
	
    .week {
		font-size: 16px;
		font-weight:400;
		color:red;
		width: 10px;
		margin-bottom:10px !important;    
	}
	
	.center {
		text-align: center;
	}
	
	table{
		
		
		border-collapse:collapse;
		margin-top: 10px;  
	}
	.red{
		background-color: #FFC0C0 !important; 
	}
	
	.content {
	text-align: center;
    color: white;
 /*  background:#ff0000 !important; */
		min-height: 0px !important;
	}
	.ymd {display:none;}
</style>			
<?php include 'footer.php'; ?>
<script>CI_ROOT = '<?php echo base_url();?>index.php/'</script>
<script>
	var selecteddays =  [];
$(document).ready(function() {

$('.calendar .day').click(function(){
day_num = $(this).find('.day_num').html();
ymd = $(this).find('.ymd').html();
//alert(day_num); return false;
var ymdres = ymd.split("-");
/*alert(ymdres[1]);// return false;
alert('<?php echo date('m');?>'); //return false;
if(ymdres[1] > '<?php echo date('m');?>' ){
alert('1'); return false;
}
else{
alert('0'); return false;
}*/
if(day_num < 10){
day_num = 0+day_num;
}

if(ymdres[0] >= '<?php echo date('Y');?>')
{
if(ymdres[1] >= '<?php echo date('m');?>')
{
if((day_num >= '<?php echo date('d');?>') || (ymdres[1] > '<?php echo date('m');?>' )){
	
// $.ajax
// ({
// url: window.location,
// type: 'POST',
// data: {
// day: day_num
// },
// success: function(msg){
// location.reload();
// } 
// });	
//alert($(this).find('.day_num').html());
//($(this).find('.day_num').html()).style.background = "coral no-repeat fixed center";
if(this.style.backgroundColor == 'coral'){
	var val = day_num+'-'+ymdres[1]+'-'+ymdres[0];
	var index = selecteddays.indexOf(val);	
	selecteddays.splice(index, 1);

	this.style.backgroundColor = 'white';
	
}else{
	selecteddays.push(day_num+'-'+ymdres[1]+'-'+ymdres[0]);
	this.style.backgroundColor = 'coral';
}


}
else{
alert('No changes can be made for previous dates');
return false;
}
}
else{
alert('No changes can be made for previous dates');
return false;
}
}		
else{
alert('No changes can be made for previous dates');
return false;
}
});
});


$('#applyleavebtn').on('click',function(){
	
	//var selecteddaysstr = selecteddays;
	//alert(selecteddays);
	if (selecteddays.length > 0) {
		var joinfilnm = selecteddays.join("/");
		//alert(joinfilnm);
		selecteddaysstr = btoa(joinfilnm);
		// var year = null;
		// var month = null;
		var web = 1;
		var day = selecteddaysstr;
		//window.location.href = CI_ROOT + "Leaves/manage_leaves/" + year + "/" + month + "/" + web + "/" + day;
		$.ajax({		
			url: CI_ROOT+'Leaves/manage_leaves',
			type: 'POST',
			data: {
				day: selecteddaysstr,
			},
			success: function(msg){
			location.reload();
			} 
		});
	}	
});
</script>


