<?php

    // 数据库配置信息
    $dbinfo = Array (
        'host' => '127.0.0.1',
        'username' => 'root', 
        'password' => '123456',
        'db'=> 'liebian',
        'port' => 3306,
        'prefix' => 'zpl_',
        'charset' => 'utf8'
    );

    // 网站配置信息
    $config = array(
        'debug' => 1,
        'theme' => 'default',
    );

    //系统版本号
    define("VERSION", "0.1.0");
    define("APP", TRUE);
    //网站根目录地址
    define("ROOT", dirname(dirname(__FILE__)));
    define("CORE_DIR", ROOT.'/core');
    define("SSS_DIR", ROOT.'/core/sss');
    define("TEMPLATE", ROOT . "/themes/{$config["theme"]}/");
    define("ADMIN_TEMPLATE", ROOT . "/core/admin/themes/");
    //开启 session
    if (!isset($_SESSION)) {
        session_start();
    }

    //开启DEBUG模式
    if (!isset($config["debug"]) || $config["debug"] == 0) {
        error_reporting(0);
    } else {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
    //引入通用函数库
    require_once(SSS_DIR.'/function.php');

    include ( SSS_DIR .'/sss.class.php');

?>