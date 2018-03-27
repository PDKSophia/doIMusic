<?php
	header("Content-Type: text/html;charset=utf-8");
	header("Access-Control-Allow-Origin: * ");
	header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
	header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

	require __DIR__.'/controller/User.php';
	$pdo = require __DIR__.'/lib/db.php';
	// 获得传过来的数据
	$username = $_POST["username"];
	$password = $_POST["password"];

	$user = new User($pdo);
	$StatusCode = $user -> Login($username, $password);
	switch ($StatusCode) {
		case '1':
			echo "用户名不能为空";
			break;
		case '2':
			echo "密码不能为空";
			break;
		case '6':
			echo "登陆失败";
			break;
		case '8':
			echo "登陆成功";
			break;
		default:
			echo "服务器错误，请重试";
			break;
	}
?>