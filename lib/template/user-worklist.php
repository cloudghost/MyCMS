<?php
$username = $_SESSION["user"]["cName"];
set_title("$username | 作业 |");
get_header();
get_sidebar("cms"); ?>

    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">作业列表</strong> /
                <small>Homework List</small>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main" width="100%" border="0"
                       cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="table-date am-hide-sm-only">设置时间</th>
                        <th class="table-date">期限</th>
                        <th>科目</th>
                        <th class="am-hide-sm-only">老师</th>
                        <th>Assessed</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 0;
                    while ($row = get_full_hw()) {
                        $assessed = $row["assessed"];
                        if ($assessed) {
                            $string = '<span class="am-badge am-badge-danger">Yes</span>';
                        } else {
                            $string = '<span class="am-badge am-badge-secondary">No</span>';
                        }
                        ?>
                        <tr class="works">
                            <td class="am-hide-sm-only"><?php echo $row["setDate"]; ?></td>
                            <td><?php echo $row["deadline"]; ?></td>
                            <td><?php echo $row["course"]; ?></td>
                            <td class="am-hide-sm-only"><?php echo $row["teacher"]; ?></td>
                            <td><?php echo $string; ?></td>
                        </tr>
                        <tr class="details">
                            <td class="a" colspan="5">
                                <div class="dropdowndiv">
                                    <div class="abc<?=$i;?>"><?php echo $row["title"]; ?></div>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    } ?>
                    </tbody>
                </table>
                <span class="am-badge am-badge-success">本页共<?php get_hw_count(); ?>项作业记录</span>
            </div>
        </div>
    </div>
</div>
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<?php get_footer(["homeworklist.js"]); ?>