<?php
/**
 * landing/views/inc_header.php
 *
 * Author: pixelcave
 *
 * The header of landing page
 *
 */
?>

<!-- Header -->
<header id="page-header" class="invisible" data-toggle="appear" data-class="animated fadeIn" data-timeout="500">
    <!-- Header Content -->
    <div class="content-header justify-content-center justify-content-lg-between">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
            <!-- Logo -->
            <a class="font-size-lg font-w600 text-dark" href="/">
                裂变<span class="text-primary">时代</span>
            </a>
            <!-- END Logo -->
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="d-none d-lg-flex align-items-center">
            <!-- Menu -->
            <ul class="nav-main nav-main-horizontal nav-main-hover">
                <li class="nav-main-item">
                    <a class="nav-main-link" data-toggle="scroll-to" data-speed="750" href="/">
                        <i class="nav-main-link-icon fa fa-home"></i>
                        <span class="nav-main-link-name">首页</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link" data-toggle="scroll-to" data-speed="750" href="#dm-wpjs">
                        <i class="nav-main-link-icon fa fa-desktop"></i>
                        <span class="nav-main-link-name">网盘介绍</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" data-toggle="scroll-to" data-speed="750" href="#dm-ggtf">
                        <i class="nav-main-link-icon fa fa-box"></i>
                        <span class="nav-main-link-name">广告投放</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" data-toggle="scroll-to" data-speed="750" href="#dm-zzlm">
                        <i class="nav-main-link-icon fa fa-compass"></i>
                        <span class="nav-main-link-name">站长联盟</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" data-toggle="scroll-to" data-speed="750" href="#dm-lxwm">
                        <i class="nav-main-link-icon fa fa-puzzle-piece"></i>
                        <span class="nav-main-link-name">联系我们</span>
                    </a>
                </li>


                <li class="nav-main-item">

                    <?php if (is_login()) { ?>
                        <a class="nav-main-link"href="/file/index">
                            <i class="nav-main-link-icon fa fa-user"></i>
                            <span class="nav-main-link-name">用户中心</span>
                        </a>

                    <?php } else { ?>

                        <a class="nav-main-link" data-toggle="scroll-to" data-speed="750" href="/user/login">
                            <i class="nav-main-link-icon fa fa-heartbeat"></i>
                            <span class="nav-main-link-name">登录/注册</span>
                        </a>

                    <?php } ?>
                    
                </li>
            </ul>
            <!-- END Menu -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-primary">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.php" method="POST">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-primary" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control border-0" placeholder="请输入搜索词" id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
       </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-primary-darker">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->
