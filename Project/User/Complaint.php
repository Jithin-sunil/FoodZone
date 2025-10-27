<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	
	$title=$_POST["txt_title"];
	$content=$_POST["txt_content"];
		
	
		$insqry="insert into tbl_complaint(complaint_title,complaint_content,complaint_reply,user_id) values('".$title."','".$content."','','".$_SESSION['uid']."')";
		if($con->query($insqry))
		{
			?>
			<script>
				alert("Inserted");
				window.location="Complaint.php";
			</script>
			<?php
		}
   
}
if(isset($_GET["delID"]))
{
	
		$delQry="delete from tbl_complaint where complaint_id='".$_GET["delID"]."'";
		if($con->query($delQry))
		{
			?>
			<script>
				alert("Deleted");
				window.location="Complaint.php";
			</script>
			<?php
		}
   
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint</title>
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
h2 {
    color: #8B4513;
    text-align: center;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    position: relative;
    z-index: 1;
}
form {
    background: rgba(255, 248, 220, 0.95); /* Semi-transparent cream for restaurant feel */
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    max-width: 500px;
    margin: 0 auto 40px;
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
    background: rgba(255, 248, 220, 0.95);
    margin: 20px auto;
    position: relative;
    z-index: 1;
    max-width: 800px;
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
input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #D2691E;
    border-radius: 5px;
    box-sizing: border-box;
    font-family: inherit;
    background: white;
}
input[type="submit"] {
    background: #8B0000;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    width: 100%;
}
input[type="submit"]:hover {
    background: #A52A2A;
}
a {
    color: #CD853F;
    text-decoration: none;
    font-weight: bold;
    padding: 5px 10px;
    background: #FFD700;
    border-radius: 5px;
    display: inline-block;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
a:hover {
    background: #FFA500;
}
body {
    text-align: center;
}
</style>
</head>

<body>
  <h2>Submit a Complaint</h2>
  <form id="form1" name="form1" method="post" action="">
    <table cellpadding="10" border="1">
      <tr>
        <td>Title</td>
        <td><input type="text" name="txt_title" id="txt_title" placeholder="Enter title" required /></td>
      </tr>
      <tr>
        <td>Content</td>
        <td><label for="txt_content"></label>
        <input type="text" name="txt_content" id="txt_content" placeholder="Enter content" required /></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center;">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        </td>
      </tr>
    </table>
  </form>

  <h2>My Complaints</h2>
  <table cellpadding="10" border="1">
    <tr>
      <td>SLNo</td>
      <td>Title</td>
      <td>Content</td>
      <td>Reply</td>
      <td>Action</td>
    </tr>
    <?php
      $selQry="select * from tbl_complaint where user_id='".$_SESSION['uid']."'";
      $row=$con->query($selQry);
      $i=0;
      while($data=$row->fetch_assoc()) {
        $i++;
    ?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data['complaint_title']?></td>
      <td><?php echo $data['complaint_content']?></td>
      <td><?php echo $data['complaint_reply']?></td>
      <td><a href="Complaint.php?delID=<?php echo $data['complaint_id'] ?>">Delete</a></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
<?php include("Foot.php");
?>