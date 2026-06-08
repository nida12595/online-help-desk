<?php
$conn = mysqli_connect("localhost", "root", "", "helpdesk");
if (!$conn) {
    die("DB connect failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Study Page</title>
<link rel="stylesheet" href="style.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #E6E6FA; /* Lavender background */
    color: #333;
  }

  .main {
    padding: 10px;
  }

  header h1 {
    margin-bottom: 20px;
    color: #4B0082; /* Dark purple for contrast */
    text-align: center;
  }

  .search-container {
      text-align: center;
      margin: 20px;
    }

    .search-container input {
      padding: 10px;
      width: 60%;
      max-width: 400px;
      border-radius: 20px;
      border: 1px solid #b674ec; /* purple border */
      font-size: 16px;
    }

  .cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
  }

  .card {
    background: #D8BFD8; /* Thistle/lavender card color */
    border-radius: 12px;
    width: 220px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
  }

  .card h3 {
    margin: 10px 0;
    color: #4B0082;
  }

  .card a {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #9370DB; /* Medium purple button */
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
    margin-right: 5px;
  }

  .card a:last-child { margin-right: 0; }

  .material-box {
    margin-top: 30px;
    background: #F3E6FF; /* Light lavender */
    padding: 10px;
    border-radius: 10px;
  }

  .material-box h2 {
    margin-bottom: 10px;
    color: #4B0082;
  }

  .material-box a {
    text-decoration: none;
    color: #333;
  }

  .material-box a:hover {
    text-decoration: underline;
    color: #9370DB;
  }
  <style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #E6E6FA;
    color: #333;
  }

  /* your existing CSS here */

  .material-box a:hover {
    text-decoration: underline;
    color: #9370DB;
  }

  /* 🔥 ADD BACK BUTTON CSS HERE */
  .back-container {
      margin: 10px 0 20px 20px;
  }

  .back-btn {
      background-color: #9370DB;
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 20px;
      font-size: 14px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
  }

  .back-btn:hover {
      background-color: #7B68EE;
      transform: translateY(-2px);
  }

</style>
</style>
</head>
<body>
  


  <div class="main">
    <header><h1>Study Materials & Tests</h1></header>
    <div class="back-container">
    <button onclick="goBack()" class="back-btn">
        <i class="fa fa-arrow-left"></i> Back
    </button>
</div>

    <div class="cards">
    <?php
    $sql = "SELECT * FROM subjects ORDER BY subject_id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = (int)$row['subject_id'];
            $name = htmlspecialchars($row['name']);
            echo '<div class="card">';
            echo "<h3>{$name}</h3>";
            echo "<a href='materials.php?subject_id={$id}'>View Materials</a>";

            echo "<a href='flashcards/index.html?subject_id={$id}'>Take Test</a>";

            echo '</div>';
        }
    } else {
        echo '<p>No subjects found.</p>';
    }
    ?>
    </div>

  </div>
  <script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>