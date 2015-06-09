<?php
set_title(cache::getCache("eca_name"));
get_header();
get_sidebar("eca");
?>
    <div class="admin-content" id="content">
        <div class="am-cf">
            <div class="am-fl am-padding"><strong
                    class="am-text-primary am-text-lg"><?= cache::getCache("eca_name"); ?></strong>
            </div>
            <div class="am-fr am-padding">
				<input id="sid" type="hidden" value="<?=$_SESSION["user"]["sidRaw"]?>"></input>
				<input id="ecaid" type="hidden" value="<?= cache::getCache("eca_id"); ?>"></input>
                <?php if (!is_user_member_view()) { ?>
                    <button class="am-btn am-btn-success" id="joinBtn">加入</button>
                <?php
                }
                if (cache::getCache("authority")>=9) { ?>
                    <button class="am-btn am-btn-danger" id="deleteEcaBtn"><span class="am-icon am-icon-close"></span>
                        解散
                    </button>
                <?php }else if(is_user_member_view()){?>
					<button class="am-btn am-btn-danger" id="exitEcaBtn"><span class="am-icon am-icon-close"></span>
                        退出
                    </button>
				<?php
                }
                if (cache::getCache("authority")>=8) {
                    ?>
                    <a class="am-btn am-btn-warning" href="http://<?=$_SERVER["HTTP_HOST"]?>/eca/attendance/<?=cache::getCache("eca_id");?>"><span class="am-icon-users"></span> 考勤</a>
                <?php }
				if (cache::getCache("authority")>=4) {
                    ?>
                    <a class="am-btn am-btn-warning" href="http://<?=$_SERVER["HTTP_HOST"]?>/index.php?action=post&method=new&ecaid=<?=cache::getCache("eca_id");?>"><span class="am-icon-users"></span> 发布通知</a>
                <?php } ?>
				<?php
						if (cache::getCache("authority")>=6) {
						?>
                        <button class="am-btn am-btn-secondary" id="changeContactBtn"
                                data-eca-id="<?= cache::getCache("eca_id"); ?>"><span class="am-icon-at"></span>联络信息
                        </button>
				<?php } ?>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-lg-4 am-u-lg-push-8">
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h4 class="am-fl">描述</h4>
						<?php
						if (cache::getCache("authority")>=6) {
						?>
                        <button class="am-fr am-btn am-btn-secondary" id="changeDescriptionBtn"
                                data-eca-id="<?= cache::getCache("eca_id"); ?>">修改
                        </button>
						<?php } ?>
                        <div class="am-cf"></div>
                    </div>
                    <div class="am-panel-bd">
                        <p id="ecaDescriptionText"><?= cache::getCache("eca_description"); ?></p>
                    </div>
                </div>
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h4>信息</h4>
                    </div>
                    <ul class="am-list am-list-static">
                        <li>社长: <span class="am-badge am-badge-primary am-text-lg"><?= get_eca_leader(); ?></span></li>
                        <li>成员数: <span
                                class="am-badge am-badge-warning am-text-lg"><?= get_eca_member_count(); ?></span></li>
                        <li>注册日期: <span
                                class="am-badge am-badge-success am-text-lg"><?= get_eca_register_date(); ?></span></li>
                    </ul>
                </div>
				<div class="am-panel am-panel-default" id="info">
                    <div class="am-panel-hd" data-am-collapse="{parent: '#info', target: '#infocollapse'}">
                        <h4>联络信息</h4>
                    </div>
                    <ul class="am-list am-list-static <?=cache::getCache("authority")?"am-collapse":""?>" id="infocollapse">
                        <li>联系方式: <?= cache::getCache('eca_contact') ?></li>
                        <li>活动时间地点:<?=cache::getCache("eca_place")?></li>
                        <li>招新动态:<?=cache::getCache('eca_moment')?></li>
						<li class="am-show-md-up"><img src="http://qr.liantu.com/api.php?w=500&text=http://<?=$_SERVER['HTTP_HOST']."/eca/view/".cache::getCache('eca_id')?>" class="am-img-responsive" data-am-popover="{content: '右击另存为下载', trigger: 'hover focus'}"></li>
                    </ul>
                </div>
            </div>
            <div class="am-u-lg-8 am-u-lg-pull-4">
                <div class="am-panel am-panel-default" id="respond">
                    <div class="am-panel-hd">
                        <h4>成员属性</h4>
                    </div>
                    <ul class="am-list am-list-static">
                        <li>
                            <h5>性别比例</h5>

                            <div class="am-progress">
                                <div class="am-progress-bar" style="width: <?= get_user_male_percentage(); ?>%"> <?= (int)get_user_male_percentage(); ?>% 男</div>
                                <div class="am-progress-bar am-progress-bar-success"
                                     style="width: <?= get_user_female_percentage(); ?>%"><?= (int)get_user_female_percentage(); ?>% 女
                                </div>
                                <div class="am-progress-bar am-progress-bar-warning"
                                     style="width: <?= get_user_uknown_percentage(); ?>%"><?= (int)get_user_uknown_percentage(); ?>%其他
                                </div>
                            </div>
                        </li>
                        <li>
                            <h5>年级分布</h5>
                            <div id="yearGroup"></div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="am-g">

            <div class="am-u-lg-8">
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h2><?= get_eca_member_count(); ?>个成员</h2>
						<p class="am-show-sm">电脑平板上使用，更多管理功能哦</p>
                    </div>
					<?php if (cache::getCache("authority")>=2){ ?>
                    <table class="am-table am-table-bordered am-table-radius am-table-striped">
                        <thead>
                        <th>学号</th>
                        <th>英文名/职位</th>
                        <?php if (cache::getCache("authority")>=8) { ?>
                            <th class="am-text-center am-show-md-up">操作</th>
                        <?php } ?>
                        </thead>
                        <tbody>
                        <?php while ($row = get_eca_members()) { ?>
                            <tr>
                                <td><?= $row["user_sid"]; ?></td>
                                <td><?= $row["user_eName"]; ?> &nbsp:&nbsp <?= $row["role"]; ?></td>
                                <?php if (cache::getCache("authority")>=8) { ?>
                                    <td class="am-show-md-up">
                                        <div id="<?= $row["user_sid"]; ?>" name="<?= $row["user_sid"]; ?>" class="am-text-center am-btn-group am-btn-group-xs am-btn-group-justify">
											<?php if($row["authority"]>0){?><button name="changeRoleBtn" type="button" class="am-btn am-btn-primary am-btn-sm" <?=($row["authority"]==9)? "disabled=\"disabled\"" : ""?>><span class="am-icon am-icon-edit"></span></button><?php }else{?>
											<button name="changeRoleBtn" type="button" class="am-btn am-btn-warning am-btn-sm" <?=($row["authority"]==9||$row["user_sid"]==cache::getCache("user_sid"))? "disabled=\"disabled\"" : ""?> ><span class="am-icon am-icon-certificate"></span></button><?php } ?>
											<a name="view" type="button" class="am-btn am-btn-primary am-btn-sm" href="http://<?=$_SERVER[HTTP_HOST];?>/index.php?action=eca&method=memberview&userid=<?=$row["user_sid"];?>" <?=($row["user_sid"]==cache::getCache("user_sid"))? "disabled=\"disabled\"" : ""?> ><span class="am-icon am-icon-user"></span></a>
											<a name="message" type="button" class="am-btn am-btn-primary am-btn-sm" href="http://<?=$_SERVER[HTTP_HOST];?>/index.php?action=post&method=new&ecaid=<?=cache::getCache("eca_id");?>&user_sid=<?=$row["user_sid"];?>" <?=($row["authority"]==9||$row["user_sid"]==cache::getCache("user_sid"))? "disabled=\"disabled\"" : ""?> ><span class="am-icon am-icon-comment-o"></span></a>
											<button name="kickBtn" type="button" class="am-btn am-btn-primary am-btn-sm" <?=($row["authority"]==9||$row["user_sid"]==cache::getCache("user_sid"))? "disabled=\"disabled\"" : ""?> ><span class="am-icon am-icon-close"></span></button>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </table>
					<?php } ?>
                </div>
            </div>

        </div>


    </div>
</div>
<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
	<script src="/assets/js/custom/IChartjs/ichart.1.2.min.js"></script>
	<script>
	$(function(){
			var varwidth = document.getElementById('respond').offsetWidth-26;
			var cirradius = varwidth*0.618/2-20;

			var data = [
			        	{name : 'G1',value : <?=get_member_year_count("G1");?>,color:'#fedd74'},
			        	{name : 'G2',value : <?=get_member_year_count("G2");?>,color:'#82d8ef'},
			        	{name : 'A1',value : <?=get_member_year_count("A1");?>,color:'#f76864'},
			        	{name : 'A2',value : <?=get_member_year_count("A2");?>,color:'#80bd91'},
		        	];
	    	
			var chart = new iChart.Donut2D({
				render : 'yearGroup',
				center:{
					text:'年级分布',
					shadow:true,
					shadow_offsetx:0,
					shadow_offsety:2,
					shadow_blur:2,
					shadow_color:'#b7b7b7',
					color:'#6f6f6f'
				},
				data: data,
				offsetx:-60,
				shadow:true,
				background_color:'#ffffff',
				separate_angle:0,//分离角度
				tip:{
					enable:true,
					showType:'fixed'
				},
				legend : {
					enable : true,
					shadow:true,
					background_color:null,
					border:false,
					legend_space:varwidth/40,//图例间距
					line_height:varwidth/40,//设置行高
					sign_space:varwidth/40,//小图标与文本间距
					sign_size:varwidth/20,//小图标大小
					color:'#6f6f6f',
					fontsize:varwidth/40//文本大小
				},
				sub_option:{
					label:false,
					color_factor : 0.3
				},
				showpercent:true,
				decimalsnum:2,
				width : varwidth,
				height : varwidth*0.618,
				radius:cirradius,
				animation : true
			});
			chart.draw();
		});
	</script>
	<div class="am-modal am-modal-prompt" tabindex="-1" id="changeContact">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">修改社团联络信息</div>
            <div class="am-modal-bd">
                联系方式:
              <!--  <input type="text" class="am-modal-prompt-input">-->
				<textarea class="am-modal-prompt-input" rows="4"></textarea>
				活动时间和地点：
				<input type="text" class="am-modal-prompt-input">
				招新动态：
				<textarea class="am-modal-prompt-input" rows="4"></textarea>
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
    <div class="am-modal am-modal-prompt" tabindex="-1" id="changeDescription">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">修改社团信息</div>
            <div class="am-modal-bd">
                不要多于100字。。
              <!--  <input type="text" class="am-modal-prompt-input">-->
				<textarea class="am-modal-prompt-input" rows="4"></textarea>
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
	<div class="am-modal am-modal-prompt" tabindex="-1" id="changeRole">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">修改社员职位</div>
            <div class="am-modal-bd">
                请写明职位信息。
                <input type="text" value="member" class="am-modal-prompt-input">
				请选择权限（实验功能），每下一个等级将拥有以上所有权限。
				<select class="am-modal-prompt-input" data-am-selected>
						<option value="1">无其他权限</option>
						<option value="2">查看社团成员信息</option>
						<option value="4">发送社团通知</option>
						<option value="6">编辑社团信息</option>
						<option value="8">发起点名及修改职位</option>
				</select>
				<!--<textarea class="am-modal-prompt-input" rows="4"></textarea>-->
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
    <div class="am-modal am-modal-alert" tabindex="-1" id="changeDescriptionSuccessAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">成功</div>
            <div class="am-modal-bd">
                成功修改了社团信息！
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
	<div class="am-modal am-modal-alert" tabindex="-1" id="successAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">成功</div>
            <div class="am-modal-bd">
                完成指定操作!
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
    <div class="am-modal am-modal-alert" tabindex="-1" id="failureAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">失败</div>
            <div class="am-modal-bd">
                没有成功完成你所指定的要求
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
    <div class="am-modal am-modal-confirm" tabindex="-1" id="confirmDelete">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">删除ECA</div>
            <div class="am-modal-bd">
                删除后不可恢复，你想好了么？？？
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="loadingAlert">
        <div class="am-modal-hd">正在载入...</div>
        <div class="am-modal-bd">
            <span class="am-icon-spinner am-icon-spin"></span>
        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-1" id="deleteEcaSuccessAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">成功</div>
            <div class="am-modal-bd">
                成功的删除了此社团
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
    <div class="am-modal am-modal-alert" tabindex="-1" id="successregAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">成功提交申请</div>
            <div class="am-modal-bd">
                正在等待社长的同意
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-1" id="registeredAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">失败</div>
            <div class="am-modal-bd">
                你已经加入了该社团
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
<?php get_footer(["eca_view.js", "ajax.js","unescape.js"]); ?>