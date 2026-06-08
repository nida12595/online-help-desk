<?php
include "db.php";
session_start();

$user_id = $_SESSION['user_id'] ?? 0;
$result = mysqli_query($conn, "SELECT * FROM activity WHERE user_id=$user_id ORDER BY timestamp DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Activity Tracker</title>
  <style>
    body { font-family: Arial; background: #F3E6FF; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    th { background: #9370DB; color: white; }
  </style>
</head>
<body>
  <h2>Activity Tracker</h2>
  <table>
    <tr><th>Action</th><th>Page</th><th>Timestamp</th></tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['action']}</td>
                <td>{$row['page']}</td>
                <td>{$row['timestamp']}</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='3'>No activity found.</td></tr>";
    }
    ?>
  </table>

  <a href="dashboard.php" style="display:inline-block;margin-top:20px;padding:8px 12px;background:#9370DB;color:white;text-decoration:none;border-radius:6px;">⬅ Back to Dashboard</a>
</body>
</html>  