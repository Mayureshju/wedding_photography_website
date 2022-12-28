<?php include 'header.php'; ?>
<div class="app-content">
    <section class="section">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-xs-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_influencer/<?php echo $no;?>">Manage Influencer</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Add Influencer</li>
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
                        <form action="<?php echo base_url() ?>Influencer/add_influencer_data" method="post"  data-parsley-validate class="form-horizontal " enctype="multipart/form-data">  
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="Mflnc_name">Influence Name</label>    
                                        <input name="Mflnc_name" class="form-control" type="text">                             
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="MNC_cat_id">Category</label>
                                        <?php $MNC_cat_id =  set_value('MNC_cat_id'); ?>
                                        <select class="form-control select2" name="MNC_cat_id" id="MNC_cat_id" style="width:100%;">											
                                            <option value="">Select Category</option>                                
                                                <?php  $getscat = get_list('mov_lov','ML_ID,ML_LOV_Value,ML_LOV_Type',"ML_LOV_Status = '1' and ML_LOV_Name like '%Influencer Category%' ");
                                                if($getscat){ foreach($getscat as $getscatdata)	{								
                                                    ?>
                                                <option value="<?php echo $getscatdata->ML_ID; ?>" <?php if(!empty($MNC_cat_id)){ if($getscatdata->ML_ID == $MNC_cat_id) echo 'selected'; }?>><?php echo $getscatdata->ML_LOV_Value; ?></option>
                                                <?php  } } else {?>  
                                                    <option value="<?php echo  set_value('MNC_cat_id'); ?>">No Data</option>  
                                                <?php }?>
                                        </select>                             
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="Mprm_ID">Promocode</label>
                                        <select class="form-control select2" name="Mprm_ID" id="Mprm_ID" style="width:100%;">											
                                            <option value="">Select Promocode</option>
                                            <?php 
                                            $getspromo = get_list('mov_promocode','Mprm_ID,Mprm_PromoCode',"Mprm_Status = '1' ORDER BY Mprm_PromoCode ASC");
                                            if(isset($getscat)){
                                                foreach($getspromo as $getspromodata)	{ ?>
                                                    <option value="<?php echo $getspromodata->Mprm_ID; ?>"><?php echo ucwords($getspromodata->Mprm_PromoCode); ?></option>  
                                                <?php } 
                                            } ?>
                                        </select>  
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-4">
                                        <label style="padding-top:12px;" >Status</label>  
                                        <label class="custom-switch" style="margin-left: 20px;">
                                            <input type="checkbox" value="1" name="Mflnc_cat_status" id="status" class="custom-switch-input" <?php if(!empty($webfaq[0])){ echo ($webfaq[0]->MPC_status =='1')?'checked':''; } ?> >
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