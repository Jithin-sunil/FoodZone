<?php
include('Head.php');
include("../Assets/connection/Connection.php");
?>
<style>
/* Unique CSS for View Complaints Page */
.complaint-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.complaint-column-title {
    width: 100%;
    padding: 0 15px;
}

.complaint-page-title {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
}

.complaint-page-title h2 {
    color: #333;
    font-size: 24px;
    margin: 0;
    font-weight: 500;
}

.complaint-home-link {
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

.complaint-home-link:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.complaint-column1 {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.complaint-col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.complaint-price-table {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.complaint-price-head {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 15px 20px;
}

.complaint-price-head-cont h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.complaint-price-block {
    padding: 20px;
}

.complaint-price-block-cont {
    padding: 0;
}

.complaint-price-cont {
    padding: 0;
}

.complaint-table-responsive {
    overflow-x: auto;
    margin-top: 10px;
}

.complaint-table {
    width: 100%;
    margin-bottom: 0;
    background-color: transparent;
    border-collapse: collapse;
}

.complaint-table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

.complaint-table-bordered {
    border: 1px solid #dee2e6;
}

.complaint-table-bordered th,
.complaint-table-bordered td {
    border: 1px solid #dee2e6;
    padding: 12px 8px;
    vertical-align: top;
}

.complaint-table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-align: left;
}

.complaint-table tbody td {
    color: #495057;
    word-wrap: break-word;
    max-width: 200px;
}

.complaint-btn-reply {
    display: inline-block;
    padding: 6px 12px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 12px;
    transition: opacity 0.15s ease-in-out;
}

.complaint-btn-reply:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .complaint-table-responsive {
        font-size: 12px;
    }
    
    .complaint-table-bordered th,
    .complaint-table-bordered td {
        padding: 8px 4px;
    }
}
</style>
                     <div class="complaint-row complaint-column_title">
                        <div class="complaint-col-md-12">
                           <div class="complaint-page_title">
                              <a href="AdminHome.php" class="complaint-home-link">Home</a>
                              <h2>View Complaints</h2>
                           </div>
                        </div>
                     </div>
                     <div class="complaint-row complaint-column1">
                        <div class="complaint-col-md-12">
                           <div class="complaint-full complaint-price_table complaint-margin_bottom_30">
                              <div class="complaint-full complaint-price_head">
                                 <div class="complaint-full complaint-price_head_cont">
                                    <h3>Pending Complaints</h3>
                                 </div>
                              </div>
                              <div class="complaint-full complaint-price_block">
                                 <div class="complaint-full complaint-price_block_cont">
                                    <div class="complaint-full complaint-price_cont">
                                       <div class="complaint-table-responsive">
                                          <table class="complaint-table complaint-table-striped complaint-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SI.NO</th>
                                                   <th>User Name</th>
                                                   <th>Email</th>
                                                   <th>Contact</th>
                                                   <th>Title</th>
                                                   <th>Content</th>
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $i = 0;
                                             $selqry = "SELECT * 
                                                        FROM tbl_complaint c 
                                                        INNER JOIN tbl_user u ON c.user_id = u.user_id 
                                                        WHERE c.complaint_reply = ''";
                                             $result = $con->query($selqry);
                                             while ($data = $result->fetch_assoc()) {
                                                 $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['user_name'] ?></td>
                                                   <td><?php echo $data['user_email'] ?></td>
                                                   <td><?php echo $data['user_contact'] ?></td>
                                                   <td><?php echo $data['complaint_title'] ?></td>
                                                   <td><?php echo $data['complaint_content'] ?></td>
                                                   <td>
                                                      <a href="Reply.php?cid=<?php echo $data['complaint_id'] ?>" class="complaint-btn-reply">Reply</a>
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
                        <div class="complaint-col-md-12">
                           <div class="complaint-full complaint-price_table complaint-margin_bottom_30">
                              <div class="complaint-full complaint-price_head">
                                 <div class="complaint-full complaint-price_head_cont">
                                    <h3>Replied Complaints</h3>
                                 </div>
                              </div>
                              <div class="complaint-full complaint-price_block">
                                 <div class="complaint-full complaint-price_block_cont">
                                    <div class="complaint-full complaint-price_cont">
                                       <div class="complaint-table-responsive">
                                          <table class="complaint-table complaint-table-striped complaint-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SI.NO</th>
                                                   <th>User Name</th>
                                                   <th>Email</th>
                                                   <th>Contact</th>
                                                   <th>Title</th>
                                                   <th>Content</th>
                                                   <th>Reply</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $i = 0;
                                             $selqry = "SELECT * 
                                                        FROM tbl_complaint c 
                                                        INNER JOIN tbl_user u ON c.user_id = u.user_id 
                                                        WHERE c.complaint_reply != ''";
                                             $result = $con->query($selqry);
                                             while ($data = $result->fetch_assoc()) {
                                                 $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['user_name'] ?></td>
                                                   <td><?php echo $data['user_email'] ?></td>
                                                   <td><?php echo $data['user_contact'] ?></td>
                                                   <td><?php echo $data['complaint_title'] ?></td>
                                                   <td><?php echo $data['complaint_content'] ?></td>
                                                   <td><?php echo $data['complaint_reply'] ?></td>
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