<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>网站信息</title>  
    <link rel="stylesheet" href="/book/Public/css/pintuer.css">
    <link rel="stylesheet" href="/book/Public/css/admin.css">
    <link rel="stylesheet" href="/book/Public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/book/Public/my.css">
    <script src="/book/Public/js/jquery.js"></script>
    <script src="/book/Public/js/pintuer.js"></script>  
    <style>
        td{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="panel admin-panel">
    <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> <?php echo ($title); ?></strong></div>
    <div class="container">
        <table class="table table-hover mt20 table-bordered table-hover" id="tablelist">
            <tr>
                <th>Id</th>
                <th>用户名</th>
                <th>IP</th>
                <th>所在地</th>
                <th>时间</th>
                <th>浏览器</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($data)): foreach($data as $key=>$val): ?><tr>
                <td><?php echo ($val["id"]); ?></td>
                <td><?php echo ($val["username"]); ?></td>
                <td><?php echo ($val["ip"]); ?></td>
                <td><?php echo ($val["city"]); ?></td>
                <td><?php echo (date('Y-m-d ',$val["time"])); ?></td>
                <td><?php echo ($val["browser"]); ?></td>
                <td><a href='<?php echo U("del?id=$val[id]");?>' class="btn btn-danger">删除</a></td>
            </tr><?php endforeach; endif; ?>
              <tr>
                <td colspan="8"><div class="pagelist"><?php echo ($page); ?></div></td>
              </tr>
        </table>
    </div>
</div>
<script>
        function user(page){
        var p = page;
        $.ajax({
            type:'get',
            url:'<?php echo U('Logs/index');?>',
            data:"p="+p,
            success:function(data){
                var $data = $(data);
                var target_div = $data.find("#tablelist");
                $('#tablelist').html(target_div);
            },
        })
    }
</script>
<script src="/book/Public/js/jquery.min.js"></script>
<script src="/book/Public/js/bootstrap.min.js"></script>
</body>
</html>