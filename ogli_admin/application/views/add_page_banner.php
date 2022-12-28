<?php include 'header.php'; ?>
<div class="app-content">
    <section class="section">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-xs-2">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="<?php //echo base_url(); ?>Nav/manage_faq/<?php echo $no; ?>">Manage Banners</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page"> Manage Pages Banners</li>
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
                                                                        else echo 'display:none'; ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                <?php if ($this->session->flashdata('success')) echo $this->session->flashdata('success'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <form action="<?php echo base_url() ?>Page_banner/add_pages_banner" method="post" data-parsley-validate class="form-horizontal " enctype="multipart/form-data">
                            
                            <!-- residential start -->
                            
                            <div class="row">
                                <div class="col-12">
                                    <h5 style="margin: 28px 0px 0px 0px;font-weight: 600;">Photography <i class="fa fa-angle-double-right" aria-hidden="true"></i></h5>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Banner</b></label>
                                        <input type="file" name="residential_banner" id="input-file-now-custom-1" value="<?php if(!empty($data[0]->Mpg_bnr_residential_banner)){ echo $data[0]->Mpg_bnr_residential_banner;  } ?>" class="dropify" data-default-file="<?php if(!empty($data[0]->Mpg_bnr_residential_banner)){ echo base_url(); ?>uploads/pagesbanner/<?= $data[0]->Mpg_bnr_residential_banner;  } ?>" /> 
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Side Image</b></label>
                                        <input type="file" name="residential_side_image" id="input-file-now-custom-1" value="<?php if(!empty($data[0]->Mpg_bnr_residential_side_image)){ echo $data[0]->Mpg_bnr_residential_side_image;  } ?>" class="dropify" data-default-file="<?php if(!empty($data[0]->Mpg_bnr_residential_side_image)){ echo base_url(); ?>uploads/pagesbanner/<?= $data[0]->Mpg_bnr_residential_side_image;  } ?>" /> 
                                    </div>
                                </div>
                            </div>

                            <!-- restaurant start -->

                            <div class="row">
                                <div class="col-12">
                                    <h5 style="margin: 28px 0px 0px 0px;font-weight: 600;">Vedioghaphy <i class="fa fa-angle-double-right" aria-hidden="true"></i></h5>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Banner</b></label>
                                        <input type="file" name="restaurant_banner" id="input-file-now-custom-1" value="<?php if(!empty($data[0]->Mpg_bnr_restaurant_banner)){ echo $data[0]->Mpg_bnr_restaurant_banner;  } ?>" class="dropify" data-default-file="<?php if(!empty($data[0]->Mpg_bnr_restaurant_banner)){ echo base_url(); ?>uploads/pagesbanner/<?= $data[0]->Mpg_bnr_restaurant_banner;  } ?>" /> 
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Side Image</b></label>
                                        <input type="file" name="restaurant_side_image" id="input-file-now-custom-1" value="<?php if(!empty($data[0]->Mpg_bnr_restaurant_side_image)){ echo $data[0]->Mpg_bnr_restaurant_side_image;  } ?>" class="dropify" data-default-file="<?php if(!empty($data[0]->Mpg_bnr_restaurant_side_image)){ echo base_url(); ?>uploads/pagesbanner/<?= $data[0]->Mpg_bnr_restaurant_side_image;  } ?>" /> 
                                    </div>
                                </div>
                            </div>

                            <!-- COMMERCIAL start -->

                              <div class="row">
                                <div class="col-12">
                                    <h5 style="margin: 28px 0px 0px 0px;font-weight: 600;">Editing <i class="fa fa-angle-double-right" aria-hidden="true"></i></h5>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Banner</b></label>
                                        <input type="file" name="commercial_banner" id="input-file-now-custom-1" value="<?php if(!empty($data[0]->Mpg_bnr_commercial_banner)){ echo $data[0]->Mpg_bnr_commercial_banner;  } ?>" class="dropify" data-default-file="<?php if(!empty($data[0]->Mpg_bnr_commercial_banner)){ echo base_url(); ?>uploads/pagesbanner/<?= $data[0]->Mpg_bnr_commercial_banner;  } ?>" /> 
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Side Image</b></label>
                                        <input type="file" name="commercial_side_image" id="input-file-now-custom-1" value="<?php if(!empty($data[0]->Mpg_bnr_commercial_side_image)){ echo $data[0]->Mpg_bnr_commercial_side_image;  } ?>" class="dropify" data-default-file="<?php if(!empty($data[0]->Mpg_bnr_commercial_side_image)){ echo base_url(); ?>uploads/pagesbanner/<?= $data[0]->Mpg_bnr_commercial_side_image;  } ?>" /> 
                                    </div>
                                </div>
                            </div>

                            <!-- ARCHITECTURE start -->

                            <div class="row">
                                <div class="col-12">
                                    <h5 style="margin: 28px 0px 0px 0px;font-weight: 600;">Album <i class="fa fa-angle-double-right" aria-hidden="true"></i></h5>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Banner</b></label>
                                        <input type="file" name="architecture_banner" id="input-file-now-custom-1" value="<?php if(!empty($data[0]->Mpg_bnr_architecture_banner)){ echo $data[0]->Mpg_bnr_architecture_banner;  } ?>" class="dropify" data-default-file="<?php if(!empty($data[0]->Mpg_bnr_architecture_banner)){ echo base_url(); ?>uploads/pagesbanner/<?= $data[0]->Mpg_bnr_architecture_banner;  } ?>" /> 
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Side Image</b></label>
                                        <input type="file" name="architecture_side_image" id="input-file-now-custom-1" value="<?php if(!empty($data[0]->Mpg_bnr_architecture_side_image)){ echo $data[0]->Mpg_bnr_architecture_side_image;  } ?>" class="dropify" data-default-file="<?php if(!empty($data[0]->Mpg_bnr_architecture_side_image)){ echo base_url(); ?>uploads/pagesbanner/<?= $data[0]->Mpg_bnr_architecture_side_image;  } ?>" /> 
                                    </div>
                                </div>
                            </div>

                            <!-- CONTACT start -->

                            <div class="row">
                                <div class="col-12">
                                    <h5 style="margin: 28px 0px 0px 0px;font-weight: 600;">CONTACT <i class="fa fa-angle-double-right" aria-hidden="true"></i></h5>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Banner</b></label>
                                        <input type="file" name="contact_banner" id="input-file-now-custom-1" value="<?php if(!empty($data[0]->Mpg_bnr_contact_banner)){ echo $data[0]->Mpg_bnr_contact_banner;  } ?>" class="dropify" data-default-file="<?php if(!empty($data[0]->Mpg_bnr_contact_banner)){ echo base_url(); ?>uploads/pagesbanner/<?= $data[0]->Mpg_bnr_contact_banner;  } ?>" /> 
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Side Image</b></label>
                                        <input type="file" name="contact_side_image" id="input-file-now-custom-1" value="<?php if(!empty($data[0]->Mpg_bnr_contact_side_image)){ echo $data[0]->Mpg_bnr_contact_side_image;  } ?>" class="dropify" data-default-file="<?php if(!empty($data[0]->Mpg_bnr_contact_side_image)){ echo base_url(); ?>uploads/pagesbanner/<?= $data[0]->Mpg_bnr_contact_side_image;  } ?>" /> 
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-0">Submit </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<?php include('footer.php'); ?>