<?php
set_title($_SESSION["user"]["cName"].'的ECA');
get_header();
get_sidebar("eca");
?>

    <div class="admin-content">
        <div class="am-cf">
            <div class="am-fl am-padding">
                <strong class="am-text-primary am-text-lg"><?= $_SESSION["user"]["cName"]; ?> | ECA |</strong>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-lg-4 am-u-lg-push-8">
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h4>我的信息</h4>
                    </div>
                    <div class="am-panel-bd">
                        <div class="am-fl am-padding-sm">
                            <img src="http://icon.scie.com.cn/user/sicon/s<?= $_SESSION["user"]["sidRaw"]; ?>_i.jpg"
                                 class="am-thumbnail">
                        </div>
                        <div class="am-fr am-margin-right-lg">
                            <table class="am-table am-table-bordered am-table-radius am-table-hover am-text-sm ">
                                <tr class="am-primary">
                                    <th>中文名</th>
                                    <td><?= $_SESSION["user"]["cName"]; ?></td>
                                </tr>
                                <tr>
                                    <th>英文名</th>
                                    <td><?= $_SESSION["user"]["eName"]; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="am-cf"></div>
                        <hr>
                        <div class="am-padding-sm">
                            <table class="am-table am-table-bordered am-table-hover am-table-striped">
                                <tr><th>学号</th><td><?=$_SESSION["user"]["sidRaw"];?></td></tr>
                                <tr><th>年级</th><td><?=$_SESSION["user"]["year"];?></td></tr>
                                <tr><th>必修班</th><td><?=$_SESSION["user"]["class"];?></td></tr>
                                <tr><th>行政班</th><td><?=$_SESSION["user"]["form"];?></td></tr>
                                <?php
                                if(!empty($_SESSION["user"]["wechat"])) {
                                    ?>
                                    <tr>
                                        <th>微信号</th>
                                        <td><?= $_SESSION["user"]["wechat"]; ?></td>
                                    </tr>
                                <?php
                                }
                                if(!empty($_SESSION['user']['mobile'])){
                                    ?>
                                    <tr><th>手机号</th><td><?=$_SESSION['user']["mobile"];?></td></tr>
                                    <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="am-u-lg-8 am-u-lg-pull-4">
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h4>我的社团</h4>
                    </div>
                </div>
            <?php while($eca = get_user_joined_eca()){?>
            <div class="am-panel am-panel-default">
                <div class="am-panel-bd">
                    <div class="am-g">
                        <div class="am-u-sm-8">
                            <h2 class="am-inline">
                                <?= $eca["eca_name"]; ?>
                            </h2>
                        </div>
                        <div class="am-u-sm-4">
                            <div class="am-vertical-align">
                                <div class="am-vertical-align-middle">
                                    <a  class="am-btn am-btn-primary" href="/eca/view/<?=$eca['eca_id'];?>">查看</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-panel-footer">
                    <small><?=$eca["eca_description"];?></small>
                </div>
            </div>

            <?php }?>
            </div>

        </div>
    </div>
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(); ?>