<?php
session_start();
include 'db.php'; // file connect database

$product_id = intval($_POST['product_id']);
$quantity = intval($_POST['quantity']);
$quantity = $quantity > 0 ? $quantity : 1;

if (!isset($_SESSION['user_id'])) {
    // --- Người chưa login: thêm vào giỏ tạm
    if (!isset($_SESSION['cart_temp'])) {
        $_SESSION['cart_temp'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart_temp'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart_temp'][] = [
            'product_id' => $product_id,
            'quantity' => $quantity
        ];
    }
    echo json_encode(['success' => true, 'message' => 'Thêm vào giỏ tạm thành công']);
} else {
    // --- Người đã login: thêm vào giỏ chính
    $user_id = $_SESSION['user_id'];

    $order = $conn->query("SELECT id FROM `Order` WHERE user_id = $user_id AND status = 'pending' LIMIT 1")->fetch_assoc();
    if (!$order) {
        $conn->query("INSERT INTO `Order` (user_id, status, created_at) VALUES ($user_id, 'pending', NOW())");
        $order_id = $conn->insert_id;
    } else {
        $order_id = $order['id'];
    }

    $detail = $conn->query("SELECT id, quantity FROM OrderDetail WHERE order_id = $order_id AND product_id = $product_id")->fetch_assoc();
    if ($detail) {
        $new_qty = $detail['quantity'] + $quantity;
        $conn->query("UPDATE OrderDetail SET quantity = $new_qty WHERE id = {$detail['id']}");
    } else {
        $conn->query("INSERT INTO OrderDetail (order_id, product_id, quantity) VALUES ($order_id, $product_id, $quantity)");
    }

    echo json_encode(['success' => true, 'message' => 'Thêm vào giỏ hàng thành công']);
}
?>
