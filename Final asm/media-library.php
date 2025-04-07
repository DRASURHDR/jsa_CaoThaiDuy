<?php
/*
Template Name: Media Library
*/
?>
<?php
// media-library.php - Chọn ảnh từ thư viện trong theme

// Đường dẫn thư mục ảnh trên server
$directory = __DIR__ . '/images';

// Base URL để load ảnh ra trình duyệt
$baseUrl = get_template_directory_uri() . '/images';

// Lấy danh sách file ảnh
$images = glob($directory . '/*.{jpg,jpeg,png,webp,gif}', GLOB_BRACE);

// Đọc biến target từ URL (mặc định là 'main')
$target = isset($_GET['target']) ? sanitize_text_field($_GET['target']) : 'main';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Image</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .gallery { display: flex; flex-wrap: wrap; gap: 15px; }
        .gallery img { width: 150px; height: 150px; object-fit: cover; cursor: pointer; border: 2px solid transparent; transition: 0.2s; }
        .gallery img:hover { border-color: #007bff; }
    </style>
</head>
<body>

<h2>Select Image</h2>

<div class="gallery">
    <!-- Thêm nút "Select None" để không chọn ảnh -->
    <button type="button" onclick="selectNone()" style="margin-bottom: 15px; padding: 8px 12px; background: #f44336; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
        Select None
    </button>

    <?php foreach ($images as $img): 
        $url = $baseUrl . '/' . basename($img);
    ?>
        <img src="<?php echo esc_url($url); ?>" onclick="selectImage('<?php echo esc_js($url); ?>')" style="width: 150px; height: 150px; object-fit: cover; margin: 5px; cursor: pointer; border: 2px solid transparent;" onmouseover="this.style.borderColor='#2196F3'" onmouseout="this.style.borderColor='transparent'">
    <?php endforeach; ?>
</div>

<script>
// Chọn ảnh
function selectImage(url) {
    if (window.opener && typeof window.opener.selectImageFromLibrary === 'function') {
        window.opener.selectImageFromLibrary(url);
        window.close();
    } else {
        alert('Cannot send image back to parent window.');
    }
}

// Không chọn ảnh (reset)
function selectNone() {
    if (window.opener && typeof window.opener.selectImageFromLibrary === 'function') {
        window.opener.selectImageFromLibrary(''); // Gửi giá trị rỗng
        window.close();
    } else {
        alert('Cannot send image back to parent window.');
    }
}
</script>



</body>
</html>
