<?php
session_start();
include "db.php";

/* Fetch user data */
$profile_image = "default.png";
$username = "";
$email = "";

if(isset($_SESSION['user_id'])){
    $user_id = (int) $_SESSION['user_id'];
    $result = mysqli_query($conn, "SELECT username,email,profile_image FROM users WHERE id = $user_id");

    if($result && mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);

        $username = $user['username'];
        $email = $user['email'];

        if(!empty($user['profile_image'])){
            $profile_image = $user['profile_image'];
        }
    }
}

$imgPath = "uploadsimg/" . $profile_image;

if(!file_exists($imgPath) || empty($profile_image)){
    $imgPath = "uploadsimg/default.png";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Help Desk</title>
  <link rel="stylesheet" href="style.css">
  <!-- Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
</head>

<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo">
      <i class="fa-solid fa-headset"></i>
      <span class="logo-text">Help Desk</span>
    </div>
    <ul>
      <li>
        <a href="study.php" class="sidebar-link">
          <i class="fa-solid fa-book"></i>
          <span>Study</span>
        </a>
      </li>
      <li>
        <a href="../COMPLAINT/complaint.html" class="sidebar-link">
          <i class="fa-solid fa-file-circle-exclamation"></i>
          <span>Complaint</span>
        </a>
      </li>
      <li>
        <a href="contact.php" class="sidebar-link">
          <i class="fa-solid fa-envelope"></i>
          <span>Contact</span>
        </a>
      </li>
      <li>
        <a href="faqs.php" class="sidebar-link">
          <i class="fa-solid fa-comments"></i>
          <span>FAQs</span>
        </a>
      </li>
      <li>
        <a href="feedback.php" class="sidebar-link">
          <i class="fa-solid fa-star"></i>
          <span>Feedback</span>
        </a>
      </li>
    </ul>

    <!-- Logout -->
    <div class="logout">
      <a href="logout_user.php" class="sidebar-link">
      <i class="fa-solid fa-right-from-bracket"></i>
      <span>Logout</span>
      </a>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="main">
    <!-- Top Bar -->
    <header>
      <h1>HELP DESK</h1>


    <div class="profile-wrapper">

    <!-- Profile Image -->
    <img src="<?php echo $imgPath; ?>" 
     class="profile-pic"
     onclick="openProfile()">
</div>
    </header>

    <!-- Cards -->
    <section class="cards">
      <div class="card red">
        <h3>Study Material</h3>
        <p>Access notes & resources</p>
      </div>
      <div class="card blue">
        <h3>Complaints</h3>
        <p>Submit your issues</p>
      </div>
      <div class="card green">
        <h3>Contact</h3>
        <p>Reach out for support</p>
      </div>
      <div class="card purple">
        <h3>FAQs</h3>
        <p>Instant help when you need it</p>
      </div>
    </section>

<section class="table-section">
  <h2>Recent Activity</h2>
  <table>
    <thead>
      <tr>
        <th>Time</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        

        if (!isset($_SESSION['user_id'])) {
            echo "<tr><td colspan='2'>No recent activity</td></tr>";
        } else {
          $user_id = (int) $_SESSION['user_id'];

        $res = mysqli_query(
            $conn,
            "SELECT * FROM activity WHERE user_id = $user_id ORDER BY timestamp DESC LIMIT 10"
       );

      if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>
                    <td>{$row['timestamp']}</td>
                    <td>{$row['action']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No recent activity</td></tr>";
    }
}
?>

    </tbody>
  </table>

  <a href="activity.php" style="text-decoration:none;background:#9370DB;color:white;padding:8px 14px;border-radius:6px;">
    📊 View Activity Tracker
  </a>
</section>
</div>


<script>
function openProfile() {
    document.getElementById("profileCardOverlay").classList.add("active");
}

function closeProfile() {
    document.getElementById("profileCardOverlay").classList.remove("active");
}

document.addEventListener("click", function(e){
    const overlay = document.getElementById("profileCardOverlay");

    if(e.target === overlay){
        closeProfile();
    }
});
</script>


<!-- PROFILE CARD POPUP -->
<div id="profileCardOverlay" class="profile-card-overlay">

  <div class="profile-card">

      <img src="<?php echo $imgPath; ?>" class="card-pic">

      
      <h3><?php echo $username; ?></h3>
      <p class="profile-email"><?php echo $email; ?></p>

      

      <form action="profile_upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" id="pfpInput" name="profile_image" hidden onchange="this.form.submit()">
    
    <!-- Hidden field to trigger $_POST['upload'] -->
    <input type="hidden" name="upload" value="1">
    
    <button type="button" onclick="document.getElementById('pfpInput').click()">
        <i class="fa-solid fa-camera"></i> Change Photo
    </button>
</form>
    </div>
</div>
</body>
</html>