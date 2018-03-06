<!Doctype html>
<html>
	<head>
		<link href="<?=base_url() ?>/public/css/reset.css" rel="stylesheet">
		<link href="<?=base_url() ?>/public/css/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="<?=base_url() ?>/public/css/bootstrap/bootstrap.min.css" rel="stylesheet">
		<link href="<?=base_url() ?>/public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet">
		<link href="<?=base_url() ?>/public/css/bootstrap/bootstrap-social.css" rel="stylesheet">
		<link href="<?=base_url() ?>/public/css/style.css" rel="stylesheet">
		
		<script src="<?=base_url() ?>/public/js/jquery-3.2.1.min.js"></script>
		<script src="<?=base_url() ?>/public/js/bootstrap/bootstrap.min.js"></script>
		<script src="<?=base_url() ?>/public/js/app.js"></script>
	</head>
	<body>
		<div class="container">
	        <div class="card card-container">
	            <form class="form-signin">
          			<span id="title"> Đăng Ký Tài Khoản </span>
	                <input type="email" id="inputEmail" class="form-control" placeholder="Tên đăng nhập" required autofocus>
	                <input type="password" class="inputPassword form-control" placeholder="Mật khẩu" required>
	                <input type="password" class="inputPassword form-control" placeholder="Xác nhận mật khẩu" required>
	                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Đăng Ký</button>
	            </form>
	            <a href="#" class="forgot-password"> Trở lại đăng nhập </a>
	        </div>
	    </div>
	</body>
</html>

