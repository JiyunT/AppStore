<?php
require_once '../config.php';
require_once '../includes/functions.php';

/*
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
*/

$pageTitle = '关于系统 - ' . SITE_NAME;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="//unpkg.com/layui@2.11.5/dist/css/layui.css">
    <style>
        .layui-card-header {
            font-weight: bold;
        }
        .system-info-item {
            margin-bottom: 10px;
        }
        .system-info-label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    
    <div class="layui-body" style="padding: 20px;">
        <div class="layui-card">
            <div class="layui-card-header">
                <i class="layui-icon layui-icon-about"></i> 关于系统
            </div>
            <div class="layui-card-body">
                <div class="layui-row layui-col-space15">
                    <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-header">系统信息</div>
                            <div class="layui-card-body">
                                <div class="system-info-item">
                                    <span class="system-info-label">系统名称：</span>
                                    <span><?php echo SITE_NAME; ?></span>
                                </div>
                                <div class="system-info-item">
                                    <span class="system-info-label">系统版本：</span>
                                    <span><?php echo defined('APP_VERSION') ? APP_VERSION : '1.0.0'; ?></span>
                                </div>
                                <div class="system-info-item">
                                    <span class="system-info-label">PHP版本：</span>
                                    <span><?php echo PHP_VERSION; ?></span>
                                </div>
                                <div class="system-info-item">
                                    <span class="system-info-label">服务器软件：</span>
                                    <span><?php echo $_SERVER['SERVER_SOFTWARE'] ?? '未知'; ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="layui-card">
                            <div class="layui-card-header">功能介绍</div>
                            <div class="layui-card-body">
                                <p>应用商店管理系统是一个基于PHP和MySQL开发的简单应用管理平台，提供应用分类、展示、搜索和下载功能。</p>
                                <ul>
                                    <li>前台功能：浏览应用和分类、搜索应用、查看应用详情、下载应用、按分类浏览应用</li>
                                    <li>后台管理功能：管理员登录/登出、应用管理（增删改查）、分类管理（增删改查）、应用截图管理</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="layui-card">
                            <div class="layui-card-header">安全提示</div>
                            <div class="layui-card-body">
                                <ul>
                                    <li>请定期备份数据库</li>
                                    <li>请及时修改默认管理员密码</li>
                                    <li>确保服务器安全性，特别是文件上传功能</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//unpkg.com/layui@2.11.5/dist/layui.js"></script>
    <script>
        layui.use('element', function(){
            var element = layui.element;
        });
    </script>
</body>
</html>