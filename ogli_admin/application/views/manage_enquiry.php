<?php include 'header.php'; ?>
<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<!-- <div id="content">
<style>
			.pagespace { margin-top:5px; padding-bottom:0px !important;}
			.faicon{font-size:12px;padding-right:5px; !important;}
			
			.pullpluse{margin-top:-8px !important;}
</style> -->
            <!-- <div class="page-header pagespace"> -->
                <!-- Container-fluid -->
                <!-- <div class="container-fluid">
				<div class="row">
					<div class="col-md-2 pagespace ">
						<ul class="breadcrumb pull-left">
                        <li><a href="#">Manage Enquiry</a></li> 
							
                         </ul>
					</div>
					<div class="pull-right pullpluse hidden-md hidden-lg visible-sm visible-xs">
					<div class="col-md-2 col-xs-2 col-sm-2">
						<div class="col-md-2 col-xs-2 col-sm-2">
						<a href="<?php echo base_url();?>Nav/manage_enquiry/<?php echo $no;?>" data-toggle="tooltip" title="Reset" class="btn btn-default" data-original-title="Rebuild">
                            <i class="fa fa-refresh"></i>
                        </a>
						</div>
					</div>
                    </div>
					
					<div class="col-md-9 col-sm-9 col-xs-12 col-lg-8" > -->





