<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
	<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Manage Portfolio</li>
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
									<a href=""><h4 style="font-size: 1.1rem !important;">Manage Portfolio</h4></a>
								</div>
								<div class="col-sm-12 col-md-8 col-xs-12">


					<form class="form-horizontal" id="mainform" action="<?php echo base_url();?>/Nav/search_portfolio_master" method="POST">
					<div class="row" id="bs-example-navbar-collapse-1">
						<div class="col-md-3 col-sm-3 col-xs-12" >
							<?php 
							$filterval = '';
							if(isset($filter)){
								$filterval = $filter;
							}
							?>
							<select class="form-control select2" name="filter" id="searchfilters" style="width:100%;">
								<option value="MP_Name" <?php echo $filterval == 'MP_Name'?'selected':'';?> >Portfolio Name</option>
							</select>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12" style="margin-right:5px;" id="plainsearch">
							<?php $search_val = '';
								if(isset($search)){
									$search_val = $search;
								}
							?>
							<input type="text" name="search" class="form-control" value="<?= $search_val?>" autocomplete="off">
						</div>


												
						<div class="col-md-3 col-sm-3 col-xs-12" style="margin-right:5px;">
							<select class="form-control select2" name="status" id="status" style="width:100%;">
								<?php  if(isset($status)){  ?>
								<option value=''> Select </option>
								<option <?php echo $status == 2?"selected":"";?> value="2">All Portfolio</option>
								<option <?php echo $status == 1?"selected":"";?> value="1">Active Portfolio</option>
								<option <?php echo $status == 0?"selected":"";?> value="0">Deactive Portfolio</option>						
								<?php  }else {  ?>
								<option value=''> Select </option>
								<option  value="2">All Portfolio</option>
								<option  value="1" >Active Portfolio</option>
								<option  value="0">Deactive Portfolio</option>
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
					<?php if (in_array("Product", $pagemodify)) { ?>
						<a href="<?php echo base_url();?>Nav/add_portfolio" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New">
							<i class="fa fa-plus"></i>
						</a>
					<?php } ?>
					<a href="<?php echo base_url();?>Nav/manage_portfolio/<?php echo $no;?>" data-toggle="tooltip" title="Reset" class="btn btn-default" data-original-title="Rebuild">
                            <i class="fa fa-refresh"></i>
                        </a>
				</div>
			
				</div>
                    

				<div class="row">
				<label class=" col-md-4 col-sm-4 col-xs-12" for="first-name">Showing Order :: <span style="color:#337ab7;"><?php echo count($projectdts); ?> of <?php echo count(get_list('mov_order','MOR_id',''));?></span></label>
				</div>
						            
							<div class="table-responsive table-lg">
                               <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                        	<!-- <th class="text-center">Page Name</th> -->
											<th class="text-center">Potfolio Name</th> 
											<th class="text-center">Status</th>
											<th class="text-center">Created Date</th>
											<th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                            <?php 									
												if(isset($projectdts) && $projectdts !='no')
												{
														foreach($projectdts as $key=>$val)
														{
															?>
															<tr>
																<!-- <td class="align-middle text-center"><?php echo $val->MC_page_name ; ?></td> -->
															    <td class="align-middle text-center"><?php echo $val->MP_Name; ?></td>														
																<td class="align-middle text-center">
																<?php if($val->MP_Status == 1){echo 'Active';}else{echo 'Inactive';}?>
																</td>
																<?php 
																$searchstr =  '';if($this->uri->segment(3)){ $searchstr = $this->uri->segment(3);}
																$page =  '0';if($this->uri->segment(4)){$page =  $this->uri->segment(4);}

																?>
																<td class="align-middle text-center"><?php echo date('d-m-Y',strtotime($val->MP_CreatedDate)); ?></td>
																<td class="align-middle text-center" width="80">
																<button class="btn btn-sm btn-primary badge" style="cursor:pointer; " title='Edit Portfolio' onclick="edit_portfolio(<?php  echo $val->MP_Id.',\''.$searchstr.'\','.$page; ?>)"><i class="fa fa-edit"></i></button>
																<button class="btn btn-sm btn-primary badge" style="cursor:pointer; " title='Delete Portfolio' onclick="delete_portfolio(<?php  echo $val->MP_Id.',\''.$searchstr.'\','.$page; ?>)"><i class="fa fa-trash-o"></i></button>
															</td>
																
																

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
echo my_file1('web/custom/product',2);
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
</script>
<script>
	function edit_portfolio(id,search,page)
	{
	
		if(id != '')	
		window.location.href = CI_ROOT+"Nav/edit_portfolio/"+id+"/"+search+"/"+page;
		else
		alert("Problem with Portfolio");
	
	}

	function delete_portfolio(id,search,page)
	{
	
		var conf = confirm("Do you want to delete portfolio?");
	if (conf) {
		$.ajax({
			type: "POST",
			url: CI_ROOT + 'Nav/deleteportfolio',
			data: {
				delid: id
			},
			success: function(result) {
				if (result == 'yes') {
					alert('Portfolio deleted');
					window.location.reload();
				}
			}
		});
	}
	
	}
</script>
