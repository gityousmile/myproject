<?php
/**
 * 
 * @authors	YANG DINGYUAN (yangdingyuan@itcast.cn)
 * @date    2016-05-21 10:31:37
 * @url 	http://dwz.cn/920815
 * @desc	请将此替换为文件描述...
 *
 */

//设置字符集
header('Content-Type:text/html;charset=utf-8');

//常量和变量都是先设置后访问，所以得写在include之前
//控制目录安全文件的开关
define('BUILD_DIR_SECURE', false);//默认为true，表示开启自动生成目录安全文件

//生产模式和调试模式的切换
define('APP_DEBUG',true);	//默认是false，表示关闭调试模式

//引入项目接口文件
include './ThinkPHP/ThinkPHP.php';
