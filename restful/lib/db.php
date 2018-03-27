<?php
	/**
	*@连接数据库并且返回句柄
	*@Author : PDK
	*@Time : 2017-12-13
	*/
	$servername = "localhost";
	$username = "root";
	$password = "";

	$pdo = new PDO("mysql:host=$servername;dbname=music", $username, $password);
	// 返回pdo实例
	$pdo->query("set names utf8");
	// var_dump($pdo);
	return $pdo;
?>