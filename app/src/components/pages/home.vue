<!-- 播放组件 -->
<template>
	<div>
		<div class="music-home">
			<yd-flexbox class="app-music-header">
	            <div class="user-info" @click.vative="show_user = true">
	            	<img src="../../assets/icon/info.png" />
	            </div>
	            <!-- 左侧弹出 -->
	            <yd-popup v-model="show_user" position="left" width="60%">
	            	<!-- 已经登陆了的 -->
		        	<div class="login_on" v-if="IsLogin">
		        		<login-on :User="user_name"></login-on>
		        	</div>
		        	<div class="login_off" v-else>
		        		<login-off></login-off>
		        	</div>
		        </yd-popup>
	            <yd-flexbox-item class="play-icon">
	            	<img src="../../assets/icon/music.png" />
	            	<img src="../../assets/icon/musics.png" />
	            	<img src="../../assets/icon/friend.png" />
	            </yd-flexbox-item>
	            <div class="search-music" @click="SearchMusic">
	            	<img src="../../assets/icon/search.png" />
	            </div>
	        </yd-flexbox>
		</div>
		<div class="app-music-tab">
			<yd-tab>
		        <yd-tab-panel label="音乐" active><music-page></music-page></yd-tab-panel>
		        <yd-tab-panel label="视频"><video-page><video-page></video-page></video-page></yd-tab-panel>
		        <yd-tab-panel label="电台"><radio-page><radio-page></radio-page></radio-page></yd-tab-panel>
		    </yd-tab>
		</div>
		<!-- <music-play></music-play> -->
	</div>
</template>

<script >
// import MusicPlay from '../common/play'
import MusicPage from '../other/music'
import VideoPage from '../other/video'
import RadioPage from '../other/radio'
import LoginOn from '../common/login_on'
import LoginOff from '../common/login_off'
import store from '@/store'

export default {
	components : {
		// MusicPlay,
		MusicPage,
		VideoPage,
		RadioPage,
		LoginOn,
		LoginOff
	},
	data() {
		return {
			IsLogin : true,
			show_user : false,
			user_name : 'Admin',
		}
	},
	store,
	created() {
		console.log(this.$store.state.IsLogin)
		if(this.$store.state.IsLogin)
		{
			let vm = this
			$.ajax({
				url : 'http://www.pengdaokuan.cn/music/restful/api/view.php',
				type : 'GET',
				success : function(data)
				{
					vm.user_name = data
					console.log(vm.user_name)
					this.IsLogin = true
				}
			})
		}
	},
	watch : {
		user_name : function(val){
			this.$nextTick(function(){
				this.IsLogin = true
			})
		}
	},
	methods : {
		SearchMusic : function()
		{
			this.$router.push({ path : '/search' })
		}
	}
}

</script>

<style scoped>
*{
	margin:0;
	padding: 0;
}
body{
	font-family:"Microsoft YaHei";
	background-color: white;
}
/*头部*/
.app-music-header{
	height:4em;
	background-color: #f44e39;
}
.music-home .play-icon{
	width: 70%;
}
.music-home .play-icon img{
	margin-left: 16%;
}
.music-home .search-music{
	width: 15%;
}
.music-home .user-info{
	width: 15%;
}
/*图标*/
.music-home img{
	margin-left:0.8rem;
	width: 1.8rem;
	height: 1.8rem;
}

/*选项卡*/
.yd-tab-nav-item>a {
    display: inherit;
    color: inherit;
    font-size: .9rem;
    height: 2.5rem;
    padding-top: .8rem;
}
</style>