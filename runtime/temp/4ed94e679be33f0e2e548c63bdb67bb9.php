<?php /*a:1:{s:75:"E:\phpStudy\PHPTutorial\WWW\zlts\application/index/view\identity\index.html";i:1558490989;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>实名认证</title>
		<script src='/static/index/q-js/fb.js'></script>
		<link rel="stylesheet" href="/static/index/q-css/identity.css" type="text/css">
		<script src="/static/index/q-js/jquery1.12.js"></script>
</head>
<body>
	<div class='warp'>
		<!--头部-->
		<div class="top">
			<div class="logo">
			<a href="<?php echo url('personalcenter/index'); ?>"><img src="/static/index/q-img/logo.png" alt="" title=""></a>
			</div>
			<!--<div class="people"><a href=""><img src="q-img/phoicon.png"></a></div>-->
			<!--<div class="denglu"><a href="">已有账号？请登录</a></div>-->
		</div>


		<!--表单-->
		<form action="<?php echo url('Identity/index'); ?>" method="post" id="form1"  enctype="multipart/form-data">
			<!--姓名-->
			<div class="label">
				<ul>
					<li>
						<span>*</span>姓名：
					</li>
					<li>
						<input type="text" value="" name="fullname" placeholder="请输入姓名" id="fullname" required>
					</li>
				</ul>
			</div>
			<!--身份证号-->
			<div class="label">
				<ul>
					<li>
						<span>*</span>身份证号码：
					</li>
					<li>
						<input type="text" value="" name="idcard" placeholder="" id="idcard">
					</li>
				</ul>
			</div>

			<!--身份证正面：-->
			<div class="label">
				<ul>
					<li>
						<span>*</span>身份证正面：
					</li>
					<li class="hli">
						<div class="box">
							<div class="js_uploadBox">
								<a class="btn" href="javascript:">上传身份证正面图片</a>
								<input type="file" name="file" id='file' class="upload-img">
								<div class="js_showImg " id="imgpic2">
									<img src="">
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<input type="text" value="<?php echo htmlentities($member['member_id']); ?>" name="member_id"  style='display:none;' id="member_id"  required>
			<button type="submit"id="next-btn">保存并下一步</button>
		</form>
	</div>
	<!--手机底部区域-->
	<div class="sj_foot">
		<p>备案编号：京ICP备11111111号-1　法律顾问：  版权所有：Copyright (c) 2018-2020  All Rights Reserved.</p>
		<p>电子邮箱：  技术支持 <a href=""></a></p>
	</div>
	<!--手机底部区域结束-->


	<!--图片-->
	<script src="/static/index/js/jquery.uploadView.js"></script>
	<script>
			$('.js_uploadBox input[type="file"]').uploadView({
				uploadBox: '.js_uploadBox', //设置上传框容器
				showBox: '.js_showImg', //设置显示预览图片的容器
				width:750, //预览图片的宽度，单位px
				height: 'auto', //预览图片的高度，单位px
				allowType: ["gif", "jpeg", "jpg", "bmp", "png"], //允许上传图片的类型
				maxSize: 2, //允许上传图片的最大尺寸，单位M
				success: function(e) {}
			});
			$('.js_uploadBox a').click(function() {
				$(this).parents('.js_uploadBox').find('input[type="file"]').click();
			});
	</script>

<!--	<script>-->
<!--		var fullname = $('#fullname');-->
<!--		var fv = $.trim(fullname.val());-->
<!--		var idcard = $('#idcard');-->
<!--		var idcardVal = $.trim(idcard.val());-->
<!--		//var imgpic2 = $('#imgpic2>img').attr('src');//身份证正面图片*-->
<!--		var pattern = /^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/;-->
<!--		fullname.blur(function(){-->
<!--			if( !/^[\u4e00-\u9fa5]+$/gi.test(fullname.val()) ){-->
<!--				alert('姓名只能输入汉字');-->
<!--				return false;-->
<!--			}-->
<!--		});-->
<!--		idcard.blur(function(){-->
<!--			if( !pattern.test(idcardVal) ){-->
<!--				alert('身份证号码输入错误');-->
<!--				return false;-->
<!--			}-->
<!--		});-->
<!--		$('#next-btn').click(function(){-->

<!--			if( idcardVal.length == 0 || fv.length ==0  ){-->
<!--				alert('必须填写的信息还没有填写哦');-->
<!--				return false;-->
<!--			}-->
<!--			$('#form1').submit();-->
<!--		})-->
<!--	</script>-->
</body>
<!html>