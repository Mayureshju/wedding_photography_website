<!Doctype HTML>
<html>
<head>
    <title><?=WEBNAME;?> - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/style1.css" />
    <link href="<?php echo base_url(); ?>public/img/icon/favicon.ico" type="image/x-icon" rel="icon" />
</head>
<style>
    .panel-footer {
        background-color: #FFFFFF;
        border-top: none;
    }
    #button-menu1 {
        padding: 9px 15px 9px 16px;
        line-height: 25px;
        float: left;
        color: #FFF;
        border-right: 1px solid #FFF;
    }
    .paddLogin {
        padding-right: 50px;
        padding-left: 50px;
    }
    .margin {
        margin-top: 30px;
        margin-top: 30px;
    }
    .merge {
        margin-top: 80px;
        margin-left: 0px;
        margin-right: 0px;
    }
    .h1 {
        color: #666;
    }
</style>
<body>
<script>
var confirmation = <?php echo isset($popup)?$popup:0;?>;
CI_ROOT = '<?php echo base_url();?>';
if(confirmation != 0){
	conf = confirm('You are already logged in to another system, do you want to logout?');
	if(conf){
		$.ajax({
			type : 'POST',
			url : CI_ROOT+'Registration/updatemac',
			success : function(result){
					$("input[name='pin']").val(confirmation);
					$("#checkpin").submit();
			} 
		});
	}
}
</script>
<?php 
	// $getwebdata = get_list('mov_website',"*","");
	// $image_path = $getwebdata[0]->MWM_Imagepath;
?>	
	
    <div id="container">

        <div class="row merge">

            <div class="margin">
                <div class="">
                    <div class="text-center">
                        <!-- <h1> <font face="Franklin Gothic Medium"><?=WEBNAME;?></font> </h1> -->
                    </div>
                </div>
            </div>

            <!-- login form content -->
			 <?php echo form_open('Registration/checkpin',['id'=>'checkpin']);?>
            <div class="col-sm-offset-4 col-sm-4 paddLogin">
				
            <div class="col-md-offset-2" style="width:65% !important;margin: auto !important;"><img class="img-responsive" alt="movinnza logo" title="Movinnza logo" src="<?php echo base_url(); ?>public/img/icon/logo2.png"></div>
				
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-lock"></i> Please enter your 4 digit key.</h3>
                    </div>
                    <div class="panel-body">
                        <div class="input-group">
                            <span class="input-group-addon">
                                            <i class="fa fa-key fa-fw"></i></span>
                            <input  name="pin"  class="form-control" type="password" placeholder="Key" />
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
						<div class="col-md-12"><span  style="color:red; padding-bottom:10px;" class="pull-left"><?php if(isset($error)) echo $error;?></span></div>
							<button type="submit" class="btn btn-primary pull-right" data-dismiss="modal">
								<i class="fa fa-key fa-fw"></i> Proceed
							</button><br/>
							<a  style="margin-right:5px;" href="<?php echo base_url('Registration/forgot_pin');?>">Forgot Key</a>
							<a  style="margin-right:5px;" href="<?php echo base_url('Registration/logout');?>">Logout</a>
                    </div>
                </div>
            </div>
			 <?php echo form_close();?>
            <!-- /login form content -->
        </div>
        <footer class="text-center" id="footer">
            <a href="#"><?=WEBNAME;?></a> All Rights Reserved.
            <br>
        </footer>
    </div>
</body>

</html>
