<?php 

session_start();

if(isset($_SESSION['status'])){
    
        echo '<div class="alert alert_success"> <h5>'.$_SESSION["status"].'</h5></div>';

    unset($_SESSION['status']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<link href="sign-up/img/my_logo.png" rel="icon">
<title>Reset Password</title>

<link href="https://cdn.jsdelivr.net/n123  pm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<div class="signup-form">
    <form action="../password_reset_code/" method="post">

        <div class="form-group return_home">
           <a href="../index.html"> <img src="../my_dashboard/img/my_logo.png" alt="my_logo" id="logo"></a>
        </div>
   
        <h2>Reset Password</h2>
		<p>Please enter the email used for account creation!</p>
    
        <div class="form-group mb-3">
        	<input type="text" class="form-control email_input" name="email" id="email" placeholder="Enter your Email" required="required">
        </div>

        <div class="reply"></div>
		<div class="form-group login_button">
            <button type="submit" class="btn btn-primary btn-lg w-100" name="password_reset_link">Send password reset link</button>
        </div>
    </form>
</div>
</body>
</html>