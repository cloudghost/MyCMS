<?php
set_title("ECA 注册");
get_header_raw(); ?>
    <style>
        .shadow {
            box-shadow: 0 0 20px #B5D5D5;
        }

        .marg {
            margin-top: 5%;
        }

    </style>
    <body>
    <div class="am-g">
        <div class="am-u-md-8 am-u-md-centered">
            <div class="am-panel am-panel-primary shadow marg">
                <div class="am-panel-hd">
                    <h1>ECA注册</h1>

                    <p>填上ECA的信息，并开始享受高大上的社团管理系统把！</p>
                </div>
                <div class="am-panel-bd">
                    <div class="am-g">
                        <div class="am-u-sm-12">
                            <h3>注册者信息</h3>
                            <table class="am-table am-table-bordered am-table-radius am-table-striped">
                                <tr>
                                    <td>学号</td>
                                    <td><?= $_SESSION["user"]["sidRaw"]; ?></td>
                                </tr>
                                <tr>
                                    <td>名称</td>
                                    <td><?= $_SESSION["user"]["cName"]; ?></td>
                                </tr>
                                <tr>
                                    <td>英文名</td>
                                    <td><?= $_SESSION["user"]["eName"]; ?></td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <form class="am-form" method="post">
                            <fieldset>
                                <legend>ECA信息</legend>

                                <div class="am-form-group">
                                    <input type="text" class="am-form-field" name="eca_name"
                                           placeholder="ECA 名称">
                                </div>

                                <div class="am-form-group">
                                    <label for="eca_description">ECA 简介</label>
                                    <textarea name="eca_description" rows="4" id="eca_description"></textarea>

                                </div>


                            </fieldset>
                        </form>
                        <div class="am-u-sm-12">
                            <button class="am-btn am-btn-secondary am-btn-block" id="submit" data-am-loading="{spinner: 'circle-o-notch', loadingText: '提交...', resetText: '再试一次'}">提交</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-2" id="successAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">成功</div>
            <div class="am-modal-bd">
                注册成功
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-2" id="registeredAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">失败</div>
            <div class="am-modal-bd">
                你已经注册过了
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
                信息提交失败,你是不是曾经提交过？
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-1" id="nameRegisteredAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">失败</div>
            <div class="am-modal-bd">
                这个ECA名称已经被注册过了
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-1" id="emptyAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">失败</div>
            <div class="am-modal-bd">
                这些空不能留啊
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
    </body>
<?php get_footer(["registereca.js"]); ?>