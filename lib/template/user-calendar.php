<?php
$username = $_SESSION["user"]["cName"];
set_title("$username | 校历 |");
get_header();
get_sidebar("cms"); ?>

    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">校历</strong> /
                <small>School Calendar</small>
            </div>
        </div>
        <div class="am-g">
            <div class="am-u-sm-12">
                <?php show_message(); ?>
            </div>
            <div class="am-u-sm-12">
				<div class="am-u-sm-6 am-content"> 
				<h2 class="am-u-sm-5 am-text-secondary"> 选择月份</h2>
				<div class="am-u-sm-1 am-input-group am-datepicker-date" data-am-datepicker="{format: 'yyyy-mm', viewMode: 'months', minViewMode: 'months'}">
					<span class="am-input-group-btn am-datepicker-add-on">
						<button class="am-btn am-btn-secondary" id="date" type="button"><span class="am-icon-calendar"></span> </button>
					</span>
				</div>
				</div>
				</br>
				</br>
                <div class="am-g">
                    <?php
                    $i = 0;
                    while ($row = get_calendar_list()) {
                        $date = $row["date"];

                        ?>
                        <div class="am-u-sm-12">
                            <div class="am-panel am-panel-default">
                                <div class="am-panel-bd">
                                    <div class="am-g">
                                        <div class="am-u-md-2 am-show-md-up">
                                      <span class="am-badge am-badge-secondary am-text-xl"><span
                                              class="am-badge am-badge-secondary am-text-xl"><?php echo $date; ?></span></span>
                                        </div>
                                        <div class="am-u-sm-12 am-show-sm-only">
                                            <div class="am-panel am-panel-default">
                                                <div class="am-panel-bd">
                                                    <div class="am-u-sm-5 am-u-sm-centered"><span
                                                            class="am-badge am-badge-secondary am-text-xl"><?php echo $date; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="am-u-md-10">

                                            <div class="am-g">

                                                <?php
                                                $j = 0;
                                                foreach ($row["results"] as $record) {
                                                    $time = $record["time"];
                                                    $location = $record["location"];
                                                    $title = $record["title"];
                                                    $content = $record["content"];

                                                    ?>
                                                    <div class="am-u-sm-12">
                                                        <div class="am-panel am-panel-default">
                                                            <div class="am-panel-hd am-cf"
                                                                 data-am-collapse="{target: '#collapse-panel-<?php echo $i . "-" . $j; ?>'}"><?php echo $title; ?>
                                                                <span class="am-icon-chevron-down am-fr"></span></div>
                                                            <div id="collapse-panel-<?php echo $i . "-" . $j; ?>"
                                                                 class="am-panel-bd am-collapse">
                                                                <ul class="am-list admin-content-task">
                                                                    <li>
                                                                        <div class="admin-task-meta">
                                                                            时间：<?php echo $time; ?></div>
                                                                        <div class="admin-task-meta">
                                                                            地点：<?php echo $location; ?></div>
                                                                        <div
                                                                            class="admin-task-bd"><?php echo $content; ?></div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $j++;
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $i++;
                    } ?>
                </div>
            </div>
            　
        </div>
        <!-- content end -->
    </div>

    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(['user_calendar.js']); ?>