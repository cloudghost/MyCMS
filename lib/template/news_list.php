<?php
set_title("新闻列表");
get_header();
if(empty($_SESSION['media']['ID'])){
	get_sidebar("news");
}else{
	get_sidebar("news_admin");
} ?>
    <div class="admin-content">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">新闻列表</strong> /
                <small>News List</small>
            </div>

            <div class="am-show-md-up">
                <div class="am-fr">
                    <form class="am-form-inline" onsubmit=" return search()">
                       <div class="am-form-group am-form-icon">
                        <i class="am-icon-search"></i>
                        <input type="text" id="searchText" class="am-form-field am-input-sm" placeholder="新闻">

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
                        <input type="text" class="am-form-field am-input-sm" placeholder="新闻">
                    </div>
            </form>

            <button id="search" class="am-btn am-btn-block am-btn-secondary am-input-sm">搜索</button>

        </div>


        <div class="am-g" id='content'>
<?php while ($row = get_news_list()) { ?>
    <div class="am-u-sm-12">
        <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
                <div class="am-g">
                    <div class="am-u-sm-8">
                        <h2 class="am-inline">
                            <?= $row["news_title"]; ?>
                        </h2>
                        <br>
                        <span class="am-badge am-badge-success am-text-md">由 <?=$row["media_name"];?> </br>发布于:<?php echo date('Y-m-d H:i:s',$row["news_submit_time"]); ?></span>
                    </div>
                    <div class="am-u-sm-3">
                        <div class="am-vertical-align">
                            <div class="am-vertical-align-middle">
                                <a  class="am-btn am-btn-primary" role="button" href="http://<?=$_SERVER["HTTP_HOST"];?>/index.php?action=news&method=view&news=<?php echo $row['news_id'];?>">查看</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="am-panel-footer">
                <small><?= $row["news_description"]; ?></small>
            </div>
        </div>
    </div>
<?php } ?>
        </div>
    </div>
</div>
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(['unescape.js']); ?>