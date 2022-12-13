<?php require TEMPLATE . '/inc/_global/config.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="bg-image" style="background-image: url('<?php echo $dm->assets_folder; ?>/media/photos/photo19@2x.jpg');">
    <div class="hero bg-white-95">
        <div class="hero-inner">
            <div class="content content-full">
                <div class="px-3 py-5 text-center">
                    <div class="row invisible" data-toggle="appear">
                        <div class="col-sm-12 text-center">
                        <?php if($error) { ?>
                            <div class="display-3 text-danger font-w700">
                                <i class="fa fa-2x fa-times-circle" aria-hidden="true"></i>
                            </div>
                        <?php } else {?>
                            <div class="display-3 text-success font-w700">
                                <i class="fa fa-2x fa-check-circle" aria-hidden="true"></i>
                            </div>
                        <?php } ?>
                            
                        </div>
                    </div>
                    
                    <h1 class="h2 font-w700 mt-5 mb-3 invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="300">
                        <?php echo(strip_tags($msg));?>
                    </h1>

                    <h2 class="h3 font-w400 text-muted mb-5 invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="450">
                        
                    页面自动 <a id="href" href="<?php echo($url);?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait);?></b>

                    </h2>


                    <div class="invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="600">
                        <a class="btn btn-hero-secondary" href="javascript:history.go(-1)">
                            <i class="fa fa-arrow-left mr-1"></i> 返回
                        </a>

                        <a class="btn btn-hero-secondary" href="<?php echo($url);?>">
                            跳转 <i class="fa fa-arrow-right mr-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),
            href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>
<?php require TEMPLATE . '/inc/_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_end.php'; ?>