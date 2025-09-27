<?php
include "config.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

// Handle approve/reject actions
if (isset($_GET["action"]) && isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $status = ($_GET["action"] === "approve") ? "approved" : "rejected";

    $stmt = $conn->prepare("UPDATE withdrawals SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard.php");
    exit;
}

// Fetch all withdrawals
$result = $conn->query("SELECT * FROM withdrawals ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #f4f4f4; }
        a { margin: 0 5px; }
    </style>
</head>
<body>
    <h2>Withdrawal Requests</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Account</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["user_id"] ?></td>
            <td>₹<?= $row["amount"] ?></td>
            <td><?= $row["method"] ?></td>
            <td><?= $row["account"] ?></td>
            <td><?= ucfirst($row["status"]) ?></td>
            <td><?= $row["created_at"] ?></td>
            <td>
                <?php if ($row["status"] === "pending"): ?>
                    <a href="dashboard.php?action=approve&id=<?= $row["id"] ?>">✅ Approve</a>
                    <a href="dashboard.php?action=reject&id=<?= $row["id"] ?>">❌ Reject</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
