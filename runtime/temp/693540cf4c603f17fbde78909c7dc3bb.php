<?php /*a:4:{s:71:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\index\main.html";i:1536030816;s:74:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\layout\layout.html";i:1536030817;s:74:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\public\header.html";i:1557968433;s:74:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\public\footer.html";i:1536030817;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>项目</title>

    <link href="/static/plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/static/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/static/plugins/animate/animate.css" rel="stylesheet">

    <link href="/static/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="/static/admin/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="/static/admin/css/hhn.css?v=<?php echo time(); ?>" rel="stylesheet">

    <script src="/static/plugins/jquery/jquery-3.1.1.min.js"></script>
    <script src="/static/plugins/jquery.form/jquery.form.min.js"></script>
    <script src="/static/plugins/layer/layer.js"></script>
    <script src="/static/admin/js/hhn.js?v=<?php echo time(); ?>"></script>

</head>
<body class="gray-bg">
<div class=" animated fadeInDown">
<div class="wrapper wrapper-content">

    <div class="row">

        <div class="col-lg-6">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>登录信息</h5>
                </div>
                <div class="ibox-content">
                    <p>
                        您好，<?php echo htmlentities($admin['username']); ?>
                    </p>
                    <p>所属角色：<?php echo htmlentities($role['name']); ?></p>

                    <div class="hr-line-dashed"></div>
                    <p>
                        上次登录时间：<?php echo date('Y-m-d H:i:s', $admin['last_login_time']); ?>
                    </p>
                    <p>
                        上次登录IP：<?php echo htmlentities($admin['last_login_ip']); ?>
                    </p>

                </div>
            </div>

        </div>


        <div class="col-lg-6">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>安全提示</h5>
                </div>
                <div class="ibox-content">
                    <p>暂无</p>

                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>开发团队</h5>
                </div>
                <div class="ibox-content">
                    <p>暂无</p>

                </div>
            </div>

        </div>

        <div class="col-lg-6">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>系统信息</h5>
                </div>
                <div class="ibox-content">

                    <p>
                        程序版本：V1.0
                    </p>
                    <p>
                        操作系统：<?php echo PHP_OS; ?>
                    </p>

                    <p>
                        服务器软件：<?php echo htmlentities($_SERVER ['SERVER_SOFTWARE']); ?>
                    </p>
                    <p>
                        MySQL 版本：<?php echo htmlentities($mysql_ver); ?>
                    </p>

                </div>
            </div>

        </div>

    </div>





</div>
</div>
<script src="/static/plugins/bootstrap/bootstrap.min.js"></script>


<!-- Toastr -->

<script src="/static/plugins/toastr/toastr.min.js"></script>



<script src="/static/plugins/pace/pace.min.js"></script>

</body>
</html>