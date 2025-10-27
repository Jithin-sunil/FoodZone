<?php
session_start();
include("../Assets/connection/Connection.php");
if(isset($_POST['btn_Submit']))
{
  $email=$_POST['txt_Email'];
  $pswd=$_POST['txt_pwd'];


  $selQry="select * from tbl_admin where admin_email='".$email."' AND admin_password='".$pswd."'";
  $row=$con->query($selQry);


  $selectqry="select * from tbl_user where user_email='".$email."' AND user_password='".$pswd."'";
  $roww=$con->query($selectqry);

  $selectquery="select * from tbl_restaurant where restaurant_email='".$email."' AND restaurant_password='".$pswd."'";
  $roow=$con->query($selectquery);

  $sltquery="select * from tbl_deliveryboy where deliveryboy_email='".$email."' AND deliveryboy_password='".$pswd."'";
  $rooww=$con->query($sltquery);

  if($data=$row->fetch_assoc())
  {
    $_SESSION['aid']=$data['admin_id'];
    $_SESSION['aname']=$data['admin_name'];
    header("location:../Admin/AdminHome.php");
  }
  else if($datta=$roww->fetch_assoc())
  {
    if($datta['user_status'] == 0)
    {
      $_SESSION['uid']=$datta['user_id'];
      $_SESSION['uname']=$datta['user_name'];
      header("location:../User/UserHome.php");
    }
    elseif($datta['user_status'] == 1)
    {
      ?>
      <script>
        alert("Your account is blocked. Please contact support.");
        window.location="Login.php";
      </script>
      <?php
    }
  }
  else if($daata=$roow->fetch_assoc())
  {
    if($daata['restaurant_status'] == 1)
    {
      $_SESSION['rid']=$daata['restaurant_id'];
      $_SESSION['rname']=$daata['restaurant_name'];
      header("location:../Restaurant/Userhome.php");
    }
    elseif($daata['restaurant_status'] == 0)
    {
      ?>
      <script>
        alert("Your account is pending verification. Please wait for admin approval.");
        window.location="Login.php";
      </script>
      <?php
    }
    elseif($daata['restaurant_status'] == 2)
    {
      ?>
      <script>
        alert("Your account has been rejected. Please contact support.");
        window.location="Login.php";
      </script>
      <?php
    }
  }
  else if($dataa=$rooww->fetch_assoc())
  {
    if($dataa['deliveryboy_status'] == 1)
    {
      $_SESSION['did']=$dataa['deliveryboy_id'];
      $_SESSION['dname']=$dataa['deliveryboy_name'];
      header("location:../Deliveryboy/HomePage.php");
    }
    elseif($dataa['deliveryboy_status'] == 0)
    {
      ?>
      <script>
        alert("Your account is pending verification. Please wait for admin approval.");
        window.location="Login.php";
      </script>
      <?php
    }
    elseif($dataa['deliveryboy_status'] == 2)
    {
      ?>
      <script>
        alert("Your account has been rejected. Please contact support.");
        window.location="Login.php";
      </script>
      <?php
    }
  }
  else
  {
    ?>
      <script>
        alert("Invalid Credentials");
        window.location="Login.php";
      </script>
    <?php
  }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Login</title>

<style>
/* ======== PAGE BACKGROUND ======== */
body {
  margin: 0;
  padding: 0;
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #74ebd5, #ACB6E5);
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

/* ======== HOME LINK ======== */
a[href="../index.php"] {
  display: inline-block;
  text-decoration: none;
  background-color: #4a00e0;
  color: white;
  padding: 10px 25px;
  border-radius: 8px;
  margin-bottom: 25px;
  font-weight: 500;
  transition: 0.3s;
}
a[href="../index.php"]:hover {
  background-color: #6a11cb;
}

/* ======== LOGIN CARD ======== */
.login-container {
  background: #fff;
  width: 380px;
  margin: 0 auto;
  padding: 35px 40px;
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.2);
  animation: fadeIn 0.8s ease-in-out;
  text-align: center;
}

/* ======== TITLE ======== */
.login-container h1 {
  color: #333;
  font-size: 28px;
  margin-bottom: 25px;
}

/* ======== TABLE LAYOUT ======== */
table {
  width: 100%;
  border-spacing: 10px;
}

td {
  font-size: 15px;
  color: #333;
  text-align: left;
}

/* ======== INPUT FIELDS ======== */
input[type="email"],
input[type="password"] {
  width: 95%;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 14px;
  transition: 0.3s;
}
input[type="email"]:focus,
input[type="password"]:focus {
  border-color: #4a00e0;
  box-shadow: 0 0 5px rgba(106, 17, 203, 0.3);
  outline: none;
}

/* ======== SUBMIT BUTTON ======== */
input[type="submit"] {
  width: 100%;
  background-color: #4a00e0;
  color: white;
  border: none;
  padding: 12px;
  font-size: 16px;
  border-radius: 8px;
  cursor: pointer;
  margin-top: 10px;
  transition: background 0.3s, transform 0.2s;
}
input[type="submit"]:hover {
  background-color: #6a11cb;
  transform: scale(1.03);
}

/* ======== LINKS BELOW FORM ======== */
small {
  color: #555;
}
td a {
  color: #4a00e0;
  text-decoration: none;
  font-weight: 500;
  transition: 0.3s;
}
td a:hover {
  color: #6a11cb;
  text-decoration: underline;
}

/* ======== ANIMATION ======== */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-15px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ======== RESPONSIVE ======== */
@media (max-width: 480px) {
  .login-container {
    width: 85%;
    padding: 25px;
  }
  input[type="submit"] {
    font-size: 15px;
  }
}
</style>
</head>

<body>
<center><a href="../index.php">Home</a></center>
  
<div class="login-container">
  <h1>Login</h1>
  <form id="form1" name="form1" method="post" action="">
    <table>
      <tr>
        <td>Email</td>
        <td><input type="email" name="txt_Email" id="txt_Email" placeholder="Enter Email" required /></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="password" name="txt_pwd" id="txt_pwd" placeholder="Enter Password" required /></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" name="btn_Submit" id="btn_Submit" value="Login" />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <small>New here? </small><br>
          <a href="NewDeliveryboy.php">New DeliveryBoy</a> / 
          <a href="NewRestaurant.php">New Restaurant</a> / 
          <a href="NewUser.php">New User</a>
        </td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>