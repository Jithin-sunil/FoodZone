<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");

if (!isset($_SESSION['rid'])) {
    echo "Please login to view bookings.";
    exit();
}

if (isset($_GET['updateStatus'])) {
    $booking_id = $_GET['updateStatus'];
    $new_status = $_GET['status'];
    $upStmt = $con->prepare("UPDATE tbl_booking SET booking_status = ? WHERE booking_id = ?");
    $upStmt->bind_param("ii", $new_status, $booking_id);
    if ($upStmt->execute()) {
        ?>
        <script>
            alert("Status updated successfully");
            window.location = "ViewBooking.php";
        </script>
        <?php
    }
    $upStmt->close();
}
?>
<div class="container my-5 unique-rest-bookings-container">
    <div class="row">
        <div class="col-12">
            <div class="unique-rest-bookings-header text-center mb-5">
                <h2 class="unique-rest-bookings-title">My Restaurant Bookings</h2>
                <p class="unique-rest-bookings-subtitle">Manage orders and update statuses</p>
            </div>
        </div>
    </div>
    <div class="row unique-rest-bookings-grid">
        <?php
        $selBookings = "SELECT DISTINCT b.* FROM tbl_booking b 
                        INNER JOIN tbl_cart c ON c.booking_id = b.booking_id 
                        INNER JOIN tbl_food f ON f.food_id = c.food_id 
                        WHERE f.restaurant_id = ? ORDER BY b.booking_id DESC";
        $stmt = $con->prepare($selBookings);
        $stmt->bind_param("i", $_SESSION['rid']);
        $stmt->execute();
        $bookingResult = $stmt->get_result();
        
        $hasBookings = false;
        while ($bookingData = $bookingResult->fetch_assoc()) {
            $hasBookings = true;
            $statusText = '';
            $statusClass = '';
            switch ($bookingData['booking_status']) {
                case 1: $statusText = 'Payment Pending'; $statusClass = 'badge-warning'; break;
                case 2: $statusText = 'Payment Completed'; $statusClass = 'badge-info'; break;
                case 3: $statusText = 'Packed'; $statusClass = 'badge-primary'; break;
                case 4: $statusText = 'Shipped'; $statusClass = 'badge-secondary'; break;
                case 5: $statusText = 'Out for Delivery'; $statusClass = 'badge-success'; break;
                case 6: $statusText = 'Delivered'; $statusClass = 'badge-success'; break;
                default: $statusText = 'Unknown'; $statusClass = 'badge-danger'; break;
            }
        ?>
        <div class="col-12 mb-4">
            <div class="card unique-rest-booking-card shadow-sm border-0 h-100">
                <div class="card-header unique-rest-booking-header d-flex justify-content-between align-items-center bg-success text-white">
                    <div>
                        <h5 class="mb-0 unique-rest-booking-id">Booking ID: #<?php echo $bookingData['booking_id']; ?></h5>
                        <small class="unique-rest-booking-date">Date: <?php echo date('M d, Y', strtotime($bookingData['booking_date'])); ?></small>
                        <br><small class="unique-rest-booking-amount">Amount: ₹<?php echo number_format($bookingData['booking_amount'], 2); ?></small>
                    </div>
                    <span class="badge <?php echo $statusClass; ?> unique-rest-status-badge"><?php echo $statusText; ?></span>
                </div>
                <div class="card-body unique-rest-booking-body">
                    <div class="row">
                        <?php
                        $selCartItems = "SELECT c.*, f.*, b.*, u.user_name, u.user_email FROM tbl_cart c 
                                        INNER JOIN tbl_food f ON f.food_id = c.food_id 
                                        INNER JOIN tbl_booking b ON b.booking_id = c.booking_id
                                        INNER JOIN tbl_user u ON u.user_id = b.user_id 
                                        WHERE c.booking_id = ? AND f.restaurant_id = ?";
                        $itemStmt = $con->prepare($selCartItems);
                        $itemStmt->bind_param("ii", $bookingData['booking_id'], $_SESSION['rid']);
                        $itemStmt->execute();
                        $cartResult = $itemStmt->get_result();
                        $i = 0;
                        $grandTotal = 0;
                        while ($cartData = $cartResult->fetch_assoc()) {
                            $i++;
                            $itemTotal = round($cartData['food_price'] * $cartData['cart_qty'], 2);
                            $grandTotal += $itemTotal;
                            $userInfo = htmlspecialchars($cartData['user_name']) . "<br><small>" . htmlspecialchars($cartData['user_email']) . "</small>";
                        ?>
                        <div class="col-lg-6 col-md-12 mb-3">
                            <div class="unique-rest-item-card card border-0 bg-light">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <img src="../Assets/Files/Food/<?php echo htmlspecialchars($cartData['food_photo']); ?>" alt="<?php echo htmlspecialchars($cartData['food_name']); ?>" class="img-fluid rounded unique-rest-item-img" style="height: 80px; object-fit: cover;" />
                                        </div>
                                        <div class="col-9">
                                            <h6 class="unique-rest-item-name mb-1"><?php echo htmlspecialchars($cartData['food_name']); ?></h6>
                                            <p class="unique-rest-item-price mb-1 small text-success fw-bold">₹<?php echo number_format($cartData['food_price'], 2); ?></p>
                                            <p class="unique-rest-item-qty mb-2 small text-muted">Qty: <?php echo $cartData['cart_qty']; ?> | Total: ₹<?php echo number_format($itemTotal, 2); ?></p>
                                            <div class="unique-rest-user-info small text-muted mb-2"><?php echo $userInfo; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        $itemStmt->close();
                        ?>
                    </div>
                    <hr class="unique-rest-divider my-3">
                    <div class="text-end unique-rest-total-section">
                        <h4 class="text-success mb-0">Grand Total: ₹<?php echo number_format($bookingData['booking_amount'], 2); ?></h4>
                    </div>
                    <div class="unique-rest-status-section mt-3">
                        <div class="row">
                            <div class="col-md-8">
                                <strong class="unique-rest-order-status">Order Status:</strong>
                                <?php
                                $status = $bookingData['booking_status'];
                                if ($status == 2) {
                                    echo "Payment Completed - Ready for Packing";
                                    ?>
                                    <a href="ViewBooking.php?updateStatus=<?php echo $bookingData['booking_id']; ?>&status=3" class="btn btn-primary unique-rest-pack-btn ms-2" onclick="return confirm('Mark as Packed? Delivery boy will collect.');">
                                        <i class="fas fa-box"></i> Mark as Packed
                                    </a>
                                    <?php
                                } elseif ($status == 3) {
                                    echo "Packed - Waiting for Delivery Boy Collection";
                                } elseif ($status == 4) {
                                    echo "Shipped";
                                } elseif ($status == 5) {
                                    echo "Out for Delivery";
                                } elseif ($status == 6) {
                                    echo "Delivered";
                                } else {
                                    echo "Pending";
                                }
                                ?>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="Invoice.php?bid=<?php echo $bookingData['booking_id']; ?>" class="btn btn-outline-secondary btn-sm unique-rest-invoice-btn">
                                    <i class="fas fa-file-invoice"></i> View Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        $stmt->close();
        
        if (!$hasBookings) {
        ?>
        <div class="col-12 text-center">
            <div class="unique-rest-no-bookings-wrapper">
                <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No Bookings Found</h4>
                <p class="text-muted">Bookings will appear here once customers place orders.</p>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<style>
.unique-rest-bookings-container {
    background: linear-gradient(rgba(255,255,255,0.95), rgba(255,255,255,0.95));
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}
.unique-rest-bookings-header {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
.unique-rest-bookings-title {
    margin: 0;
    font-size: 2.5em;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.unique-rest-bookings-subtitle {
    margin: 10px 0 0 0;
    font-size: 1.2em;
    opacity: 0.9;
}
.unique-rest-bookings-grid {
    margin-top: 20px;
}
.unique-rest-booking-card {
    border-radius: 15px;
    transition: all 0.3s ease;
    overflow: hidden;
}
.unique-rest-booking-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
.unique-rest-booking-header {
    padding: 20px;
    border-radius: 15px 15px 0 0;
}
.unique-rest-booking-id {
    font-size: 1.3em;
    font-weight: bold;
}
.unique-rest-booking-date, .unique-rest-booking-amount {
    opacity: 0.9;
}
.unique-rest-status-badge {
    font-size: 0.9em;
    padding: 8px 15px;
}
.unique-rest-booking-body {
    padding: 25px;
}
.unique-rest-item-card {
    border-radius: 10px;
    transition: all 0.3s ease;
}
.unique-rest-item-card:hover {
    background: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.unique-rest-item-img {
    border: 2px solid #f8f9fa;
}
.unique-rest-item-name {
    color: #333;
    font-weight: bold;
}
.unique-rest-user-info {
    line-height: 1.4;
}
.unique-rest-divider {
    border-color: #dee2e6;
    opacity: 0.5;
}
.unique-rest-total-section {
    padding: 15px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 10px;
}
.unique-rest-status-section {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
}
.unique-rest-order-status {
    color: #28a745;
    font-size: 1.1em;
}
.unique-rest-pack-btn {
    border-radius: 20px;
    font-weight: bold;
    transition: all 0.3s ease;
}
.unique-rest-pack-btn:hover {
    background-color: #218838;
    transform: translateY(-1px);
}
.unique-rest-invoice-btn {
    border-radius: 20px;
    font-size: 0.85em;
    transition: all 0.3s ease;
}
.unique-rest-invoice-btn:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
}
.unique-rest-no-bookings-wrapper {
    padding: 60px 20px;
    background: #f8f9fa;
    border-radius: 15px;
    margin-top: 40px;
}
@media (max-width: 768px) {
    .unique-rest-bookings-container {
        padding: 20px;
    }
    .unique-rest-bookings-title {
        font-size: 2em;
    }
    .unique-rest-booking-header {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    .unique-rest-status-section .row {
        text-align: center;
    }
    .unique-rest-pack-btn {
        margin-top: 10px;
    }
}
</style>
<?php include("Foot.php"); ?>