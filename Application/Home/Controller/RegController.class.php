<?php
namespace Home\Controller;
use Think\Controller;

class RegController extends HomeController 
{
    
    public function reg(){

        $this->display();
    }

    //检查用户是否注册过
    public function checkName()
    {
        // echo "1";exit;
        // $username=I('username');
  //       $password=I('password'));
        // var_dump($_POST);
        // EXIT;
        //判断两次密码输入是否一致
        // var_dump($_POST);
        // die;
            $user = D('User');     
        
            if(!$user->create()){
                $this->error($user->getError());
                exit;
            }
            $user->ctime=time();
            if($user->add()>0){
                $this->success('注册成功！即将为您跳转到登录页面',U('Home/Login/login'));
            }else{
            $this->error('注册失败');
            exit;
            }
    }
     public function regname(){
        if(I('get.name')){
                $user=M("user");
                $name['username']=I('get.name');
                // $name['username']='hugojoe';
                // echo  I('get.name');
                // $user->where($name)->select();
                // echo  $user->_Sql();
                // echo 1;
               
                if($user->where($name)->select()){
                    echo "s";
                }else{
                    echo "";
                }
            }
        //$this->display("reg.html");
    }
    public function crecap()
    {
        // var_dump(I('get.phone'));
        $phone=I('get.phone');
        // if($phone==15851953913){
        //     echo "6789";
        //  $this->sendTemplateSMS("15851953913",array('6789','3'),"1");
        // }else{
        //     echo "2222";
        // }
        // echo(rand(1000,9999));
        $ran = rand(1000,9999);
        $this->sendTemplateSMS($phone,array("$ran",'1'),"1");
        echo $ran; 
    }
    
    protected function sendTemplateSMS($to,$datas,$tempId)
    {
         $accountSid= '8aaf0708582eefe901584195b9880ba0';
         $accountToken= '45c5dc6c0bf34cd1b816fab9f5201fc4';
         $appId='8aaf0708582eefe901584195b9dc0ba4';
         $serverIP='app.cloopen.com';
         $serverPort='8883';
         $softVersion='2013-12-26';   
         // 初始化REST SDK
         $rest=A('REST');
         $rest->__construct($serverIP,$serverPort,$softVersion);
         $rest->setAccount($accountSid,$accountToken);
         $rest->setAppId($appId);
        
         // 发送模板短信
         // echo "Sending TemplateSMS to $to <br/>";
         $result = $rest->sendTemplateSMS($to,$datas,$tempId);
         if($result == NULL ) {
             // echo "result error!";
             // break;
     }
     if($result->statusCode!=0) {
         // echo "error code :" . $result->statusCode . "<br>";
         // echo "error msg :" . $result->statusMsg . "<br>";
         //TODO 添加错误处理逻辑
     }else{
         // echo "Sendind TemplateSMS success!<br/>";
         // 获取返回信息
         $smsmessage = $result->TemplateSMS;
         // echo "dateCreated:".$smsmessage->dateCreated."<br/>";
         // echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
         //TODO 添加成功处理逻辑
     }


}
}