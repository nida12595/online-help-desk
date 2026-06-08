<?php
$conn = new mysqli("localhost", "root", "", "helpdesk");

if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
} else {
  echo " " ;
}

?>
