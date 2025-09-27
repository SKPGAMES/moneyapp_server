<?php
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json");

include "config.php";

// Optionally require authentication (uncomment if needed)
// if (!isset($_SESSION["admin"])) {
//     echo json_encode(["status" => "error", "message" => "Unauthorized"]);
//     exit;
// }

// Fetch withdrawals
$result = $conn->query("SELECT * FROM withdrawals ORDER BY created_at DESC");

$withdrawals = [];
while ($row = $result->fetch_assoc()) {
    $withdrawals[] = [
        "id" => $row["id"],
        "user_id" => $row["user_id"],
        "amount" => $row["amount"],
        "method" => $row["method"],
        "account" => $row["account"],
        "status" => $row["status"],
        "created_at" => $row["created_at"]
    ];
}

echo json_encode([
    "status" => "success",
    "withdrawals" => $withdrawals
]);
?>
