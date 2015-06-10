<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php get_title(); ?></title>
    <meta name="description" content="SCIE MyCMS，深国交MyCMS">
    <meta name="keywords" content="SCIE,MyCMS,深国交,IT社,SCIEIT,CMS,校园信息系统">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="<?php show_root_url(); ?>/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="<?php show_root_url(); ?>/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="MyCMS"/>
    <link rel="stylesheet" href="<?php show_root_url(); ?>/assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="<?php show_root_url(); ?>/assets/css/admin.css">
	<link rel="stylesheet" href="<?php show_root_url(); ?>/assets/css/switch.css">
    <script src="<?php show_root_url();?>/assets/js/Chart.min.js"></script>
    <?php
if($_SERVER["HTTP_HOST"] === "cms.scie.cf"){?>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?0c9b77c00646f3b21dcbc5b88610ff0f";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
<?php }?>