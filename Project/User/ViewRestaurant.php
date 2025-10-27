<?php
include("../Assets/connection/Connection.php");
include("Head.php");
?>

<div class="container my-5">
    <div class="custom-rest-cards-header text-center mb-4">
        <h1 class="unique-cards-title">Restaurant Management Dashboard</h1>
        <p class="unique-cards-subtitle">Explore all registered restaurants in card view</p>
    </div>

    <!-- Filter Form -->
    <form method="post" class="text-center mb-4">
        <div class="row justify-content-center">
            <!-- District Dropdown -->
            <div class="col-md-3 mb-2">
                <select name="district" id="district" class="form-control" onchange="getPlace(this.value)">
                    <option value="">Select District</option>
                    <?php
                    $distQry = "SELECT * FROM tbl_district";
                    $distRes = $con->query($distQry);
                    while ($distData = $distRes->fetch_assoc()) {
                        $sel = (isset($_POST['district']) && $_POST['district'] == $distData['district_id']) ? "selected" : "";
                        echo "<option value='".$distData['district_id']."' $sel>".$distData['district_name']."</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Place Dropdown (AJAX updated) -->
            <div class="col-md-3 mb-2">
                <select name="place" id="select_place" class="form-control">
                    <option value="">Select Place</option>
                    <?php
                    if (!empty($_POST['district'])) {
                        $placeQry = "SELECT * FROM tbl_place WHERE district_id='".$_POST['district']."'";
                        $placeRes = $con->query($placeQry);
                        while ($placeData = $placeRes->fetch_assoc()) {
                            $sel = (isset($_POST['place']) && $_POST['place'] == $placeData['place_id']) ? "selected" : "";
                            echo "<option value='".$placeData['place_id']."' $sel>".$placeData['place_name']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Type Dropdown -->
            <div class="col-md-3 mb-2">
                <select name="type" id="type" class="form-control">
                    <option value="">Select Type</option>
                    <?php
                    $typeQry = "SELECT * FROM tbl_restauranttype";
                    $typeRes = $con->query($typeQry);
                    while ($typeData = $typeRes->fetch_assoc()) {
                        $sel = (isset($_POST['type']) && $_POST['type'] == $typeData['restauranttype_name']) ? "selected" : "";
                        echo "<option value='".$typeData['restauranttype_name']."' $sel>".$typeData['restauranttype_name']."</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Search Button -->
            <div class="col-md-2 mb-2">
                <input type="submit" name="btnSearch" class="btn btn-primary w-100" value="Search">
            </div>
        </div>
    </form>

    <!-- Restaurant Cards -->
    <div class="row unique-rest-cards-grid">
        <?php
        $selqry = "SELECT * FROM tbl_restaurant r 
                   INNER JOIN tbl_place p ON r.place_id = p.place_id 
                   INNER JOIN tbl_district d ON p.district_id = d.district_id 
                   WHERE 1=1";

        if (!empty($_POST['district'])) {
            $selqry .= " AND d.district_id = '".$_POST['district']."'";
        }
        if (!empty($_POST['place'])) {
            $selqry .= " AND p.place_id = '".$_POST['place']."'";
        }
        if (!empty($_POST['type'])) {
            $selqry .= " AND r.restaurant_type = '".$_POST['type']."'";
        }

        $row = $con->query($selqry);
        if ($row->num_rows > 0) {
            while ($data = $row->fetch_assoc()) {
                $avgQry = "SELECT AVG(rating_data) as avg_rate, COUNT(rating_id) as count_rate FROM tbl_rating WHERE restaurant_id = '".$data['restaurant_id']."'";
                $avgRes = $con->query($avgQry);
                $avgData = $avgRes->fetch_assoc();
                $average_rating = $avgData['avg_rate'] ?? 0;
                $total_review = $avgData['count_rate'] ?? 0;
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card h-100 unique-rest-card shadow-sm border-0" style="cursor:pointer;"
                 onclick="window.location.href='ViewMoreR.php?rid=<?php echo $data['restaurant_id']; ?>'">
                <div class="card-header unique-card-header bg-primary text-white text-center">
                    <h5 class="card-title mb-0 unique-card-rest-name"><?php echo $data['restaurant_name']; ?></h5>
                </div>
                <div class="card-body unique-card-body text-center">
                    <img src="../Assets/Files/Rest/Photo/<?php echo $data['restaurant_photo']; ?>" 
                         class="img-fluid rounded unique-card-photo mb-3" 
                         style="height:150px; object-fit:cover;" />

                    <p style="color:#F96; font-size:20px;">
                        <?php
                        $full_stars = floor($average_rating);
                        $decimal_part = $average_rating - $full_stars;
                        for ($s = 1; $s <= 5; $s++) {
                            if ($s <= $full_stars) echo '<i class="fas fa-star" style="color:#FC3"></i>';
                            else if ($s == ($full_stars + 1) && $decimal_part >= 0.25) echo '<i class="fas fa-star-half-alt" style="color:#FC3"></i>';
                            else echo '<i class="far fa-star" style="color:#999"></i>';
                        }
                        ?>
                    </p>
                    <small><?php echo number_format($average_rating, 1)." (".$total_review." reviews)"; ?></small>

                    <ul class="list-unstyled mt-3">
                        <li><strong>Address:</strong> <?php echo $data['restaurant_address']; ?></li>
                        <li><strong>Contact:</strong> <?php echo $data['restaurant_contact']; ?></li>
                        <li><strong>Email:</strong> <?php echo $data['restaurant_email']; ?></li>
                        <li><strong>Type:</strong> <?php echo $data['restaurant_type']; ?></li>
                        <li><strong>Place:</strong> <?php echo $data['place_name']; ?></li>
                        <li><strong>District:</strong> <?php echo $data['district_name']; ?></li>
                    </ul>
                    <!-- Action buttons: View Food (menu) and More details -->
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="ViewFood.php?rid=<?php echo $data['restaurant_id']; ?>" 
                           class="btn btn-success btn-sm" 
                           onclick="event.stopPropagation();" 
                           title="View food menu for <?php echo htmlspecialchars($data['restaurant_name'], ENT_QUOTES); ?>">
                            View Food
                        </a>
                        <a href="ViewMoreR.php?rid=<?php echo $data['restaurant_id']; ?>" 
                           cla
                           ss="btn btn-outline-primary btn-sm" 
                           onclick="event.stopPropagation();" 
                           title="View more details for <?php echo htmlspecialchars($data['restaurant_name'], ENT_QUOTES); ?>">
                            Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<div class='col-12 text-center'><p>No restaurants found.</p></div>";
        }
        ?>
    </div>
</div>

<!-- jQuery -->
<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function getPlace(disId) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxPlace.php?disId=" + disId,
            success: function(html) {
                $("#select_place").html(html);
            }
        });
    }
</script>

<style>
<?php /* Keep your previous CSS here */ ?>
</style>

<?php include("Foot.php"); ?>
