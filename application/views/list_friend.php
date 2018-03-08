list_user.php        <div id="wp-content" class="container">
            <div class="panel panel-primary">
                    <div class="bg-info">
                        <div id="tab" class="btn-group panel-heading" data-toggle="buttons-radio">
                              <a href="#info-user" class="btn btn-large btn-info active" data-toggle="tab">Thông tin tài khoản</a>
                              <a href="#list-friend" class="btn btn-large btn-info" data-toggle="tab">Danh sách bạn bè</a>
                        </div>
                    </div>

                                        
                    <div id="list-friend" class="page">
                        <div class=" panel-body">
                            <form action="/customers/" class="search pull-left" style="width: 300px">
                                <div class="input-group">
                                    <input type="text" class="form-control" value="" name="q" placeholder="Nhập tên hoặc code khách hàng ">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover" id="dev-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2</td>
                                        <td>Bob</td>
                                        <td>Loblaw</td>
                                        <td>boblahblah</td>
                                    </tr>
                                </tbody>
                            </table>
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
