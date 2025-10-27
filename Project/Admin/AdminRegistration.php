<?php
include("../Assets/connection/Connection.php");
if(isset($_POST["btn_sub"]))
{
	
	$name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$password=$_POST["txt_pwd"];
		$insqry="insert into tbl_admin(admin_name,admin_email,admin_password) values('".$name."','".$email."','".$password."')";
		if($con->query($insqry))
		{
			?>
			<script>
				alert("Inserted");
				window.location="AdminRegistration.php";
			</script>
			<?php
		}
   
}




if(isset($_GET["delID"]))
{
	
		$delQry="delete from tbl_admin where admin_id='".$_GET["delID"]."'";
		if($con->query($delQry))
		{
			?>
			<script>
				alert("Deleted");
				window.location="AdminRegistration.php";
			</script>
			<?php
		}
   
}

?>
<?php
include('Head.php');
?>
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Admin Registration</h2>
                           </div>
                        </div>
                     </div>
                     <div class="row column1">
                        <div class="col-md-6">
                           <div class="full price_table margin_bottom_30">
                              <div class="full price_head">
                                 <div class="full price_head_cont">
                                    <h3>Add New Admin</h3>
                                 </div>
                              </div>
                              <div class="full price_block">
                                 <form id="form1" name="form1" method="post" action="">
                                    <div class="full price_block_cont">
                                       <div class="full price_cont">
                                          <div class="row">
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                   <label for="txt_name">Name</label>
                                                   <input type="text" class="form-control" name="txt_name" id="txt_name" placeholder="Enter name" required />
                                                </div>
                                             </div>
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                   <label for="txt_email">E-mail</label>
                                                   <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="Enter email" required />
                                                </div>
                                             </div>
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                   <label for="txt_pwd">Password</label>
                                                   <input type="password" class="form-control" name="txt_pwd" id="txt_pwd" placeholder="Enter password" required />
                                                </div>
                                             </div>
                                             <div class="center">
                                                <input type="submit" name="btn_sub" id="btn_sub" class="btn btn-success" value="Submit" />
                                                <input type="reset" id="txt_clear" class="btn btn-danger" value="Clear" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="full price_table margin_bottom_30">
                              <div class="full price_head">
                                 <div class="full price_head_cont">
                                    <h3>Admin List</h3>
                                 </div>
                              </div>
                              <div class="full price_block">
                                 <div class="full price_block_cont">
                                    <div class="full price_cont">
                                       <div class="table-responsive">
                                          <table class="table table-striped table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>SI NO</th>
                                                   <th>Name</th>
                                                   <th>Email</th>
                                                   <th>Password</th>
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                             $i=0;
                                             $selqry="select * from tbl_admin";
                                             $row=$con->query($selqry);
                                             while($data=$row->fetch_assoc())
                                             {
                                                $i++;
                                             ?>
                                                <tr>
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo $data['admin_name'] ?></td>
                                                   <td><?php echo $data['admin_email'] ?></td>
                                                   <td><?php echo $data['admin_password'] ?></td>
                                                   <td><a href="AdminRegistration.php?delID=<?php echo $data['admin_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a></td>
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