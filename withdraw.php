<?php
header("Access-Control-Allow-Origin: *"); // allow Unity to connect
header("Content-Type: application/json");

// Database connection
$host = "localhost"; 
$user = "root";       // change if needed
$pass = "";           // your DB password
$dbname = "moneyapp";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "DB connection failed"]));
}

// Collect POST data
$user_id = $_POST['user_id'] ?? 'guest';
$amount = $_POST['amount'] ?? 0;
$method = $_POST['method'] ?? '';
$account = $_POST['account'] ?? '';

if ($amount <= 0 || empty($method) || empty($account)) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit;
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO withdrawals (user_id, amount, method, account) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siss", $user_id, $amount, $method, $account);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Withdrawal request saved"]);
} else {
    echo json_encode(["status" => "error", "message" => "DB insert failed"]);
}

$stmt->close();
$conn->close();
?>
