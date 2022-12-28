<?php include 'header.php'; ?>
<div class="app-content">
	<section class="section">
		<div class="row">
			<div class="col-sm-3 col-md-3 col-xs-2">
				<ol class=" breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_portfolio/<?= $no;?>">Manage
							Portfolio</a></li>
					<li class="breadcrumb-item active" aria-current="page">Add Portfolio</li>
				</ol>
			</div>
			<div class="col-sm-9 col-md-9 col-xs-4">
				<button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;"
					onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i>
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


						<form action="<?php echo base_url()?>Product/add_portfolio_data" method="post" id="demo-form2"
							data-parsley-validate class="form-horizontal " enctype="multipart/form-data">

							<div class="row">

								<div class="col-md-6 col-xs-12 col-sm-12">

									<div class="form-group">
										<label for="MC_page_name">Page Name</label>
										<select class="form-control select2 w-100" name="MC_page_name" id="MC_page_name"
											style="width:100%;">
											<option value="">Select Page Name</option>
											<option value="residential">Photography</option>
											<!-- <option value="restaurant">Restaurant</option>
											<option value="commercial">Commercial</option>
											<option value="architecture">Architecture</option> -->
										</select>
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="pname">Portfolio Name *</label>
										<input id="pname" name="pname" class="form-control" required="required"
											type="text">
									</div>
									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="purl">Portfolio URL *</label>
										<input id="purl" name="purl" class="form-control" required="required"
											type="text">
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="pYear">Year</label>
										<input id="pYear" name="pYear" class="form-control"
											type="text">
									</div>
									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="pBudget">Budget</label>
										<input id="pBudget" name="pBudget" class="form-control"
											type="text">
									</div>

								</div>
								<div class="col-md-6 col-xs-12 col-sm-12">

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label>Portfolio Image</label><br>
										<label><input type="file" class="form-control" name="pimages[]"
												aria-describedby="fileHelp" onchange="readURLbanr1(this);"
												accept="image/png, image/jpeg , image/JPEG, image/PNG" multiple /> </label><br />
										<font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size(); ?>
											MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
										<p>&nbsp;</p>
										<img id="blahbanr1" src="">
									</div>

									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="pConfiguration">Configuration</label>
										<textarea rows="10" cols="10" id="pConfiguration" name="pConfiguration" class="form-control"
											type="text"></textarea>
									</div>
									

								</div>

								</div class="col-lg-12">
									<div class="form-group mb-0 overflow-hidden mt-4">
										<label for="pdesc">Portfolio Description</label>
										<textarea id="editor" class="form-control" name="pdesc"></textarea>
									</div>

									<div class="form-group mb-0 overflow-hidden">
										<label>Status</label>
										<label class="custom-switch" style="margin-left: 20px;margin-top:10px;">
											<input type="checkbox" name="status" id="status"
												class="custom-switch-input">
											<span class="custom-switch-indicator"></span>
										</label>
									</div>


								</div>

							</div>


							<div class="col-md-12 col-xs-12 col-sm-12" style="text-align:center;">
								<hr />
								<div class="box-footer">
									<?php if(in_array("Product",$pagemodify)){?>
									<div class="form-group mb-0 overflow-hidden mt-4">
										<div class="col-md-6 col-sm-4 col-xs-12 col-md-offset-3">
											<button type="submit"
												class="btn btn-primary btn-primary-1 mt-3 mb-0">Submit</button>
										</div>
									</div>
									<?php }?>
								</div>
							</div>




						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End of product layout -->
		<?php include('footer.php');?>
		<script> CI_ROOT = '<?php echo base_url()?>'; </script>

		<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
//echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
//echo my_file1('web/custom/product',2);
?>