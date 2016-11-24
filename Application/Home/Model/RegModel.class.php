<?php 
	namespace Home\Model;
	use Think\Model;
	class UserModel extends Model{
		//自动完成
		protected $_auto = array ( 
		    array('password','md5',3,'function'),  
		);

		//自动验证
		protected $_validate = array(
		  array('username','require','用户名不能为空',0,'regex',1), 
		  array('username','','帐号名称已经存在！',0,'unique',1), 

		   
		  array('password','/^\w{3,12}$/','密码必须是3-12位的shuzi、字母、下划线',0,'regex',1), 
		  array('repassword','password','确认密码不正确',0,'confirm',1), // 验证确认密码是否和密码一致
		);
				
				
	}