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
</head>
<body>
<form method="get" action="<?php echo U('search');?>" id="listform">
<div class="panel admin-panel">
    <div class="panel-head"><input type="text" placeholder="请输入用户名" name="username" class="input" style="width:250px; line-height:17px;display:inline-block" />
          <button class="button border-main icon-search" type="submit" > 搜索</button></div>
    <div class="container" style="    width: 1050px;">
        <table class="table table-hover mt20 table-bordered table-hover">
            <tr>
                <th>Id</th>
                <th>用户名</th>
                <th>真实姓名</th>
                <th>密码</th>
                <th>性别</th>
                <th>手机号</th>
                <th>邮箱</th>
                <th>状态</th>
                <th>注册时间</th>
                <th>用户头像</th>
                <th>积分</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo ($vo["username"]); ?></td>
                <td><?php echo ($vo["name"]); ?></td>
                <td><?php echo ($vo["password"]); ?></td>
                <td><?php if($vo["sex"] == '0'): ?>女
                    <?php elseif($vo["sex"] == '1' ): ?>男
                    <?php else: ?>保密<?php endif; ?></td>
                <td><?php echo ($vo["phone"]); ?></td>
                <td><?php echo ($vo["email"]); ?></td>
                <td><?php if($vo["state"] == '0'): ?>禁用
                    <?php else: ?>启用<?php endif; ?></td>
                <td><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
                <td> 
                    <?php if($data['picname'] == '' ): ?><img src="/book/Public/images/Home/User/head0.png"  width="50" height="50" alt="">
                    <?php else: ?><img src="/book/Public/images/user_img/<?php echo ($data["picname"]); ?>"  width="50" height="50" alt=""><?php endif; ?>
                </td>
                <td><?php echo ($vo["integ"]); ?></td>
                <td><div class="button-group"> <a class="button border-main" href='<?php echo U("edit?id=$vo[id]");?>'><span class="icon-edit"></span> 修改</a> <a class="button border-red" href='<?php echo U("del?id=$vo[id]");?>' ><span class="icon-trash-o"></span> 删除</a> </div></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr>
                <td colspan="12"><div class="pagelist"><?php echo ($page); ?></div></td>
            </tr>
        </table>
    </div>
</div>
</form>
<script src="/book/Public/js/jquery.min.js"></script>
<script src="/book/Public/js/bootstrap.min.js"></script>
<script type="text/javascript">


    function user(page){
        var p = page;
        $.ajax({
            type:'get',
            url:'<?php echo U('User/index');?>',
            data:"p="+p,
            success:function(data){
                var $data = $(data);
                var target_div = $data.find("#tablelist");
                $('#tablelist').html(target_div);
            },
        })
    }
//搜索
function changesearch(){    
        
}

</script>
</body>
</html>