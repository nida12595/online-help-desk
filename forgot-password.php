<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div class="col-md-4 offset-md-4 form">
                <?php
            include ("connection.php");
                if(isset($_SESSION['status']))
                {
                    ?>
                    <div class="alert alert-success">
                        <h5><?=$_SESSION['status'];?></h5>
                    </div>
                    <?php
                    unset($_SESSION['status']);
                }
            ?>
            
                <form action="password-reset.php" method="POST" >
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>
                    
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>