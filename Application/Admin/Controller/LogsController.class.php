<?php
namespace Admin\Controller;
use Think\Controller;
session_start();
class LogsController extends PublicController 
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
    public function index()
    {   
        $model = new \Think\Model();
        $p = empty($_GET['p'])?1:$_GET['p'];
        $map[] = 'l.user_id=u.id';
        $data = $model->table('bk_log l,bk_user u')->where($map)->field('l.id,l.ip,l.time,l.browser,l.city,u.username')->page($p.',5')->select();
        $count = $model->table('bk_log l,bk_user u')->where($map)->field('l.id,l.ip,l.time,l.browser,l.city,u.username')->count();
        $Page = $this->getPage($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        
        foreach($condition as $key=>$val) {
             $Page->parameter[$key] = $val;
        }
       
        $show = $Page->show();// 分页显示输出
        
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('data',$data);
        $this->display();
    
    }
    



    // 执行删除方法
    public function del()
    {
        if(empty($_GET['id'])){
            $this->error('出错啦啦啦');
        }
        $id = I('get.id/d');
        $map['id'] = $id;
        if (M('log')->where($map)->delete() > 0 ) {
            $this->success('删除成功!');
        } else {
            $this->error('删除失败!');
        }
        
    }

}