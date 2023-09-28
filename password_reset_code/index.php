<?php 
session_start();
include('../api/model.php'); 

$con = $common->connection();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// load composer's autoloader
require '../vendor/autoload.php';


function send_password_reset($get_name,$get_email,$token){
  
    $mail = new PHPMailer(true);                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->isSMTPAuth = true;                                               //Send using SMTP
    $mail->Host       = 'smtp.gmail.com.com';                     //Set the SMTP server to send through
    $mail->Username   = 'simeonfriday635@gmail.com';                     //SMTP username
    $mail->Password   = '***';                               //SMTP password
    $mail->SMTPSecure = 'tis';
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('simeonfriday635@gmail.com',$get_name);
    $mail->addAddress($get_email);     //Add a recipient

    $mail->isHTML(true);               //Name is optional
    $mail->subject  = 'Reset Password Notification';

    $email_template = "
        <h2>Hello</h2>
        <h3>You are recieving this email because we recieved a password reset for your account.</h3>
        <br/><br/>
        <a href='http://localhost/primeadds/forgot_password?token=$token&email=$get_email'>Click me</a>
        
    ";

    $mail->Body = $email_template;
    $mail->send();


}

if(isset($_POST['password_reset_link'])){

    $email = $con->real_escape_string($_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = $con->query($check_email);

    if($check_email_run->num_rows > 0){
        $row      = $check_email_run->fetch_array();
        $get_name =  $row['name'];
        $get_email =  $row['email'];

        $update_token     = "UPDATE users SET verify_token='$token' WHERE email = '$get_email' LIMIT 1"; 
        $update_token_run = $con->query($update_token);

        if($update_token_run){
            // send_password_reset($get_name,$get_email,$token);
            $_SESSION['status'] = "We e-mailed you a password reset link";
            header("Location: ../forgot_password");
            exit(0);
        }else{
            $_SESSION['status'] = "something went wrong. #1 ".$con->error;
            header("Location: ../forgot_password");
            exit(0);
        }
    }else{
        $_SESSION['status'] = "No email found";
        header("Location: ../forgot_password");
        exit(0);
    }
}

?>
