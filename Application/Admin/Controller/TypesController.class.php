<?php 
namespace Admin\Controller;
use Think\Controller;
// header('content-type:text/html;charset=urf-8');
/*
 *   分类管理
 *   脳梅脮脽:禄陋脠贸
*/
class TypesController extends PublicController
{
    public function index()
    {
        $map['pid'] = 0;
        $data = D('Type')->getAdminCate();
        $this->assign('data',$data);
        $this->assign('title','分类管理');
        $this->display('index');
    }

    // 执行添加方法
    public function add()
    {
        if(empty($_POST['name'])) {
            $this->error('出错啦啦啦!');
        }
        $pid = I('post.pid/d');
        //
        if($pid==0) {
            $_POST['path'] = $pid.',';
        } else{
            $map = [];
            $map['id'] = array(array('eq', $pid));
            // 指定字段 查找父类的id和路径
            $row=M('type')->where($map)->field('id,path')->select();
            $_POST['path'] = $row[0]['path'].$row[0]['id'].',';
            $_POST['pid'] = $row[0]['id'];
        }

        M('type')->create();

        if(M('type')->add() > 0) {

            $this->success('恭喜您,添加分类成功!',U('index'));
        } else{

            $this->error('添加失败!');
        }
    }

    // 脰麓脨脨脡戮鲁媒
    public function del()
    {
        if(empty($_GET['id'])) {
            $this->error('出错啦啦啦~');
        }
        $id = I('get.id/d');
        $map['path'] = array('like','%'.I('id').'%');
        $book = M('book')->where(array('type_id'=>$id))->select();
        if ($book) {
            $this->error("请先删除该分类的书籍");
            exit;
        }

        $data = M('type')->where(array('path'=>$map['path']))->select();
        if ($data) {
            $this->error("请先删除子分类");
            exit;
        }

        if (M('type')->delete($id) > 0) {
           $this->success('恭喜您,删除成功!', U('index'));
        } else {
           $this->error('删除失败....', U('index'));
        }
    }

    // 加载修改页面
    public function edit()
    {
        if(empty($_GET['id'])) {
            // $this->redirect('');
            echo '<h1>404</h1>';exit;
        }
        $id = I('get.id/d');

        $map['id'] = $id;

        $this->assign('title','修改分类');
        $data = M('type')->where($map)->select();
        $this->assign('data',$data);
        $this->display();
    }

    // 执行修改操作
    public function update()
    {

        if(empty($_POST['id'])) {
            // $this->redirect('');
            echo '<h1>404</h1>';exit;
        }
        $id = I('post.id/d');

        $map['id'] = $id;

        M('type')->create();
        if (M('type')->where($map)->save() > 0) {
            $this->success('修改成功!', U('index'));
        } else {
            $this->error('修改失败....');
        }
        
    }

    public function look()
    {
        if(empty($_GET['id'])) {
            // $this->redirect('');
            echo '<h1>404</h1>';exit;
        }
        $id = I('get.id/d');
        $map['pid'] = $id; 
        $data = M('type')->where($map)->select();
        if (empty($data)) {
            echo '<script>alert("没有子分类");window.history.go(-1)</script>';
        }
        

        $this->assign('data',$data);
        $this->display('index');
    }

    /**
     * 分类树显示
    */
    public function tree(){
        //实例化
        $category = D('Type');
        //获取分类信息
        $list = $category->getHomeCate();
        //V($list);
        // var_dump($list);
        $this->assign('list',$list);
        $this->display();
    }
}



