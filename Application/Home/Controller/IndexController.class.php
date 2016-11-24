<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends HomeController {

    public function index(){

        $actlink = M('actlink')->select();
        $hot = M('book')->field('id,bookname,price,picname')->order('click desc')->limit('12')->select();
        $new = M('book')->field('id,bookname,price,picname')->order('addtime desc')->limit('12')->select();
        $jindian = M('book')->field('id,bookname,price,picname')->order('self desc')->limit('12')->select();

        $model = new \Think\Model();
        $pressid = empty($_GET['pressid'])?1:$_GET['pressid'];
        $map[] = 'press_id = '.$pressid;

        $pressbook = M('book')->field('id,bookname,picname')->where($map)->limit('4')->select();
        // echo $model->getLastSql();die;
        // var_dump($press);


        $press = M('press')->select();
        $this->assign('press',$press);
        $this->assign('pressbook',$pressbook);
        $this->assign('content','首页');
        $this->assign('actlink',$actlink);
        $this->assign('hot',$hot);
        $this->assign('new',$new);
        $this->assign('jindian',$jindian);
        $user = $this->getUser_name(); //获取用户名
        $this->assign('user_name',$user['username']);
        $this->display();
    }

    public function search()
        {
            $queryString = I('post.queryString');
            // var_dump($queryString);exit;
            $map = [];
            $map['bookname'] = array('like','%'.$queryString.'%');

                $data = M('book')->where($map)->field('bookname,id')->limit(5)->select();
            if(!empty($data)){
                $type = 'b';
                // var_dump($data);exit;
                ajaxSearch($type,$data);
            }
        }

}