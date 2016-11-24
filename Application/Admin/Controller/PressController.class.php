<?php 
namespace Admin\Controller;
use Think\Controller;

/*
    
*/
class PressController extends AdminController
{   
    //初始化操作
        public function _initialize(){
            parent::_initialize();
            $this->_model = D('Press');
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
            $name=$map['name'];
            $data =$this->_model->where("name like '%$name%'")->select(); 
        }else{
            $data = $this->_model->page($p.',5')->select();
            }
        $count = M('Press')->count();// 查询满足要求的总记录数

        $Page = $this->getPage($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        foreach($condition as $key=>$val) {
             $Page->parameter[$key] = $val;
        }
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('data',$data);
        $this->display('Press/index');
    }

         // 执行添加操作
    public function insert()
    {
        if(empty($_POST)){
            $this->redirect('Press/index');
            die;
        }
        if(!$this->_model->create()){
                $this->error($this->_model->getError());
                exit;
            }
       
         $img = $this->insertImg($_FILES,'./Public/images/Admin/Press/','images/Admin/Press/');
        $_POST['picname'] = $img['picname'];
        // 自动生成数据
        M('Press')->create();


        if( M('Press')->add() > 0) {
            $this->success('添加成功!',U('Press/index'),2);
        } else{
            $this->error('添加失败!');
        }
    }

    //执行删除操作
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
        if (M('Press')->delete($id) > 0 ) {
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
        $data = M('Press')->find($id);

        $this->assign('title','添加用户');
        $this->assign('data',$data);
        $this->display('Press/edit');
    }


    //执行修改
    public function update()
    {
        if (empty($_POST)) {
            $this->redirect('Admin/Press/add');
            exit;
        }
        if(!$this->_model->create()){
                $this->error($this->_model->getError());
                exit;
            }
        unlink('./Public/images/Admin/Press/'.$_POST['oldpicname']);
        $img = $this->insertImg($_FILES,'./Public/images/Admin/Press/','images/Admin/Press/');
        //     $_POST['addtime'] = time();
        $_POST['picname'] = $img['picname'];
        M('Press')->create();
        //执行修改
        if (M('Press')->save() > 0) {
           $this->success('恭喜您,编辑成功!', U('index'));
        } else {
           $this->error('编辑失败....');
        }
    }

    //搜索分页
    public function search()
    {

        if(!empty($_GET['name'])){
            $map['name'] = $_GET['name'];
        }

        $this->index($map);
    }
}














