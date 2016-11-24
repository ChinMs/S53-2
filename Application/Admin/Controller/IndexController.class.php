<?php
namespace Admin\Controller;
use Think\Controller;
session_start();
class IndexController extends PublicController 
{

	//初始化的方法
	public function _initialize(){

		//判断session是否存在
		if(empty($_SESSION['username'])){
				//跳转到 登陆页
				$this->redirect("Admin/Login/login");
		}
	}
    public function index()
    {
        $this->assign('title','后台管理页面');
        $this->display();
    
    }

    public function clear()
    {

        $this->deldir('./Application/Runtime');
        // echo '<script>self.location=document.referrer;</script>';
        echo '<script>history.go(-1);</script>';
    
    }
}