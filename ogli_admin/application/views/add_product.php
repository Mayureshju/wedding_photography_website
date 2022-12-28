<?php include 'header.php'; ?>
<div class="app-content">
  <section class="section">
    <div class="row">
      <div class="col-sm-3 col-md-3 col-xs-2">
        <ol class=" breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_Product/<?= $no;?>">Manage Tattoo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Tattoo</li>
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
    <div class="row">
      <div class="col-12">
        <div class="card overflow-hidden">
          <div class="card-body">


				<form action="<?php echo base_url()?>Product/add_product_data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal " enctype="multipart/form-data">
					
				<div class="row">  
					
				<div class="col-md-6 col-xs-12 col-sm-12"> 
					
					<div class="form-group mb-0 overflow-hidden mt-3">
					<label for="ncatid"> Category *
					</label>
					<?php $ncid =  set_value('ncatid'); ?>
						<select class="form-control select2 w-100" name="ncatid"  required="required" id="ncatid" style="width:100%;">											
						<option value="">Select  Category</option>
						<?php 				
						$getncat = get_list('mov_niche_category','MNC_cat_id,MNC_cat_name',"MNC_cat_status = '1' ORDER BY MNC_cat_name ASC");
						if($getncat){
						foreach($getncat as $getncatdata)	{	 ?>												
							<option value="<?php echo $getncatdata->MNC_cat_id; ?>" <?php if($ncid == $getncatdata->MNC_cat_id) echo 'selected';?>><?php echo ucwords($getncatdata->MNC_cat_name); ?></option>
						<?php } } else {?>  
							<option value="<?php echo  set_value('ncatid'); ?>">No Data</option>  
						<?php }?>	
						</select>
				</div>	
				
				<div class="form-group mb-0 overflow-hidden mt-4">
					<label for="pname">Tattoo Name *</label>  
					<input id="pname" name="pname" class="form-control"  required="required" type="text" value="<?php echo  set_value('pname'); ?>">
				</div>
					
				<div class="form-group mb-0 overflow-hidden mt-4">
					<label for="admindesc">Tattoo Description (For Admin) </label>
					<textarea id="admindesc" class="form-control"  name="admindesc"><?php echo  set_value('admindesc'); ?></textarea>
				</div>
					
				<div class="form-group mb-0 overflow-hidden mt-4">
					<label for="clientdesc">Tattoo Description (For Client) *</label>
					<textarea id="clientdesc" class="form-control" required="required" name="clientdesc"><?php echo  set_value('clientdesc'); ?></textarea>
				</div>
					
					
				<div class="form-group mb-0 overflow-hidden mt-4">
					<label for="tncpolicy">Tattoo Terms And Condition </label>
					<textarea id="tncpolicy" class="form-control"  name="tncpolicy"><?php echo  set_value('tncpolicy'); ?></textarea>
				</div>
						
				
			</div>
			<div class="col-md-6 col-xs-12 col-sm-12">
				
				<div class="form-group mb-0 overflow-hidden mt-3">
					<label for="costprice">Price (Admin) *</label>    
					<input id="costprice" name="costprice" required="required" class="form-control" type="number" value="<?php echo  set_value('costprice'); ?>">                             
				</div>
				
				<div class="form-group mb-0 overflow-hidden mt-4">
					<label for="currentprice">Price (Customer) *</label>    
					<input id="currentprice" name="currentprice"  required="required" class="form-control" type="number" value="<?php echo  set_value('currentprice'); ?>">                         
				</div>
				
				<div class="form-group mb-0 overflow-hidden mt-4">
						<label style="padding-top:12px;" >Show on Front</label>	
						<label class="custom-switch" style="margin-left: 20px;">
							<input type="checkbox"name="showonfront" id="showonfront" class="custom-switch-input">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>
				
					<div class="form-group mb-0 overflow-hidden mt-4">
						<label style="padding-top:12px;" >Trending</label>	
						<label class="custom-switch" style="margin-left: 20px;">
							<input type="checkbox"name="trending" id="trending" class="custom-switch-input">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>
				
					<div class="form-group">
						<label style="padding-top:12px;" >Status</label>	
						<label class="custom-switch" style="margin-left: 20px;margin-top:10px;">
							<input type="checkbox"name="status" id="status" class="custom-switch-input">
							<span class="custom-switch-indicator"></span>
						</label>
					</div>
								
				</div>
				
			</div>
					
			<div class="row"> 
			<hr/>
					<br/>
					<div class="col-md-4 col-xs-12 col-sm-12"> 
					<div class="form-group mb-0 overflow-hidden mt-4">
					<label>Tattoo Image 1</label>
					<!-- <div class="col-md-8 col-sm-8 col-xs-12"> -->
						<label><input type="file" class="form-control" name="tattoo1" aria-describedby="fileHelp" onchange="readURLbanr1(this);" value="<?php echo set_value('tattoo1'); ?>" accept="image/png, image/jpeg , image/JPEG, image/PNG" /> </label><br />
						<font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size(); ?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
						<p>&nbsp;</p>
						<img id="blahbanr1" src="">

					<!-- </div> -->
				</div>
				</div>
					<div class="col-md-4 col-xs-12 col-sm-12"> 
					<div class="form-group mb-0 overflow-hidden mt-4">
					<label>Tattoo Image 2</label>
					<!-- <div class="col-md-8 col-sm-8 col-xs-12"> -->
						<label><input type="file" class="form-control" name="tattoo2" aria-describedby="fileHelp" onchange="readURLbanr2(this);" value="<?php echo set_value('tattoo2'); ?>" accept="image/png, image/jpeg , image/JPEG, image/PNG" /> </label><br />
						<font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size(); ?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
						<p>&nbsp;</p>
						<img id="blahbanr2" src="">

					<!-- </div> -->
				</div>
				</div>
					<div class="col-md-4 col-xs-12 col-sm-12"> 
						<div class="form-group mb-0 overflow-hidden mt-4">
							<label>Tattoo Image 3</label>
							<!-- <div class="col-md-8 col-sm-8 col-xs-12"> -->
								<label><input type="file" class="form-control" name="tattoo3" aria-describedby="fileHelp" onchange="readURLbanr3(this);" value="<?php echo set_value('tattoo3'); ?>" accept="image/png, image/jpeg , image/JPEG, image/PNG" /> </label><br />
								<font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size(); ?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
								<p>&nbsp;</p>
								<img id="blahbanr3" src="">

							<!-- </div> -->
						</div>
					</div>
				
			</div>		
				
			<div class="col-md-12 col-xs-12 col-sm-12" style="text-align:center;"> 
				<hr/>
				<div class="box-footer">
					<?php if(in_array("Product",$pagemodify)){?>
						<div class="form-group mb-0 overflow-hidden mt-4">
							<div class="col-md-6 col-sm-4 col-xs-12 col-md-offset-3">
							<button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Submit</button>
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
echo my_file1('web/custom/product',2);
?>


 