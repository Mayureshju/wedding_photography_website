<?php include 'header.php'; ?>
<div class="app-content">
  <section class="section">
  <div class="row">
		<div class="col-sm-3 col-md-3 col-xs-2">
      <ol class="breadcrumb">
      <?php $serachurl = isset($searchval) ? $searchval : 'bm8=';?>
              <?php $pageurl = isset($pageval) ? $pageval : '0'; ?>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_product/<?= $serachurl ?>/<?= $pageurl ?>">Manage Tattoo</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Tattoo</li>
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

			<?php 
				//print_r($editsite);
					if(isset($editproject))
					{
						foreach($editproject as $key => $val)
						{
							?>
				<form action="<?php echo base_url()?>Product/edit_product_data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
					<input type="hidden" name="editid" id="editid" value="<?php echo $val->MP_ProID;?>">
					<input type="hidden" name="search" value="<?= $serachurl ?>">
					<input type="hidden" name="page" value="<?= $pageurl ?>">
									
					<div class="row">  
								
						<div class="col-md-6 col-xs-12 col-sm-12"> 
									
							<div class="form-group mb-0 overflow-hidden mt-3">
								<label for="ncatid"> Category *</label>
								<select class="form-control select2" name="ncatid" id="ncatid" style="width:100%;">											
									<option value="">Select Category</option>
									<?php 				
									$getncat = get_list('mov_niche_category','MNC_cat_id,MNC_cat_name',"MNC_cat_status = '1' ORDER BY MNC_cat_name ASC");
									if($getncat){
									foreach($getncat as $getncatdata)	{	 
										if($getncatdata->MNC_cat_id == $val->MNC_cat_id){ ?>												
											<option value="<?php echo $getncatdata->MNC_cat_id; ?>" selected ><?php echo ucwords($getncatdata->MNC_cat_name); ?></option>  
											<?php }else { ?>											
											<option value="<?php echo $getncatdata->MNC_cat_id; ?>"><?php echo ucwords($getncatdata->MNC_cat_name); ?></option> 
											<?php } } } else {?>  
											<option value="">No Data</option>  
									<?php }?>	
									</select>
							</div>	
                               
                                <div class="form-group mb-0 overflow-hidden mt-4">
									<label for="pname">Tattoo Name *</label>
                                    <input id="pname" name="pname" class="form-control"  required="required" type="text" value="<?php echo $val->MP_Product_Name; ?>">                             
                                  </div>
                                  
								<div class="form-group mb-0 overflow-hidden mt-4">
									<label for="admindesc">Tattoo Description (For Admin) </label>
									  <textarea id="admindesc" class="form-control"  name="admindesc"><?php echo $val->MP_Product_Desc_Admin; ?></textarea>
								  </div>
                                   
								<div class="form-group mb-0 overflow-hidden mt-4">
									<label for="clientdesc">Tattoo Description (For Client) *</label>
									  <textarea id="clientdesc" class="form-control" required="required" name="clientdesc"><?php echo $val->MP_Product_Desc_Front; ?></textarea>
								  </div>
                                   
									
								<div class="form-group mb-0 overflow-hidden mt-4">
									<label for="tncpolicy">Tattoo Terms And Condition </label>
									  <textarea id="tncpolicy" class="form-control"  name="tncpolicy"><?php echo $val->MP_TnC_Policy; ?></textarea>
								  </div>
                                   		
								
                            </div>
						    <div class="col-md-6 col-xs-12 col-sm-12">
								
								<div class="form-group mb-0 overflow-hidden mt-3">
									<label for="costprice">Price (Admin) *</label>
                                    <input id="costprice" name="costprice" required="required" class="form-control" type="number" value="<?php echo $val->MP_Cost_Price; ?>">                             
                                  </div>
								
								<div class="form-group mb-0 overflow-hidden mt-4">
									<label for="currentprice">Price (Customer) *</label>    
                                    <input id="currentprice" name="currentprice"  required="required" class="form-control" type="number" value="<?php echo $val->MP_Current_Price; ?>">                             
                                  </div>
								
								<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;" >Show on Front</label>	
										<label class="custom-switch" style="margin-left: 20px;">
											<input type="checkbox"name="showonfront" id="showonfront" class="custom-switch-input" <?php if($val->MP_Show_OnHome == 1){ echo 'Checked/'; }?>>
											<span class="custom-switch-indicator"></span>
										</label>
								   </div>
								
									<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;" >Trending</label>	
										<label class="custom-switch" style="margin-left: 20px;">
											<input type="checkbox"name="trending" id="trending" class="custom-switch-input" <?php if($val->MP_Hot_Offers == 1){ echo 'Checked/'; }?>>
											<span class="custom-switch-indicator"></span>
										</label>
								   </div>
								
									<div class="form-group mb-0 overflow-hidden mt-4">
										<label style="padding-top:12px;" >Status</label>	
										<label class="custom-switch" style="margin-left: 20px;margin-top:10px;">
											<input type="checkbox"name="status" id="status" class="custom-switch-input" <?php if($val->MP_status == 1){ echo 'Checked/'; }?>>
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
                                    <label>Tattoo Image 1 </label>
                                        <label><input type="file" class="form-control" name="tattoo1" aria-describedby="fileHelp" onchange="readURLbanr1(this);" value="<?php echo set_value('tattoo1'); ?>" accept="image/png, image/jpeg , image/JPEG, image/PNG" /> </label><br />
                                        <font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size(); ?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
										<p>&nbsp;</p>
                                        <?php if($val->MP_Image_1 !='') {
												$img_folder = 'product-images/';
												$external_link = IMAGE_PATH . $img_folder . $val->MP_Image_1;
												if (@getimagesize($external_link)) {
													$get_cat_logo = $val->MP_Image_1;
												} else {
													$get_cat_logo = 'no-image.jpg';
												}
												?>
											<img id="blahbanr1" src="<?php echo IMAGE_PATH . $img_folder . $get_cat_logo; ?>" style="width: 100px; height: 100px;">
											<?php } else {?>
												<img id="blahbanr1" src="">
											<?php } ?>
                                	</div>
								</div>
								
								 <div class="col-md-4 col-xs-12 col-sm-12"> 
								  <div class="form-group mb-0 overflow-hidden mt-4">
                                    <label>Tattoo Image 2</label>
                                        <label><input type="file" class="form-control" name="tattoo2" aria-describedby="fileHelp" onchange="readURLbanr2(this);" value="<?php echo set_value('tattoo2'); ?>" accept="image/png, image/jpeg , image/JPEG, image/PNG" /> </label><br />
                                        <font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size(); ?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
										<p>&nbsp;</p>
                                       <?php if($val->MP_Image_2 !='') {
												$img_folder = 'product-images/';
												$external_link = IMAGE_PATH . $img_folder . $val->MP_Image_2;
												if (@getimagesize($external_link)) {
													$get_cat_logo = $val->MP_Image_2;
												} else {
													$get_cat_logo = 'no-image.jpg';
												}
												?>
											<img id="blahbanr2" src="<?php echo IMAGE_PATH . $img_folder . $get_cat_logo; ?>" style="width: 100px; height: 100px;">
											<?php } else {?>
												<img id="blahbanr2" src="">
											<?php } ?>
                                	</div>
								</div>
								
								 <div class="col-md-4 col-xs-12 col-sm-12"> 
								  <div class="form-group mb-0 overflow-hidden mt-4">
                                    <label>Tattoo Image 3 </label>
                                        <label><input type="file" class="form-control" name="tattoo3" aria-describedby="fileHelp" onchange="readURLbanr3(this);" value="<?php echo set_value('tattoo3'); ?>" accept="image/png, image/jpeg , image/JPEG, image/PNG" /> </label><br />
                                        <font color="#0000FF" size="1">[ Maximum File Size : <?php echo image_size(); ?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
										<p>&nbsp;</p>
                                        <?php if($val->MP_Image_3 !='') {
												$img_folder = 'product-images/';
												$external_link = IMAGE_PATH . $img_folder . $val->MP_Image_3;
												if (@getimagesize($external_link)) {
													$get_cat_logo = $val->MP_Image_3;
												} else {
													$get_cat_logo = 'no-image.jpg';
												}
												?>
											<img id="blahbanr3" src="<?php echo IMAGE_PATH . $img_folder . $get_cat_logo; ?>" style="width: 100px; height: 100px;">
											<?php } else {?>
												<img id="blahbanr3" src="">
											<?php } ?>
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
								  <div class="ln_solid"></div>
								  

                    </form>
					<?php
									}
								}
							?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of product layout -->
				
<script type="text/javascript" src="<?php echo base_url() ; ?>assets/ckeditor/ckeditor.js"></script>		
<?php include('footer.php');?>
<script>
 CI_ROOT = '<?php echo base_url()?>index.php/';
 	
</script>
<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
//echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/product',2);
?>


 