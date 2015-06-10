<?php
set_title($_SESSION["user"]["cName"].'的考勤');
get_header();
get_sidebar("cms");
?>

    <div class="admin-content">
        <div class="am-cf">
            <div class="am-fl am-padding">
                <strong class="am-text-primary am-text-lg"><?= $_SESSION["user"]["cName"]; ?> | 考勤 |</strong>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-lg-4 am-u-lg-push-8">
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h4>2013-2015学年</h4>
                    </div>
                    <div class="am-panel-bd">
                        <div class="am-padding-sm">
                            <table class="am-table am-table-striped">
                            <?php
                                $result=cache::getCache('attendance');
                            ?>
                                <tr><th>总天数</th><td><?=$result['totalDays']?>天</td></tr>
                                <tr><th>总缺勤天数</th><td><?=$result['totalAbsentdays']?>天</td></tr>
                                <tr><th>占比</th><td><?=$result['totalRate']?></td></tr>
                                <tr><th><?=cache::getCache('year');?>年<?=cache::getCache('year');?>月共缺勤</th><td><?=$result['monthAbsentdays']?>次</td></tr>
                                <tr><th><?=cache::getCache('year');?>年<?=cache::getCache('year');?>月占比</th><td><?=$result['monthAbsentRate']?></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($result[abs_records])){?>
            <table class="am-table am-table-striped">
                <thread>
                    <th>日期</th>
                    <th>Period</th>
                    <th>科目</th>
                    <th>详情</th>
                </thread>
                <?php foreach ($result[abs_records] as $date => $periods) {
                    foreach($periods as $period to $class){?>
                <tbody>
                    <td><?=$date?></td>
                    <td><?=$period?></td>
                    <td><?=$class['course']?></td>
                    <td><?=$class['kind']?></td>
                </tbody>
                <?php }}?>
            </table>
            <?php } ?>
        </div>
    </div>
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(); ?>