<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
	<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>Registration/dashboard">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Category</li>
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

	<div class="section-body ">
		<div class="row">
			<div class="col-lg-12">
				<div class="e-panel card">
					<div class="card-body">
						<div class="e-table">
							
						<div class="row">
							<div class="col-sm-12 col-md-2 col-xs-12 mb-3">
								<a href=""><h4 style="font-size: 1.1rem !important;">Category</h4></a>
							</div>
							<div class="col-sm-12 col-md-7 col-xs-12">

						<form class="form-horizontal" action="<?php echo base_url();?>index.php/Master/add_nichecat" method="POST"  enctype="multipart/form-data" id="form-product">
							<input type="hidden" name="edit_id" id="edit_id" > 
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-3 form-group">											
									<input type="text" id="ncatname" name="ncatname" required="required"  value="" placeholder="Enter  Category"  class="form-control boxheight" autocomplete="off">
									<ul class="dropdown-menu"></ul>
								</div>

								<!-- <div class="col-md-3 col-sm-3 col-xs-12" style="margin-left: 5%;">
									<div class="form-group" style="margin-top:5px;">
										<label class="control-label " for="status">Status</label>
										<input type="checkbox" name="status" id="status" class="js-switch "  /> 
									</div>
								</div> -->

								<div class="col-md-2 col-sm-3 col-xs-6 form-group">
									<label class="custom-switch">
										<input type="checkbox" name="status" id="status" class="custom-switch-input">
										<span class="custom-switch-indicator"></span>
									</label>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-12 form-group">
								<?php if(in_array("Category",$pagemodify)){?> <div class="form-group">									
										<div class="form-group">
											<button type="submit" id="addlov" class="btn btn-primary btnfont pullpluse" >
											<i class="fa fa-search"></i> Add Category
											</button>
										</div>
									</div><?php }?>
								</div>
							</div>
						</form>
					</div>
				</div>				
                                       
                               
						<div class="e-table mt-4">
						<div class="table-responsive table-lg">
                                    <table class="table table-bordered " id="example1">
                                    <thead>
                                        <tr>
                                            
                                            <td class="text-center">ID </td>
                                            <td class="text-center">Category Name</td>                                       
                                            <td class="text-center">Updated Date</td>
                                            <td class="text-center">Updated By</td>
											<th class="text-center">Status</th>
                                            <td class="text-center" >Edit</td>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                            <?php 									
												if(isset($nichecatinfo))
												{
													foreach($nichecatinfo as $key=>$val)
													{
														?>
														<tr>
															
															<td class="align-middle text-center"><?php echo $val->MNC_cat_id; ?></td>
															<td class="align-middle text-center"><?php echo $val->MNC_cat_name; ?></td>														
															<td class="align-middle text-center"><?php echo date("d M Y - h:i:s", strtotime($val->MNC_Updated_Date)); ?></td>														
															<td class="align-middle text-center"><?php echo convert_commas_to_value('mov_user_master', 'MUM_Full_name', $val->MNC_UpdatedBy, 'MUM_ID');?></td>																												
															
															
															<td class="align-middle text-center"><?php if($val->MNC_cat_status == 1) echo "Active"; else echo "Inactive";?></td>										
															
																									
															<td class="text-center align-middle">
																<a href="#!"  data-toggle="tooltip" title="" class="btn-sm btn-primary badge" data-original-title="Edit" onclick="niche_cat(<?php echo $val->MNC_cat_id.",'".$val->MNC_cat_name."','".$val->MNC_cat_status."'";?>)">
																	<i class="fa fa-pencil" ></i>
																</a>
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
		
<?php include 'footer.php'; ?>
<script>BASEURL = '<?php echo base_url();?>index.php/'</script>
<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
 //echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
// echo my_file1('web/custom/jquery-ui-1.12.1.custom/jquery-ui.min',2);
// echo my_file1('web/custom/jquery-ui-1.12.1.custom/jquery-ui.min',1); 
echo my_file1('web/custom/master',2);
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
 
	// $(function () {
	// 	$("#title").autocomplete({
	// 		source: BASEURL = '<?php echo base_url();?>index.php/Master/get_lov', // path to the get_birds method
	// 		focus: function (event, ui) {
	// 			$("#title").val(ui.item.label);
	// 			return false;
	// 		}
	// 		, select: function (event, ui) {
			   
	// 			$("#title").val(ui.item.value);
	// 			return false; 
	// 		}
	// 	});
		
	// });
</script>