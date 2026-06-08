<?php
$conn = mysqli_connect("localhost", "root", "", "helpdesk");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
if (!isset($_GET['subject_id'])) {
    header("Location: study.php"); // redirect to main page if no subject
    exit;
}

$sid = intval($_GET['subject_id']);


$subjectRes = mysqli_query($conn, "SELECT name FROM subjects WHERE subject_id={$sid}");
if (!$subjectRes || mysqli_num_rows($subjectRes) == 0) {
    die("Subject not found.");
}
$subject = mysqli_fetch_assoc($subjectRes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Materials - <?php echo htmlspecialchars($subject['name']); ?></title>
<style>
  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color: #E6E6FA; 
    font-family: Arial, sans-serif;
  }

  .container {
    min-height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 40px 20px;
    box-sizing: border-box;
  }

  .material-box {
    background: #F3E6FF; 
    padding: 30px;
    border-radius: 15px;
    width: 100%;
    max-width: 800px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }

  h1 {
    color: #4B0082;
    text-align: center;
    margin-bottom: 20px;
  }

  .material-box h2 {
    color: #4B0082;
    margin-top: 20px;
    margin-bottom: 10px;
  }

  ul {
    list-style: none;
    padding-left: 0;
  }

  li {
    margin: 8px 0;
  }

  a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
  }

  a:hover {
    color: #9370DB;
    text-decoration: underline;
  }

  .back-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 8px 12px;
    background-color: #9370DB;
    color: white;
    text-decoration: none;
    border-radius: 6px;
  }

  .no-materials {
    font-style: italic;
    color: #555;
    margin-top: 10px;
  }
</style>
</head>
<body>
<div class="container">
    <h1>Materials for <?php echo htmlspecialchars($subject['name']); ?></h1>
    <div class="material-box">
        <?php
        // Fetch PDFs for this subject
        $pdfRes = mysqli_query($conn, "SELECT pdf_name FROM pdfs WHERE subject_id={$sid}");
       

        if ($pdfRes && mysqli_num_rows($pdfRes) > 0) {
            echo '<h2>PDFs</h2><ul>';
            while ($pdf = mysqli_fetch_assoc($pdfRes)) {
              $file = trim($pdf['pdf_name']);   
                $file = htmlspecialchars($file);
                
                echo "<li><a href='uploads/{$file}' target='_blank'>{$file}</a></li>";
            }
            echo '</ul>';
        } else {
            echo '<p class="no-materials">No PDFs available.</p>';
        }

        // Fetch Links for this subject
        $linkRes = mysqli_query($conn, "SELECT link_name, link_url FROM links WHERE subject_id={$sid}");
        
        if ($linkRes && mysqli_num_rows($linkRes) > 0) {
            echo '<h2>Links</h2><ul>';
            while ($link = mysqli_fetch_assoc($linkRes)) {
                $name = htmlspecialchars($link['link_name']);
                $url = htmlspecialchars($link['link_url']);
                echo "<li><a href='{$url}' target='_blank'>{$name}</a></li>";
            }
            echo '</ul>';
        } else {
            echo '<p class="no-materials">No links available.</p>';
        }
        ?>
    </div>
    <a href="study.php" class="back-btn">← Back to Subjects</a>
</div>
<script>
function logAction(action, page = 'materials') {
  fetch('log_activity.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
    body: 'action=' + encodeURIComponent(action) + '&page=' + encodeURIComponent(page)
  })
  .then(r => r.text())
  .then(txt => {
    // optional: console.log('logger:', txt);
  })
  .catch(e => console.error('log error', e));
}

// example: log page open
logAction('Opened Materials Page', 'materials');

// example: attach to links (run after DOM ready)
document.querySelectorAll("a[target='_blank']").forEach(a => {
  a.addEventListener('click', function(){
    const label = this.textContent.trim() || this.href;
    logAction('Opened: ' + label, 'materials');
  });
});
</script>


</body>
</html>