<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DeliveryBoy Home
</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f7fb;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background: #fff;
        padding: 30px 50px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        text-align: center;
    }

    .welcome {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 25px;
    }

    a {
        text-decoration: none;
        background: #28a745;
        color: #fff;
        padding: 12px 24px;
        border-radius: 6px;
        transition: background 0.3s ease;
        font-size: 14px;
        font-weight: bold;
    }

    a:hover {
        background: #218838;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="welcome">Welcome ::<?php echo $_SESSION['dname']?></div>
        <a href="../Deliveryboy/Myprofile.php">UserHome</a>
    </div>
</body>
</html>
