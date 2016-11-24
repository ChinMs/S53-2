<?php 
namespace Admin\Controller;
use Think\Controller;

class ActlinkController extends PublicController
{
    // 活动链接首页
    public function index()
    {
        $data = M('actlink')->select();
        $this->assign('title','活动链接管理');
        $this->assign('data',$data);
        $this->display();
    }


    public function insert()
    {  
        $count = M('actlink')->field('id')->count();
        if ($count >=5) {
            $this->error('您已经有5个轮播图了,请删除一个再继续添加!',U('Actlink/index'));
            exit;
        }
       $img = $this->insertImg($_FILES,'./Public/images/Admin/Actlink/','images/Admin/Actlink/',120,50);
        $_POST['picname'] = $img['picname'];
        M('actlink')->create();
        if (M('actlink')->add() > 0) {
            $this->success('添加成功',U('index'));
        } else {
            $this->error('添加失败');
        }
    }

    public function edit()
    {
        if(empty($_GET['id'])){
            echo '<h1>404</h1>';
            exit;
        }
        $id = I('get.id/d');
        $map['id'] = $id;
        $data = M('actlink')->where($map)->find();
        $this->assign('title','活动链接管理');
        $this->assign('data',$data);
        $this->display();
    }

    //执行修改操作
    public function update()
    {
        if(empty($_POST['link_id'])){
            echo '<h1>404</h1>';
            exit;
        }
        $id = I('post.link_id/d');
        $map['id'] = $id;
        //如果没有文件上传则不修改进行修改图片操作
        if($_FILES['picname']['error']!=4) {
            $img = $this->insertImg($_FILES,'./Public/images/Admin/Actlink/','images/Admin/Actlink/',120,50);
            $_POST['picname'] = $img['picname'];
        }
        M('actlink')->create();
        if(M('actlink')->where($map)->save() > 0 ){
            $this->success('修改成功',U('index'));
        } else {
            $this->error('没有任何数据更新!',U('Actlink/edit?id='.$id));
        
        }
    }

    public function del()
    {
        if(empty($_GET['id'])){
            echo '<h1>404</h1>';
            exit;
        }
        $id = I('get.id/d');
        $map['id'] = $id;
        if (M('actlink')->where($map)->delete() > 0) {
            $this->success('删除成功!');
        } else {
            $this->error('删除失败!');
        }
        
    }

}