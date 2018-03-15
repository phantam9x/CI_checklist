			<div id="page-login" class="container">
		        <div class="card card-container">
		            <img id="profile-img" class="profile-img-card" src="<?=base_url(); echo empty($_COOKIE['use_avatar']) ? '/public/images/user.png' : $_COOKIE['use_avatar']?>" />
		            <form class="form-signin" method="POST">
		            	<a href="<?=$url_login_fb ?>" class="btn btn-block btn-social btn-facebook">
	            			<span class="fa fa-facebook"></span> Đăng nhập bằng Facebook
	          			</a>
	          			<span id="title"></span>
	          			 <?=form_error('login') ?>
		                <input type="text" id="inputEmail" class="form-control" value="<?=empty(set_value('user_name'))?get_cookie('use_name'):set_value('user_name') ?>" name="user_name" placeholder="Tên đăng nhập" required autofocus>
		                <?=form_error('user_name') ?>
		                <input type="password" class="form-control inputPassword" value="<?=empty(set_value('password'))?get_cookie('use_password'):set_value('password') ?>" name="password" placeholder="Mật khẩu" required>
		                <?=form_error('password') ?>
		                <div id="remember" class="checkbox" >
		                    <label>
		                        <input type="checkbox" value="true" <? if(!empty(get_cookie('use_name'))) echo 'checked' ?> name="remember_me"> Nhớ tài khoản
		                    </label>
		                </div>
		                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Đăng Nhập</button>
		            </form><!-- /form -->
		            <a href="#" class="forgot-password">
		                Quên mật khẩu?
		            </a>
		            <br  />
		            <a href="<?=base_url('/registration') ?>" class="forgot-password">
		                Tạo tài khoản
		            </a>
		        </div><!-- /card-container -->
		    </div>
		    <!-- /container -->
