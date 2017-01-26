<?php
session_start(); 
if(isset($_SESSION['login_user'])){
header("location: browse.php");
} else {
header("location: login.php");
}
?>