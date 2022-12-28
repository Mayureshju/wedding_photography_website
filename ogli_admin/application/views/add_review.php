<?php include 'header.php'; ?>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
</style>
<div class="app-content">
    <section class="section">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-xs-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_review/<?php echo $no;?>">Manage Review</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Add Review</li>
                </ol>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-4">
                <button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;" onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
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
                        <form action="<?php echo base_url() ?>Review/add_review_data" method="post"  data-parsley-validate class="form-horizontal " enctype="multipart/form-data">  
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="MRV_rating">Rating</label>    
                                        <div class="rate">
                                            <input type="radio" id="star5" name="MRV_rating" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="MRV_rating" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="MRV_rating" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="MRV_rating" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="MRV_rating" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>                            
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="MRV_review_title">Title</label>    
                                        <input name="MRV_review_title" class="form-control" type="text">                             
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="MRV_review">Review</label>    
                                        <textarea name="MRV_review" rows="4" cols="5" class="form-control" type="text"></textarea>                            
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="MRV_name">Your Name</label>    
                                        <input name="MRV_name" class="form-control" type="text">                             
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-0 overflow-hidden mt-4 pt-2"></div>
                                    <div class="form-group mb-0 overflow-hidden mt-5">
                                        <label for="MRV_email">Email</label>    
                                        <input name="MRV_email" class="form-control" type="text">                             
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="MRV_phone">Mobile No</label>    
                                        <input name="MRV_phone" class="form-control" type="text">                             
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-4">
                                        <label style="padding-top:12px;" >Status</label>  
                                        <label class="custom-switch" style="margin-left: 20px;">
                                            <input type="checkbox" value="1" name="MRV_status" id="status" class="custom-switch-input" <?php if(!empty($webfaq[0])){ echo ($webfaq[0]->MPC_status =='1')?'checked':''; } ?> >
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
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