<div class="app-content">
	<section class="section">
	<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>Registration/dashboard">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Manage Enquiry</li>
		</ol>
		</div>
		<div class="col-sm-9 col-md-9 col-xs-4">
			<button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;" onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i>
				</button>
		</div>
	</div> 

	<div class="section-body ">
		<div class="row">
			<div class="col-lg-12">
				<div class="e-panel card">
					<div class="card-body">
						<div class="e-table">
							
						<div class="row">
							<div class="col-sm-12 col-md-2 col-xs-12 mb-3">
								<a href=""><h4 style="font-size: 1.1rem !important;">Manage Enquiry</h4></a>
							</div>
							<div class="col-sm-12 col-md-7 col-xs-12">

					<form class="form-horizontal" id="mainform" action="<?php echo base_url();?>index.php/Nav/search_manage_enquiry" method="POST">
					<div class="row" id="bs-example-navbar-collapse-1">
						
						<div class="col-md-3 col-sm-3 col-xs-12 form-group" style="margin-right:5px;">
							<?php 
							$filterval = '';
							if(isset($filter)){
								$filterval = $filter;
							}
							?>
							<select class="form-control select2" name="filter" id="searchfilters" style="width:100%;">
							<option value="MEnq_id" <?php echo $filterval == 'MEnq_id'?'selected':'';?> >Enquiry Id</option>
							<option value="MEnq_contact_name" <?php echo $filterval == 'MEnq_contact_name'?'selected':'';?>>Client Name</option>
							<option value="MEnq_email" <?php echo $filterval == 'MEnq_email'?'selected':'';?>>Client Email</option>
							<option value="MEnq_phone" <?php echo $filterval == 'MEnq_phone'?'selected':'';?>>Client Number</option>
							<option value="MEnq_company_name" <?php echo $filterval == 'MEnq_company_name'?'selected':'';?>>Client Company</option>
							<option value="MEnq_assigned_to" <?php echo $filterval == 'MEnq_assigned_to'?'selected':'';?>>Assigned To</option>		
							</select>
						</div>
		
						<?php $search_val = isset($search)?$search:"";?>
					
						<div class="col-md-3 col-sm-3 col-xs-12 form-group" style="margin-right:5px;" id="plainsearch">
							<input type="text" name="search" class="form-control" value="<?= $search_val?>" autocomplete="off">
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12 form-group" style="margin-right:5px;" id="sentby">
							<select class="form-control select2" name="sentbyid" id="sentbyid" style="width:100%;">											
							<option value="">Select Name</option>
							<?php 	
	
							$whereusrchk = " and MUM_ID = '".$uid."' ";
						   	if($uid == 1) { $whereusrchk = ""; }
							$getscat = get_list('mov_user_master','MUM_ID,MUM_Full_name,MUM_Email',"MUM_status = '1' ".$whereusrchk." ORDER BY MUM_Full_name ASC");
							if($getscat){
							foreach($getscat as $getscatdata)	{	 	
							if($search_val == $getscatdata->MUM_ID){ ?>												
							<option value="<?php echo $getscatdata->MUM_ID; ?>" selected ><?php echo ucwords($getscatdata->MUM_Full_name).' - ('.$getscatdata->MUM_Email.')'; ?></option>  
							<?php }else { ?>										
							<option value="<?php echo $getscatdata->MUM_ID; ?>"><?php echo ucwords($getscatdata->MUM_Full_name).' - ('.$getscatdata->MUM_Email.')'; ?></option>
							<?php } } } else {?>  
								<option value="<?php echo set_value('sentbyid'); ?>">No Data</option>  
							<?php }?>	
							</select>
						</div>
						
						
						
						<div class="col-md-4 col-sm-3 col-xs-12 form-group" style="margin-right:5px;">
							<select class="form-control select2" name="status" id="status" style="width:100%;">
								<?php  if(isset($status)){  ?>
								<option <?php echo $status == 10?"selected":"";?> value="10">All Enquiry</option>
								<option <?php echo $status == 0?"selected":"";?> value="0">Enqiry New</option>
								<option <?php echo $status == 1?"selected":"";?> value="1">Enqiry Open</option>						
								<option <?php echo $status == 2?"selected":"";?> value="2">Enqiry Lost</option>						
								<option <?php echo $status == 3?"selected":"";?> value="3">Enqiry Own</option>						
								<?php  }else {  ?>
								<option value="10">All Enquiry</option>
								<option value="0">Enqiry Pending</option>
								<option value="1">Enqiry Responded</option>						
								<option value="2">Enqiry Converted</option>						
								<option value="3">Enqiry Rejected</option>		
								<?php }?>
							</select>									
						</div>
						<input type="number" min='1' name="result" class="form-control" value="10" autocomplete="off" style="display:none">
						<!-- <div class="col-md-2 col-sm-2 col-xs-12 form-group" style="margin-right:5px;">
						<input type="number" min='1' name="result" class="form-control" value="<?= $result; ?>" autocomplete="off">
						Results Per Page
						</div> -->
						
						<div class="col-md-1 col-sm-1 col-xs-12 form-group" >
							<button type="submit" data-original-title="Search" class="btn btn-primary"><i class="fa fa-search"></i></button>
						</div>
					 </div>
					</form>
					</div>
					
					
					<div class="col-sm-12 col-md-3 col-xs-12">
						<ul class="add">									
							<li>
								<?php if (in_array("Manage FAQ", $pagemodify)) { ?>
									<a href="<?php echo base_url();?>Enquiry/add_enquiry" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New">
										<i class="fa fa-plus"></i>
									</a>
								<?php } ?>
								<a href="<?php echo base_url();?>Nav/manage_enquiry/<?php echo $no;?>" data-toggle="tooltip" title="Reset" class="btn btn-default" data-original-title="Rebuild"> <i class="fa fa-refresh"></i> </a> 
							</li>
						</ul>
					</div>
				</div>
                    

			<div class="row">
				<label class=" col-md-4 col-sm-4 col-xs-12" for="first-name">Showing Enquiry :: <span style="color:#337ab7;"><?php echo count($contentwriterdts); ?> of <?php echo count(get_list('mov_enquiry','MEnq_id',''));?></span></label>
			</div>
			<ul class="nav nav-pills pb-3 pt-3 border-bottom mb-2">
				<?php if(empty($search)){ ?>
					<a href="<?php echo base_url();?>Nav/manage_enquiry/<?php echo $no;?>" class="nav-link active mr-2 mdf-nv-link-g" data-original-title="Rebuild"> All </a> 
				<?php } else { ?>
					<a href="<?php echo base_url();?>Nav/manage_enquiry/<?php echo $no;?>" class="nav-link mr-2 mdf-nv-link-d" data-original-title="Rebuild"> All </a>
				<?php } ?>
				<?php
					$enqvalcomma = 0; 
					$mpc_enq = get_list('mov_enquiry','MPC_ID',"MEnq_status = '1'");
					if (isset($mpc_enq) && !empty($mpc_enq)) {

						$enqvalcomma = implode(',', array_column($mpc_enq, 'MPC_ID'));
						$enqvalcomma = implode(',', array_filter(array_unique(explode(',', $enqvalcomma))));

					}
					$mpc_page = get_list('mov_page_content','MPC_ID,MPC_seo_title',"MPC_ID IN ($enqvalcomma) and MPC_status = '1'");
					if($mpc_page){
						foreach($mpc_page as $mpc_page)	{	 ?> 
						<form action="<?php echo base_url();?>index.php/Nav/search_manage_enquiry" method="POST">
							<input type="hidden" value="MPC_ID" name="filter" class="form-control" value="<?= $search_val?>" autocomplete="off">
							<input type="hidden" value="<?= $mpc_page->MPC_ID; ?>" name="search" class="form-control" value="<?= $search_val?>" autocomplete="off">
							<input type="hidden" value="10" name="status" class="form-control" value="<?= $search_val?>" autocomplete="off">
							<input type="hidden" value="10" name="result" class="form-control" value="<?= $search_val?>" autocomplete="off">
							<?php if($mpc_page->MPC_ID == $search) { ?>
								<button class="nav-link active mr-2 mdf-nv-link-g"><?= $mpc_page->MPC_seo_title; ?></button>
							<?php } else { ?>
								<button class="nav-link mr-2 mdf-nv-link-d"><?= $mpc_page->MPC_seo_title; ?></button>
							<?php } ?>
						</form>
					<?php
								} 
			
					} ?>
			</ul>
			<!-- <div class="tab-content">
				<div class="tab-pane active" role="tabpanel" id="tab1">1</div>
				<div class="tab-pane" role="tabpanel" id="tab2">2</div>
				<div class="tab-pane" role="tabpanel" id="tab3">3</div>
				<div class="tab-pane" role="tabpanel" id="tab4">4</div>
			</div>	            -->
								<div class="card shadow-lg">
									<div class="card-body">
										<div class="table-responsive table-lg">
											<table id="example1" class="table table-bordered">
												<thead>
													<tr>
													
														<th class="text-center">Enq Id</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Title</th>
														<th class="text-center">Company</th>
														<th class="text-center">Contact Name</th>
														<th class="text-center">Email</th>
														<th class="text-center">Enquiry Date</th>
														<th class="text-center">Phone</th>
														<th class="text-center">Budgeted</th>
														<th class="text-center">Message</th>
														<th class="text-center">City</th>
														<th class="text-center">Channel</th>
														<th class="text-center">Assigned To</th>
														<th class="text-center">Service/Product</th>
														<th class="text-center">Status</th>
														<th class="text-center">Edit</th>
														<?php if (in_array("Manage Enquiry", $pagedelete)) { ?><th class="text-center"><a  id="del_link"><i class="fa fa-trash-o" aria-hidden="true" ></i></a></th><?php } ?>
													</tr>
												</thead>
												<tbody> 
														<?php 									
															if(isset($contentwriterdts) && $contentwriterdts !='no')
															{
																foreach($contentwriterdts as $key=>$val)
																{
															$MUM_ID = convert_commas_to_value('mov_user_master', 'MUM_Full_name', $val->MEnq_assigned_to, 'MUM_ID');
															$priority=get_row('mov_lov','ML_LOV_Value',"ML_LOV_Name='Priority' and ML_ID=".$val->MEnq_priority);
															$channel=get_row('mov_lov','ML_LOV_Value',"ML_LOV_Name='Channel' and ML_ID=".$val->MEnq_channel);
															$product=get_row('mov_products','MP_Product_Name',"MP_ProID=".$val->MEnq_service_product);
														?>
										
													<tr>
														<td class="align-middle text-center"><?php echo $val->MEnq_id ; ?></td>
														<td class="align-middle text-center"><?php if(isset($priority)){echo $priority->ML_LOV_Value;} ?></td>
														<td class="align-middle text-center"><?php echo $val->MEnq_title; ?></td>
														<td class="align-middle text-center"><?php echo $val->MEnq_company_name; ?></td>
														<td class="align-middle text-center"><?php echo $val->MEnq_contact_name; ?></td>
														<td class="align-middle text-center"><?php echo $val->MEnq_email; ?></td>
														<td class="align-middle text-center"><?php echo date("d M Y - h:i:s", strtotime($val->MEnq_CreatedDate)); ?></td>
														<td class="align-middle text-center"><?php echo $val->MEnq_phone; ?></td>	
														<td class="align-middle text-center"><?php echo $val->MEnq_budgeted; ?></td>	
														<td class="align-middle text-center"><?php echo $val->MEnq_message; ?></td>	
														<td class="align-middle text-center"><?php echo $val->MEnq_city; ?></td>	
														<td class="align-middle text-center"><?php if(isset($channel)){echo $channel->ML_LOV_Value;} ?></td>
														<td class="align-middle text-center"><?php if(isset($MUM_ID)){echo $MUM_ID;}?></td>
														<td class="align-middle text-center"><?php if(isset($product->MP_Product_Name)){echo $product->MP_Product_Name;} ?></td>
														<td class="align-middle text-center">	
															<?php 
															if($val->MEnq_status == 0){ 
																echo '<span style="color:grey;"> <b>New</b> </spain>' ;
															} 
															else if($val->MEnq_status == 1){ 
																echo '<span style="color:blue;"> <b>Open</b> </spain>'; 
															}
															else if($val->MEnq_status == 2){ 
																echo '<span style="color:green;"> <b>Lost</b> </spain>'; 
															}
															else if($val->MEnq_status == 3){ 
																echo '<span style="color:red;"> <b>Own</b> </spain>'; 
															}
															?>
														</td>
														<td class="align-middle text-center">
																		<?php 
																		$searchstr =  '';if($this->uri->segment(3)){ $searchstr = $this->uri->segment(3);}
																		$page =  '0';if($this->uri->segment(4)){$page =  $this->uri->segment(4);}

																		?>	
															<button class="btn btn-sm btn-primary badge" style="cursor:pointer; " title='Edit Enquiry' onclick="edit_enquiry(<?php  echo $val->MEnq_id.',\''.$searchstr.'\','.$page; ?>)"><i class="fa fa-edit"></i></button> </td>
									
														<td class="align-middle text-center"><?php if (in_array("Manage Enquiry", $pagedelete)) { ?><div style=""><?= form_checkbox('deletelink',$val->MEnq_id)?></div><?php }?></td> 

													</tr>
														<?php	}	}else{	?>
															<tr><td colspan="13"><p class="align-middle text-center">No Record Found</p></td></tr>
														<?php
														} 
														?>
												</tbody>
											</table>
											<?php echo $this->pagination->create_links();?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
                <!-- End of product layout -->
