<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");

if (!isset($_GET['pid'])) {
    echo "Food Not Found";
    exit();
}

$pid = $_GET['pid'];

$selfood = "SELECT * FROM tbl_food f 
           INNER JOIN tbl_foodcategory fc ON fc.foodcategory_id = f.foodcategory_id
           INNER JOIN tbl_foodtype ft ON ft.foodtype_id = fc.foodtype_id
           INNER JOIN tbl_restaurant r ON f.restaurant_id = r.restaurant_id
           INNER JOIN tbl_place p ON r.place_id = p.place_id
           INNER JOIN tbl_district d ON p.district_id = d.district_id
           WHERE f.food_id = '" . $pid . "'";
$resfood = $con->query($selfood);
if ($resfood->num_rows == 0) {
    echo "Food Not Found";
    exit();
}
$datafood = $resfood->fetch_assoc();

// Calculate average rating
$avgQry = "SELECT AVG(rating_data) as avg_rate, COUNT(rating_id) as count_rate FROM tbl_rating WHERE food_id = '$pid'";
$avgRes = $con->query($avgQry);
$avgData = $avgRes->fetch_assoc();
$average_rating = $avgData['avg_rate'] ?? 0;
$total_review = $avgData['count_rate'] ?? 0;
?>
<div class="container my-5 unique-food-detail-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="unique-food-header text-center mb-4">
                <h1 class="unique-food-title"><?php echo htmlspecialchars($datafood['food_name']); ?></h1>
                <p class="unique-food-subtitle">Delicious <?php echo htmlspecialchars($datafood['foodcategory_name']); ?> - <?php echo htmlspecialchars($datafood['foodtype_name']); ?></p>
                <!-- Average Rating -->
                <div class="average-rating mb-3">
                    <p align="center" style="color:#F96; font-size:20px; margin: 0;">
                        <?php
                        $full_stars = floor($average_rating);
                        $decimal_part = $average_rating - $full_stars;
                        for ($s = 1; $s <= 5; $s++) {
                            if ($s <= $full_stars) { echo '<i class="fas fa-star" style="color:#FC3"></i>'; }
                            else if ($s == ($full_stars + 1) && $decimal_part >= 0.25) { echo '<i class="fas fa-star-half-alt" style="color:#FC3"></i>'; }
                            else { echo '<i class="far fa-star" style="color:#999"></i>'; }
                        }
                        ?>
                    </p>
                    <div style="text-align:center; font-size:12px; color:#555;">
                        <?php echo number_format($average_rating, 1) . ' (' . $total_review . ' reviews)'; ?>
                    </div>
                    <a href="ViewRating.php?fid=<?php echo $_GET['pid']?>" class="btn btn-outline-light btn-sm mt-2">View Ratings</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="unique-food-image-wrapper">
                        <img src="../Assets/Files/Food/<?php echo htmlspecialchars($datafood['food_photo']); ?>" alt="<?php echo htmlspecialchars($datafood['food_name']); ?>" class="img-fluid unique-main-food-img rounded shadow" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="unique-food-info-card card border-0 shadow-sm h-100">
                        <div class="card-body unique-food-card-body">
                            <div class="unique-price-section mb-3">
                                <h2 class="unique-food-price text-success">₹<?php echo number_format($datafood['food_price'], 2); ?></h2>
                            </div>
                            <div class="unique-add-cart-section mb-3">
                                <button onclick="AddtoCart(<?php echo $datafood['food_id']; ?>)" class="btn btn-success btn-lg unique-add-cart-btn w-100">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </div>
                            <hr class="unique-divider">
                            <div class="unique-description-section">
                                <h5 class="unique-desc-title mb-3"><i class="fas fa-info-circle"></i> Description</h5>
                                <p class="unique-food-desc"><?php echo htmlspecialchars($datafood['food_details']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="unique-restaurant-card card border-0 shadow-sm">
                        <div class="card-header unique-rest-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-store"></i> Sold By</h5>
                        </div>
                        <div class="card-body unique-rest-card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="unique-rest-name"><?php echo htmlspecialchars($datafood['restaurant_name']); ?></h6>
                                    <p class="unique-rest-address mb-2">
                                        <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($datafood['restaurant_address']); ?><br>
                                        <?php echo htmlspecialchars($datafood['place_name']); ?>, <?php echo htmlspecialchars($datafood['district_name']); ?>
                                    </p>
                                    <p class="unique-rest-contact mb-0">
                                        <i class="fas fa-phone"></i> <?php echo htmlspecialchars($datafood['restaurant_contact']); ?>
                                    </p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <img src="../Assets/Files/Rest/Photo/<?php echo htmlspecialchars($datafood['restaurant_photo']); ?>" alt="Restaurant" class="img-fluid rounded-circle unique-rest-avatar" style="width: 100px; height: 100px; object-fit: cover;" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function AddtoCart(pid) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxAddCart.php?pid=" + pid,
            method: "GET",
            success: function(result) {
                alert(result);
            },
            error: function() {
                alert("Error adding to cart. Please try again.");
            }
        });
    }
</script>

<style>
.unique-food-detail-container {
    background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
    padding: 40px 0;
}
.unique-food-header {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
.unique-food-title {
    margin: 0;
    font-size: 2.5em;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.unique-food-subtitle {
    margin: 10px 0 0 0;
    font-size: 1.2em;
    opacity: 0.9;
}
.average-rating {
    margin-top: 10px;
}
.unique-food-image-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}
.unique-main-food-img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.unique-main-food-img:hover {
    transform: scale(1.05);
}
.unique-food-info-card {
    border-radius: 15px;
    background: white;
}
.unique-food-card-body {
    padding: 30px;
}
.unique-price-section {
    text-align: center;
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 10px;
}
.unique-food-price {
    font-size: 2.5em;
    margin: 0;
    font-weight: bold;
}
.unique-add-cart-section {
    margin-bottom: 20px;
}
.unique-add-cart-btn {
    border-radius: 50px;
    font-size: 1.2em;
    font-weight: bold;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
}
.unique-add-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(40, 167, 69, 0.4);
    background-color: #218838;
}
.unique-divider {
    border-color: #dee2e6;
    margin: 25px 0;
}
.unique-description-section {
    line-height: 1.7;
}
.unique-desc-title {
    color: #28a745;
    font-weight: bold;
}
.unique-food-desc {
    color: #6c757d;
    font-size: 1.1em;
}
.unique-restaurant-card {
    border-radius: 15px;
}
.unique-rest-header {
    border-radius: 15px 15px 0 0;
    padding: 15px 25px;
}
.unique-rest-card-body {
    padding: 25px;
}
.unique-rest-name {
    color: #28a745;
    font-size: 1.5em;
    margin-bottom: 10px;
    font-weight: bold;
}
.unique-rest-address, .unique-rest-contact {
    color: #495057;
    font-size: 1em;
}
.unique-rest-avatar {
    border: 3px solid #28a745;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
/* Ratings Styles */
.review {
    background-color: #f8f9fa;
}
.stars i {
    font-size: 1.2em;
}
@media (max-width: 768px) {
    .unique-food-title {
        font-size: 2em;
    }
    .unique-food-price {
        font-size: 2em;
    }
    .unique-main-food-img {
        height: 250px;
    }
    .unique-food-card-body {
        padding: 20px;
    }
}
</style>
<?php include("Foot.php"); ?>