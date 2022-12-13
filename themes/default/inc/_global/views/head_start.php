<?php
/**
 * head_start.php
 *
 * Author: pixelcave
 *
 * The first block of code used in every page of the template
 *
 */
?>
<!doctype html>
<html lang="zh_CN">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- <title><?php echo $dm->title; ?></title>
        <meta name="description" content="<?php echo $dm->description; ?>"> -->
        <title><?php echo isset($web_title) ? $web_title : '裂变网盘|网赚网盘'; ?> | 裂变时代,分享文件也能赚钱！-www.liebianshidai.com</title>
        <meta name="keywords" content="<?php echo isset($web_keywords) ? $web_title : '裂变网盘,网站网盘,网络硬盘,免费网络硬盘,免费网盘,网盘,网络U盘,免费网络U盘,网盘下载'; ?>">
        <meta name="description" content="<?php echo isset($web_description) ? $web_title : '裂变网盘是一款永久免费的文件分享网盘，即免费网络存储空间服务。注册后可获得支持外链的50TB空间，最大单文件可达4GB，同时为用户提供每万次点击下载1800元的收益。已为国内外数千万用户提供超过 1PB 的网络储存空间。'; ?>">
        <meta name="author" content="<?php echo $dm->author; ?>">
        <meta name="robots" content="<?php echo $dm->robots; ?>">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="<?php echo $dm->title; ?>">
        <meta property="og:site_name" content="<?php echo $dm->name; ?>">
        <meta property="og:description" content="<?php echo $dm->description; ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo $dm->og_url_site; ?>">
        <meta property="og:image" content="<?php echo $dm->og_url_image; ?>">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo $dm->assets_folder; ?>/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo $dm->assets_folder; ?>/media/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $dm->assets_folder; ?>/media/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->