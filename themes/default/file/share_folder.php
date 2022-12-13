<!-- Hover Table -->
<div class="block block-rounded text-md-left">
    <div class="block-header block-header-default">
        <h3 class="block-title">您接收到的文件</h3>
        <div class="block-options">
            <div class="block-options-item">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete">
                    <i class="fa fa-save"></i> 转存到网盘
                </button>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="file-path">

            <a href="<?php echo url('folder_share', $data['alias']); ?>">
                <i class="fa fa-home"></i> 全部文件
            </a>
            <?php 
                if ( isset($_GET['parent_id']) ) {
                    $file_path = get_file_path($_GET['parent_id'], $data['folder_id']); 
                    foreach ($file_path as &$item) {  
                        echo '/ <a href="'.get_share_folder_url($data['alias'], $item['folder_id']).'">'.$item['folder_name'].'</a>';
                    }
                } 
            ?>
        </p>

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
                            <a href="<?php echo get_share_folder_url($data['alias'], $item['folder_id']) ; ?>">
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
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="下载文件">
                                    <i class="fa fa-cloud-download-alt"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="转存到网盘">
                                    <i class="fa fa-save"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

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
                            <?php echo zpl_time($item['create_time']); ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="<?php echo url('file_share', $item['alias']); ?>" target="_blank"  class="btn btn-sm btn-primary"  title="下载文件">
                                    <i class="fa fa-cloud-download-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="转存到网盘">
                                    <i class="fa fa-save"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- END Hover Table -->