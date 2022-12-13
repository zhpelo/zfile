<?php require TEMPLATE . 'inc/_global/config.php'; ?>
<?php require TEMPLATE . 'inc/landing/config.php'; ?>
<?php require TEMPLATE . 'inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . 'inc/_global/views/head_end.php'; ?>
<?php require TEMPLATE . 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-white overflow-hidden">
    <div class="content content-top text-md-center">
        <?php
        // 文件分享框
        if ($this->action == 'share') {
            if ($type == 'file') {
                require TEMPLATE . 'file/share_file.php';
            } else {
                require TEMPLATE . 'file/share_folder.php';
            }
        }
        ?>
        <div class=" pt-4 pt-lg-6">
            <h1 class="font-w700 mb-2">
                这是一个分享文件就能赚钱的网盘
            </h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="font-size-lg text-muted mb-4">
                    无限存储空间，为您带来更多收益
                </p>
                <div>
                    <a class="btn btn-alt-success px-4 py-2 m-1" href="<?php echo url('vip/index'); ?>">
                        <i class="fa fa-fw fa-shopping-cart opacity-50 mr-1"></i> 开通VIP
                    </a>
                    <a class="btn btn-alt-primary px-4 py-2 m-1" href="<?php echo url('file/index'); ?>">
                        <i class="fa fa-fw fa-rocket opacity-50 mr-1"></i> 立即开始
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-image bg-image-top pt-4 pt-lg-6" style="background-image: url('<?php echo $dm->assets_folder; ?>/media/various/promo_hero_bg.png');">
        <div class="content pb-0">
            <img class="img-fluid" src="/themes/default/img/2.jpg" alt="Hero Promo" style="margin-bottom: -20px;">
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Package  -->
<div id="dm-wpjs" class="bg-white">
    <div class="content content-full">
        <div class="py-5 mt-3 mt-lg-5 text-md-center">
            <p class="font-size-sm text-uppercase text-primary font-w600 mb-2">
                裂变时代·网盘介绍
            </p>
            <h2 class="h1 font-w700 mb-3">
                云计算领域的 专家 团队
            </h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="font-size-lg text-muted mb-0">
                        <strong>裂变网盘</strong>是行业内知名的云存储专家，2021年，我们在中国建立了裂变网盘，目前公司位于河南省新乡市。我们拥有业内知名的云储存技术专家以及稳健的运维团队，能为您提供可靠，稳定的产品与服务。
                    </p>
                </div>
            </div>
        </div>
        <div class="row items-push-2x">
            <div class="col-md-6">
                <!-- HTML Version -->
                <div class="media">
                    <div class="item item-rounded bg-primary text-white-75 font-w600 mr-4">
                        <i class="fa fa-2x fa-sd-card"></i>
                    </div>
                    <div class="media-body">
                        <h4 class="mb-1">安全可靠存储数据</h4>
                        <p class="mb-0">
                            我们使用TechSense Technology ™的3D立体加密存储技术，为所有存储的数据进行安全加密，保证您存储的数据被安全保管。
                        </p>
                    </div>
                </div>
                <!-- END HTML Version -->
            </div>
            <div class="col-md-6">
                <!-- PHP Version -->
                <div class="media">
                    <div class="item item-rounded bg-primary text-white-75 font-w600 mr-4">
                        <i class="fa fa-2x fa-user-shield"></i>
                    </div>
                    <div class="media-body">
                        <h4 class="mb-1">多重加密保护用户信息</h4>
                        <p class="mb-0">
                            我们使用Dynamic Encryption Technology ™三重加密用户的个人资料及密码，确保您的信息不会被他人掌控。
                        </p>
                    </div>
                </div>
                <!-- END PHP Version -->
            </div>
            <div class="col-md-6">
                <!-- Laravel Starter Kit -->
                <div class="media">
                    <div class="item item-rounded bg-primary text-white-75 font-w600 mr-4">
                        <i class="fab fa-2x fa-laravel"></i>
                    </div>
                    <div class="media-body">
                        <h4 class="mb-1">全网络线路支持</h4>
                        <p class="mb-0">
                            我们拥有强大的资源平台和技术背景，在全国设有多个机房为用户提供不间断的上传下载服务，全面覆盖电信、联通、移动。
                        </p>
                    </div>
                </div>
                <!-- END Laravel Starter Kit -->
            </div>
            <div class="col-md-6">
                <!-- Get Started Version -->
                <div class="media push">
                    <div class="item item-rounded bg-primary text-white-75 font-w600 mr-4">
                        <i class="fa fa-2x fa-check"></i>
                    </div>
                    <div class="media-body">
                        <h4 class="mb-1">简洁实用的操作界面</h4>
                        <p class="mb-0">
                            不论从设计风格还是功能内容也都体现了极简主义，没有多余累赘的功能，没有花里胡哨的页面，也不会有弹窗信息。
                        </p>
                    </div>
                </div>
                <!-- END Get Started Version -->
            </div>
        </div>
    </div>
