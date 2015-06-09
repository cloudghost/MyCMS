<?php
set_title("MyCMS · CMS高大上版");
get_header_raw(); ?>
<style>
    .get {
        background: #1E5B94;
        color: #fff;
        text-align: center;
        padding: 100px 0;
    }

    .get-title {
        font-size: 200%;
        border: 2px solid #fff;
        padding: 20px;
        display: inline-block;
    }

    .get-btn {
        background: #fff;
    }

    .detail {
        background: #fff;
    }

    .detail-h2 {
        text-align: center;
        font-size: 150%;
        margin: 40px 0;
    }

    .detail-h3 {
        color: #1f8dd6;
    }

    .detail-p {
        color: #7f8c8d;
    }

    .detail-mb {
        margin-bottom: 30px;
    }

    .hope {
        background: #0bb59b;
        padding: 50px 0;
    }

    .hope-img {
        text-align: center;
    }

    .hope-hr {
        border-color: #149C88;
    }

    .hope-title {
        font-size: 140%;
    }

    .about {
        background: #fff;
        padding: 40px 0;
        color: #7f8c8d;
    }

    .about-color {
        color: #34495e;
    }

    .about-title {
        font-size: 180%;
        padding: 30px 0 50px 0;
        text-align: center;
    }

    .footer p {
        color: #7f8c8d;
        margin: 0;
        padding: 15px 0;
        text-align: center;
        background: #2d3e50;
    }
</style>
</head>
<body>
<header class="am-topbar am-topbar-fixed-top">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <strong>MyCMS</strong>
            <small>CMS·高大上版</small>
        </h1>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
                data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
                class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="collapse-head">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                <!--
                <li class="am-active"><a href="index.html">首页</a></li>
                <li><a href="#">功能介绍</a></li>
                <li class="am-dropdown" data-am-dropdown>
                    <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                        关于我们 <span class="am-icon-caret-down"></span>
                    </a>

                    <ul class="am-dropdown-content">
                        <li class="am-dropdown-header">Wellcome to IT Club</li>
                        <li><a href="#">IT Club</a></li>
                        <li><a href="#">技术支持</a></li>
                        <li><a href="#">加入我们</a></li>
                        <li><a href="#">赞助</a></li>
                    </ul>-->
                </li>
            </ul>


            <div class="am-topbar-right">
                <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm"><a href="/login" style="color:#FFF"><span
                            class="am-icon-user"></span> 登录</a></button>
            </div>
        </div>
    </div>
</header>

<div class="get">
    <div class="am-g">
        <div class="am-u-lg-12">
            <h1 class="get-title">IT Club · MyCMS</h1>

            <p>
                致力打造国交最好用的CMS辅助系统
            </p>

            <p>
                <a href="/login" class="am-btn am-btn-sm get-btn">登陆</a>
            </p>
        </div>
    </div>
</div>

<div class="detail">
    <div class="am-g am-container">
        <div class="am-u-lg-12">
            <h2 class="detail-h2">以一种全新的姿势浏览CMS!</h2>

            <div class="am-g">
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">

                    <h3 class="detail-h3">
                        <i class="am-icon-mobile am-icon-sm"></i>
                        适配各种屏幕
                    </h3>

                    <p class="detail-p">
                        更麻烦的移动和缩放说再见！前端网页采用由专业人士制作的HTML + CSS 框架，无论你用的是电脑，平板还是手机，都可以得到针对你屏幕大小的最佳体验。
                    </p>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-cogs am-icon-sm"></i>
                        学生定制
                    </h3>

                    <p class="detail-p">
                        为广大同学制作的CMS，从各位的方便使用出发。我们取消了烦人的验证码，采用cookie来保持你账号的持续登陆，并且对各种CMS条目的显示方式做了优化。
                    </p>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-check-square-o am-icon-sm"></i>
                        服务范围广泛
                    </h3>

                    <p class="detail-p">
                        MyCMS会持续提供跟新，未来会有社团管理功能，校内论坛（再也不用去百度贴吧调戏考生了）等等各种特殊模块的加入
                    </p>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                    <h3 class="detail-h3">
                        <i class="am-icon-send-o am-icon-sm"></i>
                        轻量级，高性能
                    </h3>

                    <p class="detail-p">
                        一切以流量和速度为本！再也没有学校官网铺天盖地的图片和flash动画了。一切信息从简。
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hope">
    <div class="am-g am-container">
        <div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-img">
            <img src="<?php show_root_url(); ?>/assets/i/examples/landing.png" alt=""
                 data-am-scrollspy="{animation:'slide-left', repeat: false}">
            <hr class="am-article-divider am-show-sm-only hope-hr">
        </div>
        <div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
            <h2 class="hope-title">同我们一起打造一个信息化未来</h2>

            <p>
                同为国交学生，甘愿只是等待科技为你带来便利？</br>为什么不主动为别人送去方便？
            </p>

            <p>
                招手各种人手完善系统ing。
            </p>
            <ul>
                <li>专门搞HTML，CSS 和 javascript的前端</li>
                <li>网页配色和设计的PS高手</li>
                <li>后台代码和数据库维护的程序猿</li>
            </ul>
        </div>
    </div>
</div>


<footer class="footer">
    <p class="am-padding-left">由 IT Club 制作维护 系统版本： 1.0</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="<?php show_root_url();?>/assets/js/polyfill/rem.min.js"></script>
<script src="<?php show_root_url();?>/assets/js/polyfill/respond.min.js"></script>
<script src="<?php show_root_url();?>/assets/js/amazeui.legacy.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php show_root_url(); ?>/assets/js/jquery.min.js"></script>
<script src="<?php show_root_url(); ?>/assets/js/amazeui.min.js"></script>
<!--<![endif]-->
</body>
</html>