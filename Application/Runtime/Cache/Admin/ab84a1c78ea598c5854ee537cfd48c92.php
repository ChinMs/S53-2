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
			 角色添加
		</small>
	</h1>




	<div class="row">
		<div class="col-md-12">
			<form action="<?php echo U('Role/doadd');?>" method='post' class="form-horizontal">

				<div class="form-group" style="">
					<label for="" class="col-sm-2 control-label">角色名：</label>
					<div class="col-sm-4">
						<input type="text" name="name" class="form-control" placeholder="角色名">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">说明：</label>
					<div class="col-sm-4">
						<input  type="text" name="remark" class="form-control" placeholder="">
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-4 col-sm-offset-2">
							<input type="radio" name="status" value="1" checked>启用
							<input type="radio" name="status" value="0" >禁用
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-4">
				      <button type="submit" class="btn btn-default">添 加</button>
				    </div>
				</div>
		
			</form>
		</div>
	</div>