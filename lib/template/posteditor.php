<?php
set_title("通知发布");
get_header();
get_sidebar("eca"); 
$user=empty($_GET['user_sid'])?null:$_GET['user_sid'];?>
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">通告</strong> /
                <small>通告编写</small>
            </div>
        </div>
		<div class="am-margin">
			<form id="form" name="form" class="am-form">
				<fieldset>
				<legend>发送目标：<?=empty($user)?"全体社员":$user?></legend>
					<input type="hidden" id="id" value="<?=cache::getCache('ecaInfo')['eca_id']?>">
					<input type="hidden" id="user" value="<?=empty($user)?false:$user?>">
					<div class="am-form-group">
						<label for="title" id="lbltitle">标题(0/35)</label>
						<input type="text" class="am-form-field" id="title" placeholder="输入标题" onchange="titl()" >
					</div>
					<div class="am-form-group">
						<label for="author" id="lblauthor">作者</label>
						<input type="text" class="am-form-field" id="author" value="<?=cache::getCache('ecaInfo')['eca_name'].": ".$_SESSION['user']['sidRaw'];?>" disabled>
					</div>
					<div class="am-form-group">
						<label for="abstract" id="lblabstract">内容(0/250)</label>
						<textarea class="am-form-field" rows="5" id="content" placeholder="内容" onchange="conten()" ></textarea>
					</div>
					<div class="am-margin">
						<button type="button" class="am-btn am-btn-primary am-radius" id="submit" name="submit">发送</button>
					</div>
				 </fieldset>	
			</form>
        </div>
    </div>
    <!-- content end-->
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(["posteditor.js"]); ?>