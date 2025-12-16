<?php
require_once('../model/header.php');
require_once('../model/connect.php');
error_reporting(2);

// Thông báo
if (isset($_GET['ps'])) {
    echo "<script>alert('Bạn đã xóa sản phẩm thành công!');</script>";
}
if (isset($_GET['pf'])) {
    echo "<script>alert('Không thể xóa sản phẩm!');</script>";
}

if (isset($_GET['addps'])) {
    echo "<script>alert('Bạn đã thêm sản phẩm thành công!');</script>";
}
if (isset($_GET['addpf'])) {
    echo "<script>alert('Thêm sản phẩm thất bại!');</script>";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<body>
    <!-- page content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách sản phẩm</h1>
                </div>

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Mã danh mục</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Giảm giá</th>
                            <th>Chỉnh sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // Lấy dữ liệu sản phẩm bằng PDO
                        $sql = "SELECT * FROM products ORDER BY id DESC";

                        try {
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            $rows = [];
                        }

                        if (!empty($rows)) {
                            foreach ($rows as $row) {

                                // Ảnh thumb
                                $thumbImage = (!empty($row['image'])) ? "../" . $row['image'] : "";
                        ?>
                                <tr class="odd gradeX" align="center">
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['category_id']; ?></td>
                                    <td>
                                        <img src="<?php echo str_replace('../', '', $thumbImage); ?>" width="100" height="100">
                                    </td>
                                    <td><?= $row['price']; ?></td>
                                    <td><?= $row['saleprice']; ?></td>

                                    <td class="center">
                                        <a href="product-edit.php?idProduct=<?= $row['id']; ?>">
                                            <i class="fa fa-pencil fa-lg" title="Chỉnh sửa"><button>Chỉnh sửa</button></i>
                                        </a>
                                    </td>

                                    <td class="center">
                                        <a href="product-delete.php?idProducts=<?= $row['id']; ?>">
                                            <i class="fa fa-trash-o fa-lg" title="Xóa"><button>Xóa</button></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>