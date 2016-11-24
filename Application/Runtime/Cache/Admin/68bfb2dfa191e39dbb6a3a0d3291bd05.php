<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
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
</head>
<body>
<form method="get" action="<?php echo U('search');?>" id="listform">
  <div class="panel admin-panel">
    <input type="text" placeholder="请输入出版社名" name="name" class="input" style="width:250px; line-height:17px;display:inline-block" />
          <button class="button border-main icon-search" type="submit" > 搜索</button>
    <table class="table table-hover text-center" id="tablelist">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
        <th width="20%">出版社名称</th>
        <th>出版社图片</th>
       <!--  <th width="10%">更新时间</th> -->
        <th width="200">操作</th>
      </tr>
      <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><input type="text"  value="<?php echo ($vo["id"]); ?>" style="width:50px; text-align:center; border:1px solid #ddd; padding:7px 0;" readonly /></td>
          <td><?php echo ($vo["name"]); ?></td>
          <td width="10%"><img src="/book11-15/Public/images/Admin/Press/<?php echo ($vo["picname"]); ?>" alt="" width="100" height="50" /></td>
        <!--   <td><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td> -->
          <td><div class="button-group"> <a class="button border-main" href='<?php echo U("edit?id=$vo[id]");?>'><span class="icon-edit"></span> 修改</a> <a class="button border-red" href='<?php echo U("del?id=$vo[id]");?>' ><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <tr>
        <td colspan="8"><div class="pagelist"><?php echo ($page); ?></div></td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">


    function user(page){
        var p = page;
        $.ajax({
            type:'get',
            url:'<?php echo U('Press/index');?>',
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