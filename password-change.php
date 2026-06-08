<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-4 offset-md-4 form">
               <?php
                include("connection.php");
                if (isset($_SESSION['status'])):
                ?>
                <div class="alert <?= (strpos($_SESSION['status'], 'Success') !== false) ? 'alert-success' : 'alert-danger'; ?>">
                <?= $_SESSION['status']; ?>
                </div>
                <?php
                    unset($_SESSION['status']);
                endif;
                ?>

            
                <form action="password-reset.php" method="POST" >
                    <input type="hidden" name="code" value="<?php if(isset($_GET['code'])){echo $_GET['code'];} ?>">      

                    <div class="card-header">
                     <h5 class="text-center">Change Password</h5>
                    </div>

                    <label>Email Address</label>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" placeholder="Enter email address">
                    </div>

                    <label>New Password</label>
                    <div class="form-group">
                    <input class="form-control" type="password" name="new_password" placeholder="Enter New Password">
                    </div>

                    <label>Confirm Password</label>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Enter Confirm Password">
                    </div>

                    <div class="form-group">
                        <input class="form-control button" type="submit" name="update-password" value="Update Password">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>