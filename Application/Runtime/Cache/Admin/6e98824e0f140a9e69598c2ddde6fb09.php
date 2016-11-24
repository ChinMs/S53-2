<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/book11-15/Public/css/pintuer.css">
<link rel="stylesheet" href="/book11-15/Public/css/admin.css">
<script src="/book11-15/Public/js/jquery.js"></script>
<script src="/book11-15/Public/js/pintuer.js"></script>
<link rel="stylesheet" href="/book11-15/Public/css/bootstrap.min.css">
<link rel="stylesheet" href="/book11-15/Public/my.css">
<script src="/book11-15/Public/js/jquery.min.js"></script>
<script src="/book11-15/Public/js/bootstrap.min.js"></script>
</head>

<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">
    <button type="button" class="button border-yellow" data-toggle="modal" data-target="#myModal" ><span class="icon-plus-square-o"></span> 添加分类</button>
  </div>
  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>
      <th width="8%">类别名</th>
      <th width="10%">父类</th>
      <th width="10%">path</th>
      <th width="10%">操作</th>
    </tr>
    <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
      <td><?php echo ($vo["id"]); ?></td>
      <td><?php echo ($vo["name"]); ?></td>
      <td><?php echo ($vo["pid"]); ?></td>
      <td><?php echo ($vo["path"]); ?></td>
      <td><div class="button-group"> <a class="button border-main" href='<?php echo U("edit?id=$vo[id]");?>'><span class="icon-edit"></span> 修改</a> <a class="button border-red" href='<?php echo U("del?id=$vo[id]");?>' ><span class="icon-trash-o"></span> 删除</a> </div></td>
    </tr><?php endforeach; endif; ?>
  </table>
</div>

<div class="modal fade "  tabindex="-1" id="myModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加内容</strong></div>
      </div>
      <div class="modal-body">
      <form method="post" class="form-x" action="<?php echo U('add');?>">

      <div class="form-group">
        <div class="label">
          <label>上级分类：</label>
        </div>
        <div class="field  ">
          <select name="pid" class="input w55">
            <option value="">请选择分类</option>
            <option value="0">顶级分类</option>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><if ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>分类标题：</label>
        </div>
        <div class="field ">
          <input type="text" class="input w55" name="name" />
          <div class="tips"></div>
        </div>
      </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
     </form>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>