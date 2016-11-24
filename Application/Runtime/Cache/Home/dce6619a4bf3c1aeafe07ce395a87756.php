<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html class="cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=1280">

<title>我的图书_百度阅读</title>

<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/css_core_31a0946.css"/>
<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/pkg_ydcommon_base_78541af.css"/>
<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/drop_ax_722c12d.css"/>
<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/pkg_ydcommon_yui_0c10806.css"/>
<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/cashier_c907a59.css"/>
<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/top_reco_bb02634.css"/>
<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/myBook_7edfe30.css"/>
<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/read_uc_layout_5ad92f6.css"/>
<link rel="stylesheet" type="text/css" href="/book11-15/Public/css/lanrenzhijia.css"/>
<script src="/book11-15/Public/js/jquery.min.js"></script>
<script src="/book11-15/Public/js/jquery.cookie.js"></script>
<style type="text/css">
    body, input {
        font-family: '微软雅黑';
    }
    .drop-ax.dropped .drop-ax-countdown{
        color:#173d6a;
    }
    .drop-ax.dropping .drop-ax-countdown{
        color:#d6433c;
    }
    .drop-ax.dropped .drop-ax-countdown-day{
        left:754px;
    }
    .drop-ax.dropped .drop-ax-countdown-hour{
        left:830px;
    }
    .drop-ax.dropped .drop-ax-countdown-minute{
        left:905px;
    }
    .drop-ax {
       z-index:1!important;
   }
    #search {
        position: relative;
    }
    .autocomplete {
        border: 1px solid #999;
        background-color: white;
        text-align: left;
        border-top:0px;
        z-index:1!important;
    }
    .autocomplete li{
        list-style: none;
        width: 370px;
        height: 35px;
        line-height: 35px;
        border-bottom: 1px solid #EBEBEB;
    }
    .clickable {
        cursor: default;
    }
    .highlight {
        background-color: #EBEBEB;
    }
    .infoline {
        width: 100%;
        margin-bottom: 20px;
    }
    .infomation {
        font-size: 14px;
        padding-right: 10px;
    }
    .infomation + span {
        font-size: 15px;
    }
