<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'register':
        handleRegister($conn);
        break;
    case 'login':
        handleLogin($conn);
        break;
    case 'logout':
        handleLogout();
        break;
    case 'session':
        handleSession();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ']);
        break;
}

// ========== FUNCTIONS ==========

function handleRegister($conn) {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (empty($fullname) || empty($email) || empty($password) || empty($confirm)) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin']);
        exit;
    }

    if ($password !== $confirm) {
        echo json_encode(['success' => false, 'message' => 'Mật khẩu không khớp']);
        exit;
    }

    $check = $conn->prepare("SELECT id FROM User WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email đã tồn tại']);
        exit;
    }

    $check->close();

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO User (full_name, email, password, role, created_at, updated_at, status) VALUES (?, ?, ?, 'user', NOW(), NOW(), 'active')");
    $stmt->bind_param("sss", $fullname, $email, $hashed);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Đăng ký thành công']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Đăng ký thất bại']);
    }

    $stmt->close();
    $conn->close();
    exit;
}

function handleLogin($conn) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập email và mật khẩu']);
        exit;
    }

    $stmt = $conn->prepare("SELECT id, full_name, password, role FROM User WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Email không tồn tại']);
        exit;
    }

    $stmt->bind_result($id, $fullname, $hashedPassword, $role);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['role'] = $role;

        echo json_encode(['success' => true, 'fullname' => $fullname, 'role' => $role]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Sai mật khẩu']);
    }

    $stmt->close();
    $conn->close();
    exit;
}

function handleLogout() {
    session_unset();
    session_destroy();
    echo json_encode(['success' => true, 'message' => 'Đăng xuất thành công']);
    exit;
}

function handleSession() {
    if (isset($_SESSION['user_id'])) {
        echo json_encode([
            'loggedIn' => true,
            'fullname' => $_SESSION['fullname'],
            'role' => $_SESSION['role']
        ]);
    } else {
        echo json_encode(['loggedIn' => false]);
    }
    exit;
}
?>
