<?php require TEMPLATE . '/inc/_global/config.php'; ?>
<?php require TEMPLATE . '/inc/backend/config.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/page_start.php'; ?>

<style>
    .file-list .fa-folder-open, .file-list .fa-file{
        font-size: 20px;
        width: 28px;
        text-align: center;
    }

</style>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">回收站</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">回收站</li>
                    <li class="breadcrumb-item active" aria-current="page">文件列表</li>
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
                    <a href="/file/trash"><i class="fa fa-home"></i> 回收站</a>
                </div>
            </h3>
        </div>
        <div class="block-content">
            <table class="table table-hover table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th>文件名</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">文件大小</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">删除时间</th>
                        <th class="text-center" style="width: 100px;">操作</th>
                    </tr>
                </thead>
                <tbody class="file-list">
                    <?php foreach ($template_data['file'] as &$item) {  ?>
                        <tr>
                            <td>
                                <a href="<?php echo url('file_share', $item['alias']); ?>" target="_blank">
                                    <i class="fa fa-file" style="color: #bbbbbb;"></i><span> <?php echo $item['name']; ?></span>
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <?php echo zpl_size($item['size']); ?>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <?php echo zpl_time($item['delete_time']); ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a  href="/index.php?a=trash&c=restore&file_id=<?php echo $item['file_id'];?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="编辑">
                                        <i class="fa fa-reply-all"></i> 还原
                                    </a>
                                </div>
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

<?php require TEMPLATE . '/inc/_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_start.php'; ?>
<!-- Page JS Plugins -->
<?php $dm->get_js('js/plugins/bootstrap-notify/bootstrap-notify.min.js'); ?>

<!-- Page JS Helpers (BS Notify Plugin) -->
<script>jQuery(function(){ Dashmix.helpers('notify'); });</script>

<?php require TEMPLATE . '/inc/_global/views/footer_end.php'; ?>