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
	            <form class="form-signin" method="POST">
          			<span id="title"> Đăng Ký Tài Khoản </span>
	                <input type="text" id="inputEmail" class="form-control" required name="fullname" value="<?=set_value("fullname") ?>" placeholder="Tên hiển thị" autofocus>
	                <?=form_error('fullname') ?>
	                <input type="text" id="inputEmail" class="form-control" required name="user_name" value="<?=set_value("user_name") ?>" placeholder="Tên đăng nhập" autofocus>
	                <?=form_error('user_name') ?>
	                <input type="password" class="inputPassword form-control" required value="<?=set_value("password") ?>" name="password" placeholder="Mật khẩu" >
	                <?=form_error('password') ?>
	                <input type="password" class="inputPassword form-control" required value="<?=set_value("confirm_password") ?>" name="confirm_password" placeholder="Xác nhận mật khẩu" >
	                <?=form_error('confirm_password') ?>
	                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Đăng Ký</button>
	            </form>
	            <a href="<?=base_url('/login') ?>" class="forgot-password"> Trở lại đăng nhập </a>
	        </div>
	    </div>
	</body>
</html>

