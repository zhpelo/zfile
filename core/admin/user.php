<?php require ADMIN_TEMPLATE . '/header.php'; ?>
<div class="container-fluid">
    <div class="block">
        <div class="block-header">
            <h3>用户管理</h3>
        </div>
        <div class="block-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>用户ID</th>
                        <th>用户名</th>
                        <th>昵称</th>
                        <th>邮箱</th>
                        <th>手机号</th>
                        <th>最近登录</th>
                        <th>登录ip</th>
                        <th>注册时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as &$item) {  ?>
                        <tr>
                            <th scope="row"> <?php echo $item['user_id']; ?> </th>
                            <td>
                                <?php echo $item['username']; ?> 
                                <?php if($item['vip_id'] > 0) {?>
                                <span class="badge badge-danger">vip.<?php echo $item['vip_id']; ?></span>
                                <?php } ?>
                            </td>
                            <td> <?php echo $item['nickname']; ?> </td>
                            <td> <?php echo $item['email']; ?> </td>
                            <td> <?php echo $item['mobile']; ?> </td>
                            <td> <?php echo $item['login_time'] ? date("Y-m-d H:i:s", $item['login_time']) : '无'; ?> </td>
                            <td> <?php echo $item['login_ip'] ?: '无'; ?> </td>
                            <td> <?php echo date("Y-m-d H:i:s", $item['create_time']); ?> </td>
                            <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary">封禁</button>
                                <button type="button" class="btn btn-primary">删除</button>
                                <button type="button" class="btn btn-primary">编辑</button>
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