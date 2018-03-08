        <div id="wp-content" class="container">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span>Thông tin tài khoản</span>
                    </div>
                    <div id="info-user" class="page active">
                        <div class="row">
                            <div class="col-md-4 avatar">
                                <span class="text-uppercase"><span class="text-danger">ID:</span> <?=$info['use_id'] ?></span>
                                <span class="pull-right text-uppercase"><span class="text-danger">ID-FB:</span> <?=$info['use_id_fb'] ?></span>
                                <div class="wp-img">    
                                    <img src="<?=base_url(); echo $info['use_avatar'] ?? '/public/images/user.png' ?>">
                                   
                                </div>
                                <p class="result"></p>
                                <span class="progress">
                                    <span class="value">0%</span>
                                    <span class="progress-bar"></span>
                                </span>
                                <form id="form-upload" action="<?=base_url('/user/upload-avatar') ?>" enctype="multipart/form-data" method="POST">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <button id="fake-file-button-browse" type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-file"></span>
                                        </button>
                                        </span>
                                        <input type="file" id="files-input-upload" name="img_file" style="display:none">
                                        <input type="text" id="fake-file-input-name" disabled="disabled" placeholder="Thay ảnh đại diện" class="form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" disabled="disabled" id="fake-file-button-upload">
                                                <span class="glyphicon glyphicon-upload"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                </form>
                                <form method="POST" action="<?=base_url('/user/updated') ?>">
                                    <div class="col-md-8" style="margin-bottom: 15px">
                                            <div class="form-group">
                                              <label class="col-md-3 control-label" for="fullname">Tên hiển thị:</label>  
                                              <div class="col-md-9">
                                                <input id="fullname" name="fullname" type="text" value="<?=set_value('fullname')??$info['use_fullname'] ?>" placeholder="Nhập vào tên mới" class="form-control input-md">
                                                 <?=form_error('fullname') ?>
                                              </div>
                                              
                                            </div>
                                    </div>
                                    <div class="text-center">
                                        <button  class="btn btn-success btn-recreate">Cập nhật thông tin</button>
                                    </div>
                                </form>
                            </div>
                        </div>
    </div>
        <div class="text-center">
                <ul class="pagination">
                  <li class="disabled"><a href="#">«</a></li>
                  <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">»</a></li>
                </ul>
            </div>
    </div>
