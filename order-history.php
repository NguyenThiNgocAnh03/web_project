<?php
session_start();
if (!isset($_SESSION['id-user'])) {
    header("Location: user/login.php");
    exit();
}

require_once('model/connect.php');

$user_id = $_SESSION['id-user'];

$result = mysqli_query($conn, "
SELECT id, total, date_order, status
FROM orders
WHERE user_id = $user_id
ORDER BY date_order DESC
");
?>
<h2>Lịch sử mua hàng</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        Mua khóa học thành công!
    </div>
<?php endif; ?>

<table border="1" width="100%">
    <tr>
        <th>Mã đơn</th>
        <th>Ngày đặt</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Thao tác</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td>#<?= $row['id'] ?></td>
            <td><?= $row['date_order'] ?></td>
            <td><?= number_format($row['total']) ?> đ</td>
            <td>
                <?php
                $statusText = [
                    0 => 'Đã đặt hàng',
                    1 => 'Đang xử lý',
                    2 => 'Đang giao hàng',
                    3 => 'Đã nhận hàng',
                    4 => 'Đã hủy'
                ];
                echo $statusText[$row['status']];
                ?>
            </td>
            <td>
                <?php if ($row['status'] == 2): ?>
                    <form method="post" action="confirm-received.php">
                        <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                        <button>Đã nhận hàng</button>
                    </form>
                <?php endif; ?>
                <?php if ($row['status'] == 0 || $row['status'] == 1): ?>
                    <form method="post" action="cancel-order.php"
                        onsubmit="return confirm('Bạn có chắc muốn hủy đơn này?');">
                        <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                        <button style="color:red">Hủy đơn</button>
                    </form>
                <?php endif; ?>
                <a href="order-detail.php?id=<?= $row['id'] ?>">
                    <input type="button" value="Chi tiết">
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>