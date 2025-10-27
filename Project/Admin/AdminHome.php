<?php
include('Head.php');
?>
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Dashboard</h2>
                           </div>
                        </div>
                     </div>
                     <div class="row column1">
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-user yellow_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php
                                    $sel = "SELECT COUNT(*) as total FROM tbl_user";
                                    $qry = $con->query($sel);
                                    $row = $qry->fetch_assoc();
                                    echo $row['total'];
                                    ?></p>
                                    <p class="head_couter">Total Users</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-cutlery blue1_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php
                                    $sel = "SELECT COUNT(*) as total FROM tbl_restaurant";
                                    $qry = $con->query($sel);
                                    $row = $qry->fetch_assoc();
                                    echo $row['total'];
                                    ?></p>
                                    <p class="head_couter">Total Restaurants</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-motorcycle green_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php
                                    $sel = "SELECT COUNT(*) as total FROM tbl_deliveryboy";
                                    $qry = $con->query($sel);
                                    $row = $qry->fetch_assoc();
                                    echo $row['total'];
                                    ?></p>
                                    <p class="head_couter">Total Delivery Boys</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-comments-o red_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php
                                    $sel = "SELECT COUNT(*) as total FROM tbl_complaint";
                                    $qry = $con->query($sel);
                                    $row = $qry->fetch_assoc();
                                    echo $row['total'];
                                    ?></p>
                                    <p class="head_couter">Total Complaints</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row column1">
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-cutlery green_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php
                                    $sel = "SELECT COUNT(*) as total FROM tbl_food";
                                    $qry = $con->query($sel);
                                    $row = $qry->fetch_assoc();
                                    echo $row['total'];
                                    ?></p>
                                    <p class="head_couter">Total Food Items</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-book orange_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php
                                    $sel = "SELECT COUNT(*) as total FROM tbl_booking";
                                    $qry = $con->query($sel);
                                    $row = $qry->fetch_assoc();
                                    echo $row['total'];
                                    ?></p>
                                    <p class="head_couter">Total Bookings</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-map-marker purple_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php
                                    $sel = "SELECT COUNT(*) as total FROM tbl_district";
                                    $qry = $con->query($sel);
                                    $row = $qry->fetch_assoc();
                                    echo $row['total'];
                                    ?></p>
                                    <p class="head_couter">Total Districts</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-location-arrow red_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php
                                    $sel = "SELECT COUNT(*) as total FROM tbl_place";
                                    $qry = $con->query($sel);
                                    $row = $qry->fetch_assoc();
                                    echo $row['total'];
                                    ?></p>
                                    <p class="head_couter">Total Places</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
<?php
include('Foot.php');
?>