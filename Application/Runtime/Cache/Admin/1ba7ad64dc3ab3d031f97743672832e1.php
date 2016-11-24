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
  <div class="panel-head"><strong><span class="icon-key"></span> 修改个人资料</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo U('Admin/changeInfo');?>">
      <div class="form-group">
        <div class="label">
          <label for="sitename">管理员帐号：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="username" size="50" value="<?php echo ($data["username"]); ?>" data-validate="required:请输入管理员账号" readonly="readonly"/>
          <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>"> 
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label for="sitename">联系电话：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="phone" name="phone" size="50" value="<?php echo ($data["phone"]); ?>" data-validate="required:请输入联系电话" />       
        </div>
      </div>      
      <div class="form-group">
        <div class="label">
          <label for="sitename">电子邮箱：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="email" name="email" size="50" value="<?php echo ($data['email']); ?>" data-validate="required:请输入电子邮箱" />         
        </div>
      </div>  
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 修改</button>    
        </div>
      </div>      
    </form>
  </div>
</div>
<br><br>
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-key"></span> 修改头像</strong></div>
  <div class="body-content">

    <form method="post" class="form-x" action="<?php echo U('Admin/changePic');?>" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>"> 
      <div class="form-group">
        <div class="label">
          <label for="sitename">头像：</label>
        </div>
        <div class="field">
          <input type="text" id="url1" name="picname" class="input tips" style="width:25%; float:left;"  value=""  data-toggle="hover" data-place="right" data-image="" />
          <input type="button" class="button bg-blue margin-left" id="image1" value="+ 浏览上传"  style="float:left;">
          <input type="file" name="picname" class="inputstyle"  id="a1">
        </div>
      </div> 
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 修改</button>    
        </div>
      </div>     
    </form>
  </div>
</div>
</body>
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

</script>
</html>