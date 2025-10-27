<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");
$selProfile="select * from tbl_user where user_id='".$_SESSION["uid"]."'";
$row=$con->query($selProfile);
$data=$row->fetch_assoc();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>My Profile</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, #36d1dc, #5b86e5);
        
        height: 100vh;
    }

    .profile-container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        width: 500px;
        animation: fadeIn 0.8s ease-in-out;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table td {
        padding: 12px 10px;
        border-bottom: 1px solid #ddd;
        font-size: 15px;
        color: #444;
    }

    table tr:last-child td {
        border-bottom: none;
    }

    a {
        text-decoration: none;
        color: #5b86e5;
        font-weight: bold;
        transition: 0.3s;
    }

    a:hover {
        color: #2c5fb3;
    }

    .links {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(-20px);}
        to {opacity: 1; transform: translateY(0);}
    }
</style>
</head>

<body>
<div class="profile-container">
  <h1>My Profile</h1>
  <form id="form1" name="form1" method="post" action="">
    <table>
      <tr>
        <td><strong>Name</strong></td>
        <td><?php echo $data['user_name'] ?></td>
      </tr>
      <tr>
        <td><strong>Email</strong></td>
        <td><?php echo $data['user_email'] ?></td>
      </tr>
       <tr>
        <td><strong>Password</strong></td>
        <td><?php echo $data['user_password'] ?></td>
      </tr>
      <tr>
        <td><strong>Contact</strong></td>
        <td><?php echo $data['user_contact'] ?></td>
      </tr>
      <tr>
        <td><strong>Gender</strong></td>
        <td><?php echo $data['user_gender'] ?></td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td><?php echo $data['user_address'] ?></td>
      </tr>
    </table>
    <div class="links">
      <a href="EditProfile.php" title="edit_profile">✏️ Edit Profile</a>
      <a href="ChangePassword.php" title="change_password">🔑 Change Password</a>
    </div>
    <div style="text-align:center; margin-top:20px;">
      <a href="UserHome.php">⬅️ Back to Profile</a>
    </div>
  </form>
</div>
</body>
</html>
<?php include("Foot.php");
?>