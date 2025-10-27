<?php
include('Head.php');
include("../Assets/connection/Connection.php");

if (isset($_GET['aid'])) {
    $restaurant_id = $_GET['aid'];
    $upQry = "UPDATE tbl_restaurant SET restaurant_status=1 WHERE restaurant_id='" . $restaurant_id . "'";
    if ($con->query($upQry)) {
?>
        <script>
            alert("Restaurant Verified Successfully");
            window.location = "RestaurantList.php";
        </script>
<?php
    }
}

if (isset($_GET['rid'])) {
    $restaurant_id = $_GET['rid'];
    $upQry = "UPDATE tbl_restaurant SET restaurant_status=2 WHERE restaurant_id='" . $restaurant_id . "'";
    if ($con->query($upQry)) {
?>
        <script>
            alert("Restaurant Rejected Successfully");
            window.location = "RestaurantList.php";
        </script>
<?php
    }
}
?>
<style>
/* Unique CSS for Restaurant List Page */
.rest-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.rest-column-title {
    width: 100%;
    padding: 0 15px;
}

.rest-page-title {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
    text-align: center;
}

.rest-page-title h2 {
    color: #333;
    font-size: 24px;
    margin: 0;
    font-weight: 500;
}

.rest-home-link {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 14px;
    transition: opacity 0.15s ease-in-out;
}

