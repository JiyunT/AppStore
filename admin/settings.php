<?php
// 调试模式
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// 后台设置页面
session_start();
require_once '../config.php';
require_once '../includes/functions.php';

// 是否登录
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// 处理表单提交
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['site_name'])) {
    $new_site_name = trim($_POST['site_name']);
    
    if (!empty($new_site_name)) {
        // 更新配置文件中的SITE_NAME定义
        $config_file = '../config.php';
        $config_content = file_get_contents($config_file);
        
        // 使用正则表达式替换SITE_NAME的值
        $pattern = "/define\('SITE_NAME', '.*?'\);/";
        $replacement = "define('SITE_NAME', '" . addslashes($new_site_name) . "');";
        $new_config_content = preg_replace($pattern, $replacement, $config_content);
        
        // 写入文件
        if (file_put_contents($config_file, $new_config_content) !== false) {
            $message = '设置已保存';
        } else {
            $message = '保存失败，请检查文件权限';
        }
    } else {
        $message = '站点标题不能为空';
    }
}

// 获取当前站点标题
$current_site_name = SITE_NAME;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - 设置</title>
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
            <h2>站点设置</h2>
            <hr>
            
            <?php if ($message): ?>
            <div class="layui-alert layui-bg-green"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            
            <form class="layui-form" method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label">站点标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="site_name" required lay-verify="required" 
                               placeholder="请输入站点标题" autocomplete="off" class="layui-input" 
                               value="<?php echo htmlspecialchars($current_site_name); ?>">
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo">保存设置</button>
                    </div>
                </div>
            </form>
            
            <div class="layui-card" style="margin-top: 30px;">
                <div class="layui-card-header">说明</div>
                <div class="layui-card-body">
                    <p>1. 修改站点标题后，整个网站的所有页面标题都会相应更新。</p>
                    <p>2. 请不要使用特殊字符，以免造成显示问题。</p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="//unpkg.com/layui@2.11.5/dist/layui.js"></script>
    <script>
        layui.use('form', function(){
            var form = layui.form;
            form.render();
        });
    </script>
</body>
</html>