<template>
	<div>
		<div class="search-header">
			<yd-flexbox class="app-search-header">
				<router-link :to="{ path : '/' }">
		            <div class="back">
		            	<i class="fa fa-angle-left"></i>
		            </div>
		        </router-link>
	        	<yd-flexbox-item>
			        <div class="search">
			            <input type="text" name="keywords" v-model.trim="keywords" id="keywords" placeholder="Something Just Like This" />
			            <i class="fa fa-search search-other" v-if="keywords != ''" @click="search_result"></i>
			        </div>
	        	</yd-flexbox-item>
	        	<div class="back">
		        </div>
	        </yd-flexbox>
		</div>
		<div v-if="resultIsOver">
			<div class="song-kind">
				<div align="center">
					<p>
						<i class="fa fa-user-o songs-user"></i><span>歌手分类</span><i class="fa fa-angle-right songs-icon"></i>
					</p>
				</div>
			</div>
			<div class="song-example">
				<p style="color:#999;font-size:.8rem;margin-bottom:.4rem">热门搜索</p>
				<div class="btn">
					<button type="button" @click="default_song('安河桥')">安河桥</button>
					<button type="button" @click="default_song('Yellow')">Yellow</button>
					<button type="button" @click="default_song('周杰伦')">周杰伦</button>
					<button type="button" @click="default_song('刚好遇见你')">刚好遇见你</button>
					<button type="button" @click="default_song('董小姐')">董小姐</button>
					<button type="button" @click="default_song('Yellow')">Yellow</button>
					<button type="button" @click="default_song('Something Just Like This')">Something Just Like This</button>
					<button type="button" @click="default_song('夜空中最亮的星')">夜空中最亮的星</button>
					<button type="button" @click="default_song('Something Just Like This')">Something Just Like This</button>
					<button type="button" @click="default_song('石头计划')">石头计划</button>
				</div>
			</div>
		</div>
		<!-- 请求完成之后 -->
		<div v-if="AxiosIsOver">
			<div class="search-music-tab">
				<yd-tab>
				<!-- 单曲 -->
			        <yd-tab-panel label="单曲" active>
			        	<yd-flexbox class="cell-item" v-for="(item,index) in SearchResult">
			            	<div class="num">
			            		<p>{{ ++index }}</p>
			            	</div>
				            <yd-flexbox-item class="song-introduce">
				            	<p  @click="PlayThisMusic(item.S_mp3, item.S_name, item.S_pic, item.S_singer)"class="song_name">{{ item.S_name }}<i class="fa fa-youtube-play mv-icon"></i></p>
				            	<p class="song_album"><i class="fa fa-music share-alt"></i>{{ item.S_singer}} - {{ item.S_album }}</p>
				            </yd-flexbox-item>
				            <div class="icon">
				            	<i class="fa fa-bars mores-icon"></i>
				            </div>
				        </yd-flexbox>
			    	</yd-tab-panel>
			    <!-- 歌手 -->
			        <yd-tab-panel label="歌手">
			        	<yd-flexbox class="cell-item" v-for="(item,index) in SearchResult">
			            	<div class="song-pic">
			            		<img :src="item.S_pic" />
			            	</div>
				            <yd-flexbox-item class="song-introduce">
				            	<p class="song_name">{{ item.S_singer }}</p>
				            </yd-flexbox-item>
				            <div class="icon">
				            	<i class="fa fa-user-o mores-icon"></i>
				            </div>
				        </yd-flexbox>
			    	</yd-tab-panel>
			    </yd-tab>
			</div>
		</div>
	</div>
</template>

