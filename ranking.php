<?php
// 调试模式
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 排行榜页面
require_once 'config.php';  // 主配置文件
require_once 'includes/functions.php'; // 工具函数

// 获取排行榜数据
$rankingApps = getRankingApps(20);

// 头部模板
include 'includes/header.php';
?>

<div class="container mt-4">
    <!-- 页面标题 -->
    <h1 class="text-center mb-4" style="color: #3a7bd5;">应用下载排行榜</h1>
    
    <?php if (empty($rankingApps)): ?>
    <!-- 空状态处理 -->
    <div class="alert alert-warning text-center">
        暂无排行榜数据。
    </div>
    <?php else: ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">热门下载应用 Top 20</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="8%">排名</th>
                                    <th scope="col" width="10%">应用图标</th>
                                    <th scope="col" width="25%">应用名称</th>
                                    <th scope="col" width="30%">应用描述</th>
                                    <th scope="col" width="15%">版本</th>
                                    <th scope="col" width="12%">下载量</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rankingApps as $index => $app): ?>
                                <tr>
                                    <td>
                                        <?php if ($index < 3): ?>
                                            <span class="badge badge-danger" style="font-size: 1rem;"><?php echo $index + 1; ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary"><?php echo $index + 1; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo displayAppImage($app, 'assets/images/default-app.png'); ?>
                                    </td>
                                    <td>
                                        <a href="details.php?id=<?php echo $app['id']; ?>">
                                            <?php echo displayAppName($app); ?>
                                        </a>
                                    </td>
                                    <td><?php echo displayAppDescription($app, 50); ?></td>
                                    <td><?php echo displayAppVersion($app); ?></td>
                                    <td>
                                        <span class="badge badge-primary">
                                            <?php echo displayAppDownloadCount($app); ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php
// 页脚模板 
include 'includes/footer.php';
?>