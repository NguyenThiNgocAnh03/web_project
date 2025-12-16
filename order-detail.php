<?php
session_start();
require_once('model/connect.php');

if (!isset($_SESSION['id-user'])) {
    header("Location: user/login.php");
    exit();
}

$order_id = (int)$_GET['id'];
$user_id  = $_SESSION['id-user'];

$sql = "
SELECT p.name, p.image, p.price, po.quantity
FROM product_order po
JOIN products p ON po.product_id = p.id
JOIN orders o ON po.order_id = o.id
WHERE po.order_id = $order_id AND o.user_id = $user_id
";

$result = mysqli_query($conn, $sql);
?>

<h2>Chi tiết đơn hàng #<?= $order_id ?></h2>

<table class="table table-bordered">
    <tr>
        <th>Hình ảnh</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
    </tr>

    <?php
    $total = 0;
    while ($row = mysqli_fetch_assoc($result)):
        $sub = $row['price'] * $row['quantity'];
        $total += $sub;
    ?>
        <tr>
            <td><img src="<?= $row['image'] ?>" width="80"></td>
            <td><?= $row['name'] ?></td>
            <td><?= number_format($row['price']) ?> đ</td>
            <td><?= $row['quantity'] ?></td>
            <td><?= number_format($sub) ?> đ</td>
        </tr>
    <?php endwhile; ?>

    <tr>
        <td colspan="4"><b>Tổng cộng</b></td>
        <td><b><?= number_format($total) ?> đ</b></td>
    </tr>
</table>

<a href="order-history.php">
    <input type="button" value="Quay lại">
</a>    