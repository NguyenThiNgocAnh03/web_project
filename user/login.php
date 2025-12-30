<?php
session_start();
require_once('../model/connect.php');

if (isset($_GET['error'])) {
	$error = "Vui lòng kiểm tra lại tài khoản hoặc mật khẩu của bạn!";
} else {
	$error = "";
}

if (isset($_GET['rs'])) {
	echo "<script type=\"text/javascript\">alert(\"Bạn đã đăng ký thành công!\");</script>";
	echo "<script type=\"text/javascript\">alert(\"Vui lòng đăng nhập để mua hàng!\");</script>";
}
if (isset($_GET['rf'])) {
	echo "<script type=\"text/javascript\">alert(\"Đăng ký thất bại!\");</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Anh's courses</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="images/logohong.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>
	<script src='../js/wow.js'></script>
	<script type="text/javascript" src="../js/mylishop.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
	<!-- header -->
	<header>
		<div class="container-fluid header_top wow bounceIn" data-wow-delay="0.1s">
			<div class="col-sm-10 col-md-10">
				<div class="header_top_left"> <span><i class="fa fa-phone"></i></span> <span>01697 450 200 | 0926 055 983</span>&nbsp;&nbsp;&nbsp; <span><i class="fa fa-envelope-o" aria-hidden="true"></i></span> <span>admin@mylishop.com.vn</span> </div>
			</div>
			<div class="col-sm-2 col-md-2">
				<div class="header_top_right">
					<a href="https://www.facebook.com/" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a>
					<a href="https://twitter.com/" target="_blank" title="twitter"><i class="fa fa-twitter"></i></a>
					<a href="https://www.rss.com/" target="_blank" title="rss"><i class="fa fa-rss"></i></a>
					<a href="https://www.youtube.com/" target="_blank" title="youtube"><i class="fa fa-youtube"></i></a>
					<a href="https://plus.google.com/" target="_blank" title="google"><i class="fa fa-google-plus"></i></a>
					<a href="https://linkedin.com/" target="_blank" title="linkedin"><i class="fa fa-linkedin"></i></a>
				</div>
			</div>
			<div class="clear-fix"></div>
		</div>
		<!-- /header-top -->
		<!-- Menu ngang header -->
		<div class="container">
			<!-- Logo -->
			<div class="title">
				<a href="../index.php" title="Anh's Courses"> <img src="../images/logo.png" width="260px;" height="180px;"> </a>
			</div>
			<!-- /logo -->
		</div>
	</header>
	<!-- /header -->

	<div class="container" style="margin-top: 40px;">
		<div class="row">
			<!-- col-md-offset-4: Di chuyển cột sang bên phải -->
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<center>
							<h4><strong> ĐĂNG NHẬP VÀO TÀI KHOẢN </strong></h4>
						</center>
						<p style="color: red; font-weight: bold;">
							<?php echo $error; ?>
						</p>


					</div><!-- /panel-heading -->

					<div class="panel-body">
						<form action="login-back.php" method="post" name="form-login" accept-charset="utf-8">
							<div class="row">
								<div class="col-sm-12 col-md-10 col-md-offset-1">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user fa-lg"></i></span>
											<input type="text" name="username" class="form-control" placeholder="Tên đăng nhập của bạn" required />
										</div>
									</div><!-- /form-group -->

									<div class="form-group">
										<div class="input-form">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-lock fa-lg"></i></span>
												<input type="password" name="password" class="form-control" placeholder="Mật khẩu của bạn" required />
											</div>
										</div>
									</div><!-- /form-group -->

									<div class="form-group">
										<input type="submit" name="submit" class="btn btn-info btn-block btn-lg" value="Đăng nhập">
									</div><!-- /form-group -->
								</div><!-- /col -->
							</div><!-- /row -->
						</form>
					</div><!-- /panel-body -->

					<div class="panel-footer">
						<p>Nếu bạn chưa có tài khoản. Vui lòng <a href="register.php" onclick=""> Đăng ký </a></p>
					</div><!-- /panel-footer -->

				</div><!-- /panel-danger -->
			</div><!-- /col -->
		</div><!-- /row -->
	</div><!-- /container -->

</body>

</html>