</style>
<script type="text/javascript">
    $(function(){
        //取得div层
        var $search = $('#search');
        // 取得隐藏的id
        var $searchid = $('#s-pbook');
        //取得输入框JQuery对象
        var $searchInput = $search.find('#s-word-1');
        //关闭浏览器提供给输入框的自动完成
        $searchInput.attr('autocomplete','off');
        //创建自动完成的下拉列表，用于显示服务器返回的数据,插入在搜索按钮的后面，等显示的时候再调整位置
        var $autocomplete = $('<div class="autocomplete"></div>').hide().insertAfter('.s-submit');
        //清空下拉列表的内容并且隐藏下拉列表区
        var clear = function(){
            $autocomplete.empty().hide();
        };
        //注册事件，当输入框失去焦点的时候清空下拉列表并隐藏
        $searchInput.blur(function(){
        setTimeout(clear,500);
        });
        //下拉列表中高亮的项目的索引，当显示下拉列表项的时候，移动鼠标或者键盘的上下键就会移动高亮的项目，想百度搜索那样
        var selectedItem = null;
        //timeout的ID
        var timeoutid = null;
        //设置下拉项的高亮背景
        var setSelectedItem = function(item){
        //更新索引变量
        selectedItem = item ;
        //按上下键是循环显示的，小于0就置成最大的值，大于最大值就置成0
        if(selectedItem < 0){
        selectedItem = $autocomplete.find('li').length - 1;
        }
        else if(selectedItem > $autocomplete.find('li').length-1 ) {
        selectedItem = 0;
        }
        //首先移除其他列表项的高亮背景，然后再高亮当前索引的背景
        $autocomplete.find('li').removeClass('highlight').eq(selectedItem).addClass('highlight');
        };
        var ajax_request = function(){
        //ajax
        
        $.post("<?php echo U('Mybook/search');?>", {param1: $searchInput.val()}, function(data){
            if(data) {
            console.log(data);
            //遍历data，添加到自动完成区
            $.each(data, function(index,term) {
                //创建li标签,添加到下拉列表中
                $('<li></li>').text(term).appendTo($autocomplete).addClass('clickable').hover(function(){
                //下拉列表每一项的事件，鼠标移进去的操作
                $(this).siblings().removeClass('highlight');
                $(this).addClass('highlight');
                selectedItem = index;
                },function(){
                //下拉列表每一项的事件，鼠标离开的操作
                $(this).removeClass('highlight');
                //当鼠标离开时索引置-1，当作标记
                selectedItem = -1;
                }).click(function(){
                //鼠标单击下拉列表的这一项的话，就将这一项的值添加到输入框中
                $searchInput.val(term);
                $searchid.val(selectedItem);
                //清空并隐藏下拉列表
                $autocomplete.empty().hide();
                });
            });//事件注册完毕

            //设置下拉列表的位置，然后显示下拉列表
            var ypos = $searchInput.position().top;
            var xpos = $searchInput.position().left;
            $autocomplete.css('width','370px');
            $autocomplete.css({'position':'absolute','left':xpos + "px"});
            setSelectedItem(0);
            //显示下拉列表
            $autocomplete.show();
            }
        });

        };
        //对输入框进行事件注册
        $searchInput.keyup(function(event) {
        //字母数字，退格，空格
        if(event.keyCode > 40 || event.keyCode == 8 || event.keyCode ==32) {
        //首先删除下拉列表中的信息
        clearTimeout(timeoutid);
        $autocomplete.empty().hide();
        timeoutid = setTimeout(ajax_request,100);
        }
        else if(event.keyCode == 38){
        //上
        //selectedItem = -1 代表鼠标离开
        if(selectedItem == -1){
        setSelectedItem($autocomplete.find('li').length-1);
        }
        else {
        //索引减1
        setSelectedItem(selectedItem - 1);
        }
        event.preventDefault();
        }
        else if(event.keyCode == 40) {
        //下
        //selectedItem = -1 代表鼠标离开
        if(selectedItem == -1){
        setSelectedItem(0);
        }
        else {
        //索引加1
        setSelectedItem(selectedItem + 1);
        }
        event.preventDefault();
        }
        }).keypress(function(event){
        //enter键
        if(event.keyCode == 13) {
        //列表为空或者鼠标离开导致当前没有索引值
            if($autocomplete.find('li').length == 0 || selectedItem == -1) {
                return false;
            }
                $searchInput.val($autocomplete.find('li').eq(selectedItem).text());
                $searchid.val(selectedItem);
                $autocomplete.empty().hide();
                event.preventDefault();
            }
        }).keydown(function(event){
            //esc键
            if(event.keyCode == 27 ) {
            $autocomplete.empty().hide();
            event.preventDefault();
            }
        });
        //注册窗口大小改变的事件，重新调整下拉列表的位置
        $(window).resize(function() {
            var ypos = $searchInput.position().top;
            var xpos = $searchInput.position().left;
            $autocomplete.css('width',$searchInput.css('width'));
            $autocomplete.css({'position':'absoulte','left':xpos + "px",'top':ypos +"px"});
            });
        });
