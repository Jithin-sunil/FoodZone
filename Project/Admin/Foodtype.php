<?php
include('Head.php');
include("../Assets/connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	
	$food=$_POST["txt_food"];	
		$insqry="insert into tbl_foodtype(foodtype_name) values('".$food."')";
		if($con->query($insqry))
		{
			?>
			<script>
				alert("Inserted");
				window.location="Foodtype.php";
			</script>
			<?php
		}
   
}

if(isset($_GET["delID"]))
{
	
		$delQry="delete from tbl_foodtype where foodtype_id='".$_GET["delID"]."'";
		if($con->query($delQry))
		{
			?>
			<script>
				alert("Deleted");
				window.location="Foodtype.php";
			</script>
			<?php
		}
   
}

?>
<style>
/* Unique CSS for Food Type Management Page */
.foodtype-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.foodtype-column-title {
    width: 100%;
    padding: 0 15px;
}

.foodtype-page-title {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
}

.foodtype-page-title h2 {
    color: #333;
    font-size: 24px;
    margin: 0;
    font-weight: 500;
}

.foodtype-home-link {
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

.foodtype-home-link:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.foodtype-column1 {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.foodtype-col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px;
}

.foodtype-col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.foodtype-price-table {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.foodtype-price-head {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 15px 20px;
}

.foodtype-price-head-cont h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.foodtype-price-block {
    padding: 20px;
}

.foodtype-price-block-cont {
    padding: 0;
}

.foodtype-price-cont {
    padding: 0;
}

.foodtype-form-group {
    margin-bottom: 15px;
}

.foodtype-form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #555;
}

.foodtype-form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.15s ease-in-out;
}

.foodtype-form-control:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.foodtype-center {
    text-align: center;
    margin-top: 20px;
}

.foodtype-btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    padding: 10px 20px;
    color: #fff;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: opacity 0.15s ease-in-out;
}

.foodtype-btn-success:hover {
    opacity: 0.9;
}

.foodtype-table-responsive {
    overflow-x: auto;
    margin-top: 10px;
}

.foodtype-table {
    width: 100%;
    margin-bottom: 0;
    background-color: transparent;
    border-collapse: collapse;
}

.foodtype-table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

.foodtype-table-bordered {
    border: 1px solid #dee2e6;
}

.foodtype-table-bordered th,
.foodtype-table-bordered td {
    border: 1px solid #dee2e6;
    padding: 12px 8px;
    vertical-align: top;
}

.foodtype-table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-align: left;
}

.foodtype-table tbody td {
    color: #495057;
}

.foodtype-btn-danger {
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

.foodtype-btn-danger:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .foodtype-col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
                     <div class="foodtype-row foodtype-column_title">
                        <div class="foodtype-col-md-12">
                           <div class="foodtype-page_title">
                              <a href="AdminHome.php" class="foodtype-home-link">Home</a>
                              <h2>Food Type Management</h2>
                           </div>
                        </div>
                     </div>
                     <div class="foodtype-row foodtype-column1">
                        <div class="foodtype-col-md-6">
                           <div class="foodtype-full foodtype-price_table foodtype-margin_bottom_30">
                              <div class="foodtype-full foodtype-price_head">
                                 <div class="foodtype-full foodtype-price_head_cont">
                                    <h3>Add New Food Type</h3>
                                 </div>
                              </div>
                              <div class="foodtype-full foodtype-price_block">
                                 <form id="form1" name="form1" method="post" action="">
                                    <div class="foodtype-full foodtype-price_block_cont">
                                       <div class="foodtype-full foodtype-price_cont">
                                          <div class="foodtype-row">
                                             <div class="foodtype-col-md-12">
                                                <div class="foodtype-form-group">
                                                   <label for="txt_food">Food Type</label>
                                                   <input type="text" class="foodtype-form-control" name="txt_food" id="txt_food" placeholder="Enter Foodtype" required />
                                                </div>
                                             </div>
                                             <div class="foodtype-center">
                                                <input type="submit" name="btn_submit" id="btn_submit" class="foodtype-btn-success" value="Submit" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="foodtype-col-md-12">
                           <div class="foodtype-full foodtype-price_table foodtype-margin_bottom_30">
                              <div class="foodtype-full foodtype-price_head">
                                 <div class="foodtype-full foodtype-price_head_cont">
                                    <h3>Food Type List</h3>
                                 </div>
                              </div>
                              <div class="foodtype-full foodtype-price_block">
                                 <div class="foodtype-full foodtype-price_block_cont">
                                    <div class="foodtype-full foodtype-price_cont">
                                       <div class="foodtype-table-responsive">
                                          <table class="foodtype-table foodtype-table-striped foodtype-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SL NO</th>
                                                   <th>Type</th>
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $i=0;
                                             $selqry="select * from tbl_foodtype";
                                             $row=$con->query($selqry);
                                             while($data=$row->fetch_assoc())
                                             {
                                                $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['foodtype_name'] ?></td>
                                                   <td><a href="Foodtype.php?delID=<?php echo $data['foodtype_id'] ?>" class="foodtype-btn-danger" onclick="return confirm('Are you sure?');">Delete</a></td>	
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