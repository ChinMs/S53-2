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
<li class="nav-right-li"><a href="<?php echo U('Mybook/bookshelf');?>" class="nav-right-mybook"><span class="nav-right-mybook-icon"></span>我的书架</a></li>
</ul>
</div>
</div>
<div class="read-hd-ad">

</div>

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

.arrow-up {
            width: 0px;
            height: 0px;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid gray;
            /*以下属性可以是IE5兼容*/
            font-size: 0px;
            line-height: 0px;
            position: absolute;
            display: none;
        }
    </style>
    <title><?php echo ($data["bookname"]); ?></title>
</head>
<body>

<div class="mian container">
<!--    <img src="images/notice.png" alt="" style="width: 1200px;height: auto;"/> -->

<div id="bd" class="bd">

<div class="bd-wrap">
<div class="body">

<div class="aside">

<div class="cms-block">
<div class="bd">
<a href="#" target="_blank" class="mb10">
<img src="/book11-15/Public/images/Home/1.jpeg" alt="" title="">
</a>
<a href="http://#" target="_blank" class="mb10">
<img src="/book11-15/Public/images/Home/2.jpg" alt="" title="">
</a>
<a href="#" target="_blank" class="mb10">
<img src="/book11-15/Public/images/Home/3.jpg" alt="" title="">
</a>
<a href="#" target="_blank" class="mb10">
<img src="/book11-15/Public/images/Home/4.jpg" alt="" title="">
</a>
</div>
</div>
</div>


<div class="main">

<div class="mod doc-info">

<div class="bd" style="position: relative;">
<div class="doc-info-bd clearfix"  style="position: relative;z-index:1;">
<div class="cover-block">
<div class="img-block mb20">
<a class="doc-info-imglink go-read-page" href="//yuedu.baidu.com/ebook/cc1d000c974bcf84b9d528ea81c758f5f61f2934?pn=1">

<img class="doc-info-img" src="/book11-15/Public/images/Admin/Books/<?php echo ($data["picname"]); ?>" width="200px" height="270px" style="border-radius: 0.5em 0.5em 1em / 0.5em 0.5em;" alt="" />
</a>
</div>
<div class="doc-op-wrap">
<div class="doc-op-hack">
<ul class="doc-op-content clearfix">
<li class="doc-op-item">
<?php if($data['bookstate'] == '0' ): ?><a href="javascript:void(0)" id="doc-save" class="doc-saved" title="收藏" alog-action="favo.book"><b class="ic icon-favo"></b></a>
<?php else: ?>
<a href="###" id="doc-save" class="" title="收藏" alog-action="favo.book" onclick="collection()"><b class="ic icon-favo"></b></a><?php endif; ?>
<span class="doc-operate-tip doc-operate-tip-save"></span>

</li>
<script>
    function collection(){
        $.ajax({
            type:'get',
            url:'<?php echo U('collection');?>',
            data:'bookid='+'<?php echo ($data["id"]); ?>',
            success:function(data){
             if(data=='alert("请先登录")')
            {
                eval(data);
            }else {
                $('#doc-save').attr('class','doc-saved');
                }
            }
        });
    }
</script>
<span class="split"></span>
<li class="doc-op-item">
<a href='<?php echo U("xiazai?id=$data[id]");?>' id="doc-dl-phone" class="js-publish-to-phone" title="下载到手机"><b class="ic icon-dl-phone"></b></a>
</li>
<span class="split"></span>
<li class="doc-op-item" id="fenx">
    <!-- 分享 -->
<a href="###" id="doc-share"><b class="ic icon-share"></b></a>
<div class="arrow-up"></div>
<div class=" bdshare-layer bdsharebuttonbox demo"  style=" display:none;">
    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
    <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
</div>
</li>

</ul>
<script>
url = window.location.href;
window._bd_share_config={
    "common":{
    "bdSnsKey":{},
    "bdText":"百度阅读,这是一本好书",
    bdUrl : url, 
    "bdMini":"2",
    "bdMiniList":false,
    "bdPic":"http://hiphotos.baidu.com/doc/abpic/item/241f95cad1c8a786b16741af6309c93d71cf50c5.jpg",
    "bdStyle":"2",
    "bdSize":"16"
},
    "share":{}
};
with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
</script>
<script>
    $('.demo').attr('visibility','visible');
    $('#fenx').mouseover(function(){
        $('.bdsharebuttonbox').show();
        $('.arrow-up').show();
    });
    $('#fenx').mouseout(function(){
        $('.bdsharebuttonbox').hide();
        $('.arrow-up').hide();

    });

