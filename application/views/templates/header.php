            <div id="header" class="clearfix">
                <div id="wp-logo" class="fl_left bg-07">
                    <a href="" title="" id="logo" class="fl_left">
                        <img src="" alt="">
                    </a>
                    <div id="sidebar-toggler" class="fl_right">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
                <div id="action-user" class="fl_right">
                    <div id="dropdown-user" class="dropdown dropdown-extended fl_right">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div id="thumb-circle" class="fl_left">
                                <img src="<?=base_url(get_user_avatar()) ?>">
                            </div>
                            <h3 id="username" class="fl_right"><?=get_user_fullname() ?></h3>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?=base_url('/user/info') ?>" title="Thông tin cá nhân">Thông tin cá nhân</a></li>
                            <li><a href="http://folder.info/templates/admin/?page=login#" title="Thoát">Thoát</a></li>
                        </ul>
                    </div>
                </div>
            </div>