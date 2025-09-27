<?php
// Database config
$host = "localhost";
$user = "root";   // change if needed
$pass = "";
$dbname = "moneyapp";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

session_start();
?>
