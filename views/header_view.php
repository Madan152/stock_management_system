<!DOCTYPE html>
<html lang="en">
    <head>
        <title>:: OFFICE MANAGEMENT SYSTEM ::</title>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?php echo base_url() . 'assets/css/'; ?>bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/'; ?>jquery-ui.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/'; ?>bootstrap-duallistbox.min.css" />
        <link href="<?php echo base_url() . 'assets/css/'; ?>font-awesome.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/'; ?>jquery-ui-timepicker-addon.css" />
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/chosen/'; ?>chosen.css" />
<!--        <link href="<?php echo base_url() . 'assets/css/'; ?>chosen.css" rel="stylesheet"/>-->
        <link href="<?php echo base_url() . 'assets/plugins/dataTables/'; ?>dataTables.bootstrap.css" rel="stylesheet"/>
        
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/'; ?>signin.css">
        <link href="<?php echo base_url() . 'assets/css/'; ?>style.css" rel="stylesheet"/>
        <link href="<?php echo base_url() . 'assets/css/'; ?>styles.css" rel="stylesheet"/>  
        <link href="<?php echo base_url() . "assets/css/main.css"; ?>" rel="stylesheet">


        

        <script src="<?php echo base_url() . 'assets/js/'; ?>jquery-1.11.1.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url() . 'assets/js/'; ?>jquery-ui.js" type="text/javascript"></script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>bootstrap.min.js" type="text/javascript"></script>
        <script  src="<?php echo base_url() . 'assets/plugins/dataTables/'; ?>jquery.dataTables.js"></script>
        <script  src="<?php echo base_url() . 'assets/plugins/dataTables/'; ?>dataTables.bootstrap.js"></script>
       
        <script src="<?php echo base_url() . 'assets/plugins/chosen/'; ?>chosen.jquery.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url() . 'assets/plugins/chosen/'; ?>chosen.proto.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url() . 'assets/js/'; ?>jquery.rowspanizer.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>moment.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>jquery.bootstrap-duallistbox.min.js"></script>



        <!--<script>webshim.activeLang('en-AU');</script>-->
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var js_url = base_url + 'assets/js/';
            var css_url = base_url + 'assets/css/';
        </script>
        <script src="<?php echo base_url() . "assets/js/script.js"; ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>ajax.js"></script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>jquery.simplePagination.js"></script>
        <script src="<?php echo base_url() . 'assets/js/'; ?>custom.js"></script>
    </head>
    
    
    
    
    
    
    
    
    <body class="manager-home login">

        <div class="modal fade" id="myModal"> <!-- modal div start -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!--                        <button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

       <header role="banner" class="navbar navbar-bright navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button data-target=".navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href=""> O M S </a>-->
<!--<a href="" title=""><img src="<?php // echo base_url().'assets/img/'.$_SESSION['ims_db_prefix'].'/site_logo/site_logo.png';?>" style="  height: 42px; width: 40px; padding-top: 10px;"/></a>-->
                </div>
                <nav role="navigation" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <?php
                        if ($_SESSION['oms_role_name'] != "Anonymous") {
                            ?>
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            
                            

                            <li class="dropdown mega-dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Stock Management<span class="caret text-right"></span></a>
                                <ul class="dropdown-menu header_tab mega-dropdown-menu row">
                                    <li class="col-sm-3">
                                        <ul>
                                            <li class = "dropdown-header menu Stock Management">Stock Category</li>
                                            <?php
                                            
                                            
                                                echo '<li class = "pending"><a href = "' . base_url() . 'stock/add_stock_category">Add Stock Category</a></li>';
                                           
                                                echo '<li class = "pending"><a href = "' . base_url() . 'stock/manage">Manage Stock Category</a></li>';
                                          
                                            ?>
                                            
                                        </ul>
                                    </li>  
                                    <li class="col-sm-3">
                                        <ul>
                                            <li class = "dropdown-header menu Stock Management">Product</li>
                                            <?php
                                            
                                            
                                                echo '<li class = "pending"><a href = "' . base_url() . 'stock/add_product">Add Product</a></li>';
                                           
                                                echo '<li class = "pending"><a href = "' . base_url() . 'stock/manage_product">Manage Product</a></li>';
                                           
                                            ?>
                                            
                                        </ul>
                                    </li>     
                                    <li class="col-sm-3">
                                        <ul>
                                            <li class = "dropdown-header menu Stock Management">Vendor</li>
                                            <?php
                                            
                                            
                                                echo '<li class = "pending"><a href = "' . base_url() . 'stock/add_vendor">Add Vendor</a></li>';
                                           
                                                echo '<li class = "pending"><a href = "' . base_url() . 'stock/manage_vendor">Manage Vendor</a></li>';
                                          
                                            ?>
                                            
                                        </ul>
                                    </li>   
                                    <li class="col-sm-3">
                                        <ul>
                                            <li class = "dropdown-header menu Stock Management">Purchase Inventory</li>
                                            <?php                                
                                                echo '<li class = "pending"><a href = "' . base_url() . 'stock/purchase_product">Purchase</a></li>';                                           
                                                echo '<li class = "pending"><a href = "' . base_url() . 'stock/manage_purchase_product">Manage Purchase Product</a></li>';                                         
                                                echo '<li class = "pending"><a href = "' . base_url() . 'stock/">Sale Product</a></li>'; 
                                            ?>
                                            
                                        </ul>
                                    </li>                                                 
                                    
                                </ul>
                            </li>
                            
                        <?php } ?>           
                    </ul><!-- navbar end-->


                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a  href="<?php echo base_url(); ?>" >

                                <span class="badge badge-orange hicon">
                                    <?php
                                    echo $this->custom->event_counter();
//                                    echo "3";
                                    ?>
                                </span>
                                <i class="fa fa-bell fa-lg"></i>
                            </a>
                        </li>
<!--                        <li>
                            <img src="<?php echo base_url(); ?>assets/img/no-image.jpg" alt="" class="img-circle" <img src="<?php echo base_url(); ?>assets/img/no-image.jpg" alt="" class="img-circle" style="height:30px;width: 30px">
                        </li>-->
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded= "false">
                                
                                <span class="glyphicon glyphicon-user"></span>
                                <?php
                                if (isset($_SESSION['oms_user_name'])) {
                                    echo $_SESSION['oms_user_name'];
                                }
                                ?><span class="caret" style="text-align: right"></span></a><ul class="dropdown-menu" role="menu">
                                <?php
//                                if ($this->check_permission->validate_permissions("users", "add", "") == 7) {
//                                    echo '<li class = "users"><a href = "' . base_url() . 'users/add"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add User Account</a></li>';
//                                }
//                                if ($this->check_permission->validate_permissions("users", "manage", "") == 7) {
//                                    echo '<li class = "users"><a href = "' . base_url() . 'users/manage"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Manage User Account</a></li>';
//                                }
                                ?>
                                <li><a href="<?php echo base_url(); ?>main/change_password"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;change password</a></li> 
                                <li><a href="<?php echo base_url() . 'main/logout'; ?>"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;Logout</a></li>

                            </ul>
                        </li>
                    </ul><!--end nav pull-right-->
                </nav>
            </div>
        </header>
		
		<?php // echo '<pre>';print_r($_SESSION);die; ?>

<!--for hide permissions Menu Tab-->
<!--end for hide permissions Menu Tab-->