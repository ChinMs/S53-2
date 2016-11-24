<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/book/Public/css/pintuer.css">
<link rel="stylesheet" href="/book/Public/css/admin.css">
<script src="/book/Public/js/jquery.js"></script>
<script src="/book/Public/js/pintuer.js"></script>
<style>
  .inputstyle{
    width: 144px;
    height: 41px;
    cursor: pointer;
    font-size: 30px;
    outline: medium none;
    position: absolute;
    filter:alpha(opacity=0);
    -moz-opacity:0;
    opacity:0; 
    left:-200px;
    top: 0px;

  }
</style>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo U('update');?>" enctype="multipart/form-data">  
      <input type="hidden" value="<?php echo ($data["id"]); ?>" name="id">
      <div class="form-group">
        <div class="label">
          <label>书名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="<?php echo ($data["bookname"]); ?>" name="bookname" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">
          <input type="hidden" name="oldpicname" value="<?php echo ($data["picname"]); ?>">
          <img src="/book/Public/images/Admin/Books/<?php echo ($data["picname"]); ?>" alt="" class="margin-left" width="100" height="150" id="url1">
          <input type="button" class="button bg-blue margin-left" id="image1" value="+ 浏览上传"  style="float:left;">
          <input type="file" name="picname" class="inputstyle"  id="a1">
        </div>
      </div>     
        <div class="form-group">
          <div class="label">
            <label>分类标题：</label>
          </div>
          <div class="field">
            <select name="type_id" class="input w50" data-validate="required:请选择分类">
              <option value="">请选择分类</option>
              <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo["id"] == $data[type_id]): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <div class="tips"></div>
          </div>
        </div>
      <div class="form-group">
        <div class="label">
          <label>作者：</label>
        </div>
        <div class="field">
              <select name="author_id" class="input w50" data-validate="required:请选择作者">
              <option value="">请选择作者</option>
              <?php if(is_array($author)): $i = 0; $__LIST__ = $author;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo[id] == $data[author_id]): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
          <div class="label">
            <label>出版社：</label>
          </div>
          <div class="field">
            <select name="press_id" class="input w50" data-validate="required:请选择出版社">
              <option value="">请选择出版社</option>
              <?php if(is_array($press)): $i = 0; $__LIST__ = $press;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo["id"] == $data[press_id]): ?>selected<?php endif; ?> ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <div class="tips"></div>
          </div>
        </div>
      <div class="form-group">
        <div class="label">
          <label>简介：</label>
        </div>
        <div class="field">
          <textarea class="input" name="descr" style=" height:90px;"><?php echo ($data["descr"]); ?></textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>状态：</label>
        </div>
        <div class="field">
          <input type="radio" value="0" name="state" <?php if($data["state"] == '0'): ?>checked<?php endif; ?>>下架
          <input type="radio" value="1" name="state"<?php if($data["state"] == '1'): ?>checked<?php endif; ?>>上架
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
          <div class="label">
            <label>单价：</label>
          </div>
          <div class="field">
            <input type="text" class="input w50" name="price" value="<?php echo ($data["price"]); ?>" dtype="number" data-validate="required:请输入单价" id="price" /><span style="height:40px;line-height:40px;"></span>
            <div class="tips"></div>
          </div>
        </div>
<!--         <div class="form-group">
          <div class="label">
            <label>其他属性：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            上架 <input id="ishome"  type="checkbox" />
            下架 <input id="isvouch"  type="checkbox" />
          </div>
        </div>  -->
      <div class="clear"></div>
<!--       <div class="form-group">
        <div class="label">
          <label>内容关键字：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="s_keywords" value=""/>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>关键字描述：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input" name="s_desc" style="height:80px;"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort" value="0"  data-validate="number:排序必须为数字" />
          <div class="tips"></div>
        </div>
      </div> -->
<!--       <div class="form-group">
        <div class="label">
          <label>发布时间：</label>
        </div>
        <div class="field"> 
          <script src="js/laydate/laydate.js"></script>
          <input type="text" class="laydate-icon input w50" name="datetime" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value=""  data-validate="required:日期不能为空" style="padding:10px!important; height:auto!important;border:1px solid #ddd!important;" />
          <div class="tips"></div>
        </div>
      </div> -->
<!--       <div class="form-group">
        <div class="label">
          <label>点击次数：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="views" value="" data-validate="member:只能为数字"  />
          <div class="tips"></div>
        </div>
      </div> -->
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit" id="sub"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
          //通过点击浏览上传来自动触发
          $('#image1').click(function(){
             $('#a1').trigger('click');
          });
          $('#url1').click(function(){
             $('#a1').trigger('click');
          });

        $(function() {
          $("#a1").click(function () {
             $("#a1").on("change",function(){
               var objUrl = getObjectURL(this.files[0]) ;  //获取图片的路径，该路径不是图片在本地的路径
               if (objUrl) {
                 $("#url1").attr("src", objUrl) ;      //将图片路径存入data-image中，显示出图片
                 $("#url1").val(objUrl);
               }
              });
            });
          });
         
          //建立一個可存取到該file的url
          function getObjectURL(file) {
            var url = null ;
            if (window.createObjectURL!=undefined) { // basic
              url = window.createObjectURL(file) ;
            } else if (window.URL!=undefined) { // mozilla(firefox)
              url = window.URL.createObjectURL(file) ;
            } else if (window.webkitURL!=undefined) { // webkit or chrome
              url = window.webkitURL.createObjectURL(file) ;
            }
            return url ;
          }

          $('#sub').click(function(){
            value = $('#price').val();
              if(isNaN(value)){
                return false;
            }
          });

          $('#price').blur(function(){
            value = $(this).val();
            if(!isNaN(value) && value!=null){
              $('#price').next().html('');
            }else {
              $('#price').next().css('color','red').html('请输入数字!');
            }
          })
</script>
</body></html>