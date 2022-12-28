<?php 
if(!$this->session->has_userdata('id'))
{
	redirect('Registration/logout');
}


//echo '1'; exit;
?>
<!Doctype HTML>
<html>
<head>
    <title>Dashboard</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	 <!-- <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<link rel="stylesheet" href="<?php echo base_url();?>public/web/custom/jquery-ui-1.12.1.custom/jquery-ui.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>public/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.timepicker.css" />
	<link href="<?php echo base_url()?>public/web/switchery/dist/switchery.min.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>public/css/style1-ext.css" />-->
   <!--  <link href="<?php //echo base_url(); ?>public/img1/icon/favicon.ico" type="image/x-icon" rel="icon" />  -->
   
<!--Favicon -->
<!-- <link rel="icon" href="<?php echo base_url(); ?>public/img/icon/favicon.ico" type="image/x-icon"/> -->

<link href="<?php echo base_url(); ?>public/favicon/favicon-32x32.png" type="image/x-icon" rel="icon" />

<!--Bootstrap.min css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/bootstrap/css/bootstrap.min.css">

<!--Icons css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/css/icons.css">

<!--Style css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/css/style2.css?v=110221.0">

<!--mCustomScrollbar css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/scroll-bar/jquery.mCustomScrollbar.css">

<!--Sidemenu css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/toggle-menu/sidemenu.css">

<!--Chartist css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/chartist/chartist.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/chartist/chartist-plugin-tooltip.css">

<!--Full calendar css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/fullcalendar/stylesheet1.css">

<!--morris css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/morris/morris.css">

<!--Bootstrap-daterangepicker css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/bootstrap-daterangepicker/daterangepicker.css">

<!--Bootstrap-datepicker css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/bootstrap-datepicker/bootstrap-datepicker.css">

<!--iCheck css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/iCheck/all.css">

<!--Bootstrap-colorpicker css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css">

<!--Bootstrap-timepicker css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css">

<!--Select2 css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/select2/select2.css?v=280820.0">

<!-- Modaal-->
<link rel="stylesheet" href="<?php echo base_url();?>public/css/modaal.css">

<link rel="stylesheet" href="<?php echo base_url();?>public/css/zebra_datepicker.min.css">


	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/select2.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/dist/select2.optgroupSelect.css">
	
	<!--Style css-->
<link rel="stylesheet" href="<?php echo base_url();?>public/css/style-calender.css?v=110221.0">
<link rel="stylesheet" href="<?php echo base_url();?>public/dropify/dist/css/dropify.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/dropzone-master/dist/dropzone.css">
</head>
<style>
.panel-footer {
	background-color: #FFFFFF;
	border-top: 1px solid #ddd;
}

.notification-icon--fixed {
	
  /* position: relative; */
  position: absolute;
  color: #fff !important;
  background-color: #ff473d;
  border-radius: 50%;
  /* font-family: "Roboto"; */
  font-family: inherit;

  /* Alignment */
  line-height: 0;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  
  /* Adjust as required: */
  padding: 10px;
  font-size: 9px;
width: 5px;

 
}

/* Height = width */
.notification-icon--fixed::after {
  content: "";
  display: block;
  padding-bottom: 100%;
}
.notification-badge{
	font-size: 132% !important;
	font-weight: bold !important;
}

.mdf-nv-link-g{
	border-radius: 30px !important;
    padding-left: 15px !important;
    padding-right: 15px !important;
	border: none !important;
	text-transform: capitalize;
}
.mdf-nv-link-d{
	border-radius: 30px !important;
    padding-left: 15px !important;
    padding-right: 15px !important;
	border: none !important;
	background: transparent;
	text-transform: capitalize;
}

