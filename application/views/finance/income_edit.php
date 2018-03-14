<div id="wp-content">
   <div class="row" style="margin-right: 0;margin-left: 0">
      <div class="col-md-12 ">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <span>Chỉnh sửa công việc</span>
            </div>
            <div class="panel-body" style="padding: 15px 0">
               <form method="POST" action="">
                  <div class="form-group clearfix">
                     <label class="col-md-3 control-label" for="source">Đến từ:</label>  
                     <div class="col-md-9">
                        <input id="source" name="source" type="text" value="<?=set_value('source') ?>" placeholder="Nhập vào nội dung" class="form-control input-md">
                        <?=form_error('source') ?>
                     </div>
                  </div>
                  <div class="form-group clearfix">
                     <label class="col-md-3 control-label" for="title">Gía trị:</label>  
                     <div class="col-md-9">
                        <div class="form-group">
                           <input id="title" name="value" type="number" min="1" value="<?=set_value('value') ?>" placeholder="Nhập vào giá trị nguồn thu nhập" class="form-control input-md">
                           <?=form_error('value') ?>
                        </div>
                        
                        <select class="form-control">
                           <option>Đơn vị Việt Nam đồng VNĐ</option>
                        </select>
                     </div>
                     
                  </div>
                  <div class="form-group clearfix">
                     <label class="col-md-3 control-label" for='type'>Loại:</label>  
                     <div class="col-md-9">
                        <?=form_dropdown('type' ,$this->config->item('income_type'), set_value('type'), "class='form-control' id='type'") ?>
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
   </div>
</div>