
<?php
$servername="localhost";
$username="root";
$password="";


$db="db_foodzone";
$con=mysqli_connect($servername,$username,$password,$db);
if(!$con)
{
	echo "connection failed";
}
?>
