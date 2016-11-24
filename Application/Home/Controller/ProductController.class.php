<?php
namespace Home\Controller;
use Think\Controller;
use Home\Page;
class ProductController extends HomeController {



    public function index()
    {
        $category = D('Type');
        $list = $category->getAdminCate();
        $data = $this->getTreeCate($list);
        $this->assign('data',$data);
        $user = $this->getUser_name(); //获取用户名
        $this->assign('user_name',$user['username']);
        $model = new \Think\Model();
        $map[] = 'b.author_id=a.id';

        $order = empty($_GET['condition'])?'id':$_GET['condition'];
        if ($order =='price' || $order =='id') {
            $desc = '';
        }else{
            $desc = ' desc';
        }

        $p = empty($_GET['p'])?1:$_GET['p'];

        $book = $model->table('bk_book b,bk_author a')->field('b.id,b.bookname,b.picname,b.price,b.click,a.name')->where($map)->order($order.$desc)->page($p.',10')->select();
        $this->assign('book',$book);

        $count = $model->table('bk_book b,bk_author a')->field('b.id,b.bookname,b.picname,b.price,b.click,a.name')->where($map)->order('b.click desc')->count();// 查询满足要求的总记录数
        
        $Page = getPage($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        
        foreach($condition as $key=>$val) {
             $Page->parameter[$key] = $val;
        }
        // var_dump($Page);die;
        $url =  CONTROLLER_NAME.'/'.ACTION_NAME;    
        
        $this->assign('url',$url);

        // var_dump($url);
        $show = $Page->show();// 分页显示输出
        
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('condition',$order);
        $this->display();

        
    }

    public function product()
    {
        $model = new \Think\Model();
        //实例化
        $category = D('Type');

        $order = empty($_GET['condition'])?'id':$_GET['condition'];
        
        if ($order =='price' || $order == 'id') {
            $desc = '';
        }else{
            $desc = ' desc';
        }
        $this->assign('condition',$order);


        //获取分类信息
        $typeid = I('get.typeid/d');
        $p = empty($_GET['p'])?1:$_GET['p'];
        $type = M('type')->where(array('id'=>$typeid))->find();
        $pid = $type['pid'];
        if($pid==0){
            $id = $typeid;
            $data = $category->getAdminCate($id);
            $ftypename = $type['name'];
            $this->assign('ftypename',$ftypename);
            $book = $model->table('bk_book b,bk_type t,bk_author a')->field('b.id,b.bookname,b.picname,b.price,b.click,a.name')->where(array('t.pid'=>$typeid))->where('t.id=b.type_id')->where(array('b.author_id=a.id'))->order($order.$desc)->page($p.',10')->select();
            $state = 1;
            $count = $model->table('bk_book b,bk_type t,bk_author a')->field('b.id,b.bookname,b.picname,b.price,b.click,a.name')->where(array('t.pid'=>$typeid))->where('t.id=b.type_id')->where(array('b.author_id=a.id'))->count();// 查询满足要求的总记录数
        } else{
            $ftype = M('type')->where(array('id'=>$pid))->find();
            $ftypename = $ftype['name'];
            $id = $ftype['id'];
            $data = $category->getAdminCate($id);
            $book = $model->table('bk_book b,bk_author a')->field('b.id,b.bookname,b.picname,b.price,b.click,a.name')->where(array('b.type_id'=>$typeid))->where('b.author_id=a.id')->order($order.$desc)->page($p.',10')->select();
            $state = 2;
           $count = $model->table('bk_book b,bk_author a')->field('b.id,b.bookname,b.picname,b.price,b.click,a.name')->where(array('b.type_id'=>$typeid))->where('b.author_id=a.id')->count();// 查询满足要求的总记录数            
           $this->assign('ftypename',$ftypename);
           $this->assign('sonname',$type['name']);

        }

        
        $url =  CONTROLLER_NAME.'/'.ACTION_NAME;    
        
        $this->assign('url',$url);

        // var_dump($url);
        $Page = getPage($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        
        foreach($condition as $key=>$val) {
             $Page->parameter[$key] = $val;
        }
        // var_dump($Page);die;
        $show = $Page->show();// 分页显示输出
        
        $this->assign('page',$show);// 赋值分页输出



        $this->assign('data',$data);
        $this->assign('typeid',$typeid);
        $user = $this->getUser_name(); //获取用户名
        $this->assign('user_name',$user['username']);
        $this->assign('book',$book);
        $this->assign('state',$state);
        $this->display('Product/index');
    }








    /**
     * [menu 处理返回多维分类数组,用于前台导航显示]
     * @param  [type] $cate [结果集]
     * @param  [type] $pid  [当前分类的id]
     * @param  [str] $name  [子类的索引名]
     * @return [type]       [description]
     */
    private function getTreeCate($cate,$pid=0,$name="child"){
          $arr = array();
          //遍历
          foreach($cate as $v){
            if($v['pid'] == $pid){
                $v[$name] = $this->getTreeCate($cate,$v['id']);
                $arr[] = $v;
            }
          }
          return $arr;
    }

}