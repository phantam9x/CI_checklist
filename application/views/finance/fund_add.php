<div id="wp-content">
   <div class="row" style="margin-right: 0;margin-left: 0">
      <div class="col-md-5 form-group">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <span>Thêm quỹ chi tiêu từ: 
               	<? 
               		$month = date('m',time()); 
               		$new_month = $month+1; 
               		$year = date('Y',time()); 
               	?>
	               	<span style="text-decoration: underline;">
	               		<? echo "{$day}-{$month} - {$day}-{$new_month}-{$year}"; ?>
	               	</span>
               </span>
            </div>
            <div class="panel-body" style="padding: 15px 0">
               <form method="POST" action="">
                  <div class="form-group clearfix">
                     <label class="col-md-3 control-label" for="title">Tên quỹ:</label>  
                     <div class="col-md-9">
                        <input id="title" name="title" type="text" value="<?=set_value('title') ?>" placeholder="Nhập vào tên quỹ" class="form-control input-md">
                        <?=form_error('title') ?>
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
      <div class="col-md-7 form-group">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <span>Danh sách quỹ chi tiêu từ: 
               	<span style="text-decoration: underline;">
               		<? echo "{$day}-{$month} - {$day}-{$new_month}-{$year}"; ?>
               	</span>
               </span>
            </div>
            <div class="panel-body" style="padding: 0">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>STT</th>
                        <th>Tên quỹ</th>
                        <th style="min-width: 130px">Số tiền</th>
                        <th style="min-width: 90px">Tạo lúc</th>
                        <th>Note</th>
                        <th style="min-width: 73px">Tác vụ</th>
                     </tr>
                  </thead>
                  <tbody>
                  	<? 
                  		if(!empty($list_fund)) { 
                  			$total_money = $stt = 0;
                  			foreach ($list_fund as $item) {
                  				$stt++;
                  				$total_money += $item['fun_value'];
                  	?>
                     <tr>
                        <td class="text-center"><?=$stt ?></td>
                        <td>
                          <a href=""><?=$item['fun_title'] ?></a>
                        </td>
                        <td><?=number_format($item['fun_value']).'đ' ?></td>
                        <td><?=$item['fun_created_at'] ?></td>
                        <td>
                       	<? if(!empty($item['fun_note'])) { ?>
                          <div class="fa fa-eye text-center wp-option">
                            <div class="content-hide"><?=$item['fun_note'] ?></div>
                          </div>
                          <? } ?>
                        </td>
                        <td class="text-center">
                          <a href="<?=base_url("/income/delete/{$item['fun_id']}") ?>"><span class="fa fa-trash"></span> |</a>
                          <a href="<?=base_url("/income/edit/{$item['fun_id']}") ?>"><span class="fa fa-edit"></span> |</a>
                        </td>
                     </tr>
                     <? } }?>
                    </tbody>
               </table>
            
            <div class="form-group help-block clearfix bg-danger"><? if(isset($total_money)) { ?>
            	<span class="col-md-7">Tổng quỹ: </span>
            	<span class="col-md-5 text-right"><? echo number_format($total_money).'đ' ;} ?></span>
            </div></div>
         </div>
      </div>
   </div>
</div>