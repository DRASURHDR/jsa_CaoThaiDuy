<?php
$host = 'localhost';
$db = 'bivctaolhosting_nolifeidvn';
$user = 'bivctaolhosting_nolifeidvn';
$pass = 'je7UxxT4oAVOF9MOlxvIAYtKTL0umkvz';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("❌ Kết nối thất bại: " . $conn->connect_error);
}
?>

