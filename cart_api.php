<?php
session_start();
$DBConnect = mysqli_connect("localhost", "root", "", "Momento");
if (!$DBConnect) {
    http_response_code(500);
    echo json_encode(["error" => "DB connection failed"]);
    exit;
}

$session_id = session_id();
$user_id = $_SESSION['user']['id'] ?? null;

header("Content-Type: application/json");

$action = $_POST['action'] ?? '';
$product_id = (int) ($_POST['product_id'] ?? 0);
$quantity = (int) ($_POST['quantity'] ?? 0);

switch ($action) {
    case 'add':
        if ($product_id && $quantity > 0) {
            $stmt = $DBConnect->prepare("INSERT INTO cart (session_id, user_id, product_id, quantity)
                                         VALUES (?, ?, ?, ?)
                                         ON DUPLICATE KEY UPDATE quantity = ?");
            $stmt->bind_param("siiii", $session_id, $user_id, $product_id, $quantity, $quantity);
            $stmt->execute();
            echo json_encode(["success" => true]);
        }
        break;

    case 'remove':
        if ($product_id) {
            $stmt = $DBConnect->prepare("DELETE FROM cart WHERE session_id = ? AND product_id = ?");
            $stmt->bind_param("si", $session_id, $product_id);
            $stmt->execute();
            echo json_encode(["success" => true]);
        }
        break;

    case 'fetch':
        $result = $DBConnect->query("SELECT product_id, quantity FROM cart WHERE session_id = '$session_id'");
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = ['id' => (int)$row['product_id'], 'quantity' => (int)$row['quantity']];
        }
        echo json_encode($items);
        break;

    default:
        echo json_encode(["error" => "Invalid action"]);
}
