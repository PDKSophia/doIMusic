<template>
	<div>
		<div class="setting-header">
			<yd-flexbox class="app-music-header">
				<router-link :to="{ path : '/' }">
		            <div class="back">
		            	<i class="fa fa-angle-left"></i>
		            </div>
		        </router-link>
	        <yd-flexbox-item><span class="setting-name">设置</span></yd-flexbox-item>
	        </yd-flexbox>
		</div>
		<div class="setting-content">
			<!-- 基本信息 -->
			<yd-cell-group>
				<div class="cell-title">网络</div>
		        <yd-cell-item type="label" class="setting-item" v-for="item in Setting">
		            <div slot="left"><p class="info">{{ item.content }}</p></div>
		            <yd-switch slot="right"style="color:#f44e39;"></yd-switch>
		        </yd-cell-item>
		    </yd-cell-group>
		    <!-- 播放+下载 -->
		    <yd-cell-group>
				<div class="cell-title">播放和下载</div>
		   		<yd-cell-item type="label" class="setting-item" @click.native="online_play = true">
		            <div slot="left"><p class="info">在线播放音质</p></div>
		            <span slot="right"><p class="info">{{ de_music }}<i class="fa fa-angle-right"></i></p></span>
		        </yd-cell-item> 
		        <yd-cell-item type="label" class="setting-item" @click.native="music_quality = true">
		            <div slot="left"><p class="info">下载音质</p></div>
		            <span slot="right"><p class="info">{{ download }}<i class="fa fa-angle-right"></i></p></span>
		        </yd-cell-item> 
		    </yd-cell-group>

		    <!-- 工具 -->
		    <yd-cell-group>
				<div class="cell-title">工具</div>
		        <yd-cell-item type="label" class="setting-item" v-for="item in Tools">
		            <div slot="left"><p class="info">{{ item.content }}</p></div>
		            <yd-switch slot="right"style="color:#f44e39;"></yd-switch>
		        </yd-cell-item>
		    </yd-cell-group>

		    <!-- 中间弹出 -->
		    <yd-popup v-model="online_play" position="center" width="100%">
	            <yd-cell-group>
	            <div class="cell-title"></div>
			        <yd-cell-item type="radio" class="setting-item" v-for="item in online">
			            <span slot="left"><p class="info">{{ item.text }}</p></span>
			            <input slot="right" type="radio" :value="item.val" v-model="de_music"/>
			        </yd-cell-item>
			    </yd-cell-group>
        	</yd-popup>
        	<!-- 下部弹出 -->
        	<yd-popup v-model="music_quality" position="bottom" height="11.9rem">
	            <yd-cell-group>
	            <div class="cell-title"></div>
			        <yd-cell-item type="radio" class="setting-item" v-for="item in online">
			            <span slot="left"><p class="info">{{ item.text }}</p></span>
			            <input slot="right" type="radio" :value="item.val" v-model="download"/>
			        </yd-cell-item>
			    </yd-cell-group>
        	</yd-popup>

        	<!-- 关于 -->
        	<yd-cell-group>
				<div class="cell-title">关于</div>
		        <yd-cell-item type="label" class="setting-item" v-for="item in about_help">
		            	<div slot="left">
		            		<router-link :to="{ path : item.path }">
		            			<p class="info">{{ item.text }}</p>
		            		</router-link>
		            	</div>
		        </yd-cell-item>
		    </yd-cell-group>
		</div>

		<div class="setting-footer">
			<button @click="ChangeAccount">切换账号</button>
		</div>
	</div>
</template>

<script>
export default {
	data(){
		return {
			online_play : false,   	//在线播放
			music_quality : false,  //音质
			de_music: '较高',
			download : '标准',
			// 播放
			Setting : [
				{
					content : '使用2G/3G/4G网络播放',
				},
				{
					content : '使用2G/3G/4G网络下载',
				},
				{
					content : '视频页中Wi-Fi下连续播放',
				}
			],
			// 下载
			online : [
				{
					text : '自动选择(推荐)',
					val : '自动'
				},
				{
					text : '标准(128kbit/s)',
					val : '标准'
				},
				{
					text : '较高(192kbit/s)',
					val : '较高'
				},
				{
					text : '极高(320kbit/s)',
					val : '极高'
				},
			],
			// 工具
			Tools : [
				{
					content : '桌面歌词',
				},
				{
					content : '显示歌词翻译',
				},
				{
					content : '锁屏显示',
				}
			],
			// 关于
			about_help : [
				{
					text : '嘟嘟音乐还能这么玩？',
					path : '#',
				},
				{
					text : '帮助与反馈',
					path : '#',
				},
				{
					text : '关于嘟嘟音乐',
					path : '#',
				}
			]
		}
	},
	methods : {
		close_model : function(attr)
		{
			console.log(111)
			this[attr] = fasle	 //等价于如果传进来a,那么this.a = false
		},
		ChangeAccount : function()
		{
			let _this = this
			_this.$dialog.confirm({
                title: '嘟嘟音乐提示您',
                mes: '确定退出当前账号吗？',
                opts: () => {
                	_this.$dialog.toast({mes: `正在为您切换账号<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>`, timeout: 1000})
                	setTimeout(function(){
                    	_this.$router.push({ path : '/login' })
                	}, 1500)
                }
            });
		}
	}
}
</script>

<style scoped>

.setting-header {
	height:4em;
	background-color: #f44e39;
}
.setting-header .back{
	font-size: 2rem;
	color:white;
	margin-left: 1rem;
	margin-right: .5rem;
}
.setting-header .setting-name{
	font-size: 1.2rem;
	color:white;
}
/*设置内容*/
.cell-title{
	padding: .24rem .34rem .1rem;
    font-size: .78rem;
    text-align: left;
    color: #888;
    position: relative;
    z-index: 1;
}
.setting-item{
	height: 2.8rem;
}
.setting-item .info{
    font-size: .8rem;
}
.setting-content i{
	margin-left: .4rem;
	font-size: .8rem;
}
button{
	margin-top: 2rem;
	width: 100%;
    height: 2.6rem;
    border: none;
    background-color: #f44e39;
    color: white;
    font-size:1.1rem;
    padding: .4rem;
    margin-bottom: 5.2rem;
}
</style>