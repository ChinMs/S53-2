<?php 
namespace Admin\Controller;
use Think\Controller;


class EmptyController extends Controller
{
       public function   _empty(){

                header( " HTTP/1.0  404  Not Found" );

                $this->display( 'Public:index' );

        }

}







