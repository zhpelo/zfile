<?php require TEMPLATE . '/inc/_global/config.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="row no-gutters justify-content-center bg-body-dark">
    <div class="hero-static col-sm-10 col-md-8 col-xl-6 d-flex align-items-center p-2 px-sm-0">
        <!-- Lock Block -->
        <!-- jQuery Vide for video backgrounds, for more examples you can check out https://github.com/VodkaBears/Vide -->
        <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden bg-video" data-vide-bg="<?php echo $dm->assets_folder; ?>/media/videos/city_night" data-vide-options="posterType: jpg">
            <div class="row no-gutters">
                <div class="col-md-6 order-md-1 bg-white">
                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                        <!-- Header -->
                        <div class="mb-2 text-center">
                            <a class="link-fx text-danger font-w700 font-size-h1" href="index.php">
                                <span class="text-dark">裂变</span><span class="text-danger">时代</span>
                            </a>
                            <p class="text-uppercase font-w700 font-size-sm text-muted">请输入访问密码！</p>
                        </div>
                        <!-- END Header -->

                        <!-- Lock Form -->
                        <!-- jQuery Validation (.js-validation-lock class is initialized in js/pages/op_auth_lock.min.js which was auto compiled from _js/pages/op_auth_lock.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-lock" method="POST">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-alt" id="access_password" name="access_password" placeholder="请输入访问密码！" require>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-block btn-hero-danger">
                                    <i class="fa fa-fw fa-lock-open mr-1"></i> 提取
                                </button>
                            </div>
                        </form>
                        <!-- END Lock Form -->
                    </div>
                </div>
                <div class="col-md-6 order-md-0 bg-danger-op d-flex align-items-center">
                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6 text-center">
                        <?php $dm->get_avatar(0, 'male', 64, true); ?>
                        <a class="d-block text-white font-size-lg font-w600 mt-3" href="javascript:void(0)"><?php echo $dm->get_name('male'); ?></a>
                        <div class="text-white-75">你的朋友给您分享了一个文件</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Lock Block -->
    </div>
</div>
<!-- END Page Content -->

<?php require TEMPLATE . '/inc/_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $dm->get_js('js/plugins/vide/jquery.vide.min.js'); ?>

<?php require TEMPLATE . '/inc/_global/views/footer_end.php'; ?>