</style>
<?php 
   	 
	$sess_role = $this->session->userdata('role');
	$MUM_roles = $this->session->userdata('MUM_roles');
	$uid = $this->session->userdata('id');
	//echo $uid; exit;
	/*$currmacdata = get_list('mov_user_master',"MUM_Mac_Address","MUM_ID=$uid");
	$mac = $this->session->userdata('mac') != ''?$this->session->userdata('mac'):'';
	if($currmacdata){
		foreach($currmacdata as $currmac){
			if($currmac->MUM_Mac_Address != $mac){
				redirect('Registration/logout');
			}
		}
	}*/
  
  $page = array();

  $pagemodify = array();
  $pagedelete = array();

  $roledata = get_list('mov_user_master',"MUM_Access_Permission,MUM_Modify_Permission,MUM_Delete_Permission,MUM_Profilepic","MUM_ID=$uid");
	//echo $this->db->last_query();
 // print_r($roledata);exit;
	if(!empty($roledata[0])){
        $rolids = explode(',',$roledata[0]->MUM_Access_Permission);
        $rolidsmodify = explode(',',$roledata[0]->MUM_Modify_Permission);
        $rolidsdelete = explode(',',$roledata[0]->MUM_Delete_Permission);
        if(!empty($rolids[0])){
            for($i=0;$i<count($rolids);$i++){
            $roleid = $rolids[$i];
            $pagename = get_list('mov_module_name',"MMN_Page_Name","MMN_ID=$roleid");
            if(!empty($pagename[0])){
                $page[] = $pagename[0]->MMN_Page_Name;
            }
        }
        }else{
            $page = array();
        }

        if(!empty($rolidsmodify[0])){
            for($i=0;$i<count($rolidsmodify);$i++){
            $rolidsmod = $rolidsmodify[$i];
            $pagenamem = get_list('mov_module_name',"MMN_Page_Name","MMN_ID=$rolidsmod");
            if(!empty($pagenamem[0])){
                $pagemodify[] = $pagenamem[0]->MMN_Page_Name;
            }
        }
        }else{
            $pagemodify = array();
        }

        if(!empty($rolidsdelete[0])){
            for($i=0;$i<count($rolidsdelete);$i++){
            $rolidsdel = $rolidsdelete[$i];
            $pagenamed = get_list('mov_module_name',"MMN_Page_Name","MMN_ID=$rolidsdel");
            if(!empty($pagenamed[0])){
                $pagedelete[] = $pagenamed[0]->MMN_Page_Name;
            }
        }
        }else{
            $pagedelete = array();
        }
		
	}else{
		redirect('Registration/logout');
	}
  
?>
<?php //echo date('F', strtotime('+3 month'));
	$completeyear = date('Y');
	$completemonth = date('F');
	$online_user = get_list('mov_user_master','MUM_ID,MUM_Full_name,MUM_Mac_Address,MUM_Email,MUM_Profilepic',"MUM_Mac_Address <> ''");
?>	







        <body class="app ">
<div id="spinner"></div>
<?php $no = base64_encode('no'); ?>

<!-- Main Container -->
<!-- <div id="container"> -->
<div id="app">
			<div class="main-wrapper" >
<!-- Start Of Horizontal Menu Bar -->

<!-- <header id="header" class="navbar navbar-static-top">
  <div class="navbar-header"> <a type="button" id="button-menu" class="pull-left"> <i class="fa fa-bars fa-lg"></i> </a> <a href="<?php echo base_url();?>user/dashboard" class="navbar-brand">
    <h4 class="navbar-logo moblogo"> 
      <font face="Franklin Gothic Medium">
      <?=WEBNAME;?>
      </font> </h4>
    </a> </div>
  <ul class="nav pull-right">
    <li> <a href="<?php echo base_url();?>Registration/logout"> <span class="hidden-xs hidden-sm hidden-md">Logout</span> <i class="fa fa-sign-out fa-lg"></i> </a> </li>
  </ul>
</header> -->

