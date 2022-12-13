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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">文件管理</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">文件管理</li>
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
            <table class="table table-hover table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th>文件名</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">文件大小</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">上传时间</th>
                        <th class="text-center" style="width: 100px;">操作</th>
                    </tr>
                </thead>
                <tbody class="file-list">
                    <?php foreach ($template_data['folder'] as &$item) {  ?>
                        <tr>
                            <td>
                                <a href="<?php echo url('file/index',['parent_id' => $item['folder_id']]);?>">
                                    <i class="fa fa-folder-open" style="color: #ffb119;"></i> <span><?php echo $item['folder_name']; ?></span>
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                --
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <?php echo zpl_time($item['create_time']); ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">

                                <?php if( $item['is_public'] ){ ?>
                                    <button type="button" class="btn btn-sm btn-primary copy-share-url" data-url="<?php echo url('folder/share', ['alias' =>$item['alias']]); ?>" data-toggle="tooltip"  title="复制链接">
                                        <i class="fa fa-clone"></i>
                                    </button>
                                <?php } ?>

                                    <a href="<?php echo url('file/folder_edit',['folder_id' => $item['folder_id']]);?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="编辑">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="删除">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>

                    <?php foreach ($template_data['file'] as &$item) {  ?>
                        <tr>
                            <td>
                                <a href="<?php echo url('file/share', ['alias' =>$item['alias']]); ?>" target="_blank">
                                    <i class="fa fa-file" style="color: #bbbbbb;"></i><span> <?php echo $item['name']; ?></span>
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <?php echo zpl_size($item['size']); ?>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <?php echo zpl_time($item['create_time']); ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary copy-share-url" data-url="<?php echo url('file/share', ['alias' =>$item['alias']]); ?>" title="复制链接">
                                        <i class="fa fa-clone"></i>
                                    </button>
                                    <a href="<?php echo url('file/edit',['file_id' => $item['file_id']]);?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="编辑">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <a href="<?php echo url('file/delete',['file_id' => $item['file_id']]);?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="删除">
                                        <i class="fa fa-times"></i>
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