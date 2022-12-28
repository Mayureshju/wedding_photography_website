<?php include 'header.php'; ?>
<style>
.list-group {
    display: flex;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
}
.list-group-flush:first-child .list-group-item:first-child {
    border-top: 0;
}

.list-group-flush .list-group-item {
    border-right: 0;
    border-left: 0;
    border-radius: 0;
}
.list-group-item:first-child {
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}
.bg-transparent {
    background: transparent !important;
}
.bg-transparent {
    background-color: transparent !important;
}
.list-group-item {
    position: relative;
    display: block;
    padding: .75rem .75rem;
    margin-bottom: -1px;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,0.125);
}
.widget-content {
    /* padding: 1rem; */
    flex-direction: row;
    align-items: center;
}

.p-0 {
    padding: 0 !important;
}
.widget-content .widget-content-outer {
    display: flex;
    flex: 1;
    flex-direction: column;   
}
*, *::before, *::after {
    box-sizing: border-box;
}
.widget-content .widget-content-wrapper {
    display: flex;
    flex: 1;
    position: relative;
    align-items: center;
}
.mr-3, .mx-3 {
    margin-right: 1rem !important;
}
.rounded-circle {
    border-radius: 50% !important;
}
.flex2 {
    flex: 2;
}
.widget-content .widget-content-right {
    margin-left: auto;
    margin-right: 20px;
}
.widget-content .widget-content-left .widget-heading {
    opacity: .8;
    font-weight: bold;
}
.widget-content .widget-content-left .widget-subheading {
    opacity: .5;
    margin-top: 10px;
    text-align: justify;
}
.opacity-10 {
    opacity: 1 !important;
    
}
.pr-2, .px-2 {
    padding-right: .5rem !important;
}

.icon-wrapper {
    width: 54px;
    height: 54px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
}
.icon-wrapper {
    display: flex;
    align-content: center;
    align-items: center;
}

.m-0 {
    margin: 0 !important;
}
.icon-wrapper .progress-circle-wrapper {
    width: 100%;
    margin-right: 0;
    margin-top: 4px;
}
.circle-progress {
    position: relative;
}

.d-inline-block {
    display: inline-block !important;
}
.circle-progress canvas {
    display: block;
}
.circle-progress small {
    position: absolute;
    height: 100%;
    width: 100%;
    font-weight: bold;
    left: 0;
    top: 0;
    vertical-align: middle;
    text-align: center;
    display: flex;
    align-items: center;
    align-content: center;
}
small, .small {
    font-size: 80%;
    font-weight: 400;
}
.circle-progress small span {
    margin: 0 auto;
}
.circle-progress small span {
    margin: 0 auto;
}
.widget-content .widget-numbers {
    font-weight: bold;
    font-size: 1.8rem;
    display: block;
}
.text-success {
    color: #3ac47d !important;
}
.text-primary {
    color: #3f6ad8 !important;
}

.bg-amy-crisp {
    background-image: linear-gradient(120deg, #a6c0fe 0%, #f68084 100%) !important;
}
.icon-gradient {
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    /* text-fill-color: transparent; */
}
.btn-actions-pane-right {
    margin-left: auto;
    white-space: nowrap;
}
.btn-group, .btn-group-vertical {
    position: relative;
    display: inline-flex;
    vertical-align: middle;
}
.scroll-area-lg {
    /* height: 134px; */
    overflow-x: hidden;
}
.scrollbar-sidebar, .scrollbar-container {
    position: relative;
    /* height: 100%; */
    height: auto;
}
.ps {
    /* overflow: hidden !important; */
    overflow-anchor: none;
    touch-action: auto;
}
.p-4 {
    padding: 1.5rem !important;
}

.vertical-timeline {
    width: 100%;
    position: relative;
    /* padding: 1.5rem 0 1rem; */
}
.vertical-time-simple {
    padding: .5rem 0;
}
.vertical-without-time::before {
    left: 11px;
}
.vertical-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    /* left: 67px; */
    height: 100%;
    width: 4px;
    background: #e9ecef;
    border-radius: .25rem;
}
.vertical-time-simple .vertical-timeline-element {
    margin: 0 0 .5rem;
}
.vertical-timeline-element {
    position: relative;
    margin: 0 0 1rem;
}
.vertical-time-simple .vertical-timeline-element-icon {
    height: 14px;
    width: 14px;
    background: #e9ecef;
    position: absolute;
    left: 6px;
    top: 2px;
    display: block;
    border-radius: 20px;
}
.vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
    visibility: visible;
    animation: cd-bounce-1 .8s;
}
.dot-danger .vertical-timeline-element-icon {
    background: #d92550;
}

