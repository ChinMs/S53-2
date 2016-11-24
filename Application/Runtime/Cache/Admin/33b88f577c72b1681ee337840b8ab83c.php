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
<form method="post" action="">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 评论管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 批量删除</button>
        </li>
      </ul>
    </div>

    <table class="table table-hover text-center" id="tablelist">
      <tr>
        <th >ID</th>
        <!-- <th >标题</th> -->
        <th>发布时间</th>
        <th>书名</th>
        <th width="10%">内容</th>
        <th >用户名</th>
        <th >状态</th>
        <th>点赞数</th>
        <th>回复数</th>
        <th>操作</th>
      </tr>
      <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><input type="checkbox" name="id" value="" /><?php echo ($vo["id"]); ?></td>
          <!-- <td><?php echo ($vo["title"]); ?></td> -->
          <td><?php echo (date('Y-m-d H:i:s',$vo["time"])); ?></td>
          <td><?php echo ($vo["bookname"]); ?></td>
          <td width="10%"><?php echo ($vo["comment"]); ?></td>
          <td><?php echo ($vo["username"]); ?></td>
          <td>
            <?php if($vo["state"] == 2): ?>隐藏</font>
            <?php else: ?>显示</font><?php endif; ?>
          </td>
          <td><?php echo ($vo["likenum"]); ?></td>
          <td><?php echo ($vo["replynum"]); ?></td>
          <td><div class="button-group"> 
            <a class="button border-green" href='<?php echo U("look?id=$vo[id]");?>'><span class="icon-edit"></span>详情</a></font>
            <?php if($vo["state"] == 2): ?><a class="button border-main" href='<?php echo U("edit?id=$vo[id]");?>'><span class="icon-edit"></span>显示</a></font>
            <?php else: ?><a class="button border-red" href='<?php echo U("edit?id=$vo[id]");?>'><span class="icon-edit"></span>隐藏</a></font><?php endif; ?>
          </div>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

      <tr>
        <td colspan="12"><div class="pagelist"><?php echo ($page); ?></div></td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">

// function del(id){
//  if(confirm("您确定要删除吗?")){
    
//  }
// }
$("#checkall").click(function(){ 
  $("input[name='id']").each(function(){
    if (this.checked) {
      this.checked = false;
    }
    else {
      this.checked = true;
    }
  });
})

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
function DelSelect(){
 var Checkbox=false;
  $("input[name='id']").each(function(){
   if (this.checked==true) {   
   Checkbox=true;  
   }
 });
  // if (Checkbox){
  //  var t=confirm("您确认要删除选中的内容吗？");
  //  if (t==false) return false;     
  // }
  // else{
  //  alert("请选择您要删除的内容!");
  //  return false;
  // }
}

</script>
</body></html>