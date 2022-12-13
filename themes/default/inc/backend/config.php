<?php
/**
 * backend/config.php
 *
 * Author: pixelcave
 *
 * Backend pages configuration file
 *
 */

// **************************************************************************************************
// INCLUDED VIEWS
// **************************************************************************************************

$dm->inc_side_overlay           = TEMPLATE .'/inc/backend/views/inc_side_overlay.php';
$dm->inc_sidebar                = TEMPLATE .'/inc/backend/views/inc_sidebar.php';
$dm->inc_header                 = TEMPLATE .'/inc/backend/views/inc_header.php';
$dm->inc_footer                 = TEMPLATE .'/inc/backend/views/inc_footer.php';


// **************************************************************************************************
// SIDEBAR
// **************************************************************************************************

$dm->l_sidebar_dark             = true;


// **************************************************************************************************
// HEADER
// **************************************************************************************************

$dm->l_header_style             = 'light';


// **************************************************************************************************
// MAIN CONTENT
// **************************************************************************************************

$dm->l_m_content                = 'narrow';


// **************************************************************************************************
// MAIN MENU
// **************************************************************************************************

$dm->main_nav                   = array(

    array(
        'name'  => '在线帮助',
        'icon'  => 'fa fa-location-arrow',
        'url'   => '/help/index'
    ),
    array(
        'name'  => 'VIP中心',
        'icon'  => 'fa fa-globe',
        'sub'   => array(
            array(
                'name'  => '开通 VIP',
                // 'icon'  => 'fa fa-location-arrow',
                'url'   => '/vip/index'
            ),
            array(
                'name'  => '我的订单',
                // 'badge' => array(3, 'success'),
                'url'   => '/vip/order'
            ),
        )
    ),

    array(
        'name'  => '网盘',
        'type'  => 'heading'
    ),
    array(
        'name'  => '文件管理',
        'icon'  => 'fa fa-file',
        'url'   => '/file/index'
    ),
    array(
        'name'  => '最近文件',
        'icon'  => 'fa fa-file',
        'url'   => '#'
    ),
    array(
        'name'  => '离线下载',
        'icon'  => 'fa fa-download',
        'url'   => '#'
    ),
    
    array(
        'name'  => '回收站',
        'icon'  => 'fa fa-trash',
        'url'   => '/file/trash'
    ),
    array(
        'name'  => '收益分成',
        'type'  => 'heading',
    ),
    array(
        'name'  => '收益统计',
        'icon'  => 'fa fa-location-arrow',
        'url'   => '/user/dashboard'
    ),
    array(
        'name'  => '分成设置',
        'icon'  => 'fa fa-location-arrow',
        'url'   => '/user/profit'
    ),
    array(
        'name'  => '收款信息',
        'icon'  => 'fa fa-location-arrow',
        'url'   => '/user/withdraw'
    ),
);
