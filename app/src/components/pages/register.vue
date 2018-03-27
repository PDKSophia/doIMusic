<template>
	<div>
		<div class="music-login">
			<div class="login-info">
				<p class="app-name">嘟嘟音乐</p>
			</div>
			<form id="upload_register">
				<div class="imgcontainer">
				   	<img src="../../assets/page/nologin.jpeg" class="avatar">
				</div>
				<div class="container">
				    <label><b>用户名</b></label>
				    <input type="text" placeholder="Enter Username" name="username" v-model.trim="username">

				    <label><b>密码</b></label>
				    <input type="password" placeholder="Enter Password" name="password" v-model.trim="password">

				    <label><b>邮箱</b></label>
				    <input type="email" placeholder="Enter Email" name="email" v-model.trim="email">

				    <button type="button" @click="Register_in">注册</button>
				</div>

				<div class="container">
				    <span class="psw">Forgot <a href="#">password?</a></span>
				    <button type="button" class="actives" @click="Login">登陆</button>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			username : '',
			password : '',
			email : ''
		}
	},
	methods : {
		Login : function()
		{
			this.$router.push({ path : '/login' })
		},
		Register_in : function()
		{
			let _this = this
			if(_this.username == '' || _this.password == '' || _this.email == '')
			{
				_this.$dialog.alert({mes: '请完整输入用户账号信息'})
			}
			else
			{
				var myForm = document.getElementById('upload_register')
				var formdata = new FormData(myForm)
				$.ajax({
					url : 'http://www.pengdaokuan.cn/music/restful/register.php',
					type : 'post',
					data : formdata,		//后端返回的必须是json类型
					processData : false,    // 不处理发送的数据
					contentType : false,   // <form>表单构造的FormData对象
					success : function(data){
						// console.log(data)
						if(data != '注册成功'){
							_this.$dialog.alert({mes: data})
						}
						else
						{
							_this.$dialog.alert({mes: data})
							setTimeout(function(){
								_this.$router.push({ path : '/login' })
							} ,1500)
						}
						
					},
					error : function(err){
						if(err.status == 500)
						{
							_this.$dialog.alert({mes : '注册失败'})
						}
					}
				})
			}
		},
	}
}
</script>

<style scoped>
.music-login {
    height:100%;
    width: 100%; /* Could be more or less, depending on screen size */
    margin-bottom: 5.2rem;
}
form{
	height: 100%;
}
/*输入框*/
input[type=text], input[type=password], input[type=email] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
/*注册*/
.actives {
    width: auto;
    padding: 10px 18px;
    background-color: #f44e39;
    float: right;
    margin:0px;
}
/*头像*/
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}
img.avatar {
    width: 40%;
    border-radius: 50%;
}
.container {
    padding: 16px;
}
/*忘记密码*/
span.psw {
    float: left;
    padding-top: 10px;
}
.login-info{
	text-align: center;
}
.login-info .app-name{
	font-size: 2rem;
	letter-spacing: 3px;
	padding-top: 3rem;
}
</style>