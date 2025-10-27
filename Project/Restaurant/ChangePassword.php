<?php
session_start();
include("../Assets/connection/Connection.php");

if (!isset($_SESSION['rid'])) {
    echo "Please login to change password.";
    exit();
}

if (isset($_POST['btn_save'])) {
    $oldPswd = trim($_POST['txt_crntpswd']);
    $newPswd = trim($_POST['txt_newpswd']);
    $confmPswd = trim($_POST['txt_cnfrmpswd']);

    // Fetch current password using prepared statement
    $selPswd = "SELECT restaurant_password FROM tbl_restaurant WHERE restaurant_id = ?";
    $stmt = $con->prepare($selPswd);
    $stmt->bind_param("i", $_SESSION['rid']);
    $stmt->execute();
    $row = $stmt->get_result();
    if ($row->num_rows == 0) {
        echo "<script>alert('Profile not found'); window.location='MyProfile.php';</script>";
        exit();
    }
    $data = $row->fetch_assoc();
    $stmt->close();

    // Verify old password (assuming hashed; if not, adjust accordingly)
    if (password_verify($oldPswd, $data['restaurant_password'])) {
        if ($newPswd === $confmPswd) {
            $hashedNewPswd = password_hash($newPswd, PASSWORD_DEFAULT);
            $updatePswd = "UPDATE tbl_restaurant SET restaurant_password = ? WHERE restaurant_id = ?";
            $updateStmt = $con->prepare($updatePswd);
            $updateStmt->bind_param("si", $hashedNewPswd, $_SESSION['rid']);
            if ($updateStmt->execute()) {
                echo "<script>alert('Password changed successfully'); window.location='MyProfile.php';</script>";
            } else {
                echo "<script>alert('Error updating password'); window.location='ChangePassword.php';</script>";
            }
            $updateStmt->close();
        } else {
            echo "<script>alert('New password and confirm password do not match'); window.location='ChangePassword.php';</script>";
        }
    } else {
        echo "<script>alert('Current password is incorrect'); window.location='ChangePassword.php';</script>";
    }
}

include('Head.php');
?>
<div class="container my-5 unique-password-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="unique-password-header text-center mb-5">
                <h1 class="unique-password-title">Change Password</h1>
                <p class="unique-password-subtitle">Securely update your account password</p>
            </div>
            <div class="card unique-password-card shadow-lg border-0">
                <div class="card-body unique-password-card-body p-4">
                    <form action="" method="post">
                        <div class="mb-4">
                            <label for="txt_crntpswd" class="form-label unique-form-label">
                                <i class="fas fa-lock unique-label-icon text-warning"></i> Current Password
                            </label>
                            <input type="password" name="txt_crntpswd" id="txt_crntpswd" class="form-control unique-form-control" placeholder="Enter current password" required />
                        </div>
                        <div class="mb-4">
                            <label for="txt_newpswd" class="form-label unique-form-label">
                                <i class="fas fa-key unique-label-icon text-primary"></i> New Password
                            </label>
                            <input type="password" name="txt_newpswd" id="txt_newpswd" class="form-control unique-form-control" placeholder="Enter new password" required minlength="6" />
                            <div class="form-text unique-password-hint">Password must be at least 6 characters long.</div>
                        </div>
                        <div class="mb-4">
                            <label for="txt_cnfrmpswd" class="form-label unique-form-label">
                                <i class="fas fa-check-circle unique-label-icon text-success"></i> Confirm New Password
                            </label>
                            <input type="password" name="txt_cnfrmpswd" id="txt_cnfrmpswd" class="form-control unique-form-control" placeholder="Confirm new password" required />
                        </div>
                        <div class="text-center unique-password-buttons">
                            <input type="submit" name="btn_save" id="btn_save" value="Change Password" class="btn btn-primary unique-save-password-btn me-3" />
                            <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" class="btn btn-outline-secondary unique-cancel-btn" onclick="window.location='MyProfile.php';" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.unique-password-container {
    background: linear-gradient(rgba(255,255,255,0.95), rgba(255,255,255,0.95)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
    padding: 40px 0;
}
.unique-password-header {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
.unique-password-title {
    margin: 0;
    font-size: 2.5em;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.unique-password-subtitle {
    margin: 10px 0 0 0;
    font-size: 1.2em;
    opacity: 0.9;
}
.unique-password-card {
    border-radius: 20px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.98);
}
.unique-password-card-body {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}
.unique-form-label {
    font-weight: bold;
    color: #495057;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}
.unique-label-icon {
    margin-right: 8px;
    font-size: 1.2em;
}
.unique-form-control {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    padding: 12px 15px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    font-size: 1em;
}
.unique-form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
.unique-password-hint {
    color: #6c757d;
    font-size: 0.875em;
    margin-top: 4px;
}
.unique-password-buttons {
    margin-top: 30px;
}
.unique-save-password-btn, .unique-cancel-btn {
    border-radius: 25px;
    font-weight: bold;
    padding: 12px 30px;
    transition: all 0.3s ease;
    font-size: 1em;
}
.unique-save-password-btn:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 86, 179, 0.4);
}
.unique-cancel-btn:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    transform: translateY(-2px);
}
@media (max-width: 768px) {
    .unique-password-container {
        padding: 20px 0;
    }
    .unique-password-title {
        font-size: 2em;
    }
    .unique-password-card-body {
        padding: 20px;
    }
    .unique-password-buttons {
        flex-direction: column;
        gap: 10px;
    }
    .unique-save-password-btn, .unique-cancel-btn {
        width: 100%;
    }
}
</style>
<?php include('Foot.php'); ?>