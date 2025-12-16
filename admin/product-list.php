<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./dist/css/sb-admin-2.css">
    <link rel="stylesheet" href="./dist/css/timeline.css">
    <link rel="stylesheet" href="./dist/js/sb-admin-2.js">
</head>

<body>
    <?php
    // include 'header.php';
    require_once('../model/header.php');
    // require_once("../model/connect.php");
    require_once('../model/connect.php');
    error_reporting(2);


    // Xóa sản phẩm
    if (isset($_GET['ps'])) {
        echo "<script type=\"text/javascript\">
alert(\"Bạn đã xóa sản phẩm thành công!\");
</script>";
    }
    if (isset($_GET['pf'])) {
        echo "<script type=\"text/javascript\">
alert(\"Không thể xóa sản phẩm!\");
</script>";
    }

    // Thêm sản phẩm
    if (isset($_GET['addps'])) {
        echo "<script type=\"text/javascript\">
alert(\"Bạn đã thêm sản phẩm thành công!\");
</script>";
    }
    if (isset($_GET['addpf'])) {
        echo "<script type=\"text/javascript\">
alert(\"Thêm sản phẩm thất bại!\");
</script>";
    }
    ?>

    <!-- page content -->
    <div id=" page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="product-list.php">Danh sách sản phẩm </a>
                        </li>
                        <li><a href="update_status.php">Quản lý đơn hàng </a>
                        </li>
                    </ul>
                </div>
                <table class=" table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th> STT </th>
                            <th> Tên sản phẩm </th>
                            <th> Mã danh mục </th>
                            <th> Hình ảnh </th>
                            <th> Giá </th>
                            <th> Giảm giá </th>
                            <th> Chỉnh sửa </th>
                            <th> Xóa </th>
                            <th>Thêm sản phẩm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM products ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['image'] == null || $row['image'] == '') {
                                    $thumbImage = "";
                                } else {
                                    $thumbImage = "../" . $row['image'];
                                }
                        ?>
                                <tr class="odd gradeX" align="center">
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['category_id']; ?></td>
                                    <td>
                                        <img src="<?php echo $thumbImage; ?>" width="100px" ; height="100px" ;>
                                    </td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['saleprice']; ?></td>

                                    <td class="center">
                                        <p><a href="product-edit.php?idProduct=<?php echo $row['id']; ?>"><i
                                                    class="fa fa-pencil fa-lg" title="Chỉnh sửa">
                                                </i><button> Chỉnh sửa</button></a>
                                        </p>
                                    </td>

                                    <td class="center">
                                        <p><a href="product-delete.php?idProducts=<?php echo $row['id']; ?>"><i
                                                    class="fa fa-trash-o fa-lg" title="Xóa"></i><button> Xóa</button></a>
                                        </p>
                                    </td>
                                    <td class="center">
                                        <p><a href="product-add.php"><i class="fa fa-plus fa-lg" title="Thêm sản phẩm">
                                                </i><button> Thêm sản phẩm</button></a>
                                        </p>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /#page-wrapper -->
</body>

</html>