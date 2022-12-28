<?php include 'header.php'; ?>
<?php $usid = $this->session->userdata('id'); ?>
<!-- <div id="content">
<style>
			.pagespace { margin-top:5px; padding-bottom:0px !important;}
			.faicon{font-size:12px;padding-right:5px; !important;}
			/*.listhead{margin-top:-20px !important;}*/
			.btnfont{font-size:14px !important;}
			.pullpluse{margin-top:-8px !important;}
			.bdm{padding-left:0px;margin-left: -22px;}
			.refreshbtn{margin-right:-68px;}
			.marginbotom{padding:0px 15px;}
</style>
            <div class="page-header pagespace"> -->
                <!-- Container-fluid -->
                <!-- <div class="container-fluid">
				<div class="col-md-4 pagespace bdm">
				<?php $no = base64_encode('no'); ?>
						<ul class="breadcrumb marginbotom">
                        <li><a href="<?php echo base_url();?>Nav/manage_user/<?= $no ?>">Manage User</a></li> 
												
                        <li><a href="#">Edit User</a></li>						                        
						</ul> 					
				</div>
                   
                   
                    
                </div>
			</div> -->
			<div class="app-content">
					<section class="section">
						<div class="row">
							<div class="col-sm-3 col-md-3 col-xs-2">
								<ol class=" breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>nav/manage_user/<?= $no ?>">Manage User</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit	User</li>
								</ol>
							</div>
							<div class="col-sm-9 col-md-9 col-xs-4">
								<button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;" onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i>
									</button>
							</div> 
						</div> 

				<?php 
				if(isset($user))
				{
					foreach($user as $obj)
					{
					
				?>
                <!-- product layout -->
				<div class="row" style="margin-top:-12px">
				
				<?php
					$usertype=''; $color = '';
					if($obj->MUM_User_type == 1){ $usertype = 'Admin'; $color = 'style="color:green"';}
					if($obj->MUM_User_type == 4){ $usertype = 'Artist'; $color = 'style="color:blue"';}

				?>
				<div class="col-lg-6 col-md-12 col-sm-12">
					<div class="card">
						<div class="card-header">
							<h4>User Details</h4>
						</div>
						<div class="card-body">
							<p><b>User ID :</b> <?php if($obj->MUM_ID) echo $obj->MUM_ID;?></p>
							<p><b>User Type :</b> <?php echo $usertype;?></p>
							<p><b>Company  :</b> <?php if($obj->MUM_Comp_Name) echo $obj->MUM_Comp_Name;?></p>
							<p><b>Contact Person  :</b> <?php if($obj->MUM_Full_name) echo $obj->MUM_Full_name;?></p>
							<p><b>Login Status :</b> <?php if($obj->MUM_login_status){echo "Active";} else { echo "In-Active"; }?> </p>
							<p><b>User Status :</b> <?php if($obj->MUM_status){echo "Active";} else { echo "In-Active"; }?> </p>
							<p><b>Reg. Date : </b> <?php echo date("d-F-Y l", strtotime($obj->MUM_CreatedDate));?> </p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>User	Profile</h4>
									</div>
									
									
									<div	class="row">
										<div	class="col-md-6">
											<div class="card-body">
												<p><b>Person Name :</b> <?php echo $obj->MUM_Full_name;?></p>
												<p><b>Company Name:</b> <?php echo $obj->MUM_Comp_Name;?></p>
												<p><b>Address :</b> <?php echo $obj->MUM_Add;?></p>
												<p><b>City :</b> <?php echo $obj->MUM_City;?></p>
												<p><b>Country :</b> <?php echo $obj->MUM_Country;?></p>
												<p><b>Zip Code :</b> <?php echo $obj->MUM_ZippCode;?></p>
											</div>
										</div>
										
										<div	class="col-md-6">
											<div class="card-body">
											
												<p><b>Phone :</b> <?php echo $obj->MUM_Phone;?> </p>
												<p><b>Email (Primary) : </b> <?php echo $obj->MUM_Email;?></p>
												<p><b>Email (Alt) : </b> <?php echo $obj->MUM_alt_email;?> </p>
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div	class="row">
							<div	class="col-md-4">
								<div class="card">
									<div class="card-header">
										<h4>Login	Details</h4>
									</div>
									<div class="card-body">
										<p><b>Username :</b> <?php echo $obj->MUM_Email;?> </p>
										<p><b>Password : </b> ****** </p>

										<div class="">
										<!-- <button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-3">Send </button> -->
										<a href="#!" id="sendemail" class="btn btn-primary btn-primary-1 mt-3 mb-3" >Send Email</a>
												<span class="mailloader" style="display:none;" ><img style="max-width:200px;" src="<?php echo base_url().'public/img1/spinner2.gif';?>" alt="Img" title="Img" class="img-circle"></span	>
									</div>
									</div>
								</div>
							</div>
							<div	class="col-md-4">
								<div class="card">
									<div class="card-header">
										<h4>Edit	Details</h4>
									</div>
									<div class="card-body	text-center">
										<!-- <button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-3">Edit </button> -->
										<a href="<?php echo base_url()?>index.php/User/edit_admin_user_profile/<?php echo $edit_id;?>/1/<?php echo $obj->MUM_User_type;?>" class="btn btn-primary btn-primary-1 mt-3 mb-3">Edit Details</a>
									</div>
								</div>
							</div>
							<div	class="col-md-4">
							
								<div class="card">
									<div class="card-header">
										<h4>Leaves</h4>
									</div>
									<div class="card-body	text-center">
										<!-- <button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-3">Send </button> -->
										<?php if ($obj->MUM_User_type == 1 || $obj->MUM_User_type == 4){?>
												<?php if ((in_array("Apply Leave", $pagemodify)) && $usid == $edit_id) { ?>
												<a href="<?php echo base_url()?>index.php/Leaves/manage_leaves" class="btn btn-primary btn-primary-1 mt-3 mb-3" >Apply Leave</a>
												<span class="mailloader" style="display:none;" ><img style="max-width:200px;" src="<?php echo base_url().'public/img1/spinner2.gif';?>" alt="Img" title="Img" class="img-circle"></span	>
										<?php }?>
										<?php }?>
										<?php if ($usid == 1 && $usid == $edit_id) { ?>
											<a href="<?php echo base_url()?>index.php/Leaves/approve_leaves" class="btn btn-primary btn-primary-1 mt-3 mb-3" >Approve Leave</a>
											<span class="mailloader" style="display:none;" ><img style="max-width:200px;" src="<?php echo base_url().'public/img1/spinner2.gif';?>" alt="Img" title="Img" class="img-circle"></span	>
										<?php }?>
											</div>
								</div>
							</div>
						</div>



                    

                     
				<!-- </div> -->
                <!-- End of product layout -->
				<?php 
	
	}
	}
	?>
	
	<!-- Modal -->
	
	<style>

    .a,

    h4 {

        color: #666;

    }

    .table>thead>tr>th,

    .table>tbody>tr>th,

    .table>tfoot>tr>th,

    .table>thead>tr>td,

    .table>tbody>tr>td,

    .table>tfoot>tr>td {

        padding: 8px;

        line-height: 1.28857143;

        vertical-align: top;

        border-top: none;

    }

