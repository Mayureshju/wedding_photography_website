<?php include('header.php');?>
        <!-- Start Of Content Section -->
        <!-- <div id="content">
		<style> .pagespace { margin-top:10px; padding-bottom:3px !important; }	</style>
		<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="page-header pagespace"> -->
			<!-- Container-fluid -->
			<!-- <div class="container-fluid">
				<div class="col-md-2 col-sm-4 col-xs-4">
					<h5>Dashboard</h5>
				</div>
			</div>
		</div>
		</div> -->
		<div class="app-content">
					<section class="section">
                    	<ol class="breadcrumb">
                            <!-- <li class="breadcrumb-item"><a href="#" class="text-muted">Home</a></li> -->
                            <li class="breadcrumb-item active text-" aria-current="page">Dashboard </li>
                        </ol>

						<div class="row">
							<div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 col-12" style="<?php if (($sess_role =='4' || $sess_role =='3') && !in_array("Administrator", $pagemodify)) {
                                                          echo "display:none";
                                                        } ?>">
								<a href="<?php echo base_url(); ?>Nav/manage_user/<?=$no?>">
								<div class="card">
									<div class="card-body text-center">
										<h5>Administrator</h5>
										
										<div class="text-center">
											<div class="mb-3 mt-1">
												<img src="<?php echo base_url();?>public/img/icon/user.png" class="icon-img" >
											</div>
											
										</div>
									</div>
								</div>
								</a>
							</div>
							<div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 col-12" style="<?php if (($sess_role =='4' || $sess_role =='3') && !in_array("List Of Value", $pagemodify)) {
                                                          echo "display:none";
                                                        } ?>">
								<a href="<?php echo base_url();?>Nav/lov">
								<div class="card">
									<div class="card-body text-center">
										<h5>List of values</h5>
										
										<div class="text-center">
											<div class="mb-3 mt-1">
												<img src="<?php echo base_url();?>public/img/icon/pen.png" class="icon-img" >
											</div>
											
										</div>
									</div>
								</div>
								</a>
							</div>
						</div>


						<div class="row">
			<div class="col-lg-12">
				<div class="e-panel card">
					<div class="card-body">
						<div class="e-table">
							
						
                    

			<div class="row">
				<label class=" col-md-4 col-sm-4 col-xs-12" for="first-name">Showing Follow Up :: <span style="color:#337ab7;">1 of 1</span></label>
			</div>
						           
			<div class="table-responsive table-lg">
				<div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
					<div >
						
							
								<div class="col-sm-12">
								<table id="example1" class="table table-bordered dataTable no-footer" role="grid" aria-describedby="example1_info">
					<thead>
						<tr role="row">
							<th class="text-center sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Enq Id: activate to sort column descending">Title</th>
							<th class="text-center sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Priority: activate to sort column ascending">Contact Name</th>
							<th class="text-center sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending" >Phone</th>
							<th class="text-center sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Company: activate to sort column ascending" >Email</th>
							<th class="text-center sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Contact Name: activate to sort column ascending" >Follow Up</th>
							<th class="text-center sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" >Status</th>
							
							</tr>
					</thead>
					<tbody> 
								<?php
								foreach($enquiries as $enquiry)
								{
									$completestatus=get_list_order_by('mov_follow_up','*','MEnq_id='.$enquiry->MEnq_id,'MF_id DESC');
									if(isset($completestatus[0]->MF_status) && $completestatus[0]->MF_status==0)
									{
								?>
						
																	
                                    <tr role="row" class="odd">
							<td class="align-middle text-center sorting_1"><?php echo $enquiry->MEnq_title; ?></td>
							<td class="align-middle text-center"><?php echo $enquiry->MEnq_contact_name; ?></td>
							<td class="align-middle text-center"><?php echo $enquiry->MEnq_phone; ?></td>
							<td class="align-middle text-center"><?php echo $enquiry->MEnq_email; ?></td>
							<td class="align-middle text-center"><?php echo $enquiry->MEnq_follow_up;?></td>
							<td class="align-middle text-center">
							<?php 
							if($enquiry->MEnq_status == 0){ 
								echo '<span style="color:grey;"> <b>New</b> </spain>' ;
							} 
							else if($enquiry->MEnq_status == 1){ 
								echo '<span style="color:blue;"> <b>Open</b> </spain>'; 
							}
							else if($enquiry->MEnq_status == 2){ 
								echo '<span style="color:green;"> <b>Lost</b> </spain>'; 
							}
							else if($enquiry->MEnq_status == 3){ 
								echo '<span style="color:red;"> <b>Own</b> </spain>'; 
							}
							?>		
						
						</td>
							</tr>
								<?php } } ?>
						</tbody>
								</table></div>
								
						</div>
					</div>
				</div>
			</div>
<?php include('footer.php');?>