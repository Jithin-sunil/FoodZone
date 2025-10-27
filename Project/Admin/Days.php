<?php
include('Head.php');
include("../Assets/connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	
	$day=$_POST["txt_day"];	
		$insqry="insert into tbl_days(days_name) values('".$day."')";
		if($con->query($insqry))
		{
			?>
			<script>
				alert("Inserted");
				window.location="Days.php";
			</script>
			<?php
		}
   
}

if(isset($_GET["delID"]))
{
	
		$delQry="delete from tbl_days where days_id='".$_GET["delID"]."'";
		if($con->query($delQry))
		{
			?>
			<script>
				alert("Deleted");
				window.location="Days.php";
			</script>
			<?php
		}
   
}

?>
<style>
/* Unique CSS for Days Management Page */
.days-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.days-column-title {
    width: 100%;
    padding: 0 15px;
}

.days-page-title {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
}

.days-page-title h2 {
    color: #333;
    font-size: 24px;
    margin: 0;
    font-weight: 500;
}

.days-column1 {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.days-col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px;
}

.days-col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.days-price-table {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: hidden;
}

.days-price-head {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 15px 20px;
}

.days-price-head-cont h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.days-price-block {
    padding: 20px;
}

.days-price-block-cont {
    padding: 0;
}

.days-price-cont {
    padding: 0;
}

.days-form-group {
    margin-bottom: 15px;
}

.days-form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #555;
}

.days-form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.15s ease-in-out;
}

.days-form-control:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.days-center {
    text-align: center;
    margin-top: 20px;
}

.days-btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    padding: 10px 20px;
    color: #fff;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: opacity 0.15s ease-in-out;
}

.days-btn-success:hover {
    opacity: 0.9;
}

.days-table-responsive {
    overflow-x: auto;
    margin-top: 10px;
}

.days-table {
    width: 100%;
    margin-bottom: 0;
    background-color: transparent;
    border-collapse: collapse;
}

.days-table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}

.days-table-bordered {
    border: 1px solid #dee2e6;
}

.days-table-bordered th,
.days-table-bordered td {
    border: 1px solid #dee2e6;
    padding: 12px 8px;
    vertical-align: top;
}

.days-table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-align: left;
}

.days-table tbody td {
    color: #495057;
}

.days-btn-danger {
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

.days-btn-danger:hover {
    opacity: 0.9;
    color: #fff;
    text-decoration: none;
}

.days-btn-sm {
    padding: 4px 8px;
    font-size: 12px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .days-col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
                     <div class="days-row days-column_title">
                        <div class="days-col-md-12">
                           <div class="days-page_title">
                              <h2>Days Management</h2>
                           </div>
                        </div>
                     </div>
                     <div class="days-row days-column1">
                        <div class="days-col-md-6">
                           <div class="days-full days-price_table days-margin_bottom_30">
                              <div class="days-full days-price_head">
                                 <div class="days-full days-price_head_cont">
                                    <h3>Add New Day</h3>
                                 </div>
                              </div>
                              <div class="days-full days-price_block">
                                 <form id="form1" name="form1" method="post" action="">
                                    <div class="days-full days-price_block_cont">
                                       <div class="days-full days-price_cont">
                                          <div class="days-row">
                                             <div class="days-col-md-12">
                                                <div class="days-form-group">
                                                   <label for="txt_day">Day Name</label>
                                                   <input type="text" class="days-form-control" name="txt_day" id="txt_day" placeholder="Enter dayname" required />
                                                </div>
                                             </div>
                                             <div class="days-center">
                                                <input type="submit" name="btn_submit" id="btn_submit" class="days-btn-success" value="Submit" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="days-col-md-12">
                           <div class="days-full days-price_table days-margin_bottom_30">
                              <div class="days-full days-price_head">
                                 <div class="days-full days-price_head_cont">
                                    <h3>Days List</h3>
                                 </div>
                              </div>
                              <div class="days-full days-price_block">
                                 <div class="days-full days-price_block_cont">
                                    <div class="days-full days-price_cont">
                                       <div class="days-table-responsive">
                                          <table class="days-table days-table-striped days-table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SL NO</th>
                                                   <th>Day Name</th>
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $i=0;
                                             $selqry="select * from tbl_days";
                                             $row=$con->query($selqry);
                                             while($data=$row->fetch_assoc())
                                             {
                                                $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['days_name'] ?></td>
                                                   <td><a href="Days.php?delID=<?php echo $data['days_id'] ?>" class="days-btn days-btn-danger days-btn-sm" onclick="return confirm('Are you sure?');">Delete</a></td>	
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