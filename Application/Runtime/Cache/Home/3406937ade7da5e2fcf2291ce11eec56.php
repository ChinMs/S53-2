<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/book/Public/css/1.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/3.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/6.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/7.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/8.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/swiper3.07.min.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/public.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/index.css"/>
	<link rel="stylesheet" type="text/css" href="/book/Public/css/cart_page_46b0a5a.css"/>
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
    #hd {z-index: 0 !important;}
    #doc #hd {z-index: 0;}
    .read-hd {z-index: 0;}
</style>
<div class="bd-wrap">
    <div class="body" style="border: none">
    <?php if($list == null): ?><div class="empty-cart">
            <div class="empty-cart-icon"></div>
            <div class="empty-cart-title">您的购物车为空，赶紧行动吧</div>
            <a class="empty-cart-link" href="/" target="_blank">去阅读首页看看&gt;&gt;</a>
        </div><?php endif; ?>
    <?php if($list != null): ?><div id="cart-page-wrap" class="cart-page">
        <div class="cart-hd">
            <div class="cart-table-hd mb10 clearfix">
                <span class="th-item item-info">电子书信息</span>
                <span class="th-item item-price">电子书价格（元）</span>
                <span class="th-item item-op">操作</span>
            </div>
        </div>
        <div class="cart-bd">
            <ul class="book-list">
                <div class="mod books-group js-group-0" data-groupid="0">
                    <div class="hd group-hd"></div>
                    <div class="bd group-bd" id="box">
                    <?php if(is_array($list)): foreach($list as $key=>$vli): ?><li id="item" class="item-selected">
                            <div class="mod book-enable">
                                <div class="bd book-cnt-wrap">
                                    <!-- <input type="hidden" value="<?php echo ($vli["id"]); ?>"> -->
                                    <input type="checkbox" class="selected" name="cartCheckBox" value="<?php echo ($vli["id"]); ?>" style="margin-right: 10px;" onclick="selectSingle()" checked>
                                    <a class="book-cover-link" target="_blank" href="" title="<?php echo ($vli["bookname"]); ?>">
                                        <img class="book-cover" src="<?php echo ($vli["picname"]); ?>"> <!--图书的封面-->
                                    </a>
                                    <div class="book-title-wrap">
                                        <a target="_blank" class="book-title" href="<?php echo ($vli["bookid"]); ?>" title="<?php echo ($vli["bookname"]); ?>"><?php echo ($vli["bookname"]); ?></a>
                                        <span class="book-author">作者：<?php echo ($vli["author_name"]); ?></span>
                                    </div>
                                    <div class="box mod price-wrap" >
                                        <div class="media " value="<?php echo ($vli["price"]); ?>">
                                            <p class="book-price one-line">￥<b><?php echo ($vli["price"]); ?></b></p>
                                        </div>
                                    </div>
                                    <a class="disable-link" alog-action="delete.book" onclick="solodel(<?php echo ($vli["id"]); ?>)">删除</a>
                                </div>
                            </div>
                        </li> <!--li的结束--><?php endforeach; endif; ?>
                    </div>
                </div>
            </ul>
        </div>
        <div class="cart-ft">
            <div class="cart-ft-cnt box ext" style="z-index: auto; position: static; bottom: 0px; top: auto;">
                <div class="media">
                    <a class="go-cashier-btn">去支付</a>
                </div>
                <div class="content">
                    <div class="cnt-item select-all-book-wrap">
                        <input id="allCheckBox" type="checkbox" value="" onclick="selectAll()" checked />
                        <span class="ml5">全选</span>
                    </div>
                    <div class="cnt-item del-select-book-wrap">
                        <a class="del-select-book" onclick="delselected()">删除选中图书</a>
                    </div>
                    <div class="cnt-item selected-book-count-wrap">已选
                        <span class="rec-color js-selected-count">0</span>本电子书
                    </div>
                    <div class="cnt-item cart-ft-total-price">
                        <p class="rec-color mt5">合计:￥<span class="cart-ft-total-price-txt">0</span></p>
                    </div>
                </div>
            </div>
            <div class="spacer-fixed" style="display: none; width: 1090px; height: 54px; float: none;"></div>
        </div>
    </div> <!--id="cart-page-wrap"--><?php endif; ?>
    <div>
    <style>
        .ipts {border:none;outline:none;width:90%;color:#999;}
        .theme-signin li { padding-left:0; margin-bottom: 15px;}
        .rec-color {padding: 4px 6px;height: 21px;line-height: 21px;}
        .theme-signin li strong {width: 120px;margin-left: -120px;}
    </style>
    <div class="theme-popover3">
        <div class="theme-poptit3">
            <a href="javascript:;" title="关闭" class="close3">×</a>
            <h3>提交订单</h3>
        </div>
            <div class="theme-popbod dform" style="height: auto;">
            <form class="theme-signin" name="loginform" action="<?php echo U('Car/paying');?>" method="post" style="height: auto;">
                <ol>
                    <li>
                        <strong>所选书籍：</strong>
                        <div id="book" style="height: 60px;overflow-y: auto;overflow-x: hidden;">
                            
                        </div>
                    </li>
                    <li>
                        <strong>支付金额(￥/元)：</strong>
                        <input type="text" name="total" class="ipts" style="color:orange;font-size: 18px;" readonly/>
                    </li>
                    <li>
                        <strong>支付方式：</strong>
                        <img src="/book/Public/images/weixin.png" width="150" height="150" alt="微信支付" title="微信支付"/>
                        <img src="/book/Public/images/zhifu.png" width="150" height="150" alt="支付宝" title="支付宝支付"/>
                    </li>
                    <li>
                        <strong>实付金额(￥/元)：</strong>
                        <input type="text" name="money" class="ipts" style="color:red;font-size: 20px;" readonly/>
                    </li>
                    <li>
                        <input class="btn btn-primary" type="submit" name="submit" value=" 提 交 " />
                    </li>
                </ol>
           </form>
         </div>
    </div>
    <div class="theme-popover-mask3"  style="z-index: 9999998!important;"></div>
</div>
</div>
<script>
$(document).ready(function(){
   var a =  $('.book-title-wrap').find('.book-title');
   for (var i = 0; i <a.length; i++) {
       $('#book').append('<input type="hidden" name="id[]" value="'+$(a[i]).attr('href')+'" /><input class="ipts" type="text" name="bookname[]"  value="《'+$(a[i]).html()+'》" readonly /><input type="hidden" name="price[]" value="'+$(a[i]).parent().parent().find('b').html()+'" />');
   }
});

$(document).ready(function(){
    var total = 0;
    var ipts = $('input[name=cartCheckBox]');
    if($("input[type='checkbox']").is(':checked')){
        for(var i=0;i<ipts.length;i++){
            total = total + parseInt($(ipts[i]).parent().find('b').html());
        }
    }
    $('.cart-ft-total-price-txt').html(total);
    $('input[name=money]').val(total);
    $('input[name=total]').val(total);


    var len = $("input[type='checkbox']:checked").length - $("#allCheckBox:checked").length;

    $('.js-selected-count').html(len);
});
/*点击全选计算总价*/
$('#allCheckBox').click(function(){
        var total = 0;
        var ipts = $('input[name=cartCheckBox]');
        if($("input[type='checkbox']").is(':checked')){
            for(var i=0;i<ipts.length;i++){
                total = total + parseInt($(ipts[i]).parent().find('b').html());
            }
        }
        $('.cart-ft-total-price-txt').html(total);
});

/*每个点击计算总价格 选中就加，取消选中就减*/
$('.selected').click(function(){
    var sum = 0;
    var ipts = $('input[name=cartCheckBox]');
    for(var i=0;i<ipts.length;i++){
        if(ipts[i]['checked'] == true){
            sum = sum + parseInt($(ipts[i]).parent().find('b').html());
        }
    }
    $('.cart-ft-total-price-txt').html(sum);
    $('input[name=money]').val(sum);
    $('input[name=total]').val(sum);
});
/*删除单个内容*/
function solodel(id){
    $.post("<?php echo U('Car/solodel');?>", {soloid:id}, function(data){
        if (data) {
            window.location.reload();
        }
    });
}

/*删除选中的内容*/
function delselected(){
    var a = $('input[name=cartCheckBox]:checked');
    var arr = [];
    for (var i=0;i<a.length;i++) {
       var ai = a[i]['value'];
       arr.push(ai);
    }

    $.post("<?php echo U('Car/delgoods');?>", {param:arr}, function(data){
        if (data) {
            window.location.reload();
        }
    });
}

/*复选框全选或全不选效果*/
function selectAll(){
    var oInput=document.getElementsByName("cartCheckBox");
    for (var i=0;i<oInput.length;i++){
        oInput[i].checked=document.getElementById("allCheckBox").checked;
    }
}


/*根据单个复选框的选择情况确定全选复选框是否被选中*/
function selectSingle(){
    var k=0;
    var oInput=document.getElementsByName("cartCheckBox");
     for (var i=0;i<oInput.length;i++){
       if(oInput[i].checked==false){
          k=1;
          break;
        }
    }
    if(k==0){
        document.getElementById("allCheckBox").checked=true;
        }
    else{
        document.getElementById("allCheckBox").checked=false;
        }
}


$("input[type='checkbox']").bind("click",function(){
   var len = $("input[type='checkbox']:checked").length - $("#allCheckBox:checked").length;
   $('.js-selected-count').html(len);
}); 

$(document).ready(function($) {
    $('.go-cashier-btn').click(function(){
        $('.theme-popover-mask3').fadeIn(100);
        $('.theme-popover3').slideDown(200);
    });
    $('.theme-poptit3 .close3').click(function(){
        $('.theme-popover-mask3').fadeOut(100);
        $('.theme-popover3').slideUp(200);
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