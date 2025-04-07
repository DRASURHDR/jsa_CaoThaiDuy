<?php
session_start(); 
include 'db.php';
global $wpdb;
$products = $wpdb->get_results("SELECT * FROM Product WHERE status = 'active' ORDER BY created_at DESC LIMIT 8", ARRAY_A);
// --- Check login/Fake user ---
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT id FROM User WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        session_unset();
        session_destroy();
        header("Location: " . site_url()); // Redirect về trang chủ
        exit();
    }
}
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
            <li><a href="javascript:void(0);" id="cart-icon"><i class='bx bx-cart'></i></a></li>

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
                        <a href="<?php echo site_url('/products'); ?>">Shop<i class='bx bxs-chevron-down'></i></a>
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
	
    <!-- hero section -->
    <div class="hero">
        <div class="slider">
            <div class="container">
                <!-- slide item -->
                <div class="slide active">
                    <div class="info">
                        <div class="info-content">
                            <h3 class="top-down">
                                DELL ALIENWARE
                            </h3>
                            <h2 class="top-down trans-delay-0-2">
                                Elegance in Power
                            </h2>
                            <p class="top-down trans-delay-0-4">
                                Built for visionaries and champions, Alienware delivers unmatched speed, bold futuristic design, and immersive power for those who demand nothing but excellence. Every curve, every light, and every detail speaks of ultimate gaming mastery.
                            </p>
                            <div class="top-down trans-delay-0-6">
                                <button class="btn-flat btn-hover btn-shop" data-link="<?php echo site_url('/product-detail'); ?>">
                                    <span>shop now</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="img top-down">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/awm17nt-cnb-00060lb055-wh.psd-www.laptopvip.vn-1620789867.webp" alt="">
                    </div>
                </div>
                <!-- end slide item -->
               <!-- slide item -->
                <div class="slide">
                    <div class="info">
                        <div class="info-content">
                            <h3 class="top-down">
                                GE 76 RAIDER
                            </h3>
                            <h2 class="top-down trans-delay-0-2">
                               Born to Conquer
                            </h2>
                            <p class="top-down trans-delay-0-4">
                                A masterpiece crafted for fearless gamers. GE76 Raider boasts stunning visuals, rapid response, and supreme cooling — built to conquer the battlefield and lead the charge into next-gen gaming revolutions without compromise.
                            </p>
                            <div class="top-down trans-delay-0-6" >
                                <button class="btn-flat btn-hover btn-shop" data-link="<?php echo site_url('/product-detail'); ?>">
                                    <span>shop now</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="img left-right">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/1632992086-294-nang-cap-ssd-ram-cho-laptop-msi-ge76-raider-2024.png" alt="">
                    </div>
                </div>
                <!-- end slide item -->
                <!-- slide item -->
                <div class="slide">
                    <div class="info">
                        <div class="info-content">
                            <h3 class="top-down">
                                ROG STRIX
                            </h3>
                            <h2 class="top-down trans-delay-0-2">
                                   Precision Dominance                           
							</h2>
                            <p class="top-down trans-delay-0-4">
                               Forged for warriors of performance, ROG Strix blends speed, durability, and bold aesthetics into a lethal weapon. Step into the arena with unstoppable force and experience gaming at its purest, with style and precision.
                            </p>
                            <div class="top-down trans-delay-0-6">
                                <button class="btn-flat btn-hover btn-shop" data-link="<?php echo site_url('/product-detail'); ?>">
                                    <span>shop now</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="img left-right">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/asus-rog-g531gw-01-1560650064.webp" alt="">
                    </div>
                </div>
                <!-- end slide item -->
            </div>
            <!-- slider controller -->
            <button class="slide-controll slide-next">
                <i class='bx bxs-chevron-right'></i>
            </button>
            <button class="slide-controll slide-prev">
                <i class='bx bxs-chevron-left'></i>
            </button>
            <!-- end slider controller -->
        </div>
    </div>
    <!-- end hero section -->

    <!-- promotion section -->
    <div class="promotion">
        <div class="row">
            <div class="col-4 col-md-12 col-sm-12">
                <div class="promotion-box">
                    <div class="text">
                        <h3>Lenovo LOQ</h3>
                        <button class="btn-flat btn-hover"><span>shop collection</span></button>
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/Legion-Pro-7-16IRX9H-CT1-03-www.laptopvip.vn-1734334140.webp" alt="">
                </div>
            </div>
            <div class="col-4 col-md-12 col-sm-12">
                <div class="promotion-box">
                    <div class="text">
                        <h3>Legion</h3>
                        <button class="btn-flat btn-hover"><span>shop collection</span></button>
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/81x7P1JQHAL-removebg-preview.png" alt="">
                </div>
            </div>
            <div class="col-4 col-md-12 col-sm-12">
                <div class="promotion-box">
                    <div class="text">
                        <h3>Acer Predator</h3>
                        <button class="btn-flat btn-hover"><span>shop collection</span></button>
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/-ai-phn16s-71-non-fingerprint-with-backlit-on-wp-oled-abyssal-black-02_315bf06dbac44f2cb95a82d7d8531" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- end promotion section -->

    <!-- product list -->
    <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>Latest product</h2>
            </div>
				<div class="row" id="latest-products">
						<?php foreach ($products as $product): ?>
							<?php
							$main_image = esc_url($product['main_image']);
							$hover_image = $main_image;
							if (!empty($product['additional_images'])) {
								$additional = json_decode($product['additional_images'], true);
								if (!empty($additional) && isset($additional[0])) {
									$hover_image = esc_url($additional[0]);
								}
							}
							?>
							<div class="col-3 col-md-6 col-sm-12">
								<div class="product-card">
									<div class="product-card-img">
										<img src="<?php echo $main_image; ?>" alt="<?php echo esc_attr($product['name']); ?>">
										<img src="<?php echo $hover_image; ?>" alt="<?php echo esc_attr($product['name']); ?>">
									</div>
									<div class="product-card-info">
										<div class="product-btn">
											<a href="<?php echo site_url('/product-detail'); ?>?id=<?php echo $product['id']; ?>" class="btn-flat btn-hover btn-shop-now">shop now</a>
											 <button class="btn-flat btn-hover btn-cart-add" data-id="<?php echo $product['id']; ?>">
												<i class='bx bxs-cart-add'></i>
											</button>
											<button class="btn-flat btn-hover btn-cart-add">
												<i class='bx bxs-heart'></i>
											</button>
										</div>
										<div class="product-card-name">
											<?php echo esc_html($product['name']); ?>
										</div>
										<div class="product-card-price">
											<?php if (!empty($product['sale_price'])): ?>
												<span><del><?php echo number_format($product['price']); ?> VND</del></span>
												<span class="curr-price"><?php echo number_format($product['sale_price']); ?> VND</span>
											<?php else: ?>
												<span class="curr-price"><?php echo number_format($product['price']); ?> VND</span>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
            <div class="section-footer">