</script>
</div>
</div>
</div>
<div class="content-block">
<h1 class="book-title" title="<?php echo ($data["bookname"]); ?>">
<?php echo ($data["bookname"]); ?>
&nbsp;&nbsp;<span class="ebook-tips">电子书</span>
</h1>
<span class="book-s-words"></span>
<div class="doc-info-score">
<?php if($data["count"] != 0): ?><a href="#comment" class="doc-info-score-num"><span class="c_doc-info-score-num"><?php echo ($data["count"]); ?></span>人评论</a>
    <span class="operator mv5">|</span><?php endif; ?>
<span class="doc-info-read-count"><?php echo ($data["people"]); ?>人在读</span>
</div>
<ul class="doc-info-org">
<li class="doc-info-field doc-info-author">
<span class="doc-info-label">作<span style="margin-left:12px">者：</span></span>
<a href="" class="doc-info-field-val doc-info-author-link"><?php echo ($data["author"]); ?></a>
</li>
<li class="doc-info-field ">
<span class="doc-info-label">出版社：</span>
<a class="doc-info-field-val" href=""><?php echo ($data["press"]); ?></a>
</li>
</ul>
<div class="doc-info-price">
<div class="doc-info-btn-wp doc-info-normal">
<div class="price-info">
<span class="confirm-price"><span class="prefix">价格：</span><span class="numeric">￥<?php echo ($data["price"]); ?></span></span>

</div>

<div class="btn-area">
<a href="###" class="yui-btn yui-btn-large yui-btn-large pay-btns mr10 " alog-action="buy.book">购买全本</a>
<a href='<?php echo U("look?id=$data[id]&&p=1&&chapternum=$chapternum");?>' class="go-read-page yui-btn yui-btn-large log-xsend" data-logxsend='[2, 200208, {"is_self_publishing": 0, "na_all_free":0}]' target="_blank" alog-action="try.read">开始阅读</a>
<a href="###" id="doc-add-cart" class="add-to-cart " data-doc_id="cc1d000c974bcf84b9d528ea81c758f5f61f2934">
<span class="ic ic-cart"></span>
<span class="txt">加入购物车</span>
<span class="doc-operate-tip doc-operate-tip-cart"></span>
</a>
</div>

</div>


</div>
</div>
</div>
</div>
</div>

<div class="roll-text-wrap">
<span class="arr-icon"></span>
<span class="arr-icon2"></span>
<div class="roll-text-list">
<a class="roll-item" href="" target="_blank">
<span class="roll-icon right"></span>
<div class="roll-area">
<ul class="roll-text-area prev">
<li class="roll-title">正版全本无错字</li>
<li class="roll-txt">
<?php echo ($data["wordnum"]); ?>个字，<?php echo ($data["chapternum"]); ?>个章节</li>
</ul>
<ul class="roll-text-area next">
<li class="roll-title" style="margin-top:18px;">出版社直接授权版权资源</li>
<li class="roll-txt">全本无乱码、无错字</li>
</ul>
</div>
</a>
<a class="roll-item" href="" target="_blank">
<span class="roll-icon experience"></span>
<div class="roll-area">
<ul class="roll-text-area prev">
<li class="roll-title">舒适不累的阅读体验</li>
<li class="roll-txt">随时做书摘笔记</li>
</ul>
<ul class="roll-text-area next">
<li class="roll-title" style="margin-top:18px;">全书图文精排</li>
<li class="roll-txt">多种阅读模式切换</li>
</ul>
</div>
</a>
<a class="roll-item" href="" target="_blank">
<span class="roll-icon note"></span>
<div class="roll-area">
<ul class="roll-text-area prev">
<li class="roll-title">多个设备同步阅读</li>
<li class="roll-txt">已支持电脑、手机、iPad等设备</li>
</ul>
<ul class="roll-text-area next">
<li class="roll-title" style="margin-top:18px;">让好书现身所有设备</li>
<li class="roll-txt">无需设置自动同步</li>
</ul>
</div>
</a>
</div>
</div>
<div class="mod book-select">

