<template>
	<div>
		<div class="music-song-info">
			<yd-flexbox class="cell-item">
            	<div class="num">
            		<p><i class="fa fa-play-circle-o"></i></p>
            	</div>
	            <yd-flexbox-item class="song-introduce">
	            	<p style="font-size:.95rem">播放全部</p>
	            </yd-flexbox-item>
	            <div class="icon">
	            	<i class="fa fa-download" style="color:#999;font-size:1.1rem;"></i>
	            </div>
	        </yd-flexbox>

			<yd-flexbox class="cell-item" v-for="(item,index) in AlbumList" :key="index">
            	<div class="num">
            		<p>{{ ++index }}</p>
            	</div>
	            <yd-flexbox-item class="song-introduce">
	            	<p @click="PlayThisMusic(item.al_id, item.al_name, item.al_pic, item.al_singer)" class="song_name">{{ item.al_name }}<i class="fa fa-youtube-play mv-icon"></i></p>
	            	<p class="song_album"><i class="fa fa-music share-alt"></i>{{ item.al_singer}} - {{ item.al_page }}</p>
	            </yd-flexbox-item>
	            <div class="icon">
	            	<i class="fa fa-bars mores-icon"></i>
	            </div>
	        </yd-flexbox>
		</div>
	</div>
</template>

<script>
export default {
	props : {
		AlbumNumber : {
			type : String,
			default : '未知'
		}
	},
	data() {
		return {
			AlbumList : []
		}
	},
	methods : {
		// 播放歌曲
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
			url : 'http://www.pengdaokuan.cn/music/restful/api/list.php',
			type : 'post',
			data : {
				al_id : _this.AlbumNumber
			},
			success : function(res)
			{
				var M_Album = JSON.parse(res)
				// console.log(M_Album)
				for(var i = 0; i < M_Album.length; i++)
				{
					var j = M_Album[i].length
					_this.AlbumList.push({ 'al_name' : M_Album[i].song_name ,'al_page' : M_Album[i].al, 'al_pic' : M_Album[i].pic, 'al_singer' : M_Album[i].singer, 'al_id' : M_Album[i].id })
				}
				_this.$emit('Album-ouath', M_Album[0].author)  //子组件向父传参(.$emit) 
				_this.$emit('Album-avatar', M_Album[0].avatarImg)  //子组件向父传参(.$emit) 
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
.music-song-info .num i{
	font-size: 1.5rem;
}
.music-song-info .song-introduce{
	width: 81%;
}
.music-song-info .song-introduce p.song_name{
	color: black;
	font-size: .9rem;
	overflow: hidden;
	margin-bottom: .3rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.music-song-info .song-introduce p.song_album{
	color: #999;
	font-size: .82rem;
	overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
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