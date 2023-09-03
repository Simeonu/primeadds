<?php 

session_start();
// destroy the session

unset($_SESSION['prime_adds_user']);

if(!isset($_SESSION['prime_adds_user'])){
// redirect the user to the login page
    header('Location:../login/');
}

?>