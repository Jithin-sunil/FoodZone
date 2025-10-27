<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");

if (!isset($_SESSION['rid'])) {
    echo "Please login to manage foods.";
    exit();
}

if (isset($_POST["btn_submit"])) {
    $name = trim($_POST['txt_name']);
    $det = trim($_POST['txt_details']);
    $price = trim($_POST['txt_price']);
    $photo = $_FILES['txt_photo']['name'];
    $temp = $_FILES['txt_photo']['tmp_name'];
    $category = $_POST["txt_foodcategory"];
    
    if (!empty($photo)) {
        move_uploaded_file($temp, "../Assets/Files/Food/" . $photo);
    }
    
    $insStmt = $con->prepare("INSERT INTO tbl_food (food_name, food_details, food_price, food_photo, foodcategory_id, restaurant_id, food_status) VALUES (?, ?, ?, ?, ?, ?, 1)");
    $insStmt->bind_param("sssisi", $name, $det, $price, $photo, $category, $_SESSION['rid']);
    if ($insStmt->execute()) {
        echo "<script>alert('Food added successfully'); window.location='Food.php';</script>";
    }
    $insStmt->close();
}

if (isset($_GET["statusID"])) {
    $food_id = $_GET["statusID"];
    $new_status = $_GET["status"];
    $upStmt = $con->prepare("UPDATE tbl_food SET food_status = ? WHERE food_id = ?");
    $upStmt->bind_param("ii", $new_status, $food_id);
    if ($upStmt->execute()) {
        echo "<script>alert('Status updated successfully'); window.location='Food.php';</script>";
    }
    $upStmt->close();
}

