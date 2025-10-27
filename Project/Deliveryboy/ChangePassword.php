<?php
session_start();
include("../Assets/connection/Connection.php");
include("Head.php");
if(isset($_POST['btn_save']))
{
    $oldPswd=$_POST['txt_crntpswd'];
     $newPswd=$_POST['txt_newpswd'];
     $confmPswd=$_POST['txt_cnfrmpswd'];

        


    $selPswd="select * from tbl_deliveryboy where deliveryboy_id='".$_SESSION['did']."'";
    $row=$con->query($selPswd);
    $data=$row->fetch_assoc();
    

    if($data['deliveryboy_password']==$oldPswd)
    {
        if($newPswd==$confmPswd)
        {
            $updatepswd="update tbl_deliveryboy set deliveryboy_password='".$newPswd."' where deliveryboy_id='".$_SESSION['did']."'";
            if($con->query($updatepswd))
            {
                ?>
                <script>
                        alert("password changed");
                        window.location="../Deliveryboy/Myprofile.php";
                </script>
                <?php
            }
            else{
                  ?>
                <script>
                        alert("Error");
                        window.location="../Deliveryboy/ChangePassword.php";
                </script>
                <?php
            }
        }
        else{
              ?>
                <script>
                        alert("not same");
                        window.location="../Deliveryboy/ChangePassword.php";
                </script>
                <?php
        }
    }
    else{
       ?>
                <script>
                        alert("not same");
                        window.location="../Deliveryboy/ChangePassword.php";
                </script>
                <?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
            margin-bottom: 20px;
        }
        form {
            width: 40%;
            margin: 0 auto;
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
    <h2>Change Password</h2>
    <form action="" method="post">
        <table border="1">
            <tr>
                <td>Current Password</td>
                <td><input type="text" name="txt_crntpswd"></td>
            </tr>
            <tr>
                <td>New Password</td>
                <td><input type="text" name="txt_newpswd"></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="text" name="txt_cnfrmpswd"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_save" value="Save">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php include("Foot.php");
?>
