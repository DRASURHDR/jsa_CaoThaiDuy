<?php
/**
 * Template Name: User Profile
 */
?>
<?php
session_start();
include 'db.php';

// Nếu chưa login thì về trang chủ
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . site_url());
    exit();
}
// Fetch user data
$user_id = intval($_SESSION['user_id']);
$stmt = $conn->prepare("SELECT * FROM User WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if (!$user) {
    echo "<p style='text-align:center; margin-top:50px;'>Không tìm thấy thông tin người dùng.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - NoLapNoLife</title>
	    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/grid.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/app.css">
</head>
<body>
    <!-- header -->
    <header>
		<!-- mobile menu -->
	<div class="mobile-menu bg-second">
		<a href="<?php echo site_url(); ?>" class="mb-logo-combo" style="display: flex; align-items: center; gap: 8px;">
			<span class="logo-text" style="font-weight: 600; font-size: 16px;">NoLapNoLife</span>
			<img src="<?php echo get_template_directory_uri(); ?>/images/Logo.png" alt="Logo" style="height: 32px;">
		</a>
		<span class="mb-menu-toggle" id="mb-menu-toggle">
			<i class='bx bx-menu'></i>
		</span>
	</div>
	<!-- end mobile menu -->
        <!-- main header -->
        <div class="header-wrapper" id="header-wrapper">
            <span class="mb-menu-toggle mb-menu-close" id="mb-menu-close">
                <i class='bx bx-x'></i>
            </span>
            <!-- top header -->
            <div class="bg-second">
                <div class="top-header container">
                    <ul class="devided">
                        <li>
                            <a href="#">+840925253499</a>
                        </li>
                        <li>
                            <a href="#">nolapnolife@mail.com</a>
                        </li>
                    </ul>
                    <ul class="devided">
                        <li class="dropdown">
                            <a href="">USD</a>
                            <i class='bx bxs-chevron-down'></i>
                            <ul class="dropdown-content">
                                <li><a href="#">VND</a></li>
                                <li><a href="#">JPY</a></li>
                                <li><a href="#">EUR</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="">ENGLISH</a>
                            <i class='bx bxs-chevron-down'></i>
                            <ul class="dropdown-content">
                                <li><a href="#">VIETNAMESE</a></li>
                                <li><a href="#">JAPANESE</a></li>
                                <li><a href="#">FRENCH</a></li>
                                <li><a href="#">SPANISH</a></li>
                            </ul>
                        </li>
                        <li><a href="#">ORDER TRACKING</a></li>
                    </ul>
                </div>
            </div>
            <!-- end top header -->
          <!-- mid header -->
<div class="bg-main">
    <div class="mid-header container" style="display: flex; align-items: center; justify-content: space-between; gap: 20px;">

        <!-- Logo -->
        <div class="header-logo" style="display: flex; align-items: center; gap: 10px;">
            <span class="logo-text" style="font-size: 24px; font-weight: 700; color: #000;">NoLapNoLife</span>
            <img src="<?php echo get_template_directory_uri(); ?>/images/Logo.png" alt="Logo" style="height: 40px;">
        </div>

        <!-- Search -->
        <div class="header-search" style="flex-grow: 1; max-width: 600px; display: flex; align-items: center; gap: 10px; background: #f5f5f5; padding: 8px 16px; border-radius: 10px;">
            <input type="text" placeholder="Search" style="flex-grow: 1; border: none; outline: none; background: transparent; font-size: 16px;">
            <i class='bx bx-search-alt' style="font-size: 20px;"></i>
        </div>

        <!-- User menu -->
        <ul class="user-menu">
            <li><a href="#"><i class='bx bx-bell'></i></a></li>
            <li><a href="#"><i class='bx bx-user-circle'></i></a></li>
            <li><a href="#"><i class='bx bx-cart'></i></a></li>
            <?php if (isset($_SESSION['fullname'])): ?>
                <li>
                    <span style="color: white; font-weight: 500;">
                        Xin chào, <?php echo $_SESSION['fullname']; ?>
                    </span>
                </li>
                <li>
                    <button id="logout-btn" class="btn-flat btn-hover" style="margin-left: 10px;">Logout</button>
                </li>
            <?php endif; ?>
        </ul>

    </div>
</div>
<!-- end mid header -->
            <!-- bottom header -->
            <div class="bg-second">
                <div class="bottom-header container">
                    <ul class="main-menu">
                        <li><a href="#">home</a></li>
                        <!-- mega menu -->
                        <li class="mega-dropdown">
                        <a href="<?php echo get_template_directory_uri(); ?>/product.php">Shop<i class='bx bxs-chevron-down'></i></a>
                            <div class="mega-content">
                                <div class="row">
                                    <div class="col-3 col-md-12">
                                        <div class="box">
                                            <h3>Categories</h3>
                                            <ul>
                                                <li><a href="#">DELL</a></li>
                                                <li><a href="#">Acer</a></li>
                                                <li><a href="#">MSI</a></li>
                                                <li><a href="#">ASUS</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-12">
                                        <div class="box">
                                            <h3>Categories</h3>
                                            <ul>
                                                <li><a href="#">I3</a></li>
                                                <li><a href="#">i5</a></li>
                                                <li><a href="#">I7</a></li>
                                                <li><a href="#">I9</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-12">
                                        <div class="box">
                                            <h3>Categories</h3>
                                            <ul>
                                                <li><a href="#">Predator</a></li>
                                                <li><a href="#">GE RAIDER</a></li>
                                                <li><a href="#">ROG STRIX</a></li>
                                                <li><a href="#">ALIENWARE</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-12">
                                        <div class="box">
                                            <h3>Categories</h3>
                                            <ul>
                                                <li><a href="#">GTX1050</a></li>
                                                <li><a href="#">RTX2050</a></li>
                                                <li><a href="#">RTX3050</a></li>
                                                <li><a href="#">RTX4050</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row img-row">
                                    <div class="col-3">
                                        <div class="box">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/dell-alienware-m16-r2-2024-2.png"alt="">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="box">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/-ai-phn16s-71-non-fingerprint-with-backlit-on-wp-oled-abyssal-black-02_315bf06dbac44f2cb95a82d7d8531" alt="">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="box">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/laptop-asus-rog-strix-g18-g814jir-n6108w.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="box">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/nghenhin_acer_predator-helios-neo-16_18_2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- end mega menu -->
                        <li><a href="#">blog</a></li>
                        <li><a href="#">contact</a></li>
                    </ul>
                </div>
            </div>
            <!-- end bottom header -->
        </div>
        <!-- end main header -->
    </header>
    <!-- end header -->
<!-- User profile -->
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <h1 class="section-header">Hồ Sơ Cá Nhân</h1>

    <div class="row">
        <div class="col-4 col-md-6 col-sm-12">
            <div class="profile-card">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['full_name']); ?>&background=random" alt="Avatar" class="profile-avatar">
                <h2 style="margin-bottom: 10px;"><?php echo htmlspecialchars($user['full_name']); ?></h2>
                <p class="text-red" style="text-transform: capitalize; font-weight: 600;">
                    <?php echo htmlspecialchars($user['role']); ?>
                </p>
            </div>
        </div>

        <div class="col-8 col-md-6 col-sm-12">
            <form id="profile-form" class="profile-card profile-form">
                <input type="text" id="fullname" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                <div class="profile-info">
                    <div class="profile-info-item"><i class='bx bx-envelope'></i>Email: <?php echo htmlspecialchars($user['email']); ?></div>
                    <div class="profile-info-item"><i class='bx bx-check-shield'></i>Trạng thái: <?php echo ($user['status'] == 'active') ? '<span class="text-red">Đang hoạt động</span>' : 'Ngưng hoạt động'; ?></div>
                    <div class="profile-info-item"><i class='bx bx-calendar'></i>Ngày tạo: <?php echo date('d/m/Y H:i', strtotime($user['created_at'])); ?></div>
                    <div class="profile-info-item"><i class='bx bx-time'></i>Cập nhật: <?php echo date('d/m/Y H:i', strtotime($user['updated_at'])); ?></div>
                    <div class="profile-info-item"><i class='bx bx-log-in'></i>Đăng nhập gần nhất: <?php echo ($user['last_login'] ? date('d/m/Y H:i', strtotime($user['last_login'])) : 'Chưa ghi nhận'); ?></div>
                </div>
                <div id="profile-message" style="margin-top: 15px;"></div>
                <button type="submit" class="btn-update">UPDATE PROFILE</button>
            </form>
        </div>
    </div>

    <div class="container" style="margin-top: 60px;">
        <h2 class="section-header">Lịch Sử Đơn Hàng</h2>
        <div id="order-history"></div>
    </div>