.vertical-timeline--animate .vertical-timeline-element-content.bounce-in {
    visibility: visible;
    -webkit-animation: cd-bounce-2 .6s;
    -moz-animation: cd-bounce-2 .6s;
    animation: cd-bounce-2 .6s;
}

.vertical-without-time .vertical-timeline-element-content {
    margin-left: 36px;
}
.vertical-timeline-element-content {
    position: relative;
    /* margin-left: 90px; */
    font-size: .8rem;
}
.vertical-timeline-element:after {
    content: "";
    display: table;
    clear: both;
}
.dot-warning .vertical-timeline-element-icon {
    background: #f7b924;
}
.vertical-time-simple .timeline-title {
    text-transform: none;
}
.vertical-time-simple .timeline-title {
    font-weight: normal;
    font-size: .91667rem;
    padding: 0;
}

.vertical-timeline-element-content .timeline-title {
    /* font-size: .8rem;
    text-transform: uppercase; */
    margin: 0 0 .5rem;
    /* padding: 2px 0 0;
    font-weight: bold; */
}
.vertical-timeline-element-content:after {
    content: "";
    display: table;
    clear: both;
}
.vertical-timeline-element:after {
    content: "";
    display: table;
    clear: both;
}
.vertical-time-simple .vertical-timeline-element-icon::after {
    content: '';
    position: absolute;
    background: #fff;
    left: 50%;
    top: 50%;
    margin: -4px 0 0 -4px;
    display: block;
    width: 8px;
    height: 8px;
    border-radius: 20px;
}
*, *::before, *::after {
    box-sizing: border-box;
}
.dot-success .vertical-timeline-element-icon {
    background: #3ac47d;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}
.btn {
    position: relative;
    transition: color 0.15s,background-color 0.15s,border-color 0.15s,box-shadow 0.15s;
}
.btn-success {
    color: #fff;
    /* background-color: #3ac47d;
    border-color: #3ac47d; */
    background-color: #2651be;
    border-color: #244cb3;
}
.btn-icon {
    vertical-align: bottom;
}
.btn {
    font-size: 0.8rem;
    font-weight: 500;
}
.btn-icon.btn-sm:not(.btn-block) .btn-icon-wrapper, .btn-group-sm>.btn-icon.btn:not(.btn-block) .btn-icon-wrapper {
    font-size: 16px;
}
.btn-icon-only .btn-icon-wrapper {
    margin-left: 0;
    margin-right: 0;
}
.btn-icon .btn-icon-wrapper {
    /* margin-right: .5rem; */
    margin-left: 0;
    margin-top: 0;
    font-size: 17px;
    vertical-align: middle;
    transition: color .1s;
    display: inline-block;
}
.brodersep{
    border-right: 1px solid; 
    border-color:#C21807;
}
</style>
<div class="app-content">
	<section class="section">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-xs-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Appointment Letter</li>
            </ol>
            </div>
            <div class="col-sm-9 col-md-9 col-xs-4">
                <button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;" onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </button>
            </div>
        </div> 
		<div class="section-body ">
			<div class="row">
				<div class="col-lg-12">
					<div class="e-panel card">
						<div class="card-body">
							<div class="e-table">
							    <div class="row">
                                    <div class="col-sm-12 col-md-2 col-xs-12 mb-3">
                                        <a href=""><h4 style="font-size: 1.1rem !important;">Manage letter</h4></a>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-xs-12">
                                        <form class="form-horizontal" id="mainform" action="<?php echo base_url();?>index.php/Nav/search_view_appt_letter" method="POST">
                                            <div class="row" id="bs-example-navbar-collapse-1">
                                                
                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group" style="margin-right:5px;">
                                                    <?php 
                                                    $filterval = '';
                                                    if(isset($filter)){
                                                        $filterval = $filter;
                                                    }
                                                    ?>
                                                    <select class="form-control select2" name="filter" id="searchfilters" style="width:100%;">
                                                        <option value="MQa_id" <?php echo $filterval == 'Ml_id'?'selected':'';?>>Letter ID</option>	
                                                        <option value="MM_ID" <?php echo $filterval == 'Ml_name'?'selected':'';?>>Name</option> 
                                                        <option value="MQa_UpdatedDate" <?php echo $filterval == 'Ml_UpdatedDate'?'selected':'';?>>Updated Date</option>
                                                        <option value="MQa_CreatedDate" <?php echo $filterval == 'Ml_CreatedDate'?'selected':'';?>>Created Date</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group" style="margin-right:5px;" id="plainsearch">
                                                    <?php $search_val = '';
                                                        if(isset($search)){
                                                            $search_val = $search;
                                                        }
                                                    ?>
                                                    <input type="text" name="search" class="form-control" value="<?= $search_val?>" autocomplete="off">
                                                </div>

                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group" style="margin-right:5px;" id="pagename">
                                                    <select class="form-control select2" name="MM_ID" style="width:100%;">                     
                                                        <option value="">Select Page</option>
                                                        <?php
                                                        $parentmenulist = get_list('mov_menu','*',"MM_Status = 1  and MM_Parent_ID = 0");
                                                        if($parentmenulist){
                                                            foreach($parentmenulist as $pmenu) { 
                                                            $childmenulist = get_list('mov_menu','*',"MM_Status = 1  and MM_Parent_ID = $pmenu->MM_ID"); 
                                                            
                                                            if(!empty($childmenulist)){ ?>
                                                                <optgroup label="<?php echo $pmenu->MM_Name; ?>" > 
                                                                <?php foreach($childmenulist as $chmenu) { ?>

                                                                    <?php if($search_val == $chmenu->MM_ID){ ?>  ?>
                                                                    <option value="<?php echo $chmenu->MM_ID; ?>" selected><?php echo $chmenu->MM_Name; ?></option>
                                                                    <?php }else { ?>    
                                                                <option value="<?php echo $chmenu->MM_ID; ?>" <?php if(!empty($pageid)) {  if($pageid == $chmenu->MM_ID) echo 'selected'; } ?> ><?php echo $chmenu->MM_Name; ?></option>
                                                                <?php } } ?>
                                                                </optgroup>
                                                            <?php  }else{ ?>
                                                             <?php if($search_val == $pmenu->MM_ID){ ?>  ?>
                                                                    <option value="<?php echo $pmenu->MM_ID; ?>" selected><?php echo $pmenu->MM_Name; ?></option>
                                                                    <?php }else { ?>    
                                                                <option value="<?php echo $pmenu->MM_ID; ?>" <?php if(!empty($pageid)) {  if($pageid == $pmenu->MM_ID) echo 'selected'; } ?> ><?php echo $pmenu->MM_Name; ?></option>
                                                            <?php  } }                              
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-3 col-sm-3 col-xs-12" style="margin-right:5px;" id="dateidd">                     
                                                    <input type="text" name="searchdate" id="searchdate" value="<?= $search_val ?>" class="form-control boxheight" placeholder="Search" readonly/>                                                      
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-12 form-group" style="margin-right:5px;">
                                                    <select class="form-control select2" name="status" id="status" style="width:100%;">
                                                        <?php  if(isset($status)){  ?>
                                                            <option value=''> Select </option>
                                                            <option <?php echo $status == 3?"selected":"";?> value="1">All Letter</option>
                                                            <option <?php echo $status == 2?"selected":"";?> value="0">Inactive Letter</option>					
                                                        <?php  }else {  ?>
                                                            <option value=''> Select </option>
                                                            <option selected value="1" >All Letter</option>
                                                            <option  value="0">Inactive Letter</option>
                                                        <?php }?>
                                                    </select>									
                                                </div>

                                                <div class="col-md-1 col-sm-1 col-xs-12 form-group" >
                                                    <button type="submit" data-original-title="Search" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-sm-12 col-md-2 col-xs-12">
                                    <?php if (in_array("Manage Appointment Letter", $pagemodify)) { ?>
                                        <a href="<?php echo base_url();?>Appointmentletter/add_appt_letter" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New">
                                        <i class="fa fa-plus"></i>
                                        </a>
                                    <?php } ?>
                                        <a href="<?php echo base_url();?>Nav/manage_appt_letter/<?php echo $no;?>" data-toggle="tooltip" title="Reset" class="btn btn-default" data-original-title="Rebuild">
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                    </div>
                                </div>

                                <!-- <div class="row">
                                <label class=" col-md-4 col-sm-4 col-xs-12" for="first-name">Showing pagenames :: <span style="color:#337ab7;"><?php //echo count($pagenames); ?> of <?php //echo count(get_list('mov_pagenames','MC_cl_id',''));?></span></label>
                                </div> -->
                            

                                <div class="table-responsive table-lg">
                                <table id="example1" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Letter ID</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Joining Date</th>
                                                <th class="text-center">Updated By</th> 
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                                <?php 									
                                                    if(isset($appt_letter) && $appt_letter !='no')
                                                    {
                                                            foreach($appt_letter as $key=>$val)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td class="align-middle text-center"><?php echo $val->Ml_id; ?></td>
                                                                    <td class="align-middle text-center"><?php echo $val->Ml_name; ?></td>															
                                                                    <td class="align-middle text-center"><?php echo $val->Ml_joining_date; ?></td>															
                                                                    <td class="align-middle text-center"><?php echo convert_commas_to_value('mov_user_master', 'MUM_Full_name', $val->Ml_UpdatedBY, 'MUM_ID'); ?></td>
                                                                    <td class="text-center align-middle">
                                                                        <label class="custom-switch">
                                                                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input status <?php if($val->Ml_status == 1){echo 'active_status';}else{echo 'Inactive';}?>" alt="<?php echo $val->Ml_id;?>" <?php if($val->Ml_status == 1) echo 'checked';?> >
                                                                            <span class="custom-switch-indicator"></span>
                                                                        </label>
                                                                    </td>

                                                                    <?php 
                                                                        $searchstr =  '';if($this->uri->segment(3)){ $searchstr = $this->uri->segment(3);}
                                                                        $page =  '0';if($this->uri->segment(4)){$page =  $this->uri->segment(4);}
                                                                    ?>
                                                                    <!-- <td><a  class="editrow" style="cursor:pointer; " title='Edit Category'><i class="fa fa-edit" onclick="edit_pagename(<?php  //echo $val->MC_cl_id.',\''.$searchstr.'\','.$page; ?>)"></i></a></td> -->
                                                                    <td class="align-middle text-center">
                                                                        <button class="btn btn-sm btn-primary badge" style="cursor:pointer; " title='View Order' onclick="view_appt_letter(<?php  echo $val->Ml_id.',\''.$searchstr.'\','.$page; ?>)"><i class="fa fa-eye"></i></button> 
                                                                        <button class="btn btn-sm btn-primary badge" style="cursor:pointer; " title='Edit FAQ' onclick="edit_appt_letter(<?php  echo $val->Ml_id.',\''.$searchstr.'\','.$page; ?>)"><i class="fa fa-edit"></i></button> 
                                                                    </td>
                                                                    <!-- <td class="align-middle text-center"><button class="btn btn-sm btn-primary badge" style="cursor:pointer; " title='Edit Appointment' ><i class="fa fa-edit"></i></button> </td> -->
                                                                </tr>
                                                                <?php
                                                            }
                                                    }else{
                                                    ?>
                                                    <tr><td colspan="13"><p class="text-center">No Record Found</p></td></tr>
                                                    <?php
                                                } 
                                                ?>
                                                
                                        </tbody>
                                    </table>

                                    <?php echo $this->pagination->create_links();?>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
                <!-- End of product layout -->
<style>
.dataTables_length { display : none; }
.dataTables_filter { display : none; }
.dataTables_info { display : none; }
</style>					
		
<?php include('footer.php');?>
 <script>
 CI_ROOT = '<?php echo base_url()?>index.php/';
 Userid = '';
</script>
<?php 
echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
//echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
echo my_file1('web/custom/appt_letter.js?v=211020.0',2);
?>
<script>
	 $(function () {
   $("#example1").DataTable();
	$(".dataTables_filter").addClass("pull-right");
	$(".pagination").addClass("pull-right");
	
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
	elems.forEach(function(html) {
		var switchery = new Switchery(html,{size: 'small'});
	});
	
  });
</script>
<script>
 $('#searchdate').datepicker({
	
    format:"yyyy-mm-dd",
    autoclose: true
	
});

function view_appt_letter(id,search,page)
	{
	
		if(id != '')	
		window.location.href = CI_ROOT+"Appointmentletter/view_appt_letter/"+id+"/"+search+"/"+page;
		else
		alert("Problem with Order");
	
	}

filterval = '<?php echo $filterval;?>'; 
//plainsearch nshcat pricest outreach sentby
//MNC_cat_id MGD_getpost_free_paid MGD_getpost_outreachstage_status MUM_ID
        
$("#assignto").hide();
$("#pagename").hide();
$("#dateidd").hide();

if(filterval == 'MA_assignto'){
     
$("#assignto").show();   
$("#pagename").hide();    
$("#dateidd").hide();
$("#plainsearch").hide()
}
else if(filterval == 'MM_ID'){
     
$("#assignto").hide();   
$("#pagename").show();    
$("#dateidd").hide();
$("#plainsearch").hide()
}
else if(filterval == 'MQa_UpdatedDate' || filterval == 'MQa_CreatedDate'){
     
$("#assignto").hide();   
$("#pagename").hide();        
$("#dateidd").show();
$("#plainsearch").hide();
}
else{
    $("#assignto").hide();   
$("#pagename").hide();        
$("#dateidd").hide();
$("#plainsearch").show();
}


$("#searchfilters").change(function(){
var searchfilters = $("#searchfilters").val();  

if(searchfilters == 'MQa_id'){
    $("#pagename").hide();   
$("#pagename").hide();    
$("#dateidd").hide();
$("#plainsearch").show()
}
else if(searchfilters == 'MM_ID'){
     
    $("#pagename").hide();   
$("#pagename").show();    
$("#dateidd").hide();
$("#plainsearch").hide()
}
else if(searchfilters == 'MQa_title'){
     
    $("#pagename").hide();   
$("#pagename").hide();    
$("#dateidd").hide();
$("#plainsearch").show()
}
else if(searchfilters == 'MQa_UpdatedDate' || searchfilters == 'MQa_CreatedDate'){
    $("#pagename").hide();   
$("#pagename").hide();        
$("#dateidd").show();
$("#plainsearch").hide();
}
else{
    $("#pagename").hide();   
$("#pagename").hide();        
$("#dateidd").hide();
$("#plainsearch").show();
}   
    
    
})
</script>