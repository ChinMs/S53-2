<?php
namespace Admin\Controller;
use Think\Controller;

class PublicController extends Controller
{
    //权限判断
    public function _initialize(){

        //判断session是否存在
        if(empty($_SESSION['username'])){
            //跳转到 登陆页
            $this->redirect("Login/login");
        }

        //V($_SESSION);

        //权限过滤
        $mname = CONTROLLER_NAME; //获取控制器名
        $aname = ACTION_NAME; //获取方法名

        // echo $mname.'/'.$aname;

        $nodelist = $_SESSION['admin_user']['nodelist']; //获取权限列表

        //V($_SESSION);
        //让超级管理员admin拥有所有权限
        if($_SESSION['username'] != 'admin'){
            //验证操作权限
            if(empty($nodelist[$mname]) || !in_array($aname,$nodelist[$mname])){
                
                $this->error("抱歉！没有操作权限！");
                exit;
            }

        }

    }


    public function verify()
    {
        $Verify = new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length = 1;
        $Verify->codeSet = '0123456789';
        $Verify->useNoise = false;
        $Verify->entry();
    }

    public function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['username'])){
            $this->redirect('Admin/Login/login');
            exit;
        }
    }


    public function __empty($obj)
    {
        echo '<h1>404 ERROR<h1>';
        die;
    }


    public function upload($path){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728000 ;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public/'; // 设置附件上传根目录
        $upload->subName = array();

        $upload->savePath = $path; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            return $info;
            // $this->success('上传成功！');
        }
    }

    /*
        $rootdir : 上传主目录
        $path: 上传子目录
    */
    public function insertImg($file,$rootdir='./Public/images/Admin/image',$path,$width=125,$height=165)
    {
        $dirname = $rootdir;
        // var_dump($dirname);var_dump($path);die;
        if(empty($file)){
            $this->error('请选择上传的文件');
        }else{
            $pic = $file['picname'];
            // var_dump($pic);
            // exit;
            $data= $this->upload($path);//调用upload函数,上传图片
            if(isset($data)){
                // var_dump($data);
                $image = new \Think\Image();
                $filename = $dirname.$data['picname']['savename'];
                $newfilename = $dirname.'s_'.$data['picname']['savename'];
                $data['picname']['savename'] = $data['picname']['savename'];
                $image->open("$filename");
                // 生成一个固定大小为150*150的缩略图并保存为thumb.jpg
                $image->thumb($width, $height,\Think\Image::IMAGE_THUMB_FIXED)->save("$newfilename");
                $img['picname'] = $data['picname']['savename'];
                if($_POST['oldpicname']) {
                    unlink($dirname.$_POST['oldpicname']);
                    unlink($dirname.'s_'.$_POST['oldpicname']);
                }
                return $img;
            }
        }
    }


    // 删除目录和目录下的文件
    protected function deldir($dir)
    {
        //先删除目录下的文件：
        $dh=opendir($dir);
        while ($file=readdir($dh)) {
          if($file!="." && $file!="..") {
            $fullpath=$dir."/".$file;
            if(!is_dir($fullpath)) {

                unlink($fullpath);
            } else {
                $this->deldir($fullpath);
            }
          }
        }
        
        closedir($dh);
        //删除当前文件夹：
        if(rmdir($dir)) {
          return true;
        } else {
          return false;
        }
    }
}



