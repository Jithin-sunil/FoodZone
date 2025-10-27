<?php
include("../Assets/connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	
	$name=$_POST['txt_name'];
  $add=$_POST['txt_address'];
	$place=$_POST['select_place'];
	$contact=$_POST['txt_contact'];
  $email=$_POST['txt_email'];
  $password=$_POST["txt_pwd"];
	$resttype=$_POST['slt_type'];
  $photo=$_FILES["photo"]["name"];
	$tempPhoto=$_FILES["photo"]["tmp_name"];
	move_uploaded_file($tempPhoto,'../Assets/Files/Rest/Photo/'.$photo);

  $proof=$_FILES["proof"]["name"];
	$tempProof=$_FILES["proof"]["tmp_name"];
	move_uploaded_file($tempProof,'../Assets/Files/Rest/Proof/'.$proof);
		$insqry="insert into tbl_restaurant(restaurant_name,restaurant_address,place_id,restaurant_contact,restaurant_email,restaurant_password,restaurant_type,restaurant_photo, restaurant_proof) values('".$name."','".$add."','".$place."','".$contact."','". $email."','".$password."','".$resttype."','".$photo."', '".$proof."')";
		if($con->query($insqry))
		{
			?>
			<script>
				alert("Inserted");
				window.location="Login.php";
			</script>
			<?php
		}
   
}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Restaurant</title>
<style>
body {
    background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    font-family: 'Georgia', serif;
    color: #2F1B14;
    margin: 0;
    padding: 20px;
}
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4); /* Dark overlay for readability */
    pointer-events: none;
    z-index: -1;
}
a {
    color: #CD853F;
    text-decoration: none;
    font-weight: bold;
    padding: 10px 20px;
    background: #FFD700;
    border-radius: 5px;
    display: inline-block;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    position: relative;
    z-index: 1;
}
a:hover {
    background: #FFA500;
}
form {
    background: rgba(255, 248, 220, 0.95); /* Semi-transparent cream for restaurant feel */
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    max-width: 500px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
td {
    padding: 15px;
    border: 1px solid #D2691E;
    background: rgba(255, 255, 255, 0.8);
}
td:first-child {
    background: #CD853F;
    color: white;
    font-weight: bold;
    text-align: right;
    width: 30%;
}
input[type="text"], input[type="email"], input[type="password"], input[type="tel"], select, input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #D2691E;
    border-radius: 5px;
    box-sizing: border-box;
    font-family: inherit;
    background: white;
}
input[type="submit"], input[type="reset"] {
    background: #8B0000;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    margin: 0 10px;
}
input[type="submit"]:hover, input[type="reset"]:hover {
    background: #A52A2A;
}
option {
    background: #FFF8DC;
}
select {
    background: white;
}
body[align="center"] {
    text-align: center;
}
center {
    display: block;
    text-align: center;
}
</style>
</head>

<body align="center">
<a href="AdminHome.php">Home</a>  
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table cellpadding="10" border="1">
      <tr>
        <td>Name</td>
        <td><input type="text" name="txt_name" id="txt_name" placeholder="Enter name" required /></td>
      </tr>
       <tr>
        <td>Address</td>
        <td><input type="text" name="txt_address" id="txt_address" placeholder="Enter Address" required /></td>
      </tr>   
      <tr>
        <td>District</td>
        <td>
          <select name="select_district" id="select_district" onChange="getPlace(this.value)">
            <option>--Select District--</option>
            <?php
            $SelQry="select * from tbl_district";
            $res = $con->query($SelQry);
            while($row=$res->fetch_assoc()) {
              ?>
              <option value="<?php echo $row['district_id']?>"><?php echo $row['district_name']?></option>
              <?php
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Place</td>
        <td>
          <select name="select_place" id="select_place">
            <option>--Select Place--</option>
          </select>
        </td>
      </tr> 
      <tr>
        <td>Contact</td>
        <td><input type="text" name="txt_contact" id="txt_contact" placeholder="Enter Contact" required /></td>
      </tr>
        <tr>
        <td>Email</td>
        <td><input type="email" name="txt_email" id="txt_email" placeholder="Enter Email" required /></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="password" name="txt_pwd" id="txt_pwd"  placeholder="Enter Password" required /></td>
      </tr>
     
      <tr>
        <td>Restaurant Type</td>
        <td>
          <select name="slt_type" id="slt_type">
             <?php
$selqry="select * from tbl_restauranttype";
$row=$con->query($selqry);
while($data=$row->fetch_assoc())
{
?>
<option value="<?php echo $data['restauranttype_name'] ?>"><?php echo $data['restauranttype_name'] ?></option>
<?php
}
?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Photo</td>
        <td><input type="file" name="photo" id="photo"  required /></td>
      </tr>
      <tr>
        <td>Proof</td>
        <td><input type="file" name="proof" id="proof"  required /></td>
      </tr>
      <tr>
        <td colspan="2"><center>
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          <input type="reset" id="btn_cancel" value="Cancel" />
        </center></td>
      </tr>
  </table>
</form>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function getPlace(disId) {
        $.ajax({
            url:"../Assets/AjaxPages/AjaxPlace.php?disId="+disId,
            success: function(html){
                $("#select_place").html(html);
            }
        });
    }
</script>
</body>
</html>