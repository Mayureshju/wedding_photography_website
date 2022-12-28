<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
	<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Manage Client</li>
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
									<a href=""><h4 style="font-size: 1.1rem !important;">Manage Client</h4></a>
								</div>
								<div class="col-sm-12 col-md-8 col-xs-12">
									<form class="form-horizontal" id="mainform" action="<?php echo base_url();?>index.php/Nav/search_client_master" method="POST">
										<div class="row" id="bs-example-navbar-collapse-1">
											<!--
											<input type="hidden" name="city" value="">-->
											<div class="col-md-3 col-sm-3 col-xs-12" style="margin-right:5px;">
												<?php 
												$filterval = '';
												if(isset($filter)){
													$filterval = $filter;
												}
												?>
												<select class="form-control select2" name="filter" id="searchfilters" style="width:100%;">
													<option value=''> Select </option>
													<option value="MC_cl_name" <?php echo $filterval == 'MC_cl_name'?'selected':'';?> selected>Client Name</option>
													<option value="MC_cl_email" <?php echo $filterval == 'MC_cl_email'?'selected':'';?>>Email</option>
													<option value="MC_cl_id " <?php echo $filterval == 'MC_cl_id '?'selected':'';?>>Client ID (U#)</option>	
													<option value="MC_cl_referred_id" <?php echo $filterval == 'MC_cl_referred_id'?'selected':'';?>>Referred Name</option>							
												</select>
											</div>

											<div class="col-md-3 col-sm-3 col-xs-12" id="plainsearch" style="margin-right:5px;">
												<?php $search_val = '';
													if(isset($search)){
														$search_val = $search;
													}
												?>
												<input type="text" name="search" class="form-control" value="<?= $search_val?>" autocomplete="off">
											</div>
											
											<div class="col-md-3 col-sm-3 col-xs-12" id="clntname" style="margin-right:5px;">
												<select class="form-control select2" name="search" id="MC_cl_referred_id" style="width:100%;">											
													<option value="">Select Client</option>
													<?php 
													$getscat = get_list('mov_clients','MC_cl_id,MC_cl_name',"MC_cl_status = '1' ORDER BY MC_cl_name ASC");
													if(isset($getscat)){
														foreach($getscat as $getscatdata)	{ ?>
															<option value="<?php echo $getscatdata->MC_cl_id; ?>"><?php echo ucwords($getscatdata->MC_cl_name); ?></option>  
														<?php } 
													} ?>
												</select>
											</div>

											<!-- <input type="hidden" name="website" id="website" value="1"> -->
										
											<div class="col-md-3 col-sm-3 col-xs-12 " style="margin-right:5px;">
											<select class="form-control select2" name="status" id="status" style="width:100%;">
												<?php  if(isset($status)){  ?>
													<option value=''> Select </option>
													<option <?php echo $status == 2?"selected":"";?> value="2">All Clients</option>
													<option <?php echo $status == 1?"selected":"";?> value="1" >Active Clients</option>
													<option <?php echo $status == 0?"selected":"";?> value="0">Deactive Clients</option>						
												<?php  }else {  ?>
													<option value=''> Select </option>
													<option selected value="1" >Active Clients</option>
													<option  value="0">Deactive Clients</option>
													<option  value="2">All Clients</option>
												<?php }?>
											</select>									
											</div>
											<div class="col-md-1 col-sm-1 col-xs-12 form-group" >
												<button type="submit" data-original-title="Search" class="btn btn-primary"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</form>
								</div>
								<div class="col-sm-12 col-md-2 col-xs-12">
									<?php if (in_array("Clients", $pagemodify)) { ?>
										<a href="<?php echo base_url();?>Client/add_client" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New">
										<i class="fa fa-plus"></i>
										</a>
									<?php } ?>
									<a href="<?php echo base_url();?>Nav/manage_clients/<?php echo $no;?>" data-toggle="tooltip" title="Reset" class="btn btn-default" data-original-title="Rebuild">
										<i class="fa fa-refresh"></i>
									</a>
								</div>
							</div>
							<div class="row">
								<label class=" col-md-4 col-sm-4 col-xs-12" for="first-name">Showing Clients :: <span style="color:#337ab7;"><?php echo count($clients); ?> of <?php echo count(get_list('mov_clients','MC_cl_id',''));?></span></label>
							</div>
							<div class="table-responsive table-lg">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th class="text-center">Client ID</th>
											<th class="text-center">Client Name</th>
											<th class="text-center">Email </th>
											<th class="text-center">Phone</th>
											<th class="text-center"  style="width:17%">Address</th>
											<th class="text-center">Client Type</th>
											<th class="text-center">Updated Date</th>
											<th class="text-center">Updated By</th> 
											<th class="text-center">Status</th>
											<th class="text-center">Edit</th>
										</tr>
									</thead>
									<tbody> 
											<?php 									
												if(isset($clients) && $clients !='no')
												{
														foreach($clients as $key=>$val)
														{
															?>
															<tr>
																<td class="align-middle text-center"><?php echo $val->MC_cl_id; ?></td>
																<td class="align-middle text-center">
																	<?php echo $val->MC_cl_name; ?>
																	
																	<?php
																	 $countReferred = count(get_list('mov_clients','MC_cl_id',"MC_cl_referred_id = '$val->MC_cl_id'")); 
																	if($countReferred == '0'){ }else{ ?>
																		<span class="badge badge-success mt-3"><?= $countReferred; ?></span>
																	<?php	} ?>
																	
																</td>
																<td class="align-middle text-center"><?php echo $val->MC_cl_email; ?></td>
																<td class="align-middle text-center"><?php echo $val->MC_cl_phone; ?></td>
																<td class="align-middle text-center"><?php echo $val->MC_cl_add; ?></td>															
																<td class="align-middle text-center text-capitalize"><?php echo $val->MC_cl_clienttype; ?></td>
																<td class="align-middle text-center"><?php echo date("d M Y - h:i:s", strtotime($val->MC_UpdatedDate)); ?></td>														
																<td class="align-middle text-center"><?php echo convert_commas_to_value('mov_user_master', 'MUM_Full_name', $val->MC_UpdatedBY, 'MUM_ID'); ?></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input status <?php if($val->MC_cl_status == 1){echo 'active_status';}else{echo 'Inactive';}?>" alt="<?php echo $val->MC_cl_id;?>" <?php if($val->MC_cl_status == 1) echo 'checked';?> >
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>														
																<?php 
																$searchstr =  '';if($this->uri->segment(3)){ $searchstr = $this->uri->segment(3);}
																$page =  '0';if($this->uri->segment(4)){$page =  $this->uri->segment(4);}

																?>
																<!-- <td><a  class="editrow" style="cursor:pointer; " title='Edit Category'><i class="fa fa-edit" onclick="edit_client(<?php  echo $val->MC_cl_id.',\''.$searchstr.'\','.$page; ?>)"></i></a></td> -->
																<td class="align-middle text-center"><button class="btn btn-sm btn-primary badge" style="cursor:pointer; " title='Edit Enquiry' onclick="edit_client(<?php  echo $val->MC_cl_id.',\''.$searchstr.'\','.$page; ?>)"><i class="fa fa-edit"></i></button> </td>
															</tr>
															<?php
														}
												}else{
											?>
											<tr><td colspan="13"><p class="text-center">No Record Found</p></td></tr>
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
                <!-- End of product layout -->
<style>
.dataTables_length { display : none; }
.dataTables_filter { display : none; }
.dataTables_info { display : none; }
</style>					
		
<?php include('footer.php');?>
 <script>
 CI_ROOT = '<?php echo base_url()?>index.php/';
</script>
<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
//echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/client.js?v=200820.0',2);
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


  
  	$("#clntname").hide(); 
  	$("#searchfilters").change(function(){
		var searchfilters = $("#searchfilters").val();  

		if(searchfilters == 'MC_cl_referred_id'){
			$("#clntname").show(); 
			$("#plainsearch").hide()
		}
		else{
			$("#plainsearch").show();   
			$("#clntname").hide();    
		}
	})
</script>