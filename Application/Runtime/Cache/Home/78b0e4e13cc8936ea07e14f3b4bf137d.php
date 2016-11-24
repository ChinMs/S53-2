<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/book11-15/Public/css/1.css"/>
	<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/3.css"/>
	<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/6.css"/>
	<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/7.css"/>
	<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/8.css"/>
	<link rel="stylesheet" href="/book11-15/Public/css/swiper3.07.min.css"/>
	<link rel="stylesheet" href="/book11-15/Public/css/public.css"/>
	<link rel="stylesheet" href="/book11-15/Public/css/index.css"/>
	<script src="/book11-15/Public/js/jquery-1.11.2.min.js"></script>
	<script src="/book11-15/Public/js/myfocus-2.0.1.min.js"></script>
	<script src="/book11-15/Public/js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="/book11-15/Public/3.css"/>
	<link rel="stylesheet" type="text/css" href="/book11-15/Public/8.css"/>	
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

	<title><?php echo ($title); ?></title>
</head>
<body>
<div class="top" id="item4">
	<div class="container clearfix">
		<ul class="clearfix fr">
			<input type="hidden" value="<?php echo ($_SESSION['url'] = $_SERVER['REQUEST_URI']); ?>">
			<?php if($user_name == null): ?><li><a href="<?php echo U('Login/login');?>">登录</a></li>
				<li><a href="<?php echo U('Reg/reg');?>">注册</a></li>
			<?php else: ?>
				<li><a href="<?php echo Mybook/index;?>"><?php echo ($user_name); ?></a></li>
				<li><a href="<?php echo U('Login/logout');?>">退出</a></li><?php endif; ?>
			<li><a href="<?php echo U('Index/shoppingcart');?>">购物车</a></li>
			<li><a href="#">意见反馈</a></li>
			<li><a href="" style="border: none">消息</a></li>
		</ul>
	</div>
</div>

<div class="header">
	<div class="container clearfix">
		<div style="width:1090px;height:92px;margin:auto;">
		<div class="logo fl">
			<a href="#"><img src="/book11-15/Public/images/Home/baidu.png" alt=""/></a>
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
			<img src="/book11-15/Public/images/Home/11.jpg" alt="">
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
<li class="nav-right-li"><a href="<?php echo U('Mybook/mybook');?>" class="nav-right-mybook"><span class="nav-right-mybook-icon"></span>我的书架</a></li>
</ul>
</div>
</div>
<div class="read-hd-ad">

</div>

    <style>
        #box{
            width: 70%;
            background: #FAF7ED ;
            font-size: 18px;
            line-height: 2;
            margin: 0px auto;
            padding: 20px;
            font-family: 微软雅黑, "Microsoft YaHei";
        }
        a{
            font-size: 18px;
        }
    </style>
        <div style="margin:auto;width:90%;background:#EDE8D5">
            <pre id="aa">
            <div id="box">
<?php echo ($data); ?> 
        <p style="text-align: center;height: 60px;">            
<a href='#aa' onclick="zj('sub')">上一章</a>       <a href='#aa' onclick="zj('add')">下一章</a>
        </p>
            </div>    
            </pre>
        </div>
        <script>
            var page = <?php echo ($page); ?>;
            var id = <?php echo ($id); ?>;
            var p = page;
            var url = window.location.href; 
            url.indexOf("chapternum/");
            strs = url.split("chapternum/"); 
            strs = strs[1].split(".html"); 
            var chapternum = Number(strs[0]);
            function zj(state){
                if (state=='add') {
                    p +=1 ;
                } else{
                    p -= 1;
                }
                if(p==0) {p = 1;return;}
                if(p>chapternum) {p=chapternum;return;}
                $.ajax({
                    type:'get',
                    url:'<?php echo U('Detail/look');?>',
                    data:'id='+id+'&&p='+p,
                    success:function(data){
                        var $data = $(data);
                        var word = $data.find("#box");
                        $('#box').html(word);
                    },
                })
            }
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