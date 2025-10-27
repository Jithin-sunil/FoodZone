<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");

if (!isset($_SESSION['did'])) {
    echo "Please login as delivery boy";
    exit();
}

$deliveryboy_id = $_SESSION['did'];

// Get delivery boy's place and district
$delBoyQry = "SELECT db.*, p.place_id, p.place_name, d.district_id, d.district_name FROM tbl_deliveryboy db 
              INNER JOIN tbl_place p ON db.place_id = p.place_id 
              INNER JOIN tbl_district d ON p.district_id = d.district_id 
              WHERE db.deliveryboy_id = '" . $deliveryboy_id . "'";
$delBoyRes = $con->query($delBoyQry);
$delBoyData = $delBoyRes->fetch_assoc();

if (!$delBoyData) {
    echo "Delivery boy data not found";
    exit();
}

$delivery_place_id = $delBoyData['place_id'];
$delivery_district_id = $delBoyData['district_id'];

// Handle status updates
if (isset($_GET['updateStatus'])) {
    $booking_id = $_GET['updateStatus'];
    $new_status = $_GET['status'];
    
    // Validate current status before update
    $currentQry = "SELECT booking_status FROM tbl_booking WHERE booking_id = '" . $booking_id . "'";
    $currentRes = $con->query($currentQry);
    $currentData = $currentRes->fetch_assoc();
    
    if ($currentData) {
        $current_status = $currentData['booking_status'];
        
        if (($current_status == 3 && $new_status == 4) || // Packed to Collected/Shipped
            ($current_status == 4 && $new_status == 5) || // Shipped to Out for Delivery
            ($current_status == 5 && $new_status == 6)) { // Out for Delivery to Delivered
            $upQry = "UPDATE tbl_booking SET booking_status = '" . $new_status . "' WHERE booking_id = '" . $booking_id . "'";
            if ($con->query($upQry)) {
                ?>
                <script>
                    alert("Status updated successfully");
                    window.location = "MyOrders.php";
                </script>
                <?php
            } else {
                echo "<script>alert('Error updating status');</script>";
            }
        } else {
            echo "<script>alert('Invalid status transition');</script>";
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Orders</title>
<style>
body {
    background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    font-family: 'Georgia', serif;
    color: #2F1B14;
    margin: 0;
    padding: 20px;
}
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4); /* Dark overlay for readability */
    pointer-events: none;
    z-index: -1;
}
a {
    color: #CD853F;
    text-decoration: none;
    font-weight: bold;
    padding: 10px 20px;
    background: #FFD700;
    border-radius: 5px;
    display: inline-block;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    position: relative;
    z-index: 1;
}
a:hover {
    background: #FFA500;
}
h3, h4 {
    color: #8B4513;
    text-align: center;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    position: relative;
    z-index: 1;
}
table {
    background: rgba(255, 248, 220, 0.95); /* Semi-transparent cream for restaurant feel */
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    max-width: 1000px;
    margin: 20px auto;
    position: relative;
    z-index: 1;
    border-collapse: separate;
    border-spacing: 0;
    overflow: hidden;
}
td, th {
    padding: 15px;
    border: 1px solid #D2691E;
    background: rgba(255, 255, 255, 0.8);
    text-align: left;
}
th {
    background: #CD853F;
    color: white;
    font-weight: bold;
    text-align: center;
}
tr[style*="background-color: #f2f2f2"] td {
    background: #FFF8DC !important;
    font-weight: bold;
}
img {
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
body[align="center"] {
    text-align: center;
}
</style>
</head>

<body align="center">
<h3>My Orders (Nearby Restaurants - Same Place/District: <?php echo $delBoyData['place_name'] . ', ' . $delBoyData['district_name']; ?>)</h3>
<?php
// Get bookings with status 3,4,5 (Packed to Out for Delivery) from restaurants in same place or district
$selBookings = "SELECT DISTINCT b.* FROM tbl_booking b 
                INNER JOIN tbl_cart c ON c.booking_id = b.booking_id 
                INNER JOIN tbl_food f ON f.food_id = c.food_id 
                INNER JOIN tbl_restaurant r ON f.restaurant_id = r.restaurant_id
                INNER JOIN tbl_place rp ON r.place_id = rp.place_id
                WHERE b.booking_status >= 3
                AND (rp.place_id = '" . $delivery_place_id . "' OR rp.district_id = '" . $delivery_district_id . "')
                ORDER BY b.booking_id DESC";
$bookingResult = $con->query($selBookings);

if ($bookingResult->num_rows > 0) {
    while ($bookingData = $bookingResult->fetch_assoc()) {
?>
    <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
        <tr>
            <td colspan="8">
                <h4>Booking ID: #<?php echo $bookingData['booking_id']; ?> | Date: <?php echo $bookingData['booking_date']; ?> | Amount: ₹<?php echo $bookingData['booking_amount']; ?></h4>
            </td>
        </tr>
        <tr style="background-color: #f2f2f2;">
            <th>SlNo</th>
            <th>Food Name</th>
            <th>Photo</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Item Total</th>
            <th>User Details</th>
            <th>Current Status</th>
        </tr>
        <?php
        $selCartItems = "SELECT c.*, f.food_name, f.food_photo, f.food_price, u.user_name, u.user_email FROM tbl_cart c 
                        INNER JOIN tbl_food f ON f.food_id = c.food_id 
                        INNER JOIN tbl_user u ON u.user_id = '" . $bookingData['user_id'] . "'
                        WHERE c.booking_id = '" . $bookingData['booking_id'] . "' AND f.restaurant_id IN (
                            SELECT restaurant_id FROM tbl_restaurant WHERE place_id = '" . $delivery_place_id . "'
                            OR place_id IN (SELECT place_id FROM tbl_place WHERE district_id = '" . $delivery_district_id . "')
                        )";
        $cartResult = $con->query($selCartItems);
        $i = 0;
        while ($cartData = $cartResult->fetch_assoc()) {
            $i++;
            $itemTotal = $cartData['food_price'] * $cartData['cart_qty'];
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $cartData['food_name']; ?></td>
                <td><img src="../Assets/Files/Food/<?php echo $cartData['food_photo']; ?>" width="60" height="60" /></td>
                <td><b><?php echo $cartData['food_price']; ?> ₹</b></td>
                <td><?php echo $cartData['cart_qty']; ?></td>
                <td><?php echo $itemTotal; ?> ₹</td>
                <td>
                    <?php echo $cartData['user_name'] . "<br>" . $cartData['user_email']; ?>
                </td>
                <td>
                    <?php
                    $currentStatus = $bookingData['booking_status'];
                    $statusText = $currentStatus == 3 ? 'Packed - Ready for Collection' : 
                                  ($currentStatus == 4 ? 'Collected - Shipped' : 
                                  ($currentStatus == 5 ? 'Out for Delivery' : 
                                  ($currentStatus == 6 ? 'Delivered' : 'Unknown')));
                    echo $statusText;
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
        <tr style="background-color: #f2f2f2;">
            <td colspan="7" style="text-align: right;"><strong>Grand Total:</strong></td>
            <td><strong><?php echo $bookingData['booking_amount']; ?> ₹</strong></td>
        </tr>
        <tr>
            <td colspan="8">
                <strong>Order Status:</strong> 
                <?php
                $status = $bookingData['booking_status'];
                if ($status == 3) { // Packed - Delivery boy can collect
                    echo "Packed - Ready for Collection";
                    ?>
                    <a href="MyOrders.php?updateStatus=<?php echo $bookingData['booking_id']; ?>&status=4" onclick="return confirm('Collected and Shipped?');">Collect & Ship</a>
                    <?php
                } elseif ($status == 4) { // Collected - On the way to delivery
                    echo "Collected - Out for Delivery";
                    ?>
                    <a href="MyOrders.php?updateStatus=<?php echo $bookingData['booking_id']; ?>&status=5" onclick="return confirm('Out for Delivery?');">Out for Delivery</a>
                    <?php
                } elseif ($status == 5) {
                    echo "Out for Delivery";
                    ?>
                    <a href="MyOrders.php?updateStatus=<?php echo $bookingData['booking_id']; ?>&status=6" onclick="return confirm('Mark as Delivered?');">Mark Delivered</a>
                    <?php
                } elseif ($status == 6) {
                    echo "Delivered";
                } else {
                    echo "Not Ready for Delivery";
                }
                ?>
            </td>
        </tr>
    </table>
    <br />
<?php
    }
} else {
    echo "<h4>No orders available in your area.</h4>";
}
?>
</body>
</html>
<?php include("Foot.php"); ?>