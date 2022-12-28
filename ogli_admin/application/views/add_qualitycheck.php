<?php include 'header.php'; ?>
<div class="app-content">
    <section class="section">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-xs-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_quality/<?php echo $no;?>">Manage Quality</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Add Quality</li>
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
                        <form action="<?php echo base_url() ?>Qualitycheck/add_qualitycheck_data" method="post"  data-parsley-validate class="form-horizontal " enctype="multipart/form-data">  
                            <div class="row">
                                <div class="col-6">
                                    <!-- <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="Mqua_checkby">Quality Check By</label>    
                                        <select class="form-control select2" name="Mqua_checkby" id="Mqua_checkby" style="width:100%;">											
                                            <option value="">Quality Check By</option>                                
                                               <?php 
                                                // $getsData = get_list('mov_user_master','MUM_ID,MUM_Full_name',"MUM_status = '1' ORDER BY MUM_Full_name ASC");
                                                // if(isset($getsData)){
                                                //     foreach($getsData as $getsdatavalue)	{ ?>
                                                        <option value="<?php //echo $getsdatavalue->MUM_ID; ?>"><?php echo ucwords($getsdatavalue->MUM_Full_name); ?></option>  
                                                    <?php //} 
                                                //} ?>
                                        </select>                            
                                    </div> -->
                                    <?php $userid =  set_value('userid'); ?>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="MUM_ID">Select Artist</label>    
                                        <select class="form-control select2" name="MUM_ID" id="MUM_ID" style="width:100%;">											
                                            <option value="">Select Artist</option>
                                            <?php  $getscat = get_list('mov_user_master','MUM_ID,MUM_Full_name',"MUM_status='1' and (MUM_User_type = 4) ORDER BY MUM_Full_name ASC");
                                            if($getscat){ foreach($getscat as $getscatdata)	{								
                                                ?>
                                            <option value="<?php echo $getscatdata->MUM_ID; ?>" <?php if(!empty($userid)){ if($getscatdata->MUM_ID == $userid) echo 'selected'; }?>><?php echo $getscatdata->MUM_Full_name; ?></option>
                                            <?php  } } else {?>  
                                                <option value="<?php echo  set_value('userid'); ?>">No Data</option>  
                                            <?php }?>  
                                        </select>                         
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="Mqua_designation">Designation</label>    
                                        <select class="form-control select2" name="Mqua_designation" id="Mqua_designation" style="width:100%;">											
                                            <option value="">Designation</option>                                
                                                <?php  $getscat = get_list('mov_lov','ML_ID,ML_LOV_Value,ML_LOV_Type',"ML_LOV_Status = '1' and ML_LOV_Name like '%designation%' ");
                                                if($getscat){ foreach($getscat as $getscatdata)	{								
                                                    ?>
                                                <option value="<?php echo $getscatdata->ML_ID; ?>" <?php if(!empty($ML_ID)){ if($getscatdata->ML_ID == $ML_ID) echo 'selected'; }?>><?php echo $getscatdata->ML_LOV_Value; ?></option>
                                                <?php  } } else {?>  
                                                    <option value="<?php echo set_value('ML_ID'); ?>">No Data</option>  
                                                <?php }?>
                                        </select>                         
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="Mqua_number">Quality Number</label>    
                                        <input name="Mqua_number" class="form-control" type="number">                             
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="ML_ID">Department</label>
                                        <?php $ML_ID =  set_value('ML_ID'); ?>
                                        <select class="form-control select2" name="ML_ID" id="ML_ID" style="width:100%;">											
                                            <option value="">Select Department</option>                                
                                                <?php  $getscat = get_list('mov_lov','ML_ID,ML_LOV_Value,ML_LOV_Type',"ML_LOV_Status = '1' and ML_LOV_Name like '%Department%' ");
                                                if($getscat){ foreach($getscat as $getscatdata)	{								
                                                    ?>
                                                <option value="<?php echo $getscatdata->ML_ID; ?>" <?php if(!empty($ML_ID)){ if($getscatdata->ML_ID == $ML_ID) echo 'selected'; }?>><?php echo $getscatdata->ML_LOV_Value; ?></option>
                                                <?php  } } else {?>  
                                                    <option value="<?php echo set_value('ML_ID'); ?>">No Data</option>  
                                                <?php }?>
                                        </select>                             
                                    </div>
                                    
                                    
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="Mqua_criteria">Criteria</label>
                                        <textarea class="form-control" name="Mqua_criteria" id="Mqua_criteria"></textarea>
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-4">
                                        <label style="padding-top:12px;" >Status</label>  
                                        <label class="custom-switch" style="margin-left: 20px;">
                                            <input type="checkbox" value="1" name="Mqua_status" id="Mqua_status" class="custom-switch-input" <?php if(!empty($webfaq[0])){ echo ($webfaq[0]->MPC_status =='1')?'checked':''; } ?> >
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>

                                </div>

                            </div>

                            <div class="row mt-4">
                                <!-- <div class="col-md-6 col-sm-6 col-xs-12 mobbtn">
                                    <button type="button" class="btn btn-primary btn-primary-1 mt-3 mb-0" onClick="add_more_policy()">Additional Information<i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                                    -->
                                <div class="col-md-6 col-sm-6 col-xs-12 text-right mobbtn">
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