</div>
<!-- END Package -->

<!-- Dashboards -->
<div id="dm-ggtf">
    <div class="content content-full">
        <div class="py-5 mt-3 mt-lg-5 text-md-center">
            <p class="font-size-sm text-uppercase text-primary font-w600 mb-2">
                广告效果真实有效
            </p>
            <h2 class="h1 font-w700 mb-3">
                广告位直销 没有中间商 定价更合理
            </h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="font-size-lg text-muted mb-0">
                        裂变网盘百万流量站内广告位自营直销，没有中间商赚差价，定价更合理，效果更真实。

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="content-max-width mx-auto">
        <div class="row justify-content-center no-gutters">
            <div class="col-xl-10 px-3">
                <div class="row row-deck">
                    <div class="col-sm-6 col-xl-3">
                        <a class="block block-rounded block-link-pop" href="#">
                            <div class="block-content bg-gd-xdream">
                                <div class="pt-2 px-2 pull-b">
                                    <img class="img-fluid" src="/themes/default/img/2.jpg" srcset="<?php echo $dm->assets_folder; ?>/media/various/promo_dashboard_file_hosting@2x.png 2x" alt="File Hosting Dashboard">
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <h4 class="h5 mb-1">
                                    广告位1
                                </h4>
                                <p class="text-muted mb-0">
                                    均在首屏位置，效果显著。
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <a class="block block-rounded block-link-pop" href="#">
                            <div class="block-content bg-gd-xdream">
                                <div class="pt-2 px-2 pull-b">
                                    <img class="img-fluid" src="/themes/default/img/2.jpg" srcset="<?php echo $dm->assets_folder; ?>/media/various/promo_dashboard_file_hosting@2x.png 2x" alt="File Hosting Dashboard">
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <h4 class="h5 mb-1">
                                    广告位2
                                </h4>
                                <p class="text-muted mb-0">
                                    均在首屏位置，效果显著。
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <a class="block block-rounded block-link-pop" href="#">
                            <div class="block-content bg-gd-xdream">
                                <div class="pt-2 px-2 pull-b">
                                    <img class="img-fluid" src="/themes/default/img/2.jpg" srcset="<?php echo $dm->assets_folder; ?>/media/various/promo_dashboard_file_hosting@2x.png 2x" alt="File Hosting Dashboard">
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <h4 class="h5 mb-1">
                                    广告位3
                                </h4>
                                <p class="text-muted mb-0">
                                    均在首屏位置，效果显著。
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <a class="block block-rounded block-link-pop" href="#">
                            <div class="block-content bg-gd-xdream">
                                <div class="pt-2 px-2 pull-b">
                                    <img class="img-fluid" src="/themes/default/img/2.jpg" srcset="<?php echo $dm->assets_folder; ?>/media/various/promo_dashboard_file_hosting@2x.png 2x" alt="File Hosting Dashboard">
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <h4 class="h5 mb-1">
                                    广告位4
                                </h4>
                                <p class="text-muted mb-0">
                                    均在首屏位置，效果显著。
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="py-3 py-sm-5 px-md-7">
            <div class="block block-rounded block-transparent bg-body-dark">
                <div class="block-content block-content-full bg-gd-white-op-l">
                    <div class="row justify-content-sm-between align-items-center p-md-3">
                        <div class="col-sm-6">
                            <h4 class="mb-2">
                                出类拔萃的弹窗广告服务
                            </h4>
                            <p class="text-muted mb-sm-0">
                                城通网盘提供弹窗广告投放服务，用户点击下载页面即弹出您的广告页面，每日百万真实弹出量，效果拔群。
                            </p>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <a class="btn btn-primary px-4 py-2" href="/index.php?a=page&page_url=contact_us">
                                立即获取报价
                                <i class="fa fa-fw fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Dashboards -->

