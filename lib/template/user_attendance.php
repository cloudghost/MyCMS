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
            <div class="am-container">
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h2>2013-2015学年</h2>
                    </div>
                    <div class="am-panel-bd">
                        <div class="am-padding-sm">
                            <h2 class="am-u-sm-8 am-text-secondary"> 选择月份</h2>
                            <div class="am-u-sm-1 am-input-group am-datepicker-date" data-am-datepicker="{format: 'yyyy-mm', viewMode: 'months', minViewMode: 'months'}">
                                <span class="am-input-group-btn am-datepicker-add-on">
                                    <button class="am-btn am-btn-secondary" id="date" type="button"><span class="am-icon-calendar"></span> </button>
                                </span>
                            </div>
                            <table class="am-table am-table-striped">
                            <?php
                                $result=cache::getCache('attendance');
                            ?>
                                <tr><th>总天数</th><td><?=$result['totalDays']?>天</td></tr>
                                <tr><th>总缺勤天数</th><td><?=$result['totalAbsentdays']?>天</td></tr>
                                <tr><th>缺勤率</th><td><?=$result['totalRate']?></td></tr>
                                <tr><th><?=cache::getCache('year');?>年<?=cache::getCache('month');?>月共缺勤</th><td><?=isset($result['monthAbsentDays'])?$result['monthAbsentDays']:''?>次</td></tr>
                                <tr><th><?=cache::getCache('year');?>年<?=cache::getCache('month');?>月占比</th><td><?=isset($result['monthAbsentRate'])?$result['monthAbsentRate']:''?></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($result['abs_records'])&&(intval(cache::getCache('year'))<=intval(date('Y',time())))&&(intval(cache::getCache('month'))<=intval(date('m',time())))){
                $colorArr=array(
                    'Late'=>'warning',
                    'Approved'=>'secondary',
                    'Unapproved'=>'danger',
                    'School'=>'success',
                    'Sick'=>'primary'
                    );
                ?>
            <div class="am-container">
            <table class="am-table am-table-radius">
                <thread>
                    <th>日期</th>
                    <th>Period</th>
                    <th>科目</th>
                    <th>详情</th>
                </thread>
                <?php foreach ($result['abs_records'] as $day) {
                    foreach($day['periods'] as $period => $class){?>
                <tbody>
                    <td><?=$day['abs_day']?></td>
                    <td><?=$period?></td>
                    <td><?=$class['course']?></td>
                    <td><span class= <?="\"am-badge am-badge-".$colorArr[$class['kind']]." am-radius\"
                    "?> ><?=$class['kind']?> </span></td>
                </tbody>
                <?php }}?>
            </table>
            </div>
            <?php } ?>
        </div>
    </div>
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(['user_attendance.js']); ?>