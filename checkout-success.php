<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: user/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đặt hàng thành công</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php include("model/header.php"); ?>

    <div class="container" style="margin-top:50px;">
        <div class="alert alert-success text-center">
            <h3> Đặt hàng thành công!</h3>
            <p>Cảm ơn bạn đã mua sắm tại <b>Anh’s Fashion</b>.</p>
            <a href="index.php" class="btn btn-primary">Tiếp tục mua hàng</a>
            <a href="order-history.php" class="btn btn-info">Xem đơn hàng</a>
        </div>
    </div>

    <?php include("model/footer.php"); ?>
</body>

</html>