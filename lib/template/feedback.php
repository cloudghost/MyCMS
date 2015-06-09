<?php
set_title("反馈");
get_header();
get_sidebar(); ?>
  <!-- content start -->
  <div class="admin-content">

    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">考试时间表</strong> / <small>Exam Table</small></div>
    </div>

    <div class="am-g">
      <div class="am-u-sm-12">
          <h2>用户讨论</h2>
          <div class="ds-thread" data-thread-key="1" data-title="MyCMS评论语与槽" data-url="http://cms.scie.cf/feedback"></div>
          <!-- 多说评论框 end -->
          <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
          <script type="text/javascript">
              var duoshuoQuery = {short_name:"mycms-scie"};
              (function() {
                  var ds = document.createElement('script');
                  ds.type = 'text/javascript';ds.async = true;
                  ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                  ds.charset = 'UTF-8';
                  (document.getElementsByTagName('head')[0]
                  || document.getElementsByTagName('body')[0]).appendChild(ds);
              })();
          </script>
          <!-- 多说公共JS代码 end -->

    </div>
  </div>
  <!-- content end -->
</div>

<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>
<?php get_footer(); ?>