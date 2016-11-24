<?php
namespace Home\Controller;
use Think\Controller;

class CarController extends Controller
{
    public function index()
    {
        $this->display();
    }

    public function car()
    {
        if (empty($_SESSION['user_id'])) {
            $this->display('Login/login');
            exit;
        }

        $userid = $_SESSION['user_id'];

        $shopcart = M('shopcart');
        $map[] = "bc.user_id = bu.id";
        $map[] = "bc.book_id = bb.id";
        $map[] = "bb.author_id = ba.id";
        $map[] = "bc.user_id = 1";
        $goods = $shopcart->table('bk_user as bu, bk_shopcart as bc, bk_book as bb, bk_author as ba')
                            ->field('bc.id, bb.id as bookid, ba.name as author_name, bu.username, bb.bookname, bb.price, bb.picname')
                            ->order('id desc')
                            ->where($map)
                            ->select();
        // echo M('shopcart')->getLastSql();
        if ($goods) {
            $this->assign('list', $goods);
            $this->display();
        } else {
            $this->assign('list', $goods);
            $this->display();
        }
    }

    // 删除一组数据
    public function delgoods()
    {
        if (empty($_POST)) {
            $this->redirect('Car/car');
            exit;
        }
        $id = I('post.param');

        foreach ($id as $value) {
            M('shopcart')->delete($value);
        }
        // var_dump($id);
        $this->ajaxReturn($id);
        $this->display('Car/car');
    }

    // 删除一个数据
    public function solodel()
    {
        if (empty($_POST)) {
            $this->redirect('Car/car');
            exit;
        }
        $id = I('post.soloid/d');

        $result = M('shopcart')->delete($id);
        if ($result) {
            $this->ajaxReturn($id);
            $this->display('Car/car');
        }
    }

    // 提交表单
    public function paying()
    {
        if (empty($_POST)) {
            $this->redirect('Car/car');
            exit;
        }
        $userid = 1; // 这使用的是session的值
        $bookid = I('post.id');
        $bookname = I('post.bookname');
        $price = I('post.price');
        $total = I('post.total/d');
        $money = I('post.money/d');
        $buytime = time();

        $order = array(
            'user_id' => $userid,
            'buytime' => $buytime,
            'total'   => $total,
            'money'   => $money
            );

        $order_id = M('orders')->add($order);
        
        $array = []; // 定义一个容器数组
        foreach ($bookid as $key => $value) {
            $array[$key]['order_id'] = $order_id;
            $array[$key]['book_id'] = $bookid[$key];
            $array[$key]['book_name'] = $bookname[$key];
            $array[$key]['price'] = $price[$key];
        }

        if (!empty($order_id)) {
            $result = M('detail')->addAll($array);
            if (!empty($result)) {
                foreach ($bookid as $k => $v) {
                    $where[$k]['user_id'] = $userid;
                    $where[$k]['book_id'] = $v;
                    $res = M('shopcart')->where($where[$k])->delete();
                }
                if ($res>0) {
                    $this->display('Car/car');
                }
            }
        }
    }
}

?>