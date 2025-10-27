<?php
include("../Assets/connection/Connection.php");
session_start();
$selProfile="select * from tbl_deliveryboy where deliveryboy_id='".$_SESSION['did']."'";
$row=$con->query($selProfile);
$data=$row->fetch_assoc();
if(isset($_POST['btn_save']))
{

$name=$_POST['txt_name'];

$contact=$_POST['txt_contact'];

$address=$_POST['txt_address'];

 $updateQry="update tbl_deliveryboy set deliveryboy_name='".$name."',deliveryboy_contact='".$contact."',deliveryboy_address='".$address."' where user_id='".$_SESSION['did']."'";

if ($con->query($updateQry))
{

?>

<script>

alert("updated");

window.location="../Deliveryboy/Myprofile.php";

</script>

<?php

}
}
?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" value="<?php  echo $data['deliveryboy_name']?>" /></td>
    </tr>
  
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" value="<?php  echo $data['deliveryboy_contact']?>"/></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="txt_address"></label>
      <input type="text" name="txt_address" id="txt_address" value="<?php  echo $data['deliveryboy_address']?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btn_save" id="btn_save" value="Save" /></td>
    </tr>
  </table>
</form>
</body>
</html>

