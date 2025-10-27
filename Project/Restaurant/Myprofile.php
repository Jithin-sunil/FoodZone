<?php
include("../Assets/connection/Connection.php");
session_start();
$selProfile = "SELECT * FROM tbl_restaurant r INNER JOIN tbl_place p ON r.place_id = p.place_id INNER JOIN tbl_district d ON p.district_id = d.district_id WHERE restaurant_id = ?";
$stmt = $con->prepare($selProfile);
$stmt->bind_param("i", $_SESSION["rid"]);
$stmt->execute();
$row = $stmt->get_result();
if ($row->num_rows == 0) {
    echo "Profile not found.";
    exit();
}
$data = $row->fetch_assoc();
$stmt->close();
include('Head.php');
?>
<div class="container my-5 unique-profile-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="unique-profile-header text-center mb-5">
                <h1 class="unique-profile-title">My Restaurant Profile</h1>
                <p class="unique-profile-subtitle">Manage and view your restaurant details</p>
            </div>
            <div class="card unique-profile-card shadow-lg border-0">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-md-4 unique-profile-photo-section">
                            <div class="unique-profile-photo-wrapper text-center p-4">
                                <img src="../Assets/Files/Rest/Photo/<?php echo htmlspecialchars($data['restaurant_photo']); ?>" alt="Restaurant Photo" class="img-fluid rounded-circle unique-profile-img shadow" style="width: 200px; height: 200px; object-fit: cover;" />
                                <div class="unique-photo-overlay">
                                    <i class="fas fa-camera unique-edit-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 unique-profile-info-section">
                            <div class="p-4">
                                <h2 class="unique-rest-name mb-3"><?php echo htmlspecialchars($data['restaurant_name']); ?></h2>
                                <div class="unique-profile-type mb-3">
                                    <span class="badge bg-success unique-type-badge"><?php echo htmlspecialchars($data['restaurant_type']); ?></span>
                                </div>
                                <div class="unique-profile-details">
                                    <div class="mb-3 unique-detail-item">
                                        <i class="fas fa-map-marker-alt unique-detail-icon text-danger"></i>
                                        <strong class="unique-detail-label">Address:</strong>
                                        <span class="unique-detail-value"><?php echo htmlspecialchars($data['restaurant_address']); ?></span>
                                    </div>
                                    <div class="mb-3 unique-detail-item">
                                        <i class="fas fa-city unique-detail-icon text-primary"></i>
                                        <strong class="unique-detail-label">Place:</strong>
                                        <span class="unique-detail-value"><?php echo htmlspecialchars($data['place_name']); ?></span>
                                    </div>
                                    <div class="mb-3 unique-detail-item">
                                        <i class="fas fa-globe unique-detail-icon text-info"></i>
                                        <strong class="unique-detail-label">District:</strong>
                                        <span class="unique-detail-value"><?php echo htmlspecialchars($data['district_name']); ?></span>
                                    </div>
                                    <div class="mb-3 unique-detail-item">
                                        <i class="fas fa-phone unique-detail-icon text-success"></i>
                                        <strong class="unique-detail-label">Contact:</strong>
                                        <span class="unique-detail-value"><?php echo htmlspecialchars($data['restaurant_contact']); ?></span>
                                    </div>
                                    <div class="mb-4 unique-detail-item">
                                        <i class="fas fa-envelope unique-detail-icon text-warning"></i>
                                        <strong class="unique-detail-label">Email:</strong>
                                        <span class="unique-detail-value"><?php echo htmlspecialchars($data['restaurant_email']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer unique-profile-actions bg-transparent border-0 text-center pt-0">
                    <a href="EditProfile.php" class="btn btn-primary unique-edit-btn me-3">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                    <a href="ChangePassword.php" class="btn btn-outline-secondary unique-password-btn">
                        <i class="fas fa-lock"></i> Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.unique-profile-container {
    background: linear-gradient(rgba(255,255,255,0.95), rgba(255,255,255,0.95)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
    padding: 40px 0;
}
.unique-profile-header {
    background: linear-gradient(135deg, #8B4513, #D2691E);
    color: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
.unique-profile-title {
    margin: 0;
    font-size: 2.5em;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.unique-profile-subtitle {
    margin: 10px 0 0 0;
    font-size: 1.2em;
    opacity: 0.9;
}
.unique-profile-card {
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
    background: rgba(255, 248, 220, 0.95);
}
.unique-profile-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important;
}
.unique-profile-photo-section {
    background: linear-gradient(135deg, #CD853F, #D2691E);
}
.unique-profile-photo-wrapper {
    position: relative;
}
.unique-profile-img {
    border: 4px solid rgba(255,255,255,0.3);
    transition: transform 0.3s ease;
}
.unique-profile-photo-wrapper:hover .unique-profile-img {
    transform: scale(1.05);
}
.unique-photo-overlay {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: rgba(0,0,0,0.5);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.unique-profile-photo-wrapper:hover .unique-photo-overlay {
    opacity: 1;
}
.unique-edit-icon {
    font-size: 1.2em;
}
.unique-rest-name {
    color: #8B4513;
    font-weight: bold;
    text-align: center;
    border-bottom: 2px solid #D2691E;
    padding-bottom: 10px;
}
.unique-profile-type {
    text-align: center;
}
.unique-type-badge {
    font-size: 1em;
    padding: 8px 16px;
}
.unique-profile-details {
    line-height: 1.6;
}
.unique-detail-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}
.unique-detail-item:last-child {
    border-bottom: none;
}
.unique-detail-icon {
    margin-right: 10px;
    font-size: 1.2em;
    width: 20px;
}
.unique-detail-label {
    color: #8B4513;
    margin-right: 10px;
    font-weight: bold;
}
.unique-detail-value {
    color: #2F1B14;
    flex: 1;
}
.unique-profile-actions {
    padding: 20px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
}
.unique-edit-btn, .unique-password-btn {
    border-radius: 25px;
    font-weight: bold;
    padding: 12px 30px;
    transition: all 0.3s ease;
    font-size: 1em;
}
.unique-edit-btn:hover {
    background-color: #D2691E;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(210, 105, 30, 0.4);
}
.unique-password-btn:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
    transform: translateY(-2px);
}
@media (max-width: 768px) {
    .unique-profile-container {
        padding: 20px 0;
    }
    .unique-profile-title {
        font-size: 2em;
    }
    .unique-profile-photo-section {
        text-align: center;
    }
    .unique-detail-item {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
    .unique-profile-actions {
        flex-direction: column;
        gap: 10px;
    }
    .unique-edit-btn, .unique-password-btn {
        width: 100%;
    }
}
</style>
<?php include('Foot.php'); ?>