<style>
.dataTables_length { display : none; }
.dataTables_filter { display : none; }
.dataTables_info { display : none; }
</style>					
		
				
				
<!-- <div class="modal fade" id="myModalviewenq" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">View Enquiry</h5>
       
      </div>
      <div class="modal-body" id="viewenq">
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
	  
    </div>
  </div>
</div>					
				
				
<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Enquiry</h5>
       
      </div>
      <div class="modal-body" id="enqform">
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
	  
    </div>
  </div>
</div>					 -->
				
				
				<div id="inline1" style="display:none;">
					<div class="container">
						
						<div class="row">
							<div class="col-md-12 pt-25" id="enqform">
								
								
							</div>
						</div>
					</div>
				</div>		
				
				
				
				
				
				
				
<?php include('footer.php');?>
 <script>
 CI_ROOT = '<?php echo base_url()?>index.php/';  CI_actual_link = '<?php echo $actual_link;?>';
</script>
<script>
$('.inline').modaal({
	content_source: '#inline1'
	// $(this).attr('id');
});
		</script>
<?php 
 echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
// echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
//echo my_file1('web/custom/guestpost',2);
?>
				
<script>
	 $(function () {
    $("#example1").DataTable();
	$(".dataTables_filter").addClass("pull-right");
	$(".pagination").addClass("pull-right");
	
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
	elems.forEach(function(html) {
		var switchery = new Switchery(html,{size: 'small'});
	});
	
  });
