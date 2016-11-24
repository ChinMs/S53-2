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
<div class="panel admin-panel">

  <div class="panel-head"><strong><span class="icon-key"></span> 修改个人密码</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" onsubmit="return check()" action=" <?php echo U('Admin/changePass');?>">
      <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>"> 
      <div class="form-group">
        <div class="label">
          <label for="sitename">管理员帐号：</label>
        </div>
        <div class="field">
          <label style="line-height:33px;">
            <?php echo ($data["username"]); ?>
          </label>
        </div>
      </div>      
      <div class="form-group">
        <div class="label">
          <label for="sitename">原始密码：</label>
        </div>
        <div class="field">
          <input type="password" class="input w50" id="mpass" name="mpass" size="50" placeholder="请输入原始密码" />       
        </div>
      </div>      
      <div class="form-group">
        <div class="label">
          <label for="sitename">新密码：</label>
        </div>
        <div class="field">
          <input type="password" class="input w50" name="password" size="50" placeholder="请输入新密码" data-validate="required:请输入新密码,length#>=3:新密码不能小于5位" />         
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label for="sitename">确认新密码：</label>
        </div>
        <div class="field">
          <input type="password" class="input w50" name="renewpass" size="50" placeholder="请再次输入新密码" data-validate="required:请再次输入新密码,repeat#password:两次输入的密码不一致" />          
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label for="sitename">输入手机号</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="phone" size="50" placeholder="请输入手机号"  /><span style="height:42px;line-height:42px;"></span>       
        </div>
      </div>
      <div class="form-group">
        <div class="field">
          <a class="button bg-main" id="demo" style="float:left;margin-left:100px;cursor:pointer"  >获取验证</a>   
          <input type="text" class="input w50" style="width:120px;margin-left:20px;" size="50" placeholder="验证码" id="yzm" /><span id="sj"style="height:42px;line-height:42px;"></span>        
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>   
        </div>
      </div>      
    </form>
  </div>
</div>
<script>
            var p =false;
            $("#phone").blur(            
              function (){
                var val=$(this).val();
                // console.log(val);
                var regt=/^1[3|4|5|7|8][0-9]{9}$/;

                if(!val){
                $(this).next().css("color","red");
                $(this).css("border",'1px solid red');
                $(this).next().html(" &nbsp;&nbsp;请输入手机号");
                $('#demo').attr('disabled',true);
                return p = false;
                }else if(!regt.test(val)){
                $(this).next().css("color","red");
                $(this).css("border",'1px solid red');

                $(this).next().html(" &nbsp;&nbsp;请填写正确的手机号码");
                $('#demo').attr('disabled',true);
                return p = false;
                }else{
                $(this).next().css("color","#22CC77");
                $(this).css("border",'1px solid #22CC77');
                $('#demo').attr('disabled',false);
                $(this).next().html("&nbsp;&nbsp;手机号可用");
                return p = true;
                }

            }
);

          function passe(){
              var pass=$("#mpass").val();
              if(!pass)
              {
              $("#ps").css("color","red");
              $("#ps").html("请输入密码");
              return p = false;
              }else
              {
                $.get("/book11-15/index.php/Admin/Admin/checkPass?password="+pass,function(b){
                    if(!b){
                      $("#ps").css("color","red");
                      $("#ps").html("密码错误");
                      return p = false;
                    }else{
                      $("#ps").css("color","green");
                      $("#ps").html("密码正确");
                      return p = true;
                    }

                });
              }
          }
          $("#mpass").blur(passe);



        var phoneyzm;
       $('#demo').click(
        function ()
        {
          var m = 60;
          time =setInterval(function (){
                  if(m>0){
                    m--;
                    $('#demo').html(m+'秒后获取');
                    $('#demo').attr('disabled',true);
                  }else{
                    clearInterval(time);
                    $('#demo').html('获取验证码');
                    $('#demo').attr('disabled',false);
                }
            },1000);
          //获取手机号码进行ajax请求
          var val=$("#phone").val();
          $.ajax({
              type:'get',
              url:"<?php echo U('Admin/phone');?>",
              data:'phone='+val,
              success:function(data){
                phoneyzm = data;
                console.log(phoneyzm);
              }
          });//ajaxj
 
        }

        ) 











           function check(){
              if($("#yzm").val()!=phoneyzm){
                $('#sj').css('color','red');
                $('#sj').html('验证码错误');
                return false;             
                
              }
            
            if(p)
            {
                return true;
              }else{
                passe();
                return false;
              }
  } 
</script>
</body>
</html>