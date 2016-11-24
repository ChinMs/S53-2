<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/book/Public/css/1.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/3.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/6.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/7.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/8.css"/>
	<link rel="stylesheet" href="/book/Public/css/swiper3.07.min.css"/>
	<link rel="stylesheet" href="/book/Public/css/public.css"/>
	<link rel="stylesheet" href="/book/Public/css/index.css"/>
	<script src="/book/Public/js/jquery-1.11.2.min.js"></script>
	<script src="/book/Public/js/myfocus-2.0.1.min.js"></script>
	<script src="/book/Public/js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="/book/Public/3.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/8.css"/>
	<script>
		myFocus.set({
			id:'picBOX',//焦点图盒子ID
			pattern:'mF_liquid',//风格应用的名称
			time:3,//切换时间间隔(秒)
			trigger:'click',//触发切换模式:'click'(点击)/'mouseover'(悬停)
			width:720,//设置图片区域宽度(像素)
			height:275,//设置图片区域高度(像素)
			txtHeight:'default'//文字层高度设置(像素),'default'为默认高度，0为隐藏
		});
	</script>
	
	<style>
		.swiper-container {
			width: 1100px;
			height: 300px;
			margin: 0 auto;
		}
		.read-hd-ad {
			width: 1200px;
			background: #58BD5A;
			height: 3px;
			margin-bottom: 5px;
		}
		.paixu li {
			list-style: none;
			float: left;
			width: 60px;
			line-height: 38px;
			margin-left: 25px;
			border-right: 1px solid #ededed;
		}
		.paixu li a{
			font-size: 15px;
		}
		hr{
			border:1px solid #EAEAEA;
			width:1200px;
			margin: 0 auto;
		}
		dt img{
			border-radius: 0.5em 0.5em 1em / 0.5em 0.5em;
		}
		.aa{
			width:100%;
			height:154px;
			text-align: center;
		    padding-top: 35px;
		    padding-bottom: 22px;
		    background: #FDFDFB;

		}
		.sbox{
			width: 90%;
			height: 154px;
			text-align: center;
			margin: auto;
		}
		.aa img{
			border-radius: 0.5em 0.5em 1em / 0.5em 0.5em;
		}
		.box{width: 423px;height:auto;border: 1px solid #999;background-color:#FFF;color:#000;position: fixed;z-index: 360;}
		.slist{list-style: none;margin: 0;}
		.slist li{padding-top: 2px;font-size: 15px;height:30px;line-height: 30px;}
		.slist li:hover{background: #F0F0F0;cursor: pointer;}
		#press{width:153px;height:84px;border-bottom:1px solid #eaeaea;border-right:1px solid #eaeaea;cursor: pointer;}
		#press:hover{box-shadow: 0px 0px 0px 2px #74C677 inset;}
	</style>

	<title><?php echo ($content); ?></title>
</head>
<body>
<div class="top" id="item4">
	<div class="container clearfix">
		<ul class="clearfix fl" style="color:#666666">
			<li style="margin-left:100px;">当前城市:&nbsp;&nbsp;<?php echo ($currentCity); ?></li>
			<li style="margin-left:20px;">温度:&nbsp;&nbsp;<?php echo ($temperature); ?></li>
			<li style="margin-left:20px;"><img width="18" height="16" src="<?php echo ($dayPictureUrl); ?>" alt="">&nbsp;转&nbsp;<img width="18" height="16" src="<?php echo ($nightPictureUrl); ?>" alt=""></li>
			<li></li>
		</ul>
		<ul class="clearfix fr">
			<input type="hidden" value="<?php echo ($_SESSION['url'] = $_SERVER['REQUEST_URI']); ?>">
			<?php if($user_name == null): ?><li><a href="<?php echo U('Login/login');?>">登录</a></li>
				<li><a href="<?php echo U('Reg/reg');?>">注册</a></li>
			<?php else: ?>
				<li><a href="<?php echo Mybook/index;?>"><?php echo ($user_name); ?></a></li>
				<li><a href="<?php echo U('Login/logout');?>">退出</a></li><?php endif; ?>
			<li><a href="<?php echo U('Car/car');?>">购物车</a></li>
			<li><a href="#">意见反馈</a></li>
			<li><a href="" style="border: none">消息</a></li>
		</ul>
	</div>
</div>

<div class="header">
	<div class="container clearfix">
		<div style="width:1090px;height:92px;margin:auto;">
		<div class="logo fl">
			<a href="#"><img src="/book/Public/images/Home/baidu.png" alt=""/></a>
		</div>
		<div class="seacher fl">
			<!-- 搜索 -->
			<form action="<?php echo U('Detail/index');?>" method="get">
				<input type="hidden" id="x" name="id" value="">
				<input type="text" id="inputString" onkeyup="lookup(this.value)" onblur="fill()" style="border-right:none;font-size:14px;" placeholder="从十万册图书中搜索"/><input type="submit"  style="border-top:2px solid #70bc64;" value="搜 索"/>
				<div class="box" id="suggest" style="display:none">
					<ul class="slist" id="autolist">
						<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</form>
			<p>热门搜索：<a href="#">龙应台</a>  <a href="#">南有乔木</a>  <a href="#"> 后宫如懿传</a>  <a href="#"> 法医秦明</a>  <a href="#"> 如若有你，一生何求</a></p>
		</div>
	<script>
		function lookup(inputString){
			if(inputString.length == 0){
				$('#suggest').hide();
			}else{
				$.ajax({
					type:'post',
					url:"<?php echo U('Index/search');?>",
					data:{queryString:inputString},
					// async: false,
					success:function(data){
						if(data.length>0){
							$('#suggest').show();
							$('#autolist').html(data);
							// console.log(data);
						}
					}
				})

			}
		}

		function fill(thisValue,thisid){
			$('#inputString').val(thisValue);
			// console.log(thisid);
			$('#x').attr('value',thisid);
			setTimeout("$('#suggest').hide()",200);
		}
	</script>


		<div class="mm fl clearfix">
			<img src="/book/Public/images/Home/11.jpg" alt="">
		</div>
		</div>
	</div>
</div>

<div class="mian container">
<!-- 	<img src="images/notice.png" alt="" style="width: 1200px;height: auto;"/> -->
	<div class="read-nav-wp">
<div class="read-nav-inner wrap-page-width">
<ul class="read-nav clearfix">
<li class="nav-li-index"><a class="nav-index" href="<?php echo U('Index/index');?>"><span>首页</span></a><span class="nav-border"></span></li>
<li class="nav-li-category"><a class="nav-category" href="<?php echo U('Product/index');?>"><span>分类</span></a><span class="nav-border"></span></li>
<li class="nav-li-rank"><a class="nav-rank" href="/rank/hotsale"><span>榜单</span></a><span class="nav-border"></span></li>
<li class="nav-li-author"><a class="nav-author" href="" target="_blank"><span>独家作品</span></a><span class="nav-border"></span></li>
<li class="nav-li-org"><a class="nav-org" href=""><span>机构专区</span></a><span class="nav-border"></span></li>
<li class="nav-li-app"><a class="nav-app" href=""><span>客户端</span></a><span class="nav-border"></span></li>
</ul>
<ul class="read-nav-right clearfix">
<li class="nav-right-li"><a href="" class="nav-right-mypartner"><span class="nav-right-mypartner-icon"></span>我是机构</a></li>
<li class="nav-right-li"><a href="" class="nav-right-myauthor"><span class="nav-right-myauthor-icon"></span>我是作者</a></li>
<li class="nav-right-li"><a href="<?php echo U('Mybook/bookshelf');?>" class="nav-right-mybook"><span class="nav-right-mybook-icon"></span>我的书架</a></li>
</ul>
</div>
</div>
<div class="read-hd-ad">

</div>


	<div class="clearfix" style="width:100%;">
		<div class="about fl" style="width:370px;height:285px;margin-left:50px;">
			<img src="/book/Public/images/Home/top_bg_9.png" alt="" style="width:370px;height:285px"/>

		</div>
		<div class="focus fl" style="height:285px;">
			<div id="picBOX" ><!--焦点图盒子-->
				<!--<div class="loading"><img src="js/mf-pattern/img/loading.gif" alt="请稍候..." /></div>--><!--载入画面(可删除)-->
				<div class="pic" ><!--内容列表(li数目可随意增减)-->
						<ul >
							<?php if(is_array($actlink)): $i = 0; $__LIST__ = $actlink;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>"><img src="/book/Public/images/Admin/Actlink/<?php echo ($vo["picname"]); ?>" thumb="12" alt="<?php echo ($vo["title"]); ?>" text="卖书" height="285"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>

				</div>
			</div>
		</div>

	</div>
	
<div class="aa">
	<div class="sbox">
		<a href="" style="margin-left: -50px;"><img src="/book/Public/images/Home/a1.jpg" alt=""></a>
		<a href="" style="margin-left:40px;"><img src="/book/Public/images/Home/a2.jpg" alt=""></a>
		<a href="" style="margin-left:40px;"><img src="/book/Public/images/Home/a3.jpg" alt=""></a>
	</div>
</div>

	<div class="jiaocai clearfix" id="item3">
		<h1>热门推荐</h1>
		<div class="book clearfix" style="margin: 0 auto;width: 85%;border-bottom:1px solid #E0E1E1;">
			<?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
				<dt style="border:none;"><a href='<?php echo U("Detail/index?id=$vo[id]");?>'><img src="/book/Public/images/Admin/Books/<?php echo ($vo["picname"]); ?>" width="110px" height="160px" alt="" style="border-radius: 0.5em 0.5em 1em / 0.5em 0.5em;"></a></dt>
					<dd>
						<p> style="height:38px;"<a href="#"><?php echo ($vo["bookname"]); ?></a></p>
						<p>价格：￥<?php echo ($vo["price"]); ?></p>
					</dd>
				</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
	<div class="jiaocai clearfix" id="item3">
		<h1>新书上线</h1>
		<div class="book clearfix" style="margin: 0 auto;width: 85%;">
			<?php if(is_array($new)): $i = 0; $__LIST__ = $new;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
					<dt style="border:none;"><a href='<?php echo U("Detail/index?id=$vo[id]");?>'><img src="/book/Public/images/Admin/Books/<?php echo ($vo["picname"]); ?>" width="110px" height="160px" alt=""></a></dt>
					<dd >
						<p style="height:38px;"><a href="#"><?php echo ($vo["bookname"]); ?></a></p>
						<p>价格：￥<?php echo ($vo["price"]); ?></p>
					</dd>
				</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
	<div class="jiaocai clearfix" id="item3">
		<h1>经典推荐</h1>
		<div class="book clearfix" style="margin: 0 auto;width: 85%;">
			<?php if(is_array($jindian)): $i = 0; $__LIST__ = $jindian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
					<dt style="border:none;"><a href='<?php echo U("Detail/index?id=$vo[id]");?>'><img src="/book/Public/images/Admin/Books/<?php echo ($vo["picname"]); ?>" width="110px" height="160px" alt=""></a></dt>
					<dd>
						<p style="height:38px;"><a href="#"><?php echo ($vo["bookname"]); ?></a></p>
						<p>价格：￥<?php echo ($vo["price"]); ?></p>
					</dd>
				</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>

<div class="clearfix" style="margin-top:30px;width:1000px;" id="item3">
		<center><h1>出版社</h1></center>
		<div class="fl" style="margin-top:10px;width:472px;border-top:1px solid #eaeaea;border-left:1px solid #eaeaea">
			<?php if(is_array($press)): $i = 0; $__LIST__ = $press;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="fl demo1" id="press" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["name"]); ?>">
				<img src="/book/Public/images/Admin/Press/<?php echo ($vo["picname"]); ?>" alt="" title="<?php echo ($vo["name"]); ?>" style="margin-top:15px;margin-left:20px" width="120px" height="45px" >
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="fl" style="margin-top:10px;width:514px;height:255px;border:1px solid #eaeaea;border-left:none">
			<p id="pressname" style="padding: 23px 0 17px 38px;font-size: 16px;color:#444;">理想国出版社</p>
			<span id="pressbook">
			<?php if(is_array($pressbook)): $i = 0; $__LIST__ = $pressbook;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="fl" style="width:110px;text-align: center;margin-left: 18px;margin-top:18px;">
				<a href="<?php echo U('Detail/index',array('id'=>$vo['id']));?>" target="_blank"><img src="/book/Public/images/Admin/Books/<?php echo ($vo["picname"]); ?>" width="86px" height="122px" style="border-radius: 0.5em 0.5em 1em / 0.5em 0.5em;" alt=""></a>
				<p style="display:block;height:30px;line-height:30px;"><a href="<?php echo U('Detail/index',array('id'=>$vo['id']));?>" target="_blank"><?php echo ($vo["bookname"]); ?></a></p>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</span>
		</div>
	</div>
	<script>
		$(document).ready(function(){
				$('.demo1').mouseover(
					function(){
						var pressid = $(this).attr('data-id');
						var pressname = $(this).attr('data-name');
						handle = setTimeout(function(){
							$.ajax({
								type:'get',
								url:"<?php echo U('Index/index');?>",
								data:'pressid='+pressid,
								success:function(data){
			                        var $data = $(data);
			                        var pressbook = $data.find("#pressbook");
			                        $('#pressbook').html(pressbook);
			                        $('#pressname').html(pressname);
								}
							})
							},100);
						}).mouseout(function(){
					clearTimeout(handle);
				});
				
			});
	</script>


	

</div>

<div class="foot">
	<div class="container">

		<div class="zhinan">
			<ul class="clearfix">
				<li class="item-li">购书指南
					<ul>
						<li><a href="#">支付宝担保安全！</a></li>
						<li><a href="#">如何退换货呢？</a></li>
						<li><a href="#">会员有哪些优惠？</a></li>
					</ul>
				</li>
				<li class="item-li">支付方式
					<ul>
						<li><a href="#">支付方式有哪些？</a></li>
						<li><a href="#">购书如何支付</a></li>
						<li><a href="#">支付步骤</a></li>
					</ul>
				</li>
				<li class="item-li">平台入驻
					<ul>
						<li><a href="#">机构专区</a></li>
						<li><a href="#">个人作者专区</a></li>
					</ul>
				</li>
				<li class="item-li" style="margin: 0">帮助信息
					<ul>
						<li><a href="#">购书说明</a></li>
						<li><a href="#">隐私安全</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="line"></div>

		<div class="bottom">
			<p><a href="#">如有问题欢迎联系投诉反馈</a></p>
			<p>©2016 Baidu 使用百度前必读   |  平台协议</p>
		</div>
	</div>
</div>
<div>
	<a href="#top" class="ftbottom">
		<span>回到顶部</span>
	</a>
	<a href="" class="pen">
		<span>意见反馈</span>
	</a>
</div>

</body>
</html>