<?php
include('Head.php');
include("../Assets/connection/Connection.php");

if (isset($_GET['aid'])) {
    $deliveryboy_id = $_GET['aid'];
    $upQry = "UPDATE tbl_deliveryboy SET deliveryboy_status=1 WHERE deliveryboy_id='" . $deliveryboy_id . "'";
    if ($con->query($upQry)) {
?>
        <script>
            alert("Delivery Boy Verified Successfully");
            window.location = "DeliveryBoyList.php";
        </script>
<?php
    }
}

if (isset($_GET['rid'])) {
    $deliveryboy_id = $_GET['rid'];
    $upQry = "UPDATE tbl_deliveryboy SET deliveryboy_status=2 WHERE deliveryboy_id='" . $deliveryboy_id . "'";
    if ($con->query($upQry)) {
?>
        <script>
            alert("Delivery Boy Rejected Successfully");
            window.location = "DeliveryBoyList.php";
        </script>
<?php
    }
}
?>
<style>
/* Unique CSS for Delivery Boy List Page */
.delivery-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.delivery-column-title {
    width: 100%;
    padding: 0 15px;
}

.delivery-page-title {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
    text-align: center;
}

.delivery-page-title h2 {
    color: #333;
    font-size: 24px;
    margin: 0;
    font-weight: 500;
}

