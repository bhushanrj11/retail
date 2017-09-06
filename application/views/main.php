<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/agritech logo.jpg'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Govind Furniture</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url('assets/css/animate.min.css');?>" rel="stylesheet" />
    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo base_url('assets/css/light-bootstrap-dashboard.css');?>" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'> -->
    <link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css'); ?>" rel="stylesheet" />
  
    <link href="<?php echo base_url('assets/css/dataTables.bootstrap.min.css');?>" rel="stylesheet" />


    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" />
</head>

<body>
    
    <input type="hidden" name="baseUrl" id="baseUrl" value='<?php echo base_url(); ?>'>
    <input type="hidden" name="Urlstocks" id="Urlstocks" value='<?php echo $urlStocks; ?>'>
    <input type="hidden" name="msg_type" id="msg_type" value=" <?php echo $this->session->flashdata('msg_type')?>">
    <input type="hidden" name="msg" id="msg" value="<?php echo $this->session->flashdata('msg')?>">
   
    <div class="wrapper">
        <div class="sidebar" data-color="red" data-image="<?php echo base_url('assets/img/sidebar-5.jpg');?>">
            <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                    Govind Furniture 
                </a>
                </div>
                <ul class="nav">
                   
                    <li class="<?php echo $view_file == 'dashbord' ? "active" : ""  ?>">
                        <a href="<?php echo base_url('site/dashbord') ?>">
                            <i class="pe-7s-graph"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="<?php echo $view_file == 'add_sell_order' ? "active" : ""  ?>">
                        <a href="<?php echo base_url('site/add_sell_order') ?>">
                            <i class="pe-7s-cart"></i>
                            <p>Sell Order</p>
                        </a>
                    </li>
                    <li class="<?php echo $view_file == 'orders' ? "active" : ""  ?>">
                        <a href="<?php echo base_url('site/orders') ?>">
                            <i class="pe-7s-wallet"></i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <li class="<?php echo $view_file == 'add_purchase_order' ? "active" : ""  ?>">
                        <a href="<?php echo base_url('site/add_purchase_order') ?>">
                            <i class="pe-7s-box1"></i>
                            <p>Add Purchase Order</p>
                        </a>
                    </li>
                    <li class="<?php echo ($view_file == 'company_info' || $view_file == 'add_company_info') ? "active" : ""  ?>">
                        <a href="<?php echo base_url('site/company_info') ?>">
                            <i class="pe-7s-science"></i>
                            <p>Company Info</p>
                        </a>
                    </li>

                    <li class="<?php echo ( ($view_file == 'vender' || $view_file == 'add_vender' ) && $page_title == 'Vender' ) ? "active" : ""  ?>">
                        <a href="<?php echo base_url('site/vender/0'); ?>">
                            <i class="pe-7s-user"></i>
                            <p>Vender</p>
                        </a>
                    </li>

                    <li class="<?php echo ( ($view_file == 'vender' || $view_file == 'add_vender' ) && $page_title == 'Customer'  ) ? "active" : ""  ?>">
                        <a href="<?php echo base_url('site/vender/1'); ?>">
                            <i class="pe-7s-user"></i>
                            <p>Customer</p>
                        </a>
                    </li>

                    <li class="<?php echo ( $view_file == 'item' || $view_file == 'add_item' ) ? "active" : ""  ?>">
                        <a href="<?php echo base_url('site/item') ?>">
                            <i class="pe-7s-note2"></i>
                            <p>Item</p>
                        </a>
                    </li> 
                    <li class="<?php echo ($view_file == 'unit_measure' || $view_file == 'add_unit_measure' ) ? "active" : ""  ?>">
                        <a href="<?php echo base_url('site/unit_measure') ?>">
                            <i class="pe-7s-news-paper"></i>
                            <p>Unit Measure</p>
                        </a>
                    </li>                    
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2" onclick="Dashboard.logout()" style="margin-right:25px;">
                            Logout
                        </button>
                        <a class="navbar-brand" href="#"><?= $page_title; ?></a>
                    </div>
                    <div class="collapse navbar-collapse">
                <!--         <ul class="nav navbar-nav navbar-left">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">5</span>
                                    <p class="hidden-lg hidden-md">
                                        5 Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>
                        </ul> -->
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Reports
                                    <b class="caret"></b>
                                </a>
                                 <ul class="dropdown-menu">
                                    <li><a href="#">Reports One</a></li>
                                    <li><a href="#">Reports Two</a></li>
                                    <li><a href="#">Reports Three</a></li>
                                    <li><a href="#">Reports Four</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Downloads</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url('login/logout'); ?>" >
                                    <p>Log out</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php $this->load->view($view_file) ?>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                        document.write(new Date().getFullYear())
                        </script> <a href="#">bj-inc</a> love web
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <?php $this->load->view('modal'); ?>
</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>
<!--  Checkbox, Radio & Switch Plugins -->
<!--script src="assets/js/bootstrap-checkbox-radio-switch.js"></script-->
<!--  Charts Plugin -->
<!--script src="assets/js/chartist.min.js"></script-->
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js');?>" type="text/javascript"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
  
    var msg_type = $('#msg_type').val(),
        msg = $('#msg').val();
    if(msg_type && msg){
        Dashboard.showAlert({msg:msg},msg_type);    
    }
    Dashboard.load();
    // $("#myBtn").click(function(){
    //     $("#myModal").modal();
    // });

});
</script>

</html>
