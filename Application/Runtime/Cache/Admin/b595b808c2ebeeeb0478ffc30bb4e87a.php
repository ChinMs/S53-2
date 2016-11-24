<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title><?php echo ($title); ?></title>  
    <link rel="stylesheet" type="text/css" href="/book/Public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/book/Public/css/pintuer.css">
    <link rel="stylesheet" href="/book/Public/css/admin.css">
    <script src="/book/Public/js/jquery.js"></script>   
    <script src="/book/Public/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
  <div class="logo margin-big-left fadein-top">
    <h1><img src="/book/Public/images/Admin/Admin/<?php echo ($_SESSION['picname']); ?>" class="radius-circle rotate-hover" height="50" alt="" />管理员:<?php echo ($_SESSION['username']); ?></h1>
  </div>
  <div class="head-l"><a class="button button-little bg-green" href="" target="_blank"><span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp;<a href="<?php echo U('Index/clear');?>" class="button button-little bg-blue"><span class="icon-wrench"></span> 清除缓存</a> &nbsp;&nbsp;<a class="button button-little bg-red" href="<?php echo U('Login/login');?>"><span class="icon-power-off"></span> 退出登录</a> </div>
</div>
<div class="leftnav" style="overflow-y: auto;overflow-x: hidden;">
  <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
  <ul style="display:block">
    <li>
      <h2><span class="icon-user"></span>前台用户管理</h2>
      <ul>
        <li><a href="<?php echo U('User/index');?>" target="right"><span class="icon-caret-right"></span>用户列表</a></li>
      </ul>
    </li>
    <li>
      <h2><span class="icon-user-3"></span>后台用户管理</h2>
      <ul>
        <li><a href="<?php echo U('Admin/index');?>" target="right"><span class="icon-caret-right"></span>后台用户列表</a></li>
        <!-- <li><a href="javascript:void(0)" target="right"><span class="icon-caret-right"></span>用户添加</a></li> -->
      </ul>
    </li>  
    <li>
      <h2><span class="glyphicon glyphicon-pencil"></span>修改个人资料</h2>
      <ul>
        <li><a href="<?php echo U('Admin/pass');?>" target="right"><span class="icon-caret-right"></span>修改密码</a></li>
        <li><a href="<?php echo U('Admin/info');?>" target="right"><span class="icon-caret-right"></span>修改个人信息</a></li>
      </ul>
    </li>
    <li>
      <h2><span class="icon-pencil-square-o"></span>角色管理</h2>
      <ul>
        <li><a href="<?php echo U('Role/index');?>" target="right"><span class="icon-caret-right"></span>角色管理</a></li>
       <li><a href="<?php echo U('Role/add');?>" target="right"><span class="icon-caret-right"></span>角色添加</a></li>
      </ul>
    </li>

  <li>
      <h2><span class="icon-pencil-square-o"></span>节点管理</h2>
      <ul>
        <li><a href="<?php echo U('Node/index');?>" target="right"><span class="icon-caret-right"></span>节点管理</a></li>
       <li><a href="<?php echo U('Node/add');?>" target="right"><span class="icon-caret-right"></span>节点添加</a></li>
      </ul>
    </li>

    <li>
      <h2><span class="icon-pencil-square-o"></span>分类管理</h2>
      <ul>
        <li><a href="<?php echo U('Types/index');?>" target="right"><span class="icon-caret-right"></span>分类列表</a></li>
        <li><a href="<?php echo U('Types/tree');?>" target="right"><span class="icon-caret-right"></span>分类树形图</a></li>
      </ul>
    </li>   
    <li>
      <h2><span class="icon-pencil-square-o"></span>作者管理</h2>
      <ul>
        <li><a href="<?php echo U('Author/index');?>" target="right"><span class="icon-caret-right"></span>作者列表</a></li>
        <li><a href="<?php echo U('Author/add');?>" target="right"><span class="icon-caret-right"></span>作者添加</a></li>
      </ul>
    </li>   
    <li>
      <h2><span class="icon-pencil-square-o"></span>书籍管理</h2>
    <ul>
      <li><a href="<?php echo U('Books/index');?>" target="right"><span class="icon-caret-right"></span>书籍列表</a></li>
      <li><a href="<?php echo U('Books/add');?>" target="right"><span class="icon-caret-right"></span>书籍添加</a></li>
    </ul></li>  
