<?php /*a:6:{s:72:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\member\edit.html";i:1558490407;s:74:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\layout\layout.html";i:1536030817;s:74:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\public\header.html";i:1557968433;s:75:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\member\img_url.html";i:1558239564;s:80:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\member\identity_img.html";i:1558239555;s:74:"E:\phpStudy\PHPTutorial\WWW\zlts\application/admin/view\public\footer.html";i:1536030817;}*/ ?>
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
					<form method="post" class="form-horizontal hhn-ajaxform">
                       <input type="hidden" name="member_id" value="<?php echo htmlentities($data['member_id']); ?>">
						<div class="row">
							<div class="col-lg-8 col-md-8 col-sm-7">
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label">用户昵称</label>
									<div class="col-sm-10">
										<input type="text" name="nikename" class="form-control" value="<?php echo htmlentities($data['nikename']); ?>">
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label">真实姓名</label>
									<div class="col-sm-10">
										<input type="text" name="fullname" class="form-control" value="<?php echo htmlentities($data['fullname']); ?>">
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label">电话</label>
									<div class="col-sm-10">
										<input type="text" name="tel" class="form-control" value="<?php echo htmlentities($data['tel']); ?>">
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label">头像</label>
									<div class="col-sm-10">
										  <!--上传图片-->

<script src="/static/plugins/plupload/plupload.full.min.js"></script>
<div class="uploader-box " id="img_url-uploader-box" style="">
	<button type="button" class="btn btn-primary btn-sm" id="img_url-button" data-text="上传文件">上传文件</button>
	<div class="alert alert-danger alert-dismissable" style="display: none;"></div>
	<div class="uploader-list"></div>
</div>


<script >
    var img_url = '';
    <?php if(isset($data['img_url'])): ?>
    	img_url = '<?php echo htmlentities($data["img_url"]); ?>';
    <?php endif; ?>
    multifile = typeof(multifile) == 'undefined'?1:multifile;
    maximum = typeof(maximum) == 'undefined'?1:maximum;

$(function(){
	   hhn.upload({ 
		name:'img_url', 
		value:img_url, 
		url:"<?php echo url('attachment/upload'); ?>", 
		multifile:0, 
		maximum:1, 
		maxsize:'2048kb',
		ext_type:'jpg,jpeg,png,gif', 
		ext_field: [],
		show_field_text:1, 
		show_url:0,
		show_size:{"width":"auto","height":"100px"}, 
		multipart_params:[],
		field_name:'img_url'  
		});
})


</script>

 
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label">通讯地址</label>
									<div class="col-sm-10">
										<input type="text" name="household" class="form-control" value="<?php echo htmlentities($data['household']); ?>">
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label">身份证号</label>
									<div class="col-sm-10">
										<input type="text" name="idcard" class="form-control" value="<?php echo htmlentities($data['idcard']); ?>">
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label">身份证正面</label>
									<div class="col-sm-10">
										  <!--上传图片-->

<script src="/static/plugins/plupload/plupload.full.min.js"></script>
<div class="uploader-box " id="identity_img-uploader-box" style="">
	<button type="button" class="btn btn-primary btn-sm" id="identity_img-button" data-text="上传文件">上传文件</button>
	<div class="alert alert-danger alert-dismissable" style="display: none;"></div>
	<div class="uploader-list"></div>
</div>


<script >
    var identity_img = '';
    <?php if(isset($data['identity_img'])): ?>
    	identity_img = '<?php echo htmlentities($data["identity_img"]); ?>';
    <?php endif; ?>
	//img = '[{"imgurl":"\/uploads\/20190301\/c415f597723b637154447db03fd5f82e.png"},{"imgurl":"\/uploads\/20190301\/9ee7d631e6e3c8605c08727c0956818d.png"},{"imgurl":"\/uploads\/20190301\/30d28e25d9d3edc64789c23a153c6fd2.png"},{"imgurl":"\/uploads\/20190301\/c10fd610d97402413979cd5c0579c840.png"}]';
    multifile = typeof(multifile) == 'undefined'?1:multifile;
    maximum = typeof(maximum) == 'undefined'?1:maximum;

$(function(){
	   hhn.upload({ 
		name:'identity_img', 
		value:identity_img, 
		url:"<?php echo url('attachment/upload'); ?>", 
		multifile:0, 
		maximum:1, 
		maxsize:'2048kb',
		ext_type:'jpg,jpeg,png,gif', 
		ext_field: [],
		show_field_text:1, 
		show_url:0,
		show_size:{"width":"auto","height":"100px"}, 
		multipart_params:[],
		field_name:'identity_img'  
		});
})


</script>

 
									</div>
								</div>
								<!-- <div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label">审核</label>
									<div class="col-sm-10">
										<div class="radio">
			  
											<label for="identity_is-0"><input id="identity_is-0" name="identity_is" type="radio" value="0" <?php if($data['identity_is'] == '0'): ?> checked="" <?php endif; ?>> 待审核</label>
											<label for="identity_is-1"><input id="identity_is-1" name="identity_is" type="radio" value="1" <?php if($data['identity_is'] == '1'): ?> checked="" <?php endif; ?>> 通过审核</label>
											<label for="identity_is-2"><input id="identity_is-2" name="identity_is" type="radio" value="2" <?php if($data['identity_is'] == '2'): ?> checked="" <?php endif; ?>> 审核失败</label>
						 
										</div>
									</div>
								</div> -->
							</div>
							
								

							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">

									<button class="btn btn-primary ajaxbutton" type="submit">提交</button>

									<button class="btn btn-white" type="reset">重置</button>
								</div>
							</div>
						</div>
                    </form>
                </div>
				
            </div>
        </div>
    </div>
</div>

<script>
	var multifile = 0;
	var maximum = 1;


</script>



</div>
<script src="/static/plugins/bootstrap/bootstrap.min.js"></script>


<!-- Toastr -->

<script src="/static/plugins/toastr/toastr.min.js"></script>



<script src="/static/plugins/pace/pace.min.js"></script>

</body>
</html>