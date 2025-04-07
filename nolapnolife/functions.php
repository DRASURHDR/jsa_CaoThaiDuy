<?php
function nolapnolife_enqueue_scripts() {
    // CSS
    wp_enqueue_style('grid', get_template_directory_uri() . '/css/grid.css');
    wp_enqueue_style('app', get_template_directory_uri() . '/css/app.css');

    // JS
    wp_enqueue_script('app-js', get_template_directory_uri() . '/js/app.js', array(), null, true);
    wp_enqueue_script('index-js', get_template_directory_uri() . '/js/index.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'nolapnolife_enqueue_scripts');

// Xử lý thêm/sửa sản phẩm
add_action('admin_post_handle_product', 'handle_product_function');
add_action('admin_post_nopriv_handle_product', 'handle_product_function');
function handle_product_function() {
    // Check nonce
    if (!isset($_POST['handle_product_nonce_field']) || 
        !wp_verify_nonce($_POST['handle_product_nonce_field'], 'handle_product_nonce_action')) {
        wp_die('Security check failed');
    }

    global $wpdb;

    $name = sanitize_text_field($_POST['name']);
    $description = sanitize_textarea_field($_POST['description']);
    $price = floatval($_POST['price']);
    $sale_price = floatval($_POST['sale_price']);
    $stock_quantity = intval($_POST['stock_quantity']);
    $main_image = sanitize_text_field($_POST['main_image']);
    $additional_images = wp_json_encode(json_decode(stripslashes($_POST['additional_images']), true));
    $status = sanitize_text_field($_POST['status']);
    $type = sanitize_text_field($_POST['type']);

    if ($type === 'add') {
        $result = $wpdb->insert("Product", [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'sale_price' => $sale_price,
            'stock_quantity' => $stock_quantity,
            'main_image' => $main_image,
            'additional_images' => $additional_images,
            'status' => $status,
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql'),
        ]);

        if ($result === false) {
            wp_die('Insert failed: ' . $wpdb->last_error);
        }

    } else if ($type === 'update') {
        $product_id = intval($_POST['product_id']);
        $result = $wpdb->update("Product", [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'sale_price' => $sale_price,
            'stock_quantity' => $stock_quantity,
            'main_image' => $main_image,
            'additional_images' => $additional_images,
            'status' => $status,
            'updated_at' => current_time('mysql'),
        ], [ 'id' => $product_id ]);

        if ($result === false) {
            wp_die('Update failed: ' . $wpdb->last_error);
        }
    }

    wp_redirect(home_url('/admin-products/'));
    exit();
}

// Xử lý xóa sản phẩm
add_action('admin_post_delete_product', 'delete_product_function');
add_action('admin_post_nopriv_delete_product', 'delete_product_function');
function delete_product_function() {
    global $wpdb;
    $id = intval($_GET['id']);
    $wpdb->delete("Product", ['id' => $id]);
    wp_redirect(home_url('/admin-products/'));
    exit();
}

// Cho phép lấy tham số id trên trang product-detail
function allow_id_query_var($vars) {
    $vars[] = 'id';
    return $vars;
}
add_filter('query_vars', 'allow_id_query_var');

?>
