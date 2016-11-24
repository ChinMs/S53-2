<?php
namespace Home\Controller;
use Think\Controller;

class MybookController extends HomeController
{
    public function index()
    {
        $this->display();
    }

    public function search()
    {
        if (empty($_POST)) {
            $this->redirect('Mybook/mybook');
            exit;
        }
        $bookname = I('post.param1');
        // var_dump($bookname);
        $where['bookname'] = array('like' ,'%'.$bookname.'%');
        $data = M('book')->where($where)
                      ->getField('id ,bookname',7);
      if ($data) {
        $this->ajaxReturn($data);
      }
    }

    public function searchBook()
    {
        if (empty($_POST)) {
        $this->redirect('Mybook/mybook');
        exit;
        }
        $id = I('post.id/d');
        if ($id || $id == 0) {
            /*
            * where $map[]
            * table book type author press
            * field 
            */
            $map[] = 'b.type_id = t.id';
            $map[] = 'b.author_id = a.id';
            $map[] = 'b.press_id = p.id';
            $map[] = "b.id = $id";
            $list = M('book')->table('bk_book as b,bk_type as t,bk_author as a,bk_press as p')
                            ->field('b.id,b.bookname,b.descr,b.price,b.state,t.name as tname,a.name as aname,p.name as pname')
                            ->where($map)
                            ->select();
            // echo M('book')->getLastSql();
            var_dump($list);
            if ($list) {    
                $this->assign('list',$list);
                $this->display('Mybook/mybook');
            } else {
                // $this->assign('error','没有该书');
                $this->display('Mybook/mybook');
            }
        }
        
        if (empty($id)) {
            
        }

    }
    /*
    *   书架中所有的书籍
     */
    public function bookShelf()
    {
        if (empty($_GET)) {
            $this->redirect('Mybook/mybook');
            exit;
        }
        // 用户名下收藏的书籍
        $userid = I('get.id/d');
        $book = M('bookshelf');
        $map[] = 'bs.book_id = bb.id';
        $map[] = "bs.user_id =  $userid";

        // 用户名下书籍的总数
        $count = $book->table('bk_bookshelf as bs,bk_book as bb')
                        ->field('bb.id,bb.bookname,bb.picname,bs.state')
                        ->where($map)
                        ->count();
        // 用户名下已购买的书籍的总数
        $purchased['user_id'] = array('eq', $userid);
        $purchased['state'] = array('eq', '1');
        $count_purchased = $book->where($purchased)
                                ->count();
        // 用户名下已收藏的书籍的总数
        $collected['user_id'] = array('eq', $userid);
        $collected['state'] = array('eq', '0');
        $count_collected = $book->where($collected)
                                ->count();

        // 实例化pagel类
        $Page = new \Think\Page($count, 15);
        $result = $book->table('bk_bookshelf as bs,bk_book as bb')
                      ->field('bb.id,bb.bookname,bb.picname,bs.state')
                      ->where($map)
                      ->order('id desc')
                      ->limit($Page->firstRow.','.$Page->listRows)
                      ->select();
        // 用户的信息
        $user = M('user');
        $list = $user->find($userid);
        // 分页显示输出
        $show = $Page->show();
        // 输出到前台模板上
        $array['books'] = $result;
        $array['count'] = $count;
        $array['purchased'] = $count_purchased;
        $array['collected'] = $count_collected;
        $array['picname'] = $list['picname'];
        $array['page'] = $show;
        if ($result) {
            $this->assign($array);
            $this->display('Mybook/mybook');
        } else {
            $this->assign($array);
            $this->display('Mybook/mybook');
        }
    }
    /*
    *   书架中所有的购买的书籍
     */
    public function purchased()
    {
        if (empty($_GET)) {
            $this->redirect('Mybook/mybook');
            exit;
        }
        // 用户名下收藏的书籍
        $userid = I('get.id/d');
        $book = M('bookshelf');

        // 用户名下已购买的书籍的总数
        $purchased['user_id'] = array('eq', $userid);
        $purchased['state'] = array('eq', '1');
        $count_purchased = $book->where($purchased)
                                ->count();
       
        // 用户名下书籍的总数
        $map['user_id'] = array('eq', $userid);
        $count = $book->where($map)
                        ->count();

        // 用户名下已收藏的书籍的总数
        $collected['user_id'] = array('eq', $userid);
        $collected['state'] = array('eq', '0');
        $count_collected = $book->where($collected)
                                ->count();

        // 实例化pagel类
        $Page = new \Think\Page($count_purchased, 15);
        $buy[] = 'bs.book_id = bb.id';
        $buy[] = "bs.user_id =  $userid";
        $buy[] = 'bs.state = 1';
        $result = $book->table('bk_bookshelf as bs,bk_book as bb')
                      ->field('bb.id,bb.bookname,bb.picname,bs.state')
                      ->where($buy)
                      ->order('id desc')
                      ->limit($Page->firstRow.','.$Page->listRows)
                      ->select();
        // 用户头像信息
        $user = M('user');
        $list = $user->find($userid);

        // 分页显示输出
        $show = $Page->show();
        $array['books'] = $result;
        $array['page'] = $show;
        $array['count'] = $count;
        $array['picname'] = $list['picname'];
        $array['purchased'] = $count_purchased;
        $array['collected'] = $count_collected;

        if ($result) {
            $this->assign($array);
            $this->display('Mybook/purchased');
        } else {
            $this->assign($array);
            $this->display('Mybook/purchased');
        }
    }
    /*
    *   书架中所有的收藏的书籍
     */
    public function collected()
    {
        if (empty($_GET)) {
            $this->redirect('Mybook/mybook');
            exit;
        }
        // 用户名下收藏的书籍
        $userid = I('get.id/d');
        $book = M('bookshelf');

        // 用户名下已购买的书籍的总数
        $purchased['user_id'] = array('eq', $userid);
        $purchased['state'] = array('eq', '1');
        $count_purchased = $book->where($purchased)
                                ->count();
        // var_dump($count_purchased);
        
        // 用户名下书籍的总数
        $map['user_id'] = array('eq', $userid);
        $count = $book->where($map)
                        ->count();

        // 用户名下已收藏的书籍的总数
        $collected['user_id'] = array('eq', $userid);
        $collected['state'] = array('eq', '0');
        $count_collected = $book->where($collected)
                                ->count();

        // 实例化pagel类
        $Page = new \Think\Page($count_collected, 15);
        $buy[] = 'bs.book_id = bb.id';
        $buy[] = "bs.user_id =  $userid";
        $buy[] = "bs.state = '0'";
        $result = $book->table('bk_bookshelf as bs,bk_book as bb')
                      ->field('bb.id,bb.bookname,bb.picname,bs.state')
                      ->where($buy)
                      ->order('id desc')
                      ->limit($Page->firstRow.','.$Page->listRows)
                      ->select();

        // 用户头像信息
        $user = M('user');
        $list = $user->find($userid);

        // 分页显示输出
        $array['books'] = $result;
        $array['page'] = $show;
        $array['count'] = $count;
        $array['picname'] = $list['picname'];
        $array['purchased'] = $count_purchased;
        $array['collected'] = $count_collected;
        $show = $Page->show();
        if ($result) {
            $this->assign($array);
            $this->display('Mybook/collected');
        } else {
            $this->assign('books', $result);
            $this->display('Mybook/collected');
        }
    }

