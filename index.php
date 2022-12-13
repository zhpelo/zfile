<?php
    // 网站前台代码
    define("MDIR", 'home');
    //引入config类库
    require_once('core/config.php');
    
    $SSS = new core\sss\sss();
    $SSS->run();