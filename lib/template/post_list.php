<?php
set_title("信息中心");
get_header();
get_sidebar("cms");
?>
    <div class="admin-content">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">最新信息</strong> /
                <small>Post List</small>
            </div>

            <div class="am-show-md-up">
                <div class="am-fr">
                    <form class="am-form-inline" onsubmit=" return search()">
                       <div class="am-form-group am-form-icon">
                        <i class="am-icon-search"></i>
                        <input type="text" id="searchText" class="am-form-field am-input-sm" placeholder="信息">

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
                        <input type="text" class="am-form-field am-input-sm" placeholder="信息">
                    </div>
            </form>

            <button id="search" class="am-btn am-btn-block am-btn-secondary am-input-sm">搜索</button>

        </div>


    <div class="am-u-sm-12 am-panel-group" id="content">
		<section class="am-panel am-panel-warning">
			<div class="am-panel-hd">
				<h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#newpost'}">
					未读信息
				</h4>
			</div>
			<div class="am-collapse am-in" id="newpost">
				<table class="am-table">
					<thead>
						<th>发布者</th>
						<th>标题</th>
						<th>时间</th>
						<th>操作</th>
					</thead>
					<tbody>
						<?php while ($row = get_new_post_list()) { ?>
							<tr>
								<td><?=$row["eca_name"];?></td>
								<td><?= $row["notice_title"];?></td>
								<td><?php echo date('Y-m-d H:i:s',$row["notice_submit_time"]); ?></td>
								<td>
									<div class="am-btn-group">
										<a type="button" class="am-btn am-btn-secondary" href="http://<?=$_SERVER['HTTP_HOST']?>/index.php?action=post&method=view&noticeid=<?=$row["notice_id"]?>">查看</a>
									</div>
								</td>
							</td>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="am-panel-footer">共<?=get_new_post()?>条信息</div>
		</section>
		<section class="am-panel am-panel-default">
			<div class="am-panel-hd">
				<h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#oldpost'}">
					全部消息
				</h4>
			</div>
			<div class="am-collapse" id="oldpost">
				<table class="am-table">
					<thead>
						<th>发布者</th>
						<th>标题</th>
						<th>时间</th>
						<th>操作</th>
					</thead>
					<tbody>
						<?php if(cache::getCache("post_list")) {
								foreach(cache::getCache("post_list") as $row2){?>
							<tr>
								<td><?=$row2["eca_name"];?></td>
								<td><?= $row2["notice_title"];?></td>
								<td><?php echo date('Y-m-d H:i:s',$row2["notice_submit_time"]); ?></td>
								<td>
									<div class="am-btn-group">
										<a type="button" class="am-btn am-btn-primary" href="http://<?=$_SERVER['HTTP_HOST']?>/index.php?action=post&method=view&noticeid=<?=$row2["notice_id"]?>">查看</a>
									</div>
								</td>
							</td>
								<?php }}else{
								} ?>
					</tbody>
				</table>
			</div>
			<div class="am-panel-footer">共<?php 
				$result=cache::getCache('post_list');
				echo empty($result) ? 0 :count($result);
			?>条信息</div>
		</section>
	</div>
        </div>
    </div>
</div>
    <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
       data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(['unescape.js']); ?>