.delivery-home-link {
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

.delivery-home-link:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.delivery-column1 {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.delivery-col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.delivery-price-table {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.delivery-price-head {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 15px 20px;
}

.delivery-price-head-cont h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.delivery-price-block {
    padding: 20px;
}

.delivery-price-block-cont {
    padding: 0;
}

.delivery-price-cont {
    padding: 0;
}

.delivery-table-responsive {
    overflow-x: auto;
    margin-top: 10px;
}

.delivery-table {
    width: 100%;
    margin-bottom: 0;
    background-color: transparent;
    border-collapse: collapse;
}

.delivery-table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

.delivery-table-bordered {
    border: 1px solid #dee2e6;
}

.delivery-table-bordered th,
.delivery-table-bordered td {
    border: 1px solid #dee2e6;
    padding: 12px 8px;
    vertical-align: top;
}

.delivery-table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-align: left;
}

.delivery-table tbody td {
    color: #495057;
}

.delivery-img {
    max-width: 100px;
    height: auto;
    border-radius: 4px;
}

.delivery-btn-accept {
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

.delivery-btn-accept:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.delivery-btn-reject {
    display: inline-block;
    padding: 6px 12px;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
    transition: opacity 0.15s ease-in-out;
}

.delivery-btn-reject:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .delivery-table-responsive {
        font-size: 12px;
    }
    
    .delivery-table-bordered th,
    .delivery-table-bordered td {
        padding: 8px 4px;
    }
}
</style>
                     <div class="delivery-row delivery-column_title">
                        <div class="delivery-col-md-12">
                           <div class="delivery-page_title">
                              <a href="AdminHome.php" class="delivery-home-link">Home</a>
                              <h2>Delivery Boy Management</h2>
                           </div>
                        </div>
                     </div>
                     <div class="delivery-row delivery-column1">
                        <div class="delivery-col-md-12">
                           <div class="delivery-full delivery-price_table delivery-margin_bottom_30">
                              <div class="delivery-full delivery-price_head">
                                 <div class="delivery-full delivery-price_head_cont">
                                    <h3>Pending Delivery Boy Verifications</h3>
                                 </div>
                              </div>
                              <div class="delivery-full delivery-price_block">
                                 <div class="delivery-full delivery-price_block_cont">
                                    <div class="delivery-full delivery-price_cont">
                                       <div class="delivery-table-responsive">
                                          <table class="delivery-table delivery-table-striped delivery-table-bordered">
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
                                             $selQry = "SELECT * FROM tbl_deliveryboy db
                                                        INNER JOIN tbl_place p ON db.place_id=p.place_id 
                                                        INNER JOIN tbl_district d ON p.district_id=d.district_id 
                                                        WHERE db.deliveryboy_status=0";
                                             $i = 0;
                                             $row = $con->query($selQry);
                                             while ($data = $row->fetch_assoc()) {
                                                 $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['deliveryboy_name'] ?></td>
                                                   <td><?php echo $data['deliveryboy_email'] ?></td>
                                                   <td><?php echo $data['deliveryboy_contact'] ?></td>
                                                   <td><img src="../Assets/Files/DeliveryBoy/<?php echo $data['deliveryboy_photo'] ?>" width="100" class="delivery-img" /></td>
                                                   <td><img src="../Assets/Files/DeliveryBoy/<?php echo $data['deliveryboy_proof'] ?>" width="100" class="delivery-img" /></td>
                                                   <td><?php echo $data['district_name'] ?></td>
                                                   <td><?php echo $data['place_name'] ?></td>
                                                   <td>
                                                      <a href="DeliveryBoyList.php?aid=<?php echo $data['deliveryboy_id'] ?>" class="delivery-btn-accept" onclick="return confirm('Are you sure you want to accept this delivery boy?');">Accept</a>
                                                      <a href="DeliveryBoyList.php?rid=<?php echo $data['deliveryboy_id'] ?>" class="delivery-btn-reject" onclick="return confirm('Are you sure you want to reject this delivery boy?');">Reject</a>
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
                        <div class="delivery-col-md-12">
                           <div class="delivery-full delivery-price_table delivery-margin_bottom_30">
                              <div class="delivery-full delivery-price_head">
                                 <div class="delivery-full delivery-price_head_cont">
                                    <h3>Accepted Delivery Boys</h3>
                                 </div>
                              </div>
                              <div class="delivery-full delivery-price_block">
                                 <div class="delivery-full delivery-price_block_cont">
                                    <div class="delivery-full delivery-price_cont">
                                       <div class="delivery-table-responsive">
                                          <table class="delivery-table delivery-table-striped delivery-table-bordered">
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
                                             $selQryAccepted = "SELECT * FROM tbl_deliveryboy db
                                                                INNER JOIN tbl_place p ON db.place_id=p.place_id 
                                                                INNER JOIN tbl_district d ON p.district_id=d.district_id 
                                                                WHERE db.deliveryboy_status=1";
                                             $j = 0;
                                             $rowAccepted = $con->query($selQryAccepted);
                                             while ($dataAccepted = $rowAccepted->fetch_assoc()) {
                                                 $j++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $j ?></td>
                                                   <td><?php echo $dataAccepted['deliveryboy_name'] ?></td>
                                                   <td><?php echo $dataAccepted['deliveryboy_email'] ?></td>
                                                   <td><?php echo $dataAccepted['deliveryboy_contact'] ?></td>
                                                   <td><img src="../Assets/Files/DeliveryBoy/<?php echo $dataAccepted['deliveryboy_photo'] ?>" width="100" class="delivery-img" /></td>
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
                        <div class="delivery-col-md-12">
                           <div class="delivery-full delivery-price_table delivery-margin_bottom_30">
                              <div class="delivery-full delivery-price_head">
                                 <div class="delivery-full delivery-price_head_cont">
                                    <h3>Rejected Delivery Boys</h3>
                                 </div>
                              </div>
                              <div class="delivery-full delivery-price_block">
                                 <div class="delivery-full delivery-price_block_cont">
                                    <div class="delivery-full delivery-price_cont">
                                       <div class="delivery-table-responsive">
                                          <table class="delivery-table delivery-table-striped delivery-table-bordered">
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
                                             $selQryRejected = "SELECT * FROM tbl_deliveryboy db
                                                                INNER JOIN tbl_place p ON db.place_id=p.place_id 
                                                                INNER JOIN tbl_district d ON p.district_id=d.district_id 
                                                                WHERE db.deliveryboy_status=2";
                                             $k = 0;
                                             $rowRejected = $con->query($selQryRejected);
                                             while ($dataRejected = $rowRejected->fetch_assoc()) {
                                                 $k++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $k ?></td>
                                                   <td><?php echo $dataRejected['deliveryboy_name'] ?></td>
                                                   <td><?php echo $dataRejected['deliveryboy_email'] ?></td>
                                                   <td><?php echo $dataRejected['deliveryboy_contact'] ?></td>
                                                   <td><img src="../Assets/Files/DeliveryBoy/<?php echo $dataRejected['deliveryboy_photo'] ?>" width="100" class="delivery-img" /></td>
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