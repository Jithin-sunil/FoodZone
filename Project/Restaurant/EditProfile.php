<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");

if (!isset($_SESSION['rid'])) {
    echo "Please login to edit profile.";
    exit();
}

$selProfile = "SELECT * FROM tbl_restaurant WHERE restaurant_id = ?";
$stmt = $con->prepare($selProfile);
$stmt->bind_param("i", $_SESSION['rid']);
$stmt->execute();
$row = $stmt->get_result();
if ($row->num_rows == 0) {
    echo "Profile not found.";
    exit();
}
$data = $row->fetch_assoc();
$stmt->close();

if (isset($_POST['btn_save'])) {
    $name = trim($_POST['txt_name']);
    $contact = trim($_POST['txt_contact']);
    $address = trim($_POST['txt_address']);
    
    $updateStmt = $con->prepare("UPDATE tbl_restaurant SET restaurant_name = ?, restaurant_contact = ?, restaurant_address = ? WHERE restaurant_id = ?");
    $updateStmt->bind_param("sssi", $name, $contact, $address, $_SESSION['rid']);
    if ($updateStmt->execute()) {
        echo "<script>alert('Profile updated successfully'); window.location='MyProfile.php';</script>";
    }
    $updateStmt->close();
}
?>
<div class="container my-5 unique-edit-profile-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="unique-edit-header text-center mb-5">
                <h1 class="unique-edit-title">Edit Restaurant Profile</h1>
                <p class="unique-edit-subtitle">Update your restaurant information</p>
            </div>
            <div class="card unique-edit-card shadow-lg border-0">
                <div class="card-body unique-edit-card-body p-4">
                    <form id="form1" name="form1" method="post" action="">
                        <div class="mb-4">
                            <label for="txt_name" class="form-label unique-form-label">
                                <i class="fas fa-utensils unique-label-icon text-success"></i> Restaurant Name
                            </label>
                            <input type="text" name="txt_name" id="txt_name" class="form-control unique-form-control" value="<?php echo htmlspecialchars($data['restaurant_name']); ?>" required />
                        </div>
                        <div class="mb-4">
                            <label for="txt_contact" class="form-label unique-form-label">
                                <i class="fas fa-phone unique-label-icon text-info"></i> Contact Number
                            </label>
                            <input type="tel" name="txt_contact" id="txt_contact" class="form-control unique-form-control" value="<?php echo htmlspecialchars($data['restaurant_contact']); ?>" required />
                        </div>
                        <div class="mb-4">
                            <label for="txt_address" class="form-label unique-form-label">
                                <i class="fas fa-map-marker-alt unique-label-icon text-danger"></i> Address
                            </label>
                            <textarea name="txt_address" id="txt_address" class="form-control unique-textarea" rows="4" required><?php echo htmlspecialchars($data['restaurant_address']); ?></textarea>
                        </div>
                        <div class="text-center unique-buttons-wrapper">
                            <input type="submit" name="btn_save" id="btn_save" value="Save Changes" class="btn btn-success unique-save-btn me-3" />
                            <input type="reset" name="btn_cancel" id="btn_cancel" value="Reset" class="btn btn-outline-secondary unique-reset-btn" onclick="window.location='MyProfile.php';" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.unique-edit-profile-container {
    background: linear-gradient(rgba(255,255,255,0.95), rgba(255,255,255,0.95)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
    padding: 40px 0;
}
.unique-edit-header {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
.unique-edit-title {
    margin: 0;
    font-size: 2.5em;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.unique-edit-subtitle {
    margin: 10px 0 0 0;
    font-size: 1.2em;
    opacity: 0.9;
}
.unique-edit-card {
    border-radius: 20px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.98);
}
.unique-edit-card-body {
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
.unique-form-control, .unique-textarea {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    padding: 12px 15px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    font-size: 1em;
}
.unique-form-control:focus, .unique-textarea:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}
.unique-textarea {
    resize: vertical;
    min-height: 100px;
}
.unique-buttons-wrapper {
    margin-top: 30px;
}
.unique-save-btn, .unique-reset-btn {
    border-radius: 25px;
    font-weight: bold;
    padding: 12px 30px;
    transition: all 0.3s ease;
    font-size: 1em;
}
.unique-save-btn:hover {
    background-color: #218838;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
}
.unique-reset-btn:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    transform: translateY(-2px);
}
@media (max-width: 768px) {
    .unique-edit-profile-container {
        padding: 20px 0;
    }
    .unique-edit-title {
        font-size: 2em;
    }
    .unique-edit-card-body {
        padding: 20px;
    }
    .unique-buttons-wrapper {
        flex-direction: column;
        gap: 10px;
    }
    .unique-save-btn, .unique-reset-btn {
        width: 100%;
    }
}
</style>
<?php include("Foot.php"); ?>