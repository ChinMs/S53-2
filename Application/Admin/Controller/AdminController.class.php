<?php 
namespace Admin\Controller;
use Think\Controller;

class AdminController extends PublicController
{

        private $_model = null; //数据库操作类
        private $_role = null; //角色表操作类
        private $_admin_model = null; //用户——角色表操作类

        //初始化操作
        public function _initialize(){
            parent::_initialize();
            $this->_model = D('Admin');
            $this->_role = D('Role');
            $this->_admin_role = D('Admin_role');
        }

    // 后台首页
    public function index()
    {
        // $data = M('admin')->select();
        // $this->assign('data',$data);
        $list = $this->_model->select();
            $arr = array(); //声明一个空数组
            //遍历用户信息
            foreach($list as $v){
                $role_ids = $this->_admin_role->field('rid')->where(array('uid'=>array('eq',$v['id'])))->select();
                //定义空数组
                $roles = array();
                //遍历
                foreach($role_ids as $value){
                    $roles[] = $this->_role->where(array('id'=>array('eq',$value['rid']),'status'=>array('eq',1)))->getField('name');
                }
                $v['role'] = $roles; //将新得到角色信息放置到$v中
                $arr[] = $v;
            }

        

            //分配变量
         $this->assign("list",$arr);
        // $this->assign('title','后台用户管理');
        $this->display();
    }

    // 执行添加操作
    public function insert()
    {
        if(empty($_POST)){
            $this->redirect('Admin/index');
            die;
        }
        if(!$this->_model->create()){
                $this->error($this->_model->getError());
                exit;
            }
        // 验证码判断
        $verify = new \Think\Verify();
             if(!$verify->check($_POST['code'])){
                $this->error('验证码错误！');
                exit;
             }
        $time = time();
        $_POST['addtime'] = $time;
        $timer = date('Y-m-s H:i:s',time());

        $_POST['logtime'] = $timer;
        // 自动生成数据
        M('admin')->create();


        if( M('admin')->add() > 0) {
            $this->success('添加成功!',U('Admin/index'),3);
        } else{
            $this->error('添加失败!');
        }
    }

    public function del()
    {
        //判断有无传递ID
        if (empty($_GET['id'])) {
            $this->redirect('index');
            exit;
        }
        //接收参数
        // $id = $_GET['id'];
        // I() 方法 过滤输入的数据 
        $id = I('get.id/d');
        // echo $id;exit;

        //zhixingshanchu 
        if (M('admin')->delete($id) > 0 && $this->_admin_role->where(array('uid'=>array('eq',$id)))->delete()) {
           $this->success('恭喜您,删除成功!', U('index'));
        } else {
           $this->error('删除失败....', U('index'));
        }
    }

     public function edit($id)
    {
        //接收ID
        $id = I('get.id/d');
        //查找
        $data = M('admin')->find($id);

        $this->assign('title','添加用户');
        $this->assign('data',$data);
        $this->display('Admin/edit');
    }


    //执行修改
    public function update()
    {
        if (empty($_POST)) {
            $this->redirect('Admin/User/add');
            exit;
        }
        $id = $_POST['id'];
        $data = M('admin')->find($id);
        if($data['username']==$_POST['username']&$data['phone']==$_POST['phone']&$data['email']==$_POST['email']&$data['sex']==$_POST['sex']&$data['level']==$_POST['level']&$data['state']==$_POST['state']){
            $this->error('编辑失败,信息没有发生改变....');
        }
        if(!$this->_model->create()){
                $this->error($this->_model->getError());
                exit;
            }

        M('admin')->create();
        //执行修改
        if (M('admin')->save() > 0) {
           $this->success('恭喜您,编辑成功!', U('index'));
        } else {
           $this->error('编辑失败....');
        }
    }

    public function info()
    {
        //接收ID
        $id = $_SESSION['id'];
        $data = M('admin')->find($id);
        $this->assign('title','添加用户');
        $this->assign('data',$data);
        $this->display('Admin/info');
    }


    //执行修改
    public function changeInfo()
    {
        if (empty($_POST)) {
            $this->redirect('Admin/info');
            exit;
        }
        $id = $_SESSION['id'];
        $data = M('admin')->find($id);
        if($data['username']==$_POST['username']&$data['phone']==$_POST['phone']&$data['email']==$_POST['email']){
            $this->error('编辑失败,信息没有发生改变....');
        }
         M('admin')->create();
        if (M('admin')->save() > 0) {
           $this->success('恭喜您,编辑成功!', U('index'));
        } else {
           $this->error('编辑失败....');
        }
    }

    //用户修改头像
    public function changePic()
    {   
        $id = $_SESSION['id'];
        $img = $this->insertImg($_FILES,'./Public/images/Admin/Admin/','images/Admin/Admin/',100,100);
        $_POST['picname'] = $img['picname'];
        $_SESSION['picname'] = $img['picname'];
        $map['id'] = $id;
        M('admin')->create();
        if(M('admin')->where($map)->save() > 0 ){
            $this->success('修改成功',U('index'));
        } else {
            $this->error('没有任何数据更新!');
        
        }
    }


