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
	$email = $_POST["email"];
	// 实例化
	$user = new User($pdo);
	
	$StatusCode = $user -> Register($username, $password, $email);
	switch ($StatusCode) {
		case '1':
			echo "用户名不能为空";
			break;
		case '2':
			echo "密码不能为空";
			break;
		case '3':
			echo "邮箱不能为空";
			break;
		case '4':
			echo "用户已存在,无法注册";
			break;
		case '5':
			echo "注册失败";
			break;
		case '7':
			echo "注册成功";
			break;
		default:
			echo "服务器错误";
			break;
	}
	
?>