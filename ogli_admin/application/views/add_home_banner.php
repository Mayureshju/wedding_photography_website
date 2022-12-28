<?php include 'header.php'; ?>
<style>
    .modal {
        position: fixed;
        top: 100px;
    }

    .modal-backdrop {
        position: relative !important;
    }

    .modal-content {
        border: 1px solid rgba(0, 0, 0, .2) !important;
        -webkit-box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        box-shadow: 0 0 40px rgb(0 0 0 / 20%);
    }
</style>
<div class="app-content">
    <section class="section">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-xs-2">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="<?php //echo base_url(); 
                                                                ?>Nav/manage_faq/<?php echo $no; ?>">Manage Home Banners</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page"> Manage Banner</li>
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


        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form action="<?php echo base_url() ?>Home_banner/add_home_banner" method="post" data-parsley-validate class="form-horizontal " enctype="multipart/form-data">
                            <!-- residential start -->
                            <div class="row">
                                <div class="col-12">
                                    <h5 style="margin: 28px 0px 0px 0px;font-weight: 600;">ADD HOME BANNERS <i class="fa fa-angle-double-right" aria-hidden="true"></i></h5>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle"><b>Banner</b></label>
                                        <input type="file" name="home_banner" id="input-file-now-custom-1" class="dropify" required />
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
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <h5 style="margin: 28px 0px 0px 0px;font-weight: 600;">ALL BANNERS <i class="fa fa-angle-double-right" aria-hidden="true"></i></h5>
                            </div>
                            <div class="col-12 mt-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>S.no</td>
                                            <td>Banner Images</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($data) {
                                            $i = 1;
                                            foreach ($data as $value) {  ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><img class="img-fluid" src="<?php echo base_url(); ?>uploads/homebanner/<?= $value->Mpg_home_banner; ?>" width="70%"></td>
                                                    <td style="width: 24%;">
                                                        <button data-toggle="modal" data-target="#edit<?= $value->Mpg_home_banner_id ?>" title="Change Banner Image" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></button>
                                                        <button data-toggle="modal" data-target="#delete<?= $value->Mpg_home_banner_id ?>" title="delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                        <!-- Modal Delete -->
                                                        <div class="modal fade" id="delete<?= $value->Mpg_home_banner_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body text-center">
                                                                        <h4 class="pb-2 pt-4">Are you sure?</h4>
                                                                        <h5 class="py-4">Do you really want to delete these records? This process cannot be undone.</h5>
                                                                        <div class="row pt-3 pb-4">
                                                                            <div class="col-12">
                                                                                <form action="<?php echo base_url() ?>Home_banner/delete_home_banner" method="post">
                                                                                    <input type="hidden" value="<?= $value->Mpg_home_banner_id ?>" name="id">
                                                                                    <button value="submit" name="submit" type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                                    <button value="submit" name="submit" type="submit" class="btn btn-danger">Delete</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal Edit -->
                                                        <div class="modal fade" id="edit<?= $value->Mpg_home_banner_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form action="<?php echo base_url() ?>Home_banner/add_home_banner" method="post" data-parsley-validate class="form-horizontal " enctype="multipart/form-data">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Chnage Banner Image</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                                                                        <label for="metatitle"><b>Banner</b></label>
                                                                                        <input type="hidden" value="<?= $value->Mpg_home_banner_id ?>" name="id">
                                                                                        <input type="file" name="home_banner" id="input-file-now-custom-1" value="<?php if (!empty($data[0]->Mpg_home_banner)) {
                                                                                                                                                                        echo $data[0]->Mpg_home_banner;
                                                                                                                                                                    } ?>" class="dropify" data-default-file="<?php if (!empty($data[0]->Mpg_home_banner)) {
                                                                                                                                                                                                                                                                                                echo base_url(); ?>uploads/homebanner/<?= $data[0]->Mpg_home_banner;
                                                                                                                                                                                                                                                                                                                                                                        } ?>" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button value="submit" name="submit" type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <button value="submit" name="submit" type="submit" class="btn btn-success">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<?php include('footer.php'); ?>