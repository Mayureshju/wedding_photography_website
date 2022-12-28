<?php include 'header.php'; ?>
<div class="app-content">
    <section class="section">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-xs-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_appt_letter/<?php echo $no;?>">Manage Letter</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Add Page</li>
                </ol>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-4">
                <button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;" onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="alert alert-danger alert-dismissible" style="<?php if ($this->session->flashdata('error')) echo 'display:block'; else echo 'display:none'; ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                <?php if ($this->session->flashdata('error')) echo $this->session->flashdata('error'); ?>
            </div>
            <div class="alert alert-success alert-dismissible" style="<?php if ($this->session->flashdata('success')) echo 'display:block'; else echo 'display:none'; ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                <?php if ($this->session->flashdata('success')) echo $this->session->flashdata('success'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <form action="<?php echo base_url() ?>Appointmentletter/add_appt_letter_data" method="post"  data-parsley-validate class="form-horizontal " enctype="multipart/form-data">  
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle">Name</label>
                                        <input name="Ml_name" class="form-control" type="text">                             
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metakeyword">Joining Date</label>
                                        <input class="form-control" id="joining_date" name="Ml_joining_date"></textarea>
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metakeyword">Letter Description</label>
                                        <textarea class="form-control inputheight" rows="5" name="Ml_description"></textarea>
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metakeyword">Salary</label>
                                        <input class="form-control" type="number" name="Ml_salary">
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-4">
                                        <label style="padding-top:12px;" >Status</label>  
                                        <label class="custom-switch" style="margin-left: 20px;">
                                        <input type="checkbox" value="1" name="Ml_status" id="status" class="custom-switch-input" <?php if(!empty($webfaq[0])){ echo ($webfaq[0]->MPC_status =='1')?'checked':''; } ?> >
                                        <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                
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

<script>
 $('#joining_date').datepicker({
    format:"yyyy-mm-dd",
    autoclose: true
});
</script>