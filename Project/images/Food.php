<?php
include("../Assets/connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	
	$name=$_POST['txt_name'];
	$det=$_POST['txt_details'];
	$price=$_POST['txt_price'];
	$photo=$_POST['txt_photo'];
	$foodtype=$_POST['txt_foodtype'];
	$category=$_POST["txt_foodcategory"];
	
		$insqry="insert into tbl_food(Food_name,Food_details,Food_price,Food_photo,Food_type,Food_category) values('".$name."','".$det."','".$price."','".$photo."','".$foodtype."','".$category."')";
		if($con->query($insqry))
		{
			?>
			<script>
				alert("Inserted");
				window.location="Food.php";
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
  <table width="352" border="1">
    <tr>
      <td width="175">Name</td>
      <td width="161"><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
    <tr>
      <td><p>Details</p></td>
      <td><label for="txt_details"></label>
      <input type="text" name="txt_details" id="txt_details" /></td>
    </tr>
    <tr>
      <td>Price</td>
      <td><label for="txt_price"></label>
      <input type="text" name="txt_price" id="txt_price" /></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><label for="txt_photo"></label>
      <input type="file" name="txt_photo" id="txt_photo" /></td>
    </tr>
    <tr>
      <td>Food Type</td>
      <td><label for="txt_foodtype"></label>
               <select name="slt_food" id="slt_food">
      <?php
$selqry="select * from tbl_foodtype";
$row=$con->query($selqry);
while($data=$row->fetch_assoc())
{
	$i++;
?>

<option value="<?php echo $data['foodtype_id'] ?>"><?php echo $data['foodtype_name'] ?>--select--</option>

<?php
}
?>
              </select></td>
    </tr>
    <tr>
      <td>Food Category</td>
      <td><label for="txt_foodcategory"></label>
        <select name="txt_foodcategory" id="txt_foodcategory">
          <option>--select--</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2"><center><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></center></td>
  
    </tr>
  </table>
</form>
</body>
</html>
<body>
<table border="1">
<tr>
<td>SI NO</td>
<td>Name</td>
<td>Details</td>
<td>Price</td>
<td>Food type</td>
<td>Food Category</td>
</tr>
<?php
$i=0;
$selqry="select * from tbl_food";
$row=$con->query($selqry);
while($data=$row->fetch_assoc())
{
	$i++;
?>
<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $data['Food_name'] ?></td>
		<td><?php echo $data['Food_details'] ?></td>
		<td><?php echo $data['Food_price'] ?></td>
        <td><?php echo $data['Food_type'] ?></td>
		<td><?php echo $data['Food_category'] ?></td>		
</tr>
<?php
}
?>
</table>