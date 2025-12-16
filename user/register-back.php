<?php
require_once '../model/connect.php'; // kết nối database

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // dùng MD5
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $address  = $_POST['address'];

    // Kiểm tra username hoặc email đã tồn tại chưa
    $check = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
    $check->bind_param("ss", $username, $email);
    $check->execute();
    $check->store_result();


    // Lưu thông tin user vào database
    $stmt = $conn->prepare("INSERT INTO users (fullname, username, password, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullname, $username, $password, $email, $phone, $address);

    if ($stmt->execute()) {
        // Gửi mail chào mừng
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ngocanhqb123end@gmail.com'; // đổi thành email của bạn
            $mail->Password   = 'bcox uaxi ntpv txri';        // app password Gmail
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('ngocanhqb123end@gmail.com', 'Anhs Fashion');
            $mail->addAddress($email, $username);

            $mail->isHTML(true);
            $mail->Subject = 'Welcome to Anhs Fashion';
            $mail->Body = "
                <h3>Xin chào <b>$username</b>,</h3>
                <p>Bạn đã đăng ký tài khoản thành công tại <b>Anhs Fashion</b>.</p>
                <p>Bạn có thể đăng nhập và trải nghiệm mua sắm ngay bây giờ.</p>
            ";

            $mail->send();
            header('location:../index.php');
            exit();
        } catch (Exception $e) {
            echo "Đăng ký thành công, nhưng không gửi được mail: {$mail->ErrorInfo}";
        }
    } else {
        echo "Lỗi lưu dữ liệu: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
