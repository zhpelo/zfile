<?php
// 通用函数库
function p($val)
{
    echo '<pre>';
    var_dump($val);
    echo '</pre>';
    exit();
}

function clean($string, $level = '1', $chars = FALSE, $leave = "")
{
    if (is_array($string)) return array_map("clean", $string);

    $string = preg_replace('/<script[^>]*>([\s\S]*?)<\/script[^>]*>/i', '', $string);
    switch ($level) {
        case '3':
            $search = array(
                '@<script[^>]*?>.*?</script>@si',
                '@<[\/\!]*?[^<>]*?>@si',
                '@<style[^>]*?>.*?</style>@siU',
                '@<![\s\S]*?--[ \t\n\r]*>@'
            );
            $string = preg_replace($search, '', $string);
            $string = strip_tags($string, $leave);
            if ($chars) {
                if (phpversion() >= 5.4) {
                    $string = htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, "UTF-8");
                } else {
                    $string = htmlspecialchars($string, ENT_QUOTES, "UTF-8");
                }
            }
            break;
        case '2':
            $string = strip_tags($string, '<b><i><s><u><strong><span><p>');
            break;
        case '1':
            $string = strip_tags($string, '<b><i><s><u><strong><a><pre><code><p><div><span>');
            break;
    }
    $string = str_replace('href=', 'rel="nofollow" href=', $string);
    return $string;
}


function get_header()
{
    return include(TEMPLATE . "/header.php");
}
function get_footer()
{
    return include(TEMPLATE . "/footer.php");
}


function get_admin_header()
{
    return include(ADMIN_TEMPLATE . "/header.php");
}
function get_admin_footer()
{
    return include(ADMIN_TEMPLATE . "/footer.php");
}
function is_get()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
}

function is_post()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
}
function redirect($url)
{
    Header("Location:$url");
}

function zpl_mkdir($path)
{
    //判断目录存在否，不存在则创建目录
    if (!is_dir($path)) {
        if (!mkdir($path, 0755, true)) return false;
    }
    return true;
}

function zpl_unlink($path)
{
    //判断目录存在否，不存在则创建目录
    if (file_exists($path)) {
        if (!unlink($path)) return false;
    }
    return true;
}

function get_real_ip()
{
    $ip = FALSE;
    //客户端IP 或 NONE
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    //多重代理服务器下的客户端真实IP地址（可能伪造）,如果没有使用代理，此字段为空
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) {
            array_unshift($ips, $ip);
            $ip = FALSE;
        }
        for ($i = 0; $i < count($ips); $i++) {
            if (!preg_match("^(10│172.16│192.168).", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    //客户端IP 或 (最后一个)代理服务器 IP
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}



/**
 * 随机字符串
 * @param length, start
 * @return 
 */
function strrand($use = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890", $length = 6)
{
    // $use = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 
    srand((float)microtime() * 1000000);
    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str .= $use[rand() % strlen($use)];
    }
    return $str;
}

//判断是手机访问还是电脑访问
function is_mobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
        return true;

    //此条摘自TPM智能切换模板引擎，适合TPM开发
    if (isset($_SERVER['HTTP_CLIENT']) && 'PhoneClient' == $_SERVER['HTTP_CLIENT'])
        return true;
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset($_SERVER['HTTP_VIA']))
        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
    //判断手机发送的客户端标志,兼容性有待提高
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile'
        );
        //从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}


//文件大小 人性化显示
function zpl_size($size)
{
    $dw = " Byte";

    if ($size >= pow(2, 40)) {
        $size = round($size / pow(2, 40), 2);
        $dw = " TB";
    } else if ($size >= pow(2, 30)) {
        $size = round($size / pow(2, 30), 2);
        $dw = " GB";
    } else if ($size >= pow(2, 20)) {
        $size = round($size / pow(2, 20), 2);
        $dw = " MB";
    } else if ($size >= pow(2, 10)) {
        $size = round($size / pow(2, 10), 2);
        $dw = " KB";
    } else {
        $dw = " Bytes";
    }
    return $size . $dw;
}

