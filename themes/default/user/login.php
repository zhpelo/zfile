<?php require TEMPLATE . '/inc/_global/config.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="row no-gutters justify-content-center bg-body-dark">
    <div class="hero-static col-sm-10 col-md-8 col-xl-6 d-flex align-items-center p-2 px-sm-0">
        <!-- Sign In Block -->
        <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden bg-image" style="background-image: url('<?php echo $dm->assets_folder; ?>/media/photos/photo20@2x.jpg');">
            <div class="row no-gutters">
                <div class="col-md-6 order-md-1 bg-white">
                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                        <!-- Header -->
                        <div class="mb-2 text-center">
                            <a class="link-fx font-w700 font-size-h1" href="index.php">
                                <span class="text-dark">裂变</span><span class="text-primary">时代</span>
                            </a>
                            <p class="text-uppercase font-w700 font-size-sm text-muted">Sign In</p>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-signin"  method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-alt" id="login-username" name="username" placeholder="用户名">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-alt" id="login-password" name="password" placeholder="密码">
                            </div>

                            <div>
                                <a class="float-left" href="/index.php?a=forgetpwd">忘记密码？</a>
                                <a class="float-right" href="/index.php?a=register"> 注册账号</a> 
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group mt-3">
                                
                                <button type="submit" class="btn btn-block btn-hero-primary">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> 立即登录
                                </button>
                            </div>
                        </form>
                        <!-- END Sign In Form -->
                    </div>
                </div>
                <div class="col-md-6 order-md-0 bg-primary-dark-op d-flex align-items-center">
                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                        <div class="media">
                            <a class="img-link mr-3" href="javascript:void(0)">
                                <?php $dm->get_avatar(0, 'male', 64, true); ?>
                            </a>
                            <div class="media-body">
                                <p class="text-white font-w600 mb-1">
                                    通过裂变网盘，我的网站成功实现盈利，从此不再为爱发电！
                                </p>
                                <a class="text-white-75 font-w600" href="javascript:void(0)"><?php echo $dm->get_name('male'); ?>, 个人站长</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Sign In Block -->
    </div>
</div>
<!-- END Page Content -->

<?php require TEMPLATE . '/inc/_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $dm->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>

<!-- Page JS Code -->
<?php $dm->get_js('js/pages/op_auth_signin.min.js'); ?>

<?php require TEMPLATE . '/inc/_global/views/footer_end.php'; ?>