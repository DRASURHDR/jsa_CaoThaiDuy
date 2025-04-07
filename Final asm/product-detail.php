<?php
/**
 * Template Name: Product Detail
 */
?>
<?php
session_start();
global $wpdb;

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id <= 0) {
    wp_redirect(home_url());
    exit;
}

$product = $wpdb->get_row(
    $wpdb->prepare("SELECT * FROM Product WHERE id = %d AND status = 'active'", $product_id),
    ARRAY_A
);

if (!$product) {
    wp_redirect(home_url());
    exit;
}
?>
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

    <!-- product-detail content -->
    <div class="bg-main">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <a href="./index.html">home</a>
                    <span><i class='bx bxs-chevrons-right'></i></span>
                    <a href="./products.html">all products</a>
                    <span><i class='bx bxs-chevrons-right'></i></span>
                    <a href="./product-detail.html">ALIENWARE</a>
                </div>
            </div>
            <div class="row product-row">
                <div class="col-5 col-md-12">
                    <div class="product-img" id="product-img">
						<img src="<?php echo esc_url($product['main_image']); ?>" alt="<?php echo esc_attr($product['name']); ?>">
					</div>
                    <div class="box">
                        <div class="product-img-list">
                            <div class="product-img-item">
                                <img src="./images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png" alt="">
                            </div>
                            <div class="product-img-item">
                                <img src="./images/JBL-Endurance-Sprint_Alt_Red-1605x1605px.webp" alt="">
                            </div>
                            <div class="product-img-item">
                                <img src="./images/JBL_Quantum_400_Product Image_Hero 02.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7 col-md-12">
										<div class="product-info">
						<h1><?php echo esc_html($product['name']); ?></h1>

						<div class="product-info-detail">
							<span class="product-info-detail-title">Brand:</span>
							<a href="#"><?php echo !empty($product['brand']) ? esc_html($product['brand']) : 'Updating'; ?></a>
						</div>

						<div class="product-info-detail">
							<span class="product-info-detail-title">Rated:</span>
							<span class="rating">
								<i class='bx bxs-star'></i>
								<i class='bx bxs-star'></i>
								<i class='bx bxs-star'></i>
								<i class='bx bxs-star'></i>
								<i class='bx bxs-star'></i>
							</span>
						</div>

						<p class="product-description">
							<?php echo !empty($product['description']) ? esc_html($product['description']) : 'No description available.'; ?>
						</p>

						<div class="product-info-price">
							<?php
							if (!empty($product['sale_price'])) {
								echo '<span>' . number_format($product['sale_price']) . ' VND</span> ';
								echo '<span class="old-price">' . number_format($product['price']) . ' VND</span>';
							} else {
								echo '<span>' . number_format($product['price']) . ' VND</span>';
							}
							?>
						</div>

						<div class="product-quantity-wrapper">
							<span class="product-quantity-btn">
								<i class='bx bx-minus'></i>
							</span>
							<span class="product-quantity">1</span>
							<span class="product-quantity-btn">
								<i class='bx bx-plus'></i>
							</span>
						</div>

						<div>
							<button class="btn-flat btn-hover">Add to cart</button>
						</div>
					</div>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    description
                </div>
                <div class="product-detail-description">
                    <button class="btn-flat btn-hover btn-view-description" id="view-all-description">
                        view all
                    </button>
                    <div class="product-detail-description-content">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit laudantium obcaecati odit dolorem, doloremque accusamus esse neque ipsa dignissimos saepe quisquam tempore perferendis deserunt sapiente! Recusandae illum totam earum ratione.
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam incidunt maxime rerum reprehenderit voluptas asperiores ipsam quas consequuntur maiores, at odit obcaecati vero sunt! Reiciendis aperiam perferendis consequuntur odio quas. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut quaerat eum veniam doloremque nihil repudiandae odio ratione culpa libero tempora. Expedita, quo molestias. Minus illo quis dignissimos aliquid sapiente error!
                        </p>
                        <img src="./images/JBL_Quantum_400_Product Image_Hero 02.png" alt="">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis accusantium officia, quae fuga in exercitationem aliquam labore ex doloribus repellendus beatae facilis ipsam. Veritatis vero obcaecati iste atque aspernatur ducimus.
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellat quam praesentium id sit amet magnam ad, dolorum, cumque iste optio itaque expedita eius similique, ab adipisci dicta. Quod, quibusdam quas. Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, in corrupti ipsam sint error possimus commodi incidunt suscipit sit voluptatum quibusdam enim eligendi animi deserunt recusandae earum natus voluptas blanditiis?
                        </p>
                        <img src="./images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png" alt="">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi ullam quam fugit veniam ipsum recusandae incidunt, ex ratione, magnam labore ad tenetur officia! In, totam. Molestias sapiente deserunt animi porro?
                        </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    review
                </div>
                <div>
                    <div class="user-rate">
                        <div class="user-info">
                            <div class="user-avt">
                                <img src="./images/tuat.jpg" alt="">
                            </div>
                            <div class="user-name">
                                <span class="name">Cao Thai Duy</span>
                                <span class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </span>
                            </div>
                        </div>
                        <div class="user-rate-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ea iste, veritatis nobis amet illum, cum alias magni dolores odio, eius quo excepturi veniam ipsa voluptatibus natus voluptas vero? Aspernatur!
                        </div>
                    </div>
                    <div class="user-rate">
                        <div class="user-info">
                            <div class="user-avt">
                                <img src="./images/tuat.jpg" alt="">
                            </div>
                            <div class="user-name">
                                <span class="name">Cao Thai Duy</span>
                                <span class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </span>
                            </div>
                        </div>
                        <div class="user-rate-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ea iste, veritatis nobis amet illum, cum alias magni dolores odio, eius quo excepturi veniam ipsa voluptatibus natus voluptas vero? Aspernatur!
                        </div>
                    </div>
                    <div class="user-rate">
                        <div class="user-info">
                            <div class="user-avt">
                                <img src="./images/tuat.jpg" alt="">
                            </div>
                            <div class="user-name">
                                <span class="name">Cao Thai Duy</span>
                                <span class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </span>
                            </div>
                        </div>
                        <div class="user-rate-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ea iste, veritatis nobis amet illum, cum alias magni dolores odio, eius quo excepturi veniam ipsa voluptatibus natus voluptas vero? Aspernatur!
                        </div>
                    </div>
                    <div class="user-rate">
                        <div class="user-info">
                            <div class="user-avt">
                                <img src="./images/tuat.jpg" alt="">
                            </div>
                            <div class="user-name">
                                <span class="name">Cao Thai Duy</span>
                                <span class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </span>
                            </div>
                        </div>
                        <div class="user-rate-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ea iste, veritatis nobis amet illum, cum alias magni dolores odio, eius quo excepturi veniam ipsa voluptatibus natus voluptas vero? Aspernatur!
                        </div>
                    </div>
                    <div class="user-rate">
                        <div class="user-info">
                            <div class="user-avt">
                                <img src="./images/tuat.jpg" alt="">
                            </div>
                            <div class="user-name">
                                <span class="name">Cao Thai Duy</span>
                                <span class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </span>
                            </div>
                        </div>
                        <div class="user-rate-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ea iste, veritatis nobis amet illum, cum alias magni dolores odio, eius quo excepturi veniam ipsa voluptatibus natus voluptas vero? Aspernatur!
                        </div>
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
            <div class="box">
                <div class="box-header">
                    related products
                </div>
                <div class="row" id="related-products"></div>
            </div>
        </div>
    </div>
    <!-- end product-detail content -->

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
<script src="<?php echo get_template_directory_uri(); ?>/js/product-detail.js"></script>
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