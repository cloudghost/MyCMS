<?php
set_title('信息');
get_header();
get_sidebar("eca");
?>
    <div class="admin-content" id="content">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">信息</strong> /
                <small>posts</small>
            </div>
        </div>
        <article class="am-g am-container am-article">
			<div class="am-article-hd">
			<h1 class="am-article-title"><?=cache::getCache('notice_title');?></h1>
			<p class="am-article-meta"><?=cache::getCache('eca_name');?>:<?=cache::getCache('user_sid')?></p>
			</div>
			<div class="am-article-bd">
				<?=cache::getCache('notice_content')?>
			</div>
        </article>
    </div>
</div>
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(['unescape.js']); ?>