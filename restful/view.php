<?php
	session_start();
	header("Content-Type: text/html;charset=utf-8");
	header("Access-Control-Allow-Origin: * ");
	header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
	header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

	require __DIR__.'/controller/User.php';
	$pdo = require __DIR__.'/lib/db.php';
	// 获得传过来的数据
	$user = new User($pdo);
	$res = [];
	$res = $user -> View($_SESSION["user_id"]);
	echo $res["username"];
?>