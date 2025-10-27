<?php
session_start();
include("../Assets/Connection/Connection.php");

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
</head>
<body>
    <form action="" method="post">
    <table border="1">
        <tr>
            <td>Current Paswword</td>
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
           
            <td>
                <input type="submit" name="btn_save" value="Save">
            </td>
        </tr>
    </table></form>
</body>
</html>