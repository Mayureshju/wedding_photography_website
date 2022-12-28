<?php
if($this->session->has_userdata('id'))
{
	redirect('Registration/dashboard');
}
?>
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
<?php 
	// $getwebdata = get_list('mov_website',"*","");
	// $image_path = $getwebdata[0]->MWM_Imagepath;
?>
<body>

    <div id="container">

        <div class="row merge">

            <div class="margin">
                <div class="">
                    <div class="text-center">
                      <!--  <h1> <font face="Franklin Gothic Medium"><?=WEBNAME;?></font></h1>-->
						
                    </div>
                </div>
            </div>

            <!-- login form content -->
			 <?php echo form_open('Registration/login');?>
            <div class="col-sm-offset-4 col-sm-4 paddLogin ">
			
            <div class="col-md-offset-2" style="width:25% !important;margin: auto !important;"><img class="img-responsive" alt="movinnza logo" title="<?=WEBNAME;?> logo" src="<?php echo base_url(); ?>public/img/brand/logo-iron-buzz.png"></div>
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-lock"></i> Please enter your login details.</h3>
                    </div>

                    <div class="panel-body">
                        <label for="InputName">Username </label>

                        <div class="input-group margin-bottom-sm">
                            <span class="input-group-addon"> 
                                                <i class="fa fa-user-o fa-fw"></i>
                                            </span>
                            <input class="form-control" name="email" type="email" placeholder="Email address" />
                        </div>

                        <label for="InputPassword">Password </label>

                        <div class="input-group">
                            <span class="input-group-addon">
                                            <i class="fa fa-key fa-fw"></i></span>
                            <input  name="password"  class="form-control" type="password" placeholder="Password" />
                        </div>

                    </div>

                    <div class="panel-footer clearfix">
					<span style="color:red; padding-bottom:10px;" class="pull-left"><?php if(isset($error)) echo $error;?></span>
                        <button type="submit" class="btn btn-primary pull-right" data-dismiss="modal">
                            <i class="fa fa-key fa-fw"></i> Login
                        </button>
                    </div>

                </div>

                <div>

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
<?php //}else{redirect('welcome/index');} ?>