<?php 
namespace Admin\Controller;
use Think\Controller;

class IntegController extends PublicController
{
    
     //初始化操作
        public function _initialize(){
            parent::_initialize();
            $this->_model = D('Integ');
        }

        //分页
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

// 搜索分页
    public function search()
    {

        if(!empty($_GET['username'])){
             $map['username'] = $_GET['username'];
        }

        $this->index($map);
    }

    public function index($map='')
    {   
        $model=new \Think\Model();
        $p = empty($_GET['p'])?1:$_GET['p'];

        if(!empty($map)){
            $username =$map['username'];
            $data = $model->table('bk_integ i,bk_user u')->where("u.username = '$username'")->field('i.id,u.username,i.time,i.integ,i.state,u.integ')->page($p.',5')->select();
        }else{
        $data = $model->table('bk_integ i,bk_user u')->where("i.user_id =u.id")->field('i.id,u.username,i.time,i.integ,i.state,u.integ')->page($p.',5')->select();
        }
        $count = $model->table('bk_integ i,bk_user u')->field('i.id,u.username,i.time,i.integ,i.state,u.integ')->count();// 查询满足要求的总记录数
        $Page = $this->getPage($count,5);// 实例化分页类 传入总记录数和每页显示的记录数

        foreach($condition as $key=>$val) {
             $Page->parameter[$key] = $val;
        }
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('data',$data);
        $this->assign('list',$list);
        $this->display('Integ/index');
    }


    public function edit($id)
    {
        //接收ID
        $id = I('get.id/d');
        //查找
        $data = M('Integ')->find($id);
        $data['username'] =I('get.username');
        $this->assign('title','添加用户');
        $this->assign('data',$data);
        $this->display('Integ/edit');
    }

    //执行修改
    public function update()
    {
        if (empty($_POST)) {
            $this->redirect('Admin/Integ/edit');
            exit;
        }

        if(!$this->_model->create()){
                $this->error($this->_model->getError());
                exit;
            }
        M('Integ')->create();
        //执行修改
        if (M('Integ')->save() > 0) {
           $this->success('恭喜您,修改成功!', U('index'));
        } else {
           $this->error('修改失败....');
        }
    }

}
    

