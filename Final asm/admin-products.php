<?php
/*
Template Name: Admin Products
*/

session_start();
include 'db.php'; // file kết nối database mysqli, cần include để query

if (!isset($_SESSION['user_id'])) {
    wp_redirect(home_url());
    exit();
}

$user_id = intval($_SESSION['user_id']);
global $conn;

// Kiểm tra role user
$query = $conn->prepare("SELECT role FROM User WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if (!isset($_SESSION['user_id']) || !$user || $user['role'] !== 'admin') {
    echo '<h2 style="text-align:center;margin-top:100px;">Bạn không có quyền truy cập trang này!</h2>';
    exit();
}

// --- Phần code bên dưới admin products
global $wpdb;
$editing_product = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
$editing_product = $wpdb->get_row($wpdb->prepare("SELECT * FROM Product WHERE id = %d", $id), ARRAY_A);
}

$products = $wpdb->get_results("SELECT * FROM Product ORDER BY created_at DESC", ARRAY_A);
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
<body class="admin-body">
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
<!-- Admin Product Page -->
<div class="admin-container">
  <h1 class="admin-title">Manage Products</h1>

  <div class="admin-form-wrapper">
    <h2 id="form-title"><?php echo isset($editing_product) ? 'Edit Product' : 'Add New Product'; ?></h2>

    <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="admin-form" id="product-form">
      <input type="hidden" name="action" value="handle_product">
      <?php wp_nonce_field('handle_product_nonce_action', 'handle_product_nonce_field'); ?>
      <input type="hidden" name="type" value="<?php echo isset($editing_product) ? 'update' : 'add'; ?>">
      <input type="hidden" name="product_id" value="<?php echo isset($editing_product) ? esc_attr($editing_product['id']) : 0; ?>">

      <div class="input-group">
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" required value="<?php echo isset($editing_product) ? esc_attr($editing_product['name']) : ''; ?>">
      </div>

      <div class="input-group">
        <label for="description">Description</label>
        <textarea name="description" id="description"><?php echo isset($editing_product) ? esc_textarea($editing_product['description']) : ''; ?></textarea>
      </div>

      <div class="input-row">
        <div class="input-group">
          <label for="price">Price</label>
          <input type="number" name="price" id="price" required value="<?php echo isset($editing_product) ? esc_attr($editing_product['price']) : ''; ?>">
        </div>

        <div class="input-group">
          <label for="sale_price">Sale Price</label>
          <input type="number" name="sale_price" id="sale_price" value="<?php echo isset($editing_product) ? esc_attr($editing_product['sale_price']) : ''; ?>">
        </div>

        <div class="input-group">
          <label for="stock_quantity">Stock</label>
          <input type="number" name="stock_quantity" id="stock_quantity" required value="<?php echo isset($editing_product) ? esc_attr($editing_product['stock_quantity']) : ''; ?>">
        </div>
      </div>

      <div class="input-row">
        <div class="input-group">
          <label>Main Image</label>
          <div class="image-picker">
            <input type="text" name="main_image" id="main_image" readonly value="<?php echo isset($editing_product) ? esc_url($editing_product['main_image']) : ''; ?>">
            <button type="button" class="select-btn" onclick="openMedia('main')">
              <i class="bx bx-image-add"></i> Select
            </button>
          </div>
        </div>

        <div class="input-group">
          <label>Additional Images (JSON)</label>
          <div class="image-picker">
            <input type="text" name="additional_images" id="additional_images" readonly value="<?php echo isset($editing_product) ? esc_attr($editing_product['additional_images']) : ''; ?>">
            <button type="button" class="select-btn" onclick="openMedia('additional')">
              <i class="bx bx-image-add"></i> Select
            </button>
            <div id="additional-preview" class="additional-preview"></div>
          </div>
        </div>
      </div>

      <div class="input-group">
        <label for="status">Status</label>
        <select name="status" id="status">
          <option value="active" <?php echo (isset($editing_product) && $editing_product['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
          <option value="inactive" <?php echo (isset($editing_product) && $editing_product['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
        </select>
      </div>

      <button type="submit" class="admin-submit-btn"><?php echo isset($editing_product) ? 'Update' : 'Submit'; ?></button>
    </form>
  </div>

  <div class="admin-table-wrapper">
    <h2>Product List</h2>
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Sale</th>
          <th>Main Image</th>
          <th>Additional Images</th>
          <th>Stock</th>
          <th>Status</th>
          <th>Created</th>
          <th>Updated</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="product-table-body">
        <?php foreach ($products as $product): ?>
          <tr>
            <td><?php echo esc_html($product['id']); ?></td>
            <td><?php echo esc_html($product['name']); ?></td>
            <td><?php echo number_format($product['price']); ?></td>
            <td><?php echo number_format($product['sale_price']); ?></td>
            <td><img src="<?php echo esc_url($product['main_image']); ?>" style="height:50px;"></td>
            <td>
              <?php 
              $additional = json_decode($product['additional_images'], true);
              if (!empty($additional)) {
                foreach ($additional as $img) {
                  echo '<img src="' . esc_url($img) . '" style="height:30px;margin-right:5px;">';
                }
              }
              ?>
            </td>
            <td><?php echo esc_html($product['stock_quantity']); ?></td>
            <td><?php echo esc_html($product['status']); ?></td>
            <td><?php echo esc_html($product['created_at']); ?></td>
            <td><?php echo esc_html($product['updated_at']); ?></td>
            <td>
              <a href="<?php echo esc_url(add_query_arg('edit', $product['id'])); ?>">Edit</a> |
              <a href="<?php echo esc_url(admin_url('admin-post.php?action=delete_product&id=' . $product['id'])); ?>" onclick="return confirm('Delete this product?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
// Khi vào form, nếu có dữ liệu additional_images thì render preview luôn
document.addEventListener('DOMContentLoaded', function() {
    renderAdditionalPreview();
});
</script>

	
	
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