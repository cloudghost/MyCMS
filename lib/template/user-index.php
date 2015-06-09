<?php
$username = $_SESSION["user"]["cName"];
set_title("$username 的主页");
get_header();
get_sidebar("cms"); ?>
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> /
                <small>栏目概览</small>
            </div>
        </div>
        <hr>
        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-bd am-table-striped admin-content-table">
                    <thead>
                    <h2>课程预览</h2>
                    <tr>
                        <th>时间</th>
                        <th>今天课程</th>
                        <th>明天课程</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--这里显示今天和明天的课程表-->
                    <tr>
                        <td>8:00-8:40</td>
                        <td>  <?php get_course_name(0, 1); ?>  </td>
                        <td>  <?php get_course_name(1, 1); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    <tr>
                        <td>8:40-9:20</td>
                        <td>  <?php get_course_name(0, 2); ?>  </td>
                        <td>  <?php get_course_name(1, 2); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    <tr>
                        <td>9:30-10:10</td>
                        <td>  <?php get_course_name(0, 3); ?>  </td>
                        <td>  <?php get_course_name(1, 3); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    <tr>
                        <td>10:10-10:50</td>
                        <td>  <?php get_course_name(0, 4); ?>  </td>
                        <td>  <?php get_course_name(1, 4); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    <tr>
                        <td>11:10-11:50</td>
                        <td>  <?php get_course_name(0, 5); ?>  </td>
                        <td>  <?php get_course_name(1, 5); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    <tr>
                        <td>11:50-12:30</td>
                        <td>  <?php get_course_name(0, 6); ?>  </td>
                        <td>  <?php get_course_name(1, 6); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    <tr>
                        <td>13:30-14:10</td>
                        <td>  <?php get_course_name(0, 7); ?>  </td>
                        <td>  <?php get_course_name(1, 7); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    <tr>
                        <td>14:10-14:50</td>
                        <td>  <?php get_course_name(0, 8); ?>  </td>
                        <td>  <?php get_course_name(1, 8); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    <tr>
                        <td>15:00-15:40</td>
                        <td>  <?php get_course_name(0, 9); ?>  </td>
                        <td>  <?php get_course_name(1, 9); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    <tr>
                        <td>15:40-16:20</td>
                        <td>  <?php get_course_name(0, 10); ?> </td>
                        <td>  <?php get_course_name(1, 10); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    <tr>
                        <td>16:30-17:30</td>
                        <td>  <?php get_course_name(0, 11); ?> </td>
                        <td>  <?php get_course_name(1, 11); ?>  </td>
                    </tr>
                    <!--时间固定，将课程输入。没有课则留空-->
                    </tbody>
                </table>
            </div>
        </div>
		<hr>
		<ul class="am-avg-sm-1 am-avg-md-1 am-margin am-padding am-text-center admin-content-list ">
			<li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/news/list" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>今日新闻：<?php echo get_today_news();?></a></li>
		</ul>
        <hr>
        <div class="am-g">
            <div class="am-u-sm-12">
                <div class="am-scrollable-horizontal">
                    <table class="am-table am-table-bd am-table-striped admin-content-table am-text-break">
                        <thead>
                        <h2>明日需交</h2>
                        <tr>
                            <th>科目</th>
                            <th class="am-hide-sm-only">老师</th>
                            <th>内容</th>
                            <th>ASSESSED</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!--这里显示deadline是明天的所有作业-->
                        <?php
                        while ($row = get_tmw_hw()) {

                            $course = $row[0];
                            $teacher = $row[1];
                            $title = $row[2];
                            $assessed = $row[3];
                            if ($assessed) {
                                $string = '<span class="am-badge am-badge-danger">Yes</span>';
                            } else {
                                $string = '<span class="am-badge am-badge-secondary">No</span>';
                            }
                            echo "<tr><td>$course</td><td class='am-hide-sm-only'>$teacher</td><td>$title</td><td>$string</td>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <div class="am-g">
            <div class="am-u-sm-12">
                <div class="am-scrollable-horizontal">
                    <table class="am-table am-table-bd am-table-striped admin-content-table am-text-break">
                        <thead>
                        <h2>今日新增</h2>
                        <tr>
                            <th>科目</th>
                            <th class="am-hide-sm-only">老师</th>
                            <th>内容</th>
                            <th>Deadline</th>
                            <th>ASSESSED</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = get_today_hw()) {
                            $course = $row[0];
                            $teacher = $row[1];
                            $title = $row[2];
                            $deadline = $row[3];
                            $assessed = $row[4];;
                            if ($assessed) {
                                $string = '<span class="am-badge am-badge-danger">Yes</span>';
                            } else {
                                $string = '<span class="am-badge am-badge-secondary">No</span>';
                            }
                            echo "<tr><td>$course</td><td class='am-hide-sm-only'>$teacher</td><td>$title</td><td>$deadline</td><td>$string</td>";
                        }
                        ?>
                        <!--这里显示今天留的所有作业-->
                        <!--<tr><td>Business studies</td><td>Allen Liu</td><td>Workbook P232</td><td>25/1/2120</td><td><!--Yes显示橙色-></td></tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- content end-->


    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(); ?>