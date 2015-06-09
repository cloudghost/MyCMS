<?php
set_title("资料完善");
get_header_raw();?>
<style>
    .shadow{
        box-shadow:0 0  20px #B5D5D5;
    }
    .marg{
        margin-top: 5%;
    }

</style>
<body>
    <div class="am-g">
        <div class="am-u-md-8 am-u-md-centered">
            <div class="am-panel am-panel-primary shadow marg">
                <div class="am-panel-hd">
                    <h1>资料完善</h1>
					<p>你的资料将被保密储存起来，你不必担心信息安全问题。你所填写的信息将作为日后的社团服务和校内联络信息，我们鼓励你认真填写，积极配合我们的工作，谢谢。</p>
                </div>
                <div class="am-panel-bd">
                    <div class="am-g">
                        <div class="am-u-sm-12">
                            <table class="am-table am-table-bordered am-table-radius am-table-striped">
                                <tr><td>年级</td><td><?=$_SESSION["user"]["year"];?></td></tr>
                                <tr><td>Form</td><td><?=$_SESSION["user"]["form"];?></td></tr>
                                <tr><td>必修班</td><td><?=$_SESSION["user"]["class"];?></td></tr>
                                <tr><td>House</td><td><?=$_SESSION["user"]["house"];?></td></tr>
                                <tr><td>中文名</td><td><?=$_SESSION["user"]["cName"];?></td></tr>
                                <tr><td>英文名</td><td><?=$_SESSION["user"]["eName"];?></td></tr>
                            </table>
                        </div>
                        <hr>
                        <form class="am-form" method="post">
                            <fieldset>
                                <legend>社团服务和校内联络信息（鼓励填写）</legend>

                                <div class="am-form-group am-form-icon">
                                    <i class="am-icon-weixin"></i>
                                    <input type="text" class="am-form-field am-round" name="wechat" placeholder="微信号" value="<?php echo $this->wechatid?>">
                                </div>

                                <div class="am-form-group am-form-icon">
                                    <i class="am-icon-phone"></i>
                                    <input name="mobile" type="number" maxlength="11" class="am-form-field am-round" placeholder="手机号码" value="<?php echo $this->mobilenumber?>">
                                </div>


                                <div class="am-form-group">
                                    <label for="gender">性别（可选）</label>
                                    <select id="gender" name="gender">
                                        <option value="n"<?php echo $this->sel1?>>保密</option>
                                        <option value="m"<?php echo $this->sel2?>>男</option>
                                        <option value="f" <?php echo $this->sel3?>>女</option>
                                    </select>
                                    <span class="am-form-caret"></span>
                                </div>

                                <p class="w"></p>
                            </fieldset>
                        </form>
                        <div class="am-u-sm-12">
                            <button class="am-btn am-btn-secondary am-btn-block" id="submit">完成</button>
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
                资料注册成功
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-1" id="failureAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">
                资料修改成功
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
</body>
<?php get_footer(["registerajax.js"]);?>