<?php
session_start();
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

/**
  *实例描述:用户类
  *@Author : PDK
  *@Time : 2017-12-13
*/
require __DIR__.'/Error.php';

class User
{
	/**
	* 数据库连接句柄
	* @ var
	*/
	private $_db;

	/**
	* 构造方法
	* @连接数据库并且返回句柄
	*/
	public function __construct($_db)
	{
		$this->_db = $_db;
	}

	/**
	* 用户注册
	* @ param $username
	* @ param $password 
	* @ param $email 
	*/
	public function Register($username, $password, $email)
	{
		if(empty($username))
		{
			return Error::USERNAME_CANNOT_EMPTY;
		}
		if(empty($password))
		{
			return Error::PASSWORD_CANNOT_EMPTY;
		}
		if(empty($email))
		{
			return Error::EMAIL_CANNOT_EMPTY;
		}
		if($this -> __CheckUserNameExist($username))
		{
			return Error::USERNAME_EXISTS;
		}
		// 写入数据库
		$sql = "INSERT INTO `user`(`username`, `password`, `email`) VALUES (:username, :password, :email)";
		$password = $this -> __md5($password);
		$stmt = $this -> _db -> prepare($sql);
		$stmt -> bindParam(':username', $username);
		$stmt -> bindParam(':password', $password);
		$stmt -> bindParam(':email', $email);
		if(!$stmt -> execute())
		{
			return Error::REGSITER_ERROR_FAIL;
		}
		return Error::REGISTER_SUCCESS;
	}

	/**
	* MD5密码加密
	* @ param $password
	* @ param string $key
	* @ return string
	*/
	public function __md5($string, $key = 'sophia')
	{
		return md5($string . $key);
	}

	/**
	* 检测用户名是否存在
	* @ param $username
	*/
	public function __CheckUserNameExist($username)
	{
		$sql = "SELECT * FROM `user` WHERE `username`=:user " ;
		$stmt = $this -> _db -> prepare($sql); //预处理语句
		$stmt ->bindParam(':user', $username); //参数绑定
		$stmt -> execute();
		$result = $stmt -> fetch(PDO::FETCH_ASSOC); //关联数组
		return !empty($result);
	}

	/**
	* 用户登陆
	* @ param $username
	* @ param $password 
	*/
	public function Login($username, $password)
	{
		$users = [];
		if(empty($username))
		{
			return Error::USERNAME_CANNOT_EMPTY;
		}
		if(empty($password))
		{
			return Error::PASSWORD_CANNOT_EMPTY;
		}
		// 数据库
		$sql = "SELECT * FROM `user` WHERE `username`=:username AND `password`=:password";
		$password = $this -> __md5($password);
		$stmt = $this -> _db -> prepare($sql);
		$stmt -> bindParam(':username', $username);
		$stmt -> bindParam(':password', $password);
		$stmt -> execute();
		$users = $stmt -> fetch(PDO::FETCH_ASSOC);
		$_SESSION['user_id'] = $users["user_id"];
		if(empty($users))
		{
			// throw new Exception("用户名或密码错误", Error::LOGIN_FAIL);
			return Error::LOGIN_FAIL;
		} 
		return Error::LOGIN_SUCCESS;
	}
	/**
	* 查找用户信息
	* @ return param $username
	* @ return param $password 
	*/
	public function View($user_id)
	{
		$info = [];
		$sql = "SELECT * FROM `user` WHERE `user_id`=:user_id ";
		$stmt = $this -> _db -> prepare($sql);
		$stmt -> bindParam(':user_id', $user_id);
		$stmt -> execute();
		$info = $stmt -> fetch(PDO::FETCH_ASSOC);
		$dataUser = [
			'username' => $info["username"],
			'email' => $info["email"]
		];
		return $dataUser;
	}
}

?>