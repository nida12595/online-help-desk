<?php
session_start();
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';
require __DIR__ . '/PHPMailer-master/src/Exception.php';



function send_password_reset($get_name,$get_email,$code)
 {
    $mail=new PHPMailer(true);  
    try{                    
    $mail->isSMTP();    
    $mail->SMTPAuth = true;

    $mail->Host       = "smtp.gmail.com";                     
    $mail->Username   = "thehelpdeskportal@gmail.com";                     
    $mail->Password   = "ywoj rsfs wtmg dbld";     
    
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
    $mail->Port       = 587;                                    
    $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

    
    $mail->setFrom("thehelpdeskportal@gmail.com", " ");
    $mail->addAddress($get_email,$get_name);     
    

    $mail->isHTML(true);                                 
    $mail->Subject = "Reset Password Notification";
    
    $email_template ="
    <h2>Hello</h2>
    <h3>You are receiving this email because we received a password reset request for your account.</h3>
    <br/><br/>
    <a href='http://localhost/desk/password-change.php?code=$code&email=$get_email'>Click Me </a>
    ";

    $mail->Body=$email_template;
    $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
    
 //forgot-password

if(isset($_POST['check-email']))
    {
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $code=md5(rand());

        $check_email="SELECT username,email FROM users WHERE email='$email' LIMIT 1";
        $check_email_run=mysqli_query($conn,$check_email);

        if(mysqli_num_rows($check_email_run)>0)
        {
            $row=mysqli_fetch_array($check_email_run);
            $get_name=$row['username'];
            $get_email=$row['email'];

            $update_code="UPDATE users SET code='$code' WHERE email='$get_email' LIMIT 1";
            $update_code_run=mysqli_query($conn,$update_code);

            if($update_code_run)
            {
                send_password_reset($get_name,$get_email,$code);
                $_SESSION['status']="We e-mailed you a password reset link";
                header("Location:forgot-password.php");
                exit(0);
            }
            else{
                $_SESSION['status']="Something went wrong. #1";
                header("Location:forgot-password.php");
                exit(0);
            }
        }
        else{
            $_SESSION['status']="No email Found";
            header("Location:forgot-password.php");
            exit(0);
        }
    }



    //password-change

    if(isset($_POST['update-password']))
    {
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $new_password=mysqli_real_escape_string($conn,$_POST['new_password']);
        $cpassword=mysqli_real_escape_string($conn,$_POST['cpassword']);
        $code=mysqli_real_escape_string($conn,$_POST['code']);


        if(!empty($code))
        {
            if(!empty($code) && !empty($new_password) && !empty($cpassword))
            {
                //checjing code is valid or not
                $check_code="SELECT code FROM users WHERE code='$code' LIMIT 1";
                $check_code_run=mysqli_query($conn,$check_code);

                if(mysqli_num_rows($check_code_run)>0)
                {
                    if($new_password==$cpassword)
                    {
                        //$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        //$update_password = "UPDATE users SET password='$hashed_password', code='' WHERE code='$code' LIMIT 1";
                       // $update_run = mysqli_query($conn, $update_password);
                        $update_password="UPDATE users SET password='$new_password' WHERE code='$code' LIMIT 1";
                        $update_code_run=mysqli_query($conn,$update_password);

                        if($update_code_run)
                        {
                            $new_code=md5(rand())."funda";
                            $update_to_new_code="UPDATE users SET code='$new_code' WHERE code='$code' LIMIT 1";
                            $update_to_new_code_run=mysqli_query($conn, $update_to_new_code);

                            
                            $_SESSION['status']="New Password Successfully Updated.!";
                            header("location:std3.php");
                            exit(0);
                        }
                        else
                        {
                            $_SESSION['status']="Did not update password. Something went wrong.!";
                            header("Location:password-change.php?code=$code&email=$email");
                            exit(0);
                        }

                    }
                    else
                    {
                        $_SESSION['status']="Password and Confirm Password does not match";
                        header("Location:password-change.php?code=$code&email=$email");
                        exit(0);
                    }
                }
                else
                {
                    $_SESSION['status']="Invalid Code";
                    header("Location:password-change.php?code=$code&email=$email");
                    exit(0);
                }
            }
            else
            {
                $_SESSION['status']="All Fields are Mandatory";
                header("Location:password-change.php?code=$code&email=$email");
                exit(0);
        
            }
        }
        else
        {
             $_SESSION['status']="No Code Available";
            header("Location:password-change.php");
            exit(0);
        }
    }

?>