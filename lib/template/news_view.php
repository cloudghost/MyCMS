<?php
set_title('文章阅读');
get_header();
if(empty($_SESSION['media']['ID'])){
	get_sidebar("news");
}else{
	get_sidebar("news_admin");
}
?>
    <div class="admin-content" id="content">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">新闻阅读</strong> /
                <small>News</small>
            </div>
        </div>
        <article class="am-g am-container am-article">
			<div class="am-article-hd">
			<h1 class="am-article-title"><?=cache::getCache('news_title');?></h1>
			<p class="am-article-meta"><?=cache::getCache('media_name');?></p>
			</div>
			<div class="am-article-bd">
				<div class="am-article-lead">
				<?=cache::getCache('news_description')?>
				</div>
				<div class="am-article-divider">
				</div>
				<?=cache::getCache('news_content')?>
			</div>
        </article>
    </div>
</div>
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(['unescape.js']); ?>