<li>
      <h2><span class="icon-pencil-square-o"></span>积分管理</h2>
    <ul>
      <li><a href="<?php echo U('Integ/index');?>" target="right"><span class="icon-caret-right"></span>积分管理</a></li>
    </ul></li>  
    
 <li><h2><span class="icon-pencil-square-o"></span>出版社管理</h2>
    <ul>
      <li><a href="<?php echo U('Press/index');?>" target="right"><span class="icon-caret-right"></span>出版社列表</a></li>
      <li><a href="<?php echo U('Press/add');?>" target="right"><span class="icon-caret-right"></span>出版社添加</a></li>
    </ul></li>   

    <li>
      <h2><span class="icon-pencil-square-o"></span>订单管理</h2>
      <ul>
        <li><a href="<?php echo U('Orders/index');?>" target="right"><span class="icon-caret-right"></span>订单列表</a></li>
      </ul>
    </li> 
    <li>
      <h2><span class="icon-pencil-square-o"></span>评论管理</h2>
      <ul>
        <li><a href="<?php echo U('Discuss/index');?>" target="right"><span class="icon-caret-right"></span>评论列表</a></li>
      </ul>
    </li>     
    <li>
      <h2><span class="icon-pencil-square-o"></span>活动链接管理</h2>
      <ul>
        <li><a href="<?php echo U('Actlink/index');?>" target="right"><span class="icon-caret-right"></span>活动链接列表</a></li>
        <li><a href="<?php echo U('Actlink/add');?>" target="right"><span class="icon-caret-right"></span>添加活动链接</a></li>
      </ul>
    </li>     
    <li>
      <h2><span class="icon-pencil-square-o"></span>日志管理</h2>
      <ul>
        <li><a href="<?php echo U('Logs/index');?>" target="right"><span class="icon-caret-right"></span>日志列表</a></li>
      </ul>
    </li>     
    <li>
    <h2><span class="icon-google-drive"></span>回收站管理</h2>
      <ul>
        <li><a href="<?php echo U('Recovery/index');?>" target="right"><span class="icon-caret-right"></span>回收站列表</a></li>
      </ul>
    </li>
  </ul>   
<!--   <h2><span class="icon-pencil-square-o"></span>栏目管理</h2>
  <ul>
    <li><a href="list.html" target="right"><span class="icon-caret-right"></span>内容管理</a></li>
    <li><a href="add.html" target="right"><span class="icon-caret-right"></span>添加内容</a></li>
    <li><a href="cate.html" target="right"><span class="icon-caret-right"></span>分类管理</a></li>        
  </ul>  --> 
</div>
<script type="text/javascript">
$(function(){
  $(".leftnav h2").click(function(){
    var a = $(document).find('h2');
    for(var i=0;i<a.size();i++){
        $(a[i]).next().slideUp(200);
    }
      if($(this).attr('class')== 'on'){
          $(this).removeClass("on");
        }else{
          for(var i =0;i<a.size();i++){
            $(a[i]).removeClass("on");
          }
          $(this).next().slideToggle(200);  
          $(this).addClass("on");
        }

  })
  $(".leftnav ul li a").click(function(){
      $("#a_leader_txt").text($(this).text());
      $(".leftnav ul li a").removeClass("on");
    $(this).addClass("on");
  })
});
</script>
<ul class="bread">
  <li><a href="{:U('Index/info')}" target="right" class="icon-home"> 首页</a></li>
  <li><a href="##" id="a_leader_txt">网站信息</a></li>
  <li><b>当前语言：</b><span style="color:red;">中文</php></span>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;切换语言：<a href="##">中文</a> &nbsp;&nbsp;<a href="##">英文</a> </li>
</ul>
<div class="admin">
  <iframe scrolling="auto" rameborder="0" src="info.html" name="right" width="100%" height="100%"></iframe>
</div>
<div style="text-align:center;">
<!-- <p>来源:<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p> -->
</div>
</body>
</html>