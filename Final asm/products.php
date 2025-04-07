<?php
/**
 * Template Name: Products
 */
global $wpdb;
$products = $wpdb->get_results("SELECT * FROM Product WHERE status = 'active' ORDER BY created_at DESC", ARRAY_A);
?>
<?php
session_start(); 
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nolapnolife</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- app css -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/grid.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/app.css">
</head>

<body>

    <!-- header -->
    <header>
					<!-- Login/Register Modal -->
		<div class="modal" id="login-modal">
			<div class="modal-content">
			  <span class="close-modal">&times;</span>

			  <!-- Tabs -->
			  <div class="modal-tabs">
				<button id="tab-login" class="active">Login</button>
				<button id="tab-register">Register</button>
			  </div>

			  <!-- Login Form -->
			  <form id="login-form" class="auth-form active">
				<input type="email" placeholder="Email" required>
				<input type="password" placeholder="Password" required>
				<label style="margin-bottom: 10px;">
				  <input type="checkbox" id="remember-me"> Remember me
				</label>
				<button type="submit" class="btn-flat btn-hover">Login</button>
				<div id="login-error" class="form-error"></div>
			</form>
			 <!-- end Login Form -->
			  <!-- Register Form -->
		<form id="register-form" class="auth-form">
			<input type="text" placeholder="Full Name" required>
			<input type="email" placeholder="Email" required>
			<input type="password" placeholder="Password" id="reg-password" required>
			<input type="password" placeholder="Confirm Password" id="reg-confirm-password" required>
			<!-- end Register Form -->
			<!-- Thông báo lỗi hiển thị tại đây -->
			<div id="register-error" class="form-error"></div>

			<button type="submit" class="btn-flat btn-hover">Register</button>
		  </form>  
			</div>
		  </div>

		  <!-- Toast message (đặt ngoài modal để hiện toàn trang) -->
		  <div id="toast" class="toast"></div>
			 <!-- end Login/Register Modal -->
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
                            <a href="./products.html">Shop<i class='bx bxs-chevron-down'></i></a>
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

    <!-- products content -->
    <div class="bg-main">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <a href="./index.html">home</a>
                    <span><i class='bx bxs-chevrons-right'></i></span>
                    <a href="./products.html">all products</a>
                </div>
            </div>
            <div class="box">
                <div class="row">
                    <div class="col-3 filter-col" id="filter-col">
                        <div class="box filter-toggle-box">
                            <button class="btn-flat btn-hover" id="filter-close">close</button>
                        </div>
                        <div class="box">
                            <span class="filter-header">
                                DEMAND
                            </span>
                            <ul class="filter-list">
                                <li><a href="#">Gaming</a></li>
                                <li><a href="#">Office</a></li>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Multi-tasking</a></li>
                            </ul>
                        </div>
                        <div class="box">
                            <span class="filter-header">
                                Price
                            </span>
                            <div class="price-range">
                                <input type="text">
                                <span>-</span>
                                <input type="text">
                            </div>
                        </div>
                        <div class="box">
                            <ul class="filter-list">
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="status1">
                                        <label for="status1">
                                            On sale
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="status2">
                                        <label for="status2">
                                            In stock
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="status3">
                                        <label for="status3">
                                            Featured
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="box">
                            <span class="filter-header">
                                Brands
                            </span>
                            <ul class="filter-list">
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember1" checked="checked">
                                        <label for="remember1">
                                            DELL
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember2">
                                        <label for="remember2">
                                            MSI
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember3">
                                        <label for="remember3">
                                            HP
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember4">
                                        <label for="remember4">
                                            ACER
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember5">
                                        <label for="remember5">
                                            ASUS
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="box">
                            <span class="filter-header">
                                CARD
                            </span>
                            <ul class="filter-list">
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember1">
                                        <label for="remember1">
                                            GTX1050
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember2">
                                        <label for="remember2">
                                            RTX 2050
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember3">
                                        <label for="remember3">
                                            RTX 3050
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember4">
                                        <label for="remember4">
                                            RTX 4050
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember5">
                                        <label for="remember5">
                                            RTX 5050
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="box">
                            <span class="filter-header">
                                Rating
                            </span>
                            <ul class="filter-list">
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember1">
                                        <label for="remember1">
                                            <span class="rating">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                            </span>
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember1">
                                        <label for="remember1">
                                            <span class="rating">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bx-star'></i>
                                            </span>
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember1">
                                        <label for="remember1">
                                            <span class="rating">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bx-star'></i>
                                                <i class='bx bx-star'></i>
                                            </span>
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember1">
                                        <label for="remember1">
                                            <span class="rating">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bx-star'></i>
                                                <i class='bx bx-star'></i>
                                                <i class='bx bx-star'></i>
                                            </span>
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="remember1">
                                        <label for="remember1">
                                            <span class="rating">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bx-star'></i>
                                                <i class='bx bx-star'></i>
                                                <i class='bx bx-star'></i>
                                                <i class='bx bx-star'></i>
                                            </span>
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-9 col-md-12">
                        <div class="box filter-toggle-box">
                            <button class="btn-flat btn-hover" id="filter-toggle">filter</button>
                        </div>
                        <div class="box">
							<div class="row" id="products">
								<?php foreach ($products as $product): ?>
								<?php 
								// Lấy main_image
								$main_image = esc_url($product['main_image']);

								// Lấy ảnh phụ đầu tiên trong additional_images
								$hover_image = $main_image; // mặc định = main_image
								if (!empty($product['additional_images'])) {
									$additional = json_decode($product['additional_images'], true);
									if (!empty($additional) && isset($additional[0])) {
										$hover_image = esc_url($additional[0]);
									}
								}
								?>
								<div class="col-4 col-md-6 col-sm-12">
									<div class="product-card">
										<div class="product-card-img">
											<img src="<?php echo $main_image; ?>" alt="<?php echo esc_attr($product['name']); ?>">
											<img src="<?php echo $hover_image; ?>" alt="<?php echo esc_attr($product['name']); ?>">
											<?php if (!empty($product['sale_price'])): ?>
												<span class="card-label sale">On Sale</span>
											<?php endif; ?>
										</div>
										<div class="product-card-info">
											<div class="product-card-name"><?php echo esc_html($product['name']); ?></div>
											<div class="product-card-price">
												<?php if (!empty($product['sale_price'])): ?>
													<span><?php echo number_format($product['sale_price']); ?> VND</span>
													<span class="old-price"><?php echo number_format($product['price']); ?> VND</span>
												<?php else: ?>
													<span><?php echo number_format($product['price']); ?> VND</span>
												<?php endif; ?>
											</div>
											<a href="<?php echo site_url('/product-detail'); ?>?id=<?php echo $product['id']; ?>" class="btn-flat btn-hover btn-shop-now">View Details</a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
							</div>
                        <div class="box">
                            <ul class="pagination">
                                <li><a href="#"><i class='bx bxs-chevron-left'></i></a></li>
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#"><i class='bx bxs-chevron-right'></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products content -->

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

    <!-- app js -->
<script src="<?php echo get_template_directory_uri(); ?>/js/products.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
	<script>
		//Logout
    const logoutBtn = document.querySelector('#logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function () {
            fetch('<?php echo get_template_directory_uri(); ?>/auth.php?action=logout')
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '<?php echo site_url(); ?>';
                    }
                });
        });
    }
</script>

</body>

</html>