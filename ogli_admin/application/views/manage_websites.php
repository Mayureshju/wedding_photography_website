<?php include 'header.php'; ?>

<div class="app-content">
	<section class="section">
		<div class="row">
			<div class="col-sm-3 col-md-3 col-xs-2">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>Registration/dashboard">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">View Site/Project</li>
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
                            
							<div class="table-responsive table-lg">
                                <table class="table table-bordered" id="example">
                                    <thead>
                                        <tr>
											<th class="text-center" style="width:5%">Logo</th>
											<th class="text-center">Website Name</th>
											<th class="text-center">Domain Name</th>
											<th class="text-center">Sender EmailID</th>
											<th class="text-center">Updated By</th>
											<th class="text-center">Updated Date</th>
											<th class="text-center">Status</th>
											<th class="text-center">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                            <?php
												if(isset($website))
												{
													foreach($website as $key=>$val)
													{
														
														$image_path = $val->MWM_Imagepath;
														?>
														<tr>
														  <td class="text-nowrap align-middle"><img style="width:50%" class="img-responsive" src="<?php echo $image_path.'cpanel-logo/header/'.$val->MWM_Logo;?>"></td>
														  <td class="text-nowrap align-middle"><?php echo $val->MWM_Website_Name;?></td>
														  <td class="text-nowrap align-middle"><?php echo $val->MWM_Domain_Name;?></td>
														  <td class="text-nowrap align-middle"><?php echo $val->MWM_Mail_SenderID;?></td>
														  <td class="text-nowrap align-middle"><?php echo $val->MWM_UpdatedBY;?></td>
														  <td class="text-nowrap align-middle"><?php echo $val->MWM_UpdatedDate;?></td>
														  <td class="text-center align-middle">
																
																<label class="custom-switch">
																	<input type="checkbox" name="" class="custom-switch-input clstatus <?php if($val->MWM_Status == 1){echo 'active_status';}else{echo 'Inactive';}?>" alt="<?php echo $val->MWM_ID;?>" <?php if($val->MWM_Status == 1) echo 'checked';?> >
																	<span class="custom-switch-indicator"></span>
																</label>
														  </td>
															<td class="text-center align-middle">
																<!-- <a  data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit" onclick="editdata(<?php echo $val->MWM_ID;?>);" >
																	<i class="fa fa-pencil"></i>
																</a> -->
																<div class="btn-group align-top">
																	<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button" onclick="editdata(<?php echo $val->MWM_ID;?>)">Edit</button> 
																</div>
															</td>
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
// echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
// echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/manageweb',2);
?>