</script>
</head>
<body>
<div id="doc" class="page">
    <div id="hd" class="hd hd-wrap ">
    <div class="drop-ax-container"></div>
    <div class="read-hd read-hd-bottom">
            <div class="read-searchbox-wp">
                <div class="read-searchbox-inner wrap-page-width">
                    <a href="/" class="read-logo" title="百度阅读"></a>
                    <div id="search" class="read-searchbox">
                            <form name="search" class="search" action="<?php echo U('Mybook/searchBook');?>" method="post">
                                 <input type="text" name="s-word-1" class="s-word" maxlength="256" tabindex="1" value="" autocomplete="off" id="s-word-1"/>
                                  <span class="s-placeholder" style="display:none;">在数十万册图书中搜索</span>
                                  <input type="hidden" name="id" id="s-pbook" class="s-pbook">
                                  <input type="submit" class="s-submit" value="搜索图书" />
                            </form>
                        <div class="hot-search-list">
                            <a href="" target="_blank" class="hot-search mr10">龙应台</a>
                            <a href="" target="_blank" class="hot-search mr10">南有乔木</a>
                            <a href="" target="_blank" class="hot-search mr10">后宫如懿传</a>
                            <a href="" target="_blank" class="hot-search mr10">法医秦明</a>
                            <a href="" target="_blank" class="hot-search mr10">如若有你，一生何求</a>
                        </div>
                    </div>
                    <div class="read-userbar-wp">
                        <ul class="read-userbar clearfix read-user-logined">
                            <li class="ub-li ub-li-mybook">
                                <span class="ub-border"></span>
                                <a target="_blank"  href="" class="ub-item ub-item-mybook j_ub-drop-toggle">
                                    <span class="ub-txt">阳光的钱家大少</span>
                                    <span class="arr"></span>
                                </a>
                                <ul class="ub-drop j_ub-drop">
                                    <li><a target="_blank" href="">我的订单</a></li>
                                    <li class="line"><a target="_blank" href="">账号设置</a></li>
                                    <li class="exit line"><a href="">退出</a></li>
                                </ul>
                            </li>
                            <li class="ub-li ub-li-cart">
                                <span class="ub-border"></span>
                                <a target="_blank" class="ub-item ub-cart" href="<?php echo U('Car/car');?>">
                                    <span class="ub-txt">购物车</span>
                                </a>
                            </li>
                            <li class="ub-li ub-li-message">
                                <a href="/ydmessage/browse/msgcenter" class="ub-item ub-item-message" id="js-ub-msg">
                                <span class="ub-message-icon"></span>
                                <span class="ub-txt">消息</span>
                                <span class="ub-message-num"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
            </div>
      </div>
      <div class="read-nav-wp">
            <div class="read-nav-inner wrap-page-width">
                <ul class="read-nav clearfix">
                    <li class="nav-li-index">
                        <a class="nav-index" href="">
                            <span>首页</span>
                        </a>
                        <span class="nav-border"></span>
                    </li>
                    <li class="nav-li-category">
                        <a class="nav-category" href="">
                            <span>分类</span>
                        </a>
                        <span class="nav-border"></span>
                    </li>
                    <li class="nav-li-rank">
                        <a class="nav-rank" href="">
                            <span>榜单</span>
                        </a>
                        <span class="nav-border"></span>
                    </li>
                    <li class="nav-li-org">
                        <a class="nav-org" href="">
                            <span>机构专区</span>
                        </a>
                        <span class="nav-border"></span>
                    </li>
                </ul>
                <ul class="read-nav-right clearfix">
                    <li class="nav-right-li">
                        <a href="<?php echo U('Mybook/bookShelf',array('id'=>'1'));?>" class="nav-right-mybook">
                        <span class="nav-right-mybook-icon"></span>
                            我的书架
                        </a>
                    </li>
                </ul>
            </div>
      </div>
          <div class="read-hd-ad">
          </div>
    </div>
    </div>
    <div id="bd" class="bd">
    
    <div class="bd-wrap">
      <div class="body">
        <div class="aside">
          <div class="user-card">
                <a href="<?php echo U('infoSelf', array('id'=>'1'));?>">
                    <?php if($picname == ''): ?><img class="user-avatar" src="/book11-15/Public/images/x.jpg" alt="阳光的钱家大少">
                        <?php else: ?>
                        <img class="user-avatar" src="/book11-15/Public/images/user_img/<?php echo ($picname); ?>" alt="阳光的钱家大少"><?php endif; ?>
                </a>
                <div class="user-info">
                  <a href="<?php echo U('infoSelf', array('id'=>'1'));?>" class="user-uname">阳光的钱家大少</a>
                </div>
            </div>
            <ul class="uc-nav">
                <li><a class="current" href="">我的图书</a></li>
                <li><a class="" href="">我的订单</a></li>
                <li><a class="" href="">我的积分</a></li>
            </ul>
        </div>
        <div class="main">
        
          <div class="right-main-container" data-csrf_sign="1310557914">
            <div class="books-title-select">
              <div class="books-part-btns">
                <div class="one-part-btn bg-hide" id="all">
                  <a href="<?php echo U('bookShelf', array('id'=>'1'));?>">全部(<?php echo ($count); ?>)</a>
                </div>
                <div class="one-part-btn bg-hide" id="payed">
                  <a href="<?php echo U('purchased', array('id'=>'1'));?>">已购买(<?php echo ($purchased); ?>)</a>
                </div>
                <div class="one-part-btn bg-hide" id="collect">
                  <a href="<?php echo U('collected', array('id'=>'1'));?>">已收藏(<?php echo ($collected); ?>)</a>
                </div>
              </div>
            </div>
            
    <div class="books-container"><!--这里是添加收藏的图书的-->
              <?php if($books == null): ?><div class="no-item-bg">
                    <a target="_blank" href=""><div class="select-book-btn"></div></a>
                </div><?php endif; ?>
                <?php if(is_array($books)): foreach($books as $key=>$v): ?><div class="one-book-item" <?php if($v == null): ?>style="display:none"<?php endif; ?>>
                    <div class="cover-img-container ">
                        <a title="<?php echo ($v["bookname"]); ?>" target="_blank" href=""><img class="book-cover" width="142" height="190" src="/book11-15/Public/images/Admin/Books/<?php echo ($v["picname"]); ?>"></a>
                    </div>
                    <span class="book-name">
                        <a title="<?php echo ($v["bookname"]); ?>" target="_blank" href=""><?php echo ($v["bookname"]); ?></a>
                    </span>
                    <span class="book-copr">
                    </span>
                    <span class="book-state">
                        <?php if($v["state"] == '1'): ?>已购买的<?php endif; ?>
                    </span>
                    <a class="del-book-btn" title="删除" href="<?php echo U('Mybook/delShelf',array('book_id'=>$v['id'],'user_id'=>'1'));?>"><img class="book-dele-icon" src="/book11-15/Public/images/delbook.png"></a>
                </div><?php endforeach; endif; ?>
            </div><!--books-container-->
            <div id="page">
                <?php echo ($page); ?>
            </div>

          </div><!--right-main-container-->
        
        </div><!--main-->
      </div><!--body-->
    </div><!--bd-wrap-->
    
    <div id="ft">
      <div class="help-wp clearfix">
        <div class="footer-pub wrap1090 clearfix">
          <a href="http://yuedu.baidu.com/promotion/activity/brand#block1" class="footer-pub-item" target="_blank" style="margin-left: 122px;"><span class="footer-pub-icon-1"></span>正版电子书</a>
          <a href="http://yuedu.baidu.com/promotion/activity/brand#block2" class="footer-pub-item" target="_blank"><span class="footer-pub-icon-2"></span>多平台畅读</a>
          <a href="http://yuedu.baidu.com/promotion/activity/brand#block3" class="footer-pub-item" target="_blank" style="display: none;"><span class="footer-pub-icon-3"></span>全网最低价</a>
          <a href="http://yuedu.baidu.com/promotion/activity/brand#block5" class="footer-pub-item" target="_blank"><span class="footer-pub-icon-4"></span>海量图书资源</a>
          <a href="http://yuedu.baidu.com/promotion/activity/brand#block4" class="footer-pub-item" target="_blank" style="margin-right:0;"><span class="footer-pub-icon-5"></span>优质阅读体验</a>
        </div>
        <div class="help wrap1090">
          <ul class="clearfix">
            <li class="help-blk">
              <h4>帮助</h4>
              <a href="http://yuedu.baidu.com/customer/yueduhelp?nav=2_1" target="_blank">如何购买图书</a>
              <a href="http://yuedu.baidu.com/customer/yueduhelp?nav=2_3" target="_blank">常见问题</a>
              <a href="http://yuedu.baidu.com/customer/yueduhelp?nav=2_2" target="_blank">支付方式</a>
            </li>
            <li class="help-blk">
              <h4>平台入驻</h4>
              <a href="http://yuedu.baidu.com/partner/index?fr=footer" target="_blank">机构专区</a>
              <a href="//yuedu.baidu.com/partner/browse/advertisepartner?fr=footer#block1" target="_blank">个人作者专区</a>
            </li>
            <li class="help-blk">
              <h4>投诉与建议</h4>
              <a class="help-blk-feedback" href="http://tieba.baidu.com/p/4471901647?share=9105&fr=share" target="_blank">问题反馈</a>
            </li>
            <li class="help-blk help-blk-qr">
              <h4>扫描下载客户端</h4>
              <span class="help-qr-icon"></span>
            </li>
          </ul>
        </div>
      </div>
      <div class="footer">
        <p class="contact" style="font-size:14px;">
          如有问题欢迎联系<a class="footer-contact-feedback" href="http://tieba.baidu.com/p/4471901647?share=9105&fr=share" target="_blank">投诉反馈</a>
        </p>
        <p>
          <span class="cr">&copy;2016&nbsp;Baidu</span>&nbsp;<a href="http://www.baidu.com/duty/" class="Bidu" target="_blank">使用百度前必读</a>
          &nbsp;&nbsp;<span class="line">|</span>&nbsp;&nbsp;<a class="xieyi" target="_blank" href="http://yuedu.baidu.com/customer/yueduhelp?nav=4">平台协议</a>
        </p>
      </div>
    </div>
    </div>
    <div class="side-bar-wp">
    </div>
    <script>
        $(document).ready(function(){
            $('.ub-li-mybook').mouseover(
                function(){
                    $('.ub-drop').show();
                }
            );
            $('.ub-li-mybook').mouseout(
                function(){
                    $('.ub-drop').hide();
                });
            $('.s-placeholder').css('display','block');
            $('.s-placeholder').mousedown(function(){
                $('.s-placeholder').css('display','none');
                $('.s-word')[0].focus();
            });
            $('.s-placeholder').mouseup(function(){
                $('.s-word').focus();
            });
            $('.s-word').focus(function(){
                $('.s-placeholder').css('display','none');
            });
            $('.s-word').focusout(function(){
                // $('.s-placeholder').css('display','block');
                if ($('.s-word').val() == '') {
                    $('.s-placeholder').css('display','block');
                } else {
                    $('.s-placeholder').css('display','none');
                }
            });
        });
    </script>
</body>
</html>