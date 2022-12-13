<?php require TEMPLATE . '/inc/_global/config.php'; ?>
<?php require TEMPLATE . '/inc/backend/config.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">开通VIP</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">开通VIP</li>
                    <li class="breadcrumb-item active" aria-current="page">列表</li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="row">

        <?php foreach ($data as &$item) {  ?>

            <div class="col-md-6 col-xl-3">
                <!-- Startup Plan -->
                <a class="block block-link-pop block-themed text-center" href="<?php echo url("vip/pay",["pay_type" => "alipay","vip_type" => $item['vip_id']]);?>">
                    <div class="block-header bg-success">
                        <h3 class="block-title"><?php echo $item['title'];?></h3>
                    </div>
                    <div class="block-content bg-body-light">
                        <div class="py-2">
                            <p class="h1 font-w700 text-success mb-2">￥<?php echo $item['price'];?></p>
                            <p class="h6 text-muted">per month</p>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="py-2">
                            <?php echo $item['introduce'];?>
                        </div>
                    </div>
                    <div class="block-content block-content-full bg-body-light">
                        <span class="btn btn-block btn-hero-success px-4">立即购买</span>
                    </div>
                </a>
                <!-- END Startup Plan -->
            </div>

        <?php } ?>

    </div>
    <!-- END Modern Design -->

</div>
<!-- END Page Content -->

<?php require TEMPLATE . '/inc/_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_start.php'; ?>
<?php require TEMPLATE . '/inc/_global/views/footer_end.php'; ?>
