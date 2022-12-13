<?php require TEMPLATE . '/inc/_global/config.php'; ?>
<?php require TEMPLATE . '/inc/landing/config.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-white overflow-hidden">
    <div class="content content-top ">
        <div class="pt-2 pb-5 pt-lg-2">
            <h1 class="font-w700 mb-2">
            <?php echo $template_data['title'];?>
            </h1>
        </div>
    </div>
</div>
<!-- END Hero -->




<!-- Handcrafted Design -->
<div id="dm-design" class="bg-body-light overflow-hidden">
    <div class="content content-full">
    <div class="content">
        <?php echo $template_data['content'];?>
    </div>
    </div>
</div>
<!-- END Handcrafted Design -->

<!-- Footer -->
<footer id="page-footer" class="bg-white">
    <div class="content py-5">
        <div class="row font-size-sm">
            <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                版权所有 by <a class="font-w600" href="/" target="_blank">新乡市源码科技有限公司</a>
            </div>
            <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                <a class="font-w600" href="http://xinxiangapp.com" target="_blank"><?php echo $dm->name . ' ' . $dm->version; ?></a> &copy; <span data-toggle="year-copy"></span>
            </div>
        </div>
    </div>
</footer>
<!-- END Footer -->

<?php require TEMPLATE . '/inc/_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $dm->get_js('js/plugins/jquery-sparkline/jquery.sparkline.min.js'); ?>

<!-- Page JS Helpers (jQuery Sparkline Plugin) -->
<script>jQuery(function(){ Dashmix.helpers(['sparkline']); });</script>

<?php require TEMPLATE . '/inc/_global/views/footer_end.php'; ?>
