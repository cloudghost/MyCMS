<?php
$username = $_SESSION["user"]["cName"];
set_title("$username | 时间表 |");
get_header();
get_sidebar("cms");
?>
  <!-- content start -->
  <div class="admin-content">

    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">课程表</strong> / <small>Timetable</small></div>
    </div>
    <div class="am-g">
      <div class="am-u-md-12 am-scrollable-horizontal am-show-sm-only"> <!-- am-show-md-up"> -->
          <table class="am-table am-table-bordered am-table-striped am-table-compact am-text-sm">
            <thead>
              <tr>
                <th>周一</th><th>周二</th><th>周三</th><th>周四</th><th>周五</th>
              </tr>
          </thead>
          <tbody>
                        <?php $timeperiod=array(
                            '','8:00-8:40','8:40-9:20','9:30-10:10','10:10-10:50','11:10-11:50','11:50-12:30','13:30-14:10','14:10-14:50','15:00-15:40','15:40-16:20','16:30-17:30'
                        );?>
                        <?php $weekarr=array(
                            '','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'
                        );?>
                        <?php $timetable=cache::getCache('timetable');?>
                        <?php for($i=1;$i<=10;++$i){?>
                            <tr>
                                <?php for($a=1;$a<=5;++$a){?>
                                <td><?php 
                                $string= isset($timetable[$weekarr[$a]]['P'.$i])?$timetable[$weekarr[$a]]['P'.$i]:'&nbsp'; 
                                if(isset($timetable[$weekarr[$a]]['P'.($i+1)])&&$string==$timetable[$weekarr[$a]]['P'.($i+1)]){
                                  preg_match("/[(]\S*[)]/", $timetable[$weekarr[$a]]['P'.($i+1)],$room);
                                  $timetable[$weekarr[$a]]['P'.($i+1)]=$room[0];
                                  echo pregReplaceClass($string);
                                }else{
                                  echo pregModifyClass($string);
                                }
                                ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
        </table>
        <td class="am-hide-sm-only"><?=$timeperiod[$i];?></td>
        <span class="am-badge am-badge-success am-text-sm">你一周要上 <?=get_course_count($timetable);?> 节课</span>
      </div>
      <div class="am-u-md-12 am-scrollable-horizontal am-show-md-up"> <!-- am-show-md-up"> -->
          <table class="am-table am-table-bordered am-table-striped am-table-compact am-text-sm">
            <thead>
              <tr>
                <th class="table-author">时间\星期</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th>
              </tr>
          </thead>
          <tbody>
                        <?php $timeperiod=array(
                            '','8:00-8:40','8:40-9:20','9:30-10:10','10:10-10:50','11:10-11:50','11:50-12:30','13:30-14:10','14:10-14:50','15:00-15:40','15:40-16:20','16:30-17:30'
                        );?>
                        <?php $weekarr=array(
                            '','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'
                        );?>
                        <?php $timetable=cache::getCache('timetable');?>
                        <?php for($i=1;$i<=10;++$i){?>
                            <tr>
                              <td><?=$timeperiod[$i]?></td>
                                <?php for($a=1;$a<=5;++$a){?>
                                <td><?= isset($timetable[$weekarr[$a]]['P'.$i])?$timetable[$weekarr[$a]]['P'.$i]:'&nbsp'; ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
        </table>
        <td class="am-hide-sm-only"><?=$timeperiod[$i];?></td>
        <th class="table-author am-hide-sm-only">时间\星期</th>
        <span class="am-badge am-badge-success am-text-sm">你一周要上 <?=get_course_count($timetable);?> 节课</span>
      </div>

    </div>

  </div>
</div>
  <!-- content end -->

<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<?php get_footer(); ?>