    public function pass()
    {
        //接收ID
        $id = $_SESSION['id'];
        $data = M('admin')->find($id);
        $this->assign('title','添加用户');
        $this->assign('data',$data);
        $this->display('Admin/pass');
    }

     public function changePass()
    {
        if (empty($_POST)) {
            $this->redirect('Admin/pass');
            exit;
        }
        $id = $_SESSION['id'];
        $data = M('admin')->find($id);
        if($data['password']==$_POST['password']){
            $this->error('新密码不能与原密码一致！');
        }
        // var_dump($_POST);var_dump($data);exit;
        M('admin')->create();
        //执行修改
        if (M('admin')->save() > 0) {
           $this->success('恭喜您,编辑成功!', U('index'));
        } else {
           $this->error('编辑失败....');
        }
    }

    public function rolelist(){
            //查询节点信息
            $list = $this->_role->where('status=1')->select();
            //查询当前用户信息
            $users = $this->_model->where(array('id'=>array('eq',I('id'))))->find();

            //获取当前用户的角色信息
            $rolelist = $this->_admin_role->where(array('uid'=>array('eq',I('id'))))->select();

            $myrole = array(); //定义空数组
            //对用户的角色进行重组
            foreach($rolelist as $v){
                $myrole[] = $v['rid'];
            }
            //分配数据
            $this->assign("list",$list);
            //分配当前用户信息
            $this->assign('users',$users);
            //分配该用户的角色信息
            $this->assign('role',$myrole);

            //加载模板
            $this->display();
        }

        public function saverole(){
            
            //判读必须选择一个角色
            if(empty($_POST['role'])){
                $this->error("请选择一个角色！");
            }

            $uid = $_POST['uid'];

            //清除用户所有的角色信息，避免重复添加
            $this->_admin_role->where(array('uid'=>array('eq',$uid)))->delete();
    
            foreach(I('role') as $v){
                $data['uid'] = $uid;
                $data['rid'] = $v;
                //执行添加
                $this->_admin_role->data($data)->add();

            }

            $this->success("角色分配成功",U('admin/index'));
            
        } 

        public function page()
        {
        //     if (empty($_)) {
        //     $this->redirect('Admin/page');
        //     exit;
        // }
            $nowpage = $_GET['page']>0?$_GET['page']:1;//判断当前的页数
            $size = 3;//每页显示的条数
            
            //查询一共有多少条数据
            // $count = mysqli_fetch_assoc(mysqli_query($link,'select count(*) as count from admin'));
            $count = M('admin')->count();
         
            //求总页数
            $countpage = ceil($count['count']/$size);
          
            //判断当前的页数是否超出了总页数
            $nowpage = ($nowpage>=$countpage)?$countpage:$nowpage;
            //求偏移量 limit
          
            $limit = ($nowpage-1)*$size;
         
            $username = $_GET['username'];  M('admin')->create();
            $data = M('admin')->where("username like '%$username%'")->select();
          
           if(empty($data))
           {
                $this->error('该用户不存在！');
           }
            if (M('admin')->select() > 0) 
            {   
                $this->assign('list',$data);
                $this->assign('nowpage',$nowpage);
                $this->display();
            }else {
                $this->error('编辑失败....');
            } 
        }

    public function phone()
    {   
        $ran = rand(1000,9999);
        $this->sendTemplateSMS("{$_GET['phone']}",array("$ran",'2'),1);
        echo $ran;

    }


    public function sendTemplateSMS($to,$datas,$tempId)
    {
        //主帐号,对应开官网发者主账号下的 ACCOUNT SID
        $accountSid= '8aaf0708582eefe901584194c99b0b91';

        //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
        $accountToken= 'dcaff20496f641feade5d5754043e2db';

        //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
        //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
        $appId='8aaf0708582eefe901584194ca1e0b95';

        //请求地址
        //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
        //生产环境（用户应用上线使用）：app.cloopen.com
        $serverIP='app.cloopen.com';


        //请求端口，生产环境和沙盒环境一致
        $serverPort='8883';

        //REST版本号，在官网文档REST介绍中获得。
        $softVersion='2013-12-26';
         // 初始化REST SDK
         // global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
         // var_dump($appId);die;
         $rest = new \Org\Dx\REST($serverIP,$serverPort,$softVersion);
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
             return $smsmessage;
             // echo "dateCreated:".$smsmessage->dateCreated."<br/>";
             // echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
             //TODO 添加成功处理逻辑
         }
    }

         public function checkPass(){
        if(I('get.password')){
                $user=M("admin");
                $pass['password']=I('get.password');
               
                if($user->where($pass)->select()){
                    echo "s";
                }else{
                    echo "";
                }
            }
    }


}






