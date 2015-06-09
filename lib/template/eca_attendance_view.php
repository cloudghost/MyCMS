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
				<input id="rollcallid" type="hidden" value="<?=cache::getCache("rollcall_id");?>"></input>
				<input id="ecaid" type="hidden" value="<?= cache::getCache("eca_id"); ?>"></input>
				<?php $tset=cache::getCache("tset");  if (cache::getCache("authority")>=8) { ?>
					<a class="am-btn am-btn-secondary" href="http://<?=$_SERVER['HTTP_HOST']?>/eca/attlist/<?=cache::getCache("eca_id");?>"><span class="am-icon-users"></span> 查看全部</a>
                    <a class="am-btn am-btn-warning" href="http://<?=$_SERVER['HTTP_HOST']?>/rollcalling/<?=cache::getCache("eca_id");?>"><span class="am-icon-users"></span> 发起点名</a>
                <?php }?>
            </div>
        </div>
        <div class="am-g">
            <div class="am-u-lg-12">
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h2><?=get_attended(cache::getCache("attendance"));?>/<?= get_eca_member_count(); ?>个成员:<?php echo  date("Y-m-d h:ia",$tset);?></h2>
						<p class="am-show-sm">电脑平板访问查看图片和学号</p>
						<button class="am-btn am-btn-secondary" id="submit">提交更改</button>
                    </div>
					<?php if (cache::getCache("authority")>=8){ ?>
                    <table class="am-table am-table-bordered am-table-radius am-table-striped">
                        <thead>
						<th> &nbsp </th>
                        <th class="am-show-md-up">学号</th>
                        <th class="am-show-md-up">英文名</th>
						<th>中文名</th>
                        <th class="am-show-md-up">职位</th>
						<?php $attendances=cache::getCache("attendance");
						      ?>
						<th> <span class="am-show-lg-only"><?php echo  date("Y-m-d h:ia",$tset);?></span>  <span class="am-show-md-down"><?php echo  date("m-d",$tset);?></span> </th>
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
								<td>
									<div class="onoffswitch">
										<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="<?= $row["user_sid"]; ?>" <?=$attendances[$row["user_sid"]]==1?'checked':''?>>
										<label class="onoffswitch-label" for="<?= $row["user_sid"]; ?>">
											<span class="onoffswitch-inner">
												<span class="onoffswitch-active"><span class="onoffswitch-switch">出勤</span></span>
												<span class="onoffswitch-inactive"><span class="onoffswitch-switch">缺勤</span></span>
											</span>
										</label>
									</div>
								</td>
                            </tr>
                        <?php } ?>
                    </table>
					<?php }else{?>
					<p>没有权限查看信息</p><?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="am-modal am-modal-confirm" tabindex="-1" id="confirmSubmit">
	<div class="am-modal-dialog">
		<div class="am-modal-hd">确认信息</div>
		<div class="am-modal-bd">
			是否提交更改？
		</div>
		<div class="am-modal-footer">
			<span class="am-modal-btn" data-am-modal-cancel>取消</span>
			<span class="am-modal-btn" data-am-modal-confirm>确定</span>
		</div>
	</div>
</div>

<?php get_footer(['ajax.js','eca_att.js']); ?>