</style>	
 <?php include('footer.php');
// echo my_file1('web/custom/jquery-ui-1.12.1.custom/jquery-ui.min',2);
// echo my_file1('web/custom/jquery-ui-1.12.1.custom/jquery-ui.min',1);
 ?>

<script>
	//$("#delevery_schedule").datepicker({ format: 'yyyy/mm/dd',setDate : new Date(), });
	var date = new Date();
	var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
	var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

	$('#delevery_schedule').datepicker({
		format: "yyyy/mm/dd",
		todayHighlight: true,
	});
	$('#delevery_date').datepicker({
		format: "yyyy/mm/dd",
		todayHighlight: true,
	});
	
	

$("#sendemail").click(function(){
	
		$(".mailloader").css("display","block");
		var isok = 0;
		var pass = confirm("Do you want to send email?");
		if(pass != '')
		{
			
			var adminuid = '<?php echo $obj->MUM_ID; ?>';
			var adminemail = '<?php echo $obj->MUM_Email; ?>';
			var adminpassword = '<?php echo base64_decode($obj->MUM_Passcode); ?>';
			var adminname = '<?php echo $obj->MUM_Full_name; ?>';
			var adminphone = '<?php echo $obj->MUM_Phone; ?>';
			$.ajax({
				type : "POST",
				url : CI_ROOT+'User/resendmail',
				async: false,
				data :{
					adminuid : adminuid,
					adminemail : adminemail,
					adminpassword : adminpassword,
					adminname : adminname,
					adminphone : adminphone
				},
				success : function(result)
				{
					
					if(result == 1){
					alert("Mail Sent!");
					isok = 1;
					}
					else{
					alert("Mail Not Sent!");
					isok = 0;
					}
				$(".mailloader").css("display","none");
				}
			}); 
		
		}
	else{
		alert("Mail Not Sent!");
		isok = 0;
	}
	
	if(isok == 0)
	{
		
		return false;
	}
	else{
	
		return true;
	}
	});	
		
		
		
 </script>