<?php
require_once('../model/connect.php');

$order_id = (int)$_POST['order_id'];
$status   = (int)$_POST['status'];

mysqli_query($conn, "
    UPDATE orders
    SET status = $status
    WHERE id = $order_id
");

header("Location: order_list.php");
exit();
