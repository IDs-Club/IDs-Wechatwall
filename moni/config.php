<?php

// 全局配置

$G_ROOT = dirname(__FILE__);
$G_CONFIG["weiXin"] = array(
	'account' => 'XXXXXXXXX@qq.com',  //微信帐号密码
	'password' => 'XXXXXXXXX',
	'cookiePath' => $G_ROOT. '/cache/cookie', // cookie缓存文件路径
	'webTokenPath' => $G_ROOT. '/cache/webToken', // webToken缓存文件路径
);
require '../config.php';