<div class="hd select-title clearfix" id="hahaha">
<a href="#desp" class="select-item mr5" data-fix="desp" style="margin-left: 0;"><span class="select-item-border"></span>简介</a>
<a href="#dir" class="select-item mr5" data-fix="dir"><span class="select-item-border"></span>目录</a>
<a href="#comment" class="select-item" data-fix="comment"><span class="select-item-border"></span>评论&nbsp;<?php if($data["count"] != 0): ?><span style="color:#999;">(<?php echo ($data["count"]); ?>)</span><?php endif; ?></a>
</div>
<script>
$(function(){
    var navH = $("#hahaha").offset().top;
    $(window).scroll(function(){
        var scroH = $(this).scrollTop();
        if(scroH>=navH){
            $("#hahaha").css({"position":"fixed","top":0});
        }else if(scroH<navH){
            $("#hahaha").css({"position":"static"});
        }
    })
});
</script>
<div class="select-title-placeholder"></div>
</div>
<div class="mod book-des book-intro-block" id="book-des">

<a name="desp" class="anchor anchor1" id="desp">&nbsp;</a>
<div class="new-title">
<span class="title-icon"></span>
<a href="" id="info"></a>
<span class="title-txt">图书简介</span>
</div>
<div class="bd scaling-content-wp">
<div class="scaling-content" style="height:120px;">
<p>
<?php echo ($data["descr"]); ?>
</p>
</div>
<p class="scaling-more-btn">
<a href="###" class="expand"><span class="text"></span><span class="ic"></span></a>
</p>
</div>
</div>
<p id="token" style="display: none;">b609e57fb16592b01471821337993031</p>
<div class="mod book-intro-block mb20">

<div class="new-title book-info-title">
<span class="title-icon"></span>
<span class="title-txt">基本信息</span>
</div>
<div class="bd">
<ul class="book-information clearfix">
<li>
<span class="book-information-tip">作<span class="ml28">者：</span></span>
<a href="" ><?php echo ($data["author"]); ?></a>
</li>
<li>
<span class="book-information-tip">出<span class="ml7">版</span><span class="ml7">社：</span></span>
<?php echo ($data["press"]); ?>
</li>
<li>
<span class="book-information-tip">纸书定价：</span></span>
<?php echo ($data["price"]); ?>元</li>
<li class="book-information-classic book-information-tip">
<span class="classic-type">分<span class="ml28">类：</span></span>
<div class="crumbs-wp">
<div id="page-curmbs" class="crumbs ui-crumbs">
<ul alog-group="general.curmbs" class="clearfix">
<li><a href="/book/list/6" class="logSend" data-logsend='{"send":["general","crumb2"]}'><?php echo ($data["ftype"]); ?></a></li>
<li class="current logSend"><a href="/book/list/6031" data-logsend='{"send":["general","crumb3"]}'><?php echo ($data["type"]); ?></a></li>
</ul>
</div>
</div>
</li>
</ul>
</div>
</div>
</div><!--mian-->

<div class="mod doc-catalog mb20"> <!--目录部分-->
<a name="dir" class="anchor anchor1" id="dir">&nbsp;</a>
<div class="new-title">
<span class="title-txt">目录（共<?php echo ($data["chapternum"]); ?>章）</span>
</div>
<div class="bd scaling-content-wp">
<div class="cata-content scaling-content" id="cata-content" style="height: auto;">
<ul id="catalog-list" alog-action="catalog.click">
    <?php if(is_array($zj)): $k = 0; $__LIST__ = $zj;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="level1"><a class="catalog-item" href='<?php echo U("look?id=$data[id]&&p=$k&&chapternum=$chapternum");?>' title="<?php echo ($vo); ?>" page="1-1" target="_self" ><span class="catalog-title"><?php echo ($vo); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

</div>
<p class="scaling-more-btn" id="catalog-btn" style="display: block;">
<a href="javascript:void(0)" class="expand" ><span class="text" id="a1" ></span><span class="ic"></span></a>
</p>
</div>
</div><!--目录部分-->
<script>
    function test(){
        if ($('#a1').attr('class')!='text on') {
            $('#catalog-list').children().eq(9).nextAll().hide();
            $('#a1').parent().attr('class','expand');
            $('#a1').html('查看全部');
        }else{
            $('#catalog-list').children().eq(9).nextAll().slideDown('normal');
        }
    }
    test();
        $('#a1').click(function(){
            $(this).toggleClass('on');
            $(this).html('收起');
            $(this).parent().attr('class','close');
            test();
        });
