<?php
namespace Admin\Controller;
use Think\Controller;
	session_start();
	class LoginController extends Controller
	{
	
		public function login()
		{		
				$_SESSION['username'] =null;
				$this->display();
		}

		public function logins()
		{
			$user =array();
			$user['username'] =$_POST['username'];
			$user['password'] =$_POST['password'];
		
			$verify = new \Think\Verify();
			 if(!$verify->check($_POST['code'])){
			 	$this->error('验证码错误！');
			 	exit;
			 }

			$data =M('admin')->where("username='{$user['username']}'")->select();

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
	            $_POST['logtime'] =$time;
	            // var_dump($_POST);die;
	            M('log')->create();
	            M('log')->add();
	            M('admin')->create();
	            M('admin')->where('id='.$uid)->save();
				$_SESSION['username'] =$data[0]['username'];
				$_SESSION['picname'] =$data[0]['picname'];
				$_SESSION['id'] =$data[0]['id'];
				$_SESSION['img']=$data[0]['img'];
				$_SESSION['admin_user'] = $data;


		//根据用户id获取对应的节点信息
		//$sql = "select n.mname,n.aname from lamp_user u join lamp_user_role ur on u.id=ur.uid join lamp_role_node rn on ur.rid=rn.rid join lamp_node n on rn.nid=n.id where u.id={$users['id']}";
		//$list = M()->query($sql);

		$list = M('node')->field('mname,aname')->where('id in'.M('role_node')->field('nid')->where("rid in ".M('admin_role')->field('rid')->where(array('uid'=>array('eq',$data[0]['id'])))->buildSql())->buildSql())->select();

		//控制器名转换为大写
		foreach ($list as $key => $val) {
			$list[$key]['mname'] = ucfirst($val['mname']);
		}
		//查看查询出来的信息
		// V($list); exit;
		$nodelist = array();
		$nodelist['Index'] = array('index');
		//遍历重新拼装
		foreach($list as $v){
			$nodelist[$v['mname']][] = $v['aname'];
			//把修改和执行修改 添加和执行添加 拼装到一起
			if($v['aname']=="edit"){
				$nodelist[$v['mname']][]="save";
			}
			if($v['aname']=="add"){
				$nodelist[$v['mname']][]="insert";
			}
		}
		//将权限信息放置到session中
		$_SESSION['admin_user']['nodelist'] = $nodelist;
		//重组的信
		//跳转到首页
		$this->redirect('Index/index');    
				  
			}else{
				$this->error('登录信息错误！','login');
			}
		}
		public function yzm()
		    {
		        $Verify = new \Think\Verify();
		        $Verify->fontSize = 25;
		        $Verify->length = 1;
		        $Verify->codeSet = '0123456789';
		        $Verify->imageW = 200;
		        $Verify->imageH = 50;
		        $Verify->entry();
		    }

	 public function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
}