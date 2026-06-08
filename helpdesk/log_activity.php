<?php
// log_activity.php
include "db.php";
session_start();

header('Content-Type: text/plain; charset=utf-8');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo "Not logged in";
    exit;
}

$user_id = $_SESSION['user_id'];
$action = $_POST['action'] ?? '';   // safe access
$page   = $_POST['page']   ?? '';

if ($action === '') {
    http_response_code(400);
    echo "no action";
    exit;
}

// prepared statement for safety
$stmt = $conn->prepare("INSERT INTO activity (user_id, action, page) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $action, $page);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "logged";
} else {
    http_response_code(500);
    echo "db error";
}

$stmt->close();