</script>
<div class="mod book-score">

<a name="comment" class="anchor" id="comment">&nbsp;</a>
<div class="score-area-title">
<span class="title-txt">图书评论</span>
</div>

</div>
<?php if($data["commentnum"] != 0): ?><div class="mod merge-comment mb20">

<div class="hd">
<ul class="comment-tab-control clearfix">
<span class="comment-title-text">共有<?php echo ($data["commentnum"]); ?>条评论</span>
<span class="sort-list">
<a href="" class="sort-by" data-index="1">最热排序</a>
<a href="" class="sort-by current" data-index="0">最新排序</a>
</span>
</ul>
</div>
<div class="bd">
<ul class="comment-tab-content">
<li class="comment-tab-content-item current merge-comment-content">
<div class="comment-content c_comment-content">
    
    
        <ul class="comment-list">
            <?php if(is_array($comment)): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="comment-list-item ">
                    <div class="comment-pic-wrap">
                        <div class="img-down-wp">
                            <?php if(($vo["picname"] == null)): ?><img class="img-down" src="/book11-15/Public/images/Home/head0.png">
                            <?php else: ?><img class="img-down" src="/book11-15/Public/images/user_img/<?php echo ($vo["picname"]); ?>"><?php endif; ?>
                            <span class="author-circle"></span>
                            
                        </div>
                        
                        
                        
                    </div>
                    
                    <div class="comment-info clearfix no-margin-top">
                        <span class="comment-author" title="百度用户">
                            <?php echo ($vo["username"]); ?>
                                <span class="comment-author-paied"></span>
                        </span>
                        
                        <span class="comment-score">标题:</span>
                        <span class="comment-scorenum"><?php echo ($vo["title"]); ?></span>
                        
                        <span class="comment-date"><?php echo (date("Y-m-d H:i",$vo["time"])); ?></span>
                        <span class="comment-from">来自百度阅读</span>
                        
                    </div>
                    <p class="comment-short">
                        <?php echo ($vo["comment"]); ?>
                        
                    </p>
