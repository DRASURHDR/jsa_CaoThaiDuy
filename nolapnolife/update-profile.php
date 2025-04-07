<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

// Phải đăng nhập mới update được
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập']);
    exit;
}

$fullname = $_POST['fullname'] ?? '';

if (empty($fullname)) {
    echo json_encode(['success' => false, 'message' => 'Họ tên không được để trống']);
    exit;
}

$stmt = $conn->prepare("UPDATE User SET full_name = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
$stmt->bind_param("si", $fullname, $_SESSION['user_id']);

if ($stmt->execute()) {
    $_SESSION['fullname'] = $fullname; // Cập nhật session luôn
    echo json_encode(['success' => true, 'message' => 'Cập nhật thành công']);
} else {
    echo json_encode(['success' => false, 'message' => 'Cập nhật thất bại']);
}

$stmt->close();
$conn->close();
?>
