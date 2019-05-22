<?php /*a:4:{s:76:"D:\phpstudy\PHPTutorial\WWW\uiadmin\application/admin/view\member\index.html";i:1558418446;s:77:"D:\phpstudy\PHPTutorial\WWW\uiadmin\application/admin/view\layout\layout.html";i:1536030817;s:77:"D:\phpstudy\PHPTutorial\WWW\uiadmin\application/admin/view\public\header.html";i:1557968433;s:77:"D:\phpstudy\PHPTutorial\WWW\uiadmin\application/admin/view\public\footer.html";i:1536030817;}*/ ?>
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
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <ul class="nav nav-tabs">
                        <?php if(empty($node_name)): if(empty($node['is_show'])): ?>
                        <li class="active"><a href="javascript:void(0);"><?php echo htmlentities($node['name']); ?></a></li>
                        <?php endif; else: ?>
                        <li class="active"><a href="javascript:void(0);"><?php echo htmlentities($node_name); ?></a></li>
                        <?php endif; if(!empty($brotherNodes)): if(is_array($brotherNodes) || $brotherNodes instanceof \think\Collection || $brotherNodes instanceof \think\Paginator): $i = 0; $__LIST__ = $brotherNodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if(!$v['status'] && $v['is_show']): ?>
                        <li<?php if($v['nodeid']==$node['nodeid']): ?> class="active"<?php endif; ?>><a href="<?php echo url($v['controller'].'/'.$v['action']); ?>"><?php echo htmlentities($v['name']); ?></a></li>
                        <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                    </ul>
                </div>
                <div class="ibox-content">
                <div class="row">
                    <form method="post" action="" id="form1">

                        <div class="col-sm-8 m-b-xs">
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group"><input type="text" placeholder="按昵称,手机号查询" name="tel" class="input-sm form-control" value="<?php echo htmlentities($tel); ?>" > <span class="input-group-btn">
                                <button  class="btn btn-sm btn-primary" type="submit">搜索</button> </span></div>
                        </div>
                    </form>
                </div>
                <form class="ibox-content hhn-ajaxform" method="post">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" width="80">ID</th>
                                <th class="text-center">昵称</th>
                                <th class="text-center" width="150">头像</th>
                                <th class="text-center" width="150">电话</th>
                                <th class="text-center" width="150">地址</th>
                                <th class="text-center" width="150">真实姓名</th>
                                <th class="text-center" width="150">身份证号</th>
                                <th class="text-center" width="150">余额(元)</th>
                                <th class="text-center" width="150">身份证图片</th>
                                <th class="text-center" width="150">审核</th>
								<th class="text-center" width="150"><?php echo lang('operation'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <tr class="gradeA odd" role="row">
                                <!--<td>-->
                                    <!--<input type="text" name="" value="" class="form-control input-sm list-order-input">-->
                                <!--</td>-->
                                <td class="text-center"><?php echo htmlentities($v['member_id']); ?></td>
                                <td class="text-center"><?php echo htmlentities($v['nikename']); ?></td>
                                <td class="text-center"><img src="<?php echo htmlentities($v['img_url']); ?>" alt="<?php echo htmlentities($v['img_url']); ?>" height="50"></td>
                                <td class="text-center"><?php echo htmlentities($v['tel']); ?></td>
                                <td class="text-center"><?php echo htmlentities($v['household']); ?></td>
                                <td class="text-center"><?php echo htmlentities($v['fullname']); ?></td>
                                <td class="text-center"><?php echo htmlentities($v['idcard']); ?></td>
                                <td class="text-center"><?php echo htmlentities($v['mymoney']); ?></td>
                                <td class="text-center"><img src="<?php echo htmlentities($v['identity_img']); ?>" alt="<?php echo htmlentities($v['identity_img']); ?>" height="50"></td>
                                <td class="text-center">
									<?php if($v['identity_is'] == '0'): ?> 待审核<?php endif; if($v['identity_is'] == '1'): ?> 审核通过<?php endif; if($v['identity_is'] == '2'): ?> 审核失败<?php endif; ?>
								
								</td>

                                <td class="text-center">

                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-xs" href="<?php echo url('edit','id='.$v['member_id']); ?>"><?php echo lang('edit'); ?></a>
                                        <button class="btn btn-info btn-xs" onclick ='chzlog(<?php echo htmlentities($v['member_id']); ?>)'> 充值记录 </button>
                                        <a class="btn btn-danger btn-xs hhn-ajaxrequest" href="<?php echo url('dele','id='.$v['member_id']); ?>" data-confirm="<?php echo lang('do_you_sure_delete_it'); ?>"><?php echo lang('delete'); ?></a>

                                    </div>


                                </td>

                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">

                            <!--<div class="btn-group">-->

                                <!--<button class="btn btn-default btn-sm" data-href="<?php echo url('sort'); ?>"><?php echo lang('sort'); ?></button>-->

                            <!--</div>-->

                        </div>
                        <div class="col-xs-6 text-right">
                            <?php echo $page; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

</div>

<script>
    //单个分组
    function chzlog(id){
        layer.open({
            type: 2,
            area:['1000px','600px'],
            fixed: false, //不固定
            title:'缴费记录',
            maxmin: true,
            content:"<?php echo url('MymoneyLog/index'); ?>?id="+id,
        });
    }

</script>
</div>
<script src="/static/plugins/bootstrap/bootstrap.min.js"></script>


<!-- Toastr -->

<script src="/static/plugins/toastr/toastr.min.js"></script>



<script src="/static/plugins/pace/pace.min.js"></script>

</body>
</html>