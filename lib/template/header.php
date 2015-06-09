<?php get_header_raw();?>
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，SCIE CMS 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->
<header class="am-topbar am-topbar-inverse admin-header">
    <h1 class="am-topbar-brand">
        <strong>MyCMS</strong>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
            data-am-collapse="{target: '#doc-topbar-collapse-4'}"><span class="am-sr-only">导航切换</span> <span
            class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse-4">
        <ul class="am-nav am-nav-pills am-topbar-nav">
            <li id="cms"><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/"><span class="am-icon-calendar-o"></span> CMS</a></li>
            <li id="eca"><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/eca/"><span class="am-icon-users"></span> 社团</a></li>
        </ul>
		<div class="am-topbar-right">
			<ul class="am-nav am-nav-pills am-topbar-nav">
				<li class="am-dropdown" data-am-dropdown>
					<a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
						我的账户 <span class="am-icon-caret-down"></span>
					</a>
					<ul class="am-dropdown-content">
						<li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/register/user"><span class="am-icon-user-secret"></span> &nbsp 个人信息</a></li>
						<li><a href="http://www.scieit.tk/comming-soon.php"><span class="am-icon-gear"></span> &nbsp 偏好设置</a></li>
						<li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/index.php?action=functions&name=logOut"><span class="am-icon-sign-out"></span> &nbsp 注销</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="am-topbar-right">
			<ul class="am-nav am-nav-pills am-topbar-nav">
				<li class="am-dropdown" data-am-dropdown>
					<a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
						信息中心<?php echo (get_new_post())? "<span class=\"am-badge am-badge-warning am-radius\">".get_new_post()."</span>" : ""; ?><span class="am-icon-caret-down"></span>
					</a>
					<ul class="am-dropdown-content">
						<li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/news/list"><span class="am-icon-newspaper-o"></span> &nbsp 校园新闻 &nbsp <span class="am-icon-star admin-icon-yellow"></span></a></li>
						<li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/post/list"><span class="am-icon-file-archive-o"></span> &nbsp 未读消息 &nbsp <?php echo (get_new_post())? "<span class=\"am-badge am-badge-danger am-radius\">".get_new_post()."</span>" : ""?></a></li>
					</ul>
				</li>
			</ul>
		</div>
    </div>
    </div>
</header>