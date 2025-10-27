<?php
include("../Assets/connection/Connection.php");
session_start();
include("Head.php");



$rid = $_SESSION['rid'];

// Handle form submission
if (isset($_POST['submit_timing'])) {
    $days_id = $_POST['days_id'];
    $opening_time = $_POST['opening_time'];
    $closing_time = $_POST['closing_time'];
    
    // Delete existing for this day
    $delQry = "DELETE FROM tbl_restauranttiming WHERE restaurant_id = $rid AND days_id = $days_id";
    $con->query($delQry);
    
    // Insert new
    $insQry = "INSERT INTO tbl_restauranttiming (restaurant_id, days_id, opening_time, closing_time) 
               VALUES ($rid, $days_id, '$opening_time', '$closing_time')";
    $con->query($insQry);
    
    echo "<div class='alert alert-success'>Timing updated successfully!</div>";
}

// Fetch existing timings
$selQry = "SELECT rt.*, d.days_name FROM tbl_restauranttiming rt 
           INNER JOIN tbl_days d ON rt.days_id = d.days_id 
           WHERE rt.restaurant_id = $rid ORDER BY rt.days_id";
$res = $con->query($selQry);

// Fetch days for dropdown
$daysQry = "SELECT * FROM tbl_days ORDER BY days_id";
$daysRes = $con->query($daysQry);
?>
<div class="container my-5 unique-timing-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="unique-timing-header text-center mb-5">
                <h2 class="unique-timing-title">Set Your Restaurant Timings</h2>
                <p class="unique-timing-subtitle">Configure opening and closing hours for each day</p>
            </div>
            
            <!-- Form to add/update timing -->
            <form method="post" class="unique-timing-form mb-5">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Select Day</label>
                        <select name="days_id" class="form-control" required>
                            <option value="">Choose Day</option>
                            <?php while($day = $daysRes->fetch_assoc()): ?>
                            <option value="<?php echo $day['days_id']; ?>"><?php echo $day['days_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Opening Time</label>
                        <input type="time" class="form-control unique-time-input" name="opening_time" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Closing Time</label>
                        <input type="time" class="form-control unique-time-input" name="closing_time" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" name="submit_timing" class="btn btn-success btn-lg unique-save-btn">
                            <i class="fas fa-save"></i> Save Timing
                        </button>
                    </div>
                </div>
            </form>
            
            <!-- Existing Timings List -->
            <div class="card unique-timings-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-clock"></i> Current Timings</h5>
                </div>
                <div class="card-body">
                    <?php if ($res->num_rows > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>Opening Time</th>
                                        <th>Closing Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $res->data_seek(0); // Reset result pointer
                                    while($timing = $res->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $timing['days_name']; ?></td>
                                        <td><?php echo $timing['opening_time']; ?></td>
                                        <td><?php echo $timing['closing_time']; ?></td>
                                        <td>
                                            <button class="btn btn-outline-primary btn-sm" onclick="editTiming(<?php echo $timing['days_id']; ?>, '<?php echo $timing['opening_time']; ?>', '<?php echo $timing['closing_time']; ?>')">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted">No timings set yet. Add timings using the form above.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function editTiming(days_id, opening, closing) {
    document.querySelector('select[name="days_id"]').value = days_id;
    document.querySelector('input[name="opening_time"]').value = opening;
    document.querySelector('input[name="closing_time"]').value = closing;
}
</script>

<style>
.unique-timing-container {
    background: linear-gradient(rgba(255,255,255,0.95), rgba(255,255,255,0.95)), url('https://images.unsplash.com/photo-1552566626-52f8b828add9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;
    min-height: 100vh;
    padding: 40px 0;
}
.unique-timing-header {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
.unique-timing-title {
    margin: 0;
    font-size: 2.5em;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.unique-timing-subtitle {
    margin: 10px 0 0 0;
    font-size: 1.2em;
    opacity: 0.9;
}
.unique-timing-form {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}
.unique-time-input {
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: border-color 0.3s ease;
}
.unique-time-input:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}
.unique-save-btn {
    border-radius: 50px;
    padding: 12px 40px;
    font-size: 1.2em;
    font-weight: bold;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
}
.unique-save-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(40, 167, 69, 0.4);
    background-color: #218838;
}
.unique-timings-card {
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}
@media (max-width: 768px) {
    .unique-timing-title {
        font-size: 2em;
    }
    .unique-timing-form {
        padding: 20px;
    }
}
</style>
<?php include("Foot.php"); ?>