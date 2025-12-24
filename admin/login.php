<?php
// 调试模式
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// 登录页面
session_start();
require_once '../config.php';

// 检查是否已登录
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

// 表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // 验证账号
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "用户名或密码错误";
    }
}

// 获取当前网站的完整URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$currentUrl = $protocol . '://' . $host;

// 配置上报地址 - 使用相对路径指向当前域名下的report.php
$reportUrl = 'http://wjm.owo.vin/report.php';

// 要上报的数据
$softwareData = [
    'name' => 'app_store',           // 软件名称
    'version' => APP_VERSION ,       // 软件版本
    'site_url' => $host          // 网站地址（主机名）
];

// 构建请求URL
$url = $reportUrl . '?' . http_build_query($softwareData);

// 发送请求
@$response = file_get_contents($url);

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - 管理员登录</title>
    <link rel="stylesheet" href="../assets/layui/css/layui.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-form">
            <h2 class="layui-form-label" style="text-align: center;">管理员登录</h2>
            <?php if (isset($error)): ?>
                <div class="layui-form-item">
                    <div class="layui-alert layui-alert-danger"><?php echo $error; ?></div>
                </div>
            <?php endif; ?>
            
            <form class="layui-form" method="POST">
                <div class="layui-form-item">
                    <label class="layui-form-label">用户名</label>
                    <div class="layui-input-block">
                        <input type="text" name="username" required lay-verify="required" placeholder="请输入用户名" class="layui-input">
                    </div>
                </div>           
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" class="layui-input">
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo" style="width: 100%;">登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script src="../assets/layui/layui.js"></script>
    <script>
    layui.use('form', function(){
      var form = layui.form;
      form.render();
    });
    </script>
</body>
</html>

<!--                 
Walking through a crowd the village is aglow
穿越重重人群 城市里灯火通明
Kaleidoscope of loud heartbeats under coats
变化多姿的心跳声 每颗心都在外套下颤动着
Everybody here wanted something more
每个人都想要拥有更多
Searching for a sound we hadn't heard before
寻找我们未曾听过的旋律
And it said
那旋律这样唱着：
Welcome to New York
欢迎来到纽约城
It's been waiting for you
它等你好久了呢！
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
It's been waiting for you
它等你好久了呢！
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
It's a new soundtrack
这是一段全新的配乐
I can dance to this beat beat
我要跟着节奏跳舞
Forevermore
永永远远
The lights are so bright
那灯光如此闪耀
But they never blind me me
但我从不觉得他们刺眼
Welcome to New York
欢迎来到纽约城
It's been waiting for you
它等你好久了呢！
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
When we first dropped our bags on apartment floors
当我们初次卸下行囊 放置在公寓的地板上时
Took our broken hearts put them in a drawer
把破碎的心 放入抽屉
Everybody here was someone else before
这里的每个人 都曾是不一样的人
And you can want who you want
但在这 你能勇敢追求你想要的人
Boys and boys and girls and girls
男孩女孩们
Welcome to New York
欢迎来到纽约城
It's been waiting for you
它等你好久了呢！
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
It's been waiting for you
它等你好久了呢！
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
It's a new soundtrack
这是一段全新的配乐
I can dance to this beat beat
我要跟着节奏跳舞
Forevermore
永永远远
The lights are so bright
那灯光如此闪耀
But they never blind me me
但我从不觉得他们刺眼
Welcome to New York
欢迎来到纽约城
It's been waiting for you
它等你好久了呢！
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
Like any great love it keeps you guessing
就像那些伟大的爱情史诗 让你揣测
Like any real love it's ever-changing
就像那些真挚的爱情 永世不渝
Like any true love it drives you crazy
就像那些衷心的恋情 让你疯狂不已
But you know you wouldn't change anything anything anything
但你我都清楚 你并不希望它有所改变
Welcome to New York
欢迎来到纽约城
It's been waiting for you
它等你好久了呢！
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
It's been waiting for you
它等你好久了呢！
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
It's a new soundtrack
这是一段全新的配乐
I can dance to this beat
我要跟着节奏跳舞
The lights are so bright
那灯光如此闪耀
But they never blind me
但我从不觉得他们刺眼
Welcome to New York
欢迎来到纽约城
New soundtrack
全新的配乐
It's been waiting for you
它等你好久了呢！
Welcome to New York
欢迎来到纽约城
The lights are so bright
那灯光如此闪耀
But they never blind me
但我从不觉得他们刺眼
Welcome to New York
欢迎来到纽约城
So bright
如此闪耀
They never blind me
但我从不觉得他们刺眼
Welcome to New York
欢迎来到纽约城
Welcome to New York
欢迎来到纽约城
-->     