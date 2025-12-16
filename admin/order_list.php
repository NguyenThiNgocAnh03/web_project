<?php
require_once('../model/connect.php');

$result = mysqli_query($conn, "
    SELECT id, fullname, phone, total, date_order, status
    FROM orders
    ORDER BY date_order DESC
");
?>

<h2>Quản lý đơn hàng</h2>

<table border="1" width="100%">
    <tr>
        <th>Mã đơn</th>
        <th>Khách hàng</th>
        <th>SĐT</th>
        <th>Tổng tiền</th>
        <th>Ngày đặt</th>
        <th>Trạng thái</th>
        <th>Cập nhật</th>
    </tr>

    <?php
    $statusText = [
        0 => 'Đã đặt hàng',
        1 => 'Đang xử lý',
        2 => 'Đang giao hàng',
        3 => 'Đã nhận hàng',
        4 => 'Đã hủy'
    ];

    while ($row = mysqli_fetch_assoc($result)):
    ?>
        <tr>
            <td>#<?= $row['id'] ?></td>
            <td><?= $row['fullname'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= number_format($row['total']) ?> đ</td>
            <td><?= $row['date_order'] ?></td>
            <td><?= $statusText[$row['status']] ?></td>
            <td>
                <form method="post" action="update_status.php">
                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                    <select name="status">
                        <option value="0">Đã đặt</option>
                        <option value="1">Đang xử lý</option>
                        <option value="2">Đang giao</option>
                        <option value="3">Đã nhận</option>
                        <option value="4">Hủy</option>
                    </select>
                    <button>Cập nhật</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>