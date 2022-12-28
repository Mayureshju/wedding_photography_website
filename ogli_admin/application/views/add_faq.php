<?php include 'header.php'; ?>
<div class="app-content">
    <section class="section">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-xs-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_faq/<?php echo $no;?>">Manage FAQ</a></li>
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
                        <form action="<?php echo base_url() ?>Faq/add_faq_data" method="post"  data-parsley-validate class="form-horizontal " enctype="multipart/form-data">  
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-0 overflow-hidden mt-3">
                                    <label for="pagename">Page Name*</label>                          
                                    <?php $pagename =  set_value('pagename'); ?>
                                        <select class="form-control select2" name="pagename" id="pagename" style="width:100%;">                     
                                            <option value="">Select Page</option>
                                            <?php
                                            $parentmenulist = get_list('mov_menu','*',"MM_Status = 1  and MM_Parent_ID = 0");
                                            if($parentmenulist){
                                                foreach($parentmenulist as $pmenu) { 
                                                $childmenulist = get_list('mov_menu','*',"MM_Status = 1  and MM_Parent_ID = $pmenu->MM_ID"); 
                                                
                                                if(!empty($childmenulist)){ ?>
                                                    <optgroup label="<?php echo $pmenu->MM_Name; ?>" > 
                                                    <?php foreach($childmenulist as $chmenu) { ?>
                                                    <option value="<?php echo $chmenu->MM_ID; ?>" <?php if(!empty($pageid)) {  if($pageid == $chmenu->MM_ID) echo 'selected'; } ?> ><?php echo $chmenu->MM_Name; ?></option>
                                                    <?php } ?>
                                                    </optgroup>
                                                <?php  }else{ ?>
                                                    <option value="<?php echo $pmenu->MM_ID; ?>" <?php if(!empty($pageid)) {  if($pageid == $pmenu->MM_ID) echo 'selected'; } ?> ><?php echo $pmenu->MM_Name; ?></option>
                                                <?php  }                                
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metatitle">Question</label>
                                        <input name="MQa_title" class="form-control" type="text" value="<?php if(!empty($webfaq[0])) echo $webfaq[0]->MPC_seo_title;?>">                             
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-3">
                                        <label for="metakeyword">Answaer</label>
                                        <textarea class="form-control inputheight" rows="5" name="MQa_answer"><?php if(!empty($webfaq[0])) echo $webfaq[0]->MPC_seo_keyword;?></textarea>
                                    </div>
                                    <div class="form-group mb-0 overflow-hidden mt-4">
                                        <label style="padding-top:12px;" >Status</label>  
                                        <label class="custom-switch" style="margin-left: 20px;">
                                        <input type="checkbox" value="1" name="status" id="status" class="custom-switch-input" <?php if(!empty($webfaq[0])){ echo ($webfaq[0]->MPC_status =='1')?'checked':''; } ?> >
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