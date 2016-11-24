<?php
return array(
	//'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',                  // 数据库类型
    'DB_HOST'               =>  '127.0.0.1',              // 服务器地址
    'DB_NAME'               =>  'book-24',                // 数据库名
    'DB_USER'               =>  'root',                   // 用户名
    'DB_PWD'                =>  '',                       // 密码
    'DB_PORT'               =>  '3306',                   // 端口
    'DB_PREFIX'             =>  'bk_',                    // 数据库表前缀

    'TMPL_L_DELIM'          =>  '<{',                     // 模板引擎普通标签开始标记
    'TMPL_R_DELIM'          =>  '}>',                     // 模板引擎普通标签结束标记

    'SHOW_PAGE_TRACE'       =>  true,                     // 显示页面trace信息

    
    'MAIL_SMTP'             =>  TRUE,                     // 配置邮件发送服务器
    'MAIL_HOST'             =>  'smtp.163.com',           //smtp服务器的名称
    'MAIL_SMTPAUTH'         =>  TRUE,                     //启用smtp认证
    'MAIL_USERNAME'         =>  'm15755627387@163.com',   //发件人的邮箱名
    'MAIL_PASSWORD'         =>  's1o2d3',                 //163邮箱发件人授权密码
    'MAIL_FROM'             =>  'm15755627387@163.com',   //发件人邮箱地址
    'MAIL_FROMNAME'         =>  '百度阅读',               //发件人姓名
    'MAIL_CHARSET'          =>  'utf-8',                  //设置邮件编码
    'MAIL_ISHTML'           =>  TRUE,                     // 是否HTML格式邮件
);