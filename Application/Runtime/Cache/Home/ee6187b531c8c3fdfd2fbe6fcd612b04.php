<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>注册</title>
      <link rel="stylesheet" href="/book/Public/css/bootstrap.min.css">
		<link rel="stylesheet" href="/book/Public/css/resetd.css" />
		<link rel="stylesheet" href="/book/Public/css/commond.css" />
	</head>
	<body style="background:url('/book/Public/images/Home/Login/logo_bg.jpg')">
		<div class="wrap login_wrap">
			<div class="content">
				
				<div class="logo"></div>
				
				<div class="login_box">	
					
					<div class="login_form">
						<div class="login_title">
							注册
						</div>
						<form action="<?php echo U('Home/Reg/checkName');?>" method="post" name="myForm" autocomplete="off" onsubmit="return check()">
							<div class="form_text_ipt">
								<input name="username" type="text" placeholder="请输入用户名" id="user_name_r" value="">
								<span id="nu">用户名</span>
							</div>
							<div class="ececk_warning"><span>数据不能为空</span></div>

							<div class="form_text_ipt">
								<input name="password" type="password" placeholder="请输入密码" id="password" tabinde="2" maxlength="10" value="">
								<span id="pwd">设置密码</span>
							</div>
							<div class="ececk_warning"><span>数据不能为空</span></div>

							<div class="form_text_ipt">
								<input name="repassword" type="password" tabindex="3" id="re_password" value="" maxlength="10"placeholder="确认密码">
								<span id="pwd1">确认密码</span>
							</div>
							<div class="ececk_warning"><span>数据不能为空</span></div>

							<div class="form_text_ipt">
								<input name="phone" type="text" placeholder="请输入手机号" id="PHONE">
								<span id="phone">手机号</span>
							</div>
							<div class="ececk_warning"><span>数据不能为空</span></div>
							
							<div class="form_text_ipt ">
								<input type="text" id="capt" placeholder="验证码">
								<span id="ver">验证码</span>
							</div>
							<div class="ececk_warning"><span>数据不能为空</span></div>

							<div class="form_text_ipt" style="border:none">
								<button id="fetch" readonly="readonly" type="button" class="btn btn-success col-md-12 " >获取验证码</button>
                <!-- <span id="fetch" class="btn btn-success"> 获取验证码</span> -->
							</div>
							<div class="ececk_warning"><span>数据不能为空</span></div>

							<div class="form_btn">
								<button type="submit">注册</button>
							</div>
							<div class="form_reg_btn">
								<span>已有帐号？</span><a href="<?php echo U('Login/login');?>">马上登录</a>
							</div>
						</form>
						<div class="other_login">
							<div class="left other_left">
								<span>其它登录方式</span>
							</div>
							<div class="right other_right">
								<a href="#">QQ登录</a>
								<a href="#">微信登录</a>
								<a href="#">微博登录</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="/book/Public/js/jquery.min.js" ></script>
		<script type="text/javascript" src="/book/Public/js/common.js" ></script>
		 <script type="text/javascript"charset="utf-8">


            //  电话
            var t =false;
            function phone(){
                var val=$("#PHONE").val();
                console.log(val);
                var regt=/^1[3|4|5|7|8][0-9]{9}$/;

                if(!val){
                $("#phone").css("color","red");
                $("#phone").html("请输入手机号");
                return t = false;
                }else if(!regt.test(val)){
                $("#phone").css("color","red");
                $("#phone").html("请填写正确的手机号码");
                return t = false;
                }else{
                $("#phone").css("color","green");
                $("#phone").html("手机号可用");
                return t = true;
                }

            }
            $("#PHONE").blur(phone);

            // 获取验证码
            $("#fetch").click(function(){
              var phone=$("#PHONE").val();
              if(t == ""){
                $("#ver").css("color","red");
                $("#ver").html("请先填写正常的手机格式");
                return;
              }
            
              var countdown = 60;
              function settime() { 
                if (countdown == 0) { 
                  $("#fetch").removeAttr("disabled");    
                  $("#fetch").html("获取验证码"); 
                  countdown = 60; 
                } else { 
                  $("#fetch").attr("disabled",true); 
                  $("#fetch").html("重新发送(" + countdown + ")"); 
                  countdown--; 
                setInterval(settime ,1000);
                }
              } 
              settime();

              $.get("/book/index.php/Home/Reg/crecap?phone="+phone,function(b){
                    hand=b;    
                });
            });


          // 验证码
          var f =false;
          function capt(){
            var val=$("#capt").val();
              if(!val){
                $("#ver").css("color","red");
                $("#ver").html("请点击获取验证码");
                return f = false;
              }
              console.log(val);
              console.log(hand);
              if(val == hand){
                $("#ver").css("color","green");
                $("#ver").html("验证码可用");
                return f = true;
              }else{
                $("#ver").css("color","red");
                $("#ver").html("验证码不可用");
                return f = false;   
            }

          }
          $("#capt").blur(capt);


          // 用户名
          var u =false;
          function namee(){
              var name=$("#user_name_r").val();
              var regu=/^\w{3,12}$/;
              if(!name)
              {
              $("#nu").css("color","red");
              $("#nu").html("请输入用户名");
              return u = false;
              }else if(!regu.test(name))
              {
              $("#nu").css("color","red");
              $("#nu").html("请输入3-12位任意数字字母下划线组成的用户名");
              return u = false;
              }else
              {
                $.get("/book/index.php/Home/Reg/regname?name="+name,function(b){
                    // console.log(b);

                    if(b){
                      $("#nu").css("color","red");
                      $("#nu").html("用户名已被注册");
                      return u = false;
                    }else{
                      $("#nu").css("color","green");
                      $("#nu").html("用户名可用");
                      return u = true;
                    }

                });
              }
          }
          $("#user_name_r").blur(namee);
            // 密码
            var p=false;
            function pass(){
                var val=$("#password").val();
                var regp=/^\w{3,12}$/;
              if(!val){
                  $("#pwd").css("color","red");
                  $("#pwd").html("请输入密码");
                  return p = false;
              }else if(!regp.test(val)){
                  $("#pwd").css("color","red");
                  $("#pwd").html("请输入3-12位任意数字字母下划线组成的密码");
                  return p = false;
              }else{
                  $("#pwd").css("color","green");
                  $("#pwd").html("密码可用");
                  return p = true;
              }
            }


            $("#password").blur(pass);



            // 确认密码
            var p1=false;
            function repass(){
               var val=$("#re_password").val();
                  var regp=/^\w{3,12}$/;
                  if(!val)
                  {
                    $("#pwd1").css("color","red");
                    $("#pwd1").html("请再次输入密码");
                    return p1 = false;
                    }else if(!regp.test(val)){
                        $("#pwd1").css("color","red");
                        $("#pwd1").html("请输入3-12位任意数字字母下划线组成的密码");
                        return p1 = false;
                    }else if(val != $(":password").val()){
                    $("#pwd1").css("color","red");
                    $("#pwd1").html("两次输入不同");
                    return p1 = false;
                    }else{
                    $("#pwd1").css("color","green");
                    $("#pwd1").html("密码格式正确");
                    return p1 = true;
                }
            }
            $("#re_password").blur(repass);
        
            function check(){
            if(u && p && p1 && f && t)
            {
                return true;
              }else{
                phone();
                capt();
                namee();
                pass();
                repass();
                return false;
              }             
            } 

        


            </script>
	</body>
      <script src="/book/Public/js/bootstrap.min.js"></script>
</html>