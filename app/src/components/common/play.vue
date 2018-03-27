<!-- 播放组件 -->
<template>
	<div>
		<div class="music-footer-play"  v-if="AxiosDealMusic" >
			<yd-flexbox>
	            <div class="play-icon" style="width:15%">
	            	<img :src="UploadMp3Pic" />
	            </div>
	            <yd-flexbox-item class="song-contents">
	            	<p class="song_name">{{ UploadMp3Name }}</p>
	            	<p class="song_author">{{ UploadMp3Singer }}</p>
	        	</yd-flexbox-item>
	            <div class="play-icon play-pause">
	            	<img v-if="IsPlaying" src="../../assets/icon/pause.png" @click="PauseMusic(UploadMp3Id)"/>
	            	<img v-else src="../../assets/icon/play.png" @click="PlayMusic(UploadMp3Id, UploadMp3Name, UploadMp3Pic, UploadMp3Singer)"/>
	            	<audio :src="UploadMp3Music" controls="controls" loop="loop" preload="auto" v-show="isHideAudio" ref="audio"></audio>
	            </div>
	            <div class="play-icon play-pause">
	            	<img src="../../assets/icon/lists.png" @click="M_list = true"/>
	            </div>
	        </yd-flexbox>
		</div>
		<yd-popup v-model="M_list" position="bottom" >
	        <yd-cell-group>
	            <div class="cell-title"></div>
			    <yd-cell-item type="radio" class="setting-item" v-for="item in DefaultMp3List">
			       	<span slot="left"  @click="PlayMusic(item.al_id, item.al_name, item.al_pic, item.al_singer)">
			          	<p class="info"><span class="SongName">{{ item.al_name }}</span> - <span class="SongAuthor">{{ item.al_singer }}</span></p>
			        </span>
			    </yd-cell-item>
			</yd-cell-group>
        </yd-popup>

	</div>
</template>

<script >
import store from '@/store'