//时间 人性化显示
function zpl_time($timeOreign)
{
    if (!is_numeric($timeOreign)) {
        $timeOreign = strtotime(time());
    }

    $todayTime = strtotime(date('Y-m-d'));
    $time = time() - $timeOreign;
    if ($time < 60) {
        $str = '刚刚';
    } elseif ($time < 60 * 60) {
        $min = floor($time / 60);
        $str = $min . '分钟前';
    } elseif ($timeOreign >  $todayTime) {
        $h = floor($time / (60 * 60));
        $str = $h . '小时前';
    } elseif ($timeOreign > $todayTime - 86400) {
        $str = '昨天';
    } else {
        if (date("Y", $timeOreign) == date("Y", time())) {
            $str = date("n月j日", $timeOreign);
        } else {
            $str = date("Y-m-d", $timeOreign);
        }
    }
    return $str;
}
//前台网址 生成函数
function url($path, $query = null)
{
    if (is_array($query)) {
        $query = http_build_query($query);
    }
    // switch ($path) {
    //     case "list":
    //         $url =  "/image/list&" . $query;
    //         break;
    //     case "show":
    //         $url =  "/image/show&" . $query;
    //         break;
    //     default:
    //         $url = '/404.html';
    // }
    // get_config('siteurl').
    return "/". $path ."?". $query;
}
//后台网址 生成函数
function aurl($path, $query)
{
    if (is_array($query)) {
        $query = http_build_query($query);
    }
    switch ($path) {
        case "file_ban":
            $url =  "a=file&c=ban&" . $query;
            break;
        case "file_unban":
            $url =  "a=file&c=unban&" . $query;
            break;
        case "file_delete":
            $url =  "a=file&c=delete&" . $query;
            break;
        case "file_restore":
            $url =  "a=file&c=restore&" . $query;
            break;
        case "vip_edit":
            $url =  "a=vip&c=edit&" . $query;
            break;
        default:
            $url = '/404.html';
    }
    return get_config('siteurl') . '/zplvip.php?' . $url;
}
function get_share_folder_url($alias, $folder_id)
{
    $url = "?a=share&type=folder&alias=$alias&parent_id=$folder_id";
    return get_config('siteurl') . $url;
}
function get_config($key)
{
    global $SSS;
    return $SSS->get_config()[$key];
}

function db()
{
    global $SSS;
    return $SSS->get_db();
}

function get_file_path($id, $top_id = 0, &$result = array())
{
    if ($id > 0) {
        $folder = db()->where('folder_id', $id)->getOne('file_folder');
        if ($folder['parent_id'] != $top_id) {
            get_file_path($folder['parent_id'], $top_id, $result);
        }
        $result[] = $folder;
        return $result;
    } else {
        return [];
    }
}

function get_template_page($present, $total)
{
    if ($present > 1) {
        $prev_url =  get_page_url(['page' => $present - 1]);
    }

    if ($present < $total) {
        $next_url =  get_page_url(['page' => $present + 1]);
    }


    $html =     '<nav aria-label="Page navigation example">';
    $html .=    '   <ul class="pagination">';
    if (isset($prev_url)) {
        $html .= '       <li class="page-item">';
        $html .= '           <a class="page-link" href="' . $prev_url . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span> </a>';
        $html .= '       </li>';
    }

    $start = ($present - 6) > 1 ? $present - 6 : 1;
    $end = ($present + 6) > $total ? $total : $present + 6;

    if ($start != 1) {
        $html .=    '       <li class="page-item"><a class="page-link" href="' . get_page_url(['page' => 1]) . '"><span>1</span></a></li>';
        $html .=    '       <li class="page-item"><a class="page-link"><span> ... </span></a></li>';
    }

    for ($x = $start; $x <= (int)$end; $x++) {
        $class = $present == $x ? 'active' : '';
        $html .= '       <li class="page-item ' . $class . '"><a class="page-link" href="' . get_page_url(['page' => $x]) . '">' . $x . '</a></li>';
    }
    if ($end != $total) {
        $html .=    '       <li class="page-item"><a class="page-link"><span> ... </span></a></li>';
        $html .=    '       <li class="page-item"><a class="page-link" href="' . get_page_url(['page' => $total]) . '"><span>' . $total . '</span></a></li>';
    }
    if (isset($next_url)) {
        $html .= '       <li class="page-item">';
        $html .= '           <a class="page-link" href="' . $next_url . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>';
        $html .= '       </li>';
    }

    $html .=    '   </ul>';
    $html .=    '</nav>';

    echo $html;
}



