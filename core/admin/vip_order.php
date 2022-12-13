<?php require ADMIN_TEMPLATE . '/header.php'; ?>
<div class="nav-scroller bg-white shadow-sm">
    <nav class="nav nav-underline">
        <a class="nav-link" href="?a=vip_order">VIP订单管理</a>
        <a class="nav-link" href="?a=vip">VIP等级管理</a>
    </nav>
</div>

<div class="container-fluid">
    <div class="block">
        <div class="block-header d-flex justify-content-between">
            <h3>VIP订单列表</h3>
            <a href="?a=vip"  class="btn btn-primary">VIP设置</a>
        </div>
        <div class="block-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>订单ID</th>
                        <th>购买用户</th>
                        <th>购买种类</th>
                        <th>支付方式</th>
                        <th>支付价格</th>
                        <th>订单创建时间</th>
                        <th>支付状态</th>
                        <th>支付时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as &$item) {  ?>
                        <tr>
                            <th scope="row"> <?php echo $item['order_id']; ?> </th>
                            <td> <?php echo $item['username']; ?> </td>
                            <td> <?php echo $item['title']; ?> </td>
                            <td> <?php echo $item['pay_type']; ?> </td>
                            <td> <?php echo $item['price']; ?> </td>
                            <td> <?php echo date("Y-m-d H:i:s", $item['create_time']); ?> </td>
                            <td> <?php echo $item['status']; ?> </td>
                            <td> <?php echo date("Y-m-d H:i:s", $item['pay_time']); ?> </td>
                            <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary">详情</button>
                                <button type="button" class="btn btn-primary">补单</button>
                            </div>
                            </td>
                        </tr>
                    <?php }  ?>
                </tbody>
            </table>


            <?php 
                if ($this->db->totalPages > 1) { 
                    get_template_page($page,$this->db->totalPages);
                }
            ?>

        </div>
    </div>

</div>

<?php get_admin_footer(); ?>