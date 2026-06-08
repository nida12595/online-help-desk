<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$conn = new mysqli("localhost", "root", "", "helpdesk");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email       = isset($_POST['email']) ? trim($_POST['email']) : '';
$issue_type  = isset($_POST['issue_type']) ? trim($_POST['issue_type']) : '';
$description = isset($_POST['description_text']) ? trim($_POST['description_text']) : '';

if (empty($email) || empty($issue_type) || empty($description)) {
    echo "⚠ All fields are required!";
    exit;
}

$complaint_id = "CID" . rand(100, 999) . substr(md5(uniqid()), 0, 3);

$stmt1 = $conn->prepare("INSERT INTO complaint (ID, Email, `Issue Type`) VALUES (?, ?, ?)");
$stmt1->bind_param("sss", $complaint_id, $email, $issue_type);

if ($stmt1->execute()) {

    $stmt2 = $conn->prepare("INSERT INTO description (ID, `Issue Type`, `Describe the Issue`) VALUES (?, ?, ?)");
    $stmt2->bind_param("sss", $complaint_id, $issue_type, $description);

    if ($stmt2->execute()) {

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'thehelpdeskportal@gmail.com';
            $mail->Password   = 'fottqdwrljupszbn';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('thehelpdeskportal@gmail.com', 'HelpDesk Team');

            $mail->addAddress($email);

            $mail->isHTML(false);
            $mail->Subject = 'Complaint Received - Helpdesk';
            $mail->Body = "Hello,

Your complaint (ID: $complaint_id) has been received successfully. Our team will resolve it soon.

Thank you,
Helpdesk Team";

            $mail->send();

            $mail->clearAddresses();

            $mail->addAddress('thehelpdeskportal@gmail.com');
            $mail->Subject = 'New Complaint Received';
            $mail->Body = "A new complaint has been submitted.

Complaint ID: $complaint_id
User Email: $email
Issue Type: $issue_type
Description: $description";

            $mail->send();

        } catch (Exception $e) {
            echo "<p>Email error: {$mail->ErrorInfo}</p>";
        }

        echo "
        <!DOCTYPE html>
        <html>
        <head>
        <style>
        body{
        font-family:Arial,sans-serif;
        background:#f4f4f8;
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
        }

        .box{
        background:#fff;
        padding:40px;
        border-radius:12px;
        box-shadow:0 4px 12px rgba(0,0,0,0.1);
        text-align:center;
        }

        h2{
        color:#333;
        }

        .btn{
        margin-top:20px;
        display:inline-block;
        padding:10px 18px;
        background:linear-gradient(to right,#b674ec,#ca74ec);
        color:white;
        text-decoration:none;
        border-radius:6px;
        }

        .btn:hover{
        background:linear-gradient(to right,#ab56cc,#b674ec);
        }
        </style>
        </head>

        <body>

        <div class='box'>
        <h2>Complaint Submitted Successfully</h2>
        <p>Your Complaint ID: <b>$complaint_id</b></p>
        <a class='btn' href='complaint.html'>Go Back</a>
        </div>

        </body>
        </html>
        ";

    } else {
        echo "Error inserting into description: " . $stmt2->error;
    }

    $stmt2->close();

} else {
    echo "Error inserting into complaint: " . $stmt1->error;
}

$stmt1->close();
$conn->close();
?>