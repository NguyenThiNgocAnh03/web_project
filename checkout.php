<?php
session_start();
if (!isset($_SESSION['id-user'])) {
    $_SESSION['error'] = 'Vui lòng đăng nhập để đặt hàng!';
    header("Location: user/login.php");
    exit();
}

//  CHƯA CÓ GIỎ HÀNG
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit();
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['qty'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="text-center">Thanh toán đơn hàng</h2>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                Đặt hàng thành công!
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <tr>
                <th>Sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Số lượng</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><img src="<?= $item['image'] ?>" width="80"></td>
                    <td><?= number_format($item['price']) ?> đ</td>
                    <td><?= $item['qty'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h4>Tổng tiền: <b><?= number_format($total) ?> đ</b></h4>

        <form method="post" action="checkout-back.php">
            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Địa chỉ giao hàng</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Phương thức thanh toán</label>
                <select name="payment_method" class="form-control" required>
                    <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                    <option value="bank">Chuyển khoản ngân hàng</option>
                </select>
            </div>

            <div class="form-group">
                <label>Ghi chú</label>
                <textarea name="note" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">
                Xác nhận đặt hàng
            </button>
        </form>

    </div>
</body>

</html>