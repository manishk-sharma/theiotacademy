
<html>
    <head>
        <title>The IoT Academy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset_url();?>admin/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo asset_url();?>admin/css/fontawesome-all.min.css"/>
        <link rel="apple-touch-icon" href="<?=asset_url()?>images/iot-academy-favicon-32x32.png">
        <link rel="icon" href="<?=asset_url()?>images/iot-academy-favicon-32x32.png" type="image/x-icon" />
         <script type="text/javascript" src="<?php echo asset_url();?>admin/js/jquery.min.js"></script>
         <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <link href="<?php echo asset_url();?>admin/css/simple-sidebar.css" rel="stylesheet"/>
        <link href="<?php echo asset_url()?>admin/css/liststyle.css" rel="stylesheet"/>
        <style type="text/css">
            .sidebar-modify{
                background-color:#118c8b ;
            }
            .sidebar-item-modify{
                background-color:#118c8b ;
                color:white;
                font-weight: bold;
                border-color:white;
                border:none ;
                border-radius:0 ;
                text-align:left;
                /*font-family: 'Cabin Condensed', sans-serif;*/
                font-family:Calibri;
            }
            .sidebar-item-modify:hover{
                background-color:white ;
                color:#118c8b;
                font-weight: bold;
                border-color:white;
                border-radius:0 ;
            }
            .sidebar-item-modify:active{
                background-color:#118c8b ;
                color:white;
                font-weight: bold;
                border-color:white;
                border-radius:0 ;
                box-shadow:none !important; 
            }
            .sidebar-item-modify:focus{
                background-color:#118c8b ;
                color:white;
                font-weight: bold;
                border-color:white;
                border-radius:0 ;
                box-shadow:none !important; 
            }
            .sidebar-heading-modify{
                color:white;
                font-weight: bold;
                text-align:center;
            }

            .nav-item a{
                color:black!important;
            }
            .dropdown-item{
                color:black!important;
            }
            .userimage{
                border-radius:50% ;
                height:40px;
                width:40px;
            }
            
            .dropright:hover .dropdown-menu{
                /*display:block;*/
            }
           .dropdown-menu{
                border-color:#118c8b;
                border-left:none;
                border-top-left-radius: 0 ;
                border-bottom-left-radius: 0;
           }
           .lead{
                font-family:Calibri;
            }
           .form-control{
             font-size:14px;
            }
            .heading{
                font-family:Calibri;
            }
            .shortbtn{
                width:30px;
            }
            .iconsize{
                font-size:12px;
            }
            .custbtn {
              background-color: #4CAF50; /* Green */
              border: none;
              color: white;
              padding-top: 7px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 0px 0px;
              cursor: pointer;
              background-color: #f8f9fa;
              color: #6c757d;
              border:none;
              outline: none;
            }
            .custbtn:hover{
                background-color: #f8f9fa;
                 color: black;
            }
            .custbtn:focus{
                outline: none;
            }
        </style>
    </head>
    <body>
    <div class="d-flex" id="wrapper">
        <?php $this->load->view("assignment/admin/common/left_sidebar.php") ;?>
        <div id="page-content-wrapper">
            <header id="headersection">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <!--<a class="navbar-brand" href="#">Navbar</a>-->
                <button class="btn btn-light" id="menu-toggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>aemployee">Employees</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>auserportal">Users</a>
                    </li>
					</ul> -->
    
                </div>
                </nav>
            </header>
           
