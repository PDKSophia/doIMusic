<template>
	<div>
		<div class="login-user-header" align="center">
			<img src="../../assets/page/w.jpg" />
			<p class="usernames">{{ User }}</p>
		</div>
		<div class="all-icon">
			<div class="list">
				<p><i class="fa fa-envelope-o"></i></i><span>我的消息</span></p>
				<p><i class="fa fa-user-o"></i><span>我的好友</span></p>
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
				<p><i class="fa fa-qq"></i></i><span>QQ</span></p>
				<p><i class="fa fa-wechat"></i></i><span>Wechat</span></p>
				<p><i class="fa fa-github"></i></i><span>Github</span></p>
				<p><i class="fa fa-weibo"></i></i><span>Weibo</span></p>
				<p><i class="fa fa-facebook"></i></i><span>Facebook</span></p>
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
	// 不能直接使用父组件定义好的user_name，要用props
	props: {
		// 定义user_name的数据类型
		User : {
			type : String,   //接收字符串类型，如果父组件传过来的不是字符串类型就会报错
			default : 'SB'    
		},
	},
	methods: {
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
	height: 10rem;
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

</style>