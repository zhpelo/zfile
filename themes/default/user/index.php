<?php require TEMPLATE . '/inc//_global/config.php'; ?>
<?php require TEMPLATE . '/inc//backend/config.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-image" style="background-image: url('<?php echo $dm->assets_folder; ?>/media/photos/photo17@2x.jpg');">
    <div class="bg-black-75">
        <div class="content content-full">
            <div class="py-5 text-center">
                <a class="img-link" href="be_pages_generic_profile.php">
                    <?php $dm->get_avatar(10, '', 96, true); ?>
                </a>
                <h1 class="font-w700 my-2 text-white">修改头像</h1>
                <h2 class="h4 font-w700 text-white-75">
                    用户名
                </h2>
            </div>
       </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-full content-boxed">
    <div class="block block-rounded">
        <div class="block-content">
            <form action="be_pages_projects_edit.php" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                <!-- User Profile -->
                <h2 class="content-heading pt-0">
                    <i class="fa fa-fw fa-user-circle text-muted mr-1"></i> 资料修改
                </h2>
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="text-muted">
                        你账户的重要信息。您的用户名将公开可见。
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="dm-profile-edit-username">用户名</label>
                            <input type="text" class="form-control" id="dm-profile-edit-username" name="dm-profile-edit-username" placeholder="Enter your username.." value="<?php echo $_SESSION['user']['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nickname">昵称</label>
                            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="昵称.." value="<?php echo $template_data['nickname']; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="bio">个人简介</label>
                            <input type="text" class="form-control" id="bio" name="bio" placeholder="个人简介.." value="<?php echo $template_data['bio']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="dm-profile-edit-email">邮箱</label>
                            <div class="input-group">
                                <input type="text" id="inputEmailcode" name="code" class="form-control" placeholder="验证码" value="<?php echo $template_data['email']; ?>" readonly required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success col-sm-12">修改邮箱</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>你的头像</label>
                            <div class="push">
                                <?php $dm->get_avatar(10); ?>
                            </div>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="dm-profile-edit-avatar" name="dm-profile-edit-avatar">
                                <label class="custom-file-label" for="dm-profile-edit-avatar">Choose a new avatar</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END User Profile -->

                <!-- Change Password -->
                <h2 class="content-heading pt-0">
                    <i class="fa fa-fw fa-asterisk text-muted mr-1"></i> 修改密码
                </h2>
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="text-muted">
                            更改登录密码是保持帐户安全的一种简单方法。
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="dm-profile-edit-password">Current Password</label>
                            <input type="password" class="form-control" id="dm-profile-edit-password" name="dm-profile-edit-password">
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="dm-profile-edit-password-new">New Password</label>
                                <input type="password" class="form-control" id="dm-profile-edit-password-new" name="dm-profile-edit-password-new">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="dm-profile-edit-password-new-confirm">Confirm New Password</label>
                                <input type="password" class="form-control" id="dm-profile-edit-password-new-confirm" name="dm-profile-edit-password-new-confirm">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Change Password -->

                <!-- Connections -->
                <h2 class="content-heading pt-0">
                    <i class="fa fa-fw fa-share-alt text-muted mr-1"></i> 第三方账号绑定
                </h2>
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="text-muted">
                            You can connect your account to third party networks to get extra features.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-7">
                        <div class="form-group row">
                            <div class="col-sm-10 col-md-8 col-xl-6">
                                <a class="btn btn-block btn-alt-danger text-left" href="javascript:void(0)">
                                    <i class="fab fa-fw fa-google opacity-50 mr-1"></i> Connect to Google
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 col-md-8 col-xl-6">
                                <a class="btn btn-block btn-alt-info text-left" href="javascript:void(0)">
                                    <i class="fab fa-fw fa-twitter opacity-50 mr-1"></i> Connect to Twitter
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 col-md-8 col-xl-6">
                                <a class="btn btn-block btn-alt-primary bg-transparent d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                    <span>
                                        <i class="fab fa-fw fa-facebook mr-1"></i> John Doe
                                    </span>
                                    <i class="fa fa-fw fa-check mr-1"></i>
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-6 mt-1 d-md-flex align-items-md-center font-size-sm">
                                <a class="btn btn-sm btn-light btn-rounded" href="javascript:void(0)">
                                    <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Facebook Connection
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 col-md-8 col-xl-6">
                                <a class="btn btn-block btn-alt-warning bg-transparent d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                    <span>
                                        <i class="fab fa-fw fa-instagram mr-1"></i> @john_doe
                                    </span>
                                    <i class="fa fa-fw fa-check mr-1"></i>
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-6 mt-1 d-md-flex align-items-md-center font-size-sm">
                                <a class="btn btn-sm btn-light btn-rounded" href="javascript:void(0)">
                                    <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Instagram Connection
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Connections -->

           

                <!-- Submit -->
                <div class="row push">
                    <div class="col-lg-8 col-xl-5 offset-lg-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">
                                <i class="fa fa-check-circle mr-1"></i> Update Profile
                            </button>
                        </div>
                    </div>
                </div>
                <!-- END Submit -->
            </form>
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require TEMPLATE . '/inc//_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/footer_start.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/footer_end.php'; ?>
