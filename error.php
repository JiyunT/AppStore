<?php
// 定义SITE_NAME常量（如果尚未定义）
if (!defined('SITE_NAME')) {
    define('SITE_NAME', '应用商店管理系统');
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>错误 - <?php echo SITE_NAME; ?></title>
    <link href="assets/layui/css/layui.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="error-page">
    <div class="error-container">
        <div class="error-title">发生错误</div>
        <div class="error-message">
            <?php
            // 由调用页面传递
            if (isset($_GET['msg'])) {
                echo htmlspecialchars($_GET['msg']);
            } else {
                echo "发生未知错误，请返回重试。";
            }
            ?>
        </div>
        <a href="javascript:history.back()" class="back-link">返回上一页</a>
    </div>
</body>
</html>