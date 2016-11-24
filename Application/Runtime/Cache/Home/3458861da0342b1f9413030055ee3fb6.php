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


	<style>
		#product-type>li:hover{
			border:none;
		}
		#product-type li a{
			display:block;width:220px;height:40px;padding-left:20px;color:#333;font-size:14px;
		}
		#product-type>li>a:hover{
			background-color:#34495E;
			color:#fff;
			text-decoration: none;
		}
		#typep{
			margin: 1% 0 0 2%;
			font-size: 14px;
		}
		#typep a{
			font-size: 14px;
			text-decoration: none;
		}
		#h2:hover{
			text-decoration: none;
		}
	.pages a,.pages span {
	    display:inline-block;
	    padding:2px 5px;
	    margin:0 1px;
	    border:1px solid #f0f0f0;
	    /*-webkit-border-radius:3px;*/
	    /*-moz-border-radius:3px;*/
	    /*border-radius:3px;*/
	}
	.pages a,.pages li {
	    display:inline-block;
	    list-style: none;
	    text-decoration:none; color:#5A5F7A;
	}
	.pages a.first,.pages a.prev,.pages a.next,.pages a.end{
	    margin:0;
	}
	.pages a:hover{
	    border-color:#ccc;
	}
	.pages span.current{
	    /*background:#00AAEE;*/
	    color:black;
	    font-weight:700;
	    border:none;
	    font-size: 13px;
	    border-color:black;
	}
	</style>
<div style="margin-top:30px;background-color:#FDFDFB;width:100%">
<div class="container clearfix" style="width:1200px;">
	<div class="row clearfix" >
		<?php echo ($typename); ?>
		<div class="col-md-3 list fl" style="width:250px;">
			<?php if(($status == 1) OR ($status == 2)): ?><input type="hidden" value="<?php echo ($hiddenid); ?>" id="hiddenid" /><?php endif; ?>
			<input type="hidden" value="<?php echo ($hiddencondition); ?>" id="hiddencondition" />
			<a id="h2" href="<?php echo U('Product/index');?>"><h2 style="font-size:14px;background-color:#34495E;color:white;height:50px;line-height:50px;width:240px;margin-left:-0px;" id="allcate">全部分类图书<i class="fa fa-sort-down"></i></h2></a>
			<div id="catecontent">
				<?php if(($state != 1) AND ($state != 2)): ?><ul class="one" id="product-type">
						<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="float:left;width:240px;text-align:left;background-color: rgb(245, 244, 242); border-color: rgb(237, 237, 237);">
								<a href='<?php echo U("Product/product?typeid=$vo[id]");?>' ><?php echo ($vo["name"]); ?><b class="ic ic-arrow" style="background:url(/book/Public/images/Home/get_1457fb0.png) no-repeat;float:right;margin-top:13px;margin-right:13px;"></b> </a><!--一级分类-->
								<ul class="two" style="z-index:360;">
									<?php if(is_array($vo[child])): $i = 0; $__LIST__ = $vo[child];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li style="width:120px;float:left;padding-left:20px;color:#333"><a href='<?php echo U("Product/product?typeid=$val[id]");?>'><?php echo ($val["name"]); ?></a></li><!--二级分类--><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<?php else: ?>
					<ul id="son-cate">					
						<p style="display:block;width:240px;height:40px;line-height:40px;font-size:14px;text-align:left;color:#666;background-color:#EBECED;margin:0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($ftypename); ?></p>
						<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="display:block;width:240px;height:40px;background-color:#f5f4f2;line-height:40px;text-align:left;margin:0px;">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="<?php echo U('Product/product',array('typeid'=>$vo['id']));?>" style="font-size:14px;color:#666;<?php if(($state == 2) AND ($vo["id"] == $typeid)): ?>font-weight:700;<?php endif; ?>">
									<?php echo ($vo["name"]); ?>
								</a>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endif; ?>
			</div>
			<img src="/book/Public/images/Home/1.jpeg" width="245px" alt="" style="margin-top:20px;">
			<img src="/book/Public/images/Home/2.jpg" width="245px" alt="" style="margin-top:10px;">
			<img src="/book/Public/images/Home/3.jpg" width="245px" alt="" style="margin-top:10px;">
			<img src="/book/Public/images/Home/4.jpg" width="245px" alt="" style="margin-top:10px;">
		</div>
		<div class="book fr" style="height:auto;" id="tablelist">
			<p id="typep"><a href="<?php echo U('Index/index');?>">百度阅读</a> ＞ <a href="<?php echo U('Product/index');?>">全部图书</a> <?php if($state == 1): ?>＞ <?php echo ($ftypename); elseif($state == 2): ?>＞ <a href="<?php echo U('Product/cate',array('id'=>$ptypeid));?>"><?php echo ($ftypename); ?></a> ＞ <?php echo ($sonname); else: endif; ?></p>
			<span style="background-color:#F5F5F2;width:97%;height:40px;margin:2% 0 0 1%;display:block;">
				<ul class="paixu" >
					<li><a href='<?php echo U($url,array("condition"=>"click","typeid"=>"$typeid"));?>'>热度&nbsp;<img src="/book/Public/images/Home/down-hei.png" width="10px" alt="" /></a></li>
					<li><a href='<?php echo U($url,array("condition"=>"addtime","typeid"=>"$typeid"));?>'>最新&nbsp;<img src="/book/Public/images/Home/down-hui.png" width="10px" alt="" /></a></li>
					<li><a href='<?php echo U($url,array("condition"=>"self","typeid"=>"$typeid"));?>'>销量&nbsp;<img src="/book/Public/images/Home/down-hui.png" width="10px" alt="" /></a></li>
					<li><a href='<?php echo U($url,array("condition"=>"price","typeid"=>"$typeid"));?>'>价格&nbsp;<img src="/book/Public/images/Home/down-hui.png" width="10px" alt="" /></a></li>
				</ul>
			</span>
			<?php if(is_array($book)): $i = 0; $__LIST__ = $book;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
				<dt style="border:none;width:140px;"><a href='<?php echo U("Detail/index?id=$vo[id]");?>' target="_blank"><img src="/book/Public/images/Admin/Books/<?php echo ($vo["picname"]); ?>" alt="" width="134" height="179"/></a></dt>
				<dd>
					<p style="height:38px;"><a href='<?php echo U("Detail/index?id=$vo[id]");?>'><?php echo ($vo["bookname"]); ?></a></p>
					<p>&nbsp;</p>
					<p><span style="color:#666;float:left;line-height:21px;margin-left:10px;"><?php echo ($vo["name"]); ?></span><span style="float:right;line-height:21px;"><?php echo ($vo["price"]); ?></span></p>
				</dd>
				
			</dl><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="pages clearfix" value="" id="pages" style="float:left;width:100%;text-align:center;margin-top:20px;"><?php echo ($page); ?></div>
		</div>
	</div>
</div>
</div>
<script>
        var condition = '<?php echo ($condition); ?>';
        if(condition == 'price')
        var typeid = '<?php echo ($typeid); ?>';
	    function user(page){
        var p = page;
        $.ajax({
            type:'get',
            url:'<?php echo U('Product/index');?>',
            data:"p="+p+"&condition="+condition+"&typeid="+typeid,
            success:function(data){
                var $data = $(data);
                var target_div = $data.find("#tablelist");
                console.log(condition);
                $('#tablelist').html(target_div);
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