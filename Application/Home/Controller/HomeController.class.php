<?php 
namespace Home\Controller;
use \Think\Controller;

class HomeController extends Controller
{
    public function _empty($name)
    {
        echo '<h1>404</h1>';
    }

    public function _initialize()
    {

        $ipdz = get_client_ip();
        $Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
        $area = $Ip->getlocation("$ipdz"); // 获取某个IP地址所在的位置
        $city = $area['country'];

        // var_dump($ipdz);
        $city = ($city=='IANA保留地址'|| $city=='局域网')?'上海':$city;
        // var_dump($city);
        //获取用户当前地区天气
        // $city = I('post.city', "$city");


        $url = 'http://api.map.baidu.com/telematics/v3/weather?location='.$city.'&output=json&ak=vqMyoRRwVgEq3tU1Wr6i0ij5';

        $api = new \Common\Util\ResultApi();
        $data = $api->getApiData($url, 'json');
        
        $weather = $data->results[0]->weather_data[0]->weather;
        $currentCity = $data->results[0]->currentCity;
        $temperature = $data->results[0]->weather_data[0]->temperature;
        $dayPictureUrl = $data->results[0]->weather_data[0]->dayPictureUrl;
        $nightPictureUrl = $data->results[0]->weather_data[0]->nightPictureUrl;

        $this->assign('weather', $weather);
        $this->assign('currentCity', $currentCity);
        $this->assign('temperature', $temperature);
        $this->assign('dayPictureUrl', $dayPictureUrl);
        $this->assign('nightPictureUrl', $nightPictureUrl);
    }

    public function getUser_name()
    {
        $id = $_SESSION['user_id'];
        $map['id'] = ['eq',$id];
        $user = M('user')->field('picname,username')->where($map)->find();
        return $user;
    }
}