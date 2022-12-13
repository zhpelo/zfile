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
            <h3>VIP列表</h3>
            <a href="?a=vip&c=add"  class="btn btn-primary">新增VIP</a>
        </div>
        <div class="block-body">


            <?php if (isset($_GET['c']) && ($_GET['c'] == 'add' || $_GET['c'] == 'edit')) { ?>
                <form method="POST">
                    <?php if (isset($data['vip_id'])) { ?>
                        <input type="hidden" id="vip_id" name="vip_id" value="<?php echo $data['vip_id']; ?>">
                    <?php } ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">VIP名称</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php if (isset($data['title'])) echo $data['title']; ?>" aria-describedby="titleHelp">
                        <small id="titleHelp" class="form-text text-muted">请输入vip标题不要超过40个汉字</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">VIP价格</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php if (isset($data['price'])) echo $data['price']; ?>" aria-describedby="priceHelp">
                        <small id="priceHelp" class="form-text text-muted"> 可以精确到小数点后两位 </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">VIP有效期</label>
                        <input type="text" class="form-control" id="expire" name="expire" value="<?php if (isset($data['expire'])) echo $data['expire']; ?>" aria-describedby="expireHelp">
                        <small id="expireHelp" class="form-text text-muted">例如：“<b> +1 day </b>” ，“<b> +3 month </b>”</small>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">VIP说明</label>
                        <textarea class="form-control" id="introduce" name="introduce" rows="6" aria-describedby="introduceHelp"><?php if (isset($data['introduce'])) echo $data['introduce']; ?></textarea>
                        <small id="introduceHelp" class="form-text text-muted">支持填写HTML代码</small>
                    </div>

                    <button type="submit" class="btn btn-primary">提交</button>
                </form>
            <?php } else { ?>



                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>VIPID</th>
                            <th>标题</th>
                            <th>价格</th>
                            <th>有效期</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as &$item) {  ?>
                            <tr>
                                <th scope="row"> <?php echo $item['vip_id']; ?> </th>
                                <td> <?php echo $item['title']; ?> </td>
                                <td> <?php echo $item['price']; ?> </td>
                                <td> <?php echo $item['expire']; ?> </td>
                                <td> <?php echo $item['introduce']; ?> </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-primary">下架</button>
                                        <a href="<?php echo aurl('vip_edit', ['vip_id'=>$item['vip_id']]);?>" class="btn btn-primary">编辑</a>
                                        <button type="button" class="btn btn-primary">删除</button>
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


            <?php }?>

        </div>
    </div>

</div>

<?php get_admin_footer(); ?>