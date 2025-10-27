<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");

if (!isset($_SESSION['uid'])) {
    echo "Please login to view bookings.";
    exit();
}
?>
<div class="container my-5 unique-bookings-container">
    <div class="row">
        <div class="col-12">
            <div class="unique-bookings-header text-center mb-5">
                <h2 class="unique-bookings-title">My Bookings</h2>
                <p class="unique-bookings-subtitle">Track your orders and manage bookings</p>
            </div>
        </div>
    </div>
    <div class="row unique-bookings-grid">
        <?php
        $selBookings = "SELECT * FROM tbl_booking WHERE user_id = ".$_SESSION['uid']." AND booking_status > 0 ORDER BY booking_id DESC";
        $bookingResult = $con->query($selBookings);
        
        $hasBookings = false;
        while ($bookingData = $bookingResult->fetch_assoc()) {
            $hasBookings = true;
            $statusText = '';
            $statusClass = '';
            if ($bookingData['booking_status'] == 1) {
                $statusText = 'Payment Pending';
                $statusClass = 'badge-warning';
            } elseif ($bookingData['booking_status'] == 2) {
                $statusText = 'Payment Completed';
                $statusClass = 'badge-info';
            } elseif ($bookingData['booking_status'] == 3) {
                $statusText = 'Food Packed';
                $statusClass = 'badge-primary';
            } elseif ($bookingData['booking_status'] == 4) {
                $statusText = 'Food Shipped';
                $statusClass = 'badge-secondary';
            } elseif ($bookingData['booking_status'] == 5) {
                $statusText = 'Out for Delivery';
                $statusClass = 'badge-success';
            } elseif ($bookingData['booking_status'] == 6) {
                $statusText = 'Delivered';
                $statusClass = 'badge-success';
            } else {
                $statusText = 'Unknown Status';
                $statusClass = 'badge-danger';
            }
        ?>
        <div class="col-12 mb-4">
            <div class="card unique-booking-card shadow-sm border-0 h-100">
                <div class="card-header unique-booking-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <div>
                        <h5 class="mb-0 unique-booking-id">Booking ID: #<?php echo $bookingData['booking_id']; ?></h5>
                        <small class="unique-booking-date">Date: <?php echo date('M d, Y', strtotime($bookingData['booking_date'])); ?></small>
                    </div>
                    <span class="badge <?php echo $statusClass; ?> unique-status-badge"><?php echo $statusText; ?></span>
                </div>
                <div class="card-body unique-booking-body">
                    <div class="row">
                        <?php
                        $selCartItems = "SELECT * FROM tbl_cart c 
                                        INNER JOIN tbl_food f ON f.food_id = c.food_id 
                                        INNER JOIN tbl_restaurant r ON r.restaurant_id = f.restaurant_id 
                                        WHERE c.booking_id = ".$bookingData['booking_id'];
                        $cartResult = $con->query($selCartItems);
                        $i = 0;
                        $grandTotal = 0;
                        while ($cartData = $cartResult->fetch_assoc()) {
                            $i++;
                            $itemTotal = round($cartData['food_price'] * $cartData['cart_qty'], 2);
                            $grandTotal += $itemTotal;
                            $restaurantInfo = $cartData['restaurant_name'] . "<br><small>" . $cartData['restaurant_email'] . "</small>";
                        ?>
                        <div class="col-lg-6 col-md-12 mb-3">
                            <div class="unique-item-card card border-0 bg-light">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <img src="../Assets/Files/Food/<?php echo $cartData['food_photo']; ?>" alt="<?php echo $cartData['food_name']; ?>" class="img-fluid rounded unique-item-img" style="height: 80px; object-fit: cover;" />
                                        </div>
                                        <div class="col-9">
                                            <h6 class="unique-item-name mb-1"><?php echo $cartData['food_name']; ?></h6>
                                            <p class="unique-item-price mb-1 small text-success fw-bold">₹<?php echo number_format($cartData['food_price'], 2); ?></p>
                                            <p class="unique-item-qty mb-2 small text-muted">Qty: <?php echo $cartData['cart_qty']; ?> | Total: ₹<?php echo number_format($itemTotal, 2); ?></p>
                                            <div class="unique-restaurant-info small text-muted mb-2"><?php echo $restaurantInfo; ?></div>
                                            <div class="unique-item-action">
                                                <?php if ($bookingData['booking_status'] == 6) { ?>
                                                    <a href="Rating.php?fid=<?php echo $cartData['food_id']; ?>" class="btn btn-outline-warning btn-sm unique-rate-btn">
                                                        <i class="fas fa-star"></i> Rate Food
                                                    </a>
                                                    <a href="RatingR.php?rid=<?php echo $cartData['restaurant_id']; ?>" class="btn btn-outline-primary btn-sm unique-rate-btn">
                                                        <i class="fas fa-store"></i> Rate Restaurant
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <hr class="unique-divider my-3">
                    <div class="text-end unique-total-section">
                        <h4 class="text-primary mb-0">Grand Total: ₹<?php echo number_format($bookingData['booking_amount'], 2); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        
        if (!$hasBookings) {
        ?>
        <div class="col-12 text-center">
            <div class="unique-no-bookings-wrapper">
                <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No Bookings Yet</h4>
                <p class="text-muted">Your bookings will appear here once you place an order.</p>
                <a href="Viewfood.php" class="btn btn-primary unique-explore-btn">Explore Foods</a>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<style>
.unique-bookings-container {
    background: linear-gradient(rgba(255,255,255,0.95), rgba(255,255,255,0.95));
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}
.unique-bookings-header {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
.unique-bookings-title {
    margin: 0;
    font-size: 2.5em;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.unique-bookings-subtitle {
    margin: 10px 0 0 0;
    font-size: 1.2em;
    opacity: 0.9;
}
.unique-bookings-grid {
    margin-top: 20px;
}
.unique-booking-card {
    border-radius: 15px;
    transition: all 0.3s ease;
    overflow: hidden;
}
.unique-booking-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
.unique-booking-header {
    padding: 20px;
    border-radius: 15px 15px 0 0;
}
.unique-booking-id {
    font-size: 1.3em;
    font-weight: bold;
}
.unique-booking-date {
    opacity: 0.9;
}
.unique-status-badge {
    font-size: 0.9em;
    padding: 8px 15px;
}
.unique-booking-body {
    padding: 25px;
}
.unique-item-card {
    border-radius: 10px;
    transition: all 0.3s ease;
}
.unique-item-card:hover {
    background: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.unique-item-img {
    border: 2px solid #f8f9fa;
}
.unique-item-name {
    color: #333;
    font-weight: bold;
}
.unique-restaurant-info {
    line-height: 1.4;
}
.unique-rate-btn {
    border-radius: 20px;
    font-size: 0.85em;
    transition: all 0.3s ease;
    margin-right: 5px;
}
.unique-rate-btn:hover {
    transform: translateY(-1px);
}
.unique-divider {
    border-color: #dee2e6;
    opacity: 0.5;
}
.unique-total-section {
    padding: 15px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 10px;
}
.unique-no-bookings-wrapper {
    padding: 60px 20px;
    background: #f8f9fa;
    border-radius: 15px;
    margin-top: 40px;
}
.unique-explore-btn {
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: bold;
    transition: all 0.3s ease;
}
.unique-explore-btn:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}
@media (max-width: 768px) {
    .unique-bookings-container {
        padding: 20px;
    }
    .unique-bookings-title {
        font-size: 2em;
    }
    .unique-booking-header {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    .unique-item-card .row {
        text-align: center;
    }
    .unique-rate-btn {
        margin-bottom: 5px;
        margin-right: 0;
    }
}
</style>
<?php include("Foot.php"); ?>