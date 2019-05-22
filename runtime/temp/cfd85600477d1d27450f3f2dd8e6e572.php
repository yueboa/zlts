<?php /*a:1:{s:72:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\index\index.html";i:1557968433;}*/ ?>
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
    <link href="/static/admin/css/style.css" rel="stylesheet">
    <style>
        body{
            font-size: 14px !important;
        }
        .nav-header {
            padding: 0 5px;
            background-color: #2f4050;
            height: 60px;
            line-height: 60px;
            text-align: center;
            font-size: 18px;
            border-bottom: 1px solid #293846;
        }
        body.fixed-sidebar .navbar-static-side, body.canvas-menu .navbar-static-side{
            width: 180px;
        }
        @media (min-width: 768px){
            #page-wrapper {
                margin: 0 0 0 180px;
            }
        }
        body.fixed-nav.fixed-nav-basic .navbar-fixed-top{
            left: 180px;
        }
        .footer.fixed{
            margin-left: 180px;
        }
    </style>
    <script src="/static/plugins/jquery/jquery-3.1.1.min.js"></script>
</head>

<body class="fixed-sidebar fixed-nav fixed-nav-basic" style="overflow: hidden;">

<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                            <span class="text-muted text-xs block">
                                <a href=""><?php echo htmlentities($site['name']); ?></a>
                                <b class="caret"></b>
                            </span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight"></ul>
                    </div>
                </li>
                <li class="nav-header-place"></li>

                <?php if(is_array($nodes) || $nodes instanceof \think\Collection || $nodes instanceof \think\Paginator): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node1): $mod = ($i % 2 );++$i;if(($isSuperAdmin || in_array($node1['nodeid'], $role['nodes'])) && $node1['is_show'] && !$node1['status']): ?>
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-<?php echo htmlentities($node1['icon']); ?>"></i> <span class="nav-label"><?php echo htmlentities($node1['name']); ?></span> <span class="fa arrow"></span></a>

                    <?php if(!empty($node1['son'])): ?>
                    <ul class="nav nav-second-level collapse">
                        <?php if(is_array($node1['son']) || $node1['son'] instanceof \think\Collection || $node1['son'] instanceof \think\Paginator): $i = 0; $__LIST__ = $node1['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node2): $mod = ($i % 2 );++$i;if(($isSuperAdmin || in_array($node2['nodeid'], $role['nodes'])) && $node2['is_show'] && !$node2['status']):                         $url = '';
                        if(!empty($node2['son'])){
                            foreach($node2['son'] as $val){
                                if(!$val['status'] && $val['is_show']){
                                    $url = url($val['controller'].'/'.$val['action'], $val['param']);
                                    break;
                                }
                            }
                        }

                        $url = $url ?: url($node2['controller'].'/'.$node2['action'], $node2['param']);
                        ?>
                        <li><a href="<?php echo htmlentities($url); ?>" target="main"><?php echo htmlentities($node2['name']); ?></a></li>
                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <?php endif; ?>

                </li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>

            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1" style="padding: 0;">
        <div class="border-bottom">
            <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <!--<form role="search" class="navbar-form-custom" action="search_results.html">-->
                        <!--<div class="form-group">-->
                            <!--<input type="text" placeholder="键入要搜索的关键字..." class="form-control" name="top-search" id="top-search">-->
                        <!--</div>-->
                    <!--</form>-->
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message"></span>
                    </li>

                    <li class="dropdown">

                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user-circle"></i>
                            <strong><?php echo htmlentities($admin['username']); ?></strong> [<?php echo htmlentities($role['name']); ?>] <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight">
                            <li>
                                <a href="<?php echo url('admin/info'); ?>" target="main">
                                    <i class="fa fa-gear"></i>
                                    个人资料
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('admin/pwd'); ?>" target="main">
                                    <i class="fa fa-unlock-alt"></i>
                                    修改密码
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo url('admin/logout'); ?>">
                                    <i class="fa fa-power-off"></i>
                                    退出登录
                                </a>
                            </li>

                        </ul>
                    </li>


                    <!--<li>-->
                        <!--<a href="http://www.huhangnet.com/" target="_blank">-->
                            <!--<i class="fa fa-question-circle"></i>帮助-->
                        <!--</a>-->
                    <!--</li>-->

                </ul>

            </nav>
        </div>


                <div class="wrapper" style="padding: 0;background: #fff;">
                    <iframe id="iframe" name="main" src="<?php echo url('index/main'); ?>" frameborder="0" style="width: 100%;">您的浏览器暂不支持</iframe>

                </div>



        <div class="row">
            <div class="col-lg-12">

                <div class="footer fixed">
                    <div class="pull-right">
                        10GB of <strong>250GB</strong> Free.
                    </div>
                    <div>
                        <strong>Copyright</strong> Example Company &copy; 2014-2017
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="small-chat-box fadeInRight animated">

        <div class="heading" draggable="true">
            <small class="chat-date pull-right">
                02.19.2015
            </small>
            Small chat
        </div>

        <div class="content">

            <div class="left">
                <div class="author-name">
                    Monica Jackson <small class="chat-date">
                    10:02 am
                </small>
                </div>
                <div class="chat-message active">
                    Lorem Ipsum is simply dummy text input.
                </div>

            </div>
            <div class="right">
                <div class="author-name">
                    Mick Smith
                    <small class="chat-date">
                        11:24 am
                    </small>
                </div>
                <div class="chat-message">
                    Lorem Ipsum is simpl.
                </div>
            </div>
            <div class="left">
                <div class="author-name">
                    Alice Novak
                    <small class="chat-date">
                        08:45 pm
                    </small>
                </div>
                <div class="chat-message active">
                    Check this stock char.
                </div>
            </div>
            <div class="right">
                <div class="author-name">
                    Anna Lamson
                    <small class="chat-date">
                        11:24 am
                    </small>
                </div>
                <div class="chat-message">
                    The standard chunk of Lorem Ipsum
                </div>
            </div>
            <div class="left">
                <div class="author-name">
                    Mick Lane
                    <small class="chat-date">
                        08:45 pm
                    </small>
                </div>
                <div class="chat-message active">
                    I belive that. Lorem Ipsum is simply dummy text.
                </div>
            </div>


        </div>
        <div class="form-chat">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control">
                <span class="input-group-btn"> <button
                        class="btn btn-primary" type="button">Send
                </button> </span></div>
        </div>

    </div>


</div>



<script src="/static/plugins/bootstrap/bootstrap.min.js"></script>



<script src="/static/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/static/plugins/slimscroll/jquery.slimscroll.min.js"></script>



<!-- Custom and plugin javascript -->
<script src="/static/admin/js/inspinia.js?v=<?php echo time(); ?>"></script>



<!-- Toastr -->
<link href="/static/plugins/toastr/toastr.min.css" rel="stylesheet">
<script src="/static/plugins/toastr/toastr.min.js"></script>



<script src="/static/plugins/pace/pace.min.js"></script>

</body>
</html>