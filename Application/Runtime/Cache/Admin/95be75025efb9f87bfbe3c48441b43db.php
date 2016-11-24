<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>网站信息</title>  
    <link rel="stylesheet" href="/book11-15/Public/css/pintuer.css">
    <link rel="stylesheet" href="/book11-15/Public/css/admin.css">
    <script src="/book11-15/Public/js/jquery.js"></script>
    <script src="/book11-15/Public/js/pintuer.js"></script>  
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder">评论内容</strong></div>
    <table class="table table-hover text-center" id="tablelist">
      <tr>
        <th width="10%">ID</th>
        <td><?php echo ($vo["id"]); ?></td>
      </tr>
      <tr>
        <th width="10%">标题</th>
        <td><?php echo ($vo["title"]); ?></td>
      </tr>
      <tr>
        <th width="10%">发布时间</th>
        <td><?php echo (date('Y-m-d H:i:s',$vo["time"])); ?></td>
      </tr>
      <tr>
        <th width="10%">书名</th>
        <td><?php echo ($vo["bookname"]); ?></td>
      </tr>
      <tr>
        <th width="10%" style="line-height:100px;">内容</th>
        <td height="100px"><?php echo ($vo["comment"]); ?></td>
      </tr>
      <tr>
        <th width="10%">用户名</th>
        <td><?php echo ($vo["username"]); ?></td>
      </tr>
      <tr>
        <th width="10%">状态</th>
          <td>
            <?php if($vo["state"] == 2): ?>隐藏</font>
            <?php else: ?>显示</font><?php endif; ?>
          </td>
      </tr>
      <tr>
        <th width="10%">点赞数</th>
        <td><?php echo ($vo["likenum"]); ?></td>
      </tr>
      <tr>
        <th width="10%">回复数</th>
        <td><?php echo ($vo["replynum"]); ?></td>
      </tr>
      <tr>
        <th width="10%">操作</th>
        <td><div class="button-group"> 

          <?php if($vo["state"] == 2): ?><a class="button border-main" href='<?php echo U("edit?id=$vo[id]");?>'><span class="icon-edit"></span>显示</a></font>
          <?php else: ?>
          <a class="button border-red" href='<?php echo U("edit?id=$vo[id]");?>'><span class="icon-edit"></span>隐藏</a></font><?php endif; ?>
        </div>
        </td>
      </tr>
        
      <tr>
        <td colspan="12"><div class="pagelist"><?php echo ($page); ?></div></td>
      </tr>
    </table>
</div>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>回复内容</strong></div>
    <table class="table table-hover text-center" id="tablelist">
      <tr>
        <th >ID</th>
        <th>发布时间</th>
        <th width="20%">内容</th>
        <th >用户名</th>
        <th >状态</th>
        <th>操作</th>
      </tr>
      <?php if(is_array($reply)): $i = 0; $__LIST__ = $reply;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><?php echo ($vo["id"]); ?></td>
          <td><?php echo (date('Y-m-d H:i:s',$vo["time"])); ?></td>
          <td width="10%"><?php echo ($vo["content"]); ?></td>
          <td><?php echo ($vo["username"]); ?></td>
          <td>
            <?php if($vo["state"] == 2): ?>隐藏</font>
            <?php else: ?>显示</font><?php endif; ?>
          </td>
          <td><div class="button-group"> 
            <a class="button border-green" href='<?php echo U("look?id=$vo[id]");?>'><span class="icon-edit"></span>详情</a></font>
            <?php if($vo["state"] == 2): ?><a class="button border-main" href='<?php echo U("editreply?id=$vo[id]");?>'><span class="icon-edit"></span>显示</a></font>
            <?php else: ?><a class="button border-red" href='<?php echo U("editreply?id=$vo[id]");?>'><span class="icon-edit"></span>隐藏</a></font><?php endif; ?>
          </div>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

    </table>
</div>
</body></html>