export default {
	store,
	data() {
		return {
			M_list : false,			   //默认请求歌单的列表
			isHideAudio : false,	   //播放按钮不显示
			DefaultMp3List : [],	   //默认歌单列表
			IsPlaying : false,		   //播放 / 暂停
			
			AxiosMp3Id : '',		   //歌曲播放的id
			FristFlag : true,		   //第一次需要请求
			CurrentMp3List : [],	   //播放歌曲数组   
			mp3Url : '', 		  	   //歌曲播放路径
			AxiosDealMusic : false     //请求完成之后
		}
	},
	methods : {
		
		_GetDefaultMp3 : function()
		{
			let _this = this
			$.ajax({
				url : 'http://www.pengdaokuan.cn/music/restful/api/list.php',
				type : 'post',
				data : {
					al_id : '978885161'
				},
				success : function(res)
				{
					var M_Album = JSON.parse(res)
					for(var i = 0; i < M_Album.length; i++)
					{
						var j = M_Album[i].length
						_this.DefaultMp3List.push({ 'al_name' : M_Album[i].song_name ,'al_page' : M_Album[i].al, 'al_pic' : M_Album[i].pic, 'al_singer' : M_Album[i].singer, 'al_id' : M_Album[i].id })
					}
					// 随机生成一个数,必须是整数，不然会错误
					var randomNum = parseInt(Math.random()*M_Album.length)
					// 存入vuex中，随机同步更新播放的歌曲
					_this.$store.commit('SetMp3Id', (M_Album[randomNum].id))
					_this.$store.commit('SetMp3Name', (M_Album[randomNum].song_name))
					_this.$store.commit('SetMp3Pic', (M_Album[randomNum].pic))
					_this.$store.commit('SetMp3Singer', (M_Album[randomNum].singer))
					// 获得随机播放歌曲的id
					_this.AxiosMp3Id = _this.$store.state.PlayMp3Id
					_this.AxiosDealMusic = true
				},
				error : function(err)
				{

				}
			})	
		},
		// 播放
		PlayMusic : function(id_val, name_val, pic_val, singer_val)
		{
			let vm = this
			// 判断歌曲是否是原来的曲子
			console.log('原歌曲id : ' + vm.$store.state.PlayMp3Id)
			console.log('传进来的歌曲id : ' + id_val)
			
			// 一进来就点击播放
			if(vm.FristFlag)
			{
				// console.log('我是第一次进入。需要请求')
				$.ajax({
					url : 'http://www.pengdaokuan.cn/music/restful/api/play.php',
					type : 'post',
					data : {
						song_id : id_val
					},
					success : function(res)
					{
						var M_Album = JSON.parse(res)
						// console.log(M_Album)
						vm.$store.commit('SetMp3Music', (M_Album.url))
						vm.mp3Url = vm.$store.state.PlayMp3Url
					},
					error : function(err)
					{

					}
				})
				vm.FristFlag = false
			}
			else if(vm.AxiosMp3Id != id_val)
			{
				vm.$store.commit('SetMp3Id', (id_val))
				vm.$store.commit('SetMp3Name', (name_val))
				vm.$store.commit('SetMp3Pic', (pic_val))
				vm.$store.commit('SetMp3Singer', (singer_val))
				// console.log('暂无歌曲或者不同一首歌，需要请求')
				$.ajax({
					url : 'http://www.pengdaokuan.cn/music/restful/api/play.php',
					type : 'post',
					data : {
						song_id : id_val
					},
					success : function(res)
					{
						var M_Album = JSON.parse(res)
						console.log(M_Album)
						vm.$store.commit('SetMp3Music', (M_Album.url))
						vm.mp3Url = vm.$store.state.PlayMp3Url
					},
					error : function(err)
					{

					}
				})
				// 改变状态
				vm.AxiosMp3Id = id_val
			}
			else
			{
				// console.log('歌曲一样，不需要请求')
				// 播放歌曲
				let audioPlayer = vm.$refs.audio
				console.log(audioPlayer)
				audioPlayer.play()
				
				// 改变播放状态
				vm.$store.commit('PlayMp3')
				vm.IsPlaying = true
			}
		},
		PauseMusic : function(id_val)
		{
			let _this = this
			let audioPlayer = _this.$refs.audio
			if(_this.$store.state.playing)
			{
				audioPlayer.pause()
			}
			_this.$store.commit('PauseMp3')
			_this.IsPlaying = false
		}
	},
	//通过计算属性实时刷新播放
	computed : {
		UploadMp3Id : function()
		{
			this.AxiosMp3Id = this.$store.state.PlayMp3Id
			return this.$store.state.PlayMp3Id
		},
		UploadMp3Name : function()
		{
			return this.$store.state.PlayMp3Name
		},
		UploadMp3Pic : function()
		{
			return this.$store.state.PlayMp3pic
		},
		UploadMp3 : function()
		{
			return this.$store.state.PlayMp3Id
		},
		UploadMp3Singer : function()
		{
			return this.$store.state.PlayMp3Singer
		},
		UploadMp3Music : function()
		{
			if(this.$store.state.PlayMp3Url == '')
			{
				console.log('播放路径是空')
			}
			else
			{
				// console.log('播放路径有值，可以播放')
				this.$nextTick(function(){
					let audioPlayer = this.$refs.audio
					// console.log(audioPlayer)
					audioPlayer.play()
					// 改变播放状态
					this.$store.commit('PlayMp3')
					this.IsPlaying = true
				})
			}
			return this.$store.state.PlayMp3Url
		}
	},
	watch : {
		DefaultMp3List : function(val){
			this.$nextTick(function(){
				this.AxiosDealMusic = true
			})
		},
		CurrentMp3List : function(val){
			this.$nextTick(function(){
				console.log('success')
			})
		},
		AxiosMp3Id : function(val){
			this.$nextTick(function(){
				// console.log('success')
			})
		},
		mp3Url : function(val)
		{
			let _this = this
			_this.$nextTick(function(){
				
			})
		}
	},
	created() {
		this.IsPlaying = this.$store.state.playing
		this._GetDefaultMp3()
	}
}

</script>

<style scoped>
*{
	margin:0;
	padding: 0;
}
body{
	background: white;
	font-family:"Microsoft YaHei";
}
.music-footer-play{
	position: fixed;
	bottom: 0px;
	height: 3.4rem;
	width: 100%;
	background-color: #FCFCFC;
}
.music-footer-play img{
	margin-top: 0.4rem;
	margin-left: .4rem;
	height: 2.6rem;
	width: 2.6rem;
}
.music-footer-play .play-icon{
	width: 12%;
}
.music-footer-play .song-contents{
	width: 61%;
	word-wrap: normal;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
.music-footer-play .song_name{
	font-size: .9rem;
	margin-left: .4rem;
	margin-bottom: .2rem;
}
.music-footer-play .song_author{
	margin-left: .4rem;
	font-size: .8rem;
	color:#9C9C9C;
}
.music-footer-play .play-pause img{
	margin-left: .6rem;
	width: 1.8rem;
	height: 1.8rem;
}

/*下部弹出*/
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
.setting-item .info span.SongName{
    font-size: .9rem;
    color:black;
}
.setting-item .info span.SongAuthor{
	font-size: .8rem;
    color:#999;
}
.setting-content i{
	margin-left: .4rem;
	font-size: .8rem;
}
</style>