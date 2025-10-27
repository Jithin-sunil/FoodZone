<?php
include('Head.php');
include("../Assets/connection/Connection.php");

if (isset($_GET['bid'])) {
    $user_id = $_GET['bid'];
    $upQry = "UPDATE tbl_user SET user_status=1 WHERE user_id='" . $user_id . "'";
    if ($con->query($upQry)) {
?>
        <script>
            alert("User Blocked Successfully");
            window.location = "UserList.php";
        </script>
<?php
    }
}

if (isset($_GET['uid'])) {
    $user_id = $_GET['uid'];
    $upQry = "UPDATE tbl_user SET user_status=0 WHERE user_id='" . $user_id . "'";
    if ($con->query($upQry)) {
?>
        <script>
            alert("User Unblocked Successfully");
            window.location = "UserList.php";
        </script>
<?php
    }
}
?>
<style>
/* Unique CSS for User List Page */
.user-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.user-column-title {
    width: 100%;
    padding: 0 15px;
}

.user-page-title {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
}

.user-page-title h2 {
    color: #333;
    font-size: 24px;
    margin: 0;
    font-weight: 500;
}

.user-home-link {
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

.user-home-link:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.user-column1 {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.user-col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.user-price-table {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.user-price-head {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 15px 20px;
}

.user-price-head-cont h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.user-price-block {
    padding: 20px;
}

.user-price-block-cont {
    padding: 0;
}

.user-price-cont {
    padding: 0;
}

.user-table-responsive {
    overflow-x: auto;
    margin-top: 10px;
}

.user-table {
    width: 100%;
    margin-bottom: 0;
    background-color: transparent;
    border-collapse: collapse;
}

.user-table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

.user-table-bordered {
    border: 1px solid #dee2e6;
}

.user-table-bordered th,
.user-table-bordered td {
    border: 1px solid #dee2e6;
    padding: 12px 8px;
    vertical-align: top;
}

.user-table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-align: left;
}

.user-table tbody td {
    color: #495057;
}

.user-img {
    max-width: 50px;
    height: auto;
    border-radius: 4px;
}

.user-btn-block {
    display: inline-block;
    padding: 6px 12px;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
    transition: opacity 0.15s ease-in-out;
}

.user-btn-block:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.user-btn-unblock {
    display: inline-block;
    padding: 6px 12px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
    transition: opacity 0.15s ease-in-out;
}

.user-btn-unblock:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .user-table-responsive {
        font-size: 12px;
    }
    
    .user-table-bordered th,
    .user-table-bordered td {
        padding: 8px 4px;
    }
}
</style>
                     <div class="user-row user-column_title">
                        <div class="user-col-md-12">
                           <div class="user-page_title">
                              <a href="AdminHome.php" class="user-home-link">Home</a>
                              <h2>User Management</h2>
                           </div>
                        </div>
                     </div>
                     <div class="user-row user-column1">
                        <div class="user-col-md-12">
                           <div class="user-full user-price_table user-margin_bottom_30">
                              <div class="user-full user-price_head">
                                 <div class="user-full user-price_head_cont">
                                    <h3>User List</h3>
                                 </div>
                              </div>
                              <div class="user-full user-price_block">
                                 <div class="user-full user-price_block_cont">
                                    <div class="user-full user-price_cont">
                                       <div class="user-table-responsive">
                                          <table class="user-table user-table-striped user-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SI NO</th>
                                                   <th>Photo</th>
                                                   <th>Name</th>
                                                   <th>Email</th>
                                                   <th>Status</th>
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $i=0;
                                             $selqry="select * from tbl_user";
                                             $row=$con->query($selqry);
                                             while($data=$row->fetch_assoc())
                                             {
                                                $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><img src="../Assets/Files/User/<?php echo $data['user_photo'] ?>" width="50" class="user-img" /></td>
                                                   <td><?php echo $data['user_name'] ?></td>
                                                   <td><?php echo $data['user_email'] ?></td>
                                                   <td><?php echo ($data['user_status']==0) ? 'Active' : 'Blocked'; ?></td>
                                                   <td>
                                                      <?php if($data['user_status']==0){ ?>
                                                         <a href="UserList.php?bid=<?php echo $data['user_id'] ?>" class="user-btn-block" onclick="return confirm('Are you sure you want to block this user?');">Block</a>
                                                      <?php } else { ?>
                                                         <a href="UserList.php?uid=<?php echo $data['user_id'] ?>" class="user-btn-unblock" onclick="return confirm('Are you sure you want to unblock this user?');">Unblock</a>
                                                      <?php } ?>
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
                     </div>
<?php
include('Foot.php');
?>