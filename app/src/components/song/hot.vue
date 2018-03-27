<template>
	<div>
		<div class="music-song-info">
			<yd-flexbox class="cell-item" v-for="(item,index) in HotSongList">
            	<div class="num">
            		<p>{{ ++index }}</p>
            	</div>
	            <yd-flexbox-item class="song-introduce">
	            	<p  @click="PlayThisMusic(item.S_mp3, item.S_name, item.S_pic, item.S_singer)" class="song_name">{{ item.S_name }}<i class="fa fa-youtube-play mv-icon"></i></p>
	            	<p class="song_album"><i class="fa fa-share-alt share-alt"></i>专辑：{{ item.S_album }}</p>
	            </yd-flexbox-item>
	            <div class="icon">
	            	<i class="fa fa-bars mores-icon"></i>
	            </div>
	        </yd-flexbox>
		</div>
	</div>
</template>

<script>
import store from '@/store'

export default {
	props : {
		UserName : {
			type : String,
			default : '未知'
		}
	},
	data() {
		return {
			HotSongList : []
		}
	},
	methods : {
		PlayThisMusic : function(music_id, music_name, music_pic, music_singer)
		{
			let vm = this
			console.log("you want to play this : " + music_id)
			vm.$store.commit('SetMp3Id', (music_id))
			vm.$store.commit('SetMp3Name', (music_name))
			vm.$store.commit('SetMp3Pic', (music_pic))
			vm.$store.commit('SetMp3Singer', (music_singer))
		
			// 查找mp3播放地址
			$.ajax({
				url : 'http://www.pengdaokuan.cn/music/restful/api/play.php',
				type : 'post',
				data : {
					song_id : music_id
				},
				success : function(res)
				{
					var M_Album = JSON.parse(res)
					console.log(M_Album)
					vm.$store.commit('SetMp3Music', (M_Album.url))
				},
				error : function(err)
				{

				}
			})
		}
	},
	created() {
		let _this = this 
		$.ajax({
			url : 'http://www.pengdaokuan.cn/music/restful/api/search.php',
			type : 'post',
			data : {
				search_params : _this.UserName
			},
			success : function(res)
			{
				var Msong = JSON.parse(res)
				for(var i = 0; i < Msong.length; i++)
				{
					var j = Msong[i].length
					_this.HotSongList.push({ 'S_name' : Msong[i][j-6] ,'S_album' : Msong[i][j-5], 'S_pic' : Msong[i][j-4], 'S_mp3' : Msong[i][j-3], 'S_mv' : Msong[i][j-2], 'S_singer' : Msong[i][j-1] })
				}
				_this.$emit('Song-pic',Msong[1][2])  //子组件向父传参(.$emit) 
			},
			error : function(err)
			{

			}
		})	
	}
}
</script>

<style scoped>
.cell-item{
	border-bottom:.5px #ccc solid;
	padding: .2rem 0;
}
.music-song-info {
	margin-bottom: 3.6rem;
}
.music-song-info .num{
	width: 12%;
	padding: 1rem .8rem;
	color:#999;
	font-size: 1rem;
}
.music-song-info .song-introduce{
	width: 81%;
}
.music-song-info .song-introduce p.song_name{
	color: black;
	font-size: .9rem;
	overflow: hidden;
	margin-bottom: .3rem;
}
.music-song-info .song-introduce p.song_album{
	color: #999;
	font-size: .82rem;
}
.music-song-info .icon{
	width: 7%;
}
i.mv-icon{
	color:#f44e39;
	margin-left: .3rem;
	font-size: 1rem;
}
i.share-alt{
	color:#f44e39;
	margin-right: .3rem;
	font-size: .7rem;
}
i.mores-icon{
	color:#999;
	font-size: 1.3rem;
}
</style>