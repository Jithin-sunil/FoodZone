<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");
?>

<div class="container my-5">
  <div class="text-center mb-4">
    <h1 class="unique-cards-title">Food Menu</h1>
    <p class="unique-cards-subtitle">Browse available food items</p>
  </div>

  <form class="text-center mb-4">
    <div class="row justify-content-center">
      <input type="hidden" name="txt_rid" id="txt_rid" value="<?php echo isset($_GET['rid']) ? intval($_GET['rid']) : ''; ?>" />

      <div class="col-md-4 mb-2">
        <input type="text" id="txt_search" class="form-control" placeholder="Search by food name" onkeyup="ajaxSearch()">
      </div>

       <div class="col-md-3 mb-2">
        <select id="sel_type" class="form-control" onchange="ajaxSearch(), getCategory(this.value)">
          <option value="">All Types</option>
          <?php
          $typeQry = "SELECT * FROM tbl_foodtype";
          $typeRes = $con->query($typeQry);
          while ($typeData = $typeRes->fetch_assoc()) {
            echo "<option value='" . $typeData['foodtype_id'] . "'>" . htmlspecialchars($typeData['foodtype_name'], ENT_QUOTES) . "</option>";
          }
          ?>
        </select>
      </div>

      <div class="col-md-3 mb-2">
        <select id="sel_category" class="form-control" onchange="ajaxSearch()">
          <option value="">All Categories</option>
        
        </select>
      </div>

     
    </div>
  </form>

  <div id="product_list">
    <!-- AJAX-loaded food cards will appear here -->
  </div>
</div>

<!-- jQuery -->
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function AddtoCart(pid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxAddCart.php?pid=" + pid,
      success: function(result) {
        alert(result);
      }
    });
  }

  function getCategory(typeId) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxCategory.php",
      data: { typeId: typeId },
      success: function(response) {
        $("#sel_category").html(response);
      }
    });
  }

  function ajaxSearch() {
    var search = $("#txt_search").val();
    var category = $("#sel_category").val();
    var type = $("#sel_type").val();
    var rid = $("#txt_rid").val();

    $.ajax({
      url: "../Assets/AjaxPages/AjaxFood.php",
      data: {
        search: search,
        category: category,
        type: type,
        rid: rid
      },
      success: function(response) {
        $("#product_list").html(response);
      }
    });
  }

  $(document).ready(function() {
    ajaxSearch();
  });
</script>

<?php include("Foot.php"); ?>