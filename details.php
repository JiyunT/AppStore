<?php
// 调试模式
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 详情页
require_once 'config.php'; // 主配置文件
require_once 'includes/functions.php';

// 应用ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 获取应用详情
$app = getAppDetails($id);
if (!$app) {
    header("Location: index.php");
    exit;
}

// 头部文件
include 'includes/header.php';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <!-- 应用图片，没图片时用默认图 -->
            <?php $imgUrl = !empty($app['icon_path']) 
                ? htmlspecialchars($app['icon_path'], ENT_QUOTES) 
                : 'assets/images/default-app.png'; ?>
            <img src="<?= $imgUrl ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($app['name']) ?>" onerror="this.src='assets/images/default-app.png'">
            <div class="mt-3">
                <a href="<?php echo !empty($app['file_path']) ? htmlspecialchars($app['file_path'], ENT_QUOTES) : '#'; ?>" class="btn btn-success btn-block">下载应用</a>
            </div>
        </div>
        <div class="col-md-8">
            <h2><?php echo $app['name']; ?></h2>
            <p class="text-muted">版本: <?php echo $app['version']; ?> | 大小: <?php echo $app['size']; ?> | 下载量: <?php echo $app['download_count']; ?></p>
            <hr>
            <h4>应用描述</h4>
            <p><?php echo nl2br($app['description']); ?></p>
            
            <h4 class="mt-4">应用截图</h4>
            <div class="row">
                <?php $screenshots = isset($app['screenshots']) && !empty($app['screenshots']) ? explode(',', $app['screenshots']) : []; ?>
                <?php foreach ($screenshots as $screenshot): ?>
                <div class="col-md-4 mb-3">
                    <img src="<?php echo trim($screenshot); ?>" class="img-thumbnail" alt="应用截图">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php
// 包含页脚文件
include 'includes/footer.php';
?>