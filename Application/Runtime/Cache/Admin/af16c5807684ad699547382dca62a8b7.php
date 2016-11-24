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
		节点管理
		<small>
			<i class="icon-double-angle-right"></i>
			 节点添加
		</small>
	</h1>



	<div class="row">
		<div class="col-md-12">
			<form action="<?php echo U('Node/doadd');?>" method='post' class="form-horizontal">

				<div class="form-group" style="">
					<label for="" class="col-sm-2 control-label">节点名：</label>
					<div class="col-sm-4">
						<input type="text" name="name" class="input w100" data-validate="required:节点不能为空" placeholder="权限"><span></span>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">控制器：</label>
					<div class="col-sm-4">
						<input  type="text" name="mname" class="input w100" data-validate="required:控制器名不能为空" placeholder=""><span></span>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">操作：</label>
					<div class="col-sm-4">
						<input  type="text" name="aname" class="input w100" data-validate="required:请填写操作" placeholder=""> <span></span>
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
				      <button type="submit" class="button bg-main icon-check-square-o">添 加</button>
				    </div>
				</div>
		
			</form>
		</div>
	</div>