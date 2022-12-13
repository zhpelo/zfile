<?php require TEMPLATE . '/inc//_global/config.php'; ?>
<?php require TEMPLATE . '/inc//backend/config.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/page_start.php'; ?>



<!-- Page Content -->
<div class="content content-full content-boxed">
    <div class="block block-rounded">
        <div class="block-content">
            <form action="" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                <!-- User Profile -->
                <h2 class="content-heading pt-0">
                    <i class="fa fa-fw fa-user-circle text-muted mr-1"></i> 实名认证
                </h2>
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="text-muted">
                        需要先实名认证后，才能进一步操作
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="dm-profile-edit-username">真实姓名</label>
                            <input type="text" class="form-control" id="truename" name="truename" placeholder="请输入真实姓名.." value="">
                        </div>
                        <div class="form-group">
                            <label for="nickname">身份证号码</label>
                            <input type="text" class="form-control" id="IDCard" name="IDCard" placeholder="请输入身份证号码.." value="">
                        </div>
                        
                        
                        <div class="form-group">
                            <label>身份证正面照片</label>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="dm-profile-edit-avatar" name="dm-profile-edit-avatar">
                                <label class="custom-file-label" for="dm-profile-edit-avatar">选择照片</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>身份证背面面照片</label>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="dm-profile-edit-avatar" name="dm-profile-edit-avatar">
                                <label class="custom-file-label" for="dm-profile-edit-avatar">选择照片</label>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END User Profile -->

           

           

                <!-- Submit -->
                <div class="row push">
                    <div class="col-lg-8 col-xl-5 offset-lg-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">
                                <i class="fa fa-check-circle mr-1"></i> 提交认证
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