<script>
export default{
	data() {
		return {
			keywords : '',
			SearchResult : [],
			resultIsOver : true,
			AxiosIsOver : false
		}
	},
	methods : {
		_GetCloudMusicApi : function(str_params)
		{
			let _this = this
			$.ajax({
				url : 'http://www.pengdaokuan.cn/music/restful/api/search.php',
				type : 'post',
				data : {
					search_params : str_params
				},
				success : function(res)
				{
					var Msong = JSON.parse(res)
					for(var i = 0; i < Msong.length; i++)
					{
						var j = Msong[i].length
						_this.SearchResult.push({ 'S_name' : Msong[i][j-6] ,'S_album' : Msong[i][j-5], 'S_pic' : Msong[i][j-4], 'S_mp3' : Msong[i][j-3], 'S_mv' : Msong[i][j-2], 'S_singer' : Msong[i][j-1] })
					}
					
				},
				error : function(err)
				{

				}
			})	
		},
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
		},
		default_song : function(str)
		{
			this.$dialog.loading.open('很快加载好了');
			this.keywords = str
            setTimeout(() => {
                this.$dialog.loading.close()
            }, 1000);

            setTimeout(() => {
				this._GetCloudMusicApi(str)
            }, 1500);
		},
		search_result : function()
		{
			let _this = this
			_this.SearchResult = []
			
			this.$dialog.loading.open('很快加载好了')
			setTimeout(() => {
                this.$dialog.loading.close()
            }, 1000)

			setTimeout(() => {
				_this._GetCloudMusicApi(_this.keywords)
            }, 1500)
		}
	},
	watch : {
		SearchResult : function(val)
		{
			this.$nextTick(function(){
				this.resultIsOver = false
				this.AxiosIsOver = true
			})
		}
	}
}
</script>

<style >
.search-header {
	height:4em;
	background-color: #f44e39;
}
.search-header .back{
	font-size: 2rem;
	color:white;
	margin-left: 1rem;
	margin-right: .5rem;
}
.search-header .search-name{
	font-size: 1.2rem;
	color:white;
}
.app-search-header .search{
    border-bottom: .5px solid white;
    height: 2.2rem;
}
.app-search-header .search input{
    margin-top: 0.4rem;
    color:white;
    width:87%;
    color:white;
    background:#f44e39; 
    font-size: 1rem;
    padding-top:.2rem;
    border: none;
    margin-left: .4rem;
}
.search-other{
	font-size: 1.1rem;
	color:white;
	margin-left: .1rem;
}
.app-search-header .search button{
    width:45px;
    height:40px;
    border:0;
    background:#f44e39; 
    float:right
}
input::-webkit-input-placeholder{
	color:	white;
	opacity : 0.4;
}
input:-moz-placeholder{
	color:	white;
	opacity : 0.4;
}

/*歌手分类*/
.song-kind{
	height: 2.2rem;
    border-bottom: .5px solid #ccc;
}
.song-kind i.songs-user{
	font-size: 1.2rem;
	color:#999;
	margin-top:.4rem; 
	margin-right: .3rem;
}
.song-kind i.songs-icon{
	font-size: 1.3rem;
	margin-left: .4rem;
	color:#999;
	margin-top:.4rem; 
}
.song-kind span{
	font-size: .88rem;
	color:#999;
}
.song-example{
	padding:.6rem 1rem;
}
.song-example .btn button{
	border-radius: 6px;
	border:none;
	color:black;
	font-size: .8rem;
	background-color: #F0F8FF;
	height: 1.8rem;
	padding: .5rem;
	margin:.4rem .3rem .2rem 0rem;
}
/*选项卡*/
.yd-tab-nav-item>a {
    display: inherit;
    color: inherit;
    font-size: .9rem;
    height: 2.5rem;
    padding-top: .8rem;
}
/*单曲*/
.search-music-tab{
	margin-bottom: 3.6rem;
}
.cell-item{
	border-bottom:.5px #ccc solid;
	padding: .2rem 0;
}
.cell-item .num{
	width: 12%;
	padding: 1rem .8rem;
	color:#999;
	font-size: 1rem;
}
.cell-item .num i{
	font-size: 1.5rem;
}
.cell-item .song-introduce{
	width: 81%;
}
.cell-item .song-introduce p.song_name{
	color: black;
	font-size: .9rem;
	overflow: hidden;
	margin-bottom: .3rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.cell-item .song-introduce p.song_album{
	color: #999;
	font-size: .82rem;
	overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.cell-item .icon{
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
.song-pic{
	margin-right: 1.2rem;
	padding: .4em .8rem;
}
.song-pic img{
	height: 2.6rem;
    width: 2.6rem;
}
</style>