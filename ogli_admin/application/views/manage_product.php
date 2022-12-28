<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
	<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Manage Product</li>
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
									<a href=""><h4 style="font-size: 1.1rem !important;">Manage Product</h4></a>
								</div>
								<div class="col-sm-12 col-md-8 col-xs-12">


					<form class="form-horizontal" id="mainform" action="<?php echo base_url();?>index.php/Nav/search_product_master" method="POST">
					<div class="row" id="bs-example-navbar-collapse-1">
						<div class="col-md-3 col-sm-3 col-xs-12" >
							<?php 
							$filterval = '';
							if(isset($filter)){
								$filterval = $filter;
							}
							?>
							<select class="form-control select2" name="filter" id="searchfilters" style="width:100%;">
								<option value="MP_ProID  " <?php echo $filterval == 'MP_ProID  '?'selected':'';?>>Product ID</option>	
								<option value="MP_proj_name" <?php echo $filterval == 'MP_proj_name'?'selected':'';?> >Product Name</option>
                                <option value="MNC_cat_id" <?php echo $filterval == 'MNC_cat_id'?'selected':'';?>> Category</option>
															
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


						<div class="col-md-3 col-sm-3 col-xs-12" style="margin-right:5px;" id="nshcat">
							<select class="form-control select2" name="catid" id="catid" style="width:100%;">											
							<option value="">Select Category</option>
							<?php 				
							$getscat = get_list('mov_niche_category','MNC_cat_id,MNC_cat_name',"MNC_cat_status = '1' ORDER BY MNC_cat_name ASC");
							if(isset($getscat)){
							foreach($getscat as $getscatdata)	{	 	
							if($search_val == $getscatdata->MNC_cat_id){ ?>												
							<option value="<?php echo $getscatdata->MNC_cat_id; ?>" selected><?php echo ucwords($getscatdata->MNC_cat_name); ?></option>  
							<?php }else { ?>										
							<option value="<?php echo $getscatdata->MNC_cat_id; ?>"><?php echo ucwords($getscatdata->MNC_cat_name); ?></option>
							<?php } } } else {?>  
								<option value="<?php echo set_value('catid'); ?>">No Data</option>  
							<?php }?>	
							</select>
						</div>

								
												
						<div class="col-md-3 col-sm-3 col-xs-12" style="margin-right:5px;">
						<select class="form-control select2" name="status" id="status" style="width:100%;">
							<?php  if(isset($status)){  ?>
							<option value=''> Select </option>
							<option <?php echo $status == 2?"selected":"";?> value="2">All Products</option>
							<option <?php echo $status == 1?"selected":"";?> value="1" >Active Products</option>
							<option <?php echo $status == 0?"selected":"";?> value="0">Deactive Products</option>						
							<?php  }else {  ?>
							<option value=''> Select </option>
							<option selected value="2">All Products</option>
							<option  value="1">Active Products</option>
							<option  value="0">Deactive Products</option>	
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
						<a href="<?php echo base_url();?>Product/add_product" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New">
							<i class="fa fa-plus"></i>
						</a>
					<?php } ?>
					<a href="<?php echo base_url();?>Nav/manage_product/<?php echo $no;?>" data-toggle="tooltip" title="Reset" class="btn btn-default" data-original-title="Rebuild">
                            <i class="fa fa-refresh"></i>
                        </a>
				</div>
			
				</div>
                    

				<div class="row">
				<label class=" col-md-4 col-sm-4 col-xs-12" for="first-name">Showing Product :: <span style="color:#337ab7;"><?php echo count($projectdts); ?> of <?php echo count(get_list('mov_products','MP_ProID',''));?></span></label>
				</div>
						            
							<div class="table-responsive table-lg">
                               <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                        
											<th class="text-center">Product Id</th>
											<th class="text-center" style="width:5%">Logo</th>
											<th class="text-center">Product Name</th>    
											<th class="text-center">Category</th>  
											<th class="text-center">Updated Date</th>
                                            <th class="text-center">Updated By</th>                                       
											<th class="text-center">Status</th>
											<th class="text-center">Edit</th>
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
																<td class="align-middle text-center"><?php echo $val->MP_ProID; ?></td>

																<?php if($val->MP_Image_1 !='') {
																$nimg = "";
																$img_folder = 'product-images/';
																$external_link = IMAGE_PATH . $img_folder . $val->MP_Image_1;
																if (@getimagesize($external_link)) {
																	$get_cat_logo = $val->MP_Image_1;
																} else {
																	$nimg = 'style="color : #666"';
																	$get_cat_logo = 'no-image.jpg';
																}																
																}
																else{
																$img_folder = 'product-images/';
																$nimg = 'style="color : #666"';
																$get_cat_logo = 'no-image.jpg';
																}
																?>																
																
																<td class="align-middle text-center"><img alt="<?php echo $val->MP_Product_Name; ?>" class="img-responsive" style="width:100%;" src="<?php echo IMAGE_PATH . $img_folder . $get_cat_logo; ?>"></td>
																<td class="align-middle text-center"><?php echo $val->MP_Product_Name; ?></td>
																
																<td class="align-middle text-center"><?php echo convert_commas_to_value('mov_niche_category', 'MNC_cat_name',  $val->MNC_cat_id, 'MNC_cat_id'); ?></td>
                                                                <td class="align-middle text-center"><?php echo date("d M Y - h:i:s", strtotime($val->MP_Updated_Date)); ?></td>														
																<td class="align-middle text-center"><?php echo convert_commas_to_value('mov_user_master', 'MUM_Full_name', $val->MP_UpdatedBy, 'MUM_ID'); ?></td>
                                                              
															<td class="align-middle text-center"><?php if($val->MP_status == 0){ echo '<span style="color:red;"> IN-Active </span>' ;}else if($val->MP_status == 1){ echo '<span style="color:green;"> Active </span>'; } ?></td>													
																<?php 
																$searchstr =  '';if($this->uri->segment(3)){ $searchstr = $this->uri->segment(3);}
																$page =  '0';if($this->uri->segment(4)){$page =  $this->uri->segment(4);}

																?>
																<!-- <td><a  class="editrow" style="cursor:pointer; " title='Edit pack detail'><i class="fa fa-edit" onclick="edit_product(<?php  echo $val->MP_ProID.',\''.$searchstr.'\','.$page; ?>)"></i></a></td> -->
																<td class="align-middle text-center"><button class="btn btn-sm btn-primary badge" style="cursor:pointer; " title='Edit Enquiry' onclick="edit_product(<?php  echo $val->MP_ProID.',\''.$searchstr.'\','.$page; ?>)"><i class="fa fa-edit"></i></button> </td>
																

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
filterval = '<?php echo $filterval;?>';	
//plainsearch nshcat pricest outreach sentby
//MNC_cat_id MGD_getpost_free_paid MGD_getpost_outreachstage_status MUM_ID
$("#nshcat").hide();	 	


if(filterval == 'MNC_cat_id')
{
$("#nshcat").show();	 
$("#plainsearch").hide();
}
else{
$("#nshcat").hide();	 
$("#plainsearch").show();
}


$("#searchfilters").change(function(){
var searchfilters = $("#searchfilters").val(); 	

if(searchfilters == 'MNC_cat_id')
{
$("#nshcat").show();	 
$("#plainsearch").hide();
}
else{
$("#nshcat").hide();	 
$("#plainsearch").show();
}	
	
	
})
</script>
