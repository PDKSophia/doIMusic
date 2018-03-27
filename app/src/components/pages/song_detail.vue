<!-- 播放页面 -->
<template>
	<div>
		<!-- 歌名 -->
		<div class="Mp3-header">
			<yd-flexbox class="app-music-header">
				<router-link :to="{ path : '/' }">
		            <div class="back">
		            	<i class="fa fa-angle-left"></i>
		            </div>
		        </router-link>
	        	<yd-flexbox-item><span class="Mp3-name">Something Just Like This</span></yd-flexbox-item>
	        </yd-flexbox>
		</div>
		<!-- 图片旋转 -->
		<div align="center" style="padding-top:5rem;">
			<div class="rotate-loading">
				<img src="../../assets/song/list3.jpg" />
			</div>
		</div>

		<!-- 播放 -->
		<div class="song-play-style">
			<div class="music-nav">
				<div class="nav-tab-list">
	        		<div class="tabar-nav">
	        			<div class="pic">
	        				<img src="../../assets/icon/al_add.png" v-if="Att_song" @click="CancleAtt"/>
	        				<img src="../../assets/icon/not_add.png" v-else @click="AttenSong"/>
	        			</div>
	        		</div>
	        		<div class="tabar-nav">
	        			<div class="pic">
	        				<img src="../../assets/icon/download.png" />
	        			</div>
	        		</div>
	        		<div class="tabar-nav">
	        			<div class="pic">
	        				<img src="../../assets/icon/remark.png" />
	        			</div>
	        		</div>
	        		<div class="tabar-nav">
	        			<div class="pic">
	        				<img src="../../assets/icon/about.png" />
	        			</div>
	        		</div>
		        </div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			Att_song : false,
		}
	},
	methods : {
		// 关注
		AttenSong : function()
		{
			this.Att_song = true
			this.$dialog.alert({ mes : '关注成功' })
		},
		// 取消关注
		CancleAtt : function()
		{
			this.Att_song = false
			this.$dialog.alert({ mes : '取消关注成功' })
		}
	},
	created() {
	}
}
</script>

<style>
body{
	background-color: #333;
}
.Mp3-header {
	height:4em;
	background-color: #333;
	border-bottom: .5px solid #999;
}
.Mp3-header .back{
	font-size: 2rem;
	color:white;
	margin-left: .8rem;
	margin-right: .5rem;
}
.Mp3-header .Mp3-name{
	font-size: 1.2rem;
	color:white;
	margin-left: .2rem;
}
.rotate-loading {
	width: 16rem;
	height:16rem;
	border-radius: 50%;
	background-color: #160f0e;
	/*-webkit-filter:blur(15px) brightness(0.6);    /*虚化*/
	/*旋转*/
	animation:roratePic 15s linear .3s infinite;
}
.rotate-loading img{
	width: 11rem;
	height:11rem;
	border-radius: 50%;
	margin-top: 2.5rem;
}
@-webkit-keyframes roratePic /* Safari and Chrome */
{
	0%   {
		transform:rotate(0deg);
	    -webkit-transform:rotate(0deg);  /*兼容-webkit-引擎浏览器*/
	    -moz-transform:rotate(0deg);     /*兼容-moz-引擎浏览器*/
	}
	100%   {
		transform:rotate(360deg);
	    -webkit-transform:rotate(360deg);  /*兼容-webkit-引擎浏览器*/
	    -moz-transform:rotate(360deg);     /*兼容-moz-引擎浏览器*/
	}
}

.song-play-style{
	height: 9.5rem;
	background-color: #333;
	position: fixed;
	bottom: 0px;
	width: 100%;
}

/*icon布局*/
.music-nav{
	height:4rem;
}

/*icon布局*/
.nav-tab-list{
    padding: 1rem 1rem .4rem 1rem;
	position: relative;
	width: 100%;
	display: flex;  /*弹性布局*/
	display: -webkit-flex; /* Safari */
}
.tabar-nav{
	text-align: center;
	display: block;
	/*四个居中的代码*/
	-webkit-box-flex: 1;
    flex: 1;
}
.tabar-nav img{
	width: 2rem;
	height: 2rem;
}
.tabar-nav i{
	font-size: 1.4rem;
	width: 100%;
	color:white;
	margin-bottom: .4rem;
}
.nav-label{
	text-align: center;
    /*color:#999;*/
    color:white;
    font-size: .9rem;
}
</style>