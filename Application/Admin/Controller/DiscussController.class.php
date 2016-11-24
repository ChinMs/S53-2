<?php 
namespace Admin\Controller;
use Think\Controller;

class DiscussController extends PublicController
{
    
	 //初始化操作
        public function _initialize(){
            parent::_initialize();
            $this->_model = D('Discuss');
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

    public function index()
    {   
        $model=new \Think\Model();
        $p = empty($_GET['p'])?1:$_GET['p'];
        // $list = M('Discuss')->select();
        $map[] = 'u.id=d.user_id and d.book_id=b.id  ';
        $data = $model->table('bk_discuss d,bk_book b,bk_user u')->where($map)->field('d.id,d.book_id,d.title,d.time,d.comment,d.state,d.likenum,d.replynum,b.bookname,u.username')->page($p.',5')->select();


        $count = $model->table('bk_discuss d,bk_book b,bk_user u')->where($map)->field('d.id,d.title,d.time,d.comment,d.state,d.likenum,d.replynum,b.bookname,u.username')->count();// 查询满足要求的总记录数
        $Page = $this->getPage($count,5);// 实例化分页类 传入总记录数和每页显示的记录数

        foreach($condition as $key=>$val) {
             $Page->parameter[$key] = $val;
        }

        // var_dump($data);die;
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('data',$data);
        $this->assign('list',$list);
        $this->display('Discuss/index');
    }


    // 加载修改页面
    public function edit()
    {
        if(empty($_GET['id'])){
            header( " HTTP/1.0  404  Not Found" );
            $this->display( 'Public:index' );
            exit;
        }

        $id = I('get.id/d');
        // var_dump($id);exit;

        $data = M('Discuss')->find($id);
        if($data['state']==1){
            $_POST['state']=2;
            $_POST['id']=$id;
            M('discuss')->create();
        if (M('discuss')->save() > 0) {
           $this->success('隐藏成功', U('index'));
        } else {
           $this->error('隐藏失败....');
        }
        }else{
            $_POST['state']=1;
            $_POST['id']=$id;
            M('discuss')->create();
        if (M('discuss')->save() > 0) {
           $this->success('显示成功', U('index'));
        } else {
           $this->error('显示失败');
        }
        }

    } 


    public function look()
    {
        if(empty($_GET['id'])){
            header( " HTTP/1.0  404  Not Found" );
            $this->display( 'Public:index' );
            exit;
        }
      $model=new \Think\Model();
      $id = I('get.id/d');
      $map[] = 'u.id=d.user_id and d.book_id=b.id  ';
      $map['d.id'] = ['eq',$id];
      $data = $model->table('bk_discuss d,bk_book b,bk_user u')->where($map)->field('d.id,d.book_id,d.title,d.time,d.comment,d.state,d.likenum,d.replynum,b.bookname,u.username')->find();

      $reply = $model->table('bk_reply r,bk_user u')->field('r.id,r.content,u.username,r.replytime,r.user_id,r.state,u.picname')->where(array('r.discuss_id'=>$id))->where('r.user_id=u.id')->select(); //查询回复
        // var_dump($reply);die;
      $this->assign('vo',$data);
      $this->assign('reply',$reply);
      $this->display();

    }


    public function editreply()
    {
        if(empty($_GET['id'])){
            header( " HTTP/1.0  404  Not Found" );
            $this->display( 'Public:index' );
            exit;
        }

        $id = I('get.id/d');
        // var_dump($id);exit;

        $data = M('reply')->find($id);
        $bata = M('discuss')->find($data['discuss_id']);
        // var_dump($bata);die;
        if($data['state']==1){
            $_POST['state']=2;
            $_POST['id']=$id;
            M('reply')->create();
            $map['replynum'] = $bata['replynum']-1;
            M('discuss')->create();
        if (M('reply')->save() > 0 && M('discuss')->where('id = '.$bata['id'])->save($map) > 0) {
           $this->success('隐藏成功', U('index'));
        } else {
           $this->error('隐藏失败....');
        }
        }else{
            $_POST['state']=1;
            $_POST['id']=$id;
            M('reply')->create();
            $map['replynum'] = $bata['replynum']+1;
        if (M('reply')->save() > 0 && M('discuss')->where('id = '.$bata['id'])->save($map) > 0) {
           $this->success('显示成功', U('index'));
        } else {
           $this->error('显示失败');
        }
        }

    }
}
