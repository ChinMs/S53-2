<?php 
namespace Home\Controller;
use Think\Controller;
class DetailController extends HomeController
{
    public function index()
    {
        if(empty($_GET['id'])){
            $this->redirect('Index/index');
        }
        $id = I('get.id/d');

        $map['id'] = array('eq',$id);

        $data = M('book')->where($map)->find();//查询书本信息

        $data['click'] += 1;
        M('book')->where(array('id'=>$id))->save($data);

        $author = M('author')->where('id = '.$data['author_id'])->find();//作者信息

        $press = M('press')->where('id = '.$data['press_id'])->find(); //出版社

        $type = M('type')->where('id = '.$data['type_id'])->find(); //类型

        $ftype = M('type')->where('id = '.$type['pid'])->find(); //大类型

        $commentnum = M('discuss')->where('book_id = ' .$id)->where(array('state'=>array('neq',2)))->count(); //评论数

        if($commentnum!=0){
            $model = new \Think\Model();
            $map = [];
            $map[] = 'd.user_id = u.id';
            $map['book_id'] = ['eq',$id];
            $map['d.state'] = ['neq',2];
            $comment = $model->table('bk_discuss d,bk_user u')->field('u.username,u.picname,d.id,d.title,d.time,d.comment,d.likenum,d.replynum,d.user_id')->where($map)->select();
            // $commentnum = M('reply')->where('book_id = ' .$id.'and ')->count(); //回复数
            foreach ($comment as $key => $value) {
                
            $comment[$key]['reply'] = $model->table('bk_reply r,bk_user u')->field('r.id,r.content,u.username,r.replytime,r.user_id,u.picname')->where(array('r.discuss_id'=>$value['id']))->where('r.user_id=u.id')->where(array('r.state'=>array('neq',2)))->select(); //查询回复

            $comment[$key]['likestate'] = $model->table('bk_discuss d,bk_like l')->field('l.id')->where('d.id = l.discuss_id')->where(array('l.user_id'=>$_SESSION['user_id']))->where(array('l.discuss_id'=>$comment[$key]['id']))->find(); //判断用户是否点赞过这本书下的某一评论
            }


            // echo $model->getLastSql();
            // echo '<pre>';
            // print_r($comment);
            // die;
            
        }

        // var_dump($data);die;
        if (!empty($_SESSION['user_id'])) {

            $tj['book_id'] = ['eq',$data['id']];

            $tj['user_id'] = ['eq',$_SESSION['user_id']];
            
            //查找用户是否收藏了这本书
            $bookstate = M('bookshelf')->field('state')->where($tj)->find();
            
            $data['bookstate'] = $bookstate['state'];

            //查询用户是否评论了这本书

            $commentstate = M('discuss')->field('id')->where($tj)->find();
            if (!empty($commentstate)) {
                $data['commentstate'] = true;
            } else {
                $data['commentstate'] = false;
            }
        }

        // var_dump($comment);die;
        $data['people'] = rand(110,2323);

        $data['author'] = $author['name'];
        $data['press'] = $press['name'];
        $data['type'] = $type['name'];
        $data['ftype'] = $ftype['name'];
        $data['commentnum'] = $commentnum;
        $zj = $this->zj($data['bookfile']);
        // var_dump($zj);die;
        $this->assign('zj',$zj);
        $chapternum = count($zj);
        $this->assign('chapternum', $chapternum);
        $this->assign('data',$data);
        $user=$this->getUser_name();
        $this->assign('user_name',$user['username']);
        $this->assign('plimg',$user['picname']);
        $this->assign('comment',$comment);
        $this->display();
    }

    public function look()
    {   
        $id = I('get.id/d');

        $page = I('get.p/d');
        
        $map['id'] = array('eq',$id);
        
        $data = file_get_contents("./Public/books/{$id}/{$page}.txt");
        $this->assign('data',$data);
        $this->assign('id',$id);
        $this->assign('page',$page);
        $this->assign('chapternum',$chapternum);
        $this->display('Detail/look');
    }


    // 获取小说所有章节
    public function zj($filename)
    {
        $str = fopen("./Public/books/{$filename}",'r');
        // 存放章节名称的数组
        $zj=[];
        while ($hangdata = fgets($str)) {
                $hangdata=mb_convert_encoding($hangdata,"UTF-8","GBK");
            if (preg_match("/(\x{7B2C}[^\x{7AE0}]+\x{7AE0}[\s\S]*?(?:(?=\x{7B2C}[^\x{7AE0}]+\x{7AE0})|$))/u",$hangdata,$matches)) {
                $zj[] = $matches[0];
            }
        }
        return $zj; //返回存放章节的数组
    }

