<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8" />
    <title><?php echo isset($web_title) ? $web_title : '裂变网盘|网赚网盘'; ?> | 裂变时代,分享文件也能赚钱！-www.liebianshidai.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo isset($web_keywords) ? $web_title : '裂变网盘,网站网盘,网络硬盘,免费网络硬盘,免费网盘,网盘,网络U盘,免费网络U盘,网盘下载'; ?>">
    <meta name="description" content="<?php echo isset($web_description) ? $web_title : '裂变网盘是一款永久免费的文件分享网盘，即免费网络存储空间服务。注册后可获得支持外链的50TB空间，最大单文件可达4GB，同时为用户提供每万次点击下载1800元的收益。已为国内外数千万用户提供超过 1PB 的网络储存空间。'; ?>">

    <link rel="shortcut icon" href="/Themes/default/img/favicon.ico" />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- 引入图标css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery.cookie@1.4.1/jquery.cookie.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"> -->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?7fec6823743e9d9617636a22e0c5eb78";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <style>

a {
    text-decoration: none;
}
        #send-box {
            min-height: 12rem;
            border: 1px solid #dee2e6;
            padding: 2rem
        }

        .text p {
            text-indent: 2em;
        }

        .htmlpage h1 {
            text-align: center;
            margin: 40px 0;
        }

        .sidebar {
            overflow: hidden;
            padding: 0 2rem;
            /* position: absolute; */
        }


        .sidebar-left-nav {
            /* margin-top: 3rem; */
        }

        .sidebar-left-nav ul,
        .sidebar-left-nav li {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-left-nav li {
            height: 30px;
            display: flex;
            align-items: center;
            margin-left: 10px;
        }

        .sidebar-left-nav li a {
            font-size: 16px;
            line-height: 32px;
            color: #333333;
        }


        .sidebar-left-title {
            color: #a5a5a4;
            margin-top: 20px;
            font-size: 20px;
            line-height: 40px;
        }

        .lb-navbar {
            color: #fff;
            background-color: #20c997 !important;
            min-height: 4rem;
            font-size: 1.2rem;
        }

        .lb-navbar .navbar-brand {
            font-size: 1.8rem;
        }

        .lb-navbar .navbar-nav .nav-link {
            color: #fff;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark lb-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="/Themes/default/img/favicon.ico" alt="" width="30" height="24" class="d-inline-block align-text-top">
                裂变时代
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/index.php?a=page&page_url=about">网盘介绍</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/index.php?a=page&page_url=Advertising">广告投放</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/index.php?a=page&page_url=cooperation">合作分成</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            关于我们
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/index.php?a=page&page_url=help">使用帮助</a></li>
                            <li><a class="dropdown-item" href="/index.php?a=page&page_url=about">关于我们</a></li>
                            <li><a class="dropdown-item" href="/index.php?a=page&page_url=join_us">加入我们</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/index.php?a=page&page_url=privacy_policy">隐私协议</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['is_login']) && $_SESSION['is_login']) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/index">
                                <?php echo $_SESSION['user']['username'] ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/logout">注销</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/login">登录</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/user/register">注册</a>
                        </li>
                    <?php } ?>
                </ul>
                
            </div>
        </div>
    </nav>

   