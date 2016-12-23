<?php
session_start();// Starting Session
include_once("database_connection.php"); //database connection

if (!isset($_SESSION['login_user'])) {
    // small check to be sure you are logged
    header('Location: index.php'); // Redirecting To Home Page
}

// Stored Session
$user_check = $_SESSION['login_user'];

// current signed in user
$email = mysqli_real_escape_string($conn, $user_check);

// SQL Query To Fetch Complete Information Of User
$query = "SELECT * FROM users WHERE email='" . $email . "'";

$result = mysqli_query($conn, $query);

// Associative array
$userDetails = mysqli_fetch_assoc($result);