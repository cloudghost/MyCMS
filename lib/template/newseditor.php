<?php
$username = $_SESSION["user"]["cName"];
set_title("文章编写");
get_header();
if(empty($_SESSION['media']['ID'])){
	get_sidebar("news");
}else{
	get_sidebar("news_admin");
} ?>
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">新闻</strong> /
                <small>新闻编辑</small>
            </div>
        </div>
		<div class="am-margin">
			<form id="form" name="form" class="am-form">
				<fieldset>
				<legend>文章编写</legend>
					<input type="hidden" class="" id="id" value ="<?php echo cache::getCache('news_id')!=false ? cache::getCache('news_id'): ""?>">
					<div class="am-form-group">
						<label for="title" id="lbltitle">标题(0/35)</label>
						<input type="text" class="am-form-field" id="title" placeholder="输入标题" onchange="titl()" <?php echo false!=cache::getCache('news_title') ? "value=\"".cache::getCache('news_title')."\"": ""?> >
					</div>
					<div class="am-form-group">
						<label for="author" id="lblauthor">作者</label>
						<input type="text" class="am-form-field" id="author" value="<?=cache::getCache('media_name')?>" <?php echo false!=cache::getCache('media_name') ? "value=\"".cache::getCache('media_name')."\"": ""?> disabled>
					</div>
					<div class="am-form-group">
						<label for="abstract" id="lblabstract">摘要(0/250)</label>
						<textarea class="am-form-field" rows="5" id="abstract" placeholder="输入摘要" onchange="abstrac()" ><?php echo false!=cache::getCache('news_description') ? cache::getCache('news_description'): ""?></textarea>
					</div>
					<div class="am-form-group">
						<label for="content" id="lblcontent">内容(0/60000)</label>
						<textarea class="am-form-field" rows="20" id="content" placeholder="输入内容" ><?php echo false!=cache::getCache('news_content') ? cache::getCache('news_content'): ""?></textarea>
					</div>
					<div class="am-margin">
						<button type="button" class="am-btn am-btn-primary am-radius" id="submit" name="submit">提交</button>
					</div>
				 </fieldset>	
			</form>
        </div>
    </div>
    <!-- content end-->
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(["ckeditor/ckeditor.js","runckeditor.js"]); ?>