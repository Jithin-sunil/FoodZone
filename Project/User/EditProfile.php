<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");
$selProfile="select * from tbl_user where user_id='".$_SESSION['uid']."'";
$row=$con->query($selProfile);
$data=$row->fetch_assoc();
if(isset($_POST['btn_save']))
{

$name=$_POST['txt_name'];

$contact=$_POST['txt_contact'];

$address=$_POST['txt_address'];

 $updateQry="update tbl_user set user_name='".$name."',user_contact='".$contact."',user_address='".$address."' where user_id='".$_SESSION['uid']."'";

if ($con->query($updateQry))
{

?>

<script>

alert("updated");

window.location="Myprofile.php";

</script>

<?php

}
}
?>









<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Profile</title>
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
  table {
    width: 50%;
    margin: 20px auto;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border-radius: 10px;
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
  input[type="text"] {
    width: 95%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    transition: border 0.3s;
  }
  input[type="text"]:focus {
    border-color: #4CAF50;
  }
  input[type="submit"] {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
  }
  input[type="submit"]:hover {
    background: #388E3C;
  }
</style>
</head>

<body>
  <h2>Edit Profile</h2>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td>Name</td>
        <td>
          <label for="txt_name"></label>
          <input type="text" name="txt_name" id="txt_name" value="<?php  echo $data['user_name']?>" />
        </td>
      </tr>
      <tr>
        <td>Contact</td>
        <td>
          <label for="txt_contact"></label>
          <input type="text" name="txt_contact" id="txt_contact" value="<?php  echo $data['user_contact']?>"/>
        </td>
      </tr>
      <tr>
        <td>Address</td>
        <td>
          <label for="txt_address"></label>
          <input type="text" name="txt_address" id="txt_address" value="<?php  echo $data['user_address']?>" />
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
          <input type="submit" name="btn_save" id="btn_save" value="Save" />
        </td>
      </tr>
    </table>
  </form>
</body>
</html>
<?php include("Foot.php");
?>