<?php
include('Head.php');
include("../Assets/connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	
  $category=$_POST["txt_name"];	
  $type=$_POST["sel_foodtype"];	

		$insqry="insert into tbl_foodcategory(foodcategory_name, foodtype_id) values('".$category."', '".$type."')";
		if($con->query($insqry))
		{
			?>
			<script>
				alert("Inserted");
				window.location="FoodCategory.php";
			</script>
			<?php
		}
   
}




if(isset($_GET["delID"]))
{
	
	
		$delete="delete from tbl_foodcategory where foodcategory_id ='".$_GET["delID"]."'";
		if($con->query($delete))
		{
			?>
			<script>
				alert("Deleted");
				window.location="FoodCategory.php";
			</script>
			<?php 
		}
}

?>
<style>
/* Unique CSS for Food Category Management Page */
.foodcat-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.foodcat-column-title {
    width: 100%;
    padding: 0 15px;
}

.foodcat-page-title {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
}

.foodcat-page-title h2 {
    color: #333;
    font-size: 24px;
    margin: 0;
    font-weight: 500;
}

.foodcat-home-link {
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

.foodcat-home-link:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.foodcat-column1 {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.foodcat-col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px;
}

.foodcat-col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.foodcat-price-table {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.foodcat-price-head {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 15px 20px;
}

.foodcat-price-head-cont h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.foodcat-price-block {
    padding: 20px;
}

.foodcat-price-block-cont {
    padding: 0;
}

.foodcat-price-cont {
    padding: 0;
}

.foodcat-form-group {
    margin-bottom: 15px;
}

.foodcat-form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #555;
}

.foodcat-form-control, .foodcat-select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.15s ease-in-out;
    background-color: #fff;
}

.foodcat-form-control:focus, .foodcat-select:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.foodcat-center {
    text-align: center;
    margin-top: 20px;
}

.foodcat-btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    padding: 10px 20px;
    color: #fff;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: opacity 0.15s ease-in-out;
}

.foodcat-btn-success:hover {
    opacity: 0.9;
}

.foodcat-table-responsive {
    overflow-x: auto;
    margin-top: 10px;
}

.foodcat-table {
    width: 100%;
    margin-bottom: 0;
    background-color: transparent;
    border-collapse: collapse;
}

.foodcat-table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

.foodcat-table-bordered {
    border: 1px solid #dee2e6;
}

.foodcat-table-bordered th,
.foodcat-table-bordered td {
    border: 1px solid #dee2e6;
    padding: 12px 8px;
    vertical-align: top;
}

.foodcat-table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-align: left;
}

.foodcat-table tbody td {
    color: #495057;
}

.foodcat-btn-danger {
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

.foodcat-btn-danger:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .foodcat-col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
                     <div class="foodcat-row foodcat-column_title">
                        <div class="foodcat-col-md-12">
                           <div class="foodcat-page_title">
                              <a href="AdminHome.php" class="foodcat-home-link">Home</a>
                              <h2>Food Category Management</h2>
                           </div>
                        </div>
                     </div>
                     <div class="foodcat-row foodcat-column1">
                        <div class="foodcat-col-md-6">
                           <div class="foodcat-full foodcat-price_table foodcat-margin_bottom_30">
                              <div class="foodcat-full foodcat-price_head">
                                 <div class="foodcat-full foodcat-price_head_cont">
                                    <h3>Add New Food Category</h3>
                                 </div>
                              </div>
                              <div class="foodcat-full foodcat-price_block">
                                 <form id="form1" name="form1" method="post" action="">
                                    <div class="foodcat-full foodcat-price_block_cont">
                                       <div class="foodcat-full foodcat-price_cont">
                                          <div class="foodcat-row">
                                             <div class="foodcat-col-md-12">
                                                <div class="foodcat-form-group">
                                                   <label for="sel_foodtype">Food Type</label>
                                                   <select name="sel_foodtype" id="sel_foodtype" class="foodcat-select" required>
                                                      <?php
                                                      $selqry="select * from tbl_foodtype";
                                                      $row=$con->query($selqry);
                                                      while($data=$row->fetch_assoc())
                                                      {
                                                      ?>
                                                         <option value="<?php echo $data['foodtype_id'] ?>"><?php echo $data['foodtype_name'] ?></option>
                                                      <?php
                                                      }
                                                      ?>
                                                   </select>
                                                </div>
                                                <div class="foodcat-form-group">
                                                   <label for="txt_name">Food Category Name</label>
                                                   <input type="text" class="foodcat-form-control" name="txt_name" id="txt_name" placeholder="Enter FoodCategoryName" required />
                                                </div>
                                             </div>
                                             <div class="foodcat-center">
                                                <input type="submit" name="btn_submit" id="btn_submit" class="foodcat-btn-success" value="Submit" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="foodcat-col-md-12">
                           <div class="foodcat-full foodcat-price_table foodcat-margin_bottom_30">
                              <div class="foodcat-full foodcat-price_head">
                                 <div class="foodcat-full foodcat-price_head_cont">
                                    <h3>Food Category List</h3>
                                 </div>
                              </div>
                              <div class="foodcat-full foodcat-price_block">
                                 <div class="foodcat-full foodcat-price_block_cont">
                                    <div class="foodcat-full foodcat-price_cont">
                                       <div class="foodcat-table-responsive">
                                          <table class="foodcat-table foodcat-table-striped foodcat-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SL NO</th>
                                                   <th>Food Type</th>
                                                   <th>Food Category</th>
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $i=0;
                                             $selqry="select * from tbl_foodcategory p inner join tbl_foodtype d on p.foodtype_id=d.foodtype_id";
                                             $row=$con->query($selqry);
                                             while($data=$row->fetch_assoc())
                                             {
                                                $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['foodtype_name'] ?></td>
                                                   <td><?php echo $data['foodcategory_name'] ?></td>
                                                   <td><a href="FoodCategory.php?delID=<?php echo $data['foodcategory_id'] ?>" class="foodcat-btn-danger" onclick="return confirm('Are you sure?');">Delete</a></td>
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