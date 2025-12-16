<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>

<h2>Giỏ hàng</h2>

<?php if (empty($cart)) { ?>
    <p>Giỏ hàng đang trống.</p>
<?php } else { ?>

    <table class="table table-bordered">
        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Xóa</th>
        </tr>

        <?php foreach ($cart as $item):
            $sub = $item['price'] * $item['qty'];
            $total += $sub;
        ?>
            <tr>
                <td>
                    <img src="<?= $item['image'] ?>" width="80">
                </td>

                <td><?= $item['name'] ?></td>

                <td><?= number_format($item['price']) ?> đ</td>

                <td style="text-align:center">
                    <a href="update-cart.php?id=<?= $item['id'] ?>&type=minus"
                        class="btn btn-xs btn-danger">−</a>

                    <strong style="padding:0 10px;">
                        <?= $item['qty'] ?>
                    </strong>

                    <a href="update-cart.php?id=<?= $item['id'] ?>&type=plus"
                        class="btn btn-xs btn-success">+</a>
                </td>

                <td><?= number_format($sub) ?> đ</td>

                <td>
                <td>
                    <a href="remove-cart.php?id=<?= $item['id'] ?>"
                        onclick="return confirm('Xóa sản phẩm này?');"
                        class="btn btn-xs btn-danger">
                        Xóa
                    </a>
                </td>

                </td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="4"><b>Tổng cộng</b></td>
            <td colspan="2"><b><?= number_format($total) ?> đ</b></td>
        </tr>
    </table>

    <a href="checkout.php" class="btn btn-success">
        <input type="button" value="Đặt hàng">
    </a>
    <a href="index.php" class="btn btn-primary">
        <input type="button" value="Trang chủ ">
    <?php } ?>