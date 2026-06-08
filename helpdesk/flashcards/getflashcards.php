<?php
header("Content-Type: application/json");

$conn = mysqli_connect("localhost", "root", "", "helpdesk");
if (!$conn) {
    echo json_encode([]);
    exit;
}

$subject_id = intval($_GET['subject_id'] ?? 0);

$sql = "SELECT question, answer, options FROM flashcards WHERE subject_id=$subject_id";
$result = mysqli_query($conn, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        "question" => $row["question"],
        "answer" => $row["answer"],
        "options" => json_decode($row["options"])
    ];
}

echo json_encode($data);
?>