<?php
include('Head.php');
include("../Assets/connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	
	$type=$_POST["txt_type"];	
		$insqry="insert into tbl_restauranttype(restauranttype_name) values('".$type."')";
		if($con->query($insqry))
		{
			?>
			<script>
				alert("Inserted");
				window.location="Restauranttype.php";
			</script>
			<?php
		}
   
}

if(isset($_GET["delID"]))
{
	
		$delQry="delete from tbl_restauranttype where restauranttype_id='".$_GET["delID"]."'";
		if($con->query($delQry))
		{
			?>
			<script>
				alert("Deleted");
				window.location="Restauranttype.php";
			</script>
			<?php
		}
   
}

?>
<style>
/* Unique CSS for Restaurant Type Management Page */
.resttype-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.resttype-column-title {
    width: 100%;
    padding: 0 15px;
}

.resttype-page-title {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
}

.resttype-page-title h2 {
    color: #333;
    font-size: 24px;
    margin: 0;
    font-weight: 500;
}

.resttype-home-link {
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

.resttype-home-link:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.resttype-column1 {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.resttype-col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px;
}

.resttype-col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.resttype-price-table {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.resttype-price-head {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 15px 20px;
}

.resttype-price-head-cont h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.resttype-price-block {
    padding: 20px;
}

.resttype-price-block-cont {
    padding: 0;
}

.resttype-price-cont {
    padding: 0;
}

.resttype-form-group {
    margin-bottom: 15px;
}

.resttype-form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #555;
}

.resttype-form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.15s ease-in-out;
}

.resttype-form-control:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.resttype-center {
    text-align: center;
    margin-top: 20px;
}

.resttype-btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    padding: 10px 20px;
    color: #fff;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: opacity 0.15s ease-in-out;
}

.resttype-btn-success:hover {
    opacity: 0.9;
}

.resttype-table-responsive {
    overflow-x: auto;
    margin-top: 10px;
}

.resttype-table {
    width: 100%;
    margin-bottom: 0;
    background-color: transparent;
    border-collapse: collapse;
}

.resttype-table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

.resttype-table-bordered {
    border: 1px solid #dee2e6;
}

.resttype-table-bordered th,
.resttype-table-bordered td {
    border: 1px solid #dee2e6;
    padding: 12px 8px;
    vertical-align: top;
}

.resttype-table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-align: left;
}

.resttype-table tbody td {
    color: #495057;
}

.resttype-btn-danger {
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

.resttype-btn-danger:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .resttype-col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
                     <div class="resttype-row resttype-column_title">
                        <div class="resttype-col-md-12">
                           <div class="resttype-page_title">
                              <a href="AdminHome.php" class="resttype-home-link">Home</a>
                              <h2>Restaurant Type Management</h2>
                           </div>
                        </div>
                     </div>
                     <div class="resttype-row resttype-column1">
                        <div class="resttype-col-md-6">
                           <div class="resttype-full resttype-price_table resttype-margin_bottom_30">
                              <div class="resttype-full resttype-price_head">
                                 <div class="resttype-full resttype-price_head_cont">
                                    <h3>Add New Restaurant Type</h3>
                                 </div>
                              </div>
                              <div class="resttype-full resttype-price_block">
                                 <form id="form1" name="form1" method="post" action="">
                                    <div class="resttype-full resttype-price_block_cont">
                                       <div class="resttype-full resttype-price_cont">
                                          <div class="resttype-row">
                                             <div class="resttype-col-md-12">
                                                <div class="resttype-form-group">
                                                   <label for="txt_type">Type</label>
                                                   <input type="text" class="resttype-form-control" name="txt_type" id="txt_type" placeholder="Enter Restauranttype" required />
                                                </div>
                                             </div>
                                             <div class="resttype-center">
                                                <input type="submit" name="btn_submit" id="btn_submit" class="resttype-btn-success" value="Submit" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="resttype-col-md-12">
                           <div class="resttype-full resttype-price_table resttype-margin_bottom_30">
                              <div class="resttype-full resttype-price_head">
                                 <div class="resttype-full resttype-price_head_cont">
                                    <h3>Restaurant Type List</h3>
                                 </div>
                              </div>
                              <div class="resttype-full resttype-price_block">
                                 <div class="resttype-full resttype-price_block_cont">
                                    <div class="resttype-full resttype-price_cont">
                                       <div class="resttype-table-responsive">
                                          <table class="resttype-table resttype-table-striped resttype-table-bordered">
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
                                             $selqry="select * from tbl_restauranttype";
                                             $row=$con->query($selqry);
                                             while($data=$row->fetch_assoc())
                                             {
                                                $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['restauranttype_name'] ?></td>
                                                   <td><a href="Restauranttype.php?delID=<?php echo $data['restauranttype_id'] ?>" class="resttype-btn-danger" onclick="return confirm('Are you sure?');">Delete</a></td>	
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