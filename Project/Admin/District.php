<?php
include('Head.php');
include("../Assets/connection/Connection.php");
if(isset($_POST["btn_Save"]))
{
	
	$name=$_POST["txt_Dname"];
		$insqry="insert into tbl_district(district_name) values('".$name."')";
		if($con->query($insqry))
		{
			?>
			<script>
				alert("Inserted");
				window.location="District.php";
			</script>
			<?php
			
		}
}
  
  
 ?>
  <?php
  
if(isset($_GET["delID"]))
{
	
	
		$delete="delete from tbl_district where district_id='".$_GET["delID"]."'";
		if($con->query($delete))
		{
			?>
			<script>
				alert("Deleted");
				window.location="District.php";
			</script>
			<?php
		}
}

?>
<style>
/* Unique CSS for District Management Page */
.district-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.district-column-title {
    width: 100%;
    padding: 0 15px;
}

.district-page-title {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
}

.district-page-title h2 {
    color: #333;
    font-size: 24px;
    margin: 0;
    font-weight: 500;
}

.district-home-link {
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

.district-home-link:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.district-column1 {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.district-col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px;
}

.district-col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.district-price-table {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.district-price-head {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 15px 20px;
}

.district-price-head-cont h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.district-price-block {
    padding: 20px;
}

.district-price-block-cont {
    padding: 0;
}

.district-price-cont {
    padding: 0;
}

.district-form-group {
    margin-bottom: 15px;
}

.district-form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #555;
}

.district-form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.15s ease-in-out;
}

.district-form-control:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.district-center {
    text-align: center;
    margin-top: 20px;
}

.district-btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    padding: 10px 20px;
    color: #fff;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: opacity 0.15s ease-in-out;
    margin-right: 10px;
}

.district-btn-success:hover {
    opacity: 0.9;
}

.district-btn-cancel {
    background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
    border: none;
    padding: 10px 20px;
    color: #fff;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: opacity 0.15s ease-in-out;
}

.district-btn-cancel:hover {
    opacity: 0.9;
}

.district-table-responsive {
    overflow-x: auto;
    margin-top: 10px;
}

.district-table {
    width: 100%;
    margin-bottom: 0;
    background-color: transparent;
    border-collapse: collapse;
}

.district-table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

.district-table-bordered {
    border: 1px solid #dee2e6;
}

.district-table-bordered th,
.district-table-bordered td {
    border: 1px solid #dee2e6;
    padding: 12px 8px;
    vertical-align: top;
}

.district-table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-align: left;
}

.district-table tbody td {
    color: #495057;
}

.district-btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
    padding: 6px 12px;
    color: #fff;
    border-radius: 4px;
    font-size: 12px;
    text-decoration: none;
    display: inline-block;
    transition: opacity 0.15s ease-in-out;
}

.district-btn-danger:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .district-col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
                     <div class="district-row district-column_title">
                        <div class="district-col-md-12">
                           <div class="district-page_title">
                              <a href="AdminHome.php" class="district-home-link">Home</a>
                              <h2>District Management</h2>
                           </div>
                        </div>
                     </div>
                     <div class="district-row district-column1">
                        <div class="district-col-md-6">
                           <div class="district-full district-price_table district-margin_bottom_30">
                              <div class="district-full district-price_head">
                                 <div class="district-full district-price_head_cont">
                                    <h3>Add New District</h3>
                                 </div>
                              </div>
                              <div class="district-full district-price_block">
                                 <form id="form1" name="form1" method="post" action="">
                                    <div class="district-full district-price_block_cont">
                                       <div class="district-full district-price_cont">
                                          <div class="district-row">
                                             <div class="district-col-md-12">
                                                <div class="district-form-group">
                                                   <label for="txt_Dname">District Name</label>
                                                   <input type="text" class="district-form-control" name="txt_Dname" id="txt_Dname" placeholder="Enter Districtname" required />
                                                </div>
                                             </div>
                                             <div class="district-center">
                                                <input type="submit" name="btn_Save" id="btn_Save" class="district-btn-success" value="Save" />
                                                <input type="reset" id="btn_Cancel" class="district-btn-cancel" value="Cancel" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="district-col-md-12">
                           <div class="district-full district-price_table district-margin_bottom_30">
                              <div class="district-full district-price_head">
                                 <div class="district-full district-price_head_cont">
                                    <h3>District List</h3>
                                 </div>
                              </div>
                              <div class="district-full district-price_block">
                                 <div class="district-full district-price_block_cont">
                                    <div class="district-full district-price_cont">
                                       <div class="district-table-responsive">
                                          <table class="district-table district-table-striped district-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SI NO</th>
                                                   <th>District Name</th>
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $i=0;
                                             $selqry="select * from tbl_district";
                                             $row=$con->query($selqry);
                                             while($data=$row->fetch_assoc())
                                             {
                                                $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['district_name'] ?></td>
                                                   <td><a href="District.php?delID=<?php echo $data['district_id'] ?>" class="district-btn-danger" onclick="return confirm('Are you sure?');">Delete</a></td>
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