</div>
<!-- end User profile -->
 <!-- footer -->
    <footer class="bg-second">
        <div class="container">
            <div class="row">
                <div class="col-3 col-md-6">
                    <h3 class="footer-head">Products</h3>
                    <ul class="menu">
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">product help</a></li>
                        <li><a href="#">warranty</a></li>
                        <li><a href="#">order status</a></li>
                    </ul>
                </div>
                <div class="col-3 col-md-6">
                    <h3 class="footer-head">services</h3>
                    <ul class="menu">
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">product help</a></li>
                        <li><a href="#">warranty</a></li>
                        <li><a href="#">order status</a></li>
                    </ul>
                </div>
                <div class="col-3 col-md-6">
                    <h3 class="footer-head">support</h3>
                    <ul class="menu">
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">product help</a></li>
                        <li><a href="#">warranty</a></li>
                        <li><a href="#">order status</a></li>
                    </ul>
                </div>
                <div class="col-3 col-md-6 col-sm-12">
                    <div class="contact">
                        <h3 class="contact-header">
                            NOLAPNOLIFE
                        </h3>
                        <ul class="contact-socials">
                            <li><a href="#">
                                    <i class='bx bxl-facebook-circle'></i>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bxl-instagram-alt'></i>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bxl-youtube'></i>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bxl-twitter'></i>
                                </a></li>
                        </ul>
                    </div>
                    <div class="subscribe">
                        <input type="email" placeholder="ENTER YOUR EMAIL">
                        <button>subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
</body>
</html>