<!--                     <p class="comment-all">
                        边看边哭！感人！好看！一个通宵搞定
                        <a href="http://yuedu.baidu.com/ebook/d94178b9b9f3f90f76c61ba8?fr=bookrank###" class="comment-close j_comment-close">收起<span class="comment-close-icon"></span></a>
                    </p> -->
                    <div class="comment-ft">
                        
                            <?php if($vo["user_id"] == $_SESSION['user_id']): ?><a href='<?php echo U("Detail/deldiscuss?discuss_id=$vo[id]");?>'  style="position: relative;top: -1px;font-size: 12px;">删除</a><?php endif; ?>
                            &nbsp;
                            <a href="javascript:;" class="btn-reply " data-status="closed" data-id="649941" data-uname="百度用户"><span class="reply-change" data-name="<?php echo ($vo["username"]); ?>">回复</span><span style="position: relative;top: -1px;font-size: 12px;">(<?php echo ($vo["replynum"]); ?>)</span>
                            
                            </a>
                        
                            <!--点赞-->
                            <?php if($vo["likestate"] == null): ?><a href="javascript:;"  class="comment-like j_comment-like demo" data-id="<?php echo ($data["id"]); ?>" data-discuss="<?php echo ($vo["id"]); ?>">
                            <?php else: ?>
                            <a href="javascript:;"  class="comment-like j_comment-like liked" ><?php endif; ?>
                                <span class="like-icon"></span>
                                <span class="like-numarea">
                                <span class="like-num"><?php echo ($vo["likenum"]); ?></span>
                                </span>
                                
                            </a>
                            <span class="comment-like-error">已提交</span>
                        
                    </div>
                    
                                
                            <div class="reply-comment-wrap" >
                            <span class="comment-up-icon"></span>
                            <span class="comment-up-icon2"></span>
                        <?php if(is_array($vo['reply'])): $i = 0; $__LIST__ = $vo['reply'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="reply-content">
                            
                            
                            <div class="reply-items">
                                    <div class="reply-pic-wrap">
                                        <div class="img-down-wp">
                                            <?php if($v["picname"] == null): ?><img class="img-down" src="/book11-15/Public/images/Home/head0.png">
                                            <?php else: ?>
                                            <img class="img-down" src="/book11-15/Public/images/user_img/<?php echo ($v["picname"]); ?>"><?php endif; ?>
                                                    <span class="author-circle"></span>
                                                
                                            </div>
                                            <span class="img-up"></span>
                                            
                                        </div>
                                        <p class="reply-title">
                                            <span class="comment-author" title="<?php echo ($v["username"]); ?>" data-id="655489">
                                                <?php echo ($v["username"]); ?>
                                                
                                            </span>
                                            
                                            
                                            <span class="reply-date"><?php echo (date('Y-m-d H:i:s',$v["replytime"])); ?></span>
                                        </p>

                                        <p class="reply-content-txt">
                                            <?php echo ($v["content"]); ?>
                                        </p>
                                        <div class="reply-ft">
                                            <span class="time"></span>
                                            <?php if($v["user_id"] == $_SESSION['user_id']): ?><a href='<?php echo U("Detail/delreply?reply_id=$v[id]&discuss_id=$vo[id]");?>' class="delete-reply" data-id="655489">删除</a>
                                            <?php else: ?> <a href="javascript:;" class="btn-subreply" data-id="655489" data-name="<?php echo ($v["username"]); ?>">回复</a><?php endif; ?>
                                        </div>
                                        <div class="reply-split"></div>
                                    </div>
                          
                                </div> <!--回复区域--><?php endforeach; endif; else: echo "" ;endif; ?>
                            <?php if($vo['reply'] != null): ?><div class="reply-textarea">

                                </div><?php endif; ?>
                                <div class="reply-textarea">
                                    <form action="<?php echo U('Detail/reply');?>" method="post" >
                                    <!-- <span class="reply-to-name"></span> -->
                                    <input type="hidden" name="discuss_id" value="<?php echo ($vo["id"]); ?>">
                                    <input type="hidden"  name="book_id" value="<?php echo ($data["id"]); ?>">
                                    <input type="text" name="content"  class="inputarea" maxlength="1000" value="" placeholder=""/>
                                    <a href="javascript:void(0)" class="do-reply-btn"  data-replyid="">回复</a>
                                    </form>
                                </div>
                                
                            </div>
                    
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    
</div>

</li>
<li class="comment-tab-content-item other-comment-content">
<div class="comment-content c_comment-content"></div>
<div class="comment-pager c_comment-pager"></div>
</li>
</ul>
</div>
</div>
<?php else: ?>
<div style="width:100%;height:100px;">
    <span style="display:block;width:100px;height:50px;margin:0 auto;font-size:20px;color:#ccc;margin-top:20px;">暂无评论</span>
</div><?php endif; ?>
</div>

<!-- 评论表单区域 -->
<div class="mod comment mb20">

<a name="write-comment" class="anchor anchor1" id="write-comment">&nbsp;</a>
<div class="hd">
</div>
<div class="bd">
<div class="uncomment"> <!--评论后隐藏-->
<div class="user-icon-wp">
<div class="user-icon">
<div class="user-icon-mask"></div>
<img src="<?php if($plimg == null): ?>/book11-15/Public/images/Home/head0.png
    <?php else: ?>/book11-15/Public/images/user_img/<?php echo ($plimg); endif; ?>" alt="" class="user-icon-pic">
<span class="author-circle"></span>
</div>
</div>
<div class="comment-sub ">
<form action="<?php echo U('comment');?>" id="first" method="post">
    <input type="hidden" name="book_id" value="<?php echo ($data["id"]); ?>">
<div class="clearfix comment-sub-wp">
<span>标题</span>
<input type="text" id="title" name="title" class="comment-title-sub " placeholder="选填" maxlength="30">
</div>
<div class="clearfix comment-sub-wp">
<span>正文</span>
<textarea name="comment" id="pl" class="comment-content-sub " placeholder="必填，不少于5个字"></textarea>
</div>
</form>
<div class="comment-vcode-wrap clearfix">
<span class="comment-vcode-label">验证码</span>
<input type="text" id="yzm" class="comment-vcode-input" maxlength="4">
<img src="<?php echo U('Detail/yzm');?>" title="点击更换新的验证码" alt="" class="comment-vcode-img js-comment-vcode-img" id="yz_img"><span class="comment-vcode-change">看不清，换一张</span></div>
</div>
<div class="comment-sub-btn-wp">
<a href="javascript:void(0)" onclick="submit()" class="comment-sub-btn j_comment-sub-btn ">
<b class="btc">
<b class="btText btText-normal" >发表评论</b>
<b class="btText btText-loading"><span class="loading-icon"></span>发表中</b>
</b>
</a><a href="<?php echo U('Login/login');?>" class="not-login-tips" style="display:none">登录后可评论</a>
<span class="comment-sub-error c_comment-sub-error"></span>
</div>
</div>
<div class="commented" style="display:none">您已经评论过了</div>
</div>
</div>

</div>

<script>
    var yz_img = $('#yz_img');
    var src_img = yz_img.attr('src');
    yz_img.click(function(){
        $(this).attr('src', src_img+'?yzm='+Math.random());
        // console.log($(this).attr('src'));
    })

    function submit(){
        var yzm1 = $('#yzm').val();
        var pl = $('#pl').val();
        if (pl==''){
            $('.comment-sub-error').html('请填写正文');
             return; 
        }else if(pl.length<5){
            $('.comment-sub-error').html('正文必须大于5个字');
            return;
        };

        $.ajax({
                type:'get',
                url:'<?php echo U('Detail/getYzm');?>',
                data:"yzm1="+yzm1,
                async: false,
                success:function(data){
                    if(!data){
                        $('.comment-sub-error').html('验证码错误,请输入正确的验证码');
                    }
                    else{
                         $('.comment-sub-error').html('');
                         $('.btText-normal').hide();
                         $('.btText-loading').show();
                         function test(){
                            $("#first").trigger("submit");
                         }
                         setTimeout(test,1500);
                    }
                },
            })
    }


    var user_name = '<?php echo ($user_name); ?>';
    if(user_name == ''){
        $('#pl').attr('disabled',true);
        $('#title').attr('disabled',true);
        // $('.inputarea').attr('disabled',true);
        $(".j_comment-sub-btn").removeAttr("onclick");
        $(".j_comment-sub-btn").css('background','#ABDDA9');
        $(".j_comment-sub-btn").css('cursor','default');
        $('.comment-vcode-wrap').hide();
        $('.not-login-tips').show();
    }
    
    if('<?php echo ($data["commentstate"]); ?>'){
        $('.uncomment').hide();
        $('.commented').show();
    }

    $('.reply-change').click(function(){
        var name = $(this).attr('data-name');
        $('.inputarea').attr('placeholder','回复:'+name);
        $(this).toggleClass('on');
        var a = $(this).parent().parent().parent();
        a.children(".reply-comment-wrap").show();
        if($(this).attr('class')=='reply-change on'){
            a.children(".reply-comment-wrap").show();
            $(this).html('收起回复');
        } else{
            a.children(".reply-comment-wrap").hide();
            $(this).html('回复');
        }
    })


    $('.do-reply-btn').click(function reply()
    {   
        if(user_name == ''){
            alert('请登录');
            return;
        }
        $(this).parent().trigger("submit");
    })

    $('.btn-subreply').click(function(){
        var name = $(this).attr('data-name');
        $('.inputarea').attr('placeholder','回复:'+name);
    })


    // 点赞
    $('.demo').click(function(){
        if(user_name == ''){
            alert('请登录');
            return;
        }
        var book_id = $(this).attr('data-id');
        var discuss_id = $(this).attr('data-discuss');
        // console.log(discuss_id);return;
        var user_id = "<?php echo ($_SESSION['user_id']); ?>";
       var  state = '';
        $.ajax({
            type:'post',
            url:'<?php echo U("Detail/like");?>',
            async:false,
            data:"book_id="+book_id+'&user_id='+user_id+'&discuss_id='+discuss_id,
            success:function(data){
                // console.log(data);
                state = true;
                $('.like-num').html(data);
            }
        });

        if(state){
            $(this).addClass('liked');
            $(this).unbind("click");

        }

    });

</script>
</div>
</div>


	

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