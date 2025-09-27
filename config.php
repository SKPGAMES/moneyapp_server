<?php
$host = "dpg-d3bpcrd6ubrc73e9qtkg-a";
$port = "5432";
$dbname = "moneyapp_db";
$user = "moneyapp_db_user";
$pass = "A2lVsaO78bKL9Z6C5Y9QimDijeFx9FYv";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die(json_encode(["status"=>"error","message"=>$e->getMessage()]));
}
?>
