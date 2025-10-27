<?php
include("../Assets/connection/Connection.php");
include("Head.php");

$rid = $_GET['rid'];
$restQry = "SELECT * FROM tbl_restaurant r 
            INNER JOIN tbl_place p ON r.place_id = p.place_id 
            INNER JOIN tbl_district d ON p.district_id = d.district_id 
            WHERE r.restaurant_id = '$rid'";
$restRes = $con->query($restQry);
$data = $restRes->fetch_assoc();
?>

<div class="container my-5">
    <h2 class="text-center mb-4"><?php echo $data['restaurant_name']; ?></h2>

    <div class="row">
        <div class="col-md-4 text-center">
            <img src="../Assets/Files/Rest/Photo/<?php echo $data['restaurant_photo']; ?>" 
                 class="img-fluid rounded mb-3" style="height:250px; object-fit:cover;">
        </div>

        <div class="col-md-8">
            <ul class="list-unstyled">
                <li><strong>Address:</strong> <?php echo $data['restaurant_address']; ?></li>
                <li><strong>Contact:</strong> <?php echo $data['restaurant_contact']; ?></li>
                <li><strong>Email:</strong> <?php echo $data['restaurant_email']; ?></li>
                <li><strong>Type:</strong> <?php echo $data['restaurant_type']; ?></li>
                <li><strong>Place:</strong> <?php echo $data['place_name']; ?></li>
                <li><strong>District:</strong> <?php echo $data['district_name']; ?></li>
            </ul>

            <h4 class="mt-4">Opening Hours</h4>
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Day</th>
                        <th>Opening Time</th>
                        <th>Closing Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $timeQry = "SELECT d.days_name, t.opening_time, t.closing_time 
                                FROM tbl_restauranttiming t 
                                INNER JOIN tbl_days d ON d.days_id = t.days_id 
                                WHERE t.restaurant_id = '$rid'";
                    $timeRes = $con->query($timeQry);

                    if ($timeRes->num_rows > 0) {
                        while ($timeData = $timeRes->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $timeData['days_name']; ?></td>
                                <td><?php echo $timeData['opening_time']; ?></td>
                                <td><?php echo $timeData['closing_time']; ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="3">No timing information available</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("Foot.php"); ?>
