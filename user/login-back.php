
<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
require_once('../model/connect.php');

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    /* ================== 1️⃣ KIỂM TRA ADMIN ================== */
    $sqlAdmin = "SELECT * FROM admin 
                 WHERE username='$username' 
                 AND password='$password'"; // admin KHÔNG md5

    $rsAdmin = mysqli_query($conn, $sqlAdmin);

    if (mysqli_num_rows($rsAdmin) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: ../admin/product-list.php");
        exit();
    }

    /* ================== 2️⃣ KIỂM TRA USER ================== */
    $sqlUser = "SELECT * FROM users 
                WHERE username='$username' 
                AND password=md5('$password')";

    $rsUser = mysqli_query($conn, $sqlUser);

    if (mysqli_num_rows($rsUser) > 0) {
        $_SESSION['username'] = $username;

        $row = mysqli_fetch_assoc($rsUser);
        $_SESSION['id-user'] = $row['id'];

        header("Location: ../index.php?ls=1");
        exit();
    }

    /* ================== 3️⃣ SAI HẾT ================== */
    $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không hợp lệ!';
    header("Location: ../user/login.php?error=wrong");
    exit();
}
?>