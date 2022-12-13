<?php require TEMPLATE . '/inc/_global/config.php'; ?>
<?php require TEMPLATE . '/inc/backend/config.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/page_start.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/dropzone.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/dropzone.min.css" rel="stylesheet">
<style>
    .dropzone {
        min-height: 350px;
        border: 2px dashed #5A8DEE;
        background: #F2F4F4;
        margin: 30px 0;
    }

    .dropzone .dz-message {
        font-size: 1.5rem;
        width: 100%;
        margin-top: 130px;
        color: #5A8DEE;
        text-align: center;
    }

    .dropzone .note {
        font-size: 1.2rem;
        color: #a7a7a7;
    }

    .file-list .filename {
        font-size: 16px;
        color: #5a5a59;
        padding: .375rem .75rem;
    }

    .file-list .filename a {
        color: #000;
    }

    .file-list .filename .bi {
        font-size: 28px;
        margin-right: 8px;
        color: #ffd65a;
    }

    .file-list .filename span {
        line-height: 26px;
        vertical-align: text-bottom;
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
                    <li class="breadcrumb-item active" aria-current="page">文件上传</li>
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
        
            <form action="<?php echo url('file/upload',['parent_id' => $parent_id]);?>" class="dropzone" id="dpz-file-limits">
                <div class="dz-message needsclick">
                    <button type="button" class="dz-button">点击这里选择文件 或 将文件拖入此处</button><br />
                    <span class="note needsclick">文件大小不能超过4GB</span>
                </div>
            </form>

            <div class="hidden" id="box-upload">
                <button id="start-uploading" class="btn btn-primary mb-2 ">开始上传</button>
            </div>
            <script type="text/javascript">
                Dropzone.options.dpzFileLimits = {
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 4096, // MB
                    maxFiles: 20,
                    parallelUploads: 20,
                    maxThumbnailFilesize: 1, // MB
                    addRemoveLinks: true,
                    autoProcessQueue: false,
                    dictRemoveFile: "删除",
                    dictFileTooBig: "文件超过 4G,不允许上传",
                    init: function() {
                        var submitButton = document.querySelector("#start-uploading")
                        myDropzone = this; // closure

                        submitButton.addEventListener("click", function() {
                            myDropzone.processQueue(); // Tell Dropzone to process all queued files.
                        });
                        this.on("addedfile", function(file) {
                            $('#box-upload').removeClass('hidden');
                        });

                        this.on("success", function(file) {
                            console.log("File " + file.name + " 上传成功");
                        });
                        this.on("removedfile", function(file) {
                            console.log("File " + file.name + "removed");
                        });

                        this.on("maxfilesexceeded", function(file) {
                            this.removeFile(file);
                        });
                    },
                }
            </script>

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