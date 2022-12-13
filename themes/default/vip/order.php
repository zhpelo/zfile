<?php require TEMPLATE . '/inc//_global/config.php'; ?>
<?php require TEMPLATE . '/inc//backend/config.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/head_start.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/head_end.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/page_start.php'; ?>


<!-- Page Content -->
<div class="content content-full content-boxed">
    <div class="block block-rounded">
        <div class="block-content">
            <!-- User Profile -->
            <h2 class="content-heading pt-0">
                <i class="fa fa-fw fa-user-circle text-muted mr-1"></i> 订单列表
            </h2>
            <!-- END User Profile -->

            <table class="table table-bordered table-vcenter text-center">
                <thead>
                    <tr>
                        <th>订单ID</th>
                        <th>订单名称</th>
                        <th>金额</th>
                        <th class="d-none d-sm-table-cell">VIP种类</th>
                        <th class="d-none d-sm-table-cell">支付状态</th>
                        <th class="d-none d-sm-table-cell">创建时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as &$item) {  ?>
                    <tr>
                        <th scope="row">
                            <?php echo $item['order_id']; ?>
                        </th>
                        <td class="font-w600">
                            <?php echo $item['title']; ?>
                        </td>
                        <td>
                            <?php echo $item['price']; ?> 元
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <span class="badge badge-danger"><?php echo $item['viptitle']; ?></span>
                        </td>
                        
                        <td class="d-none d-sm-table-cell">
                            <?php if($item['status'] == 'paid'){?>
                                <span class="badge badge-success">已支付</span>
                            <?php }else{ ?>
                                <span class="badge badge-warning">未支付</span>
                            <?php }?>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <?php echo date("Y-m-d H:i:s", $item['create_time']); ?>
                        </td>
                        <td >
                            <div class="btn-group">
                                <a href="<?php echo url("vip/pay",['order_id' => $item['order_id'] ]);?>" class="btn btn-sm btn-primary js-tooltip-enabled"  >
                                    去支付
                                </a>
                                <a href="<?php echo url("vip/close_order",['order_id' => $item['order_id'] ]);?>" class="btn btn-sm btn-primary js-tooltip-enabled" >
                                    关闭订单
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require TEMPLATE . '/inc//_global/views/page_end.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/footer_start.php'; ?>
<?php require TEMPLATE . '/inc//_global/views/footer_end.php'; ?>