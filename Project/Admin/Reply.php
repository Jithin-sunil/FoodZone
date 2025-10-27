<?php
include("../Assets/connection/Connection.php");

$complaintId = $_GET['cid'];

if (isset($_POST['btn_submit'])) {
    $reply = $_POST['txt_reply'];

    $upQry = "UPDATE tbl_complaint 
              SET complaint_reply = '" . $reply . "' 
              WHERE complaint_id = '" . $complaintId . "'";

    if ($con->query($upQry)) {
        ?>
        <script>
            alert('Reply Sent Successfully');
            window.location = 'ViewComplaint.php';
        </script>
        <?php
    } else {
        ?>
        <script>alert('Failed to send reply.');</script>
        <?php
    }
}

$selComp = "SELECT * FROM tbl_complaint c INNER JOIN tbl_user u ON c.user_id = u.user_id WHERE c.complaint_id = '" . $complaintId . "'";
$resComp = $con->query($selComp);
$dataComp = $resComp->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reply to Complaint</title>
</head>
<body align="center">

<a href="AdminHome.php">Home</a>

<h3>Reply to Complaint</h3>

<form id="form1" name="form1" method="post" action="">
  <table border="1" cellpadding="10">
    <tr>
      <td>Your Reply</td>
      <td>
        <textarea name="txt_reply" id="txt_reply" required rows="5" cols="40"></textarea>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit Reply" />
      </td>
    </tr>
  </table>
</form>

</body>
</html>