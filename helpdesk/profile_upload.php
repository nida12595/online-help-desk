<?php
session_start();
include "db.php";

if(isset($_POST['upload'])){

    $user_id = (int) $_SESSION['user_id'];

    $image = $_FILES['profile_image']['name'];
    $tmp = $_FILES['profile_image']['tmp_name'];

    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png'];

    if(in_array($ext, $allowed)){

        $new_name = uniqid() . "." . $ext;

        move_uploaded_file($tmp, "uploadsimg/" . $new_name);

        mysqli_query($conn, "UPDATE users SET profile_image='$new_name' WHERE id=$user_id");

        header("Location: dashboard.php");
        exit();

    } 
    else{
        echo "Invalid file type!";
    }

}
?>