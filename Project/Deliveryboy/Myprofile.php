<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");
$selProfile="select * from tbl_deliveryboy where deliveryboy_id='".$_SESSION['did']."'";
$row=$con->query($selProfile);
$data=$row->fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deliveryboy Profile</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 20px;
  }
  h2 {
    text-align: center;
    color: #333;
  }
  form {
    width: 50%;
    margin: 20px auto;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
  }
  td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
  }
  tr:last-child td {
    border-bottom: none;
    text-align: center;
  }
  a {
    text-decoration: none;
    color: #4CAF50;
    font-weight: bold;
    padding: 6px 12px;
    border: 1px solid #4CAF50;
    border-radius: 6px;
    transition: all 0.3s;
  }
  a:hover {
    background: #4CAF50;
    color: #fff;
  }
</style>
</head>

<body>
  <h2>Deliveryboy Profile</h2>
  <form id="form1" name="form1" method="post" action="Myprofile.php">
    <table width="200" border="1">
      <tr>
        <td>Deliveryboy Name</td>
        <td><?php echo $data['deliveryboy_name'] ?></td>
      </tr>
      <tr>
        <td>Deliveryboy Contact</td>
        <td><?php echo $data['deliveryboy_contact'] ?></td>
      </tr>
      <tr>
        <td>Deliveryboy Email</td>
        <td><?php echo $data['deliveryboy_email'] ?></td>
      </tr>
      <tr>
        <td>Deliveryboy Password</td>
        <td><?php echo $data['deliveryboy_password'] ?></td>
      </tr>
      <tr>
        <td>
          <a href="../Deliveryboy/EditProfile.php" title="Edit_profile">Edit Profile</a>
        </td>
        <td>
          <a href="../Deliveryboy/ChangePassword.php" title="Change_Password">Change Password</a>
        </td>
      </tr>
    </table>
  </form>
</body>
</html>
<?php include("Foot.php"); ?>