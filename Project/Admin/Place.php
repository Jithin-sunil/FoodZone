<?php
include('Head.php');
include("../Assets/connection/Connection.php");
if(isset($_POST["btn_Save"]))
{
	
	$name=$_POST["slt_dst"];
	$place=$_POST["txt_plc"];
	
		$insqry="insert into tbl_place(district_id,place_name) values('".$name."','".$place."')";
		if($con->query($insqry))
		{
			?>
			<script>
				alert("Inserted");
				window.location="Place.php";
			</script>
			<?php
		}
   
}
  

?>
<?php
	if(isset($_GET["delID"]))
{
	
		$delQry="delete from tbl_place where place_id='".$_GET["delID"]."'";
		if($con->query($delQry))
		{
			?>
			<script>
				alert("Deleted");
				window.location="Place.php";
			</script>
			<?php
		}
	}
  

?>
<style>
/* Unique CSS for Place Management Page */
.place-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.place-column-title {
    width: 100%;
    padding: 0 15px;
}

.place-page-title {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
}

.place-page-title h2 {
    color: #333;
    font-size: 24px;
    margin: 0;
    font-weight: 500;
}

.place-home-link {
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

.place-home-link:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.place-column1 {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.place-col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px;
}

.place-col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.place-price-table {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.place-price-head {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 15px 20px;
}

.place-price-head-cont h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.place-price-block {
    padding: 20px;
}

.place-price-block-cont {
    padding: 0;
}

.place-price-cont {
    padding: 0;
}

.place-form-group {
    margin-bottom: 15px;
}

.place-form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #555;
}

.place-form-control, .place-select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.15s ease-in-out;
    background-color: #fff;
}

.place-form-control:focus, .place-select:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.place-center {
    text-align: center;
    margin-top: 20px;
}

.place-btn-success {
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

.place-btn-success:hover {
    opacity: 0.9;
}

.place-btn-cancel {
    background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
    border: none;
    padding: 10px 20px;
    color: #fff;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: opacity 0.15s ease-in-out;
}

.place-btn-cancel:hover {
    opacity: 0.9;
}

.place-table-responsive {
    overflow-x: auto;
    margin-top: 10px;
}

.place-table {
    width: 100%;
    margin-bottom: 0;
    background-color: transparent;
    border-collapse: collapse;
}

.place-table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

.place-table-bordered {
    border: 1px solid #dee2e6;
}

.place-table-bordered th,
.place-table-bordered td {
    border: 1px solid #dee2e6;
    padding: 12px 8px;
    vertical-align: top;
}

.place-table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-align: left;
}

.place-table tbody td {
    color: #495057;
}

.place-btn-danger {
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

.place-btn-danger:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .place-col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
                     <div class="place-row place-column_title">
                        <div class="place-col-md-12">
                           <div class="place-page_title">
                              <a href="AdminHome.php" class="place-home-link">Home</a>
                              <h2>Place Management</h2>
                           </div>
                        </div>
                     </div>
                     <div class="place-row place-column1">
                        <div class="place-col-md-6">
                           <div class="place-full place-price_table place-margin_bottom_30">
                              <div class="place-full place-price_head">
                                 <div class="place-full place-price_head_cont">
                                    <h3>Add New Place</h3>
                                 </div>
                              </div>
                              <div class="place-full place-price_block">
                                 <form id="form1" name="form1" method="post" action="">
                                    <div class="place-full place-price_block_cont">
                                       <div class="place-full place-price_cont">
                                          <div class="place-row">
                                             <div class="place-col-md-12">
                                                <div class="place-form-group">
                                                   <label for="slt_dst">District</label>
                                                   <select name="slt_dst" id="slt_dst" class="place-select" required>
                                                      <?php
                                                      $selqry="select * from tbl_district";
                                                      $row=$con->query($selqry);
                                                      while($data=$row->fetch_assoc())
                                                      {
                                                      ?>
                                                         <option value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name'] ?></option>
                                                      <?php
                                                      }
                                                      ?>
                                                   </select>
                                                </div>
                                                <div class="place-form-group">
                                                   <label for="txt_plc">Place</label>
                                                   <input type="text" class="place-form-control" name="txt_plc" id="txt_plc" placeholder="Enter Placename" required />
                                                </div>
                                             </div>
                                             <div class="place-center">
                                                <input type="submit" name="btn_Save" id="btn_Save" class="place-btn-success" value="Save" />
                                                <input type="reset" id="btn_Cancel" class="place-btn-cancel" value="Cancel" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="place-col-md-12">
                           <div class="place-full place-price_table place-margin_bottom_30">
                              <div class="place-full place-price_head">
                                 <div class="place-full place-price_head_cont">
                                    <h3>Place List</h3>
                                 </div>
                              </div>
                              <div class="place-full place-price_block">
                                 <div class="place-full place-price_block_cont">
                                    <div class="place-full place-price_cont">
                                       <div class="place-table-responsive">
                                          <table class="place-table place-table-striped place-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SI NO</th>
                                                   <th>District Name</th>
                                                   <th>Place</th>
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $i=0;
                                             $selqry="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
                                             $row=$con->query($selqry);
                                             while($data=$row->fetch_assoc())
                                             {
                                                $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['district_name'] ?></td>
                                                   <td><?php echo $data['place_name'] ?></td>
                                                   <td><a href="Place.php?delID=<?php echo $data['place_id'] ?>" class="place-btn-danger" onclick="return confirm('Are you sure?');">Delete</a></td>
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