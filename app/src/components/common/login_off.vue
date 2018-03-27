<template>
	<div>
		<div class="login-user-header" align="center">
			<img src="../../assets/page/nologin.jpeg" />
			<p class="usernames"><button @click="User_Login">登陆</button></p>
		</div>
		<div class="all-icon">
			<div class="list">
				<p><i class="fa fa-map-marker"></i></i><span>附近的人</span></p>
			</div>
			<div style="height:10px;background:#efeff4"></div>
			<div class="list">
				<p><i class="fa fa-diamond"></i></i><span>会员中心</span></p>
				<p><i class="fa fa-eye"></i></i><span>护眼模式</span></p>
				<p><i class="fa fa-hourglass-2"></i></i><span>定时停止播放</span></p>
			</div>
			<div style="height:10px;background:#efeff4"></div>
			<div class="list">
				<p><i class="fa fa-cog"></i></i><span @click="setting">设置</span></p>
				<p><i class="fa fa-power-off"></i></i><span @click="exit">退出</span></p>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	methods : {
		User_Login : function()
		{
			this.$router.push({ path : '/login' })
		},
		setting : function()
		{
			this.$router.push({ path : '/setting' })
		},
		exit : function()
		{
			let _this = this
			_this.$store.commit('ExitStatus')

			_this.$dialog.confirm({
                title: '嘟嘟音乐提示您',
                mes: '确定退出当前账号吗？',
                opts: () => {
                	_this.$dialog.toast({mes: `退出中<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>`, timeout: 1000})
                	setTimeout(function(){
                    	_this.$router.push({ path : '/' })
                	}, 1500)
                }
            });
		}
	}
}
</script>

<style scoped>
.login-user-header{
	height: 12rem;
	background-color: #f44e39;
	/*background-image: url(../../assets/page/2.jpeg);*/
	/*background-repeat:no-repeat;*/
	/*background-size:100% 100%;*/
	/*-moz-background-size:100% 100%*/
}
.login-user-header img{
    width: 5.5rem;
    height: 5.5rem;
    margin-top:2rem;
    border-radius: 50%;
}
.login-user-header p.usernames{
	font-size: 1rem;
	margin-top: .6rem;
	color:white;
}
.all-icon .list p{
	padding:.6rem;
}
.all-icon .list i{
	font-size: 1.3rem;
	width:1.3rem;
	color:#999;
	margin-right: .6rem;
}
.all-icon .list span{
	font-size: .9rem;
}
button{
	border: none;
	height: 2rem;

	color:white;
	font-size: 1.6rem;
}
</style>