if (isset($_GET["delID"])) {
    $delStmt = $con->prepare("DELETE FROM tbl_food WHERE food_id = ?");
    $delStmt->bind_param("i", $_GET["delID"]);
    if ($delStmt->execute()) {
        echo "<script>alert('Food deleted successfully'); window.location='Food.php';</script>";
    }
    $delStmt->close();
}
?>
<div class="container my-5 unique-food-mgmt-container">
    <div class="row">
        <div class="col-12">
            <div class="unique-food-mgmt-header text-center mb-5">
                <h2 class="unique-food-mgmt-title">Manage Food Items</h2>
                <p class="unique-food-mgmt-subtitle">Add new dishes and manage your menu</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card unique-add-food-card shadow-sm border-0 h-100">
                <div class="card-header unique-add-food-header bg-success text-white text-center">
                    <h5 class="mb-0"><i class="fas fa-plus"></i> Add New Food</h5>
                </div>
                <div class="card-body unique-add-food-body">
                    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="txt_name" class="form-label unique-form-label">Food Name</label>
                            <input type="text" name="txt_name" id="txt_name" class="form-control unique-form-input" required />
                        </div>
                        <div class="mb-3">
                            <label for="txt_details" class="form-label unique-form-label">Details</label>
                            <input type="text" name="txt_details" id="txt_details" class="form-control unique-form-input" required />
                        </div>
                        <div class="mb-3">
                            <label for="txt_price" class="form-label unique-form-label">Price (₹)</label>
                            <input type="number" step="0.01" name="txt_price" id="txt_price" class="form-control unique-form-input" required />
                        </div>
                        <div class="mb-3">
                            <label for="txt_photo" class="form-label unique-form-label">Photo</label>
                            <input type="file" name="txt_photo" id="txt_photo" class="form-control unique-form-input" accept="image/*" required />
                        </div>
                        <div class="mb-3">
                            <label for="slt_food" class="form-label unique-form-label">Food Type</label>
                            <select name="slt_food" id="slt_food" class="form-select unique-form-select" required onchange="getCategory(this.value)">
                                <option value="">--Select Type--</option>
                                <?php
                                $selqry = "SELECT * FROM tbl_foodtype";
                                $row = $con->query($selqry);
                                while ($data = $row->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($data['foodtype_id']) . "'>" . htmlspecialchars($data['foodtype_name']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="txt_foodcategory" class="form-label unique-form-label">Food Category</label>
                            <select name="txt_foodcategory" id="txt_foodcategory" class="form-select unique-form-select" required>
                                <option value="">--Select Category--</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" name="btn_submit" id="btn_submit" value="Add Food" class="btn btn-success unique-submit-btn" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card unique-food-list-preview shadow-sm border-0 h-100">
                <div class="card-header unique-list-header bg-info text-white text-center">
                    <h5 class="mb-0"><i class="fas fa-list"></i> Quick Preview</h5>
                </div>
                <div class="card-body unique-list-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 unique-food-preview-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $previewQry = "SELECT f.food_name, f.food_price, f.food_status FROM tbl_food f WHERE f.restaurant_id = ? LIMIT 5";
                                $previewStmt = $con->prepare($previewQry);
                                $previewStmt->bind_param("i", $_SESSION['rid']);
                                $previewStmt->execute();
                                $previewResult = $previewStmt->get_result();
                                while ($previewData = $previewResult->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($previewData['food_name']); ?></td>
                                    <td>₹<?php echo number_format($previewData['food_price'], 2); ?></td>
                                    <td><span class="badge <?php echo ($previewData['food_status'] == 1) ? 'bg-success' : 'bg-danger'; ?>"> <?php echo ($previewData['food_status'] == 1) ? 'Available' : 'Unavailable'; ?></span></td>
                                </tr>
                                <?php
                                }
                                $previewStmt->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card unique-food-list-card shadow-sm border-0">
                <div class="card-header unique-full-list-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-utensils"></i> All Food Items</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 unique-food-mgmt-table">
                            <thead class="table-dark">
                                <tr>
                                    <th class="unique-si-col">SI No</th>
                                    <th class="unique-name-col">Name</th>
                                    <th class="unique-details-col">Details</th>
                                    <th class="unique-price-col">Price</th>
                                    <th class="unique-photo-col">Photo</th>
                                    <th class="unique-type-col">Type</th>
                                    <th class="unique-category-col">Category</th>
                                    <th class="unique-status-col">Status</th>
                                    <th class="unique-action-col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $selqry = "SELECT * FROM tbl_food f INNER JOIN tbl_restaurant r ON f.restaurant_id = r.restaurant_id INNER JOIN tbl_foodcategory fc ON f.foodcategory_id = fc.foodcategory_id INNER JOIN tbl_foodtype ft ON fc.foodtype_id = ft.foodtype_id WHERE f.restaurant_id = ?";
                                $stmt = $con->prepare($selqry);
                                $stmt->bind_param("i", $_SESSION['rid']);
                                $stmt->execute();
                                $row = $stmt->get_result();
                                while ($data = $row->fetch_assoc()) {
                                    $i++;
                                    $statusText = ($data['food_status'] == 1) ? 'Available' : 'Unavailable';
                                    $statusClass = ($data['food_status'] == 1) ? 'bg-success' : 'bg-danger';
                                    $toggleText = ($data['food_status'] == 1) ? 'Make Unavailable' : 'Make Available';
                                    $toggleStatus = ($data['food_status'] == 1) ? 0 : 1;
                                ?>
                                <tr class="unique-food-row">
                                    <td class="unique-si-cell"><?php echo $i; ?></td>
                                    <td class="unique-name-cell"><?php echo htmlspecialchars($data['food_name']); ?></td>
                                    <td class="unique-details-cell"><?php echo htmlspecialchars($data['food_details']); ?></td>
                                    <td class="unique-price-cell">₹<?php echo number_format($data['food_price'], 2); ?></td>
                                    <td class="unique-photo-cell">
                                        <img src="../Assets/Files/Food/<?php echo htmlspecialchars($data['food_photo']); ?>" alt="Food Photo" width="50" class="img-thumbnail unique-food-img" />
                                    </td>
                                    <td class="unique-type-cell"><?php echo htmlspecialchars($data['foodtype_name']); ?></td>
                                    <td class="unique-category-cell"><?php echo htmlspecialchars($data['foodcategory_name']); ?></td>
                                    <td class="unique-status-cell">
                                        <span class="badge <?php echo $statusClass; ?> unique-status-badge"><?php echo $statusText; ?></span>
                                    </td>
                                    <td class="unique-action-cell">
                                        <a href="Food.php?statusID=<?php echo $data['food_id']; ?>&status=<?php echo $toggleStatus; ?>" class="btn btn-warning btn-sm unique-toggle-btn me-1" onclick="return confirm('Are you sure?');">
                                            <?php echo $toggleText; ?>
                                        </a>
                                        <a href="Food.php?delID=<?php echo $data['food_id']; ?>" class="btn btn-danger btn-sm unique-delete-btn" onclick="return confirm('Are you sure?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                }
                                $stmt->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function getCategory(typeId) {
        if (typeId) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxCategory.php?typeId=" + typeId,
                method: "GET",
                success: function(html) {
                    $("#txt_foodcategory").html(html);
                },
                error: function() {
                    $("#txt_foodcategory").html('<option value="">Error loading categories</option>');
                }
            });
        } else {
            $("#txt_foodcategory").html('<option value="">--Select Category--</option>');
        }
    }
