<?php 
namespace Admin\Controller;
use Think\Controller;
use Admin\Page;

/*
    书籍管理
    作者：华润
*/
class BooksController extends PublicController
{   
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
       
        $model=new \Think\Model();
        
        $p = empty($_GET['p'])?1:$_GET['p'];
        
        $list = M('type')->where('pid != 0')->select();
        
        $map[] = 'b.type_id=t.id';
        
        $data = $model->table('bk_book b,bk_type t')->where($map)->field('b.id,b.bookname,b.picname,b.state,b.addtime,t.name')->page($p.',5')->select();

        
        $count = $model->table('bk_book b,bk_type t')->where($map)->field('b.id,b.bookname,b.picname,b.state,b.addtime,t.name')->count();// 查询满足要求的总记录数
        
        $Page = $this->getPage($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        
        foreach($condition as $key=>$val) {
             $Page->parameter[$key] = $val;
        }
       
        $show = $Page->show();// 分页显示输出
        
        $this->assign('page',$show);// 赋值分页输出
       
        $this->assign('data',$data);
       
        $this->assign('list',$list);
       
        $this->display('Books/index');
    }



    // 加载添加界面
    public function add()
    {
        $map['pid'] = array('neq','0');
        $data = M('type')->where($map)->select();
        
        $author = M('author')->select();
        
        $press = M('press')->select();
        
        $this->assign('list',$data);
        
        $this->assign('author',$author);
        
        $this->assign('press',$press);
       
        $this->display();
    }

    //执行添加方法
    public function insert()
    {   

        $file['picname'] = $_FILES['picname'];
        // var_dump($_FILES);die;
        
        //上传图片同时获取缩略图
       $img = $this->insertImg($file,'./Public/images/Admin/Books/','images/Admin/Books/');
       
        $_POST['addtime'] = time();
        
        $_POST['picname'] = $img['picname'];

        //上传书本文件
        $info = $this->uploadbook();
        $bookname = $info['bookfile']['savename'];

        $_POST['bookfile'] = $bookname;
        
        //获取小说字数
        $book = $this->bookword($bookname);

        $_POST['wordnum'] = $book['wordnum'];
        $_POST['chapternum'] = $book['chapternum'];

        M('book')->create();

        $bid = M('book')->add();
        $this->fenzhang($bookname,$bid);
        if ( $bid > 0) {
            $this->success('添加成功',U('index'));
        } else {
            $this->error('添加失败');
        }

    }

    // 书籍上传方法 不要问我为啥又写一次
    public function uploadbook(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728000 ;// 设置附件上传大小
        $upload->exts = array('txt');// 设置附件上传类型
        $upload->rootPath = './Public/'; // 设置附件上传根目录
        $upload->subName = array();

        $upload->savePath = 'books/'; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            return $info;
            // $this->success('上传成功！');
        }
    }

    // 加载修改页面
    public function edit()
    {
        if(empty($_GET['id'])){
            echo '<h1>404</h1>';
            exit;
        }
        
        $id = I('get.id/d');
        
        $map['id'] = $id;
        
        $data = M('book')->where($map)->find();
        
        $this->assign('data',$data);
        
        $list = D('type')->getAdminCate();
       
        $author = M('author')->select();
        
        $press = M('press')->select();
        
        $this->assign('list',$list);
        
        $this->assign('author',$author);
       
        $this->assign('press',$press);
       
        $this->display();
    } 

    // 执行修改操作
    public function update()
    {
        if(empty($_POST['id'])){
            echo '<h1>404</h1>';
            exit;
        }
        $id = I('post.id/d');
       
        $map['id'] = $id;
        
        if($_FILES['picname']['error']!=4) {
            $img = $this->insertImg($_FILES,'./Public/images/Admin/Books/','images/Admin/Books/');
            $_POST['picname'] = $img['picname'];
        }
        
        $_POST['addtime'] = time();
        
        M('book')->create();
        
        if(M('book')->where($map)->save() > 0 ){
            $this->success('修改成功',U('index'));
        } else {
            $this->error('修改失败',U('Books/edit?id='.$id));
        
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
        $data = M('book')->where($map)->find();
        $_POST = $data;
        $time = time();
        $_POST['deltime'] = $time;
        M('recycle')->create();
        if (M('recycle')->add() > 0 && M('book')->where($map)->delete() > 0) {
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

    //小说每章内容的截取
    protected function _cut($begin,$end,$str)
    {
        $b = mb_strpos($str,$begin) + mb_strlen($begin);
        if($end==''){
                return strchr($str,$begin);
        }else{

            $e = mb_strpos($str,$end) - $b;
        }
        return mb_substr($str,$b,$e);
    }
    /*
        进行小说分章 
        $filename 要计算的文件名
        return $book 小说总章节和小说字数
    */
    protected function fenzhang($filename,$bid)
    {
        $zj = $this->zj($filename); //获取章节
        $count = count($zj); //获取章节数
        $s = file_get_contents("./Public/books/{$filename}");
        $s=mb_convert_encoding($s,"UTF-8","GBK");
        mkdir("./Public/books/{$bid}");
        // 循环通过
        for ($i=0; $i <$count; $i++) { 
            $a = $i+1;
            if($a==$count){

                $x[$zj[$i]] = $this->_cut($zj[$i],$zj[$a],$s);
            }else{
                $x[$zj[$i]] = $zj[$i]." \r\n".$this->_cut($zj[$i],$zj[$a],$s);
            }
            file_put_contents("./Public/books/{$bid}/{$a}.txt", $x[$zj[$i]]);//把分好的章节放入以id命名的文件夹中
            // var_dump("./Public/books/{$bid}/{$a}.txt");die;

        }
        // close($str); //关闭资源
        return $book;
    }

    //返回小说字数和章节数
    public function bookword($filename)
    {
        $str = file_get_contents("./Public/books/{$filename}");
        $str=mb_convert_encoding($str,"UTF-8","GBK");
        $wordnum = strlen($str);
        $book['wordnum'] = $wordnum;
        $zj = $this->zj($filename); //获取章节
        $book['chapternum'] = count($zj);
        return $book;
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


}











