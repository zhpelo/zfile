<?php require TEMPLATE . '/inc/_global/config.php'; ?>
<?php require TEMPLATE . '/inc/backend/config.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/page_start.php'; ?>

<style>
    .file-list .fa-folder-open,
    .file-list .fa-file {
        font-size: 20px;
        width: 28px;
        text-align: center;
    }
</style>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">文件管理</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">文件管理</li>
                    <li class="breadcrumb-item active" aria-current="page">新建文件夹</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Hover Table -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                <div class="file-path">
                    <a href="<?php echo url("file/index");?>"><i class="fa fa-home"></i> 文件管理</a> 
                    <?php 
                        if ( $parent_id ) {
                            $file_path = get_file_path($parent_id); 
                            foreach ($file_path as &$item) {  
                                echo '/ <a href="'.url("file/index",['parent_id' => $item['folder_id']]).'">'.$item['folder_name'].'</a>';
                            }
                        } 
                    ?>
                </div>
            </h3>
            <div class="block-options">
                <div class="block-options-item">
                    <a href="<?php echo url('file/folder_add',['parent_id' => $parent_id]);?>" class="btn btn-sm btn-primary" title="新建文件夹">
                        <i class="fa fa-plus"></i> 新建文件夹
                    </a>

                    <a href="<?php echo url('file/upload',['parent_id' => $parent_id]);?>"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="文件上传">
                        <i class="fa fa-upload"></i> 文件上传
                    </a>
                </div>
            </div>
        </div>
        <div class="block-content">

            <form method="POST">
                <div class="form-group row">
                    <label for="folder_name" class="col-sm-2 col-form-label">文件夹名</label>
                    <div class="col-sm-5">
                        <input type="text" name="folder_name" class="form-control" id="folder_name" value="未命名文件夹">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_public" class="col-sm-2 col-form-label">文件权限</label>
                    <div class="col-sm-5">
                        <select class="form-control" id="is_public" name="is_public">
                            <option value="0">私人文件夹</option>
                            <option value="1">公开文件夹</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="access_password" class="col-sm-2 col-form-label">访问密码</label>
                    <div class="col-sm-5">
                        <input type="text" name="access_password" class="form-control" id="access_password" placeholder="不设置就不用填写">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">确定</button>
            </form>

            <br>
        </div>
    </div>
    <!-- END Hover Table -->
</div>
<!-- END Page Content -->

<?php require TEMPLATE . '/inc/_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_start.php'; ?>
<!-- Page JS Plugins -->
<?php $dm->get_js('js/plugins/bootstrap-notify/bootstrap-notify.min.js'); ?>

<!-- Page JS Helpers (BS Notify Plugin) -->
<script>
    jQuery(function() {
        Dashmix.helpers('notify');
    });
</script>

<?php require TEMPLATE . '/inc/_global/views/footer_end.php'; ?>