.rest-home-link:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.rest-column1 {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.rest-col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.rest-price-table {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.rest-price-head {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 15px 20px;
}

.rest-price-head-cont h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.rest-price-block {
    padding: 20px;
}

.rest-price-block-cont {
    padding: 0;
}

.rest-price-cont {
    padding: 0;
}

.rest-table-responsive {
    overflow-x: auto;
    margin-top: 10px;
}

.rest-table {
    width: 100%;
    margin-bottom: 0;
    background-color: transparent;
    border-collapse: collapse;
}

.rest-table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

.rest-table-bordered {
    border: 1px solid #dee2e6;
}

.rest-table-bordered th,
.rest-table-bordered td {
    border: 1px solid #dee2e6;
    padding: 12px 8px;
    vertical-align: top;
}

.rest-table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-align: left;
}

.rest-table tbody td {
    color: #495057;
}

.rest-img {
    max-width: 100px;
    height: auto;
    border-radius: 4px;
}

.rest-btn-accept {
    display: inline-block;
    margin-right: 10px;
    padding: 6px 12px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
    transition: opacity 0.15s ease-in-out;
}

.rest-btn-accept:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.rest-btn-reject {
    display: inline-block;
    padding: 6px 12px;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
    transition: opacity 0.15s ease-in-out;
}

.rest-btn-reject:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .rest-table-responsive {
        font-size: 12px;
    }
    
    .rest-table-bordered th,
    .rest-table-bordered td {
        padding: 8px 4px;
    }
}
</style>
                     <div class="rest-row rest-column_title">
                        <div class="rest-col-md-12">
                           <div class="rest-page_title">
                              <a href="AdminHome.php" class="rest-home-link">Home</a>
                              <h2>Restaurant Management</h2>
                           </div>
                        </div>
                     </div>
                     <div class="rest-row rest-column1">
                        <div class="rest-col-md-12">
                           <div class="rest-full rest-price_table rest-margin_bottom_30">
                              <div class="rest-full rest-price_head">
                                 <div class="rest-full rest-price_head_cont">
                                    <h3>Pending Restaurant Verifications</h3>
                                 </div>
                              </div>
                              <div class="rest-full rest-price_block">
                                 <div class="rest-full rest-price_block_cont">
                                    <div class="rest-full rest-price_cont">
                                       <div class="rest-table-responsive">
                                          <table class="rest-table rest-table-striped rest-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SI.NO</th>
                                                   <th>Name</th>
                                                   <th>Email</th>
                                                   <th>Contact</th>
                                                   <th>Photo</th>
                                                   <th>Proof</th>
                                                   <th>District</th>
                                                   <th>Place</th>
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $selQry = "SELECT * FROM tbl_restaurant r
                                                        INNER JOIN tbl_place p ON r.place_id=p.place_id 
                                                        INNER JOIN tbl_district d ON p.district_id=d.district_id 
                                                        WHERE r.restaurant_status=0";
                                             $i = 0;
                                             $row = $con->query($selQry);
                                             while ($data = $row->fetch_assoc()) {
                                                 $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['restaurant_name'] ?></td>
                                                   <td><?php echo $data['restaurant_email'] ?></td>
                                                   <td><?php echo $data['restaurant_contact'] ?></td>
                                                   <td><img src="../Assets/Files/Rest/Photo/<?php echo $data['restaurant_photo'] ?>" width="100" class="rest-img" /></td>
                                                   <td><img src="../Assets/Files/Rest/Proof/<?php echo $data['restaurant_proof'] ?>" width="100" class="rest-img" /></td>
                                                   <td><?php echo $data['district_name'] ?></td>
                                                   <td><?php echo $data['place_name'] ?></td>
                                                   <td>
                                                      <a href="RestaurantList.php?aid=<?php echo $data['restaurant_id'] ?>" class="rest-btn-accept" onclick="return confirm('Are you sure you want to accept this restaurant?');">Accept</a>
                                                      <a href="RestaurantList.php?rid=<?php echo $data['restaurant_id'] ?>" class="rest-btn-reject" onclick="return confirm('Are you sure you want to reject this restaurant?');">Reject</a>
                                                   </td>
                                                </tr>
                                             <?php
                                             }
                                             ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="rest-col-md-12">
                           <div class="rest-full rest-price_table rest-margin_bottom_30">
                              <div class="rest-full rest-price_head">
                                 <div class="rest-full rest-price_head_cont">
                                    <h3>Accepted Restaurants</h3>
                                 </div>
                              </div>
                              <div class="rest-full rest-price_block">
                                 <div class="rest-full rest-price_block_cont">
                                    <div class="rest-full rest-price_cont">
                                       <div class="rest-table-responsive">
                                          <table class="rest-table rest-table-striped rest-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SI.NO</th>
                                                   <th>Name</th>
                                                   <th>Email</th>
                                                   <th>Contact</th>
                                                   <th>Photo</th>
                                                   <th>District</th>
                                                   <th>Place</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $selQryAccepted = "SELECT * FROM tbl_restaurant r
                                                                INNER JOIN tbl_place p ON r.place_id=p.place_id 
                                                                INNER JOIN tbl_district d ON p.district_id=d.district_id 
                                                                WHERE r.restaurant_status=1";
                                             $j = 0;
                                             $rowAccepted = $con->query($selQryAccepted);
                                             while ($dataAccepted = $rowAccepted->fetch_assoc()) {
                                                 $j++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $j ?></td>
                                                   <td><?php echo $dataAccepted['restaurant_name'] ?></td>
                                                   <td><?php echo $dataAccepted['restaurant_email'] ?></td>
                                                   <td><?php echo $dataAccepted['restaurant_contact'] ?></td>
                                                   <td><img src="../Assets/Files/Rest/Photo/<?php echo $dataAccepted['restaurant_photo'] ?>" width="100" class="rest-img" /></td>
                                                   <td><?php echo $dataAccepted['district_name'] ?></td>
                                                   <td><?php echo $dataAccepted['place_name'] ?></td>
                                                </tr>
                                             <?php
                                             }
                                             ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="rest-col-md-12">
                           <div class="rest-full rest-price_table rest-margin_bottom_30">
                              <div class="rest-full rest-price_head">
                                 <div class="rest-full rest-price_head_cont">
                                    <h3>Rejected Restaurants</h3>
                                 </div>
                              </div>
                              <div class="rest-full rest-price_block">
                                 <div class="rest-full rest-price_block_cont">
                                    <div class="rest-full rest-price_cont">
                                       <div class="rest-table-responsive">
                                          <table class="rest-table rest-table-striped rest-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SI.NO</th>
                                                   <th>Name</th>
                                                   <th>Email</th>
                                                   <th>Contact</th>
                                                   <th>Photo</th>
                                                   <th>District</th>
                                                   <th>Place</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $selQryRejected = "SELECT * FROM tbl_restaurant r
                                                                INNER JOIN tbl_place p ON r.place_id=p.place_id 
                                                                INNER JOIN tbl_district d ON p.district_id=d.district_id 
                                                                WHERE r.restaurant_status=2";
                                             $k = 0;
                                             $rowRejected = $con->query($selQryRejected);
                                             while ($dataRejected = $rowRejected->fetch_assoc()) {
                                                 $k++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $k ?></td>
                                                   <td><?php echo $dataRejected['restaurant_name'] ?></td>
                                                   <td><?php echo $dataRejected['restaurant_email'] ?></td>
                                                   <td><?php echo $dataRejected['restaurant_contact'] ?></td>
                                                   <td><img src="../Assets/Files/Rest/Photo/<?php echo $dataRejected['restaurant_photo'] ?>" width="100" class="rest-img" /></td>
                                                   <td><?php echo $dataRejected['district_name'] ?></td>
                                                   <td><?php echo $dataRejected['place_name'] ?></td>
                                                </tr>
                                             <?php
                                             }
                                             ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
<?php
include('Foot.php');
?>