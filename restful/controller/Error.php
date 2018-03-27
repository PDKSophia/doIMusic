<?php

/**
  *实例描述:错误提示
  *@Author : PDK
  *@Time : 2017-12-13
*/
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

class Error 
{
	const USERNAME_CANNOT_EMPTY = 1;    //用户名不能为空
	const PASSWORD_CANNOT_EMPTY = 2;    //密码不能为空
	const EMAIL_CANNOT_EMPTY = 3;    	//邮箱不能为空
	const USERNAME_EXISTS = 4;  		//用户名已存在
	const REGSITER_ERROR_FAIL = 5;    	//注册失败
	const LOGIN_FAIL = 6;  				//登陆失败
	const REGISTER_SUCCESS = 7;			//注册成功
	const LOGIN_SUCCESS = 8;			//登陆成功
	
}