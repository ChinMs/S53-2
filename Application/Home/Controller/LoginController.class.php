<?php
namespace Home\Controller;
use Think\Controller;
	session_start();
	class LoginController extends HomeController
	{
	
		public function login()
		{		
				// $_SESSION['username'] =null;
				$this->display('Login/login');
		}


		//执行登录
		public function dologin()
		{	
			
			if(empty($_POST['username'])|empty($_POST['password'])) {
				// var_dump($_POST);exit;
				$this->error('登录信息错误！','index');
				exit;
			}
			
			$user =array();
			$user['username'] =$_POST['username'];
			$user['password'] =$_POST['password'];

			$data =M('user')->where("username='{$user['username']}'")->select();
	
			if($data){
					if($_SESSION['url']==null){
						$this->redirect('Index/index');
					}else{
						echo '<script>window.location.href="'.$_SESSION['url'].'";</script>';
					}
				}

			if($user['username']==$data[0]['username']&&$user['password']==$data[0]['password'])
			{

	            $ipdz = get_client_ip();
	            $Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
	            $area = $Ip->getlocation("$ipdz"); // 获取某个IP地址所在的位置
	            $city = $area['country'];
	            $browser = get_client_browser();
	            $uid = $data[0]['id'];
	            $time = time();
	            $_POST['ip']=$ipdz;
	            $_POST['city'] = $city;
	            $_POST['browser'] = $browser[0].' '.$browser[1];
	            $_POST['user_id'] = $uid;
	            $_POST['time'] = $time;
	            // var_dump($_POST);die;
	            M('log')->create();
	            M('log')->add();
				$_SESSION['user_name'] =$data[0]['username']; 
				$_SESSION['user_id'] =$data[0]['id']; 
				echo '<script>window.location.href="'.$_SESSION['url'].'";</script>';

				     
			}else{
				$this->error('登录信息错误！','login');
			}

		}

		public function logout()
		{
			$_SESSION['user_name'] =null;
			$_SESSION['user_id'] =null;
			$_SESSION['url'] =null;
        	echo '<script>self.location=document.referrer;</script>';


		}
    }