<?php
// Returns a fragment of HTML (cards) to be injected into ViewFood.php
include("../connection/Connection.php");
session_start();

$rid = isset($_GET['rid']) ? mysqli_real_escape_string($con, $_GET['rid']) : '';
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
$category = isset($_GET['category']) ? mysqli_real_escape_string($con, $_GET['category']) : '';
$type = isset($_GET['type']) ? mysqli_real_escape_string($con, $_GET['type']) : '';

$selQry = "SELECT *
       FROM tbl_food f 
       INNER JOIN tbl_foodcategory fc ON fc.foodcategory_id = f.foodcategory_id
       LEFT JOIN tbl_foodtype ft ON ft.foodtype_id = fc.foodtype_id 
       WHERE f.restaurant_id='".$rid."' AND 1=1";

if (!empty($search)) {
  $selQry .= " AND f.food_name LIKE '%" . $search . "%'";
}
if (!empty($category)) {
  $selQry .= " AND fc.foodcategory_id = '" . $category . "'";
}
if (!empty($type)) {
  $selQry .= " AND ft.foodtype_id = '" . $type . "'";
}

$ro = $con->query($selQry);

if ($ro && $ro->num_rows > 0) {
  echo '<div class="row">';
  while ($data = $ro->fetch_assoc()) {
    // ratings
    $average_rating = 0;
    $total_review = 0;
    $query = "SELECT AVG(rating_data) as avg_rate, COUNT(rating_id) as count_rate FROM tbl_rating WHERE food_id = '" . $data["food_id"] . "'";
    $result = $con->query($query)->fetch_assoc();
    if ($result && $result['count_rate'] > 0) {
      $average_rating = $result['avg_rate'];
      $total_review = $result['count_rate'];
    }

    $safeName = htmlspecialchars($data['food_name'], ENT_QUOTES);
    $safeCategory = htmlspecialchars($data['foodcategory_name'], ENT_QUOTES);
    $safeType = htmlspecialchars($data['foodtype_name'], ENT_QUOTES);
    $photoPath = '../Assets/Files/Food/' . $data['food_photo'];

    echo '<div class="col-lg-4 col-md-6 col-sm-12 mb-4">';
    echo '  <div class="card h-100 shadow-sm border-0">';
    echo '    <div class="card-body text-center">';
    echo '      <img src="' . $photoPath . '" class="img-fluid rounded mb-3" style="height:150px; object-fit:cover;" alt="' . $safeName . '">';
    echo '      <h5 class="card-title">' . $safeName . '</h5>';
    echo '      <p class="mb-1"><strong>Price:</strong> ' . number_format($data['food_price'], 2) . ' ₹</p>';
    echo '      <p class="mb-1"><small>' . $safeCategory . ' &middot; ' . $safeType . '</small></p>';

    // stars
    echo '      <p style="color:#F96; font-size:18px; margin:0">';
    $full_stars = floor($average_rating);
    $decimal_part = $average_rating - $full_stars;
    for ($s = 1; $s <= 5; $s++) {
      if ($s <= $full_stars) echo '<i class="fas fa-star" style="color:#FC3"></i>';
      else if ($s == ($full_stars + 1) && $decimal_part >= 0.25) echo '<i class="fas fa-star-half-alt" style="color:#FC3"></i>';
      else echo '<i class="far fa-star" style="color:#999"></i>';
    }
    echo '</p>';
    echo '      <small>' . number_format($average_rating, 1) . ' (' . $total_review . ')</small>';

    echo '      <div class="d-flex justify-content-center gap-2 mt-3">';
    echo '        <a href="ViewMore.php?pid=' . $data['food_id'] . '" class="btn btn-outline-primary btn-sm">Details</a>';
    echo '        <a href="#" onclick="AddtoCart(' . $data['food_id'] . '); return false;" class="btn btn-success btn-sm">Add to Cart</a>';
    echo '      </div>';

    echo '    </div>';
    echo '  </div>';
    echo '</div>';
  }
  echo '</div>';
} else {
  echo "<div class='text-center'><h4>No foods found.</h4></div>";
}

?>