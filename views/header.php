<!DOCTYPE html>
<html>
    <head>
        <title>:: OFFICE MANAGEMENT SYSTEM ::</title>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="<?php echo base_url().'assets/css/';?>signin.css">
         <link href="<?php echo base_url() . 'assets/css/'; ?>style.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo base_url() . "assets/css/styles.css"; ?>">
        <link href="<?php echo base_url() . 'assets/css/'; ?>bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/'; ?>jquery.timepicker.css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/'; ?>style.css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/fonts/'; ?>font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
        
        <script src="<?php echo base_url() . 'assets/js/'; ?>jquery-1.11.1.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/ie-emulation-modes-warning.js"></script>
        <script src="<?php echo base_url() . "assets/js/script.js"; ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>jquery.timepicker.min.js"></script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>bootstrap.min.js"></script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>polyfiller.js"></script>
        
        <script>webshim.activeLang('en-AU');</script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var js_url = base_url + 'assets/js/';
            var css_url = base_url + 'assets/css/';
        </script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>ajax.js"></script>
      <!--mts link--> 
   
	<script src="<?php echo base_url() . 'assets/js/'; ?>jquery.simplePagination.js"></script>
        
        <script src="<?php echo base_url() . 'assets/js/'; ?>custom.js"></script>
       
       
        
    </head>
    <body>
<header role="banner" class="navbar navbar-bright navbar-fixed-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="background-color: #4c9ed9;margin-top: 0;">
                <nav role="navigation" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url().'main/home';?>">Home</a></li>
                        <li><a href="<?php echo base_url().'main/contact';?>">Contact</a></li>
                        <li><a href="#"></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded= "false">
                                <span class="glyphicon glyphicon-user"></span>user name:<?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];}?><span class="caret" style="text-align: right"></span></a>
                            <ul class="dropdown-menu" role="menu">
<!--                                <li><a href="<?php echo site_url();?>/main/manage_account"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Manage Account</a></li>
                                <li><a href="<?php echo site_url();?>/main/add_user"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add User</a></li>
                                <li><a href="<?php echo site_url();?>/main/change_password"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Change Password</a></li>
                                <li class="divider"></li>-->
                                <li><a href="<?php echo base_url().'main/logout';?>"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
    