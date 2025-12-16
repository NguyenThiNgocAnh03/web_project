<?php
session_start();
require_once('model/connect.php');

$order_id = (int)$_POST['order_id'];
$user_id  = $_SESSION['id-user'];

/* Chỉ hủy khi đơn chưa giao */
mysqli_query($conn, "
    UPDATE orders
    SET status = 4
    WHERE id = $order_id
    AND user_id = $user_id
    AND status IN (0,1)
");

header("Location: order-history.php");
exit();
