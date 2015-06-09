<?php
set_title("ECA 列表");
get_header();
get_sidebar("eca"); ?>
    <div class="admin-content">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">ECA列表</strong> /
                <small>ECA List</small>
            </div>
            <div class="am-show-md-up">
                <div class="am-fr">
                    <form class="am-form-inline" onsubmit=" return search()">
                       <div class="am-form-group am-form-icon">
                        <i class="am-icon-search"></i>
                        <input type="text" id="searchText" class="am-form-field am-input-sm" placeholder="ECA">

                        <button class="am-btn am-btn-secondary am-input-sm">搜索</button>

                      </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="am-cf am-show-sm-only am-padding">
            <form class="am-form" onsubmit="return search()">
                    <div class="am-form-group am-form-icon">
                        <i class="am-icon-search"></i>
                        <input type="text" class="am-form-field am-input-sm" placeholder="ECA">
                    </div>
            </form>

            <button id="search" class="am-btn am-btn-block am-btn-secondary am-input-sm">搜索</button>

        </div>


        <div class="am-g">
        <?php while ($row = get_eca_list()) { ?>
    <div class="am-u-sm-12">
        <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
                <div class="am-g">
                    <div class="am-u-sm-8">
                        <h2 class="am-inline">
                            <?= $row["eca_name"]; ?>
                        </h2>
                        <br>
                        <span class="am-badge am-badge-success am-text-md">由<?= $row["user_eName"]; ?> <?= $row["user_sid"]; ?>创立</span>
                    </div>
                    <div class="am-u-sm-4">
                        <div class="am-vertical-align">
                            <div class="am-vertical-align-middle">
                                <a  class="am-btn am-btn-primary" href="/eca/view/<?=$row['eca_id'];?>">查看</a>
                                <button class="am-btn am-btn-success" data-eca-id="<?=$row['eca_id'];?>" onclick="join(this)">加入</button>
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

    <div class="am-modal am-modal-alert" tabindex="-1" id="failureAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">失败</div>
            <div class="am-modal-bd">
                向数据库提交信息时失败
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-1" id="successAlert">
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

    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(["eca_list.js"]); ?>