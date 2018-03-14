<div class="container">
   <div class="row" style="margin-right: 0;margin-left: 0">
      <div class="col-md-12 ">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <span>Chỉnh sửa công việc</span>
            </div>
            <div class="panel-body" style="padding: 15px 0">
               <form method="POST" action="">
               	    <div class="form-group clearfix">
                     <label class="col-md-3 control-label" for="title">Được tạo lúc:</label>  
                     <div class="col-md-9">
                        <?= date('H:m - d-m-Y', set_value('created_at')) ?>
                     </div>
                  </div>
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
                     	<?	
                     		$list_option = [
                     			'1'=> 'Quan trọng, khẩn cấp',
                     			'2'=> 'Quan trọng, không khẩn cấp',
                     			'3'=> 'Không quan trọng, khẩn cấp',
                     			'4'=> 'Không quan trọng, không khẩn cấp',
                     		];
                     		echo form_dropdown('type',$list_option,set_value('type'),'class="form-control"  id="type"') ?>
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
                        <button  class="btn btn-success btn-recreate">Lưu thông tin</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>