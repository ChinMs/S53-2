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
<body>

	<h1>
		节点管理
		<small>
			<i class="icon-double-angle-right"></i>
			 节点列表
		</small>
	</h1>



	<center>
		<table width=90% cellpadding="5" cellspacing="3">
			<tr align='left' bgcolor="#ccc">
				<th>ID</th>
				<th>节点名称</th>
				<th>模块名（控制器）</th>
				<th>操作</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php echo ($vo["name"]); ?></td>
					<td><?php echo ($vo["mname"]); ?></td>
					<td><?php echo ($vo["aname"]); ?></td>
					<td><?php if($vo["status"] == 1): ?>启用<?php else: ?>禁用<?php endif; ?></td>
					<td>
						<a href="<?php echo U('Node/del',array('id'=>$vo['id']));?>">删除</a>
						<a href="<?php echo U('Node/edit',array('id'=>$vo['id']));?>">修改</a>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			
		</table>
	</center>