    public function xiazai()
    {
        $a=new \Org\Net\Http();
        $time = date('Y-m-d H:i:s',time());
        $showname = $time.rand(1000,9999).'.txt';
        if(empty($_GET['id'])){
            $this->error('下载失败!');
            exit;
        }
        $map['id'] = ['eq',I('get.id/d')];
        $bookfile = M('book')->field('bookfile')->where($map)->find();
        $file = file_get_contents('./Public/books/'.$bookfile['bookfile']);
        // var_dump($file);die;
        $a->download("http://127.0.0.1/book11-15/Public/books/{$bookfile}", $showname, $file); 
    }

    public function collection()
    {
        I('get.bookid/d');
        // var_dump($book_id);die;
        if (empty($_SESSION['user_id'])) {
            echo 'alert("请先登录")';
            exit;
        }
        $_POST['book_id'] = $_GET['bookid'];
        $_POST['user_id'] = $_SESSION['user_id'];

        $map['user_id'] = $_POST['user_id'];
        $map['book_id'] = $_POST['book_id'];

        $data = M('bookshelf')->where($map)->select();
        $_POST['state'] = 0;
        if (empty($data)) {            
            M('bookshelf')->create();
            M('bookshelf')->add();
        } else{
            M('bookshelf')->create();
            M('bookshelf')->where($map)->save();
        }


        // echo M('bookshelf')->getLastSql();
        // die;
        // $a = json_encode($_GET);
        // echo $a;
    }

    // 生成验证码
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
    public function getYzm()
    {
        $Verify = new \Think\Verify();
        $info = $Verify->check($_GET['yzm1']);
        echo $info;
    }

    // 提交评论
    public function comment()
    {
        if (empty($_POST['book_id'])) {
            $this->error('评论失败!');
            exit;
        }
        // var_dump($_POST);die;
        $_POST['user_id'] = $_SESSION['user_id'];
        $_POST['time'] = time();
        M('discuss')->create();
        if (M('discuss')->add() > 0) {
            echo '<script>self.location=document.referrer;</script>';
        } else {
            $this->error('评论失败!');
        }
        

    }

    // 提交回复
    public function reply()
    {
        // var_dump($_POST);
        $_POST['replytime'] = time();
        $_POST['user_id'] = $_SESSION['user_id'];
        $replynum = M('discuss')->field('replynum')->where('id='.$_POST['discuss_id'])->find();
        $replynum =$replynum['replynum']+1;
        $data['replynum']=$replynum;
        M('discuss')->where('id='.$_POST['discuss_id'])->save($data);
        M('reply')->create();
        if (M('reply')->add() > 0) {
            echo '<script>self.location=document.referrer;</script>';
        } else {
            $this->error('回复失败!');
        }
    }


    //响应点赞请求
    public function like()
    {
        $_POST['book_id'] = I('post.book_id/d');
        $_POST['user_id'] = I('post.user_id/d');
        $discuss_id = I('post.discuss_id/d');
        $likenum = M('discuss')->field('likenum')->where('id='.$discuss_id)->find();
        $likenum =$likenum['likenum']+1;
        $data['likenum']=$likenum;
        M('discuss')->where('id='.$discuss_id)->save($data);
        M('like')->create();

        M('like')->add();
        
        echo $likenum;

    }

    //删除/隐藏评论
    public function deldiscuss()
    {
        if (empty($_GET['discuss_id'])) {
            $this->error('删除失败!');
            exit;
        }

        $id = I('get.discuss_id/d');

        $map['id'] = $id;
        // $replynum = M('discuss')->field('replynum')->where($map)->find();
        // $replynum =$replynum['replynum']+1;
        // $data['replynum']=$replynum;
        $data['state'] = 2;
        if (M('discuss')->where($map)->save($data) > 0) {
            $this->success('删除成功!');
        } else {
            $this->error('删除失败');
        }
        

    }

    // 删除回复
    public function delreply()
    {
        if (empty($_GET['reply_id'])) {
            $this->error('删除失败!');
            exit;
        }

        $reply_id = I('get.reply_id/d');
        $discuss_id = I('get.discuss_id/d');

        $map['id'] = $discuss_id;
        $replynum = M('discuss')->field('replynum')->where($map)->find();
        $replynum =$replynum['replynum']-1;
        $data['replynum']=$replynum;

        $nap['id'] = $reply_id;
        $bate['state'] = 2;
        if ( M('discuss')->where($map)->save($data) > 0 && M('reply')->where($nap)->save($bate) > 0 ) {
            $this->success('删除成功!');
        } else {
            
            $this->error('删除失败');
        }
    }
}


