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
    <div class="app-details">
        <div class="row">
            <div class="col-md-5">
                <!-- 应用图片，没图片时用默认图 -->
                <?php $imgUrl = !empty($app['icon_path'])
                    ? htmlspecialchars($app['icon_path'], ENT_QUOTES)
                    : 'assets/images/default-app.png'; ?>
                <img src="<?= $imgUrl ?>" class="img-fluid rounded shadow" alt="<?= htmlspecialchars($app['name']) ?>" onerror="this.src='assets/images/default-app.png'" style="max-height: 300px; object-fit: cover;">

                <div class="mt-4 text-center">
                    <a href="<?php echo !empty($app['file_path']) ? htmlspecialchars($app['file_path'], ENT_QUOTES) : '#'; ?>" class="btn btn-success btn-lg w-100">
                        <i class="bi bi-download me-2"></i>下载应用
                    </a>

                    <div class="mt-3 d-flex justify-content-center gap-3">
                        <span class="badge bg-primary">
                            <i class="bi bi-tag"></i> <?php echo displayAppVersion($app); ?>
                        </span>
                        <span class="badge bg-info">
                            <i class="bi bi-hdd"></i> <?php echo displayAppSize($app); ?>
                        </span>
                        <span class="badge bg-success">
                            <i class="bi bi-download"></i> <?php echo displayAppDownloadCount($app); ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <h1 class="fw-bold"><?php echo displayAppName($app); ?></h1>

                <div class="mt-4">
                    <h4 class="mb-3">应用描述</h4>
                    <p class="lead"><?php echo nl2br(htmlspecialchars($app['description'])); ?></p>
                </div>

                <div class="mt-4">
                    <h4 class="mb-3">应用截图</h4>
                    <div class="app-screenshots">
                        <div class="row">
                            <?php $screenshots = isset($app['screenshots']) && !empty($app['screenshots']) ? explode(',', $app['screenshots']) : []; ?>
                            <?php foreach ($screenshots as $screenshot): ?>
                            <div class="col-md-6 mb-3">
                                <img src="<?php echo trim($screenshot); ?>" class="img-fluid rounded" alt="应用截图" style="max-height: 200px; object-fit: cover;">
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 相关推荐 -->
        <div class="mt-5">
            <h4 class="mb-3">相关推荐</h4>
            <div class="row">
                <?php
                // 获取同分类的其他应用
                $relatedApps = getAppsByCategory($app['category_id'], 3, $app['id']);
                foreach ($relatedApps as $relatedApp):
                ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <?php echo displayAppImage($relatedApp); ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo displayAppName($relatedApp); ?></h5>
                            <p class="card-text"><?php echo displayAppDescription($relatedApp, 50); ?></p>
                            <a href="details.php?id=<?php echo $relatedApp['id']; ?>" class="btn btn-outline-primary">查看详情</a>
                        </div>
                    </div>
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