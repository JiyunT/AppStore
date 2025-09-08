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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_site_name = trim($_POST['site_name']);
    $new_contact_email = trim($_POST['contact_email']);
    $new_contact_phone = trim($_POST['contact_phone']);
    
    // 更新配置文件中的定义
    $config_file = '../config.php';
    $config_content = file_get_contents($config_file);
    
    // 更新站点名称
    if (!empty($new_site_name)) {
        $pattern = "/define\('SITE_NAME', '.*?'\);/";
        $replacement = "define('SITE_NAME', '" . addslashes($new_site_name) . "');";
        $config_content = preg_replace($pattern, $replacement, $config_content);
    }
    
    // 更新联系邮箱
    if (isset($new_contact_email)) {
        $pattern = "/define\('CONTACT_EMAIL', '.*?'\);/";
        $replacement = "define('CONTACT_EMAIL', '" . addslashes($new_contact_email) . "');";
        $config_content = preg_replace($pattern, $replacement, $config_content);
    }
    
    // 更新联系电话
    if (isset($new_contact_phone)) {
        $pattern = "/define\('CONTACT_PHONE', '.*?'\);/";
        $replacement = "define('CONTACT_PHONE', '" . addslashes($new_contact_phone) . "');";
        $config_content = preg_replace($pattern, $replacement, $config_content);
    }
    
    // 写入文件
    if (file_put_contents($config_file, $config_content) !== false) {
        $message = '设置已保存';
    } else {
        $message = '保存失败，请检查文件权限';
    }
}

// 获取当前设置
$current_site_name = SITE_NAME;
$current_contact_email = CONTACT_EMAIL;
$current_contact_phone = CONTACT_PHONE;
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
                    <label class="layui-form-label">联系邮箱</label>
                    <div class="layui-input-block">
                        <input type="email" name="contact_email" 
                               placeholder="请输入联系邮箱" autocomplete="off" class="layui-input" 
                               value="<?php echo htmlspecialchars($current_contact_email); ?>">
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <label class="layui-form-label">联系电话</label>
                    <div class="layui-input-block">
                        <input type="text" name="contact_phone" 
                               placeholder="请输入联系电话" autocomplete="off" class="layui-input" 
                               value="<?php echo htmlspecialchars($current_contact_phone); ?>">
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
                    <p>2. 联系邮箱和联系电话会显示在网站底部。</p>
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