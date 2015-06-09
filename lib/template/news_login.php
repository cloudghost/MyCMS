<?php
set_title("媒体登陆");
get_header();
get_sidebar("news"); ?>
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">新闻</strong> /
                <small>媒体登陆</small>
            </div>
        </div>
		<div class="am-margin">
			<form id="form" name="form" class="am-form">
				<fieldset>
				<legend>登陆</legend>
					<div class="am-form-group">
						<label for="id">媒体ID</label>
						<input type="text" class="am-form-field" id="id">
					</div>
					<div class="am-form-group">
						<label for="pas">密码</label>
						<input type="password" class="am-form-field" id="pas">
					</div>
					<label>
						<input type="checkbox" id="remember"> 记住登陆
					</label>
					</br>
					<button type="button" class="am-btn am-btn-primary am-radius" id="login" name="login" onclick="Login()">登陆</button>
				 </fieldset>	
			</form>
        </div>
    </div>
	<div class="am-modal am-modal-alert" tabindex="-1" id="failureAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">失败</div>
            <div class="am-modal-bd">
                ID或密码有误。
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-1" id="successAlert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">欢迎</div>
            <div class="am-modal-bd">
                登陆成功！
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
    <!-- content end-->
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(["newslogin.js"]); ?>