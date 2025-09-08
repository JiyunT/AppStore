<?php
// 调试模式
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// 后台管理关于页面
session_start();
require_once '../config.php';
require_once '../includes/functions.php';

// 是否登录
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - 关于</title>
    <link rel="stylesheet" href="//unpkg.com/layui@2.11.5/dist/css/layui.css">
    <style>
        .layui-layout-admin .layui-side {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="layui-layout layui-layout-admin">
        <?php include 'sidebar.php'; ?>
        
        <div class="main-content">
            <h2>关于系统</h2>
            <hr>
            
            <div class="layui-card">
                <div class="layui-card-header">系统信息</div>
                <div class="layui-card-body">
                    <p><strong>系统名称：</strong><?php echo SITE_NAME; ?></p>
                    <p><strong>项目版本：</strong><?php echo APP_VERSION; ?></p>
                    <p><strong>PHP版本：</strong><?php echo PHP_VERSION; ?></p>
                    <p><strong>服务器软件：</strong><?php echo $_SERVER['SERVER_SOFTWARE'] ?? '未知'; ?></p>
                </div>
            </div>
            
            <div class="layui-card" style="margin-top: 20px;">
                <div class="layui-card-header">功能介绍</div>
                <div class="layui-card-body">
                    <p>一个基于PHP 和MySQL 开发的简单应用商店管理系统，提供以下功能：</p>
                    <ul>
                        <li>应用展示与分类管理</li>
                        <li>应用搜索功能</li>
                        <li>后台管理系统</li>
                        <li>应用详情展示</li>
                    </ul>
                </div>
            </div>
            
            <div class="layui-card" style="margin-top: 20px;">
                <div class="layui-card-header">安全提示</div>
                <div class="layui-card-body">
                    <p>为了确保系统安全，请注意以下事项：</p>
                    <ul>
                        <li>定期更新系统版本</li>
                        <li>使用强密码并定期更换</li>
                        <li>不要在不安全的网络环境下访问后台</li>
                        <li>定期备份数据库</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <script src="//unpkg.com/layui@2.11.5/dist/layui.js"></script>
</body>
</html>