filterval = '<?php echo $filterval;?>';	
$("#plainsearch").show();
$("#sentby").hide();
if(filterval == 'MEnq_assigned_to'){	
$("#sentby").show()
$("#plainsearch").hide();
}
else{	
$("#sentby").hide()
$("#plainsearch").show();
}

$("#searchfilters").change(function(){
var searchfilters = $("#searchfilters").val(); 	

if(searchfilters == 'MEnq_assigned_to'){	
$("#sentby").show()
$("#plainsearch").hide();
}
else{
$("#sentby").hide()
$("#plainsearch").show();
}	
})
	
	
function view_enquiry(pro_id)
{
	$.ajax({
	type : "POST",
	url : CI_ROOT+'Enquiry/view_enquiry',
	data : {
	pro_id : pro_id
	},
	success :function(result)
	{
		$("#viewenq").html(result); 
		$('#myModalviewenq').modal('show');
	}
});
}	
	
function edit_enquiry(id,search,page)
{
	if(id != '')	
		window.location.href = CI_ROOT+"Enquiry/edit_enquiry/"+id+"/"+search+"/"+page;
		else
		alert("Problem with update");
}
	
	
$("#del_link").on('click', function() {
	var valuedel = [];
	
	$('input[name="deletelink"]:checked').each(function() {
		valuedel.push($(this).val());
	});
	var conf = confirm("Do you want to delete enquiry?");
	if (conf) {
		//alert(valuedel); return false;
		$.ajax({
			type: "POST",
			url: CI_ROOT + 'Enquiry/deletelink',
			data: {
				delid: valuedel
			},
			success: function(result) {
				//alert(result);
				if (result == 'yes') {
					alert('Enquiry deleted');
					window.location.reload();
				}
			}
		});
	}

});	
	
</script>				
				