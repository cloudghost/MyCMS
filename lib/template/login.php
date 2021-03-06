<?php get_header_raw(); ?>
    <style>
        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }

        .header p {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="am-g">
        <h1>MyCMS</h1>

        <p>请使用CMS账号登陆</p>
    </div>
    <hr/>
</div>
<div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
        <h3>登录</h3>
        <hr>

        <form method="post" class="am-form" action="/login">
            <label for="email">CMS用户名:</label>
            <input type="text" name="sid" id="email" value="">
            <br>
            <label for="password">密码:</label>
            <input type="password" name="pwd" id="password" value="">
            <br>
            <label for="remember-me">
                <input id="remember-me" type="checkbox" name="remember" value="true">
                记住密码
            </label>
            <br/>

            <div class="am-cf">
                <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl am-btn-block">
            </div>
        </form>
        <?php show_message(); ?>
        <hr>
        <p>由 IT Club 制作维护</p>
    </div>
</div>
<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="<?php show_root_url(); ?>/js/polyfill/rem.min.js"></script>
<script src="<?php show_root_url(); ?>/js/polyfill/respond.min.js"></script>
<script src="<?php show_root_url(); ?>/js/amazeui.legacy.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php show_root_url(); ?>/assets/js/jquery.min.js"></script>
<script src="<?php show_root_url(); ?>/assets/js/amazeui.min.js"></script>
<!--<![endif]-->
<script src="<?php show_root_url(); ?>/assets/js/app.js"></script>
</body>
</html>