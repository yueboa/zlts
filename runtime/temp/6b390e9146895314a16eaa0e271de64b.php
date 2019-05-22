<?php /*a:1:{s:74:"E:\phpStudy\PHPTutorial\WWW\zlts\application/index/view\mymoney\index.html";i:1558000302;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>我的会费</title>
		<script type="text/javascript" src='/static/index/q-js/fb.js'></script>
		<link rel="stylesheet" href="/static/index/q-css/mymoney.css" type="text/css">
</head>
<body>

	<div class='warp'>
		<div class="logo">
			<a href="<?php echo url('personalcenter/index'); ?>"><img src="/static/index/q-img/logo.png" alt="" title=""></a>
		</div>
		<div class="people">
			<div class="pic">
				<img src="<?php echo htmlentities($member['img_url']); ?>" alt="" title="">
			</div>
			<p class="name">余额：<?php echo htmlentities($member['mymoney']); ?>元</p>
		</div>

		<div class="details">
			<!--<div class="zero">您还未进行过消费</div>-->
			<ul>
				<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li><?php echo htmlentities($v['addtime']); ?>;
					<?php if($v['status'] == '0'): ?> 充值<?php endif; if($v['status'] == '1'): ?> 消费<?php endif; ?>
					&nbsp;<span><?php echo htmlentities($v['money']); ?></span>&nbsp;元</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>

	</div>


	<!--手机底部区域-->
	<div class="sj_foot">
		<p>备案编号：京ICP备11111111号-1　法律顾问：  版权所有：Copyright (c) 2018-2020  All Rights Reserved.</p>
		<p>电子邮箱：  技术支持 <a href=""></a></p>
	</div>
	<!--手机底部区域结束-->

</body>
<!html>