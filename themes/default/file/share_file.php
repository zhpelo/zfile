<!-- Hover Table -->
<div class="block block-rounded text-md-left">
    <div class="block-header block-header-default">
        <h3 class="block-title">您接收到的文件</h3>
        <div class="block-options">
            <div class="block-options-item">
                <a href="<?php echo url('file_save',$data['alias']);?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="SaveFile">
                    <i class="fa fa-save"></i> 转存到网盘
                </a>
            </div>
        </div>
    </div>
    <div class="block-content">
        <h1><?php echo $data['name']; ?></h1>
        <p>上传用户：<?php echo hide_username($data['user_id']); ?> （<a target="_" href="<?php echo url('page/index' , ['page_url' => 'report']) ?>">举报</a>）</p>
        <p>文件大小：<?php echo zpl_size($data['size']); ?></p>
        <p>上传时间：<?php echo zpl_time($data['create_time']); ?></p>
        <!-- <p>文件MD5：<?php echo $data['md5']; ?></p> -->
        <div class="row">
            <div class="col-md-4 mt-2">
                <a href="<?php echo url('file_share',$data['alias']);?>?c=download"  class="btn btn-info btn-block">
                <i class="fa fa-fw fa-download mr-1"></i> 普通下载
                </a>
            </div>
            <div class="col-md-4 mt-2">
                <a href="<?php echo url('file_share',$data['alias']);?>?c=vipdownload"  class="btn btn-danger btn-block">
                <i class="fa fa-fw fa-download mr-1"></i> VIP极速下载 (不限速)
                </a>
            </div>

            <!--<div class="col-md-4 mt-2">-->
            <!--    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-block-normal">-->
            <!--        <i class="fa fa-fw fa-address-card mr-1"></i> 加客服微信免费得VIP-->
            <!--    </button>-->
            <!--</div>-->
        </div>
        <p></p>
       
    </div>
</div>
<!-- END Hover Table -->

<!-- 加微信免费领VIP 活动弹出框  -->
<div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">使用微信扫一扫</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    添加微信后，回复自己账号的注册邮箱，我们的客服会在后台直接赠送您一个月的VIP！
                    <img src="https://www.xinxiangapp.com/images/qywx.jpg" style="max-width: 100%;"/>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 加微信免费领VIP 活动弹出框 END -->