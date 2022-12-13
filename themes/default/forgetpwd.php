<?php require TEMPLATE . '/inc/_global/config.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="row no-gutters justify-content-center bg-body-dark">
    <div class="hero-static col-sm-10 col-md-8 col-xl-6 d-flex align-items-center p-2 px-sm-0">
        <!-- Reminder Block -->
        <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden bg-image" style="background-image: url('<?php echo $dm->assets_folder; ?>/media/photos/photo19.jpg');">
            <div class="row no-gutters">
                <div class="col-md-6 order-md-1 bg-white">
                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                        <!-- Header -->
                        <div class="mb-2 text-center">
                            <a class="link-fx text-warning font-w700 font-size-h1" href="index.php">
                                <span class="text-dark">裂变</span><span class="text-warning">时代</span>
                            </a>
                            <p class="text-uppercase font-w700 font-size-sm text-muted">Forget Password</p>
                        </div>
                        <!-- END Header -->

                        <!-- Reminder Form -->
                        <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.min.js which was auto compiled from _js/pages/op_auth_reminder.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="forgetpwd-form" method="POST">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-alt" id="email" name="email" placeholder="请输入你的注册邮箱">
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" class="form-control form-control-alt" id="code" name="code" placeholder="邮箱验证码" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success col-sm-12" data-event="forgetpwd" id="sendemail_btn">发送验证码</button>
                                    </div>
                                </div>
                                
                            </div>


                            <div class="form-group">
                                <input type="text" class="form-control form-control-alt" id="newpassword" name="newpassword" placeholder="请输入新密码">
                            </div>


                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-block btn-hero-warning">
                                    <i class="fa fa-fw fa-reply mr-1"></i> 重置密码
                                </button>
                            </div>
                        </form>
                        <!-- END Reminder Form -->
                    </div>
                </div>
                <div class="col-md-6 order-md-0 bg-gd-sun-op d-flex align-items-center">
                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6 text-center">
                        <p class="font-size-h2 font-w700 text-white mb-0">
                            别担心你的账号
                        </p>
                        <p class="font-size-h3 font-w600 text-white-75 mb-0">
                            只需要简单验证就可以为您找回密码
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Reminder Block -->
    </div>
</div>
<!-- END Page Content -->

<?php require TEMPLATE . '/inc/_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_start.php'; ?>
<!-- Page JS Plugins -->
<?php $dm->get_js('js/plugins/bootstrap-notify/bootstrap-notify.min.js'); ?>

<!-- Page JS Helpers (BS Notify Plugin) -->
<script>jQuery(function(){ Dashmix.helpers('notify'); });</script>

<!-- Page JS Plugins -->
<?php $dm->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>

<!-- Page JS Code -->
<?php $dm->get_js('js/pages/forgetpwd.js'); ?>

<?php require TEMPLATE . '/inc/_global/views/footer_end.php'; ?>