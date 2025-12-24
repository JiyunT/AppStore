<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <i class="bi bi-app-indicator me-2"></i>
                <span><?php echo SITE_NAME; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                            <i class="bi bi-house-door me-1"></i> 首页
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo basename($_SERVER['PHP_SELF']) == 'category.php' ? 'active' : ''; ?>" href="category.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-folder me-1"></i> 分类
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach (getAllCategories() as $category): ?>
                            <li><a class="dropdown-item" href="category.php?id=<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'ranking.php' ? 'active' : ''; ?>" href="ranking.php">
                            <i class="bi bi-trophy me-1"></i> 排行榜
                        </a>
                    </li>
                </ul>
                <form class="d-flex me-3" action="search.php" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" name="q" placeholder="搜索应用..." aria-label="搜索应用">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'admin/') !== false ? 'active' : ''; ?>" href="admin/login.php">
                            <i class="bi bi-shield-lock me-1"></i> 管理员
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</file>