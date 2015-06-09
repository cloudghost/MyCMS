<?php
set_title("ECA点名");
get_header_raw(); ?>

    <body>
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">社团助手</strong> /
                <small>点名二维码</small>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12 am-text-center">
				<input type="hidden" id="id" value="<?php echo $this->id?>">
                <h2 class="am-text-center am-text-xxxl am-margin-top-lg">QRcode Generation</h2>
				<p>本网页每隔5秒钟将自动更新数据。若连续超过三次连接失败，请尝试刷新网页。</p>
				<?php echo $this->code;?>
				</br>
				<a href="/" class="am-btn am-btn-primary am-round">回到首页</a>
				<hr>
				<table class="am-table am-u-sm-12 am-text-center">
					<thead>
						<tr class="am-primary">
							<th colspan="2" id="attendnum">已签到人数：</th>
						</tr>
					</thead>
					<tbody id="listsid">
						<!--ajax自动获取表格内容-->
					</tbody>
				</table>
            </div>
        </div>
    </div>
    </body>
<?php get_footer(["rollcallingajax.js"]);?>