<a href="<?php echo site_url('/products'); ?>" class="btn-flat btn-hover btn-view-all">View All</a>
            </div>
        </div>
    </div>
    <!-- end product list -->

    <!-- special product -->
    <div class="bg-second">
        <div class="section container">
            <div class="row">
                <div class="col-4 col-md-4">
                    <div class="sp-item-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/alienware-x16-r2-3.webp" alt="">
                    </div>
                </div>
                <div class="col-7 col-md-8">
                    <div class="sp-item-info">
                        <div class="sp-item-name">DELL ALIENWARE X16 r2</div>
                        <p class="sp-item-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore dignissimos itaque et eaque quod harum vero autem? Reprehenderit enim non voluptate! Qui provident modi est non eius ratione, debitis iure.
                        </p>
                        <button class="btn-flat btn-hover btn-shop" data-link="<?php echo site_url('/product-detail'); ?>">shop now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end special product -->

    <!-- product list -->
    <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>best selling</h2>
            </div>
				<div class="row" id="best-products">
					<?php foreach ($products as $product): ?>
						<?php
						$main_image = esc_url($product['main_image']);
						$hover_image = $main_image;
						if (!empty($product['additional_images'])) {
							$additional = json_decode($product['additional_images'], true);
							if (!empty($additional) && isset($additional[0])) {
								$hover_image = esc_url($additional[0]);
							}
						}
						?>
						<div class="col-3 col-md-6 col-sm-12">
							<div class="product-card">
								<div class="product-card-img">
									<img src="<?php echo $main_image; ?>" alt="<?php echo esc_attr($product['name']); ?>">
									<img src="<?php echo $hover_image; ?>" alt="<?php echo esc_attr($product['name']); ?>">
								</div>
								<div class="product-card-info">
									<div class="product-btn">
										<a href="<?php echo site_url('/product-detail'); ?>?id=<?php echo $product['id']; ?>" class="btn-flat btn-hover btn-shop-now">shop now</a>
										<button class="btn-flat btn-hover btn-cart-add" data-id="<?php echo $product['id']; ?>">
											<i class='bx bxs-cart-add'></i>
										</button>
										<button class="btn-flat btn-hover btn-cart-add">
											<i class='bx bxs-heart'></i>
										</button>
									</div>
									<div class="product-card-name">
										<?php echo esc_html($product['name']); ?>
									</div>
									<div class="product-card-price">
										<?php if (!empty($product['sale_price'])): ?>
											<span><del><?php echo number_format($product['price']); ?> VND</del></span>
											<span class="curr-price"><?php echo number_format($product['sale_price']); ?> VND</span>
										<?php else: ?>
											<span class="curr-price"><?php echo number_format($product['price']); ?> VND</span>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
            <div class="section-footer">
