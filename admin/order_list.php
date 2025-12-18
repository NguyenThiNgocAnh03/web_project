<?php
require_once('../model/connect.php');

$result = mysqli_query($conn, "
    SELECT id, fullname, phone, total, date_order, status
    FROM orders
    ORDER BY date_order DESC
");

$statusText = [
    0 => 'Đã đặt hàng',
    1 => 'Đang xử lý',
    2 => 'Đang giao hàng',
    3 => 'Đã nhận hàng',
    4 => 'Đã hủy'
];

$statusClass = [
    0 => 'label label-default',
    1 => 'label label-info',
    2 => 'label label-warning',
    3 => 'label label-success',
    4 => 'label label-danger'
];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng</title>

    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
        .table td {
            vertical-align: middle !important;
        }

        select {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center">QUẢN LÝ ĐƠN HÀNG</h2>
        <hr>

        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr class="info">
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>SĐT</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Cập nhật</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>#<?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['fullname']) ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= number_format($row['total']) ?> đ</td>
                        <td><?= $row['date_order'] ?></td>

                        <td>
                            <span class="<?= $statusClass[$row['status']] ?>">
                                <?= $statusText[$row['status']] ?>
                            </span>
                        </td>

                        <td>
                            <form method="post" action="update_status.php" class="form-inline">
                                <input type="hidden" name="order_id" value="<?= $row['id'] ?>">

                                <select name="status" class="form-control input-sm">
                                    <?php foreach ($statusText as $key => $text): ?>
                                        <option value="<?= $key ?>"
                                            <?= ($row['status'] == $key) ? 'selected' : '' ?>>
                                            <?= $text ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <button class="btn btn-primary btn-sm">
                                    Cập nhật
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>