<!-- Widgets Collection -->
<div id="dm-zzlm" class="bg-body-light">
    <div class="content">
        <div class="py-5 mt-3 mt-lg-5 text-md-center">
            <p class="font-size-sm text-uppercase text-primary font-w600 mb-2">
                站长联盟 详细说明
            </p>
            <h2 class="h1 font-w700 mb-3">
                上周提现人数共476人，随机显示100位提现记录
            </h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="font-size-lg text-muted mb-0">
                        裂变网盘分成平台将为上传者提供高达95%的佣金分成。裂变网盘每个IP可以无限次计算收入，与国内其他网盘每天只记录几次的方式不同。
                    </p>
                </div>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-md-6 d-md-flex align-items-md-center">
                <div class="row w-100 gutters-tiny">
                    <div class="col-sm-6">
                        <a class="block text-center bg-image" style="background-image: url('<?php echo $dm->assets_folder; ?>/media/photos/photo19.jpg');" href="javascript:void(0)">
                            <div class="block-content block-content-full bg-gd-fruit-op aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                <div>
                                    <i class="far fa-2x fa-user-circle text-white"></i>
                                    <div class="font-w600 mt-3 text-uppercase text-white">用户邀请</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a class="block text-center bg-image" style="background-image: url('<?php echo $dm->assets_folder; ?>/media/photos/photo19.jpg');" href="javascript:void(0)">
                            <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                <div>
                                    <i class="fa fa-2x fa-inbox text-white"></i>
                                    <div class="font-w600 mt-3 text-uppercase text-white">文件分发</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-5 offset-md-1 d-md-flex align-items-md-center">
                <div class="py-3">
                    <h4 class="mb-2">
                        为什么要选择裂变网盘？
                    </h4>
                    <p class="mb-0 text-muted">
                        裂变网盘是目前分成型网盘中体验较好的网盘。首先我们能为您提供稳定的存储服务，其次我们为您提供更快速的上传下载服务，除此之外，我们提供更少的广告和更简洁的下载页面。
                    </p>
                </div>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-md-6 d-md-flex align-items-md-center">
                <a class="block block-rounded block-link-pop w-100 my-3 bg-image text-center" style="background-image: url('<?php echo $dm->assets_folder; ?>/media/photos/photo18.jpg');" href="javascript:void(0)">
                    <div class="block-content block-content-full bg-white-90">
                        <?php $dm->get_avatar(15, false, 96, true); ?>
                        <p class="font-size-lg font-w600 mb-0 mt-2"><?php $dm->get_name('male'); ?></p>
                        <p class="text-muted mb-0">
                            个人站长
                        </p>
                    </div>
                    <div class="block-content block-content-full bg-white">
                        <div class="row gutters-tiny my-2">
                            <div class="col-4">
                                <p class="mb-2">
                                    <i class="fa fa-fw fa-2x fa-boxes text-muted"></i>
                                </p>
                                <p class="font-size-sm mb-0">
                                    107 分享
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="mb-2">
                                    <i class="fa fa-fw fa-2x fa-user-tie text-muted"></i>
                                </p>
                                <p class="font-size-sm mb-0">
                                    908 粉丝
                                </p>

                            </div>
                            <div class="col-4">
                                <p class="mb-2">
                                    <i class="fa fa-fw fa-2x fa-money-bill-wave text-muted"></i>
                                </p>
                                <p class="font-size-sm mb-0">
                                    1.6k 收入
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-5 offset-md-1 d-md-flex align-items-md-center">
                <div class="py-3">
                    <h4 class="mb-2">
                        品质保证绝不不扣量
                    </h4>
                    <p class="mb-0 text-muted">
                        作为一家运营十多年的网盘，我们深知只有不扣量做好口碑才能在充分竞争的市场下做大做强。城通网盘绝对不扣量，请您放心使用。
                    </p>
                </div>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-md-6 d-md-flex align-items-md-center">
                <a class="block block-rounded w-100 my-3 bg-image" style="background-image: url('<?php echo $dm->assets_folder; ?>/media/photos/photo18.jpg');" href="javascript:void(0)">
                    <div class="block-content block-content-full d-flex justify-content-between bg-primary-dark-op">
                        <div class="mr-3">
                            <p class="text-white font-size-h2 font-w300 mb-0">
                                +150%
                            </p>
                            <p class="text-white-75 font-size-sm font-w700 text-uppercase mb-0">
                                收益效果
                            </p>
                        </div>
                        <div class="mt-2">
                            <i class="fa fa-2x fa-coins text-white-50"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full overflow-hidden bg-primary-dark-op">
                        <!-- Sparkline Container -->
                        <!-- jQuery Sparkline (.js-sparkline class is initialized in Helpers.sparkline() -->
                        <!-- For more info and examples you can check out http://omnipotent.net/jquery.sparkline/#s-about -->
                        <span class="js-sparkline" data-type="line" data-points="[25,36,25,36,48,29,53,64]" data-width="100%" data-height="150px" data-line-color="#fff" data-chart-range-min="15" data-fill-color="transparent" data-spot-color="transparent" data-min-spot-color="transparent" data-max-spot-color="transparent" data-highlight-spot-color="#fff" data-highlight-line-color="#fff" data-tooltip-suffix="Sales"></span>
                    </div>
                </a>
            </div>
            <div class="col-md-5 offset-md-1 d-md-flex align-items-md-center">
                <div class="py-3">
                    <h4 class="mb-2">
                        新人扶植计划
                    </h4>
                    <p class="mb-0 text-muted">
                        新开分成账户专享1元1次点击，25次点击即可获得25元佣金！分享大文件可享更高收入分成，电脑小白也可轻轻松松月入上万。
                    </p>
                </div>
            </div>
        </div>
        <div class="py-3 py-sm-5 px-md-7">
            <div class="block block-rounded block-transparent bg-body">
                <div class="block-content block-content-full bg-gd-white-op-l">
                    <div class="row justify-content-sm-between align-items-center p-md-3">
                        <div class="col-sm-6">
                            <h4 class="mb-2">
                                大客户合作
                            </h4>
                            <p class="text-muted mb-sm-0">
                                如果您有超大网站，可以和我们的找招商客服一对一谈谈！
                            </p>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <a class="btn btn-primary px-4 py-2" href="/index.php?a=page&page_url=contact_us">
                                联系我们
                                <i class="fa fa-fw fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Widgets Collection -->



<!-- Smart Toolkit -->
<div id="dm-toolkit" class="bg-white">
    <div class="content content-full">
        <div class="py-5 mt-3 mt-lg-5 text-md-center">
            <p class="font-size-sm text-uppercase text-primary font-w600 mb-2">
                需要优质IDC资源也可与我们联系
            </p>
            <h2 class="h1 font-w700 mb-3">
                使用我们的技术团队
            </h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="font-size-lg text-muted mb-0">
                        裂变网盘拥有多项先进技术，确保用户存储的数据99.99%可用，99.99%安全。不计成本，只为确保您的数据安全。
                    </p>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <div class="row py-3">
                <div class="col-md-5 d-md-flex align-items-md-center">
                    <div>
                        <h4 class="mb-2">
                            分布式数据存储解决方案
                        </h4>
                        <p class="mb-0 text-muted">
                            裂变时代 是知名云计算及数据服务提供商，在海量文件存储、CDN 内容分发、视频点播、互动直播及大规模异构数据的智能分析与处理等技术深度投入，致力以数据科技驱动数字化未来，赋能各行业全面进入数据时代。
                        </p>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1 d-md-flex align-items-md-center">
                    <div class="block block-rounded block-fx-pop row gutters-tiny w-100 py-4 my-3">
                        <div class="col-6">
                            <div class="item item-2x item-rounded ml-auto bg-xinspire-lighter">
                                <i class="fa fa-2x fa-server text-xinspire-dark"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item item-2x item-rounded mr-auto bg-xinspire-lighter">
                                <i class="fa fa-2x fa-redo fa-spin text-xinspire-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-md-5 d-md-flex align-items-md-center">
                    <div>
                        <h4 class="mb-2">
                            云主机服务
                        </h4>
                        <p class="mb-0 text-muted">
                            云主机秒级创建，海量计算资源瞬间获得，完美相应业务需求，随时调整配置，多种计费模式灵活选择，无缝衔接丰富产品，持续为业务发展提供完整的计算、储存、安全等解决方案。
                        </p>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1 d-md-flex align-items-md-center">
                    <div class="block block-rounded block-fx-pop row no-gutters w-100 py-4 my-3">
                        <div class="col-4">
                            <div class="item item-2x item-rounded mx-auto bg-xsmooth-lighter">
                                <i class="fab fa-2x fa-sass text-xsmooth-dark"></i>
                            </div>
                        </div>
                        <div class="col-4 d-flex align-items-center justify-content-center">
                            <div class="item item-circle bg-body-dark">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="item item-2x item-rounded mx-auto bg-xwork-lighter">
                                <i class="fab fa-2x fa-css3 text-xwork-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-md-5 d-md-flex align-items-md-center">
                    <div>
                        <h4 class="mb-2">
                            异构数据湖
                        </h4>
                        <p class="mb-0 text-muted">
                            完全自主知识产权，可实现任意来源、任意规模、任意类型数据的全量获取、全量存储、多模式处理与全生命周期管理，助您在 DT 时代持续挖掘海量数据的无限价值。
                        </p>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1 d-md-flex align-items-md-center">
                    <div class="block block-rounded block-fx-pop row no-gutters w-100 py-4 my-3">
                        <div class="col-4">
                            <div class="item item-2x item-rounded mx-auto bg-xplay-lighter">
                                <span class="font-size-lg font-w700 text-xplay-dark">ES6</span>
                            </div>
                        </div>
                        <div class="col-4 d-flex align-items-center justify-content-center">
                            <div class="item item-circle bg-body-dark">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="item item-2x item-rounded mx-auto bg-xwork-lighter">
                                <span class="font-size-lg font-w700 text-xwork-dark">ES5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-md-5 d-md-flex align-items-md-center">
                    <div>
                        <h4 class="mb-2">
                            数据传输
                        </h4>
                        <p class="mb-0 text-muted">
                            独家的 CDN 加速和质量监控体系，可实现全网一体化调度和优化，助您在性能和成本之间得到良好平衡。面向不同音视频数据特别优化的传输网络让数据实现真正闭环。
                        </p>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1 d-md-flex align-items-md-center">
                    <div class="block block-rounded block-fx-pop row no-gutters w-100 py-4 my-3">
                        <div class="item item-2x item-rounded mx-auto bg-xeco-lighter">
                            <i class="fa fa-2x fa-wrench text-xeco-dark"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Smart Toolkit -->

<!-- Handcrafted Design -->
<div id="dm-lxwm" class="bg-body-light overflow-hidden">
    <div class="content content-full">
        <div class="py-5 mt-3 mt-lg-5 text-md-center">
            <p class="font-size-sm text-uppercase text-primary font-w600 mb-2">
                我们的联系方式
            </p>
            <h2 class="h1 font-w700 mb-3">
                如何联系我们
            </h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="font-size-lg text-muted mb-0">
                        新乡市源码科技有限公司于2017年11月10日成立,公司经营范围包括：计算机软硬件的技术开发、技术推广、技术转让、技术咨询、技术服务；计算机系统服务；基础软件服务等。
                    </p>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <div class="row py-3">
                <div class="col-md-5 d-md-flex align-items-md-center">
                    <div>
                        <h4 class="h5 mb-2">
                            联系方式
                        </h4>
                        <p class="mb-0 text-muted">
                            座机：0373-5171417
                        </p>
                        <p class="mb-0 text-muted">
                            邮箱：zpl@sss.ms
                        </p>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1 d-md-flex align-items-md-center">
                    <div class="block block-rounded block-fx-pop row no-gutters w-100 py-4 my-3 overflow-hidden">
                        <div class="row no-gutters text-center w-100 mb-2">
                            <div class="col-4">
                                <div class="item mx-auto">
                                    <i class="si fa-2x si-badge text-info"></i>
                                </div>
                                <strong>专属客服</strong>
                            </div>
                            <div class="col-4">
                                <div class="item mx-auto">
                                    <i class="si fa-2x si-chemistry text-xsmooth"></i>
                                </div>
                                <strong>秒级响应</strong>
                            </div>
                            <div class="col-4">
                                <div class="item mx-auto">
                                    <i class="si fa-2x si-heart text-danger"></i>
                                </div>
                                <strong>关爱服务</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-md-5 d-md-flex align-items-md-center">
                    <div>
                        <h4 class="h5 mb-2">
                            公司地址
                        </h4>
                        <p class="mb-0 text-muted">
                            河南省新乡市市辖区高新区火炬园内HII201-217(2019)
                        </p>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1 offset-md-1 d-md-flex align-items-md-center">
                    <div class="block block-rounded block-fx-pop row no-gutters w-100 py-4 my-3 overflow-hidden">
                        <div class="row no-gutters text-center w-100 mb-2">
                            <div class="col-4">
                                <div class="item mx-auto">
                                    <i class="si fa-2x si-compass text-success"></i>
                                </div>
                                <strong>帮助指南</strong>
                            </div>
                            <div class="col-4">
                                <div class="item mx-auto">
                                    <i class="si fa-2x si-energy text-warning"></i>
                                </div>
                                <strong>闪电处理</strong>
                            </div>
                            <div class="col-4">
                                <div class="item mx-auto">
                                    <i class="si fa-2x si-vector text-xinspire"></i>
                                </div>
                                <strong>售后回访</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Handcrafted Design -->


<!-- Call To Action -->
<div class="bg-image" style="background-image: url('<?php echo $dm->assets_folder; ?>/media/photos/photo19@2x.jpg');">
    <div class="bg-white-95">
        <div class="content content-full">
            <div class="py-5 py-md-8 text-center">
                <h2 class="mb-3">
                    裂变时代·网赚网盘
                </h2>
                <p class="font-size-lg text-muted mb-4">
                    这是一个分享文件就能赚钱的网盘
                </p>
                <a class="btn btn-alt-success px-4 py-2 m-1" href="vip">
                    <i class="fa fa-fw fa-shopping-cart opacity-50 mr-1"></i> 开通VIP
                </a>
                <a class="btn btn-alt-primary px-4 py-2 m-1" href="/index.php?a=file&c=index">
                    <i class="fa fa-fw fa-rocket opacity-50 mr-1"></i> 立即使用
                </a>
            </div>
        </div>
    </div>
</div>
<!-- END Call To Action -->

<!-- Footer -->
<footer id="page-footer" class="bg-white">
    <div class="content py-5">

        
        <div class="row font-size-sm">
            <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                Copyright © 2021 <a class="font-w600" href="https://www.xinxiangapp.com/" target="_blank">新乡市源码科技有限公司</a>
                <br>
                <a class="font-w600" href="https://beian.miit.gov.cn/">豫ICP备18002677号</a> |
                <img src="https://www.xinxiangapp.com/images/gongan.png"/>
                公安备案号<a class="font-w600" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=41070202000914">41070202000914</a>
            </div>
            <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
            <a class="font-w600" href="/index.php?a=page&page_url=privacy_policy">隐私协议</a> <b>|</b>
            <a class="font-w600" href="/index.php?a=page&page_url=report">侵权举报</a> <b>|</b> 
            <a class="font-w600" href="/index.php?a=page&page_url=help">帮助中心</a>



            </div>
        </div>
    </div>
</footer>
<!-- END Footer -->

<?php require TEMPLATE . '/inc/_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_start.php'; ?>
<!-- Page JS Plugins -->
<?php $dm->get_js('js/plugins/jquery-sparkline/jquery.sparkline.min.js'); ?>
<!-- Page JS Helpers (jQuery Sparkline Plugin) -->
<script>
    jQuery(function() {
        Dashmix.helpers(['sparkline']);
    });
</script>
<?php require TEMPLATE . '/inc/_global/views/footer_end.php'; ?>