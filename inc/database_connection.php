<?php
// Report all errors
error_reporting(E_ALL);
/**
 * Connection to your database
 *
 * $username="your_username";
 * $password="your_password";
 * $database="your_database";
 */

$username = "root";
$password = "dominic";
$servername = "localhost";


// Establishing Connection with Server by passing server_name, username and password as a parameter
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}

// Selecting Database
$database = "personal_php_sample";
$db = mysqli_select_db($conn, $database);