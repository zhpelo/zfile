<?php
    // 网站后台代码
    require_once('core/config.php');
    define("ADMIN", TRUE);
    $SSS = new SSS();
    $SSS->run();