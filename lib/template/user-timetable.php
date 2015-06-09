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
      <div class="am-u-md-12 am-show-md-up">
      <?php show_message(); ?>
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                </th><th>时间\星期</th><th class="table-author am-hide-sm-only">星期一</th><th>星期二</th><th>星期三</th><th>星期四</th><th>星期五</th>
              </tr>
          </thead>
          <tbody>
            <tr>
			  <td class="am-hide-sm-only">08:00-08:40</td>
              <td><?php get_course_name_manual(0,1);?></td>
			  <td><?php get_course_name_manual(1,1);?></td>
			  <td><?php get_course_name_manual(2,1);?></td>
			  <td><?php get_course_name_manual(3,1);?></td>
			  <td><?php get_course_name_manual(4,1);?></td><!--课程表处理方法同主页-->
            </tr>
                        <tr>
			  <td class="am-hide-sm-only">08:40-09:20</td>
              <td><?php get_course_name_manual(0,2);?></td>
			  <td><?php get_course_name_manual(1,2);?></td>
			  <td><?php get_course_name_manual(2,2);?></td>
			  <td><?php get_course_name_manual(3,2);?></td>
			  <td><?php get_course_name_manual(4,2);?></td><!--课程表处理方法同主页-->
            </tr>            <tr>
			  <td class="am-hide-sm-only">09:30-10:10</td>
              <td><?php get_course_name_manual(0,3);?></td>
			  <td><?php get_course_name_manual(1,3);?></td>
			  <td><?php get_course_name_manual(2,3);?></td>
			  <td><?php get_course_name_manual(3,3);?></td>
			  <td><?php get_course_name_manual(4,3);?></td><!--课程表处理方法同主页-->
            </tr>
            <tr>
			  <td class="am-hide-sm-only">10:10-10:50</td>
              <td><?php get_course_name_manual(0,4);?></td>
			  <td><?php get_course_name_manual(1,4);?></td>
			  <td><?php get_course_name_manual(2,4);?></td>
			  <td><?php get_course_name_manual(3,4);?></td>
			  <td><?php get_course_name_manual(4,4);?></td><!--课程表处理方法同主页-->
            </tr>
            <tr>
              <td class="am-hide-sm-only">11:10-11:50</td>
              <td><?php get_course_name_manual(0,5);?></td>
			  <td><?php get_course_name_manual(1,5);?></td>
			  <td><?php get_course_name_manual(2,5);?></td>
			  <td><?php get_course_name_manual(3,5);?></td>
			  <td><?php get_course_name_manual(4,5);?></td><!--课程表处理方法同主页-->
            </tr>
            <tr>
			  <td class="am-hide-sm-only">11:50-12:30</td>
              <td><?php get_course_name_manual(0,6);?></td>
			  <td><?php get_course_name_manual(1,6);?></td>
			  <td><?php get_course_name_manual(2,6);?></td>
			  <td><?php get_course_name_manual(3,6);?></td>
			  <td><?php get_course_name_manual(4,6);?></td><!--课程表处理方法同主页-->
            </tr>            <tr>
			  <td class="am-hide-sm-only">13:30-14:10</td>
              <td><?php get_course_name_manual(0,7);?></td>
			  <td><?php get_course_name_manual(1,7);?></td>
			  <td><?php get_course_name_manual(2,7);?></td>
			  <td><?php get_course_name_manual(3,7);?></td>
			  <td><?php get_course_name_manual(4,7);?></td><!--课程表处理方法同主页-->
            </tr>            <tr>
			  <td class="am-hide-sm-only">14:10-14:50</td>
              <td><?php get_course_name_manual(0,8);?></td>
			  <td><?php get_course_name_manual(1,8);?></td>
			  <td><?php get_course_name_manual(2,8);?></td>
			  <td><?php get_course_name_manual(3,8);?></td>
			  <td><?php get_course_name_manual(4,8);?></td><!--课程表处理方法同主页-->
            </tr>            <tr>
			  <td class="am-hide-sm-only">15:00-15:40</td>
              <td><?php get_course_name_manual(0,9);?></td>
			  <td><?php get_course_name_manual(1,9);?></td>
			  <td><?php get_course_name_manual(2,9);?></td>
			  <td><?php get_course_name_manual(3,9);?></td>
			  <td><?php get_course_name_manual(4,9);?></td><!--课程表处理方法同主页-->
            </tr>
            <tr>
			  <td class="am-hide-sm-only">15:40-16:20</td>
              <td><?php get_course_name_manual(0,10);?></td>
			  <td><?php get_course_name_manual(1,10);?></td>
			  <td><?php get_course_name_manual(2,10);?></td>
			  <td><?php get_course_name_manual(3,10);?></td>
			  <td><?php get_course_name_manual(4,10);?></td><!--课程表处理方法同主页-->
            </tr>
          </tbody>
        </table>
        <span class="am-badge am-badge-success am-text-sm">你一周要上 <?php get_course_count();?> 节课</span>
      </div>

        <?php
        $i = 0;
        while($row = get_course_name_by_day()){
            $dayInt = $i;
            switch($dayInt){
                case 0:
                    $dayString = "星期一";
                    break;
                case 1:
                    $dayString = "星期二";
                    break;
                case 2:
                    $dayString = "星期三";
                    break;
                case 3:
                    $dayString = "星期四";
                    break;
                case 4:
                    $dayString = "星期五";
                    break;
            }
            ?>
        <div class="am-u-sm-12">
                <div class="am-panel am-panel-default am-show-sm-only">
                    <div class="am-panel-hd">
                        <span class="am-badge am-badge-success am-text-xl am-center"><?php echo $dayString;?></span>
                    </div>
                    <div class="am-panel-bd">
                        <table class="am-table am-table-striped am-table-hover">
                            <thead><tr><th>时间</th><th>课程</th></tr></thead>
                            <tr><td>8:00-8:40</td><td><?php extract_course_name($row,1);?></td></tr>
                            <tr><td>8:40-9:20</td><td><?php extract_course_name($row,2);?></td></tr>
                            <tr><td>9:30-10:10</td><td><?php extract_course_name($row,3);?></td></tr>
                            <tr><td>10:10-10:50</td><td><?php extract_course_name($row,4);?></td></tr>
                            <tr><td>11:10-11:50</td><td><?php extract_course_name($row,5);?></td></tr>
                            <tr><td>11:50-12:30</td><td><?php extract_course_name($row,6);?></td></tr>
                            <tr><td>13:30-14:10</td><td><?php extract_course_name($row,7);?></td></tr>
                            <tr><td>14:10-14:50</td><td><?php extract_course_name($row,8);?></td></tr>
                            <tr><td>15:00-15:40</td><td><?php extract_course_name($row,9);?></td></tr>
                            <tr><td>15:40-16:20</td><td><?php extract_course_name($row,10);?></td></tr>
                        </table>
                    </div>
                </div>
        </div>
    <?php
        $i++;
        }?>

    </div>

  </div>
</div>
  <!-- content end -->

<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<?php get_footer(); ?>