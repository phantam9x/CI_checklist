<div id="wp-content">
   <div class="row">
      <div class="col-md-4">
         <div class="panel panel-default">
            <div class="zabuto_calendar">
               <input type="hidden" name="year" value="<?=$year ?>">
               <input type="hidden" name="month" value="<?=$month ?>">
               <input type="hidden" name="base_url" value="<?=base_url() ?>">
               <table class="table">
                  <tbody>
                     <tr class="calendar-month-header">
                        <th>
                           <div class="month-back">
                              <span class="glyphicon glyphicon-chevron-left"></span>
                           </div>
                        </th>
                        <th colspan="5"><span>Tháng <?=$month.'-'.$year ?></span></th>
                        <th>
                           <div class="month-next">
                              <span class="glyphicon glyphicon-chevron-right"></span>
                           </div>
                        </th>
                     </tr>
                     <tr class="calendar-dow-header">
                        <th>Thứ 2</th>
                        <th>Thứ 3</th>
                        <th>Thứ 4</th>
                        <th>Thứ 5</th>
                        <th>Thứ 6</th>
                        <th>Thứ 7</th>
                        <th>CN</th>
                     </tr>
                     <?
                        $day     = 1;
                        $x       = 7;
                        $y       = 1;
                        $work_time = "{$year}-{$month}-{$day}";
                        $stuff   = date('w', strtotime($work_time));
                        if($stuff == 0) $stuff = 8;
                        else $stuff++;
                        $show_element_fake = function($stop) {
                           $stop -= 2;
                           for($i=0;$i<$stop;$i++) {
                              echo '<td><span class="day-fake"></span></td>';
                           }
                           return $stop;
                        };
                        for($i= 0;$i<$y;$i++) {
                     ?>
                        <tr class="calendar-dow">
                           <? 
                              if($stuff != 0) {
                                 $x -= $show_element_fake($stuff);
                                 $stuff = 0;
                              } else $x = 7;
                              for($f=0;$f<$x;$f++) {
                                 
                           ?>
                              <td class="<?if($today==$day) echo 'active'; ?>">
                                 <a  class="day"href="<?=base_url("/work/?d={$day}&m={$month}&y={$year}") ?>"><?=$day ?></a>
                              </td>
                           <?   
                              $day++;
                              if(!checkdate($month, $day, $year)) {
                                 echo '</tr>';
                                 break;  
                              }
                           }
                           ?>
                        </tr>   
                     <?     
                     if(!checkdate($month, $day, $year)) break;  
                     $y++;
                           }
                     ?>
                     
                     
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="col-md-8">
                  <div class="panel panel-primary">
            <div class="panel-heading">
               <span>Danh sách công việc ngày: <span style="text-decoration: underline;">
                <?
                  echo $today.'-'.$month.'-'.$year; 
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
                        <th class="text-center">Note</th>
                        <th class="text-center" style="min-width: 73px">Tác vụ</th>
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
               <? if($today>=date('d',time())&&$month==date('m',time())&&$year==date('Y',time())) { ?>
               <div class="help-block text-center">
                  <a href="<?=base_url("/work/add/{$today}-{$month}-{$year}") ?>" class="btn btn-success">Thêm công việc</a>
               </div>
               <? } ?>
            </div>
         </div>
      </div>
   </div>
</div>