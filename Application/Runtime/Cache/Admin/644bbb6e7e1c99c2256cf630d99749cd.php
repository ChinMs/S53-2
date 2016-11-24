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
    <form method="post" class="form-x" action="<?php echo U('insert');?>" enctype="multipart/form-data">  
      <div class="form-group">
        <div class="label">
          <label>书名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="bookname" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">
          <input type="text" id="url1" name="img" class="input tips" style="width:25%; float:left;"  value=""  data-toggle="hover" data-place="right" data-image="" />
          <input type="button" class="button bg-blue margin-left" id="image1" value="+ 浏览上传"  style="float:left;">
          <input type="file" name="picname" class="inputstyle"  id="a1">
        </div>
      </div>     
      <div class="form-group">
        <div class="label">
          <label>书籍文件：</label>
        </div>
        <div class="field">
          <input type="text" id="url2" name="img" class="input tips" style="width:25%; float:left;"  value=""  />
          <input type="button" class="button bg-blue margin-left" id="file1" value="+ 浏览上传"  style="float:left;">
          <input type="file" name="bookfile" class="inputstyle"  id="a2">
        </div>
      </div> 
        <div class="form-group">
          <div class="label">
            <label>分类标题：</label>
          </div>
          <div class="field">
            <select name="type_id" class="input w50" data-validate="required:请选择分类">
              <option value="">请选择分类</option>
              <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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
              <?php if(is_array($author)): $i = 0; $__LIST__ = $author;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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
              <?php if(is_array($press)): $i = 0; $__LIST__ = $press;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <div class="tips"></div>
          </div>
        </div>
      <div class="form-group">
        <div class="label">
          <label>简介：</label>
        </div>
        <div class="field">
          <textarea class="input" name="descr" style=" height:90px;"></textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>标签：</label>
        </div>
        <div class="field">
          <textarea class="input w50" name="tag" style=" height:90px;"></textarea>
          <div class="tips"></div>多个标签用逗号隔开
        </div>
      </div>
        <div class="form-group">
          <div class="label">
            <label>单价：</label>
          </div>
          <div class="field">
            <input type="text" class="input w50" name="price" value="" dtype="number" data-validate="required:请输入单价" id="price" /><span style="height:40px;line-height:40px;"></span>
            <div class="tips"></div>
          </div>
        </div>
      <div class="clear"></div>
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
                 $("#url1").attr("data-image", objUrl) ;      //将图片路径存入data-image中，显示出图片
                 $("#url1").val(objUrl);
               }
              });
            });
          });

          $('#file1').click(function(){
             $('#a2').trigger('click');
          });
          $('#url2').click(function(){
             $('#a2').trigger('click');
          });

        $(function() {
          $("#a2").click(function () {
             $("#a2").on("change",function(){
               var objUrl = getObjectURL(this.files[0]) ;  //获取图片的路径，该路径不是图片在本地的路径
               if (objUrl) {
                 $("#url2").attr("value", objUrl) ;      //将图片路径存入data-image中，显示出图片
                 $("#url2").val(objUrl);
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