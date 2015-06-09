<?php
set_title(cache::getCache("eca_name"));
get_header();
get_sidebar("eca");
?>

    <div class="admin-content">
        <div class="am-cf">
            <div class="am-fl am-padding"><strong
                    class="am-text-primary am-text-lg"><?= cache::getCache("eca_name"); ?></strong>
            </div>
            <div class="am-fr am-padding">
				<input id="sid" type="hidden" value="<?=$_SESSION["user"]["sidRaw"]?>"></input>
				<input id="ecaid" type="hidden" value="<?= cache::getCache("eca_id"); ?>"></input>
				<?php if (cache::getCache("authority")>=8) { ?>
					<a class="am-btn am-btn-secondary" href="http://<?=$_SERVER['HTTP_HOST']?>/eca/attlist/<?=cache::getCache("eca_id");?>"><span class="am-icon-users"></span> 查看全部</a>
                    <a class="am-btn am-btn-warning" href="http://<?=$_SERVER['HTTP_HOST']?>/rollcalling/<?=cache::getCache("eca_id");?>"><span class="am-icon-users"></span> 发起点名</a>
                <?php }?>
            </div>
        </div>
		<div class="am-g">
        <?php while ($row = get_attendance_list()) { ?>
    <div class="am-u-sm-12">
        <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
                <div class="am-g">
                    <div class="am-u-sm-8">
                        <h2 class="am-inline">
                            <?= date("Y-m-d h:ia",$row['tset']); ?>
                        </h2>
                        <br>
                        <span class="am-badge am-badge-success am-text-md">已到人数：<?php echo get_attended($row['attendance']);?></span>
						<span class="am-badge am-badge-danger am-text-md">未到人数：<?=count($row['attendance'])-get_attended($row['attendance'])?></span>
						<span class="am-badge am-badge-secondary am-text-md">出勤率：<?=intval((get_attended($row['attendance']))/count($row['attendance'])*100)?>%</span>
                    </div>
                    <div class="am-u-sm-4">
                        <div class="am-vertical-align">
                            <div class="am-vertical-align-middle">
                                <a  class="am-btn am-btn-primary" href="/eca/attview/<?=$row['rollcall_id'];?>">查看/编辑</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="am-panel-footer">
                <small><?= $row["eca_description"]; ?></small>
            </div>
        </div>
    </div>
<?php } ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>