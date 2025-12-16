<?php
session_start();
require_once('model/connect.php');

$order_id = (int)$_POST['order_id'];
$user_id  = $_SESSION['id-user'];

mysqli_query($conn, "
    UPDATE orders
    SET status = 3
    WHERE id = $order_id AND user_id = $user_id
");

header("Location: order-history.php");
exit();
