<?php
if($this->session->has_userdata('id'))
{
	redirect('Registration/dashboard');
}
?>
<!Doctype HTML>
<html>
<head>
<title>
Oglinginches
- Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- <script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>public/css/style1.css" /> -->
<link href="<?php echo base_url(); ?>public/favicon/favicon-32x32.png" type="image/x-icon" rel="icon" />


<!--Favicon -->
<!-- <link rel="icon" href="favicon.ico" type="image/x-icon"/> -->

<!--Bootstrap.min css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/bootstrap/css/bootstrap.min.css">

<!--Icons css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/css/icons.css">

<!--Style css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/css/style2.css?v=070920.0">

<!--mCustomScrollbar css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/scroll-bar/jquery.mCustomScrollbar.css">

<!--Sidemenu css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/toggle-menu/sidemenu.css">






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
<body class="bg-primarys single-pageimage cover-image" data-image-src="<?php echo base_url();?>public/img/particle.png">
		<div id="app">
			<section class="section section-2">
                <div class="container">
					<div class="row">
						<div class="single-page single-pageimage construction-bg cover-image ">
							<div class="row">
								<div class="col-lg-12">
									<div class="wrapper wrapper2">
										<form action="<?php echo base_url()?>Registration/login" method="post" id="login" class="card-body" tabindex="500">
                    <!-- <input type="hidden" name="role" value="<?php //echo $role;?>"> -->
											<h3>Login</h3>
											<div class="mail">
												<input type="email" name="email">
												<label>Mail or Username</label>
											</div>
											<div class="passwd">
												<input type="password" name="password">
												<label>Password</label>
											</div>
											<div class="submit">
						<!-- <a class="btn btn-primary btn-block" href="index.html">Login</a> -->
						<span style="color:red; padding-bottom:10px;" class="pull-left"><?php if(isset($error)) echo $error;?></span>
                        <button type="submit" class="btn btn-primary btn-primary-1 btn-block" > Login </button>
											</div>
											<p class="mb-2"><a href="<?php echo base_url(); ?>registration/forgot" >Forgot Password</a></p>
											<p class="text-dark mb-0">Don't have account?<a href="<?php echo base_url(); ?>Registration/register" class="text-primary ml-1">Sign UP</a></p>
										</form>
										<!-- <div class="card-body border-top"> -->
											<!-- <a class="btn  btn-social btn-facebook btn-block"><i class="fa fa-facebook"></i> Sign in with Facebook</a> -->
											<!-- <a class="btn  btn-social btn-google btn-block mt-2"><i class="fa fa-google-plus"></i> Sign in with Google</a>
										</div> -->
									</div>
								</div>
								
							</div>
						</div>	
					</div>
				</div>
			</section>
		</div>

		<!--Jquery.min js-->
		<script src="<?php echo base_url();?>public/js/jquery.min.js"></script>

		<!--popper js-->
		<script src="<?php echo base_url();?>public/js/popper.js"></script>

		<!--Tooltip js-->
		<script src="<?php echo base_url();?>public/js/tooltip.js"></script>

		<!--Bootstrap.min js-->
		<script src="<?php echo base_url();?>public/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Jquery.nicescroll.min js-->
		<script src="<?php echo base_url();?>public/plugins/nicescroll/jquery.nicescroll.min.js"></script>

		<!--Scroll-up-bar.min js-->
		<script src="<?php echo base_url();?>public/plugins/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
		
		<script src="<?php echo base_url();?>public/js/moment.min.js"></script>

		<!--mCustomScrollbar js-->
		<script src="<?php echo base_url();?>public/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!--Sidemenu js-->
		<script src="<?php echo base_url();?>public/plugins/toggle-menu/sidemenu.js"></script>

		<!--Scripts js-->
		<script src="<?php echo base_url();?>public/js/scripts.js"></script>

	</body>
</html>