</script>

<style>
.unique-food-mgmt-container {
    background: linear-gradient(rgba(255,255,255,0.95), rgba(255,255,255,0.95));
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}
.unique-food-mgmt-header {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
.unique-food-mgmt-title {
    margin: 0;
    font-size: 2.5em;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.unique-food-mgmt-subtitle {
    margin: 10px 0 0 0;
    font-size: 1.2em;
    opacity: 0.9;
}
.unique-add-food-card, .unique-food-list-preview, .unique-food-list-card {
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}
.unique-add-food-card:hover, .unique-food-list-preview:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
}
.unique-add-food-header, .unique-list-header, .unique-full-list-header {
    padding: 15px;
}
.unique-add-food-body {
    padding: 25px;
}
.unique-form-label {
    font-weight: bold;
    color: #28a745;
}
.unique-form-input, .unique-form-select {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: border-color 0.3s ease;
}
.unique-form-input:focus, .unique-form-select:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}
.unique-submit-btn {
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: bold;
    transition: all 0.3s ease;
}
.unique-submit-btn:hover {
    background-color: #218838;
    transform: translateY(-2px);
}
.unique-list-body {
    max-height: 300px;
    overflow-y: auto;
}
.unique-food-preview-table th, .unique-food-preview-table td {
    padding: 12px;
    vertical-align: middle;
}
.unique-food-mgmt-table {
    font-size: 0.9em;
}
.unique-food-mgmt-table th {
    font-weight: 600;
    text-align: center;
}
.unique-food-mgmt-table td {
    vertical-align: middle;
    text-align: center;
}
.unique-food-row:hover {
    background-color: #f8f9fa;
}
.unique-food-img {
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.unique-status-badge {
    font-size: 0.8em;
    padding: 6px 12px;
}
.unique-toggle-btn, .unique-delete-btn {
    border-radius: 15px;
    font-size: 0.85em;
    transition: all 0.3s ease;
}
.unique-toggle-btn:hover {
    transform: translateY(-1px);
}
.unique-delete-btn:hover {
    background-color: #c82333;
    transform: translateY(-1px);
}
@media (max-width: 768px) {
    .unique-food-mgmt-container {
        padding: 20px;
    }
    .unique-food-mgmt-title {
        font-size: 2em;
    }
    .unique-food-mgmt-table {
        font-size: 0.8em;
    }
    .unique-action-cell .btn {
        margin-bottom: 5px;
        display: block;
    }
}
</style>
<?php include("Foot.php"); ?>