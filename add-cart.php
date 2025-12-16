<?php
session_start();
require_once('model/connect.php');
if (!isset($_SESSION['id-user'])) {
    $_SESSION['error'] = 'Vui lòng đăng nhập để mua hàng!';
    header("Location: user/login.php");
    exit();
}


$id = (int)$_GET['id'];

// Lấy sản phẩm từ DB
$sql = "SELECT id, name, price, image FROM products WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

$product = mysqli_fetch_assoc($result);

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Nếu sản phẩm đã có → tăng số lượng
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty'] += 1;
} else {
    $_SESSION['cart'][$id] = [
        'id'    => $product['id'],
        'name'  => $product['name'],
        'price' => $product['price'],
        'image' => str_replace('../', '', $product['image']),
        'qty'   => 1
    ];
}

$_SESSION['addcart_success'] = 'Đã thêm "' . $product['name'] . '" vào giỏ hàng.';
header("Location: index.php?added=1&name=" . urlencode($product['name']));
exit();

// header("Location: view-cart.php");
// exit();
