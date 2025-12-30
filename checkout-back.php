<?php
session_start();
require_once('model/connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['id-user'])) {
    header("Location: user/login.php");
    exit();
}

// Kiểm tra giỏ hàng
if (empty($_SESSION['cart'])) {
    header("Location: view-cart.php");
    exit();
}

// Lấy dữ liệu từ form
$name    = mysqli_real_escape_string($conn, $_POST['fullname']);
$phone   = mysqli_real_escape_string($conn, $_POST['phone']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$note    = mysqli_real_escape_string($conn, $_POST['note']);
$payment = mysqli_real_escape_string($conn, $_POST['payment_method']);
$user_id = $_SESSION['id-user'];

// Lấy email user
$user = mysqli_query($conn, "SELECT email FROM users WHERE id = $user_id");
$row  = mysqli_fetch_assoc($user);
$email = $row['email'] ?? '';

// Tính tổng tiền
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['qty'];
}

// Lưu đơn hàng
$stmt = $conn->prepare("INSERT INTO orders 
    (total, date_order, status, user_id, fullname, phone, address, payment_method, note)
    VALUES (?, NOW(), 0, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("disssss", $total, $user_id, $name, $phone, $address, $payment, $note);
$stmt->execute();

$order_id = $stmt->insert_id;
$stmt->close();

// Lưu chi tiết đơn hàng
$stmt2 = $conn->prepare("INSERT INTO product_order (product_id, order_id, quantity) VALUES (?, ?, ?)");
foreach ($_SESSION['cart'] as $item) {
    $pid = $item['id'];
    $qty = $item['qty'];
    $stmt2->bind_param("iii", $pid, $order_id, $qty);
    $stmt2->execute();
}
$stmt2->close();

// Gửi email xác nhận đơn hàng
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ngocanhqb123end@gmail.com';
    $mail->Password   = 'bcox uaxi ntpv txri'; // mật khẩu ứng dụng
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    $mail->setFrom('ngocanhqb123end@gmail.com', 'Anhs Courses');
    $mail->addAddress($email, $name);

    $mail->isHTML(true);
    $mail->Subject = "Confirm order #$order_id";

    $body = "<h3>Đặt hàng thành công!</h3>
        <p><b>Mã đơn:</b> $order_id</p>
        <p><b>Khách hàng:</b> $name</p>
        <p><b>SĐT:</b> $phone</p>
        <p><b>Địa chỉ:</b> $address</p>
         <h4>Chi tiết sản phẩm:</h4>
        <table border='1' cellpadding='5' cellspacing='0'>
            <tr>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>";

    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['qty'];
        $body .= "<tr>
            <td><img src='{$item['image']}' width='60' height='60'></td>
            <td>{$item['name']}</td>
            <td>" . number_format($item['price']) . " đ</td>
            <td>{$item['qty']}</td>
            <td>" . number_format($subtotal) . " đ</td>
        </tr>";
    }

    $body .= "</table>
        <p><b>Tổng tiền:</b> " . number_format($total) . " đ</p>
        <p>Cảm ơn bạn đã mua hàng!</p>";

    $mail->Body = $body;
    $mail->send();
} catch (Exception $e) {
    // Nếu gửi mail lỗi vẫn tiếp tục
    error_log("Mail error: {$mail->ErrorInfo}");
}



// Xóa giỏ hàng
unset($_SESSION['cart']);

// Chuyển hướng sang trang thành công
header("Location: checkout-success.php");
exit();
