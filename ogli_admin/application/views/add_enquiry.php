<?php include 'header.php'; ?>
<div class="app-content">
    <section class="section">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-xs-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_faq/<?php echo $no;?>">Manage Enquiry</a></li>
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
                        <form action="<?php echo base_url() ?>Enquiry/add_enquiry_data" method="post"  data-parsley-validate class="form-horizontal " enctype="multipart/form-data">
                            <div class="row basic-form--border--round--row">
                                <div class="form-group mb-0 overflow-hidden mt-3 col-lg-6">
                                    <label for="name">First Name <sup>*</sup></label>
                                    <input id="name" type="text" class="form-control">
                                </div>
                                <div class="form-group mb-0 overflow-hidden mt-3 col-lg-6">
                                    <label for="name">Last Name <sup>*</sup></label>
                                    <input id="name" name="lastname" type="text" class="form-control">
                                </div>
                                <div class="form-group mb-0 overflow-hidden mt-3 col-lg-6">
                                    <label for="name">Hotline Bling (Phone number)<sup>*</sup></label>
                                    <input id="name" name="mobile" type="text" class="form-control">
                                </div>
                                <div class="form-group mb-0 overflow-hidden mt-3 col-lg-6">
                                    <label for="mail">Email Address <sup>*</sup></label>
                                    <!-- data-error="true" to set error field -->
                                    <input id="mail" name="mail" type="email" class="form-control" data-error="false">
                                </div>
                                <div class="form-group mb-0 overflow-hidden mt-3 col-lg-6">
                                    <label for="name">City<sup>*</sup></label>
                                    <input id="name" name="city" type="text" class="form-control">
                                </div>
                                <div class="form-group mb-0 overflow-hidden mt-3 col-lg-6">
                                    <label for="MEnq_enquiry_type">Enquiry Source</label>
                                    <select id="MEnq_enquiry_type" name="MEnq_enquiry_type" type="text" class="form-control">
                                        <option value="">-- select --</option>
                                        <option value="Whats app">Whats app</option>
                                        <option value="IG Messenger">IG Messenger</option>
                                        <option value="FB Messenger">FB Messenger</option>
                                        <option value="Google Messenger">Google Messenger</option>
                                    </select>
                                </div>
                                <div class="form-group mb-0 overflow-hidden mt-3 col-lg-6">
                                    <label for="name">What have you budgeted for this tattoo?</label>
                                    <select id="name" name="budgeted" type="text" class="form-control">
                                        <option>Less than 5k</option>
                                        <option>Between 6k- 15k</option>
                                        <option>I think I can spend around 25k</option>
                                        <option>My budget is 35k- 55k.</option>
                                            <option>I just want good work. 60-80k</option>
                                            <option>Who's your best? 1L+</option>
                                    </select>
                                </div>
                                <div class="form-group mb-0 overflow-hidden mt-3 col-6">
                                    <label for="message">Describe what type of tattoo are you interested in getting.<sup>*</sup></label>
                                    <!-- data-error="true" to set error field -->
                                    <textarea id="message" rows="10" cols="10" name="message" placeholder="I'd like to get a hyper-realism tattoo from Eric. Does he have any availability in 2019?" class="form-control"></textarea>
                                </div>

                                <!-- data-active="false" is hidden, data-active="true" is visible -->
                                <!-- <div class="form-group mb-0 overflow-hidden mt-3 col-6">
                                    <p>For the error message see contact.php file</p>
                                </div> -->
                                <div class="form-group mb-0 overflow-hidden mt-3 col-6">
                                    <!-- <p>For the error message see contact.php file</p> -->
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