<?php require ADMIN_TEMPLATE . '/header.php'; ?>

<div class="container-fluid">
    <div class="block">
        <div class="block-header">
            <h3>文件管理</h3>
        </div>
        <div class="block-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>文件ID</th>
                        <th>上传用户</th>
                        <th>文件名</th>
                        <th>文件大小</th>
                        <th>存储路径</th>
                        <th>上传时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach ($data as &$item){  ?>
                    <tr>
                        <th scope="row"> <?php echo $item['file_id'];?> </th>
                        <td>
                            <a href="#" target="_blank">
                                <?php echo $item['username'];?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo url('file_share',$item['alias']);?>" target="_blank">
                                <?php echo $item['name'];?>
                            </a>
                        </td>
                        <td> <?php echo zpl_size($item['size']);?> </td>
                        <td> <?php echo $item['url'];?> </td>
                        <td> <?php echo date("Y-m-d H:i:s", $item['create_time']);?> </td>
                        <td>
                        <?php 
                        // enum('normal', 'ban', 'trash')
                            if($item['status'] == 'normal'){
                                echo "<p style=\"color:green\">正常</p>";
                            }elseif($item['status'] == 'ban'){
                                echo "<p style=\"color:#ff00ff\">已被封禁</p>";
                            }elseif($item['status'] == 'trash'){
                                echo "<p style=\"color:red\">已删除</p>";
                            }
                        ?> 
                        </td>
                        <td> 
                        
                        <?php if($item['status'] == 'trash') {?>
                            <a href="<?php echo aurl('file_restore', ['file_id'=>$item['file_id']]);?>">还原</a>
                        <?php } else {?>
                            <?php if($item['status'] == 'ban') {?>
                                <a href="<?php echo aurl('file_unban', ['file_id'=>$item['file_id']]);?>" style="color:red">解封</a>
                            <?php } else {?>
                                <a href="<?php echo aurl('file_ban', ['file_id'=>$item['file_id']]);?>">封禁</a>
                            <?php } ?>

                            <a href="<?php echo aurl('file_delete', ['file_id'=>$item['file_id']]);?>">删除</a>
                        <?php } ?>
                            

                        <?php if($item['status'] == 'normal') {?>
                            <a href="<?php echo aurl('file_edit', ['file_id'=>$item['file_id']]);?>">编辑</a>
                        <?php } ?>
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