    public function delShelf()
    {
        // var_dump($_GET['id']);
        if (empty($_GET['book_id'])) {
            $this->redirect('Mybook/mybook');
            exit;
        }
        $userid = I('get.user_id/d');
        $bookid = I('get.book_id/d');
        $book = M('bookshelf');
        $where['user_id'] = array('eq',$userid);
        $where['book_id'] = array('eq',$bookid);
        $result = $book->where($where)
                        ->delete();
        if ($result) {
            $this->success('删谁成功');
        } else {
            $this->error('删除失败');
        }
    }

    public function infoSelf()
    {
        if (IS_GET) {
            $id = I('get.id/d');
            // var_dump($id);
            $map['id'] = array('eq', $id);
            $data = M('user')->where($map)->select();
            // var_dump($data);
            $this->assign('picname', $data['0']['picname']);
            $this->assign('infomation',$data);
            $this->display('Mybook/infoself');
        }
    }

     public function message()
    {   
        $phone = I('post.param1');
        // var_dump($phone);

        $accountSid= '8aaf0708582eefe90158419557d40b97';
        $accountToken= '481cb24ba9f64619ae9b2cb87f66af03';
        $appId='8aaf0708582eefe90158419559eb0b9e';
        $serverIP='app.cloopen.com';
        $serverPort='8883';
        $softVersion='2013-12-26';

        vendor('Message.Send');

        $uc = new \Send($serverIP,$serverPort,$softVersion); //实例化对象
        $uc->setAccount($accountSid,$accountToken);
        $uc->setAppId($appId);

        $rand = rand(1000,9999);

        $result = $uc->sendTemplateSMS("$phone",array($rand,'3'),"1");
        if($result == NULL ) {
            // break;
        }
        if($result->statusCode!=0) {
            
        }else{
            $this->ajaxReturn($rand);
            //TODO 添加成功处理逻辑
        }
    }

