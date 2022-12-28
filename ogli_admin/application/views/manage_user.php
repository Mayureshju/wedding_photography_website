<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
	<div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Manage User</li>
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
									<a href=""><h4 style="font-size: 1.1rem !important;">Manage User</h4></a>
								</div>
								<div class="col-sm-12 col-md-8 col-xs-12">


					<?php if(isset($website))?>	
				
						<form class="form-horizontal" id="mainform" action="<?php echo base_url();?>index.php/Nav/search_user" method="POST">
							<div class="row" id="bs-example-navbar-collapse-1">
								<div class="col-md-3 col-sm-3 col-xs-12">
									<?php 
									$filterval = '';
									if(isset($filter)){
										$filterval = $filter;
									}
									?>
									<select class="form-control select2" name="filter" id="ftval">
										<option value="MUM_ID" <?php echo $filterval == 'MUM_ID'?'selected':'';?>>User ID (U#)</option>						
										<option value="MUM_Full_name" <?php echo $filterval == 'MUM_Full_name'?'selected':'';?>>Person Name</option>
										<option value="MUM_Email" <?php echo $filterval == 'MUM_Email'?'selected':'';?>>Email</option>
									</select>
								</div>
							
								<div class="col-md-3 col-sm-3 col-xs-12" id="serchval">
									<?php $search_val = '';
										if(isset($search)){
											$search_val = $search;
										}
									?>
									<input type="text" name="search" class="form-control" value="<?= $search_val?>" autocomplete="off">
								</div>
									
									<input type="hidden" name="website" id="website"  class="form-control" value="1">
									
									<?php 
										$statusval = '';
										if(isset($status)){
											$statusval = $status;
										}
										?>
									<div class="col-md-2 col-sm-2 col-xs-12">
										<select name="status" class="form-control select2">
											<option value="">All</option>
											<option value="1" <?php echo $statusval == '1'?'selected':'';?>>Active</option>
											<option value="0" <?php echo $statusval == '0'?'selected':'';?>>De-Active</option>
										</select>
									</div>
									<div class="col-md-1 col-sm-1 col-xs-12 form-group" >
										<input type="submit" class="btn btn-primary" onclick="" value="Search">
									</div>			
					 			</div>
						</form>
					</div>
					
				<?php if($sess_role == '1'){?>	
				<div class="col-sm-12 col-md-2 col-xs-12">
				<a href="<?php echo base_url();?>User/add_adminuser" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New">
					<i class="fa fa-plus"></i>
				</a>
					<a href="<?php echo base_url();?>Nav/manage_user/<?php echo $no;?>" data-toggle="tooltip" title="Reset" class="btn btn-default" data-original-title="Rebuild">
                            <i class="fa fa-refresh"></i>
                        </a>
				</div>
				<?php }?>
                   
                    
                </div>
                    
                   
          
		<?php $role=$this->session->userdata('role'); ?>
                
						        <div class="row">
						<label class=" col-md-4 col-sm-4 col-xs-12" for="first-name">Showing Results :: <span style="color:#337ab7;"><?php echo count($listofuser); ?> of <?php echo count(get_list('mov_user_master','MUM_ID',''));?></span></label>
					</div>     
							<div class="table-responsive table-lg">
                                <table id="example1" class="table table-bordered" >
                                    <thead>
                                        <tr class="textC">
											<th class="text-center">UID</th>
											<th class="text-center">User Role</th>
											<th class="text-center">Company Name</th>
											<th class="text-center">Person Name</th>
											<th class="text-center">Email Id</th>
											<th class="text-center">Updated Date</th>
				<?php if($role == 1){	?>  
											<th class="text-center">Login Status</th> 
											<th class="text-center">Status</th> 
											<?php }?>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                           <?php $j=1; 
				if(isset($listofuser)&& !empty($listofuser))
				{
				foreach($listofuser as $loc)
				{
					$func = '';
					  $func = 'onclick="edit_user('.$loc->MUM_ID.');"'; 
					
					$usertype=''; $color = '';
					if($loc->MUM_User_type == 1){ $usertype = 'Admin'; $color = 'style="color:green"';}
					if($loc->MUM_User_type == 4){ $usertype = 'Artist'; $color = 'style="color:blue"';}
					
				?>
								<tr style="cursor:pointer;">
									<td class="align-middle text-center" <?php echo $func;?> ><?php echo 'U'.$loc->MUM_ID; ?></td>
									<td class="align-middle text-center" <?php echo $func;?> ><span <?php echo $color;?>> <b><?php echo $usertype;?></b> </span><br></td>
									<td class="align-middle text-center" <?php echo $func;?> ><?php echo $loc->MUM_Comp_Name;  ?></td>
									<td class="align-middle text-center" <?php echo $func;?> ><?php echo $loc->MUM_Full_name;  ?></td>
									<td class="align-middle text-center" <?php echo $func;?> ><?php echo $loc->MUM_Email;  ?></td>
									<td class="align-middle text-center" <?php echo $func;?> ><?php echo date("d-F-Y l", strtotime($loc->MUM_UpdatedDate));  ?></td>
									<?php if($role == 1){	?>									
									<td class="text-center align-middle">
										<label class="custom-switch">
											<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input loginstatus <?php if($loc->MUM_login_status == 1){echo 'active_status';}else{echo 'Inactive';}?>" alt="<?php echo $loc->MUM_ID;?>" <?php if($loc->MUM_login_status == 1) echo 'checked';?> >
											<span class="custom-switch-indicator"></span>
										</label>
									</td>
									<td class="text-center align-middle">
										<label class="custom-switch">
											<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input status <?php if($loc->MUM_status == 1){echo 'active_status';}else{echo 'Inactive';}?>" alt="<?php echo $loc->MUM_ID;?>" <?php if($loc->MUM_status == 1) echo 'checked';?> >
											<span class="custom-switch-indicator"></span>
										</label>
									</td>
									<?php }?>
								 </tr>
				<?php $j++; }} ?>   
                                    </tbody>
                                </table>
								<?= $this->pagination->create_links()?>
								
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
//  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
// elems.forEach(function(html) {
// 	var switchery = new Switchery(html,{size: 'small'});
// });
</script>
<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
// echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/user',2);
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
