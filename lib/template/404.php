<?php
set_title("404 错误");
get_header_raw(); ?>

    <body>
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">404</strong> /
                <small>That’s an error</small>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <h2 class="am-text-center am-text-xxxl am-margin-top-lg">404. Not Found</h2>

                <p class="am-text-center">没有找到你要的页面</p>

                <div style="margin: 0 auto;">
                    <pre style="background: #fff;border: none;width: 200px;margin: 0 auto;">
          .----.
       _.'__    `.
   .--($)($$)---/#\
 .' @          /###\
 :         ,   #####
  `-..__.-' _.-\###/
        `;_:    `"'
      .'"""""`.
     /,  ya ,\\
    //  404!  \\
    `-._______.-'
    ___`. | .'___
   (______|______)
                    </pre>
                </div>
                <p class="am-text-center"><a href="/">回到首页</a></p>
            </div>
            <div class="am-u-sm-12">
                <?php show_message(); ?>
            </div>
        </div>

    </div>

    </body>
<?php get_footer(); ?>