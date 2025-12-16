<?php
session_start();

if (!isset($_SESSION['cart'])) {
    header("Location: view-cart.php");
    exit();
}

$id   = isset($_GET['id'])   ? (int)$_GET['id']   : 0;
$type = isset($_GET['type']) ? $_GET['type']      : '';

if (isset($_SESSION['cart'][$id])) {

    if ($type === 'plus') {
        $_SESSION['cart'][$id]['qty'] += 1;
    }

    if ($type === 'minus') {
        $_SESSION['cart'][$id]['qty'] -= 1;
        if ($_SESSION['cart'][$id]['qty'] <= 0) {
            unset($_SESSION['cart'][$id]); // xoá nếu <= 0
        }
    }
}

header("Location: view-cart.php");
exit();
