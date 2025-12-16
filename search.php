<?php
session_start();
require_once('model/connect.php');

/* ===== LẤY DỮ LIỆU ===== */
$search = isset($_POST['search']) ? trim($_POST['search']) : '';
$min    = isset($_POST['min_price']) ? (int)$_POST['min_price'] : 0;
$max    = isset($_POST['max_price']) ? (int)$_POST['max_price'] : 0;

/* ===== SQL ===== */
$sql = "SELECT id, name, image, price FROM products WHERE 1=1";

if ($search != '') {
    $search = mysqli_real_escape_string($conn, $search);
    $sql .= " AND name LIKE '%$search%'";
}

if ($min > 0) {
    $sql .= " AND price >= $min";
}

if ($max > 0) {
    $sql .= " AND price <= $max";
}

$result = mysqli_query($conn, $sql);
$total  = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tìm & lọc sản phẩm</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <?php include("model/header.php"); ?>

    <div class="container">
        <h3>KẾT QUẢ SẢN PHẨM</h3>
        <p>Có <b><?= $total ?></b> sản phẩm</p>

        <!-- ===== FORM ===== -->
        <form method="POST" class="row" style="margin-bottom:20px">

            <div class="col-md-4">
                <input type="text"
                    name="search"
                    value="<?= htmlspecialchars($search) ?>"
                    class="form-control"
                    placeholder="Tên sản phẩm">
            </div>

            <div class="col-md-3">
                <input type="number"
                    name="min_price"
                    value="<?= $min ?>"
                    class="form-control"
                    placeholder="Giá từ">
            </div>

            <div class="col-md-3">
                <input type="number"
                    name="max_price"
                    value="<?= $max ?>"
                    class="form-control"
                    placeholder="Giá đến">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary btn-block">
                    Lọc
                </button>
            </div>

        </form>

        <!-- ===== DANH SÁCH ===== -->
        <div class="row">
            <?php if ($total > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-3">
                        <div class="thumbnail text-center">
                            <img src="<?= $row['image'] ?>" class="img-responsive">
                            <div class="caption">
                                <h5><?= $row['name'] ?></h5>
                                <p><?= number_format($row['price']) ?> đ</p>
                                <a href="detail.php?id=<?= $row['id'] ?>"
                                    class="btn btn-info btn-sm">
                                    Chi tiết
                                </a>
                                <a href="add-cart.php?id=<?= $row['id'] ?>"
                                    class="btn btn-success btn-sm">
                                    Thêm vào giỏ
                                </a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <p style="color:red;font-weight:bold">
                    Không có sản phẩm phù hợp
                </p>
            <?php } ?>
        </div>

    </div>

    <?php include("model/footer.php"); ?>

</body>

</html>