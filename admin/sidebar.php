   <!-- 侧边栏组件  -->
<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域 -->
        <div class="layui-logo" style="background-color: #282b33;">
            <span style="color: #fff; font-weight: bold;"><?php echo SITE_NAME; ?></span>
        </div>
        
        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            <li data-name="index" class="layui-nav-item">
                <a href="index.php" lay-tips="控制台" lay-direction="2">
                    <i class="layui-icon layui-icon-console"></i>
                    <cite>控制台</cite>
                </a>
            </li>
            
            <li data-name="apps" class="layui-nav-item">
                <a href="javascript:;" lay-tips="应用管理" lay-direction="2">
                    <i class="layui-icon layui-icon-app"></i>
                    <cite>应用管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="app-list">
                        <a href="apps.php">应用列表</a>
                    </dd>
                    <dd data-name="app-add">
                        <a href="add_app.php">添加应用</a>
                    </dd>
                </dl>
            </li>
            
            <li data-name="categories" class="layui-nav-item">
                <a href="javascript:;" lay-tips="分类管理" lay-direction="2">
                    <i class="layui-icon layui-icon-tabs"></i>
                    <cite>分类管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="category-list">
                        <a href="categories.php">分类列表</a>
                    </dd>
                    <dd data-name="category-add">
                        <a href="add_category.php">添加分类</a>
                    </dd>
                </dl>
            </li>
            
            <li data-name="settings" class="layui-nav-item">
                <a href="settings.php" lay-tips="站点设置" lay-direction="2">
                    <i class="layui-icon layui-icon-set"></i>
                    <cite>站点设置</cite>
                </a>
            </li>
            
            <li data-name="account" class="layui-nav-item" style="margin-top: 20px;">
                <a href="javascript:;" lay-tips="账号管理" lay-direction="2">
                    <i class="layui-icon layui-icon-user"></i>
                    <cite>账号管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="change-password">
                        <a href="change_password.php">修改密码</a>
                    </dd>
                    <dd data-name="about">
                        <a href="about.php">关于系统</a>
                    </dd>
                </dl>
            </li>
            
            <li data-name="logout" class="layui-nav-item">
                <a href="logout.php" style="color: #FF5722;" lay-tips="退出登录" lay-direction="2">
                    <i class="layui-icon layui-icon-logout"></i>
                    <cite>退出登录</cite>
                </a>
            </li>
        </ul>
    </div>
</div>