<?php
$username = $_SESSION["user"]["cName"];
set_title("$username | 考试 |");
get_header();
get_sidebar("cms"); ?>
  <!-- content start -->
  <div class="admin-content">

    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">考试时间表</strong> / <small>Exam Table</small></div>
    </div>

    <div class="am-g">
      <div class="am-u-sm-12">
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
                  <th>科目</th>
                  <th>考场</th>
                  <th>座位</th>
                  <th>时间</th>
                  <th class="am-hide-sm-only">日期</th>
                  <th class="am-hide-sm-only">考试名称</th>
          </thead>
          <tbody>
          <?php
          while ($row = get_exam()) {
              $course = $row["course"];
              $room = $row["room"];
              $seat = $row["seat"];
              $time = $row["time"];
              $date = $row["date"];
              $exam = $row["exam"];
           ?>
            <tr class="am-hide-md works"><td><?=$course;?></td><td><?=$room;?></td><td><?=$seat;?></td><td><?=$time;?></td><td class="am-hide-sm-only"><?=$date;?></td><td class="am-hide-sm-only"><?=$exam;?></td></tr>
            <tr class="details"><td colspan="4"><div>日期：<?=$date;?> <br>考试名称：<?=$exam;?></div></td></tr>
            <?php }?>
          </tbody>
        </table>

          <span class="am-badge am-badge-success am-text-sm">共有 <?php get_exam_count();?> 场考试</span>
      </div>

    </div>
  </div>
  <!-- content end -->
</div>

<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer();?>