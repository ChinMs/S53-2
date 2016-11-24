<?php 
namespace Admin\Controller;
use Think\Controller;

class UserController extends PublicController
{

        private $_model = null; //数据库操作类
        private $_role = null; //角色表操作类
        private $_admin_model = null; //用户——角色表操作类

        //初始化操作
        public function _initialize(){
            parent::_initialize();
            $this->_model = D('User');
        }

     function getPage($count, $pagesize = 20) {
        $Page = new \Admin\Page\AjaxPage($count, $pagesize);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('last', '末页');
        $Page->setConfig('first', '首页');
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $Page->lastSuffix = false;//最后一页不显示为总页数
        return $Page;
    }
        
    public function index($map='')
    {   
        $p = empty($_GET['p'])?1:$_GET['p'];
        if(!empty($map))
        {   
            $map[] ="u.id=i.user_id";
            $username=$map['username'];
            $data =$this->_model->where("username like '%$username%'")->select(); 
        }else{
            $data = $this->_model->page($p.',3')->select();
            }
        $count = M('User')->count();// 查询满足要求的总记录数

        $Page = $this->getPage($count,3);// 实例化分页类 传入总记录数和每页显示的记录数
        foreach($condition as $key=>$val) {
             $Page->parameter[$key] = $val;
        }
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('data',$data);
        $this->display('User/index');
    }
         //搜索分页
    public function search()
    {

        if(!empty($_GET['username'])){
            $map['username'] = $_GET['username'];
        }
        $this->index($map);
    }
     public function edit($id)
    {
        //接收ID
        $id = I('get.id/d');
        //查找
        $data = M('User')->find($id);

        $this->assign('title','添加用户');
        $this->assign('data',$data);
        $this->display('User/edit');
    }


    //执行修改
    public function update()
    {
        if (empty($_POST)) {
            $this->redirect('User/edit');
            exit;
        }

        $id = $_POST['id'];
        $data = M('user')->find($id);
        if($data['username']==$_POST['username']&$data['sex']==$_POST['sex']&$data['state']==$_POST['state']&$data['integ']==$_POST['integ']){
        
            $this->error('信息没有发改变!');
        }
        
        if(!$this->_model->create()){
                $this->error($this->_model->getError());
                exit;
            }

        M('User')->create();
        //执行修改
        if (M('User')->save() > 0) {
           $this->success('恭喜您,编辑成功!', U('index'));
        } else {
           $this->error('编辑失败....');
        }
    }
}













