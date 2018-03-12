<div id="wp-content">
   <div class="row" style="margin-right: 0;margin-left: 0">
      <div class="col-md-6 form-group">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <span>Thêm công việc cho ngày: <span style="text-decoration: underline;">
                <?
                  echo "$day-$mont-$year"; 
                ?>
                </span></span>
            </div>
            <div class="panel-body" style="padding: 15px 0">
               <form method="POST" action="">
                  <div class="form-group clearfix">
                     <label class="col-md-3 control-label" for="title">Tên đầu việc:</label>  
                     <div class="col-md-9">
                        <input id="title" name="title" type="text" value="<?=set_value('title') ?>" placeholder="Nhập vào tên đầu việc" class="form-control input-md">
                        <?=form_error('title') ?>
                     </div>
                  </div>
                  <div class="form-group clearfix" style="padding-bottom: 0">
                     <label class="col-md-3 control-label">Thời gian dự kiến:</label>  
                     <!-- <div class="col-md-9"> -->
                     <div class="col-md-4">
                        <input id="fullname" name="time_start" type="time" maxlength="4" value="<?=set_value('time_start') ?>" placeholder="Bắt đầu" class="form-control input-md">
                        <?=form_error('time_start') ?>
                     </div>
                     <div class="col-md-5">
                        <input id="fullname" name="time_stop" type="time" maxlength="4" value="<?=set_value('time_stop') ?>" placeholder="Kết thúc" class="form-control input-md">
                        <?=form_error('time_stop') ?>
                     </div>
                     <!-- </div> -->
                  </div>
                  <div class="form-group clearfix">
                     <label class="col-md-3 control-label" for='type'>Độ ưu tiên:</label>  
                     <div class="col-md-9">
                        <select class="form-control" id="type" name="type">
                           <option value="4">Không quan trọng, không khẩn cấp</option>
                           <option value="3">Không quan trọng, khẩn cấp</option>
                           <option value="2">Quan trọng, không khẩn cấp</option>
                           <option value="1">Quan trọng, khẩn cấp</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group clearfix">
                     <label class="col-md-3 control-label" for="note">Ghi chú:</label>  
                     <div class="col-md-9">
                        <textarea class="form-control" id="note" name="note" style="resize: none;" rows="5"><?=set_value('note') ?></textarea>
                     </div>
                  </div>
                  <div class="form-group clearfix">
                     <div class="text-center">
                        <button  class="btn btn-success btn-recreate">Xác nhận lưu</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-md-6 form-group">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <span>Danh sách công việc ngày: <span style="text-decoration: underline;">
                <?
                  echo "$day-$mont-$year"; 
                ?>
                </span></span>
            </div>
            <div class="panel-body" style="padding: 0">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th style="min-width: 130px">Thời gian</th>
                        <th style="min-width: 90px">Trạng thái</th>
                        <th>Note</th>
                        <th style="min-width: 73px">Tác vụ</th>
                     </tr>
                  </thead>
                  <tbody>
                    <?$stt = 1 ; foreach($list_work as $item) {?>
                     <tr class="<?=$item['wor_type'] ?>">
                        <td class="text-center"><?=$stt ?></td>
                        <td>
                          <a href=""><?=$item['wor_title'] ?></a>
                        </td>
                        <td><?=$item['wor_time_start'].' - '.$item['wor_time_stop'] ?></td>
                        <td><?=$item['wor_status'] ?></td>
                        <td>
                          <? if(!empty($item['wor_note'])) { ?>
                          <div class="fa fa-eye text-center wp-option">
                            <div class="content-hide"><?=$item['wor_note'] ?></div>
                          </div>
                          <? } ?>
                        </td>
                        <td class="text-center">
                          <a href="<?=base_url("/work/delete/{$item['wor_id']}") ?>"><span class="fa fa-trash"></span> |</a>
                          <a href="<?=base_url("/work/edit/{$item['wor_id']}") ?>"><span class="fa fa-edit"></span> |</a>
                          <div class="wp-option">
                            <span class="fa fa-cog icon"></span>
                            <div class="option">
                              <a href="<?=base_url("/work/option/yes/{$item['wor_id']}") ?>">Hoàn thành</a>
                              <a href="<?=base_url("/work/option/no/{$item['wor_id']}") ?>">Không làm</a>
                              <a href="<?=base_url("/work/option/pending/{$item['wor_id']}") ?>">Chưa làm</a>
                              <a href="<?=base_url("/work/option/active/{$item['wor_id']}") ?>">Đang làm</a>
                            </div>
                          </div>
                        </td>
                     </tr>
                     <? $stt++ ; } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>