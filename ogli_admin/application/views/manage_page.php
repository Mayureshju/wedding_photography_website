<?php include 'header.php'; ?>
<div class="app-content">
          <section class="section">
          <div class="row">
    <div class="col-sm-3 col-md-3 col-xs-2">
            <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_page/<?php echo $no;?>">Manage Page</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Add page</li>
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
                              <form action="<?php echo base_url() ?>Page/add_cms_details" method="post" id="demo-form3" data-parsley-validate class="form-horizontal " enctype="multipart/form-data">  
                                <input type="hidden" name="id" value="<?php ?>" />
                             <div class="row">
                      <div class="col-sm-12 col-md-4 mb-3">
                        <a href=""><h4> Add Page</h4></a>
                      </div>                    
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
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
                          <label for="seourl">SEO Url</label>
                        <input id="seourl" name="seourl" class="form-control" type="text" value="<?php if(!empty($webcms[0])) echo $webcms[0]->MPC_seo_url;?>">                             
                        </div>
                        <div class="form-group mb-0 overflow-hidden mt-3">
                          <label for="metatitle">Meta Title </label>
                          <input id="metatitle" name="metatitle" class="form-control" type="text" value="<?php if(!empty($webcms[0])) echo $webcms[0]->MPC_seo_title;?>">                             
                        </div>

                         <div class="form-group mb-0 overflow-hidden mt-3">
                          <label for="pagecontent1">Page Content 1</label>
                            <textarea id="pagecontent1" class="form-control inputheight editor" rows="5" name="pagecontent1"><?php if(!empty($webcms[0])) echo $webcms[0]->MPC_content;?></textarea>
                        </div>
                        </div>
                      <div class="col-md-6">

                        <div class="form-group mb-0 overflow-hidden mt-3">
                          <label for="metakeyword">Meta Keywords</label>
                            <textarea id="metakeyword" class="form-control inputheight" rows="5" name="metakeyword"><?php if(!empty($webcms[0])) echo $webcms[0]->MPC_seo_keyword;?></textarea>
                        </div>

                        <div class="form-group mb-0 overflow-hidden mt-3">
                          <label for="metadesc">Meta Description</label>
                            <textarea id="metadesc" class="form-control inputheight" rows="5" name="metadesc"><?php if(!empty($webcms[0])) echo $webcms[0]->MPC_seo_description;?></textarea>
                        </div>

                       

                       <!--  <div class="form-group mb-0 overflow-hidden mt-3">
                          <label for="pagecontent2">Page Content 2</label>
                            <textarea id="pagecontent2" class="form-control inputheight" rows="5" name="pagecontent2"><?php if(!empty($webcms[0])) echo $webcms[0]->MPC_content2;?></textarea>
                        </div> -->

                        <!-- <div class="form-group mb-0 overflow-hidden mt-3">
                          <label for="pagecontent3">Page Content 3</label>
                            <textarea id="pagecontent3" class="form-control inputheight" rows="5" name="pagecontent3"><?php if(!empty($webcms[0])) echo $webcms[0]->MPC_content3;?></textarea>
                        </div> -->
                        <!-- <div class="form-group mb-0 overflow-hidden mt-3">
                          <label for="pagecontent4">Page Content 4</label>
                            <textarea id="pagecontent4" class="form-control inputheight" rows="5" name="pagecontent4"><?php if(!empty($webcms[0])) echo $webcms[0]->MPC_content4;?></textarea>
                        </div> -->

                       <!--  <div class="form-group mb-0 overflow-hidden mt-4">
                          <label for="paymentgateway" >Status</label>
                          <label class="custom-switch" style="margin-left: 20px;">
                            <input type="checkbox" name="status" id="status" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                            </label> 
                            <label class="radio-inline" style="padding-left:28px;">                                                                
                            <input type="radio" name="status" value="0" class="flat prstatus" checked />  Pending
                                            </label>
                                            <label class="radio-inline" style="padding-left:10px;">
                            <input type="radio" name="status" value="1" class="flat prstatus">  Ongoing
                                            </label>
                                            <label class="radio-inline" style="padding-left:10px;">
                            <input type="radio" name="status" value="2" class="flat prstatus">  Completed
                                            </label>   
                          </div>-->
 
                            <div class="form-group mb-0 overflow-hidden mt-4">
                    <label style="padding-top:12px;" >Status</label>  
                    <label class="custom-switch" style="margin-left: 20px;">
                      <input type="checkbox" name="status" id="status" class="custom-switch-input" <?php if(!empty($webcms[0])){ echo ($webcms[0]->MPC_status =='1')?'checked':''; } ?> >
                      <span class="custom-switch-indicator"></span>
                    </label>
                   </div>

                        

                        <!-- <div class="form-group mb-0 overflow-hidden mt-3">
                          <label>Attachment </label><br>
                            <label><input type="file" name="attachfile[]" class="form-control" aria-describedby="fileHelp" onchange="readURLbanr(this);" value="<?php echo set_value('attachfile');?>" accept="image/png, image/jpeg,.pdf,.doc,.docx" multiple/> </label><br/>
                            <font color="#0000FF" size="1">[ Maximum Image Size : <?php echo image_size();?> MB and Upload Only .jpg / .png extension file. ]&nbsp;</font>
                            <font color="#0000FF" size="1">[ Maximum File Size :<?php echo file_size();?> MB and Upload Only .pdf / .doc /.docx extension file. ]&nbsp;</font>
                            <img id="blahbanr" src="">                   
                        </div>-->

                      </div>

                    </div>
                    

                

              <!-- </div>
            </div>
          </div> -->










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



      <!-- End of product layout -->
    <?php include('footer.php'); ?>
    <script>
  $(function(){
      $.fn.select2.amd.require(["optgroup-data", "optgroup-results"], 
          function (OptgroupData, OptgroupResults) {
          $('#worker').select2({
              dataAdapter: OptgroupData,
              resultsAdapter: OptgroupResults,
              closeOnSelect: false,
      //  placeholder: "Search"
          }); 
      });
  });
  var datestr1 = $('#startdate').val();
  var localTime = new Date();
  $('#startdate').Zebra_DatePicker({
        format: 'Y-m-d H:i',
        current_date: localTime
    });
    
    $('#enddate').Zebra_DatePicker({
        format: 'Y-m-d H:i',
        current_date: localTime
      });
      

  // var datestr1 = $('#startdate').val();
  //  $('#startdate').datepicker({
     
  //  //dateFormat: "yy-mm-dd"
    //     format:"yyyy-mm-dd",
    //     minViewMode:0,
    //     autoclose:true,
    //     todayHighlight:true
  // });
  // $('#enddate').datepicker({
    //     //dateFormat: "yy-mm-dd" , minDate:0
    //     format:"yyyy-mm-dd",
    //     minViewMode:0,
    //     autoclose:true,
    //     todayHighlight:true
    // });  
    
    // $('#followupdate').datepicker({
    //     //dateFormat: "yy-mm-dd" ,
        
    //     format:"yyyy-mm-dd",
    //     startDate: new Date(),
    // //     minViewMode:0,
    // //     inline: false,
    //  lang: 'en',
    // // // step: 5,
    //  multidate: 5,
    //  assumeNearbyYear: 20,
    //  closeOnDateSelect: true,
    // todayHighlight:true,
    // // startView: 2,
    //  defaultViewDate: new Date(),
    //    // multidate: 3
  // });
  
  $('#followupdate').Zebra_DatePicker({
        format: 'Y-m-d H:i',
        direction: -1,
         current_date: localTime
    });


 $("#startdate").change(function() {
     //alert('hi')
   $('#enddate').val('');
 });


  $("#enddate").change(function() {
    var startDate = document.getElementById("startdate").value;
    var endDate = document.getElementById("enddate").value;
    //var DateCreated = new Date(Date.parse(startDate)).format("MM/dd/yyyy");
   // var d = new Date(startDate);
   // startDate = d.toISOString();
    //alert((Date.endDate));
    if ((Date.parse(endDate) < Date.parse(startDate))) {
      alert("End date should be greater than Start date");
      document.getElementById("enddate").value = "";
    }
  });




  </script>
      <script>
    CI_ROOT = '<?php echo base_url() ?>';
    Userid = '';
      </script>
      <?php
      //echo my_file1('web/plugins/datatables/jquery.dataTables.min', 2);
     // echo my_file1('web/plugins/datatables/dataTables.bootstrap.min', 2);
     // echo my_file1('web/custom/appointment.js?v=191120.0', 2);
      ?>
     
      <script>
    
        

        function IsChkNumc(source) {
          bmobile = $(source).val();
          if (isNaN(bmobile)) {
            bmobile = bmobile.replace(/\D/g, '');
            $(source).val(bmobile);
          }
        }

        $('#cljoindate').datepicker({
          dateFormat: "d-MM-yy DD"
    });
    
    $('#bookingdate').datepicker({
        // dateFormat: "d-MM-yy DD"
        format:"yyyy-mm-dd",
        minViewMode:0,
        autoclose:true
      });
      </script>


<script>



$(document).ready(function(){
    $("#pagename").change(function(){
        var page = $("#pagename").val();
        
        if(page != '')
        {
          window.location.href = CI_ROOT+"Page/display_cms_details/"+page;
        }
        else{
          alert("Please select Page");
        }
        
        
    });
    
});

</script>