    public function addPhone()
    {   
        if (empty($_POST)) {
            $this->redirect('Mybook/infoself');
            exit;
        }

        $id = I('post.id/d');
        $phone = I('post.phone');
        $yzm = I('post.yzm');
        $reyzm = I('post.reyzm');
        // var_dump($id);
        // var_dump($phone);
        // var_dump($yzm);
        // var_dump($reyzm);
        // $this->display('Mybook/infoself');
        if ($yzm == $reyzm) {
            $user = M('user');
            $map['id'] = array('eq' ,$id);
            $result = $user->where($map)
                ->setField('phone',$phone);
            if ($result) {
                $this->success('绑定成功');
            }else{
                $this->error();
            }
        }
    }

    public function changed()
    {
        if (empty($_POST)) {
            $this->redirect('Mybook/infoself');
            exit;
        }

        $username = I('post.username');
        $name = I('post.name');
        $email = I('post.email');
        $sex = I('post.sex');
        $id = I('post.id/d');
        $pwd = I('post.password');

        $map['id'] = array('eq', $id);
        
        $data['username'] = $username;
        $data['name'] = $name;
        $data['sex'] = $sex;
        $data['email'] = $email;

        $user = M('user');
        $result = $user->where($map)
                        ->setField($data);
        if ($result) {
            $this->success('修改成功!');
        } else {
            $this->error('修改失败!');
        }
    }

    public function upload()
    {
        $upload = new \Think\Upload();// 实例化上传类

        $upload->maxSize = 3145728 ;// 设置附件上传大小

        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

        $upload->rootPath = './Public/'; // 设置附件上传根目录

        $upload->savePath = './images/user_img/'; // 设置附件上传（子）目录

        $upload->subName = array(); // 关闭使用系统时间命名创建子文件夹

        // 上传文件
        $info = $upload->upload();
        // var_dump($info);die;
        if(!$info) {
            // 上传错误提示错误信息
            $this->error($upload->getError());
        }else{
            $id['id'] = array('eq', I('get.id/d')); // 获取用户id
            $user = M('user')->where($id)->select(); // 查询用户数据
            $path = $info['picname']['savename'];  // 文件名称
            // 判断有误数据
            if (empty($user['0']['picname'])) {
                M('user')->where($id)->setField('picname', $path);
            } else {
                unlink('./Public/'.$info['picname']['savepath'].$user['0']['picname']);
                M('user')->where($id)->setField('picname', $path);
            }

            // 上传成功
            $this->success('上传成功！');
        }
    }

}
?>