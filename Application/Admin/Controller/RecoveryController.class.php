<?php 
namespace Admin\Controller;
use Think\Controller;
use Admin\Page;

/*
    书籍管理
    作者：华润
*/
class RecoveryController extends PublicController
{
    public function index($map='')
    {   
       
        $model=new \Think\Model();
        
        $p = empty($_GET['p'])?1:$_GET['p'];
       
        $list = M('type')->where('pid != 0')->select();
        
        $map[] = 'r.type_id=t.id';
        
        $data = $model->table('bk_recycle r,bk_type t')->where($map)->field('r.id,r.bookname,r.picname,r.state,r.addtime,t.name')->page($p.',5')->select();

        
        $count = $model->table('bk_recycle r,bk_type t')->where($map)->field('r.id,r.bookname,r.picname,r.state,r.addtime,t.name')->count();// 查询满足要求的总记录数
        
        $Page = $this->getPage($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        
        foreach($condition as $key=>$val) {
             $Page->parameter[$key] = $val;
        }
       
        $show = $Page->show();// 分页显示输出
        
        $this->assign('page',$show);// 赋值分页输出
       
        $this->assign('data',$data);
       
        $this->assign('list',$list);
       
        $this->display('Recovery/index');
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

    // 还原到book中
    public function back()
    {
        if(empty($_GET['id'])){
            echo '<h1>404</h1>';
            exit;
        }
        $id = I('get.id/d');
        $map['id'] = $id;
        $data = M('recycle')->where($map)->find();
        $_POST =$data;
        M('book')->create();
        if (M('book')->add() > 0 && M('recycle')->where($map)->delete()) {
            $this->success('还原成功!');
        } else {
            $this->error('还原失败!');
        }
    }

    // 执行删除操作

    public function del()
    {
        if(empty($_GET['id'])){
            echo '<h1>404</h1>';
            exit;
        }
        $id = I('get.id/d');
        $map['id'] = $id;
        $data = M('recycle')->field('picname,bookfile')->where($map)->find();
        unlink('./Public/images/Admin/Books/'.$data['picname']);
        unlink('./Public/images/Admin/Books/s_'.$data['picname']);
        unlink('./Public/books/'.$data['bookfile']);
        $this->deldir("./Public/books/$id");
        if (M('recycle')->delete($id) >0) {
            $this->success('删除成功!');
        } else {
            $this->error('删除失败!');
        }
    }

    //搜索分页
    public function search()
    {

        $tid = I('get.type_id/d');
        if(!empty($_GET['type_id'])){

            $map['type_id'] = array('eq',$tid);
        }
        if(!empty($_GET['bookname'])){
            $map['bookname'] = array('LIKE',"%{$_GET['bookname']}%");
        }

        $this->index($map);
    }


}