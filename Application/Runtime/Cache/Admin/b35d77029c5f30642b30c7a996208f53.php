<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="/book/Public/css/pintuer.css">
    <link rel="stylesheet" href="/book/Public/css/admin.css">
    <link rel="stylesheet" href="/book/Public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/book/Public/my.css">
    <script src="/book/Public/js/jquery.js"></script>
    <script src="/book/Public/js/pintuer.js"></script>  
</head>


	<h1>
		角色管理
		<small>
			<i class="icon-double-angle-right"></i>
			 角色列表
		</small>
	</h1>



		<table class="table">
			<tr align='left' bgcolor="#ccc">
				<th>ID</th>
				<th>角色名</th>
				<th>说明</th>
				<th>状态</th>
				<th>拥有权限</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php echo ($vo["name"]); ?></td>
					<td><?php echo ($vo["remark"]); ?></td>
					<td><?php if($vo["status"] == 1): ?>启用<?php else: ?>禁用<?php endif; ?></td>
					<td width=200>
						<!-- <?php if(is_array($vo["node"])): $i = 0; $__LIST__ = $vo["node"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i; echo ($va); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?> -->
					</td>
					<td>
						<a href="<?php echo U('Role/del',array('id'=>$vo['id']));?>">删除</a>
						<a href="<?php echo U('Role/edit',array('id'=>$vo['id']));?>">修改</a>
						<a href="<?php echo U('Role/nodelist',array('id'=>$vo['id']));?>">分配权限</a>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>