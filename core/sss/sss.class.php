<?php
namespace core\sss;

class sss
{

    protected $module = "",$controller = "",$action = "", $noNeedLogin = null, $db = null, $do = null, $id = null;
    protected $config = [];
    protected $class_name = null;

    public function __construct()
    {
        global $dbinfo;
        spl_autoload_register('self::AutoLoad');
        
        $this->db = new \core\sss\db($dbinfo);
        
        //网站后台设置项
        foreach ($this->db->get('options') as $item) {
            $this->config[$item['option_name']] = $item['option_value'];
        }
        $s = input('s','get','index/index');
        if ($s) {
            // Validate Request
            $var = explode("/", $s);
            // Removes dots
            $var[0] = str_replace(".", "", $var[0]);
            $this->controller = clean($var[0], 3, TRUE);
            // Run Methods
            if (isset($var[1]) && !empty($var[1])) $this->action = clean($var[1], 3);
            if (isset($var[2]) && !empty($var[2])) $this->id = clean($var[2], 3);
        }
    }
    public function get_db()
    {
        return $this->db;
    }
    public function get_config()
    {
        return $this->config;
    }
    public function run()
    {
        $CLASSNAME =  "core\\".MDIR."\\".$this->controller;
        $APP = new $CLASSNAME();
        if ($this->action) {
            if ($APP->actions == "*" || in_array($this->action, $APP->actions)) {
               
                if($APP->noNeedLogin != "*" && !in_array($this->action, $APP->noNeedLogin)){
                    
                    if ( !isset($_SESSION['is_login']) ) {
                        $this->error('请登录后访问！', $_SERVER['PHP_SELF'].'?s=user/login');
                    }
                }
                return $APP->{$this->action}();
            } else {
                $this->_404();
            }
        } else {
            // 访问主页
            return $APP->index();
        }
    }

    public function _404()
    {
        $this->error('您访问的页面不存在');
    }

    // 实现类文件自动加载
    public static function AutoLoad($className)
    {
        if (substr($className, 0, 4) == 'core') { // 框架类文件命名空间转换
            $class_file = CORE_DIR . '/' . str_replace('\\', '/', substr($className, 5)) . '.class.php';
        }
        if (isset($class_file) && file_exists($class_file)) {
            require $class_file;
        }
        require ROOT . '/vendor/autoload.php';
    }

    protected function success($msg = '', $url = null, $code = 1)
    {
        $this->result($msg, $url, $code, 200);
    }


    protected function error($msg = '', $url = null, $code = 0)
    {
        $this->result($msg, $url, $code, 402);
    }

    protected function result($msg, $url = null, $code = 0, $httpstart = 200)
    {
        http_response_code($httpstart);
        $wait = 3;
        $error = $code? 0:1;
        $url = $url ?: (isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'');
    
        include(TEMPLATE . "/message.php");die();
    }
}
