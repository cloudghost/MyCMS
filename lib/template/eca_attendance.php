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
            <div class="am-u-lg-12">
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h2><?= get_eca_member_count(); ?>个成员</h2>
						<h4>最近三次点名</h4>
						<p class="am-show-sm">电脑平板访问查看图片和学号</p>
                    </div>
					<?php if (cache::getCache("authority")>=8){ ?>
                    <table class="am-table am-table-bordered am-table-radius am-table-striped">
                        <thead>
						<th> &nbsp </th>
                        <th class="am-show-md-up">学号</th>
                        <th class="am-show-md-up">英文名</th>
						<th>中文名</th>
                        <th class="am-show-md-up">职位</th>
						<?php if($attendances=cache::getCache("attendance")){
						foreach($attendances as $att){?>
						<th> <span class="am-show-lg-only"><?php echo  date("Y-m-d h:ia",$att['tset']);?></span>  <span class="am-show-md-down"><?php echo  date("m-d",$att['tset']);?></span> </th>
						<?php }?>
                        </thead>
                        <tbody>
                        <?php while ($row = get_eca_members()) { ?>
                            <tr>
								<td><img src="http://icon.scie.com.cn/user/sicon/s<?= $row["user_sid"]; ?>_i.jpg"
                                 class="am-thumbnail"></td>
                                <td class="am-show-md-up"><?= $row["user_sid"]; ?></td>
                                <td class="am-show-md-up"><?= $row["user_eName"]; ?></td>
								<td><?= $row["user_cName"]; ?></td>
								<td class="am-show-md-up"><?= $row["role"]; ?></td>
								<?php foreach($attendances as $att){?>
								<td><?php
								if($att['attendance'][$row["user_sid"]]==1){
									echo '<span class="am-badge am-badge-success">YES</span>';
								}else{
									echo '<span class="am-badge am-badge-warning">NO</span>';
								}
									?></td>
								<?php }?>
                            </tr>
                        <?php }} ?>
                    </table>
					<?php }else{?>
					<p>没有权限查看信息</p><?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>