<nav class="navbar navbar-expand-lg main-navbar">
					<a class="header-brand" href="<?php echo base_url();?>Registration/dashboard">
						<!-- <img src="assets/img/brand/logo-1.png" class="header-brand-img" alt=""> -->
						CinemaicMJ
					</a>
					
					<form class="form-inline mr-auto">
						<ul class="navbar-nav mr-3">
							<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
							<li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i class="ion ion-search"></i></a></li>
						</ul>
						
					</form>				
					<ul class="navbar-nav navbar-right ml-auto ">
						<!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="ion-ios-email-outline"></i></a>
							<div class="dropdown-menu dropdown-list dropdown-menu-right">
								<div class="dropdown-header">Messages
									<div class="float-right">
										<a href="#">View All</a>
									</div>
								</div>
							</div>
						</li> -->
						<li class="dropdown dropdown-list-toggle" style="margin-right:16px;"><a href="#">
						<i class="ion-ios-bell-outline" style="font-size: 24px;"></i><a class="notification-icon--fixed" href="#">
					<small class="notification-badge"><?php //echo $noticecount; ?></small>
					</a></a>

							<!-- <a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg beep"><i class="ion-ios-bell-outline"></i></a> -->
							<div class="dropdown-menu dropdown-list dropdown-menu-right">
								<div class="dropdown-header">Notifications
									<div class="float-right">
										<a href="#">View All</a>
									</div>
								</div>
							</div>
						</li>
						<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
							<div class="d-sm-none d-lg-inline-block">
							<?php if($this->session->userdata('username')) echo $this->session->userdata('username');?>
							</div></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="<?php echo base_url();?>Registration/logout" class="dropdown-item has-icon">
									<i class="ion-ios-redo"></i> Logout
								</a>
							</div>
						</li>
					</ul>
				</nav>

<!-- End Of Horizontal Menu Bar--> 

<!-- Start Of verticle Menu Bar-->
				<aside class="app-sidebar" style="z-index: 9999;">
					<div class="app-sidebar__user">
					    <div class="dropdown">
							<a class="nav-link pl-2  leading-none d-flex" data-toggle="dropdown" href="<?php echo base_url();?>user/dashboard">
								<!-- <img alt="image" src="<?php echo base_url(); ?>public/img/brand/logo-iron-buzz.png" class=" avatar-md "> -->
								<!-- <span class="ml-2 d-lg-block"> -->
									<!-- <span class=" app-sidebar__user-name mt-5">Rameez</span><br> -->
									<!-- <span class="text-muted app-sidebar__user-name text-sm"> Web-Designer</span> -->
								<!-- </span> -->
							</a>
						</div>
					</div>
				<ul class="side-menu">
						<li>
							<a class="side-menu__item"  href="<?php echo base_url();?>Registration/dashboard" style="<?php if(!in_array("Dashboard",$page)){echo "display:none";}?>"><i class="side-menu__icon fa fa-desktop"></i><span class="side-menu__label">Dashboard</span></a>
						</li>
                        
						<li>
							<a class="side-menu__item" href="<?php echo base_url();?>Nav/manage_portfolio/<?php echo $no;?>" style="<?php if(!in_array("Manage Portfolio",$page)){echo "display:none";}?>"><i class="side-menu__icon fa fa-rss fa-fw"></i><span class="side-menu__label">Manage Portfolio</span></a>
						</li>

						<!-- <li class="slide" id="appointment">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-tasks fa-fw"></i><span class="side-menu__label">Home page</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="<?php //echo base_url();?>Home_banner/home_banner" class="slide-item">Add Banner</a></li>					
								<li><a href="" class="slide-item">Add Reviews</a></li>					
							</ul>
						</li> -->

						<li>
							<a class="side-menu__item" href="<?php echo base_url();?>Faq/add_faq"><i class="side-menu__icon fa fa-rss fa-fw"></i><span class="side-menu__label">About Us</span></a>
						</li>

						<li>
							<a class="side-menu__item" href="<?php echo base_url();?>Home_banner/home_banner"><i class="side-menu__icon fa fa-rss fa-fw"></i><span class="side-menu__label">Home Banner</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="<?php echo base_url();?>Page_banner/page_banner"><i class="side-menu__icon fa fa-rss fa-fw"></i><span class="side-menu__label">Pages Banner</span></a>
						</li>
						
						<li>
							<a class="side-menu__item"  href="<?php echo base_url();?>Nav/manage_websites" style="<?php if(!in_array("Manage Website",$page)){echo "display:none";}?>"><i class="side-menu__icon fa fa-globe fa-fw"></i><span class="side-menu__label">Manage Website</span></a>
						</li>
						
					</ul>
				</aside>
<!-- End Of verticle Menu Bar-->
