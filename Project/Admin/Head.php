<?php
session_start();
include("../Assets/connection/Connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <link rel="icon" href="../Assets/Templates/Admin/images/fevicon.png" type="image/png" />
   <!-- bootstrap css -->
   <link rel="stylesheet" href="../Assets/Templates/Admin/css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="../Assets/Templates/Admin/style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="../Assets/Templates/Admin/css/responsive.css" />
   <!-- color css -->
   <link rel="stylesheet" href="../Assets/Templates/Admin/css/colors.css" />
   <!-- select bootstrap -->
   <link rel="stylesheet" href="../Assets/Templates/Admin/css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="../Assets/Templates/Admin/css/perfect-scrollbar.css" />
   <!-- custom css -->
   <link rel="stylesheet" href="../Assets/Templates/Admin/css/custom.css" />
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="dashboard dashboard_1">
   <div class="full_container">
      <div class="inner_container">
         <!-- Sidebar  -->
         <nav id="sidebar">
            <div class="sidebar_blog_1">
               <div class="sidebar-header">
                  <div class="logo_section">
                     <a href="AdminHome.php"><img class="logo_icon img-responsive"
                           src="../Assets/Templates/Admin/images/logo/logo_icon.png" alt="#" /></a>
                  </div>
               </div>
               <div class="sidebar_user_info">
                  <div class="user_profle_side">
                     <div class="user_img"><img class="img-responsive"
                           src="../Assets/Templates/Admin/images/layout_img/user_img.jpg" alt="#" /></div>
                     <div class="user_info">
                        <h6><?php echo $_SESSION['aname']?></h6>
                        <p><span class="online_animation"></span> Online</p>
                     </div>
                  </div>
               </div>
            </div>

            <div class="sidebar_blog_2">
               <h4>Menu</h4>
               <ul class="list-unstyled components">
                  <li><a href="AdminHome.php"><i class="fa fa-home yellow_color"></i> <span>Dashboard</span></a></li>
                  <li><a href="Days.php"><i class="fa fa-calendar purple_color"></i> <span>Days</span></a></li>
                  <li><a href="DeliveryBoyList.php"><i class="fa fa-motorcycle blue2_color"></i> <span>Delivery Boy
                           List</span></a></li>
                  <li><a href="District.php"><i class="fa fa-map-marker green_color"></i> <span>District</span></a></li>
                  <li><a href="FoodCategory.php"><i class="fa fa-cutlery orange_color"></i> <span>Food
                           Category</span></a></li>
                  <li><a href="Foodtype.php"><i class="fa fa-spoon red_color"></i> <span>Food Type</span></a></li>
                  <li><a href="Place.php"><i class="fa fa-location-arrow yellow_color"></i> <span>Place</span></a></li>
                  <li><a href="RestaurantList.php"><i class="fa fa-building purple_color2"></i> <span>Restaurant
                           List</span></a></li>
                  <li><a href="Restauranttype.php"><i class="fa fa-tags blue1_color"></i> <span>Restaurant
                           Type</span></a></li>
                  <li><a href="UserList.php"><i class="fa fa-users green_color"></i> <span>User List</span></a></li>
                  <li><a href="ViewComplaint.php"><i class="fa fa-envelope red_color"></i> <span>View
                           Complaints</span></a></li>
               </ul>
            </div>
         </nav>

         <!-- end sidebar -->
         <!-- right content -->
         <div id="content">
            <!-- topbar -->
            <div class="topbar">
               <nav class="navbar navbar-expand-lg navbar-light">
                  <div class="full">
                     <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                           class="fa fa-bars"></i></button>
                     
                     <div class="right_topbar">
                        <div class="icon_info">
                           
                           <ul class="user_profile_dd">
                              <li>
                                 <a class="dropdown-toggle" data-toggle="dropdown"><img
                                       class="img-responsive rounded-circle"
                                       src="../Assets/Templates/Admin/images/layout_img/user_img.jpg" alt="#" /><span
                                       class="name_user"><?php echo $_SESSION['aname']?></span></a>
                                 <div class="dropdown-menu">
                                    
                                    <a class="dropdown-item" href="../Guest/LogOut.php"><span>Log Out</span> <i
                                          class="fa fa-sign-out"></i></a>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </nav>
            </div>
            <!-- end topbar -->
            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">