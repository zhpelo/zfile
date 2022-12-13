<?php require TEMPLATE . '/inc/_global/config.php'; ?>
<?php require TEMPLATE . '/inc/backend/config.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_end.php'; ?>

<style>
    .file-list .fa-folder-open, .file-list .fa-file{
        font-size: 20px;
        width: 28px;
        text-align: center;
    }
</style>

<!-- Page Content -->
<div class="content">
    <!-- Hover Table -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                <div class="file-path">
                    请选择保存的目录
                </div>
            </h3>

            <div class="block-options">
                <div class="block-options-item">

                    <a href="<?php echo "/index.php?a=file&c=save&alias={$alias}&folder_id={$parent_id}";?>"  class="btn btn-sm btn-primary" data-toggle="tooltip" title="文件上传">
                        <i class="fa fa-save"></i> 保存到当前目录
                    </a>
                </div>
            </div>
        </div>
        <div class="block-content">
            <table class="table table-hover table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th>文件名</th>
                        <th class="text-center" >操作</th>
                    </tr>
                </thead>
                <tbody class="file-list">
                    <?php foreach ($folder as &$item) {  ?>
                        <tr>
                            <td>
                                <a href="<?php echo "/index.php?a=file&c=save&alias={$alias}&parent_id={$item['folder_id']}";?>">
                                    <i class="fa fa-folder-open" style="color: #ffb119;"></i> <span><?php echo $item['folder_name']; ?></span>
                                </a>
                            </td>
                           
                            <td class="text-center">
                                <a href="<?php echo "/index.php?a=file&c=save&alias={$alias}&folder_id={$item['folder_id']}";?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="编辑">
                                    <i class="fa fa-save"></i> 保存到此目录
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Hover Table -->
</div>
<!-- END Page Content -->
<?php require TEMPLATE . '/inc/_global/views/footer_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_end.php'; ?>