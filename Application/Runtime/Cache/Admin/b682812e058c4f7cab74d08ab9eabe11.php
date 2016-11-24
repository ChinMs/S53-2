<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="/book11-15/Public/css/pintuer.css">
    <link rel="stylesheet" href="/book11-15/Public/css/admin.css">
    <link rel="stylesheet" href="/book11-15/Public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/book11-15/Public/my.css">
    <script src="/book11-15/Public/js/jquery.js"></script>
    <script src="/book11-15/Public/js/pintuer.js"></script>  
</head>
<body>
    <div class="panel-head"><strong><?php echo ($title); ?></strong>
   <form action="<?php echo U('Admin/page');?>" method="get">
<div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <li> <a class="button border-main icon-plus-square-o" href="add.html" data-toggle="modal" data-target="#myModal"> 添加内容</a> </li>
        <li>搜索：</li>
        <li>
          <input type="text" placeholder="请输入用户名" name="username" class="input" style="width:250px; line-height:17px;display:inline-block" />
          <button class="button border-main icon-search" type="submit" > 搜索</button></li>
      </ul>
    
   </form>
    </div> 
    
       
        <table class="table table-hover mt20 table-bordered table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>用户名</th>
                <th>性别</th>
                <th>手机号</th>
                <th>邮箱</th>
                <th>等级</th>
                <th>添加时间</th>
                <th>登录时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo ($vo["username"]); ?></td>
                <td><?php if($vo["sex"] == '0'): ?>女
                    <?php elseif($vo["sex"] == '1' ): ?>男
                    <?php else: ?>保密<?php endif; ?></td>
                <td><?php echo ($vo["phone"]); ?></td>
                <td><?php echo ($vo["email"]); ?></td>
                <td><?php if($vo["level"] == '0'): ?>超级管理员
                    <?php else: ?>技术人员<?php endif; ?></td>
                <td><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
                <td><?php echo (date('Y-m-d H:i:s',$vo["logtime"])); ?></td>
                <td><?php if($vo["state"] == 1): ?>启用
                    <?php else: ?>禁用<?php endif; ?></td>
                <td><a href="<?php echo U('Admin/edit',array('id'=>$vo['id']));?>" class="btn btn-primary">修改</a>
                    <a href="<?php echo U('Admin/del',array('id'=>$vo['id']));?>" class="btn btn-danger">删除</a>
                    <a href="<?php echo U('Admin/rolelist',array('id'=>$vo['id']));?>" class="btn btn-danger">分配角色</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        </table>
    
    </div>
</div>



    <div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">添加用户</h4>
      </div>
      <div class="modal-body">
        <table class="table">
            <div class="form-group">
            <form action="<?php echo U('Admin/insert');?>" method="post">
                <tr>
                    <th>用户名:</th>
                <td><input type="text" class="form-control" aria-describedby="sizing-addon1" name="username" placeholder="5-50个字符"></td>
                </tr>
                <tr>
                    <th>密码:</th>
                <td><input type="password" class="form-control" aria-describedby="sizing-addon1" name="password" placeholder="8-32个字符"></td>
                </tr>
                <tr>
                    <th>邮箱地址:</th>
                <td><input type="email" class="form-control" aria-describedby="sizing-addon1" name="email" placeholder="输入邮箱地址"></td>
                </tr>
                <tr>
                    <th>性别:</th>
                    <td>
                        <input type="radio" name="sex" value="1">男
                        <input type="radio" name="sex" value="0" checked>女
                        <input type="radio" name="sex" value="2" >保密</td>
                </tr>
                <tr>
                    <th>电话号码:</th>

                <td><input type="text" class="form-control" aria-describedby="sizing-addon1"  name="phone" placeholder="输入电话号码"></td>
                </tr>
                <tr>
                    <td >
                        <img class="margin-left" width="152" height="100" title='看不清楚?换一张' src="<?php echo U('Public/verify');?>" name='verifyImg' onclick="this.src='<?php echo U('Public/verify');?>'">
                    </td>
                    <td>
                        <input type="text" class="form-control" aria-describedby="sizing-addon1" name="code">
                    </td>
                </tr>
            </div>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">添加</button>
          </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <script src="/book11-15/Public/js/jquery.min.js"></script>
    <script src="/book11-15/Public/js/bootstrap.min.js"></script>
</body>
</html>