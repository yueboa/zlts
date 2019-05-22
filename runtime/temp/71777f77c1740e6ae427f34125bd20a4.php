<?php /*a:1:{s:81:"E:\phpStudy\PHPTutorial\WWW\zlts\application/index/view\personalcenter\index.html";i:1558490191;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>个人中心</title>
		<script type="text/javascript" src='/static/index/q-js/fb.js'></script>
		<link rel="stylesheet" href="/static/index/q-css/personalcenter.css" type="text/css">
</head>
<body>

	<div class='warp'>
		<div class="logo">
			<img src="/static/index/q-img/logo.png" alt="" title="">
		</div>
		<div class="people">
			<div class="pic">
				<img src="<?php echo htmlentities($member['img_url']); ?>" alt="" title="">
			</div>
			<a href="" class="auth">
				<img src="/static/index/q-img/icon_01.jpg">
			</a>
		<!-- 	<a class="edit" style='float:left;'>
				<?php if($member['identity_is'] == '0'): ?>待审核<?php endif; if($member['identity_is'] == '1'): ?>审核通过<?php endif; if($member['identity_is'] == '2'): ?>审核失败<?php endif; ?>
			</a> -->
			<!-- <a href="<?php echo url('Member/edit'); ?>" ></a> -->
			<p class="name" ><span style='float:left;margin-left:30%'><?php echo htmlentities($member['nikename']); ?></span><img style='float:left;' id=useredit onclick='useredit()' src="/static/index/q-img/icon_02.jpg"></p>
		
		</div>

		<div class="list">
			<ul>
				
				<li onclick='Mymoney()'>
					<img src="/static/index/q-img/icon_03.jpg"><span>我的会费</span><a href="<?php echo url('Mymoney/index'); ?>"> > </a>
				</li>
				
				<li onclick='Activity()'>
					<img src="/static/index/q-img/icon_04.jpg"><span>我的活动</span><a href="<?php echo url('Activity/index'); ?>"> > </a>
				</li>
				<li onclick='Mycompany()'>
					<img src="/static/index/q-img/icon_05.jpg"><span>我的公司</span><a href="<?php echo url('Mycompany/index'); ?>"> > </a>
				</li>
				<li  onclick='Identity()'>
					<img src="/static/index/q-img/icon_06.jpg"><span>实名认证</span><a href="<?php echo url('Identity/index'); ?>"> > </a>
				</li>
			</ul>
			<ul>
				<li>
					<img src="/static/index/q-img/icon_07.jpg"><span>在线客服</span><a href="#"> > </a>
				</li>
				<li>
					<img src="/static/index/q-img/icon_08.jpg"><span>关于</span><a href="#"> > </a>
				</li>
				<li>
					<img src="/static/index/q-img/icon_09.jpg"><span>设置</span><a href="#"> > </a>
				</li>
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


<script>
	function useredit(){
		window.location.href="<?php echo url('Member/edit'); ?>";
	}
	function Mymoney(){
		window.location.href="<?php echo url('Mymoney/index'); ?>";
	}
	function Activity(){
		window.location.href="<?php echo url('Activity/index'); ?>";
	}
	function Mycompany(){
		window.location.href="<?php echo url('Mycompany/index'); ?>";
	}
	function Identity(){
		window.location.href="<?php echo url('Identity/index'); ?>";
	}

</script>