<a href="<?php echo site_url('/products'); ?>" class="btn-flat btn-hover btn-view-all">View All</a>
            </div>
        </div>
    </div>
    <!-- end product list -->

    <!-- blogs -->
    <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>latest blog</h2>
            </div>
            <div class="blog">
                <div class="blog-img">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Predator-Helios-Neo-16-PHN16-72-Vu-Khi-Gaming-Toi-Thuong-2024-Intel-Core-i9-Gen-14-RTX-4070.webp" alt="">
                </div>
                <div class="blog-info">
                    <div class="blog-title">
                        THE ULTIMATE GAMING
                    </div>
                    <div class="blog-preview">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi, eligendi dolore. Sapiente omnis numquam mollitia asperiores animi, veritatis sint illo magnam, voluptatum labore, quam ducimus! Nisi doloremque praesentium laudantium repellat.
                    </div>
                    <button class="btn-flat btn-hover">read more</button>
                </div>
            </div>
            <div class="blog row-revere">
                <div class="blog-img">
                <img src="<?php echo get_template_directory_uri(); ?>/images/fd8fe6e0-ad1c-11ee-bf3b-f441cdae-1705076129453979871482.webp" alt="">
                </div>
                <div class="blog-info">
                    <div class="blog-title">
                        ACER PREDATOR 18
                    </div>
                    <div class="blog-preview">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi, eligendi dolore. Sapiente omnis numquam mollitia asperiores animi, veritatis sint illo magnam, voluptatum labore, quam ducimus! Nisi doloremque praesentium laudantium repellat.
                    </div>
                    <button class="btn-flat btn-hover">read more</button>
                </div>
            </div>
            <div class="section-footer">
<a href="<?php echo site_url('/products'); ?>" class="btn-flat btn-hover btn-view-all">View All</a>
            </div>
        </div>
    </div>
    <!-- end blogs -->

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
<script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/index.js"></script>
	
<!-- Cart Sidebar -->
<div id="cart-sidebar" class="cart-sidebar">
    <!-- Header -->
    <div class="cart-header">
        <h3>Your Cart</h3>
        <span class="close-cart">&times;</span>
    </div>

    <!-- Body: chứa nhiều cart-item -->
    <div class="cart-body" id="cart-items">
        <!-- Nhiều sản phẩm cart-item sẽ render vào đây -->
    </div>

    <!-- Footer -->
    <div class="cart-footer">
        <div class="cart-total">
            Total: <span id="cart-total-price">0 VND</span>
        </div>
        <button id="checkout-btn" class="btn-flat btn-hover">Checkout</button>
    </div>
</div>
<!-- End Cart Sidebar -->

	<script>
document.getElementById('checkout-btn').addEventListener('click', function () {
    <?php if (isset($_SESSION['user_id'])): ?>
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        fetch('<?php echo get_template_directory_uri(); ?>/checkout_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ cart })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showToast('Thanh toán thành công!');
                localStorage.removeItem('cart');
                location.reload();
            }
        });
    <?php else: ?>
        document.getElementById('login-modal').style.display = 'flex'; // <<< Sửa thành style.display
    <?php endif; ?>
});
</script>
</body>

</html>