function get_page_url($addarr = null)
{
    $pageURL = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

    $query_arr = [];
    if ($_SERVER["QUERY_STRING"]) {
        parse_str($_SERVER["QUERY_STRING"], $query_arr);
    }
    if ($addarr) {
        $query_arr = array_merge($query_arr, $addarr);
    }
    $query_str = $_SERVER['PHP_SELF'] . '?' . http_build_query($query_arr);
    
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $query_str;
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $query_str;
    }
    return $pageURL;
}


function is_login()
{
    if (isset($_SESSION['is_login']) && $_SESSION['is_login']) {
        return true;
    } else {
        return false;
    }
}

function get_user_id()
{
    if (isset($_SESSION['is_login']) && $_SESSION['is_login']) {
        return $_SESSION['user']['user_id'];
    } else {
        return 0;
    }
}

function is_vip($user_id = null)
{
    if (!$user_id) {
        if (isset($_SESSION['is_login']) && $_SESSION['is_login']) {
            $user_id =  $_SESSION['user']['user_id'];
        } else {
            return false;
        }
    }
    $user = db()->where('user_id', $user_id)->getOne('user', 'user_id,vip_id,vip_time');
    if ($user['vip_id'] < 1) {
        return false;
    }
    if ($user['vip_time'] < time()) {
        return false;
    }
    return true;
}

function is_email($str)
{
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}

// $key 键名
// $method 请求类型 （get,post）
// $default 默认值
// $verify 验证回调函数
function input($key = null, $method = 'get', $default = null, $verify = null)
{
    if ($method == 'get') {
        $val = isset($_GET[$key]) ? $_GET[$key] : $default;
    } else if ($method == 'post') {
        $val = isset($_POST[$key]) ? $_POST[$key] : $default;
    }
    if ($verify) {
        if (!call_user_func($verify, $val)) {
            return false;
        }
    }

    return $val;
}

function hide_username($user_id)
{
    $username = db()->where('user_id', $user_id)->getValue('user', 'username');
    return hideStar($username);
}

//用户名、邮箱、手机账号中间字符串以*隐藏 
function hideStar($str)
{
    if (strpos($str, '@')) {
        $email_array = explode("@", $str);
        $prevfix = (strlen($email_array[0]) < 4) ? "" : substr($str, 0, 3); //邮箱前缀 
        $count = 0;
        $str = preg_replace('/([\d\w+_-]{0,100})@/', '***@', $str, -1, $count);
        $rs = $prevfix . $str;
    } else {
        $pattern = '/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i';
        if (preg_match($pattern, $str)) {
            $rs = preg_replace($pattern, '$1****$2', $str); // substr_replace($name,'****',3,4); 
        } else {
            $rs = substr($str, 0, 3) . "***" . substr($str, -1);
        }
    }
    return $rs;
}

function get_cat_tree($arr, $cat_pid = 0, $level = 0)
{
    $list = array();
    foreach ($arr as $k => $v) {
        if ($v['cat_pid'] == $cat_pid) {
            $v['level'] = $level;
            $child = get_cat_tree($arr, $v['cat_id'], $level + 1);
            if (count($child)) {
                $v['leaf'] = false; //是否子节点
                $v['child'] = $child;
            } else {
                $v['leaf'] = true;
            }
            $list[] = $v;
        }
    }
    return $list;
}

function get_cat_tree_list($arr, $cat_pid = 0, $level = 0)
{
    global $tree;
    foreach ($arr as $key => $val) {
        if ($val['cat_pid'] == $cat_pid) {

            $flg = str_repeat("&emsp;", $level); // →
            if($level > 0){
                $flg .= '┗━';
            }
            $val['name'] = $flg . $val['name'];
            $tree[] = $val;
            get_cat_tree_list($arr, $val['cat_id'], $level + 1);
        }
    }
    return $tree;
}

function cdnurl($url){
    return get_config('cdnurl').$url;
}